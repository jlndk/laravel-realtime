<?php

namespace Jlndk\LaravelRealtime\Events;

/**
 * Adds the ability to inject data into an event
 */
trait CanHaveData
{
    protected $data = array();

    /**
     * Is called when data is set in the event.
     * Can be used by the event to manage data.
     * @param  array $data  The data which is added
     * @return void
     */
    function onSetData($data) {
        //The event can overwrite this method
    }

    /**
     * Returns the data
     * @return array The data
     */
    function getData() {
        return $this->data;
    }

    /**
     * Updates the data in the event
     * @param array $data The data, which is added
     */
    function setData($data)
    {
        $this->data = $data;

        $this->onSetData($data);
    }
}


?>
