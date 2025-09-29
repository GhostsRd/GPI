<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\chat;
class UtilisateurAcceuil extends Component
{
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
        return view('livewire.utilisateur.utilisateur-acceuil',["chats"=> chat::all()]);
    }
}
