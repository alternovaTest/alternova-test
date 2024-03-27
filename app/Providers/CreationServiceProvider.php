<?php

namespace App\Providers;

use App\Factories\Contracts\CreationInterface;
use App\Factories\ItemFactory;
use App\Factories\UserRatingFactory;
use App\Factories\UsersCommentFactory;
use App\Services\ItemService;
use App\Services\UsersCommentService;
use App\Services\UsersRatingService;
use Illuminate\Support\ServiceProvider;

class CreationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(ItemService::class)
        ->needs(CreationInterface::class)
        ->give(function(){
            return new ItemFactory();
        });

        $this->app->when(UsersRatingService::class)
        ->needs(CreationInterface::class)
        ->give(function(){
            return new UserRatingFactory();
        });

        $this->app->when(UsersCommentService::class)
        ->needs(CreationInterface::class)
        ->give(function(){
            return new UsersCommentFactory();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
