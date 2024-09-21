<?php

namespace Vortextangent\Epeiros\Http;

use JsonSerializable;

class JsonSerializableObject extends JsonContent
{
    public function __construct(JsonSerializable $object)
    {
        parent::__construct(json_encode($object));
    }
}
