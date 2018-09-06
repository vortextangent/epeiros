<?php

namespace Epeiros\Http;

abstract class AbstractRoute
{
    /**
     * @return string
     */
    public function getType()
    {
        return get_class($this);
    }
}