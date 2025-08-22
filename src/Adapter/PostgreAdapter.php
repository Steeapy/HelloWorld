<?php
declare(strict_types=1);

namespace HelloWorld\Adapter;

use HelloWorld\Model\Player;
use PDO;

class PostgreAdapter
{

    private $connection;

    public function __construct()
    {
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s;', POSTGRES_HOST, POSTGRES_PORT, POSTGRES_DB);
        $this->connection = new PDO($dsn, POSTGRES_USER, POSTGRES_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    public function getPlayerData(int $playerId): array
    {
        $statement = $this->connection->prepare('SELECT * FROM player WHERE player_id = :playerID;');
        $statement->execute(['playerID' => $playerId]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createPlayerData(Player $player): int
    {
        $statement = $this->connection->prepare('INSERT INTO player(player_character_class, player_name, player_age, player_created) VALUES (:playerCharacterClass, :playerName, :playerAge, :playerCreated);');
        $result = $statement->execute([
            "playerCharacterClass" => $player->getCharacterClass()->getValue(),
            "playerName" => $player->getName(),
            "playerAge" => $player->getAge(),
            "playerCreated" => "2025-12-01 12:03:02"
        ]);

        if ($result === false) {
            throw new \RuntimeException("Es konnte nicht in der Datenbank eingetragen werden.");
        }

        $lastId = $this->connection->lastInsertId();

        if ($lastId === false) {
            throw new \RuntimeException("Es konnte keine Id zurück gegeben werden");
        }

        return (int)$lastId;
    }
}