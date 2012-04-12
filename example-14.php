<?php

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select;

$artistTable = new TableGateway('artist', $adapter);
$rowset = $artistTable->select(function (Select $select) {
    $select->where->like('name', 'Link%');
});
$row = $rowset->current();

$name = $row['name'];
$name2 = $row->name;

assert_example_works($name == 'Linkin Park' && $name2 == 'Linkin Park');