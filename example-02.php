<?php

/**
 * Issue INSERT command through adapter using array paramaterization (default)
 */
 
include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');

$statement = $adapter->query('INSERT INTO artist (name, history) VALUES (?, ?)');
$return = $statement->execute(array('New Artist', 'This is the history'));

assert_example_works($return == 1, true);

$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(array(3));

$count = count($results);
assert_example_works($count == 1, true);

$name = $results[0]['name'];
assert_example_works($name == 'New Artist', true);