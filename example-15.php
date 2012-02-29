<?php


/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\Sql\Select,
    Zend\Db\ResultSet\ResultSet;

$select = new Select;
$select->from('artist')
    ->join('album', 'artist.id = album.artist_id')
    ->where->like('artist.name', 'Foo%');

$statment = $adapter->createStatement();
$select->prepareStatement($adapter, $statment);

$resultSet = new ResultSet();
$resultSet->setDataSource($statment->execute());

$albums = array();
foreach ($resultSet as $row) {
    $albums[] = $row->title;
}

assert_example_works($albums == array('Foos First Album', 'Foos Second Album'));
