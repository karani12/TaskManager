<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Event; 
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Google\Provider; 
class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        SocialiteWasCalled::class => [
            Provider::class,
        ],
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
     
    
       
    }
}
