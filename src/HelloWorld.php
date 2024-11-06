<?php
declare (strict_types=1);
/*namespace HelloWorld;
 */
require 'vendor/autoload.php';

use HelloWorld\Human;

$human = new Human();
$name = readline('name: ');
$human->sayHello($name);


$age = (int)readline('age: ');
$human->sayAge($age);

$profession = readline('profession: ');
$human->sayProfession($profession);
