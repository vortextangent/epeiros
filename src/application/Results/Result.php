<?php

namespace Vortextangent\Epeiros;

use Vortextangent\Epeiros\Http\JsonData;
use Vortextangent\Epeiros\Http\JsonError;

abstract class Result
{
    /**
     * @param JsonData|null $jsonData
     * @return SuccessfulResult
     */
    public static function success(JsonData $jsonData = null)
    {
        return new SuccessfulResult($jsonData);
    }

    /**
     * @param JsonError $error
     * @param JsonData|null $jsonData
     * @return FailedResult
     */
    public static function failure(JsonError $error, JsonData $jsonData = null)
    {
        return new FailedResult($error, $jsonData);
    }
}
