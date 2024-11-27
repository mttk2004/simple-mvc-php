<?php

use Core\App;
use Core\Container;
use Core\Database;


/**
 * Create a new Container instance and bind the Database class to it.
 */
$container = new Container();

/**
 * Bind the Database class to the container with a closure that returns a new Database instance.
 */
$container->bind('Core\Database', function () {
	$config = require_once(__DIR__ . '/Core/config.php');
	
	return new Database($config);
});

/**
 * Set the container instance in the App class.
 */
App::setContainer($container);
