<?php

namespace Core;

use Exception;

/**
 * Class Container
 *
 * This class provides a simple dependency injection container.
 */
class Container
{
    /**
     * @var array $bindings The array of bindings in the container.
     */
    private array $bindings = [];

    /**
     * Binds a key to a value in the container.
     *
     * @param string $key   The key to bind.
     * @param mixed  $value The value to bind to the key.
     *
     * @return void
     */
    public function bind(string $key, mixed $value): void
    {
        $this->bindings[$key] = $value;
    }

    /**
     * Resolves a key from the container.
     *
     * @param string $key The key to resolve.
     *
     * @return mixed The resolved value.
     * @throws Exception If the key is not bound in the container.
     */
    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("$key is not bound in the container");
        }

        return call_user_func($this->bindings[$key]);
    }
}
