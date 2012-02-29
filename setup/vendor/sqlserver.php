<?php

$table_type = (isset($dbconfig['table_type']) && $dbconfig['table_type'] == 'InnoDB') ? 'InnoDB' : 'MyISAM';

$common = include 'common.php';

$data = array_merge($common, array(
    'schema_up' => array(
        'CREATE TABLE [album] (
          [id] INTEGER PRIMARY KEY IDENTITY,
          [artist_id] INTEGER NOT NULL,
          [title] varchar(255) NOT NULL,
          [release_date] date NOT NULL
        );',
        'CREATE TABLE [artist] (
          [id] INTEGER PRIMARY KEY IDENTITY,
          [name] varchar(255) NOT NULL,
          [history] text
        );',
        'CREATE TABLE [genre] (
          [id] INTEGER PRIMARY KEY IDENTITY,
          [parent_id] INTEGER DEFAULT NULL,
          [name] varchar(255) NOT NULL,
          UNIQUE ([name])
        );',
        'CREATE TABLE [artist_genre] (
          [artist_id] INTEGER NOT NULL,
          [genre_id] INTEGER NOT NULL,
          [added_on] date NOT NULL,
          PRIMARY KEY ([artist_id],[genre_id])
        );',
        'CREATE TABLE [track] (
          [id] INTEGER PRIMARY KEY IDENTITY,
          [artist_id] INTEGER DEFAULT NULL,
          [album_id] INTEGER DEFAULT NULL,
          [number] INTEGER DEFAULT NULL,
          [title] varchar(255) NOT NULL,
          [length] INTEGER NOT NULL
        );',
        'ALTER TABLE [album]
          ADD CONSTRAINT [fk_album_artist] FOREIGN KEY ([artist_id]) REFERENCES [artist] ([id]) ON DELETE CASCADE ON UPDATE CASCADE',
        'ALTER TABLE [artist_genre]
          ADD CONSTRAINT [fk_artist_genre_artist] FOREIGN KEY ([artist_id]) REFERENCES [artist] ([id]) ON DELETE CASCADE ON UPDATE CASCADE',
        'ALTER TABLE [artist_genre]
          ADD CONSTRAINT [fk_artist_genre_genre] FOREIGN KEY ([genre_id]) REFERENCES [genre] ([id]) ON DELETE CASCADE ON UPDATE CASCADE',
        'ALTER TABLE [genre]
          ADD CONSTRAINT [fk_genre_genre] FOREIGN KEY ([parent_id]) REFERENCES [genre] ([id]) ON DELETE NO ACTION ON UPDATE NO ACTION',
        'ALTER TABLE [track]
          ADD CONSTRAINT [fk_track_artist] FOREIGN KEY ([artist_id]) REFERENCES [artist] ([id]) ON DELETE NO ACTION ON UPDATE NO ACTION',
        'ALTER TABLE [track]
          ADD CONSTRAINT [fk_track_album] FOREIGN KEY ([album_id]) REFERENCES [album] ([id]) ON DELETE NO ACTION ON UPDATE NO ACTION',
    ),
    'schema_down' => array(
        'IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.CONSTRAINT_TABLE_USAGE WHERE TABLE_NAME = \'album\' AND [CONSTRAINT_NAME] = \'fk_album_artist\')
          ALTER TABLE [album] DROP CONSTRAINT [fk_album_artist]',

        'IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.CONSTRAINT_TABLE_USAGE WHERE TABLE_NAME = \'artist_genre\' AND [CONSTRAINT_NAME] = \'fk_artist_genre_artist\')
          ALTER TABLE [artist_genre] DROP CONSTRAINT [fk_artist_genre_artist]',

        'IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.CONSTRAINT_TABLE_USAGE WHERE TABLE_NAME = \'artist_genre\' AND [CONSTRAINT_NAME] = \'fk_artist_genre_genre\')
          ALTER TABLE [artist_genre] DROP CONSTRAINT [fk_artist_genre_genre]',

        'IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.CONSTRAINT_TABLE_USAGE WHERE TABLE_NAME = \'genre\' AND [CONSTRAINT_NAME] = \'fk_genre_genre\')
          ALTER TABLE [genre] DROP CONSTRAINT [fk_genre_genre]',

        'IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.CONSTRAINT_TABLE_USAGE WHERE TABLE_NAME = \'track\' AND [CONSTRAINT_NAME] = \'fk_track_artist\')
          ALTER TABLE [track] DROP CONSTRAINT [fk_track_artist]',

        'IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.CONSTRAINT_TABLE_USAGE WHERE TABLE_NAME = \'track\' AND [CONSTRAINT_NAME] = \'fk_track_album\')
          ALTER TABLE [track] DROP CONSTRAINT [fk_track_album]',

        'IF OBJECT_ID(\'album\') IS NOT NULL DROP TABLE [album]',
        'IF OBJECT_ID(\'artist\') IS NOT NULL DROP TABLE [artist]',
        'IF OBJECT_ID(\'genre\') IS NOT NULL DROP TABLE [genre]',
        'IF OBJECT_ID(\'artist_genre\') IS NOT NULL DROP TABLE [artist_genre]',
        'IF OBJECT_ID(\'track\') IS NOT NULL DROP TABLE [track]'
    ),
    'data_down' => array(
        'DELETE FROM [album]',
        'DBCC CHECKIDENT(album, RESEED, 1)',
        'DELETE FROM [artist]',
        'DBCC CHECKIDENT(artist, RESEED, 1)',
        'DELETE FROM [artist_genre]',
        'DELETE FROM [genre]',
        'DBCC CHECKIDENT(genre, RESEED, 1)',
        'DELETE FROM [track]',
        'DBCC CHECKIDENT(track, RESEED, 1)',
    )
));

$data['data_up'] = array(
    'SET IDENTITY_INSERT [artist] ON',
    'artist' => $data['data_up']['artist'],
    'SET IDENTITY_INSERT [artist] OFF',
    'SET IDENTITY_INSERT [album] ON',
    'album' => $data['data_up']['album'],
    'SET IDENTITY_INSERT [album] OFF',
    'SET IDENTITY_INSERT [genre] ON',
    'genre' => $data['data_up']['genre'],
    'SET IDENTITY_INSERT [genre] OFF',
    'artist_genre' => $data['data_up']['artist_genre'],
    'track' => $data['data_up']['track'],
);


return $data;