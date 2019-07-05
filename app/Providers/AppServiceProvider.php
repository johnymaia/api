<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\WordAnnotationRepositoryInterface',
            'App\Repositories\WordAnnotationRepositoryEloquent'

        );

        $this->app->bind(
            'App\Repositories\WordTagRepositoryInterface',
            'App\Repositories\WordTagRepositoryEloquent'
        );
    }
}
