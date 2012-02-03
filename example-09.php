<?php

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

/* @var $adapter Zend\Db\Adapter */
$artistTable = new Zend\Db\TableGateway\TableGateway('artist', $adapter);
$result = $artistTable->delete(array('id' => 2));

assert_example_works($result === 1, true);

$artistTable = new Zend\Db\TableGateway\TableGateway('artist', $adapter);
$rowset = $artistTable->select(array('id' => 2));
$row = $rowset->current();

assert_example_works($row == false);
