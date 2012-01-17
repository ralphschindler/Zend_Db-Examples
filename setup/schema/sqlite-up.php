<?php

$sqldata = <<<EOS

CREATE TABLE IF NOT EXISTS "album" (
  "id" INTEGER PRIMARY KEY,
  "artist_id" int(11) NOT NULL,
  "title" varchar(255) NOT NULL,
  "release_date" date NOT NULL
);

CREATE TABLE IF NOT EXISTS "artist" (
  "id" INTEGER PRIMARY KEY,
  "name" varchar(255) NOT NULL,
  "history" text
);

CREATE TABLE IF NOT EXISTS "artist_genre" (
  "artist_id" int(11) NOT NULL,
  "genre_id" int(11) NOT NULL,
  "added_on" date NOT NULL,
  PRIMARY KEY ("artist_id","genre_id")
);

CREATE TABLE IF NOT EXISTS "genre" (
  "id" INTEGER PRIMARY KEY,
  "parent_id" int(11) DEFAULT NULL,
  "name" varchar(255) NOT NULL,
  UNIQUE ("name")
);

CREATE TABLE IF NOT EXISTS "track" (
  "id" INTEGER PRIMARY KEY,
  "artist_id" int(11) DEFAULT NULL,
  "album_id" int(11) DEFAULT NULL,
  "number" int(11) DEFAULT NULL,
  "title" varchar(255) NOT NULL,
  "length" int(11) NOT NULL
);

EOS;

// if ($table_type == 'InnoDB') {
//     
//     $sqldata .=<<< EOS
//     ALTER TABLE "album"
//       ADD CONSTRAINT "album_ibfk_1" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
// 
//     ALTER TABLE "artist_genre"
//       ADD CONSTRAINT "artist_genre_ibfk_1" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id") ON DELETE CASCADE ON UPDATE CASCADE,
//       ADD CONSTRAINT "artist_genre_ibfk_2" FOREIGN KEY ("genre_id") REFERENCES "genre" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
// 
//     ALTER TABLE "genre"
//       ADD CONSTRAINT "genre_ibfk_1" FOREIGN KEY ("parent_id") REFERENCES "genre" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
// 
//     ALTER TABLE "track"
//       ADD CONSTRAINT "track_ibfk_1" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id") ON DELETE CASCADE ON UPDATE CASCADE,
//       ADD CONSTRAINT "track_ibfk_2" FOREIGN KEY ("album_id") REFERENCES "album" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
// EOS;
// }

$sqls = explode("\n\n", str_replace("\r", '', $sqldata));
$sqls = array_map('trim', $sqls);

return $sqls;