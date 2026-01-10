<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Task;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport; // ← Add this

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => TaskPolicy::class,
        Project::class => ProjectPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Add Passport routes - but this is optional in newer versions
        // Passport::tokensExpireIn(now()->addDays(15));
        // Passport::refreshTokensExpireIn(now()->addDays(30));

        // Admin override
        Gate::before(function ($user) {
            return $user->hasRole('admin') ? true : null;
        });

        Gate::define('users.manage', fn ($user) => $user->hasPermission('users.manage'));
        Gate::define('products.create', fn ($user) => $user->hasPermission('products.create'));
        Gate::define('products.update', fn ($user) => $user->hasPermission('products.update'));
        Gate::define('categories.create', fn ($user) => $user->hasPermission('categories.create'));
        Gate::define('categories.update', fn ($user) => $user->hasPermission('categories.update'));
    }
}
