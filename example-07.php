<?php

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

/* @var $adapter Zend\Db\Adapter */
$artistTable = new Zend\Db\TableGateway\TableGateway('artist', $adapter);
$result = $artistTable->insert(array(
    'name' => 'New Artist',
    'history' => 'This is the history'
));

$id = $artistTable->getLastInsertValue();

if ($id == null && $adapter->getPlatform()->getName() == 'PostgreSQL') {
    $id = $adapter->getDriver()->getConnection()->getLastGeneratedValue('artist_id_seq');
}

assert_example_works($result === 1, true);

$artistTable = new Zend\Db\TableGateway\TableGateway('artist', $adapter);
$rowset = $artistTable->select(array('id' => $id));
$row = $rowset->current();

$name = $row['name'];
assert_example_works($name == 'New Artist');