<?php

/**
 * Issue SELECT command through adapter using name based container paramaterization
 */

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

/* @var $adapter Zend\Db\Adapter */
$statement = $adapter->query('SELECT * FROM artist WHERE id = :id');
$results = $statement->execute(array('id' => 2));

$row = $results->current();
$name = $row['name'];
assert_example_works($name == 'Bar Artist');