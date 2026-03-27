<?php

namespace HelloWorld\Model\State;

class IdleState implements State
{
    public function __construct() {

    }

    public function handleInput(string $input = ''): ?State {

        if ($input === 'run') {
            return new RunState();
        }

        return null;
    }
}