<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Result;
use Vortextangent\Epeiros\SuccessfulResult;

class NullValidator implements Validator
{
    /**
     * @return SuccessfulResult
     */
    public function validate()
    {
        return Result::success();
    }
}
