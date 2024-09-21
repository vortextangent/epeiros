<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Library\RoutingException;

abstract class GetRoute extends AbstractRoute implements Route
{
    private GetRoute $next;

    public function setNext(GetRoute $route)
    {
        $this->next = $route;
    }

    /**
     * @throws RoutingException
     */
    final public function route(GetRequest $request): GetRoute
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

    abstract protected function matches(GetRequest $request): bool;

    abstract public function buildQuery(GetRequest $request): Query;
}
