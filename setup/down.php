<?php

$adapter = include ((file_exists(__DIR__ . '/../bootstrap.php')) ? __DIR__ . '/../bootstrap.php' : __DIR__ . '/../bootstrap.dist.php');

$platform = $adapter->getPlatform()->getName();

$vendorData = include __DIR__ . '/vendor/' . strtolower($platform) . '.php';

try {
    foreach ($vendorData['schema_down'] as $schemaStmt) {
        $adapter->query($schemaStmt, $adapter::QUERY_MODE_EXECUTE);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
    exit(1);
}
