<?php

namespace Core\Middleware;


use Core\Session;


class Auth
{
	function handle(): void
	{
		authorize(Session::has('user'));
	}
}
