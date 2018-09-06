<?php

namespace Epeiros\Http;

use Epeiros\Library\RoutingException;

abstract class GetRoute extends AbstractRoute implements Route
{
    /**
     * @var GetRoute
     */
    private $next;

    /**
     * @param GetRoute $route
     */
    public function setNext(GetRoute $route)
    {
        $this->next = $route;
    }

    /**
     * @param GetRequest $request
     * @return GetRoute
     * @throws RoutingException
     */
    final public function route(GetRequest $request)
    {
        if (!$this->matches($request)) {
            if ($this->next === null) {
                throw new RoutingException(
                    'No route matched the request'
                );
            }

            return $this->next->route($request);
        }

        return $this;
    }

    /**
     * @param GetRequest $request
     * @return bool
     */
    abstract protected function matches(GetRequest $request);

    /**
     * @param GetRequest $request
     * @return Query
     */
    abstract public function buildQuery(GetRequest $request);
}
