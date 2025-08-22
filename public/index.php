<?php

declare (strict_types=1);

chdir(dirname(__DIR__));

require 'vendor/autoload.php';
require_once 'config/config.php';

use HelloWorld\Adapter\PostgreAdapter;
use HelloWorld\Controller\IndexController;

$request = trim(strtok($_SERVER['REQUEST_URI'], '?'));
$postgreAdapter = new PostgreAdapter();
$indexController = new IndexController($postgreAdapter);

switch ($request) {
    case '/':
        $indexController->indexAction();
        break;

    case '/show':
        $indexController->showAction();
        break;

    case '/error':
        $indexController->errorAction();
        break;

    default:
        echo '404';
        break;
}
