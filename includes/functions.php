<?php

function example_autoloader($class) {
    if (strpos($class, 'Zend\\') === 0) {
        include (defined('ZF2_PATH') ? rtrim(ZF2_PATH, '\/') . '/' : __DIR__ . '/../../') . 'library/' . str_replace('\\', '/', $class) . '.php';
    }
}

function assert_example_works($expression, $continue_if_true = false) {
    if ($expression) {
        if ($continue_if_true) {
            return;
        } else {
            echo 'It works!' . PHP_EOL;
            exit(0);
        }
    } else {
        echo 'It DOES NOT work!' . PHP_EOL;
        exit(0);
    }
}

/**
 * @param Zend\Db\Adapter\Adapter $adapter
 */
function refresh_data($adapter) {
    $platform = $adapter->getPlatform();
    $platformName = $platform->getName();
    $vendorData = include __DIR__ . '/../setup/vendor/' . str_replace(' ', '-', strtolower($platformName)) . '.php';

    try {
        foreach ($vendorData['data_down'] as $downSql) {
            $adapter->query(
                $downSql,
                $adapter::QUERY_MODE_EXECUTE
            );
        }

        foreach ($vendorData['data_up'] as $tableName => $tableData) {

            if ($tableData == null) {
                continue;
            }

            if (is_int($tableName) && is_string($tableData)) {
                $adapter->query(
                    $tableData,
                    $adapter::QUERY_MODE_EXECUTE
                );
                continue;
            }

            foreach ($tableData as $rowName => $rowData) {

                $keys = array_keys($rowData);
                $values = array_values($rowData);
                array_walk(
                    $keys,
                    function (&$key) use ($platform) {
                        $key = $platform->quoteIdentifier($key);
                    }
                );
                array_walk(
                    $values,
                    function (&$value) use ($platform) {
                        switch (gettype($value)) {
                            case 'NULL':
                                $value = 'NULL';
                                break;
                            case 'string':
                                $value = $platform->quoteValue($value);
                                break;
                        }
                    }
                );

                $insertSql = 'INSERT INTO ' . $platform->quoteIdentifier($tableName)
                    . ' (' . implode(', ', $keys) . ') '
                    . ' VALUES (' .
                        implode(', ',
                            $values
                        )
                    . ')';

                $adapter->query(
                    $insertSql,
                    $adapter::QUERY_MODE_EXECUTE
                );
            }
        }
    } catch (\Exception $e) {
        echo $e->getMessage();
        var_dump($e);
        exit(1);
    }

}
