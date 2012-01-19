<?php

/**
 * Issue DELETE command through adapter using array paramaterization (default)
 */

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');

$statement = $adapter->query('DELETE FROM artist WHERE id = 1');
$statement->execute();

$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(array(1));

$row = $results->current();

assert_example_works($row === false);
