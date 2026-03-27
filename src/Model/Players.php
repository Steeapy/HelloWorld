<?php

declare(strict_types=1);

namespace HelloWorld\Model;

use ArrayIterator;
use IteratorAggregate;

/**
 * @extends GenericCollection<Player>
 */
class Players extends GenericCollection
{
    public function __construct(Player ...$players)
    {
        $this->values = $players;
    }
}
