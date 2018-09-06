<?php

namespace Epeiros\Http;

use Epeiros\FileName;
use Epeiros\Filesize;
use Epeiros\Library\AbstractCollection;
use Epeiros\Library\NotFoundInCollectionException;
use Epeiros\Library\RuntimeException;

class UploadFileCollection extends AbstractCollection
{
    /**
     * @param array $files
     * @throws RuntimeException
     * @return UploadFileCollection
     */
    public static function fromArray($files)
    {
        $collection = new self;

        foreach ($files as $name => $fileInfo) {
            $statusCode = new UploadFileStatusCode($fileInfo['error']);

            if ($statusCode->isSystemError()) {
                throw new RuntimeException($statusCode->errorAsString());
            }

            $fileName = new FileName($fileInfo['name']);

            $fileType = null;
            $tempFile = null;
            $filesize = null;
            if ($statusCode->fileWasUploaded()) {
                $fileType = new UploadFileType($fileInfo['type']);
                $tempFile = UploadTempFile::fromString($fileInfo['tmp_name']);
                $filesize = new Filesize($fileInfo['size']);
            }

            $uploadFile = new UploadFile($fileName, $statusCode, $fileType, $tempFile, $filesize);

            $collection->add(
                new Parameter(
                    new ParameterIdentifier($name),
                    $uploadFile
                )
            );
        }

        return $collection;
    }

    /**
     * @param Parameter $parameter
     */
    public function add(Parameter $parameter)
    {
        $this->elements[$parameter->getIdentifier()->asString()] = $parameter;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasUploadFile($name)
    {
        return $this->hasElementByIdentifier(new ParameterIdentifier($name));
    }

    /**
     * @param string $name
     * @throws NotFoundInCollectionException
     * @return UploadFile
     */
    public function getUploadFile($name)
    {
        if (!$this->hasUploadFile($name)) {
            throw new NotFoundInCollectionException('There is no upload file named:' . $name);
        }

        return $this->getElementByIdentifier(new ParameterIdentifier($name))->getValue();
    }
}
