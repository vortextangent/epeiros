<?php

namespace Vortextangent\Epeiros\Http;

class ErrorStatusHeader implements StatusHeader
{
    private int $errorNumber;

    public function __construct(int $errorNumber)
    {

        $this->errorNumber = $errorNumber;
    }

    public function send()
    {
        header(sprintf(
            '%s %s',
            $_SERVER['SERVER_PROTOCOL'],
            $this->errorNumber
        ));
    }
}
