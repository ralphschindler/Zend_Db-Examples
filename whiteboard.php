<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

// example here
$c = $adapter->driver->getConnection();
$r = $c->execute('SELECT * FROM "artist"');
var_dump($r);
