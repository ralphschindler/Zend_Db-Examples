<?php

/** @var $adapter Zend\Db\Adapter\Adapter */
$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature\EventFeature;
use Zend\EventManager as EM;


// Use Static Event Manager, with multiple identifiers

class ArtistTable extends TableGateway {} // force the AritstTable identifier to be registered
$artistTable = new ArtistTable('artist', $adapter, new EventFeature());

$sem = EM\StaticEventManager::getInstance();

$sem->attach('ArtistTable', 'preInsert', function ($event) {
    /** @var $target TableGateway */
    $target = $event->getTarget();
    echo 'This is before Insert of the ' . get_class($target) . ' for table ' . $target->getTable() . PHP_EOL;
    echo 'With param names: ' . PHP_EOL;
    var_dump(array_keys($event->getParams()));
});

$sem->attach('Zend\Db\TableGateway\TableGateway', 'postInsert', function ($event) {
    /** @var $target TableGateway */
    $target = $event->getTarget();
    echo 'This is after Insert of the ' . get_class($target) . ' for table ' . $target->getTable() . PHP_EOL;
    echo 'With params names: ' . PHP_EOL;
    var_dump(array_keys($event->getParams()));
});

$artistTable->insert(array('name' => 'Foo Fighters'));


// USE Non-static Event Manager

$em = new EM\EventManager;
$artistTable = new TableGateway('artist', $adapter, new EventFeature($em));

$em->attach('preDelete', function ($event) {
    /** @var $target TableGateway */
    $target = $event->getTarget();
    echo 'This is before Delete of the ' . get_class($target) . ' for table ' . $target->getTable() . PHP_EOL;
    echo 'With param names: ' . PHP_EOL;
    var_dump(array_keys($event->getParams()));
});

$em->attach('postDelete', function ($event) {
    /** @var $target TableGateway */
    $target = $event->getTarget();
    echo 'This is after Delete of the ' . get_class($target) . ' for table ' . $target->getTable() . PHP_EOL;
    echo 'With params names: ' . PHP_EOL;
    var_dump(array_keys($event->getParams()));
});

$artistTable->delete(array('name' => 'Foo Fighters'));

// @todo Currently incomplete as this needs to implement assert_works()