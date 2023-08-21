<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor');

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true) // Enable risky rules like void_return
    ->setRules([
        // PSR-1 Basic Coding Standard
        'psr_autoloading' => true,

        // PSR-2 Coding Style Guide
        '@PSR2' => true,

        // PSR-4 Autoloading Standard
        'psr_autoloading' => true,

        // Symfony Coding Standards
        '@Symfony' => true,

        // Additional rules for clean code
        'align_multiline_comment' => true,
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'no_superfluous_phpdoc_tags' => ['allow_mixed' => true],
        'no_useless_else' => true,
        'no_useless_return' => true,
        'single_line_comment_style' => true,

        // More clean code rules
        'declare_strict_types' => true,
        'general_phpdoc_annotation_remove' => [
            'annotations' => ['author', 'authorship'],
        ],
        'no_null_property_initialization' => true,
        'no_superfluous_elseif' => true,
        'no_unneeded_curly_braces' => true,
        'no_unneeded_final_method' => true,
        'no_unset_on_property' => true,
        'ordered_class_elements' => true,
        'php_unit_internal_class' => true,
        'phpdoc_separation' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_var_without_name' => true,
        'protected_to_private' => true,
        'single_class_element_per_statement' => true,
        'single_import_per_statement' => true,
        'single_line_throw' => true,
        'yoda_style' => false, // Prefer non-Yoda style
    ])
    ->setFinder($finder);
