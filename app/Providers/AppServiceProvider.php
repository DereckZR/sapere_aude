<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(\App\Repositories\Interfaces\MemberRepositoryInterface::class, \App\Repositories\MemberRepository::class);
        $this->app->scoped(\App\Repositories\Interfaces\CycleRepositoryInterface::class, \App\Repositories\CycleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
