<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\Sql\Sql,
    Zend\Db\ResultSet\ResultSet;

$sql = new Sql($adapter);
$select = $sql->select();
$select->from('artist')
    ->columns(array()) // no columns from main table
    ->join('album', 'artist.id = album.artist_id', array('title', 'release_date'))
    ->order(array('release_date', 'title'))
    ->limit(2)->offset(0)
    ->where->like('artist.name', '%Brit%');

// prepare statement in a platform specific way
$statement = $sql->prepareStatementForSqlObject($select);
$container = $statement->getParameterContainer();

// create iterable result set
$resultSet = new ResultSet();

// as we iterate bind the new offset to the existing statement
foreach (array(0, 2, 4) as $offset) {

    $container->offsetSet('offset', $offset);
    $resultSet->initialize($statement->execute());

    $output = '';
    foreach ($resultSet->toArray() as $row) {
        $output .= '|' . $row['title'] . '|';
    }

    switch ($offset) {
        case 0:
            assert_example_works($output === '|...Baby One More Time||Oops!... I Did It Again|', true);
            break;
        case 2:
            assert_example_works($output === '|Britney||Blackout|', true);
            break;
        case 4:
            assert_example_works($output === '|Circus||Femme Fatale|');
            break;
    }
}
