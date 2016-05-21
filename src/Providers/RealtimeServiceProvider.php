<?php

namespace Jlndk\LaravelRealtime\Providers;


use Illuminate\Support\ServiceProvider;

class RealtimeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $assetDir = __DIR__.'/../../assets';
        $this->publishes([
            $assetDir.'/config/realtime.php' => config_path('realtime.php'),
            $assetDir.'/providers/RealtimeEventServiceProvider.php' => app_path('/Providers/RealtimeEventServiceProvider.php')
        ], 'all');
    }

    public function register()
    {

    }
}

?>
