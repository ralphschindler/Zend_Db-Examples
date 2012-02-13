README
======

Introduction
------------

This repository show's off Zend\Db's feature-set via a simple schema and simple tasks.  The schema's are located in `setup/vendor` and are tailored to setup a scheme in a vendor specific way.  So, the first thing you'll need to do is run the setup scripts.  If you decide you want to run them against something other than Sqlite, first copy the bootstrap and setup the proper credentials.

Setup:
------

First, you'll need to 

    setup/up.php

If you want to run against something other than Sqlite, copy the bootstrap, then fill out the credentials in the appropriate section:

    cp bootstrap.dist.php bootstrap.php
    < < edit bootstrap.php > >
    
To destroy a schema

    setup/down.php


Examples:
---------

1 - 4. (working) SELECT, INSERT, UPDATE, DELETE through adapter using array based parameritized query.  These scripts are utilizing the Adapter and Platform API's to produce vendor agnostic queries.

    php example-01.php
    php example-02.php
    php example-03.php
    php example-04.php
    
5\. Demonstrate adapter exception handling (not working.)

    n/a

6 - 9. TableGateway examples showing basic select(), insert(), update(), and delete().

    php example-06.php
    php example-07.php
    php example-08.php
    php example-09.php

Unpacking the Phar:
-------------------

Currently, this master repository is using an up to date phar of just Zend_Db.  To extract these files for usage, use the phar.phar utility:

    phar.phar extract -f Zend_Db-2.0.0dev.phar
    
Linking to your checked out code:

    cp bootstrap.dist.php bootstrap.php

edit bootstrap with:

    // include 'Zend_Db-2.0.0dev.phar';
    require_once '/path/to/ZF2/library/Zend/Loader/StandardAutoloader.php';
    $autoloader = new Autoloader;
    $autoloader->register();
    
