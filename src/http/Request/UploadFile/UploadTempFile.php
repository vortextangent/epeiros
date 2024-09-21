<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Directory;
use Vortextangent\Epeiros\File;
use Vortextangent\Epeiros\FileName;

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
