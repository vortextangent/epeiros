<?php

namespace Vortextangent\Epeiros;

use Vortextangent\Epeiros\Http\JsonData;

class SuccessfulResult
{
    /**
     * @var JsonData
     */
    private $data;

    /**
     * @param JsonData $data
     */
    public function __construct(JsonData $data = null)
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isFailure()
    {
        return false;
    }

    /**
     * @return JsonData
     */
    public function data()
    {
        return $this->data;
    }
}
