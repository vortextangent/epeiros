<?php

namespace Epeiros\Http;

use Epeiros\Factory;
use Epeiros\Library\RoutingException;

class GetRequestHandler implements RequestHandler
{

    /**
     * @var GetRouter
     */
    private $getRouter;

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param GetRouter $getRouter
     * @param Factory $factory
     */
    public function __construct(
        GetRouter $getRouter,
        Factory $factory
    ) {
        $this->getRouter = $getRouter;
        $this->factory   = $factory;
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @throws \Epeiros\Library\RoutingException
     */
    public function handle(Request $request)
    {
        /** @var GetRequest $request */
        $route = $this->getRouter->route($request);

        $query = $route->buildQuery($request);

        // TODO Replace this with a return type declaration
        if ( ! $query instanceof Query) {
            throw new RoutingException('Route did not return a Query object');
        }

        return $query->execute();

    }
}
