<?php

declare (strict_types=1);

namespace Unit;

use HelloWorld\Model\CharacterClass;
use HelloWorld\Model\Player;
use HelloWorld\Model\State\IdleState;
use HelloWorld\Model\State\RunState;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class PlayerTest extends Unit
{
    /**
     * @dataProvider providePossibleCharacters
     */
    public function testCanCreateCharacter(string $name, int $age, string $characterClass): void
    {
        $characterMock = $this->createMock(CharacterClass::class);
        $characterMock->method("getValue")->willReturn(CharacterClass::BARBARIAN);

        $player = new Player($characterMock, $age, $name);

        $this->assertInstanceOf(Player::class, $player);
        var_dump($player->getCharacterClass()->getValue());
    }

    public function testCanChangeState(): void
    {
        $characterMock = $this->createMock(CharacterClass::class);
        $characterMock->method("getValue")->willReturn(CharacterClass::BARBARIAN);
        $player = new Player($characterMock, 245, 'Heinrich');

        $player->handleInput('run');
        $this->assertInstanceOf(RunState::class, $player->getState());

        $player->handleInput('stop');
        $this->assertInstanceOf(IdleState::class, $player->getState());
    }

    public static function providePossibleCharacters(): array
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
