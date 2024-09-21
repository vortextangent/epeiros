<?php
declare(strict_types=1);

namespace Vortextangent\Epeiros\Library\Schema;

use JsonSerializable;

class Schema implements JsonSerializable
{
    private array $columns;

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function setColumns(array $columns): Schema
    {
        sort($columns);
        $this->columns = $columns;
        return $this;
    }


    public function jsonSerialize()
    {
        return [
            'columns' => $this->columns,
        ];
    }
}