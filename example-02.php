<?php

/**
 * Issue INSERT command through adapter using array paramaterization (default)
 */

/* @var Zend\Db\Adapter $adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

$qi = function($name) use ($adapter) { return $adapter->platform->quoteIdentifier($name); };
$fp = function($name) use ($adapter) { return $adapter->driver->formatParameterName($name); };

$sql = 'INSERT INTO '
    . $qi('artist')
    . ' (' . $qi('name') . ', ' . $qi('history') . ') VALUES ('
    . $fp('name') . ', ' . $fp('history') . ')';

/* @var $statement Zend\Db\Adapter\DriverStatement */
$statement = $adapter->query($sql);

$parameters = array(
    'name' => 'New Artist',
    'history' => 'This is the history'
);

$statement->execute($parameters);

// DATA INSERTED, NOW CHECK

/* @var $statement Zend\Db\Adapter\DriverStatement */
$statement = $adapter->query('SELECT * FROM '
    . $qi('artist')
    . ' WHERE id = ' . $fp('id'));

/* @var $results Zend\Db\ResultSet\ResultSet */
$results = $statement->execute(array('id' => 3));

$row = $results->current();
$name = $row['name'];
assert_example_works($name == 'New Artist');