<?php

namespace Epeiros\Query;

use Epeiros\Http\ContentResponse;
use Epeiros\Http\JsonContent;
use Epeiros\Http\NotFoundStatusHeader;
use Epeiros\Http\ParameterCollection;
use Epeiros\Http\Query;

class NotFoundQuery implements Query
{

    /**
     * @var ParameterCollection
     */
    private $parameters;

    /**
     * @param ParameterCollection $parameters
     */
    public function __construct(ParameterCollection $parameters)
    {
        $this->parameters = $parameters;
    }

    public function execute()
    {
        $content  = json_encode([
            'status'  => 'not found',
            'message' => 'Route not found.',
        ]);
        $response = new ContentResponse(new NotFoundStatusHeader(), new JsonContent($content));

        return $response;
    }
}
