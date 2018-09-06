<?php

namespace Epeiros;

use Epeiros\Events\Event;
use Epeiros\Events\EventSerializer;

class Producer
{
    /**
     * @var \RdKafka\Producer
     */
    private $producer;

    /**
     * @var string
     */
    private $serviceName;

    /**
     * @var EventSerializer
     */
    private $eventSerializer;

    /**
     * @param string[] $brokers
     * @param string $serviceName
     * @param EventSerializer $eventSerializer
     */
    public function __construct($brokers, $serviceName, EventSerializer $eventSerializer)
    {
        $this->serviceName = $serviceName;
        $this->eventSerializer = $eventSerializer;

        $this->producer = new \RdKafka\Producer();

        $this->producer->setLogLevel(LOG_DEBUG);
        $this->producer->addBrokers(implode(", ", $brokers));
    }

    public function produce(Event $event)
    {
        /** @var \RdKafka\ProducerTopic $topic */
        $topic = $this->producer->newTopic($this->serviceName . "-" . $event->type());

        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $this->eventSerializer->serialize($event));
    }
}
