<?php

namespace Epeiros\Http;

use Epeiros\Result;
use Epeiros\SuccessfulResult;

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
