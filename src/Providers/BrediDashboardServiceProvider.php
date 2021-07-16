<?php

namespace Bredi\BrediDashboard\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class BrediDashboardServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    // protected $policies = [
    //     'App\Model' => 'Bredi\BrediDashboard\Policies\BrediDashboardPolicy',
    // ];
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        $file = __DIR__ . '/../Http/Helper/Helper.php';

        if (file_exists($file)) {
            require_once $file;
        }

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('bredidashboard.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('bredidashboard.php'),
        ], 'bredidashboard-config');
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'bredidashboard'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/bredidashboard');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/bredidashboard';
        }, \Config::get('view.paths')), [$sourcePath]), 'bredidashboard');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/bredidashboard');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'bredidashboard');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'bredidashboard');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
