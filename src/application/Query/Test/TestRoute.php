<?php

namespace Vortextangent\Epeiros\Query;

use Vortextangent\Epeiros\Factory;
use Vortextangent\Epeiros\Http\GetRequest;
use Vortextangent\Epeiros\Http\GetRoute;
use Vortextangent\Epeiros\Http\Path;
use Vortextangent\Epeiros\Http\Query;

class TestRoute extends GetRoute
{

    private Factory $factory;
    private Path $url;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->url = new Path('');
        $this->factory = $factory;
    }

    protected function matches(GetRequest $request): bool
    {
        return $request->getPath()->equals($this->url);
    }

    public function buildQuery(GetRequest $request): Query
    {
        return $this->factory->createTestQuery();
    }
}
