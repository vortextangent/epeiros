<?php
namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\ResultInterface;

interface Command
{
    /**
     * @return Response
     */
    public function execute();
}
