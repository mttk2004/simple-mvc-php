<?php

namespace Core;


class Session
{
	public static function start(): void
	{
		session_start();
	}
	
	public static function destroy(): void
	{
		session_destroy();
	}
	
	public static function has($key): bool
	{
		return isset($_SESSION[$key]);
	}
	
	public static function set($key, $value): void
	{
		$_SESSION[$key] = $value;
	}
	
	public static function get($key, $default = null)
	{
		return $_SESSION[$key] ?? $default;
	}
	
	public static function unset($key): void
	{
		unset($_SESSION[$key]);
	}
	
	public static function flash($key, $value): void
	{
		$_SESSION['__flash'][$key] = $value;
	}
	
	public static function getFlash($key, $default = null)
	{
		$value = $_SESSION['__flash'][$key] ?? $default;
		unset($_SESSION['__flash'][$key]);
		
		return $value;
	}
	
	public static function unFlash(): void
	{
		unset($_SESSION['__flash']);
	}
}
