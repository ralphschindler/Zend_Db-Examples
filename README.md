README
======

Setup scripts:

* setup/up.php & setup/down.php

Examples:

1. SELECT through adapter using array based parameritized query
* INSERT through adapter using array based parameritized query
* UPDATE through adapter using array based parameritized query
* DELETE through adapter using array based parameritized query
* Demonstrate adapter exception handling
* SELECT through adapter using executed and quoted values
* SELECT through adapter using name based container paramaterization
* SELECT through adapter using positional based container paramaterization
* SELECT through adapter using paramaterization, iterating result as array values
* SELECT through adapter using paramaterization, iterating result as objects
* Retrieve metadata from the database in array/object format about tables, views, columns, constraints, triggers
* Display metadata from the database on CLI format about tables, views, columns, constraints, triggers
* Construct SELECT query via SQL builder as preparable and executable query, with values
* Construct INSERT query via SQL builder as preparable and executable query, with values
* Construct UPDATE query via SQL builder as preparable and executable query, with values
* Construct DELETE query via SQL builder as preparable and executable query, with values
* Construct SELECT query via SQL builder with predicates (IN, BETWEEN, ISNULL, LIKE, NOT, etc)
* Construct DDL CREATE TABLE via SQL builder
* Construct DDL ALTER TABLE via SQL builder
* Construct DDL DROP TABLE via SQL builder
* select() via TableGateway, retrieving data as array
* select() via TableGateway, retrieving data as object
* insert() via TableGateway
* update() via TableGateway
* delete() via TableGateway
* SELECT through adapter, retrieving rows as RowGatway objects, demonstrating interaction with columns
* SELECT through adapter, retrieving rows as RowGatway object, demonstrating save(), delete()
* select() via TableGateway, returning a RowGateway object
* more:
    * type casting (plugin)
    * logging
    * caching
    * blob support
    * profiling
    * limit/pagination
    * case folding?
    * charsets?