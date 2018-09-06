<?php

namespace Epeiros\Events;

class SystemEvent implements Event
{
    /**
     * @var AggregateId
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    public function __construct(AggregateId $id, $type)
    {
        $this->id   = $id;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function belongsToAggregateType()
    {
        return "System";
    }

    /**
     * @return AggregateId
     */
    public function aggregateId()
    {
        return $this->id;
    }
}
