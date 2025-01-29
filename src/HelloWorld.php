<?php

declare (strict_types=1);
/*namespace HelloWorld;
 */
require 'vendor/autoload.php';

use HelloWorld\Model\Human;

$human = new Human();

$human->addProfession('ITler');
$human->addProfession('BarKeeper');

$human->sayAllProfessions();

$name = readline('name: ');
if ($name !== false) {
    $human->sayHello($name);
}


$age = (int)readline('age: ');
$human->sayAge($age);

/*$profession = readline('profession: ');
$human->sayProfession($profession);
 */
