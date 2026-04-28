<?php

namespace App\Observers;

use App\Models\Checkout;
use App\Notifications\GPINotification;
use Illuminate\Support\Facades\Notification;

class CheckoutObserver
{
    public function created(Checkout $checkout)
    {
        if ($checkout->utilisateur) {
            $checkout->utilisateur->notify(new GPINotification([
                'title' => 'Nouvelle sortie de matériel',
                'message' => "Une sortie de matériel ({$checkout->materiel_type}) a été enregistrée à votre nom.",
                'icon' => 'fas fa-sign-out-alt',
                'color' => 'warning',
                'link' => '#', 
                'type' => 'creation'
            ]));
        }
    }

    public function updated(Checkout $checkout)
    {
        if ($checkout->isDirty('statut')) {
            if ($checkout->utilisateur) {
                $checkout->utilisateur->notify(new GPINotification([
                    'title' => 'Statut de sortie mis à jour',
                    'message' => "Le statut de votre sortie de matériel est désormais : {$checkout->statut}.",
                    'icon' => 'fas fa-info-circle',
                    'color' => 'info',
                    'link' => '#',
                    'type' => 'status_update'
                ]));
            }
        }
    }
}
