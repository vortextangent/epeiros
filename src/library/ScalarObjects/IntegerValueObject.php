<?php

namespace Epeiros\Library;

class IntegerValueObject extends NumericValueObject
{
    private $int;

    public function __construct($int)
    {
        parent::__construct($int);
        $this->ensureIsInt($int);

        $this->int = $int;
    }

    private function ensureIsInt($int)
    {
        if (!is_int($int)) {
            throw new InvalidArgumentException(
                get_class($this) . " is expecting an integer value.  A " . gettype($int) . " ({$int}) was provided."
            );
        }
    }
}
