<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Incident as IncidentModel;
use App\Models\Service;
use App\Models\Department;
use App\Models\Ordinateur;
use App\Models\Imprimante;
use App\Models\Telephone;
use App\Models\Logiciel;
use App\Models\Peripherique;
use App\Models\Moniteur;
use App\Models\MaterielReseau;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Incident extends Component
{
    use WithPagination;

    public $selectedIncidents = [];
    public $recherche = '';
    public $disabled = "disabled";
    public $nature = "";
    public $statut = "";
    public $showDeleteModal = false;
    public $incidentToDelete = null;
    public $isBulkDelete = false;
    public $selectedIncidentNature = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $date_debut = '';
    public $date_fin = '';

    // Propriétés pour le formulaire
    public $incident_id;
    public $utilisateur_id;
    public $service_id;
    public $department_id;
    public $materiel_id;
    public $type_materiel = '';
    public $date_incident;
    public $nature_incident;
    public $numero_rapport;
    public $details_panne;
    public $lieu_perte;
    public $observation;
    public $statut_final = 'nouveau';
    public $technicien_id;

    public $showForm = false;
    public $editMode = false;

    protected $rules = [
        'utilisateur_id' => 'required|exists:users,id',
        'service_id' => 'nullable',
        'department_id' => 'nullable',
        'type_materiel' => 'required|in:ordinateur,imprimante,telephone,logiciel,peripherique,moniteur,reseau,autre',
        'materiel_id' => 'nullable',
        'date_incident' => 'required|date',
        'nature_incident' => 'required|string|max:255',
        'numero_rapport' => 'nullable|unique:incidents,numero_rapport',
        'details_panne' => 'nullable|string',
        'lieu_perte' => 'nullable|string|max:255',
        'observation' => 'nullable|string',
        'statut_final' => 'required|in:nouveau,en_cours,resolu,clos',
        'technicien_id' => 'nullable|exists:users,id'
    ];

    protected $messages = [
        'utilisateur_id.required' => 'L\'utilisateur est requis.',
        'date_incident.required' => 'La date de l\'incident est requise.',
        'nature_incident.required' => 'La nature de l\'incident est requise.',
        'type_materiel.required' => 'Le type de matériel est requis.',
        'statut_final.required' => 'Le statut est requis.',
    ];

    public function mount()
    {
        $this->utilisateur_id = Auth::id();
        $this->date_incident = now()->format('Y-m-d');
    }

    public function updatedTypeMateriel()
    {
        $this->materiel_id = null;
    }

    public function getMaterielsProperty()
    {
        if (!$this->type_materiel) {
            return collect();
        }

        try {
            switch ($this->type_materiel) {
                case 'ordinateur':
                    return class_exists(Ordinateur::class) ? Ordinateur::all() : collect();
                case 'imprimante':
                    return class_exists(Imprimante::class) ? Imprimante::all() : collect();
                case 'telephone':
                    return class_exists(Telephone::class) ? Telephone::all() : collect();
                case 'logiciel':
                    return class_exists(Logiciel::class) ? Logiciel::all() : collect();
                case 'peripherique':
                    return class_exists(Peripherique::class) ? Peripherique::all() : collect();
                case 'moniteur':
                    return class_exists(Moniteur::class) ? Moniteur::all() : collect();
                case 'reseau':
                    return class_exists(MaterielReseau::class) ? MaterielReseau::all() : collect();
                default:
                    return collect();
            }
        } catch (\Exception $e) {
            return collect();
        }
    }

    // Méthodes helper pour la vue
    public function getCategoryColor($type)
    {
        $colors = [
            'ordinateur' => 'blue',
            'imprimante' => 'purple',
            'telephone' => 'green',
            'logiciel' => 'indigo',
            'peripherique' => 'yellow',
            'moniteur' => 'blue',
            'reseau' => 'red',
            'autre' => 'gray'
        ];

        return $colors[$type] ?? 'gray';
    }

    public function getCategoryIcon($type)
    {
        $icons = [
            'ordinateur' => '💻',
            'imprimante' => '🖨️',
            'telephone' => '📱',
            'logiciel' => '💾',
            'peripherique' => '⌨️',
            'moniteur' => '🖥️',
            'reseau' => '🌐',
            'autre' => '🔧'
        ];

        return $icons[$type] ?? '🔧';
    }

    public function getStatusConfig($status)
    {
        $configs = [
            'nouveau' => ['class' => 'nouveau', 'icon' => '🆕'],
            'en_cours' => ['class' => 'en_cours', 'icon' => '🔄'],
            'resolu' => ['class' => 'resolu', 'icon' => '✅'],
            'clos' => ['class' => 'clos', 'icon' => '🔒']
        ];

        return $configs[$status] ?? ['class' => 'clos', 'icon' => '🔒'];
    }

    public function confirmDelete($incidentId)
    {
        $incident = IncidentModel::find($incidentId);
        if ($incident) {
            $this->incidentToDelete = $incidentId;
            $this->selectedIncidentNature = $incident->nature_incident;
            $this->isBulkDelete = false;
            $this->showDeleteModal = true;
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->incidentToDelete = null;
    }

    public function deleteConfirmed()
    {
        try {
            if ($this->isBulkDelete) {
                $count = IncidentModel::whereIn('id', $this->selectedIncidents)->delete();
                $this->selectedIncidents = [];
                session()->flash('message', "{$count} incident(s) supprimé(s) avec succès.");
            } else if ($this->incidentToDelete) {
                IncidentModel::find($this->incidentToDelete)?->delete();
                session()->flash('message', 'Incident supprimé avec succès.');
            }
            
            $this->showDeleteModal = false;
            $this->incidentToDelete = null;
            $this->selectedIncidentNature = '';
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function confirmBulkDelete()
    {
        if (empty($this->selectedIncidents)) {
            session()->flash('error', 'Aucun incident sélectionné.');
            return;
        }

        $this->isBulkDelete = true;
        $this->showDeleteModal = true;
    }

    public function deleteSelected()
    {
        $this->confirmBulkDelete();
    }

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editMode = false;
    }

    public function showEditForm($incidentId)
    {
        $incident = IncidentModel::with(['utilisateur', 'service', 'department', 'technicien'])->findOrFail($incidentId);
        
        $this->incident_id = $incident->id;
        $this->utilisateur_id = $incident->utilisateur_id;
        $this->service_id = $incident->service_id;
        $this->department_id = $incident->department_id;
        $this->type_materiel = $incident->type_materiel ?? '';
        $this->materiel_id = $incident->materiel_id;
        $this->date_incident = $incident->date_incident->format('Y-m-d');
        $this->nature_incident = $incident->nature_incident;
        $this->numero_rapport = $incident->numero_rapport;
        $this->details_panne = $incident->details_panne;
        $this->lieu_perte = $incident->lieu_perte;
        $this->observation = $incident->observation;
        $this->statut_final = $incident->statut_final;
        $this->technicien_id = $incident->technicien_id;

        $this->showForm = true;
        $this->editMode = true;
    }

    public function saveIncident()
    {
        if ($this->editMode) {
            $this->rules['numero_rapport'] = 'nullable|unique:incidents,numero_rapport,' . $this->incident_id;
        }

        $this->validate();

        $data = [
            'utilisateur_id' => $this->utilisateur_id,
            'service_id' => $this->service_id,
            'department_id' => $this->department_id,
            'type_materiel' => $this->type_materiel,
            'materiel_id' => $this->materiel_id,
            'date_incident' => $this->date_incident,
            'nature_incident' => $this->nature_incident,
            'numero_rapport' => $this->numero_rapport,
            'details_panne' => $this->details_panne,
            'lieu_perte' => $this->lieu_perte,
            'observation' => $this->observation,
            'statut_final' => $this->statut_final,
            'technicien_id' => $this->technicien_id,
        ];

        try {
            if ($this->editMode) {
                IncidentModel::find($this->incident_id)->update($data);
                $message = 'Incident modifié avec succès.';
            } else {
                IncidentModel::create($data);
                $message = 'Incident créé avec succès.';
            }

            $this->showForm = false;
            $this->resetForm();
            session()->flash('message', $message);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la sauvegarde: ' . $e->getMessage());
        }
    }

    public function cancelForm()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset([
            'incident_id',
            'service_id',
            'department_id',
            'type_materiel',
            'materiel_id',
            'nature_incident',
            'numero_rapport',
            'details_panne',
            'lieu_perte',
            'observation',
            'statut_final',
            'technicien_id'
        ]);
        $this->utilisateur_id = Auth::id();
        $this->date_incident = now()->format('Y-m-d');
        $this->resetErrorBag();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        try {
            $query = IncidentModel::with(['utilisateur', 'service', 'department', 'technicien'])
                ->when($this->nature, function ($query) {
                    $query->where("nature_incident", "like", "%" . $this->nature . "%");
                })
                ->when($this->statut, function ($query) {
                    $query->where("statut_final", $this->statut);
                })
                ->when($this->date_debut, function ($query) {
                    $query->where("date_incident", ">=", $this->date_debut);
                })
                ->when($this->date_fin, function ($query) {
                    $query->where("date_incident", "<=", $this->date_fin);
                })
                ->when($this->recherche, function ($query) {
                    $query->where(function ($q) {
                        $q->where("nature_incident", "like", "%" . $this->recherche . "%")
                          ->orWhere("numero_rapport", "like", "%" . $this->recherche . "%")
                          ->orWhere("lieu_perte", "like", "%" . $this->recherche . "%")
                          ->orWhereHas('utilisateur', function ($userQuery) {
                              $userQuery->where('name', 'like', '%' . $this->recherche . '%');
                          });
                    });
                })
                ->orderBy($this->sortField, $this->sortDirection);

            $incidents = $query->paginate(10);

            // Récupérer les services et départements de manière sécurisée
            $services = class_exists(Service::class) ? Service::all() : collect();
            $departments = class_exists(Department::class) ? Department::all() : collect();
            
            // Solution simple : prendre tous les utilisateurs comme techniciens potentiels
            $techniciens = User::all();

            // Récupérer les matériels selon le type sélectionné
            $materiels = $this->getMaterielsProperty();

            $totalIncidents = IncidentModel::count();
            $nouveauxIncidents = IncidentModel::where("statut_final", "nouveau")->count();
            $enCoursIncidents = IncidentModel::where("statut_final", "en_cours")->count();
            $resolusIncidents = IncidentModel::where("statut_final", "resolu")->count();
            $closIncidents = IncidentModel::where("statut_final", "clos")->count();

        } catch (\Exception $e) {
            // En cas d'erreur (table non créée), utiliser des valeurs par défaut
            $incidents = collect()->paginate(10);
            $services = collect();
            $departments = collect();
            $techniciens = collect();
            $materiels = collect();
            $totalIncidents = 0;
            $nouveauxIncidents = 0;
            $enCoursIncidents = 0;
            $resolusIncidents = 0;
            $closIncidents = 0;
        }

        return view('livewire.equipement.incident', [
            "incidents" => $incidents,
            "services" => $services,
            "departments" => $departments,
            "techniciens" => $techniciens,
            "materiels" => $materiels,
            "totalIncidents" => $totalIncidents,
            "nouveauxIncidents" => $nouveauxIncidents,
            "enCoursIncidents" => $enCoursIncidents,
            "resolusIncidents" => $resolusIncidents,
            "closIncidents" => $closIncidents,
        ]);
    }
}
