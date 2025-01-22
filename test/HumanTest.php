<?php

declare (strict_types=1);

use PHPUnit\Framework\TestCase;
use HelloWorld\Human;

class HumanTest extends TestCase
{
    public function testCanSayHello(): void
    {
        $this->expectOutputString("Hallo, ich bin Lukas\n");
        $human = new Human();
        $human->sayHello('Lukas');
    }

    public function testCanSayAge(): void
    {
        $this->expectOutputString("Ich bin 12 Jahre alt\n");
        $human = new Human();
        $human->sayAge(12);
    }

    public function testCanSayProfession(): void
    {
        $this->expectOutputString("Ich arbeite als Bauer\n");
        $human = new Human();
        $human->sayProfession('Bauer');
    }
}
