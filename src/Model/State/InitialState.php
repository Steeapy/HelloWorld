<?php

namespace HelloWorld\Model\State;

class InitialState implements State
{
    public function handleInput(string $input = ''): ?State
    {
        echo "initializing\n";

        if ('run' == $input) {
            return new RunState();
        }
        if('stop' === $input) {
            return new IdleState();
        }

        return null;
    }
}
