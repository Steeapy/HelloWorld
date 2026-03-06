<?php

declare(strict_types=1);

namespace HelloWorld\Adapter;

use HelloWorld\Repository\DatabaseAdapter;

final class PostgreAdapter implements DatabaseAdapter
{
    private $connection;

    public function __construct()
    {
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s;', POSTGRES_HOST, POSTGRES_PORT, POSTGRES_DB);
        $this->connection = new \PDO($dsn, POSTGRES_USER, POSTGRES_PASSWORD, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public function read(string $sql, array $data = []): array
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($data);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function writeAndReturnLastInsertedId(string $sql, array $data): string
    {
        $this->execution($sql, $data);

        $lastId = $this->connection->lastInsertId();

        if (false === $lastId) {
            throw new \RuntimeException('Es konnte keine Id zurück gegeben werden');
        }

        return $lastId;
    }

    public function writeAndReturnAffectedRowCount(string $sql, array $data): int
    {
        $statement = $this->execution($sql, $data);

        return $statement->rowCount();
    }

    private function execution($sql, $data): \PDOStatement
    {
        $statement = $this->connection->prepare($sql);

        if (false === $statement) {
            throw new \RuntimeException('Das prepare statement funktioniert nicht');
        }

        $result = $statement->execute($data);

        if (false === $result) {
            throw new \RuntimeException('Es konnte nicht in der Datenbank eingetragen werden.');
        }

        return $statement;
    }
}
