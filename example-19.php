<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\Sql;
use Zend\Db\ResultSet\ResultSet;

$sql = new Sql\Sql($adapter);

$subselect = $sql->select();
$subselect->from('artist')
    ->columns(array()) // no columns from main table
    ->join('album', 'artist.id = album.artist_id', array('title', 'release_date'))
    //->order(array('release_date', 'title'))
    ->where->like('artist.name', '%Brit%');

$select = $sql->select();
$select->from(array('t' => $subselect))->columns(array('c' => new Sql\Expression('COUNT(1)')));

$statement = $sql->prepareStatementForSqlObject($select);

$result = $statement->execute();
$row = $result->current();

assert_example_works($row['c'] == 7);
