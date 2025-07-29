<?php

namespace HelloWorld\Model;

use HelloWorld\Model\State;
use HelloWorld\Model\RunState;

class IdleState implements StateInterface
{
    public int $counter;

    public function __construct()
    {
        $this->counter = 0;
    }

    public function handleInput(string $input): ?StateInterface
    {
        $this->counter++;

        if ($input === 'run') {
            return new RunState();
        }

        var_dump($this->counter);

        return null;
    }
}
