<?php

namespace App\Http\Livewire\Utilisateur\Checkout;

use Livewire\Component;
use App\Models\chat;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;
use App\Models\User;
use App\Models\ordinateur;
use App\Models\moniteur;
use App\Models\ticket;
use Livewire\WithPagination;


class Checkout extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public $categorie = [];
    public $tickets;
    public $recherche;
    public $search;

    public $state;
public $filteredMateriels = [];

public $selectedMateriels = [];

public function retirerMateriel($id)
{
    $this->selectedMateriels = collect($this->selectedMateriels)
        ->reject(fn($item) => $item['id'] == $id)
        ->values()
        ->toArray();
}
public function ajouterMateriel($id)
{
    // Cherche l'ordinateur correspondant
    $ordinateur = ordinateur::find($id);

    if ($ordinateur && !collect($this->selectedMateriels)->pluck('id')->contains($ordinateur->id)) {
        // On pousse dans la collection s’il n’existe pas déjà
        $this->selectedMateriels[] = [
            'id' => $ordinateur->id,
            'modele' => $ordinateur->modele,
            'os_version' => $ordinateur->os_version,
            'statut' => $ordinateur->statut,
        ];
    }
}
public function updatedSearch()
{
    if (strlen($this->search) > 1) {
        
        if($this->search == "ordinateur"){
            $ordinateurs = ordinateur::get()
            ->map(function ($item) {
                return (object)[
                    'type' => 'ordinateur',
                    'id' => $item->id,
                    'label' => trim($item->modele . ' ' . $item->os_version),
                ];
            });
        }
        // Recherche ordinateurs
        $ordinateurs = ordinateur::query()
            ->where('statut', 'En stock')
            ->where(function ($query) {
                $query->where('modele', 'like', '%' . $this->search . '%')
                      ->orWhere('os_version', 'like', '%' . $this->search . '%');
            })
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'type' => 'ordinateur',
                    'id' => $item->id,
                    'label' => trim($item->modele . ' ' . $item->os_version),
                ];
            });

        // Recherche moniteurs
        $moniteurs = moniteur::query()
            ->where('statut', 'En stock')
            ->where(function ($query) {
                $query->where('modele', 'like', '%' . $this->search . '%')
                      ->orWhere('fabricant', 'like', '%' . $this->search . '%');
            })
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'type' => 'moniteur',
                    'id' => $item->id,
                    'label' => trim($item->modele . ' ' . ($item->fabricant ?? '')),
                ];
            });

        // Fusionner proprement
        $this->filteredMateriels = collect($ordinateurs)
            ->merge($moniteurs)
            ->take(10)
            ->values()
            ->all(); // ✅ on convertit bien en array d’objets simples

    } else {
        $this->filteredMateriels = [];
    }
}

public function selectMateriel($val)
{
    $this->search = $val;
    $this->filteredMateriels = [];
}
    public function visiterTicket(){
        return redirect("/utilisateur-service");
    }
 

    public function mount(){
        $this->recherche;

        $ordinateur = ordinateur::find(1);
       // dd(gettype($ordinateur->statut));
        
       // dd($this->state);
    }

    public function render()
    {
         $user_ID =  Auth::guard('utilisateur')->user()->id;
        // $ordinateurs = collect();
          //  $moniteurs = collect();
        $query = ordinateur::query();
        if ($this->state) {
          $query->parStatut($this->state);
    }

        $query1 =  moniteur::query();
        if ($this->state) {
            $query1->parStatut($this->state);
        }

    return view('livewire.utilisateur.checkout.checkout', [
        "ordinateurs" => $query->paginate(5),
        "moniteurs" => $query1->get(),
    ]);
}
    
}

