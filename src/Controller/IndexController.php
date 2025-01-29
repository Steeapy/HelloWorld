<?php


declare (strict_types=1);

namespace HelloWorld\Controller;

use HelloWorld\Model\Human;

class IndexController
{
    public function indexAction(): void
    {
        $human = new Human();

        $human->addProfession('ITler');
        $human->addProfession('BarKeeper');

        $human->sayAllProfessions();
    }
}
