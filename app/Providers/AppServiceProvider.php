<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::before(function (User $user, string $ability) {
            $user->loadMissing('roles.permissions');

            return $user->isAdmin() ?: null;
        });

        if ($this->app->runningInConsole()) {
            return;
        }

        try {
            Permission::all()->each(function (Permission $permission) {
                Gate::define($permission->slug, fn (User $user) => $user->hasPermission($permission->slug));
            });
        } catch (\Throwable) {
            // Table may not exist during migrations
        }

        Gate::define('admin', fn (User $user) => $user->isAdmin());
    }
}
