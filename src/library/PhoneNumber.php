<?php

namespace Vortextangent\Epeiros\Library;

class PhoneNumber
{
    /**
     * @var string
     */
    private $numberString;

    /**
     * @param string $numberString
     */
    public function __construct($numberString)
    {
        $numberString = $this->removeDashes($numberString);

        $this->ensureIsTenCharacters($numberString);
        $this->ensureAllNumericCharacters($numberString);

        $this->numberString = $numberString;
    }

    /**
     * @param $numberString
     * @return mixed
     */
    private function removeDashes($numberString)
    {
        return str_replace("-", "", $numberString);
    }

    /**
     * @param $numberString
     * @throws InvalidArgumentException
     */
    private function ensureIsTenCharacters($numberString)
    {
        if (strlen($numberString) !== 10) {
            throw new InvalidArgumentException('Phone number must be 10 characters');
        }
    }

    /**
     * @param $numberString
     * @throws InvalidArgumentException
     */
    private function ensureAllNumericCharacters($numberString)
    {
        if (!ctype_digit($numberString)) {
            throw new InvalidArgumentException('Phone number can only contain numeric characters');
        }
    }

    /**
     * @return string
     */
    public function asStringWithDashes()
    {
        return substr($this->numberString, 0, 3) . '-' .
               substr($this->numberString, 3, 3) . '-' .
               substr($this->numberString, 6);
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->numberString;
    }

    /**
     * @param PhoneNumber $number
     * @return bool
     */
    public function equals(PhoneNumber $number)
    {
        if ($this->asString() === $number->asString()) {
            return true;
        }

        return false;
    }
}
