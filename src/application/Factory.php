<?php

namespace Vortextangent\Epeiros;

use PDO;
use Vortextangent\Epeiros\Events\EventSerializer;
use Vortextangent\Epeiros\Events\MySqliEventStore;
use Vortextangent\Epeiros\Http\GetRequestHandler;
use Vortextangent\Epeiros\Http\GetRouter;
use Vortextangent\Epeiros\Http\NullValidator;
use Vortextangent\Epeiros\Http\ParameterCollection;
use Vortextangent\Epeiros\Http\Path;
use Vortextangent\Epeiros\Http\PostRequestHandler;
use Vortextangent\Epeiros\Http\PostRouter;
use Vortextangent\Epeiros\Http\Request;
use Vortextangent\Epeiros\Http\RequestHandlerLocator;
use Vortextangent\Epeiros\Http\Validator;
use Vortextangent\Epeiros\Library\Schema\SchemaLoader;
use Vortextangent\Epeiros\Library\Schema\SchemaMapper;
use Vortextangent\Epeiros\Library\Schema\SchemaRepository;
use Vortextangent\Epeiros\Query\DescribeDatabase\SchemaRoute;
use Vortextangent\Epeiros\Query\NotFoundQuery;
use Vortextangent\Epeiros\Query\NotFoundRoute;
use Vortextangent\Epeiros\Query\TestQuery;
use Vortextangent\Epeiros\Query\TestRoute;

class Factory
{

    private AppConfig $config;

    public function __construct(AppConfig $config)
    {
        $this->config = $config;
    }

    public function createDatabaseRepository(): SchemaRepository
    {
        return new SchemaRepository($this->createSchemaMapper());
    }

    private function createDatabaseConnection(): PDO
    {
        return $this->config->database();
    }

    public function createValidator(Request $request): Validator
    {
        switch ($request->getPath()->asString()) {
            default:
                $validator = new NullValidator();
                break;
        }

        return $validator;
    }

    public function createRequestHandlerLocator(): RequestHandlerLocator
    {
        return new RequestHandlerLocator($this);
    }

    public function createNotFoundQuery(Path $path, ParameterCollection $parameters): NotFoundQuery
    {
        return new NotFoundQuery($path, $parameters);
    }

    public function createApplication(): Application
    {
        return new Application($this);
    }

    public function createNotFoundRoute(): NotFoundRoute
    {
        return new NotFoundRoute($this);
    }

    public function createTestQuery(): TestQuery
    {
        return new TestQuery($this);
    }

    private function createMysqlEventStore(): MySqliEventStore
    {
        return new MySqliEventStore($this->createDatabaseConnection());
    }

    public function createGetRequestHandler(Request $request): GetRequestHandler
    {
        return new GetRequestHandler($this->createGetRouter(), $this);
    }

    public function createPostRequestHandler(Request $request): PostRequestHandler
    {
        return new PostRequestHandler($this->createPostRouter(), $this);
    }

    public function createGetRouter(): GetRouter
    {
        $router = new GetRouter;
        $router->add($this->createTestRoute());
        $router->add($this->createSchemaRoute());

        // Last
        $router->add($this->createNotFoundRoute());

        return $router;
    }

    public function createPostRouter(): PostRouter
    {
        $router = new PostRouter;

        return $router;
    }

    private function createProducer(): Producer
    {
        return new Producer($this->config->kafkaBrokers(), $this->config->kafkaServiceName(), new EventSerializer());
    }

    private function createTestRoute()
    {
        return new TestRoute($this);
    }

    private function createSchemaRoute(): SchemaRoute
    {
        return new SchemaRoute($this);
    }

    private function createSchemaMapper(): SchemaMapper
    {
        return new SchemaMapper($this->createSchemaLoader());
    }

    private function createSchemaLoader(): SchemaLoader
    {
        return new SchemaLoader($this->createDatabaseConnection());
    }
}
