<div>
    <style>
        :root {
            --primary: #5BC4BF;
            --primary-dark: #4AA39E;
            --primary-light: #7FD9D4;
            --primary-soft: rgba(91, 196, 191, 0.1);
            --primary-50: #F0FAF9;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-400: #94A3B8;
            --gray-600: #475569;
            --gray-800: #1E293B;
        }

        /* Animations */
        .fade-in-up {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Dashboard Card */
        .dashboard-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(91, 196, 191, 0.08);
            border: none;
            transition: all 0.2s ease;
        }

        .dashboard-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        /* Stat Cards */
        .stat-card {
            padding: 1rem;
            border: none;
            border-radius: 16px;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(91, 196, 191, 0.12);
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .stat-icon-lg {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background: var(--primary-soft);
            transition: all 0.2s ease;
        }

        /* Table moderne */
        .table-modern th {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-600);
            background: var(--gray-50);
            padding: 0.75rem 0.75rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .table-modern td {
            padding: 0.7rem 0.75rem;
            font-size: 0.75rem;
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        .table-modern tbody tr {
            transition: all 0.15s ease;
        }

        .table-modern tbody tr:hover {
            background: var(--primary-soft);
        }

        /* Badges modernes */
        .badge-modern {
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
            font-size: 0.65rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .badge-success { background: rgba(16, 185, 129, 0.12); color: #0b7e5a; }
        .badge-warning { background: rgba(245, 158, 11, 0.12); color: #b45309; }
        .badge-info { background: rgba(59, 130, 246, 0.12); color: #1e40af; }
        .badge-danger { background: rgba(239, 68, 68, 0.12); color: #b91c1c; }
        .badge-secondary { background: rgba(100, 116, 139, 0.12); color: #475569; }

        /* Boutons modernes */
        .btn-modern {
            padding: 0.35rem 0.85rem;
            font-size: 0.7rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-modern-primary {
            background: var(--primary);
            color: white;
            border: none;
        }

        .btn-modern-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(91, 196, 191, 0.3);
        }

        .btn-modern-outline {
            background: transparent;
            border: 1px solid var(--gray-200);
            color: var(--gray-600);
        }

        .btn-modern-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-soft);
        }

        /* Formulaires */
        .form-modern {
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 0.45rem 0.7rem;
            font-size: 0.7rem;
            transition: all 0.2s ease;
            background: white;
        }

        .form-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
            outline: none;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 0.7rem;
        }

        .search-box .form-control {
            padding-left: 28px;
        }

        /* Pagination */
        .pagination-modern .page-link {
            border: none;
            margin: 0 2px;
            border-radius: 6px;
            font-size: 0.7rem;
            padding: 0.35rem 0.65rem;
            color: var(--gray-600);
        }

        .pagination-modern .page-link:hover {
            background: var(--primary);
            color: white;
        }

        .pagination-modern .active .page-link {
            background: var(--primary);
            color: white;
        }

        /* Checkbox modern */
        .checkbox-modern {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        /* Modals */
        .modal-content {
            border-radius: 16px;
            border: none;
            overflow: hidden;
        }

        .modal-header {
            background: var(--primary-50);
            border-bottom: 1px solid var(--gray-200);
            padding: 0.75rem 1.25rem;
        }

        .modal-footer {
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            padding: 0.75rem 1.25rem;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-100);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-400);
            border-radius: 10px;
        }
    </style>

    <div class="container-fluid px-3 px-md-4 py-3 fade-in-up">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h1 class="fw-bold mb-1" style="color: var(--gray-800); font-size: 1.3rem;">
                    <i class="bi bi-display me-2" style="color: var(--primary);"></i>
                    Gestion des Moniteurs
                </h1>
                <p class="text-muted small mb-0">Inventaire complet des écrans et moniteurs</p>
            </div>
            <div class="d-flex gap-2">
                <button wire:click="toggleStats" class="btn btn-modern-outline btn-modern">
                    <i class="bi bi-{{ $showStats ? 'eye-slash' : 'eye' }} me-1"></i>
                    {{ $showStats ? 'Masquer stats' : 'Afficher stats' }}
                </button>
                <button wire:click="create" class="btn btn-modern-primary btn-modern">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter
                </button>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session()->has('message') || session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show small mb-3 rounded-3" style="background: rgba(16, 185, 129, 0.1); border: none; color: #0b7e5a;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('message') ?? session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show small mb-3 rounded-3" style="background: rgba(239, 68, 68, 0.1); border: none; color: #b91c1c;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Cards -->
        @if($showStats)
        <div class="row g-3 mb-4">
            <div class="col-xl-2 col-md-4 col-6">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-semibold">Total</span>
                            <div class="stat-number" style="color: var(--primary);">{{ $stats['total'] ?? 0 }}</div>
                            <small class="text-muted">Moniteurs</small>
                        </div>
                        <div class="stat-icon-lg" style="background: var(--primary-soft); color: var(--primary);">
                            <i class="bi bi-display"></i>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 3px;">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-semibold">En service</span>
                            <div class="stat-number text-success">{{ $stats['en_service'] ?? 0 }}</div>
                            <small class="text-muted">Opérationnels</small>
                        </div>
                        <div class="stat-icon-lg" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 3px;">
                        <div class="progress-bar bg-success" style="width: {{ ($stats['total'] ?? 1) > 0 ? (($stats['en_service'] ?? 0) / ($stats['total'] ?? 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-semibold">En réparation</span>
                            <div class="stat-number text-warning">{{ $stats['en_reparation'] ?? 0 }}</div>
                            <small class="text-muted">Maintenance</small>
                        </div>
                        <div class="stat-icon-lg" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                            <i class="bi bi-tools"></i>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 3px;">
                        <div class="progress-bar bg-warning" style="width: {{ ($stats['total'] ?? 1) > 0 ? (($stats['en_reparation'] ?? 0) / ($stats['total'] ?? 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-semibold">En stock</span>
                            <div class="stat-number text-info">{{ $stats['en_stock'] ?? 0 }}</div>
                            <small class="text-muted">Disponibles</small>
                        </div>
                        <div class="stat-icon-lg" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 3px;">
                        <div class="progress-bar bg-info" style="width: {{ ($stats['total'] ?? 1) > 0 ? (($stats['en_stock'] ?? 0) / ($stats['total'] ?? 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-semibold">Hors service</span>
                            <div class="stat-number text-danger">{{ $stats['hors_service'] ?? 0 }}</div>
                            <small class="text-muted">À réformer</small>
                        </div>
                        <div class="stat-icon-lg" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 3px;">
                        <div class="progress-bar bg-danger" style="width: {{ ($stats['total'] ?? 1) > 0 ? (($stats['hors_service'] ?? 0) / ($stats['total'] ?? 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-semibold">Disponibilité</span>
                            @php
                                $taux = ($stats['total'] ?? 1) > 0 ? round((($stats['en_service'] ?? 0) / ($stats['total'] ?? 1)) * 100) : 0;
                            @endphp
                            <div class="stat-number {{ $taux >= 80 ? 'text-success' : ($taux >= 60 ? 'text-warning' : 'text-danger') }}">{{ $taux }}%</div>
                            <small class="text-muted">Taux global</small>
                        </div>
                        <div class="stat-icon-lg" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 3px;">
                        <div class="progress-bar {{ $taux >= 80 ? 'bg-success' : ($taux >= 60 ? 'bg-warning' : 'bg-danger') }}" style="width: {{ $taux }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filters -->
        <div class="dashboard-card p-3 mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-2 col-sm-6">
                    <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Recherche</label>
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" wire:model.live.debounce.300ms="search"
                               class="form-control form-modern" placeholder="Nom, série, fabricant...">
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Statut</label>
                    <select wire:model.live="statut" class="form-select form-modern">
                        <option value="">Tous</option>
                        @foreach(['En service', 'En stock', 'Hors service', 'En réparation'] as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-6">
                    <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Entité</label>
                    <select wire:model.live="entite" class="form-select form-modern">
                        <option value="">Toutes</option>
                        @foreach($entitesList as $e)
                            <option value="{{ $e }}">{{ $e }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-6">
                    <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Fabricant</label>
                    <select wire:model.live="fabricant" class="form-select form-modern">
                        <option value="">Tous</option>
                        @foreach($fabricantsList as $f)
                            <option value="{{ $f }}">{{ $f }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-6">
                    <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Affichage</label>
                    <select wire:model.live="perPage" class="form-select form-modern">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button wire:click="openImportModal" class="btn btn-modern-outline btn-modern flex-grow-1">
                            <i class="bi bi-upload me-1"></i> Import
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-modern-outline btn-modern dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-download me-1"></i> Export
                            </button>
                            <ul class="dropdown-menu shadow-sm border-0 rounded-2">
                                <li><a class="dropdown-item small" href="#" wire:click.prevent="export('xlsx')"><i class="bi bi-file-earmark-excel text-success me-2"></i>Excel</a></li>
                                <li><a class="dropdown-item small" href="#" wire:click.prevent="export('csv')"><i class="bi bi-file-earmark-text text-info me-2"></i>CSV</a></li>
                                <li><a class="dropdown-item small" href="#" wire:click.prevent="export('pdf')"><i class="bi bi-file-earmark-pdf text-danger me-2"></i>PDF</a></li>
                            </ul>
                        </div>
                        <button wire:click="resetFilters" class="btn btn-modern-outline btn-modern" title="Réinitialiser">
                            <i class="bi bi-arrow-repeat"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Active Filters -->
            @if($search || $statut || $entite || $fabricant)
            <div class="mt-3 pt-2 border-top">
                <div class="d-flex gap-2 flex-wrap">
                    <span class="small text-muted">Filtres actifs :</span>
                    @if($search)
                    <span class="badge bg-light text-dark rounded-pill d-inline-flex align-items-center gap-1 px-2 py-1" style="font-size: 0.6rem;">
                        Recherche: {{ $search }}
                        <button wire:click="$set('search', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.4rem;"></button>
                    </span>
                    @endif
                    @if($statut)
                    <span class="badge bg-light text-dark rounded-pill d-inline-flex align-items-center gap-1 px-2 py-1" style="font-size: 0.6rem;">
                        Statut: {{ $statut }}
                        <button wire:click="$set('statut', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.4rem;"></button>
                    </span>
                    @endif
                    @if($entite)
                    <span class="badge bg-light text-dark rounded-pill d-inline-flex align-items-center gap-1 px-2 py-1" style="font-size: 0.6rem;">
                        Entité: {{ $entite }}
                        <button wire:click="$set('entite', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.4rem;"></button>
                    </span>
                    @endif
                    @if($fabricant)
                    <span class="badge bg-light text-dark rounded-pill d-inline-flex align-items-center gap-1 px-2 py-1" style="font-size: 0.6rem;">
                        Fabricant: {{ $fabricant }}
                        <button wire:click="$set('fabricant', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.4rem;"></button>
                    </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Table -->
        <div class="dashboard-card overflow-hidden">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h6 class="fw-semibold mb-0" style="color: var(--gray-800);">Liste des moniteurs</h6>
                @if(!empty($selectedMoniteurs))
                <button wire:click="confirmBulkDelete" class="btn btn-modern-danger btn-modern">
                    <i class="bi bi-trash3 me-1"></i> Supprimer ({{ count($selectedMoniteurs) }})
                </button>
                @endif
            </div>

            <div class="table-responsive" style="max-height: 60vh;">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th style="width: 35px;">
                                <input type="checkbox" wire:model.live="selectAll" class="checkbox-modern">
                            </th>
                            <th wire:click="sortBy('nom')" style="cursor: pointer;">Nom <i class="bi bi-arrow-down-up ms-1 small"></i></th>
                            <th wire:click="sortBy('entite')" style="cursor: pointer;">Entité <i class="bi bi-arrow-down-up ms-1 small"></i></th>
                            <th wire:click="sortBy('statut')" style="cursor: pointer;">Statut <i class="bi bi-arrow-down-up ms-1 small"></i></th>
                            <th>Fabricant</th>
                            <th>Modèle</th>
                            <th>N° Série</th>
                            <th>Utilisateur</th>
                            <th>Lieu</th>
                            <th>Type</th>
                            <th wire:click="sortBy('updated_at')" style="cursor: pointer;">Modifié <i class="bi bi-arrow-down-up ms-1 small"></i></th>
                            <th style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($moniteurs as $moniteur)
                        <tr wire:key="mon-{{ $moniteur->id }}">
                            <td><input type="checkbox" wire:model.live="selectedMoniteurs" value="{{ $moniteur->id }}" class="checkbox-modern"></td>
                            <td class="fw-medium">{{ $moniteur->name ?? $moniteur->nom }}</td>
                            <td>{{ $moniteur->entite ?? '-' }}</td>
                            <td>
                                @php
                                    $statusMap = [
                                        'En service' => 'success',
                                        'En stock' => 'info',
                                        'En réparation' => 'warning',
                                        'Hors service' => 'danger'
                                    ];
                                    $color = $statusMap[$moniteur->statut] ?? 'secondary';
                                    $iconMap = [
                                        'En service' => 'check-circle',
                                        'En stock' => 'box',
                                        'En réparation' => 'tools',
                                        'Hors service' => 'x-circle'
                                    ];
                                    $icon = $iconMap[$moniteur->statut] ?? 'question-circle';
                                @endphp
                                <span class="badge-modern badge-{{ $color }}">
                                    <i class="bi bi-{{ $icon }}"></i> {{ $moniteur->statut }}
                                </span>
                            </td>
                            <td>{{ $moniteur->fabricant ?? '-' }}</td>
                            <td>{{ $moniteur->modele ?? '-' }}</td>
                            <td class="font-monospace">{{ $moniteur->numero_serie ?? '-' }}</td>
                            <td>
                                @if($moniteur->utilisateur)
                                    <span class="d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-person-circle small" style="color: var(--primary);"></i>
                                        {{ $moniteur->utilisateur->nom ?? $moniteur->utilisateur->name }}
                                    </span>
                                @else
                                    <span class="text-muted">Non attribué</span>
                                @endif
                            </td>
                            <td>{{ $moniteur->lieu ?? '-' }}</td>
                            <td><span class="badge bg-light text-dark">{{ $moniteur->type ?? '-' }}</span></td>
                            <td class="text-muted">{{ $moniteur->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button wire:click="showDetails({{ $moniteur->id }})" class="btn btn-sm p-0" style="color: var(--primary); width: 26px; height: 26px;" title="Voir">
                                        <i class="bi bi-eye fs-6"></i>
                                    </button>
                                    <button wire:click="edit({{ $moniteur->id }})" class="btn btn-sm p-0" style="color: #f59e0b; width: 26px; height: 26px;" title="Modifier">
                                        <i class="bi bi-pencil fs-6"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $moniteur->id }})" class="btn btn-sm p-0" style="color: #ef4444; width: 26px; height: 26px;" title="Supprimer">
                                        <i class="bi bi-trash3 fs-6"></i>
                                    </button>
                                    <button wire:click="openFileModal({{ $moniteur->id }})" class="btn btn-sm p-0" style="color: #3b82f6; width: 26px; height: 26px;" title="Fichiers">
                                        <i class="bi bi-paperclip fs-6"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center py-4">
                                <i class="bi bi-display display-6 text-muted opacity-25 d-block mb-2"></i>
                                <p class="text-muted small mb-0">Aucun moniteur trouvé</p>
                                @if($search || $statut || $entite || $fabricant)
                                    <button wire:click="resetFilters" class="btn btn-modern-outline btn-modern mt-2">
                                        <i class="bi bi-arrow-repeat me-1"></i> Réinitialiser
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($moniteurs->hasPages())
            <div class="card-footer bg-white border-0 py-2">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span class="small text-muted">
                        {{ $moniteurs->firstItem() ?? 0 }} - {{ $moniteurs->lastItem() ?? 0 }} sur {{ $moniteurs->total() }}
                    </span>
                    {{ $moniteurs->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" style="font-size: 0.95rem;">
                        <i class="bi bi-{{ $isEditing ? 'pencil' : 'plus-circle' }} me-2" style="color: var(--primary);"></i>
                        {{ $isEditing ? 'Modifier le moniteur' : 'Nouveau moniteur' }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block">Nom <span class="text-danger">*</span></label>
                                <input type="text" wire:model="nom" class="form-control form-modern @error('nom') is-invalid @enderror" placeholder="Ex: Moniteur Salle 101">
                                @error('nom') <small class="text-danger" style="font-size: 0.6rem;">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block">Statut</label>
                                <select wire:model="statut_form" class="form-select form-modern">
                                    <option value="">Sélectionner</option>
                                    @foreach(['En service', 'En stock', 'En réparation', 'Hors service'] as $s)
                                        <option value="{{ $s }}">{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block">Fabricant</label>
                                <input type="text" wire:model="fabricant" class="form-control form-modern" placeholder="Dell, HP, Samsung...">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block">Modèle</label>
                                <input type="text" wire:model="modele" class="form-control form-modern" placeholder="Modèle du moniteur">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block">Numéro de série</label>
                                <input type="text" wire:model="numero_serie" class="form-control form-modern" placeholder="SN-12345...">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block">Type</label>
                                <select wire:model="type" class="form-select form-modern">
                                    <option value="">Sélectionner</option>
                                    @foreach($types as $t)
                                        <option value="{{ $t }}">{{ $t }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block">Entité</label>
                                <input type="text" wire:model="entite_form" class="form-control form-modern" placeholder="Direction...">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block">Lieu</label>
                                <input type="text" wire:model="lieu" class="form-control form-modern" placeholder="Bâtiment, bureau...">
                            </div>
                            <div class="col-md-12">
                                <label class="small fw-semibold text-muted mb-1 d-block">Utilisateur principal</label>
                                <select wire:model="utilisateur_id" class="form-select form-modern">
                                    <option value="">-- Non attribué --</option>
                                    @foreach($utilisateurs as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="small fw-semibold text-muted mb-1 d-block">Commentaires</label>
                                <textarea wire:model="commentaires" rows="2" class="form-control form-modern" placeholder="Informations supplémentaires..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-modern-outline btn-modern" wire:click="closeModal">
                            <i class="bi bi-x me-1"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-modern-primary btn-modern">
                            <span wire:loading.remove><i class="bi bi-{{ $isEditing ? 'check' : 'plus' }} me-1"></i> {{ $isEditing ? 'Modifier' : 'Créer' }}</span>
                            <span wire:loading><i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i> Chargement...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($confirmingDelete)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content text-center">
                <div class="modal-body p-4">
                    <i class="bi bi-trash3 text-danger" style="font-size: 2rem;"></i>
                    <h6 class="mt-2 fw-semibold">Confirmer la suppression</h6>
                    <p class="small text-muted mb-3">
                        @if($isBulkDelete)
                            Supprimer {{ count($selectedMoniteurs) }} moniteur(s) ?
                        @else
                            Supprimer "{{ $selectedMoniteurName }}" ?
                        @endif
                    </p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button class="btn btn-modern-outline btn-modern" wire:click="closeDeleteModal">
                            <i class="bi bi-x me-1"></i> Annuler
                        </button>
                        <button class="btn btn-modern-danger btn-modern" wire:click="deleteConfirmed">
                            <i class="bi bi-trash3 me-1"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Details Modal -->
    @if($showDetailsModal && $selectedMoniteur)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" style="font-size: 0.95rem;">
                        <i class="bi bi-info-circle me-2" style="color: var(--primary);"></i> Détails du moniteur
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Nom</small>
                                <span class="fw-medium" style="font-size: 0.75rem;">{{ $selectedMoniteur->nom }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Statut</small>
                                <span style="font-size: 0.75rem;">{{ $selectedMoniteur->statut }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Fabricant / Modèle</small>
                                <span style="font-size: 0.75rem;">{{ $selectedMoniteur->fabricant ?? '-' }} {{ $selectedMoniteur->modele ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">N° Série</small>
                                <span class="font-monospace" style="font-size: 0.7rem;">{{ $selectedMoniteur->numero_serie ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Type</small>
                                <span style="font-size: 0.75rem;">{{ $selectedMoniteur->type ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Lieu</small>
                                <span style="font-size: 0.75rem;">{{ $selectedMoniteur->lieu ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Entité</small>
                                <span style="font-size: 0.75rem;">{{ $selectedMoniteur->entite ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Utilisateur</small>
                                <span style="font-size: 0.75rem;">{{ $selectedMoniteur->utilisateur->nom ?? $selectedMoniteur->utilisateur->name ?? 'Non attribué' }}</span>
                            </div>
                        </div>
                        @if($selectedMoniteur->commentaires)
                        <div class="col-12">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Commentaires</small>
                                <span style="font-size: 0.75rem;">{{ $selectedMoniteur->commentaires }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modern-outline btn-modern" wire:click="closeDetailsModal">
                        <i class="bi bi-x me-1"></i> Fermer
                    </button>
                    <button type="button" class="btn btn-modern-primary btn-modern" wire:click="edit({{ $selectedMoniteur->id }})">
                        <i class="bi bi-pencil me-1"></i> Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- File Management Modal -->
    @if($showFileModal && $selectedMoniteurForFiles)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" style="font-size: 0.95rem;">
                        <i class="bi bi-paperclip me-2" style="color: var(--primary);"></i>
                        Fichiers - {{ $selectedMoniteurForFiles->nom }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeFileModal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="mb-3">
                        <label class="small fw-semibold text-muted mb-1 d-block">Ajouter des fichiers</label>
                        <input type="file" wire:model="uploadedFiles" multiple class="form-control form-modern">
                        <div class="form-text small">Formats: JPG, PNG, PDF, DOC, XLS (max 10MB)</div>
                    </div>

                    @if(count($uploadedFiles) > 0)
                    <div class="mb-3">
                        <button type="button" wire:click="uploadFiles" class="btn btn-modern-primary btn-modern w-100">
                            <i class="bi bi-upload me-1"></i> Uploader ({{ count($uploadedFiles) }})
                        </button>
                    </div>
                    @endif

                    <h6 class="fw-semibold mb-2 small border-bottom pb-1" style="color: var(--primary-dark);">Fichiers attachés</h6>
                    @if(count($attachedFiles) > 0)
                        <div class="list-group">
                            @foreach($attachedFiles as $file)
                            <div class="list-group-item d-flex justify-content-between align-items-center p-2 border-0 bg-light mb-1 rounded-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-file-earmark-text text-primary"></i>
                                    <span class="small">{{ $file['name'] }}</span>
                                    <small class="text-muted">{{ $file['size'] }}</small>
                                </div>
                                <div class="d-flex gap-1">
                                    <button wire:click="downloadFile('{{ $file['path'] }}')" class="btn btn-sm p-1 text-primary" title="Télécharger">
                                        <i class="bi bi-download"></i>
                                    </button>
                                    <button wire:click="deleteFile('{{ $file['path'] }}')" class="btn btn-sm p-1 text-danger" title="Supprimer">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-3 small">Aucun fichier attaché</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modern-outline btn-modern" wire:click="closeFileModal">
                        <i class="bi bi-x me-1"></i> Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Import Modal -->
    @if($showImportModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" style="font-size: 0.95rem;">
                        <i class="bi bi-upload me-2" style="color: var(--primary);"></i> Importer des moniteurs
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeImportModal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="alert alert-info small rounded-2 mb-3" style="background: var(--primary-soft); border: none;">
                        <i class="bi bi-info-circle me-2"></i> Formats supportés: CSV, XLSX. Taille max: 10MB
                    </div>
                    <div class="mb-3">
                        <label class="small fw-semibold text-muted mb-1 d-block">Fichier à importer</label>
                        <input type="file" wire:model="importFile" class="form-control form-modern" accept=".csv,.xlsx">
                        @error('importFile') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <button type="button" wire:click="downloadImportTemplate" class="btn btn-modern-outline btn-modern w-100">
                        <i class="bi bi-download me-1"></i> Télécharger le template
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-modern-outline btn-modern" wire:click="closeImportModal">
                        <i class="bi bi-x me-1"></i> Annuler
                    </button>
                    <button class="btn btn-modern-primary btn-modern" wire:click="storeImportFile" wire:loading.attr="disabled" {{ !$importFile ? 'disabled' : '' }}>
                        <span wire:loading.remove><i class="bi bi-upload me-1"></i> Importer</span>
                        <span wire:loading><i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i> Import...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>