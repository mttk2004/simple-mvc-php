<?php

use Core\Session;

// Start session
session_start();

// Root path of the project
const BASE_PATH = __DIR__ . '/../';

// Autoload
require_once BASE_PATH . 'vendor/autoload.php';

// Load helper functions
require_once BASE_PATH . 'utils/helperFunctions.php';

// Routes
require_once BASE_PATH . 'routes.php';

// Get the URI and method of the request
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Debugging: Print the URI and method
error_log("URI: $uri, Method: $method");

// Route the request
try {
    $router->route($uri, $method);
} catch (Exception $e) {
    // Display the error
    view('errors/500', ['error' => $e->getMessage()]);

    // End flash session
    Session::unFlash();
}
