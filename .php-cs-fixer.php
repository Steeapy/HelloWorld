<?php
declare(strict_types=1);

$config = new PhpCsFixer\Config();
$finder = new PhpCsFixer\Finder();

$finder->in([
    __DIR__ . '/src',
    __DIR__ . '/test',
    __DIR__ . '/public',
])->exclude([
        'test/fixtures',
    ]);

$config->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect());
$config->setFinder($finder);

return $config;