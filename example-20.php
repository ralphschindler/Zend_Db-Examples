<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\Sql;
use Zend\Db\ResultSet\ResultSet;

$sql = new Sql\Sql($adapter);

$subselect = $sql->select();
$subselect->from('artist')
    ->columns(array('name'))
    ->join('album', 'artist.id = album.artist_id', array())
    ->where->greaterThan('release_date', '2005-01-01');


$select = $sql->select();
$select->from('artist')
    ->order(array('name' => Sql\Select::ORDER_ASCENDING))
    ->where
        ->like('name', 'L%')
        ->AND->in('name', $subselect);

$statement = $sql->prepareStatementForSqlObject($select);

$result = $statement->execute();

$rows = array_values(iterator_to_array($result));

assert_example_works(
    count($rows) == 2
    && $rows[0]['name'] == 'Lady Gaga'
    && $rows[1]['name'] == 'Linkin Park'
);
