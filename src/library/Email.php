<?php

namespace Epeiros\Library;

class Email
{
    /**
     * @var string
     */
    private $address;

    /**
     * @param string $address
     */
    public function __construct($address)
    {
        $this->ensureIsValidEmailFormat($address);

        $this->address = $address;
    }

    /**
     * @param string $address
     * @throws InvalidArgumentException
     */
    private function ensureIsValidEmailFormat($address)
    {
        if (filter_var($address, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Invalid email address format.');
        }
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }
}
