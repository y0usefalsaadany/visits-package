<?php

namespace Yousef\Visits;
use Illuminate\Support\ServiceProvider;

class VisitServiceProvider extends ServiceProvider{

    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../views', 'visits');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register(){

    }
}
