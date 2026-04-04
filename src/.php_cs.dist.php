Add PHP‑CS‑Fixer dist config

// This file contains the configuration for PHP‑CS‑Fixer. Updated to work with PHP 8.4.
// The key changes: no `no_unneeded_alias` rule, keep `use DateTimeImmutable;`.
// The rules are strict typing, PHPDoc import, and preserve quotes.

<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['data', 'bin', 'vendor', 'var'])
    ->in(__DIR__.'/src');

return [
    'config' => '@PSR12',
    'finder' => $finder,
    'rules' => [
        'declare_strict_types' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'strict_type_cast' => true,
        'phpdoc_import' => [
            'classes' => true,
            'ignore_annotation' => false,
            'short_name' => true,
        ],
    ],
];