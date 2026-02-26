<div class="container-fluid py-4">
    <!-- Main Table Card - Search and filters now in header -->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border-0 shadow-lg fade-in" style="border-radius: 24px; animation-delay: 0.1s; background: var(--card-bg);">
                <div class="card-header border-0 bg-transparent py-4 px-4">
                    <!-- Header with title, filters and switch -->
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-4">
                        <!-- Left side: Title and counter -->
                        <div class="d-flex align-items-center">
                            <div class="stats-indicator me-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                    <i class="fas fa-list me-2"></i>{{ $activities->total() ?? 0 }} activités
                                </span>
                            </div>
                            <h5 class="fw-700 mb-0 ms-2">Historique complet</h5>
                        </div>

                        <!-- Center: Search and filters -->
                        <div class="d-flex flex-column flex-md-row align-items-center gap-3 flex-grow-1 justify-content-center">
                            <div class="position-relative search-input-wrapper" style="width: 100%; max-width: 350px;">
                                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <input type="text" wire:model.debounce.300ms="search" 
                                    class="form-control border-0 shadow-sm ps-5" 
                                    style="border-radius: 50px; width: 100%; height: 45px; background: var(--card-bg); border: 1px solid rgba(0,0,0,0.03) !important;" 
                                    placeholder="Rechercher une activité...">
                                @if(strlen($search) > 0)
                                <button wire:click="$set('search', '')" class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent" style="right: 5px !important;">
                                    <i class="fas fa-times-circle text-muted"></i>
                                </button>
                                @endif
                            </div>
                            
                            <div class="filter-select-wrapper">
                                <select wire:model="typeFilter" class="form-select border-0 shadow-sm" style="border-radius: 50px; width: 200px; height: 45px; background: var(--card-bg); border: 1px solid rgba(0,0,0,0.03) !important; cursor: pointer; padding-left: 20px;">
                                    <option value="all">Toutes les activités</option>
                                    <option value="ticket">🎫 Tickets uniquement</option>
                                    <option value="incident">⚠️ Incidents uniquement</option>
                                    <option value="checkout">🚪 Checkouts uniquement</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right side: Active only switch -->
                        <div class="form-check form-switch custom-switch">
                            <input class="form-check-input" type="checkbox" wire:model="onlyActive" id="activeOnly">
                            <label class="form-check-label fw-600 text-muted ms-2" for="activeOnly" style="cursor: pointer;">
                                <i class="fas fa-clock me-1"></i>En cours uniquement
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive px-2">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="ps-4 py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Date & Heure</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Type</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Description</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Utilisateur</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Assigné à</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Statut</th>
                                <th class="text-end pe-4 py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $activity)
                            <tr style="transition: all 0.2s ease;">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="date-badge me-2">
                                            <span class="fw-700 text-dark">{{ $activity['date']->format('d') }}</span>
                                            <span class="text-muted small">{{ $activity['date']->format('M') }}</span>
                                        </div>
                                        <div>
                                            <div class="fw-600 mb-0 small">{{ $activity['date']->translatedFormat('d M Y') }}</div>
                                            <div class="text-muted small">{{ $activity['date']->format('H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $activity['color'] }} bg-opacity-10 text-{{ $activity['color'] }} px-3 py-2 rounded-pill fw-600" style="font-size: 0.72rem;">
                                        <i class="{{ $activity['icon'] }} me-2"></i>{{ $activity['type'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-700 text-dark">{{ $activity['title'] }}</div>
                                    <div class="text-muted small">ID: #{{ $activity['id'] }}</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <span class="fw-600 text-muted">{{ $activity['user'] }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted small fw-500">{{ $activity['assigned_to'] }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $activity['color'] }} px-3 py-1 rounded-pill fw-600" style="font-size: 0.68rem; letter-spacing: 0.02em;">
                                        {{ $activity['status'] }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-icon-only border-0 bg-light rounded-circle shadow-sm" style="width: 34px; height: 34px; transition: all 0.3s ease;" title="Voir les détails">
                                        <i class="fas fa-eye text-muted small"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="py-4">
                                        <div class="empty-state-icon mb-3">
                                            <i class="fas fa-search fa-4x" style="color: var(--gray-300);"></i>
                                        </div>
                                        <h6 class="fw-600 text-muted">Aucune activité trouvée</h6>
                                        <p class="text-muted small">Essayez de modifier vos filtres ou votre recherche</p>
                                        <button wire:click="resetFilters" class="btn btn-sm btn-outline-primary rounded-pill px-4 mt-2">
                                            <i class="fas fa-redo me-2"></i>Réinitialiser
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($activities->hasPages())
                <div class="card-footer border-0 bg-transparent py-4 px-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="text-muted small">
                            Affichage de {{ $activities->firstItem() ?? 0 }} à {{ $activities->lastItem() ?? 0 }} sur {{ $activities->total() }} activités
                        </div>
                        <div class="pagination-custom">
                            {{ $activities->links() }}
                        </div>
                        <div class="per-page-selector">
                            <select wire:model="perPage" class="form-select form-select-sm border-0 bg-light rounded-pill" style="width: auto; cursor: pointer;">
                                <option value="10">10 par page</option>
                                <option value="25">25 par page</option>
                                <option value="50">50 par page</option>
                                <option value="100">100 par page</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .avatar-sm { 
            font-size: 0.8rem; 
            transition: all 0.3s ease;
        }
        
        .custom-switch .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-icon-only {
            transition: all 0.3s ease;
        }
        
        .btn-icon-only:hover {
            transform: translateY(-2px);
            background: var(--primary) !important;
            color: white !important;
            box-shadow: 0 5px 15px rgba(79, 187, 178, 0.3) !important;
        }
        
        .btn-icon-only:hover i {
            color: white !important;
        }

        .table > :not(caption) > * > * {
            padding: 1rem 0.5rem;
        }

        tr:hover {
            background-color: rgba(79, 187, 178, 0.02) !important;
            transform: scale(1);
        }

        .uppercase {
            text-transform: uppercase;
        }

        /* Améliorations design */
        .search-input-wrapper input:focus,
        .filter-select-wrapper select:focus {
            box-shadow: 0 0 0 3px rgba(79, 187, 178, 0.1) !important;
            outline: none;
        }

        .date-badge {
            background: rgba(79, 187, 178, 0.1);
            border-radius: 8px;
            padding: 4px 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            line-height: 1.2;
            min-width: 40px;
        }

        .date-badge span:first-child {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .date-badge span:last-child {
            font-size: 0.65rem;
            text-transform: uppercase;
        }

        .pagination-custom nav .pagination {
            margin-bottom: 0;
            gap: 5px;
        }

        .pagination-custom .page-link {
            border: none;
            border-radius: 50px !important;
            margin: 0 2px;
            color: #6c757d;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .pagination-custom .page-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 187, 178, 0.3);
        }

        .pagination-custom .active .page-link {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .empty-state-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Header responsive adjustments */
        @media (max-width: 992px) {
            .card-header .d-flex {
                gap: 1rem !important;
            }
            
            .search-input-wrapper {
                max-width: 100% !important;
            }
            
            .filter-select-wrapper select {
                width: 100% !important;
            }
        }

        @media (max-width: 768px) {
            .card-header {
                padding: 1.5rem !important;
            }
            
            .filter-select-wrapper {
                width: 100%;
            }
            
            .filter-select-wrapper select {
                width: 100% !important;
            }
        }
    </style>
</div>