<?php

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');

$di = new Zend\Di\Di();
$di->configure(new Zend\Di\Configuration(array(
    'instance' => array(
        'Zend\Db\Adapter\Adapter' => array(
            'parameters' => array(
                'driver' => $dbconfig
            )
        )
    )
)));

//var_dump($di->instanceManager());
$db = $di->get('Zend\Db\Adapter\Adapter');

echo $db->platform->getName() . PHP_EOL;
