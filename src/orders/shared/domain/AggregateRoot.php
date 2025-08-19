<?php

namespace Src\orders\shared\domain;

use Src\orders\shared\event\BaseEvent;

/**
 * @package Src\orders\shared\domain
 *
 * The objective of this class is to provide an abstract class for other aggregate roots so that they can dispatch domain events.
 */
abstract class AggregateRoot
{
    /**
     * @var BaseEvent[]
     */
    private array $recordedEvents = [];

    /**
     * This method is used to register new events
     *
     * @param object $event
     * @return void
     */
    protected function recordEvent(object $event): void
    {
        $this->recordedEvents[] = $event;
    }
    
    /**
     * This method is used to register new events
     *
     * @return BaseEvent[] 
     */
    public function pullDomainEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }
}

