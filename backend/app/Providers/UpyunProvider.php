<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UpyunProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // 又拍云客户端
        $this->app->singleton(\Upyun\Upyun::class, function($app) {
            $serviceName = env('UPYUN_SERVICE_NAME');
            $operateUser = env('UPYUN_OPERATE_USER');
            $operatePass = env('UPYUN_OPERATE_PASS');

            $config = new \Upyun\Config($serviceName, $operateUser, $operatePass);
            return new \Upyun\Upyun($config);
        });
    }
}
