<?php

$common = include 'common.php';

$data = array_merge($common, array(
    'schema_up' => array(
        'CREATE TABLE "artist" (
          "id" NUMBER PRIMARY KEY,
          "name" VARCHAR(255) NOT NULL,
          "history" CLOB
        )',
        'CREATE TABLE "album" (
          "id" NUMBER PRIMARY KEY,
          "artist_id" NUMBER NOT NULL,
          "title" VARCHAR(255) NOT NULL,
          "release_date" DATE NOT NULL,
          CONSTRAINT "album_artist_fk" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id")
        )',
        'CREATE TABLE "genre" (
          "id" NUMBER PRIMARY KEY,
          "parent_id" NUMBER DEFAULT NULL,
          "name" VARCHAR(255) NOT NULL,
          UNIQUE ("name"),
          CONSTRAINT "genre_genre_fk" FOREIGN KEY ("parent_id") REFERENCES "genre" ("id")
        )',
        'CREATE TABLE "artist_genre" (
          "artist_id" NUMBER NOT NULL,
          "genre_id" NUMBER NOT NULL,
          "added_on" DATE NOT NULL,
          PRIMARY KEY ("artist_id","genre_id"),
          CONSTRAINT "artist_genre_artist_fk" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id"),
          CONSTRAINT "artist_genre_genre_fk" FOREIGN KEY ("genre_id") REFERENCES "genre" ("id")
        )',
        'CREATE TABLE "track" (
          "id" NUMBER PRIMARY KEY,
          "artist_id" NUMBER DEFAULT NULL,
          "album_id" NUMBER DEFAULT NULL,
          "number" NUMBER DEFAULT NULL,
          "title" VARCHAR(255) NOT NULL,
          "length" NUMBER NOT NULL,
          CONSTRAINT "track_artist_fk" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id"),
          CONSTRAINT "track_album_fk" FOREIGN KEY ("album_id") REFERENCES "album" ("id")
        )',
        'CREATE SEQUENCE "artist_id_seq" START WITH 1 INCREMENT BY 1 NOMAXVALUE',
        'CREATE TRIGGER "artist_autoincrement_trig"' . "\n" . 'BEFORE INSERT ON "artist"' . "\n" . 'FOR EACH ROW WHEN (NEW."id" IS NULL)' . "\n" . 'BEGIN SELECT "artist_id_seq".NEXTVAL INTO :NEW."id" FROM DUAL;' . "\n" . 'END;',
        'CREATE SEQUENCE "album_id_seq" START WITH 1 INCREMENT BY 1 NOMAXVALUE',
        'CREATE TRIGGER "album_autoincrement_trig"' . "\n" . 'BEFORE INSERT ON "album"' . "\n" . 'FOR EACH ROW WHEN (NEW."id" IS NULL)' . "\n" . 'BEGIN SELECT "album_id_seq".NEXTVAL INTO :NEW."id" FROM DUAL;' . "\n" . 'END;',
        'CREATE SEQUENCE "genre_id_seq" START WITH 1 INCREMENT BY 1 NOMAXVALUE',
        'CREATE TRIGGER "genre_autoincrement_trig"' . "\n" . 'BEFORE INSERT ON "genre"' . "\n" . 'FOR EACH ROW WHEN (NEW."id" IS NULL)' . "\n" . 'BEGIN SELECT "genre_id_seq".NEXTVAL INTO :NEW."id" FROM DUAL;' . "\n" . 'END;',
        'CREATE SEQUENCE "track_id_seq" START WITH 1 INCREMENT BY 1 NOMAXVALUE',
        'CREATE TRIGGER "track_autoincrement_trig"' . "\n" . 'BEFORE INSERT ON "track"' . "\n" . 'FOR EACH ROW WHEN (NEW."id" IS NULL)' . "\n" . 'BEGIN SELECT "track_id_seq".NEXTVAL INTO :NEW."id" FROM DUAL;' . "\n" . 'END;',
    ),
    'schema_down' => array(
        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "track"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "artist_genre"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "genre"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "album"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "artist"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP SEQUENCE "artist_id_seq"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP TRIGGER "artist_autoincrement_trig"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4080 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP SEQUENCE "album_id_seq"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP TRIGGER "album_autoincrement_trig"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4080 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP SEQUENCE "genre_id_seq"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP TRIGGER "genre_autoincrement_trig"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4080 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP SEQUENCE "track_id_seq"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DROP TRIGGER "track_autoincrement_trig"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4080 THEN RAISE; END IF; END;',
    ),
    'data_down' => array(
        'BEGIN EXECUTE IMMEDIATE \'DELETE FROM "track"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DELETE FROM "artist_genre"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DELETE FROM "genre"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DELETE FROM "album"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
        'BEGIN EXECUTE IMMEDIATE \'DELETE FROM "artist"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
    ),

));

foreach ($data['data_up'] as $tName => $tData) {
    foreach ($tData as $tRowIndex => $tRow) {
        foreach ($tRow as $cName => $cValue) {
            if (strpos($cName, '_date') !== false || strpos($cName, '_on') !== false) {
                $data['data_up'][$tName][$tRowIndex][$cName] = date('d-M-y', strtotime($cValue));
            }
        }
    }
}

//$data['data_up'] = array(
//    'artist' => $data['data_up']['artist'],
//    "SELECT setval('artist_id_seq', 6)",
//    'album' => $data['data_up']['album'],
//    "SELECT setval('album_id_seq', 25)",
//    'genre' => $data['data_up']['genre'],
//    "SELECT setval('genre_id_seq', 4)",
//    'artist_genre' => $data['data_up']['artist_genre'],
//    'track' => $data['data_up']['track'],
//    "SELECT setval('track_id_seq', 1)",
//);

return $data;