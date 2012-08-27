<?php

/* @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);
$adapter->getQueryResultSetPrototype()->buffer(); // default ResultSet is Zend\Db\ResultSet\ResultSet

$resultSet = $adapter->query(
    'SELECT * FROM ' . $adapter->platform->quoteIdentifier('artist'),
    $adapter::QUERY_MODE_EXECUTE
);

foreach ($resultSet as $i => $row) {
    echo $i . ': ' . $row['name'] . PHP_EOL;
}
echo PHP_EOL;
foreach ($resultSet as $i => $row) {
    echo $i . ': ' . $row['name'] . PHP_EOL;
}
