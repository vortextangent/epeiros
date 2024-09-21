<?php

namespace Vortextangent\Epeiros\Query;

use Vortextangent\Epeiros\Factory;
use Vortextangent\Epeiros\Http\GetRequest;
use Vortextangent\Epeiros\Http\GetRoute;
use Vortextangent\Epeiros\Http\ParameterCollection;
use Vortextangent\Epeiros\Http\Query;

class NotFoundRoute extends GetRoute
{
    private Factory $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    protected function matches(GetRequest $request): bool
    {
        return true;
    }

    public function buildQuery(GetRequest $request): Query
    {
        $parameterCollection = ParameterCollection::fromArray([
            'status' => "Not Found",
            'message' => 'Route Not Found',
        ]);

        return $this->factory->createNotFoundQuery($request->getPath(), $parameterCollection);
    }
}
