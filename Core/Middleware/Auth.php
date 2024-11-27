<?php

namespace Core\Middleware;


use Core\ResponseCode;
use Core\Session;


class Auth
{
	function handle(): void
	{
		authorize(Session::has('user'), ResponseCode::FORBIDDEN);
	}
}
