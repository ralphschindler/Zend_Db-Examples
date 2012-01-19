<?php

return array(
    'data_up' => array(
        'artist' => array(
            array(
                'id' => 1,
                'name' => 'Foo Arist',
                'history' => null,
            ),
            array(
                'id' => 2,
                'name' => 'Bar Artist',
                'history' => null,
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
                'added_on'  => '2010-11-11'
            ),
        ),
        'genre' => array(
            array(
                'id' => 1,
                'parent_id' => null,
                'name' => 'Rock & Roll'
            ),
            array(
                'id' => 2,
                'parent_id' => null,
                'name' => 'Hip-hop'
            )
        )
    )
);