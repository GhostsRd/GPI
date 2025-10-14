<?php

namespace App\Http\Livewire\Utilisateur\Checkout;

use Livewire\Component;
use App\Models\chat;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;
use App\Models\User;
use App\Models\ticket;

use Livewire\WithPagination;

class Checkout extends Component
{

    public $tickets;
    public $recherche;
    public $state;


    public function mount(){
        $this->recherche;
        $this->state;


    }
    public function render()
    {
         $user_ID =  Auth::guard('utilisateur')->user()->id;
        
        return view('livewire.utilisateur.checkout.checkout',[
            "tickets"=> ticket::where("sujet","like","%".$this->recherche."%")
            ->where("state","like","%".$this->state."%")
            ->where("utilisateur_id",$user_ID)
            ->orderBy("created_at", "desc")
                ->paginate(4),
         "chats"=> chat::all(),
         "responsables" => User::all(),
           ]);
    
    }
}
