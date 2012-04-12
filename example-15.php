<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\Sql\Select,
    Zend\Db\ResultSet\ResultSet;

$select = new Select;
$select->from('artist')
    ->join('album', 'artist.id = album.artist_id')
    ->where->like('artist.name', 'Brit%');

$statment = $adapter->createStatement();
$select->prepareStatement($adapter, $statment);

$resultSet = new ResultSet();
$resultSet->setDataSource($statment->execute());

$albums = array();
foreach ($resultSet as $row) {
    $albums[] = $row->title;
}

assert_example_works(
    $albums == array(
        0 => '...Baby One More Time',
        1 => 'Oops!... I Did It Again',
        2 => 'Britney',
        3 => 'In the Zone',
        4 => 'Blackout',
        5 => 'Circus',
        6 => 'Femme Fatale',
));
