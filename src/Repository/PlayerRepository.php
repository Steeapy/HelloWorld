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

    public function fetchPlayer(int $playerId): array
    {
        return $this->databaseAdapter->read('SELECT * FROM player WHERE player_id = :playerID;', ['playerID' => $playerId]);
    }

    public function fetchAllPlayers(): array
    {
        return $this->databaseAdapter->read('SELECT * FROM player;');
    }

    public function createPlayer(Player $player): int
    {
        $sql = 'INSERT INTO player(player_character_class, player_name, player_age, player_created) VALUES (:playerCharacterClass, :playerName, :playerAge, :playerCreated);';

        $playerInformation = [
            "playerCharacterClass" => $player->getCharacterClass()->getValue(),
            "playerName" => $player->getName(),
            "playerAge" => $player->getAge(),
            "playerCreated" => "2025-12-01 12:03:02"
        ];

        $playerId = $this->databaseAdapter->writeAndReturnLastInsertedId($sql, $playerInformation);

        return (int)$playerId;
    }
}