<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteMacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::macro('crud', function (
            string $prefix,
            string $controller
        ) {

            Route::prefix($prefix)->group(function () use ($prefix, $controller) {

                Route::get('/', [$controller, 'index'])
                    ->name("$prefix.index");

                Route::get('/getAll', [$controller, 'getAll'])
                    ->name("$prefix.getAll");

                Route::get('/getAllTrashed', [$controller, 'getAllTrashed'])
                    ->name("$prefix.getAllTrashed");

                Route::get('/{id}/findById', [$controller, 'findById'])
                    ->name("$prefix.findById");

                Route::post('/', [$controller, 'store'])
                    ->name("$prefix.store");

                Route::put('/{id}', [$controller, 'update'])
                    ->name("$prefix.update");

                Route::delete('/{id}', [$controller, 'delete'])
                    ->name("$prefix.delete");

                Route::patch('/{id}', [$controller, 'restore'])
                    ->name("$prefix.restore");
            });
        });
    }
}
