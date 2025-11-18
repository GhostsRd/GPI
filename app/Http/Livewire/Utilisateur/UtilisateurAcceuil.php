<?php

namespace App\Http\Livewire\Utilisateur;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\chat;
class UtilisateurAcceuil extends Component
{
    public $message;
    public $userId;

     public function EnvoyerMessage(Chat $chat){
        //$chat = Chat::find($this->profilId);

        $adminSupport = User::first();

        $chat->targetmsg_id = $adminSupport->id;
        $chat->utilisateur_id = Auth::guard('utilisateur')->user()->matricule;
        $chat->type = "agent";
       // $chat->categorie = "pouradmin"; // type user(pour le sendeur) ou agent(pour  le recepteur)
        $chat->message = $this->message;
        $chat->save();
        
        $this->reset(['message']);
        $this->emit("refreshComponent");

    }


    public function render()
    {
        
        if(Auth::guard('utilisateur')->user()){

            $this->userId = Auth::guard('utilisateur')->user()->matricule;
        }else{
            $this->userID = 1111;
        }
        return view('livewire.utilisateur.utilisateur-acceuil',[
            "chats" => Chat::where(function ($query) {
                $query->where('targetmsg_id', $this->userId)
               
                    ->orWhere('utilisateur_id', $this->userId);
            })
            ->orderBy('created_at', 'asc')
            ->get()
        ]);
    }
}
