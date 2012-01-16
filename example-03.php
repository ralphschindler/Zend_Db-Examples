<?php

/**
 * Issue UPDATE command through adapter using array paramaterization (default)
 */
 
include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');

$statement = $adapter->query('UPDATE artist SET name = ? WHERE id = 1');
$return = $statement->execute(array('The Updated Artist Name');

assert_example_works($return == 1, true);

$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(array(1));

$count = count($results);
assert_example_works($count == 1, true);

$name = $results[0]['name'];
assert_example_works($name == 'The Updated Artist Name', true);