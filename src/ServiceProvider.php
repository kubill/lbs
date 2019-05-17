<?php

namespace Kubill\Lbs;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot(){
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => config_path()], 'lbs');
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton(GeoCoder::class, function () {
            return new GeoCoder(config('lbs.key'),config('lbs.driver'));
        });
        $this->app->alias(GeoCoder::class, 'GeoCoder');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [GeoCoder::class, 'GeoCoder'];
    }
}
