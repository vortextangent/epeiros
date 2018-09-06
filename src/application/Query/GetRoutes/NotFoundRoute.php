<?php

namespace Epeiros\Query;

use Epeiros\Factory;
use Epeiros\Http\GetRequest;
use Epeiros\Http\GetRoute;
use Epeiros\Http\ParameterCollection;

class NotFoundRoute extends GetRoute
{

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    protected function matches(GetRequest $request)
    {
        return true;
    }

    public function buildQuery(GetRequest $request)
    {
        $parameterCollection = ParameterCollection::fromArray([
            'status'  => "Not Found",
            'message' => 'Route Not Found',
            'data'    => ['route' => $request->getPath()],
        ]);

        return $this->factory->createNotFoundQuery($parameterCollection);
    }
}
