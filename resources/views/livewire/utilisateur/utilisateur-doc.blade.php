<div class="documentation-page" x-data="docDocManager()" x-init="init()" x-cloak>
    <!-- Toast Notifications -->
    <div style="position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 10000; display: flex; flex-direction: column; gap: 0.75rem; pointer-events: none;">
        <template x-for="toast in toasts" :key="toast.id">
            <div class="toast-notification"
                 :style="{ borderLeftColor: toast.type === 'success' ? 'var(--success)' : (toast.type === 'error' ? 'var(--danger)' : 'var(--primary)') }">
                <div :style="{ color: toast.type === 'success' ? 'var(--success)' : (toast.type === 'error' ? 'var(--danger)' : 'var(--primary)') }" class="toast-icon">
                    <i class="fas" :class="toast.type === 'success' ? 'fa-check-circle' : (toast.type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle')"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title" x-text="toast.title"></div>
                    <div class="toast-message" x-text="toast.message"></div>
                </div>
                <button @click="removeToast(toast.id)" class="toast-close"><i class="fas fa-times"></i></button>
                <div class="toast-progress"><div class="toast-progress-bar"></div></div>
            </div>
        </template>
    </div>

    <!-- Hero Section -->
    <div class="doc-hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">Explorez notre bibliothèque de connaissances</h1>
                    <p class="hero-subtitle">Des guides pratiques aux procédures détaillées, tout ce dont vous avez besoin pour exceller dans votre travail.</p>
                    <div class="hero-search">
                        <div class="search-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" placeholder="Rechercher un document..." wire:model.live.debounce.300ms="search">
                            @if($search)
                                <button class="search-clear" wire:click="clearSearch"><i class="fas fa-times"></i></button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="hero-illustration">
                    <div class="illustration-grid">
                        <div class="grid-item"><i class="fas fa-file-alt"></i><span>Guides</span></div>
                        <div class="grid-item"><i class="fas fa-play-circle"></i><span>Tutoriels</span></div>
                        <div class="grid-item"><i class="fas fa-bookmark"></i><span>Références</span></div>
                        <div class="grid-item"><i class="fas fa-shield-alt"></i><span>Sécurité</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="doc-stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item"><div class="stat-number">{{ $stats['total'] ?? 0 }}</div><div class="stat-label">Documents</div><div class="stat-description">Ressources à disposition</div></div>
                <div class="stat-item"><div class="stat-number">{{ $stats['viewed'] ?? 0 }}</div><div class="stat-label">Consultations</div><div class="stat-description">Connaissances partagées</div></div>
                <div class="stat-item"><div class="stat-number">{{ $stats['downloaded'] ?? 0 }}</div><div class="stat-label">Téléchargements</div><div class="stat-description">Ressources sauvegardées</div></div>
                <div class="stat-item"><div class="stat-number">{{ $stats['favorites'] ?? 0 }}</div><div class="stat-label">Favoris</div><div class="stat-description">Documents préférés</div></div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="doc-features-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Pourquoi notre documentation ?</h2>
                <p class="section-subtitle">Une documentation conçue pour vous accompagner à chaque étape</p>
            </div>
            <div class="features-grid">
                <div class="feature-card"><div class="feature-icon"><i class="fas fa-bolt"></i></div><h3 class="feature-title">Rapide</h3><p class="feature-description">Trouvez rapidement les informations grâce à notre système de recherche intelligent.</p></div>
                <div class="feature-card"><div class="feature-icon"><i class="fas fa-mobile-alt"></i></div><h3 class="feature-title">Accessible</h3><p class="feature-description">Accédez à la documentation depuis n'importe quel appareil, à tout moment.</p></div>
                <div class="feature-card"><div class="feature-icon"><i class="fas fa-layer-group"></i></div><h3 class="feature-title">Complet</h3><p class="feature-description">Une collection exhaustive de guides et tutoriels pour tous vos besoins.</p></div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="doc-categories-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Explorez par catégorie</h2>
                <p class="section-subtitle">Naviguez à travers nos différentes catégories de documentation</p>
            </div>
            <div class="categories-grid">
                @foreach($categories as $category)
                    @if(isset($category['slug']) && $category['slug'] !== 'all')
                        <div class="category-card-wrapper">
                            <div class="category-card" wire:click="filterByCategory('{{ $category['slug'] }}')">
                                <div class="category-card-inner">
                                    <div class="category-icon">
                                        @switch($category['slug'] ?? 'guides')
                                            @case('guides') <i class="fas fa-book"></i> @break
                                            @case('tutorials') <i class="fas fa-play-circle"></i> @break
                                            @case('references') <i class="fas fa-bookmark"></i> @break
                                            @case('faq') <i class="fas fa-question-circle"></i> @break
                                            @case('security') <i class="fas fa-shield-alt"></i> @break
                                            @default <i class="fas fa-file-alt"></i>
                                        @endswitch
                                    </div>
                                    <h4 class="category-name">{{ $category['name'] ?? 'Catégorie' }}</h4>
                                    <p class="category-count">{{ $category['count'] ?? 0 }} documents</p>
                                </div>
                                <div class="category-hover"><span>Explorer</span><i class="fas fa-arrow-right"></i></div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- All Documents -->
    <div class="all-documents-section">
        <div class="container">
            <div class="section-header">
                <div class="header-flex">
                    <div>
                        <h2 class="section-title">Tous les documents</h2>
                        <p class="section-subtitle">{{ $paginatedDocuments->total() }} documents disponibles</p>
                    </div>
                    <div class="document-controls">
                        <div class="view-switcher">
                            <button class="btn {{ $viewMode === 'grid' ? 'btn-primary' : 'btn-light' }}" wire:click="$set('viewMode', 'grid')"><i class="fas fa-th-large"></i> Grille</button>
                            <button class="btn {{ $viewMode === 'list' ? 'btn-primary' : 'btn-light' }}" wire:click="$set('viewMode', 'list')"><i class="fas fa-list"></i> Liste</button>
                        </div>
                        <select class="form-select" wire:model.live="sortBy">
                            <option value="date_desc">Plus récents</option>
                            <option value="date_asc">Plus anciens</option>
                            <option value="title">Titre A-Z</option>
                            <option value="views">Plus consultés</option>
                            <option value="downloads">Plus téléchargés</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filters Bar -->
            <div class="filters-bar">
                <div class="filters-row">
                    <div class="filter-tags">
                        @if(isset($documentTypes))
                            @foreach($documentTypes as $type)
                                @php $typeId = $type['id'] ?? $type; $typeName = $type['name'] ?? ucfirst($type); $typeIcon = $type['icon'] ?? 'file-alt'; @endphp
                                <label class="filter-tag {{ isset($selectedTypes[$typeId]) && $selectedTypes[$typeId] ? 'active' : '' }}">
                                    <input type="checkbox" wire:model.live="selectedTypes.{{ $typeId }}" class="d-none">
                                    <i class="fas fa-{{ $typeIcon }}"></i>
                                    <span>{{ $typeName }}</span>
                                </label>
                            @endforeach
                        @endif
                        @if(isset($selectedTypes) && count(array_filter($selectedTypes)) > 0)
                            <button class="filter-clear" wire:click="$set('selectedTypes', [])"><i class="fas fa-times"></i> Effacer</button>
                        @endif
                    </div>
                    <div class="filter-actions">
                        @if($search || (isset($activeCategory) && $activeCategory !== 'all') || (isset($selectedTypes) && count(array_filter($selectedTypes)) > 0))
                            <button class="btn-reset" wire:click="resetFilters"><i class="fas fa-redo"></i> Réinitialiser</button>
                        @endif
                    </div>
                </div>
            </div>

            @if($paginatedDocuments->count() > 0)
                @if($viewMode === 'grid')
                    <div class="documents-grid">
                        @foreach($paginatedDocuments as $document)
                            @php
                                $documentId = $document->id;
                                $documentTitle = $document->title ?? 'Sans titre';
                                $documentDescription = $document->description ?? '';
                                $documentType = $document->type ?? 'guide';
                                $categoryName = $document->category->name ?? 'Général';
                                $typeIcon = $this->getTypeIcon($documentType);
                                $typeName = ucfirst($documentType);
                                $fileName = $document->file_name ?? $documentTitle;
                                $fileSize = $document->getFormattedFileSize() ?: 'Document';
                                $fileExtension = $document->file_name ? strtolower(pathinfo($document->file_name, PATHINFO_EXTENSION)) : 'doc';
                                $fileIcon = match($fileExtension) { 'pdf' => 'fa-file-pdf', 'jpg','jpeg','png' => 'fa-file-image', 'mp4' => 'fa-file-video', 'doc','docx' => 'fa-file-word', 'xls','xlsx' => 'fa-file-excel', default => 'fa-file-alt' };
                                $isFavorite = false;
                                if (Auth::check() && method_exists($document, 'favorites') && $document->favorites) { $isFavorite = $document->favorites->where('user_id', Auth::id())->isNotEmpty(); }
                            @endphp
                            <div class="document-card">
                                <div class="card-header">
                                    <div class="card-badges">
                                        <span class="badge-category">{{ $categoryName }}</span>
                                        <span class="badge-type"><i class="fas fa-{{ $typeIcon }}"></i>{{ $typeName }}</span>
                                    </div>
                                    <button class="card-favorite" wire:click="toggleFavorite({{ $documentId }})"><i class="fas {{ $isFavorite ? 'fa-heart' : 'fa-heart-o' }}"></i></button>
                                </div>
                                <div class="card-body" wire:click="viewContent({{ $documentId }})">
                                    <h3 class="card-title">@if($search) {!! preg_replace('/(' . preg_quote($search, '/') . ')/i', '<span class="highlight">$1</span>', $documentTitle) !!} @else {{ $documentTitle }} @endif</h3>
                                    <p class="card-description">{{ Str::limit($documentDescription, 120) }}</p>
                                    <div class="file-preview">
                                        <div class="file-icon-box"><i class="fas {{ $fileIcon }}"></i></div>
                                        <div class="file-details">
                                            <div class="file-primary-info">
                                                <span class="file-name-text">{{ $fileName }}</span>
                                                <span class="file-ext-badge">{{ $fileExtension }}</span>
                                            </div>
                                            <span class="file-size-text">{{ $fileSize }}</span>
                                        </div>
                                    </div>
                                    <div class="card-meta">
                                        <span><i class="fas fa-user"></i> {{ $authorName ?? 'Admin' }}</span>
                                        <span><i class="fas fa-calendar"></i> {{ isset($document->created_at) ? \Carbon\Carbon::parse($document->created_at)->format('d/m/Y') : 'Récent' }}</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn-outline" wire:click.stop="downloadDocument({{ $documentId }})"><i class="fas fa-download"></i> Télécharger</button>
                                    <button class="btn-primary-custom" wire:click="viewContent({{ $documentId }})"><i class="fas fa-eye"></i> Voir</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="documents-list">
                        <div class="list-header">
                            <div class="col-document">Document</div>
                            <div class="col-category">Catégorie</div>
                            <div class="col-type">Type</div>
                            <div class="col-author">Auteur</div>
                            <div class="col-actions">Actions</div>
                        </div>
                        @foreach($paginatedDocuments as $document)
                            @php
                                $typeIcon = $this->getTypeIcon($document->type ?? 'file');
                                $documentId = $document->id;
                                $isFavorite = false;
                                if (Auth::check() && method_exists($document, 'favorites') && $document->favorites) { $isFavorite = $document->favorites->where('user_id', Auth::id())->isNotEmpty(); }
                            @endphp
                            <div class="list-item">
                                <div class="col-document">
                                    <div class="list-icon-box"><i class="fas fa-{{ $typeIcon }}"></i></div>
                                    <div>
                                        <h4 class="list-title">{{ $document->title }}</h4>
                                        <small>{{ $document->getFormattedFileSize() }} • {{ $document->file_extension }}</small>
                                    </div>
                                </div>
                                <div class="col-category"><span class="list-badge">{{ $document->category->name ?? 'Général' }}</span></div>
                                <div class="col-type">{{ ucfirst($document->type) }}</div>
                                <div class="col-author">{{ $document->user->name ?? 'Admin' }}</div>
                                <div class="col-actions">
                                    <button class="action-btn view" wire:click="viewContent({{ $documentId }})" title="Visualiser"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn favorite" wire:click.stop="toggleFavorite({{ $documentId }})" title="Favoris"><i class="fas {{ $isFavorite ? 'fa-heart' : 'fa-heart-o' }}"></i></button>
                                    <button class="action-btn download" wire:click.stop="downloadDocument({{ $documentId }})" title="Télécharger"><i class="fas fa-download"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($paginatedDocuments->hasPages())
                    <div class="pagination-wrapper">{{ $paginatedDocuments->links('vendor.livewire.bootstrap') }}</div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-search"></i></div>
                    <h3 class="empty-title">Aucun document trouvé</h3>
                    <p class="empty-text">@if($search || (isset($activeCategory) && $activeCategory !== 'all') || (isset($selectedTypes) && count(array_filter($selectedTypes)) > 0)) Aucun document ne correspond à vos critères. @else La bibliothèque est vide pour le moment. @endif</p>
                    @if($search || (isset($activeCategory) && $activeCategory !== 'all') || (isset($selectedTypes) && count(array_filter($selectedTypes)) > 0))<button class="btn-primary-custom" wire:click="resetFilters"><i class="fas fa-redo"></i> Réinitialiser</button>@endif
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Preview -->
    @if(isset($selectedContent) && $selectedContent)
    <div class="modal-preview" x-data="{ isFullscreen: false }" x-on:keydown.escape.window="isFullscreen ? isFullscreen = false : $wire.closeContent()">
        <div class="modal-overlay" wire:click="closeContent"></div>
        <div class="modal-container" :class="{ 'fullscreen': isFullscreen }">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="modal-icon"><i class="fas fa-file-alt"></i></div>
                    <div>
                        <h3>{{ $selectedContent->title }}</h3>
                        <div class="modal-meta">
                            <span class="file-ext">{{ $selectedContent->file_extension }}</span>
                            <span>{{ $selectedContent->getFormattedFileSize() }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-actions">
                    <button class="icon-btn" wire:click="toggleFavorite({{ $selectedContent->id }})"><i class="fas {{ $selectedContent->is_favorite ?? false ? 'fa-heart' : 'fa-heart-o' }}"></i></button>
                    @if($selectedContent->allow_download !== false)<a href="{{ route('admin.documents.stream', $selectedContent->id) }}?download=1" class="btn-download"><i class="fas fa-download"></i> Télécharger</a>@endif
                    <button class="icon-btn" x-on:click="isFullscreen = !isFullscreen"><i class="fas" :class="isFullscreen ? 'fa-compress' : 'fa-expand'"></i></button>
                    <button class="icon-btn close" wire:click="closeContent"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="modal-body">
                <x-document-preview :document="$selectedContent" />
                @if($selectedContent->content)
                <div class="description-section">
                    <h4>Description détaillée</h4>
                    <div class="content-wrapper">{!! $selectedContent->content !!}</div>
                </div>
                @endif
            </div>
            <div class="modal-sidebar">
                <h4>Détails du document</h4>
                <div class="detail-item"><label>Catégorie</label><span>{{ $selectedContent->category->name ?? 'Général' }}</span></div>
                <div class="detail-item"><label>Auteur</label><span>{{ $selectedContent->user->name ?? 'Admin' }}</span></div>
                <div class="detail-item"><label>Publié le</label><span>{{ $selectedContent->created_at->format('d/m/Y') }}</span></div>
                <hr>
                <div class="stats-box"><h5>Statistiques</h5><div class="stats-grid-mini"><div class="stat-mini"><div class="stat-value">{{ $selectedContent->views ?? 0 }}</div><div class="stat-label">Vues</div></div><div class="stat-mini"><div class="stat-value">{{ $selectedContent->downloads ?? 0 }}</div><div class="stat-label">Downloads</div></div></div></div>
            </div>
        </div>
    </div>
    @endif

    <style>
        :root { 
            --primary: #5BC4BF; 
            --primary-dark: #3A9692; 
            --primary-light: #8CD6D3; 
            --primary-lightest: #F0F9F8; 
            --orange: #e65e4b;
            --orange-light: #f59e0b;
            --success: #10b981; 
            --danger: #ef4444; 
            --warning: #f59e0b; 
            --gray-50: #f9fafb; 
            --gray-100: #f3f4f6; 
            --gray-200: #e5e7eb; 
            --gray-300: #d1d5db; 
            --gray-400: #9ca3af; 
            --gray-500: #6b7280; 
            --gray-600: #4b5563; 
            --gray-700: #374151; 
            --gray-800: #1f2937; 
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); 
            --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1); 
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            --radius: 16px; 
            --radius-sm: 12px; 
            --radius-lg: 24px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        .documentation-page { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
            background: #f8fafc; 
            color: var(--gray-800); 
            font-size: 14px;
            line-height: 1.5;
            min-height: 100vh;
        }
        
        .container { max-width: 1400px; margin: 0 auto; padding: 0 24px; }
        @media (max-width: 768px) { .container { padding: 0 16px; } }
        
        /* Hero Section */
        .doc-hero-section { 
            background: linear-gradient(135deg, #41babcff 0%, #5BC4BF  100%); 
            padding: 80px 0; 
            margin-bottom: 48px; 
            position: relative;
            overflow: hidden;
        }

        .doc-hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 40%;
            height: 200%;
            background: radial-gradient(circle, rgba(91, 196, 191, 0.15) 0%, transparent 70%);
            transform: rotate(-15deg);
        }
        
        .hero-content { display: flex; align-items: center; justify-content: space-between; gap: 48px; flex-wrap: wrap; position: relative; z-index: 1; }
        .hero-text { flex: 1; min-width: 280px; }
        .hero-title { font-size: 2.8rem; font-weight: 800; color: white; margin-bottom: 16px; line-height: 1.2; letter-spacing: -0.02em; }
        .hero-subtitle { font-size: 1.1rem; color: rgba(255,255,255,0.9); margin-bottom: 28px; line-height: 1.5; }
        
        .search-wrapper { position: relative; max-width: 400px; }
        .search-input { width: 100%; padding: 10px 16px 10px 40px; border: none; border-radius: 40px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: white; font-size: 0.9rem; border: 1px solid rgba(255,255,255,0.25); transition: all 0.3s ease; }
        .search-input:focus { outline: none; background: rgba(255,255,255,0.25); border-color: rgba(255,255,255,0.5); }
        .search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.7); font-size: 0.9rem; }
        
        .illustration-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; max-width: 260px; margin: 0 auto; }
        .grid-item { background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.25); border-radius: 16px; padding: 16px; text-align: center; color: white; transition: all 0.3s ease; cursor: pointer; }
        .grid-item:hover { transform: translateY(-4px); background: rgba(255,255,255,0.2); }
        .grid-item i { font-size: 1.4rem; margin-bottom: 8px; display: block; }
        .grid-item span { font-size: 0.8rem; display: block; font-weight: 500; }
        
        /* Stats Section */
        .doc-stats-section { margin-bottom: 48px; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; background: white; border-radius: var(--radius); padding: 32px 28px; box-shadow: var(--shadow-lg); margin-top: -40px; position: relative; border: 1px solid var(--gray-200); }
        @media (max-width: 768px) { .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 24px; } }
        @media (max-width: 480px) { .stats-grid { grid-template-columns: 1fr; } }
        .stat-item { text-align: center; padding: 4px; }
        
        /* Nombre en orange */
        .stat-number { 
            font-size: 2rem; 
            font-weight: 800; 
            color: #2c9e33ff; 
            margin-bottom: 6px; 
            letter-spacing: -0.02em; 
        }
        
        .stat-label { font-weight: 600; color: var(--gray-700); margin-bottom: 4px; font-size: 0.9rem; }
        .stat-description { font-size: 0.75rem; color: var(--gray-400); }
        
        /* Features Section */
        .doc-features-section { margin-bottom: 60px; }
        .section-header { text-align: center; margin-bottom: 40px; }
        .section-title { font-size: 1.8rem; font-weight: 700; margin-bottom: 12px; letter-spacing: -0.02em; }
        .section-subtitle { font-size: 0.9rem; color: var(--gray-500); max-width: 550px; margin: 0 auto; line-height: 1.5; }
        
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 60px; }
        @media (max-width: 768px) { .features-grid { grid-template-columns: 1fr; gap: 20px; } }
        
        .feature-card { background: white; border-radius: var(--radius-sm); padding: 28px 24px; text-align: center; border: 1px solid var(--gray-200); transition: all 0.3s ease; }
        .feature-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: var(--primary-light); }
        .feature-icon { width: 56px; height: 56px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; }
        .feature-icon i { font-size: 1.4rem; color: white; }
        .feature-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 12px; }
        .feature-description { font-size: 0.8rem; color: var(--gray-500); line-height: 1.5; }
        
        /* Categories Section */
        .doc-categories-section { margin-bottom: 60px; }
        .categories-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-bottom: 60px; }
        
        .category-card-wrapper { cursor: pointer; }
        .category-card { background: white; border-radius: var(--radius-sm); border: 1px solid var(--gray-200); text-align: center; padding: 32px 20px; position: relative; overflow: hidden; transition: all 0.3s ease; }
        .category-card:hover { transform: translateY(-4px); border-color: var(--primary); box-shadow: var(--shadow-md); }
        .category-icon { width: 52px; height: 52px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
        .category-icon i { font-size: 1.3rem; color: white; }
        .category-name { font-size: 0.95rem; font-weight: 700; margin-bottom: 6px; }
        .category-count { font-size: 0.7rem; color: var(--gray-400); font-weight: 500; }
        .category-hover { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); padding: 10px; color: white; font-size: 0.75rem; font-weight: 600; transform: translateY(100%); transition: transform 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 6px; }
        .category-card:hover .category-hover { transform: translateY(0); }
        
        /* Documents Section */
        .all-documents-section { margin-bottom: 60px; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 32px; }
        
        .document-controls { display: flex; gap: 12px; align-items: center; }
        .view-switcher { background: var(--gray-100); border-radius: 40px; padding: 4px; display: flex; gap: 3px; }
        .view-switcher .btn { padding: 7px 16px; font-size: 0.8rem; font-weight: 600; border-radius: 40px; border: none; background: transparent; cursor: pointer; transition: all 0.2s ease; }
        .view-switcher .btn-primary { background: white; color: var(--primary); box-shadow: var(--shadow-sm); }
        .view-switcher .btn-light { background: transparent; color: var(--gray-500); }
        
        .form-select { padding: 7px 32px 7px 14px; border-radius: 40px; border: 1px solid var(--gray-200); background: white; font-size: 0.8rem; cursor: pointer; font-weight: 500; color: var(--gray-700); }
        .form-select:focus { outline: none; border-color: var(--primary); }
        
        .filters-bar { background: white; border-radius: var(--radius-sm); padding: 18px 24px; margin-bottom: 32px; border: 1px solid var(--gray-200); }
        .filters-row { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; }
        .filter-tags { display: flex; flex-wrap: wrap; gap: 10px; }
        .filter-tag { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; background: var(--gray-100); border-radius: 40px; font-size: 0.75rem; font-weight: 500; cursor: pointer; transition: all 0.2s ease; }
        .filter-tag:hover { background: var(--gray-200); }
        .filter-tag.active { background: var(--primary); color: white; }
        .filter-clear, .btn-reset { background: transparent; border: none; color: var(--danger); font-size: 0.75rem; font-weight: 500; cursor: pointer; padding: 6px 12px; transition: all 0.2s ease; border-radius: 40px; }
        
        /* Documents Grid */
        .documents-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; margin-bottom: 48px; }
        
        .document-card { background: white; border-radius: var(--radius-sm); border: 1px solid var(--gray-200); overflow: hidden; transition: all 0.3s ease; }
        .document-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: var(--primary-light); }
        
        .card-header { padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--gray-100); }
        .card-badges { display: flex; gap: 8px; }
        .badge-category { padding: 4px 10px; background: var(--primary-lightest); color: var(--primary-dark); border-radius: 20px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px; }
        .badge-type { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; background: var(--gray-100); border-radius: 20px; font-size: 0.65rem; font-weight: 600; }
        .card-favorite { background: transparent; border: none; cursor: pointer; color: var(--gray-400); font-size: 0.9rem; transition: all 0.2s ease; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .card-favorite:hover { background: var(--gray-100); }
        .card-favorite .fa-heart { color: var(--danger); }
        
        .card-body { padding: 20px; cursor: pointer; }
        .card-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 10px; line-height: 1.4; }
        .card-description { font-size: 0.75rem; color: var(--gray-500); line-height: 1.5; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        
        .file-preview { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--gray-50); border-radius: 12px; margin-bottom: 16px; }
        .file-icon-box { width: 40px; height: 40px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1rem; }
        .file-details { flex: 1; }
        .file-primary-info { display: flex; align-items: center; gap: 8px; margin-bottom: 4px; flex-wrap: wrap; }
        .file-name-text { font-size: 0.75rem; font-weight: 600; color: var(--gray-700); }
        .file-ext-badge { font-size: 0.55rem; padding: 2px 6px; background: var(--gray-200); border-radius: 4px; font-weight: 600; text-transform: uppercase; }
        .file-size-text { font-size: 0.6rem; color: var(--gray-400); font-weight: 500; }
        
        .card-meta { display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid var(--gray-100); font-size: 0.65rem; color: var(--gray-400); }
        .card-meta i { margin-right: 4px; width: 12px; }
        
        .card-footer { padding: 12px 20px 20px; display: flex; gap: 12px; border-top: 1px solid var(--gray-100); background: var(--gray-50); }
        .btn-outline, .btn-primary-custom { flex: 1; padding: 8px 12px; border-radius: 8px; font-size: 0.7rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease; border: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; }
        .btn-outline { background: white; border: 1px solid var(--gray-300); color: var(--gray-700); }
        .btn-outline:hover { border-color: var(--primary); color: var(--primary); }
        .btn-primary-custom { background: var(--orange); color: white; border-radius: 12px; }
        .btn-primary-custom:hover { background: #d45241; transform: scale(1.05); box-shadow: 0 5px 15px rgba(230, 94, 75, 0.4); }
        
        /* List View */
        .documents-list { background: white; border-radius: var(--radius-sm); border: 1px solid var(--gray-200); overflow: hidden; margin-bottom: 48px; }
        .list-header { display: grid; grid-template-columns: 3fr 1.5fr 1fr 1.5fr 1.2fr; padding: 14px 20px; background: var(--gray-50); border-bottom: 1px solid var(--gray-200); font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--gray-500); }
        .list-item { display: grid; grid-template-columns: 3fr 1.5fr 1fr 1.5fr 1.2fr; padding: 14px 20px; border-bottom: 1px solid var(--gray-100); transition: all 0.2s ease; align-items: center; }
        .list-item:hover { background: var(--gray-50); }
        .col-document { display: flex; align-items: center; gap: 12px; }
        .list-icon-box { width: 36px; height: 36px; background: var(--primary-lightest); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 0.9rem; }
        .list-title { font-size: 0.8rem; font-weight: 600; margin-bottom: 3px; }
        .list-title + small { font-size: 0.6rem; color: var(--gray-400); }
        .list-badge { display: inline-block; padding: 4px 10px; background: var(--primary-lightest); color: var(--primary-dark); border-radius: 20px; font-size: 0.65rem; font-weight: 600; }
        .col-actions { display: flex; gap: 8px; justify-content: flex-start; }
        .action-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--gray-200); background: white; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem; }
        .action-btn:hover { transform: translateY(-2px); }
        .action-btn.view:hover { background: var(--primary); border-color: var(--primary); color: white; }
        .action-btn.favorite:hover { background: var(--danger); border-color: var(--danger); color: white; }
        .action-btn.download:hover { background: var(--success); border-color: var(--success); color: white; }
        
        /* Pagination */
        .pagination-wrapper { display: flex; justify-content: center; margin-top: 32px; }
        
        /* Empty State */
        .empty-state { text-align: center; padding: 60px 32px; background: white; border-radius: var(--radius-sm); border: 1px solid var(--gray-200); }
        .empty-icon { font-size: 3rem; color: var(--gray-300); margin-bottom: 20px; }
        .empty-title { font-size: 1rem; font-weight: 700; margin-bottom: 8px; }
        .empty-text { font-size: 0.75rem; color: var(--gray-500); margin-bottom: 20px; }
        
        /* Modal */
        .modal-preview { position: fixed; inset: 0; z-index: 10000; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(6px); }
        .modal-container { position: relative; background: white; border-radius: 24px; width: 100%; max-width: 1000px; max-height: 85vh; overflow: hidden; display: flex; flex-wrap: wrap; box-shadow: var(--shadow-lg); transition: all 0.3s ease; }
        .modal-container.fullscreen { position: fixed; inset: 0; max-width: 100%; max-height: 100%; border-radius: 0; }
        .modal-header { width: 100%; padding: 18px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--gray-200); background: white; }
        .modal-title { display: flex; align-items: center; gap: 14px; }
        .modal-icon { width: 42px; height: 42px; background: var(--primary-lightest); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1rem; }
        .modal-meta { display: flex; gap: 8px; margin-top: 4px; }
        .file-ext { padding: 2px 8px; background: var(--gray-100); border-radius: 4px; font-size: 0.6rem; font-weight: 600; }
        .modal-actions { display: flex; gap: 8px; }
        .btn-download { padding: 8px 16px; background: var(--primary); color: white; border-radius: 8px; text-decoration: none; font-size: 0.7rem; font-weight: 600; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 6px; }
        .modal-body { flex: 1; padding: 24px; overflow-y: auto; max-height: calc(85vh - 80px); }
        .modal-sidebar { width: 260px; padding: 24px; border-left: 1px solid var(--gray-200); background: var(--gray-50); }
        .detail-item { margin-bottom: 16px; }
        .detail-item label { font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--gray-400); display: block; margin-bottom: 5px; }
        .detail-item span { font-size: 0.8rem; font-weight: 600; color: var(--gray-800); }
        .stats-grid-mini { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 12px; }
        .stat-mini { text-align: center; padding: 12px; background: white; border-radius: 10px; }
        .stat-value { font-size: 1.2rem; font-weight: 800; color: var(--primary); }
        .description-section { margin-top: 24px; padding: 20px; background: var(--gray-50); border-radius: 14px; }
        .description-section h4 { font-size: 0.85rem; font-weight: 700; margin-bottom: 12px; }
        .highlight { background: var(--primary-lightest); color: var(--primary-dark); padding: 1px 4px; border-radius: 4px; font-weight: 600; }
        
        /* Toast */
        .toast-notification { background: white; border-radius: 12px; width: 320px; box-shadow: var(--shadow-lg); border-left: 3px solid; padding: 12px 16px; display: flex; gap: 12px; align-items: center; position: relative; animation: slideInRight 0.3s ease; pointer-events: auto; }
        .toast-icon { font-size: 1rem; flex-shrink: 0; }
        .toast-content { flex: 1; }
        .toast-title { font-weight: 700; font-size: 0.75rem; margin-bottom: 3px; }
        .toast-message { font-size: 0.65rem; color: var(--gray-500); }
        .toast-close { background: none; border: none; color: var(--gray-400); cursor: pointer; padding: 4px; font-size: 0.65rem; transition: all 0.2s ease; border-radius: 6px; }
        .toast-progress { position: absolute; bottom: 0; left: 0; height: 2px; background: rgba(0,0,0,0.05); width: 100%; border-radius: 0 0 12px 12px; overflow: hidden; }
        .toast-progress-bar { height: 100%; width: 0%; background: currentColor; animation: progress 5s linear forwards; }
        
        .icon-btn { width: 34px; height: 34px; border-radius: 8px; border: 1px solid var(--gray-200); background: white; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s ease; }
        
        hr { margin: 16px 0; border: none; border-top: 1px solid var(--gray-200); }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes progress {
            from { width: 0%; }
            to { width: 100%; }
        }
        
        @media (max-width: 768px) {
            .container { padding: 0 16px; }
            .hero-title { font-size: 2rem; }
            .hero-subtitle { font-size: 0.9rem; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; padding: 24px 20px; }
            .section-title { font-size: 1.4rem; }
            .list-header { display: none; }
            .list-item { grid-template-columns: 1fr; gap: 12px; }
            .modal-sidebar { width: 100%; border-left: none; border-top: 1px solid var(--gray-200); }
            .modal-container { flex-direction: column; }
            .col-actions { justify-content: flex-start; margin-top: 8px; }
            .documents-grid { grid-template-columns: 1fr; gap: 20px; }
            .features-grid { grid-template-columns: 1fr; gap: 16px; }
            .categories-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); }
            .toast-notification { width: calc(100vw - 32px); max-width: 320px; }
        }
        
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .hero-title { font-size: 1.6rem; }
            .card-header { flex-wrap: wrap; gap: 10px; }
            .filter-tags { justify-content: center; }
            .filters-row { flex-direction: column; align-items: stretch; }
        }
    </style>
</div>

@push('scripts')
<script>
function docDocManager() {
    return { 
        toasts: [], 
        init() { 
            window.addEventListener('toast', event => { 
                this.addToast(event.detail.type, event.detail.title, event.detail.message); 
            }); 
        }, 
        addToast(type, title, message) { 
            const id = Date.now() + Math.random(); 
            this.toasts.push({ id, type, title, message }); 
            setTimeout(() => this.removeToast(id), 5000); 
        }, 
        removeToast(id) { 
            this.toasts = this.toasts.filter(t => t.id !== id); 
        } 
    }
}
</script>
@endpush