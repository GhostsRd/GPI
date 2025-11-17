<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Logiciel as LogicielModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    public $modalTitle = 'Ajouter un logiciel';
    public $editMode = false;
    public $selectedLogiciel = null;
    public $confirmingDelete = false;
    public $selectedLogicielName = '';

    // Import simple
    public $fichierExcel;
    public $showStats = true;

    // Statistiques
    public $stats = [];

    // Sélection multiple
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

        $query->orderBy($this->sortField, $this->sortDirection);

        $logiciels = $query->paginate($this->perPage);

        $editeurs = LogicielModel::distinct()->whereNotNull('editeur')->pluck('editeur');
        $systemes = LogicielModel::distinct()->whereNotNull('version_systeme_exploitation')->pluck('version_systeme_exploitation');

        return view('livewire.equipement.logiciel', compact('logiciels', 'editeurs', 'systemes'));
    }

    // ==================== CRUD ====================

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

            $this->closeModal();
            $this->chargerStatistiques();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $logiciel = LogicielModel::findOrFail($id);
        $this->selectedLogicielName = $logiciel->nom;
        $this->logicielId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
        try {
            LogicielModel::findOrFail($this->logicielId)->delete();
            session()->flash('message', 'Logiciel supprimé avec succès.');
            $this->chargerStatistiques();
            $this->closeDeleteModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function deleteSelected()
    {
        try {
            $count = LogicielModel::whereIn('id', $this->selectedLogiciels)->delete();
            $this->selectedLogiciels = [];
            session()->flash('message', $count . ' logiciel(s) supprimé(s).');
            $this->chargerStatistiques();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function showDetails($id)
    {
        $this->selectedLogiciel = LogicielModel::find($id);
        $this->showDetailsModal = true;
    }

    // ==================== IMPORT SIMPLIFIÉ ====================

    public function openImportModal()
    {
        $this->showImportModal = true;
        $this->reset(['fichierExcel']);
    }

    public function closeImportModal()
    {
        $this->showImportModal = false;
    }

    public function importLogiciels()
    {
        $this->validate([
            'fichierExcel' => 'required|file|mimes:csv,txt|max:10240'
        ]);

        try {
            // Sauvegarder le fichier
            $filePath = $this->fichierExcel->storeAs(
                'imports/logiciels',
                'import_' . time() . '.csv',
                'public'
            );

            // Traiter le fichier
            $result = $this->processCSV(storage_path('app/public/' . $filePath));
            
            session()->flash('message', "Import réussi: {$result['imported']} logiciel(s) importé(s)");
            $this->closeImportModal();
            $this->chargerStatistiques();

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur import: ' . $e->getMessage());
        }
    }

    private function processCSV($filePath)
    {
        $file = fopen($filePath, 'r');
        
        // Lire et ignorer les en-têtes
        $headers = fgetcsv($file);
        
        $importedCount = 0;
        $lineNumber = 1;
        $errors = [];

        while (($row = fgetcsv($file)) !== FALSE) {
            $lineNumber++;
            
            try {
                // Format fixe: nom, editeur, version_nom, systeme_exploitation, installations, licences, date_achat, date_expiration, description
                $data = [
                    'nom' => trim($row[0] ?? ''),
                    'editeur' => isset($row[1]) ? trim($row[1]) : null,
                    'version_nom' => isset($row[2]) ? trim($row[2]) : null,
                    'version_systeme_exploitation' => isset($row[3]) ? trim($row[3]) : null,
                    'nombre_installations' => isset($row[4]) && is_numeric($row[4]) ? intval($row[4]) : 0,
                    'nombre_licences' => isset($row[5]) && is_numeric($row[5]) ? intval($row[5]) : 0,
                    'date_achat' => isset($row[6]) ? $this->parseDate(trim($row[6])) : null,
                    'date_expiration' => isset($row[7]) ? $this->parseDate(trim($row[7])) : null,
                    'description' => isset($row[8]) ? trim($row[8]) : null,
                ];

                // Vérifier le nom (obligatoire)
                if (empty($data['nom'])) {
                    $errors[] = "Ligne $lineNumber: Nom manquant - ignorée";
                    continue;
                }

                // Éviter les doublons
                if (!LogicielModel::where('nom', $data['nom'])->exists()) {
                    LogicielModel::create($data);
                    $importedCount++;
                }

            } catch (\Exception $e) {
                $errors[] = "Ligne $lineNumber: " . $e->getMessage();
            }
        }

        fclose($file);
        
        // Sauvegarder le rapport
        $this->saveImportReport($importedCount, $lineNumber - 1, $errors);
        
        return [
            'imported' => $importedCount,
            'total' => $lineNumber - 1,
            'errors' => $errors
        ];
    }

    private function parseDate($dateString)
    {
        if (empty($dateString)) return null;

        try {
            return \Carbon\Carbon::parse($dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function saveImportReport($imported, $totalLines, $errors)
    {
        $report = [
            'date' => now()->format('Y-m-d H:i:s'),
            'fichier' => $this->fichierExcel->getClientOriginalName(),
            'lignes_traitees' => $totalLines,
            'logiciels_importes' => $imported,
            'erreurs' => $errors
        ];

        Storage::disk('local')->put('imports/reports/logiciel_' . time() . '.json', json_encode($report, JSON_PRETTY_PRINT));
    }

    // ==================== STATISTIQUES ====================

    public function toggleStats()
    {
        $this->showStats = !$this->showStats;
    }

    public function chargerStatistiques()
    {
        $this->stats = [
            'total' => LogicielModel::count(),
            'licences_critiques' => LogicielModel::where('statut_licences', 'Critique')->count(),
            'total_installations' => LogicielModel::sum('nombre_installations'),
            'total_licences' => LogicielModel::sum('nombre_licences'),
            'sans_licences' => LogicielModel::where('nombre_licences', 0)->count(),
            'taux_conformite' => LogicielModel::count() > 0 ? 
                round((LogicielModel::where('statut_licences', 'Conforme')->count() / LogicielModel::count()) * 100) : 0
        ];
    }

    // ==================== UTILITAIRES ====================

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function closeDeleteModal()
    {
        $this->confirmingDelete = false;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
    }

    public function resetForm()
    {
        $this->reset([
            'logicielId', 'nom', 'editeur_form', 'version_nom', 'version_systeme_exploitation',
            'nombre_installations', 'nombre_licences', 'description', 'date_achat', 'date_expiration'
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'editeur', 'systeme_exploitation', 'statutFilter']);
        $this->resetPage();
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
            $this->selectedLogiciels = LogicielModel::pluck('id')->toArray();
        } else {
            $this->selectedLogiciels = [];
        }
    }

    public function downloadTemplate()
    {
        $fileName = 'template_logiciels.csv';

        return response()->streamDownload(function () {
            $file = fopen('php://output', 'w');
            
            // En-têtes simples
            fputcsv($file, [
                'nom', 
                'editeur', 
                'version_nom', 
                'systeme_exploitation',
                'installations', 
                'licences', 
                'date_achat',
                'date_expiration', 
                'description'
            ]);

            // Exemples
            fputcsv($file, [
                'Microsoft Office',
                'Microsoft',
                '2021',
                'Windows 10/11',
                '50',
                '100',
                '2024-01-15',
                '2025-01-15',
                'Suite bureautique Microsoft'
            ]);

            fputcsv($file, [
                'Adobe Photoshop',
                'Adobe',
                '2023',
                'Windows/Mac',
                '25',
                '30',
                '2024-02-01',
                '2025-02-01',
                'Logiciel de retouche photo'
            ]);

            fclose($file);
        }, $fileName);
    }

    public function exportLogiciel()
    {
        try {
            $query = LogicielModel::query();

            if ($this->search) {
                $query->where('nom', 'like', "%{$this->search}%");
            }

            $logiciels = $query->orderBy('nom')->get();

            $fileName = 'logiciels_export_' . date('Y-m-d_H-i-s') . '.csv';

            return response()->streamDownload(function () use ($logiciels) {
                $file = fopen('php://output', 'w');

                fputcsv($file, [
                    'nom', 'editeur', 'version_nom', 'systeme_exploitation',
                    'installations', 'licences', 'date_achat', 'date_expiration', 'description'
                ]);

                foreach ($logiciels as $logiciel) {
                    fputcsv($file, [
                        $logiciel->nom,
                        $logiciel->editeur,
                        $logiciel->version_nom,
                        $logiciel->version_systeme_exploitation,
                        $logiciel->nombre_installations,
                        $logiciel->nombre_licences,
                        $logiciel->date_achat?->format('Y-m-d') ?? '',
                        $logiciel->date_expiration?->format('Y-m-d') ?? '',
                        $logiciel->description
                    ]);
                }

                fclose($file);
            }, $fileName);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur export: ' . $e->getMessage());
        }
    }
}