<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected static $repositories = [
        [
            'App\Repositories\Contracts\UserRepository',
            'App\Repositories\Eloquents\UserEloquentRepository',
        ],
        [
            'App\Repositories\Contracts\MessageRepository',
            'App\Repositories\Eloquents\MessageEloquentRepository',
        ],
        [
            'App\Repositories\Contracts\GroupRepository',
            'App\Repositories\Eloquents\GroupEloquentRepository',
        ],
        [
            'App\Repositories\Contracts\ConversationRepository',
            'App\Repositories\Eloquents\ConversationEloquentRepository',
        ],
        [
            'App\Repositories\Contracts\GroupUserRepository',
            'App\Repositories\Eloquents\GroupUserEloquentRepository',
        ],
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->bind(
                $repository[0],
                $repository[1]
            );
        }
    }
}
