<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\ticket;
use App\Models\utilisateur;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\chat;
class Profile extends Component
{ 
    public $notifications = [];
     public $lastCount = 0;

     public $message;
     public $profileId;
    public function mount($id){
            $this->notifications = Cache::get('notifications', []);
            $this->lastCount = count($this->notifications);

            $this->profilId = $id;
    }


    public function EnvoyerMessage(Chat $chat){
        //$chat = Chat::find($this->profilId);
        $utilisateurs = utilisateur::findOrFail($this->profilId);
        $chat->targetmsg_id = $utilisateurs->matricule;
        $chat->utilisateur_id = Auth::user()->id;
        $chat->type = "user"; // type user(pour le sendeur) ou agent(pour  le recepteur)
        $chat->message = $this->message;
        $chat->save();
        
        $this->emit("refreshComponent");

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
        $utilisateurs = utilisateur::findOrFail($this->profilId);
        $userId = Auth::user()->id;
        return view('livewire.admin.profile.profile',[
            "utilisateurs" => $utilisateurs,
            "Chats" => Chat::where(function ($query) {
                    $userId = Auth::user()->id;
                    $query->where('utilisateur_id', $userId)
                        ->orWhere('targetmsg_id', $userId);
                })
                ->where(function ($query) use ($utilisateurs) {
                    $query->where('targetmsg_id', $utilisateurs->matricule)
                        ->orWhere('utilisateur_id', $utilisateurs->matricule);
                })
                ->orderBy('created_at', 'asc')
                ->get()
        ]);
    }
}
