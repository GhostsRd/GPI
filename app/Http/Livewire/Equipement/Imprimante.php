<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Imprimante as ImprimanteModel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;


class Imprimante extends Component
{
    use WithPagination, WithFileUploads;



    // Propriétés pour le formulaire
    public $imprimanteId;
    public $nom;

    public $numero_serie;
    public $utilisateur_id;
    public $usager_id;
    public $lieu;


    // États des modals
    public $isEditing = false;
    public $showModal = false;

    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $isImporting = false;



    // Règles de validation
    protected $rules = [
        'nom' => 'required|string|max:100',

    ];

    /**
     * Initialisation du composant
     */
    public function mount()
    {

    }

    /**
     * Rendu du composant
     */
    public function render()
    {
        $query = $this->getImprimantesQuery();
        $query->orderBy($this->sortField, $this->sortDirection);



        // Si c'est un fichier CSV, passer directement au mapping
        $extension = $this->importFile->getClientOriginalExtension();
        
        if (in_array($extension, ['csv', 'txt'])) {
            $this->storeImportFile();
        } else {
            // Pour les fichiers Excel, utiliser l'import direct
            Excel::import(new ImprimantesImport, $this->importFile);
            
            $this->showImportModal = false;
            $this->isImporting = false;
            $this->resetImport();
            
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();
            
            session()->flash('message', 'Imprimantes importées avec succès via Excel.');
        }

    } catch (\Exception $e) {
        $this->isImporting = false;
        $this->importErrors[] = 'Erreur lors de l\'import: ' . $e->getMessage();
        session()->flash('error', 'Erreur lors de l\'import: ' . $e->getMessage());
    }
}

/**
 * Fermer le modal de mapping
 */
public function closeMappingModal()
{
    $this->showMappingModal = false;
    $this->resetImport();
}

/**
 * Fermer la modal de suppression
 */
public function closeDeleteModal()
{
    $this->confirmingDelete = false;
    $this->deleteId = null;
    $this->selectedImprimanteName = '';
}

    // ==================== MÉTHODES DE RECHERCHE ET FILTRES ====================

    /**
     * Obtenir la requête de base pour les imprimantes
     */
    private function getImprimantesQuery()
    {
        $query = ImprimanteModel::with(['utilisateur', 'usager']);

        // Application des filtres
        if ($this->statut) {
            $query->where('statut', $this->statut);
        }

        if ($this->entite) {
            $query->where('entite', $this->entite);
        }


    }

    /**
     * Trier les résultats
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    /**

    }

    // ==================== MÉTHODES CRUD ====================

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $imprimante = ImprimanteModel::findOrFail($id);

        $this->imprimanteId = $imprimante->id;
        $this->nom = $imprimante->nom;

        $this->numero_serie = $imprimante->numero_serie;
        $this->utilisateur_id = $imprimante->utilisateur_id;
        $this->usager_id = $imprimante->usager_id;
        $this->lieu = $imprimante->lieu;


        $this->isEditing = true;
        $this->showModal = true;
    }

    /**
     * Enregistrer une nouvelle imprimante
     */

    /**
     * Afficher les détails d'une imprimante
     */
    public function showDetails($id)
    {

    {
        try {
            // Statistiques globales par statut
            $this->statsGlobales = ImprimanteModel::select('statut', DB::raw('COUNT(*) as count'))
                ->groupBy('statut')
                ->get()
                ->pluck('count', 'statut')
                ->toArray();

            // Pour compatibilité avec le template
            $this->stats = [
                'total' => ImprimanteModel::count(),
                'en_service' => ImprimanteModel::where('statut', 'En service')->count(),
                'en_maintenance' => ImprimanteModel::where('statut', 'En maintenance')->count(),
                'hors_service' => ImprimanteModel::where('statut', 'Hors service')->count(),
                'en_stock' => ImprimanteModel::where('statut', 'En stock')->count(),
            ];

            // Statistiques par entité
            $this->statsParEntite = ImprimanteModel::select('entite', DB::raw('COUNT(*) as count'))
                ->whereNotNull('entite')
                ->groupBy('entite')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

            // Statistiques par fabricant
            $this->statsParFabricant = ImprimanteModel::select('fabricant', DB::raw('COUNT(*) as count'))
                ->whereNotNull('fabricant')
                ->groupBy('fabricant')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

            // Statistiques par type
            $this->statsParType = ImprimanteModel::select('type', DB::raw('COUNT(*) as count'))
                ->whereNotNull('type')
                ->groupBy('type')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

        } catch (\Throwable $e) {
            // En cas d'erreur, initialise les données à vide
            $this->statsGlobales     = [];
            $this->statsParEntite    = [];
            $this->statsParFabricant = [];
            $this->statsParType      = [];

            $this->stats = [
                'total' => 0,
                'en_service' => 0,
                'en_maintenance' => 0,
                'hors_service' => 0,
                'en_stock' => 0,
            ];
        }
    }

    /**

     * Réinitialiser le formulaire
     */
    private function resetForm()
    {
        $this->reset([

        ]);
        $this->resetErrorBag();
    }


    // ==================== MÉTHODES DE PAGINATION ====================

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatut()
    {
        $this->resetPage();
    }

    public function updatingEntite()
    {
        $this->resetPage();
    }

    public function updatingFabricant()
    {
        $this->resetPage();
    }

}
