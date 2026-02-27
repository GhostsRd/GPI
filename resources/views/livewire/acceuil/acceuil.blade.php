<div class="container-fluid py-4" style="min-height: 100vh; background: transparent;">
    <!-- Assets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #5BC4BF;
            --primary-light: #7ED6D3;
            --primary-dark: #3A9692;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
        }

        [data-bs-theme="dark"] {
            --gray-50: #111827;
            --gray-100: #1f2937;
            --gray-200: #374151;
            --gray-300: #4b5563;
            --gray-400: #6b7280;
            --gray-500: #9ca3af;
            --gray-600: #d1d5db;
            --gray-700: #e5e7eb;
            --gray-800: #f3f4f6;
            --gray-900: #f9fafb;
        }

        /* Cards simplifiés */
        .card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: all 0.2s ease;
        }

        [data-bs-theme="dark"] .card {
            background: var(--gray-800);
            border-color: var(--gray-700);
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
        }

        [data-bs-theme="dark"] .card-header {
            border-bottom-color: var(--gray-700);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Stats cards simplifiés */
        .stat-card {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-info h3 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }

        .stat-info p {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-500);
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
            background: var(--primary);
        }

        .stat-trend {
            font-size: 0.75rem;
            margin-top: 0.5rem;
            color: var(--gray-500);
        }

        .stat-trend i {
            margin-right: 0.25rem;
        }

        .stat-trend .up { color: #10b981; }
        .stat-trend .down { color: #ef4444; }

        /* Badges simplifiés */
        .badge {
            padding: 0.375rem 0.75rem;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 20px;
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        [data-bs-theme="dark"] .badge {
            background: var(--gray-700);
            color: var(--gray-200);
            border-color: var(--gray-600);
        }

        .badge-primary {
            background: rgba(91, 196, 191, 0.1);
            color: var(--primary);
            border-color: rgba(91, 196, 191, 0.2);
        }

        /* Boutons simplifiés */
        .btn-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            border: 1px solid var(--gray-200);
            background: white;
            color: var(--gray-600);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        [data-bs-theme="dark"] .btn-icon {
            background: var(--gray-800);
            border-color: var(--gray-700);
            color: var(--gray-400);
        }

        .btn-icon:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: scale(1.05);
        }

        .btn-refresh {
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--gray-200);
            background: white;
            color: var(--gray-700);
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        [data-bs-theme="dark"] .btn-refresh {
            background: var(--gray-800);
            border-color: var(--gray-700);
            color: var(--gray-300);
        }

        .btn-refresh:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .btn-refresh i {
            transition: transform 0.3s ease;
        }

        .btn-refresh:hover i {
            transform: rotate(180deg);
        }

        /* Table simplifiée */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: transparent;
            color: var(--gray-500);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }

        [data-bs-theme="dark"] .table thead th {
            border-bottom-color: var(--gray-700);
            color: var(--gray-400);
        }

        .table td {
            padding: 1rem 1.5rem;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        [data-bs-theme="dark"] .table td {
            border-bottom-color: var(--gray-800);
            color: var(--gray-300);
        }

        .table tbody tr:hover td {
            background: var(--gray-50);
        }

        [data-bs-theme="dark"] .table tbody tr:hover td {
            background: var(--gray-800);
        }

        /* Progress bar simplifiée */
        .progress {
            height: 6px;
            border-radius: 3px;
            background: var(--gray-100);
            overflow: hidden;
        }

        [data-bs-theme="dark"] .progress {
            background: var(--gray-700);
        }

        .progress-bar {
            background: var(--primary);
            border-radius: 3px;
        }

        /* Titres simplifiés */
        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
            letter-spacing: -0.025em;
        }

        .page-subtitle {
            color: var(--gray-500);
            font-size: 0.875rem;
            font-weight: 400;
        }

        /* Animations fluides */
        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Chart container simplifié */
        .chart-container {
            width: 100%;
            height: 250px;
            margin-top: 0.5rem;
        }

        .small-chart {
            height: 40px;
            width: 100%;
        }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
        <div>
            <h1 class="page-title">Tableau de bord</h1>
            <p class="page-subtitle">Vue d'ensemble de l'activité</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn-icon" id="themeToggle">
                <i class="fas fa-moon"></i>
            </button>
            <button class="btn-refresh" wire:click="refreshCharts">
                <i class="fas fa-sync-alt me-2"></i>Actualiser
            </button>
        </div>
    </div>

    <!-- Stats Cards - Design simplifié -->
    <div class="row g-3 mb-4">
        <!-- Incident -->
        <div class="col-md-6 col-xl-3 fade-in" style="animation-delay: 0.1s">
            <div class="card stat-card">
                <div class="stat-info">
                    <p>Incidents</p>
                    <h3>{{ $totalIncidents ?? 0 }}</h3>
                    <div class="stat-trend">
                        <i class="fas fa-arrow-up up"></i>
                        <span>+12% cette semaine</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div id="spark1" class="small-chart mt-3" wire:ignore></div>
            </div>
        </div>

        <!-- Tickets -->
        <div class="col-md-6 col-xl-3 fade-in" style="animation-delay: 0.15s">
            <div class="card stat-card">
                <div class="stat-info">
                    <p>Tickets ouverts</p>
                    <h3>{{ $stats['total_tickets'] ?? 0 }}</h3>
                    <div class="stat-trend">
                        <i class="fas fa-clock me-1"></i>
                        <span>24 en attente</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div id="spark2" class="small-chart mt-3" wire:ignore></div>
            </div>
        </div>

        <!-- Sorties -->
        <div class="col-md-6 col-xl-3 fade-in" style="animation-delay: 0.2s">
            <div class="card stat-card">
                <div class="stat-info">
                    <p>Sorties en cours</p>
                    <h3>{{ $stats['total_checkouts'] ?? 0 }}</h3>
                    <div class="stat-trend">
                        <i class="fas fa-rotate-left me-1"></i>
                        <span>8 à retourner</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div id="spark3" class="small-chart mt-3" wire:ignore></div>
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
                <div class="stat-info">
                    <p>Taux de résolution</p>
                    <h3>{{ $rate }}%</h3>
                    <div class="progress mt-2" style="width: 90%;">
                        <div class="progress-bar" style="width: {{ $rate }}%"></div>
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div id="spark4" class="small-chart mt-3" wire:ignore></div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 - Design simplifié -->
    <div class="row g-3 mb-4">
        <div class="col-lg-6 fade-in" style="animation-delay: 0.3s">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Évolution des tickets</h6>
                    <span class="badge badge-primary">+23%</span>
                </div>
                <div class="card-body">
                    <div id="chartTickets" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 fade-in" style="animation-delay: 0.35s">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Activité des sorties</h6>
                    <span class="badge badge-primary">+15%</span>
                </div>
                <div class="card-body">
                    <div id="chartCheckouts" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 - Design simplifié -->
    <div class="row g-3 mb-4">
        <div class="col-lg-6 fade-in" style="animation-delay: 0.4s">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Équipements par type</h6>
                    <span class="badge badge-primary">Total: 156</span>
                </div>
                <div class="card-body">
                    <div id="chartEquipments" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 fade-in" style="animation-delay: 0.45s">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Logiciels par catégorie</h6>
                    <span class="badge badge-primary">234 licences</span>
                </div>
                <div class="card-body">
                    <div id="chartSoftware" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table des activités - Design simplifié -->
    <div class="card fade-in" style="animation-delay: 0.5s">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-600">Activités récentes</h6>
            <div class="d-flex gap-3 align-items-center">
                <span class="badge">{{ count($this->UnifiedActivities ?? []) }} événements</span>
                <a href="{{ route('admin.activites') }}" class="btn-refresh text-decoration-none">
                    <i class="fas fa-eye me-2"></i>Voir tous
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Type</th>
                        <th>Description</th>
                        <th>Utilisateur</th>
                        <th>Statut</th>
                        <th class="text-end pe-4"></th>
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
                            <span class="badge badge-{{ $color }}">
                                <i class="{{ $activity['icon'] ?? 'fas fa-circle' }} me-2"></i> 
                                {{ $activity['type'] ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-500">{{ $activity['title'] ?? '' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle me-2" style="color: var(--gray-400);"></i>
                                <span>{{ $activity['user'] ?? '' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-{{ $color }}">
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
                            <i class="fas fa-inbox fa-2x mb-2" style="color: var(--gray-300);"></i>
                            <p class="text-muted mb-0">Aucune activité récente</p>
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

        function initCharts() {
            try {
                const dataTickets = @json($monthlyTicketsData ?? []);
                const dataCheckouts = @json($monthlyCheckoutsData ?? []);
                const dataEquip = @json($equipmentTypeData ?? []);
                const dataSoft = @json($softwareCategoryData ?? []);
                const incidentData = @json(array_values($incidentTrendData['data'] ?? [0, 0, 0]));

                // Détruire les anciens graphiques
                for (let key in charts) {
                    if (charts[key] && typeof charts[key].destroy === 'function') {
                        try { charts[key].destroy(); } catch(e) {}
                    }
                }
                charts = {};

                // Configuration commune pour les graphiques
                const baseOptions = {
                    chart: {
                        toolbar: { show: false },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: { enabled: true, delay: 150 },
                            dynamicAnimation: { enabled: true, speed: 350 }
                        }
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 2 },
                    fill: { opacity: 1, type: 'solid' },
                    colors: ['#5BC4BF'],
                    grid: {
                        borderColor: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#374151' : '#e5e7eb',
                        strokeDashArray: 4,
                        padding: { left: 10, right: 10 }
                    },
                    xaxis: {
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: { 
                            style: { 
                                colors: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280',
                                fontSize: '11px'
                            }
                        }
                    },
                    yaxis: {
                        labels: { 
                            style: { 
                                colors: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280',
                                fontSize: '11px'
                            }
                        }
                    },
                    tooltip: { 
                        theme: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'dark' : 'light',
                        style: { fontSize: '12px' }
                    }
                };

                // Sparklines
                const createSpark = (id, data) => {
                    const element = document.getElementById(id);
                    if (!element) return;
                    
                    charts[id] = new ApexCharts(element, {
                        chart: { 
                            type: 'area', 
                            height: 40, 
                            sparkline: { enabled: true },
                            animations: { enabled: true, easing: 'easeinout', speed: 800 }
                        },
                        stroke: { curve: 'smooth', width: 1.5 },
                        colors: [id === 'spark1' ? '#ef4444' : '#5BC4BF'],
                        fill: { opacity: 0.2, type: 'solid' },
                        series: [{ data: data }],
                        tooltip: { enabled: false }
                    });
                    charts[id].render();
                };

                createSpark('spark1', incidentData);
                createSpark('spark2', Object.values(dataTickets).slice(-10));
                createSpark('spark3', Object.values(dataCheckouts).slice(-10));
                createSpark('spark4', [80, 85, 90, 88, 92]);

                // Graphique Tickets
                if (document.getElementById('chartTickets')) {
                    charts.tickets = new ApexCharts(document.getElementById('chartTickets'), {
                        ...baseOptions,
                        series: [{ name: 'Tickets', data: Object.values(dataTickets) }],
                        chart: { ...baseOptions.chart, type: 'area', height: 250 },
                        xaxis: { ...baseOptions.xaxis, categories: Object.keys(dataTickets) }
                    });
                    charts.tickets.render();
                }

                // Graphique Sorties
                if (document.getElementById('chartCheckouts')) {
                    charts.checkouts = new ApexCharts(document.getElementById('chartCheckouts'), {
                        ...baseOptions,
                        series: [{ name: 'Sorties', data: Object.values(dataCheckouts) }],
                        chart: { ...baseOptions.chart, type: 'bar', height: 250 },
                        plotOptions: { bar: { borderRadius: 4, columnWidth: '60%' } },
                        xaxis: { ...baseOptions.xaxis, categories: Object.keys(dataCheckouts) }
                    });
                    charts.checkouts.render();
                }

                // Graphique Équipements
                if (document.getElementById('chartEquipments') && Object.keys(dataEquip).length > 0) {
                    charts.equipments = new ApexCharts(document.getElementById('chartEquipments'), {
                        ...baseOptions,
                        series: Object.values(dataEquip),
                        labels: Object.keys(dataEquip),
                        chart: { ...baseOptions.chart, type: 'donut', height: 250 },
                        plotOptions: { 
                            pie: { 
                                donut: { size: '70%' },
                                expandOnClick: false
                            } 
                        },
                        legend: { position: 'bottom', fontSize: '12px' },
                        stroke: { show: false }
                    });
                    charts.equipments.render();
                }

                // Graphique Logiciels
                if (document.getElementById('chartSoftware') && Object.keys(dataSoft).length > 0) {
                    charts.software = new ApexCharts(document.getElementById('chartSoftware'), {
                        ...baseOptions,
                        series: Object.values(dataSoft),
                        labels: Object.keys(dataSoft),
                        chart: { ...baseOptions.chart, type: 'pie', height: 250 },
                        legend: { position: 'bottom', fontSize: '12px' },
                        stroke: { show: false }
                    });
                    charts.software.render();
                }
            } catch(e) {
                console.error('Erreur:', e);
            }
        }

        // Theme toggle avec mise à jour des graphiques
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

                // Mettre à jour les couleurs des graphiques
                const textColor = theme === 'dark' ? '#9ca3af' : '#6b7280';
                const gridColor = theme === 'dark' ? '#374151' : '#e5e7eb';
                
                Object.values(charts).forEach(chart => {
                    if (chart && chart.updateOptions) {
                        chart.updateOptions({
                            grid: { borderColor: gridColor },
                            xaxis: { labels: { style: { colors: textColor } } },
                            yaxis: { labels: { style: { colors: textColor } } },
                            tooltip: { theme: theme === 'dark' ? 'dark' : 'light' }
                        });
                    }
                });
            });
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', saved);
            const icon = document.querySelector('#themeToggle i');
            if (icon) {
                icon.className = saved === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            }
            initCharts();
        });

        // Refresh charts
        window.addEventListener('chartsRefreshed', () => {
            initCharts();
        });
    </script>
</div>