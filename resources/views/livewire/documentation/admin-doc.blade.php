@push('styles')
<style>
    /* Variables globales - Palette principale GPI (Turquoise) */
    :root {
        --primary: #5BC4BF;
        --primary-dark: #3A9692;
        --primary-light: #8CD6D3;
        --primary-lighter: #D4F0EF;
        --primary-lightest: #F5FBFA;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.07);
        --radius: 8px;
        --radius-lg: 12px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .doc-manager {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', system-ui, sans-serif;
        background: var(--gray-50);
        min-height: 100vh;
        padding: 1.5rem;
        font-size: 0.8125rem;
    }

    /* Container */
    .doc-container {
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Header simplifié */
    .doc-header {
        background: white;
        border-radius: var(--radius-lg);
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid var(--gray-200);
    }

    .header-title h1 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 0.125rem;
    }

    .header-title p {
        color: var(--gray-500);
        font-size: 0.75rem;
    }

    .header-stats {
        display: flex;
        gap: 1.5rem;
    }

    .stat-item {
        text-align: right;
    }

    .stat-value {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-800);
    }

    .stat-label {
        font-size: 0.6875rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    /* Stats Cards - Sans couleurs */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius);
        padding: 1rem 1.25rem;
        border: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        border-color: var(--gray-300);
        box-shadow: var(--shadow-sm);
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius);
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        color: var(--gray-600);
    }

    .stat-info h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 0.125rem;
    }

    .stat-info p {
        color: var(--gray-500);
        font-size: 0.6875rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    /* Actions Bar */
    .actions-bar {
        background: white;
        border-radius: var(--radius);
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-200);
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    /* Boutons */
    .btn-primary {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        font-weight: 500;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    .btn-secondary {
        background: white;
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        font-weight: 500;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-danger {
        background: white;
        color: var(--danger);
        border: 1px solid var(--gray-300);
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        font-weight: 500;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-danger:hover {
        background: #fef2f2;
        border-color: var(--danger);
    }

    /* Filtres */
    .filters-bar {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-box {
        position: relative;
    }

    .search-box i {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        font-size: 0.75rem;
        font-style: normal;
    }

    .search-input {
        padding: 0.5rem 0.75rem 0.5rem 2rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 0.75rem;
        width: 240px;
        background: white;
        transition: all 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(59,130,246,0.1);
    }

    .filter-select {
        padding: 0.5rem 1.5rem 0.5rem 0.75rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 0.75rem;
        background: white;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 1rem;
    }

    /* Table */
    .table-wrapper {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.75rem;
    }

    .data-table th {
        background: var(--gray-50);
        padding: 0.75rem 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.6875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--gray-500);
        border-bottom: 1px solid var(--gray-200);
    }

    .data-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--gray-100);
        color: var(--gray-700);
    }

    .data-table tr:hover td {
        background: var(--gray-50);
    }

    /* Document info */
    .doc-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .doc-icon {
        width: 32px;
        height: 32px;
        border-radius: var(--radius);
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: var(--gray-600);
    }

    .doc-details h4 {
        font-weight: 500;
        font-size: 0.8125rem;
        margin-bottom: 0.125rem;
        color: var(--gray-800);
    }

    .doc-details p {
        color: var(--gray-500);
        font-size: 0.6875rem;
    }

    /* Badges épurés */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.1875rem 0.5rem;
        border-radius: 4px;
        font-size: 0.6875rem;
        font-weight: 500;
    }

    .badge-success {
        background: #ecfdf5;
        color: #065f46;
    }

    .badge-warning {
        background: #fffbeb;
        color: #92400e;
    }

    .badge-info {
        background: #eff6ff;
        color: #1e40af;
    }

    .badge-gray {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    /* Actions */
    .action-group {
        display: flex;
        gap: 0.25rem;
    }

    .action-btn {
        width: 28px;
        height: 28px;
        border-radius: 4px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: transparent;
        color: var(--gray-500);
        font-size: 0.75rem;
        transition: all 0.2s;
    }

    .action-btn:hover {
        background: var(--gray-100);
        color: var(--primary);
    }

    .action-btn.delete:hover {
        background: #fef2f2;
        color: var(--danger);
    }

    /* Checkbox */
    input[type="checkbox"] {
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: var(--primary);
    }

    /* Pagination - Simplifiée */
    .pagination-wrapper {
        padding: 1rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--gray-200);
        background: white;
        font-size: 0.75rem;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .pagination-info {
        color: var(--gray-500);
    }

    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        flex-wrap: wrap;
    }

    .pagination-btn {
        padding: 0.375rem 0.75rem;
        border-radius: 4px;
        border: 1px solid var(--gray-300);
        background: white;
        color: var(--gray-700);
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .pagination-btn:hover:not(:disabled) {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .pagination-btn.active {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .pagination-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .per-page-selector {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .per-page-selector select {
        padding: 0.375rem 1.25rem 0.375rem 0.5rem;
        border: 1px solid var(--gray-300);
        border-radius: 4px;
        font-size: 0.6875rem;
        background: white;
        cursor: pointer;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1000;
    }

    .modal.active {
        display: block;
    }

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(2px);
    }

    .modal-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: var(--radius-lg);
        width: 90%;
        max-width: 560px;
        max-height: 85vh;
        overflow-y: auto;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .modal-sm .modal-container {
        max-width: 400px;
    }

    .modal-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray-800);
    }

    .modal-close {
        background: transparent;
        border: none;
        font-size: 1.25rem;
        cursor: pointer;
        color: var(--gray-400);
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
    }

    .modal-close:hover {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .modal-body {
        padding: 1.25rem;
    }

    .modal-footer {
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--gray-200);
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        background: var(--gray-50);
    }

    /* Form */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        font-size: 0.6875rem;
        font-weight: 500;
        margin-bottom: 0.375rem;
        color: var(--gray-700);
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .form-control {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 0.8125rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(59,130,246,0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .form-error {
        color: var(--danger);
        font-size: 0.6875rem;
        margin-top: 0.25rem;
    }

    /* Source types */
    .source-types {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .source-type {
        flex: 1;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        padding: 0.625rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: white;
        font-size: 0.75rem;
    }

    .source-type.active {
        border-color: var(--primary);
        background: #eff6ff;
    }

    /* Upload area */
    .upload-area {
        border: 1px dashed var(--gray-300);
        border-radius: var(--radius);
        padding: 1.5rem;
        text-align: center;
        background: var(--gray-50);
        cursor: pointer;
        transition: all 0.2s;
    }

    .upload-area:hover {
        border-color: var(--primary);
        background: #eff6ff;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.25rem;
        color: var(--gray-700);
    }

    .empty-text {
        font-size: 0.75rem;
        color: var(--gray-500);
        margin-bottom: 1rem;
    }

    /* Toast */
    .toast-container {
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 1100;
    }

    .toast {
        background: white;
        border-radius: var(--radius);
        padding: 0.75rem 1rem;
        margin-bottom: 0.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 280px;
        border-left: 3px solid;
        font-size: 0.75rem;
    }

    .toast-success { border-left-color: var(--success); }
    .toast-error { border-left-color: var(--danger); }
    .toast-warning { border-left-color: var(--warning); }
    .toast-info { border-left-color: var(--primary); }

    /* Responsive */
    @media (max-width: 768px) {
        .doc-manager {
            padding: 1rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .pagination-wrapper {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .pagination-controls {
            justify-content: center;
        }
    }
</style>
@endpush

<div class="doc-manager" 
     x-data="docManager()" 
     x-init="init()"
     @file-upload-complete.window="handleFileUploadComplete($event.detail)"
     @video-upload-complete.window="handleVideoUploadComplete($event.detail)">
    <div class="doc-container">
        
        <!-- Toast Container -->
        <div class="toast-container">
            <template x-for="toast in toasts" :key="toast.id">
                <div class="toast" :class="'toast-' + toast.type">
                    <div class="toast-content" style="flex:1">
                        <div class="toast-title" style="font-weight:600; margin-bottom:0.125rem" x-text="toast.title"></div>
                        <div class="toast-message" style="color:var(--gray-500); font-size:0.6875rem" x-text="toast.message"></div>
                    </div>
                    <button class="toast-close" @click="removeToast(toast.id)" style="background:transparent; border:none; font-size:1rem; cursor:pointer;">×</button>
                </div>
            </template>
        </div>

        <!-- Header simplifié -->
        <div class="doc-header">
            <div class="header-title">
                <h1>Gestion des documents</h1>
                <p>Bibliothèque documentaire</p>
            </div>
            <div class="header-stats">
                <div class="stat-item">
                    <div class="stat-value" x-text="$wire.stats.total || 0"></div>
                    <div class="stat-label">Total</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" x-text="$wire.stats.published || 0"></div>
                    <div class="stat-label">Publiés</div>
                </div>
            </div>
        </div>

        <!-- Stats Cards - Sans couleurs -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📄</div>
                <div class="stat-info">
                    <h3 x-text="$wire.stats.total || 0"></h3>
                    <p>Documents</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✓</div>
                <div class="stat-info">
                    <h3 x-text="$wire.stats.published || 0"></h3>
                    <p>Publiés</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✎</div>
                <div class="stat-info">
                    <h3 x-text="$wire.stats.draft || 0"></h3>
                    <p>Brouillons</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👁</div>
                <div class="stat-info">
                    <h3 x-text="formatNumber($wire.stats.total_views || 0)"></h3>
                    <p>Vues</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⬇</div>
                <div class="stat-info">
                    <h3 x-text="formatNumber($wire.stats.total_downloads || 0)"></h3>
                    <p>Téléchargements</p>
                </div>
            </div>
        </div>

        <!-- Actions Bar -->
        <div class="actions-bar">
            <div class="filters-bar">
                <div class="search-box">
                    <i>🔍</i>
                    <input type="text" 
                           class="search-input" 
                           placeholder="Rechercher..."
                           wire:model.debounce.500ms="search">
                </div>

                <select class="filter-select" wire:model="categoryFilter">
                    <option value="">Toutes catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <select class="filter-select" wire:model="typeFilter">
                    <option value="">Tous types</option>
                    <option value="pdf">PDF</option>
                    <option value="word">Word</option>
                    <option value="spreadsheet">Excel</option>
                    <option value="ppt">PowerPoint</option>
                    <option value="mp4">Vidéo</option>
                </select>

                <button class="btn-secondary" wire:click="resetFilters">
                    ↻ Réinitialiser
                </button>
            </div>

            <button class="btn-primary" @click="openModal('create')">
                + Nouveau document
            </button>
        </div>

        <!-- Bulk Actions -->
        <div class="actions-bar" x-show="$wire.selectedDocuments.length > 0" x-cloak>
            <span x-text="`${$wire.selectedDocuments.length} document(s) sélectionné(s)`"></span>
            <button class="btn-danger" @click="openDeleteModal('bulk')">
                🗑 Supprimer
            </button>
        </div>

        <!-- Table -->
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="36"><input type="checkbox" wire:model="selectAll"></th>
                        <th>Document</th>
                        <th>Catégorie</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Vues</th>
                        <th>Date</th>
                        <th width="100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $doc)
                    <tr wire:key="doc-{{ $doc->id }}">
                        <td><input type="checkbox" value="{{ $doc->id }}" wire:model="selectedDocuments"></td>
                        <td>
                            <div class="doc-info">
                                <div class="doc-icon">
                                    @switch($doc->file_extension)
                                        @case('pdf') 📄 @break
                                        @case('doc') @case('docx') 📝 @break
                                        @case('xls') @case('xlsx') 📊 @break
                                        @case('ppt') @case('pptx') 📽 @break
                                        @case('mp4') 🎬 @break
                                        @default 📁
                                    @endswitch
                                </div>
                                <div class="doc-details">
                                    <h4>{{ $doc->title }}</h4>
                                    <p>{{ Str::limit($doc->description, 60) }}</p>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-info">{{ $doc->category->name ?? 'Non catégorisé' }}</span></td>
                        <td><span class="badge badge-gray">{{ strtoupper($doc->file_extension) }}</span></td>
                        <td>
                            @if($doc->is_published)
                                <span class="badge badge-success">Publié</span>
                            @else
                                <span class="badge badge-warning">Brouillon</span>
                            @endif
                        </td>
                        <td>{{ number_format($doc->views) }}</td>
                        <td>{{ $doc->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="action-group">
                                <button class="action-btn" wire:click="showPreview({{ $doc->id }})" title="Voir">👁</button>
                                <button class="action-btn" @click="openModal('edit', {{ $doc->id }})" title="Modifier">✏</button>
                                <button class="action-btn" wire:click="togglePublish({{ $doc->id }})" title="{{ $doc->is_published ? 'Dépublier' : 'Publier' }}">
                                    {{ $doc->is_published ? '👁' : '👁‍🗨' }}
                                </button>
                                <button class="action-btn delete" @click="openDeleteModal('single', {{ $doc->id }}, '{{ addslashes($doc->title) }}')" title="Supprimer">🗑</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon">📄</div>
                                <h3 class="empty-title">Aucun document</h3>
                                <p class="empty-text">Commencez par créer votre premier document</p>
                                <button class="btn-primary" @click="openModal('create')">+ Créer un document</button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination simplifiée -->
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    @if($documents->total() > 0)
                        {{ $documents->firstItem() }} - {{ $documents->lastItem() }} sur {{ $documents->total() }} documents
                    @else
                        Aucun document
                    @endif
                </div>

                <div class="pagination-controls">
                    <!-- Previous -->
                    <button class="pagination-btn" wire:click="previousPage" wire:loading.attr="disabled" @if($documents->onFirstPage()) disabled @endif>
                        ‹ Précédent
                    </button>

                    <!-- Page numbers (limit to 5 for simplicity) -->
                    @php
                        $currentPage = $documents->currentPage();
                        $lastPage = $documents->lastPage();
                        $start = max(1, $currentPage - 2);
                        $end = min($lastPage, $currentPage + 2);
                    @endphp

                    @for($page = $start; $page <= $end; $page++)
                        <button class="pagination-btn {{ $page == $currentPage ? 'active' : '' }}" wire:click="gotoPage({{ $page }})">
                            {{ $page }}
                        </button>
                    @endfor

                    <!-- Next -->
                    <button class="pagination-btn" wire:click="nextPage" wire:loading.attr="disabled" @if(!$documents->hasMorePages()) disabled @endif>
                        Suivant ›
                    </button>

                    <!-- Per page selector -->
                    <div class="per-page-selector">
                        <span style="color:var(--gray-500)">Par page :</span>
                        <select wire:model.live="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Création/Édition -->
        <div class="modal" :class="{ 'active': modals.document }">
            <div class="modal-overlay" @click="closeModal('document')"></div>
            <div class="modal-container">
                <div class="modal-header">
                    <h3 x-text="modalAction === 'create' ? 'Nouveau document' : 'Modifier le document'"></h3>
                    <button class="modal-close" @click="closeModal('document')">×</button>
                </div>

                <form @submit.prevent="submitForm">
                    <div class="modal-body">
                        <!-- Source type -->
                        <div class="source-types">
                            <button type="button" class="source-type" :class="{ 'active': sourceType === 'file' }" @click="sourceType = 'file'; resetFileInputs()">📁 Fichier</button>
                            <button type="button" class="source-type" :class="{ 'active': sourceType === 'video' }" @click="sourceType = 'video'; resetFileInputs()">🎬 Vidéo</button>
                            <button type="button" class="source-type" :class="{ 'active': sourceType === 'embed' }" @click="sourceType = 'embed'; resetFileInputs()">🔗 Lien</button>
                        </div>

                        <!-- Titre -->
                        <div class="form-group">
                            <label class="form-label">Titre *</label>
                            <input type="text" class="form-control" x-model="form.title" :class="{ 'error': errors.title }">
                            <div class="form-error" x-show="errors.title" x-text="errors.title"></div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" x-model="form.description" rows="3"></textarea>
                        </div>

                        <!-- File upload -->
                        <template x-if="sourceType === 'file'">
                            <div class="form-group">
                                <label class="form-label">Fichier *</label>
                                <template x-if="!selectedFile && !form.existing_file_name">
                                    <div class="upload-area" @click="$refs.fileInput.click()" :style="isUploading ? 'opacity:0.5; pointer-events:none' : ''">
                                        <div style="font-size:1.5rem; margin-bottom:0.5rem">📤</div>
                                        <div x-text="isUploading ? `Téléchargement... ${uploadProgress}%` : 'Cliquez pour sélectionner un fichier'"></div>
                                        <div style="font-size:0.625rem; color:var(--gray-400); margin-top:0.25rem">PDF, Word, Excel, PowerPoint, Images (max 100MB)</div>
                                    </div>
                                </template>
                                <template x-if="selectedFile">
                                    <div class="file-preview" style="display:flex; align-items:center; gap:0.75rem; padding:0.75rem; background:var(--gray-50); border-radius:var(--radius)">
                                        <div style="flex:1">
                                            <div style="font-weight:500" x-text="selectedFile.name"></div>
                                            <div style="font-size:0.625rem; color:var(--gray-500)" x-text="formatFileSize(selectedFile.size)"></div>
                                        </div>
                                        <button type="button" class="btn-secondary" style="padding:0.25rem 0.5rem" @click="removeSelectedFile()">Retirer</button>
                                    </div>
                                </template>
                                <input type="file" x-ref="fileInput" @change="handleFileSelect($event)" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png" style="display:none">
                            </div>
                        </template>

                        <!-- Video -->
                        <template x-if="sourceType === 'video'">
                            <div class="form-group">
                                <label class="form-label">Source vidéo</label>
                                <div style="display:flex; gap:1rem; margin-bottom:0.75rem">
                                    <label style="display:flex; align-items:center; gap:0.25rem; cursor:pointer; font-size:0.75rem">
                                        <input type="radio" value="url" x-model="form.videoSource" @change="resetVideoInputs()"> Lien externe
                                    </label>
                                    <label style="display:flex; align-items:center; gap:0.25rem; cursor:pointer; font-size:0.75rem">
                                        <input type="radio" value="file" x-model="form.videoSource" @change="resetVideoInputs()"> Fichier MP4
                                    </label>
                                </div>

                                <template x-if="form.videoSource === 'url'">
                                    <div>
                                        <input type="url" class="form-control" x-model="form.video_url" placeholder="https://youtube.com/watch?v=...">
                                        <div class="form-error" x-show="errors.video_url" x-text="errors.video_url"></div>
                                    </div>
                                </template>

                                <template x-if="form.videoSource === 'file'">
                                    <div>
                                        <template x-if="!selectedVideoFile && !form.existing_file_name">
                                            <div class="upload-area" @click="$refs.videoFileInput.click()">
                                                <div style="font-size:1.5rem; margin-bottom:0.5rem">🎬</div>
                                                <div>Sélectionner une vidéo</div>
                                                <div style="font-size:0.625rem; color:var(--gray-400)">MP4, WebM (max 500MB)</div>
                                            </div>
                                        </template>
                                        <template x-if="selectedVideoFile">
                                            <div>
                                                <div style="display:flex; align-items:center; gap:0.75rem; padding:0.75rem; background:var(--gray-50); border-radius:var(--radius); margin-bottom:0.5rem">
                                                    <div style="flex:1">
                                                        <div style="font-weight:500" x-text="selectedVideoFile.name"></div>
                                                        <div style="font-size:0.625rem; color:var(--gray-500)" x-text="formatFileSize(selectedVideoFile.size)"></div>
                                                    </div>
                                                    <button type="button" class="btn-secondary" style="padding:0.25rem 0.5rem" @click="removeSelectedVideoFile()">Retirer</button>
                                                </div>
                                                <video controls style="width:100%; max-height:200px; border-radius:var(--radius)">
                                                    <source :src="selectedVideoFilePreview" :type="selectedVideoFile.type">
                                                </video>
                                            </div>
                                        </template>
                                        <input type="file" x-ref="videoFileInput" @change="handleVideoFileSelect($event)" accept="video/mp4,video/webm" style="display:none">
                                    </div>
                                </template>
                            </div>
                        </template>

                        <!-- Embed URL -->
                        <template x-if="sourceType === 'embed'">
                            <div class="form-group">
                                <label class="form-label">URL du document *</label>
                                <input type="url" class="form-control" x-model="form.embed_url" placeholder="https://...">
                                <div class="form-error" x-show="errors.embed_url" x-text="errors.embed_url"></div>
                            </div>
                        </template>

                        <!-- Catégorie -->
                        <div class="form-group">
                            <label class="form-label">Catégorie *</label>
                            <div style="display:flex; gap:0.5rem">
                                <template x-if="!showNewCategory">
                                    <select class="form-control" x-model="form.category_id" style="flex:1">
                                        <option value="">Sélectionnez</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </template>
                                <template x-if="showNewCategory">
                                    <input type="text" class="form-control" x-model="newCategoryName" placeholder="Nouvelle catégorie" style="flex:1">
                                </template>
                                <button type="button" class="btn-secondary" style="padding:0.5rem" @click="showNewCategory ? saveNewCategory() : (showNewCategory = true)" x-text="showNewCategory ? '✓' : '+'"></button>
                                <button type="button" class="btn-secondary" style="padding:0.5rem" x-show="showNewCategory" @click="showNewCategory = false; newCategoryName = ''">✗</button>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="form-group">
                            <label class="form-label">Type *</label>
                            <select class="form-control" x-model="form.file_type" @change="onFileTypeChange">
                                <option value="">Sélectionnez</option>
                                <option value="pdf">PDF</option>
                                <option value="word">Word</option>
                                <option value="spreadsheet">Excel</option>
                                <option value="ppt">PowerPoint</option>
                                <option value="jpg">Image</option>
                                <option value="mp4">Vidéo</option>
                            </select>
                        </div>

                        <!-- Options -->
                        <div style="display:flex; gap:1rem; margin-top:0.5rem">
                            <label style="display:flex; align-items:center; gap:0.5rem; font-size:0.75rem">
                                <input type="checkbox" x-model="form.is_published"> Publier
                            </label>
                            <label style="display:flex; align-items:center; gap:0.5rem; font-size:0.75rem">
                                <input type="checkbox" x-model="form.allow_download"> Téléchargement autorisé
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" @click="closeModal('document')">Annuler</button>
                        <button type="submit" class="btn-primary" :disabled="loading || isUploading">
                            <span x-show="!loading && !isUploading" x-text="modalAction === 'create' ? 'Créer' : 'Modifier'"></span>
                            <span x-show="loading || isUploading" class="spinner" style="display:inline-block; width:12px; height:12px; border:2px solid white; border-top-color:transparent; border-radius:50%; animation:spin 0.8s linear infinite"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Confirmation Suppression -->
        <div class="modal modal-sm" :class="{ 'active': modals.delete }">
            <div class="modal-overlay" @click="closeModal('delete')"></div>
            <div class="modal-container">
                <div class="modal-header">
                    <h3>Confirmer la suppression</h3>
                    <button class="modal-close" @click="closeModal('delete')">×</button>
                </div>
                <div class="modal-body" style="text-align:center">
                    <div style="font-size:2rem; margin-bottom:0.5rem">🗑</div>
                    <p style="margin-bottom:0.5rem">
                        <template x-if="deleteType === 'bulk'">
                            <span>Supprimer <strong x-text="$wire.selectedDocuments.length"></strong> document(s) ?</span>
                        </template>
                        <template x-if="deleteType === 'single'">
                            <span>Supprimer "<strong x-text="deleteItemTitle"></strong>" ?</span>
                        </template>
                    </p>
                    <p style="font-size:0.6875rem; color:var(--danger)">⚠ Action irréversible</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" @click="closeModal('delete')">Annuler</button>
                    <button type="button" class="btn-danger" @click="confirmDelete" :disabled="loading">
                        <span x-show="!loading">Supprimer</span>
                        <span x-show="loading" class="spinner" style="display:inline-block; width:12px; height:12px; border:2px solid white; border-top-color:transparent; border-radius:50%; animation:spin 0.8s linear infinite"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Preview Modernisé -->
    @if($showPreviewModal && $previewDocument)
    <div style="position:fixed; inset:0; z-index:9999; display:flex; align-items:center; justify-content:center; padding: 1rem;" 
         x-data="{ isFullscreen: false }" 
         x-on:keydown.escape.window="isFullscreen ? isFullscreen = false : $wire.closePreview()"
         x-on:toggle-fullscreen.window="isFullscreen = !isFullscreen">
        <div style="position:fixed; inset:0; background:rgba(15, 23, 42, 0.7); backdrop-filter:blur(8px)" wire:click="closePreview"></div>
        
        <div :style="isFullscreen ? 'position:fixed; inset:0; width:100vw; height:100vh; max-width:100%; border-radius:0; z-index:10000;' : 'position:relative; background:white; border-radius:16px; width:100%; max-width:1100px; height:90vh;'"
             style="display:flex; flex-direction:column; background:white; shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25); overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); animation: modal-up 0.3s ease-out;">
            <!-- Header -->
            <div style="display:flex; justify-content:space-between; align-items:center; padding:1.25rem 1.5rem; border-bottom:1px solid var(--gray-100); background: white;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; border-radius: 10px; background: var(--gray-50); display: flex; align-items: center; justify-content: center; color: var(--primary);">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h3 style="font-size:1.125rem; font-weight:700; color: var(--gray-900); margin: 0;">{{ $previewDocument->title }}</h3>
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem;">
                            <span style="font-size:0.6875rem; color:white; background: var(--gray-700); padding: 2px 6px; border-radius: 4px; text-transform:uppercase; font-weight: 600;">{{ $previewDocument->file_extension }}</span>
                            <span style="font-size:0.6875rem; color:var(--gray-500);">{{ $previewDocument->getFormattedFileSize() }}</span>
                        </div>
                    </div>
                </div>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="{{ route('admin.documents.stream', $previewDocument->id) }}?download=1" class="btn-secondary" style="height: 36px; padding: 0 1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.75rem;">
                        <i class="fas fa-download"></i> Télécharger
                    </a>
                    
                    <button x-show="isFullscreen" 
                            x-on:click="isFullscreen = false" 
                            class="btn-secondary" 
                            title="Petite vue"
                            style="width: 36px; height: 36px; border-radius: 50%; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-compress"></i>
                    </button>

                    <button x-show="!isFullscreen" 
                            x-on:click="isFullscreen = true" 
                            class="btn-secondary" 
                            title="Plein écran"
                            style="width: 36px; height: 36px; border-radius: 50%; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-expand"></i>
                    </button>

                    <button wire:click="closePreview" style="width: 36px; height: 36px; border-radius: 50%; border: none; background: var(--gray-100); color: var(--gray-600); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='var(--danger)'; this.style.color='white'" onmouseout="this.style.background='var(--gray-100)'; this.style.color='var(--gray-600)'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div style="flex:1; overflow:hidden; background:#f1f5f9; display: flex;" :class="isFullscreen ? 'fullscreen-mode' : ''">
                <div style="flex: 1; padding: 1.5rem; overflow-y: auto; display: flex; flex-direction: column;" :style="isFullscreen ? 'padding: 0;' : ''">
                    <x-document-preview :document="$previewDocument" />
                </div>
                
                {{-- Sidebar Info (Optionnelle) --}}
                <div style="width: 300px; border-left: 1px solid var(--gray-100); background: white; padding: 1.5rem; display: none;" class="d-lg-block">
                    <h4 style="font-size: 0.8125rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gray-500); margin-bottom: 1rem;">Détails</h4>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div>
                            <label style="font-size: 0.6875rem; color: var(--gray-400); display: block; margin-bottom: 0.25rem;">Catégorie</label>
                            <span style="font-size: 0.8125rem; color: var(--gray-700); font-weight: 500;">{{ $previewDocument->category->name ?? 'Non classé' }}</span>
                        </div>
                        <div>
                            <label style="font-size: 0.6875rem; color: var(--gray-400); display: block; margin-bottom: 0.25rem;">Ajouté le</label>
                            <span style="font-size: 0.8125rem; color: var(--gray-700); font-weight: 500;">{{ $previewDocument->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div>
                            <label style="font-size: 0.6875rem; color: var(--gray-400); display: block; margin-bottom: 0.25rem;">Description</label>
                            <p style="font-size: 0.8125rem; color: var(--gray-600); line-height: 1.5;">{{ $previewDocument->description ?: 'Aucune description fournie.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes modal-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endif
</div>

@push('scripts')
<script>
function docManager() {
    return {
        modals: { document: false, delete: false },
        modalAction: 'create',
        sourceType: 'file',
        isUploading: false,
        uploadProgress: 0,
        selectedFile: null,
        selectedVideoFile: null,
        selectedVideoFilePreview: null,
        form: {
            id: null, title: '', description: '', category_id: '', file_type: '',
            file: null, video_url: '', videoSource: 'url', embed_url: '',
            is_published: true, allow_download: true,
            existing_file_name: null, existing_file_size: null, existing_video_url: null
        },
        showNewCategory: false,
        newCategoryName: '',
        deleteType: null,
        deleteId: null,
        deleteItemTitle: '',
        errors: {},
        loading: false,
        toasts: [],
        
        init() {
            this.$nextTick(() => {
                window.addEventListener('toast', event => {
                    this.addToast(event.detail.type, event.detail.title, event.detail.message);
                });
                Livewire.on('document-loaded', (data) => this.handleDocumentLoaded(data));
            });
        },
        
        handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) {
                this.selectedFile = file;
                this.form.file = file;
                const ext = file.name.split('.').pop().toLowerCase();
                const map = { pdf:'pdf', doc:'word', docx:'word', xls:'spreadsheet', xlsx:'spreadsheet', ppt:'ppt', pptx:'ppt', jpg:'jpg', jpeg:'jpg', png:'jpg' };
                if (map[ext]) this.form.file_type = map[ext];
            }
        },
        
        handleVideoFileSelect(e) {
            const file = e.target.files[0];
            if (file) {
                this.selectedVideoFile = file;
                this.selectedVideoFilePreview = URL.createObjectURL(file);
                this.form.file_type = 'mp4';
            }
        },
        
        removeSelectedFile() {
            this.selectedFile = null;
            this.form.file = null;
            if (this.$refs.fileInput) this.$refs.fileInput.value = '';
        },
        
        removeSelectedVideoFile() {
            if (this.selectedVideoFilePreview) URL.revokeObjectURL(this.selectedVideoFilePreview);
            this.selectedVideoFile = null;
            this.selectedVideoFilePreview = null;
            this.$wire.set('videoUpload', null);
            if (this.$refs.videoFileInput) this.$refs.videoFileInput.value = '';
        },
        
        resetFileInputs() {
            this.removeSelectedFile();
            this.removeSelectedVideoFile();
            this.form.video_url = '';
            this.form.embed_url = '';
            this.form.videoSource = 'url';
        },
        
        resetVideoInputs() {
            if (this.form.videoSource === 'url') this.removeSelectedVideoFile();
            else this.form.video_url = '';
        },
        
        openModal(action, id = null) {
            this.modalAction = action;
            this.sourceType = 'file';
            this.errors = {};
            this.resetFileInputs();
            if (action === 'create') {
                this.resetForm();
                this.modals.document = true;
            } else if (action === 'edit' && id) this.loadDocument(id);
        },
        
        closeModal(modal) {
            this.modals[modal] = false;
            if (modal === 'document') this.resetForm();
        },
        
        async loadDocument(id) {
            this.loading = true;
            try {
                const doc = await this.$wire.getDocument(id);
                this.handleDocumentLoaded({ doc });
            } catch(e) { this.addToast('error', 'Erreur', 'Chargement impossible'); }
            finally { this.loading = false; }
        },
        
        handleDocumentLoaded(data) {
            const doc = data.doc;
            this.form = {
                id: doc.id, title: doc.title, description: doc.description || '',
                category_id: doc.category_id, file_type: doc.type || doc.file_extension,
                file: null, video_url: doc.video_url || '', videoSource: doc.video_url ? 'url' : (doc.file_extension === 'mp4' ? 'file' : 'url'),
                embed_url: doc.embed_url || '', is_published: doc.is_published, allow_download: doc.allow_download,
                existing_file_name: doc.file_name, existing_file_size: doc.file_size, existing_video_url: doc.file_path || null
            };
            if (doc.type === 'video' || doc.file_extension === 'mp4') this.sourceType = 'video';
            else if (doc.embed_url && doc.type === 'link') this.sourceType = 'embed';
            else this.sourceType = 'file';
            this.modals.document = true;
        },
        
        async submitForm() {
            this.loading = true;
            this.errors = {};
            if (!this.form.title) this.errors.title = 'Titre requis';
            if (!this.form.category_id) this.errors.category_id = 'Catégorie requise';
            if (this.sourceType === 'file' && !this.selectedFile && this.modalAction === 'create' && !this.form.existing_file_name)
                this.errors.file = 'Fichier requis';
            if (this.sourceType === 'video' && this.form.videoSource === 'url' && !this.form.video_url)
                this.errors.video_url = 'URL requise';
            if (this.sourceType === 'video' && this.form.videoSource === 'file' && !this.selectedVideoFile && this.modalAction === 'create' && !this.form.existing_file_name)
                this.errors.video_file = 'Vidéo requise';
            if (this.sourceType === 'embed' && !this.form.embed_url)
                this.errors.embed_url = 'URL requise';
            if (Object.keys(this.errors).length > 0) { this.loading = false; return; }
            
            const data = { ...this.form, sourceType: this.sourceType };
            
            try {
                // Upload de fichier avec les bons callbacks: (property, file, onSuccess, onError, onProgress)
                if (this.sourceType === 'file' && this.selectedFile) {
                    this.isUploading = true;
                    await new Promise((resolve, reject) => {
                        this.$wire.upload('fileUpload', this.selectedFile,
                            () => { this.isUploading = false; resolve(); },          // onSuccess
                            (error) => { this.isUploading = false; reject(error); }, // onError
                            (event) => { this.uploadProgress = event.detail.progress; } // onProgress
                        );
                    });
                }
                if (this.sourceType === 'video' && this.form.videoSource === 'file' && this.selectedVideoFile) {
                    this.isUploading = true;
                    await new Promise((resolve, reject) => {
                        this.$wire.upload('videoUpload', this.selectedVideoFile,
                            () => { this.isUploading = false; resolve(); },          // onSuccess
                            (error) => { this.isUploading = false; reject(error); }, // onError
                            (event) => { this.uploadProgress = event.detail.progress; } // onProgress
                        );
                    });
                }
                
                if (this.modalAction === 'create') await this.$wire.createDocument(data);
                else await this.$wire.updateDocument(data);
                
                this.closeModal('document');
            } catch(e) {
                console.error('Upload/Submit error:', e);
                this.addToast('error', 'Erreur', 'Une erreur est survenue lors de l\'envoi');
            } finally {
                this.loading = false;
                this.isUploading = false;
            }
        },
        
        openDeleteModal(type, id = null, title = '') {
            this.deleteType = type;
            this.modals.delete = true;
            if (type === 'single') { this.deleteId = id; this.deleteItemTitle = title; }
        },
        
        async confirmDelete() {
            this.loading = true;
            try {
                if (this.deleteType === 'bulk') await this.$wire.deleteSelected();
                else await this.$wire.deleteDocument(this.deleteId);
                this.closeModal('delete');
                this.addToast('success', 'Succès', 'Document(s) supprimé(s)');
            } catch(e) { this.addToast('error', 'Erreur', 'Suppression impossible'); }
            finally { this.loading = false; }
        },
        
        resetForm() {
            this.form = { id: null, title: '', description: '', category_id: '', file_type: '', file: null, video_url: '', videoSource: 'url', embed_url: '', is_published: false, allow_download: true, existing_file_name: null, existing_file_size: null, existing_video_url: null };
            this.errors = {};
            this.sourceType = 'file';
            this.resetFileInputs();
        },
        
        onFileTypeChange() { if (this.form.file_type === 'mp4') { this.sourceType = 'video'; this.form.videoSource = 'file'; } },
        
        async saveNewCategory() {
            if (!this.newCategoryName.trim()) return;
            await this.$wire.set('newCategoryName', this.newCategoryName.trim());
            const newId = await this.$wire.addCategory();
            if (newId) { this.form.category_id = String(newId); this.addToast('success', 'Succès', 'Catégorie ajoutée'); }
            this.showNewCategory = false;
            this.newCategoryName = '';
        },
        
        addToast(type, title, message) {
            const id = Date.now() + Math.random();
            this.toasts.push({ id, type, title, message });
            setTimeout(() => this.removeToast(id), 5000);
        },
        
        removeToast(id) { this.toasts = this.toasts.filter(t => t.id !== id); },
        formatNumber(num) { return new Intl.NumberFormat('fr-FR').format(num); },
        formatFileSize(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024, sizes = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    }
}
</script>
<style>
@keyframes spin { to { transform: rotate(360deg); } }
[x-cloak] { display: none !important; }
</style>
@endpush