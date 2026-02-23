@push('styles')
<link rel="stylesheet" href="{{ asset('css/documentation/admin-doc.css') }}">
<style>
/* Styles essentiels pour les modals */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 1rem;
}

.modal-container {
    max-width: 800px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.modal-container.modal-sm {
    max-width: 450px;
}

.modal-card {
    display: flex;
    flex-direction: column;
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #5BC4BF, #4AA8A4);
    color: white;
    border-radius: 20px 20px 0 0;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
}

.modal-close {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    cursor: pointer;
}

.modal-close:hover {
    background: rgba(255,255,255,0.3);
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding: 1.25rem 1.5rem;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
    background: #f9fafb;
    border-radius: 0 0 20px 20px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group.full-width {
    grid-column: span 2;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #374151;
}

.form-input, .form-textarea, .form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.875rem;
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: #5BC4BF;
    box-shadow: 0 0 0 3px rgba(91,196,191,0.1);
}

.form-error {
    font-size: 0.75rem;
    color: #ef4444;
    margin-top: 0.25rem;
}

.source-type-selector {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
}

.source-type-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    background: white;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.3s ease;
}

.source-type-btn.active {
    border-color: #5BC4BF;
    background: #f0f9f8;
    color: #5BC4BF;
}

.source-icon {
    font-size: 1.5rem;
}

.file-upload-area {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    background: #f9fafb;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: #5BC4BF;
    background: #f0f9f8;
}

.file-upload-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.file-upload-title {
    display: block;
    font-weight: 600;
    color: #374151;
}

.file-upload-subtitle {
    display: block;
    font-size: 0.75rem;
    color: #9ca3af;
}

.file-upload-formats {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
    margin-top: 1rem;
}

.format-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.7rem;
    font-weight: 600;
}

.format-badge.pdf { background: #fee2e2; color: #dc2626; }
.format-badge.doc { background: #dbeafe; color: #2563eb; }
.format-badge.xls { background: #dcfce7; color: #16a34a; }
.format-badge.ppt { background: #fed7aa; color: #ea580c; }
.format-badge.img { background: #f3e8ff; color: #9333ea; }
.format-badge.video { background: #ffe4e6; color: #e11d48; }

.file-preview {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 8px;
}

.file-preview-remove {
    width: 2rem;
    height: 2rem;
    border: none;
    border-radius: 8px;
    background: #f3f4f6;
    color: #6b7280;
    font-size: 1.25rem;
    cursor: pointer;
}

.file-preview-remove:hover {
    background: #fee2e2;
    color: #ef4444;
}

.checkbox-group {
    display: flex;
    gap: 1.5rem;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

.checkbox-input {
    display: none;
}

.checkbox-custom {
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    position: relative;
}

.checkbox-input:checked + .checkbox-custom {
    background: #5BC4BF;
    border-color: #5BC4BF;
}

.checkbox-input:checked + .checkbox-custom:after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 0.75rem;
}

.btn-primary, .btn-secondary, .btn-danger {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    border: none;
}

.btn-primary {
    background: #5BC4BF;
    color: white;
}

.btn-primary:hover {
    background: #4AA8A4;
}

.btn-secondary {
    background: #f3f4f6;
    color: #374151;
}

.btn-secondary:hover {
    background: #e5e7eb;
}

.btn-danger {
    background: #ef4444;
    color: white;
}

.btn-danger:hover {
    background: #dc2626;
}

.spinner-container {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.spinner {
    width: 1rem;
    height: 1rem;
    border: 2px solid rgba(255,255,255,0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Toast */
.toast-container {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    max-width: 400px;
}

.toast {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    border-left: 4px solid;
}

.toast-success { border-left-color: #10b981; }
.toast-error { border-left-color: #ef4444; }
.toast-warning { border-left-color: #f59e0b; }
.toast-info { border-left-color: #3b82f6; }

.toast-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: #9ca3af;
    cursor: pointer;
}

.toast-close:hover {
    color: #4b5563;
}

[x-cloak] { display: none !important; }
</style>
@endpush

<div class="documents-dashboard" 
     x-data="{ 
        toasts: [],
        addToast(type, title, message) {
            const icons = { success: '✅', error: '❌', warning: '⚠️', info: 'ℹ️' };
            this.toasts.push({ type, title, message, icon: icons[type] || 'ℹ️' });
            setTimeout(() => this.removeToast(this.toasts.length - 1), 5000);
        },
        removeToast(index) {
            this.toasts = this.toasts.filter((_, i) => i !== index);
        }
     }"
     x-init="Livewire.on('showToast', (data) => addToast(data.type, data.title, data.message));
            Livewire.on('toast', (data) => addToast(data.type, data.title, data.message));"
     wire:key="admin-doc-dashboard">
    
    <!-- Toast Notifications -->
    <div class="toast-container">
        <template x-for="(toast, index) in toasts" :key="index">
            <div class="toast" 
                 :class="`toast-${toast.type}`">
                <div class="toast-icon" x-text="toast.icon"></div>
                <div class="toast-content">
                    <div class="toast-title" x-text="toast.title"></div>
                    <div class="toast-message" x-text="toast.message"></div>
                </div>
                <button class="toast-close" @click="removeToast(index)">×</button>
            </div>
        </template>
    </div>

    <!-- Header Principal -->
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="dashboard-title">📚 Gestion des Documents</h1>
                <p class="dashboard-subtitle">Administrez votre bibliothèque de documents</p>
            </div>
            <div class="header-right">
                <div class="total-badge">
                    <span class="total-number">{{ $stats['total'] ?? 0 }}</span>
                    <span class="total-label">Documents</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes Statistiques -->
    <div class="stats-grid">
        <div class="doc-stat-card">
            <div class="stat-icon primary">📄</div>
            <div class="stat-content">
                <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
                <div class="stat-label">Total Documents</div>
            </div>
        </div>
        <div class="doc-stat-card">
            <div class="stat-icon success">✅</div>
            <div class="stat-content">
                <div class="stat-number">{{ $stats['published'] ?? 0 }}</div>
                <div class="stat-label">Publiés</div>
            </div>
        </div>
        <div class="doc-stat-card">
            <div class="stat-icon warning">✏️</div>
            <div class="stat-content">
                <div class="stat-number">{{ $stats['draft'] ?? 0 }}</div>
                <div class="stat-label">Brouillons</div>
            </div>
        </div>
        <div class="doc-stat-card">
            <div class="stat-icon info">👁️</div>
            <div class="stat-content">
                <div class="stat-number">{{ number_format($stats['total_views'] ?? 0) }}</div>
                <div class="stat-label">Vues totales</div>
            </div>
        </div>
        <div class="doc-stat-card">
            <div class="stat-icon purple">📥</div>
            <div class="stat-content">
                <div class="stat-number">{{ number_format($stats['total_downloads'] ?? 0) }}</div>
                <div class="stat-label">Téléchargements</div>
            </div>
        </div>
    </div>

    <!-- Barre de Filtres -->
    <div class="filters-section">
        <div class="filters-card">
            <div class="filters-header">
                <h3 class="filters-title">🔍 Filtres & Recherche</h3>
            </div>
            <div class="filters-body">
                <form method="GET" action="{{ route('documentation.admin-doc') }}" class="filters-form">
                    <div class="filters-grid">
                        <div class="filter-group">
                            <div class="search-box">
                                <span class="search-icon">🔍</span>
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       class="search-input" 
                                       placeholder="Rechercher un document...">
                            </div>
                        </div>
                        
                        <div class="filter-group">
                            <select name="category" class="form-select-custom">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <select name="type" class="form-select-custom">
                                <option value="">Tous les types</option>
                                <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                <option value="doc" {{ request('type') == 'doc' ? 'selected' : '' }}>Word</option>
                                <option value="xls" {{ request('type') == 'xls' ? 'selected' : '' }}>Excel</option>
                                <option value="ppt" {{ request('type') == 'ppt' ? 'selected' : '' }}>PowerPoint</option>
                                <option value="mp4" {{ request('type') == 'mp4' ? 'selected' : '' }}>Vidéo</option>
                                <option value="jpg" {{ request('type') == 'jpg' ? 'selected' : '' }}>Image</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <select name="status" class="form-select-custom">
                                <option value="">Tous les statuts</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <select name="per_page" class="form-select-custom">
                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 par page</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 par page</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 par page</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 par page</option>
                            </select>
                        </div>
                        
                        <div class="filter-actions">
                            <button type="submit" class="btn-filter">Filtrer</button>
                            <a href="{{ route('documentation.admin-doc') }}" class="btn-reset">Réinitialiser</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Actions Rapides -->
    <div class="quick-actions">
        <button type="button" class="btn-primary-action" wire:click="openCreateModal">
            <span class="btn-icon">➕</span>
            <span>Nouveau Document</span>
        </button>
        
        <div class="bulk-actions" x-show="$wire.selectedDocuments.length > 0" x-cloak>
            <span class="selected-count" x-text="`${$wire.selectedDocuments.length} document(s) sélectionné(s)`"></span>
            <button class="btn-bulk-delete" wire:click="confirmBulkDelete">
                <span class="btn-icon">🗑️</span>
                <span>Supprimer</span>
            </button>
        </div>
        
        <div class="sort-actions">
            <span class="sort-label">Trier par :</span>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => request('sort') == 'title' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
               class="sort-btn {{ request('sort') == 'title' ? 'active' : '' }}">
                Titre
                @if(request('sort') == 'title')
                    <span class="sort-arrow">{{ request('direction', 'asc') == 'asc' ? '↑' : '↓' }}</span>
                @endif
            </a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'views', 'direction' => request('sort') == 'views' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
               class="sort-btn {{ request('sort') == 'views' ? 'active' : '' }}">
                Vues
                @if(request('sort') == 'views')
                    <span class="sort-arrow">{{ request('direction', 'asc') == 'asc' ? '↑' : '↓' }}</span>
                @endif
            </a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('sort') == 'created_at' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
               class="sort-btn {{ request('sort') == 'created_at' ? 'active' : '' }}">
                Date
                @if(request('sort') == 'created_at')
                    <span class="sort-arrow">{{ request('direction', 'desc') == 'asc' ? '↑' : '↓' }}</span>
                @endif
            </a>
        </div>
    </div>
 
    <!-- Tableau des Documents -->
    <div class="table-section">
        <div class="table-card">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="40">
                                <input type="checkbox" 
                                       id="select-all" 
                                       wire:model="selectAll">
                            </th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Type</th>
                            <th>Taille</th>
                            <th>Vues</th>
                            <th>Téléch.</th>
                            <th>Statut</th>
                            <th>Créé le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $document)
                            <tr class="table-row">
                                <td>
                                    <input type="checkbox" 
                                           class="select-item" 
                                           value="{{ $document->id }}"
                                           wire:model="selectedDocuments">
                                </td>
                                <td>
                                    <div class="document-info">
                                        <div class="document-icon">
                                            <span class="type-icon {{ $document->file_extension }}">
                                                @php
                                                    $icons = [
                                                        'pdf' => '📄', 'doc' => '📝', 'docx' => '📝',
                                                        'xls' => '📊', 'xlsx' => '📊',
                                                        'ppt' => '📽️', 'pptx' => '📽️',
                                                        'mp4' => '🎬', 'avi' => '🎬', 'mov' => '🎬',
                                                        'jpg' => '🖼️', 'jpeg' => '🖼️', 'png' => '🖼️', 'gif' => '🖼️',
                                                        'default' => '📁'
                                                    ];
                                                @endphp
                                                {{ $icons[$document->file_extension] ?? $icons['default'] }}
                                            </span>
                                        </div>
                                        <div class="document-details">
                                            <div class="document-title">{{ $document->title }}</div>
                                            <div class="document-description">
                                                {{ Str::limit($document->description ?? '', 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="category-badge">{{ $document->category->name ?? 'Non catégorisé' }}</span>
                                </td>
                                <td>
                                    <span class="type-badge">{{ strtoupper($document->file_extension) }}</span>
                                </td>
                                <td>
                                    <span class="file-size">{{ $document->formatted_size }}</span>
                                </td>
                                <td>
                                    <div class="views-count">
                                        <span class="views-icon">👁️</span>
                                        <span class="views-number">{{ number_format($document->views) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="downloads-count">
                                        <span class="downloads-icon">📥</span>
                                        <span class="downloads-number">{{ number_format($document->downloads) }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($document->is_published)
                                        <span class="status-badge published">Publié</span>
                                    @else
                                        <span class="status-badge draft">Brouillon</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-cell">
                                        {{ $document->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="doc-btn-action view" 
                                                wire:click="togglePublish({{ $document->id }})"
                                                title="{{ $document->is_published ? 'Dépublier' : 'Publier' }}">
                                            @if($document->is_published)
                                                <span class="action-icon">👁️</span>
                                            @else
                                                <span class="action-icon">👁️‍🗨️</span>
                                            @endif
                                        </button>
                                        
                                        <button type="button" class="doc-btn-action edit" 
                                                wire:click="openEditModal({{ $document->id }})"
                                                title="Modifier">
                                            <span class="action-icon">✏️</span>
                                        </button>
                                        
                                        <button type="button" class="doc-btn-action delete" 
                                                wire:click="confirmDelete({{ $document->id }})"
                                                title="Supprimer">
                                            <span class="action-icon">🗑️</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty-state">
                                    <div class="empty-content">
                                        <div class="empty-icon">📄</div>
                                        <h3 class="empty-title">Aucun document trouvé</h3>
                                        <p class="empty-description">Commencez par créer votre premier document</p>
                                        <button type="button" class="btn-primary-action" wire:click="openCreateModal">
                                            <span class="btn-icon">➕</span>
                                            <span>Créer un document</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($documents instanceof \Illuminate\Pagination\LengthAwarePaginator && $documents->hasPages())
                <div class="pagination-container">
                    <div class="pagination-info">
                        Affichage de {{ $documents->firstItem() ?? 0 }} à {{ $documents->lastItem() ?? 0 }} 
                        sur {{ $documents->total() }} documents
                    </div>
                    <div class="pagination-controls">
                        {{ $documents->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Document (Création/Modification) -->
    @if($showModal)
    <div class="modal-overlay" wire:click.self="closeModal">
        <div class="modal-container" wire:click.stop>
            <div class="modal-card">
                <div class="modal-header">
                    <h3 class="modal-title">{{ $modalAction === 'create' ? '➕ Nouveau document' : '✏️ Modifier le document' }}</h3>
                    <button type="button" class="modal-close" wire:click="closeModal">×</button>
                </div>
                
                <form wire:submit.prevent="submit">
                    @csrf
                    
                    <div class="modal-body">
                        <div class="form-grid">
                            <!-- Titre -->
                            <div class="form-group full-width">
                                <label class="form-label">Titre du document *</label>
                                <input type="text" 
                                       wire:model="title"
                                       class="form-input" 
                                       placeholder="Ex: Guide d'utilisation, Manuel technique...">
                                @error('title') <span class="form-error">{{ $message }}</span> @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea wire:model="description"
                                          rows="3"
                                          class="form-textarea"
                                          placeholder="Décrivez brièvement le contenu du document..."></textarea>
                                @error('description') <span class="form-error">{{ $message }}</span> @enderror
                            </div>

                            <!-- Sélecteur de type de source -->
                            <div class="form-group full-width">
                                <label class="form-label">Type de contenu *</label>
                                <div class="source-type-selector">
                                    <button type="button" 
                                            class="source-type-btn {{ $sourceType === 'file' ? 'active' : '' }}"
                                            wire:click="$set('sourceType', 'file')">
                                        <span class="source-icon">📁</span>
                                        <span>Fichier local</span>
                                    </button>
                                    <button type="button" 
                                            class="source-type-btn {{ $sourceType === 'video' ? 'active' : '' }}"
                                            wire:click="$set('sourceType', 'video')">
                                        <span class="source-icon">🎬</span>
                                        <span>Vidéo en ligne</span>
                                    </button>
                                    <button type="button" 
                                            class="source-type-btn {{ $sourceType === 'embed' ? 'active' : '' }}"
                                            wire:click="$set('sourceType', 'embed')">
                                        <span class="source-icon">🔗</span>
                                        <span>Lien externe</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Section Fichier local -->
                            @if($sourceType === 'file')
                            <div class="form-group full-width">
                                <label class="form-label">Fichier *</label>
                                <div class="file-upload-area" 
                                     onclick="document.getElementById('fileInput').click()">
                                    <input type="file" 
                                           id="fileInput"
                                           wire:model="file"
                                           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.mp4,.avi,.mov"
                                           style="display: none;">
                                    
                                    @if(!$file)
                                    <div class="file-upload-content">
                                        <div class="file-upload-icon">📤</div>
                                        <div class="file-upload-text">
                                            <span class="file-upload-title">Cliquez pour télécharger</span>
                                            <span class="file-upload-subtitle">ou glissez-déposez votre fichier</span>
                                        </div>
                                        <div class="file-upload-formats">
                                            <span class="format-badge pdf">PDF</span>
                                            <span class="format-badge doc">DOC</span>
                                            <span class="format-badge xls">XLS</span>
                                            <span class="format-badge ppt">PPT</span>
                                            <span class="format-badge img">IMG</span>
                                            <span class="format-badge video">MP4</span>
                                        </div>
                                    </div>
                                    @else
                                    <div class="file-preview">
                                        <div class="file-preview-icon">
                                            <span class="file-emoji">📄</span>
                                        </div>
                                        <div class="file-preview-details">
                                            <div class="file-preview-name">{{ $file->getClientOriginalName() }}</div>
                                        </div>
                                        <button type="button" class="file-preview-remove" wire:click="$set('file', null)">
                                            <span>×</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                @error('file') <span class="form-error">{{ $message }}</span> @enderror
                                <p class="form-help">
                                    Formats acceptés : PDF, Word, Excel, PowerPoint, Images, Vidéos (max 100MB)
                                </p>
                            </div>
                            @endif

                            <!-- Section Vidéo en ligne -->
                            @if($sourceType === 'video')
                            <div class="form-group full-width">
                                <label class="form-label">URL de la vidéo *</label>
                                <div class="video-url-input">
                                    <input type="url" 
                                           wire:model="video_url"
                                           class="form-input"
                                           placeholder="https://youtube.com/watch?v=... ou https://vimeo.com/...">
                                    <div class="video-platform-hint">
                                        <span class="platform youtube">YouTube</span>
                                        <span class="platform vimeo">Vimeo</span>
                                        <span class="platform dailymotion">Dailymotion</span>
                                    </div>
                                </div>
                                @error('video_url') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                            @endif

                            <!-- Section Lien externe -->
                            @if($sourceType === 'embed')
                            <div class="form-group full-width">
                                <label class="form-label">URL du document *</label>
                                <input type="url" 
                                       wire:model="embed_url"
                                       class="form-input"
                                       placeholder="https://exemple.com/document.pdf">
                                @error('embed_url') <span class="form-error">{{ $message }}</span> @enderror
                                <p class="form-help">
                                    Lien vers un document hébergé en ligne (Google Drive, Dropbox, site web...)
                                </p>
                            </div>
                            @endif

                            <!-- Catégorie -->
                            <div class="form-group">
                                <label class="form-label">Catégorie *</label>
                                <select wire:model="category_id" class="form-select">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="form-error">{{ $message }}</span> @enderror
                            </div>

                            <!-- Type de document -->
                            <div class="form-group">
                                <label class="form-label">Type *</label>
                                <select wire:model="file_type" class="form-select">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="pdf">📄 PDF</option>
                                    <option value="doc">📝 Word</option>
                                    <option value="xls">📊 Excel</option>
                                    <option value="ppt">📽️ PowerPoint</option>
                                    <option value="mp4">🎬 Vidéo</option>
                                    <option value="jpg">🖼️ Image</option>
                                </select>
                                @error('file_type') <span class="form-error">{{ $message }}</span> @enderror
                            </div>

                            <!-- Options -->
                            <div class="form-group full-width">
                                <div class="checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" wire:model="is_published" class="checkbox-input">
                                        <span class="checkbox-custom"></span>
                                        <span class="checkbox-text">Publier immédiatement</span>
                                    </label>
                                    
                                    <label class="checkbox-label">
                                        <input type="checkbox" wire:model="allow_download" class="checkbox-input">
                                        <span class="checkbox-custom"></span>
                                        <span class="checkbox-text">Autoriser le téléchargement</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" wire:click="closeModal">
                            Annuler
                        </button>
                        <button type="submit" class="btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                {{ $modalAction === 'create' ? 'Créer le document' : 'Enregistrer les modifications' }}
                            </span>
                            <span wire:loading>
                                <span class="spinner-container">
                                    <span class="spinner"></span>
                                    Traitement...
                                </span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Confirmation Suppression -->
    @if($showDeleteModal)
    <div class="modal-overlay" wire:click.self="closeDeleteModal">
        <div class="modal-container modal-sm" wire:click.stop>
            <div class="modal-card">
                <div class="modal-header">
                    <h3 class="modal-title">⚠️ Confirmer la suppression</h3>
                    <button type="button" class="modal-close" wire:click="closeDeleteModal">×</button>
                </div>
                
                <div class="modal-body">
                    <div class="delete-confirmation">
                        <div class="delete-icon">🗑️</div>
                        <h4 class="delete-title">Êtes-vous sûr ?</h4>
                        
                        @if($isBulkDelete)
                            <p class="delete-message">
                                Cette action supprimera définitivement 
                                <strong>{{ count($selectedDocuments) }} documents</strong> sélectionnés.
                            </p>
                        @elseif($documentToDelete)
                            <p class="delete-message">
                                Cette action supprimera définitivement le document 
                                <strong>"{{ $documentToDelete['title'] ?? '' }}"</strong>.
                            </p>
                        @endif
                        
                        <p class="delete-warning">
                            <span class="warning-icon">⚠️</span>
                            Cette action est irréversible.
                        </p>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" wire:click="closeDeleteModal">
                        Annuler
                    </button>
                    <button type="button" class="btn-danger" wire:click="deleteDocument" wire:loading.attr="disabled">
                        <span wire:loading.remove>Supprimer définitivement</span>
                        <span wire:loading>
                            <span class="spinner-container">
                                <span class="spinner"></span>
                                Suppression...
                            </span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script src="{{ asset('js/documentation/admin-doc.js') }}"></script>
@endpush