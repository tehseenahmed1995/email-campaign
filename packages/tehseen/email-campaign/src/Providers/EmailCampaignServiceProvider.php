<?php

namespace Tehseen\EmailCampaign\Providers;

use Illuminate\Support\ServiceProvider;

class EmailCampaignServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register package services
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([
            __DIR__. '/../../config/email-campaign.php' => config_path('email-campaign.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/email-campaign'),
        ], 'views');


    }
}