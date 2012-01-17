<?php

include ((file_exists(__DIR__ . '/../bootstrap.php')) ? __DIR__ . '/../bootstrap.php' : __DIR__ . '/../bootstrap.dist.php');

$platform = $adapter->getPlatform()->getName();
$schemas = include __DIR__ . '/schema/' . strtolower($platform) . '-up.php';



try {
    foreach ($schemas as $schemaStmt) {
        $adapter->query($schemaStmt, $adapter::QUERY_MODE_EXECUTE);
    }
} catch (\Exception $e) {
    echo 'Problem with ' . $schemaStmt;
    var_dump($e);
}