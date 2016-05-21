<?php

namespace Jlndk\LaravelRealtime\Events;

use Jlndk\LaravelRealtime\Contracts\EventMap as EventMapContract;

/**
 * An index over all the events we should subscribe to and handle
 */
class EventMap implements EventMapContract
{
    /**
     * All the events
     * @var array
     */
    protected $events = array();

    /**
     * @inheritdoc
     */
    public function addEvent($topic, $callback, $options = array()) {
        $this->events[] = new RealtimeEvent($topic, $callback, $options);
    }

    /**
     * @inheritdoc
     */
    public function getEvents() {
        return $this->events;
    }
}


?>
