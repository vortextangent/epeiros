<?php
declare(strict_types=1);

namespace Vortextangent\Epeiros\Http;

class ErrorResponse extends AbstractResponse
{
    private \Throwable $error;

    public function __construct(\Throwable $error)
    {
        $this->error = $error;
    }

    protected function doSend()
    {
        header(sprintf('HTTP/1.1 %s', $this->error->getCode()));
        header('Content-Type: application/json');

        print $this->error->getMessage();
    }
}