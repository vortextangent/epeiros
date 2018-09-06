<?php

namespace Epeiros\Query;

use Epeiros\Factory;
use Epeiros\Http\GetRequest;
use Epeiros\Http\GetRoute;
use Epeiros\Http\Path;

class TestRoute extends GetRoute
{

    /**
     * @var Factory
     */
    private $factory;
    /**
     * @var Path
     */
    private $url;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->url     = new Path('');
        $this->factory = $factory;
    }

    /**
     * @param GetRequest $request
     *
     * @return bool
     */
    protected function matches(GetRequest $request)
    {
        return $request->getPath()->equals($this->url);
    }

    /**
     * @param GetRequest $request
     *
     * @return TestQuery
     */
    public function buildQuery(GetRequest $request)
    {
        return $this->factory->createTestQuery();
    }
}
