<?php

namespace App\Providers;

use App\Libraries\CustomRoute;
use App\Libraries\CustomRouter;
use Illuminate\Routing\RoutingServiceProvider as ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    protected function registerRouter()
    {
        $this->app->singleton('router', function ($app) {
            return new CustomRouter($app['events'], $app);
        });
    }

    public function register()
    {
        parent::register();

        $this->app->bind('Illuminate\Routing\Route', CustomRoute::class);
    }
}
