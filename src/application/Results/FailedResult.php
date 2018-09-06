<?php

namespace Epeiros;

use Epeiros\Http\JsonData;
use Epeiros\Http\JsonError;

class FailedResult
{
    /**
     * @var JsonError
     */
    private $error;

    /**
     * @var JsonData
     */
    private $data;

    public function __construct(JsonError $error, JsonData $data = null)
    {
        $this->error = $error;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isFailure()
    {
        return true;
    }

    /**
     * @return JsonError
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * @return JsonData
     */
    public function data()
    {
        return $this->data;
    }
}
