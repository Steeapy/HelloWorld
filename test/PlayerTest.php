<?php

declare (strict_types=1);

use PHPUnit\Framework\TestCase;
use HelloWorld\Model\Player;

class PlayerTest extends TestCase
{
    /**
     * @dataProvider providePossibleCharacters
     */
    public function testCanCreateCharacter (string $name, int $age, string $characterClass): void
    {
        $player = new Player($characterClass, $age, $name);
        $this->assertInstanceOf(Player::class, $player);
    }
    public static function providePossibleCharacters (): array
    {
        return [
            'a mighty babarian' => [
                'Conan the Barbarian',
                30,
                'BARBARIAN',
            ],
            'a powerfull warrior' => [
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
