<?php

$table_type = (isset($dbconfig['table_type']) && $dbconfig['table_type'] == 'InnoDB') ? 'InnoDB' : 'MyISAM';

$common = include 'common.php';

$data = array_merge($common, array(
    'schema_up' => array(
        "CREATE TABLE IF NOT EXISTS `album` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `artist_id` int(11) NOT NULL,
          `title` varchar(255) NOT NULL,
          `release_date` date NOT NULL,
          PRIMARY KEY (`id`),
          KEY `artist_id` (`artist_id`)
        ) ENGINE=$table_type DEFAULT CHARSET=utf8;",
        "CREATE TABLE IF NOT EXISTS `artist` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `history` text,
          PRIMARY KEY (`id`)
        ) ENGINE=$table_type DEFAULT CHARSET=utf8;",
        "CREATE TABLE IF NOT EXISTS `artist_genre` (
          `artist_id` int(11) NOT NULL,
          `genre_id` int(11) NOT NULL,
          `added_on` date NOT NULL,
          PRIMARY KEY (`artist_id`,`genre_id`),
          KEY `genre_id` (`genre_id`)
        ) ENGINE=$table_type DEFAULT CHARSET=utf8;",
        "CREATE TABLE IF NOT EXISTS `artist_genre` (
          `artist_id` int(11) NOT NULL,
          `genre_id` int(11) NOT NULL,
          `added_on` date NOT NULL,
          PRIMARY KEY (`artist_id`,`genre_id`),
          KEY `genre_id` (`genre_id`)
        ) ENGINE=$table_type DEFAULT CHARSET=utf8;",
        "CREATE TABLE IF NOT EXISTS `genre` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `parent_id` int(11) DEFAULT NULL,
          `name` varchar(255) NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `name` (`name`),
          KEY `parent_id` (`parent_id`)
        ) ENGINE=$table_type  DEFAULT CHARSET=utf8;",
        "CREATE TABLE IF NOT EXISTS `track` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `artist_id` int(11) DEFAULT NULL,
          `album_id` int(11) DEFAULT NULL,
          `number` int(11) DEFAULT NULL,
          `title` varchar(255) NOT NULL,
          `length` int(11) NOT NULL,
          PRIMARY KEY (`id`),
          KEY `artist_id` (`artist_id`),
          KEY `album_id` (`album_id`)
        ) ENGINE=$table_type DEFAULT CHARSET=utf8;",
    ),
    'schema_down' => array(
        'DROP TABLE IF EXISTS `artist_genre`;',
        'DROP TABLE IF EXISTS `genre`;',
        'DROP TABLE IF EXISTS `track`;',
        'DROP TABLE IF EXISTS `album`;',
        'DROP TABLE IF EXISTS `artist`;'
    ),
    'data_down' => array(
        'DELETE FROM `artist_genre`',
        'DELETE FROM `album`',
        'DELETE FROM `artist`',
        'DELETE FROM `genre`',
        'DELETE FROM `track`',
        'ALTER TABLE `artist_genre` AUTO_INCREMENT = 1',
        'ALTER TABLE `album` AUTO_INCREMENT = 1',
        'ALTER TABLE `artist` AUTO_INCREMENT = 1',
        'ALTER TABLE `genre` AUTO_INCREMENT = 1',
        'ALTER TABLE `track` AUTO_INCREMENT = 1',
    ),
));

if ($table_type == 'InnoDB') {
    
    $data = array_merge_recursive($data, array(
        'schema_up' => array(
            'ALTER TABLE `album`
              ADD CONSTRAINT `fk_album_artist` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;',
            'ALTER TABLE `artist_genre`
              ADD CONSTRAINT `fk_artist_genre_artist` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `fk_artist_genre_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;',
            'ALTER TABLE `genre`
              ADD CONSTRAINT `fk_genre_genre` FOREIGN KEY (`parent_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;',
            'ALTER TABLE `track`
              ADD CONSTRAINT `fk_track_artist` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `fk_track_album` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;',
        )
    ));

}
return $data;