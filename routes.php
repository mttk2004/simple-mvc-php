<?php

use Core\Router;

$router = new Router();

// TODO: Add routes here as needed
$router->get('/', 'home');
$router->get('/about', 'about')->only('guest');
$router->get('/users', 'user/index');
$router->get('/login', 'session/create')->only('guest');
$router->post('/login', 'session/store')->only('guest');
$router->post('/logout', 'session/destroy')->only('auth');
