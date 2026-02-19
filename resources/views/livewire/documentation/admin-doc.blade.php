@push('styles')
<link rel="stylesheet" href="{{ asset('css/documentation/admin-doc.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('js/documentation/admin-doc.js') }}"></script>
@endpush
<div class="documents-dashboard" 
     x-data="{ 
        showModal: @entangle('showModal'),
        showDeleteModal: @entangle('showDeleteModal'),
        sourceType: @entangle('sourceType'),
        toasts: [],
        form: {
            id: null,
            method: 'POST'
        },
        removeToast(index) {
            this.toasts = this.toasts.filter((_, i) => i !== index);
        },
        addToast(type, title, message) {
            this.toasts.push({ type, title, message, icon: type === 'success' ? '✅' : '❌' });
        },
        closeModal() {
            $wire.closeModal();
        },
        openModal(action) {
            if (action === 'create') {
                $wire.openCreateModal();
            }
        },
        closeDeleteModal() {
            $wire.closeDeleteModal();
        },
        get modalTitle() {
            return $wire.modalAction === 'create' ? 'Ajouter un nouveau document' : 'Modifier le document';
        },
        submitForm() {
            $wire.submit();
        }
     }"
     wire:key="admin-doc-dashboard">
    <!-- Toast Notifications -->
    <div class="toast-container">
        <template x-for="(toast, index) in toasts" :key="index">
            <div class="toast" 
                 :class="`toast-${toast.type}`"
                 x-init="setTimeout(() => removeToast(index), 5000)">
                <div class="toast-icon" x-html="toast.icon"></div>
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
                                       @change="$wire.selectedDocuments = $event.target.checked ? {{ json_encode($documents->pluck('id')) }} : []">
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
                                                wire:click="confirmDelete({{ $document->id }}, '{{ addslashes($document->title) }}')"
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
                                        <button type="button" class="btn-primary-action" @click.stop="openModal('create')">
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
    <div class="modal-overlay" 
         x-show="showModal" 
         x-cloak 
         @click.self="closeModal()" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none !important;">
        <div class="modal-container" @click.stop>
            <div class="modal-card">
                <div class="modal-header">
                    <h3 class="modal-title" x-text="modalTitle"></h3>
                    <button type="button" class="modal-close" @click.stop="closeModal()">×</button>
                </div>
                
                <form @submit.prevent="submitForm">
                    @csrf
                    <input type="hidden" name="_method" x-model="form.method">
                    <input type="hidden" name="document_id" x-model="form.id">
                    
                    <div class="modal-body">
                        <div class="form-grid">
                            <!-- Titre -->
                            <div class="form-group full-width">
                                <label class="form-label">Titre du document *</label>
                                <input type="text" 
                                       wire:model.defer="title"
                                       class="form-input" 
                                       placeholder="Ex: Guide d'utilisation, Manuel technique...">
                                @error('title') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea wire:model.defer="description"
                                          rows="3"
                                          class="form-textarea"
                                          placeholder="Décrivez brièvement le contenu du document..."></textarea>
                                @error('description') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <!-- Sélecteur de type de source -->
                            <div class="form-group full-width">
                                <label class="form-label">Type de contenu *</label>
                                <div class="source-type-selector">
                                    <button type="button" 
                                            class="source-type-btn" 
                                            :class="{ 'active': sourceType === 'file' }"
                                            @click="sourceType = 'file'">
                                        <span class="source-icon">📁</span>
                                        <span>Fichier local</span>
                                    </button>
                                    <button type="button" 
                                            class="source-type-btn" 
                                            :class="{ 'active': sourceType === 'video' }"
                                            @click="sourceType = 'video'">
                                        <span class="source-icon">🎬</span>
                                        <span>Vidéo en ligne</span>
                                    </button>
                                    <button type="button" 
                                            class="source-type-btn" 
                                            :class="{ 'active': sourceType === 'embed' }"
                                            @click="sourceType = 'embed'">
                                        <span class="source-icon">🔗</span>
                                        <span>Lien externe</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Section Fichier local -->
                            <div class="form-group full-width" x-show="sourceType === 'file'" x-cloak>
                                <label class="form-label">Fichier *</label>
                                <div class="file-upload-area" 
                                     onclick="document.getElementById('fileInput').click()">
                                    <input type="file" 
                                           id="fileInput"
                                           wire:model="file"
                                           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.mp4,.avi,.mov"
                                           style="display: none;">
                                    
                                    <template x-if="!$wire.file">
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
                                    </template>
                                    
                                    <div x-show="$wire.file" class="file-preview" x-cloak>
                                        <div class="file-preview-icon">
                                            <span class="file-emoji">📄</span>
                                        </div>
                                        <div class="file-preview-details">
                                            <div class="file-preview-name" x-text="$wire.file ? $wire.file.name : ''"></div>
                                        </div>
                                        <button type="button" class="file-preview-remove" @click.stop="$wire.file = null">
                                            <span>×</span>
                                        </button>
                                    </div>
                                </div>
                                @error('file') <div class="form-error">{{ $message }}</div> @enderror
                                <p class="form-help">
                                    Formats acceptés : PDF, Word, Excel, PowerPoint, Images, Vidéos (max 100MB)
                                </p>
                            </div>

                             <!-- Section Vidéo en ligne -->
                            <div class="form-group full-width" x-show="sourceType === 'video'" x-cloak>
                                <label class="form-label">URL de la vidéo *</label>
                                <div class="video-url-input">
                                    <input type="url" 
                                           wire:model.defer="video_url"
                                           class="form-input"
                                           placeholder="https://youtube.com/watch?v=... ou https://vimeo.com/...">
                                    <div class="video-platform-hint">
                                        <span class="platform youtube">YouTube</span>
                                        <span class="platform vimeo">Vimeo</span>
                                        <span class="platform dailymotion">Dailymotion</span>
                                    </div>
                                </div>
                                @error('video_url') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <!-- Section Lien externe -->
                            <div class="form-group full-width" x-show="sourceType === 'embed'" x-cloak>
                                <label class="form-label">URL du document *</label>
                                <input type="url" 
                                       wire:model.defer="embed_url"
                                       class="form-input"
                                       placeholder="https://exemple.com/document.pdf">
                                @error('embed_url') <div class="form-error">{{ $message }}</div> @enderror
                                <p class="form-help">
                                    Lien vers un document hébergé en ligne (Google Drive, Dropbox, site web...)
                                </p>
                            </div>

                            <!-- Catégorie -->
                            <div class="form-group">
                                <label class="form-label">Catégorie *</label>
                                <select wire:model.defer="category_id" class="form-select">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <!-- Type de document -->
                            <div class="form-group">
                                <label class="form-label">Type *</label>
                                <select wire:model.defer="file_type" class="form-select">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="pdf">📄 PDF</option>
                                    <option value="doc">📝 Word</option>
                                    <option value="xls">📊 Excel</option>
                                    <option value="ppt">📽️ PowerPoint</option>
                                    <option value="mp4">🎬 Vidéo</option>
                                    <option value="jpg">🖼️ Image</option>
                                </select>
                                @error('file_type') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <!-- Options -->
                            <div class="form-group full-width">
                                <div class="checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" wire:model.defer="is_published" class="checkbox-input">
                                        <span class="checkbox-custom"></span>
                                        <span class="checkbox-text">Publier immédiatement</span>
                                    </label>
                                    
                                    <label class="checkbox-label">
                                        <input type="checkbox" wire:model.defer="allow_download" class="checkbox-input">
                                        <span class="checkbox-custom"></span>
                                        <span class="checkbox-text">Autoriser le téléchargement</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" wire:click="closeModal()">
                            Annuler
                        </button>
                        <button type="submit" class="btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="submit">
                                {{ $modalAction === 'create' ? 'Créer le document' : 'Enregistrer les modifications' }}
                            </span>
                            <span wire:loading wire:target="submit" class="spinner-container">
                                <span class="spinner"></span>
                                Traitement...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Confirmation Suppression -->
    <div class="modal-overlay" 
         x-show="showDeleteModal" 
         x-cloak 
         @click.self="closeDeleteModal()" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none !important;">
        <div class="modal-container modal-sm" @click.stop>
            <div class="modal-card">
                <div class="modal-header">
                    <h3 class="modal-title">⚠️ Confirmer la suppression</h3>
                    <button type="button" class="modal-close" wire:click="closeDeleteModal()">×</button>
                </div>
                <div class="modal-body">
                    <div class="delete-confirmation">
                        <div class="delete-icon">🗑️</div>
                        <h4 class="delete-title">Êtes-vous sûr ?</h4>
                        @if($isBulkDelete)
                            <p class="delete-message">
                                Cette action supprimera définitivement les 
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
                    <button type="button" class="btn-secondary" wire:click="closeDeleteModal()">
                        Annuler
                    </button>
                    <button type="button" class="btn-danger" wire:click="deleteDocument()" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="deleteDocument">Supprimer définitivement</span>
                        <span wire:loading wire:target="deleteDocument" class="spinner-container">
                            <span class="spinner"></span>
                            Suppression...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


