<?php

namespace HelloWorld\Repository;

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
            $fetchedPlayer['player_name'],
            $fetchedPlayer['player_id'],
        );
    }

    public function fetchAllPlayers(): Players
    {
        $playerObjects = [];
        $players = $this->databaseAdapter->read('SELECT * FROM player;');

        foreach ($players as $player) {
            $playerObjects[] = new Player(
                new CharacterClass($player['player_character_class']),
                $player['player_age'],
                $player['player_name'],
                $player['player_id'],
            );
        }

        return new Players(...$playerObjects);
    }

    public function createPlayer(Player $player): int
    {
        $sql = 'INSERT INTO player(player_character_class, player_name, player_age, player_created) VALUES (:playerCharacterClass, :playerName, :playerAge, :playerCreated);';
        $date = new \DateTimeimmutable();

        $playerInformation = [
            'playerCharacterClass' => $player->getCharacterClass()->getValue(),
            'playerName' => $player->getName(),
            'playerAge' => $player->getAge(),
            'playerCreated' => $date->format('Y-m-d H:i:s'),
        ];

        $playerId = $this->databaseAdapter->writeAndReturnLastInsertedId($sql, $playerInformation);

        return (int) $playerId;
    }

    public function deletePlayerById(int $playerId): int
    {
        return $this->databaseAdapter->writeAndReturnAffectedRowCount('DELETE FROM player WHERE player_id = :playerID;', ['playerID' => $playerId]);
    }

    public function updatePlayer(Player $player): void
    {
        $sql = 'UPDATE player SET player_character_class = :playerCharacterClass, player_name = :playerName, player_age = :playerAge, player_updated = :playerUpdate WHERE player_id = :playerID';
        $date = new \DateTimeimmutable();

        $playerInformation = [
            'playerCharacterClass' => $player->getCharacterClass()->getValue(),
            'playerName' => $player->getName(),
            'playerAge' => $player->getAge(),
            'playerUpdate' => $date->format('Y-m-d H:i:s'),
            'playerID' => $player->getId(),
        ];

        $playerId = $this->databaseAdapter->writeAndReturnAffectedRowCount($sql, $playerInformation);
    }
}
