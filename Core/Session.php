<?php

namespace Core;


/**
 * Class Session
 *
 * This class provides methods to manage PHP sessions.
 */
class Session
{
	/**
	 * Starts the session.
	 *
	 * @return void
	 */
	public static function start(): void
	{
		session_start();
	}
	
	/**
	 * Destroys the session.
	 *
	 * @return void
	 */
	public static function destroy(): void
	{
		session_destroy();
	}
	
	/**
	 * Checks if a session key exists.
	 *
	 * @param string $key The key to check.
	 *
	 * @return bool True if the key exists, otherwise false.
	 */
	public static function has(string $key): bool
	{
		return isset($_SESSION[$key]);
	}
	
	/**
	 * Sets a session key.
	 *
	 * @param string $key   The key to set.
	 * @param mixed  $value The value to set.
	 *
	 * @return void
	 */
	public static function set(string $key, mixed $value): void
	{
		$_SESSION[$key] = $value;
	}
	
	/**
	 * Gets a session key.
	 *
	 * @param string     $key     The key to get.
	 * @param mixed|null $default The default value to return if the key does not exist.
	 *
	 * @return mixed The value of the key, or the default value if the key does not exist.
	 */
	public static function get(string $key, mixed $default = null): mixed
	{
		return $_SESSION[$key] ?? $default;
	}
	
	/**
	 * Unsets a session key.
	 *
	 * @param string $key The key to unset.
	 *
	 * @return void
	 */
	public static function unset(string $key): void
	{
		unset($_SESSION[$key]);
	}
	
	/**
	 * Flashes a session key.
	 *
	 * @param string $key   The key to flash.
	 * @param mixed  $value The value to flash.
	 *
	 * @return void
	 */
	public static function flash(string $key, mixed $value): void
	{
		$_SESSION['__flash'][$key] = $value;
	}
	
	/**
	 * Gets a flashed session key.
	 *
	 * @param string     $key     The key to get.
	 * @param mixed|null $default The default value to return if the key does not exist.
	 *
	 * @return mixed The value of the key, or the default value if the key does not exist.
	 */
	public static function getFlash(string $key, mixed $default = null): mixed
	{
		$value = $_SESSION['__flash'][$key] ?? $default;
		unset($_SESSION['__flash'][$key]);
		
		return $value;
	}
	
	/**
	 * Unflashes all session keys.
	 *
	 * @return void
	 */
	public static function unFlash(): void
	{
		unset($_SESSION['__flash']);
	}
}
