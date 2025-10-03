<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipement;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $equipement = [
        'identification' => '',
        'nom_public' => '',
        'emplacement' => '',
        'marque' => '',
        'model' => '',
        'type' => '',
        'numero_serie' => '',
        'couleur' => 'noir',
        'technologie_impression' => 'laser',
        'reference_cartouche' => '',
        'date_entree_stock' => '',
        'adresse_ip' => '',
        'statut' => 'en_stock',
        'description' => '',
        'photo' => null
    ];

    public $types = ['Imprimante', 'Ordinateur', 'Écran', 'Souris', 'Clavier', 'Onduleur', 'Scanner', 'Photocopieur'];
    public $emplacements = ['Bureau A', 'Bureau B', 'Salle de réunion', 'Entrepôt', 'Atelier'];
    public $marques = ['HP', 'Canon', 'Epson', 'Dell', 'Lenovo', 'Apple', 'Samsung', 'Brother'];
    public $couleurs = ['noir', 'blanc', 'gris', 'bleu', 'rouge'];
    public $technologies = ['laser', 'jet d\'encre', 'thermique', '3D'];
    public $statuts = [
        'en_stock' => 'En Stock',
        'en_pret' => 'En Prêt',
        'en_maintenance' => 'En Maintenance'
    ];

    protected $rules = [
        'equipementSeeder.identification' => 'required|unique:equipements,identification',
        'equipementSeeder.nom_public' => 'required|string|max:255',
        'equipementSeeder.emplacement' => 'required|string|max:255',
        'equipementSeeder.marque' => 'required|string|max:255',
        'equipementSeeder.model' => 'required|string|max:255',
        'equipementSeeder.type' => 'required|string|max:255',
        'equipementSeeder.numero_serie' => 'nullable|string|max:255',
        'equipementSeeder.couleur' => 'required|string|max:255',
        'equipementSeeder.technologie_impression' => 'nullable|string|max:255',
        'equipementSeeder.reference_cartouche' => 'nullable|string|max:255',
        'equipementSeeder.date_entree_stock' => 'required|date',
        'equipementSeeder.adresse_ip' => 'nullable|ipv4',
        'equipementSeeder.statut' => 'required|string',
        'equipementSeeder.description' => 'nullable|string',
        'equipementSeeder.photo' => 'nullable|image|max:2048'
    ];

    public function mount()
    {
        $this->generateId();
    }

    public function openCreateModal()
    {
        $this->isOpen = true;
        $this->resetErrorBag();
        $this->generateId();
    }

    public function closeCreateModal()
    {
        $this->isOpen = false;
        $this->resetErrorBag();
        $this->reset('equipementSeeder');
        $this->generateId();
    }

    public function generateId()
    {
        $this->equipement['identification'] = 'EQP-' . now()->format('Ymd-His');
        $this->equipement['date_entree_stock'] = now()->format('Y-m-d');
    }

    public function createEquipement()
    {
        $this->validate();

        try {
            $data = $this->equipement;

            if ($this->equipement['photo']) {
                $data['photo'] = $this->equipement['photo']->store('equipements', 'public');
            }

            Equipement::create($data);

            $this->closeCreateModal();
            $this->emit('equipementCreated');
            session()->flash('success', 'Équipement créé avec succès!');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la création: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('equipementSeeder.create');
    }
}
