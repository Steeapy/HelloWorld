<?php

namespace HelloWorld\Repository;

use HelloWorld\Adapter\PostgreAdapter;
use HelloWorld\Model\Player;

class PlayerRepository
{
    private DatabaseAdapter $databaseAdapter;

    public function __construct(DatabaseAdapter $databaseAdapter)
    {
        $this->databaseAdapter = $databaseAdapter;
    }

    public function getPlayerData(int $playerId): array
    {
        return $this->databaseAdapter->read('SELECT * FROM player WHERE player_id = :playerID;', ['playerID' => $playerId]);
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