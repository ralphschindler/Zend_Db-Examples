<?php

$common = include 'common.php';

$data = array_merge($common, array(
    'schema_up' => array(
        'CREATE TABLE "artist" (
          "id" INTEGER PRIMARY KEY NOT NULL,
          "name" VARCHAR(255) NOT NULL,
          "history" CLOB
        )',
        'CREATE TABLE "album" (
          "id" INTEGER PRIMARY KEY NOT NULL,
          "artist_id" INTEGER NOT NULL,
          "title" VARCHAR(255) NOT NULL,
          "release_date" DATE NOT NULL,
          CONSTRAINT "album_artist_fk" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id")
        )',
        'CREATE TABLE "genre" (
          "id" INTEGER PRIMARY KEY NOT NULL,
          "parent_id" INTEGER DEFAULT NULL,
          "name" VARCHAR(255) NOT NULL,
          UNIQUE ("name"),
          CONSTRAINT "genre_genre_fk" FOREIGN KEY ("parent_id") REFERENCES "genre" ("id")
        )',
        'CREATE TABLE "artist_genre" (
          "artist_id" INTEGER NOT NULL,
          "genre_id" INTEGER NOT NULL,
          "added_on" DATE NOT NULL,
          PRIMARY KEY ("artist_id","genre_id"),
          CONSTRAINT "artist_genre_artist_fk" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id"),
          CONSTRAINT "artist_genre_genre_fk" FOREIGN KEY ("genre_id") REFERENCES "genre" ("id")
        )',
        'CREATE TABLE "track" (
          "id" INTEGER PRIMARY KEY NOT NULL,
          "artist_id" INTEGER DEFAULT NULL,
          "album_id" INTEGER DEFAULT NULL,
          "number" INTEGER DEFAULT NULL,
          "title" VARCHAR(255) NOT NULL,
          "length" INTEGER NOT NULL,
          CONSTRAINT "track_artist_fk" FOREIGN KEY ("artist_id") REFERENCES "artist" ("id"),
          CONSTRAINT "track_album_fk" FOREIGN KEY ("album_id") REFERENCES "album" ("id")
        )',
//        'CREATE SEQUENCE "artist_id_seq" START WITH 1 INCREMENT BY 1 NOMAXVALUE',
//        'CREATE TRIGGER "artist_autoincrement_trig"' . "\n"
//            . 'BEFORE INSERT ON "artist"' . "\n"
//            . 'FOR EACH ROW WHEN (NEW."id" IS NULL)' . "\n"
//            . 'BEGIN SELECT "artist_id_seq".NEXTVAL INTO :NEW."id" FROM DUAL;' . "\n"
//            . 'END;',
//        'CREATE SEQUENCE "album_id_seq" START WITH 1 INCREMENT BY 1 NOMAXVALUE',
//        'CREATE TRIGGER "album_autoincrement_trig"' . "\n"
//            . 'BEFORE INSERT ON "album"' . "\n"
//            . 'FOR EACH ROW WHEN (NEW."id" IS NULL)' . "\n"
//            . 'BEGIN SELECT "album_id_seq".NEXTVAL INTO :NEW."id" FROM DUAL;' . "\n"
//            . 'END;',
//        'CREATE SEQUENCE "genre_id_seq" START WITH 1 INCREMENT BY 1 NOMAXVALUE',
//        'CREATE TRIGGER "genre_autoincrement_trig"' . "\n"
//            . 'BEFORE INSERT ON "genre"' . "\n"
//            . 'FOR EACH ROW WHEN (NEW."id" IS NULL)' . "\n"
//            . 'BEGIN SELECT "genre_id_seq".NEXTVAL INTO :NEW."id" FROM DUAL;' . "\n"
//            . 'END;',
//        'CREATE SEQUENCE "track_id_seq" START WITH 1 INCREMENT BY 1 NOMAXVALUE',
//        'CREATE TRIGGER "track_autoincrement_trig"' . "\n"
//            . 'BEFORE INSERT ON "track"' . "\n"
//            . 'FOR EACH ROW WHEN (NEW."id" IS NULL)' . "\n"
//            . 'BEGIN SELECT "track_id_seq".NEXTVAL INTO :NEW."id" FROM DUAL;' . "\n"
//            . 'END;',
//        'CREATE PROCEDURE "reset_sequence"( "p_seq_name" IN VARCHAR2)' . "\n"
//            . 'IS "l_val" NUMBER;' . "\n"
//            . 'BEGIN' . "\n"
//            . 'EXECUTE IMMEDIATE \'SELECT "\' || "p_seq_name" || \'".NEXTVAL FROM DUAL\' INTO "l_val";' . "\n"
//            . 'EXECUTE IMMEDIATE \'ALTER SEQUENCE "\' || "p_seq_name" || \'" INCREMENT BY -\' || "l_val" || \' MINVALUE 0\';' . "\n"
//            . 'EXECUTE IMMEDIATE \'SELECT "\' || "p_seq_name" || \'".NEXTVAL FROM DUAL \' INTO "l_val";' . "\n"
//            . 'EXECUTE IMMEDIATE \'ALTER SEQUENCE "\' || "p_seq_name" || \'" INCREMENT BY 1 MINVALUE 0\';' . "\n"
//            . 'END;',
    ),
    'schema_down' => array(
        //
        'DROP TABLE "track"',
        'DROP TABLE "artist_genre"',
        'DROP TABLE "genre"',
        'DROP TABLE "album"',
        'DROP TABLE "artist"'


//        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "track"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "artist_genre"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "genre"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "album"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP TABLE "artist"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -942 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP SEQUENCE "artist_id_seq"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP TRIGGER "artist_autoincrement_trig"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4080 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP SEQUENCE "album_id_seq"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP TRIGGER "album_autoincrement_trig"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4080 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP SEQUENCE "genre_id_seq"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP TRIGGER "genre_autoincrement_trig"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4080 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP SEQUENCE "track_id_seq"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP TRIGGER "track_autoincrement_trig"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4080 THEN RAISE; END IF; END;',
//        'BEGIN EXECUTE IMMEDIATE \'DROP PROCEDURE "reset_sequence"\'; EXCEPTION WHEN OTHERS THEN IF SQLCODE != -4043 THEN RAISE; END IF; END;',
    ),
    'data_down' => array(
        'DELETE FROM "track"',
        'DELETE FROM "artist_genre"',
        'DELETE FROM "genre"',
        'DELETE FROM "album"',
        'DELETE FROM "artist"',
//        'BEGIN EXECUTE IMMEDIATE \'EXECUTE "reset_sequence" (\\\'artist_id_seq\\\')\'; END;'
    ),

));

//foreach ($data['data_up'] as $tName => $tData) {
//    foreach ($tData as $tRowIndex => $tRow) {
//        foreach ($tRow as $cName => $cValue) {
//            if (strpos($cName, '_date') !== false || strpos($cName, '_on') !== false) {
//                $data['data_up'][$tName][$tRowIndex][$cName] = date('d-M-y', strtotime($cValue));
//            }
//        }
//    }
//}

return $data;
