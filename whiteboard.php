<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);


$sql = new Zend\Db\Sql\Sql($adapter);
$select = $sql->select('album');

$select->columns(array(
    'aid' => new Zend\Db\Sql\Expression('DISTINCT artist_id') //, 'artist_id', array(Zend\Db\Sql\Expression::TYPE_IDENTIFIER))
));

$stmt = $sql->prepareStatementForSqlObject($select);
$result = $stmt->execute();
foreach ($result as $row) {
    var_dump($row);
}

