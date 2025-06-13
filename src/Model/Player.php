<?php

declare (strict_types=1);

namespace HelloWorld\Model;

use HelloWorld\Model\State\InitialState;
use HelloWorld\Model\State\State;
use InvalidArgumentException;

class Player
{
    private State $state;
    private CharacterClass $characterClass;
    private int $age;
    private string $name;

    public function __construct(CharacterClass $characterClass, int $age, string $name, State $state = new InitialState())
    {
        $this->assertAge($age);
        $this->assertName($name);

        $this->characterClass = $characterClass;
        $this->age = $age;
        $this->name = $name;

        $this->state = $state;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCharacterClass(): CharacterClass
    {
        return $this->characterClass;
    }

    public function handleInput(string $input = ''): void
    {
        $state = $this->state->handleInput($this, $input);

        if (!empty($state)) {
            $this->state = $state;
        }
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
