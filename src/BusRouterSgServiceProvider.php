<?php

namespace Daison\BusRouterSg;

use Illuminate\Support\ServiceProvider;

/**
 * [BusRouterSgServiceProvider description]
 *
 * @author Daison Cariño <daison12006013@gmail.com>
 */
class BusRouterSgServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\ParseJsonRawFiles::class,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        # code here...
    }
}
