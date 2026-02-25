<div class="container-fluid py-4" style="min-height: 100vh; background: transparent;">
    <!-- Assets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .fullscreen-table {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .fullscreen-table.active {
            display: flex;
        }

        .fullscreen-table .card {
            width: 95vw;
            height: 90vh;
            max-width: 1800px;
            background: var(--card-bg);
            backdrop-filter: blur(var(--blur-amount));
            display: flex;
            flex-direction: column;
            animation: zoomIn 0.3s ease;
        }

        .fullscreen-table .card-body {
            flex: 1;
            overflow: auto;
            padding: 0;
        }

        .fullscreen-table .table {
            margin-bottom: 0;
        }

        .fullscreen-table .table thead th {
            position: sticky;
            top: 0;
            background: var(--card-bg);
            backdrop-filter: blur(var(--blur-amount));
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .fullscreen-table .table tbody tr {
            cursor: pointer;
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(var(--blur-amount));
            -webkit-backdrop-filter: blur(var(--blur-amount));
            border: 1px solid var(--border-light);
            border-radius: 28px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
            background: rgba(255, 255, 255, 0.95);
        }

        [data-bs-theme="dark"] .card:hover {
            background: rgba(30, 41, 59, 0.95);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-light);
            padding: 1.5rem 1.75rem;
        }

        .card-body {
            padding: 1.75rem;
        }

        .stat-card {
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            background: var(--card-bg);
            backdrop-filter: blur(var(--blur-amount));
            -webkit-backdrop-filter: blur(var(--blur-amount));
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(79, 187, 178, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: transform 0.3s ease;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-icon.primary { background: var(--gradient-teal); color: white; }
        .stat-icon.success { background: linear-gradient(135deg, rgba(16, 185, 129, 0.9), rgba(5, 150, 105, 0.9)); color: white; }
        .stat-icon.danger { background: linear-gradient(135deg, rgba(239, 68, 68, 0.9), rgba(185, 28, 28, 0.9)); color: white; }
        .stat-icon.warning { background: linear-gradient(135deg, rgba(245, 158, 11, 0.9), rgba(217, 119, 6, 0.9)); color: white; }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.25rem;
            color: var(--dark);
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.75rem;
            border-radius: 30px;
            border: 1px solid var(--border-light);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .badge.bg-primary { background: rgba(79, 187, 178, 0.15) !important; color: var(--primary); border-color: rgba(79, 187, 178, 0.3); }
        .badge.bg-success { background: rgba(16, 185, 129, 0.15) !important; color: var(--success); border-color: rgba(16, 185, 129, 0.3); }
        .badge.bg-danger { background: rgba(239, 68, 68, 0.15) !important; color: var(--danger); border-color: rgba(239, 68, 68, 0.3); }
        .badge.bg-warning { background: rgba(245, 158, 11, 0.15) !important; color: var(--warning); border-color: rgba(245, 158, 11, 0.3); }

        .btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            border: 1px solid var(--border-light);
            background: var(--card-bg);
            backdrop-filter: blur(var(--blur-amount));
            -webkit-backdrop-filter: blur(var(--blur-amount));
            color: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
        }

        .btn-icon:hover {
            border-color: var(--primary);
            color: white;
            background: var(--primary);
            transform: rotate(180deg);
        }

        .btn-refresh {
            padding: 0.6rem 1.5rem;
            border-radius: 14px;
            border: 1px solid var(--border-light);
            background: var(--card-bg);
            backdrop-filter: blur(var(--blur-amount));
            -webkit-backdrop-filter: blur(var(--blur-amount));
            color: var(--dark);
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
        }

        .btn-refresh:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .btn-refresh i {
            transition: transform 0.5s ease;
        }

        .btn-refresh:hover i {
            transform: rotate(360deg);
        }

        .btn-view-all {
            padding: 0.6rem 1.5rem;
            border-radius: 14px;
            border: 1px solid var(--border-light);
            background: var(--primary);
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-view-all:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
            box-shadow: var(--shadow-md);
        }

        .btn-view-all i {
            transition: transform 0.3s ease;
        }

        .btn-view-all:hover i {
            transform: translateX(5px);
        }

        .btn-close-fullscreen {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 20;
            background: var(--danger);
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid var(--border-light);
            backdrop-filter: blur(var(--blur-amount));
        }

        .btn-close-fullscreen:hover {
            transform: rotate(90deg) scale(1.1);
            background: #dc2626;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: rgba(6, 182, 212, 0.03);
            color: var(--gray);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1.25rem 1.5rem;
            border-bottom: none;
        }

        .table tbody tr {
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(6, 182, 212, 0.03);
            border-left-color: var(--primary);
            transform: scale(1.01);
            box-shadow: var(--shadow-sm);
        }

        .table td {
            padding: 1.25rem 1.5rem;
            color: var(--dark);
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }

        .progress {
            height: 8px;
            border-radius: 4px;
            background: rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .progress-bar {
            background: var(--gradient-teal);
            border-radius: 4px;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .page-subtitle {
            color: var(--gray);
            font-size: 1rem;
            font-weight: 500;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .card-header, .card-body {
                padding: 1.25rem;
            }
            .stat-value {
                font-size: 2rem;
            }
            .page-title {
                font-size: 1.75rem;
            }
        }
    </style>

    <!-- Fullscreen Table Modal -->
    <div class="fullscreen-table" id="fullscreenTable">
        <div class="card">
            <button class="btn-close-fullscreen" id="closeFullscreen">
                <i class="fas fa-times"></i>
            </button>
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 fw-700">Toutes les activités</h4>
                    <p class="text-muted small mb-0">Liste complète des événements</p>
                </div>
                <span class="badge bg-primary">{{ count($this->UnifiedActivities ?? []) }} événements</span>
            </div>
            <div class="card-body">
                <div class="table-responsive h-100">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Type</th>
                                <th>Description</th>
                                <th>Utilisateur</th>
                                <th>Statut</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($this->UnifiedActivities as $activity)
                            @php
                                $activityColor = isset($activity['color']) ? $activity['color'] : 'info';
                                $color = match($activityColor) {
                                    'orange', 'warning' => 'warning',
                                    'info' => 'primary',
                                    'danger' => 'danger',
                                    'success' => 'success',
                                    default => 'primary'
                                };
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-{{ $color }}">
                                        <i class="{{ $activity['icon'] ?? 'fas fa-circle' }} me-2"></i> 
                                        {{ $activity['type'] ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-600">{{ $activity['title'] ?? '' }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-{{ $color }} bg-opacity-10 p-2 me-2">
                                            <i class="fas fa-user-circle text-{{ $color }}"></i>
                                        </div>
                                        <span class="text-muted">{{ $activity['user'] ?? '' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }}">
                                        {{ $activity['status'] ?? '' }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <button class="btn-icon btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-inbox fa-3x mb-3" style="color: var(--gray);"></i>
                                        <h6 class="fw-600 mb-2">Aucune activité récente</h6>
                                        <p class="text-muted small mb-0">Les nouvelles activités apparaîtront ici</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-5 fade-in">
        <div>
            <h1 class="page-title">Tableau de bord</h1>
            <p class="page-subtitle">
                <i class="fas fa-circle me-2" style="color: #10b981; font-size: 0.5rem;"></i>
                Infrastructure et monitoring en temps réel
            </p>
        </div>
        <div class="d-flex gap-3">
            <button class="btn-icon" id="themeToggle">
                <i class="fas fa-moon"></i>
            </button>
            <button class="btn-refresh" wire:click="refreshCharts">
                <i class="fas fa-sync-alt me-2"></i>Actualiser
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <!-- Incident -->
        <div class="col-md-6 col-xl-3 fade-in" style="animation-delay: 0.1s">
            <div class="card stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-label mb-1">Incidents</p>
                        <h2 class="stat-value">{{ $totalIncidents ?? 0 }}</h2>
                        <span class="badge bg-danger mt-3">
                            <i class="fas fa-arrow-up me-1"></i>+12% cette semaine
                        </span>
                    </div>
                    <div class="stat-icon danger float-animation">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
                <div id="spark1" wire:ignore class="mt-4"></div>
            </div>
        </div>

        <!-- Tickets -->
        <div class="col-md-6 col-xl-3 fade-in" style="animation-delay: 0.15s">
            <div class="card stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-label mb-1">Tickets ouverts</p>
                        <h2 class="stat-value">{{ $stats['total_tickets'] ?? 0 }}</h2>
                        <span class="badge bg-primary mt-3">
                            <i class="fas fa-clock me-1"></i>24 en attente
                        </span>
                    </div>
                    <div class="stat-icon primary float-animation">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
                <div id="spark2" wire:ignore class="mt-4"></div>
            </div>
        </div>

        <!-- Sorties -->
        <div class="col-md-6 col-xl-3 fade-in" style="animation-delay: 0.2s">
            <div class="card stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-label mb-1">Sorties en cours</p>
                        <h2 class="stat-value">{{ $stats['total_checkouts'] ?? 0 }}</h2>
                        <span class="badge bg-success mt-3">
                            <i class="fas fa-rotate-left me-1"></i>8 à retourner
                        </span>
                    </div>
                    <div class="stat-icon success float-animation">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
                <div id="spark3" wire:ignore class="mt-4"></div>
            </div>
        </div>

        <!-- Résolution -->
        <div class="col-md-6 col-xl-3 fade-in" style="animation-delay: 0.25s">
            @php
                $sum = isset($incidentsChartData) ? array_sum($incidentsChartData) : 0;
                $res = isset($incidentsChartData['Résolus']) ? $incidentsChartData['Résolus'] : 0;
                $rate = $sum > 0 ? round(($res / $sum) * 100) : 0;
            @endphp
            <div class="card stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-label mb-1">Taux de résolution</p>
                        <h2 class="stat-value">{{ $rate }}%</h2>
                        <div class="progress mt-3" style="width: 90%;">
                            <div class="progress-bar" style="width: {{ $rate }}%"></div>
                        </div>
                    </div>
                    <div class="stat-icon warning float-animation">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div id="spark4" wire:ignore class="mt-4"></div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6 fade-in" style="animation-delay: 0.3s">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-700">Évolution des tickets</h6>
                        <p class="text-muted small mb-0">Activité des 30 derniers jours</p>
                    </div>
                    <span class="badge bg-primary">
                        <i class="fas fa-chart-line me-1"></i>+23%
                    </span>
                </div>
                <div class="card-body" wire:ignore>
                    <div id="chartTickets"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 fade-in" style="animation-delay: 0.35s">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-700">Activité des sorties</h6>
                        <p class="text-muted small mb-0">Mouvements d'équipements</p>
                    </div>
                    <span class="badge bg-success">
                        <i class="fas fa-arrow-up me-1"></i>+15%
                    </span>
                </div>
                <div class="card-body" wire:ignore>
                    <div id="chartCheckouts"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6 fade-in" style="animation-delay: 0.4s">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-700">Équipements par type</h6>
                        <p class="text-muted small mb-0">Répartition du stock</p>
                    </div>
                    <span class="badge bg-primary">Total: 156</span>
                </div>
                <div class="card-body" wire:ignore>
                    <div id="chartEquipments"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 fade-in" style="animation-delay: 0.45s">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-700">Logiciels par catégorie</h6>
                        <p class="text-muted small mb-0">Distribution des licences</p>
                    </div>
                    <span class="badge bg-warning">
                        <i class="fas fa-key me-1"></i>234 licences
                    </span>
                </div>
                <div class="card-body" wire:ignore>
                    <div id="chartSoftware"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table des activités avec bouton Voir tous -->
    <div class="card fade-in" style="animation-delay: 0.5s">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-1 fw-700">Activités récentes</h6>
                <p class="text-muted small mb-0">Derniers événements enregistrés</p>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <span class="badge bg-primary">{{ count($this->UnifiedActivities ?? []) }} événements</span>
                <a href="{{ route('admin.activites') }}" target="_blank" class="btn-view-all text-decoration-none" id="viewAllBtn">
                    <i class="fas fa-eye me-2"></i>Voir tous
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        <div class="table-responsive" style="max-height: 400px;">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Type</th>
                        <th>Description</th>
                        <th>Utilisateur</th>
                        <th>Statut</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->UnifiedActivities as $activity)
                    @php
                        $activityColor = isset($activity['color']) ? $activity['color'] : 'info';
                        $color = match($activityColor) {
                            'orange', 'warning' => 'warning',
                            'info' => 'primary',
                            'danger' => 'danger',
                            'success' => 'success',
                            default => 'primary'
                        };
                    @endphp
                    <tr>
                        <td class="ps-4">
                            <span class="badge bg-{{ $color }}">
                                <i class="{{ $activity['icon'] ?? 'fas fa-circle' }} me-2"></i> 
                                {{ $activity['type'] ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-600">{{ $activity['title'] ?? '' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-{{ $color }} bg-opacity-10 p-2 me-2">
                                    <i class="fas fa-user-circle text-{{ $color }}"></i>
                                </div>
                                <span class="text-muted">{{ $activity['user'] ?? '' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }}">
                                {{ $activity['status'] ?? '' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <button class="btn-icon btn-sm">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="py-4">
                                <i class="fas fa-inbox fa-3x mb-3" style="color: var(--gray);"></i>
                                <h6 class="fw-600 mb-2">Aucune activité récente</h6>
                                <p class="text-muted small mb-0">Les nouvelles activités apparaîtront ici</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        let charts = {};

        // Fullscreen table functionality
        const fullscreenTable = document.getElementById('fullscreenTable');
        const viewAllBtn = document.getElementById('viewAllBtn');
        const closeFullscreen = document.getElementById('closeFullscreen');

        if (viewAllBtn) {
            viewAllBtn.addEventListener('click', () => {
                fullscreenTable.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        if (closeFullscreen) {
            closeFullscreen.addEventListener('click', () => {
                fullscreenTable.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && fullscreenTable.classList.contains('active')) {
                fullscreenTable.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Close on click outside
        fullscreenTable.addEventListener('click', (e) => {
            if (e.target === fullscreenTable) {
                fullscreenTable.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        function initCharts() {
            try {
                const dataTickets = @json($monthlyTicketsData ?? []);
                const dataCheckouts = @json($monthlyCheckoutsData ?? []);
                const dataEquip = @json($equipmentTypeData ?? []);
                const dataSoft = @json($softwareCategoryData ?? []);
                
              incidentData = <?php echo json_encode(array_values($incidentTrendData['data'] ?? [0, 0, 0])); ?>;

                for (let key in charts) {
                    if (charts[key] && typeof charts[key].destroy === 'function') {
                        try { charts[key].destroy(); } catch(e) {}
                    }
                }
                charts = {};

                const createSpark = (id, data, color) => {
                    const element = document.getElementById(id);
                    if (!element) return;
                    
                    try {
                        charts[id] = new ApexCharts(element, {
                            chart: { 
                                type: 'area', 
                                height: 40, 
                                sparkline: { enabled: true },
                                animations: { enabled: true, easing: 'easeinout', speed: 800 }
                            },
                            stroke: { curve: 'smooth', width: 2 },
                            colors: [color],
                            fill: { 
                                opacity: 0.3,
                                type: 'gradient',
                                gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0 }
                            },
                            series: [{ data: data }],
                            tooltip: { enabled: false }
                        });
                        charts[id].render();
                    } catch(e) {}
                };

                createSpark('spark1', incidentData, '#ef4444');
                createSpark('spark2', Object.values(dataTickets).slice(-10), '#4361ee');
                createSpark('spark3', Object.values(dataCheckouts).slice(-10), '#10b981');
                createSpark('spark4', [80, 85, 90, 88, 92], '#f59e0b');

                const chartTickets = document.getElementById('chartTickets');
                if (chartTickets) {
                    charts.t = new ApexCharts(chartTickets, {
                        series: [{ name: 'Tickets', data: Object.values(dataTickets) }],
                        chart: { 
                            type: 'area', 
                            height: 280, 
                            toolbar: { show: false },
                            animations: { enabled: true, easing: 'easeinout', speed: 800 }
                        },
                        colors: ['#4fbbb2'],
                        stroke: { curve: 'smooth', width: 3 },
                        fill: { 
                            opacity: 0.1, 
                            type: 'gradient',
                            gradient: { shadeIntensity: 1, opacityFrom: 0.2, opacityTo: 0 }
                        },
                        dataLabels: { enabled: false },
                        grid: { borderColor: 'var(--border-light)', strokeDashArray: 5 },
                        xaxis: { 
                            categories: Object.keys(dataTickets), 
                            axisBorder: { show: false },
                            labels: { style: { colors: 'var(--gray)' } }
                        },
                        yaxis: { 
                            labels: { style: { colors: 'var(--gray)' } }
                        },
                        tooltip: { theme: 'dark' }
                    });
                    charts.t.render();
                }

                const chartCheckouts = document.getElementById('chartCheckouts');
                if (chartCheckouts) {
                    charts.c = new ApexCharts(chartCheckouts, {
                        series: [{ name: 'Sorties', data: Object.values(dataCheckouts) }],
                        chart: { 
                            type: 'bar', 
                            height: 280, 
                            toolbar: { show: false },
                            animations: { enabled: true, easing: 'easeinout', speed: 800 }
                        },
                        colors: ['#8b5cf6'],
                        plotOptions: { 
                            bar: { 
                                borderRadius: 8, 
                                columnWidth: '60%',
                                distributed: true
                            } 
                        },
                        dataLabels: { enabled: false },
                        grid: { borderColor: 'var(--border-light)', strokeDashArray: 5 },
                        xaxis: { 
                            categories: Object.keys(dataCheckouts), 
                            axisBorder: { show: false },
                            labels: { style: { colors: 'var(--gray)' } }
                        },
                        yaxis: { 
                            labels: { style: { colors: 'var(--gray)' } }
                        },
                        tooltip: { theme: 'dark' }
                    });
                    charts.c.render();
                }

                const chartEquipments = document.getElementById('chartEquipments');
                if (chartEquipments && Object.keys(dataEquip).length > 0) {
                    charts.e = new ApexCharts(chartEquipments, {
                        series: Object.values(dataEquip),
                        labels: Object.keys(dataEquip),
                        chart: { 
                            type: 'donut', 
                            height: 280,
                            animations: { enabled: true, easing: 'easeinout', speed: 800 }
                        },
                        colors: ['#06b6d4', '#8b5cf6', '#2dd4bf', '#10b981', '#f59e0b'],
                        plotOptions: { 
                            pie: { 
                                donut: { 
                                    size: '65%',
                                    labels: {
                                        show: true,
                                        name: { show: true },
                                        value: { show: true, fontSize: '16px', fontWeight: 600 },
                                        total: { show: true, label: 'Total' }
                                    }
                                } 
                            } 
                        },
                        legend: { 
                            position: 'bottom', 
                            fontSize: '12px',
                            labels: { colors: 'var(--dark)' }
                        },
                        dataLabels: { enabled: false },
                        stroke: { show: false },
                        tooltip: { theme: 'dark' }
                    });
                    charts.e.render();
                }

                const chartSoftware = document.getElementById('chartSoftware');
                if (chartSoftware && Object.keys(dataSoft).length > 0) {
                    charts.s = new ApexCharts(chartSoftware, {
                        series: Object.values(dataSoft),
                        labels: Object.keys(dataSoft),
                        chart: { 
                            type: 'pie', 
                            height: 280,
                            animations: { enabled: true, easing: 'easeinout', speed: 800 }
                        },
                        colors: ['#4361ee', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                        legend: { 
                            position: 'bottom', 
                            fontSize: '12px',
                            labels: { colors: 'var(--dark)' }
                        },
                        dataLabels: { enabled: false },
                        stroke: { show: false },
                        tooltip: { theme: 'dark' }
                    });
                    charts.s.render();
                }
            } catch(e) {
                console.error('Erreur lors de l\'initialisation des graphiques:', e);
            }
        }

        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const html = document.documentElement;
                const theme = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-bs-theme', theme);
                localStorage.setItem('theme', theme);
                
                const icon = document.querySelector('#themeToggle i');
                if (icon) {
                    icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                }
                
                Object.values(charts).forEach(chart => {
                    if (chart && chart.updateOptions) {
                        chart.updateOptions({
                            xaxis: { labels: { style: { colors: theme === 'dark' ? '#94a3b8' : '#64748b' } } },
                            yaxis: { labels: { style: { colors: theme === 'dark' ? '#94a3b8' : '#64748b' } } },
                            grid: { borderColor: theme === 'dark' ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)' },
                            legend: { labels: { colors: theme === 'dark' ? '#f8fafc' : '#1e293b' } }
                        });
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            try {
                const saved = localStorage.getItem('theme') || 'light';
                document.documentElement.setAttribute('data-bs-theme', saved);
                const icon = document.querySelector('#themeToggle i');
                if (icon) {
                    icon.className = saved === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                }
                initCharts();
            } catch(e) {}
        });

        window.addEventListener('chartsRefreshed', () => {
            initCharts();
        });
    </script>
</div>