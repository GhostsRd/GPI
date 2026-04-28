<?php
// app/Http/Livewire/Documentation/AdminDoc.php

namespace App\Http\Livewire\Documentation;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminDoc extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Filtres et recherche
    public $search = '';
    public $categoryFilter = '';
    public $typeFilter = '';
    public $perPage = 10;
    
    // Nouvelle catégorie
    public $newCategoryName = '';
    public $showNewCategoryInput = false;

    // Upload de fichiers
    public $videoUpload;
    public $fileUpload;

    // Sélection multiple
    public $selectedDocuments = [];
    public $selectAll = false;
    
    // Preview modal
    public $previewDocument = null;
    public $showPreviewModal = false;

    // Listeners pour les événements
    protected $listeners = [
        'refresh' => '$refresh',
        'toast' => 'handleToast',
        'document-loaded' => 'handleDocumentLoaded'
    ];
    
    // Query string pour la persistance des filtres dans l'URL
    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'typeFilter' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    /**
     * Règles de validation
     */
    protected function rules()
    {
        return [
            'search' => 'nullable|string|max:255',
            'categoryFilter' => 'nullable|exists:document_categories,id',
            'typeFilter' => 'nullable|string|max:50',
            'perPage' => 'required|integer|in:10,25,50,100',
            'newCategoryName' => 'required|string|max:255|unique:document_categories,name',
            'fileUpload' => 'nullable|file|max:512000', // 500MB max
            'videoUpload' => 'nullable|file|max:512000|mimes:mp4,webm,avi,mov',
        ];
    }

    /**
     * Messages de validation personnalisés
     */
    protected function messages()
    {
        return [
            'newCategoryName.unique' => 'Cette catégorie existe déjà',
            'fileUpload.max' => 'Le fichier ne doit pas dépasser 500MB',
            'videoUpload.max' => 'La vidéo ne doit pas dépasser 500MB',
            'videoUpload.mimes' => 'Format vidéo non supporté (MP4, WebM, AVI, MOV uniquement)',
        ];
    }

    /**
     * Réinitialisation après chaque validation
     */
    protected function resetAfterValidation()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    /**
     * Méthode appelée quand 'perPage' change
     */
    public function updatedPerPage()
    {
        $this->resetPage();
        $this->dispatchBrowserEvent('toast', [
            'type' => 'info',
            'title' => 'Affichage modifié',
            'message' => "{$this->perPage} documents par page"
        ]);
    }

    /**
     * Gère la sélection de tous les documents
     */
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedDocuments = $this->documents->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedDocuments = [];
        }
    }

    /**
     * Gère la sélection individuelle
     */
    public function updatedSelectedDocuments()
    {
        $this->selectAll = count($this->selectedDocuments) === $this->documents->count();
    }

    /**
     * Réinitialise tous les filtres
     */
    public function resetFilters()
    {
        $this->reset(['search', 'categoryFilter', 'typeFilter', 'selectedDocuments', 'selectAll']);
        $this->resetPage();
        
        $this->dispatchBrowserEvent('toast', [
            'type' => 'info',
            'title' => 'Filtres réinitialisés',
            'message' => 'Tous les filtres ont été effacés'
        ]);
    }

    /**
     * Ajoute une nouvelle catégorie
     */
    public function addCategory()
    {
        $this->validate([
            'newCategoryName' => 'required|string|max:255|unique:document_categories,name',
        ]);

        $category = DocumentCategory::create([
            'name' => $this->newCategoryName,
            'slug' => Str::slug($this->newCategoryName),
            'created_by' => auth()->id(),
        ]);

        $this->newCategoryName = '';
        $this->showNewCategoryInput = false;

        $this->dispatchBrowserEvent('toast', [
            'type' => 'success',
            'title' => 'Succès',
            'message' => "Catégorie '{$category->name}' ajoutée"
        ]);

        return $category->id;
    }

    /**
     * Publie ou dépublie un document
     */
    public function togglePublish($id)
    {
        $document = Document::findOrFail($id);
        
        // Vérification supplémentaire pour la publication
        if (!$document->is_published && !$document->file_path && !$document->video_url && !$document->content) {
            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'title' => 'Impossible de publier',
                'message' => 'Le document n\'a pas de fichier associé'
            ]);
            return;
        }
        
        $document->is_published = !$document->is_published;
        $document->save();

        $this->dispatchBrowserEvent('toast', [
            'type' => 'success',
            'title' => 'Succès',
            'message' => $document->is_published ? 'Document publié' : 'Document dépublié'
        ]);
    }

    /**
     * Récupère un document pour édition
     */
    public function getDocument($id)
    {
        $doc = Document::with('category')->findOrFail($id);
        
        return [
            'id' => $doc->id,
            'title' => $doc->title,
            'description' => $doc->description,
            'category_id' => $doc->category_id,
            'type' => $doc->type,
            'file_extension' => $doc->file_extension,
            'video_url' => $doc->video_url,
            'file_path' => $doc->file_path ? Storage::disk('public')->url($doc->file_path) : null,
            'embed_url' => $doc->content,
            'file_name' => $doc->file_name,
            'file_size' => $doc->file_size,
            'is_published' => $doc->is_published,
            'allow_download' => $doc->allow_download ?? true,
        ];
    }

    /**
     * Gère le chargement d'un document dans Alpine
     */
    public function handleDocumentLoaded($data)
    {
        $this->dispatchBrowserEvent('document-loaded', $data);
    }

    /**
     * Crée un nouveau document
     */
    public function createDocument($data)
    {
        // S'assurer que les colonnes nécessaires existent
        $this->ensureRequiredColumnsExist();

        // Validation
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:document_categories,id',
            'file_type' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $this->dispatchBrowserEvent('validation-errors', ['errors' => $validator->errors()]);
            return;
        }

        $document = new Document();
        $document->title = $data['title'];
        $document->description = $data['description'] ?? null;
        $document->category_id = $data['category_id'];
        $document->file_extension = $data['file_type'];
        $document->is_published = $data['is_published'] ?? false;
        $document->allow_download = $data['allow_download'] ?? true;
        $document->user_id = auth()->id();
        $document->content = $data['description'] ?? '';

        try {
            // Gestion selon le type de source
            if ($data['sourceType'] === 'file') {
                $this->handleFileUpload($document);
            } elseif ($data['sourceType'] === 'video') {
                $this->handleVideoUpload($document, $data);
            } elseif ($data['sourceType'] === 'embed') {
                $document->content = $data['embed_url'];
                $document->type = 'link';
                $document->file_extension = 'url';
            }

            // Fallback pour le type
            if (!$document->type) {
                $document->type = $this->inferType($document->file_extension);
            }

            $document->save();
            $this->resetPage();
            
            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'title' => 'Succès',
                'message' => 'Document créé avec succès'
            ]);
            
            $this->dispatchBrowserEvent('document-created', ['id' => $document->id]);
            
        } catch (\Exception $e) {
            \Log::error('Document creation error: ' . $e->getMessage());
            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Impossible de créer le document: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Gère l'upload de fichier
     */
    private function handleFileUpload($document)
    {
        if (!$this->fileUpload) {
            // Si c'est une mise à jour et qu'un fichier existe déjà, on skip
            if ($document->exists && $document->file_path) {
                return;
            }
            throw new \Exception('Aucun fichier sélectionné');
        }

        $this->validate(['fileUpload' => 'required|file|max:512000']);

        $extension = strtolower($this->fileUpload->getClientOriginalExtension());
        $type = $this->inferType($extension);
        $folder = $this->getStorageFolder($type);
        
        $document->file_size = $this->fileUpload->getSize();
        
        // Déterminer le disque de stockage
        $disk = 'public';
        if ($document->file_size > 52428800 && config('filesystems.disks.google.clientId')) { // > 50MB
            $disk = 'google';
        }
        
        $path = $this->fileUpload->store($folder, $disk);
        $document->file_path = ($disk === 'google') ? 'google:' . $path : $path;
        $document->file_name = $this->fileUpload->getClientOriginalName();
        $document->file_extension = $extension;
        $document->type = $type;

        // Backup sur Google Drive si stockage local
        if ($disk === 'public' && config('filesystems.disks.google.clientId')) {
            try {
                $this->fileUpload->storeAs($folder, $document->file_name, 'google');
            } catch (\Exception $e) {
                \Log::warning('Google Drive backup failed: ' . $e->getMessage());
            }
        }

        $this->fileUpload = null;
    }

    /**
     * Gère l'upload de vidéo
     */
    private function handleVideoUpload($document, $data)
    {
        if (isset($data['videoSource']) && $data['videoSource'] === 'file') {
            if (!$this->videoUpload) {
                // Si c'est une mise à jour et qu'un fichier existe déjà, on skip
                if ($document->exists && $document->file_path) {
                    $document->type = 'video';
                    return;
                }
                \Log::error('Video upload null. VideoUpload property state: ' . ($this->videoUpload ? 'set' : 'null'));
                throw new \Exception('Aucune vidéo sélectionnée. Veuillez réessayer.');
            }

            $this->validate(['videoUpload' => 'required|file|max:512000|mimes:mp4,webm,avi,mov']);
            
            $document->file_size = $this->videoUpload->getSize();
            
            $disk = 'public';
            if ($document->file_size > 52428800 && config('filesystems.disks.google.clientId')) {
                $disk = 'google';
            }
            
            $path = $this->videoUpload->store('videos', $disk);
            $document->file_path = ($disk === 'google') ? 'google:' . $path : $path;
            $document->file_name = $this->videoUpload->getClientOriginalName();
            $document->file_extension = strtolower($this->videoUpload->getClientOriginalExtension());
            $document->type = 'video';

            if ($disk === 'public' && config('filesystems.disks.google.clientId')) {
                try {
                    $this->videoUpload->storeAs('videos', $document->file_name, 'google');
                } catch (\Exception $e) {
                    \Log::warning('Google Drive video backup failed: ' . $e->getMessage());
                }
            }

            $this->videoUpload = null;
        } else {
            $document->video_url = $data['video_url'] ?? null;
            $document->type = 'video';
            $document->file_extension = 'mp4';
        }
    }

    /**
     * Met à jour un document existant
     */
    public function updateDocument($data)
    {
        $this->ensureRequiredColumnsExist();

        $document = Document::findOrFail($data['id']);
        
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:document_categories,id',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $this->dispatchBrowserEvent('validation-errors', ['errors' => $validator->errors()]);
            return;
        }

        $document->title = $data['title'];
        $document->description = $data['description'] ?? null;
        $document->category_id = $data['category_id'];
        
        // Vérification de publication
        $wantToPublish = $data['is_published'] ?? false;
        if ($wantToPublish && $data['sourceType'] === 'file') {
            $existsOnDisk = $document->file_path && Storage::disk('public')->exists($document->file_path);
            if (!$existsOnDisk && !$this->fileUpload) {
                $this->dispatchBrowserEvent('toast', [
                    'type' => 'error',
                    'title' => 'Impossible de publier',
                    'message' => 'Le fichier est introuvable. Veuillez le ré-uploader.'
                ]);
                return;
            }
        }
        
        $document->is_published = $wantToPublish;
        $document->allow_download = $data['allow_download'] ?? true;
        $document->content = $data['description'] ?? $document->content;

        try {
            // Gestion des mises à jour selon le type
            if ($data['sourceType'] === 'file' && $this->fileUpload) {
                $this->updateFile($document);
            } elseif ($data['sourceType'] === 'video' && isset($data['videoSource'])) {
                $this->updateVideo($document, $data);
            } elseif ($data['sourceType'] === 'embed') {
                $document->content = $data['embed_url'];
                $document->type = 'link';
                $document->file_extension = 'url';
            }

            // Mise à jour du type si nécessaire
            if (!$this->fileUpload && !$this->videoUpload && $document->file_extension) {
                $document->type = $this->inferType($document->file_extension);
            }

            $document->save();
            
            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'title' => 'Succès',
                'message' => 'Document modifié avec succès'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Document update error: ' . $e->getMessage());
            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Impossible de modifier le document: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Met à jour le fichier d'un document
     */
    private function updateFile($document)
    {
        $this->validate(['fileUpload' => 'file|max:512000']);
        
        // Supprimer l'ancien fichier
        if ($document->file_path) {
            $oldDisk = str_starts_with($document->file_path, 'google:') ? 'google' : 'public';
            $oldPath = str_replace('google:', '', $document->file_path);
            Storage::disk($oldDisk)->delete($oldPath);
        }
        
        $extension = strtolower($this->fileUpload->getClientOriginalExtension());
        $type = $this->inferType($extension);
        $folder = $this->getStorageFolder($type);
        
        $document->file_size = $this->fileUpload->getSize();
        
        $disk = 'public';
        if ($document->file_size > 52428800 && config('filesystems.disks.google.clientId')) {
            $disk = 'google';
        }
        
        $path = $this->fileUpload->store($folder, $disk);
        $document->file_path = ($disk === 'google') ? 'google:' . $path : $path;
        $document->file_name = $this->fileUpload->getClientOriginalName();
        $document->file_extension = $extension;
        $document->type = $type;
        
        $this->fileUpload = null;
    }

    /**
     * Met à jour la vidéo d'un document
     */
    private function updateVideo($document, $data)
    {
        if ($data['videoSource'] === 'file' && $this->videoUpload) {
            $this->validate(['videoUpload' => 'file|max:512000|mimes:mp4,webm,avi,mov']);
            
            if ($document->file_path) {
                $oldDisk = str_starts_with($document->file_path, 'google:') ? 'google' : 'public';
                $oldPath = str_replace('google:', '', $document->file_path);
                Storage::disk($oldDisk)->delete($oldPath);
            }
            
            $document->file_size = $this->videoUpload->getSize();
            
            $disk = 'public';
            if ($document->file_size > 52428800 && config('filesystems.disks.google.clientId')) {
                $disk = 'google';
            }
            
            $path = $this->videoUpload->store('videos', $disk);
            $document->file_path = ($disk === 'google') ? 'google:' . $path : $path;
            $document->file_name = $this->videoUpload->getClientOriginalName();
            $document->file_extension = strtolower($this->videoUpload->getClientOriginalExtension());
            $document->type = 'video';
            $document->video_url = null;
            
            $this->videoUpload = null;
        } elseif ($data['videoSource'] === 'url') {
            $document->video_url = $data['video_url'];
            $document->type = 'video';
            $document->file_extension = 'mp4';
            // Ne pas supprimer l'ancien fichier s'il existe
        }
    }

    /**
     * Détermine le dossier de stockage selon le type
     */
    private function getStorageFolder($type)
    {
        return match($type) {
            'pdf' => 'pdf',
            'image' => 'images',
            'video' => 'videos',
            'audio' => 'audio',
            'word', 'spreadsheet', 'ppt' => 'documents',
            default => 'documents',
        };
    }

    /**
     * Infère le type de fichier à partir de l'extension
     */
    private function inferType($extension)
    {
        $extension = strtolower($extension ?? '');
        $types = [
            'pdf' => ['pdf'],
            'image' => ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'bmp'],
            'video' => ['mp4', 'webm', 'ogg', 'avi', 'mov', 'wmv', 'flv'],
            'audio' => ['mp3', 'wav', 'ogg', 'm4a', 'flac'],
            'word' => ['doc', 'docx', 'odt', 'rtf', 'txt'],
            'spreadsheet' => ['xls', 'xlsx', 'ods', 'csv'],
            'ppt' => ['ppt', 'pptx', 'odp'],
        ];

        foreach ($types as $type => $extensions) {
            if (in_array($extension, $extensions)) {
                return $type;
            }
        }

        return 'other';
    }

    /**
     * Assure que les colonnes nécessaires existent et ont le bon format
     */
    private function ensureRequiredColumnsExist()
    {
        static $checked = false;
        if ($checked) return;
        
        try {
            // S'assurer que 'type' est VARCHAR
            \Illuminate\Support\Facades\DB::statement(
                "ALTER TABLE documents MODIFY COLUMN type VARCHAR(255) NULL"
            );
            
            // Ajouter 'allow_download' si manquant
            $columns = \Illuminate\Support\Facades\DB::select("SHOW COLUMNS FROM documents LIKE 'allow_download'");
            if (empty($columns)) {
                \Illuminate\Support\Facades\DB::statement(
                    "ALTER TABLE documents ADD COLUMN allow_download TINYINT(1) DEFAULT 1 AFTER is_published"
                );
            }
        } catch (\Exception $e) {
            \Log::warning('Database enhancement failed: ' . $e->getMessage());
        }
        
        $checked = true;
    }

    /**
     * Affiche l'aperçu d'un document
     */
    public function showPreview($id)
    {
        $this->previewDocument = Document::with('category')->findOrFail($id);
        
        // Ajouter l'URL publique pour l'affichage
        if ($this->previewDocument->file_path && !str_starts_with($this->previewDocument->file_path, 'google:')) {
            $this->previewDocument->public_url = Storage::disk('public')->url($this->previewDocument->file_path);
        }
        
        // Incrémenter les vues
        $this->previewDocument->increment('views');
        
        $this->showPreviewModal = true;
    }

    /**
     * Ferme l'aperçu
     */
    public function closePreview()
    {
        $this->previewDocument = null;
        $this->showPreviewModal = false;
    }

    /**
     * Gère les toasts
     */
    public function handleToast($data)
    {
        $this->dispatchBrowserEvent('toast', $data);
    }

    /**
     * Supprime un document
     */
    public function deleteDocument($id)
    {
        try {
            $document = Document::findOrFail($id);
            
            // Supprimer le fichier physique
            if ($document->file_path) {
                $disk = str_starts_with($document->file_path, 'google:') ? 'google' : 'public';
                $path = str_replace('google:', '', $document->file_path);
                Storage::disk($disk)->delete($path);
            }
            
            $document->delete();
            
            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'title' => 'Succès',
                'message' => 'Document supprimé'
            ]);
            
            // Nettoyer la sélection
            $this->selectedDocuments = array_diff($this->selectedDocuments, [$id]);
            $this->selectAll = false;
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Impossible de supprimer le document'
            ]);
        }
    }

    /**
     * Supprime les documents sélectionnés
     */
    public function deleteSelected()
    {
        try {
            $documents = Document::whereIn('id', $this->selectedDocuments)->get();
            
            foreach ($documents as $doc) {
                if ($doc->file_path) {
                    $disk = str_starts_with($doc->file_path, 'google:') ? 'google' : 'public';
                    $path = str_replace('google:', '', $doc->file_path);
                    Storage::disk($disk)->delete($path);
                }
                $doc->delete();
            }
            
            $this->selectedDocuments = [];
            $this->selectAll = false;
            
            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'title' => 'Succès',
                'message' => count($documents) . ' document(s) supprimé(s)'
            ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Impossible de supprimer les documents'
            ]);
        }
    }

    /**
     * Propriété calculée pour les statistiques
     */
    public function getStatsProperty()
    {
        return [
            'total' => Document::count(),
            'published' => Document::where('is_published', true)->count(),
            'draft' => Document::where('is_published', false)->count(),
            'total_views' => Document::sum('views'),
            'total_downloads' => Document::sum('downloads'),
        ];
    }

    /**
     * Propriété calculée pour la liste des documents
     */
    public function getDocumentsProperty()
    {
        return Document::with('category')
            ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->when($this->categoryFilter, fn($q) => $q->where('category_id', $this->categoryFilter))
            ->when($this->typeFilter, function($q) {
                $q->where(function($query) {
                    $query->where('type', $this->typeFilter)
                          ->orWhere('file_extension', $this->typeFilter);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    /**
     * Rendu de la vue
     */
    public function render()
    {
        return view('livewire.documentation.admin-doc', [
            'documents' => $this->documents,
            'categories' => DocumentCategory::orderBy('name')->get(),
            'stats' => $this->stats,
        ])->layout('layouts.app'); // ou votre layout par défaut
    }
}