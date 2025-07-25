<?php

namespace HelloWorld\Model\State;

use HelloWorld\Model\Player;

class InitialState implements State
{
    public function handleInput(string $input = ''): ?State
    {
        echo "initializing\n";

        if ($input == 'run')
        {
            return new RunState();
        }

        return null;
    }
}