<?php

namespace HelloWorld\Model\State;

use HelloWorld\Model\Player;

interface State
{
    public function handleInput(Player $player, string $input = ''): ?State;
}