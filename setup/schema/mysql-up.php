<?php

$table_type = (isset($dbconfig['table_type']) && $dbconfig['table_type'] == 'InnoDB') ? 'InnoDB' : 'MyISAM';

$sqldata = <<<EOS

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `artist_id` (`artist_id`)
) ENGINE=$table_type DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `history` text,
  PRIMARY KEY (`id`)
) ENGINE=$table_type DEFAULT CHARSET=utf8;

INSERT INTO `artist` (`id`, `name`, `history`) VALUES
(1, 'Foo Artist', NULL),
(2, 'Bar Artist', NULL);

CREATE TABLE IF NOT EXISTS `artist_genre` (
  `artist_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `added_on` date NOT NULL,
  PRIMARY KEY (`artist_id`,`genre_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=$table_type DEFAULT CHARSET=utf8;

INSERT INTO `artist_genre` (`artist_id`, `genre_id`, `added_on`) VALUES
(1, 1, '2010-11-10'),
(1, 2, '2010-11-11');

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `parent_id` (`parent_id`)
) ENGINE=$table_type  DEFAULT CHARSET=utf8;

INSERT INTO `genre` (`id`, `parent_id`, `name`) VALUES
(1, NULL, 'Rock & Roll'),
(2, NULL, 'Hiphop');

CREATE TABLE IF NOT EXISTS `track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `length` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `artist_id` (`artist_id`),
  KEY `album_id` (`album_id`)
) ENGINE=$table_type DEFAULT CHARSET=utf8;

EOS;

if ($table_type == 'InnoDB') {
    
    $sqldata .=<<< EOS
    ALTER TABLE `album`
      ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

    ALTER TABLE `artist_genre`
      ADD CONSTRAINT `artist_genre_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
      ADD CONSTRAINT `artist_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

    ALTER TABLE `genre`
      ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

    ALTER TABLE `track`
      ADD CONSTRAINT `track_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
      ADD CONSTRAINT `track_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
EOS;
}

$sqls = explode("\n\n", str_replace("\r", '', $sqldata));
$sqls = array_map('trim', $sqls);
var_dump($sqls);