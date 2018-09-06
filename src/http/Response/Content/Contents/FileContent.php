<?php

namespace Epeiros\Http;

use Epeiros\File;
use Epeiros\Library\RuntimeException;

class FileContent implements Content
{

    /**
     * @var File
     */
    private $file;

    /** @var string */
    private $fileMime;

    /**
     * FileContent constructor.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->ensureIsValidFile($file);

        $this->fileMime = $this->getFileMimeType($file);

        $this->file = $file;
    }

    /**
     * @param File $file
     *
     * @throws RuntimeException
     */
    private function ensureIsValidFile(File $file)
    {
        if ( ! $file->exists()) {
            throw new RuntimeException('The specified file does not exist.');
        }
    }

    /**
     * @param File $file
     *
     * @return string
     */
    private function getFileMimeType(File $file)
    {
        return mime_content_type($file->getFullFilePath());
    }

    /**
     * @throws RuntimeException
     */
    public function send()
    {
        $file = $this->file->getContents();

        header("Content-Type: {$this->fileMime}");
        header('Content-Length: ' . strlen($file));
        echo "\r\r";
        print $file;
    }
}
