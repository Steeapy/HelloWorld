<?php

declare (strict_types=1);

use HelloWorld\Model\CharacterClass;
use PHPUnit\Framework\TestCase;
use HelloWorld\Model\Player;

class PlayerTest extends TestCase
{
    /**
     * @dataProvider providePossibleCharacters
     */
    public function testCanCreateCharacter (string $name, int $age, string $characterClass): void
    {
        $player = new Player(new CharacterClass($characterClass), $age, $name);
        $this->assertInstanceOf(Player::class, $player);
    }
    public static function providePossibleCharacters (): array
    {
        return [
            'a mighty barbarian' => [
                'Conan the Barbarian',
                30,
                'BARBARIAN',
            ],
            'a powerful warrior' => [
                'Minsc of Rashemen',
                140,
                'WARRIOR',
            ],
            'a thieflike archer' => [
                'Garret',
                25,
                'ARCHER',
            ],
        ];
    }
}
