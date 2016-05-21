<?php

namespace Jlndk\LaravelRealtime\Contracts;

interface RealtimeEvent
{
    /**
     * Returns the topic
     * @return string   The topic
     */
    public function getTopic();

    /**
     * Sets the topic
     * @param string    $topic  The topic
     */
    public function setTopic($topic);

    /**
     * Returns the callback
     * @return string   The callback
     */
    public function getCallback();


    /**
     * Sets the callback
     * @param string    $topic  The callback
     */
    public function setCallback($callback);

    /**
     * Returns the options
     * @return string   The options
     */
    public function getOptions();

    /**
     * Sets the options
     * @param string    $topic  The options
     */
    public function setOptions($options);

    /**
     * Creates a new RealtimeEvent from an array of parameters
     * @param array $parameters An array containing topic, callback and options
     */
    public static function FromArray($parameters);
}

?>
