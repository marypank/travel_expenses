<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Trip;
use App\Models\TripExpense;
use App\Policies\TagPolicy;
use App\Policies\TripExpensePolicy;
use App\Policies\TripPolicy;
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
        Gate::policy(Tag::class, TagPolicy::class);
        Gate::policy(Trip::class, TripPolicy::class);
        Gate::policy(TripExpense::class, TripExpensePolicy::class);
    }
}
