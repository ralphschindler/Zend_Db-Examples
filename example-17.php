<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\TableGateway\Feature\FeatureSet,
    Zend\Db\TableGateway\Feature\RowGatewayFeature;

$artistTable = new TableGateway('artist', $adapter, new RowGatewayFeature('id'));

// also written as:
// $artistTable = new TableGateway('artist', $adapter, new FeatureSet(array(new RowGatewayFeature('id'))));

// also written as:
// $artistTable = new TableGateway('artist', $adapter, array(new RowGatewayFeature('id')));

$rows = $artistTable->select(array('id' => 2));
$rows->getDataSource()->buffer(); // buffer result set (only does something for mysqli)

/** @var $row \Zend\Db\RowGateway\RowGateway */
$row = $rows->current();

assert_example_works($row->name == 'Linkin Park' && $row instanceof \Zend\Db\RowGateway\RowGateway, true);

// update the row
$row['name'] = 'New Artist';
$row->save();

unset($row, $rows, $artistTable);


// ensure, separately, that that worked
$statement = $adapter->query('SELECT * FROM '
    . $adapter->platform->quoteIdentifier('artist')
    . ' WHERE id = ' . $adapter->driver->formatParameterName('id'));
$result = $statement->execute(array('id' => 2));
$row = $result->current();
assert_example_works($row['name'] == 'New Artist' && is_array($row));
