<?php

namespace Vortextangent\Epeiros;

use Vortextangent\Epeiros\App\ApplicationState;
use Vortextangent\Epeiros\Http\Request;

class Application
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

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function run(Request $request)
    {
        try {

            $requestHandlerLocator = $this->factory->createRequestHandlerLocator();

            $handler = $requestHandlerLocator->locateHandler($request);

            $response = $handler->handle($request);

            return $response;
        } catch (\Exception $e) {
            //log and display 500 error page
            $logFile = __DIR__ . '/logs/eperios.application.log';
            $data    = "[EXCEPTION] " . $e->getCode() . ': ' . $e->getMessage() .
                       "\nTrace:" . $e->getTraceAsString() . "\n";
            file_put_contents($logFile, $data, FILE_APPEND);

            throw $e;
        }
    }
}
