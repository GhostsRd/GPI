<?php
// app/Http/Controllers/Admin/DocumentController.php

namespace App\Http\Livewire\Documentation;

use App\Models\Document;
use App\Models\DocumentCategory;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AdminDoc extends Component
{
    use \Livewire\WithPagination;
    use \Livewire\WithFileUploads;

    public $search;
    public $category;
    public $type;
    public $status;
    public $per_page = 10;
    public $sort = 'created_at';
    public $direction = 'desc';

    // Modal properties
    public $showModal = false;
    public $showDeleteModal = false;
    public $modalAction = 'create';
    public $documentId;
    public $documentToDelete;
    public $title, $description, $category_id, $file_type, $sourceType = 'file', $video_url, $embed_url;
    public $is_published = true;
    public $allow_download = true;
    public $file; // for Livewire file uploads
    public $selectedDocuments = []; // for bulk actions
    public $isBulkDelete = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'type' => ['except' => ''],
        'status' => ['except' => ''],
        'sort' => ['except' => 'created_at'],
        'direction' => ['except' => 'desc'],
    ];

    /**
     * Renders the component
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'file' => 'nullable|max:102400', // 100MB
        ]);
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->modalAction = 'create';
        $this->showModal = true;
        $this->dispatchBrowserEvent('open-doc-modal');
    }

    public function openEditModal($id)
    {
        $this->resetForm();
        $this->modalAction = 'edit';
        $this->documentId = $id;
        
        $doc = Document::findOrFail($id);
        $this->title = $doc->title;
        $this->description = $doc->description;
        $this->category_id = $doc->category_id;
        $this->file_type = $doc->file_extension;
        $this->sourceType = $doc->source_type ?? 'file';
        $this->video_url = $doc->video_url;
        $this->embed_url = $doc->embed_url;
        $this->is_published = $doc->is_published;
        $this->allow_download = $doc->allow_download;
        
        $this->showModal = true;
        $this->dispatchBrowserEvent('open-doc-modal');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->dispatchBrowserEvent('close-doc-modal');
    }

    private function resetForm()
    {
        $this->reset(['title', 'description', 'category_id', 'file_type', 'sourceType', 'video_url', 'embed_url', 'is_published', 'allow_download', 'file', 'documentId']);
        $this->sourceType = 'file';
        $this->is_published = true;
        $this->allow_download = true;
    }

    public function submit()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:document_categories,id',
            'file_type' => 'required|string',
            'sourceType' => 'required|in:file,video,embed',
            'is_published' => 'boolean',
            'allow_download' => 'boolean'
        ];

        if ($this->modalAction === 'create' && $this->sourceType === 'file') {
            $rules['file'] = 'required|file|max:102400';
        }

        $this->validate($rules);

        try {
            $data = [
                'title' => $this->title,
                'slug' => Str::slug($this->title) . '-' . time(),
                'description' => $this->description,
                'category_id' => $this->category_id,
                'file_type' => $this->file_type,
                'file_extension' => $this->file_type,
                'uploaded_by' => Auth::id(),
                'is_published' => $this->is_published,
                'allow_download' => $this->allow_download,
                'published_at' => $this->is_published ? now() : null,
                'source_type' => $this->sourceType
            ];

            if ($this->modalAction === 'edit') {
                $document = Document::findOrFail($this->documentId);
                unset($data['uploaded_by']); // Don't change uploader on edit
                
                if ($this->is_published && !$document->is_published) {
                    $data['published_at'] = now();
                }
            }

            // File handling
            if ($this->sourceType === 'file' && $this->file) {
                // Remove old file if editing
                if ($this->modalAction === 'edit' && isset($document) && $document->file_path) {
                    Storage::disk('public')->delete($document->file_path);
                }

                $fileName = time() . '_' . Str::slug($this->file->getClientOriginalName()) . '.' . $this->file->getClientOriginalExtension();
                $filePath = $this->file->storeAs('documents', $fileName, 'public');

                $data = array_merge($data, [
                    'file_path' => $filePath,
                    'file_name' => $fileName,
                    'file_original_name' => $this->file->getClientOriginalName(),
                    'file_extension' => $this->file->getClientOriginalExtension(),
                    'file_size' => $this->file->getSize(),
                    'mime_type' => $this->file->getMimeType()
                ]);
            } elseif ($this->sourceType === 'video') {
                $data['video_url'] = $this->video_url;
                $data['embed_url'] = null;
            } elseif ($this->sourceType === 'embed') {
                $data['embed_url'] = $this->embed_url;
                $data['video_url'] = null;
            }

            if ($this->modalAction === 'edit') {
                $document->update($data);
                session()->flash('success', 'Document mis à jour avec succès.');
            } else {
                Document::create($data);
                session()->flash('success', 'Document créé avec succès.');
            }

            $this->closeModal();
            $this->resetForm();

        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function confirmDelete($id, $title = '')
    {
        $this->documentId = $id;
        $this->documentToDelete = ['id' => $id, 'title' => $title];
        $this->isBulkDelete = false;
        $this->showDeleteModal = true;
    }

    public function confirmBulkDelete()
    {
        if (empty($this->selectedDocuments)) {
            return;
        }
        $this->isBulkDelete = true;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->isBulkDelete = false;
    }

    public function deleteDocument()
    {
        if ($this->isBulkDelete) {
            $this->performBulkDelete();
        } else {
            $this->performSingleDelete();
        }
        $this->closeDeleteModal();
    }

    private function performSingleDelete()
    {
        if ($this->documentId) {
            $doc = Document::find($this->documentId);
            if ($doc) {
                if ($doc->file_path) {
                    Storage::disk('public')->delete($doc->file_path);
                }
                $doc->delete();
                session()->flash('success', 'Document supprimé avec succès');
            }
        }
    }

    private function performBulkDelete()
    {
        if (empty($this->selectedDocuments)) {
            return;
        }

        try {
            $documents = Document::whereIn('id', $this->selectedDocuments)->get();
            foreach ($documents as $document) {
                if ($document->file_path) {
                    Storage::disk('public')->delete($document->file_path);
                }
                $document->delete();
            }
            $this->selectedDocuments = [];
            session()->flash('success', 'Documents supprimés avec succès.');
        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue lors de la suppression groupée.');
        }
    }

    public function render()
    {
        $query = Document::with(['category']);

        // Filtre par recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'LIKE', "%{$this->search}%")
                  ->orWhere('description', 'LIKE', "%{$this->search}%")
                  ->orWhere('content', 'LIKE', "%{$this->search}%");
            });
        }

        // Filtre par catégorie
        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        // Filtre par type
        if ($this->type) {
            $query->where('file_extension', $this->type);
        }

        // Filtre par statut
        if ($this->status) {
            if ($this->status === 'published') {
                $query->where('is_published', true);
            } elseif ($this->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        // Tri
        $allowedSortFields = ['title', 'views', 'downloads', 'created_at', 'updated_at'];
        $sortField = in_array($this->sort, $allowedSortFields) ? $this->sort : 'created_at';
        $query->orderBy($sortField, $this->direction);

        $documents = $query->paginate($this->per_page);
        $categories = DocumentCategory::orderBy('name')->get();

        // Statistiques
        $stats = [
            'total' => Document::count(),
            'published' => Document::where('is_published', true)->count(),
            'draft' => Document::where('is_published', false)->count(),
            'total_views' => Document::sum('views'),
            'total_downloads' => Document::sum('downloads')
        ];

        return view('livewire.documentation.admin-doc', [
            'documents' => $documents,
            'categories' => $categories,
            'stats' => $stats
        ]);
    }

    /**
     * Récupère un document pour édition (AJAX)
     */
    public function edit($id)
    {
        try {
            $document = Document::with('category')->findOrFail($id);
            
            return response()->json([
                'id' => $document->id,
                'title' => $document->title,
                'description' => $document->description,
                'content' => $document->content,
                'category_id' => $document->category_id,
                'file_type' => $document->file_extension,
                'file_extension' => $document->file_extension,
                'is_published' => $document->is_published,
                'allow_download' => $document->allow_download,
                'source_type' => $document->source_type ?? 'file',
                'video_url' => $document->video_url,
                'embed_url' => $document->embed_url,
                'file_name' => $document->file_original_name,
                'file_size' => $document->file_size,
                'file_path' => $document->file_path
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Document non trouvé'
            ], 404);
        }
    }

    /**
     * Enregistre un nouveau document
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:document_categories,id',
            'file_type' => 'required|string',
            'sourceType' => 'required|in:file,video,embed',
            'is_published' => 'boolean',
            'allow_download' => 'boolean'
        ]);

        // Validation conditionnelle selon le type de source
        if ($request->sourceType === 'file') {
            $validator->sometimes('file', 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,mp4,avi,mov|max:102400', function ($input) {
                return $input->sourceType === 'file';
            });
        } elseif ($request->sourceType === 'video') {
            $validator->sometimes('video_url', 'required|url', function ($input) {
                return $input->sourceType === 'video';
            });
        } elseif ($request->sourceType === 'embed') {
            $validator->sometimes('embed_url', 'required|url', function ($input) {
                return $input->sourceType === 'embed';
            });
        }

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . time(),
                'description' => $request->description,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'file_type' => $request->file_type,
                'file_extension' => $request->file_type,
                'uploaded_by' => Auth::id(),
                'is_published' => $request->boolean('is_published', true),
                'allow_download' => $request->boolean('allow_download', true),
                'published_at' => $request->boolean('is_published', true) ? now() : null,
                'source_type' => $request->sourceType
            ];

            // Gestion selon le type de source
            if ($request->sourceType === 'file' && $request->hasFile('file')) {
                $file = $request->file('file');
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;
                $filePath = $file->storeAs('documents', $fileName, 'public');

                $data = array_merge($data, [
                    'file_path' => $filePath,
                    'file_name' => $fileName,
                    'file_original_name' => $originalName,
                    'file_extension' => $extension,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]);
            } elseif ($request->sourceType === 'video') {
                $data['video_url'] = $request->video_url;
                
                // Essayer d'extraire l'ID de la vidéo pour générer un nom
                $videoId = $this->extractVideoId($request->video_url);
                if ($videoId) {
                    $data['file_name'] = 'video_' . $videoId . '.mp4';
                }
            } elseif ($request->sourceType === 'embed') {
                $data['embed_url'] = $request->embed_url;
            }

            $document = Document::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Document créé avec succès.',
                'document' => $document
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue lors de la création.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Met à jour un document existant
     */
    public function update(Request $request, $id)
    {
        try {
            $document = Document::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'category_id' => 'required|exists:document_categories,id',
                'file_type' => 'required|string',
                'sourceType' => 'required|in:file,video,embed',
                'is_published' => 'boolean',
                'allow_download' => 'boolean'
            ]);

            // Validation conditionnelle selon le type de source
            if ($request->sourceType === 'file') {
                $validator->sometimes('file', 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,mp4,avi,mov|max:102400', function ($input) {
                    return $input->sourceType === 'file';
                });
            } elseif ($request->sourceType === 'video') {
                $validator->sometimes('video_url', 'required|url', function ($input) {
                    return $input->sourceType === 'video';
                });
            } elseif ($request->sourceType === 'embed') {
                $validator->sometimes('embed_url', 'required|url', function ($input) {
                    return $input->sourceType === 'embed';
                });
            }

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . time(),
                'description' => $request->description,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'file_type' => $request->file_type,
                'file_extension' => $request->file_type,
                'is_published' => $request->boolean('is_published', $document->is_published),
                'allow_download' => $request->boolean('allow_download', $document->allow_download),
                'source_type' => $request->sourceType
            ];

            // Gestion de la publication
            if ($request->boolean('is_published') && !$document->is_published) {
                $data['published_at'] = now();
            }

            // Gestion selon le type de source
            if ($request->sourceType === 'file') {
                if ($request->hasFile('file')) {
                    // Supprimer l'ancien fichier
                    if ($document->file_path) {
                        Storage::disk('public')->delete($document->file_path);
                    }

                    $file = $request->file('file');
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;
                    $filePath = $file->storeAs('documents', $fileName, 'public');

                    $data = array_merge($data, [
                        'file_path' => $filePath,
                        'file_name' => $fileName,
                        'file_original_name' => $originalName,
                        'file_extension' => $extension,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                        'video_url' => null,
                        'embed_url' => null
                    ]);
                } else {
                    // Garder les anciennes valeurs si pas de nouveau fichier
                    $data['video_url'] = null;
                    $data['embed_url'] = null;
                }
            } elseif ($request->sourceType === 'video') {
                $data['video_url'] = $request->video_url;
                $data['embed_url'] = null;
                
                // Supprimer l'ancien fichier si on passe de fichier à vidéo
                if ($document->file_path) {
                    Storage::disk('public')->delete($document->file_path);
                    $data['file_path'] = null;
                    $data['file_name'] = null;
                    $data['file_original_name'] = null;
                    $data['file_extension'] = $request->file_type;
                    $data['file_size'] = null;
                    $data['mime_type'] = null;
                }
            } elseif ($request->sourceType === 'embed') {
                $data['embed_url'] = $request->embed_url;
                $data['video_url'] = null;
                
                // Supprimer l'ancien fichier si on passe de fichier à embed
                if ($document->file_path) {
                    Storage::disk('public')->delete($document->file_path);
                    $data['file_path'] = null;
                    $data['file_name'] = null;
                    $data['file_original_name'] = null;
                    $data['file_extension'] = $request->file_type;
                    $data['file_size'] = null;
                    $data['mime_type'] = null;
                }
            }

            $document->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Document mis à jour avec succès.',
                'document' => $document
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue lors de la mise à jour.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Supprime un document
     */
    public function destroy($id)
    {
        try {
            $document = Document::findOrFail($id);

            // Supprimer le fichier associé
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Supprimer les vues associées
            $document->views()->delete();

            // Supprimer le document
            $document->delete();

            return response()->json([
                'success' => true,
                'message' => 'Document supprimé avec succès.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue lors de la suppression.',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function togglePublish($id)
    {
        try {
            $document = Document::findOrFail($id);
            $document->update([
                'is_published' => !$document->is_published,
                'published_at' => !$document->is_published ? now() : $document->published_at
            ]);
            session()->flash('success', 'Statut modifié.');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la modification.');
        }
    }

    /**
     * Télécharge un document
     */
    public function download($id)
    {
        try {
            $document = Document::findOrFail($id);

            if (!$document->allow_download) {
                return response()->json([
                    'error' => 'Ce document n\'est pas disponible au téléchargement.'
                ], 403);
            }

            if (!$document->file_path || !Storage::disk('public')->exists($document->file_path)) {
                return response()->json([
                    'error' => 'Fichier non trouvé.'
                ], 404);
            }

            // Incrémenter le compteur
            $document->increment('downloads_count');

            return Storage::disk('public')->download(
                $document->file_path,
                $document->file_original_name ?? $document->file_name
            );

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du téléchargement.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Extrait l'ID d'une vidéo YouTube/Vimeo
     */
    private function extractVideoId($url)
    {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $url, $matches)) {
            return $matches[1];
        }
        
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            return $matches[1];
        }
        
        if (preg_match('/dailymotion\.com\/video\/([^_]+)/', $url, $matches)) {
            return $matches[1];
        }
        
        return null;
    }
}