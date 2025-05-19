<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
    ])
;

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PER' => true,
        '@PER:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP80Migration:risky' => true,
        '@PHP83Migration' => true,
        'concat_space' =>  ['spacing' => 'one'],
    ])
    ->setFinder($finder);