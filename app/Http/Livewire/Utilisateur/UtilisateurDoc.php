<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UtilisateurDoc extends Component
{
    use WithPagination;
    
    // Filtres
    public $search = '';
    public $activeCategory = 'all';
    public $selectedTypes = [];
    public $sortBy = 'date_desc';
    
    // États
    public $selectedContent = null;
    public $viewMode = 'grid';
    public $perPage = 12;
    public $favorites = [];
    public $showBookmarks = false;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'activeCategory' => ['except' => 'all'],
        'sortBy' => ['except' => 'date_desc'],
        'viewMode' => ['except' => 'grid'],
        'perPage' => ['except' => 12],
        'showBookmarks' => ['except' => false],
    ];

    public function mount()
    {
        $this->loadFavorites();
    }
    
    public function loadFavorites()
    {
        if (Auth::check()) {
            $this->favorites = Auth::user()->bookmarks()->pluck('documents.id')->toArray();
        } else {
            $this->favorites = session()->get('document_favorites', []);
        }
    }

    // ============ FONCTIONS UTILITAIRES ============

    // Fonction pour obtenir l'icône du type de document
    public function getTypeIcon($type)
    {
        $icons = [
            'guide' => 'book',
            'guides' => 'book',
            'tutorial' => 'play-circle',
            'tutorials' => 'play-circle',
            'reference' => 'bookmark',
            'references' => 'bookmark',
            'procedure' => 'list-check',
            'procedures' => 'list-check',
            'faq' => 'question-circle',
            'security' => 'shield-alt',
            'video' => 'video',
            'audio' => 'headphones',
            'pdf' => 'file-pdf',
            'image' => 'file-image',
            'spreadsheet' => 'file-excel',
            'word' => 'file-word',
        ];

        return $icons[$type] ?? 'file-alt';
    }

    // Fonction pour obtenir la couleur du type
    public function getTypeColor($type)
    {
        $colors = [
            'guide' => 'primary',
            'guides' => 'primary',
            'tutorial' => 'info',
            'tutorials' => 'info',
            'reference' => 'success',
            'references' => 'success',
            'procedure' => 'warning',
            'procedures' => 'warning',
            'faq' => 'danger',
            'security' => 'purple',
            'video' => 'secondary',
            'audio' => 'pink',
            'pdf' => 'danger',
            'image' => 'primary',
            'spreadsheet' => 'success',
            'word' => 'info',
        ];

        return $colors[$type] ?? 'primary';
    }

    // Obtenir la couleur de la catégorie
    private function getCategoryColor($categorySlug)
    {
        $colors = [
            'guides' => 'primary',
            'tutorials' => 'info',
            'references' => 'success',
            'faq' => 'warning',
            'security' => 'purple',
            'procedures' => 'cyan',
            'general' => 'secondary',
        ];

        return $colors[$categorySlug] ?? 'primary';
    }

    // Obtenir l'icône du fichier
    private function getFileIcon($extension)
    {
        $icons = [
            'pdf' => 'file-pdf',
            'jpg' => 'file-image',
            'jpeg' => 'file-image',
            'png' => 'file-image',
            'gif' => 'file-image',
            'bmp' => 'file-image',
            'svg' => 'file-image',
            'mp4' => 'file-video',
            'avi' => 'file-video',
            'mov' => 'file-video',
            'wmv' => 'file-video',
            'mp3' => 'file-audio',
            'wav' => 'file-audio',
            'ogg' => 'file-audio',
            'doc' => 'file-word',
            'docx' => 'file-word',
            'xls' => 'file-excel',
            'xlsx' => 'file-excel',
            'ppt' => 'file-powerpoint',
            'pptx' => 'file-powerpoint',
            'zip' => 'file-archive',
            'rar' => 'file-archive',
            'txt' => 'file-alt',
            'md' => 'file-alt',
        ];

        return $icons[$extension] ?? 'file-alt';
    }

    // Formater la taille du fichier
    private function formatFileSize($bytes)
    {
        if ($bytes == 0) return '0 Bytes';
        
        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes) / log($k));
        
        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }

    // ============ PROPRIÉTÉS COMPUTED ============

    // Récupérer les statistiques
    public function getStatsProperty()
    {
        try {
            $total = Document::where('is_published', true)->count();
            $viewed = Document::where('is_published', true)->sum('views');
            $downloaded = Document::where('is_published', true)->sum('downloads');
            
            $favorites = Auth::check() 
                ? Auth::user()->bookmarks()->count()
                : count(session()->get('document_favorites', []));
            
            return [
                'total' => $total,
                'viewed' => $viewed,
                'downloaded' => $downloaded,
                'favorites' => $favorites,
            ];
        } catch (\Exception $e) {
            return [
                'total' => 0,
                'viewed' => 0,
                'downloaded' => 0,
                'favorites' => 0,
            ];
        }
    }

    // Récupérer les catégories
    public function getCategoriesProperty()
    {
        try {
            $categories = DocumentCategory::withCount(['documents' => function($query) {
                $query->where('is_published', true);
                
                if ($this->showBookmarks && !empty($this->favorites)) {
                    $query->whereIn('id', $this->favorites);
                }
            }])
            ->orderBy('name')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'count' => $category->documents_count,
                    'color' => $category->color ?? $this->getCategoryColor($category->slug),
                ];
            })
            ->toArray();

            // Ajouter la catégorie "Tout"
            array_unshift($categories, [
                'id' => 0,
                'name' => 'Tout',
                'slug' => 'all',
                'count' => $this->stats['total'],
                'color' => 'primary',
            ]);

            return $categories;
        } catch (\Exception $e) {
            return [];
        }
    }

    // Récupérer les documents récents
    public function getRecentDocumentsProperty()
    {
        try {
            if (!Auth::check()) {
                // Pour les non-connectés, montrer les plus récents
                $recentDocuments = Document::with(['category'])
                    ->where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->take(6)
                    ->get();
            } else {
                // Pour les connectés, montrer les favoris ou les plus récents
                $recentDocuments = Auth::user()->bookmarks()
                    ->with(['category'])
                    ->where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->take(6)
                    ->get();

                // Si pas assez de favoris, compléter avec les plus récents
                if ($recentDocuments->count() < 6) {
                    $additional = Document::with(['category'])
                        ->where('is_published', true)
                        ->whereNotIn('id', $recentDocuments->pluck('id'))
                        ->orderBy('created_at', 'desc')
                        ->take(6 - $recentDocuments->count())
                        ->get();
                    
                    $recentDocuments = $recentDocuments->merge($additional);
                }
            }

            return $recentDocuments->map(function ($document) {
                return $this->formatDocumentData($document);
            })->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    // Récupérer les types de documents disponibles
    public function getDocumentTypesProperty()
    {
        try {
            // Extraire les types uniques des documents
            $types = Document::where('is_published', true)
                ->select('type')
                ->distinct()
                ->get()
                ->pluck('type')
                ->filter()
                ->map(function ($type) {
                    return [
                        'id' => $type,
                        'name' => ucfirst($type),
                        'icon' => $this->getTypeIcon($type),
                        'color' => $this->getTypeColor($type),
                    ];
                })
                ->values()
                ->toArray();

            return $types;
        } catch (\Exception $e) {
            return [];
        }
    }

    // Récupérer les documents paginés
    public function getPaginatedDocumentsProperty()
    {
        try {
            $query = Document::query()
                ->with(['category'])
                ->where('is_published', true);

            // Filtrer par favoris si activé
            if ($this->showBookmarks && !empty($this->favorites)) {
                $query->whereIn('id', $this->favorites);
            }

            // Recherche
            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            }

            // Filtre par catégorie
            if ($this->activeCategory && $this->activeCategory !== 'all') {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->activeCategory);
                });
            }

            // Filtre par types
            if (!empty(array_filter($this->selectedTypes))) {
                $query->whereIn('type', array_keys(array_filter($this->selectedTypes)));
            }

            // Tri
            switch ($this->sortBy) {
                case 'date_asc':
                    $query->orderBy('created_at');
                    break;
                case 'title':
                    $query->orderBy('title');
                    break;
                case 'views':
                    $query->orderBy('views', 'desc');
                    break;
                case 'downloads':
                    $query->orderBy('downloads', 'desc');
                    break;
                default: // date_desc
                    $query->orderBy('created_at', 'desc');
                    break;
            }

            return $query->paginate($this->perPage);
        } catch (\Exception $e) {
            return Document::where('is_published', true)->paginate($this->perPage);
        }
    }

    // Formater les données du document
    private function formatDocumentData($document)
    {
        try {
            $category = $document->category ?? null;
            $type = $document->type ?? 'guide';
            
            $isFavorite = false;
            if (Auth::check()) {
                $isFavorite = Auth::user()->bookmarks()->where('document_id', $document->id)->exists();
            } else {
                $favorites = session()->get('document_favorites', []);
                $isFavorite = in_array($document->id, $favorites);
            }

            // Déterminer le type de fichier
            $fileExtension = strtolower(pathinfo($document->file_name ?? 'document.pdf', PATHINFO_EXTENSION));
            $fileIcon = $this->getFileIcon($fileExtension);

            return [
                'id' => $document->id,
                'title' => $document->title,
                'description' => $document->description,
                'content' => $document->content,
                'category' => $category->name ?? 'Général',
                'category_slug' => $category->slug ?? 'general',
                'type' => $type,
                'type_name' => ucfirst($type),
                'type_icon' => $this->getTypeIcon($type),
                'type_color' => $this->getTypeColor($type),
                'file_name' => $document->file_name,
                'file_size' => $this->formatFileSize($document->file_size ?? 0),
                'file_extension' => $fileExtension,
                'file_path' => $document->file_path,
                'file_url' => $document->file_url,
                'views' => $document->views ?? 0,
                'downloads' => $document->downloads ?? 0,
                'reading_time' => $document->reading_time ?? 0,
                'is_favorite' => $isFavorite,
                'video_url' => $document->video_url,
                'updated_at' => $document->updated_at,
                'created_at' => $document->created_at,
                'file_icon' => $fileIcon,
            ];
        } catch (\Exception $e) {
            return [
                'id' => $document->id ?? 0,
                'title' => $document->title ?? 'Sans titre',
                'description' => $document->description ?? '',
                'category' => 'Général',
                'category_slug' => 'general',
                'type' => 'guide',
                'type_name' => 'Guide',
                'type_icon' => 'book',
                'type_color' => 'primary',
                'file_name' => $document->file_name ?? 'document.pdf',
                'file_size' => '0 KB',
                'file_extension' => 'pdf',
                'views' => 0,
                'downloads' => 0,
                'reading_time' => 0,
                'is_favorite' => false,
            ];
        }
    }

    // ============ MÉTHODES PUBLIQUES ============

    // Filtrer par catégorie
    public function filterByCategory($categorySlug)
    {
        $this->activeCategory = $categorySlug;
        $this->resetPage();
    }

    // Effacer la recherche
    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    // Réinitialiser tous les filtres
    public function resetFilters()
    {
        $this->search = '';
        $this->sortBy = 'date_desc';
        $this->selectedTypes = [];
        $this->activeCategory = 'all';
        $this->showBookmarks = false;
        $this->resetPage();
        $this->loadFavorites();
    }

    // Afficher le contenu
    public function viewContent($documentId)
    {
        try {
            $document = Document::with(['category'])
                ->where('is_published', true)
                ->findOrFail($documentId);
            
            // Incrémenter le compteur de vues
            $document->increment('views');
            
            // Enregistrer comme favori pour l'utilisateur connecté
            if (Auth::check()) {
                Auth::user()->bookmarks()->syncWithoutDetaching([$documentId]);
            }

            $this->selectedContent = $this->formatDocumentData($document);
        } catch (\Exception $e) {
            session()->flash('error', 'Document non trouvé');
        }
    }

    // Fermer le contenu
    public function closeContent()
    {
        $this->selectedContent = null;
    }

    // Basculer favori
    public function toggleFavorite($documentId)
    {
        if (!Auth::check()) {
            // Gérer les favoris en session pour les non connectés
            $favorites = session()->get('document_favorites', []);
            
            if (in_array($documentId, $favorites)) {
                $favorites = array_diff($favorites, [$documentId]);
                session()->flash('info', 'Document retiré des favoris');
            } else {
                $favorites[] = $documentId;
                session()->flash('success', 'Document ajouté aux favoris');
            }
            
            session()->put('document_favorites', $favorites);
            $this->loadFavorites();
        } else {
            $user = Auth::user();
            
            if (in_array($documentId, $this->favorites)) {
                $user->bookmarks()->detach($documentId);
                $this->favorites = array_diff($this->favorites, [$documentId]);
                session()->flash('info', 'Document retiré des favoris');
            } else {
                $user->bookmarks()->attach($documentId);
                $this->favorites[] = $documentId;
                session()->flash('success', 'Document ajouté aux favoris');
            }
        }

        // Mettre à jour l'état dans le contenu sélectionné si ouvert
        if ($this->selectedContent && isset($this->selectedContent['id']) && $this->selectedContent['id'] == $documentId) {
            $this->selectedContent['is_favorite'] = !($this->selectedContent['is_favorite'] ?? false);
        }

        // Rafraîchir les données
        $this->emitSelf('$refresh');
    }

    // Télécharger le document
    public function downloadDocument($documentId)
    {
        try {
            $document = Document::findOrFail($documentId);
            
            // Incrémenter le compteur de téléchargements
            $document->increment('downloads');

            // Retourner le fichier pour téléchargement
            if ($document->file_path && Storage::exists($document->file_path)) {
                return Storage::download($document->file_path, $document->file_name);
            } elseif ($document->file_url) {
                // Rediriger vers l'URL du fichier
                return redirect()->away($document->file_url);
            }

            session()->flash('error', 'Le fichier n\'existe pas.');
            return null;
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors du téléchargement');
            return null;
        }
    }

    // Extraire l'ID YouTube d'une URL
    public function getYouTubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

    // Extraire l'ID Vimeo d'une URL
    public function getVimeoId($url)
    {
        preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches);
        return $matches[1] ?? null;
    }

    // Changer le mode d'affichage
    public function changeViewMode($mode)
    {
        $this->viewMode = $mode;
        session()->put('document_view_mode', $mode);
    }

    // Basculer l'affichage des favoris
    public function toggleBookmarks()
    {
        $this->showBookmarks = !$this->showBookmarks;
        $this->resetPage();
    }

    // Rendu
    public function render()
    {
        return view('livewire.utilisateur.utilisateur-doc', [
            'stats' => $this->stats,
            'categories' => $this->categories,
            'recentDocuments' => $this->recentDocuments,
            'documentTypes' => $this->documentTypes,
            'paginatedDocuments' => $this->paginatedDocuments,
        ]);
    }
}