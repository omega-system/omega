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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'PaginationPresenter',
            'Omega\Presenters\Pagination\SemanticUIPresenter'
        );

        $this->app->bind(
            'Omega\Repositories\UserRepositoryInterface',
            'Omega\Repositories\DbUserRepository'
        );
    }
}
