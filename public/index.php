<?php

use Core\Session;
use Core\ValidationException;


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
} catch (ValidationException $e) {
	// Set the session for error
	Session::flash('errors', $e->errors);
	Session::flash('old', $e->old);
	
	// Redirect back to the previous URL
	redirect($router->previousUrl());
} catch (Exception $e) {
	// Redirect to 404 page if no route is found
	abort();
}

// End flash session
Session::unFlash();
