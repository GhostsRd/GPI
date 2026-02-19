<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Moniteur as MoniteurModel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;

class Moniteur extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // Propriétés pour la recherche et les filtres
    public $search = '';
    public $statut = '';
    public $entite = '';
    public $fabricant = '';
    public $perPage = 20;
    
    // Propriétés pour les statistiques
    public $statsGlobales = [];
    public $stats = [];
    public $showStats = true;

    // Propriétés pour le formulaire
    public $moniteurId;
    public $nom;
    public $entite_form;
    public $statut_form = 'En service';
    public $fabricant_form;
    public $numero_serie;
    public $utilisateur_id;
    public $usager_id;
    public $lieu;
    public $type;
    public $modele;
    public $commentaires;

    // États des modals
    public $isEditing = false;
    public $showModal = false;
    public $showImportModal = false;
    public $showDetailsModal = false;
    public $showFileModal = false;
    public $showMappingModal = false;
    public $showImportedData = false;
    public $confirmingDelete = false;
    public $deleteId = null;
    public $isBulkDelete = false;
    public $selectedMoniteurName = '';

    // Données pour les selects
    public $utilisateurs;
    public $statuts = ['En service', 'En stock', 'Hors service', 'En réparation'];
    public $types = ['LCD', 'LED', '4K', 'Ultra HD', 'Curved', 'IPS', 'TN', 'VA'];
    public $fabricants = [];
    public $entites = [];

    // Sélection multiple et tri
    public $selectedMoniteurs = [];
    public $selectAll = false;
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    // Propriétés pour l'import
    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $csvHeaders = [];
    public $csvPreview = [];
    public $importedData = [];
    public $fieldMapping = [
        'nom' => '',
        'entite' => '',
        'statut' => '',
        'fabricant' => '',
        'numero_serie' => '',
        'lieu' => '',
        'type' => '',
        'modele' => '',
        'commentaires' => ''
    ];

    // Propriétés pour les détails et fichiers
    public $selectedMoniteur = null;
    public $selectedMoniteurForFiles = null;
    public $uploadedFiles = [];
    public $attachedFiles = [];

    // Règles de validation
    protected $rules = [
        'nom' => 'required|string|max:100',
        'entite_form' => 'nullable|string|max:100',
        'statut_form' => 'required|in:En service,En stock,Hors service,En réparation',
        'fabricant_form' => 'nullable|string|max:100',
        'numero_serie' => 'nullable|string|max:100',
        'utilisateur_id' => 'nullable|exists:users,id',
        'usager_id' => 'nullable|exists:users,id',
        'lieu' => 'nullable|string|max:150',
        'type' => 'nullable|string|max:50',
        'modele' => 'nullable|string|max:100',
        'commentaires' => 'nullable|string'
    ];

    /**
     * Initialisation du composant
     */
    public function mount()
    {
        $this->utilisateurs = User::orderBy('name')->get();
        $this->chargerStatistiques();
        $this->chargerFabricants();
        $this->chargerEntites();
    }

    /**
     * Rendu du composant
     */
    public function render()
    {
        $query = $this->getMoniteursQuery();
        $query->orderBy($this->sortField, $this->sortDirection);

        $moniteurs = $query->paginate($this->perPage);

        $fabricantsList = MoniteurModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();

        $entitesList = MoniteurModel::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();

        return view('livewire.equipement.moniteur', compact('moniteurs', 'fabricantsList', 'entitesList'));
    }

    // ==================== MÉTHODES DE RECHERCHE ET FILTRES ====================

    private function getMoniteursQuery()
    {
        $query = MoniteurModel::with(['utilisateur', 'usager']);

        if ($this->statut) {
            $query->where('statut', $this->statut);
        }

        if ($this->entite) {
            $query->where('entite', $this->entite);
        }

        if ($this->fabricant) {
            $query->where('fabricant', $this->fabricant);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nom', 'LIKE', "%{$this->search}%")
                  ->orWhere('numero_serie', 'LIKE', "%{$this->search}%")
                  ->orWhere('fabricant', 'LIKE', "%{$this->search}%")
                  ->orWhere('modele', 'LIKE', "%{$this->search}%")
                  ->orWhere('lieu', 'LIKE', "%{$this->search}%")
                  ->orWhereHas('utilisateur', function ($q) {
                      $q->where('name', 'LIKE', "%{$this->search}%");
                  })
                  ->orWhereHas('usager', function ($q) {
                      $q->where('name', 'LIKE', "%{$this->search}%");
                  });
            });
        }

        return $query;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'statut', 'entite', 'fabricant', 'selectedMoniteurs', 'selectAll']);
        $this->resetPage();
        session()->flash('message', 'Filtres réinitialisés avec succès.');
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

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedMoniteurs = $this->getMoniteursQuery()->pluck('id')->toArray();
        } else {
            $this->selectedMoniteurs = [];
        }
    }

    // ==================== MÉTHODES CRUD ====================

    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $moniteur = MoniteurModel::findOrFail($id);

        $this->moniteurId = $moniteur->id;
        $this->nom = $moniteur->nom;
        $this->entite_form = $moniteur->entite;
        $this->statut_form = $moniteur->statut;
        $this->fabricant_form = $moniteur->fabricant;
        $this->numero_serie = $moniteur->numero_serie;
        $this->utilisateur_id = $moniteur->utilisateur_id;
        $this->usager_id = $moniteur->usager_id;
        $this->lieu = $moniteur->lieu;
        $this->type = $moniteur->type;
        $this->modele = $moniteur->modele;
        $this->commentaires = $moniteur->commentaires;

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->update();
        } else {
            $this->store();
        }
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            MoniteurModel::create([
                'nom' => $this->nom,
                'entite' => $this->entite_form,
                'statut' => $this->statut_form,
                'fabricant' => $this->fabricant_form,
                'numero_serie' => $this->numero_serie,
                'utilisateur_id' => $this->utilisateur_id,
                'usager_id' => $this->usager_id,
                'lieu' => $this->lieu,
                'type' => $this->type,
                'modele' => $this->modele,
                'commentaires' => $this->commentaires,
            ]);

            $this->showModal = false;
            $this->resetForm();
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            session()->flash('success', 'Moniteur créé avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la création du moniteur: ' . $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate([
            'nom' => 'required|string|max:100|unique:moniteurs,nom,' . $this->moniteurId,
            'entite_form' => 'nullable|string|max:100',
            'statut_form' => 'required|in:En service,En stock,Hors service,En réparation',
            'fabricant_form' => 'nullable|string|max:100',
            'numero_serie' => 'nullable|string|max:100|unique:moniteurs,numero_serie,' . $this->moniteurId,
            'utilisateur_id' => 'nullable|exists:users,id',
            'usager_id' => 'nullable|exists:users,id',
            'lieu' => 'nullable|string|max:150',
            'type' => 'nullable|string|max:50',
            'modele' => 'nullable|string|max:100',
            'commentaires' => 'nullable|string'
        ]);

        try {
            $moniteur = MoniteurModel::findOrFail($this->moniteurId);
            $moniteur->update([
                'nom' => $this->nom,
                'entite' => $this->entite_form,
                'statut' => $this->statut_form,
                'fabricant' => $this->fabricant_form,
                'numero_serie' => $this->numero_serie,
                'utilisateur_id' => $this->utilisateur_id,
                'usager_id' => $this->usager_id,
                'lieu' => $this->lieu,
                'type' => $this->type,
                'modele' => $this->modele,
                'commentaires' => $this->commentaires,
            ]);

            $this->showModal = false;
            $this->resetForm();
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            session()->flash('success', 'Moniteur mis à jour avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la mise à jour du moniteur: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            MoniteurModel::findOrFail($id)->delete();
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            session()->flash('success', 'Moniteur supprimé avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression du moniteur: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $moniteur = MoniteurModel::find($id);
        if ($moniteur) {
            $this->deleteId = $id;
            $this->selectedMoniteurName = $moniteur->nom;
            $this->isBulkDelete = false;
            $this->confirmingDelete = true;
        }
    }

    public function deleteConfirmed()
    {
        try {
            if ($this->isBulkDelete) {
                $count = MoniteurModel::whereIn('id', $this->selectedMoniteurs)->delete();
                $this->selectedMoniteurs = [];
                $this->selectAll = false;
                session()->flash('success', "{$count} moniteur(s) supprimé(s) avec succès.");
            } else if ($this->deleteId) {
                MoniteurModel::findOrFail($this->deleteId)->delete();
                session()->flash('success', 'Moniteur supprimé avec succès.');
            }
            
            $this->confirmingDelete = false;
            $this->deleteId = null;
            $this->selectedMoniteurName = '';
            $this->chargerStatistiques();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function confirmBulkDelete()
    {
        if (empty($this->selectedMoniteurs)) {
            session()->flash('warning', 'Aucun moniteur sélectionné.');
            return;
        }

        $this->isBulkDelete = true;
        $this->confirmingDelete = true;
    }

    public function deleteSelected()
    {
        $this->confirmBulkDelete();
    }

    // ==================== MÉTHODES D'IMPORT ====================

    public function openImportModal()
    {
        $this->showImportModal = true;
        $this->resetImport();
    }

    public function closeImportModal()
    {
        $this->showImportModal = false;
        $this->resetImport();
    }

    private function resetImport()
    {
        $this->reset([
            'importFile', 
            'importErrors', 
            'importSuccessCount',
            'csvHeaders',
            'csvPreview',
            'importedData',
            'showImportedData',
            'showMappingModal'
        ]);
        $this->fieldMapping = [
            'nom' => '',
            'entite' => '',
            'statut' => '',
            'fabricant' => '',
            'numero_serie' => '',
            'lieu' => '',
            'type' => '',
            'modele' => '',
            'commentaires' => ''
        ];
        $this->resetErrorBag();
    }
public function updatedImportFile($value)
{
    \Log::info('Import file updated:', [
        'has_file' => !is_null($value),
        'file_name' => $this->importFile ? $this->importFile->getClientOriginalName() : 'null'
    ]);
}
    /**
 * Stocker le fichier et préparer le mapping - VERSION CORRIGÉE
 */
public function storeImportFile()
{
    $this->validate([
        'importFile' => 'required|file|mimes:csv,txt|max:10240'
    ]);

    try {
        if (!$this->importFile) {
            session()->flash('error', 'Aucun fichier sélectionné.');
            return;
        }

        // Stocker le fichier
        $filePath = $this->importFile->storeAs(
            'imports/moniteurs',
            'import_' . time() . '_' . $this->importFile->getClientOriginalName(),
            'public'
        );

        if (!$filePath) {
            session()->flash('error', 'Erreur lors du stockage du fichier.');
            return;
        }

        $fullPath = storage_path('app/public/' . $filePath);
        
        if (!file_exists($fullPath)) {
            session()->flash('error', 'Fichier non trouvé après stockage.');
            return;
        }

        // Lire le fichier CSV
        $this->readCsvFile($fullPath);

        // Passer à l'étape de mapping
        $this->showMappingModal = true;
        
        \Log::info('Import file stored successfully, moving to mapping');

    } catch (\Exception $e) {
        \Log::error('Import error:', ['error' => $e->getMessage()]);
        $this->importErrors[] = 'Erreur lors du stockage du fichier: ' . $e->getMessage();
        session()->flash('error', 'Erreur lors du stockage du fichier: ' . $e->getMessage());
    }

}    private function readCsvFile($filePath)
{
    try {
        \Log::info('Reading CSV file:', ['path' => $filePath]);
        
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(',');

        $this->csvHeaders = $csv->getHeader();
        \Log::info('CSV Headers:', $this->csvHeaders);
        
        $stmt = (new Statement())->limit(5);
        $records = $stmt->process($csv);
        
        $this->csvPreview = [];
        foreach ($records as $record) {
            $this->csvPreview[] = $record;
        }

        \Log::info('CSV Preview data:', $this->csvPreview);
        
        $this->autoMapFields();

    } catch (\Exception $e) {
        \Log::error('Error reading CSV:', ['error' => $e->getMessage()]);
        $this->importErrors[] = 'Erreur lors de la lecture du fichier: ' . $e->getMessage();
    }
}
    private function autoMapFields()
    {
        $fieldPatterns = [
            'nom'          => ['nom','name','designation','moniteur'],
            'entite'       => ['entite','entity','departement','service'],
            'statut'       => ['statut','status','etat'],
            'fabricant'    => ['fabricant','manufacturer','marque'],
            'numero_serie' => ['numero_serie','serial','serial_number'],
            'lieu'         => ['lieu','location','place'],
            'type'         => ['type','typologie','technology'],
            'modele'       => ['modele','model','reference'],
            'commentaires' => ['commentaires','comments','notes'],
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

    public function processMappedData()
    {
        try {
            $this->importErrors = [];
            $this->importedData = [];

            $files = Storage::disk('public')->files('imports/moniteurs');
            if (empty($files)) {
                throw new \Exception('Aucun fichier importé trouvé');
            }

            $latestFile = last($files);
            $filePath = storage_path('app/public/' . $latestFile);

            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0);
            $csv->setDelimiter(',');

            $records = $csv->getRecords();
            $lineNumber = 1;

            foreach ($records as $record) {
                $lineNumber++;
                $mappedData = [];

                try {
                    foreach ($this->fieldMapping as $field => $csvHeader) {
                        if (!empty($csvHeader) && isset($record[$csvHeader])) {
                            $mappedData[$field] = trim($record[$csvHeader]);
                        } else {
                            $mappedData[$field] = '';
                        }
                    }

                    if (empty($mappedData['nom'])) {
                        $this->importErrors[] = "Ligne {$lineNumber}: Le nom est obligatoire";
                        continue;
                    }

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
        }
    }

    private function cleanMappedData($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            
            if ($key === 'statut' && !empty($value)) {
                $statutsValides = ['En service', 'En stock', 'Hors service', 'En réparation'];
                if (!in_array($value, $statutsValides)) {
                    $data[$key] = 'En stock';
                }
            }
        }

        return $data;
    }

    public function saveImportedData()
    {
        try {
            DB::beginTransaction();

            $savedCount = 0;
            $errors = [];

            foreach ($this->importedData as $index => $data) {
                try {
                    $existing = MoniteurModel::where('nom', $data['nom'])->first();
                    if ($existing) {
                        $errors[] = "Ligne " . ($index + 1) . ": Le moniteur '{$data['nom']}' existe déjà";
                        continue;
                    }

                    MoniteurModel::create([
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

            $this->cleanImportFiles();

            $this->showImportedData = false;
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            if ($savedCount > 0) {
                session()->flash('success', $savedCount . ' moniteur(s) importé(s) avec succès !');
            }

            if (!empty($errors)) {
                session()->flash('warning', 'Import terminé avec ' . count($errors) . ' erreur(s).');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur lors de la sauvegarde: ' . $e->getMessage());
        }
    }

    private function cleanImportFiles()
    {
        try {
            $files = Storage::disk('public')->files('imports/moniteurs');
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }
        } catch (\Exception $e) {
            // Ignorer les erreurs de nettoyage
        }
    }

    public function cancelImport()
    {
        $this->cleanImportFiles();
        $this->resetImport();
        $this->showMappingModal = false;
        $this->showImportedData = false;
        $this->showImportModal = false;
    }

    public function downloadImportTemplate()
    {
        try {
            $fileName = 'template_import_moniteurs.csv';
            $templateContent = "nom,entite,statut,fabricant,numero_serie,lieu,type,modele,commentaires\n" .
                             "Moniteur Bureau 1,SI,En service,Dell,SN123456,Bureau A1,LCD,UltraSharp U2419H,Écran principal direction\n" .
                             "Moniteur Bureau 2,Commercial,En stock,HP,SN123457,Stock,LCD,EliteDisplay E243,En attente d'affectation";

            return response()->streamDownload(function () use ($templateContent) {
                echo $templateContent;
            }, $fileName, [
                'Content-Type' => 'text/csv; charset=utf-8',
            ]);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors du téléchargement du template: ' . $e->getMessage());
        }
    }

    public function exportToCsv()
    {
        try {
            $query = $this->getMoniteursQuery();
            $moniteurs = $query->get();

            $fileName = 'moniteurs_export_' . date('Y-m-d_H-i-s') . '.csv';

            return response()->streamDownload(function () use ($moniteurs) {
                $file = fopen('php://output', 'w');

                fputcsv($file, [
                    'Nom', 'Entité', 'Statut', 'Fabricant', 'Modèle', 
                    'Numéro de série', 'Utilisateur', 'Lieu', 'Type', 'Commentaires'
                ]);

                foreach ($moniteurs as $moniteur) {
                    fputcsv($file, [
                        $moniteur->nom,
                        $moniteur->entite ?? 'N/A',
                        $moniteur->statut,
                        $moniteur->fabricant ?? 'N/A',
                        $moniteur->modele ?? 'N/A',
                        $moniteur->numero_serie ?? 'N/A',
                        $moniteur->utilisateur->name ?? 'Non attribué',
                        $moniteur->lieu ?? 'N/A',
                        $moniteur->type ?? 'N/A',
                        $moniteur->commentaires ?? '',
                    ]);
                }

                fclose($file);
            }, $fileName);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'export: ' . $e->getMessage());
        }
    }

    // ==================== GESTION DES FICHIERS ====================

    public function openFileModal($moniteurId)
    {
        $this->selectedMoniteurForFiles = MoniteurModel::find($moniteurId);
        $this->loadAttachedFiles();
        $this->showFileModal = true;
    }

    public function closeFileModal()
    {
        $this->showFileModal = false;
        $this->selectedMoniteurForFiles = null;
        $this->uploadedFiles = [];
        $this->attachedFiles = [];
    }

    private function loadAttachedFiles()
    {
        if ($this->selectedMoniteurForFiles) {
            $folder = "moniteurs/{$this->selectedMoniteurForFiles->id}";
            
            if (Storage::disk('public')->exists($folder)) {
                $files = Storage::disk('public')->allFiles($folder);
                
                $this->attachedFiles = collect($files)->map(function($file) {
                    return [
                        'path' => $file,
                        'name' => basename($file),
                        'url' => Storage::disk('public')->url($file),
                        'size' => $this->formatFileSize(Storage::disk('public')->size($file)),
                        'date' => date('d/m/Y H:i', Storage::disk('public')->lastModified($file)),
                    ];
                })->toArray();
            } else {
                $this->attachedFiles = [];
            }
        }
    }

    public function uploadFiles()
    {
        $this->validate([
            'uploadedFiles.*' => 'file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,txt'
        ]);

        if ($this->selectedMoniteurForFiles && count($this->uploadedFiles) > 0) {
            $uploadedCount = 0;
            
            foreach ($this->uploadedFiles as $file) {
                try {
                    $dateFolder = now()->format('Y-m-d');
                    $filePath = $file->storeAs(
                        "moniteurs/{$this->selectedMoniteurForFiles->id}/{$dateFolder}",
                        $file->getClientOriginalName(),
                        'public'
                    );
                    
                    $uploadedCount++;
                    
                } catch (\Exception $e) {
                    session()->flash('error', 'Erreur lors de l\'upload de ' . $file->getClientOriginalName() . ': ' . $e->getMessage());
                }
            }

            $this->uploadedFiles = [];
            $this->loadAttachedFiles();
            
            session()->flash('success', $uploadedCount . ' fichier(s) uploadé(s) avec succès.');
        }
    }

    public function downloadFile($filePath)
    {
        try {
            return Storage::disk('public')->download($filePath);
        } catch (\Exception $e) {
            session()->flash('error', 'Fichier non trouvé: ' . $e->getMessage());
        }
    }

    public function deleteFile($filePath)
    {
        try {
            Storage::disk('public')->delete($filePath);
            $this->loadAttachedFiles();
            
            session()->flash('success', 'Fichier supprimé avec succès.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    // ==================== MÉTHODES POUR LES DÉTAILS ====================

    public function showDetails($id)
    {
        $this->selectedMoniteur = MoniteurModel::with(['utilisateur', 'usager'])->find($id);
        if ($this->selectedMoniteur) {
            $this->showDetailsModal = true;
        }
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedMoniteur = null;
    }

    public function closeDeleteModal()
    {
        $this->confirmingDelete = false;
        $this->deleteId = null;
        $this->selectedMoniteurName = '';
    }

    // ==================== MÉTHODES POUR LES STATISTIQUES ====================

    public function chargerStatistiques()
    {
        try {
            $this->statsGlobales = MoniteurModel::select('statut', DB::raw('COUNT(*) as count'))
                ->groupBy('statut')
                ->get()
                ->pluck('count', 'statut')
                ->toArray();

            $this->stats = [
                'total'         => MoniteurModel::count(),
                'en_service'    => MoniteurModel::where('statut', 'En service')->count(),
                'en_stock'      => MoniteurModel::where('statut', 'En stock')->count(),
                'hors_service'  => MoniteurModel::where('statut', 'Hors service')->count(),
                'en_reparation' => MoniteurModel::where('statut', 'En réparation')->count(),
            ];

        } catch (\Throwable $e) {
            $this->statsGlobales = [];
            $this->stats = [
                'total'         => 0,
                'en_service'    => 0,
                'en_stock'      => 0,
                'hors_service'  => 0,
                'en_reparation' => 0,
            ];
        }
    }

    private function chargerFabricants()
    {
        $this->fabricants = MoniteurModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();
    }

    private function chargerEntites()
    {
        $this->entites = MoniteurModel::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();
    }

    public function toggleStats()
    {
        $this->showStats = !$this->showStats;
        if ($this->showStats) {
            $this->chargerStatistiques();
        }
    }

    // ==================== MÉTHODES UTILITAIRES ====================

    private function resetForm()
    {
        $this->reset([
            'moniteurId', 'nom', 'entite_form', 'statut_form', 'fabricant_form',
            'numero_serie', 'utilisateur_id', 'usager_id', 'lieu', 'type',
            'modele', 'commentaires'
        ]);
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
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

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingSelectedMoniteurs()
    {
        $this->selectAll = false;
    }

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
}