<?php


declare (strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\CharacterClass;
use HelloWorld\Model\Player;
use HelloWorld\Service\View;
use HelloWorld\Repository\PlayerRepository;

class IndexController
{
    private $playerAdapter;

    public function __construct(PlayerRepository $playerAdapter)
    {
        $this->playerAdapter = $playerAdapter;
    }

    public function errorAction(): void
    {
        $errorPage = new View('index/error');
        $indexView = new View("index/index");
        echo $indexView->render(['content' => $errorPage->render([
            'error' => "Test"
            ])
        ]);
    }
    public function indexAction(): void
    {
        if (!empty($_POST)) {
            $player = new Player(
                new CharacterClass($_POST['character_radio']),
                (int)$_POST['age'],
                $_POST['name']
            );

            try {
                $playerId = $this->playerAdapter->createPlayer($player);
            } catch (\RuntimeException $e) {
                $this->redirect('/error');
            }

            $this->redirect("/show?playerId=$playerId");
        }

        $characterView = new View('index/characterForm');
        $indexView = new View('index/index');

        echo $indexView->render(['content' => $characterView->render()]);
    }
    public function showAction(): void
    {
        $playerId = $_GET["playerId"];
        $playerData = $this->playerAdapter->fetchPlayer((int)$playerId);
        #$playerData = $this->playerAdapter->fetchAllPlayers();
        var_dump($playerData);

        exit;

        $characterMenu = new View('index/characterMenu');
        $indexView = new View('index/index');
        echo $indexView->render([
            'content' => $characterMenu->render([
                'player' => $player
            ])
        ]);
    }

    private function redirect(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
