<?php

namespace Omega\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(
            'PaginationPresenter',
            'Omega\Presenters\Pagination\SemanticUIPresenter'
        );

        app()->bind(
            'Omega\Repositories\UserRepositoryInterface',
            'Omega\Repositories\DbUserRepository'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
