<?php

namespace Epeiros\Http;

interface ValidationResult
{
    /**
     * @return bool
     */
    public function isSuccess();

    /**
     * @return bool
     */
    public function isFailure();
}
