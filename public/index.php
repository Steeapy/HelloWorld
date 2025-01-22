<?php


declare (strict_types=1);

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use HelloWorld\Human;

$human = new Human();

$human->addProfession('ITler');
$human->addProfession('BarKeeper');

$human->sayAllProfessions();
