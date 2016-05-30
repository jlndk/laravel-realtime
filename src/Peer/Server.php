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
     * List sessions info
     *
     * @var array
     */
    protected $_sessions = [];

    protected $session;

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
        $session->subscribe('wamp.metaevent.session.on_join',  [$this, 'onSessionJoin']);
        $session->subscribe('wamp.metaevent.session.on_leave', [$this, 'onSessionLeave']);

        $this->session = $session;

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
     * Broadcasts a given event to the session
     * @param  array  $channels The channels that the event will be broadcasted on
     * @param  [type] $event    The name of the event that will be broadcasted
     * @param  [type] $payload  The extra data that the event provides.
     * @return void
     */
    public function publish(array $channels, $event, array $payload = [])
    {
        foreach($channels as $channel)
        {
            $this->session->publish($channel, [$payload]);
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

    /**
     * Handle on new session joinned
     *
     * @param array $args
     * @param array $kwArgs
     * @param array $options
     * @return void
     * @link https://github.com/crossbario/crossbar/wiki/Session-Metaevents
     */
    public function onSessionJoin($args, $kwArgs, $options)
    {
        echo "Session {$args[0]->session} joinned\n";
        $this->_sessions[] = $args[0];
    }

    /**
     * Handle on session leaved
     *
     * @param array $args
     * @param array $kwArgs
     * @param array $options
     * @return void
     * @link https://github.com/crossbario/crossbar/wiki/Session-Metaevents
     */
    public function onSessionLeave($args, $kwArgs, $options)
    {
        if (!empty($args[0]->session)) {
            foreach ($this->_sessions as $key => $details) {
                if ($args[0]->session == $details->session) {
                    echo "Session {$details->session} leaved\n";
                    unset($this->_sessions[$key]);
                    return;
                }
            }
        }
    }
}
