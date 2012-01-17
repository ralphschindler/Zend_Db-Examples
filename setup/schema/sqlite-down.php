<?php

$sqldata = <<<EOS

DROP TABLE IF EXISTS `artist_genre`;

DROP TABLE IF EXISTS `genre`;

DROP TABLE IF EXISTS `track`;

DROP TABLE IF EXISTS `album`;

DROP TABLE IF EXISTS `artist`;

EOS;

$sqls = explode("\n\n", str_replace("\r", '', $sqldata));
$sqls = array_map('trim', $sqls);

return $sqls;