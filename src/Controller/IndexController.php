<?php


declare (strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\CharacterClass;
use HelloWorld\Model\Player;
use HelloWorld\Service\View;
use HelloWorld\Adapter\PostgreAdapter;

class IndexController
{
    public function indexAction(): void
    {
        if (empty($_POST)) {
            $player = new Player(
                new CharacterClass($_POST['character_radio']),
                (int)$_POST['age'],
                $_POST['name']
            );
            var_dump($player);
            exit;
        }

        PostgreAdapter::getPlayerData();
        $characterView = new View('index/characterForm');
        $indexView = new View('index/index');
        echo $indexView->render(['content' => $characterView->render()]);
    }
    public function showAction(): void
    {
        var_dump($_POST);


        $characterMenu = new View('index/characterMenu');
        $indexView = new View('index/index');
        echo $indexView->render([
            'content' => $characterMenu->render([
                'player' => $player
            ])
        ]);
    }
}
