<?php

namespace Epeiros\Events;

class InMemoryEventStore implements EventStore
{
    /**
     * @var EventCollection
     */
    public $events;

    /**
     * InMemoryEventStore constructor.
     * @param EventCollection $events
     */
    public function __construct(EventCollection $events)
    {
        $this->events = $events;
    }

    /**
     * @param [] | EventCollection
     * @return mixed|void
     */
    public function store(EventCollection $events)
    {
        foreach ($events as $event) {
            $this->events->add($event);
        }
    }

    /**
     * @todo UUID
     * @param AggregateId
     * @return array
     */
    public function retrieveAll(AggregateId $aggregateId)
    {
        return $this->events->retrieveAllEventsForAggregate($aggregateId);
    }
}
