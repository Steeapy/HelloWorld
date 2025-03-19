<?php


declare (strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\Player;
use HelloWorld\Service\View;
use http\Exception\InvalidArgumentException;
use mysql_xdevapi\Exception;

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
        var_dump($_POST);

        $player = new Player(
            $_POST['characterClass'],
            $_POST['age'],
            $_POST['name']
        );
    }
}
