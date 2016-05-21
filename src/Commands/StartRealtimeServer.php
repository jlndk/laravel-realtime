<?php

namespace Jlndk\LaravelRealtime\Commands;

use Jlndk\LaravelRealtime\Contracts\Router as RouterContract;
use Jlndk\LaravelRealtime\Contracts\EventMap as EventMapContract;

use Thruway\Peer\Router as ThruwayRouter;

use Illuminate\Console\Command;

use Exception;

/**
 * Artisan command to start the realtime server
 */
class StartRealtimeServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'realtime:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the realtime broadcasting server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RouterContract $router, EventMapContract $events)
    {
        $this->router = $router;

        $this->events = $events;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        echo "We're going to start the server here!" . PHP_EOL;

        $server = $this->router->getInternalClient();

        $server->addEventMap($this->events);

        $this->router->start();
    }
}
