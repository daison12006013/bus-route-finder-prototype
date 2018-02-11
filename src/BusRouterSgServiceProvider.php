<?php

namespace Daison\BusRouterSg;

use Illuminate\Support\ServiceProvider;
use Daison\BusRouterSg\Http\Middleware;

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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bus-router-sg');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\ParseJsonRawFiles::class,
            ]);
        }

        # let's change the default pagination to use bootstrap 4
        \Illuminate\Pagination\AbstractPaginator::defaultView("pagination::bootstrap-4");
        \Illuminate\Pagination\AbstractPaginator::defaultSimpleView("pagination::simple-bootstrap-4");
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        include_once __DIR__.'/../helpers.php';

        $this->app['router']->aliasMiddleware(package('guest', 'middleware'), Middleware\RedirectIfAuthenticated::class);
        $this->app['router']->aliasMiddleware(package('auth', 'middleware'), Middleware\RedirectIfNotAuthenticated::class);
    }
}
