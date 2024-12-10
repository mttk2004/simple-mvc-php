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
        // TODO: Add more rules here if needed
            '@PSR12' => true,
            'array_syntax' => ['syntax' => 'short'],
            'align_multiline_comment' => true,
            'single_quote' => true,
            'no_trailing_whitespace_in_comment' => true,
            'no_whitespace_before_comma_in_array' => true,
            'method_chaining_indentation' => true,
            'no_unused_imports' => true,
            'no_useless_else' => true,
            'no_useless_return' => true,
            'indentation_type' => true,
    ])
    ->setFinder($finder);
