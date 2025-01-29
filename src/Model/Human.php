<?php

declare (strict_types=1);

namespace HelloWorld\Model;

class Human
{
    private string $characterClass;
    private int $age;
    private string $name;

    public function __construct(string $characterClass, int $age, string $name)
    {
        $this->characterClass = $characterClass;
        $this->age = $age;
        $this->name = $name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCharacterClass(): string
    {
        return $this->characterClass;
    }

}
