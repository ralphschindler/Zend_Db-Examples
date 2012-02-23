<?php

$adapter = include ((file_exists('bootstrap.php')) ? 'bootstrap.php' : 'bootstrap.dist.php');
refresh_data($adapter);

$metadata = new Zend\Db\Metadata\Metadata($adapter);

// get the table names
$tableNames = $metadata->getTableNames();


foreach ($tableNames as $tableName) {
    echo 'In Table ' . $tableName . PHP_EOL;

    $table = $metadata->getTable($tableName);


    echo '    With columns: ' . PHP_EOL;
    foreach ($table->getColumns() as $column) {
        echo '        ' . $column->getName()
            . ' -> ' . $column->getDataType()
            . PHP_EOL;
    }

    echo PHP_EOL;
    echo '    With constraints: ' . PHP_EOL;
    foreach ($metadata->getConstraints($tableName) as $constraint) {
        echo '        ' . $constraint->getName()
            . ' -> ' . $constraint->getType()
            . PHP_EOL;
        foreach ($constraint->getKeys() as $key) {
            echo '            column: ' . $constraint->getTableName() . '.'
                . $key->getColumnName();
            if ($constraint->isForeignKey()) {
                echo ' => ' . $key->getReferencedTableName()
                    . '.' . $key->getReferencedColumnName();
            }
            echo PHP_EOL;
        }

    }

    echo '----' . PHP_EOL;
}
