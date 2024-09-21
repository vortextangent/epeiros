<?php
declare(strict_types=1);

namespace Vortextangent\Epeiros\Query\DescribeDatabase;

use Vortextangent\Epeiros\Factory;
use Vortextangent\Epeiros\Http\ContentResponse;
use Vortextangent\Epeiros\Http\GetRequest;
use Vortextangent\Epeiros\Http\JsonSerializableObject;
use Vortextangent\Epeiros\Http\OkStatusHeader;
use Vortextangent\Epeiros\Http\Query;
use Vortextangent\Epeiros\Http\Response;
use Vortextangent\Epeiros\Library\NotFoundInCollectionException;

class SchemaQuery implements Query
{

    //<editor-fold defaultstate="collapsed" desc="Properties">
    private Factory $factory;
    private GetRequest $request;

    //</editor-fold>

    public function __construct(Factory $factory, GetRequest $request)
    {
        $this->assertRequestIsValid($request);
        $this->factory = $factory;
        $this->request = $request;
    }

    /**
     * @throws NotFoundInCollectionException
     */
    public function execute(): Response
    {
        $table = $this->request->getParameterByName('table')->getValue();
        $repo = $this->factory->createDatabaseRepository();
        $schema = $repo->tableSchema($table);
        return new ContentResponse(new OkStatusHeader(), new JsonSerializableObject($schema));
    }

    private function assertRequestIsValid(GetRequest $request)
    {
        try {
            $this->request->getParameterByName('table');
        } catch (NotFoundInCollectionException $exception) {

        }
    }
}