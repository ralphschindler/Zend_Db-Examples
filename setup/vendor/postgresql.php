<?php

$common = include 'common.php';

$data = array_merge($common, array(
    'schema_up' => array(
        'CREATE TABLE IF NOT EXISTS "artist" (
          "id" SERIAL PRIMARY KEY,
          "name" VARCHAR(255) NOT NULL,
          "history" text
        );',
        'CREATE TABLE IF NOT EXISTS "album" (
          "id" SERIAL PRIMARY KEY,
          "artist_id" INTEGER NOT NULL,
          "title" VARCHAR(255) NOT NULL,
          "release_date" DATE NOT NULL,
          FOREIGN KEY ("artist_id") REFERENCES "artist"("id") ON DELETE CASCADE ON UPDATE CASCADE
        );',
        'CREATE TABLE IF NOT EXISTS "genre" (
          "id" SERIAL PRIMARY KEY,
          "parent_id" INTEGER DEFAULT NULL,
          "name" VARCHAR(255) NOT NULL,
          UNIQUE ("name"),
          FOREIGN KEY ("parent_id") REFERENCES "genre" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION
        );',
        'CREATE TABLE IF NOT EXISTS "artist_genre" (
          "artist_id" INTEGER NOT NULL,
          "genre_id" INTEGER NOT NULL,
          "added_on" DATE NOT NULL,
          PRIMARY KEY ("artist_id","genre_id"),
          FOREIGN KEY ("artist_id") REFERENCES "artist" ("id") ON DELETE CASCADE ON UPDATE CASCADE,
          FOREIGN KEY ("genre_id") REFERENCES "genre" ("id") ON DELETE CASCADE ON UPDATE CASCADE
        );',
        'CREATE TABLE IF NOT EXISTS "track" (
          "id" SERIAL PRIMARY KEY,
          "artist_id" INTEGER DEFAULT NULL,
          "album_id" INTEGER DEFAULT NULL,
          "number" INTEGER DEFAULT NULL,
          "title" VARCHAR(255) NOT NULL,
          "length" INTEGER NOT NULL,
          FOREIGN KEY ("artist_id") REFERENCES "artist" ("id") ON DELETE CASCADE ON UPDATE CASCADE,
          FOREIGN KEY ("album_id") REFERENCES "album" ("id") ON DELETE CASCADE ON UPDATE CASCADE
        );'
    ),
    'schema_down' => array(
        'DROP TABLE IF EXISTS "track"',
        'DROP TABLE IF EXISTS "artist_genre"',
        'DROP TABLE IF EXISTS "genre"',
        'DROP TABLE IF EXISTS "album"',
        'DROP TABLE IF EXISTS "artist"'
    ),
    'data_down' => array(
        'DELETE FROM "track"',
        'DELETE FROM "artist_genre"',
        'DELETE FROM "genre"',
        'DELETE FROM "album"',
        'DELETE FROM "artist"',
    ),

));

$data['data_up'] = array(
    'artist' => $data['data_up']['artist'],
    "SELECT setval('artist_id_seq', 6)",
    'album' => $data['data_up']['album'],
    "SELECT setval('album_id_seq', 25)",
    'genre' => $data['data_up']['genre'],
    "SELECT setval('genre_id_seq', 4)",
    'artist_genre' => $data['data_up']['artist_genre'],
    'track' => $data['data_up']['track'],
    "SELECT setval('track_id_seq', 1)",
);

return $data;