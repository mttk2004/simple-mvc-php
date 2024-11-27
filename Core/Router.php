<?php

namespace Core;


use Core\Middleware\Middleware;
use Exception;
use JetBrains\PhpStorm\NoReturn;


/**
 * Class Router
 *
 * This class provides a mechanism to resolve and handle routes based on a given URI and method.
 */
class Router
{
	public array $routes = [];
	
	private function add($method, $uri, $controller): void
	{
		$this->routes[$method][$uri] = $controller;
	}
	
	public function get($uri, $controller): void
	{
		$this->add('GET', $uri, $controller);
	}
	
	public function post($uri, $controller): void
	{
		$this->add('POST', $uri, $controller);
	}
	
	public function put($uri, $controller): void
	{
		$this->add('PUT', $uri, $controller);
	}
	
	public function patch($uri, $controller): void
	{
		$this->add('PATCH', $uri, $controller);
	}
	
	public function delete($uri, $controller): void
	{
		$this->add('DELETE', $uri, $controller);
	}
	
	/**
	 * @throws Exception
	 */
	public function route($uri, $method): void
	{
		// Find the route
		foreach ($this->routes as $route) {
			if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
				// Check if the route has middleware
				Middleware::resolve($route['middleware']);
				
				// Call the controller
				require_once BASE_PATH . "Http/controller/{$route['controller']}.php";
				exit;
			}
		}
		
		// If no route is found, abort with 404
		$this->abort();
	}
	
	public function previousUrl(): string
	{
		return $_SERVER['HTTP_REFERER'] ?? '/';
	}
	
	#[NoReturn] protected function abort($code = 404): void
	{
		http_response_code($code);
		
		require_once BASE_PATH . "view/{$code}.view.php";
		exit;
	}
}
