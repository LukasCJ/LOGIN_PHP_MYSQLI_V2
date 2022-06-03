CREATE TABLE users (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` varchar(128) NOT NULL,
    `email` varchar(128) NOT NULL,
    `uid` varchar(128) NOT NULL,
    `pwd` varchar(128) NOT NULL
);

CREATE TABLE items {
    -- universella:
    `type` varchar(128) NOT NULL, -- film, short film, game, show, season, episode
    `id` int(11) NOT NULL,
    `name` varchar(128) NOT NULL,
    `date` date NOT NULL,
    `poster_path` varchar(128) NOT NULL,
    `bg_path` varchar(128) NOT NULL,
    `description` text NOT NULL,
    `rating` float(2) NOT NULL DEFAULT 0,
    `popularity_all` int(11) NOT NULL DEFAULT 0,
    `popularity_week` int(11) NOT NULL DEFAULT 0

    -- `related` json NOT NULL, -- inkluderar både franchise och liknande
    -- `cast` json NOT NULL,
    -- `crew` json NOT NULL,

    `film_length` int(5), -- i minuter

    `series_length_seasons` int(3),
    `series_length_eps` int(5),
    `series_type` varchar(1), -- R: regular, M: mini
    `series_ongoing` bit,
    `series_date_last` date, -- NULL if ongoing

    `game_avg_length` int(5), -- hämtad från howlongtobeat.com
}

CREATE TABLE seasons (
    `number` int(4) NOT NULL,
    `series_id` varchar(128) NOT NULL,
    `length_eps` int(5) NOT NULL,
    `date` date NOT NULL,
    `bg_path` varchar(128) NOT NULL,
    `description` varchar(128) NOT NULL,
);

CREATE TABLE eps (
    `number_of_season` int(5) NOT NULL, -- vilket avsnitt av denna säsongen?
    `number_of_series` int(5) NOT NULL, -- vilket avsnitt av hela serien?
    `series_id` varchar(128) NOT NULL,
    `season` varchar(128) NOT NULL, -- vilken säsong
    `name` varchar(128) NOT NULL,
    `date` date NOT NULL,
    `bg_path` varchar(128) NOT NULL,
    `description` varchar(128) NOT NULL,
    `length` int(5) NOT NULL,
    `rating` float(2) NOT NULL DEFAULT 0
);

CREATE TABLE ratings (
    `user_id` int(11) NOT NULL,
    `item_type` varchar(128) NOT NULL,
    `item_id` int(11) NOT NULL,
    `rating` float(2), -- mellan 1 och 5. halvpoäng funkar. om 0 => NULL, räknas inte med i avg. 
    `like` bit NOT NULL
);

CREATE TABLE entries (
    `user_id` int(11) NOT NULL,
    `item_type` varchar(128) NOT NULL,
    `item_id` int(11) NOT NULL,
    `rating` float(2) NOT NULL,
    `like` bit NOT NULL,
    `review` bit NOT NULL,
    `review_id` int(11),
    `date_completion` datetime NOT NULL, -- datetime för att lättare sortera i "activity from friends"
    `date_start` date, -- optional
    `first` bit -- is it a rewatch?
);