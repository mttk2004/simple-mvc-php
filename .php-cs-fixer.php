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
        'single_quote' => true,
        'align_multiline_comment' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_trailing_whitespace_in_blank_line' => true,
        'no_whitespace_before_comma_in_array' => true,
        'method_chaining_indentation' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
    ])
    ->setFinder($finder);

