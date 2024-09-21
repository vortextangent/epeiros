<?php
declare(strict_types=1);

namespace Vortextangent\Epeiros\Library\Schema;

use PDO;

class SchemaLoader
{

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function table(string $table): array
    {
        list($schema, $table) = $this->getTableSchema($table);

        $statement = $this->db
            ->prepare('
            SELECT col.COLUMN_NAME, col.DATA_TYPE, col.COLUMN_TYPE, col.IS_NULLABLE, col.COLUMN_KEY,
                   kcu.REFERENCED_TABLE_NAME, kcu.REFERENCED_COLUMN_NAME
              FROM INFORMATION_SCHEMA.COLUMNS col
              LEFT JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu on col.TABLE_NAME = kcu.TABLE_NAME AND col.COLUMN_NAME = kcu.COLUMN_NAME AND kcu.REFERENCED_TABLE_NAME IS NOT NULL
             WHERE col.TABLE_SCHEMA = :schema
               AND col.TABLE_NAME  = :table
               ');
        $statement->execute([
            ':schema' => $schema,
            ':table' => $table
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tableKeys($table): array
    {
        [$table, $schema] = $this->getTableSchema($table);

        $statement = $this->db
            ->prepare('
            SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
              FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
             WHERE TABLE_SCHEMA = :schema
               AND TABLE_NAME  = :table
               ');
        $statement->execute([
            ':schema' => $schema,
            ':table' => $table
        ]);
    }

    private function getTableSchema(string $table): array
    {
        $tableConfig = explode('.', $table, 2);

        if (count($tableConfig) === 2) {
            $schema = $tableConfig[0];
            $table = $tableConfig[1];
        } else {
            $schema = $this->db->query('select database()')->fetchColumn();
        }
        return [$schema, $table];
    }
}