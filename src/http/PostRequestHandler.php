<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\AccessController;
use Vortextangent\Epeiros\Factory;
use Vortextangent\Epeiros\Library\RoutingException;

class PostRequestHandler implements RequestHandler
{

    /**
     * @var PostRouter
     */
    private $postRouter;

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param PostRouter $postRouter
     * @param Factory $factory
     */
    public function __construct(
        PostRouter $postRouter,
        Factory $factory
    ) {
        $this->postRouter = $postRouter;
        $this->factory    = $factory;
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @throws RoutingException
     */
    public function handle(Request $request)
    {
        /** @var PostRequest $request */
        $route = $this->postRouter->route($request);

        $validator        = $this->factory->createValidator($request);
        $validationResult = $validator->validate();

        if ($validationResult->isSuccess()) {
            $command = $route->buildCommand($request);

            // TODO Replace this with a return type declaration
            if ( ! $command instanceof Command) {
                throw new RoutingException('Route did not return a Command object');
            }

            return $command->execute();

        }
    }
}
