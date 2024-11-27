<?php

namespace Core;


use Exception;


/**
 * Class App
 *
 * This class provides methods to manage the application container.
 */
class App
{
	/**
	 * @var Container $container The application container instance.
	 */
	private static Container $container;
	
	/**
	 * Sets the application container.
	 *
	 * @param Container $container The container instance to set.
	 *
	 * @return void
	 */
	public static function setContainer(Container $container): void
	{
		self::$container = $container;
	}
	
	/**
	 * Gets the application container.
	 *
	 * @return Container The container instance.
	 */
	public static function getContainer(): Container
	{
		return self::$container;
	}
	
	/**
	 * Resolves a key from the container.
	 *
	 * @param string $key The key to resolve.
	 *
	 * @return mixed The resolved value.
	 * @throws Exception If the key cannot be resolved.
	 */
	public static function resolve(string $key): mixed
	{
		return self::$container->resolve($key);
	}
}
