<?php

namespace App\Observers;

use App\Models\ticket;
use App\Notifications\GPINotification;
use Illuminate\Support\Facades\Notification;

class TicketObserver
{
    /**
     * Handle the active "created" event.
     */
    public function created(ticket $ticket)
    {
        // Notifier le demandeur
        if ($ticket->utilisateur) {
            $ticket->utilisateur->notify(new GPINotification([
                'title' => 'Nouveau ticket créé',
                'message' => "Votre ticket #{$ticket->id} ({$ticket->sujet}) a été créé avec succès.",
                'icon' => 'fas fa-ticket-alt',
                'color' => 'primary',
                'link' => route('utilisateurTicket', $ticket->id),
                'type' => 'creation'
            ]));
        }

        // Notifier le responsable s'il est assigné dès le début
        if ($ticket->responsable) {
            $ticket->responsable->notify(new GPINotification([
                'title' => 'Nouveau ticket assigné',
                'message' => "Un nouveau ticket #{$ticket->id} vous a été assigné.",
                'icon' => 'fas fa-user-tag',
                'color' => 'info',
                'link' => route('checkTicketview', $ticket->id),
                'type' => 'assignment'
            ]));
        }
    }

    /**
     * Handle the active "updated" event.
     */
    public function updated(ticket $ticket)
    {
        if ($ticket->isDirty('status')) {
            if ($ticket->utilisateur) {
                $ticket->utilisateur->notify(new GPINotification([
                    'title' => 'Statut du ticket mis à jour',
                    'message' => "Le statut de votre ticket #{$ticket->id} est passé à : {$ticket->status}.",
                    'icon' => 'fas fa-sync',
                    'color' => 'success',
                    'link' => route('utilisateurTicket', $ticket->id),
                    'type' => 'status_update'
                ]));
            }
        }

        if ($ticket->isDirty('responsable_id')) {
            if ($ticket->responsable) {
                $ticket->responsable->notify(new GPINotification([
                    'title' => 'Ticket assigné',
                    'message' => "Le ticket #{$ticket->id} vous a été assigné.",
                    'icon' => 'fas fa-user-tag',
                    'color' => 'info',
                    'link' => route('checkTicketview', $ticket->id),
                    'type' => 'assignment'
                ]));
            }
        }
    }

    /**
     * Handle the active "deleted" event.
     */
    public function deleted(ticket $ticket)
    {
        // Optionnel : notifier de la suppression
    }
}
