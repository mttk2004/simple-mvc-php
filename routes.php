<?php

use Core\Router;

$router = new Router();

// TODO: Add routes here as needed
$router->get('/', 'home');
$router->get('/about', 'about')->only('guest');
$router->get('/users', 'user/index');
