<?php

/**
 * Issue SELECT command through adapter using name based container paramaterization
 */

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

//$table = new Zend\Db\TableGateway\TableGateway('artist', $adapter);

$where = new Zend\Db\Sql\Where();

$where->equalTo('id', 1)->OR->equalTo('id', 2);
$where->nest('OR')->like('name', 'Ralph%')->OR->greaterThanOrEqualTo('age', 30)->AND->lessThanOrEqualTo('age', 50);
$where->literal('foo = ?', 'bar');


$stmt = $adapter->createStatement();
$stmt->setSql('SELECT * FROM artist');
$where->prepareStatement($adapter, $stmt);
var_dump($stmt->getSql(), $stmt->getParameterContainer());
die();

$artists = $table->select($where);
var_dump($artists);
foreach ($artists as $artist) {
    //var_dump($artist->toArray());
}
