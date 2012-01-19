<?php

/**
 * Issue INSERT command through adapter using array paramaterization (default)
 */

/* @var Zend\Db\Adapter $adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

$statement = $adapter->query('INSERT INTO artist (name, history) VALUES (?, ?)');
$statement->execute(array('New Artist', 'This is the history'));

$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(array(3));
$row = $results->current();

$name = $row['name'];
assert_example_works($name == 'New Artist');