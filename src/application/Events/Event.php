<?php

namespace Vortextangent\Epeiros\Events;

interface Event
{
    /**
     * @return string
     */
    public function type();

    /**
     * @return string
     */
    public function belongsToAggregateType();

    /**
     * @return AggregateId
     */
    public function aggregateId(): AggregateId;
}
