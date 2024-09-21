<?php

namespace Vortextangent\Epeiros\Library;

use JsonSerializable;

interface CollectionElement extends JsonSerializable
{

    /**
     * @return CollectionElementIdentifier
     */
    public function getIdentifier();
}
