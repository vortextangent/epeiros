<?php

namespace Epeiros\Query;

use Epeiros\Factory;
use Epeiros\Http\ContentResponse;
use Epeiros\Http\JsonContent;
use Epeiros\Http\OkStatusHeader;
use Epeiros\Http\Query;
use Epeiros\Http\Response;

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

    /**
     * @return Response
     */
    public function execute()
    {
        $content  = json_encode([
            'status'  => 'ok',
            'message' => 'Hello World.',
        ]);
        return new ContentResponse(new OkStatusHeader(), new JsonContent($content));
    }
}