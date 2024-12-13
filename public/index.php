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

// Bootstrap the application
require_once BASE_PATH . 'bootstrap.php';

// Routes
require_once BASE_PATH . 'routes.php';

// Get the URI and method of the request
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Route the request
try {
    $router->route($uri, $method);
} catch (Exception $e) {
    // Display the error
    view('errors/404', ['error' => $e->getMessage()]);

    // End flash session
    Session::unFlash();
}
