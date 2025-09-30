<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\ticket as ticketmodel;
use App\Models\chat;

class UtilisateurService extends Component
{
    public $recherche;
    public $message;
    
    public function storechat()
    {
        $chat = new chat();
        $chat->utilisateur_id = 1;
        $chat->targetmsg_id = 2;
        $chat->type = "utilisateur";
        $chat->message = $this->message;
        $chat->save();
    }

    public function render()
    {
        return view('livewire.utilisateur.utilisateur-service',[
            "tickets"=> ticketmodel::where("id","like","%".$this->recherche."%")
        ->paginate(5),
         "chats"=> chat::all(),
           ]);
    }
}
