<?php

namespace App\Http\Livewire\Component;

use App\Models\chat as Chatmodel;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\utilisateur;



class Chat extends Component
{
    public $message;
    public $utilisateurs;

    public function mount()
    {
        $this->message;
    }

       public function EnvoyerMessage(Chatmodel $chat){
        //$chat = Chat::find($this->profilId);
            if(preg_match('/admin\/checkout-view-(\d+)/', request()->path(), $matches)){

                $utilisateurs = utilisateur::findOrFail($this->profilId);
                $chat->targetmsg_id = $utilisateurs->matricule;
                $chat->utilisateur_id = Auth::user()->id;
                $chat->type = "user"; // type user(pour le sendeur) ou agent(pour  le recepteur)
                $chat->message = $this->message;
                $chat->save();
            

            }elseif (preg_match('/admin\/utilisateur\/profile-(\d+)/', request()->path(), $matches)) {
                    $utilisateurs = utilisateur::findOrFail($this->checkouts->utilisateur->id);
                    $chat->targetmsg_id = $utilisateurs->matricule;
                    $chat->utilisateur_id = Auth::user()->id;
                    $chat->type = "user"; // type user(pour le sendeur) ou agent(pour  le recepteur)
                    $chat->message = $this->message;
                    $chat->save();
                
            }
       
    }
      
 public function render()
{
    $userId = Auth::user()->id;
 

    // Route checkout
    if (preg_match('/admin\/checkout-view-(\d+)/', request()->path(), $matches)) {
        $checkouts = Checkout::findOrFail($matches[1]);
        $this->utilisateurs = utilisateur::findOrFail($checkouts->utilisateur->id);
    }

    // Route profil utilisateur
    if (preg_match('/admin\/utilisateur\/profile-(\d+)/', request()->path(), $matches)) {
        $this->utilisateurs = utilisateur::findOrFail($matches[1]);
    }

    // Requête des chats (uniquement si $utilisateurs défini)
    $Chats = collect();
    $users = $this->utilisateurs;
    if ($this->utilisateurs) {
        $Chats = Chatmodel::where(function ($query) use ($userId) {
                        $query->where('utilisateur_id', $userId)
                              ->orWhere('targetmsg_id', $userId);
                    })
                    ->where(function ($query) use ($users) {
                        $query->where('targetmsg_id', $users->matricule)
                              ->orWhere('utilisateur_id', $users->matricule);
                    })
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    return view('livewire.component.chat', [
        'utilisateurs' => $users,
        'Chats' => $Chats
    ]);
}

}
