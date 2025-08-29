<?php
declare(strict_types=1);

namespace HelloWorld\Adapter;

use HelloWorld\Model\Player;
use HelloWorld\Repository\DatabaseAdapter;
use PDO;

class PostgreAdapter implements DatabaseAdapter
{

    private $connection;

    public function __construct()
    {
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s;', POSTGRES_HOST, POSTGRES_PORT, POSTGRES_DB);
        $this->connection = new PDO($dsn, POSTGRES_USER, POSTGRES_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    public function read(string $sql, array $data = []): array
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($data);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function writeAndReturnLastInsertedId(string $sql, array $data): string
    {
        // TODO: Implement writeAndReturnLastInsertedId() method.
    }

    public function writeAndReturnAffectedRowCount(string $sql, array $data): int
    {
        // TODO: Implement writeAndReturnAffectedRowCount() method.
    }
}