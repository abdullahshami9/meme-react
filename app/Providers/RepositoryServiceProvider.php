<?php

namespace App\Providers;

use App\Repository\FriendRepo;
use App\Repository\IFriendRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->singleton(tl1FiberHome::class, function ($app) {
        //     return new tl1FiberHome();
        // });

        $this->app->bind(IFriendRepo::class, FriendRepo::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
