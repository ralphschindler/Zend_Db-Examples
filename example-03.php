<?php

/**
 * Issue UPDATE command through adapter using array paramaterization (default)
 */
 
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');

$statement = $adapter->query('UPDATE artist SET name = ? WHERE id = 1');
$statement->execute(array('The Updated Artist Name'));

$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(array(1));
$row = $results->current();

$name = $row['name'];
assert_example_works($name == 'The Updated Artist Name');