<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\ticket;

class DocumentationPage extends Component
{
    use WithPagination;
    
    public $search = '';
    public $activeCategory = 'all';
    public $showBookmarks = false;
    public $selectedContent = null;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'activeCategory' => ['except' => 'all'],
        'showBookmarks' => ['except' => false],
    ];
     public function history(Request $request,ticket $ticket){
            
        $name = $request->name;

        $ticket->sujet = "$request->name";
        $ticket->details = "$request->name";
        $ticket->utilisateur_id = 1;
        $ticket->responsable_id = 1;
        $ticket->equipement = "riuter";
        $ticket->categorie = "trest";
        $ticket->impact = "test";
        $ticket->state = 2;
        $ticket->status = "en attente";
        $ticket->priorite = 1;
        $ticket->save();

        //$req = regisseur::all();
        
      
        
        return response()->json(["status"=> "200"]);

        
    }
    public function render()
    {
        $user = Auth::user();
        
        // Construire la requête
        $query = $this->showBookmarks
            ? $user->bookmarkedDocuments()
            : Document::query();
        
        // Appliquer les filtres
        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }
        
        if ($this->activeCategory !== 'all') {
            $query->whereHas('category', function($q) {
                $q->where('slug', $this->activeCategory);
            });
        }
        
        $documents = $query->paginate(12);
        $categories = DocumentCategory::withCount('documents')->get();
        
        return view('livewire.user.documentation-page', [
            'documents' => $documents,
            'categories' => $categories,
            'user' => $user,
        ]);
    }
    
    public function toggleBookmarks()
    {
        $this->showBookmarks = !$this->showBookmarks;
        $this->resetPage();
    }
    
    public function toggleBookmark($documentId)
    {
        $user = Auth::user();
        
        if ($user->bookmarkedDocuments()->where('document_id', $documentId)->exists()) {
            $user->bookmarkedDocuments()->detach($documentId);
            $this->dispatchBrowserEvent('notify', [
                'type' => 'info',
                'message' => 'Document retiré des favoris'
            ]);
        } else {
            $user->bookmarkedDocuments()->attach($documentId);
            $this->dispatchBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Document ajouté aux favoris'
            ]);
        }
        
        $this->emitSelf('$refresh');
    }
    
    public function viewDocument($documentId)
    {
        $document = Document::with(['category', 'tags'])->findOrFail($documentId);
        $this->selectedContent = $document;
        
        // Incrémenter les vues
        $document->increment('views_count');
    }
    
    public function closeDocument()
    {
        $this->selectedContent = null;
    }
    
    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }
    
    public function filterByCategory($categorySlug)
    {
        $this->activeCategory = $categorySlug;
        $this->resetPage();
        }
        
       
}