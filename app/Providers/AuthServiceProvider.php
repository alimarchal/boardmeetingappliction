<?php

namespace App\Providers;

use App\Models\CommitteeMeeting;
use App\Policies\CommitteeMeetingPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        CommitteeMeeting::class => CommitteeMeetingPolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole(['Super-Admin','Company Secretary']) ? true : null;
        });
    }
}
