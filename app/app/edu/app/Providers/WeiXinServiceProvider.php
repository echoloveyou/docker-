<?php
namespace App\Providers;

use App\Service\WeiXinService;
use Illuminate\Support\ServiceProvider;

class WeiXinServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('wei_xin', function (){
            return new WeiXinService(config('weixin.small_routine.serverUrl'),
                config('weixin.small_routine.appId'),
                config('weixin.small_routine.appSecret'));
        });
    }
}
?>