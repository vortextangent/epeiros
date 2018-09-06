<?php

namespace Epeiros\Library;

abstract class AbstractIdentifier extends StringValueObject implements CollectionElementIdentifier
{
    function jsonSerialize()
    {
        return $this->asString();
    }
}
