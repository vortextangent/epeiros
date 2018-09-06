<?php
namespace Epeiros\Http;

use Epeiros\ResultInterface;

interface Command
{
    /**
     * @return Response
     */
    public function execute();
}
