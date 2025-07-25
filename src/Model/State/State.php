<?php

namespace HelloWorld\Model\State;

use HelloWorld\Model\Player;

interface State
{
    public function handleInput(string $input = ''): ?State;
}