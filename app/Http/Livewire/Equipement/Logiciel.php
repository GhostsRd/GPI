<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Logiciel as LogicielModel;
use Illuminate\Support\Facades\DB;

class Logiciel extends Component
{
    use WithPagination;

    public $search = '';
    public $editeur = '';
    public $systeme_exploitation = '';
    public $sortField = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 20;

    // Propriétés pour la création/édition
    public $logicielId;
    public $nom;
    public $editeur_form;
    public $version_nom;
    public $version_systeme_exploitation;
    public $nombre_installations = 0;
    public $nombre_licences = 0;
    public $description;
    public $date_achat;
    public $date_expiration;

    public $showModal = false;
    public $showDeleteModal = false;
    public $modalTitle = 'Ajouter un Logiciel';
    public $editing = false;

    protected $rules = [
        'nom' => 'required|string|max:150',
        'editeur_form' => 'nullable|string|max:150',
        'version_nom' => 'nullable|string|max:100',
        'version_systeme_exploitation' => 'nullable|string|max:100',
        'nombre_installations' => 'nullable|integer|min:0',
        'nombre_licences' => 'nullable|integer|min:0',
        'description' => 'nullable|string',
        'date_achat' => 'nullable|date',
        'date_expiration' => 'nullable|date|after_or_equal:date_achat',
    ];

    // Ajout des messages de validation personnalisés
    protected $messages = [
        'nom.required' => 'Le nom du logiciel est obligatoire.',
        'date_expiration.after_or_equal' => 'La date d\'expiration doit être postérieure ou égale à la date d\'achat.',
    ];

    public function render()
    {
        $query = LogicielModel::query();

        // Filtres de recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('nom', 'like', "%{$this->search}%")
                  ->orWhere('editeur', 'like', "%{$this->search}%")
                  ->orWhere('version_nom', 'like', "%{$this->search}%");
            });
        }

        if ($this->editeur) {
            $query->where('editeur', $this->editeur);
        }

        if ($this->systeme_exploitation) {
            $query->where('version_systeme_exploitation', 'like', "%{$this->systeme_exploitation}%");
        }

        // Tri
        if (in_array($this->sortField, ['nom', 'editeur', 'version_nom', 'nombre_installations', 'nombre_licences'])) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        $logiciels = $query->paginate($this->perPage);

        // Statistiques
        $stats = [
            'total' => LogicielModel::count(),
            'licences_critiques' => LogicielModel::licencesCritiques()->count(),
            'total_installations' => LogicielModel::sum('nombre_installations'),
            'total_licences' => LogicielModel::sum('nombre_licences'),
        ];

        $editeurs = LogicielModel::distinct()->pluck('editeur')->filter();
        $systemes = LogicielModel::distinct()->pluck('version_systeme_exploitation')->filter();

        return view('livewire.equipement.logiciel', compact('logiciels', 'stats', 'editeurs', 'systemes'));
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function create()
    {
        $this->resetForm();
        $this->modalTitle = 'Ajouter un Logiciel';
        $this->editing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $logiciel = LogicielModel::findOrFail($id);
        
        $this->logicielId = $logiciel->id;
        $this->nom = $logiciel->nom;
        $this->editeur_form = $logiciel->editeur;
        $this->version_nom = $logiciel->version_nom;
        $this->version_systeme_exploitation = $logiciel->version_systeme_exploitation;
        $this->nombre_installations = $logiciel->nombre_installations;
        $this->nombre_licences = $logiciel->nombre_licences;
        $this->description = $logiciel->description;
        $this->date_achat = $logiciel->date_achat?->format('Y-m-d');
        $this->date_expiration = $logiciel->date_expiration?->format('Y-m-d');

        $this->modalTitle = 'Modifier le Logiciel';
        $this->editing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nom' => $this->nom,
            'editeur' => $this->editeur_form,
            'version_nom' => $this->version_nom,
            'version_systeme_exploitation' => $this->version_systeme_exploitation,
            'nombre_installations' => $this->nombre_installations ?? 0,
            'nombre_licences' => $this->nombre_licences ?? 0,
            'description' => $this->description,
            'date_achat' => $this->date_achat ?: null,
            'date_expiration' => $this->date_expiration ?: null,
        ];

        try {
            if ($this->editing) {
                $logiciel = LogicielModel::findOrFail($this->logicielId);
                $logiciel->update($data);
                $message = 'Logiciel mis à jour avec succès.';
            } else {
                LogicielModel::create($data);
                $message = 'Logiciel créé avec succès.';
            }

            $this->showModal = false;
            $this->resetForm();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('success', $message);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'enregistrement: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $this->logicielId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        try {
            $logiciel = LogicielModel::findOrFail($this->logicielId);
            $logiciel->delete();
            
            $this->showDeleteModal = false;
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('success', 'Logiciel supprimé avec succès.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset([
            'logicielId',
            'nom',
            'editeur_form',
            'version_nom',
            'version_systeme_exploitation',
            'nombre_installations',
            'nombre_licences',
            'description',
            'date_achat',
            'date_expiration',
        ]);
        $this->resetErrorBag();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'editeur', 'systeme_exploitation']);
        $this->resetPage();
    }

    // Méthodes pour le dashboard (propriétés calculées)
    public function getLogicielsCritiquesProperty()
    {
        return LogicielModel::licencesCritiques()
            ->orderByRaw('(nombre_installations / nombre_licences) DESC')
            ->get();
    }

    public function getLogicielsParEditeurProperty()
    {
        return LogicielModel::select('editeur', DB::raw('COUNT(*) as count'))
            ->whereNotNull('editeur')
            ->groupBy('editeur')
            ->orderBy('count', 'desc')
            ->get();
    }

    public function getDashboardStatsProperty()
    {
        return [
            'total_logiciels' => LogicielModel::count(),
            'licences_critiques' => $this->logicielsCritiques->count(),
            'taux_utilisation_moyen' => LogicielModel::where('nombre_licences', '>', 0)
                ->avg(DB::raw('(nombre_installations / nombre_licences) * 100')) ?? 0,
        ];
    }

    // Fermer les modales
    public function closeModal()
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->resetForm();
    }
}