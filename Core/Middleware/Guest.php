<?php

namespace Core\Middleware;


use Core\ResponseCode;
use Core\Session;


class Guest
{
	function handle(): void
	{
		authorize(!Session::has('user'), ResponseCode::UNAUTHORIZED);
	}
}
