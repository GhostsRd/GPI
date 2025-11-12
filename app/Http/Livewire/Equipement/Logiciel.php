<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Logiciel as LogicielModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;

class Logiciel extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $editeur = '';
    public $systeme_exploitation = '';
    public $statutFilter = '';
    public $perPage = 20;
    public $sortField = 'nom';
    public $sortDirection = 'asc';
    protected $paginationTheme = 'bootstrap';

    // Variables pour le formulaire
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

    // États des modals
    public $showModal = false;
    public $showDetailsModal = false;
    public $showDeleteModal = false;
    public $showImportModal = false;
    public $showMappingModal = false;
    public $showImportedData = false;
    public $modalTitle = 'Ajouter un logiciel';
    public $editMode = false;
    public $selectedLogiciel = null;
    public $confirmingDelete = false;
    public $selectedLogicielName = '';

    // Propriétés pour l'import avec mapping
    public $fichierExcel;
    public $importProgress = 0;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $isImporting = false;
    public $showStats = true;

    // Propriétés pour le mapping
    public $csvHeaders = [];
    public $csvPreview = [];
    public $fieldMapping = [
        'nom' => '',
        'editeur' => '',
        'version_nom' => '',
        'version_systeme_exploitation' => '',
        'nombre_installations' => '',
        'nombre_licences' => '',
        'date_achat' => '',
        'date_expiration' => '',
        'description' => ''
    ];

    // Données importées temporaires
    public $importedData = [];

    // Statistiques
    public $stats = [];

    // Propriétés pour la sélection multiple
    public $selectedLogiciels = [];
    public $selectAll = false;

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

    protected $messages = [
        'nom.required' => 'Le nom du logiciel est obligatoire.',
        'date_expiration.after_or_equal' => 'La date d\'expiration doit être postérieure ou égale à la date d\'achat.',
        'fichierExcel.required' => 'Veuillez sélectionner un fichier',
        'fichierExcel.mimes' => 'Le fichier doit être de type CSV',
        'fichierExcel.max' => 'Le fichier ne doit pas dépasser 10MB'
    ];

    // Règles pour l'import
    protected $importRules = [
        'fichierExcel' => 'required|file|mimes:csv,txt|max:10240'
    ];

    public function mount()
    {
        $this->chargerStatistiques();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'editeur', 'systeme_exploitation', 'statutFilter', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = LogicielModel::query();

        // Filtres de recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('nom', 'like', "%{$this->search}%")
                  ->orWhere('editeur', 'like', "%{$this->search}%")
                  ->orWhere('version_nom', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        if ($this->editeur) {
            $query->where('editeur', $this->editeur);
        }

        if ($this->systeme_exploitation) {
            $query->where('version_systeme_exploitation', 'like', "%{$this->systeme_exploitation}%");
        }

        if ($this->statutFilter) {
            if ($this->statutFilter === 'Aucune licence') {
                $query->where('nombre_licences', 0);
            } else {
                $query->where('statut_licences', $this->statutFilter);
            }
        }

        // Tri
        $query->orderBy($this->sortField, $this->sortDirection);

        $logiciels = $query->paginate($this->perPage);

        // Mettre à jour la sélection si "selectAll" est coché
        if ($this->selectAll && empty($this->selectedLogiciels)) {
            $this->selectedLogiciels = $logiciels->pluck('id')->toArray();
        }

        $editeurs = LogicielModel::distinct()->whereNotNull('editeur')->pluck('editeur');
        $systemes = LogicielModel::distinct()->whereNotNull('version_systeme_exploitation')->pluck('version_systeme_exploitation');

        return view('livewire.equipement.logiciel', compact('logiciels', 'editeurs', 'systemes'));
    }

    // ==================== MÉTHODES DE TRI ====================

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    // ==================== MÉTHODES POUR LES STATISTIQUES ====================

    /**
     * Basculer l'affichage des statistiques
     */
    public function toggleStats()
    {
        $this->showStats = !$this->showStats;
    }

    /**
     * Charger les statistiques complètes
     */
    public function chargerStatistiques()
    {
        $total = LogicielModel::count();
        $licencesCritiques = LogicielModel::licencesCritiques()->count();
        $totalInstallations = LogicielModel::sum('nombre_installations');
        $totalLicences = LogicielModel::sum('nombre_licences');
        
        // Nouvelles statistiques
        $logicielsSansLicences = LogicielModel::where('nombre_licences', 0)->count();
        $logicielsExpires = LogicielModel::where('date_expiration', '<', now())->count();
        $logicielsExpirentBientot = LogicielModel::whereBetween('date_expiration', [now(), now()->addDays(30)])->count();
        
        // Calcul du taux de conformité
        $logicielsConformes = LogicielModel::where('statut_licences', 'Conforme')->count();
        $tauxConformite = $total > 0 ? round(($logicielsConformes / $total) * 100) : 0;

        $this->stats = [
            'total' => $total,
            'licences_critiques' => $licencesCritiques,
            'total_installations' => $totalInstallations,
            'total_licences' => $totalLicences,
            'sans_licences' => $logicielsSansLicences,
            'expires' => $logicielsExpires,
            'expirent_bientot' => $logicielsExpirentBientot,
            'taux_conformite' => $tauxConformite,
            'conformes' => $logicielsConformes
        ];
    }

    /**
     * Obtenir la couleur du badge pour le statut des licences
     */
    public function getBadgeColor($statut)
    {
        switch($statut) {
            case 'Conforme': return 'success';
            case 'Alerte': return 'warning';
            case 'Critique': return 'danger';
            case 'Aucune licence': return 'secondary';
            default: return 'info';
        }
    }

    // ==================== MÉTHODES CRUD ====================

    public function create()
    {
        $this->resetForm();
        $this->modalTitle = 'Ajouter un logiciel';
        $this->editMode = false;
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

        $this->modalTitle = 'Modifier le logiciel';
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        try {
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

            if ($this->editMode) {
                $logiciel = LogicielModel::findOrFail($this->logicielId);
                $logiciel->update($data);
                session()->flash('message', 'Logiciel mis à jour avec succès.');
            } else {
                LogicielModel::create($data);
                session()->flash('message', 'Logiciel créé avec succès.');
            }

            $this->resetForm();
            $this->showModal = false;
            $this->chargerStatistiques();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'opération: ' . $e->getMessage());
        }
    }

    /**
     * Confirmer la suppression
     */
    public function confirmDelete($id)
    {
        $logiciel = LogicielModel::findOrFail($id);
        $this->selectedLogicielName = $logiciel->nom;
        $this->logicielId = $id;
        $this->confirmingDelete = true;
    }

    /**
     * Fermer la modal de confirmation de suppression
     */
    public function closeDeleteModal()
    {
        $this->confirmingDelete = false;
        $this->selectedLogicielName = '';
        $this->logicielId = null;
    }

    /**
     * Supprimer après confirmation
     */
    public function deleteConfirmed()
    {
        try {
            $logiciel = LogicielModel::findOrFail($this->logicielId);
            $logiciel->delete();

            session()->flash('message', 'Logiciel supprimé avec succès.');
            $this->chargerStatistiques();
            $this->closeDeleteModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Supprimer les logiciels sélectionnés
     */
    public function deleteSelected()
    {
        try {
            if (empty($this->selectedLogiciels)) {
                session()->flash('warning', 'Aucun logiciel sélectionné.');
                return;
            }

            $count = LogicielModel::whereIn('id', $this->selectedLogiciels)->delete();
            
            $this->selectedLogiciels = [];
            $this->selectAll = false;
            
            session()->flash('message', $count . ' logiciel(s) supprimé(s) avec succès.');
            $this->chargerStatistiques();
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Afficher les détails d'un logiciel
     */
    public function showDetails($id)
    {
        $this->selectedLogiciel = LogicielModel::find($id);
        if ($this->selectedLogiciel) {
            $this->showDetailsModal = true;
        }
    }

    /**
     * Fermer la modal de détails
     */
    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedLogiciel = null;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'logicielId', 'nom', 'editeur_form', 'version_nom', 'version_systeme_exploitation',
            'nombre_installations', 'nombre_licences', 'description', 'date_achat', 'date_expiration'
        ]);
        $this->resetErrorBag();
    }

    /**
     * Réinitialiser les filtres
     */
    public function resetFilters()
    {
        $this->reset(['search', 'editeur', 'systeme_exploitation', 'statutFilter']);
        $this->resetPage();
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
            'editeur' => '',
            'version_nom' => '',
            'version_systeme_exploitation' => '',
            'nombre_installations' => '',
            'nombre_licences' => '',
            'date_achat' => '',
            'date_expiration' => '',
            'description' => ''
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
                'imports/logiciels',
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

    /**
     * Mapping automatique des champs
     */
    private function autoMapFields()
    {
        $fieldPatterns = [
            'nom' => ['nom', 'nom_logiciel', 'logiciel', 'software', 'name', 'designation', 'libelle'],
            'editeur' => ['editeur', 'editor', 'publisher', 'manufacturer', 'fabricant', 'marque'],
            'version_nom' => ['version_nom', 'version', 'version_name', 'release', 'edition'],
            'version_systeme_exploitation' => ['version_systeme_exploitation', 'systeme_exploitation', 'os', 'operating_system', 'platform', 'plateforme'],
            'nombre_installations' => ['nombre_installations', 'installations', 'installs', 'count_install', 'install_count'],
            'nombre_licences' => ['nombre_licences', 'licences', 'licenses', 'license_count', 'licence_count'],
            'date_achat' => ['date_achat', 'achat', 'purchase_date', 'date_purchase', 'buy_date'],
            'date_expiration' => ['date_expiration', 'expiration', 'expiry_date', 'end_date', 'valid_until'],
            'description' => ['description', 'desc', 'commentaire', 'comments', 'notes', 'note', 'remarque']
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
     * Traiter les données avec le mapping - VERSION CORRIGÉE
     */
    public function processMappedData()
    {
        try {
            $this->importErrors = [];
            $this->importedData = [];
            $this->importSuccessCount = 0;

            // Trouver le dernier fichier importé
            $files = Storage::disk('public')->files('imports/logiciels');
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
            $lineNumber = 1; // Commence à 1 pour l'en-tête

            foreach ($records as $record) {
                $lineNumber++;
                
                // SAUTER LES LIGNES VIDES
                if ($this->isEmptyRow($record)) {
                    $this->importErrors[] = "Ligne {$lineNumber}: Ignorée - ligne vide";
                    continue;
                }

                $mappedData = [];

                try {
                    // Appliquer le mapping
                    foreach ($this->fieldMapping as $field => $csvHeader) {
                        if (!empty($csvHeader) && isset($record[$csvHeader])) {
                            $value = $record[$csvHeader];
                            // Convertir en string et nettoyer
                            $mappedData[$field] = trim(strval($value));
                        } else {
                            $mappedData[$field] = '';
                        }
                    }

                    // VALIDATION RENFORCÉE
                    $validationResult = $this->validateMappedData($mappedData, $lineNumber);
                    if (!$validationResult['valid']) {
                        $this->importErrors[] = $validationResult['error'];
                        continue;
                    }

                    // Nettoyer et formater les données
                    $mappedData = $this->cleanMappedData($mappedData);
                    
                    $this->importedData[] = $mappedData;
                    $this->importSuccessCount++;

                } catch (\Exception $e) {
                    $this->importErrors[] = "Ligne {$lineNumber}: Erreur de traitement - " . $e->getMessage();
                }
            }

            $this->showMappingModal = false;
            $this->showImportedData = true;

            // Log pour debug
            logger("Import terminé - Succès: {$this->importSuccessCount}, Erreurs: " . count($this->importErrors));

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors du traitement des données: ' . $e->getMessage();
            session()->flash('error', 'Erreur lors du traitement des données: ' . $e->getMessage());
        }
    }

    /**
     * Vérifier si une ligne est vide
     */
    private function isEmptyRow($record)
    {
        if (empty($record)) {
            return true;
        }
        
        // Vérifier si toutes les valeurs sont vides
        $nonEmptyValues = array_filter($record, function($value) {
            return !empty(trim(strval($value)));
        });
        
        return empty($nonEmptyValues);
    }

    /**
     * Validation renforcée des données mappées
     */
    private function validateMappedData($data, $lineNumber)
    {
        // 1. Vérifier le nom (obligatoire)
        if (empty($data['nom']) || trim($data['nom']) === '') {
            return [
                'valid' => false,
                'error' => "Ligne {$lineNumber}: Le nom du logiciel est obligatoire"
            ];
        }

        // 2. Vérifier la longueur du nom
        if (strlen($data['nom']) > 150) {
            return [
                'valid' => false,
                'error' => "Ligne {$lineNumber}: Le nom est trop long (max 150 caractères)"
            ];
        }

        // 3. Vérifier les nombres d'installations et licences
        if (!empty($data['nombre_installations']) && !is_numeric($data['nombre_installations'])) {
            return [
                'valid' => false,
                'error' => "Ligne {$lineNumber}: Le nombre d'installations doit être un nombre"
            ];
        }

        if (!empty($data['nombre_licences']) && !is_numeric($data['nombre_licences'])) {
            return [
                'valid' => false,
                'error' => "Ligne {$lineNumber}: Le nombre de licences doit être un nombre"
            ];
        }

        // 4. Vérifier les dates
        if (!empty($data['date_achat']) && !$this->isValidDate($data['date_achat'])) {
            return [
                'valid' => false,
                'error' => "Ligne {$lineNumber}: Format de date d'achat invalide - '{$data['date_achat']}'"
            ];
        }

        if (!empty($data['date_expiration']) && !$this->isValidDate($data['date_expiration'])) {
            return [
                'valid' => false,
                'error' => "Ligne {$lineNumber}: Format de date d'expiration invalide - '{$data['date_expiration']}'"
            ];
        }

        return ['valid' => true];
    }

    /**
     * Vérifier si une date est valide
     */
    private function isValidDate($dateString)
    {
        if (empty($dateString)) {
            return true;
        }

        try {
            // Essayer différents formats de date
            $formats = ['Y-m-d', 'd/m/Y', 'd-m-Y', 'm/d/Y', 'Y/m/d'];
            
            foreach ($formats as $format) {
                $date = \DateTime::createFromFormat($format, $dateString);
                if ($date && $date->format($format) === $dateString) {
                    return true;
                }
            }
            
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Nettoyer les données mappées - VERSION AMÉLIORÉE
     */
    private function cleanMappedData($data)
    {
        foreach ($data as $key => $value) {
            // Nettoyer les espaces
            $data[$key] = trim($value);
            
            // Gérer les valeurs vides
            if ($data[$key] === '') {
                $data[$key] = null;
            }
            
            // Conversion des nombres
            if (in_array($key, ['nombre_installations', 'nombre_licences'])) {
                if (empty($data[$key]) || !is_numeric($data[$key])) {
                    $data[$key] = 0;
                } else {
                    $data[$key] = intval($data[$key]);
                    // S'assurer que c'est positif
                    $data[$key] = max(0, $data[$key]);
                }
            }

            // Gestion des dates
            if (in_array($key, ['date_achat', 'date_expiration']) && !empty($data[$key])) {
                try {
                    $data[$key] = $this->parseDate($data[$key]);
                } catch (\Exception $e) {
                    $data[$key] = null; // Si la date n'est pas valide, on la met à null
                }
            }
            
            // Limiter la longueur des champs texte
            if (in_array($key, ['nom', 'editeur', 'version_nom', 'version_systeme_exploitation']) && $data[$key]) {
                $maxLength = $key === 'nom' ? 150 : 100;
                $data[$key] = substr($data[$key], 0, $maxLength);
            }
            
            if ($key === 'description' && $data[$key]) {
                $data[$key] = substr($data[$key], 0, 500);
            }
        }

        return $data;
    }

    /**
     * Parser une date depuis différents formats
     */
    private function parseDate($dateString)
    {
        if (empty($dateString)) {
            return null;
        }

        $formats = [
            'Y-m-d',    // 2024-01-15
            'd/m/Y',    // 15/01/2024
            'd-m-Y',    // 15-01-2024
            'm/d/Y',    // 01/15/2024
            'Y/m/d',    // 2024/01/15
            'd.m.Y',    // 15.01.2024
        ];

        foreach ($formats as $format) {
            $date = \DateTime::createFromFormat($format, $dateString);
            if ($date && $date->format($format) === $dateString) {
                return $date->format('Y-m-d');
            }
        }

        // Essayer avec la reconnaissance automatique
        try {
            $date = \Carbon\Carbon::parse($dateString);
            return $date->format('Y-m-d');
        } catch (\Exception $e) {
            throw new \Exception("Format de date non reconnu: {$dateString}");
        }
    }

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
                    // Vérifier si le logiciel existe déjà
                    $existing = LogicielModel::where('nom', $data['nom'])->first();
                    if ($existing) {
                        $errors[] = "Ligne " . ($index + 1) . ": Le logiciel '{$data['nom']}' existe déjà";
                        continue;
                    }

                    // Créer le logiciel
                    LogicielModel::create([
                        'nom' => $data['nom'],
                        'editeur' => $data['editeur'] ?? null,
                        'version_nom' => $data['version_nom'] ?? null,
                        'version_systeme_exploitation' => $data['version_systeme_exploitation'] ?? null,
                        'nombre_installations' => $data['nombre_installations'] ?? 0,
                        'nombre_licences' => $data['nombre_licences'] ?? 0,
                        'date_achat' => $data['date_achat'] ?? null,
                        'date_expiration' => $data['date_expiration'] ?? null,
                        'description' => $data['description'] ?? null,
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
            
            // Réinitialiser la pagination pour voir les nouvelles données
            $this->resetPage();

            if ($savedCount > 0) {
                session()->flash('message', $savedCount . ' logiciel(s) importé(s) avec succès !');
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
     * Nettoyer les fichiers d'import temporaires
     */
    private function cleanImportFiles()
    {
        try {
            $files = Storage::disk('public')->files('imports/logiciels');
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
    public function cancelImport()
    {
        $this->cleanImportFiles();
        $this->resetImport();
        $this->showMappingModal = false;
        $this->showImportedData = false;
        $this->showImportModal = false;
    }

    /**
     * Debug détaillé de l'import
     */
    public function debugImport()
    {
        logger('=== DEBUG IMPORT LOGICIELS ===');
        logger('Fichier: ' . ($this->fichierExcel ? $this->fichierExcel->getClientOriginalName() : 'Aucun'));
        logger('Headers CSV: ' . json_encode($this->csvHeaders));
        logger('Mapping: ' . json_encode($this->fieldMapping));
        logger('Preview données: ' . json_encode($this->csvPreview));
        
        if (!empty($this->importErrors)) {
            logger('=== ERREURS IMPORT ===');
            foreach ($this->importErrors as $error) {
                logger($error);
            }
        }
        
        session()->flash('info', 'Debug enregistré dans les logs - Vérifiez storage/logs/laravel.log');
    }

    /**
     * Exporter le rapport d'erreurs
     */
    public function exportErrorReport()
    {
        if (empty($this->importErrors)) {
            session()->flash('info', 'Aucune erreur à exporter');
            return;
        }

        $fileName = 'import_errors_logiciels_' . date('Y-m-d_H-i-s') . '.txt';

        return response()->streamDownload(function () {
            echo "=== RAPPORT D'ERREURS IMPORT LOGICIELS ===\n";
            echo "Date: " . now()->format('d/m/Y H:i:s') . "\n";
            echo "Fichier: " . ($this->fichierExcel ? $this->fichierExcel->getClientOriginalName() : 'N/A') . "\n";
            echo "Lignes importées: {$this->importSuccessCount}\n";
            echo "Erreurs: " . count($this->importErrors) . "\n\n";
            
            echo "=== DÉTAIL DES ERREURS ===\n";
            foreach ($this->importErrors as $index => $error) {
                echo ($index + 1) . ". " . $error . "\n";
            }
            
            echo "\n=== CONSEILS DE RÉSOLUTION ===\n";
            echo "1. Vérifiez que le fichier CSV utilise la virgule comme séparateur\n";
            echo "2. Assurez-vous que la première ligne contient les en-têtes\n";
            echo "3. Vérifiez que la colonne 'nom' est remplie pour chaque ligne\n";
            echo "4. Les dates doivent être au format YYYY-MM-DD, DD/MM/YYYY ou DD-MM-YYYY\n";
            echo "5. Les nombres d'installations et licences doivent être des chiffres\n";
        }, $fileName);
    }

    /**
     * Télécharger le template d'import
     */
    public function downloadTemplate()
    {
        $fileName = 'template_import_logiciels.csv';

        return response()->streamDownload(function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'nom', 'editeur', 'version_nom', 'version_systeme_exploitation',
                'nombre_installations', 'nombre_licences', 'date_achat',
                'date_expiration', 'description'
            ]);

            fputcsv($file, [
                'Microsoft Office',
                'Microsoft',
                '2021',
                'Windows 10/11',
                '50',
                '100',
                '2024-01-15',
                '2025-01-15',
                'Suite bureautique Microsoft Office 2021'
            ]);

            fclose($file);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }

    // ==================== MÉTHODES D'EXPORT ====================

    /**
     * Exporter les logiciels en CSV
     */
    public function exportLogiciel()
    {
        try {
            $query = LogicielModel::query();

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

            $logiciels = $query->orderBy('nom')->get();

            $fileName = 'logiciels_export_' . date('Y-m-d_H-i-s') . '.csv';

            return response()->streamDownload(function () use ($logiciels) {
                $file = fopen('php://output', 'w');

                // En-têtes
                fputcsv($file, [
                    'Nom', 'Éditeur', 'Version', 'Système d\'exploitation',
                    'Installations', 'Licences', 'Statut', 'Date achat',
                    'Date expiration', 'Description'
                ]);

                // Données
                foreach ($logiciels as $logiciel) {
                    fputcsv($file, [
                        $logiciel->nom,
                        $logiciel->editeur,
                        $logiciel->version_nom,
                        $logiciel->version_systeme_exploitation,
                        $logiciel->nombre_installations,
                        $logiciel->nombre_licences,
                        $logiciel->statut_licences,
                        $logiciel->date_achat?->format('d/m/Y') ?? '',
                        $logiciel->date_expiration?->format('d/m/Y') ?? '',
                        $logiciel->description
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

    /**
     * Mise à jour de la sélection multiple
     */
    public function updatedSelectAll($value)
    {
        if ($value) {
            $query = LogicielModel::query();

            if ($this->search) {
                $query->where(function($q) {
                    $q->where('nom', 'like', "%{$this->search}%")
                      ->orWhere('editeur', 'like', "%{$this->search}%")
                      ->orWhere('version_nom', 'like', "%{$this->search}%");
                });
            }

            $this->selectedLogiciels = $query->pluck('id')->toArray();
        } else {
            $this->selectedLogiciels = [];
        }
    }

    /**
     * Rafraîchir le tableau
     */
    public function refreshTable()
    {
        $this->resetPage();
        $this->chargerStatistiques();
    }
}