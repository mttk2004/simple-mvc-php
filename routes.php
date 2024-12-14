<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    $COMMON_CONTROLLER = 'Http\Controllers\CommonController';
    $SESSION_CONTROLLER = 'Http\Controllers\SessionController';
    $USER_CONTROLLER = 'Http\Controllers\UserController';

    // Common routes
    $r->addRoute('GET', '/', [$COMMON_CONTROLLER, 'home']);
    $r->addRoute('GET', '/about', [$COMMON_CONTROLLER, 'about']);

    // Session routes
    $r->addRoute('GET', '/login', [$SESSION_CONTROLLER, 'create']);
    $r->addRoute('POST', '/login', [$SESSION_CONTROLLER, 'store']);
    $r->addRoute('DELETE', '/logout', [$SESSION_CONTROLLER, 'destroy']);

    // User routes
    $r->addRoute('GET', '/users', [$USER_CONTROLLER, 'index']);
};
