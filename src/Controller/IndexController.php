<?php


declare (strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\Human;
use HelloWorld\Service\View;

class IndexController
{
    public function indexAction(): void
    {
        $human = new Human('Barbarian', 69, 'Hugo');
        $content = $human->getName();
        $indexView = new View('index/index');
        echo $indexView->render(['content' => $content]);
    }
}
