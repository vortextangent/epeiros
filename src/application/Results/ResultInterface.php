<?php

namespace Epeiros;

interface ResultInterface
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
