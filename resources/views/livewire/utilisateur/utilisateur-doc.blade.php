<div class="documentation-page">
    <!-- Hero Section -->
    <div class="doc-hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">
                        Explorez notre bibliothèque de connaissances
                    </h1>
                    <p class="hero-subtitle">
                        Le moment est venu d'accéder à une documentation complète. 
                        Des guides pratiques aux procédures détaillées, tout ce dont vous avez besoin 
                        pour exceller dans votre travail.
                    </p>
                    <div class="hero-search">
                        <div class="search-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" 
                                   class="search-input" 
                                   placeholder="Rechercher un document, guide ou tutoriel..." 
                                   wire:model.live.debounce.300ms="search">
                            @if($search)
                                <button class="search-clear" wire:click="clearSearch">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-illustration">
                        <div class="illustration-grid">
                            <div class="grid-item grid-item-1">
                                <i class="fas fa-file-alt"></i>
                                <span>Guides</span>
                            </div>
                            <div class="grid-item grid-item-2">
                                <i class="fas fa-play-circle"></i>
                                <span>Tutoriels</span>
                            </div>
                            <div class="grid-item grid-item-3">
                                <i class="fas fa-bookmark"></i>
                                <span>Références</span>
                            </div>
                            <div class="grid-item grid-item-4">
                                <i class="fas fa-shield-alt"></i>
                                <span>Sécurité</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="doc-stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
                    <div class="stat-label">Documents</div>
                    <div class="stat-description">Ressources complètes à votre disposition</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['viewed'] ?? 0 }}</div>
                    <div class="stat-label">Consultations</div>
                    <div class="stat-description">Connaissances partagées</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['downloaded'] ?? 0 }}</div>
                    <div class="stat-label">Téléchargements</div>
                    <div class="stat-description">Ressources sauvegardées</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['favorites'] ?? 0 }}</div>
                    <div class="stat-label">Favoris</div>
                    <div class="stat-description">Documents préférés</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="doc-features-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Pourquoi notre documentation ?</h2>
                <p class="section-subtitle">
                    Une documentation conçue pour vous accompagner à chaque étape
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="feature-title">Rapide</h3>
                        <p class="feature-description">
                            Trouvez rapidement les informations dont vous avez besoin grâce à notre 
                            système de recherche intelligent et à notre organisation optimisée.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">Accessible</h3>
                        <p class="feature-description">
                            Accédez à la documentation depuis n'importe quel appareil, à tout moment. 
                            Une expérience fluide sur mobile, tablette et desktop.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3 class="feature-title">Complet</h3>
                        <p class="feature-description">
                            Une collection exhaustive de guides, tutoriels et références pour 
                            couvrir tous vos besoins professionnels.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="doc-categories-section">
        <div class="container">
            <div class="section-header mb-4">
                <h2 class="section-title">Explorez par catégorie</h2>
                <p class="section-subtitle">
                    Naviguez à travers nos différentes catégories de documentation
                </p>
            </div>

            <div class="categories-grid">
                @foreach($categories as $category)
                    @if(isset($category['slug']) && $category['slug'] !== 'all')
                        <div class="category-card-wrapper">
                            <div class="category-card" wire:click="filterByCategory('{{ $category['slug'] }}')">
                                <div class="category-card-inner">
                                    <div class="category-icon" style="background: var(--{{ $category['slug'] ?? 'guides' }}-gradient)">
                                        @switch($category['slug'] ?? 'guides')
                                            @case('guides') <i class="fas fa-book"></i> @break
                                            @case('tutorials') <i class="fas fa-play-circle"></i> @break
                                            @case('references') <i class="fas fa-bookmark"></i> @break
                                            @case('faq') <i class="fas fa-question-circle"></i> @break
                                            @case('security') <i class="fas fa-shield-alt"></i> @break
                                            @case('procedures') <i class="fas fa-list-check"></i> @break
                                            @default <i class="fas fa-file-alt"></i>
                                        @endswitch
                                    </div>
                                    <h4 class="category-name">{{ $category['name'] ?? 'Catégorie' }}</h4>
                                    <p class="category-count">{{ $category['count'] ?? 0 }} documents</p>
                                </div>
                                <div class="category-hover">
                                    <span>Explorer</span>
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Documents -->
    @if(isset($recentDocuments) && count($recentDocuments) > 0)
        <div class="recent-documents-section">
            <div class="container">
                <div class="section-header mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="section-title">Consultés récemment</h2>
                            <p class="section-subtitle">Retrouvez vos documents récents</p>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ count($recentDocuments) }}</span>
                    </div>
                </div>

                <div class="recent-documents-grid">
                    @foreach($recentDocuments as $document)
                        @php
                            $documentId = $document['id'] ?? ($document->id ?? 0);
                            $documentTitle = $document['title'] ?? ($document->title ?? 'Sans titre');
                            $documentDescription = $document['description'] ?? ($document->description ?? '');
                            $categorySlug = $document['category_slug'] ?? ($document->category->slug ?? 'general');
                            $categoryName = $document['category'] ?? ($document->category->name ?? 'Général');
                            $typeIcon = $document['type_icon'] ?? 'file-alt';
                            $typeColor = $document['type_color'] ?? 'primary';
                            $readingTime = $document['reading_time'] ?? ($document->reading_time ?? 0);
                            $views = $document['views'] ?? ($document->views ?? 0);
                            $downloads = $document['downloads'] ?? ($document->downloads ?? 0);
                            $fileName = $document['file_name'] ?? ($document->file_name ?? 'document');
                            $isFavorite = $document['is_favorite'] ?? false;
                            
                            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                            $fileIcon = 'fa-file-alt';
                            if (in_array($fileExtension, ['pdf'])) $fileIcon = 'fa-file-pdf';
                            elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'])) $fileIcon = 'fa-file-image';
                            elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv', 'flv'])) $fileIcon = 'fa-file-video';
                            elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg'])) $fileIcon = 'fa-file-audio';
                        @endphp
                        
                        <div class="recent-doc-card-wrapper">
                            <div class="recent-doc-card" wire:click="viewContent({{ $documentId }})">
                                <div class="doc-header">
                                    <div class="doc-badge" style="background: var(--{{ $categorySlug }}-color)">
                                        {{ $categoryName }}
                                    </div>
                                    <button class="doc-favorite" wire:click.stop="toggleFavorite({{ $documentId }})">
                                        <i class="fas {{ $isFavorite ? 'fa-heart text-danger' : 'fa-heart-o' }}"></i>
                                    </button>
                                </div>
                                <div class="doc-body">
                                    <div class="doc-type-icon" style="color: var(--{{ $typeColor }})">
                                        <i class="fas fa-{{ $typeIcon }}"></i>
                                    </div>
                                    <h4 class="doc-title">{{ $documentTitle }}</h4>
                                    <p class="doc-description">{{ Str::limit($documentDescription, 80) }}</p>
                                    
                                    <div class="file-mini-preview {{ $fileExtension }}-preview">
                                        <i class="fas {{ $fileIcon }}"></i>
                                        <span class="text-truncate">{{ $fileName }}</span>
                                    </div>
                                </div>
                                <div class="doc-footer">
                                    <div class="doc-meta">
                                        <span><i class="fas fa-clock me-1"></i> {{ $readingTime }} min</span>
                                        <span><i class="fas fa-eye me-1"></i> {{ $views }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- All Documents -->
    <div class="all-documents-section">
        <div class="container">
            <div class="section-header mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="section-title">Tous les documents</h2>
                        <p class="section-subtitle">{{ $paginatedDocuments->total() }} documents disponibles</p>
                    </div>
                    <div class="document-controls">
                        <div class="filter-dropdown">
                            <select class="form-select form-select-sm" wire:model.live="sortBy">
                                <option value="date_desc">Plus récents</option>
                                <option value="date_asc">Plus anciens</option>
                                <option value="title">Titre A-Z</option>
                                <option value="views">Plus consultés</option>
                                <option value="downloads">Plus téléchargés</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters Bar -->
            <div class="filters-bar mb-4">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="filter-tags">
                            @if(isset($documentTypes))
                                @foreach($documentTypes as $type)
                                    @php
                                        $typeId = $type['id'] ?? $type;
                                        $typeName = $type['name'] ?? ucfirst($type);
                                        $typeIcon = $type['icon'] ?? 'file-alt';
                                    @endphp
                                    <label class="filter-tag {{ isset($selectedTypes[$typeId]) && $selectedTypes[$typeId] ? 'active' : '' }}">
                                        <input type="checkbox" 
                                               wire:model.live="selectedTypes.{{ $typeId }}"
                                               class="d-none">
                                        <i class="fas fa-{{ $typeIcon }} me-2"></i>
                                        {{ $typeName }}
                                    </label>
                                @endforeach
                            @endif
                            @if(isset($selectedTypes) && count(array_filter($selectedTypes)) > 0)
                                <button class="filter-clear" wire:click="$set('selectedTypes', [])">
                                    <i class="fas fa-times"></i> Effacer
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        @if($search || (isset($activeCategory) && $activeCategory !== 'all') || (isset($selectedTypes) && count(array_filter($selectedTypes)) > 0))
                            <button class="btn btn-outline-secondary btn-sm" wire:click="resetFilters">
                                <i class="fas fa-redo me-1"></i>Réinitialiser
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            @if($paginatedDocuments->count() > 0)
                <div class="documents-grid">
                    @foreach($paginatedDocuments as $document)
                        @php
                            $documentId = $document->id ?? 0;
                            $documentTitle = $document->title ?? 'Sans titre';
                            $documentDescription = $document->description ?? '';
                            $documentType = $document->type ?? 'guide';
                            $categorySlug = $document->category->slug ?? 'general';
                            $categoryName = $document->category->name ?? 'Général';
                            $typeIcon = $this->getTypeIcon($documentType);
                            $typeColor = $this->getTypeColor($documentType);
                            $typeName = ucfirst($documentType);
                            $fileName = $document->file_name ?? 'document';
                            $fileSize = $document->file_size ?? '0 KB';
                            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                            $views = $document->views ?? 0;
                            $downloads = $document->downloads ?? 0;
                            $readingTime = $document->reading_time ?? 0;
                            
                            $fileIcon = 'fa-file-alt';
                            if (in_array($fileExtension, ['pdf'])) $fileIcon = 'fa-file-pdf';
                            elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'])) $fileIcon = 'fa-file-image';
                            elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv', 'flv'])) $fileIcon = 'fa-file-video';
                            elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg'])) $fileIcon = 'fa-file-audio';
                            elseif (in_array($fileExtension, ['doc', 'docx'])) $fileIcon = 'fa-file-word';
                            elseif (in_array($fileExtension, ['xls', 'xlsx'])) $fileIcon = 'fa-file-excel';
                            
                            $isFavorite = false;
                            if (Auth::check() && method_exists($document, 'favorites')) {
                                $isFavorite = $document->favorites->where('user_id', Auth::id())->isNotEmpty();
                            }
                        @endphp
                        
                        <div class="document-card-wrapper">
                            <div class="document-card">
                                <div class="card-header">
                                    <div class="card-badges">
                                        <span class="badge-category" style="background: var(--{{ $categorySlug }}-color)">
                                            {{ $categoryName }}
                                        </span>
                                        <span class="badge-type" style="color: var(--{{ $typeColor }})">
                                            <i class="fas fa-{{ $typeIcon }} me-1"></i>
                                            {{ $typeName }}
                                        </span>
                                    </div>
                                    <button class="card-favorite" wire:click="toggleFavorite({{ $documentId }})">
                                        <i class="fas {{ $isFavorite ? 'fa-heart text-danger' : 'fa-heart-o' }}"></i>
                                    </button>
                                </div>
                                <div class="card-body" wire:click="viewContent({{ $documentId }})">
                                    <h3 class="card-title">{{ $documentTitle }}</h3>
                                    <p class="card-description">{{ Str::limit($documentDescription, 120) }}</p>
                                    
                                    <div class="file-premium-preview">
                                        <div class="file-icon-box" style="background: var(--{{ $typeColor }}-lightest)">
                                            <i class="fas {{ $fileIcon }}" style="color: var(--{{ $typeColor }})"></i>
                                        </div>
                                        <div class="file-details">
                                            <div class="file-primary-info">
                                                <span class="file-name-text text-truncate">{{ $fileName }}</span>
                                                <span class="file-ext-badge">{{ $fileExtension }}</span>
                                            </div>
                                            <span class="file-size-text">{{ $fileSize }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="card-meta-inline">
                                        <div class="meta-inline-item">
                                            <i class="fas fa-eye"></i>
                                            <span>{{ $views }}</span>
                                        </div>
                                        <div class="meta-inline-item">
                                            <i class="fas fa-download"></i>
                                            <span>{{ $downloads }}</span>
                                        </div>
                                        <div class="meta-inline-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $readingTime }} min</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="card-actions-row">
                                        <button class="btn btn-icon-only" wire:click="downloadDocument({{ $documentId }})" title="Télécharger">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="btn btn-main-action" wire:click="viewContent({{ $documentId }})">
                                            <span>Ouvrir</span>
                                            <i class="fas fa-external-link-alt ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($paginatedDocuments->hasPages())
                    <div class="pagination-wrapper mt-5">
                        <div class="d-flex justify-content-center">
                            {{ $paginatedDocuments->links('vendor.livewire.bootstrap') }}
                        </div>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search fa-3x"></i>
                    </div>
                    <h3 class="empty-title">Aucun document trouvé</h3>
                    <p class="empty-text">
                        @if($search || (isset($activeCategory) && $activeCategory !== 'all') || (isset($selectedTypes) && count(array_filter($selectedTypes)) > 0))
                            Aucun document ne correspond à vos critères de recherche.
                        @else
                            La bibliothèque de documents est vide pour le moment.
                        @endif
                    </p>
                    @if($search || (isset($activeCategory) && $activeCategory !== 'all') || (isset($selectedTypes) && count(array_filter($selectedTypes)) > 0))
                        <button class="btn btn-primary mt-3" wire:click="resetFilters">
                            <i class="fas fa-redo me-2"></i>Réinitialiser les filtres
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Modal pour afficher le contenu (article/vidéo) -->
    @if(isset($selectedContent) && $selectedContent)
        <div class="modal-overlay" wire:click="closeContent">
            <div class="modal-container" wire:click.stop>
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-header-content">
                            <div class="modal-badges">
                                <span class="modal-badge" style="background: var(--{{ $selectedContent['category_slug'] ?? 'general' }}-color)">
                                    {{ $selectedContent['category'] ?? 'Général' }}
                                </span>
                                <span class="modal-badge" style="color: white; background: var(--{{ $selectedContent['type_color'] ?? 'primary' }})">
                                    <i class="fas fa-{{ $selectedContent['type_icon'] ?? 'file-alt' }} me-1"></i>
                                    {{ $selectedContent['type_name'] ?? 'Document' }}
                                </span>
                                <span class="modal-badge" style="background: var(--neutral-light)">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $selectedContent['reading_time'] ?? 0 }} min
                                </span>
                            </div>
                            <h2 class="modal-title">{{ $selectedContent['title'] ?? 'Sans titre' }}</h2>
                        </div>
                        <button class="modal-close" wire:click="closeContent">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <!-- Description -->
                        <div class="modal-description mb-4">
                            <p class="mb-0">{{ $selectedContent['description'] ?? '' }}</p>
                        </div>
                        
                        <!-- Contenu selon le type -->
                        @if(isset($selectedContent['type']) && $selectedContent['type'] === 'video')
                            <!-- Player vidéo -->
                            <div class="video-container mb-4">
                                <div class="video-player">
                                    @if(isset($selectedContent['video_url']) && $selectedContent['video_url'])
                                        @if(str_contains($selectedContent['video_url'], 'youtube.com') || str_contains($selectedContent['video_url'], 'youtu.be'))
                                            <iframe 
                                                src="https://www.youtube.com/embed/{{ $this->getYouTubeId($selectedContent['video_url']) }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        @elseif(str_contains($selectedContent['video_url'], 'vimeo.com'))
                                            <iframe 
                                                src="https://player.vimeo.com/video/{{ $this->getVimeoId($selectedContent['video_url']) }}"
                                                frameborder="0"
                                                allow="autoplay; fullscreen; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        @else
                                            <video controls style="width: 100%;">
                                                <source src="{{ $selectedContent['video_url'] }}" type="video/mp4">
                                                Votre navigateur ne supporte pas la lecture vidéo.
                                            </video>
                                        @endif
                                    @else
                                        <div class="no-video">
                                            <i class="fas fa-video-slash fa-3x"></i>
                                            <p>Aucune vidéo disponible</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Description vidéo -->
                            <div class="video-description mb-4">
                                <h4>À propos de cette vidéo</h4>
                                <div class="content-wrapper">
                                    {!! $selectedContent['content'] ?? '' !!}
                                </div>
                            </div>
                        @else
                            <!-- Contenu article -->
                            <div class="article-content-section mb-4">
                                <div class="content-wrapper article-content">
                                    {!! $selectedContent['content'] ?? '' !!}
                                </div>
                            </div>
                        @endif
                        
                        <!-- Informations sur le fichier -->
                        <div class="file-info-section mb-4">
                            <h4 class="mb-3">Informations du fichier</h4>
                            <div class="file-info-card">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas fa-file me-2"></i>
                                            <div>
                                                <div class="info-label">Nom du fichier</div>
                                                <div class="info-value">{{ $selectedContent['file_name'] ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas fa-hdd me-2"></i>
                                            <div>
                                                <div class="info-label">Taille</div>
                                                <div class="info-value">{{ $selectedContent['file_size'] ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas fa-code me-2"></i>
                                            <div>
                                                <div class="info-label">Format</div>
                                                <div class="info-value">{{ $selectedContent['file_extension'] ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas fa-calendar me-2"></i>
                                            <div>
                                                <div class="info-label">Dernière mise à jour</div>
                                                <div class="info-value">{{ \Carbon\Carbon::parse($selectedContent['updated_at'] ?? now())->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Statistiques -->
                        <div class="modal-stats mb-4">
                            <h4 class="mb-3">Statistiques</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="stat-box">
                                        <i class="fas fa-eye text-primary"></i>
                                        <div>
                                            <div class="stat-number">{{ $selectedContent['views'] ?? 0 }}</div>
                                            <div class="stat-label">Consultations</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-box">
                                        <i class="fas fa-download text-success"></i>
                                        <div>
                                            <div class="stat-number">{{ $selectedContent['downloads'] ?? 0 }}</div>
                                            <div class="stat-label">Téléchargements</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-box">
                                        <i class="fas fa-heart text-danger"></i>
                                        <div>
                                            <div class="stat-number">{{ ($selectedContent['is_favorite'] ?? false) ? '1' : '0' }}</div>
                                            <div class="stat-label">Favoris</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="modal-footer-left">
                            <button class="btn btn-outline-danger" wire:click="toggleFavorite({{ $selectedContent['id'] ?? 0 }})">
                                <i class="fas {{ ($selectedContent['is_favorite'] ?? false) ? 'fa-heart' : 'fa-heart-o' }} me-2"></i>
                                {{ ($selectedContent['is_favorite'] ?? false) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                            </button>
                        </div>
                        <div class="modal-footer-right">
                            <button class="btn btn-outline-secondary" wire:click="closeContent">
                                <i class="fas fa-times me-2"></i>Fermer
                            </button>
                            <button class="btn btn-primary" wire:click="downloadDocument({{ $selectedContent['id'] ?? 0 }})">
                                <i class="fas fa-download me-2"></i>Télécharger
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Styles CSS -->
    <style>
        :root {
            /* Palette basée sur #5BC4BF */
            --primary-main: #5BC4BF;
            --primary-dark: #4AA8A4;
            --primary-light: #7CD0CC;
            --primary-lighter: #A3E0DD;
            --primary-lightest: #D5F2F0;
            
            /* Couleurs secondaires */
            --secondary-main: #FF9F1C;
            --secondary-dark: #E68A1A;
            --secondary-light: #FFB453;
            
            /* Couleurs neutres */
            --neutral-dark: #2D3748;
            --neutral-medium: #4A5568;
            --neutral-light: #718096;
            --neutral-lighter: #CBD5E0;
            --neutral-lightest: #F7FAFC;
            
            /* Couleurs d'état */
            --success-color: #48BB78;
            --warning-color: #ED8936;
            --danger-color: #F56565;
            --info-color: #4299E1;
            --purple: #9F7AEA;
            --pink: #ED64A6;
            --cyan: #38B2AC;
            
            /* Couleurs de catégories */
            --guides-color: var(--primary-main);
            --tutorials-color: #4CC9F0;
            --references-color: #4299E1;
            --faq-color: #ED64A6;
            --security-color: #9F7AEA;
            --procedures-color: #38B2AC;
            
            /* Dégradés */
            --guides-gradient: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
            --tutorials-gradient: linear-gradient(135deg, #4CC9F0 0%, #4299E1 100%);
            --references-gradient: linear-gradient(135deg, #4299E1 0%, var(--primary-main) 100%);
            --faq-gradient: linear-gradient(135deg, #ED64A6 0%, #D53F8C 100%);
            --security-gradient: linear-gradient(135deg, #9F7AEA 0%, #805AD5 100%);
            --procedures-gradient: linear-gradient(135deg, #38B2AC 0%, var(--primary-dark) 100%);
            
            --danger: var(--danger-color);
            --success: var(--success-color);
            --primary: var(--primary-main);
            --warning: var(--warning-color);
            --info: var(--info-color);
            
            --section-spacing: 5rem;
        }
        
        /* Base */
        .documentation-page {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--neutral-dark);
            background: var(--neutral-lightest);
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Hero Section */
        .doc-hero-section {
            background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 6rem 0 4rem;
            margin-bottom: var(--section-spacing);
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .hero-search {
            max-width: 500px;
        }
        
        .search-wrapper {
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 1rem 3rem 1rem 3.5rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
        
        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .search-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 3px rgba(91, 196, 191, 0.3);
        }
        
        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }
        
        .search-clear {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 5px;
        }
        
        .search-clear:hover {
            color: white;
        }
        
        .hero-illustration {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        
        .illustration-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            width: 300px;
        }
        
        .grid-item {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .grid-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.2);
        }
        
        .grid-item span {
            font-size: 0.875rem;
            margin-top: 0.5rem;
            opacity: 0.9;
        }
        
        /* Stats Section */
        .doc-stats-section {
            margin-bottom: var(--section-spacing);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2rem;
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            margin-top: -3rem;
            position: relative;
            z-index: 1;
            border: 1px solid var(--neutral-lighter);
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-main);
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 0.5rem;
        }
        
        .stat-description {
            font-size: 0.875rem;
            color: var(--neutral-light);
        }
        
        /* Features Section */
        .doc-features-section {
            margin-bottom: var(--section-spacing);
        }
        
        .section-header {
            margin-bottom: 3rem;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--neutral-dark);
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            font-size: 1.125rem;
            color: var(--neutral-medium);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid var(--neutral-lighter);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(91, 196, 191, 0.15);
            border-color: var(--primary-lighter);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
            margin: 0 auto 1.5rem;
        }
        
        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 1rem;
        }
        
        .feature-description {
            color: var(--neutral-medium);
            line-height: 1.6;
        }
        
        /* Categories Section */
        .doc-categories-section {
            margin-bottom: var(--section-spacing);
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .category-card-wrapper {
            display: flex;
        }
        
        .category-card {
            background: white;
            border-radius: 16px;
            width: 100%;
            text-align: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid var(--neutral-lighter);
            display: flex;
            flex-direction: column;
        }
        
        .category-card-inner {
            padding: 2.5rem 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(91, 196, 191, 0.15);
            border-color: var(--primary-main);
        }
        
        .category-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .category-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--neutral-dark);
            margin-bottom: 0.5rem;
        }
        
        .category-count {
            color: var(--neutral-light);
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .category-hover {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .category-card:hover .category-hover {
            transform: translateY(0);
        }
        
        /* Recent Documents */
        .recent-documents-section {
            margin-bottom: var(--section-spacing);
        }
        
        .recent-documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        
        .recent-doc-card-wrapper {
            display: flex;
        }
        
        .recent-doc-card {
            background: white;
            border-radius: 16px;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid var(--neutral-lighter);
            display: flex;
            flex-direction: column;
        }
        
        .recent-doc-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(91, 196, 191, 0.15);
            border-color: var(--primary-main);
        }
        
        .doc-header {
            padding: 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .doc-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .doc-favorite {
            background: rgba(0,0,0,0.03);
            border: none;
            color: var(--neutral-lighter);
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .doc-favorite:hover {
            background: rgba(245, 101, 101, 0.1);
            color: var(--danger-color);
        }
        
        .doc-body {
            padding: 0 1.25rem 1.25rem;
            flex: 1;
        }
        
        .doc-type-icon {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }
        
        .doc-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--neutral-dark);
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 3.1rem;
        }
        
        .doc-description {
            color: var(--neutral-medium);
            font-size: 0.85rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .file-mini-preview {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 0.8rem;
            background: var(--neutral-lightest);
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 500;
            border: 1px solid var(--neutral-lighter);
        }
        
        .pdf-preview { color: #e53e3e; background: #fff5f5; border-color: #feb2b2; }
        .jpg-preview, .jpeg-preview, .png-preview { color: var(--primary-main); background: var(--primary-lightest); border-color: var(--primary-lighter); }
        
        .doc-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--neutral-lightest);
            background: #fafafa;
        }
        
        .doc-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--neutral-light);
            font-weight: 600;
        }
        
        /* All Documents Section */
        .all-documents-section {
            margin-bottom: var(--section-spacing);
        }
        
        .document-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .form-select {
            border-color: var(--neutral-lighter);
            color: var(--neutral-medium);
            font-size: 0.875rem;
            padding: 0.375rem 2.25rem 0.375rem 0.75rem;
        }
        
        .form-select:focus {
            border-color: var(--primary-main);
            box-shadow: 0 0 0 3px rgba(91, 196, 191, 0.15);
        }
        
        .filters-bar {
            background: var(--neutral-lightest);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--neutral-lighter);
        }
        
        .filter-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        
        .filter-tag {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: white;
            border: 1px solid var(--neutral-lighter);
            border-radius: 50px;
            font-size: 0.875rem;
            color: var(--neutral-medium);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-tag:hover {
            border-color: var(--primary-main);
            color: var(--primary-main);
        }
        
        .filter-tag.active {
            background: var(--primary-main);
            border-color: var(--primary-main);
            color: white;
        }
        
        .filter-clear {
            background: none;
            border: none;
            color: var(--danger-color);
            font-size: 0.875rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .filter-clear:hover {
            color: var(--danger-color);
            text-decoration: underline;
        }
        
        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }
        
        .document-card-wrapper {
            display: flex;
        }
        
        .document-card {
            background: white;
            border-radius: 16px;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid var(--neutral-lighter);
            display: flex;
            flex-direction: column;
        }
        
        .document-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(91, 196, 191, 0.15);
            border-color: var(--primary-main);
        }
        
        .card-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-badges {
            display: flex;
            gap: 0.65rem;
        }
        
        .badge-category {
            padding: 0.4rem 0.8rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
        }
        
        .badge-type {
            padding: 0.4rem 0.8rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 700;
            background: var(--neutral-lightest);
            border: 1px solid var(--neutral-lighter);
        }
        
        .card-favorite {
            background: rgba(0,0,0,0.03);
            border: none;
            color: var(--neutral-lighter);
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .card-favorite:hover {
            background: rgba(245, 101, 101, 0.1);
            color: var(--danger-color);
        }
        
        .card-body {
            padding: 0.5rem 1.5rem 1.5rem;
            cursor: pointer;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--neutral-dark);
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 3.5rem;
        }
        
        .card-description {
            color: var(--neutral-medium);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .file-premium-preview {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--neutral-lightest);
            border-radius: 12px;
            margin-bottom: 1.25rem;
            border: 1px solid var(--neutral-lighter);
        }
        
        .file-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        
        .file-details {
            flex: 1;
            min-width: 0;
        }
        
        .file-primary-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.15rem;
        }
        
        .file-name-text {
            font-weight: 700;
            color: var(--neutral-dark);
            font-size: 0.85rem;
        }
        
        .file-ext-badge {
            font-size: 0.65rem;
            font-weight: 800;
            background: var(--neutral-lighter);
            color: var(--neutral-medium);
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
            text-transform: uppercase;
        }
        
        .file-size-text {
            font-size: 0.75rem;
            color: var(--neutral-light);
            font-weight: 600;
        }
        
        .card-meta-inline {
            display: flex;
            gap: 1.25rem;
            margin-top: auto;
            padding-top: 0.5rem;
        }
        
        .meta-inline-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            color: var(--neutral-light);
            font-weight: 600;
        }
        
        .card-footer {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--neutral-lightest);
            background: #fafafa;
        }
        
        .card-actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
        
        .btn-icon-only {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            padding: 0;
            background: white;
            border: 1px solid var(--neutral-lighter);
            color: var(--neutral-medium);
        }
        
        .btn-icon-only:hover {
            border-color: var(--primary-main);
            color: var(--primary-main);
            background: var(--primary-lightest);
        }
        
        .btn-main-action {
            flex: 1;
            background: var(--primary-main);
            color: white;
            font-weight: 700;
            border-radius: 10px;
            padding: 0.65rem 1.25rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-main-action:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(91, 196, 191, 0.3);
        }
        
        /* Boutons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
        }
        
        .btn-primary {
            background: var(--primary-main);
            border-color: var(--primary-main);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .btn-outline-primary {
            color: var(--primary-main);
            border-color: var(--primary-main);
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-main);
            border-color: var(--primary-main);
            color: white;
        }
        
        .btn-outline-secondary {
            color: var(--neutral-medium);
            border-color: var(--neutral-lighter);
            background: transparent;
        }
        
        .btn-outline-secondary:hover {
            background: var(--neutral-lightest);
            border-color: var(--neutral-light);
        }
        
        .btn-outline-danger {
            color: var(--danger-color);
            border-color: var(--danger-color);
            background: transparent;
        }
        
        .btn-outline-danger:hover {
            background: var(--danger-color);
            border-color: var(--danger-color);
            color: white;
        }
        
        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 50rem;
        }
        
        .bg-primary {
            background-color: var(--primary-main) !important;
        }
        
        .rounded-pill {
            border-radius: 50rem !important;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid var(--neutral-lighter);
        }
        
        .empty-icon {
            margin-bottom: 1.5rem;
            color: var(--neutral-lighter);
        }
        
        .empty-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 0.75rem;
        }
        
        .empty-text {
            color: var(--neutral-medium);
            max-width: 400px;
            margin: 0 auto 1.5rem;
        }
        
        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
            padding: 2rem;
        }
        
        .modal-container {
            max-width: 900px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        
        .modal-content {
            display: flex;
            flex-direction: column;
            max-height: 90vh;
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--neutral-lighter);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-shrink: 0;
        }
        
        .modal-header-content {
            flex: 1;
            margin-right: 1rem;
        }
        
        .modal-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .modal-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--neutral-dark);
            margin: 0;
        }
        
        .modal-close {
            background: var(--neutral-lightest);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--neutral-light);
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        
        .modal-close:hover {
            background: var(--neutral-lighter);
        }
        
        .modal-body {
            padding: 1.5rem;
            overflow-y: auto;
            flex: 1;
        }
        
        /* Video container dans modal */
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            background: #000;
            margin-bottom: 1.5rem;
        }
        
        .video-container iframe,
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .no-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            background: #2D3748;
        }
        
        .no-video i {
            margin-bottom: 1rem;
        }
        
        /* Contenu article dans modal */
        .article-content {
            line-height: 1.8;
            color: var(--neutral-medium);
        }
        
        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4 {
            color: var(--neutral-dark);
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        
        .article-content p {
            margin-bottom: 1rem;
        }
        
        .article-content ul,
        .article-content ol {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }
        
        .article-content li {
            margin-bottom: 0.5rem;
        }
        
        .article-content code {
            background: var(--neutral-lightest);
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.9em;
            color: var(--neutral-dark);
        }
        
        .article-content pre {
            background: var(--neutral-dark);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            overflow-x: auto;
            margin: 1rem 0;
        }
        
        .article-content blockquote {
            border-left: 4px solid var(--primary-main);
            padding-left: 1rem;
            margin: 1.5rem 0;
            color: var(--neutral-medium);
            font-style: italic;
        }
        
        /* File info dans modal */
        .file-info-section h4,
        .video-description h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 1rem;
        }
        
        .file-info-card {
            background: var(--neutral-lightest);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--neutral-lighter);
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            background: white;
            border-radius: 8px;
            border: 1px solid var(--neutral-lighter);
        }
        
        .info-item i {
            font-size: 1.25rem;
            color: var(--primary-main);
            width: 30px;
        }
        
        .info-label {
            font-size: 0.75rem;
            color: var(--neutral-light);
            margin-bottom: 0.25rem;
        }
        
        .info-value {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--neutral-dark);
        }
        
        /* Stats dans modal */
        .modal-stats {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--neutral-lighter);
        }
        
        .modal-stats h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 1rem;
        }
        
        .stat-box {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--neutral-lightest);
            border-radius: 12px;
            border: 1px solid var(--neutral-lighter);
        }
        
        .stat-box i {
            font-size: 1.5rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--neutral-dark);
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: var(--neutral-light);
        }
        
        .modal-footer {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--neutral-lighter);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }
        
        .modal-footer-left, .modal-footer-right {
            display: flex;
            gap: 0.75rem;
        }
        
        /* Utilities */
        .mb-0 { margin-bottom: 0 !important; }
        .mb-3 { margin-bottom: 1rem !important; }
        .mb-4 { margin-bottom: 1.5rem !important; }
        .mb-5 { margin-bottom: 3rem !important; }
        .mt-3 { margin-top: 1rem !important; }
        .mt-5 { margin-top: 3rem !important; }
        .ms-1 { margin-left: 0.25rem !important; }
        .ms-2 { margin-left: 0.5rem !important; }
        .me-1 { margin-right: 0.25rem !important; }
        .me-2 { margin-right: 0.5rem !important; }
        
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        
        .col-lg-6, .col-md-4, .col-md-8 {
            padding: 0 15px;
        }
        
        .col-lg-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        
        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        
        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        
        .d-flex { display: flex !important; }
        .justify-content-between { justify-content: space-between !important; }
        .justify-content-center { justify-content: center !important; }
        .align-items-center { align-items: center !important; }
        .text-center { text-align: center !important; }
        .text-end { text-align: right !important; }
        
        .g-3 { gap: 1rem !important; }
        .g-4 { gap: 1.5rem !important; }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                padding: 2rem;
            }
            
            .col-md-4, .col-md-8 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        @media (max-width: 768px) {
            .doc-hero-section {
                padding: 4rem 0 3rem;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding: 1.5rem;
            }
            
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .documents-grid {
                grid-template-columns: 1fr;
            }
            
            .illustration-grid {
                width: 250px;
                margin-top: 2rem;
            }
            
            .document-controls {
                margin-top: 1rem;
            }
            
            .col-lg-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .modal-footer {
                flex-direction: column;
                gap: 1rem;
            }
            
            .modal-footer-left, .modal-footer-right {
                width: 100%;
                justify-content: center;
            }
            
            .info-item {
                flex-direction: column;
                text-align: center;
                padding: 1rem;
            }
            
            .info-item i {
                width: auto;
                margin-bottom: 0.5rem;
            }
            
            .modal-stats .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            :root {
                --section-spacing: 3rem;
            }
            
            .hero-title {
                font-size: 1.75rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .feature-card, .category-card {
                padding: 1.5rem;
            }
            
            .modal-overlay {
                padding: 1rem;
            }
            
            .modal-container {
                max-height: 95vh;
            }
        }
    </style>
</div>