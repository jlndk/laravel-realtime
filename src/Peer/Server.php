<?php

namespace Jlndk\LaravelRealtime\Peer;

use Jlndk\LaravelRealtime\Contracts\EventMap as EventMapContract;
use Thruway\Peer\Client;

use Illuminate\Foundation\Application;

/**
 * Class InternalClient.
 */
class Server extends Client
{
    protected $events;

    protected $app;

    /**
     * Constructor.
     */
    public function __construct(Application $app,$realm = 'realm1')
    {
        $this->app = $app;

        parent::__construct($realm);
    }

    /**
     * @param EventMapContract $events [description]
     */
    public function addEventMap(EventMapContract $events)
    {
        $this->events = $events;
    }

    /**
     * @param \Thruway\ClientSession                $session
     * @param \Thruway\Transport\TransportInterface $transport
     */
    public function onSessionStart($session, $transport)
    {
        if($this->events) {
            //@TODO: Implerment IteratorInterface so we can use EventMap as an array
            foreach ($this->events->getEvents() as $event) {

                $this->getSubscriber()->subscribe($session, $event->getTopic(), function ($data) use ($event) {
                    $this->handleEvent($event, $data);
                }, $event->getOptions());
            }
        }
    }

    /**
     * @param  [type] $event [description]
     * @param  [type] $data  [description]
     * @return [type]        [description]
     */
    public function handleEvent($event, $data)
    {
        foreach($event->getCallback() as $callback) {
            $event = $this->app->make($callback);

            if(method_exists($event, 'setData')) {
                $event->setData($data);
            }

            event($event);
        }
    }
}
