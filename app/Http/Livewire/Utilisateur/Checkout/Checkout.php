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
//use Livewire\WithPagination;


class Checkout extends Component
{
    //protected $paginationTheme = 'bootstrap';
    //use WithPagination;
    public $categorie = [];
    public $tickets;
    public $recherche;
    public $search = "";

    public $state;
    public $filteredMateriels = [];

    public $equipements = [];

    public $filtrerMateriel = "";

    public $selectedMateriels = [];

    public function visiterTicket()
    {
        return redirect("/utilisateur-service");
    }


    public function mount()
    {
        $this->recherche;
        $this->filtrerMateriel;
        $ordinateur = ordinateur::find(1);
         $this->equipements = collect([
            ['id' => 1, 'type' => 'Ordinateur portable', 'statut' => 'En stock'],
            ['id' => 2, 'type' => 'Ordinateur de bureau', 'statut' => 'En stock'],
            ['id' => 3, 'type' => 'Moniteur', 'statut' => 'En stock'],
            ['id' => 4, 'type' => 'Clavier', 'statut' => 'En stock'],
            ['id' => 5, 'type' => 'Souris', 'statut' => 'En stock'],
            ['id' => 6, 'type' => 'Périphérique USB', 'statut' => 'En stock'],
            ['id' => 7, 'type' => 'Bluetooth', 'statut' => 'En stock'],
            ['id' => 8, 'type' => 'Dongle', 'statut' => 'En stock'],
            ['id' => 9, 'type' => 'Casque filaire', 'statut' => 'En stock'],
            ['id' => 10, 'type' => 'Casque sans fil', 'statut' => 'En stock'],
            ['id' => 11, 'type' => 'Microphone', 'statut' => 'En stock'],
            ['id' => 12, 'type' => 'Jabra', 'statut' => 'En stock'],
            ['id' => 13, 'type' => 'Projecteur', 'statut' => 'En stock'],
            ['id' => 14, 'type' => 'Chargeur', 'statut' => 'En stock'],
            ['id' => 15, 'type' => 'Adaptateur', 'statut' => 'En stock'],
            ['id' => 16, 'type' => 'Imprimante', 'statut' => 'En stock'],
            ['id' => 17, 'type' => 'Scanner', 'statut' => 'En stock'],
            ['id' => 18, 'type' => 'Tablette', 'statut' => 'En stock'],
            ['id' => 19, 'type' => 'Téléphone mobile', 'statut' => 'En stock'],
            ['id' => 20, 'type' => 'Câble USB Type-C', 'statut' => 'En stock'],
            ['id' => 21, 'type' => 'Câble Lightning (iPhone)', 'statut' => 'En stock'],
            ['id' => 22, 'type' => 'Câble HDMI', 'statut' => 'En stock'],
            ['id' => 23, 'type' => 'Câble USB-A', 'statut' => 'En stock'],
            ['id' => 24, 'type' => 'Câble audio jack 3.5mm', 'statut' => 'En stock'],
        ]);
        // dd(gettype($ordinateur->statut));

        // dd($this->state);
    }

        public function getFilteredEquipementsProperty()
    {
        if ($this->search == '') {
            return $this->equipements;
        }

        return $this->equipements->filter(function ($equip) {
            return str_contains(strtolower($equip['type']), strtolower($this->search));
        })->values(); // values() pour réindexer le tableau
    }

    public function render()
    {
        $user_ID = Auth::guard('utilisateur')->user()->id;

        $queryOrdinateurs = Ordinateur::query();
        $queryMoniteurs = Moniteur::query();

        if ($this->state) {
            $queryOrdinateurs->parStatut($this->state);
            $queryMoniteurs->parStatut($this->state);
        }

        // Récupération des données
        $ordinateurs = $queryOrdinateurs->paginate(5);
        $moniteurs = $queryMoniteurs->paginate(5);

        // Fusion dans une seule collection
        $materiels = $ordinateurs->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'Ordinateur',
                'modele' => $item->modele,
                'details' => $item->details,
                'statut' => $item->statut,
                'created_at' => $item->created_at,
            ];
        })->merge(
                $moniteurs->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'type' => 'Moniteur',
                        'modele' => $item->modele,
                        'details' => $item->details,
                        'statut' => $item->statut,
                        'created_at' => $item->created_at,
                    ];
                })
            );

        return view('livewire.utilisateur.checkout.checkout', [
            'materiels' => $materiels,
            'ordinateurs' => ordinateur::where("statut","En stock")->paginate(10),
            "moniteurs" => moniteur::where("statut", "En stock")->paginate(10),
            'equipements' => $this->filteredEquipements
        ]);
    }

}

