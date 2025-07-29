<?php

namespace HelloWorld\Model;

interface StateInterface
{
    public function handleInput(string $input): ?StateInterface;
}
