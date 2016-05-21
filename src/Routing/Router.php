<?php

namespace Jlndk\LaravelRealtime\Routing;

use Jlndk\LaravelRealtime\Contracts\Router as RouterContract;
use Jlndk\LaravelRealtime\Peer\Server;
use Jlndk\LaravelRealtime\Events\EventMap;
use Jlndk\LaravelRealtime\Contracts\EventMap as EventMapContract;

use Thruway\Peer\Router as ThruwayRouter;
use Thruway\Peer\RouterInterface as ThruwayRouterInterface;
use Thruway\Peer\ClientInterface as ThruwayClientInterface;
use Thruway\Transport\RatchetTransportProvider;
use Thruway\Transport\RouterTransportProviderInterface;

/**
 *
 */
class Router implements RouterContract
{
    /**
     * @var Thruway\Peer\Router
     */
    protected $router;

    /**
     * @var ThruwayClientInterface
     */
    protected $client;

    /**
     * Starts the internal router
     * @return void
     */
    public function start() {
        $this->router->start();
    }

    /**
     * Returns the internal router
     * @return ThruwayRouterInterface The router
     */
    public function getInternalRouter() {
        return $this->router;
    }

    public function setInternalRouter(ThruwayRouterInterface $router) {
        $this->router = $router;
    }

    public function getInternalClient() {
        return $this->client;
    }

    public function setInternalClient(ThruwayClientInterface $client) {
        $this->router->addInternalClient($client);
        $this->client = $client;
    }
}



?>
