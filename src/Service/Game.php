<?php

declare(strict_types=1);

namespace HelloWorld\Service;

final class Game
{
    private array $entities;

    public function __construct(array $entities)
    {
        $this->entities = $entities;
    }

    public function run(string $input): void
    {
        foreach ($this->entities as $entity) {
            $entity->handleInput($input);
        }
    }
}