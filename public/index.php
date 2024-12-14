<?php

use FastRoute\Dispatcher;

use function FastRoute\simpleDispatcher;

// Start session
session_start();

// Root path of the project
const BASE_PATH = __DIR__ . '/../';

// Autoload
require_once BASE_PATH . 'vendor/autoload.php';

// Load helper functions
require_once BASE_PATH . 'utils/helperFunctions.php';

// Load routes
$dispatcher = simpleDispatcher(require BASE_PATH . 'routes.php');

// Get the URI and method of the request
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch the request
$routeInfo = $dispatcher->dispatch($method, $uri);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        // Handle 404
        view('errors/404', []);
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        // Handle 405
        view('errors/405', []);
        break;
    case Dispatcher::FOUND:
        [$controller, $action] = $routeInfo[1];
        call_user_func([new $controller(), $action]);
        break;
}
