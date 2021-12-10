<?php

namespace Hadishahpuri\SocialMediaActions;

use Hadishahpuri\SocialMediaActions\Console\InstallCommand;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class SocialMediaActionsServiceProvider extends ServiceProvider
{
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
        Relation::morphMap(config('social_media_actions.morphs_array', []));
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