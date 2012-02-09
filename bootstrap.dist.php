<?php

namespace zf2bootstrap;

use Zend\Loader\StandardAutoloader as Autoloader,
    Zend\Db\Adapter\Adapter as DbAdapter;

// require_once 'includes/Zend_Db-2.0.0beta2.phar';

require_once '/path/to/ZF2/library/Zend/Loader/StandardAutoloader.php';
require_once './includes/functions.php';
$autoloader = new Autoloader;
$autoloader->register();

$dbconfig = array(

    // Sqlite Configuration
    'type' => 'Pdo',
    'dsn' => 'sqlite:' . __DIR__ . '/tmp/sqlite.db',

    // Mysql Configuration
    // 'type'     => 'Mysqli',
    // 'username' => '',
    // 'password' => '',
    // 'database' => ''

);

$adapter = new DbAdapter($dbconfig);
