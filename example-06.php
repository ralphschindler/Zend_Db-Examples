<?php

/**
 * Issue SELECT command through adapter using name based container paramaterization
 */

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

$artistTable = new Zend\Db\TableGateway\TableGateway('artist', $adapter);
$rowset = $artistTable->select(array('id' => 2));
$row = $rowset->current();

$name = $row['name'];
$name2 = $row->name;
assert_example_works($name == 'Linkin Park' && $name2 == 'Linkin Park');