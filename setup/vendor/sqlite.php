<?php

$common = include 'common.php';

return array_merge($common, array(
    'schema_up' => array(
        'CREATE TABLE IF NOT EXISTS "album" (
          "id" INTEGER PRIMARY KEY,
          "artist_id" int(11) NOT NULL,
          "title" varchar(255) NOT NULL,
          "release_date" date NOT NULL,
          FOREIGN KEY ("artist_id") REFERENCES "artist"("id")
        );',
        'CREATE TABLE IF NOT EXISTS "artist" (
          "id" INTEGER PRIMARY KEY,
          "name" varchar(255) NOT NULL,
          "history" text
        );',
        'CREATE TABLE IF NOT EXISTS "genre" (
          "id" INTEGER PRIMARY KEY,
          "parent_id" int(11) DEFAULT NULL,
          "name" varchar(255) NOT NULL,
          UNIQUE ("name"),
          FOREIGN KEY ("parent_id") REFERENCES "genre" ("id")
        );',
        'CREATE TABLE IF NOT EXISTS "artist_genre" (
          "artist_id" int(11) NOT NULL,
          "genre_id" int(11) NOT NULL,
          "added_on" date NOT NULL,
          PRIMARY KEY ("artist_id","genre_id"),
          FOREIGN KEY ("artist_id") REFERENCES "artist" ("id"),
          FOREIGN KEY ("genre_id") REFERENCES "genre" ("id")
        );',
        'CREATE TABLE IF NOT EXISTS "track" (
          "id" INTEGER PRIMARY KEY,
          "artist_id" int(11) DEFAULT NULL,
          "album_id" int(11) DEFAULT NULL,
          "number" int(11) DEFAULT NULL,
          "title" varchar(255) NOT NULL,
          "length" int(11) NOT NULL,
          FOREIGN KEY ("artist_id") REFERENCES "artist" ("id"),
          FOREIGN KEY ("album_id") REFERENCES "album" ("id")
        );'
    ),
    'schema_down' => array(
        'DROP TABLE IF EXISTS "album"',
        'DROP TABLE IF EXISTS "artist"',
        'DROP TABLE IF EXISTS "genre"',
        'DROP TABLE IF EXISTS "artist_genre"',
        'DROP TABLE IF EXISTS "track"'
    ),
    'data_down' => array(
        'DELETE FROM "album"',
        'DELETE FROM "artist"',
        'DELETE FROM "artist_genre"',
        'DELETE FROM "genre"',
        'DELETE FROM "track"',
    )
));