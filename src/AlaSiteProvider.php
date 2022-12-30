<?php
/**
 *
 * User: songrui
 * Date: 2022/12/26
 * Email: <sr_yes@foxmail.com>
 */
namespace Arui\AlaSite;

use Illuminate\Support\ServiceProvider;

class AlaSiteProvider extends ServiceProvider
{
    public function boot (){
        $this->publishes([
            __DIR__.'/config/alasite.php' => config_path('alasite.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('AlaSite',function ($app){
            return new AlaSite();
        });
    }
}
