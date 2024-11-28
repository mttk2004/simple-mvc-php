<?php

use Core\Router;


$router = new Router;

$router->get('/', 'home');
$router->get('/about', 'about')->only('auth');
$router->get('/contact', 'contact');
// TODO: Add more routes here.
