<?php

declare (strict_types=1);

namespace HelloWorld;

class Human
{
    /**
    * @var string[]
    */
    private array $professions;

    public function addProfession(string $profession): void
    {
        $this->professions[] = $profession;
    }

    public function sayAllProfessions(): void
    {
        foreach ($this->professions as $profession) {
            echo $profession;
        }
    }

    public function sayHello(string $name): void
    {
        $this->say("Hallo, ich bin $name");
    }

    public function sayAge(int $age): void
    {
        $this->say("Ich bin $age Jahre alt");
    }

    public function sayProfession(string $profession): void
    {
        $this->say("Ich arbeite als $profession");
    }

    private function say(string $sentence): void
    {
        echo $sentence . "\n";
    }
}
