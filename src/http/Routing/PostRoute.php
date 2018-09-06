<?php

namespace Epeiros\Http;

use Epeiros\Library\RoutingException;

abstract class PostRoute extends AbstractRoute implements Route
{
    /**
     * @var PostRoute
     */
    private $next;

    /**
     * @param PostRoute $route
     */
    public function setNext(PostRoute $route)
    {
        $this->next = $route;
    }

    /**
     * @param PostRequest $request
     * @return PostRoute
     * @throws RoutingException
     */
    final public function route(PostRequest $request)
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
     * @param PostRequest $request
     * @return bool
     */
    abstract protected function matches(PostRequest $request);

    /**
     * @param PostRequest $request
     * @return Command
     */
    abstract public function buildCommand(PostRequest $request);
}
