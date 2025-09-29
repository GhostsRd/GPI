<?php

namespace App\Http\Livewire\User;
use Livewire\WithPagination;
use App\Models\chat;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class User extends Component
{
    
    public function mount(){
 

    }
  public function render()
{
    $chats = Chat::all();   // récupérer toutes les discussions

    return view('layout.user', compact('chats'));
}


}