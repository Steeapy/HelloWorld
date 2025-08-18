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
        //var_dump($statement->fetch());
    }

    public static function createPlayerData()
    {
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s;', POSTGRES_HOST, POSTGRES_PORT, POSTGRES_DB);
        $pdo = new PDO($dsn, POSTGRES_USER, POSTGRES_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $statement = $pdo->prepare('INSERT INTO player(player_character_class, player_name, player_age, player_created) VALUES (:playerCharacterClass, :playerName, :playerAge, :playerCreated);');
        $statement->execute(["playerCharacterClass" => "barbarian", "playerName" => "Mark", "playerAge" => 12, "playerCreated" => "2025-12-01 12:03:02"]);
    }
}