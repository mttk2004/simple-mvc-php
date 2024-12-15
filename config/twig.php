<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(BASE_PATH . 'resources/views');
$twig = new Environment($loader, [
        'cache' => BASE_PATH . 'storage/cache/twig',
        'debug' => true,
]);

return $twig;
