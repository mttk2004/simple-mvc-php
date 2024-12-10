<?php

namespace Core\Middleware;

use Core\Session;

class Auth
{
    public function handle(): void
    {
        authorize(Session::has('user'));
    }
}
