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
        
        * {
            font-size: 13px;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        
        .dashboard-card:hover {
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }
        
        .stat-card {
            padding: 0; /* On utilise p-3 sur le contenu interne maintenant */
        }
        
        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        
        .stat-icon-lg {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
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
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 2px;
        }
        
        .stat-label {
            font-size: 0.7rem;
            color: #6c757d;
            margin-bottom: 0;
        }
        
        .progress-sm {
            height: 3px;
            margin-top: 6px;
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
            font-size: 0.8rem;
        }
        
        .search-box .form-control {
            padding-left: 28px;
            font-size: 0.75rem;
        }
        
        .badge-sm {
            font-size: 0.65rem;
            padding: 0.2em 0.4em;
        }
        
        .table th {
            font-size: 0.7rem;
            font-weight: 600;
            color: #495057;
            padding: 8px 6px;
        }
        
        .table td {
            font-size: 0.7rem;
            vertical-align: middle;
            padding: 8px 6px;
        }
        
        .btn {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
        }
        
        .btn-sm {
            padding: 0.15rem 0.4rem;
            font-size: 0.65rem;
        }
        
        .form-label {
            font-size: 0.65rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .form-control-sm, .form-select-sm {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
            height: 38px !important;
            border-radius: 10px !important;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-control-sm:focus, .form-select-sm:focus {
            background-color: #ffffff !important;
            border-color: #4fbbb2 !important;
            box-shadow: 0 0 0 3px rgba(79, 187, 178, 0.1) !important;
            transform: translateY(-1px);
        }
        
        .form-select-sm {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.6rem center;
            background-size: 10px 10px;
        }
        
        .modal-title {
            font-size: 0.95rem;
            font-weight: 600;
        }
        
        .detail-item {
            padding: 0.2rem 0;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-item strong {
            font-size: 0.7rem;
            color: #495057;
            display: flex;
            align-items: center;
            margin-bottom: 2px;
        }
        
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
        
        .bg-light {
            background-color: #f8f9fa !important;
        }
        
        .rounded-2 {
            border-radius: 6px !important;
        }
        
        .btn {
            border-radius: 4px !important;
        }
        
        .type-badge {
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-size: 0.65rem;
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
        
        h1.h4 {
            font-size: 1.1rem;
        }
        
        .text-muted.small {
            font-size: 0.7rem;
        }
        
        .fw-semibold {
            font-weight: 600;
        }
        
        .container-fluid.py-3 {
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
        }
        
        .mb-3 {
            margin-bottom: 0.75rem !important;
        }
        
        .mb-4 {
            margin-bottom: 1rem !important;
        }
        
        .gap-2 {
            gap: 0.4rem !important;
        }
        
        .g-3 {
            gap: 0.6rem !important;
        }
        
        .p-3 {
            padding: 0.75rem !important;
        }
        
        /* Boutons personnalisés Thème Teal */
        .btn-teal, .btn-outline-teal {
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            padding: 0 1.25rem !important;
            height: 38px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.5rem !important;
            border-radius: 10px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            white-space: nowrap !important;
        }
        
        .btn-teal {
            background-color: #4fbbb2 !important;
            border-color: #4fbbb2 !important;
            color: white !important;
        }
        
        .btn-teal:hover {
            background-color: #3d9d95 !important;
            border-color: #3d9d95 !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 187, 178, 0.3) !important;
        }
        
        .btn-outline-teal {
            color: #4fbbb2 !important;
            border-color: #4fbbb2 !important;
            background: transparent !important;
        }
        
        .btn-outline-teal:hover {
            background-color: #4fbbb2 !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 187, 178, 0.1) !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #filters-container .col-md-3,
            #filters-container .col-md-2 {
                margin-bottom: 0.5rem;
            }
            
            .btn span.d-none.d-lg-inline {
                display: inline !important;
            }
        }
    </style>

    <!-- Contenu principal -->
    <div class="container-fluid py-2">
        <!-- Header -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                    <div>
                        <h1 class="h5 fw-semibold text-dark mb-0">
                            <i class="fas fa-mobile-alt me-2 text-primary"></i> Gestion des Téléphones et Tablettes
                        </h1>
                        <p class="text-muted small mb-0">Inventaire mobile</p>
                    </div>
                    <div class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-outline-primary btn-sm d-flex align-items-center" wire:click="toggleStats">
                            <i class="fas fa-chart-bar me-1 small"></i>
                            {{ $showStats ? 'Masquer' : 'Stats' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages flash -->
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show small py-1 mb-2" role="alert">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" style="font-size: 0.6rem;"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show small py-1 mb-2" role="alert">
                <i class="fas fa-exclamation-triangle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" style="font-size: 0.6rem;"></button>
            </div>
        @endif

        <!-- Statistiques -->
        @if($showStats)
        <div class="row g-4 mb-4">
            <!-- Total -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="dashboard-card stat-card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="stat-label text-uppercase letter-spacing-1 fw-bold mb-1" style="font-size: 0.65rem; color: #64748b;">Total Équipements</div>
                            <div class="stat-number text-primary" style="font-size: 1.75rem;">{{ $stats['total'] ?? 0 }}</div>
                        </div>
                        <div class="stat-icon-lg icon-primary shadow-sm">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm rounded-0" style="height: 4px;"><div class="progress-bar bg-primary" style="width: 100%"></div></div>
                </div>
            </div>

            <!-- En service -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="dashboard-card stat-card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="stat-label text-uppercase letter-spacing-1 fw-bold mb-1" style="font-size: 0.65rem; color: #64748b;">En Service</div>
                            <div class="stat-number text-success" style="font-size: 1.75rem;">{{ $stats['enService'] ?? 0 }}</div>
                        </div>
                        <div class="stat-icon-lg icon-success shadow-sm">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm rounded-0" style="height: 4px;"><div class="progress-bar bg-success" style="width: {{ $stats['total'] > 0 ? ($stats['enService'] / $stats['total'] * 100) : 0 }}%"></div></div>
                </div>
            </div>

            <!-- En stock -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="dashboard-card stat-card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="stat-label text-uppercase letter-spacing-1 fw-bold mb-1" style="font-size: 0.65rem; color: #64748b;">En Stock</div>
                            <div class="stat-number text-warning" style="font-size: 1.75rem;">{{ $stats['enStock'] ?? 0 }}</div>
                        </div>
                        <div class="stat-icon-lg icon-warning shadow-sm">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm rounded-0" style="height: 4px;"><div class="progress-bar bg-warning" style="width: {{ $stats['total'] > 0 ? ($stats['enStock'] / $stats['total'] * 100) : 0 }}%"></div></div>
                </div>
            </div>

            <!-- Hors service -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="dashboard-card stat-card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="stat-label text-uppercase letter-spacing-1 fw-bold mb-1" style="font-size: 0.65rem; color: #64748b;">Hors Service</div>
                            <div class="stat-number text-danger" style="font-size: 1.75rem;">{{ $stats['horsService'] ?? 0 }}</div>
                        </div>
                        <div class="stat-icon-lg icon-danger shadow-sm">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm rounded-0" style="height: 4px;"><div class="progress-bar bg-danger" style="width: {{ $stats['total'] > 0 ? ($stats['horsService'] / $stats['total'] * 100) : 0 }}%"></div></div>
                </div>
            </div>

            <!-- En réparation -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="dashboard-card stat-card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="stat-label text-uppercase letter-spacing-1 fw-bold mb-1" style="font-size: 0.65rem; color: #64748b;">Réparation</div>
                            <div class="stat-number text-info" style="font-size: 1.75rem;">{{ $stats['enReparation'] ?? 0 }}</div>
                        </div>
                        <div class="stat-icon-lg icon-info shadow-sm">
                            <i class="fas fa-tools"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm rounded-0" style="height: 4px;"><div class="progress-bar bg-info" style="width: {{ $stats['total'] > 0 ? ($stats['enReparation'] / $stats['total'] * 100) : 0 }}%"></div></div>
                </div>
            </div>

            <!-- Disponibilité -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="dashboard-card stat-card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="stat-label text-uppercase letter-spacing-1 fw-bold mb-1" style="font-size: 0.65rem; color: #64748b;">Disponibilité</div>
                            @php $taux = $stats['total'] > 0 ? round((($stats['enService'] + $stats['enStock']) / $stats['total']) * 100) : 0; @endphp
                            <div class="stat-number {{ $taux >= 80 ? 'text-success' : ($taux >= 50 ? 'text-warning' : 'text-danger') }}" style="font-size: 1.75rem;">{{ $taux }}%</div>
                        </div>
                        <div class="stat-icon-lg {{ $taux >= 80 ? 'icon-success' : ($taux >= 50 ? 'icon-warning' : 'icon-danger') }} shadow-sm">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm rounded-0" style="height: 4px;"><div class="progress-bar {{ $taux >= 80 ? 'bg-success' : ($taux >= 50 ? 'bg-warning' : 'bg-danger') }}" style="width: {{ min($taux, 100) }}%"></div></div>
                </div>
            </div>

            <!-- Téléphones -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="dashboard-card stat-card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="stat-label text-uppercase letter-spacing-1 fw-bold mb-1" style="font-size: 0.65rem; color: #64748b;">Téléphones</div>
                            <div class="stat-number" style="font-size: 1.75rem; color: #6610f2;">{{ $stats['telephones'] ?? 0 }}</div>
                        </div>
                        <div class="stat-icon-lg icon-purple shadow-sm">
                            <i class="fas fa-mobile"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm rounded-0" style="height: 4px;"><div class="progress-bar bg-purple" style="width: {{ $stats['total'] > 0 ? ($stats['telephones'] / $stats['total'] * 100) : 0 }}%"></div></div>
                </div>
            </div>

            <!-- Tablettes -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="dashboard-card stat-card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between p-3">
                        <div>
                            <div class="stat-label text-uppercase letter-spacing-1 fw-bold mb-1" style="font-size: 0.65rem; color: #64748b;">Tablettes</div>
                            <div class="stat-number text-secondary" style="font-size: 1.75rem;">{{ $stats['tablettes'] ?? 0 }}</div>
                        </div>
                        <div class="stat-icon-lg icon-secondary shadow-sm">
                            <i class="fas fa-tablet-alt"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm rounded-0" style="height: 4px;"><div class="progress-bar bg-secondary" style="width: {{ $stats['total'] > 0 ? ($stats['tablettes'] / $stats['total'] * 100) : 0 }}%"></div></div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filtres -->
        <div class="dashboard-card border-0 shadow-sm rounded-4 p-3 mb-4" style="background: #ffffff;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1" style="font-size: 0.75rem; color: #64748b;">
                    <i class="bi bi-filter-left me-2"></i>Filtrer les équipements
                </h6>
            </div>

            <div class="d-flex flex-wrap align-items-end justify-content-between gap-3" id="filters-container">
                <!-- Actions à gauche -->
                <div class="d-flex align-items-end gap-2">
                    <button wire:click="create" class="btn btn-teal btn-sm px-4 shadow-sm">
                        <i class="bi bi-plus-lg me-1"></i> Nouveau
                    </button>
                    
                    <div class="d-flex gap-1">
                        <button wire:click="openImportModal" class="btn btn-outline-teal btn-sm px-3">
                            <i class="bi bi-upload me-1"></i> Import
                        </button>
                        
                        <div class="dropdown">
                            <button class="btn btn-outline-teal btn-sm dropdown-toggle px-3" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-download me-1"></i> Export
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                <li><button class="dropdown-item small py-2" wire:click="export('xlsx')"><i class="bi bi-file-earmark-excel me-2 text-success"></i> Excel</button></li>
                                <li><button class="dropdown-item small py-2" wire:click="export('csv')"><i class="bi bi-file-earmark-text me-2 text-primary"></i> CSV</button></li>
                                <li><button class="dropdown-item small py-2" wire:click="export('pdf')"><i class="bi bi-file-earmark-pdf me-2 text-danger"></i> PDF</button></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Espace vide automatique (flex-grow-1 sur un spacer si besoin, ou justify-content-between) -->

                <!-- Filtres à droite -->
                <div class="d-flex flex-wrap align-items-end gap-2 ms-auto">
                    <!-- Recherche -->
                    <div style="min-width: 200px;">
                        <label class="form-label text-start mb-1">Recherche</label>
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                   class="form-control form-control-sm ps-5 bg-light"
                                   placeholder="Rechercher...">
                        </div>
                    </div>

                    <!-- Statut -->
                    <div style="min-width: 120px;">
                        <label class="form-label text-start mb-1">Statut</label>
                        <select wire:model.live="filterStatut" class="form-select form-select-sm bg-light">
                            <option value="">Tous</option>
                            <option value="En service">Service</option>
                            <option value="En stock">Stock</option>
                            <option value="Hors service">HS</option>
                            <option value="En réparation">Répar.</option>
                        </select>
                    </div>

                    <!-- Type -->
                    <div style="min-width: 100px;">
                        <label class="form-label text-start mb-1">Type</label>
                        <select wire:model.live="filterType" class="form-select form-select-sm bg-light">
                            <option value="">Tous</option>
                            <option value="Téléphone">Tél</option>
                            <option value="Tablette">Tab</option>
                        </select>
                    </div>

                    <!-- Marque -->
                    <div style="min-width: 140px;">
                        <label class="form-label text-start mb-1">Marque</label>
                        <select wire:model.live="filterFabricant" class="form-select form-select-sm bg-light">
                            <option value="">Toutes</option>
                            @foreach($fabricants as $fabricant)
                                <option value="{{ $fabricant }}">{{ $fabricant }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Reset -->
                    <div class="pb-1">
                        <button wire:click="resetFilters" class="btn btn-link text-decoration-none text-muted p-0 ms-2" title="Réinitialiser">
                            <i class="bi bi-arrow-clockwise"></i> <small>Reset</small>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filtres actifs -->
            @if($search || $filterStatut || $filterType || $filterFabricant)
            <div class="mt-2 pt-1 border-top">
                <div class="d-flex align-items-center gap-1 flex-wrap">
                    <span class="text-muted small">Actifs :</span>
                    @if($search)
                    <span class="badge bg-light text-dark border small py-0 px-1">Recherche: "{{ $search }}" <button wire:click="$set('search', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.5rem;"></button></span>
                    @endif
                    @if($filterStatut)
                    <span class="badge bg-light text-dark border small py-0 px-1">Statut: {{ $filterStatut }} <button wire:click="$set('filterStatut', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.5rem;"></button></span>
                    @endif
                    @if($filterType)
                    <span class="badge bg-light text-dark border small py-0 px-1">Type: {{ $filterType }} <button wire:click="$set('filterType', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.5rem;"></button></span>
                    @endif
                    @if($filterFabricant)
                    <span class="badge bg-light text-dark border small py-0 px-1">Marque: {{ $filterFabricant }} <button wire:click="$set('filterFabricant', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.5rem;"></button></span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Tableau -->
        <div class="dashboard-card p-2">
            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-1">
                <h6 class="fw-semibold mb-0 small">Équipements</h6>
                @if(count($selectedTelephones) > 0)
                <div class="d-flex align-items-center gap-1">
                    <span class="text-muted small">{{ count($selectedTelephones) }} sélectionné(s)</span>
                    <button wire:click="confirmBulkDelete" class="btn btn-danger btn-sm py-0 px-2">
                        <i class="bi bi-trash me-0"></i> Suppr.
                    </button>
                </div>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 25px;"><input type="checkbox" wire:model="selectAll" class="form-check-input m-0"></th>
                            <th wire:click="sortBy('nom')" style="cursor: pointer;">Nom @if ($sortField === 'nom')<i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>@endif</th>
                            <th wire:click="sortBy('type')" style="cursor: pointer;">Type @if ($sortField === 'type')<i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>@endif</th>
                            <th wire:click="sortBy('statut')" style="cursor: pointer;">Statut @if ($sortField === 'statut')<i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>@endif</th>
                            <th>Marque/Modèle</th>
                            <th>Entité</th>
                            <th>Usager</th>
                            <th>Localisation</th>
                            <th>N° Série</th>
                            <th>N° Appel</th>
                            <th>IMEI</th>
                            <th wire:click="sortBy('updated_at')" style="cursor: pointer;">Modif. @if ($sortField === 'updated_at')<i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>@endif</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($telephones as $telephone)
                        <tr>
                            <td><input type="checkbox" wire:model="selectedTelephones" value="{{ $telephone->id }}" class="form-check-input m-0"></td>
                            <td class="fw-medium">{{ $telephone->nom }}</td>
                            <td><span class="type-badge {{ $telephone->type === 'Téléphone' ? 'type-phone' : 'type-tablet' }}">{{ $telephone->type }}</span></td>
                            <td><span class="badge {{ $telephone->statut == 'En service' ? 'bg-success' : ($telephone->statut == 'En stock' ? 'bg-warning' : ($telephone->statut == 'En réparation' ? 'bg-info' : 'bg-danger')) }} badge-sm">{{ $telephone->statut }}</span></td>
                            <td><span class="fw-medium">{{ $telephone->marque ?? 'N/A' }}</span><br><span class="text-muted">{{ $telephone->modele ?? '' }}</span></td>
                            <td>{{ $telephone->entite ?? '-' }}</td>
                            <td>
                                @php $liaisonActive = \App\Models\liaison_equipement::with(['utilisateur'])->where('telephone_id', $telephone->id)->where('statut', 'actif')->first(); @endphp
                                @if($liaisonActive && $liaisonActive->utilisateur)<span class="badge bg-light text-dark border small"><i class="bi bi-person-fill me-1 text-primary"></i>{{ $liaisonActive->utilisateur->nom }}</span>@else<span class="text-muted">-</span>@endif
                            </td>
                            <td>{{ $telephone->lieu ?? '-' }}</td>
                            <td class="font-monospace">{{ $telephone->numero_serie ?? '-' }}</td>
                            <td class="fw-bold text-primary">{{ $telephone->numero_appel ?? '-' }}</td>
                            <td class="font-monospace">@if($telephone->imei){{ substr($telephone->imei, 0, 8) }}...@else - @endif</td>
                            <td>{{ $telephone->updated_at->format('d/m/y') }}</td>
                            <td>
                                <div class="d-flex gap-0">
                                    <button wire:click="showDetails({{ $telephone->id }})" class="btn btn-sm btn-outline-info border-0 py-0 px-1" title="Détails"><i class="bi bi-eye small"></i></button>
                                    <button wire:click="edit({{ $telephone->id }})" class="btn btn-sm btn-outline-primary border-0 py-0 px-1" title="Modifier"><i class="bi bi-pencil small"></i></button>
                                    <button wire:click="confirmDelete({{ $telephone->id }})" class="btn btn-sm btn-outline-danger border-0 py-0 px-1" title="Supprimer"><i class="bi bi-trash small"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="13" class="text-center py-2"><i class="fas fa-mobile-alt text-muted d-block mb-1"></i><span class="text-muted small">Aucun équipement</span>@if($search || $filterStatut || $filterType || $filterFabricant)<button wire:click="resetFilters" class="btn btn-sm btn-outline-primary mt-1 py-0 px-2">Réinitialiser</button>@endif</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-2 pt-1 border-top">
                <div class="text-muted small">@if($telephones->count() > 0){{ $telephones->firstItem() }}-{{ $telephones->lastItem() }}/{{ $telephones->total() }}@else 0 @endif</div>
                {{ $telephones->links() }}
            </div>
        </div>
    </div>

    <!-- Modal d'import -->
    @if($showImportModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h6 class="modal-title small fw-semibold"><i class="bi bi-upload me-1"></i>Importer</h6>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeImportModal"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="alert alert-info small py-1 mb-2"><i class="bi bi-info-circle me-1"></i>Format: nom, entite, usager, lieu, services, type, marque, modele, numero_serie, statut, emplacement_actuel, imei</div>
                    <input type="file" wire:model="importFile" class="form-control form-control-sm" accept=".xlsx,.xls,.csv">
                    @error('importFile') <span class="text-danger small">{{ $message }}</span> @enderror
                    @if($importErrors && count($importErrors) > 0)<div class="alert alert-danger small mt-2 py-1"><ul class="mb-0 small ps-3">@foreach($importErrors as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                    <button type="button" wire:click="downloadTemplate" class="btn btn-outline-primary btn-sm mt-2 w-100">Télécharger le template</button>
                </div>
                <div class="modal-footer py-1 justify-content-between">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeImportModal">Annuler</button>
                    <button type="button" class="btn btn-primary btn-sm" wire:click="storeImportFile" {{ !$importFile ? 'disabled' : '' }}>Suivant</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal formulaire -->
    @if($showModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h6 class="modal-title small fw-semibold"><i class="fas {{ $isEditing ? 'fa-edit' : 'fa-plus' }} me-1"></i>{{ $isEditing ? 'Modifier' : 'Nouvel équipement' }}</h6>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-2" style="max-height: 60vh; overflow-y: auto;">
                        <div class="row g-1">
                            <div class="col-12 mb-1"><h6 class="small fw-semibold mb-0 border-bottom pb-1">Informations</h6></div>
                            <div class="col-md-6"><label class="form-label">Nom *</label><input type="text" wire:model="nom" class="form-control form-control-sm @error('nom') is-invalid @enderror">@error('nom')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label">Type *</label><select wire:model="type" class="form-select form-control-sm @error('type') is-invalid @enderror"><option value="">Sélectionnez</option><option value="Téléphone">Téléphone</option><option value="Tablette">Tablette</option></select>@error('type')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label">Marque *</label><input type="text" wire:model="marque" class="form-control form-control-sm @error('marque') is-invalid @enderror">@error('marque')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label">Modèle *</label><input type="text" wire:model="modele" class="form-control form-control-sm @error('modele') is-invalid @enderror">@error('modele')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-4"><label class="form-label">N° Série *</label><input type="text" wire:model="numero_serie" class="form-control form-control-sm @error('numero_serie') is-invalid @enderror">@error('numero_serie')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-4"><label class="form-label">IMEI</label><input type="text" wire:model="imei" class="form-control form-control-sm @error('imei') is-invalid @enderror">@error('imei')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-4"><label class="form-label">N° Appel</label><input type="text" wire:model="numero_appel" class="form-control form-control-sm">@error('numero_appel')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label">Statut *</label><select wire:model="statut" class="form-select form-control-sm @error('statut') is-invalid @enderror"><option value="En service">En service</option><option value="En stock">En stock</option><option value="En réparation">En réparation</option><option value="Hors service">Hors service</option></select>@error('statut')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label">Lieu *</label><input type="text" wire:model="lieu" class="form-control form-control-sm @error('lieu') is-invalid @enderror">@error('lieu')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label">Emplacement</label><input type="text" wire:model="emplacement_actuel" class="form-control form-control-sm">@error('emplacement_actuel')<div class="invalid-feedback small">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label">Entité</label><input type="text" wire:model="entite" class="form-control form-control-sm"></div>
                            <div class="col-md-6"><label class="form-label">Usager</label><input type="text" wire:model="usager" class="form-control form-control-sm"></div>
                            <div class="col-12"><label class="form-label">Services</label><textarea wire:model="services" class="form-control form-control-sm" rows="2"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal">Annuler</button>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas {{ $isEditing ? 'fa-check' : 'fa-plus' }} me-1"></i>{{ $isEditing ? 'Modifier' : 'Créer' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal suppression -->
    @if($confirmingDelete)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white py-1">
                    <h6 class="modal-title small fw-semibold"><i class="bi bi-exclamation-triangle me-1"></i>Confirmation</h6>
                    <button type="button" class="btn-close btn-close-white btn-close-sm" wire:click="cancelDelete"></button>
                </div>
                <div class="modal-body p-2 text-center">
                    <i class="bi bi-trash3 text-danger" style="font-size: 1.5rem;"></i>
                    <p class="small mb-0 mt-1">Supprimer @if($isBulkDelete){{ count($selectedTelephones) }} équipements@else"{{ $telephoneName }}"@endif ?</p>
                </div>
                <div class="modal-footer py-1 justify-content-center">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="cancelDelete">Annuler</button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete">Confirmer</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal détails -->
    @if($showDetailsModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h6 class="modal-title small fw-semibold"><i class="fas fa-info-circle me-1"></i>Détails</h6>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body p-2">
                    @if($selectedTelephone)
                        <div class="detail-item"><strong>Nom</strong><span class="small">{{ $selectedTelephone->nom }}</span></div>
                        <div class="detail-item"><strong>Type</strong><span class="small">{{ $selectedTelephone->type }}</span></div>
                        <div class="detail-item"><strong>Marque/Modèle</strong><span class="small">{{ $selectedTelephone->marque }} {{ $selectedTelephone->modele }}</span></div>
                        <div class="detail-item"><strong>N° Série</strong><span class="small font-monospace">{{ $selectedTelephone->numero_serie }}</span></div>
                        <div class="detail-item"><strong>Statut</strong><span class="badge {{ $selectedTelephone->statut == 'En service' ? 'bg-success' : ($selectedTelephone->statut == 'En stock' ? 'bg-warning' : ($selectedTelephone->statut == 'En réparation' ? 'bg-info' : 'bg-danger')) }} badge-sm">{{ $selectedTelephone->statut }}</span></div>
                        <div class="detail-item"><strong>Localisation</strong><span class="small">{{ $selectedTelephone->lieu }} @if($selectedTelephone->emplacement_actuel) ({{ $selectedTelephone->emplacement_actuel }})@endif</span></div>
                        <div class="detail-item"><strong>Usager</strong><span class="small">{{ $selectedTelephone->usager ?? '-' }}</span></div>
                        <div class="detail-item"><strong>N° Appel</strong><span class="small fw-bold text-primary">{{ $selectedTelephone->numero_appel ?? '-' }}</span></div>
                        <div class="detail-item"><strong>IMEI</strong><span class="small font-monospace">{{ $selectedTelephone->imei ?? '-' }}</span></div>
                        @if($selectedTelephone->services)<div class="detail-item"><strong>Services</strong><span class="small">{{ $selectedTelephone->services }}</span></div>@endif
                    @endif
                </div>
                <div class="modal-footer py-1">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeDetailsModal">Fermer</button>
                    @if($selectedTelephone)<button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $selectedTelephone->id }})">Modifier</button>@endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Liens CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</div>