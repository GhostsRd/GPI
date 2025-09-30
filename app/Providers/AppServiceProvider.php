<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Forcer la longueur par défaut des VARCHAR à 191
        Schema::defaultStringLength(191);

        // Utiliser Bootstrap pour la pagination
        Paginator::useBootstrap();

        // Partager $notificationCount avec toutes les vues
        View::composer('*', function ($view) {
            $view->with('notificationCount', Notification::where('read', false)->count());
        });
    }
}
