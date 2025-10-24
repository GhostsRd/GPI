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

      
    public function render()
    {
        if (preg_match('/admin\/checkout-view-(\d+)/', request()->path(), $matches)) {
       // return $matches[1];
                             $checkouts = Checkout::findOrFail($matches[1]); 
                            //dd($checkouts->utilisateur->id);
  
                          $utilisateurs = utilisateur::findOrFail($checkouts->utilisateur->id);
                        return view('livewire.component.chat',[
                            'utilisateurs'=> $utilisateurs,
                            "Chats" => Chatmodel::where(function ($query) {
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
            elseif(preg_match('/admin\/utilisateur\/profile-(\d+)/', request()->path(), $matches)) {
                $utilisateurs = utilisateur::findOrFail($matches[1]);
                $userId = Auth::user()->id;
                return view('livewire.component.chat',[
                    "utilisateurs" => $utilisateurs,
                    "Chats" => Chatmodel::where(function ($query) {
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
}
