<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\Sql\Select,
    Zend\Db\ResultSet\ResultSet;

$select = new Select;
$select->from('artist')
    ->columns(array()) // no columns from main table
    ->join('album', 'artist.id = album.artist_id', array('title', 'release_date'))
    ->order(array('release_date', 'title'))
    ->where->like('artist.name', '%Brit%');

$statement = $adapter->createStatement();
$select->prepareStatement($adapter, $statement);

$resultSet = new ResultSet();
$resultSet->initialize($statement->execute());

$albums = array();
foreach ($resultSet as $row) {
    $albums[] = $row->title . ' released on: ' . date('Y-m-d', strtotime($row->release_date));
}

assert_example_works(
    $albums == array(
        0 => '...Baby One More Time released on: 1999-02-14',
        1 => 'Oops!... I Did It Again released on: 2000-10-10',
        2 => 'Britney released on: 2001-04-06',
        3 => 'Blackout released on: 2007-10-10',
        4 => 'Circus released on: 2008-11-23',
        5 => 'Femme Fatale released on: 2011-10-10',
        6 => 'In the Zone released on: 2011-10-10',
));
