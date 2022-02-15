<?php

declare(strict_types=1);

$rules = [
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'no_unused_imports' => true,
    'no_extra_blank_lines' => [
        'tokens' => [
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'throw',
            'use',
        ],
    ],
];

$finder = Symfony\Component\Finder\Finder::create()
    ->in(__DIR__)
    ->exclude(['storage', 'vendor'])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();

return $config->setRules($rules)->setFinder($finder);
