<?php
declare(strict_types=1);

namespace Vortextangent\Epeiros\Library\Schema;

class SchemaMapper
{
    private SchemaLoader $loader;

    public function __construct(SchemaLoader $loader)
    {
        $this->loader = $loader;
    }

    private function map(array $tableArray): Schema
    {
        $tableSchema = new Schema();
        $tableSchema->setColumns(array_column($tableArray,'COLUMN_NAME'));
        return $tableSchema;
    }

    public function table(string $table): Schema
    {
        $tableArray = $this->loader->table($table);
        return $this->map($tableArray);
    }


}