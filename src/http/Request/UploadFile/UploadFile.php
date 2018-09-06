<?php

namespace Epeiros\Http;

use Epeiros\Directory;
use Epeiros\File;
use Epeiros\FileName;
use Epeiros\Filesize;
use Epeiros\Library\RuntimeException;

class UploadFile
{
    /**
     * @var FileName
     */
    private $fileName;

    /**
     * @var UploadFileStatusCode
     */
    private $statusCode;

    /**
     * @var UploadFileType
     */
    private $fileType;

    /**
     * @var File
     */
    private $uploadTempFile;

    /**
     * @var Filesize
     */
    private $filesize;

    /**
     * @param FileName $fileName
     * @param UploadFileStatusCode $statusCode
     * @param UploadFileType $fileType
     * @param UploadTempFile $uploadTempFile
     * @param Filesize $filesize
     */
    public function __construct(
        FileName $fileName,
        UploadFileStatusCode $statusCode,
        UploadFileType $fileType = null,
        UploadTempFile $uploadTempFile = null,
        Filesize $filesize = null
    ) {
        $this->fileName       = $fileName;
        $this->statusCode     = $statusCode;
        $this->fileType       = $fileType;
        $this->uploadTempFile = $uploadTempFile;
        $this->filesize       = $filesize;
    }

    /**
     * @param Directory $toDirectory
     * @throws RuntimeException
     */
    public function save(Directory $toDirectory)
    {
        $uploadFile = new File($toDirectory, $this->fileName);

        $this->uploadTempFile->moveTo($uploadFile);
    }

    /**
     * @return UploadFileStatusCode
     */
    public function statusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return UploadTempFile
     */
    public function tempFile()
    {
        return $this->uploadTempFile;
    }

    /**
     * @param FileName $fileName
     */
    public function updateFileName(FileName $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return FileName
     */
    public function fileName()
    {
        return $this->fileName;
    }
}
