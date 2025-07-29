<?php

namespace HelloWorld\Model;

use HelloWorld\Model\State;

class RunState implements StateInterface
{
    public function handleInput(string $input): ?StateInterface
    {
        if ($input === 'run') {
            return new RunState();
        }if ($input === 'stop') {
            return new IdleState();
        }
    }
}
