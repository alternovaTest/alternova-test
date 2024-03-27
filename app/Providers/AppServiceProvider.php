<?php

namespace App\Providers;

use App\Events\UpdateRating;
use App\Listeners\SaveRatingAverage;
use App\Models\Item;
use App\Models\UsersComment;
use App\Models\UsersRating;
use App\Policies\ItemPolicy;
use App\Policies\UsersCommentPolicy;
use App\Policies\UsersRatingPolicy;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Item::class, ItemPolicy::class);
        Gate::policy(UsersRating::class, UsersRatingPolicy::class);
        Gate::policy(UsersComment::class, UsersCommentPolicy::class);
        Event::listen(UpdateRating::class, SaveRatingAverage::class);
    }
}
