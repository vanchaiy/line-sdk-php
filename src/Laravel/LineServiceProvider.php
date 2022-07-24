<?php

namespace LineSDK\Laravel;

use Illuminate\Support\ServiceProvider;
use LineSDK\Bot;
use LineSDK\Notify;

class LineServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPublishables();
    }
    
    public function register()
    {
        $this->app->bind('linebot', function () {
            $channelID = config('line.channelID');
            $channelSecret = config('line.channelSecret');
            $channelAccessToken = config('line.channelAccessToken');
            return new Bot([
                "channelID" => $channelID,
                "channelSecret" => $channelSecret,
                "channelAccessToken" => $channelAccessToken,
            ]);
        });

        $this->app->bind('linenotify', function () {
            $accessToken = config('line.accessToken');
            return new Notify($accessToken);
        });
        
        $this->mergeConfigFrom(__DIR__ . '/../../config/line.php', 'line');
    }

    protected function registerPublishables(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/line.php' => config_path('line.php'),
        ], 'config');
    }
}
