<div>
    <style>
        :root {
            --primary: #5BC4BF;
            --primary-dark: #4AA39E;
            --primary-light: #7FD9D4;
            --primary-soft: rgba(91, 196, 191, 0.1);
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-400: #94a3b8;
            --gray-600: #475569;
            --gray-800: #1e293b;
        }

        /* Animations */
        .fade-in-up {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Cartes stats miniaturisées */
        .stat-card-mini {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
        }

        .stat-card-mini:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(91, 196, 191, 0.12) !important;
        }

        .stat-card-mini .card-body {
            padding: 0.6rem !important;
        }

        .stat-card-mini .stat-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 0;
            line-height: 1.2;
        }

        .stat-card-mini .stat-label {
            font-size: 0.55rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: var(--gray-600);
        }

        .stat-card-mini .stat-icon {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .stat-card-mini .stat-icon i {
            font-size: 0.75rem;
        }

        /* Table moderne */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0;
        }

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
            padding: 0.2rem 0.6rem;
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

        .btn-modern-danger {
            background: #ef4444;
            color: white;
            border: none;
        }

        .btn-modern-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        /* Champs de formulaire */
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

        /* Pagination */
        .pagination-modern .page-link {
            border: none;
            margin: 0 2px;
            border-radius: 6px;
            font-size: 0.7rem;
            padding: 0.35rem 0.65rem;
            color: var(--gray-600);
            transition: all 0.2s ease;
        }

        .pagination-modern .page-link:hover {
            background: var(--primary);
            color: white;
        }

        .pagination-modern .active .page-link {
            background: var(--primary);
            color: white;
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
                    <i class="bi bi-laptop me-2" style="color: var(--primary);"></i>
                    Gestion des Ordinateurs
                </h1>
                <p class="text-muted small mb-0">Gérez votre parc informatique efficacement</p>
            </div>
            <div class="d-flex gap-2">
                @if(count($selectedOrdinateurs) > 0)
                    <button wire:click="confirmBulkDelete" class="btn btn-modern-danger btn-modern">
                        <i class="bi bi-trash3 me-1"></i> Supprimer ({{ count($selectedOrdinateurs) }})
                    </button>
                @endif
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

        <!-- Statistics Cards - Format Mini -->
        @if($showStats)
        <div class="row g-2 mb-4">
            <div class="col-xl-2 col-md-4 col-6">
                <div class="card stat-card-mini border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="stat-label">TOTAL</span>
                            <div class="stat-icon" style="background: var(--primary-soft);">
                                <i class="bi bi-laptop" style="color: var(--primary);"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($stats['total'] ?? 0) }}</div>
                        <div class="text-muted" style="font-size: 0.55rem;">Ordinateurs</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="card stat-card-mini border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="stat-label">EN SERVICE</span>
                            <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1);">
                                <i class="bi bi-check-circle" style="color: #10b981;"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($stats['en_service'] ?? 0) }}</div>
                        <div class="text-muted" style="font-size: 0.55rem;">Opérationnels</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="card stat-card-mini border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="stat-label">RÉPARATION</span>
                            <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">
                                <i class="bi bi-tools" style="color: #f59e0b;"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($stats['en_reparation'] ?? 0) }}</div>
                        <div class="text-muted" style="font-size: 0.55rem;">Maintenance</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="card stat-card-mini border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="stat-label">EN STOCK</span>
                            <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1);">
                                <i class="bi bi-box-seam" style="color: #3b82f6;"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($stats['en_stock'] ?? 0) }}</div>
                        <div class="text-muted" style="font-size: 0.55rem;">Disponibles</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="card stat-card-mini border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="stat-label">HORS SERVICE</span>
                            <div class="stat-icon" style="background: rgba(239, 68, 68, 0.1);">
                                <i class="bi bi-x-circle" style="color: #ef4444;"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($stats['hors_service'] ?? 0) }}</div>
                        <div class="text-muted" style="font-size: 0.55rem;">À réformer</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="card stat-card-mini border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="stat-label">DISPONIBILITÉ</span>
                            <div class="stat-icon" style="background: rgba(99, 102, 241, 0.1);">
                                <i class="bi bi-speedometer2" style="color: #6366f1;"></i>
                            </div>
                        </div>
                        @php
                            $taux = ($stats['total'] ?? 1) > 0 ? round((($stats['en_service'] ?? 0) / ($stats['total'] ?? 1)) * 100) : 0;
                        @endphp
                        <div class="stat-value">{{ $taux }}%</div>
                        <div class="progress mt-1" style="height: 2px;">
                            <div class="progress-bar" style="width: {{ $taux }}%; background: #6366f1;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filters -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-3">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3 col-sm-6">
                        <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Recherche</label>
                        <div class="position-relative">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="font-size: 0.7rem;"></i>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                   class="form-control form-control-sm ps-5 rounded-2" 
                                   style="font-size: 0.7rem;"
                                   placeholder="Nom, IP, OS...">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Entité</label>
                        <input type="text" wire:model.live="entite" 
                               class="form-control form-control-sm rounded-2"
                               style="font-size: 0.7rem;"
                               placeholder="Entité...">
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Statut</label>
                        <select wire:model.live="statut" class="form-select form-select-sm rounded-2" style="font-size: 0.7rem;">
                            <option value="">Tous</option>
                            @foreach($statuts as $statutOption)
                                <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Affichage</label>
                        <select wire:model.live="perPage" class="form-select form-select-sm rounded-2" style="font-size: 0.7rem;">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button wire:click="openImportModal" class="btn btn-modern-outline btn-modern flex-grow-1">
                                <i class="bi bi-upload me-1"></i> Importer
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
                @if($search || $statut || $entite)
                <div class="mt-3 pt-2 border-top">
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="small text-muted" style="font-size: 0.65rem;">Filtres actifs :</span>
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
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Table -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="table-responsive" style="max-height: 60vh;">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th style="width: 35px;">
                                <input type="checkbox" wire:model.live="selectAll" class="form-check-input rounded-1" style="width: 14px; height: 14px;">
                            </th>
                            <th wire:click="sortBy('nom')" style="cursor: pointer;">Nom <i class="bi bi-arrow-down-up ms-1 small"></i></th>
                            <th wire:click="sortBy('entite')" style="cursor: pointer;">Entité <i class="bi bi-arrow-down-up ms-1 small"></i></th>
                            <th wire:click="sortBy('statut')" style="cursor: pointer;">Statut <i class="bi bi-arrow-down-up ms-1 small"></i></th>
                            <th>Fabricant</th>
                            <th>Modèle</th>
                            <th>N° Série</th>
                            <th>Utilisateur</th>
                            <th>IP</th>
                            <th>OS</th>
                            <th wire:click="sortBy('updated_at')" style="cursor: pointer;">Modifié <i class="bi bi-arrow-down-up ms-1 small"></i></th>
                            <th style="width: 70px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ordinateurs as $ordinateur)
                        <tr wire:key="ord-{{ $ordinateur->id }}">
                            <td><input type="checkbox" wire:model.live="selectedOrdinateurs" value="{{ $ordinateur->id }}" class="form-check-input rounded-1" style="width: 14px; height: 14px;"></td>
                            <td class="fw-medium">{{ $ordinateur->nom }}</td>
                            <td>{{ $ordinateur->entite ?? '-' }}</td>
                            <td>
                                @php
                                    $statusMap = [
                                        'En service' => 'success',
                                        'En stock' => 'info',
                                        'En réparation' => 'warning',
                                        'Hors service' => 'danger'
                                    ];
                                    $color = $statusMap[$ordinateur->statut] ?? 'secondary';
                                    $iconMap = [
                                        'En service' => 'check-circle',
                                        'En stock' => 'box',
                                        'En réparation' => 'tools',
                                        'Hors service' => 'x-circle'
                                    ];
                                    $icon = $iconMap[$ordinateur->statut] ?? 'question-circle';
                                @endphp
                                <span class="badge-modern badge-{{ $color }}">
                                    <i class="bi bi-{{ $icon }}"></i> {{ $ordinateur->statut }}
                                </span>
                            </td>
                            <td>{{ $ordinateur->fabricant ?? '-' }}</td>
                            <td>{{ $ordinateur->modele ?? '-' }}</td>
                            <td><span class="font-monospace">{{ $ordinateur->numero_serie ?? '-' }}</span></td>
                            <td>
                                @php
                                    $liaisonActive = \App\Models\liaison_equipement::with('utilisateur')
                                        ->where('ordinateur_id', $ordinateur->id)
                                        ->where('statut', 'actif')
                                        ->first();
                                @endphp
                                @if($liaisonActive && $liaisonActive->utilisateur)
                                    <span class="d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-person-circle small" style="color: var(--primary);"></i>
                                        {{ $liaisonActive->utilisateur->nom }}
                                    </span>
                                @else
                                    <span class="text-muted">Non attribué</span>
                                @endif
                            </td>
                            <td><span class="font-monospace">{{ $ordinateur->reseau_ip ?? '-' }}</span></td>
                            <td>{{ $ordinateur->os_version ?? '-' }}</td>
                            <td class="text-muted">{{ $ordinateur->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button wire:click="showDetails({{ $ordinateur->id }})" class="btn btn-sm p-0" style="color: var(--primary); width: 24px; height: 24px;" title="Voir">
                                        <i class="bi bi-eye fs-6"></i>
                                    </button>
                                    <button wire:click="edit({{ $ordinateur->id }})" class="btn btn-sm p-0" style="color: #f59e0b; width: 24px; height: 24px;" title="Modifier">
                                        <i class="bi bi-pencil fs-6"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $ordinateur->id }})" class="btn btn-sm p-0" style="color: #ef4444; width: 24px; height: 24px;" title="Supprimer">
                                        <i class="bi bi-trash3 fs-6"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center py-4">
                                <i class="bi bi-laptop display-6 text-muted opacity-25 d-block mb-2"></i>
                                <p class="text-muted small mb-0">Aucun ordinateur trouvé</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($ordinateurs->hasPages())
            <div class="card-footer bg-white border-0 py-2">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span class="small text-muted" style="font-size: 0.65rem;">
                        {{ $ordinateurs->firstItem() ?? 0 }} - {{ $ordinateurs->lastItem() ?? 0 }} sur {{ $ordinateurs->total() }}
                    </span>
                    {{ $ordinateurs->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-3 shadow-lg">
                <div class="modal-header border-0 py-2" style="background: var(--primary);">
                    <h5 class="modal-title text-white fw-semibold" style="font-size: 0.95rem;">
                        <i class="bi bi-{{ $isEditing ? 'pencil' : 'plus-circle' }} me-2"></i>
                        {{ $isEditing ? 'Modifier l\'ordinateur' : 'Nouvel ordinateur' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Nom <span class="text-danger">*</span></label>
                                <input type="text" wire:model="nom" class="form-control form-modern @error('nom') is-invalid @enderror" placeholder="Ex: PC-Direction-01">
                                @error('nom') <small class="text-danger" style="font-size: 0.6rem;">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Statut</label>
                                <select wire:model="statut_form" class="form-select form-modern">
                                    <option value="">Sélectionner</option>
                                    @foreach($statuts as $s)
                                        <option value="{{ $s }}">{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Fabricant</label>
                                <input type="text" wire:model="fabricant" class="form-control form-modern" placeholder="Dell, HP, Lenovo...">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Modèle</label>
                                <input type="text" wire:model="modele" class="form-control form-modern" placeholder="Latitude 5420...">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Numéro de série</label>
                                <input type="text" wire:model="numero_serie" class="form-control form-modern" placeholder="SN-12345...">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Disque dur</label>
                                <input type="text" wire:model="disque_dur" class="form-control form-modern" placeholder="512 Go SSD">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Adresse IP</label>
                                <input type="text" wire:model="reseau_ip" class="form-control form-modern" placeholder="192.168.1.100">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Version OS</label>
                                <input type="text" wire:model="os_version" class="form-control form-modern" placeholder="Windows 11 Pro">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Entité</label>
                                <input type="text" wire:model="entite_form" class="form-control form-modern" placeholder="Direction...">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Sous-entité</label>
                                <input type="text" wire:model="sous_entite" class="form-control form-modern" placeholder="Service...">
                            </div>
                            <div class="col-md-12">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Utilisateur principal</label>
                                <select wire:model="utilisateur_id" class="form-select form-modern">
                                    <option value="">-- Non attribué --</option>
                                    @foreach($utilisateurs as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Notes</label>
                                <textarea wire:model="notes" rows="2" class="form-control form-modern" placeholder="Informations supplémentaires..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light py-2">
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
            <div class="modal-content border-0 rounded-3 shadow-lg text-center">
                <div class="modal-body p-4">
                    <i class="bi bi-trash3 text-danger" style="font-size: 2rem;"></i>
                    <h6 class="mt-2 fw-semibold" style="font-size: 0.9rem;">Confirmer la suppression</h6>
                    <p class="small text-muted mb-3">
                        @if($isBulkDelete)
                            Supprimer {{ count($selectedOrdinateurs) }} ordinateur(s) ?
                        @else
                            Supprimer "{{ $selectedOrdinateurName }}" ?
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
    @if($showDetailsModal && $selectedOrdinateur)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-3 shadow-lg">
                <div class="modal-header border-0 py-2" style="background: var(--primary);">
                    <h5 class="modal-title text-white fw-semibold" style="font-size: 0.95rem;">
                        <i class="bi bi-info-circle me-2"></i> Détails de l'ordinateur
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Nom</small>
                                <span class="fw-medium" style="font-size: 0.75rem;">{{ $selectedOrdinateur->nom }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Statut</small>
                                <span style="font-size: 0.75rem;">{{ $selectedOrdinateur->statut }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Fabricant / Modèle</small>
                                <span style="font-size: 0.75rem;">{{ $selectedOrdinateur->fabricant ?? '-' }} {{ $selectedOrdinateur->modele ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">N° Série</small>
                                <span class="font-monospace" style="font-size: 0.7rem;">{{ $selectedOrdinateur->numero_serie ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Adresse IP</small>
                                <span class="font-monospace" style="font-size: 0.7rem;">{{ $selectedOrdinateur->reseau_ip ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">OS</small>
                                <span style="font-size: 0.75rem;">{{ $selectedOrdinateur->os_version ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Entité</small>
                                <span style="font-size: 0.75rem;">{{ $selectedOrdinateur->entite ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Utilisateur</small>
                                <span style="font-size: 0.75rem;">{{ $selectedOrdinateur->utilisateur->name ?? 'Non attribué' }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light rounded-2 p-2">
                                <small class="text-muted d-block" style="font-size: 0.6rem;">Notes</small>
                                <span style="font-size: 0.75rem;">{{ $selectedOrdinateur->notes ?? 'Aucune note' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light py-2">
                    <button type="button" class="btn btn-modern-outline btn-modern" wire:click="closeDetailsModal">
                        <i class="bi bi-x me-1"></i> Fermer
                    </button>
                    <button type="button" class="btn btn-modern-primary btn-modern" wire:click="edit({{ $selectedOrdinateur->id }})">
                        <i class="bi bi-pencil me-1"></i> Modifier
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
            <div class="modal-content border-0 rounded-3 shadow-lg">
                <div class="modal-header border-0 py-2" style="background: var(--primary);">
                    <h5 class="modal-title text-white fw-semibold" style="font-size: 0.95rem;">
                        <i class="bi bi-upload me-2"></i> Importer des ordinateurs
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeImportModal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="alert alert-info small rounded-2 mb-3" style="background: var(--primary-soft); border: none; font-size: 0.7rem;">
                        <i class="bi bi-info-circle me-2"></i> Formats supportés: CSV, XLSX. Taille max: 10MB
                    </div>
                    <div class="mb-3">
                        <label class="small fw-semibold text-muted mb-1 d-block" style="font-size: 0.7rem;">Fichier à importer</label>
                        <input type="file" wire:model="fichierExcel" class="form-control form-modern" accept=".csv,.xlsx">
                        @error('fichierExcel') <small class="text-danger" style="font-size: 0.6rem;">{{ $message }}</small> @enderror
                    </div>
                    <button type="button" wire:click="downloadTemplate" class="btn btn-modern-outline btn-modern w-100">
                        <i class="bi bi-download me-1"></i> Télécharger le template
                    </button>
                </div>
                <div class="modal-footer border-0 bg-light py-2">
                    <button class="btn btn-modern-outline btn-modern" wire:click="closeImportModal">
                        <i class="bi bi-x me-1"></i> Annuler
                    </button>
                    <button class="btn btn-modern-primary btn-modern" wire:click="storeImportFile" wire:loading.attr="disabled" {{ !$fichierExcel ? 'disabled' : '' }}>
                        <span wire:loading.remove><i class="bi bi-upload me-1"></i> Importer</span>
                        <span wire:loading><i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i> Import...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>