<?php

namespace Vortextangent\Epeiros;

use Throwable;
use Vortextangent\Epeiros\App\ApplicationState;
use Vortextangent\Epeiros\Http\ContentResponse;
use Vortextangent\Epeiros\Http\ErrorStatusHeader;
use Vortextangent\Epeiros\Http\JsonContent;
use Vortextangent\Epeiros\Http\Request;
use Vortextangent\Epeiros\Library\Exception;

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

            return $handler->handle($request);
        } catch (Exception $e) {
            //log and display 500 error page
            $logFile = __DIR__ . '/logs/eperios.application.log';
            $data = "[EXCEPTION] " . $e->getCode() . ': ' . $e->getMessage() .
                "\nTrace:" . $e->getTraceAsString() . "\n";
            file_put_contents($logFile, $data, FILE_APPEND);

            $content = json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);

            return new ContentResponse(new ErrorStatusHeader($e->getCode()), new JsonContent($content));
        }
    }
}
