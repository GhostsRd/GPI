<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Peripherique as PeripheriqueModel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;

class Peripherique extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // Propriétés pour la recherche et les filtres
    public $search = '';
    public $filterStatut = '';
    public $filterType = '';
    public $filterFabricant = '';
    
    // Propriétés pour les statistiques
    public $stats = [];

    // Propriétés pour le formulaire
    public $peripheriqueId;
    public $nom;
    public $entite;
    public $statut = 'En service';
    public $fabricant;
    public $lieu;
    public $type;
    public $modele;
    public $usager;

    // États des modals
    public $showForm = false;
    public $editingId = null;
    public $showImportModal = false;
    public $showMappingModal = false;
    public $showImportedData = false;
    public $confirmingDelete = false;
    public $deleteId = null;
    public $isBulkDelete = false;
    public $peripheriqueName = '';

    // Sélection multiple et tri
    public $selectedPeripheriques = [];
    public $selectAll = false;
    public $sortField = 'nom';
    public $sortDirection = 'asc';

    // Options pour les selects
    public $statuts = ['En service', 'En stock', 'Hors service', 'En réparation'];
    public $types = ['Clavier', 'Souris', 'Webcam', 'Casque', 'Écran', 'Imprimante', 'Scanner'];
    public $fabricants = [];
    public $entites = [];

    // NOUVELLES PROPRIÉTES À AJOUTER
public $showDetailsModal = false;
public $selectedPeripherique = null;
public $showSortieModal = false;
public $showRetourModal = false;
public $showHistoriqueModal = false;

// Propriétés pour les sorties/retours
public $sortiePeripheriqueId;
public $sortieUsager;
public $sortieEntite;
public $sortieLieu;
public $sortieDate;
public $sortieCommentaire;

public $retourPeripheriqueId;
public $retourDate;
public $retourEtat = 'Bon';
public $retourCommentaire;

public $viewMode = 'compact';

    // Propriétés pour l'import avec mapping
    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $isImporting = false;

    // Propriétés pour le mapping
    public $csvHeaders = [];
    public $csvPreview = [];
    public $fieldMapping = [
        'nom' => '',
        'entite' => '',
        'statut' => '',
        'fabricant' => '',
        'lieu' => '',
        'type' => '',
        'modele' => '',
        'usager' => ''
    ];

    // Données importées temporaires
    public $importedData = [];

    // Règles de validation
    protected $rules = [
        'nom' => 'required|string|max:100|unique:peripheriques,nom',
        'entite' => 'nullable|string|max:100',
        'statut' => 'required|in:En service,En stock,Hors service,En réparation',
        'fabricant' => 'nullable|string|max:100',
        'lieu' => 'nullable|string|max:150',
        'type' => 'required|string|max:100',
        'modele' => 'nullable|string|max:100',
        'usager' => 'nullable|string|max:100',
    ];

    /**
     * Initialisation du composant
     */
   

    /**
     * Rendu du composant
     */
    public function render()
    {
        $query = PeripheriqueModel::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('nom', 'like', '%'.$this->search.'%')
                      ->orWhere('modele', 'like', '%'.$this->search.'%')
                      ->orWhere('fabricant', 'like', '%'.$this->search.'%')
                      ->orWhere('entite', 'like', '%'.$this->search.'%')
                      ->orWhere('usager', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->filterStatut, function($query) {
                $query->where('statut', $this->filterStatut);
            })
            ->when($this->filterType, function($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterFabricant, function($query) {
                $query->where('fabricant', $this->filterFabricant);
            })
            ->orderBy($this->sortField, $this->sortDirection);

        $peripheriques = $query->paginate(20);

        $fabricantsList = PeripheriqueModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();

        return view('livewire.equipement.peripherique', [
            'peripheriques' => $peripheriques,
            'fabricantsList' => $fabricantsList,
            'stats' => $this->stats,
        ]);
    }

    // ==================== MÉTHODES DE RECHERCHE ET FILTRES ====================

    /**
     * Réinitialiser les filtres
     */
    public function resetFilters()
    {
        $this->reset(['search', 'filterStatut', 'filterType', 'filterFabricant', 'selectedPeripheriques', 'selectAll']);
        $this->resetPage();
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
     * Sélectionner/désélectionner tous les périphériques
     */
    public function updatedSelectAll($value)
    {
        if ($value) {
            $query = PeripheriqueModel::query()
                ->when($this->search, function($query) {
                    $query->where(function($q) {
                        $q->where('nom', 'like', '%'.$this->search.'%')
                          ->orWhere('modele', 'like', '%'.$this->search.'%')
                          ->orWhere('fabricant', 'like', '%'.$this->search.'%')
                          ->orWhere('entite', 'like', '%'.$this->search.'%');
                    });
                })
                ->when($this->filterStatut, function($query) {
                    $query->where('statut', $this->filterStatut);
                })
                ->when($this->filterType, function($query) {
                    $query->where('type', $this->filterType);
                })
                ->when($this->filterFabricant, function($query) {
                    $query->where('fabricant', $this->filterFabricant);
                });

            $this->selectedPeripheriques = $query->pluck('id')->toArray();
        } else {
            $this->selectedPeripheriques = [];
        }
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
            'importFile', 
            'importErrors', 
            'importSuccessCount',
            'isImporting',
            'csvHeaders',
            'csvPreview',
            'importedData',
            'showImportedData'
        ]);
        $this->fieldMapping = [
            'nom' => '',
            'entite' => '',
            'statut' => '',
            'fabricant' => '',
            'lieu' => '',
            'type' => '',
            'modele' => '',
            'usager' => ''
        ];
        $this->resetErrorBag();
    }

    /**
     * Stocker le fichier et préparer le mapping
     */
    public function storeImportFile()
    {
        $this->validate([
            'importFile' => 'required|file|mimes:csv,txt|max:10240'
        ]);

        try {
            // Stocker le fichier
            $filePath = $this->importFile->storeAs(
                'imports/peripheriques',
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
            'nom' => ['nom', 'name', 'designation', 'libelle', 'peripherique', 'equipement', 'identification'],
            'entite' => ['entite', 'entity', 'departement', 'service', 'department', 'division'],
            'statut' => ['statut', 'status', 'etat', 'state', 'situation'],
            'fabricant' => ['fabricant', 'manufacturer', 'marque', 'brand', 'make', 'constructor'],
            'lieu' => ['lieu', 'location', 'place', 'emplacement', 'site', 'localisation'],
            'type' => ['type', 'typologie', 'categorie', 'category'],
            'modele' => ['modele', 'model', 'reference', 'product', 'produit'],
            'usager' => ['usager', 'user', 'utilisateur', 'utilise_par', 'assigne_a']
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
            $files = Storage::disk('public')->files('imports/peripheriques');
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

                    if (empty($mappedData['type'])) {
                        $this->importErrors[] = "Ligne {$lineNumber}: Le type est obligatoire";
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

            // Validation spécifique pour le type
            if ($key === 'type' && !empty($value)) {
                $typesValides = ['Clavier', 'Souris', 'Webcam', 'Casque', 'Écran', 'Imprimante', 'Scanner'];
                if (!in_array($value, $typesValides)) {
                    // On garde la valeur mais on pourrait la normaliser si nécessaire
                }
            }
        }

        return $data;
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
                    // Vérifier si le périphérique existe déjà
                    $existing = PeripheriqueModel::where('nom', $data['nom'])->first();
                    if ($existing) {
                        $errors[] = "Ligne " . ($index + 1) . ": Le périphérique '{$data['nom']}' existe déjà";
                        continue;
                    }

                    // Créer le périphérique
                    PeripheriqueModel::create([
                        'nom' => $data['nom'],
                        'entite' => $data['entite'] ?? null,
                        'statut' => $data['statut'] ?? 'En stock',
                        'fabricant' => $data['fabricant'] ?? null,
                        'lieu' => $data['lieu'] ?? null,
                        'type' => $data['type'],
                        'modele' => $data['modele'] ?? null,
                        'usager' => $data['usager'] ?? null,
                    ]);

                    $savedCount++;

                } catch (\Exception $e) {
                    $errors[] = "Ligne " . ($index + 1) . ": " . $e->getMessage();
                }
            }

            DB::commit();

            // Nettoyer les fichiers temporaires
            $this->cleanImportFiles();

            $this->showImportedData = false;
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            if ($savedCount > 0) {
                session()->flash('success', $savedCount . ' périphérique(s) importé(s) avec succès !');
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
            $files = Storage::disk('public')->files('imports/peripheriques');
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
    }

    /**
     * Télécharger le template d'import
     */
    public function downloadImportTemplate()
    {
        try {
            $fileName = 'template_import_peripheriques.csv';
            $templateContent = "nom,entite,statut,fabricant,lieu,type,modele,usager\n" .
                             "Clavier Bureau 1,SIEGE,En service,Logitech,Bureau A1,Clavier,K120,John Doe\n" .
                             "Souris RH,DRH,En stock,Microsoft,Stock,Souris,Basic Mouse,\n" .
                             "Écran Direction,SIEGE,En service,Dell,Bureau Directeur,Écran,UltraSharp U2419H,PDG\n" .
                             "Imprimante Commercial,Commercial,En service,HP,Bureau Open Space,Imprimante,LaserJet Pro,Équipe Commerciale";

            return response()->streamDownload(function () use ($templateContent) {
                echo $templateContent;
            }, $fileName, [
                'Content-Type' => 'text/csv; charset=utf-8',
            ]);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors du téléchargement du template: ' . $e->getMessage());
        }
    }

    /**
     * Exporter les périphériques en CSV
     */
    public function exportToCsv()
    {
        try {
            $query = PeripheriqueModel::query()
                ->when($this->search, function($query) {
                    $query->where(function($q) {
                        $q->where('nom', 'like', '%'.$this->search.'%')
                          ->orWhere('modele', 'like', '%'.$this->search.'%')
                          ->orWhere('fabricant', 'like', '%'.$this->search.'%')
                          ->orWhere('entite', 'like', '%'.$this->search.'%');
                    });
                })
                ->when($this->filterStatut, function($query) {
                    $query->where('statut', $this->filterStatut);
                })
                ->when($this->filterType, function($query) {
                    $query->where('type', $this->filterType);
                })
                ->when($this->filterFabricant, function($query) {
                    $query->where('fabricant', $this->filterFabricant);
                })
                ->orderBy($this->sortField, $this->sortDirection);

            $peripheriques = $query->get();

            $fileName = 'peripheriques_export_' . date('Y-m-d_H-i-s') . '.csv';

            return response()->streamDownload(function () use ($peripheriques) {
                $file = fopen('php://output', 'w');

                // En-têtes
                fputcsv($file, [
                    'Nom', 'Entité', 'Statut', 'Fabricant', 'Lieu', 
                    'Type', 'Modèle', 'Usager', 'Date création', 'Date modification'
                ]);

                // Données
                foreach ($peripheriques as $peripherique) {
                    fputcsv($file, [
                        $peripherique->nom,
                        $peripherique->entite ?? 'N/A',
                        $peripherique->statut,
                        $peripherique->fabricant ?? 'N/A',
                        $peripherique->lieu ?? 'N/A',
                        $peripherique->type,
                        $peripherique->modele ?? 'N/A',
                        $peripherique->usager ?? 'N/A',
                        $peripherique->created_at->format('d/m/Y'),
                        $peripherique->updated_at->format('d/m/Y'),
                    ]);
                }

                fclose($file);
            }, $fileName);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'export: ' . $e->getMessage());
        }
    }

    // ==================== MÉTHODES CRUD ====================

    /**
     * Afficher le formulaire de création
     */
    public function showForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $peripherique = PeripheriqueModel::findOrFail($id);

        $this->editingId = $peripherique->id;
        $this->nom = $peripherique->nom;
        $this->entite = $peripherique->entite;
        $this->statut = $peripherique->statut;
        $this->fabricant = $peripherique->fabricant;
        $this->lieu = $peripherique->lieu;
        $this->type = $peripherique->type;
        $this->modele = $peripherique->modele;
        $this->usager = $peripherique->usager;

        $this->showForm = true;
    }

    /**
     * Enregistrer un nouveau périphérique
     */
    public function save()
    {
        if ($this->editingId) {
            $this->rules['nom'] = 'required|string|max:100|unique:peripheriques,nom,' . $this->editingId;
        }

        $this->validate();

        $data = [
            'nom' => $this->nom,
            'entite' => $this->entite,
            'statut' => $this->statut,
            'fabricant' => $this->fabricant,
            'lieu' => $this->lieu,
            'type' => $this->type,
            'modele' => $this->modele,
            'usager' => $this->usager,
        ];

        if ($this->editingId) {
            PeripheriqueModel::find($this->editingId)->update($data);
            $message = 'Périphérique mis à jour avec succès.';
        } else {
            PeripheriqueModel::create($data);
            $message = 'Périphérique créé avec succès.';
        }

        $this->resetForm();
        $this->showForm = false;
        $this->chargerStatistiques();
        $this->chargerFabricants();
        $this->chargerEntites();
        
        session()->flash('success', $message);
    }

    /**
     * Confirmer la suppression
     */
    public function confirmDelete($id)
    {
        $peripherique = PeripheriqueModel::findOrFail($id);
        $this->deleteId = $id;
        $this->peripheriqueName = $peripherique->nom;
        $this->isBulkDelete = false;
        $this->confirmingDelete = true;
    }

    /**
     * Supprimer un périphérique
     */
    public function delete($id)
    {
        try {
            PeripheriqueModel::findOrFail($id)->delete();
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            session()->flash('success', 'Périphérique supprimé avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression du périphérique: ' . $e->getMessage());
        }
    }

    /**
     * Suppression confirmée
     */
    public function deleteConfirmed()
    {
        try {
            if ($this->isBulkDelete) {
                $count = PeripheriqueModel::whereIn('id', $this->selectedPeripheriques)->delete();
                $this->selectedPeripheriques = [];
                $this->selectAll = false;
                session()->flash('success', "{$count} périphérique(s) supprimé(s) avec succès.");
            } else if ($this->deleteId) {
                PeripheriqueModel::findOrFail($this->deleteId)->delete();
                session()->flash('success', 'Périphérique supprimé avec succès.');
            }
            
            $this->confirmingDelete = false;
            $this->deleteId = null;
            $this->peripheriqueName = '';
            $this->chargerStatistiques();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Supprimer les périphériques sélectionnés
     */
    public function confirmBulkDelete()
    {
        if (empty($this->selectedPeripheriques)) {
            session()->flash('warning', 'Aucun périphérique sélectionné.');
            return;
        }

        $this->isBulkDelete = true;
        $this->confirmingDelete = true;
    }

    // ==================== MÉTHODES POUR LES STATISTIQUES ====================

    /**
     * Charger les statistiques
     */
    public function chargerStatistiques()
    {
        try {
            $this->stats = [
                'total' => PeripheriqueModel::count(),
                'en_service' => PeripheriqueModel::where('statut', 'En service')->count(),
                'en_stock' => PeripheriqueModel::where('statut', 'En stock')->count(),
                'hors_service' => PeripheriqueModel::where('statut', 'Hors service')->count(),
                'en_reparation' => PeripheriqueModel::where('statut', 'En réparation')->count(),
            ];
        } catch (\Exception $e) {
            $this->stats = [
                'total' => 0,
                'en_service' => 0,
                'en_stock' => 0,
                'hors_service' => 0,
                'en_reparation' => 0,
            ];
        }
    }

    /**
     * Charger la liste des fabricants
     */
    private function chargerFabricants()
    {
        $this->fabricants = PeripheriqueModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();
    }

    /**
     * Charger la liste des entités
     */
    private function chargerEntites()
    {
        $this->entites = PeripheriqueModel::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();
    }

    // ==================== MÉTHODES UTILITAIRES ====================

    /**
     * Réinitialiser le formulaire
     */
    public function resetForm()
    {
        $this->reset([
            'editingId', 'nom', 'entite', 'statut', 'fabricant',
            'lieu', 'type', 'modele', 'usager'
        ]);
        $this->resetErrorBag();
    }

    /**
     * Fermer le modal
     */
    public function closeModal()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    // ==================== MÉTHODES DE PAGINATION ====================

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatut()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterFabricant()
    {
        $this->resetPage();
    }

    // ==================== MÉTHODES POUR LES DÉTAILS ====================

/**
 * Afficher les détails d'un périphérique
 */
public function showDetails($id)
{
    $this->selectedPeripherique = PeripheriqueModel::find($id);
    $this->showDetailsModal = true;
}

/**
 * Fermer le modal de détails
 */
public function closeDetailsModal()
{
    $this->showDetailsModal = false;
    $this->selectedPeripherique = null;
}

// ==================== MÉTHODES POUR LES SORTIES/RETOURS ====================

/**
 * Ouvrir le modal de sortie
 */
public function openSortieModal()
{
    $this->resetSortieForm();
    $this->showSortieModal = true;
}

/**
 * Ouvrir le modal de retour
 */
public function openRetourModal()
{
    $this->resetRetourForm();
    $this->showRetourModal = true;
}

/**
 * Ouvrir le modal d'historique
 */
public function openHistoriqueModal()
{
    $this->showHistoriqueModal = true;
}

/**
 * Sortie rapide d'un périphérique
 */
public function quickSortie($id)
{
    $this->sortiePeripheriqueId = $id;
    $peripherique = PeripheriqueModel::findOrFail($id);
    
    // Pré-remplir certains champs
    $this->sortieEntite = $peripherique->entite;
    $this->sortieLieu = $peripherique->lieu;
    $this->sortieDate = now()->format('Y-m-d\TH:i');
    
    $this->showSortieModal = true;
}

/**
 * Retour rapide d'un périphérique
 */
public function quickRetour($id)
{
    $this->retourPeripheriqueId = $id;
    $this->retourDate = now()->format('Y-m-d\TH:i');
    $this->showRetourModal = true;
}

/**
 * Enregistrer une sortie
 */


/**
 * Enregistrer un retour
 */


// ==================== MÉTHODES UTILITAIRES ====================

/**
 * Réinitialiser le formulaire de sortie
 */
private function resetSortieForm()
{
    $this->reset([
        'sortiePeripheriqueId',
        'sortieUsager', 
        'sortieEntite', 
        'sortieLieu', 
        'sortieCommentaire'
    ]);
    $this->sortieDate = now()->format('Y-m-d\TH:i');
}

/**
 * Réinitialiser le formulaire de retour
 */
private function resetRetourForm()
{
    $this->reset([
        'retourPeripheriqueId',
        'retourCommentaire'
    ]);
    $this->retourDate = now()->format('Y-m-d\TH:i');
    $this->retourEtat = 'Bon';
}

/**
 * Changer le mode d'affichage
 */
public function changeViewMode($mode)
{
    $this->viewMode = $mode;
}

/**
 * Charger les données pour les modals
 */
private function chargerDonneesModals()
{
    $this->peripheriquesEnStock = PeripheriqueModel::where('statut', 'En stock')->get();
    $this->peripheriquesEnService = PeripheriqueModel::where('statut', 'En service')->get();
}
public function mount()
{
    $this->chargerStatistiques();
    $this->chargerFabricants();
    $this->chargerEntites();
    $this->chargerDonneesModals(); // AJOUTÉ
    $this->sortieDate = now()->format('Y-m-d\TH:i');
    $this->retourDate = now()->format('Y-m-d\TH:i');
}

public function enregistrerSortie()
{
    $this->validate([
        'sortiePeripheriqueId' => 'required|exists:peripheriques,id',
        'sortieUsager' => 'required|string|max:255',
        'sortieEntite' => 'required|string|max:255',
        'sortieLieu' => 'required|string|max:255',
        'sortieDate' => 'required|date',
    ]);

    DB::transaction(function () {
        $peripherique = PeripheriqueModel::findOrFail($this->sortiePeripheriqueId);
        $peripherique->update([
            'statut' => 'En service',
            'usager' => $this->sortieUsager,
            'entite' => $this->sortieEntite,
            'lieu' => $this->sortieLieu,
        ]);
    });

    $this->showSortieModal = false;
    $this->resetSortieForm();
    $this->chargerStatistiques();
    $this->chargerDonneesModals(); // AJOUTÉ
    session()->flash('success', 'Sortie enregistrée avec succès.');
}

public function enregistrerRetour()
{
    $this->validate([
        'retourPeripheriqueId' => 'required|exists:peripheriques,id',
        'retourDate' => 'required|date',
        'retourEtat' => 'required|string|max:255',
    ]);

    DB::transaction(function () {
        $peripherique = PeripheriqueModel::findOrFail($this->retourPeripheriqueId);
        $nouveauStatut = $this->retourEtat === 'Hors service' ? 'Hors service' : 'En stock';
        
        $peripherique->update([
            'statut' => $nouveauStatut,
            'usager' => null,
            'entite' => null,
            'lieu' => 'Stock',
        ]);
    });

    $this->showRetourModal = false;
    $this->resetRetourForm();
    $this->chargerStatistiques();
    $this->chargerDonneesModals(); // AJOUTÉ
    session()->flash('success', 'Retour enregistré avec succès.');
}
}