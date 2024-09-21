<?php

namespace Vortextangent\Epeiros;

use finfo;
use Vortextangent\Epeiros\Library\RuntimeException;

class File
{
    /**
     * @var finfo
     */
    private $fileInfo;

    /**
     * @var Directory
     */
    private $directory;

    /**
     * @var FileName
     */
    private $fileName;

    /**
     * @param Directory $directory
     * @param FileName $fileName
     */
    public function __construct(Directory $directory, FileName $fileName)
    {
        $this->fileInfo = new finfo(FILEINFO_MIME_TYPE);

        $this->directory = $directory;
        $this->fileName  = $fileName;
    }

    /**
     * @return Directory
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @return FileName
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getFullFilePath()
    {
        return $this->getDirectory()->asString() . $this->getFileName()->asString();
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getFullFilePath());
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    public function getContents()
    {
        if (!$this->exists()) {
            throw new RuntimeException("Specified file ({$this->getFullFilePath()}) is missing.");
        }

        return file_get_contents($this->getFullFilePath());
    }

    /**
     * @param $fileContents
     */
    public function save($fileContents)
    {
        file_put_contents($this->getFullFilePath(), $fileContents);
    }

    public function unlink()
    {
        unlink($this->getFullFilePath());
    }

    /**
     * @return string
     */
    public function getFileType()
    {
        return $this->fileInfo->file($this->getFullFilePath());
    }

    /**
     * @param File $file
     * @throws RuntimeException
     */
    public function moveTo(File $file)
    {
        if (@rename($this->getFullFilePath(), $file->getFullFilePath()) === false) {
            throw new RuntimeException(
                sprintf('Unable to move %s to %s', $this->getFullFilePath(), $file->getFullFilePath())
            );
        }

        $this->fileName  = $file->getFileName();
        $this->directory = $file->getDirectory();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getDirectory() . $this->getFileName()->asString();
    }
}
