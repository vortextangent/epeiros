<?php

namespace Epeiros;

use PDO;

class DatabaseConnection
{

    private static $db;

    public static function getInstance(array $database)
    {
        if (null === static::$db) {
            $databaseConfiguration = new DatabaseConfiguration($database);
            $db                    = new PDO($databaseConfiguration->dsn(), $databaseConfiguration->user(),
                $databaseConfiguration->password(), $databaseConfiguration->options());
            // set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            static::$db = $db;
        }

        return static::$db;
    }
}
