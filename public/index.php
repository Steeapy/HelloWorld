<?php

declare (strict_types=1);

chdir(dirname(__DIR__));

require 'vendor/autoload.php';
require_once 'config/config.php';

use HelloWorld\Controller\IndexController;

$request = $_SERVER["REQUEST_URI"];

switch ($request) {
    case '/':
        $indexController = new IndexController();
        $indexController->indexAction();
        break;

    case '/show':
        $indexController = new IndexController();
        $indexController->showAction();
        break;

    default:
        echo '404';
        break;
}
