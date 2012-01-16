<?php

namespace zf2bootstrap;

// require_once 'includes/Zend_Db-2.0.0beta2.phar';

require_once '/path/to/ZF2/library/Zend/Loader/StandardAutoloader.php';
$autoloader = new \Zend\Loader\StandardAutoloader;
spl_autoload_register(array($autoloader, 'autoload'));

$dbconfig = array(

    'sqlite' => array(
        'database' => __DIR__ . '/tmp/sqlite.db'
    ),
    
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

$adapter = new \Zend\Db\Adpater($dbConfig['mysql']);

function assert_example_works($expression, $continue_if_true) {
    if ($expression) {
        if ($continue_if_true) {
            return;
        } else {
            echo 'It works!';
            exit(0);
        }
    } else {
        echo 'It DOES NOT work!';
        exit(0);
    }
}
