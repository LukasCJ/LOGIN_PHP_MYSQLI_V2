CREATE TABLE `users` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` varchar(128) NOT NULL,
    `email` varchar(128) NOT NULL,
    `uid` varchar(128) NOT NULL,
    `pwd` varchar(128) NOT NULL
);

CREATE TABLE `items` (
    `type` varchar(128) NOT NULL CHECK (`type` IN ('Film', 'Short Film', 'Game', 'Series', 'Mini Series')),
    `id` int(11) NOT NULL,
    `name` varchar(128) NOT NULL,
    `date` date NOT NULL,
    `poster-path` varchar(128),
    `bg-path` varchar(128),
    `description` text NOT NULL,
    `rating` float(2) NOT NULL DEFAULT 0,
    `popularity-all` int(11) NOT NULL DEFAULT 0,
    `popularity-week` int(11) NOT NULL DEFAULT 0,

    -- endast för spel och filmer (i minuter)
    -- spels längd hämtad från howlongtobeat.com
    `length` int(5), 

    -- endast för serier
    `series_length-seasons` int(3),
    `series_length-eps` int(5),
    `series_ongoing` bit, -- 1: yes
    `series_date-last` date -- NULL if ongoing
);

CREATE TABLE `seasons` (
    `number` int(4) NOT NULL,
    `series_id` int(11) NOT NULL,
    `length_eps` int(5) NOT NULL,
    `date` date NOT NULL,
    `bg_path` varchar(128),
    `description` varchar(128) NOT NULL,
);

CREATE TABLE `eps` (
    `number_of_season` int(5) NOT NULL, -- vilket avsnitt av denna säsongen?
    `number_of_series` int(5) NOT NULL, -- vilket avsnitt av hela serien?
    `series_id` int(11) NOT NULL,
    `season` varchar(128) NOT NULL, -- vilken säsong?
    `name` varchar(128) NOT NULL,
    `date` date NOT NULL,
    `bg_path` varchar(128),
    `description` varchar(128) NOT NULL,
    `length` int(5) NOT NULL,
    `rating` float(2) NOT NULL DEFAULT 0
);

CREATE TABLE `edition` (
    `item_id` int(11) NOT NULL,
    `name` varchar(128) NOT NULL,
    `length` int(5), 
);

CREATE TABLE `alt_editions` (
    
);

CREATE TABLE `achievements` (
    `name`
);

CREATE TABLE `unlocked_achievements` (
    `name`
);

CREATE TABLE `ratings` (
    `user_id` int(11) NOT NULL,
    `item_type` varchar(128) NOT NULL,
    `item_id` int(11) NOT NULL,
    `rating` float(2), -- mellan 0.1 och 5. tiondels poäng funkar. om 0 => NULL, räknas inte med i avg. 
    `like` bit NOT NULL
);

CREATE TABLE `entries` (
    `user_id` int(11) NOT NULL,
    `item_type` varchar(128) NOT NULL,
    `item_id` int(11) NOT NULL,
    `rating` float(2) NOT NULL,
    `like` bit NOT NULL,
    `date_completion` date NOT NULL,
    `date_start` date, -- optional
    `re` bit NOT NULL DEFAULT 0 -- is it a rewatch? 1: yes

    -- `review` bit NOT NULL,
    -- `review_id` int(11),
);