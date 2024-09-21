<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Library\RoutingException;

class GetRouter
{
    /**
     * @var GetRoute
     */
    private $first;

    /**
     * @var GetRoute
     */
    private $last;

    /**
     * @param GetRequest $request
     * @return GetRoute
     * @throws RoutingException
     */
    public function route(GetRequest $request)
    {
        $route = $this->first->route($request);

        return $route;
    }

    /**
     * @param GetRoute $route
     */
    public function add(GetRoute $route)
    {
        if ($this->first === null) {
            $this->first = $route;
        }

        if ($this->last !== null) {
            $this->last->setNext($route);
        }

        $this->last = $route;
    }
}
