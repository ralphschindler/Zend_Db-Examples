<?php

/**
 * Issue SELECT command through adapter using name based container paramaterization
 */

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select;

$artistTable = new TableGateway('artist', $adapter);
$rowset = $artistTable->select(function (Select $select) {
    $select->where->like('name', 'Bar%');
});
$row = $rowset->current();

$name = $row['name'];
$name2 = $row->name;
assert_example_works($name == 'Bar Artist' && $name2 == 'Bar Artist');