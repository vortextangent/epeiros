<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Library\RoutingException;

class PostRouter
{
    /**
     * @var PostRoute
     */
    private $first;

    /**
     * @var PostRoute
     */
    private $last;

    /**
     * @param PostRequest $request
     * @return PostRoute
     * @throws RoutingException
     */
    public function route(PostRequest $request)
    {
        $route = $this->first->route($request);

        return $route;
    }

    /**
     * @param PostRoute $route
     */
    public function add(PostRoute $route)
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
