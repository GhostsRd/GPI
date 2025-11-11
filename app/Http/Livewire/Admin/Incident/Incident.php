<?php

namespace App\Http\Livewire\Admin\Incident;

use Livewire\Component;
use App\Models\Incident as incidenmodel;
class Incident extends Component
{
    protected $listeners = ['refreshComponent'=> '$refresh'];
    public function SupprimerDemande($id){
        $incident = incidenmodel::destroy($id);
        $this->emit("refreshComponent");

    }
    public function Visualiser($id){
        return redirect()->route("admin.incident.view", ["id"=> $id]);
    }

    public function render()
    {
        return view('livewire.admin.incident.incident',
    [
        'Incidents' => incidenmodel::orderBy('id','desc')->get(),
    ]);
    }
}
