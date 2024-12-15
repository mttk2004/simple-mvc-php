<?php

use Core\ResponseCode;
use Core\Session;
use Medoo\Medoo;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
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
    exit();
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
    require_once(BASE_PATH . 'resources/views/errors/' . $statusCode . '.html.twig');
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
    $data['auth_user'] = Session::get('auth_user');
    $twig = require_once BASE_PATH . 'config/twig.php';
    echo $twig->render($view . '.html.twig', $data);
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
    exit();
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
 * Resolves the database connection.
 *
 * @return Medoo The database connection.
 */
function resolveDatabase(): Medoo
{
    $config = require_once BASE_PATH . 'config/medoo.php';
    return new Medoo($config);
}

/**
 * Resolves the logger with the given name.
 *
 * @param string $name The name of the logger.
 *
 * @return Logger The logger.
 */
function resolveLogger(string $name): Logger
{
    // Tạo logger
    $logger = new Logger($name);

    // Thêm handler để ghi log vào file
    $logger->pushHandler(new StreamHandler(BASE_PATH . 'storage/logs/app.log'));

    return $logger;
}

/**
 * Flashes errors and old data to the session and redirects to the given URL.
 *
 * @param array  $errors The errors to flash.
 * @param array  $old    The old data to flash.
 * @param string $url    The URL to redirect to.
 *
 * @return void
 */
#[NoReturn] function flashAndRedirect(array $errors, array $old, string $url): void
{
    Session::flash('errors', $errors);
    Session::flash('old', $old);
    redirect($url);
}
