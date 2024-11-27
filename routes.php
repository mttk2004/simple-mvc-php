<?php

use Core\Router;

$router = new Router;

$router->get('/', 'home');
$router->get('/about', 'about');
$router->get('/contact', 'contact');
// More routes here
