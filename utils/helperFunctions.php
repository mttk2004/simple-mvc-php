<?php

use Core\App;
use Core\Database;
use Core\ResponseCode;
use Core\Session;
use JetBrains\PhpStorm\NoReturn;

/**
 * Dumps the variable and ends the script.
 *
 * @param mixed $var The variable to dump.
 *
 * @return void
 */
#[NoReturn] function dd(mixed $var): void
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

/**
 * Checks if the current URL matches the given URL.
 *
 * @param string $url The URL to check.
 *
 * @return bool True if the current URL matches, false otherwise.
 */
function urlIs(string $url): bool
{
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

    return $uri === $url;
}

/**
 * Authorizes a condition and aborts with a status code if the condition is not met.
 *
 * @param bool $condition  The condition to check.
 * @param int  $statusCode The status code to abort with if the condition is not met.
 *
 * @return void
 */
function authorize(bool $condition, int $statusCode = ResponseCode::FORBIDDEN): void
{
    if (!$condition) {
        abort($statusCode);
    }
}

/**
 * Aborts the request with the given status code.
 *
 * @param int $statusCode The status code to abort with.
 *
 * @return void
 */
#[NoReturn] function abort(int $statusCode = 404): void
{
    http_response_code($statusCode);
    require_once(BASE_PATH . 'resources/views/' . $statusCode . '.view.php');
    exit();
}

/**
 * Renders a view with the given data.
 *
 * @param string $view The name of the view file.
 * @param array  $data The data to pass to the view.
 *
 * @return void
 */
function view(string $view, array $data): void
{
    extract($data);

    $viewPath = BASE_PATH . 'resources/views/' . $view . '.view.php';
    if (!file_exists($viewPath)) {
        abort();
    }

    require($viewPath);
}

/**
 * Redirects to the given URL.
 *
 * @param string $url The URL to redirect to.
 *
 * @return void
 */
#[NoReturn] function redirect(string $url): void
{
    header('Location: ' . $url);
    die();
}

/**
 * Retrieves the old input value from the session flash data.
 *
 * @param string      $key     The key of the old input value.
 * @param string|null $default The default value to return if the old input value is not set.
 *
 * @return mixed The old input value or the default value.
 */
function old(string $key, null|string $default = ''): mixed
{
    return Session::getFlash('old')[$key] ?? $default;
}

/**
 * Resolves and returns the Database instance from the App container.
 * If an exception occurs, aborts with an internal server error status code.
 *
 * @return Database The resolved Database instance.
 */
function resolveDatabase(): Database
{
    try {
        return App::resolve(Database::class);
    } catch (Exception) {
        abort(ResponseCode::INTERNAL_SERVER_ERROR);
    }
}
