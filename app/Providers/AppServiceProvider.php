<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\LoginRepositoryInterface;
use App\Repositories\LoginRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
