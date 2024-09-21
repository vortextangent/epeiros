<?php
declare(strict_types=1);

namespace Vortextangent\Epeiros\Library\Schema;


class SchemaRepository
{
    private SchemaMapper $mapper;

    public function __construct(SchemaMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function tableSchema(string $table): Schema
    {
        return $this->mapper->table($table);
    }


}