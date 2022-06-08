<?php

namespace Misakstvanu\DschrankaApi;

use Illuminate\Support\ServiceProvider;

class DschrankaServiceProvider extends ServiceProvider{

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing(){
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/dschranka.php' => config_path('dschranka.php'),
            ], 'dschranka-config');
        }
    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(){
        $this->mergeConfigFrom(
            __DIR__.'/../config/dschranka.php', 'dschranka'
        );
    }



}