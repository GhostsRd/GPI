{{-- resources/views/livewire/document-view.blade.php --}}
<div>
    {{-- Barre de navigation et progression premium --}}
    @if($totalPages > 1)
    <div class="doc-viewer-nav fixed-top" x-data="{ scrolled: false }" @scroll.window="scrolled = window.pageYOffset > 20" :class="{ 'scrolled': scrolled }">
        <div class="progress-container">
            <div class="progress-bar-slim" :style="'width: ' + $wire.readingProgress + '%'"></div>
        </div>
        <div class="container py-2">
            <div class="nav-content">
                <div class="nav-controls">
                    <button wire:click="previousPage" 
                            class="nav-btn"
                            title="Précédent"
                            {{ $currentPage <= 1 ? 'disabled' : '' }}>
                        <i class="bi bi-arrow-left"></i>
                    </button>
                    
                    <div class="page-indicator">
                        <span class="current">{{ $currentPage }}</span>
                        <span class="separator">/</span>
                        <span class="total">{{ $totalPages }}</span>
                    </div>
                    
                    <button wire:click="nextPage" 
                            class="nav-btn"
                            title="Suivant"
                            {{ $currentPage >= $totalPages ? 'disabled' : '' }}>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
                
                <div class="nav-status">
                    <span class="percentage text-gradient">{{ round($readingProgress) }}%</span>
                    <span class="status-label">completé</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="doc-hero-section {{ $totalPages > 1 ? 'mt-5' : '' }}">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb doc-breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('documents.index') }}">Documents</a>
                            </li>
                            @if($document->category)
                            <li class="breadcrumb-item">
                                <a href="{{ route('documents.category', $document->category->slug) }}">
                                    {{ $document->category->name }}
                                </a>
                            </li>
                            @endif
                            <li class="breadcrumb-item active">{{ $document->title }}</li>
                        </ol>
                    </nav>
                    
                    <h1 class="doc-main-title mb-3">{{ $document->title }}</h1>
                    
                    @if($document->description)
                    <p class="doc-hero-description mb-4">{{ $document->description }}</p>
                    @endif
                    
                    <div class="doc-meta-grid">
                        @if($document->author)
                        <div class="doc-meta-item">
                            <div class="icon-circle"><i class="bi bi-person"></i></div>
                            <div class="meta-info">
                                <span class="label">Auteur</span>
                                <span class="value">{{ $document->author->name }}</span>
                            </div>
                        </div>
                        @endif
                        
                        <div class="doc-meta-item">
                            <div class="icon-circle"><i class="bi bi-calendar3"></i></div>
                            <div class="meta-info">
                                <span class="label">Publié</span>
                                <span class="value">{{ $document->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>
                        
                        <div class="doc-meta-item">
                            <div class="icon-circle"><i class="bi bi-hourglass-split"></i></div>
                            <div class="meta-info">
                                <span class="label">Lecture</span>
                                <span class="value">{{ $readingTime }} min</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="doc-quick-stats shadow-lg">
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($stats['views']) }}</div>
                            <div class="stat-label">Vues</div>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <div class="stat-value">{{ number_format($stats['downloads']) }}</div>
                            <div class="stat-label">Téléchargements</div>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $stats['popularity_score'] }}</div>
                            <div class="stat-label">Popularité</div>
                        </div>
                        
                        <div class="dropdown doc-actions-dropdown mt-3">
                            <button class="btn btn-action-trigger w-100" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-lightning-charge-fill me-2"></i> Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-4 border-0">
                                <li>
                                    <button wire:click="toggleBookmarkStatus" class="dropdown-item">
                                        <i class="bi {{ $isBookmarked ? 'bi-bookmark-fill text-warning' : 'bi-bookmark' }} me-2"></i>
                                        {{ $isBookmarked ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                                    </button>
                                </li>
                                <li>
                                    <button wire:click="printDocument" class="dropdown-item">
                                        <i class="bi bi-printer-fill me-2"></i> Imprimer
                                    </button>
                                </li>
                                <li>
                                    <button wire:click="toggleFullscreen" class="dropdown-item">
                                        <i class="bi bi-arrows-fullscreen me-2"></i>
                                        {{ $isFullscreen ? 'Quitter plein écran' : 'Plein écran' }}
                                    </button>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <button wire:click="reportDocument" class="dropdown-item text-danger">
                                        <i class="bi bi-flag-fill me-2"></i> Signaler
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <div class="row">
            {{-- Contenu principal --}}
            <div class="{{ $showComments ? 'col-lg-8' : 'col-12' }}">
                <div class="card premium-card mb-5">
                    <div class="card-body p-4 p-lg-5">
                        {{-- Actions rapides modernisées --}}
                        <div class="d-flex flex-wrap gap-3 mb-5">
                            @if($document->file_path)
                            <a href="{{ asset('storage/' . $document->file_path) }}" 
                               class="btn btn-action-trigger px-4"
                               target="_blank"
                               wire:click="handleDownload">
                                <i class="bi bi-download me-2"></i> Télécharger
                            </a>
                            @endif
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary rounded-pill px-4 dropdown-toggle" 
                                        data-bs-toggle="dropdown">
                                    <i class="bi bi-share me-2"></i> Partager
                                </button>
                                <ul class="dropdown-menu shadow-lg border-0 rounded-4">
                                    <li>
                                        <button wire:click="shareDocument('facebook')" class="dropdown-item py-2">
                                            <i class="bi bi-facebook text-primary me-2"></i> Facebook
                                        </button>
                                    </li>
                                    <li>
                                        <button wire:click="shareDocument('twitter')" class="dropdown-item py-2">
                                            <i class="bi bi-twitter text-info me-2"></i> Twitter
                                        </button>
                                    </li>
                                    <li>
                                        <button wire:click="shareDocument('linkedin')" class="dropdown-item py-2">
                                            <i class="bi bi-linkedin text-linkedin me-2"></i> LinkedIn
                                        </button>
                                    </li>
                                    <li>
                                        <button wire:click="shareDocument('whatsapp')" class="dropdown-item py-2">
                                            <i class="bi bi-whatsapp text-success me-2"></i> WhatsApp
                                        </button>
                                    </li>
                                    <li>
                                        <button wire:click="shareDocument('email')" class="dropdown-item py-2">
                                            <i class="bi bi-envelope text-danger me-2"></i> Email
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            
                            <button class="btn btn-outline-secondary rounded-pill px-4" onclick="window.print()">
                                <i class="bi bi-printer me-2"></i> Imprimer
                            </button>
                        </div>
                        
                        {{-- Contenu du document raffiné --}}
                        <div class="document-content">
                            @if($document->content)
                                <div class="content-rendered">
                                    {!! $document->content !!}
                                </div>
                            @elseif($document->file_path)
                                <div class="text-center py-5 bg-light rounded-4">
                                    <div class="display-1 text-muted opacity-25 mb-4">
                                        <i class="bi bi-file-earmark-lock2"></i>
                                    </div>
                                    <h4 class="text-dark fw-bold mb-3">Document protégé</h4>
                                    <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">
                                        Ce document est prêt à être consulté. Téléchargez-le pour profiter d'une lecture hors-ligne complète.
                                    </p>
                                    <a href="{{ asset('storage/' . $document->file_path) }}" 
                                       class="btn btn-action-trigger px-5"
                                       target="_blank"
                                       wire:click="handleDownload">
                                        <i class="bi bi-download me-2"></i> Télécharger maintenant
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Tags modernisés --}}
                        @if($document->tags && $document->tags->count() > 0)
                        <div class="mt-5 pt-4 border-top">
                            <h6 class="text-uppercase fw-bold text-muted small mb-3 letter-spacing-1">
                                <i class="bi bi-tags-fill me-2"></i> Mots-clés
                            </h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($document->tags as $tag)
                                <a href="{{ route('documents.tag', $tag->slug) }}" 
                                   class="badge rounded-pill bg-white text-dark border py-2 px-3 transition-hover">
                                    #{{ $tag->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                {{-- Documents similaires modernisés --}}
                @if($relatedDocuments->count() > 0)
                <div class="related-section mb-5">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="fw-800 mb-0">Découvrir aussi</h4>
                        <div class="section-line flex-grow-1 ms-3"></div>
                    </div>
                    <div class="row">
                        @foreach($relatedDocuments as $related)
                        <div class="col-md-6 mb-4">
                            <a href="{{ route('documents.show', $related->slug) }}" class="text-decoration-none h-100">
                                <div class="card premium-card border h-100 transition-up">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="badge bg-soft-primary text-primary rounded-pill px-3">
                                                {{ $related->category->name ?? 'Document' }}
                                            </span>
                                            <small class="text-muted">{{ $related->created_at->diffForHumans() }}</small>
                                        </div>
                                        <h5 class="card-title text-dark fw-bold mb-3">
                                            {{ Str::limit($related->title, 55) }}
                                        </h5>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center text-muted small">
                                                <i class="bi bi-eye me-1"></i> {{ number_format($related->views_count) }}
                                            </div>
                                            <div class="d-flex align-items-center text-muted small">
                                                <i class="bi bi-clock me-1"></i> 5 min
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            {{-- Sidebar avec commentaires modernisée --}}
            @if($showComments)
            <div class="col-lg-4">
                <div class="card sidebar-card sticky-top" style="top: 100px;">
                    <div class="card-header bg-transparent border-0 p-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-800 mb-0">Discussions</h5>
                        <button wire:click="$set('showComments', false)" class="btn btn-sm btn-light rounded-circle shadow-sm">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div class="card-body p-4 pt-0 comments-container" style="max-height: 70vh; overflow-y: auto;">
                        {{-- Formulaire de commentaire modernisé --}}
                        @auth
                        <div class="mb-4">
                            <form wire:submit.prevent="addComment">
                                <div class="modern-textarea-group mb-3">
                                    <textarea wire:model="newComment" 
                                              class="form-control rounded-4 border-white shadow-sm" 
                                              rows="3"
                                              placeholder="Partagez votre avis..."></textarea>
                                    @error('newComment') <span class="text-danger small mt-2 d-block">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-action-trigger w-100 py-2">
                                    <i class="bi bi-send-fill me-2"></i> Publier
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="alert bg-soft-primary border-0 rounded-4 p-4 mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle bg-white"><i class="bi bi-info-circle-fill"></i></div>
                                <div class="small">
                                    <a href="{{ route('login') }}" class="fw-bold text-primary">Connectez-vous</a> pour participer à la discussion.
                                </div>
                            </div>
                        </div>
                        @endauth
                        
                        {{-- Liste des commentaires --}}
                        @if($comments->count() > 0)
                        <div class="comments-list">
                            @foreach($comments as $comment)
                            <div class="comment-bubble mb-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="avatar-initial">{{ substr($comment->user->name, 0, 1) }}</div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-700 text-dark small">{{ $comment->user->name }}</span>
                                            <span class="text-muted" style="font-size: 0.75rem;">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="mb-2 text-muted small">{{ $comment->content }}</p>
                                        
                                        @auth
                                        <button wire:click="replyToComment({{ $comment->id }})" 
                                                class="btn btn-link p-0 text-primary text-decoration-none small fw-600">
                                            <i class="bi bi-reply-fill me-1"></i> Répondre
                                        </button>
                                        @endauth
                                        
                                        {{-- Réponses modernisées --}}
                                        @if($comment->replies && $comment->replies->count() > 0)
                                        <div class="replies ms-2 mt-3 ps-3 border-start transition-all">
                                            @foreach($comment->replies as $reply)
                                            <div class="reply mb-3">
                                                <div class="d-flex align-items-start gap-2">
                                                    <div class="avatar-initial" style="width: 24px; height: 24px; font-size: 0.6rem; border-radius: 6px;">{{ substr($reply->user->name, 0, 1) }}</div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-700 text-dark" style="font-size: 0.7rem;">{{ $reply->user->name }}</span>
                                                        <p class="text-muted small mb-0 lh-base" style="font-size: 0.75rem;">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            @if($document->comments()->count() > $comments->count())
                            <div class="text-center mt-4">
                                <button wire:click="loadMoreComments" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                    Voir plus de messages
                                </button>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="bi bi-chat-dots-fill display-4 text-muted opacity-25 mb-4"></i>
                            <p class="text-muted small">Aucun commentaire pour le moment.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-4">
                <button wire:click="$set('showComments', true)" class="btn btn-action-trigger w-100 py-3 shadow-sm">
                    <i class="bi bi-chat-text-fill me-2"></i> Voir les commentaires
                </button>
            </div>
            @endif
        </div>
    </div>
    
    {{-- Modal pour les réponses modernisé --}}
    @if($replyTo)
    <div class="modal fade show" style="display: block; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(8px);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-5 overflow-hidden">
                <div class="modal-header border-0 bg-light p-4">
                    <h5 class="fw-800 mb-0">Nouvelle réponse</h5>
                    <button wire:click="$set('replyTo', null)" type="button" class="btn-close"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="addReply">
                        <div class="mb-4">
                            <textarea wire:model="replyContent" 
                                      class="form-control rounded-4 border-light bg-light p-3" 
                                      rows="4"
                                      placeholder="Votre réponse..."></textarea>
                            @error('replyContent') <span class="text-danger small mt-2 d-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button wire:click="$set('replyTo', null)" 
                                    type="button" 
                                    class="btn btn-light rounded-pill px-4 fw-600">
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-action-trigger rounded-pill px-5">
                                <i class="bi bi-send-fill me-2"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
:root {
    --doc-primary: #4f46e5;
    --doc-primary-light: #818cf8;
    --doc-secondary: #7c3aed;
    --doc-accent: #f43f5e;
    --doc-bg-glass: rgba(255, 255, 255, 0.8);
    --doc-border-glass: rgba(255, 255, 255, 0.3);
    --doc-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

/* Base Reading Typography */
.doc-main-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #1a1a1a;
    letter-spacing: -0.02em;
    line-height: 1.2;
}

.text-gradient {
    background: linear-gradient(135deg, var(--doc-primary), var(--doc-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Slim Progress Bar */
.doc-viewer-nav {
    backdrop-filter: blur(10px);
    background: var(--doc-bg-glass);
    border-bottom: 1px solid var(--doc-border-glass);
    transition: all 0.3s ease;
}

.doc-viewer-nav.scrolled {
    padding: 0.2rem 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.progress-container {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: rgba(0, 0, 0, 0.03);
}

.progress-bar-slim {
    height: 100%;
    background: linear-gradient(to right, var(--doc-primary), var(--doc-secondary));
    transition: width 0.3s ease;
}

/* Nav Controls */
.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-controls {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.nav-btn {
    border: none;
    background: #f3f4f6;
    color: #4b5563;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.nav-btn:hover:not(:disabled) {
    background: var(--doc-primary);
    color: white;
    transform: translateY(-2px);
}

.page-indicator {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.95rem;
}

.page-indicator .separator { color: #d1d5db; margin: 0 0.4rem; }

.nav-status {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.percentage { font-size: 1.2rem; font-weight: 800; }
.status-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af; font-weight: 700; }

/* Hero Section */
.doc-hero-section {
    background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.03), transparent),
                radial-gradient(circle at bottom left, rgba(124, 58, 237, 0.03), transparent);
}

.doc-breadcrumb {
    background: transparent;
    padding: 0;
}

.doc-breadcrumb .breadcrumb-item a {
    color: var(--doc-primary);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
}

.doc-hero-description {
    font-size: 1.25rem;
    color: #4b5563;
    line-height: 1.6;
    max-width: 90%;
}

.doc-meta-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.5rem;
}

.doc-meta-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.icon-circle {
    width: 48px;
    height: 48px;
    background: white;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--doc-primary);
    font-size: 1.2rem;
}

.meta-info .label {
    display: block;
    font-size: 0.75rem;
    text-transform: uppercase;
    font-weight: 700;
    color: #9ca3af;
    letter-spacing: 0.02em;
}

.meta-info .value {
    font-weight: 600;
    color: #374151;
}

/* Quick Stats */
.doc-quick-stats {
    background: white;
    border-radius: 24px;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.02);
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 800;
    color: #111827;
}

.stat-label {
    font-size: 0.8rem;
    color: #6b7280;
    text-transform: uppercase;
    font-weight: 600;
}

.stat-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, #f3f4f6, transparent);
}

.btn-action-trigger {
    background: var(--doc-primary);
    color: white;
    border-radius: 12px;
    padding: 0.8rem;
    font-weight: 700;
    border: none;
    transition: all 0.2s ease;
}

.btn-action-trigger:hover {
    background: var(--doc-secondary);
    transform: scale(1.02);
    box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
}

/* Content Area */
.premium-card {
    border: none;
    border-radius: 24px;
    box-shadow: var(--doc-shadow);
    overflow: hidden;
}

.document-content {
    line-height: 1.8;
    font-size: 1.15rem;
    color: #374151;
}

.content-rendered {
    color: #374151;
}

.content-rendered p { margin-bottom: 1.5rem; }

.content-rendered h2 {
    margin-top: 2.5rem;
    margin-bottom: 1.2rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: -0.01em;
}

/* Comments Sidebar */
.sidebar-card {
    border: none;
    border-radius: 24px;
    box-shadow: var(--doc-shadow);
    background: #f9fafb;
}

.comment-bubble {
    background: white;
    border-radius: 18px;
    padding: 1.2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
    margin-bottom: 1rem;
}

.avatar-initial {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: linear-gradient(135deg, #e0e7ff, #f3f4f6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--doc-primary);
    font-weight: 700;
}

/* Custom Scrollbar */
.comments-container::-webkit-scrollbar { width: 5px; }
.comments-container::-webkit-scrollbar-track { background: transparent; }
.comments-container::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }

/* Animations & Micro-interactions */
.transition-hover {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.transition-hover:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
}

.card.transition-up {
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.card.transition-up:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(79, 70, 229, 0.1) !important;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.doc-hero-section { animation: fadeIn 0.8s ease-out; }
.premium-card { animation: fadeIn 0.8s ease-out 0.2s both; }
.sidebar-card { animation: fadeIn 0.8s ease-out 0.4s both; }

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .doc-main-title { font-size: 2.2rem; }
    .doc-hero-description { font-size: 1.1rem; }
    .doc-viewer-nav { position: relative !important; }
    .doc-hero-section { border-top: 1px solid #f1f5f9; }
    .sidebar-card { position: static !important; margin-top: 2rem; }
}

@media (max-width: 767.98px) {
    .nav-controls { gap: 0.8rem; }
    .page-indicator { font-size: 0.85rem; }
    .doc-meta-grid { grid-template-columns: 1fr; }
    .doc-main-title { font-size: 1.8rem; }
    .stat-value { font-size: 1.4rem; }
}
</style>
@endpush

@push('scripts')
<script>
// Gestion du plein écran
document.addEventListener('fullscreenchange', function() {
    @this.set('isFullscreen', !!document.fullscreenElement);
});

function toggleFullscreen(element) {
    if (!document.fullscreenElement) {
        element.requestFullscreen().catch(err => {
            console.error(`Erreur: ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
}

// Écouteur d'événements Livewire
document.addEventListener('DOMContentLoaded', function() {
    // Suivi du défilement pour la progression
    window.addEventListener('scroll', function() {
        const contentHeight = document.querySelector('.document-content').offsetHeight;
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;
        
        if (contentHeight > windowHeight) {
            const scrollPercentage = (scrollPosition / (contentHeight - windowHeight)) * 100;
            @this.set('readingProgress', Math.min(100, Math.max(0, scrollPercentage)));
        }
    });
});

// Copier le lien
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Lien copié dans le presse-papier!');
    });
}
</script>
@endpush