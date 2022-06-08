<?php

namespace Misakstvanu\DschrankaApi;

use Illuminate\Support\ServiceProvider;

class DschrankaServiceProvider extends ServiceProvider{

    function boot(){
        $this->registerCommands();
        $this->registerPublishing();

    }

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
     * Register the package's commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\PublishCommand::class,
            ]);
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