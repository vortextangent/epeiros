<?php
declare(strict_types=1);

namespace Vortextangent\Epeiros\Query\DescribeDatabase;

use Vortextangent\Epeiros\Factory;
use Vortextangent\Epeiros\Http\GetRequest;
use Vortextangent\Epeiros\Http\GetRoute;
use Vortextangent\Epeiros\Http\Path;
use Vortextangent\Epeiros\Http\Query;

class SchemaRoute extends GetRoute
{
    private Path $url;
    private Factory $factory;

    public function __construct(Factory $factory)
    {
        $this->url = new Path('/schema');
        $this->factory = $factory;
    }

    protected function matches(GetRequest $request): bool
    {
        return $request->getPath()->equals($this->url);
    }

    public function buildQuery(GetRequest $request): Query
    {
        return new SchemaQuery($this->factory, $request);
    }
}