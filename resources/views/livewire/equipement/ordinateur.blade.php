<div>
    <!-- Styles CSS -->
    <style>
        :root {
            --dark-green: #3D3E14;
            --turquoise: #66C0B7;
            --off-white: #EDEDE8;
            --orange: #E35E2F;
            --soft-green: #83AF4B;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        
        .dashboard-card:hover {
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            padding: 16px;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .stat-icon-lg {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }
        
        .icon-primary { background: rgba(131, 175, 79, 0.1); color: var(--soft-green); }
        .icon-success { background: rgba(102, 192, 183, 0.1); color: var(--turquoise); }
        .icon-warning { background: rgba(227, 94, 47, 0.1); color: var(--orange); }
        .icon-info { background: rgba(61, 62, 20, 0.1); color: var(--dark-green); }
        .icon-danger { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .search-box .form-control {
            padding-left: 30px;
            font-size: 0.875rem;
        }
        
        .badge-sm {
            font-size: 0.7rem;
            padding: 0.25em 0.5em;
        }
        
        .table th {
            font-size: 0.8rem;
            font-weight: 600;
            color: #495057;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table td {
            font-size: 0.8rem;
            vertical-align: middle;
        }
        
        .btn {
            font-size: 0.8rem;
        }
        
        .form-label {
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .modal-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .detail-item {
            padding: 0.25rem 0;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-item strong {
            color: #495057;
            display: flex;
            align-items: center;
            margin-bottom: 0.125rem;
        }
        
        /* Styles pour centrer les modales */
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }
        
        .modal-backdrop {
            z-index: 1040;
        }
        
        .modal {
            z-index: 1050;
        }
        
        .progress {
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        
        .progress-bar {
            border-radius: 10px;
        }

        /* Styles supplémentaires pour les filtres */
        .search-box input:focus {
            background-color: white !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1) !important;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
            border-radius: 8px;
        }

        .form-select:focus, .form-control:focus {
            box-shadow: none !important;
            background-color: white !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .rounded-2 {
            border-radius: 8px !important;
        }

        .btn {
            border-radius: 6px !important;
        }

        /* Animation pour les badges de filtre */
        .badge {
            transition: all 0.2s ease;
        }

        .badge:hover {
            transform: translateY(-1px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            #filters-container .col-md-3,
            #filters-container .col-md-2 {
                margin-bottom: 1rem;
            }
            
            .btn span.d-none.d-sm-inline {
                display: inline !important;
            }
        }
    </style>

    <!-- Contenu principal -->
    <div class="container-fluid py-3">
        <!-- Header -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h1 class="h4 fw-semibold text-dark mb-0">
                            <i class="bi bi-laptop me-2 text-primary"></i> Gestion des Ordinateurs
                        </h1>
                        <p class="text-muted small">Gérez votre parc informatique efficacement</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        @if(count($selectedOrdinateurs) > 0)
                            <button wire:click="confirmBulkDelete" class="btn btn-danger btn-sm d-flex align-items-center">
                                <i class="bi bi-trash me-2"></i> Supprimer ({{ count($selectedOrdinateurs) }})
                            </button>
                        @endif
                        <button class="btn btn-primary btn-sm d-flex align-items-center" 
                                wire:click="create">
                            <i class="bi bi-plus-lg me-2"></i> Ajouter
                        </button>
                        <button class="btn btn-outline-primary btn-sm d-flex align-items-center" wire:click="toggleStats">
                            <i class="fas fa-chart-bar me-1"></i>
                            {{ $showStats ? 'Masquer' : 'Afficher' }} stats
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages flash -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show small" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <!-- Statistiques -->
        @if($showStats)
        <div class="row mb-4">
            <!-- Total -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-primary mb-1">{{ $stats['total'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Total Ordinateurs</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-primary ms-3">
                            <i class="bi bi-laptop-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En service -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-success mb-1">{{ $stats['en_service'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Service</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_service'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-success ms-3">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En réparation -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-warning mb-1">{{ $stats['en_reparation'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Réparation</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_reparation'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-warning ms-3">
                            <i class="bi bi-tools"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En stock -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-info mb-1">{{ $stats['en_stock'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Stock</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_stock'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-info ms-3">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hors service -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-danger mb-1">{{ $stats['hors_service'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Hors Service</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-danger" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['hors_service'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-danger ms-3">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taux de disponibilité -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            @php
                                $disponible = $stats['en_service'] ?? 0;
                                $total = $stats['total'] ?? 1;
                                $taux = $total > 0 ? round(($disponible / $total) * 100) : 0;
                            @endphp
                            <h3 class="stat-number mb-1 {{ $taux >= 80 ? 'text-success' : ($taux >= 60 ? 'text-warning' : 'text-danger') }}">
                                {{ $taux }}%
                            </h3>
                            <p class="text-muted small mb-0 fw-medium">Disponibilité</p>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar {{ $taux >= 80 ? 'bg-success' : ($taux >= 60 ? 'bg-warning' : 'bg-danger') }}" 
                                     style="width: {{ $taux }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg {{ $taux >= 80 ? 'icon-success' : ($taux >= 60 ? 'icon-warning' : 'icon-danger') }} ms-3">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filtres avec boutons Import/Export -->
        <div class="dashboard-card p-3 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-semibold mb-0 text-dark small">Filtres et Actions</h6>
                <div class="d-flex gap-2">
                    <button wire:click="resetFilters" class="btn btn-outline-secondary btn-sm" title="Réinitialiser les filtres">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                    <button wire:click="toggleFilters" class="btn btn-outline-secondary btn-sm d-md-none" title="Afficher/Masquer les filtres">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>
            </div>

            <div class="row g-3 align-items-end" id="filters-container">
                <!-- Recherche -->
                <div class="col-md-3 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Recherche</label>
                    <div class="search-box position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted small"></i>
                        <input type="text" wire:model.live.debounce.300ms="search"
                               class="form-control form-control-sm ps-4 border-0 bg-light rounded-2"
                               placeholder="Nom, IP, OS...">
                    </div>
                </div>

                <!-- Entité -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Entité</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="bi bi-building"></i>
                        </span>
                        <input type="text" wire:model.live="entite" 
                               class="form-control border-0 bg-light rounded-2" 
                               placeholder="Entité...">
                    </div>
                </div>

                <!-- Statut -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Statut</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="bi bi-circle-fill"></i>
                        </span>
                        <select wire:model.live="statut" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les statuts</option>
                            @foreach($statuts as $statutOption)
                                <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Affichage</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="bi bi-list-ul"></i>
                        </span>
                        <select wire:model.live="perPage" class="form-select border-0 bg-light rounded-2">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="col-md-3">
                    <div class="d-flex gap-2 flex-wrap justify-content-end">
                        <button wire:click="openImportModal" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="bi bi-upload me-1"></i>
                            <span class="d-none d-sm-inline">Importer</span>
                        </button>
                        <button wire:click="exportOrdinateur" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="bi bi-download me-1"></i>
                            <span class="d-none d-sm-inline">Exporter</span>
                        </button>
                        <button wire:click="create" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="bi bi-plus-lg me-1"></i>
                            <span class="d-none d-sm-inline">Nouveau</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Résultats du filtre -->
            @if($search || $statut || $entite)
            <div class="mt-3 pt-2 border-top">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-muted small">Filtres actifs :</span>
                    @if($search)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Recherche: "{{ $search }}"
                        <button wire:click="$set('search', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($statut)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Statut: {{ $statut }}
                        <button wire:click="$set('statut', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($entite)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Entité: {{ $entite }}
                        <button wire:click="$set('entite', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Tableau -->
        <div class="dashboard-card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <h5 class="fw-semibold mb-0">Liste des Ordinateurs</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th width="40">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="selectAll">
                                </div>
                            </th>
                            <th>Nom</th>
                            <th wire:click="sortBy('entite')" style="cursor: pointer;">
                                Entité
                                @if ($sortField === 'entite')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('statut')" style="cursor: pointer;">
                                Statut
                                @if ($sortField === 'statut')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th>Fabricant</th>
                            <th>Modèle</th>
                            <th>N° Série</th>
                            <th>Utilisateur</th>
                            <th>IP</th>
                            <th>OS</th>
                            <th wire:click="sortBy('updated_at')" style="cursor: pointer;">
                                Dernière modif.
                                @if ($sortField === 'updated_at')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($ordinateurs as $ordinateur)
                        <tr wire:key="ordinateur-{{ $ordinateur->id }}">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="selectedOrdinateurs" value="{{ $ordinateur->id }}">
                                </div>
                            </td>
                            <td class="fw-medium small">{{ $ordinateur->nom }}</td>
                            <td class="small">{{ $ordinateur->entite }}</td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'En service' => 'badge bg-success badge-sm',
                                        'En stock' => 'badge bg-info badge-sm',
                                        'En réparation' => 'badge bg-warning badge-sm',
                                        'Hors service' => 'badge bg-danger badge-sm'
                                    ];
                                @endphp
                                <span class="{{ $statusClasses[$ordinateur->statut] ?? 'badge bg-secondary badge-sm' }}">
                                    {{ $ordinateur->statut }}
                                </span>
                            </td>
                            <td class="small">{{ $ordinateur->fabricant }}</td>
                            <td class="small">{{ $ordinateur->modele }}</td>
                            <td class="small font-monospace">{{ $ordinateur->numero_serie ?? 'N/A' }}</td>
                            <td class="small">{{ $ordinateur->utilisateur->name ?? 'Non attribué' }}</td>
                            <td class="small font-monospace">{{ $ordinateur->reseau_ip ?? 'N/A' }}</td>
                            <td class="small">{{ $ordinateur->os_version ?? 'N/A' }}</td>
                            <td class="small">{{ $ordinateur->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- Bouton Voir Détails -->
                                    <button wire:click="showDetails({{ $ordinateur->id }})"
                                            class="btn btn-sm btn-outline-info border-0"
                                            title="Voir détails">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <!-- Bouton Modifier -->
                                    <button wire:click="edit({{ $ordinateur->id }})"
                                            class="btn btn-sm btn-outline-primary border-0"
                                            title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <!-- Bouton Supprimer -->
                                    <button wire:click="confirmDelete({{ $ordinateur->id }})"
                                            class="btn btn-sm btn-outline-danger border-0"
                                            title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-3">
                                <i class="fas fa-laptop display-6 text-muted d-block mb-2"></i>
                                <p class="text-muted mb-0 small">Aucun ordinateur trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    @if($ordinateurs->count() > 0)
                        Affichage de {{ $ordinateurs->firstItem() }} à {{ $ordinateurs->lastItem() }} sur {{ $ordinateurs->total() }} ordinateurs
                    @else
                        Aucun ordinateur
                    @endif
                </div>
                {{ $ordinateurs->links() }}
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Modal pour créer/modifier un ordinateur -->
    @if($showModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="bi {{ $isEditing ? 'bi-pencil' : 'bi-plus-circle' }} me-1"></i>
                        {{ $isEditing ? 'Modifier l\'ordinateur' : 'Nouvel Ordinateur' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save" style="max-height:400px;overflow-y: scroll;  -ms-overflow-style: none;">
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <!-- Informations de base -->
                            <div class="col-12 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-info-circle me-1 text-primary"></i>Informations de base
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Nom <span class="text-danger">*</span></label>
                                <input type="text" wire:model="nom"
                                       class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                       placeholder="Nom de l'ordinateur">
                                @error('nom') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Statut <span class="text-danger">*</span></label>
                                <select wire:model="statut_form"
                                        class="form-select form-select-sm @error('statut_form') is-invalid @enderror">
                                    <option value="">Sélectionner un statut</option>
                                    @foreach($statuts as $statut)
                                        <option value="{{ $statut }}">{{ $statut }}</option>
                                    @endforeach
                                </select>
                                @error('statut_form') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <!-- Spécifications matérielles -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-cpu me-1 text-primary"></i>Spécifications matérielles
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Fabricant</label>
                                <input type="text" wire:model="fabricant"
                                       class="form-control form-control-sm @error('fabricant') is-invalid @enderror"
                                       placeholder="Dell, HP, Lenovo...">
                                @error('fabricant') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Modèle</label>
                                <input type="text" wire:model="modele"
                                       class="form-control form-control-sm @error('modele') is-invalid @enderror"
                                       placeholder="Latitude 5420...">
                                @error('modele') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Numéro de série</label>
                                <input type="text" wire:model="numero_serie"
                                       class="form-control form-control-sm @error('numero_serie') is-invalid @enderror"
                                       placeholder="Numéro de série">
                                @error('numero_serie') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Disque dur</label>
                                <input type="text" wire:model="disque_dur"
                                       class="form-control form-control-sm"
                                       placeholder="512 Go SSD">
                            </div>

                            <!-- Réseau et OS -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-wifi me-1 text-primary"></i>Réseau et Système
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Adresse IP</label>
                                <input type="text" wire:model="reseau_ip"
                                       class="form-control form-control-sm @error('reseau_ip') is-invalid @enderror"
                                       placeholder="192.168.1.100">
                                @error('reseau_ip') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Version OS</label>
                                <input type="text" wire:model="os_version"
                                       class="form-control form-control-sm"
                                       placeholder="Windows 11 Pro">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Version noyau</label>
                                <input type="text" wire:model="os_noyau" class="form-control form-control-sm"
                                       placeholder="10.0.19045">
                            </div>

                            <!-- Utilisateurs -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-people me-1 text-primary"></i>Attribution utilisateurs
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Utilisateur principal</label>
                                <select wire:model="utilisateur_id"
                                        class="form-select form-select-sm @error('utilisateur_id') is-invalid @enderror">
                                    <option value="">Sélectionner un utilisateur</option>
                                    @foreach($utilisateurs as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('utilisateur_id') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Usager secondaire</label>
                                <select wire:model="usager_id" class="form-select form-select-sm">
                                    <option value="">Sélectionner un usager</option>
                                    @foreach($utilisateurs as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Organisation -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-building me-1 text-primary"></i>Organisation
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Entité</label>
                                <input type="text" wire:model="entite_form"
                                       class="form-control form-control-sm @error('entite_form') is-invalid @enderror"
                                       placeholder="Entité organisationnelle">
                                @error('entite_form') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Sous-entité</label>
                                <input type="text" wire:model="sous_entite"
                                       class="form-control form-control-sm"
                                       placeholder="Sous-entité organisationnelle">
                            </div>

                            <!-- Dates importantes -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-calendar me-1 text-primary"></i>Dates importantes
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Date dernier inventaire</label>
                                <input type="date" wire:model="date_dernier_inventaire"
                                       class="form-control form-control-sm">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Dernier démarrage</label>
                                <input type="datetime-local" wire:model="derniere_date_demarrage"
                                       class="form-control form-control-sm">
                            </div>

                            <!-- Notes -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-sticky me-1 text-primary"></i>Notes et informations
                                </h6>
                                <textarea wire:model="notes" class="form-control form-control-sm" rows="3"
                                          placeholder="Informations supplémentaires..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal">Annuler</button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span wire:loading.remove>
                                <i class="bi {{ $isEditing ? 'bi-check' : 'bi-plus' }} me-1"></i>
                                {{ $isEditing ? 'Modifier' : 'Créer' }}
                            </span>
                            <span wire:loading>
                                <i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i>
                                {{ $isEditing ? 'Modification...' : 'Création...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de détails de l'ordinateur -->
    @if($showDetailsModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i>Détails de l'Ordinateur
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body">
                    @if($selectedOrdinateur)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-laptop me-1"></i>Nom</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->nom }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-building me-1"></i>Entité</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->entite ?? 'Non spécifiée' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-circle me-1"></i>Statut</strong>
                                    <p class="mb-0">
                                        @php
                                            $statusClasses = [
                                                'En service' => 'badge bg-success badge-sm',
                                                'En stock' => 'badge bg-info badge-sm',
                                                'En réparation' => 'badge bg-warning badge-sm',
                                                'Hors service' => 'badge bg-danger badge-sm'
                                            ];
                                        @endphp
                                        <span class="{{ $statusClasses[$selectedOrdinateur->statut] ?? 'badge bg-secondary badge-sm' }}">
                                            {{ $selectedOrdinateur->statut }}
                                        </span>
                                    </p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-industry me-1"></i>Fabricant</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->fabricant ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-barcode me-1"></i>Numéro de série</strong>
                                    <p class="mb-0 small font-monospace">{{ $selectedOrdinateur->numero_serie ?? 'Non renseigné' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-cube me-1"></i>Modèle</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->modele ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-network-wired me-1"></i>Adresse IP</strong>
                                    <p class="mb-0 small font-monospace">{{ $selectedOrdinateur->reseau_ip ?? 'Non configurée' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fab fa-windows me-1"></i>Version OS</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->os_version ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-users me-1"></i>Utilisateur principal</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->utilisateur->name ?? 'Non attribué' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-user me-1"></i>Usager secondaire</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->usager->name ?? 'Non attribué' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-calendar-plus me-1"></i>Date de création</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->created_at->format('d/m/Y à H:i') }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-calendar-check me-1"></i>Dernière modification</strong>
                                    <p class="mb-0 small">{{ $selectedOrdinateur->updated_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle display-6 text-warning d-block mb-2"></i>
                            <p class="text-muted small">Impossible de charger les détails de l'ordinateur.</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeDetailsModal">Fermer</button>
                    @if($selectedOrdinateur)
                        <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $selectedOrdinateur->id }})">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de confirmation de suppression -->
    @if($confirmingDelete)
    <div class="modal fade show" 
         style="display: block; background: rgba(0,0,0,0.5);"
         tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-exclamation-triangle me-2"></i> Confirmation de suppression
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeDeleteModal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-trash3 text-danger" style="font-size: 3rem;"></i>
                    </div>
                    @if($isBulkDelete)
                        <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer les <strong>{{ count($selectedOrdinateurs) }}</strong> ordinateurs sélectionnés ?</p>
                    @else
                        <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer l'ordinateur <strong>{{ $selectedOrdinateurName }}</strong> ?</p>
                    @endif
                    <p class="text-muted small">Cette action est irréversible et toutes les données associées seront définitivement perdues.</p>
                </div>
                <div class="modal-footer bg-light border-0 justify-content-center p-3">
                    <button type="button" class="btn btn-outline-secondary px-4" wire:click="closeDeleteModal">
                        <i class="bi bi-x-lg me-1"></i> Annuler
                    </button>
                    <button type="button" class="btn btn-danger px-4" wire:click="deleteConfirmed">
                        <i class="bi bi-trash-fill me-1"></i> Confirmer la suppression
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal d'import -->
    @if($showImportModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-arrow-up me-2"></i>Importer des Ordinateurs
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeImportModal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-2"></i>
                        Formats supportés: CSV, TXT. Taille max: 10MB
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small">Fichier à importer</label>
                        <input type="file" wire:model="fichierExcel" class="form-control form-control-sm" accept=".csv,.txt">
                        @error('fichierExcel') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <button type="button" wire:click="downloadTemplate" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-download me-1"></i>
                            Télécharger le template
                        </button>
                    </div>

                    @if($importErrors && count($importErrors) > 0)
                    <div class="alert alert-danger small">
                        <h6 class="alert-heading">Erreurs d'importation</h6>
                        <ul class="mb-0">
                            @foreach($importErrors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeImportModal">Annuler</button>
                    <button type="button" class="btn btn-primary btn-sm" wire:click="storeImportFile" 
                            wire:loading.attr="disabled" {{ !$fichierExcel ? 'disabled' : '' }}>
                        <i class="bi bi-file-earmark-arrow-up me-1"></i>
                        <span wire:loading.remove>Importer</span>
                        <span wire:loading>
                            <i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i>
                            Import...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de mapping -->
    @if($showMappingModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-columns me-2"></i>Mapping des Colonnes
                    </h5>
                    <button type="button" wire:click="cancelImport" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-2"></i>
                        Associez les colonnes de votre fichier aux champs de la base de données.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th class="small">Champ de la base</th>
                                    <th class="small">Colonne dans le fichier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fieldMapping as $field => $mappedHeader)
                                <tr>
                                    <td class="small fw-medium">
                                        <span class="badge {{ $field === 'nom' ? 'bg-danger' : 'bg-secondary' }} badge-sm me-2">
                                            {{ $field === 'nom' ? 'Obligatoire' : 'Optionnel' }}
                                        </span>
                                        {{ $field }}
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm" wire:model="fieldMapping.{{ $field }}">
                                            <option value="">-- Non mappé --</option>
                                            @foreach($csvHeaders as $header)
                                            <option value="{{ $header }}">{{ $header }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($importErrors && count($importErrors) > 0)
                    <div class="alert alert-danger small mt-3">
                        <h6 class="alert-heading">Erreurs détectées</h6>
                        <ul class="mb-0">
                            @foreach($importErrors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="cancelImport" class="btn btn-secondary btn-sm">
                        <i class="bi bi-x me-1"></i>Annuler
                    </button>
                    <button type="button" wire:click="processMappedData" class="btn btn-primary btn-sm" 
                            wire:loading.attr="disabled" {{ empty($fieldMapping['nom']) ? 'disabled' : '' }}>
                        <i class="bi bi-gear me-1"></i>
                        <span wire:loading.remove>Traiter les données</span>
                        <span wire:loading>
                            <i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i>
                            Traitement...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal d'aperçu des données importées -->
    @if($showImportedData)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle me-2"></i>Aperçu des Données Importées
                    </h5>
                    <button type="button" wire:click="cancelImport" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success small">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ $importSuccessCount }} enregistrement(s) prêt(s) à être importés.
                        @if($importErrors && count($importErrors) > 0)
                        <br><strong>{{ count($importErrors) }} erreur(s) détectée(s):</strong>
                        @endif
                    </div>

                    @if($importErrors && count($importErrors) > 0)
                    <div class="alert alert-danger small">
                        <h6 class="alert-heading">Erreurs d'importation:</h6>
                        <ul class="mb-0">
                            @foreach($importErrors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(count($importedData) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="small">Nom</th>
                                    <th class="small">Entité</th>
                                    <th class="small">Statut</th>
                                    <th class="small">Fabricant</th>
                                    <th class="small">Modèle</th>
                                    <th class="small">N° Série</th>
                                    <th class="small">IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($importedData as $data)
                                <tr>
                                    <td class="small">{{ $data['nom'] }}</td>
                                    <td class="small">{{ $data['entite'] ?? 'N/A' }}</td>
                                    <td class="small">
                                        <span class="badge badge-sm bg-{{ $this->getBadgeColor($data['statut'] ?? 'En stock') }}">
                                            {{ $data['statut'] ?? 'En stock' }}
                                        </span>
                                    </td>
                                    <td class="small">{{ $data['fabricant'] ?? 'N/A' }}</td>
                                    <td class="small">{{ $data['modele'] ?? 'N/A' }}</td>
                                    <td class="small font-monospace">{{ $data['numero_serie'] ?? 'N/A' }}</td>
                                    <td class="small font-monospace">{{ $data['reseau_ip'] ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="cancelImport" class="btn btn-secondary btn-sm">
                        <i class="bi bi-x me-1"></i>Annuler
                    </button>
                    <button type="button" wire:click="saveImportedData" class="btn btn-success btn-sm" 
                            {{ count($importedData) === 0 ? 'disabled' : '' }}>
                        <i class="bi bi-save me-1"></i>
                        Sauvegarder ({{ count($importedData) }})
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Scripts JavaScript -->
    <script>
        // Fonction pour basculer l'affichage des filtres sur mobile
        function toggleFilters() {
            const container = document.getElementById('filters-container');
            container.classList.toggle('d-none');
        }
    </script>

    <!-- Liens CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</div>