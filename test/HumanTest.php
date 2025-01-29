<?php

declare (strict_types=1);

use PHPUnit\Framework\TestCase;
use HelloWorld\Model\Human;

class HumanTest extends TestCase
{
    public function testCanCreateCharacter (): void
    {
        $human = new Human('Itler', 12, 'Peter');
        $this->assertInstanceOf(Human::class, $human);
    }
}
