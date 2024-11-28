<?php

use Core\Router;


$router = new Router;

// TODO: Add routes here as needed
$router->get('/', 'home');
$router->get('/about', 'about')->only('auth');
$router->get('/contact', 'contact');
$router->get('/users', 'user/index');
