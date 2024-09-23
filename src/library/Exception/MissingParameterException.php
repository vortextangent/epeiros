<?php
declare(strict_types=1);

namespace Vortextangent\Epeiros\Library;

use Throwable;

class MissingParameterException extends \Vortextangent\Epeiros\Library\RuntimeException
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}