<?php

declare (strict_types=1);

namespace HelloWorld\Model;

class Player
{
    private string $characterClass;
    private int $age;
    private string $name;

    public function __construct(string $characterClass, int $age, string $name)
    {
        $this->assertAge($age);
        $this->assertName($name);

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

    private function assertAge(int $age)
    {
        if ($age <= 0){
            throw new InvalidArgumentException(
                "Age is <= 0!"
            );
        }
    }

    private function assertName(string $name)
    {
        if (empty($name)){
            throw new InvalidArgumentException(
                'Name is empty'
            );
        }
    }
}
