<?php

namespace Vortextangent\Epeiros\Query;

use Vortextangent\Epeiros\Http\ContentResponse;
use Vortextangent\Epeiros\Http\JsonContent;
use Vortextangent\Epeiros\Http\NotFoundStatusHeader;
use Vortextangent\Epeiros\Http\ParameterCollection;
use Vortextangent\Epeiros\Http\Path;
use Vortextangent\Epeiros\Http\Query;

class NotFoundQuery implements Query
{

    /**
     * @var ParameterCollection
     */
    private $parameters;
    private Path $path;

    /**
     * @param ParameterCollection $parameters
     */
    public function __construct(Path $path, ParameterCollection $parameters)
    {
        $this->parameters = $parameters;
        $this->path = $path;
    }

    public function execute()
    {
        $content = json_encode([
            'status' => 'not found',
            'message' => 'Route not found.',
            'data' => $this->path->asString()
        ]);
        $response = new ContentResponse(new NotFoundStatusHeader(), new JsonContent($content));

        return $response;
    }
}
