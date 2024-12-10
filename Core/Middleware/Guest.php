<?php

namespace Core\Middleware;

use Core\ResponseCode;
use Core\Session;

class Guest
{
    public function handle(): void
    {
        authorize(!Session::has('user'), ResponseCode::UNAUTHORIZED);
    }
}
