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
        /** @var $constraint Zend\Db\Metadata\Object\ConstraintObject */
        echo '        ' . $constraint->getName()
            . ' -> ' . $constraint->getType()
            . PHP_EOL;
        if (!$constraint->hasColumns()) {
            continue;
        }
        echo '            column: ' . implode(', ', $constraint->getColumns());
        if ($constraint->isForeignKey()) {
            $fkCols = array();
            foreach ($constraint->getReferencedColumns() as $refColumn) {
                $fkCols[] = $constraint->getReferencedTableName() . '.' . $refColumn;
            }
            echo ' => ' . implode(', ', $fkCols);
        }
        echo PHP_EOL;

    }

    echo '----' . PHP_EOL;
}
