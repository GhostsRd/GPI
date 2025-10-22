<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\ticket;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class Profile extends Component
{ public $notifications = [];
     public $lastCount = 0;

    public function mount(){
            $this->notifications = Cache::get('notifications', []);
            $this->lastCount = count($this->notifications);
    }

    public function checkNotifications()
{
      $current = Cache::get('notifications', []);
        $currentCount = count($current);

        // Si le nombre a augmenté → nouvelle notification détectée
        if ($currentCount > $this->lastCount) {
            $this->dispatchBrowserEvent('playSound'); // ✅ version correcte
        }

        $this->notifications = $current;
        $this->lastCount = $currentCount;
}



    public function sendNotifications()
    {
        $now = Carbon::now();

        // Vérifier la dernière notification stockée dans la session
        $lastSent = session('last_notification_time', null);

      

        if (!$lastSent || $now->diffInDays($lastSent) >= 2) {
            $this->notifications[] = [
                'title' => 'Rappel automatique',
                'message' => 'Ceci est votre notification tous les 2 jours.',
                'created_at' => $now
            ];

            // Enregistrer le moment où la notification a été “envoyée”
            session(['last_notification_time' => $now]);
        }
    }
    public function render()
    {
        return view('livewire.admin.profile.profile');
    }
}
