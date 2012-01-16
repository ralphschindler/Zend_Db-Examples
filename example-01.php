<?php

/**
 * Issue SELECT command through adapter using array paramaterization (default)
 */

include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');

$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(array(1));

$count = count($results);
assert_example_works($count == 1, true);

$name = $results[0]['name'];
assert_example_works($name == 'Foo Artist', true);