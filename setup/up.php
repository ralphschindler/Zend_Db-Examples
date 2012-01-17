<?php

include ((file_exists(__DIR__ . '/../bootstrap.php')) ? __DIR__ . '/../bootstrap.php' : __DIR__ . '/../bootstrap.dist.php');

$platform = $adapter->getPlatform()->getName();

$downSchemas = include __DIR__ . '/schema/' . strtolower($platform) . '-down.php';
$upSchemas = include __DIR__ . '/schema/' . strtolower($platform) . '-up.php';
$datas   = include __DIR__ . '/data/data.php';

try {
    foreach ($downSchemas as $schemaStmt) {
        $adapter->query($schemaStmt, $adapter::QUERY_MODE_EXECUTE);
    }
} catch (\Exception $e) {
    echo 'Problem with ' . $schemaStmt;
    var_dump($e);
}

try {
    foreach ($upSchemas as $schemaStmt) {
        $adapter->query($schemaStmt, $adapter::QUERY_MODE_EXECUTE);
    }
} catch (\Exception $e) {
    echo 'Problem with ' . $schemaStmt;
    var_dump($e);
}

try {
    foreach ($datas as $tableName => $tableData) {
        foreach ($tableData as $rowName => $rowData) {

            $keys = array_keys($rowData);
            $values = array_values($rowData);
            array_walk(
                $values,
                function (&$value) {
                    $value = ($value == null) ? 'NULL' : '\'' . $value . '\'';
                }
            );
            $adapter->query(
                'INSERT INTO ' . $tableName
                    . ' (' . implode(', ', $keys) . ') '
                    . ' VALUES (' .
                        implode(', ',
                            $values
                        )
                    . ');',
                $adapter::QUERY_MODE_EXECUTE
            );
        }
    }
} catch (\Exception $e) {
    echo 'Problem with ' . $schemaStmt;
    var_dump($e);
}
