<?php

namespace App\Observers;

use App\Models\Incident;
use App\Notifications\GPINotification;
use Illuminate\Support\Facades\Notification;

class IncidentObserver
{
    public function created(Incident $incident)
    {
        if ($incident->utilisateur) {
            $incident->utilisateur->notify(new GPINotification([
                'title' => 'Signalement d\'incident',
                'message' => "Un incident a été déclaré : {$incident->incident_sujet}.",
                'icon' => 'fas fa-exclamation-triangle',
                'color' => 'danger',
                'link' => '#',
                'type' => 'creation'
            ]));
        }

        if ($incident->technicien) {
            $incident->technicien->notify(new GPINotification([
                'title' => 'Nouvel incident assigné',
                'message' => "Un incident vous a été assigné : {$incident->incident_sujet}.",
                'icon' => 'fas fa-tools',
                'color' => 'warning',
                'link' => '#',
                'type' => 'assignment'
            ]));
        }
    }

    public function updated(Incident $incident)
    {
        if ($incident->isDirty('statut')) {
            if ($incident->utilisateur) {
                $incident->utilisateur->notify(new GPINotification([
                    'title' => 'Statut d\'incident mis à jour',
                    'message' => "Le statut de votre incident ({$incident->incident_sujet}) est désormais : {$incident->statut}.",
                    'icon' => 'fas fa-info-circle',
                    'color' => 'info',
                    'link' => '#',
                    'type' => 'status_update'
                ]));
            }
        }
    }
}
