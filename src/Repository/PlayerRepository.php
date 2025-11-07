<?php

namespace HelloWorld\Repository;

use HelloWorld\Adapter\PostgreAdapter;
use HelloWorld\Model\CharacterClass;
use HelloWorld\Model\Player;
use HelloWorld\Model\Players;

class PlayerRepository
{
    private DatabaseAdapter $databaseAdapter;

    public function __construct(DatabaseAdapter $databaseAdapter)
    {
        $this->databaseAdapter = $databaseAdapter;
    }

    public function fetchPlayer(int $playerId): Player
    {
        $result = $this->databaseAdapter->read('SELECT * FROM player WHERE player_id = :playerID;', ['playerID' => $playerId]);

        $fetchedPlayer = array_shift($result);

        return new Player(
            new CharacterClass($fetchedPlayer['player_character_class']),
            $fetchedPlayer['player_age'],
            $fetchedPlayer['player_name']
        );
    }

    public function fetchAllPlayers(): Players
    {
        $playerObjects = [];
        $players = $this->databaseAdapter->read('SELECT * FROM player;');

        foreach ($players as $player){
            $playerObjects[] = new Player(
                new CharacterClass($player['player_character_class']),
                $player['player_age'],
                $player['player_name']
            );
        }

        return new Players(...$playerObjects);
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

    public function deletePlayerById(int $playerId): int
    {
        return $this->databaseAdapter->writeAndReturnAffectedRowCount('DELETE FROM player WHERE player_id = :playerID;', ['playerID' => $playerId]);
    }
}
