<?php

/**
 * Issue SELECT command through adapter using array paramaterization (default)
 */

include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');

// $pdo = $adapter->getDriver()->getConnection()->connect()->getResource();
// $pdoS = $pdo->prepare('SELECT * FROM artist WHERE id = ?');
// $x = 1;
// $pdoS->bindParam(1, $x);
// $r = $pdoS->execute();
// // find count
// foreach ($pdoS as $y) {
//     var_dump($y);
// }


$statement = $adapter->query('SELECT * FROM artist WHERE id = ?');
$results = $statement->execute(array(2));



var_dump($results);

$count = count($results);
echo $count;
// assert_example_works($count == 1, true);
// 
// $name = $results[0]['name'];
// assert_example_works($name == 'Foo Artist', true);