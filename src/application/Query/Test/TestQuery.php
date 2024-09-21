<?php

namespace Vortextangent\Epeiros\Query;

use Vortextangent\Epeiros\Factory;
use Vortextangent\Epeiros\Http\ContentResponse;
use Vortextangent\Epeiros\Http\JsonContent;
use Vortextangent\Epeiros\Http\OkStatusHeader;
use Vortextangent\Epeiros\Http\Query;
use Vortextangent\Epeiros\Http\Response;

class TestQuery implements Query
{

    //<editor-fold defaultstate="collapsed" desc="Properties">
    //</editor-fold>
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

    public function execute(): Response
    {
        $content = json_encode([
            'status' => 'ok',
            'message' => 'Hello World.',
        ]);
        return new ContentResponse(new OkStatusHeader(), new JsonContent($content));
    }
}