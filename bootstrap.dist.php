<?php

namespace zf2bootstrap;

// require_once 'includes/Zend_Db-2.0.0beta2.phar';

require_once '/path/to/ZF2/library/Zend/Loader/StandardAutoloader.php';
require_once './includes/functions.php';
$autoloader = new \Zend\Loader\StandardAutoloader;
spl_autoload_register(array($autoloader, 'autoload'));

$dbconfig = array(
    'driver' => array(
        'type' => 'Pdo',
        'connectionParams' => array(
            'dsn' => 'sqlite:' . __DIR__ . '/tmp/sqlite.db'
        )
    ),
    'platform' => 'Sqlite'
    
    // 'mysql' => array( // other options: hostname, port, table_type
    //         'username' => '',
    //         'password' => '',
    //         'database' => ''
    //     ),
    
    // 'mssql' => array(
    //         'username' => '',
    //         'password' => '',
    //         'database' => ''
    //     ),
    
    // 'oracle' => array(
    //         'username' => '',
    //         'password' => '',
    //         'database' => ''
    //     ),
    
    // 'ibmdb2' => array(
    //         'username' => '',
    //         'password' => '',
    //         'database' => ''
    //     ),
    
);

$adapter = new \Zend\Db\Adapter($dbconfig);
