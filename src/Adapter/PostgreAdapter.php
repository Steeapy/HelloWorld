<?php
declare(strict_types=1);

namespace HelloWorld\Adapter;

use PDO;

class PostgreAdapter
{
    public static function getPlayerData()
    {
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s;', POSTGRES_HOST, POSTGRES_PORT, POSTGRES_DB);
        $pdo = new PDO($dsn, POSTGRES_USER, POSTGRES_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $statement = $pdo->prepare('SELECT * FROM player WHERE player_id = :playerID;');
        $statement->execute(['playerID' => 1]);
        var_dump($statement->fetch());
    }
}