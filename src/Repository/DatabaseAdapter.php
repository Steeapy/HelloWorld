<?php

declare(strict_types=1);

namespace HelloWorld\Repository;

interface DatabaseAdapter
{
    /**
     * Executes a SQL statement and returns the results as an array.
     *
     * @param array<string, mixed> $data
     */
    public function read(string $sql, array $data = []): array;

    /**
     * Executes a SQL statement and returns the last inserted id.
     *
     * @param array<string, mixed> $data
     */
    public function writeAndReturnLastInsertedId(string $sql, array $data): string;

    /**
     * Executes a SQL statement and returns the affected row count.
     *
     * @param array<string, mixed> $data
     */
    public function writeAndReturnAffectedRowCount(string $sql, array $data): int;
}
