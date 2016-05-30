<?php

namespace Jlndk\LaravelRealtime\Broadcasting;

use Illuminate\Contracts\Broadcasting\Broadcaster;
use Jlndk\LaravelRealtime\Peer\Server;

class RealtimeBroadcaster implements Broadcaster
{
    /**
     * @var Jlndk\LaravelRealtime\Peer\Server
     */
    protected $server;

    /**
     * Creates a new instance of RealtimeBroadcaster
     * @param Server $server The server we shold use to broadcast events
     */
    function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * Returns the server
     * @return Jlndk\LaravelRealtime\Peer\Server
     */
    function getServer() {
        return $this->server();
    }

    /**
     * Broadcasts a given event to the websocket
     * @param  array  $channels The channels that the event will be broadcasted on
     * @param  [type] $event    The name of the event that will be broadcasted
     * @param  [type] $payload  The extra data that the event provides.
     * @return void           
     */
    function broadcast(array $channels, $event, array $payload = [])
    {
        $this->server->publish($channels, $event, $payload);
    }
}


?>
