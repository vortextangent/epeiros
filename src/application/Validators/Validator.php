<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\ResultInterface;

interface Validator
{
    /**
     * @return ResultInterface
     */
    public function validate();
}
