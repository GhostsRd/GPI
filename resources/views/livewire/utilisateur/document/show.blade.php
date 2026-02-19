{{-- resources/views/documents/show.blade.php --}}
@extends('layouts.app')

@section('title', $document->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        {{-- Sidebar avec métadonnées --}}
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary">
                        <i class="bi bi-info-circle me-2"></i>Informations
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-primary mb-2">{{ $document->type ?? 'Document' }}</span>
                        @if($document->category)
                        <span class="badge bg-secondary">{{ $document->category->name }}</span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-muted small mb-1"><i class="bi bi-calendar me-1"></i> Créé le</h6>
                        <p class="mb-0">{{ $document->created_at->translatedFormat('d F Y') }}</p>
                    </div>
                    
                    @if($document->updated_at->ne($document->created_at))
                    <div class="mb-3">
                        <h6 class="text-muted small mb-1"><i class="bi bi-arrow-clockwise me-1"></i> Modifié le</h6>
                        <p class="mb-0">{{ $document->updated_at->translatedFormat('d F Y à H:i') }}</p>
                    </div>
                    @endif
                    
                    @if($document->author)
                    <div class="mb-3">
                        <h6 class="text-muted small mb-1"><i class="bi bi-person me-1"></i> Auteur</h6>
                        <p class="mb-0">{{ $document->author->name }}</p>
                    </div>
                    @endif
                    
                    @if($document->tags && $document->tags->count() > 0)
                    <div class="mb-3">
                        <h6 class="text-muted small mb-1"><i class="bi bi-tags me-1"></i> Mots-clés</h6>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($document->tags as $tag)
                            <span class="badge bg-light text-dark border">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('documents.index') }}" class="btn btn-outline-secondary btn-sm w-100 mb-2">
                            <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                        </a>
                        
                        @if(auth()->check() && auth()->user()->can('update', $document))
                        <a href="{{ route('documents.edit', $document->slug) }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
                            <i class="bi bi-pencil me-1"></i> Modifier
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            
            {{-- Statistiques --}}
            @if($document->views_count || $document->downloads_count)
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <h6 class="text-muted mb-3"><i class="bi bi-bar-chart me-1"></i> Statistiques</h6>
                    <div class="row text-center">
                        @if($document->views_count)
                        <div class="col-6">
                            <div class="display-6 text-primary">{{ $document->views_count }}</div>
                            <small class="text-muted">Vues</small>
                        </div>
                        @endif
                        @if($document->downloads_count)
                        <div class="col-6">
                            <div class="display-6 text-success">{{ $document->downloads_count }}</div>
                            <small class="text-muted">Téléchargements</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        {{-- Contenu principal --}}
        <div class="col-lg-9 col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-0 text-dark">{{ $document->title }}</h1>
                            @if($document->description)
                            <p class="text-muted mb-0 mt-1">{{ $document->description }}</p>
                            @endif
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light border" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Imprimer</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-share me-2"></i>Partager</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-flag me-2"></i>Signaler</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    {{-- Actions rapides --}}
                    <div class="d-flex gap-2 mb-4">
                        @if($document->file_path)
                        <a href="{{ asset('storage/' . $document->file_path) }}" 
                           class="btn btn-primary" 
                           target="_blank"
                           data-bs-toggle="tooltip" 
                           title="Télécharger le fichier original">
                            <i class="bi bi-download me-1"></i> Télécharger
                        </a>
                        @endif
                        
                        <button class="btn btn-outline-secondary" onclick="window.print()">
                            <i class="bi bi-printer me-1"></i> Imprimer
                        </button>
                        
                        <button class="btn btn-outline-secondary" onclick="toggleFullscreen()">
                            <i class="bi bi-arrows-fullscreen me-1"></i> Plein écran
                        </button>
                        
                        <button class="btn btn-outline-secondary" id="copyLinkBtn" data-url="{{ url()->current() }}">
                            <i class="bi bi-link-45deg me-1"></i> Copier le lien
                        </button>
                    </div>
                    
                    {{-- Contenu du document --}}
                    <div class="document-content bg-light p-4 rounded">
                        @if($document->content)
                            <div class="content-rendered">
                                {!! $document->content !!}
                            </div>
                        @elseif($document->file_path)
                            <div class="text-center py-5">
                                <i class="bi bi-file-earmark-text display-1 text-muted"></i>
                                <p class="mt-3 text-muted">Ce document est disponible uniquement en téléchargement</p>
                                <a href="{{ asset('storage/' . $document->file_path) }}" 
                                   class="btn btn-primary mt-2" 
                                   target="_blank">
                                    <i class="bi bi-download me-1"></i> Télécharger pour visualiser
                                </a>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Aucun contenu disponible pour ce document.
                            </div>
                        @endif
                    </div>
                    
                    {{-- Prévisualisation PDF (si fichier PDF) --}}
                    @if($document->file_path && strtolower(pathinfo($document->file_path, PATHINFO_EXTENSION)) === 'pdf')
                    <div class="mt-4">
                        <h5 class="mb-3"><i class="bi bi-file-earmark-pdf me-2 text-danger"></i>Prévisualisation</h5>
                        <div class="ratio ratio-16x9 border rounded">
                            <iframe src="{{ asset('storage/' . $document->file_path) }}#view=fitH" 
                                    class="rounded" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    @endif
                    
                    {{-- Documents liés ou similaires --}}
                    @if($relatedDocuments && $relatedDocuments->count() > 0)
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="mb-3"><i class="bi bi-link-45deg me-2"></i>Documents liés</h5>
                        <div class="row">
                            @foreach($relatedDocuments->take(3) as $related)
                            <div class="col-md-4">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ Str::limit($related->title, 50) }}</h6>
                                        <p class="card-text small text-muted">{{ Str::limit($related->description, 80) }}</p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <a href="{{ route('documents.show', $related->slug) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            Consulter
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                
                {{-- Pied de page avec navigation --}}
                @if($previousDocument || $nextDocument)
                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex justify-content-between">
                        @if($previousDocument)
                        <a href="{{ route('documents.show', $previousDocument->slug) }}" 
                           class="btn btn-outline-primary">
                            <i class="bi bi-chevron-left me-1"></i> Document précédent
                        </a>
                        @else
                        <span></span>
                        @endif
                        
                        @if($nextDocument)
                        <a href="{{ route('documents.show', $nextDocument->slug) }}" 
                           class="btn btn-outline-primary">
                            Document suivant <i class="bi bi-chevron-right ms-1"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal pour partager --}}
<div class="modal fade" id="shareModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Partager ce document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Lien du document</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="shareLink" value="{{ url()->current() }}" readonly>
                        <button class="btn btn-outline-secondary" onclick="copyShareLink()">
                            <i class="bi bi-clipboard"></i>
                        </button>
                    </div>
                </div>
                <div class="text-center">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" class="btn btn-outline-primary btn-sm me-2">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($document->title) }}" 
                       target="_blank" class="btn btn-outline-info btn-sm me-2">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="mailto:?subject={{ urlencode($document->title) }}&body={{ urlencode('Consultez ce document: ' . url()->current()) }}" 
                       class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.document-content {
    min-height: 400px;
    line-height: 1.8;
}

.document-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}

.document-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.document-content table, 
.document-content th, 
.document-content td {
    border: 1px solid #dee2e6;
    padding: 0.75rem;
}

.document-content pre {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 6px;
    overflow-x: auto;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.badge {
    font-weight: 500;
}

.ratio iframe {
    border: none;
}
</style>
@endpush

@push('scripts')
<script>
// Initialisation des tooltips Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    
    // Copier le lien
    const copyLinkBtn = document.getElementById('copyLinkBtn')
    if (copyLinkBtn) {
        copyLinkBtn.addEventListener('click', function() {
            const url = this.getAttribute('data-url')
            navigator.clipboard.writeText(url).then(() => {
                const originalHTML = this.innerHTML
                this.innerHTML = '<i class="bi bi-check me-1"></i> Lien copié!'
                this.classList.add('btn-success')
                this.classList.remove('btn-outline-secondary')
                
                setTimeout(() => {
                    this.innerHTML = originalHTML
                    this.classList.remove('btn-success')
                    this.classList.add('btn-outline-secondary')
                }, 2000)
            })
        })
    }
})

// Plein écran
function toggleFullscreen() {
    const elem = document.querySelector('.document-content')
    if (!document.fullscreenElement) {
        elem.requestFullscreen().catch(err => {
            console.log(`Erreur plein écran: ${err.message}`)
        })
    } else {
        document.exitFullscreen()
    }
}

// Copier le lien de partage
function copyShareLink() {
    const shareLink = document.getElementById('shareLink')
    shareLink.select()
    shareLink.setSelectionRange(0, 99999)
    document.execCommand('copy')
    
    // Feedback visuel
    const btn = event.target.closest('button')
    const originalHTML = btn.innerHTML
    btn.innerHTML = '<i class="bi bi-check"></i> Copié!'
    setTimeout(() => {
        btn.innerHTML = originalHTML
    }, 2000)
}

// Gestion du plein écran
document.addEventListener('fullscreenchange', function() {
    const fullscreenBtn = document.querySelector('[onclick="toggleFullscreen()"]')
    if (document.fullscreenElement) {
        fullscreenBtn.innerHTML = '<i class="bi bi-arrows-angle-contract me-1"></i> Quitter plein écran'
        fullscreenBtn.classList.add('btn-primary')
        fullscreenBtn.classList.remove('btn-outline-secondary')
    } else {
        fullscreenBtn.innerHTML = '<i class="bi bi-arrows-fullscreen me-1"></i> Plein écran'
        fullscreenBtn.classList.remove('btn-primary')
        fullscreenBtn.classList.add('btn-outline-secondary')
    }
})
</script>
@endpush