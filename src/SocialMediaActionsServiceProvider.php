<?php

namespace Hadishahpuri\SocialMediaActions;

use Hadishahpuri\SocialMediaActions\Console\InstallCommand;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class SocialMediaActionsServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'SocialMediaActions';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'social_media_actions';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        Relation::morphMap([
            // add your models with their singular lower name exp:
            //'products' => App\Models\Product::class,
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('actions::install', function()
        {
            return new InstallCommand();
        });
        $this->commands('actions::install');
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
            __DIR__.'/Config/social_media_actions.php' => config_path('social_media_actions.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/Config/social_media_actions.php', 'social_media_actions'
        );
    }
}