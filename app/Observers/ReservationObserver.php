<?php

namespace App\Observers;

use App\Models\checkoutreserver;
use App\Notifications\GPINotification;
use Illuminate\Support\Facades\Notification;

class ReservationObserver
{
    public function created(checkoutreserver $reservation)
    {
        if ($reservation->responsable) {
            $reservation->responsable->notify(new GPINotification([
                'title' => 'Nouvelle réservation',
                'message' => "Une réservation de matériel ({$reservation->equipement_type}) a été enregistrée à votre nom.",
                'icon' => 'fas fa-calendar-check',
                'color' => 'info',
                'link' => '#',
                'type' => 'creation'
            ]));
        }
    }

    public function updated(checkoutreserver $reservation)
    {
        if ($reservation->isDirty('statut')) {
            if ($reservation->responsable) {
                $reservation->responsable->notify(new GPINotification([
                    'title' => 'Statut de réservation mis à jour',
                    'message' => "Le statut de votre réservation ({$reservation->equipement_type}) est désormais : {$reservation->statut}.",
                    'icon' => 'fas fa-info-circle',
                    'color' => 'success',
                    'link' => '#',
                    'type' => 'status_update'
                ]));
            }
        }
    }
}
