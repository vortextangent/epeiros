<?php

namespace Epeiros;

use Epeiros\Events\EventSerializer;
use Epeiros\Events\MySqliEventStore;
use Epeiros\Http\GetRequestHandler;
use Epeiros\Http\GetRouter;
use Epeiros\Http\NullValidator;
use Epeiros\Http\ParameterCollection;
use Epeiros\Http\Path;
use Epeiros\Http\PostRequestHandler;
use Epeiros\Http\PostRouter;
use Epeiros\Http\Request;
use Epeiros\Http\RequestHandlerLocator;
use Epeiros\Http\Validator;
use Epeiros\Query\NotFoundQuery;
use Epeiros\Query\NotFoundRoute;
use Epeiros\Query\RedirectQuery;
use Epeiros\Query\TestQuery;
use Epeiros\Query\TestRoute;
use mysqli;

class Factory
{

    /**
     * @var AppConfig
     */
    private $config;

    /**
     * @param AppConfig $config
     */
    public function __construct(AppConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return mysqli
     */
    public function createDatabaseConnection()
    {
        return $this->config->database();
    }

    /**
     * @param $request
     *
     * @return Validator
     */
    public function createValidator(Request $request)
    {
        switch ($request->getPath()->asString()) {
            default:
                $validator = new NullValidator();
                break;
        }

        return $validator;
    }

    /**
     * @return RequestHandlerLocator
     */
    public function createRequestHandlerLocator()
    {
        return new RequestHandlerLocator($this);
    }

    public function createNotFoundQuery(ParameterCollection $parameters)
    {
        return new NotFoundQuery($parameters);
    }

    /**
     * @return Application
     */
    public function createApplication()
    {
        return new Application($this);
    }

    /**
     * @return NotFoundRoute
     */
    public function createNotFoundRoute()
    {
        return new NotFoundRoute($this);
    }

    /**
     * @param Path $path
     * @param ParameterCollection|null $parameters
     *
     * @return RedirectQuery
     */
    public function createRedirectQuery(
        Path $path,
        ParameterCollection $parameters = null
    ) {
        return new RedirectQuery($path, $parameters);
    }

    /**
     * @return RedirectQuery
     */
    public function createRedirectToNotFoundQuery()
    {
        return $this->createRedirectQuery(new Path('/error'));
    }

    public function createTestQuery() {
        return new TestQuery($this);
    }

    /**
     * @return MySqliEventStore
     */
    private function createMysqlEventStore()
    {
        return new MySqliEventStore($this->createDatabaseConnection());
    }

    /**
     * @param Request $request
     *
     * @return GetRequestHandler
     */
    public function createGetRequestHandler(Request $request)
    {
        return new GetRequestHandler($this->createGetRouter(), $this);
    }

    /**
     * @param Request $request
     *
     * @return PostRequestHandler
     */
    public function createPostRequestHandler(Request $request)
    {
        return new PostRequestHandler($this->createPostRouter(), $this);
    }

    /**
     * @return GetRouter
     */
    public function createGetRouter()
    {
        $router = new GetRouter;
        $router->add($this->createTestRoute());
        $router->add($this->createNotFoundRoute());

        return $router;
    }

    /**
     * @return PostRouter
     */
    public function createPostRouter()
    {
        $router = new PostRouter;

        return $router;
    }

    /**
     * @return Producer
     */
    private function createProducer()
    {
        return new Producer($this->config->kafkaBrokers(), $this->config->kafkaServiceName(), new EventSerializer());
    }

    private function createTestRoute()
    {
        return new TestRoute($this);
    }
}
