<?php

namespace Vortextangent\Epeiros;

use Vortextangent\Epeiros\Library\InvalidArgumentException;

class Filesize
{
    /**
     * @var int
     */
    private $sizeInBytes;

    /**
     * @param int $sizeInBytes
     */
    public function __construct($sizeInBytes)
    {
        $this->ensureIsInteger($sizeInBytes);

        $this->ensureIsPositive($sizeInBytes);

        $this->sizeInBytes = $sizeInBytes;
    }

    /**
     * @param int $sizeInBytes
     * @throws InvalidArgumentException
     */
    protected function ensureIsInteger($sizeInBytes)
    {
        if (!is_int($sizeInBytes)) {
            throw new InvalidArgumentException('File size must be an integer.');
        }
    }

    /**
     * @param int $sizeInBytes
     * @throws InvalidArgumentException
     */
    protected function ensureIsPositive($sizeInBytes)
    {
        if ($sizeInBytes < 0) {
            throw new InvalidArgumentException('Filesize must be positive.');
        }
    }

    /**
     * @return int
     */
    public function sizeInBytes()
    {
        return $this->sizeInBytes;
    }
}
