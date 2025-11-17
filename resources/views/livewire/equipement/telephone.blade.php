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
        .icon-purple { background: rgba(102, 16, 242, 0.1); color: #6610f2; }
        
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

        /* Styles spécifiques pour les téléphones */
        .type-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .type-phone {
            background-color: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }
        
        .type-tablet {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
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
                            <i class="fas fa-mobile-alt me-2 text-primary"></i> Gestion des Téléphones et Tablettes
                        </h1>
                        <p class="text-muted small">Inventaire complet des équipements mobiles</p>
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

        <!-- Statistiques TELEPHONES avec le même design -->
        @if($showStats)
        <div class="row mb-4">
            <!-- Total Équipements -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-primary mb-1">{{ $stats['total'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Total Équipements</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-primary ms-3">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En service -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-success mb-1">{{ $stats['enService'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En service</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['enService'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-success ms-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En stock -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-warning mb-1">{{ $stats['enStock'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En stock</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['enStock'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-warning ms-3">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hors service -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-danger mb-1">{{ $stats['horsService'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Hors service</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-danger" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['horsService'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-danger ms-3">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En réparation -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-info mb-1">{{ $stats['enReparation'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En réparation</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['enReparation'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-info ms-3">
                            <i class="fas fa-tools"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taux disponibilité -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            @php
                                $taux = $stats['total'] > 0 ? round((($stats['enService'] + $stats['enStock']) / $stats['total']) * 100) : 0;
                            @endphp
                            <h3 class="stat-number mb-1 {{ $taux >= 80 ? 'text-success' : ($taux >= 50 ? 'text-warning' : 'text-danger') }}">
                                {{ $taux }}%
                            </h3>
                            <p class="text-muted small mb-0 fw-medium">Disponibilité</p>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar {{ $taux >= 80 ? 'bg-success' : ($taux >= 50 ? 'bg-warning' : 'bg-danger') }}" 
                                     style="width: {{ min($taux, 100) }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg {{ $taux >= 80 ? 'icon-success' : ($taux >= 50 ? 'icon-warning' : 'icon-danger') }} ms-3">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Téléphones -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-purple mb-1">{{ $stats['telephones'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Téléphones</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-purple" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['telephones'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-purple ms-3">
                            <i class="fas fa-mobile"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tablettes -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-secondary mb-1">{{ $stats['tablettes'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Tablettes</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-secondary" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['tablettes'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-secondary ms-3">
                            <i class="fas fa-tablet-alt"></i>
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
                               placeholder="Nom, usager, série, marque...">
                    </div>
                </div>

                <!-- Statut -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Statut</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="fas fa-circle"></i>
                        </span>
                        <select wire:model.live="filterStatut" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les statuts</option>
                            <option value="En service">En service</option>
                            <option value="En stock">En stock</option>
                            <option value="Hors service">Hors service</option>
                            <option value="En réparation">En réparation</option>
                        </select>
                    </div>
                </div>

                <!-- Type -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Type</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="fas fa-mobile-alt"></i>
                        </span>
                        <select wire:model.live="filterType" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les types</option>
                            <option value="Téléphone">Téléphone</option>
                            <option value="Tablette">Tablette</option>
                        </select>
                    </div>
                </div>

                <!-- Marque -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Marque</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="fas fa-tag"></i>
                        </span>
                        <select wire:model.live="filterFabricant" class="form-select border-0 bg-light rounded-2">
                            <option value="">Toutes les marques</option>
                            @foreach($fabricants as $fabricant)
                                <option value="{{ $fabricant }}">{{ $fabricant }}</option>
                            @endforeach
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
                        <button wire:click="exportToCsv" class="btn btn-outline-primary btn-sm d-flex align-items-center">
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
            @if($search || $filterStatut || $filterType || $filterFabricant)
            <div class="mt-3 pt-2 border-top">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-muted small">Filtres actifs :</span>
                    @if($search)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Recherche: "{{ $search }}"
                        <button wire:click="$set('search', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($filterStatut)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Statut: {{ $filterStatut }}
                        <button wire:click="$set('filterStatut', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($filterType)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Type: {{ $filterType }}
                        <button wire:click="$set('filterType', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($filterFabricant)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Marque: {{ $filterFabricant }}
                        <button wire:click="$set('filterFabricant', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Tableau -->
        <div class="dashboard-card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <h5 class="fw-semibold mb-0">Liste des Équipements</h5>
                @if(count($selectedTelephones) > 0)
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">{{ count($selectedTelephones) }} sélectionné(s)</span>
                    <button wire:click="confirmDeleteSelected" class="btn btn-danger btn-sm">
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
                            <th wire:click="sortBy('type')" style="cursor: pointer;">
                                Type
                                @if ($sortField === 'type')
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
                            <th>Marque/Modèle</th>
                            <th>Entité/Usager</th>
                            <th>Localisation</th>
                            <th>Numéro Série</th>
                            <th>IMEI</th>
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
                    @forelse($telephones as $telephone)
                        <tr>
                            <td>
                                <input type="checkbox" wire:model="selectedTelephones" value="{{ $telephone->id }}" class="form-check-input">
                            </td>
                            <td class="fw-medium small">{{ $telephone->nom }}</td>
                            <td>
                                <span class="type-badge {{ $telephone->type === 'Téléphone' ? 'type-phone' : 'type-tablet' }}">
                                    {{ $telephone->type }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'En service' => 'badge bg-success badge-sm',
                                        'En stock' => 'badge bg-warning badge-sm',
                                        'Hors service' => 'badge bg-danger badge-sm',
                                        'En réparation' => 'badge bg-info badge-sm'
                                    ];
                                @endphp
                                <span class="{{ $statusClasses[$telephone->statut] ?? 'badge bg-secondary badge-sm' }}">
                                    {{ $telephone->statut }}
                                </span>
                            </td>
                            <td class="small">
                                <div class="fw-medium">{{ $telephone->marque ?? 'N/A' }}</div>
                                <div class="text-muted">{{ $telephone->modele ?? '' }}</div>
                            </td>
                            <td class="small">
                                <div>{{ $telephone->entite ?? '-' }}</div>
                                @if($telephone->usager)
                                    <div class="text-muted">{{ $telephone->usager }}</div>
                                @endif
                            </td>
                            <td class="small">
                                <div>{{ $telephone->lieu ?? 'N/A' }}</div>
                                @if($telephone->emplacement_actuel)
                                    <div class="text-muted">{{ $telephone->emplacement_actuel }}</div>
                                @endif
                            </td>
                            <td class="small font-monospace">{{ $telephone->numero_serie ?? 'N/A' }}</td>
                            <td class="small font-monospace">
                                @if($telephone->imei)
                                    {{ substr($telephone->imei, 0, 8) }}...
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="small">{{ $telephone->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- Bouton Voir Détails -->
                                    <button wire:click="showDetails({{ $telephone->id }})"
                                            class="btn btn-sm btn-outline-info border-0"
                                            title="Voir détails">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <!-- Bouton Modifier -->
                                    <button wire:click="edit({{ $telephone->id }})"
                                            class="btn btn-sm btn-outline-primary border-0"
                                            title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <!-- Bouton Supprimer -->
                                    <button wire:click="confirmDelete({{ $telephone->id }})"
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
                                <i class="fas fa-mobile-alt display-6 text-muted d-block mb-2"></i>
                                <p class="text-muted mb-0 small">Aucun équipement trouvé</p>
                                @if($search || $filterStatut || $filterType || $filterFabricant)
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
                    @if($telephones->count() > 0)
                        Affichage de {{ $telephones->firstItem() }} à {{ $telephones->lastItem() }} sur {{ $telephones->total() }} équipements
                    @else
                        Aucun équipement
                    @endif
                </div>
                {{ $telephones->links() }}
            </div>
        </div>
    </div><!-- Modal d'import DIRECTE (sans mapping) -->
@if($showImportModal)
<div class="modal-backdrop fade show"></div>
<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title small fw-semibold">
                    <i class="bi bi-upload me-1"></i>Importer des Équipements
                </h5>
                <button type="button" class="btn-close btn-close-sm" wire:click="closeImportModal"></button>
            </div>
            <div class="modal-body p-3">
                <div class="alert alert-info small">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Format CSV requis:</strong> Les colonnes doivent être dans cet ordre exact:<br>
                    <code>nom, entite, usager, lieu, services, type, marque, modele, numero_serie, statut, emplacement_actuel, imei</code>
                </div>
                
                <div class="mb-3">
                    <label class="form-label small fw-medium">Fichier CSV</label>
                    <input type="file" wire:model="importFile" class="form-control form-control-sm" accept=".csv,.txt">
                    @error('importFile') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                @if($importFile)
                <div class="alert alert-success small">
                    <i class="bi bi-check-circle me-2"></i>
                    Fichier sélectionné: <strong>{{ $importFile->getClientOriginalName() }}</strong>
                </div>
                @endif

                @if($importErrors && count($importErrors) > 0)
                <div class="alert alert-danger small">
                    <h6 class="alert-heading small mb-2">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Erreurs d'importation:
                    </h6>
                    <ul class="mb-0 small">
                        @foreach($importErrors as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mb-3">
                    <button type="button" wire:click="downloadTemplate" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-download me-1"></i>Télécharger le template
                    </button>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeImportModal">Annuler</button>
                <button type="button" class="btn btn-primary btn-sm" wire:click="importTelephones" 
                        wire:loading.attr="disabled" {{ !$importFile ? 'disabled' : '' }}>
                    <i class="bi bi-upload me-1"></i>
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

    <!-- Modal pour créer/modifier un équipement -->
    @if($showModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="fas {{ $isEditing ? 'fa-edit' : 'fa-plus' }} me-1"></i>
                        {{ $isEditing ? 'Modifier l\'équipement' : 'Nouvel équipement' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <!-- Informations de base -->
                            <div class="col-12 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="fas fa-info-circle me-1 text-primary"></i>Informations de base
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Nom <span class="text-danger">*</span></label>
                                <input type="text" wire:model="nom"
                                       class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                       placeholder="Ex: TEL-IT-001, TAB-ADM-002">
                                @error('nom') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Type <span class="text-danger">*</span></label>
                                <select wire:model="type" class="form-select form-control-sm @error('type') is-invalid @enderror">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="Téléphone">Téléphone</option>
                                    <option value="Tablette">Tablette</option>
                                </select>
                                @error('type') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <!-- Marque et Modèle -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="fas fa-tags me-1 text-primary"></i>Caractéristiques
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Marque <span class="text-danger">*</span></label>
                                <input type="text" wire:model="marque"
                                       class="form-control form-control-sm @error('marque') is-invalid @enderror"
                                       placeholder="Ex: Apple, Samsung, Huawei">
                                @error('marque') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Modèle <span class="text-danger">*</span></label>
                                <input type="text" wire:model="modele"
                                       class="form-control form-control-sm @error('modele') is-invalid @enderror"
                                       placeholder="Ex: iPhone 14, Galaxy S23">
                                @error('modele') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <!-- Numéro de série et IMEI -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Numéro de série <span class="text-danger">*</span></label>
                                <input type="text" wire:model="numero_serie"
                                       class="form-control form-control-sm @error('numero_serie') is-invalid @enderror"
                                       placeholder="Numéro de série unique">
                                @error('numero_serie') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">IMEI</label>
                                <input type="text" wire:model="imei"
                                       class="form-control form-control-sm @error('imei') is-invalid @enderror"
                                       placeholder="Numéro IMEI (15 chiffres)">
                                @error('imei') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <!-- Statut et Localisation -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="fas fa-map-marker-alt me-1 text-primary"></i>Localisation et statut
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Statut <span class="text-danger">*</span></label>
                                <select wire:model="statut" class="form-select form-control-sm @error('statut') is-invalid @enderror">
                                    <option value="En service">En service</option>
                                    <option value="En stock">En stock</option>
                                    <option value="En réparation">En réparation</option>
                                    <option value="Hors service">Hors service</option>
                                </select>
                                @error('statut') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Lieu <span class="text-danger">*</span></label>
                                <input type="text" wire:model="lieu"
                                       class="form-control form-control-sm @error('lieu') is-invalid @enderror"
                                       placeholder="Ex: Bureau 101, Entrepôt">
                                @error('lieu') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Emplacement actuel <span class="text-danger">*</span></label>
                                <input type="text" wire:model="emplacement_actuel"
                                       class="form-control form-control-sm @error('emplacement_actuel') is-invalid @enderror"
                                       placeholder="Localisation précise">
                                @error('emplacement_actuel') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Entité</label>
                                <input type="text" wire:model="entite"
                                       class="form-control form-control-sm"
                                       placeholder="Ex: Direction, IT, Commercial">
                            </div>

                            <!-- Usager et Services -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="text-dark fw-medium mb-2 small border-bottom pb-1">
                                    <i class="fas fa-user me-1 text-primary"></i>Assignation
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Usager</label>
                                <input type="text" wire:model="usager"
                                       class="form-control form-control-sm"
                                       placeholder="Personne assignée">
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label small fw-medium">Services/Plugins</label>
                                <textarea wire:model="services" class="form-control form-control-sm" rows="3"
                                          placeholder="Services installés, configurations..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal">Annuler</button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span wire:loading.remove>
                                <i class="fas {{ $isEditing ? 'fa-check' : 'fa-plus' }} me-1"></i>
                                {{ $isEditing ? 'Modifier' : 'Créer' }}
                            </span>
                            <span wire:loading>
                                <i class="fas fa-spinner fa-spin me-1"></i>
                                {{ $isEditing ? 'Modification...' : 'Création...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de confirmation de suppression -->
    @if($confirmingDelete)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" wire:click="cancelDelete"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-danger display-5"></i>
                        <h4 class="mt-2 h5">Êtes-vous sûr ?</h4>
                        <p class="text-muted small">
                            Vous êtes sur le point de supprimer cet équipement. 
                            Cette action est irréversible.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="cancelDelete">Annuler</button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete">
                        <i class="fas fa-trash me-1"></i>Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de détails du téléphone -->
@if($showDetailsModal)
<div class="modal-backdrop fade show"></div>
<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle me-2"></i>Détails de l'Équipement
                </h5>
                <button type="button" class="btn-close" wire:click="closeDetailsModal"></button>
            </div>
            <div class="modal-body">
                @if($selectedTelephone)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-mobile-alt me-1"></i>Nom</strong>
                                <p class="mb-0 small">{{ $selectedTelephone->nom }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-tag me-1"></i>Type</strong>
                                <p class="mb-0 small">{{ $selectedTelephone->type }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-building me-1"></i>Marque/Modèle</strong>
                                <p class="mb-0 small">{{ $selectedTelephone->marque }} {{ $selectedTelephone->modele }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-hashtag me-1"></i>Numéro de série</strong>
                                <p class="mb-0 small font-monospace">{{ $selectedTelephone->numero_serie }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-circle me-1"></i>Statut</strong>
                                <p class="mb-0">
                                    @php
                                        $statusClasses = [
                                            'En service' => 'badge bg-success badge-sm',
                                            'En stock' => 'badge bg-warning badge-sm',
                                            'Hors service' => 'badge bg-danger badge-sm',
                                            'En réparation' => 'badge bg-info badge-sm'
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$selectedTelephone->statut] ?? 'badge bg-secondary badge-sm' }}">
                                        {{ $selectedTelephone->statut }}
                                    </span>
                                </p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-map-marker-alt me-1"></i>Localisation</strong>
                                <p class="mb-0 small">{{ $selectedTelephone->lieu }}</p>
                                @if($selectedTelephone->emplacement_actuel)
                                    <p class="mb-0 small text-muted">{{ $selectedTelephone->emplacement_actuel }}</p>
                                @endif
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-user me-1"></i>Usager</strong>
                                <p class="mb-0 small">{{ $selectedTelephone->usager ?? 'Non assigné' }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-barcode me-1"></i>IMEI</strong>
                                <p class="mb-0 small font-monospace">{{ $selectedTelephone->imei ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($selectedTelephone->services)
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-cogs me-1"></i>Services/Plugins</strong>
                                <p class="mb-0 small">{{ $selectedTelephone->services }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle display-6 text-warning d-block mb-2"></i>
                        <p class="text-muted small">Impossible de charger les détails de l'équipement.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeDetailsModal">Fermer</button>
                @if($selectedTelephone)
                    <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $selectedTelephone->id }})">
                        <i class="fas fa-edit me-1"></i>Modifier
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

    <!-- Liens CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</div>