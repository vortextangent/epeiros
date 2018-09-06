<?php

namespace Epeiros\Library;

abstract class StringValueObject
{
    /**
     * @var string
     */
    protected $string;

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->ensureIsString($string);

        $this->string = $string;
    }


    /**
     * @param $string
     * @throws InvalidArgumentException
     */
    protected function ensureIsString($string)
    {
        if (!is_string($string)) {
            throw new InvalidArgumentException(get_class() . " must be a string.");
        }
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->string;
    }

    /**
     * @param  StringValueObject $string
     * @return bool
     */
    public function equals(StringValueObject $string)
    {
        return ($this->asString() === $string->asString());
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }
}
