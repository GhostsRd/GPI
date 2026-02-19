<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\DocumentView as DocumentViewModel;
use App\Models\DocumentDownload;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentView extends Component
{
    public $document;
    public $slug;
    public $comments = [];
    public $newComment = '';
    public $replyTo = null;
    public $replyContent = '';
    public $relatedDocuments = [];
    public $showComments = true;
    public $isBookmarked = false;
    public $readingProgress = 0;
    public $currentPage = 1;
    public $totalPages = 1;
    public $isFullscreen = false;
    
    protected $listeners = [
        'incrementDownload' => 'handleDownload',
        'toggleBookmark' => 'toggleBookmarkStatus',
        'printDocument' => 'printDocument',
        'shareDocument' => 'shareDocument',
        'loadMoreComments' => 'loadMoreComments',
    ];
    
    public function mount($slug)
    {
        $this->slug = $slug;
        $this->loadDocument();
        $this->trackView();
        $this->checkBookmarkStatus();
        $this->loadComments();
        $this->loadRelatedDocuments();
    }
    
    public function loadDocument()
    {
        $this->document = Document::with([
            'category',
            'author',
            'tags',
            'comments' => function($query) {
                $query->whereNull('parent_id')
                      ->with(['replies', 'user'])
                      ->orderBy('created_at', 'desc');
            }
        ])
        ->where('slug', $this->slug)
        ->where('is_published', true)
        ->firstOrFail();
        
        // Calculer le nombre de pages pour le contenu
        if ($this->document->content) {
            $wordCount = str_word_count(strip_tags($this->document->content));
            $this->totalPages = ceil($wordCount / 300); // ~300 mots par page
        }
    }
    
    public function trackView()
    {
        // Enregistrer la vue dans la base de données
        if (Auth::check()) {
            DocumentViewModel::firstOrCreate([
                'document_id' => $this->document->id,
                'user_id' => Auth::id(),
                'ip_address' => request()->ip(),
            ]);
        } else {
            DocumentViewModel::firstOrCreate([
                'document_id' => $this->document->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
        
        // Incrémenter le compteur de vues
        $this->document->increment('views_count');
    }
    
    public function handleDownload()
    {
        // Enregistrer le téléchargement
        if (Auth::check()) {
            DocumentDownload::create([
                'document_id' => $this->document->id,
                'user_id' => Auth::id(),
                'ip_address' => request()->ip(),
            ]);
        } else {
            DocumentDownload::create([
                'document_id' => $this->document->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
        
        // Incrémenter le compteur de téléchargements
        $this->document->increment('downloads_count');
        
        // Émettre un événement pour notification
        $this->dispatchBrowserEvent('download-tracked', [
            'count' => $this->document->downloads_count
        ]);
    }
    
    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:3|max:1000',
        ]);
        
        $comment = Comment::create([
            'document_id' => $this->document->id,
            'user_id' => Auth::id(),
            'content' => $this->newComment,
            'parent_id' => $this->replyTo,
        ]);
        
        $this->newComment = '';
        $this->replyTo = null;
        $this->loadComments();
        
        $this->dispatchBrowserEvent('comment-added', [
            'message' => 'Commentaire ajouté avec succès!'
        ]);
    }
    
    public function replyToComment($commentId)
    {
        $this->replyTo = $commentId;
        $this->dispatchBrowserEvent('focus-reply-input');
    }
    
    public function addReply()
    {
        $this->validate([
            'replyContent' => 'required|min:3|max:500',
        ]);
        
        Comment::create([
            'document_id' => $this->document->id,
            'user_id' => Auth::id(),
            'content' => $this->replyContent,
            'parent_id' => $this->replyTo,
        ]);
        
        $this->replyContent = '';
        $this->replyTo = null;
        $this->loadComments();
        
        $this->dispatchBrowserEvent('reply-added');
    }
    
    public function loadComments()
    {
        $this->comments = $this->document->comments()
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
    }
    
    public function loadMoreComments()
    {
        $moreComments = $this->document->comments()
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->skip($this->comments->count())
            ->take(5)
            ->get();
            
        $this->comments = $this->comments->concat($moreComments);
    }
    
    public function toggleBookmarkStatus()
    {
        if (!Auth::check()) {
            $this->dispatchBrowserEvent('show-login-modal');
            return;
        }
        
        $user = Auth::user();
        
        if ($user->bookmarks()->where('document_id', $this->document->id)->exists()) {
            $user->bookmarks()->detach($this->document->id);
            $this->isBookmarked = false;
            $this->dispatchBrowserEvent('bookmark-removed');
        } else {
            $user->bookmarks()->attach($this->document->id);
            $this->isBookmarked = true;
            $this->dispatchBrowserEvent('bookmark-added');
        }
    }
    
    public function checkBookmarkStatus()
    {
        if (Auth::check()) {
            $this->isBookmarked = Auth::user()->bookmarks()
                ->where('document_id', $this->document->id)
                ->exists();
        }
    }
    
    public function loadRelatedDocuments()
    {
        $this->relatedDocuments = Document::with(['category', 'author'])
            ->where('id', '!=', $this->document->id)
            ->where('is_published', true)
            ->where(function($query) {
                // Documents de la même catégorie
                if ($this->document->category_id) {
                    $query->orWhere('category_id', $this->document->category_id);
                }
                
                // Documents avec les mêmes tags
                if ($this->document->tags->isNotEmpty()) {
                    $tagIds = $this->document->tags->pluck('id')->toArray();
                    $query->orWhereHas('tags', function($q) use ($tagIds) {
                        $q->whereIn('tags.id', $tagIds);
                    });
                }
            })
            ->orderBy('views_count', 'desc')
            ->take(6)
            ->get();
    }
    
    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            $this->updateReadingProgress();
        }
    }
    
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->updateReadingProgress();
        }
    }
    
    public function goToPage($page)
    {
        if ($page >= 1 && $page <= $this->totalPages) {
            $this->currentPage = $page;
            $this->updateReadingProgress();
        }
    }
    
    public function updateReadingProgress()
    {
        $this->readingProgress = ($this->currentPage / $this->totalPages) * 100;
        
        // Enregistrer la progression pour les utilisateurs connectés
        if (Auth::check()) {
            DB::table('document_progress')->updateOrInsert(
                [
                    'user_id' => Auth::id(),
                    'document_id' => $this->document->id,
                ],
                [
                    'current_page' => $this->currentPage,
                    'progress_percentage' => $this->readingProgress,
                    'updated_at' => now(),
                ]
            );
        }
    }
    
    public function toggleFullscreen()
    {
        $this->isFullscreen = !$this->isFullscreen;
        $this->dispatchBrowserEvent('toggle-fullscreen', [
            'fullscreen' => $this->isFullscreen
        ]);
    }
    
    public function printDocument()
    {
        $this->dispatchBrowserEvent('print-document', [
            'title' => $this->document->title
        ]);
    }
    
    public function shareDocument($platform)
    {
        $url = route('documents.show', $this->document->slug);
        $title = $this->document->title;
        
        $shareUrls = [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($url),
            'twitter' => "https://twitter.com/intent/tweet?url=" . urlencode($url) . "&text=" . urlencode($title),
            'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url=" . urlencode($url) . "&title=" . urlencode($title),
            'whatsapp' => "https://wa.me/?text=" . urlencode($title . " - " . $url),
            'email' => "mailto:?subject=" . urlencode($title) . "&body=" . urlencode("Consultez ce document: " . $url),
        ];
        
        if (isset($shareUrls[$platform])) {
            $this->dispatchBrowserEvent('open-share-window', [
                'url' => $shareUrls[$platform]
            ]);
        }
    }
    
    public function reportDocument()
    {
        $this->dispatchBrowserEvent('show-report-modal', [
            'document_id' => $this->document->id,
            'document_title' => $this->document->title
        ]);
    }
    
    public function getDocumentStats()
    {
        return [
            'views' => $this->document->views_count,
            'downloads' => $this->document->downloads_count,
            'comments' => $this->document->comments()->count(),
            'average_reading_time' => $this->calculateReadingTime(),
            'popularity_score' => $this->calculatePopularityScore(),
        ];
    }
    
    protected function calculateReadingTime()
    {
        if (!$this->document->content) {
            return 0;
        }
        
        $wordCount = str_word_count(strip_tags($this->document->content));
        $readingTime = ceil($wordCount / 200); // 200 mots par minute
        
        return max(1, $readingTime); // Au moins 1 minute
    }
    
    protected function calculatePopularityScore()
    {
        $viewsWeight = 1;
        $downloadsWeight = 2;
        $commentsWeight = 3;
        
        $score = ($this->document->views_count * $viewsWeight)
               + ($this->document->downloads_count * $downloadsWeight)
               + ($this->document->comments()->count() * $commentsWeight);
        
        return $score;
    }
    
    public function render()
    {
        return view('livewire.DocumentView', [
            'stats' => $this->getDocumentStats(),
            'readingTime' => $this->calculateReadingTime(),
            'socialLinks' => $this->getSocialLinks(),
        ]);
    }
    
    protected function getSocialLinks()
    {
        $currentUrl = route('documents.show', $this->document->slug);
        
        return [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($currentUrl),
            'twitter' => "https://twitter.com/intent/tweet?url=" . urlencode($currentUrl) . "&text=" . urlencode($this->document->title),
            'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url=" . urlencode($currentUrl),
            'whatsapp' => "https://wa.me/?text=" . urlencode($this->document->title . " - " . $currentUrl),
        ];
    }
}