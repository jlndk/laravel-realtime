<?php

namespace Jlndk\LaravelRealtime\Events;

use Jlndk\LaravelRealtime\Contracts\RealtimeEvent as RealtimeEventContract;

/**
 * A representation of the event sent from the realtime server to laravel
 */
class RealtimeEvent implements RealtimeEventContract {

    /**
     * The topic we should subscribe to
     * @var string
     */
    protected $topic = "";

    /**
     * The laravel event we should fire.
     * @var string|class
     */
    protected $callback;

    /**
     * Optional parameters
     * @var array
     */
    protected $options = array();

    /**
     * Creates a new RealtimeEvent instance
     * @param string        $topic    The topic we should subscribe to
     * @param string|class  $callback The laravel event we should fire.
     * @param array         $options  Optional parameters
     *
     * @return void
     */
    public function __construct($topic, $callback, $options = array())
    {
        $this->topic = $topic;
        $this->callback = $callback;
        $this->options = $options;
    }

    public function getTopic() {
        return $this->topic;
    }

    public function setTopic($topic) {
        $this->topic = $topic;
    }

    public function getCallback() {
        return $this->callback;
    }

    public function setCallback($callback) {
        $this->callback = $callback;
    }

    public function getOptions() {
        return $this->options;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    public static function FromArray($parameters) {
        return new static($parameters['topic'], $parameters['callback'], $parameters['options']);
    }
}

?>
