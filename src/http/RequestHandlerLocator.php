<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Factory;
use Vortextangent\Epeiros\Library\RuntimeException;

class RequestHandlerLocator
{

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(
        Factory $factory
    ) {
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     *
     * @return RequestHandler
     * @throws RuntimeException
     */
    public function locateHandler(Request $request)
    {
        if ($request->isGetRequest()) {
            /** @var GetRequest $request */
            $handler = $this->factory->createGetRequestHandler($request);
        } elseif ($request->isPostRequest()) {
            /** @var PostRequest $request */
            $handler = $this->factory->createPostRequestHandler($request);
        } else {
            throw new RuntimeException('Cannot handle request');
        }

        return $handler;
    }
}
