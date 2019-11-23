<?php

namespace Hsy\Html;

use Illuminate\Support\ServiceProvider;

class HsyHtmlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        \App::bind('Html', function()
        {
            return new Html;
        });



        $this->mergeConfigFrom(__DIR__ . '/../resources/config/html.php', 'html');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'html');

        $this->publishes([
            __DIR__ . '/../resources/config/html.php' => config_path('html.php'),
        ], 'config');


        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/html'),
        ], 'views');


    }
}
