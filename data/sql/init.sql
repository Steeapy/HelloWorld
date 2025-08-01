CREATE TABLE player (
    player_id int PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    player_character_class varchar NOT NULL,
    player_name varchar NOT NULL,
    player_age int NOT NULL,
    player_created TIMESTAMP NOT NULL,
    player_updated TIMESTAMP
);
