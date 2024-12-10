<?php

namespace Core\Middleware;

use Exception;

/**
 * Class Middleware
 *
 * This class provides a mechanism to resolve and handle middleware based on a given key.
 */
class Middleware
{
    /**
     * @var array MAP A map of middleware keys to their corresponding class names.
     */
    private const array MAP
        = [
                'auth' => Auth::class,
                'guest' => Guest::class,
            // TODO: Add more middleware here as needed
        ];

    /**
     * Resolves and handles the middleware for the given key.
     *
     * @param string $key The key of the middleware to resolve.
     *
     * @return void
     * @throws Exception If the middleware key is not found.
     */
    public static function resolve(string $key): void
    {
        if (!$key) {
            return;
        }

        $middleware = self::MAP[$key] ?? null;
        if ($middleware) {
            (new $middleware())->handle();
        } else {
            throw new Exception("Middleware {$key} not found");
        }
    }
}
