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
        $this->app->scoped(\App\Repositories\Interfaces\TransactionRepositoryInterface::class, \App\Repositories\TransactionRepository::class);
        $this->app->scoped(\App\Repositories\Interfaces\TransactionCategoryRepositoryInterface::class, \App\Repositories\TransactionCategoryRepository::class);
        $this->app->scoped(\App\Repositories\Interfaces\InventoryMovementRepositoryInterface::class, \App\Repositories\InventoryMovementRepository::class);
        $this->app->scoped(\App\Repositories\Interfaces\ProductRepositoryInterface::class, \App\Repositories\ProductRepository::class);
        $this->app->scoped(\App\Repositories\Interfaces\RoleRepositoryInterface::class, \App\Repositories\RoleRepository::class);
        $this->app->scoped(\App\Repositories\Interfaces\UserRepositoryInterface::class, \App\Repositories\UserRepository::class);
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
