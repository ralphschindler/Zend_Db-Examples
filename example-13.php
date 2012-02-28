<?php

/**
 * Issue SELECT command through adapter using name based container paramaterization
 */

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

$sql = new Zend\Db\Sql\Select;
$sql->from('foo');
$sql->where(array('id > ?' => 2));
echo $sql->getSqlString($adapter->getPlatform());