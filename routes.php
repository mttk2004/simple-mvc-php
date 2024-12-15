<?php

use Core\Router;
use Http\Controllers\CommonController;
use Http\Controllers\SessionController;
use Http\Controllers\UserController;

$router = new Router();

// TODO: Add routes here as needed
$router->get('/', [CommonController::class, 'index']);
$router->get('/about', [CommonController::class, 'about']);

$router->get('/login', [SessionController::class, 'create'])->only('guest');
$router->post('/login', [SessionController::class, 'store'])->only('guest');
$router->delete('/logout', [SessionController::class, 'destroy'])->only('auth');

$router->get('/users', [UserController::class, 'index'])->only('guest');
$router->get('/users/{id}', [UserController::class, 'show'])->only('guest');
