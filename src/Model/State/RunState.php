<?php

namespace HelloWorld\Model\State;

use HelloWorld\Model\Player;

class RunState implements State
{
    private int $miles;


    public function __construct()
    {
        $this->miles = 0;
    }

    public function handleInput(Player $player, string $input = ''): ?State
    {
        echo "running {$this->miles}" . PHP_EOL;
        $this->miles++;

        return null;
    }
}