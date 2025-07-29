<?php


declare (strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\CharacterClass;
use HelloWorld\Model\Player;
use HelloWorld\Service\View;

class IndexController
{
    public function indexAction(): void
    {
        $characterView = new View('index/characterForm');
        $indexView = new View('index/index');
        echo $indexView->render(['content' => $characterView->render()]);
    }
    public function showAction(): void
    {
        $player = new Player(
            new CharacterClass($_POST['character_radio']),
            (int)$_POST['age'],
            $_POST['name']
        );
        $characterMenu = new View('index/characterMenu');
        $indexView = new View('index/index');
        echo $indexView->render([
            'content' => $characterMenu->render([
                'player' => $player
            ])
        ]);
    }
}
