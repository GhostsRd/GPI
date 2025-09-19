<?php

namespace App\Http\Livewire\Gerer;

use App\Models\User;
use Livewire\Component;

class Auth extends Component
{
    public $checkData = [];
    public $disabled = "disabled";
    public $total;
    public $recherche;
    public $form;


    public function formAjout()
     {
         $this->form = "active";
     }
     public function exit(){
        return redirect('/admin');
     }
     
    public function deleteSelected(){
     
        User::query()
            ->where('id',$this->checkData)
            ->delete();

        $this->checkData = [];

        return redirect("/admin")
        ->with('notif',"Effacé avec succés");
    } 
    public function render()
    {
        if(count($this->checkData) > 0){
            $this->disabled = "";
            $this->total = count($this->checkData);
        }else
        {
             $this->disabled = "disabled";
        }
        return view('livewire.gerer.auth',[
            "users"=> User::where("email","like","%".$this->recherche."%")
        ->where("name","like","%".$this->recherche."%")
        
        ->get(),
           ]);
    }
    
}
