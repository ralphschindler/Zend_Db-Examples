<?php

/**
 * Issue SELECT command through adapter using positional based container paramaterization
 */

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

/* @var $adapter Zend\Db\Adapter */
$artistTable = new Zend\Db\TableGateway\TableGateway('artist', $adapter);
$result = $artistTable->insert(array(
    'name' => 'New Artist',
    'history' => 'This is the history'
));

assert_example_works($result === 1, true);

$artistTable = new Zend\Db\TableGateway\TableGateway('artist', $adapter);
$rowset = $artistTable->select(array('id' => 3));
$row = $rowset->current();

$name = $row['name'];
assert_example_works($name == 'New Artist');