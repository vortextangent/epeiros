<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Library\RoutingException;

class GetRequestHandler implements RequestHandler
{
    private GetRouter $getRouter;

    public function __construct(GetRouter $getRouter)
    {
        $this->getRouter = $getRouter;
    }

    /**
     * @throws RoutingException
     */
    public function handle(Request $request): Response
    {
        /** @var GetRequest $request */
        $route = $this->getRouter->route($request);

        $query = $route->buildQuery($request);

        return $query->execute();

    }
}
