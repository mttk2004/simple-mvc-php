<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once BASE_PATH . 'vendor/autoload.php';

$loader = new FilesystemLoader(BASE_PATH . 'resources/views');
$twig = new Environment($loader, [
        'cache' => BASE_PATH . 'cache/twig',
        'debug' => true,
]);

return $twig;
