<?php

$adapter = include ((file_exists(__DIR__ . '/../bootstrap.php')) ? __DIR__ . '/../bootstrap.php' : __DIR__ . '/../bootstrap.dist.php');

$platform = $adapter->getPlatform()->getName();

$vendorData = include __DIR__ . '/vendor/' . str_replace(' ', '-', strtolower($platform)) . '.php';

try {
    foreach ($vendorData['schema_down'] as $schemaStmt) {
        try {
            $adapter->query($schemaStmt, $adapter::QUERY_MODE_EXECUTE);
        } catch (\Exception $e) {
            echo $schemaStmt . ' FAILED DUE TO ' . $e->getMessage() . PHP_EOL;
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage();
    exit(1);
}
