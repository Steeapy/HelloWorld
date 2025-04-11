<?php

namespace HelloWorld\Model;

use InvalidArgumentException;

class CharacterClass
{
    public const BARBARIAN = 'BARBARIAN';
    public const WARRIOR = 'WARRIOR';
    public const ARCHER = 'ARCHER';
    public const CHARACTER_CLASSES = [
        self::BARBARIAN => 'Barbarian',
        self::WARRIOR => 'Warrior',
        self::ARCHER => 'Archer',
    ];
    private string $value;
    public function __construct(string $characterClass)
    {
        $this->assertCharacterClass($characterClass);
        $this->value = $characterClass;
    }

    public function getValue(): string
    {
        return $this->value;
    }
    private function assertCharacterClass(string $characterClass)
    {
        if (!array_key_exists($characterClass, self::CHARACTER_CLASSES)) {
            throw new InvalidArgumentException("Character class '{$characterClass}' does not exist.");
        }
    }

}