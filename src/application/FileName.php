<?php

namespace Vortextangent\Epeiros;

use Vortextangent\Epeiros\Library\InvalidArgumentException;

class FileName
{
    /**
     * @var string
     */
    private $base;

    /**
     * @var string
     */
    private $extension;

    /**
     * @param string $base
     * @param string $extension
     */
    public function __construct($base, $extension = '')
    {
        $this->ensureIsString($base);
        $this->ensureIsString($extension);
        $this->base      = $base;
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param $value
     * @throws InvalidArgumentException
     */
    private function ensureIsString($value)
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException($value);
        }
    }

    /**
     * @return string
     */
    public function asString()
    {
        $fileName = $this->getBase();

        if (!empty($this->getExtension())) {
            $fileName .= "." . $this->getExtension();
        }

        return $fileName;
    }
}
