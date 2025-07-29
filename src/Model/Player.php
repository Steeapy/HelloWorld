<?php

declare (strict_types=1);

namespace HelloWorld\Model;

use InvalidArgumentException;

class Player
{
    private StateInterface $state;
    private CharacterClass $characterClass;
    private int $age;
    private string $name;

    public function __construct(CharacterClass $characterClass, int $age, string $name, StateInterface $state = new IdleState())
    {
        $this->assertAge($age);
        $this->assertName($name);

        $this->characterClass = $characterClass;
        $this->age = $age;
        $this->name = $name;
        $this->state = $state;
    }

    public function handleInput(string $input): void
    {
        $actualState = $this->state->handleInput($input);
        if ($actualState !== null) {
            $this->state = $actualState;
        }
    }

    public function getState(): StateInterface
    {
        return $this->state;
    }

    public function update()
    {
        switch ($this->state) {
            case 'idle':
                echo 'idle';
                break;

            case 'run':
                echo 'run';
                break;
        }
    }

    private function assertAge(int $age)
    {
        if ($age <= 0) {
            throw new InvalidArgumentException(
                'Age is <= 0!'
            );
        }
    }

    private function assertName(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException(
                'Name is empty'
            );
        }
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
}
