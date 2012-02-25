<?php

namespace zf2bootstrap;

use Zend\Loader\StandardAutoloader as Autoloader,
    Zend\Db\Adapter\Adapter as DbAdapter;

require_once './includes/functions.php';

include 'Zend_Db-2.0.0dev.phar';

//require_once '/path/to/ZF2/library/Zend/Loader/StandardAutoloader.php';
//$autoloader = new Autoloader;
//$autoloader->register();

$dbconfig = array(

    // Sqlite Configuration
    'driver' => 'Pdo',
    'dsn' => 'sqlite:' . __DIR__ . '/tmp/sqlite.db',

    // Mysqli Configuration
    //'driver'     => 'Mysqli',
    //'hostname' => 'localhost',
    //'username' => 'developer',
    //'password' => 'developer',
    //'database' => 'zend_db_example',
    //'table_type' => 'InnoDB'

    // Sqlsrv Configuration
    //'driver' => 'Sqlsrv',
    //'hostname' => 'MYHOSTNAME-PC\SQLEXPRESS',
    //'UID' => 'developer',
    //'PWD' => 'developer',
    //'Database' => 'zend_db_example'

);

return new DbAdapter($dbconfig);
