<?php

namespace Epeiros\Http;

use Epeiros\Library\InvalidArgumentException;

class UploadFileStatusCode
{
    /**
     * @var array
     */
    private $systemErrors = [
        UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.'
    ];

    /**
     * @var array
     */
    private $validationErrors = [
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        UPLOAD_ERR_PARTIAL   => 'The uploaded file was only partially uploaded.',
        UPLOAD_ERR_NO_FILE   => 'No file was uploaded.'
    ];

    /**
     * @var int
     */
    private $code;

    /**
     * @param int $code
     */
    public function __construct($code)
    {
        $this->ensureIsInteger($code);

        $this->ensureIsValidStatusCode($code);

        $this->code = $code;
    }

    /**
     * @param int $code
     * @throws InvalidArgumentException
     */
    protected function ensureIsInteger($code)
    {
        if (!is_int($code)) {
            throw new InvalidArgumentException('Upload file status code must be an integer.');
        }
    }

    /**
     * @param int $code
     * @throws InvalidArgumentException
     */
    protected function ensureIsValidStatusCode($code)
    {
        if ($code < 0 || $code > 8) {
            throw new InvalidArgumentException('Upload file status code must be between 0 and 8.');
        }
    }

    /**
     * @return int
     */
    public function code()
    {
        return $this->code;
    }

    /**
     * @return bool
     */
    public function fileWasUploaded()
    {
        if ($this->code === UPLOAD_ERR_OK) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isSystemError()
    {
        if (in_array($this->code, array_keys($this->systemErrors))) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isValidationError()
    {
        if (in_array($this->code, array_keys($this->validationErrors))) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function fileIsTooLarge()
    {
        if ($this->code === UPLOAD_ERR_FORM_SIZE || $this->code === UPLOAD_ERR_INI_SIZE) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function fileWasPartiallyUploaded()
    {
        if ($this->code === UPLOAD_ERR_PARTIAL) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function errorAsString()
    {
        $allErrorCodes = $this->systemErrors + $this->validationErrors;

        return $allErrorCodes[$this->code];
    }
}
