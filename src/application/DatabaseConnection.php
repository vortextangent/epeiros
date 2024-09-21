<?php

namespace Vortextangent\Epeiros;

use PDO;

class DatabaseConnection
{

    private static ?PDO $db = null;

    public static function getInstance(array $database): PDO
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
