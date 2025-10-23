<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Ordinateur as OrdinateurModel;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrdinateursImport;

class Ordinateur extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $statut = '';
    public $entite = '';
    public $perPage = 20;
    protected $paginationTheme = 'bootstrap';

    // Variables pour le formulaire
    public $ordinateurId;
    public $nom;
    public $entite_form;
    public $sous_entite;
    public $statut_form = 'En service';
    public $fabricant;
    public $fabricants = [];

    public $modele;
    public $numero_serie;
    public $utilisateur_id;
    public $usager_id;
    public $date_dernier_inventaire;
    public $reseau_ip;
    public $disque_dur;
    public $os_version;
    public $os_noyau;
    public $derniere_date_demarrage;
    public $notes;

    // États des modals
    public $showModal = false;
    public $showDetailsModal = false;
    public $showImportModal = false;
    public $showMappingModal = false;
    public $showImportedData = false;
    public $modalTitle = 'Ajouter un ordinateur';
    public $editMode = false;
    public $selectedOrdinateur = null;

    // Propriétés pour l'import avec mapping
    public $fichierExcel;
    public $importProgress = 0;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $isImporting = false;
    public $stats = []; 

    // Propriétés pour le mapping
    public $csvHeaders = [];
    public $csvPreview = [];
    public $fieldMapping = [
        'nom' => '',
        'entite' => '',
        'sous_entite' => '',
        'statut' => '',
        'fabricant' => '',
        'modele' => '',
        'numero_serie' => '',
        'utilisateur' => '',
        'usager' => '',
        'date_dernier_inventaire' => '',
        'reseau_ip' => '',
        'disque_dur' => '',
        'os_version' => '',
        'os_noyau' => '',
        'derniere_date_demarrage' => '',
        'notes' => ''
    ];

    // Données importées temporaires
    public $importedData = [];

    // Statistiques
    public $statsGlobales = [];

    protected $rules = [
        'nom' => 'required|string|max:100|unique:ordinateurs,nom',
        'entite_form' => 'nullable|string|max:100',
        'sous_entite' => 'nullable|string|max:100',
        'statut_form' => 'required|in:En service,En stock,Hors service,En réparation',
        'fabricant' => 'nullable|string|max:100',
        'modele' => 'nullable|string|max:100',
        'numero_serie' => 'nullable|string|max:100|unique:ordinateurs,numero_serie',
        'utilisateur_id' => 'nullable|exists:utilisateurs,id',
        'usager_id' => 'nullable|exists:utilisateurs,id',
        'date_dernier_inventaire' => 'nullable|date',
        'reseau_ip' => 'nullable|ip',
        'disque_dur' => 'nullable|string|max:50',
        'os_version' => 'nullable|string|max:100',
        'os_noyau' => 'nullable|string|max:100',
        'derniere_date_demarrage' => 'nullable|date',
        'notes' => 'nullable|string'
    ];

    // Règles pour l'import
    protected $importRules = [
        'fichierExcel' => 'required|file|mimes:csv,txt|max:10240'
    ];

    protected $messages = [
        'fichierExcel.required' => 'Veuillez sélectionner un fichier',
        'fichierExcel.mimes' => 'Le fichier doit être de type CSV',
        'fichierExcel.max' => 'Le fichier ne doit pas dépasser 10MB'
    ];

    public function mount()
    {
        $this->chargerStatistiques();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'statut', 'entite', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = OrdinateurModel::with(['utilisateur', 'usager']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nom', 'LIKE', "%{$this->search}%")
                    ->orWhere('numero_serie', 'LIKE', "%{$this->search}%")
                    ->orWhere('fabricant', 'LIKE', "%{$this->search}%")
                    ->orWhere('modele', 'LIKE', "%{$this->search}%")
                    ->orWhere('reseau_ip', 'LIKE', "%{$this->search}%")
                    ->orWhereHas('utilisateur', function ($q) {
                        $q->where('name', 'LIKE', "%{$this->search}%");
                    });
            });
        }

        if ($this->statut) {
            $query->where('statut', $this->statut);
        }

        if ($this->entite) {
            $query->where('entite', 'LIKE', "%{$this->entite}%");
        }

        $ordinateurs = $query->orderBy('nom')->paginate($this->perPage);
        $utilisateurs = Utilisateur::orderBy('nom')->get();
        $statuts = ['En service', 'En stock', 'Hors service', 'En réparation'];

        return view('livewire.equipement.ordinateur', compact('ordinateurs', 'utilisateurs', 'statuts'));
    }

    // ==================== MÉTHODES D'IMPORT AVEC MAPPING ====================

    /**
     * Ouvrir la modal d'import
     */
    public function openImportModal()
    {
        $this->showImportModal = true;
        $this->resetImport();
    }

    /**
     * Fermer la modal d'import
     */
    public function closeImportModal()
    {
        $this->showImportModal = false;
        $this->resetImport();
    }

    /**
     * Réinitialiser l'import
     */
    private function resetImport()
    {
        $this->reset([
            'fichierExcel', 
            'importProgress', 
            'importErrors', 
            'importSuccessCount',
            'csvHeaders',
            'csvPreview',
            'importedData',
            'showImportedData'
        ]);
        $this->fieldMapping = [
            'nom' => '',
            'entite' => '',
            'sous_entite' => '',
            'statut' => '',
            'fabricant' => '',
            'modele' => '',
            'numero_serie' => '',
            'utilisateur' => '',
            'usager' => '',
            'date_dernier_inventaire' => '',
            'reseau_ip' => '',
            'disque_dur' => '',
            'os_version' => '',
            'os_noyau' => '',
            'derniere_date_demarrage' => '',
            'notes' => ''
        ];
        $this->resetErrorBag();
    }

    /**
     * Stocker le fichier et préparer le mapping
     */
    public function storeImportFile()
    {
        $this->validate($this->importRules);

        try {
            // Stocker le fichier
            $filePath = $this->fichierExcel->storeAs(
                'imports/ordinateurs',
                'import_' . time() . '.csv',
                'public'
            );

            // Lire le fichier CSV
            $this->readCsvFile(storage_path('app/public/' . $filePath));

            // Passer à l'étape de mapping
            $this->showImportModal = false;
            $this->showMappingModal = true;

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors du stockage du fichier: ' . $e->getMessage();
            session()->flash('error', 'Erreur lors du stockage du fichier: ' . $e->getMessage());
        }
    }

    /**
     * Lire le fichier CSV pour extraction des en-têtes et preview
     */
    private function readCsvFile($filePath)
    {
        try {
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0);
            $csv->setDelimiter(',');

            // Obtenir les en-têtes
            $this->csvHeaders = $csv->getHeader();
            
            // Obtenir un aperçu des données (5 premières lignes)
            $stmt = (new Statement())->limit(5);
            $records = $stmt->process($csv);
            
            $this->csvPreview = [];
            foreach ($records as $record) {
                $this->csvPreview[] = $record;
            }

            // Mapping automatique basé sur la similarité des noms
            $this->autoMapFields();

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors de la lecture du fichier: ' . $e->getMessage();
        }
    }

     // Méthodes pour ouvrir et fermer la modale
    public function openMappingModal()
    {
        $this->showMappingModal = true;
    }

    public function closeMappingModal()
    {
        $this->showMappingModal = false;
    }

    /**
     * Mapping automatique des champs
     */
    private function autoMapFields()
    {
        $fieldPatterns = [
            'nom' => ['nom', 'name', 'designation', 'libelle', 'ordinateur', 'computer', 'hostname'],
            'entite' => ['entite', 'entity', 'departement', 'service', 'department', 'division'],
            'sous_entite' => ['sous_entite', 'sous_entite', 'sous_entity', 'sub_department', 'sub_service'],
            'statut' => ['statut', 'status', 'etat', 'state', 'situation'],
            'fabricant' => ['fabricant', 'manufacturer', 'marque', 'brand', 'make', 'constructor'],
            'modele' => ['modele', 'model', 'reference', 'product', 'produit'],
            'numero_serie' => ['numero_serie', 'serial', 'serial_number', 'sn', 'no_serie', 'num_serie'],
            'utilisateur' => ['utilisateur', 'user', 'utilisateur_nom', 'user_name', 'affecte_a'],
            'usager' => ['usager', 'usager_nom', 'utilisateur_final', 'end_user'],
            'date_dernier_inventaire' => ['date_dernier_inventaire', 'date_inventaire', 'inventory_date', 'last_inventory'],
            'reseau_ip' => ['reseau_ip', 'ip', 'ip_address', 'adresse_ip', 'network_ip'],
            'disque_dur' => ['disque_dur', 'disque', 'stockage', 'hard_drive', 'storage', 'hdd', 'ssd'],
            'os_version' => ['os_version', 'os', 'operating_system', 'systeme_exploitation', 'version_os'],
            'os_noyau' => ['os_noyau', 'noyau', 'kernel', 'version_noyau', 'kernel_version'],
            'derniere_date_demarrage' => ['derniere_date_demarrage', 'date_demarrage', 'last_boot', 'boot_time', 'startup_date'],
            'notes' => ['notes', 'commentaires', 'comments', 'remarques', 'note', 'observation']
        ];

        foreach ($this->csvHeaders as $header) {
            $headerLower = strtolower(trim($header));
            
            foreach ($fieldPatterns as $field => $patterns) {
                foreach ($patterns as $pattern) {
                    if (str_contains($headerLower, $pattern) && empty($this->fieldMapping[$field])) {
                        $this->fieldMapping[$field] = $header;
                        break 2;
                    }
                }
            }
        }
    }

    /**
     * Traiter les données avec le mapping
     */
    public function processMappedData()
    {
        try {
            $this->importErrors = [];
            $this->importedData = [];

            // Trouver le dernier fichier importé
            $files = Storage::disk('public')->files('imports/ordinateurs');
            if (empty($files)) {
                throw new \Exception('Aucun fichier importé trouvé');
            }

            $latestFile = last($files);
            $filePath = storage_path('app/public/' . $latestFile);

            // Lire et traiter le fichier avec le mapping
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0);
            $csv->setDelimiter(',');

            $records = $csv->getRecords();
            $lineNumber = 1;

            foreach ($records as $record) {
                $lineNumber++;
                $mappedData = [];

                try {
                    // Appliquer le mapping
                    foreach ($this->fieldMapping as $field => $csvHeader) {
                        if (!empty($csvHeader) && isset($record[$csvHeader])) {
                            $mappedData[$field] = trim($record[$csvHeader]);
                        } else {
                            $mappedData[$field] = '';
                        }
                    }

                    // Validation des données requises
                    if (empty($mappedData['nom'])) {
                        $this->importErrors[] = "Ligne {$lineNumber}: Le nom est obligatoire";
                        continue;
                    }

                    // Nettoyer et formater les données
                    $mappedData = $this->cleanMappedData($mappedData);
                    
                    $this->importedData[] = $mappedData;

                } catch (\Exception $e) {
                    $this->importErrors[] = "Ligne {$lineNumber}: " . $e->getMessage();
                }
            }

            $this->importSuccessCount = count($this->importedData);
            $this->showMappingModal = false;
            $this->showImportedData = true;

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors du traitement des données: ' . $e->getMessage();
            session()->flash('error', 'Erreur lors du traitement des données: ' . $e->getMessage());
        }
    }

    /**
     * Nettoyer les données mappées
     */
    private function cleanMappedData($data)
    {
        // Nettoyer chaque champ
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            
            // Validation spécifique pour le statut
            if ($key === 'statut' && !empty($value)) {
                $statutsValides = ['En service', 'En stock', 'Hors service', 'En réparation'];
                if (!in_array($value, $statutsValides)) {
                    $data[$key] = 'En stock'; // Valeur par défaut
                }
            }

            // Gestion des dates
            if (in_array($key, ['date_dernier_inventaire', 'derniere_date_demarrage']) && !empty($value)) {
                try {
                    // Essayer de parser la date
                    $date = \Carbon\Carbon::parse($value);
                    $data[$key] = $date->format('Y-m-d');
                } catch (\Exception $e) {
                    // Si la date n'est pas valide, laisser vide
                    $data[$key] = null;
                }
            }
        }

        return $data;
    }

    /**
     * Sauvegarder les données importées dans la base
     */
  

    /**
     * Nettoyer les fichiers d'import temporaires
     */
    private function cleanImportFiles()
    {
        try {
            $files = Storage::disk('public')->files('imports/ordinateurs');
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }
        } catch (\Exception $e) {
            // Ignorer les erreurs de nettoyage
        }
    }

    /**
     * Annuler l'import
     */
    

    /**
     * Télécharger le template d'import
     */
    public function downloadTemplate()
    {
        $fileName = 'template_import_ordinateurs.csv';

        return response()->streamDownload(function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'nom', 'entite', 'sous_entite', 'statut', 'fabricant',
                'modele', 'numero_serie', 'utilisateur', 'usager',
                'date_dernier_inventaire', 'reseau_ip', 'disque_dur',
                'os_version', 'os_noyau', 'derniere_date_demarrage', 'notes'
            ]);

            fputcsv($file, [
                'ORD-PC-001',
                'Direction',
                'IT',
                'En service',
                'Dell',
                'Optiplex 7070',
                'ABC123XYZ',
                'John Doe',
                'Jane Smith',
                '2024-01-15',
                '192.168.1.100',
                '512GB SSD',
                'Windows 10 Pro',
                '10.0.19045',
                '2024-01-20 08:30:00',
                'Ordinateur de test'
            ]);

            fclose($file);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }

    // ==================== MÉTHODES CRUD ====================

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    /**
     * Afficher les détails d'un ordinateur
     */
    public function showDetails($id)
    {
        $this->selectedOrdinateur = OrdinateurModel::with(['utilisateur', 'usager'])->find($id);
        if ($this->selectedOrdinateur) {
            $this->showDetailsModal = true;
        }
    }

    /**
     * Fermer la modal de détails
     */
    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedOrdinateur = null;
    }

    public function create()
    {
        $this->resetForm();
        $this->modalTitle = 'Ajouter un ordinateur';
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $ordinateur = OrdinateurModel::findOrFail($id);

        $this->ordinateurId = $ordinateur->id;
        $this->nom = $ordinateur->nom;
        $this->entite_form = $ordinateur->entite;
        $this->sous_entite = $ordinateur->sous_entite;
        $this->statut_form = $ordinateur->statut;
        $this->fabricant = $ordinateur->fabricant;
        $this->modele = $ordinateur->modele;
        $this->numero_serie = $ordinateur->numero_serie;
        $this->utilisateur_id = $ordinateur->utilisateur_id;
        $this->usager_id = $ordinateur->usager_id;
        $this->date_dernier_inventaire = $ordinateur->date_dernier_inventaire
            ? $ordinateur->date_dernier_inventaire->format('Y-m-d')
            : null;
        $this->reseau_ip = $ordinateur->reseau_ip;
        $this->disque_dur = $ordinateur->disque_dur;
        $this->os_version = $ordinateur->os_version;
        $this->os_noyau = $ordinateur->os_noyau;
        $this->derniere_date_demarrage = $ordinateur->derniere_date_demarrage
            ? $ordinateur->derniere_date_demarrage->format('Y-m-d\TH:i')
            : null;
        $this->notes = $ordinateur->notes;

        $this->modalTitle = 'Modifier l\'ordinateur';
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->rules['nom'] = 'required|string|max:100|unique:ordinateurs,nom,' . $this->ordinateurId;
            $this->rules['numero_serie'] = 'nullable|string|max:100|unique:ordinateurs,numero_serie,' . $this->ordinateurId;
        }

        $this->validate();

        try {
            $data = [
                'nom' => $this->nom,
                'entite' => $this->entite_form,
                'sous_entite' => $this->sous_entite,
                'statut' => $this->statut_form,
                'fabricant' => $this->fabricant,
                'modele' => $this->modele,
                'numero_serie' => $this->numero_serie,
                'utilisateur_id' => $this->utilisateur_id,
                'usager_id' => $this->usager_id,
                'date_dernier_inventaire' => $this->date_dernier_inventaire,
                'reseau_ip' => $this->reseau_ip,
                'disque_dur' => $this->disque_dur,
                'os_version' => $this->os_version,
                'os_noyau' => $this->os_noyau,
                'derniere_date_demarrage' => $this->derniere_date_demarrage,
                'notes' => $this->notes,
            ];

            if ($this->editMode) {
                $ordinateur = OrdinateurModel::findOrFail($this->ordinateurId);
                $ordinateur->update($data);
                session()->flash('message', 'Ordinateur mis à jour avec succès.');
            } else {
                OrdinateurModel::create($data);
                session()->flash('message', 'Ordinateur créé avec succès.');
            }

            $this->resetForm();
            $this->showModal = false;
            $this->chargerStatistiques();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'opération: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $ordinateur = OrdinateurModel::findOrFail($id);
        $ordinateur->delete();

        session()->flash('message', 'Ordinateur supprimé avec succès.');
        $this->chargerStatistiques();
    }

    public function resetForm()
    {
        $this->reset([
            'ordinateurId', 'nom', 'entite_form', 'sous_entite', 'statut_form',
            'fabricant', 'modele', 'numero_serie', 'utilisateur_id', 'usager_id',
            'date_dernier_inventaire', 'reseau_ip', 'disque_dur', 'os_version',
            'os_noyau', 'derniere_date_demarrage', 'notes'
        ]);
        $this->resetErrorBag();
    }
    

    /**
     * Exporter les ordinateurs en CSV
     */
    public function exportOrdinateur()
    {
        try {
            $query = OrdinateurModel::with(['utilisateur', 'usager']);

            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('nom', 'LIKE', "%{$this->search}%")
                        ->orWhere('numero_serie', 'LIKE', "%{$this->search}%")
                        ->orWhere('fabricant', 'LIKE', "%{$this->search}%")
                        ->orWhere('modele', 'LIKE', "%{$this->search}%")
                        ->orWhere('reseau_ip', 'LIKE', "%{$this->search}%")
                        ->orWhereHas('utilisateur', function ($q) {
                            $q->where('name', 'LIKE', "%{$this->search}%");
                        });
                });
            }

            if ($this->statut) {
                $query->where('statut', $this->statut);
            }

            if ($this->entite) {
                $query->where('entite', 'LIKE', "%{$this->entite}%");
            }

            $ordinateurs = $query->orderBy('nom')->get();

            $fileName = 'ordinateurs_export_' . date('Y-m-d_H-i-s') . '.csv';

            return response()->streamDownload(function () use ($ordinateurs) {
                $file = fopen('php://output', 'w');

                // En-têtes
                fputcsv($file, [
                    'Nom', 'Entité', 'Sous-entité', 'Statut', 'Fabricant',
                    'Modèle', 'Numéro de série', 'Utilisateur', 'Usager',
                    'Date inventaire', 'IP', 'Disque dur', 'OS Version',
                    'OS Noyau', 'Dernier démarrage', 'Notes'
                ]);

                // Données
                foreach ($ordinateurs as $ord) {
                    fputcsv($file, [
                        $ord->nom,
                        $ord->entite,
                        $ord->sous_entite,
                        $ord->statut,
                        $ord->fabricant,
                        $ord->modele,
                        $ord->numero_serie,
                        $ord->utilisateur->name ?? 'N/A',
                        $ord->usager->name ?? 'N/A',
                        $ord->date_dernier_inventaire?->format('d/m/Y') ?? '',
                        $ord->reseau_ip,
                        $ord->disque_dur,
                        $ord->os_version,
                        $ord->os_noyau,
                        $ord->derniere_date_demarrage?->format('d/m/Y H:i') ?? '',
                        $ord->notes
                    ]);
                }

                fclose($file);
            }, $fileName, [
                'Content-Type' => 'text/csv',
            ]);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'export: ' . $e->getMessage());
            return back();
        }
    }

    // ==================== MÉTHODES POUR LES STATISTIQUES ====================

    /**
     * Charger les statistiques
     */
    public function chargerStatistiques()
    {
        $this->statsGlobales = OrdinateurModel::select('statut', DB::raw('COUNT(*) as count'))
            ->groupBy('statut')
            ->get()
            ->pluck('count', 'statut')
            ->toArray();
    }

    /**
     * Obtenir l'icône pour un statut
     */
    public function getIconeStatut($statut)
    {
        switch($statut) {
            case 'En service': return 'fa-check-circle';
            case 'En stock': return 'fa-warehouse';
            case 'En réparation': return 'fa-tools';
            case 'Hors service': return 'fa-times-circle';
            default: return 'fa-desktop';
        }
    }

    /**
     * Obtenir la couleur du badge pour un statut
     */
    public function getBadgeColor($statut)
    {
        switch($statut) {
            case 'En service': return 'success';
            case 'En stock': return 'info';
            case 'En réparation': return 'warning';
            case 'Hors service': return 'danger';
            default: return 'secondary';
        }
    }

    // ==================== MÉTHODES D'IMPORT AVEC MAPPING ====================

/**
 * Sauvegarder les données importées dans la base
 */
public function saveImportedData()
{
    try {
        DB::beginTransaction();

        $savedCount = 0;
        $errors = [];

        foreach ($this->importedData as $index => $data) {
            try {
                // Vérifier si le moniteur existe déjà
                $existing = OrdinateurModel::where('nom', $data['nom'])->first();
                if ($existing) {
                    $errors[] = "Ligne " . ($index + 1) . ": Le moniteur '{$data['nom']}' existe déjà";
                    continue;
                }

                // Créer le moniteur
                OrdinateurModel::create([
                    'nom' => $data['nom'],
                    'entite' => $data['entite'] ?? null,
                    'statut' => $data['statut'] ?? 'En stock',
                    'fabricant' => $data['fabricant'] ?? null,
                    'numero_serie' => $data['numero_serie'] ?? null,
                    'lieu' => $data['lieu'] ?? null,
                    'type' => $data['type'] ?? null,
                    'modele' => $data['modele'] ?? null,
                    'commentaires' => $data['commentaires'] ?? null,
                ]);

                $savedCount++;

            } catch (\Exception $e) {
                $errors[] = "Ligne " . ($index + 1) . ": " . $e->getMessage();
            }
        }

        DB::commit();

        // Nettoyer les fichiers temporaires
        $this->cleanImportFiles();

        // FORCER LE RECHARGEMENT DES DONNÉES
        $this->showImportedData = false;
        $this->showMappingModal = false;
        
        // Recharger les données et statistiques
        $this->chargerStatistiques();
        $this->chargerFabricants();
        $this->chargerEntites();
        
        // Réinitialiser la pagination pour voir les nouvelles données
        $this->resetPage();
        
        // Émettre un événement pour forcer le re-rendu
        $this->emit('$refresh');

        if ($savedCount > 0) {
            session()->flash('success', $savedCount . ' moniteur(s) importé(s) avec succès ! Les données sont maintenant visibles dans le tableau.');
        }

        if (!empty($errors)) {
            session()->flash('warning', 'Import terminé avec ' . count($errors) . ' erreur(s).');
            $this->importErrors = $errors;
        }

    } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('error', 'Erreur lors de la sauvegarde: ' . $e->getMessage());
    }
}

/**
 * Annuler l'import
 */
public function cancelImport()
{
    $this->cleanImportFiles();
    $this->resetImport();
    $this->showMappingModal = false;
    $this->showImportedData = false;
    $this->showImportModal = false; // Ajouter cette ligne
}

/**
 * Fermer la modal d'import
 */

}