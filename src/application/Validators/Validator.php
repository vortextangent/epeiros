<?php

namespace Epeiros\Http;

use Epeiros\ResultInterface;

interface Validator
{
    /**
     * @return ResultInterface
     */
    public function validate();
}
