<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define the 'admin' gate
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // Define the 'conductor' gate
        Gate::define('conductor', function ($user) {
            return $user->role === 'conductor';
        });
    }
}
