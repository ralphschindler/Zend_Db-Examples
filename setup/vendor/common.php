<?php

return array(
    'data_up' => array(
        'artist' => array(
            array(
                'id' => 1,
                'name' => 'Kevin Schroeder',
                'history' => null,
            ),
            array(
                'id' => 2,
                'name' => 'Linkin Park',
                'history' => null,
            ),
            array(
                'id' => 3,
                'name' => 'Lady Gaga',
                'history' => null,
            ),
            array(
                'id' => 4,
                'name' => 'Britney Spears',
                'history' => null,
            ),
            array(
                'id' => 5,
                'name' => 'ABBA',
                'history' => null,
            ),
        ),
        'album' => array(
            array(
                'id' => 1,
                'artist_id' => 1,
                'title' => 'Coronal Loop Safari',
                'release_date' => '2010-10-1'
            ),
            array(
                'id' => 2,
                'artist_id' => 1,
                'title' => 'Loudness Wars',
                'release_date' => '2012-05-01'
            ),
            array(
                'id' => 3,
                'artist_id' => 2,
                'title' => 'Hybrid Theory',
                'release_date' => '2000-05-01'
            ),
            array(
                'id' => 4,
                'artist_id' => 2,
                'title' => 'Meteora',
                'release_date' => '2003-02-15'
            ),
            array(
                'id' => 5,
                'artist_id' => 2,
                'title' => 'Minutes to Midnight',
                'release_date' => '2007-07-21'
            ),
            array(
                'id' => 6,
                'artist_id' => 2,
                'title' => 'A Thousand Suns',
                'release_date' => '2010-05-01'
            ),
            array(
                'id' => 7,
                'artist_id' => 3,
                'title' => 'The Fame',
                'release_date' => '2008-05-01'
            ),
            array(
                'id' => 8,
                'artist_id' => 3,
                'title' => 'The Fame Monster',
                'release_date' => '2009-05-01'
            ),
            array(
                'id' => 9,
                'artist_id' => 3,
                'title' => 'Born This Way',
                'release_date' => '2011-10-10'
            ),
            array(
                'id' => 10,
                'artist_id' => 4,
                'title' => '...Baby One More Time',
                'release_date' => '1999-2-14'
            ),
            array(
                'id' => 11,
                'artist_id' => 4,
                'title' => 'Oops!... I Did It Again',
                'release_date' => '2000-10-10'
            ),
            array(
                'id' => 12,
                'artist_id' => 4,
                'title' => 'Britney',
                'release_date' => '2001-04-06'
            ),
            array(
                'id' => 13,
                'artist_id' => 4,
                'title' => 'In the Zone',
                'release_date' => '2011-10-10'
            ),
            array(
                'id' => 14,
                'artist_id' => 4,
                'title' => 'Blackout',
                'release_date' => '2007-10-10'
            ),
            array(
                'id' => 15,
                'artist_id' => 4,
                'title' => 'Circus',
                'release_date' => '2008-11-23'
            ),
            array(
                'id' => 16,
                'artist_id' => 4,
                'title' => 'Femme Fatale',
                'release_date' => '2011-10-10'
            ),
            array(
                'id' => 17,
                'artist_id' => 5,
                'title' => 'Ring Ring',
                'release_date' => '1973-10-10'
            ),
            array(
                'id' => 18,
                'artist_id' => 5,
                'title' => 'Waterloo',
                'release_date' => '1974-10-10'
            ),
            array(
                'id' => 19,
                'artist_id' => 5,
                'title' => 'ABBA',
                'release_date' => '1975-10-10'
            ),
            array(
                'id' => 20,
                'artist_id' => 5,
                'title' => 'Arrival',
                'release_date' => '1976-10-10'
            ),
            array(
                'id' => 21,
                'artist_id' => 5,
                'title' => 'ABBA: The Album',
                'release_date' => '1977-10-10'
            ),
            array(
                'id' => 22,
                'artist_id' => 5,
                'title' => 'Voulez-Vous',
                'release_date' => '1979-10-10'
            ),
            array(
                'id' => 23,
                'artist_id' => 5,
                'title' => 'Super Trouper',
                'release_date' => '1980-10-10'
            ),
            array(
                'id' => 24,
                'artist_id' => 5,
                'title' => 'The Visitors',
                'release_date' => '1981-10-10'
            ),
        ),
        'genre' => array(
            array(
                'id' => 1,
                'parent_id' => null,
                'name' => 'Rock & Roll/Metal'
            ),
            array(
                'id' => 2,
                'parent_id' => null,
                'name' => 'Electronic/Dance'
            ),
            array(
                'id' => 3,
                'parent_id' => null,
                'name' => '70s'
            )
        ),
        'artist_genre' => array(
            array(
                'artist_id' => 1,
                'genre_id'  => 1,
                'added_on'  => '2010-11-10'
            ),
            array(
                'artist_id' => 1,
                'genre_id'  => 2,
                'added_on'  => '2010-11-10'
            ),
            array(
                'artist_id' => 2,
                'genre_id'  => 1,
                'added_on'  => '2010-11-11'
            ),
            array(
                'artist_id' => 3,
                'genre_id'  => 2,
                'added_on'  => '2010-11-11'
            ),
            array(
                'artist_id' => 4,
                'genre_id'  => 2,
                'added_on'  => '2010-11-11'
            ),
            array(
                'artist_id' => 5,
                'genre_id'  => 3,
                'added_on'  => '2010-11-11'
            ),
        ),
        'track' => array(),
    )
);

