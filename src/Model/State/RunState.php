<?php

namespace HelloWorld\Model\State;

class RunState implements State
{
    private int $miles;

    public function __construct()
    {
        $this->miles = 0;
    }

    public function handleInput(string $input = ''): ?State
    {
        echo "running {$this->miles}".PHP_EOL;
        ++$this->miles;

        if ($input === 'stop') {
            return new IdleState();
        }

        return null;
    }
}
