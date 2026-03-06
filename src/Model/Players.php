<?php

declare(strict_types=1);

namespace HelloWorld\Model;

class Players implements \IteratorAggregate
{
    public array $values;

    public function __construct(Player ...$players)
    {
        $this->values = $players;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->values);
    }
}
