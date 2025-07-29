<?php

declare (strict_types=1);

use HelloWorld\Model\CharacterClass;
use HelloWorld\Model\RunState;
use PHPUnit\Framework\TestCase;
use HelloWorld\Model\Player;

class PlayerTest extends TestCase
{
    /**
     * @dataProvider providePossibleCharacters
     */
    public function testCanCreateCharacter (string $name, int $age, string $characterClass): void
    {
        $characterMock = $this->createMock(CharacterClass::class);
        $characterMock->method("getValue")->willReturn(CharacterClass::BARBARIAN);
        $player = new Player($characterMock, $age, $name);
        $this->assertInstanceOf(Player::class, $player);
        var_dump($player->getCharacterClass()->getValue());
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

    public function testCanChangeState(): void
    {
        $characterMock = $this->createMock(CharacterClass::class);
        $characterMock->method("getValue")->willReturn(CharacterClass::BARBARIAN);

        $player = new Player($characterMock, 12, 'Mark');
        $player->handleInput('run');
        $player->update();

        $result = $player->getState(); # new IdelState | IdelState

        $this->assertInstanceOf(RunState::class, $result); #"RunState"
    }
}
