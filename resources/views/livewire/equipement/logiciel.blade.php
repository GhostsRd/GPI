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
        .icon-secondary { background: rgba(108, 117, 125, 0.1); color: #6c757d; }
        
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
                            <i class="bi bi-microsoft me-2 text-primary"></i> Gestion des Logiciels
                        </h1>
                        <p class="text-muted small">Gérez votre parc logiciel efficacement</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
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

        @if (session()->has('info'))
            <div class="alert alert-info alert-dismissible fade show small" role="alert">
                <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <!-- Statistiques avec 6 cartes -->
        @if($showStats)
        <div class="row mb-4">
            <!-- Carte 1: Total Logiciels -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-primary mb-1">{{ $stats['total'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Total Logiciels</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-primary ms-3">
                            <i class="bi bi-microsoft"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte 2: Licences Critiques -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-danger mb-1">{{ $stats['licences_critiques'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Licences Critiques</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-danger" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['licences_critiques'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-danger ms-3">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte 3: Total Installations -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-success mb-1">{{ $stats['total_installations'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Total Installations</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-success ms-3">
                            <i class="bi bi-download"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte 4: Total Licences -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-info mb-1">{{ $stats['total_licences'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Total Licences</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-info ms-3">
                            <i class="bi bi-key-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte 5: Logiciels sans licences -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-warning mb-1">{{ $stats['sans_licences'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Sans Licences</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['sans_licences'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-warning ms-3">
                            <i class="bi bi-x-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte 6: Taux de Conformité -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-secondary mb-1">{{ $stats['taux_conformite'] ?? 0 }}%</h3>
                            <p class="text-muted small mb-0 fw-medium">Conformité</p>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar {{ $stats['taux_conformite'] >= 80 ? 'bg-success' : ($stats['taux_conformite'] >= 60 ? 'bg-warning' : 'bg-danger') }}" 
                                     style="width: {{ $stats['taux_conformite'] }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-secondary ms-3">
                            <i class="bi bi-check-circle-fill"></i>
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
                               placeholder="Nom, Éditeur, Version...">
                    </div>
                </div>

                <!-- Éditeur -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Éditeur</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="bi bi-building"></i>
                        </span>
                        <select wire:model.live="editeur" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les éditeurs</option>
                            @foreach($editeurs as $editeurOption)
                                <option value="{{ $editeurOption }}">{{ $editeurOption }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Système d'exploitation -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Système d'exploitation</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="bi bi-windows"></i>
                        </span>
                        <select wire:model.live="systeme_exploitation" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les systèmes</option>
                            @foreach($systemes as $systeme)
                                <option value="{{ $systeme }}">{{ $systeme }}</option>
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
                        <button wire:click="exportLogiciel" class="btn btn-outline-primary btn-sm d-flex align-items-center">
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
            @if($search || $editeur || $systeme_exploitation || $statutFilter)
            <div class="mt-3 pt-2 border-top">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-muted small">Filtres actifs :</span>
                    @if($search)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Recherche: "{{ $search }}"
                        <button wire:click="$set('search', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($editeur)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Éditeur: {{ $editeur }}
                        <button wire:click="$set('editeur', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($systeme_exploitation)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Système: {{ $systeme_exploitation }}
                        <button wire:click="$set('systeme_exploitation', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    
                </div>
            </div>
            @endif
        </div>

       <!-- Tableau -->
<div class="dashboard-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h5 class="fw-semibold mb-0">Liste des Logiciels</h5>
        @if(count($selectedLogiciels) > 0)
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small">{{ count($selectedLogiciels) }} sélectionné(s)</span>
            <button wire:click="deleteSelected" class="btn btn-danger btn-sm">
                <i class="bi bi-trash me-1"></i>Supprimer
            </button>
        </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th style="width: 30px;">
                        <input type="checkbox" wire:model="selectAll" class="form-check-input">
                    </th>
                    <th wire:click="sortBy('nom')" style="cursor: pointer;">
                        Nom
                        @if ($sortField === 'nom')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                        @else
                            <i class="fas fa-sort text-muted small"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('editeur')" style="cursor: pointer;">
                        Éditeur
                        @if ($sortField === 'editeur')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                        @else
                            <i class="fas fa-sort text-muted small"></i>
                        @endif
                    </th>
                    <th>Version</th>
                    <th>Système d'exploitation</th>
                    <th wire:click="sortBy('nombre_installations')" style="cursor: pointer;">
                        Installations
                        @if ($sortField === 'nombre_installations')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                        @else
                            <i class="fas fa-sort text-muted small"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('nombre_licences')" style="cursor: pointer;">
                        Licences
                        @if ($sortField === 'nombre_licences')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                        @else
                            <i class="fas fa-sort text-muted small"></i>
                        @endif
                    </th>
                    <th>Statut</th>
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
            @forelse($logiciels as $logiciel)
                <tr>
                    <td>
                        <input type="checkbox" wire:model="selectedLogiciels" value="{{ $logiciel->id }}" class="form-check-input">
                    </td>
                    <td class="fw-medium small">{{ $logiciel->nom }}</td>
                    <td class="small">{{ $logiciel->editeur ?? 'N/A' }}</td>
                    <td class="small">{{ $logiciel->version_nom ?? 'N/A' }}</td>
                    <td class="small">{{ $logiciel->version_systeme_exploitation ?? 'N/A' }}</td>
                    <td class="small text-center">{{ $logiciel->nombre_installations }}</td>
                    <td class="small text-center">{{ $logiciel->nombre_licences }}</td>
                    <td>
                        @php
                            $statusClasses = [
                                'Conforme' => 'badge bg-success badge-sm',
                                'Alerte' => 'badge bg-warning badge-sm',
                                'Critique' => 'badge bg-danger badge-sm',
                                'Aucune licence' => 'badge bg-secondary badge-sm'
                            ];
                        @endphp
                        <span class="{{ $statusClasses[$logiciel->statut_licences] ?? 'badge bg-info badge-sm' }}">
                            {{ $logiciel->statut_licences }}
                        </span>
                    </td>
                    <td class="small">{{ $logiciel->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <!-- Bouton Voir Détails -->
                            <button wire:click="showDetails({{ $logiciel->id }})"
                                    class="btn btn-sm btn-outline-info border-0"
                                    title="Voir détails">
                                <i class="bi bi-eye"></i>
                            </button>
                            <!-- Bouton Modifier -->
                            <button wire:click="edit({{ $logiciel->id }})"
                                    class="btn btn-sm btn-outline-primary border-0"
                                    title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <!-- Bouton Supprimer -->
                            <button wire:click="confirmDelete({{ $logiciel->id }})"
                                    class="btn btn-sm btn-outline-danger border-0"
                                    title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center py-3">
                        <i class="fas fa-box display-6 text-muted d-block mb-2"></i>
                        <p class="text-muted mb-0 small">Aucun logiciel trouvé</p>
                        @if($search || $editeur || $systeme_exploitation)
                            <button wire:click="resetFilters" class="btn btn-sm btn-outline-primary mt-2">
                                Réinitialiser les filtres
                            </button>
                        @endif
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted small">
            @if($logiciels->count() > 0)
                Affichage de {{ $logiciels->firstItem() }} à {{ $logiciels->lastItem() }} sur {{ $logiciels->total() }} logiciels
            @else
                Aucun logiciel
            @endif
        </div>
        {{ $logiciels->links() }}
    </div>
</div>
    <!-- Modal pour créer/modifier un logiciel -->
    @if($showModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="bi {{ $editMode ? 'bi-pencil' : 'bi-plus-circle' }} me-1"></i>
                        {{ $editMode ? 'Modifier le logiciel' : 'Nouveau Logiciel' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save">
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
                                       placeholder="Nom du logiciel">
                                @error('nom') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Éditeur</label>
                                <input type="text" wire:model="editeur_form"
                                       class="form-control form-control-sm @error('editeur_form') is-invalid @enderror"
                                       placeholder="Éditeur du logiciel">
                                @error('editeur_form') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <!-- Version et compatibilité -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-tags me-1 text-primary"></i>Version et compatibilité
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Nom de version</label>
                                <input type="text" wire:model="version_nom"
                                       class="form-control form-control-sm"
                                       placeholder="2023, 2.1, etc.">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Système d'exploitation</label>
                                <input type="text" wire:model="version_systeme_exploitation"
                                       class="form-control form-control-sm"
                                       placeholder="Windows, Linux, macOS...">
                            </div>

                            <!-- Licences et installations -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-key me-1 text-primary"></i>Licences et installations
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Nombre d'installations</label>
                                <input type="number" wire:model="nombre_installations"
                                       class="form-control form-control-sm"
                                       min="0" placeholder="0">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Nombre de licences</label>
                                <input type="number" wire:model="nombre_licences"
                                       class="form-control form-control-sm"
                                       min="0" placeholder="0">
                            </div>

                            <!-- Dates importantes -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-calendar me-1 text-primary"></i>Dates importantes
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Date d'achat</label>
                                <input type="date" wire:model="date_achat"
                                       class="form-control form-control-sm">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Date d'expiration</label>
                                <input type="date" wire:model="date_expiration"
                                       class="form-control form-control-sm @error('date_expiration') is-invalid @enderror">
                                @error('date_expiration') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="bi bi-sticky me-1 text-primary"></i>Description
                                </h6>
                                <textarea wire:model="description" class="form-control form-control-sm" rows="3"
                                          placeholder="Description du logiciel, fonctionnalités..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal">Annuler</button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span wire:loading.remove>
                                <i class="bi {{ $editMode ? 'bi-check' : 'bi-plus' }} me-1"></i>
                                {{ $editMode ? 'Modifier' : 'Créer' }}
                            </span>
                            <span wire:loading>
                                <i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i>
                                {{ $editMode ? 'Modification...' : 'Création...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de détails du logiciel -->
    @if($showDetailsModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i>Détails du Logiciel
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body">
                    @if($selectedLogiciel)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-cube me-1"></i>Nom</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->nom }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-building me-1"></i>Éditeur</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->editeur ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-tag me-1"></i>Version</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->version_nom ?? 'Non spécifiée' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-windows me-1"></i>Système d'exploitation</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->version_systeme_exploitation ?? 'Non spécifié' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-download me-1"></i>Installations</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->nombre_installations }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-key me-1"></i>Licences</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->nombre_licences }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-circle me-1"></i>Statut des licences</strong>
                                    <p class="mb-0">
                                        @php
                                            $statusClasses = [
                                                'Conforme' => 'badge bg-success badge-sm',
                                                'Alerte' => 'badge bg-warning badge-sm',
                                                'Critique' => 'badge bg-danger badge-sm',
                                                'Aucune licence' => 'badge bg-secondary badge-sm'
                                            ];
                                        @endphp
                                        <span class="{{ $statusClasses[$selectedLogiciel->statut_licences] ?? 'badge bg-info badge-sm' }}">
                                            {{ $selectedLogiciel->statut_licences }}
                                        </span>
                                    </p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-calendar me-1"></i>Date d'expiration</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->date_expiration ? $selectedLogiciel->date_expiration->format('d/m/Y') : 'Non définie' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-file-alt me-1"></i>Description</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->description ?? 'Aucune description' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-calendar-plus me-1"></i>Date de création</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->created_at->format('d/m/Y à H:i') }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-calendar-check me-1"></i>Dernière modification</strong>
                                    <p class="mb-0 small">{{ $selectedLogiciel->updated_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle display-6 text-warning d-block mb-2"></i>
                            <p class="text-muted small">Impossible de charger les détails du logiciel.</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeDetailsModal">Fermer</button>
                    @if($selectedLogiciel)
                        <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $selectedLogiciel->id }})">
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
                        <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer les <strong>{{ count($selectedLogiciels) }}</strong> logiciels sélectionnés ?</p>
                    @else
                        <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer le logiciel <strong>{{ $selectedLogicielName }}</strong> ?</p>
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

    <!-- Modal d'import SIMPLIFIÉE -->
@if($showImportModal)
<div class="modal-backdrop fade show"></div>
<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-upload me-2"></i>Importer des Logiciels
                </h5>
                <button type="button" class="btn-close" wire:click="closeImportModal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info small">
                    <strong>Format CSV requis:</strong><br>
                    Colonnes dans cet ordre:<br>
                    <code>nom, éditeur, version, système, installations, licences, date_achat, date_expiration, description</code>
                </div>
                
                <div class="mb-3">
                    <label class="form-label small">Fichier CSV</label>
                    <input type="file" wire:model="fichierExcel" class="form-control form-control-sm" accept=".csv,.txt">
                    @error('fichierExcel') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <button wire:click="downloadTemplate" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-download me-1"></i>Télécharger le template
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeImportModal">Annuler</button>
                <button type="button" class="btn btn-primary btn-sm" wire:click="importLogiciels" 
                        wire:loading.attr="disabled" {{ !$fichierExcel ? 'disabled' : '' }}>
                    <i class="bi bi-upload me-1"></i>
                    <span wire:loading.remove>Importer</span>
                    <span wire:loading>Import...</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

    <!-- Liens CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</div>