CREATE TABLE users (
    user_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_name varchar(128) NOT NULL,
    user_email varchar(128) NOT NULL,
    user_uid varchar(128) NOT NULL,
    user_pwd varchar(128) NOT NULL,
    user_ratings json NOT NULL,
    user_reviews json NOT NULL,
    user_diary json NOT NULL
);

CREATE TABLE feature_films (
    film_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    film_name varchar(128) NOT NULL,
    film_date date NOT NULL,
    film_poster_path varchar(128) NOT NULL,
    film_bg_path varchar(128) NOT NULL,
    film_description text NOT NULL,
    film_length time NOT NULL,
    film_rating float(2) NOT NULL,
    film_related json NOT NULL, -- includes both similar and franchise
    film_cast json NOT NULL,
    film_crew json NOT NULL
);

CREATE TABLE short_films (
    sfilm_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    sfilm_name varchar(128) NOT NULL,
    sfilm_date date NOT NULL,
    sfilm_poster_path varchar(128) NOT NULL,
    sfilm_bg_path varchar(128) NOT NULL,
    sfilm_description text NOT NULL,
    sfilm_length time NOT NULL,
    sfilm_rating float(2) NOT NULL,
    sfilm_related json NOT NULL,
    sfilm_cast json NOT NULL,
    sfilm_crew json NOT NULL
);

CREATE TABLE series (
    series_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    series_name varchar(128) NOT NULL,
    series_type varchar(128) NOT NULL, -- mini or full
    series_length_seasons int(3) NOT NULL, -- amount of seasons
    series_length_episodes int(5) NOT NULL,
    series_length_time time NOT NULL,
    series_date date NOT NULL, -- if unfinished: first ep date, if finished: first ep date "-" last ep date
    series_poster_path varchar(128) NOT NULL, -- will apply to every season
    series_bg_path varchar(128) NOT NULL,
    series_description varchar(128) NOT NULL,
    series_rating float(2) NOT NULL,
    series_related json NOT NULL,
    series_cast json NOT NULL, -- collected from seasons
    series_crew json NOT NULL
);

CREATE TABLE series_seasons (
    season_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    season_number int(4) NOT NULL,
    season_for_series varchar(128) NOT NULL,
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
    episode_number_season int(5) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    episode_number_series int(5) NOT NULL,
    episode_for_series varchar(128) NOT NULL,
    episode_for_season varchar(128) NOT NULL,
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
    rating_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    rating_for_user int(11) NOT NULL,
    rating_for_item_type varchar(128) NOT NULL,
    rating_for_item int(11) NOT NULL,
    rating_watched bool NOT NULL,
    rating float(2) NOT NULL,
    rating_like bool NOT NULL
);

CREATE TABLE reviews (
    review_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    review_for_user int(11) NOT NULL, -- id
    review_for_item_type varchar(128) NOT NULL,
    review_for_item int(11) NOT NULL, -- id
    review_rating float(2) NOT NULL,
    review_like bool NOT NULL,
    review_text text NOT NULL,
    review_date date NOT NULL
);

CREATE TABLE diary_entries (
    entry_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    entry_for_user int(11) NOT NULL,
    entry_for_item_type varchar(128) NOT NULL,
    entry_for_item int(11) NOT NULL,
    entry_rating float(2) NOT NULL,
    entry_likes bool NOT NULL,
    entry_review bool NOT NULL,
    entry_review_id int(11) NOT NULL,
    entry_date date NOT NULL
);