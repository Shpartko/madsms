<?php

namespace Shpartko\Madsms;

use Illuminate\Support\ServiceProvider;
use Shpartko\Madsms\Madsms;
use Shpartko\Madsms\SuperMadsms;
use Shpartko\Madsms\Exceptions\GatewaysException;
use Route;

/**
 * Mad Class ServiceProvider
 *
 * @package Shpartko\Madsms
 */
class MadServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/madsms.php' => config_path('madsms.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/madsms'),
        ]);
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/madsms')
        ], 'views');

        $this->mergeConfigFrom(__DIR__.'/../config/madsms.php', 'madsms');
        $this->loadRoutesFrom(__DIR__.'/../resources/routes.php', 'madsms');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'madsms');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'madsms');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('madsms', function ($app) {
            if (!config('madsms.gateways'))
                 throw GatewaysException::cannot_load_config();

            $gateway = array_random(config('madsms.gateways'));
            return new Madsms(new $gateway());
        });
        $this->app->singleton('supermadsms', function ($app) {
            return new SuperMadsms(config('madsms.gateways'));
        });
        $this->app->alias('madsms', Madsms::class);
        $this->app->alias('supermadsms', SuperMadsms::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'madsms',
            'supermadsms',
            Madsms::class,
            SuperMadsms::class,
        ];
    }
}
