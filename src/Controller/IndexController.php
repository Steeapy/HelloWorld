<?php

declare(strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\CharacterClass;
use HelloWorld\Model\Player;
use HelloWorld\Repository\PlayerRepository;
use HelloWorld\Service\View;

class IndexController
{
    private $playerAdapter;

    public function __construct(PlayerRepository $playerAdapter)
    {
        $this->playerAdapter = $playerAdapter;
    }

    public function indexAction(): void
    {
        $allPlayers = $this->playerAdapter->fetchAllPlayers();

        $playerLists = new View('index/playerLists');
        $indexView = new View('index/index');
        echo $indexView->render([
            'content' => $playerLists->render([
                'players' => $allPlayers,
            ]),
        ]);
    }

    public function errorAction(): void
    {
        $errorPage = new View('index/error');
        $indexView = new View('index/index');
        echo $indexView->render(['content' => $errorPage->render([
            'error' => 'Test',
        ]),
        ]);
    }

    public function createAction(): void
    {
        if (!empty($_POST)) {
            $player = new Player(
                new CharacterClass($_POST['character_radio']),
                (int) $_POST['age'],
                $_POST['name']
            );

            try {
                $playerId = $this->playerAdapter->createPlayer($player);
                $this->redirect("/show?playerId={$playerId}");
            } catch (\RuntimeException $e) {
                $this->redirect('/error');
            }
        }

        $characterView = new View('index/create');
        $createView = new View('index/index');

        echo $createView->render(['content' => $characterView->render()]);
    }

    public function updateAction(): void
    {
        $playerId = (int) $_GET['playerId'];

        if (!empty($_POST)) {
            $player = new Player(
                new CharacterClass($_POST['character_radio']),
                (int) $_POST['age'],
                $_POST['name'],
                $playerId
            );

            try {
                $this->playerAdapter->updatePlayer($player);
            } catch (\RuntimeException $e) {
                $this->redirect('/error');
            }

            $this->redirect('/');
        }

        $characterView = new View('index/updatePlayer');
        $createView = new View('index/index');

        echo $createView->render(
            [
                'content' => $characterView->render(
                    [
                        'player' => $this->playerAdapter->fetchPlayer($playerId),
                    ]
                ),
            ]
        );
    }

    public function showAction(): void
    {
        $playerId = $_GET['playerId'];
        $playerData = $this->playerAdapter->fetchPlayer((int) $playerId);

        $characterMenu = new View('index/show');
        $indexView = new View('index/index');
        echo $indexView->render([
            'content' => $characterMenu->render([
                'playerName' => $playerData->getName(),
                'playerAge' => $playerData->getAge(),
            ]),
        ]);
    }

    public function deleteAction(): void
    {
        $playerId = (int) $_GET['playerId'];
        $this->playerAdapter->deletePlayerById($playerId);

        $this->redirect('/');
    }

    private function redirect(string $location): void
    {
        header('Location: '.$location);

        exit;
    }
}
