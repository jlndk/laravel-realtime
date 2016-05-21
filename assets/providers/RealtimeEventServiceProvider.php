<?php

namespace App\Providers;

use Jlndk\LaravelRealtime\Providers\RealtimeEventServiceProvider as ServiceProvider;

class RealtimeEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'com.myapp.hello' => [
            'App\Events\TestEvent'
        ]
    ];
}
