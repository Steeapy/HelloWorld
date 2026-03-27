<?php

declare(strict_types=1);

namespace HelloWorld\Model;

use ArrayIterator;
use IteratorAggregate;

/**
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
 */
abstract class GenericCollection implements IteratorAggregate
{
    protected array $values;

    /**
     * @return array<int, TValue>
     */
    public function toArray(): array|null
    {
        return $this->values;
    }

    /**
     * @return ArrayIterator<int, TValue>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->values);
    }
}