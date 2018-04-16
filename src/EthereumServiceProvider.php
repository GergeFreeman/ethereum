<?php

namespace Santran\Ethereum;

use Illuminate\Support\ServiceProvider;

class EthereumServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ethereum', function ($app) {
            return new EthereumManager;
        });
    }

    private function handleConfigs()
    {
        $configPath = __DIR__ . '/../config/ethereum.php';
        $this->publishes([$configPath => config_path('ethereum.php')]);
        $this->mergeConfigFrom($configPath, 'ethereum');
    }

}
