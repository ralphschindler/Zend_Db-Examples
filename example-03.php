<?php

/**
 * Issue UPDATE command through adapter using array paramaterization (default)
 */
 
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

$qi = function($name) use ($adapter) { return $adapter->platform->quoteIdentifier($name); };
$fp = function($name) use ($adapter) { return $adapter->driver->formatParameterName($name); };

$sql = 'UPDATE ' . $qi('artist')
    . ' SET ' . $qi('name') . ' = ' . $fp('name')
    . ' WHERE ' . $qi('id') . ' = ' . $fp('id');

/* @var $statement Zend\Db\Adapter\DriverStatementInterface */
$statement = $adapter->query($sql);

$parameters = array(
    'name' => 'Updated Artist',
    'id' => 1
);

$statement->execute($parameters);

// DATA INSERTED, NOW CHECK

/* @var $statement Zend\Db\Adapter\DriverStatementInterface */
$statement = $adapter->query('SELECT * FROM '
    . $qi('artist')
    . ' WHERE id = ' . $fp('id'));

/* @var $results Zend\Db\ResultSet\ResultSet */
$results = $statement->execute(array('id' => 1));

$row = $results->current();
$name = $row['name'];
assert_example_works($name == 'Updated Artist');