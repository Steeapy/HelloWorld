<?php

namespace HelloWorld\Model\State;

interface State
{
    public function handleInput(string $input = ''): ?State;
}
