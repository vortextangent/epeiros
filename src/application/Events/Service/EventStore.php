<?php

namespace Epeiros\Events;

interface EventStore
{
    /**
     * @param [] | EventCollection
     * @return mixed
     */
    public function store(EventCollection $events);

    /**
     * @param AggregateId $projectId
     * @return mixed
     */
    public function retrieveAll(AggregateId $projectId);
}
