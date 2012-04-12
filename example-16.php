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
    ->limit(2)->offset(0)
    ->where->like('artist.name', '%Brit%');

$statement = $adapter->createStatement();
$select->prepareStatement($adapter, $statement);

$resultSet = new ResultSet();

$container = $statement->getParameterContainer();
//var_dump($statement);

// as we iterate bind the new offset to the existing statement
foreach (array(0, 2, 4) as $offset) {

    $container->offsetSet('offset', $offset);
    $resultSet->setDataSource($statement->execute());

    $output = '';
    foreach ($resultSet->toArray() as $row) {
        $output .= '|' . $row['title'] . '|';
    }
//var_dump($output);
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
