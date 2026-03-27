<?php

declare(strict_types=1);

namespace Unit;

use Codeception\Attribute\DataProvider;
use Codeception\Test\Unit;
use HelloWorld\Model\CharacterClass;

class CharacterClassTest extends Unit
{
    #[DataProvider('providePossibleClasses')]
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