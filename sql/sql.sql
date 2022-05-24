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
    `length` time NOT NULL, -- kom på ett sätt att sätta flera olika längder för olika versioner
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
    sfilm_cast json NOT NULL,
    sfilm_crew json NOT NULL
);

CREATE TABLE series (
    series_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    series_name varchar(128) NOT NULL,
    series_type varchar(128) NOT NULL, -- mini or normal
    series_length_seasons int(3) NOT NULL, -- amount of seasons
    series_length_episodes int(5) NOT NULL,
    series_length_time time NOT NULL,
    series_ongoing bit NOT NULL,
    series_date date NOT NULL, -- if ongoing: first ep date, if finished: first ep date "-" last ep date
    series_poster_path varchar(128) NOT NULL, -- same poster will apply to every season
    series_bg_path varchar(128) NOT NULL,
    series_description varchar(128) NOT NULL,
    series_rating float(2) NOT NULL,
    series_related json NOT NULL,
    series_cast json NOT NULL, -- collected from seasons
    series_crew json NOT NULL
);

CREATE TABLE series_seasons (
    season_number int(4) NOT NULL,
    season_series_id varchar(128) NOT NULL,
    season_length_episodes int(5) NOT NULL,
    season_length_time time NOT NULL,
    season_date date NOT NULL, -- if unfinished: first ep date, if finished: first ep date "-" last ep date
    season_bg_path varchar(128) NOT NULL,
    season_description varchar(128) NOT NULL,
    season_rating float(2) NOT NULL,
    season_cast json NOT NULL,
    season_crew json NOT NULL
);

CREATE TABLE series_episodes (
    episode_number_season int(5) NOT NULL, -- which episode is it of entire series?
    episode_number_series int(5) NOT NULL, -- which episode is it of this season?
    episode_series_id varchar(128) NOT NULL,
    episode_season varchar(128) NOT NULL,
    episode_name varchar(128) NOT NULL,
    episode_date date NOT NULL,
    episode_bg_path varchar(128) NOT NULL,
    episode_description varchar(128) NOT NULL,
    episode_length_time time NOT NULL,
    episode_rating float(2) NOT NULL
);

CREATE TABLE games (
    game_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    game_name varchar(128) NOT NULL,
    game_date date NOT NULL,
    game_poster_path varchar(128) NOT NULL,
    game_bg_path varchar(128) NOT NULL,
    game_description text NOT NULL,
    game_length time NOT NULL, -- retrieved from howlongtobeat.com
    game_rating float(2) NOT NULL,
    game_related json NOT NULL,
    game_crew json NOT NULL,
    game_cast json NOT NULL
);

CREATE TABLE ratings (
    `user_id` int(11) NOT NULL,
    `item_type` varchar(128) NOT NULL, -- film, game, show, review
    `item_id` int(11) NOT NULL,
    `user_id` int(11), -- if type = review
    `rating` float(2) NOT NULL,
    `like` bit NOT NULL
);

CREATE TABLE reviews (
    review_user_id int(11) NOT NULL,
    review_id int(11) NOT NULL, -- every user`s reviews has its own set of ids
    review_item_type varchar(128) NOT NULL,
    review_item_id int(11) NOT NULL,
    review_rating float(2) NOT NULL,
    review_like bit NOT NULL,
    review_text text NOT NULL,
    review_date datetime NOT NULL
);

CREATE TABLE entries (
    entry_user_id int(11) NOT NULL,
    entry_item_type varchar(128) NOT NULL,
    entry_item_id int(11) NOT NULL,
    entry_rating float(2) NOT NULL,
    entry_like bit NOT NULL,
    entry_review bit NOT NULL,
    entry_review_id int(11),
    entry_date_completion datetime NOT NULL, -- datetime för att lättare sortera i "activity from friends"
    entry_date_start date, -- optional
    entry_first bit -- is it a rewatch?
);

CREATE TABLE follow (
    follow_from_id int(11) NOT NULL,
    follow_to_id int(11) NOT NULL,
    follow_status varchar(1) NOT NULL -- P: Pending request, F: Friends, B: Blocked
)