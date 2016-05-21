<?php

namespace Jlndk\LaravelRealtime\Contracts;

interface EventMap {
    /**
     * Adds a new event to the EventMap
     * @param string $topic    The topic to subscribe to
     * @param string $callback The laravel event we should trigger
     * @param array  $options  Optional parameters
     */
    public function addEvent($topic, $callback, $options = array());

    /**
     * Returns an array with all registered events
     * @return array All the events
     */
    public function getEvents();
}


?>
