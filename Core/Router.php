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
    /**
     * @var array $routes The array of routes.
     */
    public array $routes = [];

    /**
     * Adds a new route to the routes array.
     *
     * @param string $method     The HTTP method of the route (e.g., GET, POST).
     * @param string $uri        The URI of the route.
     * @param array  $controller The controller to handle the route.
     *
     * @return Router Returns the current Router instance for method chaining.
     */
    private function add(string $method, string $uri, array $controller): Router
    {
        $this->routes[] = [
                'method' => $method,
                'uri' => $uri,
                'controller' => $controller,
                'middleware' => null,
        ];

        return $this;
    }

    /**
     * Adds a GET route.
     *
     * @param string $uri        The URI of the route.
     * @param array  $controller The controller to handle the route.
     *
     * @return Router
     */
    public function get(string $uri, array $controller): Router
    {
        return $this->add('GET', $uri, $controller);
    }

    /**
     * Adds a POST route.
     *
     * @param string $uri        The URI of the route.
     * @param array  $controller The controller to handle the route.
     *
     * @return Router
     */
    public function post(string $uri, array $controller): Router
    {
        return $this->add('POST', $uri, $controller);
    }

    /**
     * Adds a PUT route.
     *
     * @param string $uri        The URI of the route.
     * @param array  $controller The controller to handle the route.
     *
     * @return Router
     */
    public function put(string $uri, array $controller): Router
    {
        return $this->add('PUT', $uri, $controller);
    }

    /**
     * Adds a PATCH route.
     *
     * @param string $uri        The URI of the route.
     * @param array  $controller The controller to handle the route.
     *
     * @return Router
     */
    public function patch(string $uri, array $controller): Router
    {
        return $this->add('PATCH', $uri, $controller);
    }

    /**
     * Adds a DELETE route.
     *
     * @param string $uri        The URI of the route.
     * @param array  $controller The controller to handle the route.
     *
     * @return Router
     */
    public function delete(string $uri, array $controller): Router
    {
        return $this->add('DELETE', $uri, $controller);
    }

    /**
     * Resolves the route based on the given URI and method.
     *
     * @param string $uri    The URI to resolve.
     * @param string $method The method to resolve.
     *
     * @return void
     * @throws Exception
     */
    #[NoReturn] public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route['uri']);
            if (preg_match('#^' . $pattern . '$#', $uri, $matches) && $route['method'] === strtoupper($method)) {
                array_shift($matches); // Remove the full match from the beginning of the matches array

                if ($route['middleware']) {
                    Middleware::resolve($route['middleware']);
                }

                [$class, $method] = $route['controller'];
                try {
                    if (!class_exists($class) || !method_exists($class, $method)) {
                        throw new Exception('Controller or method not found');
                    }

                    // Extract parameter names from the route URI
                    preg_match_all('/\{([^\}]+)\}/', $route['uri'], $paramNames);
                    $params = array_combine($paramNames[1], $matches);

                    (new $class())->$method($params);
                    exit();
                } catch (Exception $e) {
                    view('errors/500', ['error' => $e->getMessage()]);
                    exit();
                }
            }
        }

        $this->abort();
    }

    /**
     * Gets the previous URL.
     *
     * @return string The previous URL.
     */
    public function previousUrl(): string
    {
        return $_SERVER['HTTP_REFERER'] ?? '/';
    }

    /**
     * Aborts the request with a given HTTP status code.
     *
     * @param int $code The HTTP status code.
     *
     * @return void
     */
    #[NoReturn] protected function abort(int $code = 404): void
    {
        if (!headers_sent()) {
            http_response_code($code);
        }
        require_once(BASE_PATH . 'resources/views/errors/' . $code . '.html.twig');
        exit();
    }

    /**
     * Adds a middleware to the last route.
     *
     * @param string $key The key of the middleware.
     *
     * @return Router
     */
    public function only(string $key): Router
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }
}
