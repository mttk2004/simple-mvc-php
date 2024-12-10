<?php

/**
 * This file is used to configure PHP-CS-Fixer for this project.
 * To use it, run `vendor/bin/php-cs-fixer fix` in the root directory of the project.
 */
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'single_quote' => true,
        // TODO: Add more rules here if needed
    ])
    ->setFinder($finder);