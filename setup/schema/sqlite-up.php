<?php

$sqldata = <<<EOS










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