<?php

use Core\Session;
use Core\ValidationException;
use Core\Router;


// Start session
session_start();

// Root path of the project
const BASE_PATH = __DIR__ . '/../';

// Autoload
require_once BASE_PATH . './vendor/autoload.php';

// functions.php is required for the functions used in the project
require_once BASE_PATH . './utils/helperFunctions.php';

// Start session
require_once BASE_PATH . './bootstrap.php';

// Routes
require_once BASE_PATH . './routes.php';

// Get the URI and method
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Route the request
try {
	$router->route($uri, $method);
} catch (ValidationException $e) {
	// Set the session for error
	Session::flash('errors', $e->errors);
	Session::flash('old', $e->old);
	
	// Redirect back
	redirect($router->previousUrl());
} catch (Exception $e) {
	// Redirect to 404 page
	abort();
}

// End flash session
Session::unFlash();
