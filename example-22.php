<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature\EventFeature;
use Zend\EventManager\EventManager;

$em = new EventManager;

$em->attach('Zend\Db\TableGateway\TableGateway.preInsert', function ($event) {
    /** @var $target TableGateway */
    $target = $event->getTarget();
    echo 'This is before Insert of the ' . get_class($target) . ' for table ' . $target->getTable() . PHP_EOL;
    echo 'With param names: ' . PHP_EOL;
    var_dump(array_keys($event->getParams()));
});

$em->attach('Zend\Db\TableGateway\TableGateway.postInsert', function ($event) {
    /** @var $target TableGateway */
    $target = $event->getTarget();
    echo 'This is after Insert of the ' . get_class($target) . ' for table ' . $target->getTable() . PHP_EOL;
    echo 'With params names: ' . PHP_EOL;
    var_dump(array_keys($event->getParams()));
});

$artistTable = new TableGateway('artist', $adapter, new EventFeature($em));
$artistTable->insert(array('name' => 'Foo Fighters'));


