<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Notifications\AutoReminderNotification;
use Carbon\Carbon;

class AutoReminder extends Component
{
    public function mount()
    {
        $this->sendNotifications();
    }

   public function sendNotifications()
{
    $users = User::all(); // Récupérer tous les utilisateurs, tu peux filtrer si besoin

    foreach ($users as $user) {
        // Récupère la dernière notification de type AutoReminderNotification
        $lastNotification = $user->notifications()
                                 ->where('type', AutoReminderNotification::class)
                                 ->orderBy('created_at', 'desc')
                                 ->first();

        // Vérifie si aucune notification n'a été envoyée ou si elle date de 2 jours ou plus
        $shouldNotify = false;

        if (!$lastNotification) {
            $shouldNotify = true; // jamais notifié
        } else {
            $lastCreated = $lastNotification->created_at; // Carbon instance
            if ($lastCreated->diffInDays(now()) >= 2) {
                $shouldNotify = true; // dernière notification >= 2 jours
            }
        }

        // Envoi de la notification si nécessaire
        if ($shouldNotify) {
            $user->notify(new AutoReminderNotification());
        }
    }
}

    public function render()
    {
        return view('livewire.auto-reminder');
    }
}
