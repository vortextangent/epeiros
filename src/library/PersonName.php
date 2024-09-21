<?php

namespace Vortextangent\Epeiros\Library;

class PersonName
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($firstName, $lastName)
    {
        $this->ensureIsString($firstName);
        $this->firstName = $firstName;

        $this->ensureIsString($lastName);
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function firstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function lastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function fullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @param $name
     * @throws InvalidArgumentException
     */
    private function ensureIsString($name)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException(sprintf("Name expects a string. '%s' given.", (string) $name));
        }
    }

    /**
     * @param PersonName $name
     * @return bool
     */
    public function equals(PersonName $name)
    {
        return $this->fullName() == $name->fullName();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->fullName();
    }
}
