<?php

use PHPUnit\Framework\TestCase;
use HelloWorld\Model\CharacterClass;

class CharacterClassTest extends TestCase
{
    /**
     * @dataProvider providePossibleClasses
     */
    public function testCanCreateCharacterClass(string $class): void
    {
        $characterClass = new CharacterClass($class);
        $this->assertInstanceOf(CharacterClass::class, $characterClass);
    }
    public static function providePossibleClasses(): array
    {
        return [
            "Barbarian" => [CharacterClass::BARBARIAN],
            "Warrior" => [CharacterClass::WARRIOR],
            "Archer" => [CharacterClass::ARCHER],
        ];
    }
}