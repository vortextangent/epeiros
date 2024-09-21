<?php
namespace Vortextangent\Epeiros\Events;

use Vortextangent\Epeiros\Library\AbstractCollection;

class EventCollection extends AbstractCollection
{
    /**
     * @param array $events
     *
     * @return EventCollection
     */
    public static function fromArray(array $events)
    {
        $eventCollection = new self;

        foreach ($events as $event) {
            if ($event instanceof Event) {
                $eventCollection->add($event);
            };
        }

        return $eventCollection;
    }

    /**
     * @param Event $event
     */
    public function add(Event $event)
    {
        $this->elements[] = $event;
    }

    /**
     * @param AggregateId $aggregateId
     * @return EventCollection
     */
    public function retrieveAllEventsForAggregate(AggregateId $aggregateId)
    {
        $projectEvents = array_filter(
            $this->elements,
            function ($event) use ($aggregateId) {
                /** @var Event $event */
                return $event->aggregateId()->equals($aggregateId);
            }
        );

        return self::fromArray($projectEvents);
    }

    /**
     * @return Event[]
     */
    public function retrieveAllEvents()
    {
        return $this->elements;
    }

    /**
     * @param EventCollection $events
     * @return mixed|void
     */
    public function store($events)
    {
        foreach ($events as $event) {
            $this->add($event);
        }
    }

    public function isEmpty()
    {
        return empty($this->elements);
    }
}
