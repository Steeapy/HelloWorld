<?php

declare (strict_types=1);

chdir(dirname(__DIR__));

require 'vendor/autoload.php';
require_once 'config/config.php';

use HelloWorld\Repository\PlayerRepository;
use HelloWorld\Adapter\PostgreAdapter;
use HelloWorld\Controller\PlayerController;

$request = trim(strtok($_SERVER['REQUEST_URI'], '?'));
$dataBase = new PostgreAdapter();
$playerRepository = new PlayerRepository($dataBase);
$indexController = new PlayerController($playerRepository);

switch ($request) {
    case '/':
        $indexController->indexAction();
        break;

    case '/create':
        $indexController->createAction();
        break;

    case '/show':
        $indexController->showAction();
        break;

    case '/error':
        $indexController->errorAction();
        break;

    case '/delete':
        $indexController->deleteAction();
        break;

    case '/update':
        $indexController->updateAction();
        break;

    default:
        echo '404';
        break;
}
