<?php

/**
 * Issue DELETE command through adapter using array paramaterization (default)
 */

include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');

$statement = $adapter->query('DELETE FROM artist WHERE id = 1');
$return = $statement->execute(array('The Updated Artist Name');

assert_example_works($return == 1, true);

$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(array(1));

$count = count($results);
assert_example_works($count == 0, true);
