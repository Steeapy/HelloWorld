<?php


declare (strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\Player;
use HelloWorld\Service\View;

class IndexController
{
    public function indexAction(): void
    {
        $human = new Player('Barbarian', 69, 'Hugo');
        $content = $human->getName();
        $indexView = new View('index/index');
        echo $indexView->render(['content' => $content]);
    }
}
