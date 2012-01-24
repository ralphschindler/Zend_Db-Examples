<?php

/**
 * Issue SELECT command through adapter using positional based container paramaterization
 */

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

/* @var $adapter Zend\Db\Adapter */
$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(
    new Zend\Db\Adapter\DriverStatement\PositionalParameterContainer(1, array(2))
);

$row = $results->current();
$name = $row['name'];
assert_example_works($name == 'Bar Artist');