<?php

namespace Jlndk\LaravelRealtime\Providers;

use Jlndk\LaravelRealtime\Routing\Router;
use Jlndk\LaravelRealtime\Contracts\Router as RouterContract;
use Jlndk\LaravelRealtime\Events\EventMap;
use Jlndk\LaravelRealtime\Contracts\EventMap as EventMapContract;
use Jlndk\LaravelRealtime\Peer\Server;

use Thruway\Peer\Router as ThruwayRouter;
use Thruway\Transport\RatchetTransportProvider;

use Illuminate\Support\ServiceProvider;

class RealtimeEventServiceProvider extends ServiceProvider
{

    /**
     * A map of the events we should subscribe too
     *
     * @var array
     */
    protected $listen = array();

    /**
     * The console commands.
     *
     * @var array
     */
    protected $commands = [
        'Jlndk\LaravelRealtime\Commands\StartRealtimeServer',
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerEventMap();
        $this->registerServer();
        $this->registerThruway();
        $this->commands($this->commands);
    }

    protected function registerEventMap() {
        $listen = $this->listen;

        $this->app->singleton(EventMapContract::class, function() use($listen) {
            $events = new EventMap();

            foreach($listen as $topic => $event) {
                if(!is_array($event)) {
                    throw new \Exception("Events must be an array of strings");
                }
                $events->addEvent($topic, $event);
            }

            return $events;
        });

    }

    protected function registerServer()
    {
        $this->app->bind(Server::class, function ($app) {
            //@TODO: Make broadcast channel and port configurable and dynamic
            return new Server($app);
        });
    }

    protected function registerThruway()
    {
        $this->app->bind(RatchetTransportProvider::class, function ($app) {
            $address = config('realtime.ip');
            $port = config('realtime.port');
            return new RatchetTransportProvider($address, $port);
        });

        $this->app->singleton(RouterContract::class, function ($app) {

            $router = new Router();

            $thruwayRouter = $app['\Thruway\Peer\Router'];

            $transportProvider = $app['\Thruway\Transport\RatchetTransportProvider'];

            $client = $app['\Jlndk\LaravelRealtime\Peer\Server'];

            $thruwayRouter->addTransportProvider($transportProvider);

            $router->setInternalRouter($thruwayRouter);

            $router->setInternalClient($client);

            return $router;
        });

    }

}


?>
