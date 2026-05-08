<?php

declare(strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\CharacterClass;
use HelloWorld\Model\Player;
use HelloWorld\Service\Game;

final class GameController
{

    private Game $game;

    public function newAction(): void
    {
        $entities = [new Player(characterClass: new CharacterClass(CharacterClass::WARRIOR), age: 2, name: 'Peter Fox')];
        $this->game = new Game($entities);
        $this->game->run('');
    }

    public function pauseAction(): void
    {

    }

    public function stopAction(): void
    {

    }

    public function showMenueAction(): void
    {

    }

}