<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\ticket;
use App\Models\Checkout;
use App\Models\Incident;
use App\Models\checkoutreserver;
use App\Observers\TicketObserver;
use App\Observers\CheckoutObserver;
use App\Observers\IncidentObserver;
use App\Observers\ReservationObserver;
use Illuminate\Support\Facades\Auth;

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

        // Observers
        ticket::observe(TicketObserver::class);
        Checkout::observe(CheckoutObserver::class);
        Incident::observe(IncidentObserver::class);
        checkoutreserver::observe(ReservationObserver::class);

        // Partager $notificationCount avec toutes les vues
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('notificationCount', Auth::user()->unreadNotifications->count());
            } else {
                $view->with('notificationCount', 0);
            }
        });
    }
}
