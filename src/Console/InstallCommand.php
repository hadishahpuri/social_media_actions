<?php

namespace Hadishahpuri\SocialMediaActions\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'actions:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs migrations, configs, views and assets.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $this->info('            [ Welcome to social media Actions Installations ]       ');
        $this->info('            [ Migrating tables ]       ');
        $this->call('migrate:fresh', ['--path' => 'vendor/hadishahpuri/social-media-actions/src/Database/Migrations']);
        $this->info('            [ Database migration finished! ]       ');
        $this->info('            [ publishing package config file ]       ');
        $this->call('vendor:publish', ['--provider' => 'Hadishahpuri\SocialMediaActions\SocialMediaActionsServiceProvider']);
        $this->info('            [ publishing assets finished! ]       ');
        $this->info('            [ Enjoy using this package! ]       ');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}