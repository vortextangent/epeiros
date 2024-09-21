<?php

namespace Vortextangent\Epeiros;

use Vortextangent\Epeiros\Library\InvalidPathException;
use Vortextangent\Epeiros\Library\InvalidArgumentException;

class Directory
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->ensureDirectoryIsString($directory);
        $directory = $this->ensureSlashAtEndOfPath($directory);
        $this->ensureDirectoryExists($directory);

        //TODO: figure out if we want to ensure readable or writable
        //TODO: do we want to allow relative directories or make everything absolute

        $this->directory = $directory;
    }

    /**
     * @param $directory
     * @throws InvalidArgumentException
     */
    private function ensureDirectoryIsString($directory)
    {
        if (!is_string($directory)) {
            throw new InvalidArgumentException('This directory is not a string');
        }
    }

    /**
     * @param $directory
     * @return string
     */
    private function ensureSlashAtEndOfPath($directory)
    {
        if (!(substr($directory, -1) == '/')) {
            return $directory . '/';
        }

        return $directory;
    }

    /**
     * @param $directory
     * @throws InvalidPathException
     */
    private function ensureDirectoryExists($directory)
    {
        if (!is_dir($directory)) {
            throw new InvalidPathException(sprintf("The directory '%s' does not exist.", $directory));
        }
    }

    /**
     * @param FileName $fileName
     * @return File
     */
    public function file(FileName $fileName)
    {
        return new File($this, $fileName);
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->directory;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->directory;
    }
}
