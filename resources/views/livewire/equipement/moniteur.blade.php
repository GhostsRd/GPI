<div>
    <!-- Styles CSS -->
    <style>
        :root {
            --primary: #5BC4BF !important;
            --primary-dark: #4AA39E !important;
            --primary-light: #7FD9D4 !important;
            --primary-soft: rgba(91, 196, 191, 0.1) !important;
            --primary-50: #F0FAF9 !important;
            --white: #FFFFFF !important;
            --gray-50: #F8FAFC !important;
            --gray-100: #F1F5F9 !important;
            --gray-200: #E2E8F0 !important;
            --gray-300: #CBD5E1 !important;
            --gray-400: #94A3B8 !important;
            --gray-500: #64748B !important;
            --gray-600: #475569 !important;
            --gray-700: #334155 !important;
            --shadow-sm: 0 1px 3px rgba(91, 196, 191, 0.08);
            --shadow-md: 0 4px 6px rgba(91, 196, 191, 0.1);
            --shadow-lg: 0 10px 15px rgba(91, 196, 191, 0.15);
            --border-light: rgba(91, 196, 191, 0.15);
            --border-medium: rgba(91, 196, 191, 0.25);
        }
        
        .dashboard-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            transition: all 0.2s ease;
        }
        
        .dashboard-card:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }
        
        .stat-card {
            padding: 20px;
            border-left: 4px solid var(--primary);
            border-radius: 12px;
        }
        
        .stat-icon-lg {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            background: var(--primary-soft);
            color: var(--primary);
            box-shadow: 0 2px 8px var(--primary-soft);
            transition: all 0.2s ease;
        }
        
        .stat-icon-lg:hover {
            transform: scale(1.05);
            background: var(--primary);
            color: var(--white);
        }
        
        .icon-primary, .icon-success, .icon-warning, .icon-danger, .icon-info {
            background: var(--primary-soft) !important;
            color: var(--primary) !important;
        }
        
        .stat-number {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0;
            color: var(--primary-dark);
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 0.9rem;
            z-index: 10;
        }
        
        .search-box .form-control {
            padding-left: 35px;
            font-size: 0.875rem;
            border-color: var(--border-light) !important;
        }
        
        .search-box .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px var(--primary-soft) !important;
        }
        
        .badge-sm {
            font-size: 0.7rem;
            padding: 0.4em 0.8em;
            border-radius: 30px;
        }
        
        .table th {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid var(--border-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table td {
            font-size: 0.8rem;
            vertical-align: middle;
            color: var(--gray-600);
        }
        
        .table tbody tr:hover {
            background: var(--primary-50);
        }
        
        .btn {
            font-size: 0.8rem;
            border-radius: 8px !important;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: var(--white) !important;
            box-shadow: 0 2px 8px var(--primary-soft);
        }
        
        .btn-primary:hover {
            background: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--primary-soft);
        }
        
        .btn-outline-primary {
            color: var(--primary) !important;
            border-color: var(--border-medium) !important;
            background: var(--white) !important;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary) !important;
            color: var(--white) !important;
            border-color: var(--primary) !important;
            transform: translateY(-2px);
        }
        
        .btn-outline-info, .btn-outline-success, .btn-outline-secondary {
            color: var(--primary) !important;
            border-color: var(--border-light) !important;
            background: var(--white) !important;
        }
        
        .btn-outline-info:hover, .btn-outline-success:hover, .btn-outline-secondary:hover {
            background: var(--primary-soft) !important;
            color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        
        .btn-danger {
            background: #EF4444 !important;
            border-color: #EF4444 !important;
            color: var(--white) !important;
        }
        
        .btn-danger:hover {
            background: #DC2626 !important;
            border-color: #DC2626 !important;
        }
        
        .btn-outline-danger {
            color: #EF4444 !important;
            border-color: rgba(239, 68, 68, 0.3) !important;
        }
        
        .btn-outline-danger:hover {
            background: #EF4444 !important;
            color: var(--white) !important;
            border-color: #EF4444 !important;
        }
        
        .btn-outline-warning {
            color: #F59E0B !important;
            border-color: rgba(245, 158, 11, 0.3) !important;
        }
        
        .btn-outline-warning:hover {
            background: #F59E0B !important;
            color: var(--white) !important;
        }
        
        .form-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--gray-600);
            margin-bottom: 0.25rem;
        }
        
        .form-control, .form-select {
            border-radius: 8px !important;
            border: 1px solid var(--border-light) !important;
            font-size: 0.875rem !important;
            color: var(--gray-700) !important;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px var(--primary-soft) !important;
            outline: none !important;
        }
        
        .input-group-text {
            background: var(--primary-50) !important;
            border: 1px solid var(--border-light) !important;
            color: var(--primary) !important;
            border-radius: 8px 0 0 8px !important;
        }
        
        .modal-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .detail-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-light);
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-item strong {
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            margin-bottom: 0.25rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .modal-backdrop {
            z-index: 1040;
        }
        
        .modal {
            z-index: 1050;
        }
        
        .modal-content {
            border-radius: 16px;
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-lg);
        }
        
        .modal-header {
            background: var(--primary-50);
            border-bottom: 1px solid var(--border-light);
            border-radius: 16px 16px 0 0;
            padding: 1rem 1.5rem;
        }
        
        .modal-header.bg-danger {
            background: linear-gradient(135deg, #EF4444, #DC2626) !important;
            color: var(--white);
        }
        
        .modal-footer {
            border-top: 1px solid var(--border-light);
            background: var(--primary-50);
            border-radius: 0 0 16px 16px;
            padding: 1rem 1.5rem;
        }
        
        .progress {
            background-color: var(--primary-50);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .progress-bar {
            border-radius: 10px;
            transition: width 0.3s ease;
        }
        
        .progress-bar.bg-primary { background: var(--primary) !important; }
        .progress-bar.bg-success { background: #10B981 !important; }
        .progress-bar.bg-warning { background: #F59E0B !important; }
        .progress-bar.bg-info { background: #3B82F6 !important; }
        .progress-bar.bg-danger { background: #EF4444 !important; }

        .badge {
            font-weight: 500;
            border-radius: 30px;
            border: 1px solid transparent;
        }
        
        .badge.bg-success { background: rgba(16, 185, 129, 0.15) !important; color: #065F46 !important; border-color: rgba(16, 185, 129, 0.3); }
        .badge.bg-info { background: rgba(91, 196, 191, 0.15) !important; color: var(--primary-dark) !important; border-color: var(--border-medium); }
        .badge.bg-warning { background: rgba(245, 158, 11, 0.15) !important; color: #92400E !important; border-color: rgba(245, 158, 11, 0.3); }
        .badge.bg-danger { background: rgba(239, 68, 68, 0.15) !important; color: #B91C1C !important; border-color: rgba(239, 68, 68, 0.3); }
        .badge.bg-secondary { background: rgba(100, 116, 139, 0.15) !important; color: #475569 !important; border-color: rgba(100, 116, 139, 0.3); }
        .badge.bg-light { background: var(--white) !important; color: var(--primary) !important; border-color: var(--border-medium); }

        .text-primary { color: var(--primary) !important; }
        .text-success { color: #10B981 !important; }
        .text-warning { color: #F59E0B !important; }
        .text-info { color: #3B82F6 !important; }
        .text-danger { color: #EF4444 !important; }

        .bg-light { background-color: var(--primary-50) !important; }
        .border-top { border-top-color: var(--border-light) !important; }
        .border-bottom { border-bottom-color: var(--border-light) !important; }

        .checkbox-modern {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .font-mono {
            font-family: 'Courier New', monospace;
        }

        /* Pagination */
        .pagination .page-link {
            color: var(--primary);
            border-color: var(--border-light);
            border-radius: 8px;
            margin: 0 2px;
        }

        .pagination .page-link:hover {
            background: var(--primary-soft);
            color: var(--primary);
            border-color: var(--primary);
        }

        .pagination .active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        /* Alertes */
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
            color: #065F46;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #B91C1C;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border-color: rgba(245, 158, 11, 0.3);
            color: #92400E;
        }

        .alert-info {
            background: var(--primary-soft);
            border-color: var(--border-medium);
            color: var(--primary-dark);
        }

        /* Animation pour les badges de filtre */
        .badge {
            transition: all 0.2s ease;
        }

        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px var(--primary-soft);
        }

        /* Bouton de fermeture */
        .btn-close:hover {
            background-color: var(--primary-soft);
            opacity: 1;
        }

        /* Form check */
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem var(--primary-soft);
        }

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
                        <h1 class="h4 fw-semibold mb-0" style="color: var(--primary-dark);">
                            <i class="bi bi-display me-2" style="color: var(--primary);"></i> Gestion des Moniteurs
                        </h1>
                        <p class="text-muted small">Inventaire complet des écrans et moniteurs</p>
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

        <!-- Statistiques -->
       @if($showStats)
<div class="row mb-4">
    <!-- Total -->
    <div class="col-xl-2 col-md-4 mb-3">
        <div class="dashboard-card stat-card h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div class="flex-grow-1">
                    <h3 class="stat-number mb-1" style="color: var(--primary);">{{ $stats['total'] ?? 0 }}</h3>
                    <p class="text-muted small mb-0 fw-medium">Total Moniteurs</p>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
                <div class="stat-icon-lg ms-3">
                    <i class="bi bi-display"></i>
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
                <div class="stat-icon-lg ms-3" style="color: #10B981;">
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
                <div class="stat-icon-lg ms-3" style="color: #F59E0B;">
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
                <div class="stat-icon-lg ms-3" style="color: #3B82F6;">
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
                <div class="stat-icon-lg ms-3" style="color: #EF4444;">
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
                <div class="stat-icon-lg ms-3 {{ $taux >= 80 ? 'text-success' : ($taux >= 60 ? 'text-warning' : 'text-danger') }}">
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
                <h6 class="fw-semibold mb-0 small" style="color: var(--primary-dark);">Filtres et Actions</h6>
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
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium">Recherche</label>
                    <div class="search-box position-relative">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-2 small"></i>
                        <input type="text" wire:model.live.debounce.300ms="search"
                               class="form-control form-control-sm ps-4 border-0 bg-light rounded-2"
                               placeholder="Nom, n° série, fabricant...">
                    </div>
                </div>

                <!-- Statut -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium">Statut</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text border-0">
                            <i class="fas fa-circle"></i>
                        </span>
                        <select wire:model.live="statut" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les statuts</option>
                            @foreach(['En service', 'En stock', 'Hors service', 'En réparation'] as $statutOption)
                                <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Entité -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium">Entité</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text border-0">
                            <i class="fas fa-building"></i>
                        </span>
                        <select wire:model.live="entite" class="form-select border-0 bg-light rounded-2">
                            <option value="">Toutes les entités</option>
                            @foreach($entitesList as $entiteOption)
                                <option value="{{ $entiteOption }}">{{ $entiteOption }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Fabricant -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium">Fabricant</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text border-0">
                            <i class="fas fa-industry"></i>
                        </span>
                        <select wire:model.live="fabricant" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les fabricants</option>
                            @foreach($fabricantsList as $fabricantOption)
                                <option value="{{ $fabricantOption }}">{{ $fabricantOption }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="col-md-4">
                    <div class="d-flex gap-2 flex-wrap justify-content-end">
                        <button wire:click="openImportModal" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="fas fa-file-import me-1"></i>
                            <span class="d-none d-sm-inline">Importer</span>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-file-export me-1"></i>
                                <span class="d-none d-sm-inline">Exporter</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="exportDropdown">
                                <li>
                                    <button class="dropdown-item d-flex align-items-center py-2" wire:click="export('xlsx')">
                                        <i class="bi bi-file-earmark-excel me-2 text-success"></i> Excel (.xlsx)
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item d-flex align-items-center py-2" wire:click="export('csv')">
                                        <i class="bi bi-file-earmark-text me-2 text-primary"></i> CSV
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item d-flex align-items-center py-2" wire:click="export('pdf')">
                                        <i class="bi bi-file-earmark-pdf me-2 text-danger"></i> PDF
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <button wire:click="create" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="fas fa-plus me-1"></i>
                            <span class="d-none d-sm-inline">Ajouter</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Résultats du filtre -->
            @if($search || $statut || $entite || $fabricant)
            <div class="mt-3 pt-2 border-top">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-muted small">Filtres actifs :</span>
                    @if($search)
                    <span class="badge bg-light d-flex align-items-center">
                        Recherche: "{{ $search }}"
                        <button wire:click="$set('search', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($statut)
                    <span class="badge bg-light d-flex align-items-center">
                        Statut: {{ $statut }}
                        <button wire:click="$set('statut', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($entite)
                    <span class="badge bg-light d-flex align-items-center">
                        Entité: {{ $entite }}
                        <button wire:click="$set('entite', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($fabricant)
                    <span class="badge bg-light d-flex align-items-center">
                        Fabricant: {{ $fabricant }}
                        <button wire:click="$set('fabricant', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Tableau -->
        <div class="dashboard-card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <h5 class="fw-semibold mb-0" style="color: var(--primary-dark);">Liste des Moniteurs ({{ $moniteurs->total() }})</h5>
                @if(!empty($selectedMoniteurs))
                <button wire:click="confirmBulkDelete" class="btn btn-danger btn-sm" title="Supprimer les moniteurs sélectionnés">
                    <i class="fas fa-trash me-1"></i>
                    Supprimer ({{ count($selectedMoniteurs) }})
                </button>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                            </th>
                            <th wire:click="sortBy('nom')" style="cursor: pointer;">
                                Nom
                                @if ($sortField === 'nom')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort small" style="color: var(--border-medium);"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('entite')" style="cursor: pointer;">
                                Entité
                                @if ($sortField === 'entite')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort small" style="color: var(--border-medium);"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('statut')" style="cursor: pointer;">
                                Statut
                                @if ($sortField === 'statut')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort small" style="color: var(--border-medium);"></i>
                                @endif
                            </th>
                            <th>Fabricant</th>
                            <th>Modèle</th>
                            <th>N° Série</th>
                            <th>Utilisateur</th>
                            <th>Usager</th>
                            <th>Lieu</th>
                            <th>Type</th>
                            <th wire:click="sortBy('updated_at')" style="cursor: pointer;">
                                Dernière modif.
                                @if ($sortField === 'updated_at')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort small" style="color: var(--border-medium);"></i>
                                @endif
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($moniteurs as $moniteur)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedMoniteurs"
                                       value="{{ $moniteur->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td class="fw-medium small">
                                <div class="d-flex align-items-center">
                                    <span style="color: var(--primary-dark);">{{ $moniteur->nom }}</span>
                                    @if($moniteur->commentaires)
                                        <i class="fas fa-sticky-note ms-1" style="color: #F59E0B;" title="{{ $moniteur->commentaires }}"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="small">{{ $moniteur->entite ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'En service' => 'badge bg-success badge-sm',
                                        'En stock' => 'badge bg-info badge-sm',
                                        'Hors service' => 'badge bg-danger badge-sm',
                                        'En réparation' => 'badge bg-warning badge-sm'
                                    ];
                                @endphp
                                <span class="{{ $statusClasses[$moniteur->statut] ?? 'badge bg-secondary badge-sm' }}">
                                    {{ $moniteur->statut }}
                                </span>
                            </td>
                            <td class="small">{{ $moniteur->fabricant ?? 'N/A' }}</td>
                            <td class="small">{{ $moniteur->modele ?? 'N/A' }}</td>
                            <td class="small font-mono">{{ $moniteur->numero_serie ?? 'N/A' }}</td>
                            <td class="small">
                                @if($moniteur->utilisateur)
                                    <span class="badge bg-light">{{ $moniteur->utilisateur->nom }}</span>
                                @else
                                    <span class="text-muted small">Non attribué</span>
                                @endif
                            </td>
                            <td class="small">
                                @if($moniteur->usager)
                                    <span class="badge bg-light">{{ $moniteur->usager->nom }}</span>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td class="small">{{ $moniteur->lieu ?? 'N/A' }}</td>
                            <td class="small">
                                @if($moniteur->type)
                                    <span class="badge bg-light">{{ $moniteur->type }}</span>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td class="small">{{ $moniteur->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
    <div class="d-flex gap-1">
        <!-- Bouton Voir Détails -->
        <button wire:click="showDetails({{ $moniteur->id }})"
                class="btn btn-sm border-0"
                style="color: var(--primary); background: var(--primary-soft); border-radius: 6px;"
                onmouseover="this.style.background='var(--primary)'; this.style.color='white';"
                onmouseout="this.style.background='var(--primary-soft)'; this.style.color='var(--primary)';"
                title="Voir détails">
            <i class="bi bi-eye"></i>
        </button>
        <!-- Bouton Modifier -->
        <button wire:click="edit({{ $moniteur->id }})"
                class="btn btn-sm border-0"
                style="color: #F59E0B; background: rgba(245, 158, 11, 0.1); border-radius: 6px;"
                onmouseover="this.style.background='#F59E0B'; this.style.color='white';"
                onmouseout="this.style.background='rgba(245, 158, 11, 0.1)'; this.style.color='#F59E0B';"
                title="Modifier">
            <i class="bi bi-pencil"></i>
        </button>
        <!-- Bouton Supprimer -->
        <button wire:click="confirmDelete({{ $moniteur->id }})"
                class="btn btn-sm border-0"
                style="color: #EF4444; background: rgba(239, 68, 68, 0.1); border-radius: 6px;"
                onmouseover="this.style.background='#EF4444'; this.style.color='white';"
                onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='#EF4444';"
                title="Supprimer">
            <i class="bi bi-trash"></i>
        </button>
        <!-- Bouton Fichiers -->
        <button wire:click="openFileModal({{ $moniteur->id }})"
                class="btn btn-sm border-0"
                style="color: #3B82F6; background: rgba(59, 130, 246, 0.1); border-radius: 6px;"
                onmouseover="this.style.background='#3B82F6'; this.style.color='white';"
                onmouseout="this.style.background='rgba(59, 130, 246, 0.1)'; this.style.color='#3B82F6';"
                title="Gérer les fichiers">
            <i class="bi bi-paperclip"></i>
        </button>
    </div>
</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center py-3">
                                <i class="fas fa-desktop display-6 d-block mb-2" style="color: var(--border-medium);"></i>
                                <p class="text-muted mb-0 small">Aucun moniteur trouvé</p>
                                @if($search || $statut || $entite || $fabricant)
                                    <button wire:click="resetFilters" class="btn btn-outline-primary btn-sm mt-2">
                                        <i class="fas fa-redo me-1"></i>
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
                    @if($moniteurs->count() > 0)
                        Affichage de {{ $moniteurs->firstItem() }} à {{ $moniteurs->lastItem() }} sur {{ $moniteurs->total() }} moniteurs
                    @else
                        Aucun moniteur
                    @endif
                </div>
                {{ $moniteurs->links() }}
            </div>
        </div>
    </div>

    <!-- Modal pour créer/modifier un moniteur -->
    @if($showModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="fas {{ $isEditing ? 'fa-edit' : 'fa-plus' }} me-1" style="color: var(--primary);"></i>
                        {{ $isEditing ? 'Modifier le moniteur' : 'Nouveau Moniteur' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save" style="max-height:500px;overflow-y: scroll;  -ms-overflow-style: none;">
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <!-- Informations de base -->
                            <div class="col-12 mb-2">
                                <h6 class="fw-medium mb-2 small border-bottom pb-1" style="color: var(--primary-dark);">
                                    <i class="fas fa-info-circle me-1" style="color: var(--primary);"></i>Informations de base
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Nom <span class="text-danger">*</span></label>
                                <input type="text" wire:model="nom"
                                       class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                       placeholder="Nom du moniteur">
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

                            <!-- Spécifications techniques -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="fw-medium mb-2 small border-bottom pb-1" style="color: var(--primary-dark);">
                                    <i class="fas fa-desktop me-1" style="color: var(--primary);"></i>Spécifications techniques
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Fabricant</label>
                                <input type="text" wire:model="fabricant_form"
                                       class="form-control form-control-sm"
                                       placeholder="Dell, HP, Samsung...">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Modèle</label>
                                <input type="text" wire:model="modele"
                                       class="form-control form-control-sm"
                                       placeholder="Modèle du moniteur">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Numéro de série</label>
                                <input type="text" wire:model="numero_serie"
                                       class="form-control form-control-sm"
                                       placeholder="Numéro de série">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Type</label>
                                <select wire:model="type" class="form-select form-select-sm">
                                    <option value="">Sélectionner un type</option>
                                    @foreach($types as $typeItem)
                                        <option value="{{ $typeItem }}">{{ $typeItem }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Organisation -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="fw-medium mb-2 small border-bottom pb-1" style="color: var(--primary-dark);">
                                    <i class="fas fa-building me-1" style="color: var(--primary);"></i>Organisation
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Entité</label>
                                <input type="text" wire:model="entite_form"
                                       class="form-control form-control-sm"
                                       placeholder="Entité organisationnelle">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Lieu</label>
                                <input type="text" wire:model="lieu"
                                       class="form-control form-control-sm"
                                       placeholder="Emplacement physique">
                            </div>

                            <!-- Attribution utilisateurs -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="fw-medium mb-2 small border-bottom pb-1" style="color: var(--primary-dark);">
                                    <i class="fas fa-users me-1" style="color: var(--primary);"></i>Attribution utilisateurs
                                </h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Utilisateur principal</label>
                                <select wire:model="utilisateur_id" class="form-select form-select-sm">
                                    <option value="">Sélectionner un utilisateur</option>
                                    @foreach($utilisateurs as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
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

                            <!-- Notes -->
                            <div class="col-12 mt-2 mb-2">
                                <h6 class="fw-medium mb-2 small border-bottom pb-1" style="color: var(--primary-dark);">
                                    <i class="fas fa-sticky-note me-1" style="color: var(--primary);"></i>Notes et informations
                                </h6>
                                <textarea wire:model="commentaires" class="form-control form-control-sm" rows="3"
                                          placeholder="Commentaires supplémentaires..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="closeModal">Annuler</button>
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

    <!-- Modal de détails du moniteur -->
    @if($showDetailsModal && $selectedMoniteur)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-desktop me-2" style="color: var(--primary);"></i>Détails du Moniteur
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-desktop me-1" style="color: var(--primary);"></i>Nom</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->nom }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-building me-1" style="color: var(--primary);"></i>Entité</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->entite ?? 'Non spécifiée' }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-circle me-1" style="color: var(--primary);"></i>Statut</strong>
                                <p class="mb-0">
                                    @php
                                        $statusClasses = [
                                            'En service' => 'badge bg-success badge-sm',
                                            'En stock' => 'badge bg-info badge-sm',
                                            'Hors service' => 'badge bg-danger badge-sm',
                                            'En réparation' => 'badge bg-warning badge-sm'
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$selectedMoniteur->statut] ?? 'badge bg-secondary badge-sm' }}">
                                        {{ $selectedMoniteur->statut }}
                                    </span>
                                </p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-industry me-1" style="color: var(--primary);"></i>Fabricant</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->fabricant ?? 'Non spécifié' }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-barcode me-1" style="color: var(--primary);"></i>Numéro de série</strong>
                                <p class="mb-0 small font-mono">{{ $selectedMoniteur->numero_serie ?? 'Non renseigné' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-cube me-1" style="color: var(--primary);"></i>Modèle</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->modele ?? 'Non spécifié' }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-map-marker-alt me-1" style="color: var(--primary);"></i>Lieu</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->lieu ?? 'Non spécifié' }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-tag me-1" style="color: var(--primary);"></i>Type</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->type ?? 'Non spécifié' }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-users me-1" style="color: var(--primary);"></i>Utilisateur principal</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->utilisateur->nom ?? 'Non attribué' }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-user me-1" style="color: var(--primary);"></i>Usager secondaire</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->usager->nom ?? 'Non attribué' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-calendar-plus me-1" style="color: var(--primary);"></i>Date de création</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->created_at->format('d/m/Y à H:i') }}</p>
                            </div>

                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-calendar-check me-1" style="color: var(--primary);"></i>Dernière modification</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->updated_at->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($selectedMoniteur->commentaires)
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="detail-item mb-2">
                                <strong class="small"><i class="fas fa-sticky-note me-1" style="color: var(--primary);"></i>Commentaires</strong>
                                <p class="mb-0 small">{{ $selectedMoniteur->commentaires }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="closeDetailsModal">Fermer</button>
                    @if($selectedMoniteur)
                        <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $selectedMoniteur->id }})">
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
                    <button type="button" class="btn-close btn-close-white" wire:click="$set('confirmingDelete', false)"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-trash3" style="color: #EF4444; font-size: 3rem;"></i>
                    </div>
                    @if($isBulkDelete)
                        <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer les <strong>{{ count($selectedMoniteurs) }}</strong> moniteurs sélectionnés ?</p>
                    @else
                        <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer le moniteur <strong>{{ $selectedMoniteurName }}</strong> ?</p>
                    @endif
                    <p class="text-muted small">Cette action est irréversible et toutes les données associées seront définitivement perdues.</p>
                </div>
                <div class="modal-footer bg-light border-0 justify-content-center p-3">
                    <button type="button" class="btn btn-outline-secondary px-4" wire:click="$set('confirmingDelete', false)">
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

    <!-- Modal d'import simplifié -->
    @if($showImportModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="fas fa-file-import me-1" style="color: var(--primary);"></i>
                        Importer des Moniteurs
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeImportModal"></button>
                </div>
                <div class="modal-body p-3">
                    <!-- Étape 1 : Upload du fichier -->
                    @if(!$showMappingModal && !$showImportedData)
                    <div class="text-center mb-3">
                        <i class="fas fa-file-csv display-6 mb-3" style="color: var(--primary);"></i>
                        <h6 class="fw-semibold" style="color: var(--primary-dark);">Importer depuis un fichier CSV</h6>
                        <p class="text-muted small">Téléchargez le template ou importez votre fichier CSV</p>
                    </div>

                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle me-2"></i>
                        Formats supportés: CSV, TXT. Taille max: 10MB
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-medium">Fichier CSV</label>
                        <input type="file" wire:model="importFile" 
                               class="form-control form-control-sm @error('importFile') is-invalid @enderror" 
                               accept=".csv,.txt">
                        @error('importFile') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <button type="button" wire:click="downloadImportTemplate" 
                                class="btn btn-outline-primary btn-sm w-100">
                            <i class="fas fa-download me-1"></i>
                            Télécharger le template
                        </button>
                    </div>

                    @if($importErrors && count($importErrors) > 0)
                    <div class="alert alert-danger small">
                        <h6 class="alert-heading small">Erreurs détectées</h6>
                        <ul class="mb-0 small">
                            @foreach($importErrors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @endif

                    <!-- Étape 2 : Mapping simplifié -->
                    @if($showMappingModal)
                    <div class="text-center mb-3">
                        <i class="fas fa-map-marked-alt display-6 mb-3" style="color: #F59E0B;"></i>
                        <h6 class="fw-semibold" style="color: var(--primary-dark);">Association des colonnes</h6>
                        <p class="text-muted small">Associez les colonnes de votre fichier aux champs du système</p>
                    </div>

                    <div class="alert alert-warning small">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Seul le champ <strong>Nom</strong> est obligatoire. Les autres champs sont optionnels.
                    </div>

                    <!-- Aperçu des données -->
                    @if(count($csvPreview) > 0)
                    <div class="mb-3">
                        <h6 class="small fw-semibold" style="color: var(--primary-dark);">Aperçu de vos données :</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered small">
                                <thead class="table-light">
                                    <tr>
                                        @foreach($csvHeaders as $header)
                                        <th>{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($csvPreview as $row)
                                    <tr>
                                        @foreach($csvHeaders as $header)
                                        <td>{{ $row[$header] ?? '' }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <!-- Mapping simplifié -->
                    <div class="row g-2">
                        @foreach(['nom' => 'Nom*', 'entite' => 'Entité', 'statut' => 'Statut', 'fabricant' => 'Fabricant'] as $field => $label)
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">{{ $label }}</label>
                            <select wire:model="fieldMapping.{{ $field }}" 
                                    class="form-select form-select-sm @if($field === 'nom' && empty($fieldMapping['nom'])) is-invalid @endif">
                                <option value="">-- Sélectionner une colonne --</option>
                                @foreach($csvHeaders as $header)
                                <option value="{{ $header }}">{{ $header }}</option>
                                @endforeach
                            </select>
                            @if($field === 'nom' && empty($fieldMapping['nom']))
                            <div class="invalid-feedback small">Le champ nom est obligatoire</div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <!-- Champs optionnels groupés -->
                    <div class="mt-3">
                        <h6 class="small fw-semibold" style="color: var(--primary-dark);">Champs optionnels :</h6>
                        <div class="row g-2">
                            @foreach(['numero_serie' => 'N° Série', 'lieu' => 'Lieu', 'type' => 'Type', 'modele' => 'Modèle'] as $field => $label)
                            <div class="col-md-6">
                                <label class="form-label small text-muted">{{ $label }}</label>
                                <select wire:model="fieldMapping.{{ $field }}" class="form-select form-select-sm">
                                    <option value="">-- Optionnel --</option>
                                    @foreach($csvHeaders as $header)
                                    <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @if($importErrors && count($importErrors) > 0)
                    <div class="alert alert-danger small mt-3">
                        <h6 class="alert-heading small">Erreurs de mapping</h6>
                        <ul class="mb-0 small">
                            @foreach($importErrors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @endif

                    <!-- Étape 3 : Aperçu et confirmation -->
                    @if($showImportedData)
                    <div class="text-center mb-3">
                        <i class="fas fa-check-circle display-6 mb-3" style="color: #10B981;"></i>
                        <h6 class="fw-semibold" style="color: var(--primary-dark);">Confirmation d'import</h6>
                        <p class="text-muted small">Vérifiez les données avant l'import final</p>
                    </div>

                    <div class="alert alert-success small">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>{{ $importSuccessCount }}</strong> moniteur(s) prêt(s) à être importé(s)
                        @if(count($importErrors) > 0)
                        - <strong>{{ count($importErrors) }}</strong> erreur(s)
                        @endif
                    </div>

                    @if(count($importErrors) > 0)
                    <div class="alert alert-danger small">
                        <h6 class="alert-heading small">Erreurs :</h6>
                        <ul class="mb-0 small">
                            @foreach($importErrors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(count($importedData) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered small">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Entité</th>
                                    <th>Statut</th>
                                    <th>Fabricant</th>
                                    <th>N° Série</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice($importedData, 0, 5) as $data)
                                <tr>
                                    <td>{{ $data['nom'] }}</td>
                                    <td>{{ $data['entite'] ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-sm" style="background: {{ $this->getBadgeColor($data['statut'] ?? 'En stock') }}; color: white;">
                                            {{ $data['statut'] ?? 'En stock' }}
                                        </span>
                                    </td>
                                    <td>{{ $data['fabricant'] ?? 'N/A' }}</td>
                                    <td class="font-mono">{{ $data['numero_serie'] ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                                @if(count($importedData) > 5)
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        ... et {{ count($importedData) - 5 }} autre(s) moniteur(s)
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            @endif
            <div class="modal-footer py-2">
                    @if(!$showMappingModal && !$showImportedData)
                    <!-- Boutons étape 1 -->
                    <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="closeImportModal">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" 
                            wire:click="storeImportFile" 
                            wire:loading.attr="disabled"
                            {{ !$importFile ? 'disabled' : '' }}>
                        <i class="fas fa-arrow-right me-1"></i>
                        <span wire:loading.remove>Suivant</span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-1"></i>
                            Chargement...
                        </span>
                    </button>
                    @endif

                    @if($showMappingModal)
                    <!-- Boutons étape 2 -->
                    <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="cancelImport">
                        <i class="fas fa-arrow-left me-1"></i>
                        Retour
                    </button>
                    <button type="button" wire:click="processMappedData" class="btn btn-primary btn-sm" 
                            wire:loading.attr="disabled" {{ empty($fieldMapping['nom']) ? 'disabled' : '' }}>
                        <i class="fas fa-gear me-1"></i>
                        <span wire:loading.remove>Traiter les données</span>
                        <span wire:loading>Traitement en cours...</span>
                    </button>
                    @endif

                    @if($showImportedData)
                    <!-- Boutons étape 3 -->
                    <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="cancelImport">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    <button type="button" class="btn btn-success btn-sm" 
                            wire:click="saveImportedData"
                            wire:loading.attr="disabled"
                            {{ count($importedData) === 0 ? 'disabled' : '' }}>
                        <i class="fas fa-save me-1"></i>
                        <span wire:loading.remove>Importer ({{ count($importedData) }})</span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-1"></i>
                            Import...
                        </span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de gestion des fichiers -->
    @if($showFileModal && $selectedMoniteurForFiles)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="fas fa-paperclip me-1" style="color: var(--primary);"></i>
                        Fichiers attachés - {{ $selectedMoniteurForFiles->nom }}
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeFileModal"></button>
                </div>
                <div class="modal-body p-3">
                    <!-- Upload de fichiers -->
                    <div class="mb-3">
                        <label class="form-label small fw-medium">Ajouter des fichiers</label>
                        <input type="file" wire:model="uploadedFiles" multiple class="form-control form-control-sm">
                        <div class="form-text small">Formats supportés: JPG, PNG, PDF, DOC, XLS, TXT (max 10MB)</div>
                        @error('uploadedFiles.*') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    @if(count($uploadedFiles) > 0)
                    <div class="mb-3">
                        <button type="button" wire:click="uploadFiles" class="btn btn-primary btn-sm">
                            <i class="fas fa-upload me-1"></i>
                            Uploader les fichiers ({{ count($uploadedFiles) }})
                        </button>
                    </div>
                    @endif

                    <!-- Liste des fichiers -->
                    <h6 class="fw-medium mb-2 small border-bottom pb-1" style="color: var(--primary-dark);">Fichiers attachés</h6>
                    @if(count($attachedFiles) > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th class="small">Nom</th>
                                        <th class="small">Taille</th>
                                        <th class="small">Date</th>
                                        <th class="small">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attachedFiles as $file)
                                    <tr>
                                        <td class="small">{{ $file['name'] }}</td>
                                        <td class="small">{{ $file['size'] }}</td>
                                        <td class="small">{{ $file['date'] }}</td>
                                        <td>
                                            <button wire:click="downloadFile('{{ $file['path'] }}')" 
                                                    class="btn btn-sm btn-outline-primary" title="Télécharger">
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <button wire:click="deleteFile('{{ $file['path'] }}')" 
                                                    class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-3 small">Aucun fichier attaché</p>
                    @endif
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="closeFileModal">
                        <i class="fas fa-times me-1"></i>
                        Fermer
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

        // Fermer les modales avec la touche Echap
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                @this.call('closeModal');
                @this.call('closeDetailsModal');
                @this.call('closeDeleteModal');
                @this.call('closeImportModal');
                @this.call('closeFileModal');
                @this.call('cancelImport');
            }
        });
        
    </script>

    <!-- Liens CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</div>
    <!-- Dans votre layout principal ou header -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">