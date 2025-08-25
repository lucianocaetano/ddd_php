<?php

namespace Src\inventories\shared\event;

use Src\inventories\value_objects\Id;

/**
 * @package Src\inventories\shared\event
 *
 * The objective of this class is to provide an abstract class for other events
 */
abstract class BaseEvent
{

    /**
     * @param string $eventId
     * @param string $createdAt It is used to provide an automatic creation date.  
     */
    public function __construct(
        private string $eventId,
        private string $createdAt
    ) {
        $this->eventId = Id::randomId(); 
        $this->createdAt = (new \DateTimeImmutable())->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}

