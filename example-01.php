<?php

/**
 * Issue SELECT command through adapter, using the driver and platform
 * to create completely portable SQL by hand.
 *
 * Currently tested against:
 *  Mysqli via MySQL
 *  Sqlite via PDO
 */

/* @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

// create completely portable SQL by hand
$sql = 'SELECT * FROM '
    . $adapter->platform->quoteIdentifier('artist')
    . ' WHERE ' . $adapter->platform->quoteIdentifier('id') . ' = ' . $adapter->driver->formatParameterName('id');

/* @var $statement \Zend\Db\Adapter\Driver\StatementInterface */
$statement = $adapter->query($sql);
$parameters = array('id' => 2);

/* @var $results Zend\Db\ResultSet\ResultSet */
$results = $statement->execute($parameters);

$row = $results->current();
$name = $row['name'];
assert_example_works($name == 'Linkin Park');