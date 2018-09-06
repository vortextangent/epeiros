<?php

namespace Epeiros\Query;

use Epeiros\Http\ParameterCollection;
use Epeiros\Http\Path;
use Epeiros\Http\Query;
use Epeiros\Http\RedirectResponse;
use Epeiros\Http\Response;

class RedirectQuery implements Query
{
    /**
     * @var Path
     */
    private $path;

    /**
     * @var ParameterCollection
     */
    private $parameters;

    /**
     * @param Path $path
     * @param ParameterCollection $parameters
     */
    public function __construct(Path $path, ParameterCollection $parameters = null)
    {
        $this->path       = $path;
        $this->parameters = $parameters;
    }

    /**
     * @return Response
     */
    public function execute()
    {
        $parametersUrlString = '';
        if ($this->parameters !== null) {
            $parametersUrlString = $this->parameters->asUrlString();
        }
        return new RedirectResponse(new Path($this->path->asString() . $parametersUrlString));
    }
}
