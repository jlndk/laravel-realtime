<?php

namespace Jlndk\LaravelRealtime\Contracts;

use Thruway\Peer\RouterInterface as ThruwayRouterInterface;
use Thruway\Peer\ClientInterface as ThruwayClientInterface;
use Thruway\Transport\RouterTransportProviderInterface;

interface Router {
    /**
     * Starts the router
     * @return void
     */
    public function start();
}


?>
