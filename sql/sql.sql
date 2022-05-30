CREATE TABLE users (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` varchar(128) NOT NULL,
    `email` varchar(128) NOT NULL,
    `uid` varchar(128) NOT NULL,
    `pwd` varchar(128) NOT NULL
);

CREATE TABLE feature_films (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` varchar(128) NOT NULL,
    `date` date NOT NULL,
    `poster_path` varchar(128) NOT NULL,
    `bg_path` varchar(128) NOT NULL,
    `description` text NOT NULL,
    `length` varchar(128) NOT NULL, -- kom på ett sätt att sätta flera olika längder för olika versioner
    `rating` float(2) NOT NULL,
    `related` json NOT NULL, -- includes both similar and franchise
    `cast` json NOT NULL,
    `crew` json NOT NULL
);

CREATE TABLE short_films (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` varchar(128) NOT NULL,
    `date` date NOT NULL,
    `poster_path` varchar(128) NOT NULL,
    `bg_path` varchar(128) NOT NULL,
    `description` text NOT NULL,
    `length` time NOT NULL,
    `rating` float(2) NOT NULL,
    `related` json NOT NULL,
    `cast` json NOT NULL,
    `crew` json NOT NULL
);

CREATE TABLE series (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` varchar(128) NOT NULL,
    `series_type` varchar(128) NOT NULL, -- mini or normal
    `length_seasons` int(3) NOT NULL, -- amount of seasons
    `length_episodes` int(5) NOT NULL,
    `length_time` time NOT NULL,
    `ongoing` bit NOT NULL,
    `date_first` date NOT NULL,
    `date_last` date, -- NULL if ongoing
    `poster_path` varchar(128) NOT NULL, -- same poster will apply to every season
    `bg_path` varchar(128) NOT NULL,
    `description` varchar(128) NOT NULL,
    `rating` float(2) NOT NULL,
    `related` json NOT NULL,
    `cast` json NOT NULL, -- collected from seasons
    `crew` json NOT NULL
);

CREATE TABLE series_seasons (
    `number` int(4) NOT NULL,
    `series_id` varchar(128) NOT NULL,
    `length_episodes` int(5) NOT NULL,
    `length_time` time NOT NULL,
    `date` date NOT NULL, -- if unfinished: first ep date, if finished: first ep date "-" last ep date
    `bg_path` varchar(128) NOT NULL,
    `description` varchar(128) NOT NULL,
    `rating` float(2) NOT NULL,
    `cast` json NOT NULL,
    `crew` json NOT NULL
);

CREATE TABLE series_episodes (
    `number_season` int(5) NOT NULL, -- which episode is it of entire series?
    `number_series` int(5) NOT NULL, -- which episode is it of this season?
    `series_id` varchar(128) NOT NULL,
    `season` varchar(128) NOT NULL,
    `name` varchar(128) NOT NULL,
    `date` date NOT NULL,
    `bg_path` varchar(128) NOT NULL,
    `description` varchar(128) NOT NULL,
    `length` time NOT NULL,
    `rating` float(2) NOT NULL
);

CREATE TABLE games (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` varchar(128) NOT NULL,
    `date` date NOT NULL,
    `poster_path` varchar(128) NOT NULL,
    `bg_path` varchar(128) NOT NULL,
    `description` text NOT NULL,
    `length` time NOT NULL, -- retrieved from howlongtobeat.com
    `rating` float(2) NOT NULL,
    `related` json NOT NULL,
    `crew` json NOT NULL,
    `cast` json NOT NULL
);

CREATE TABLE ratings (
    `user_id` int(11) NOT NULL,
    `item_type` varchar(128) NOT NULL, -- film, game, show, review
    `item_id` int(11) NOT NULL,
    `user_id` int(11), -- if type = review
    `rating` float(2), -- mellan 1 och 5. halvpoäng funkar. om 0 => NULL, räknas inte med i avg. 
    `like` bit NOT NULL
);

CREATE TABLE reviews (
    `user_id` int(11) NOT NULL,
    `id` int(11) NOT NULL, -- every user`s reviews has its own set of ids
    `item_type` varchar(128) NOT NULL,
    `item_id` int(11) NOT NULL,
    `rating` float(2) NOT NULL,
    `like` bit NOT NULL,
    `text` text NOT NULL,
    `date` datetime NOT NULL
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

CREATE TABLE follow (
    `from` int(11) NOT NULL, -- user id
    `to` int(11) NOT NULL, -- user id
    `status` varchar(1) NOT NULL -- P: Pending request, F: Friends, B: Blocked
)