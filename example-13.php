<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

$where = new Zend\Db\Sql\Where();
$where->equalTo('id', 1)->OR->equalTo('id', 2);
$where->OR
    ->NEST->like('name', 'Ralph%')->OR->greaterThanOrEqualTo('age', 30)->AND->lessThanOrEqualTo('age', 50)->UNNEST
    ->literal('foo = ?', 'bar');

$target =<<<EOS
SELECT "foo".* FROM "foo" WHERE "id" = '1' OR "id" = '2' OR ("name" LIKE 'Ralph%' OR "age" >= '30' AND "age" <= '50') AND foo = 'bar'
EOS;

$select = new Zend\Db\Sql\Select('foo');
$select->where($where);

assert_example_works($target == $select->getSqlString());