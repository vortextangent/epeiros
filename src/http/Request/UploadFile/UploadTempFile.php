<?php

namespace Epeiros\Http;

use Epeiros\Directory;
use Epeiros\File;
use Epeiros\FileName;

class UploadTempFile extends File
{
    public static function fromString($tempFilePath)
    {
        $pathParts = pathinfo($tempFilePath);

        $directory = new Directory($pathParts['dirname']);
        $fileName  = new FileName($pathParts['filename']);

        return new UploadTempFile($directory, $fileName);
    }
}
