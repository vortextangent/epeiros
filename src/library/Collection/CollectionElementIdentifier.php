<?php

namespace Epeiros\Library;

use JsonSerializable;

interface CollectionElementIdentifier extends JsonSerializable
{
    /**
     * @return string
     */
    public function __toString();
}
