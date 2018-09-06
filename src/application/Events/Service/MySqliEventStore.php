<?php

namespace Epeiros\Events;

use Epeiros\Library\InvalidArgumentException;
use Epeiros\Library\RuntimeException;
use Epeiros\Library\UUID;
use mysqli;
use mysqli_stmt;

class MySqliEventStore implements EventStore
{
    /**
     * @var mysqli
     */
    private $mysqli;

    /**
     * @param mysqli $mysqli
     */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * @param  EventCollection
     * @return void
     */
    public function store(EventCollection $events)
    {
        $this->ensureEventsInCollectionAreInstanceOfEvent($events);
        $this->persistEvents($events);
    }

    /**
     * @todo retrieveAll All
     * @todo retrieveByEventId
     * @todo retrieveAllByEventType
     * @todo retrieveAllByAggregateIdAndEventType
     * @param AggregateId $aggregateId
     * @return EventCollection
     */
    public function retrieveAll(AggregateId $aggregateId)
    {
        $mysqliStmt = $this->prepareRetrieveStatement();
        $this->bindParamsToRetrieveStatement($aggregateId, $mysqliStmt);
        $this->execute($mysqliStmt);
        $events = $this->fetchResults($mysqliStmt);

        return EventCollection::fromArray($events);
    }

    /**
     * @param Event $event
     */
    private function persistInDB(Event $event)
    {
        $mysqliStmt      = $this->preparePersistStatement();
        $uuid            = UUID::generate();
        $aggregateId     = $event->aggregateId()->asString();
        $aggregateType   = $event->belongsToAggregateType();
        $eventId         = $uuid->asString();
        $eventType       = $event->type();
        $eventSerialized = serialize($event);
        $this->bindParamsToPersistStatment(
            $mysqliStmt,
            $eventType,
            $eventSerialized,
            $aggregateId,
            $aggregateType,
            $eventId
        );
        $this->execute($mysqliStmt);
    }

    /**
     * @param $mysqliStmt
     * @param $eventType
     * @param $eventSerialized
     * @param $aggregateId
     * @param $aggregateType
     * @param $eventId
     * @throws RuntimeException
     */
    private function bindParamsToPersistStatment(
        $mysqliStmt,
        $eventType,
        $eventSerialized,
        $aggregateId,
        $aggregateType,
        $eventId
    ) {
        if (!$mysqliStmt->bind_param(
            'sssss',
            $aggregateId,
            $aggregateType,
            $eventId,
            $eventType,
            $eventSerialized
        )
        ) {
            throw new RuntimeException(
                "Error on binding params to statement on line " . __LINE__ . " in " . __FILE__
            );
        }
    }

    /**
     * @param mysqli_stmt $mysqliStmt
     * @throws RuntimeException
     */
    private function execute(mysqli_stmt $mysqliStmt)
    {
        if (!$mysqliStmt->execute()) {
            throw new RuntimeException();
        }
    }

    /**
     * @return mysqli_stmt
     * @throws RuntimeException
     */
    private function preparePersistStatement()
    {
        $sql        = "INSERT INTO events (`aggregate_id`,`aggregate_type`, `event_id`, `event_type`, `event`) VALUES (?, ?, ?, ?, ?)";
        $mysqliStmt = $this->mysqli->prepare($sql);
        if (!$mysqliStmt instanceof mysqli_stmt) {
            throw new RuntimeException(
                "\nError on preparing statement on line " . __LINE__ . " in " . __FILE__
            );
        }

        return $mysqliStmt;
    }

    /**
     * @return mysqli_stmt
     * @throws RuntimeException
     */
    private function prepareRetrieveStatement()
    {
        $sql        = "SELECT event FROM events WHERE aggregate_id = ? ORDER BY id ASC";
        $mysqliStmt = $this->mysqli->prepare($sql);
        if (!$mysqliStmt instanceof \mysqli_stmt) {
            throw new RuntimeException("Error on preparing statement on line " . __LINE__ . " in " . __FILE__);
        }

        return $mysqliStmt;
    }

    /**
     * @param AggregateId $aggregateId
     * @param $mysqliStmt
     * @throws RuntimeException
     */
    private function bindParamsToRetrieveStatement(AggregateId $aggregateId, $mysqliStmt)
    {
        $aggregateId = $aggregateId->asString();
        if (!$mysqliStmt->bind_param(
            's',
            $aggregateId
        )
        ) {
            throw new RuntimeException(
                "Error on binding params to statement on line " . __LINE__ . " in " . __FILE__
            );
        }
    }

    /**
     * @param $mysqliStmt
     * @return array
     * @throws RuntimeException
     */
    private function fetchResults($mysqliStmt)
    {
        $result = $mysqliStmt->get_result();
        $events = [];
        while ($row = $result->fetch_object()) {
            $event = unserialize($row->event);
            if (!$event instanceof Event) {
                throw new RuntimeException("Unserialized event is  not an instance of Event");
            }
            $events[] = $event;
        }

        return $events;
    }

    /**
     * @param EventCollection $events
     * @throws InvalidArgumentException
     */
    private function ensureEventsInCollectionAreInstanceOfEvent(EventCollection $events)
    {
        foreach ($events as $event) {
            if (!$event instanceof Event) {
                throw new InvalidArgumentException();
            }
        }
    }

    /**
     * @param EventCollection $events
     */
    private function persistEvents(EventCollection $events)
    {
        foreach ($events as $event) {
            $this->persistInDB($event);
        }
    }
}
