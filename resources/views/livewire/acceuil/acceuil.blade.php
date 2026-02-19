<script>
    // Prevent theme flicker
    (function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
    })();
</script>
<div class="container-fluid py-4" style="min-height: 100vh;">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        :root {
            /* Maxton Palette - Indigo/Violet SaaS */
            --maxton-primary: #6366f1;
            --maxton-primary-dark: #4f46e5;
            --maxton-secondary: #a855f7;
            --maxton-accent: #38bdf8;
            --maxton-success: #10b981;
            --maxton-warning: #f59e0b;
            --maxton-danger: #ef4444;
            
            --bs-body-bg: #f8fafc;
            --card-bg: #ffffff;
            --card-border: rgba(0,0,0,0.05);
            --text-main: #1e293b;
            --text-muted: #64748b;
        }
        
        [data-bs-theme="dark"] {
            --bs-body-bg: #0f172a;
            --card-bg: #1e293b;
            --card-border: rgba(255,255,255,0.05);
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            
            --maxton-primary: #818cf8;
            --maxton-secondary: #c084fc;
        }
        
        body {
            background-color: var(--bs-body-bg);
            color: var(--text-main);
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        /* Modern Glassmorphism Cards */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--card-border);
            padding: 1.5rem;
        }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            color: var(--text-main);
            font-weight: 700;
        }
        
        /* Stats Icons */
        .stat-icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }
        
        .card:hover .stat-icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }
        
        .bg-indigo { background: rgba(99, 102, 241, 0.15); color: #6366f1; }
        .bg-violet { background: rgba(168, 85, 247, 0.15); color: #a855f7; }
        .bg-emerald { background: rgba(16, 185, 129, 0.15); color: #10b981; }
        .bg-amber { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-entry {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .row > div:nth-child(1) .animate-entry { animation-delay: 0.1s; }
        .row > div:nth-child(2) .animate-entry { animation-delay: 0.2s; }
        .row > div:nth-child(3) .animate-entry { animation-delay: 0.3s; }
        .row > div:nth-child(4) .animate-entry { animation-delay: 0.4s; }

        /* Fancy Tables */
        .table {
            color: var(--text-main);
        }
        
        .table thead th {
            background: rgba(0,0,0,0.02);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.05rem;
            border-bottom: 1px solid var(--card-border);
            padding: 1rem 1.5rem;
        }
        
        [data-bs-theme="dark"] .table thead th {
            background: rgba(255,255,255,0.02);
        }
        
        .table td { border-bottom: 1px solid var(--card-border); padding: 1rem 1.5rem; vertical-align: middle; }

        /* Theme Toggle Button */
        .theme-toggle {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .theme-toggle:hover {
            border-color: var(--maxton-primary);
            color: var(--maxton-primary);
            transform: scale(1.05);
        }

        /* Support Button (Inspired by image) */
        .btn-maxton-support {
            background: linear-gradient(135deg, var(--maxton-primary) 0%, var(--maxton-secondary) 100%);
            border: none;
            color: white;
            padding: 0.6rem 1.4rem;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-maxton-support:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
            color: white;
        }
        
        /* Custom Scrollbar for Dark Mode */
        [data-bs-theme="dark"] ::-webkit-scrollbar { width: 8px; }
        [data-bs-theme="dark"] ::-webkit-scrollbar-track { background: #1e293b; }
        [data-bs-theme="dark"] ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>



    <!-- Header Dashboard -->
    <div class="d-flex justify-content-between align-items-center mb-5 animate-entry">
        <div>
            <h2 class="mb-1 text-main">Tableau de Bord</h2>
            <p class="text-muted mb-0">Vue d'ensemble intelligente de votre infrastructure</p>
        </div>
        <div class="d-flex gap-3">
            <div id="themeToggle" class="theme-toggle">
                <i class="fas fa-moon"></i>
            </div>
            <button class="btn btn-white bg-card border-0 shadow-sm fw-600 px-4 rounded-3" wire:click="refreshCharts" style="height: 42px;">
                <i class="fas fa-sync-alt me-2 text-primary"></i>Actualiser
            </button>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row g-4 mb-5">
        <!-- Total Incidents -->
        <div class="col-12 col-md-6 col-xl-3 animate-entry">
            <div class="card h-100 p-4 border-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted fw-600 text-uppercase small mb-1 ls-1">Incidents</p>
                        <h2 class="mb-0">{{ $totalIncidents ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-soft-danger rounded-circle">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <span class="text-danger fw-700 me-2"><i class="fas fa-arrow-up me-1"></i>12%</span>
                    <span class="text-muted small">ce mois</span>
                </div>
                <div id="spark1" class="mt-3" style="min-height: 50px;"></div>
            </div>
        </div>

        <!-- Total Tickets -->
        <div class="col-12 col-md-6 col-xl-3 animate-entry">
            <div class="card h-100 p-4 border-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted fw-600 text-uppercase small mb-1 ls-1">Tickets</p>
                        <h2 class="mb-0">{{ $stats['total_tickets'] ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-soft-primary rounded-circle">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <span class="text-indigo fw-700 me-2"><i class="fas fa-arrow-down me-1"></i>5%</span>
                    <span class="text-muted small">vs dernier mois</span>
                </div>
                <div id="spark2" class="mt-3" style="min-height: 50px;"></div>
            </div>
        </div>

        <!-- Sorties Actives -->
        <div class="col-12 col-md-6 col-xl-3 animate-entry">
            <div class="card h-100 p-4 border-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted fw-600 text-uppercase small mb-1 ls-1">Sorties</p>
                        <h2 class="mb-0">{{ $stats['total_checkouts'] ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-soft-success rounded-circle">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <span class="text-emerald fw-700 me-2"><i class="fas fa-arrow-up me-1"></i>8%</span>
                    <span class="text-muted small">en hausse</span>
                </div>
                <div id="spark3" class="mt-3" style="min-height: 50px;"></div>
            </div>
        </div>

        <!-- Taux Résolution -->
        <div class="col-12 col-md-6 col-xl-3 animate-entry">
            <div class="card h-100 p-4 border-0">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted fw-600 text-uppercase small mb-1 ls-1">Résolution</p>
                        @php
                            $rate = 0;
                            if(isset($incidentsChartData) && array_sum($incidentsChartData) > 0) {
                                $resolved = $incidentsChartData['Résolus'] ?? 0;
                                $total = array_sum($incidentsChartData);
                                $rate = round(($resolved / $total) * 100);
                            }
                        @endphp
                        <h2 class="mb-0">{{ $rate }}%</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-soft-warning rounded-circle">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <span class="text-amber fw-700 me-2"><i class="fas fa-check me-1"></i>+3%</span>
                    <span class="text-muted small">efficacité</span>
                </div>
                <div id="spark4" class="mt-3" style="min-height: 50px;"></div>
            </div>
        </div>
    </div>

    <!-- Graphiques principaux -->
    <div class="row g-4 mb-5">
        <!-- Tickets Mensuels -->
        <div class="col-lg-6 animate-entry">
            <div class="card h-100 border-0">
                <div class="card-header border-0 d-flex justify-content-between align-items-center pb-0">
                    <div>
                        <h5 class="mb-1">Statistiques Tickets</h5>
                        <p class="text-muted small mb-0">Évolution mensuelle {{ date('Y') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartTickets"></div>
                </div>
            </div>
        </div>

        <!-- Activité des Sorties -->
        <div class="col-lg-6 animate-entry">
            <div class="card h-100 border-0">
                <div class="card-header border-0 d-flex justify-content-between align-items-center pb-0">
                    <div>
                        <h5 class="mb-1">Activité des Sorties</h5>
                        <p class="text-muted small mb-0">Prêts et retours récents</p>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartCheckouts"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques secondaires -->
    <div class="row g-4 mb-5">
        <!-- Équipements -->
        <div class="col-lg-6 animate-entry">
            <div class="card h-100 border-0">
                <div class="card-header border-0 pb-0">
                    <h5 class="mb-1">Équipements</h5>
                    <p class="text-muted small mb-0">Par type d'inventaire</p>
                </div>
                <div class="card-body">
                    <div id="chartEquipments"></div>
                </div>
            </div>
        </div>

        <!-- Logiciels -->
        <div class="col-lg-6 animate-entry">
            <div class="card h-100 border-0">
                <div class="card-header border-0 pb-0">
                    <h5 class="mb-1">Logiciels & Licences</h5>
                    <p class="text-muted small mb-0">Répartition par catégorie</p>
                </div>
                <div class="card-body">
                    <div id="chartSoftware"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des activités unifiées -->
    <div class="card border-0 animate-entry">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Flux d'Activités Unifié</h5>
            <div class="d-flex align-items-center gap-3">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="filterActive" wire:model.live="onlyActive">
                    <label class="form-check-label small fw-600" for="filterActive">Flux Actif Uniquement</label>
                </div>
                <span class="badge bg-soft-primary px-3 py-2 rounded-2">Total: {{ count($this->UnifiedActivities) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Type</th>
                            <th>Description</th>
                            <th>Utilisateur</th>
                            <th>Assigné à</th>
                            <th>Date & Heure</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->UnifiedActivities as $activity)
                        <tr class="activity-row" style="border-left: 4px solid var(--maxton-{{ $activity['color'] == 'orange' ? 'warning' : ($activity['color'] == 'info' ? 'primary' : $activity['color']) }});">
                            <td class="ps-3">
                                <div class="d-flex align-items-center">
                                    <div class="stat-icon-wrapper bg-soft-{{ $activity['color'] == 'orange' ? 'warning' : ($activity['color'] == 'info' ? 'primary' : $activity['color']) }} rounded-circle me-2" style="width: 32px; height: 32px; font-size: 0.9rem; margin-bottom: 0;">
                                        <i class="{{ $activity['icon'] }}"></i>
                                    </div>
                                    <span class="fw-700 small">{{ $activity['type'] }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="fw-600 text-main">{{ $activity['title'] }}</div>
                                <div class="text-muted small">ID: #{{ str_pad($activity['id'] ?? '---', 4, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2 bg-indigo text-white" style="width: 30px; height: 30px; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                        {{ substr($activity['user'], 0, 1) }}
                                    </div>
                                    <span class="fw-500 small">{{ $activity['user'] }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2 bg-violet text-white" style="width: 30px; height: 30px; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                        {{ substr($activity['assigned_to'] ?? '---', 0, 1) }}
                                    </div>
                                    <span class="fw-500 small">{{ $activity['assigned_to'] ?? '---' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="fw-500 small">{{ $activity['date']->format('d/m/Y') }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $activity['date']->format('H:i') }} ({{ $activity['date']->diffForHumans() }})</div>
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($activity['color']) {
                                        'danger' => 'bg-soft-danger text-danger',
                                        'orange' => 'bg-soft-warning text-warning',
                                        'warning' => 'bg-soft-warning text-warning',
                                        'success' => 'bg-soft-success text-success',
                                        'info' => 'bg-soft-primary text-primary',
                                        default => 'bg-soft-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} font-size-12 px-3 py-2 rounded-pill">
                                    {{ $activity['status'] }}
                                </span>
                            </td>
                            <td>
                                @if($activity['priority'] == 'Urgent' || $activity['priority'] == 'Critique')
                                    <span class="text-danger fw-700 small"><i class="fas fa-circle font-size-10 me-1"></i>{{ $activity['priority'] }}</span>
                                @else
                                    <span class="text-muted fw-500 small">{{ $activity['priority'] }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-5 text-muted">Aucune activité récente trouvée</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initDashboard();
        });

        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', (message, component) => {
                initDashboard();
            });
        });

        window.addEventListener('chartsRefreshed', () => {
            initDashboard();
        });

        function initDashboard() {
            // Colors Maxton
            const colors = {
                primary: '#6366f1',
                secondary: '#a855f7',
                success: '#10b981',
                warning: '#f59e0b',
                danger: '#ef4444',
                info: '#06b6d4'
            };

            const html = document.documentElement;
            const isDark = html.getAttribute('data-bs-theme') === 'dark';
            const textColor = isDark ? '#94a3b8' : '#64748b';
            const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

            // Données
            const ticketsHistory = {!! json_encode($monthlyTicketsData ?? []) !!};
            const checkoutsHistory = {!! json_encode($monthlyCheckoutsData ?? []) !!};
            
            // Configuration des sparklines
            const sparkOptions = {
                chart: { 
                    type: 'area', 
                    height: 50, 
                    sparkline: { enabled: true },
                    animations: { enabled: true }
                },
                stroke: { curve: 'smooth', width: 2.5 },
                fill: { 
                    type: 'gradient',
                    gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0 }
                },
                tooltip: { enabled: false }
            };

            // Spark 1 - Incidents
            if(document.querySelector("#spark1")) {
                new ApexCharts(document.querySelector("#spark1"), {
                    ...sparkOptions,
                    colors: [colors.danger],
                    series: [{ data: {!! json_encode(array_values($incidentTrendData['data'] ?? [5, 8, 6, 10, 7, 9])) !!} }]
                }).render();
            }

            // Spark 2 - Tickets
            if(document.querySelector("#spark2")) {
                new ApexCharts(document.querySelector("#spark2"), {
                    ...sparkOptions,
                    colors: [colors.primary],
                    series: [{ data: Object.values(ticketsHistory).slice(-10) }]
                }).render();
            }

            // Spark 3 - Checkouts
            if(document.querySelector("#spark3")) {
                new ApexCharts(document.querySelector("#spark3"), {
                    ...sparkOptions,
                    colors: [colors.success],
                    series: [{ data: Object.values(checkoutsHistory).slice(-10) }]
                }).render();
            }

            // Spark 4 - Taux
            if(document.querySelector("#spark4")) {
                new ApexCharts(document.querySelector("#spark4"), {
                    ...sparkOptions,
                    colors: [colors.warning],
                    series: [{ data: [90, 92, 95, 94, 96, 95, 97, 96, 98, 97, 98, 99] }]
                }).render();
            }

            // Chart Tickets (Area)
            if(document.querySelector("#chartTickets")) {
                new ApexCharts(document.querySelector("#chartTickets"), {
                    series: [{ name: 'Tickets', data: Object.values(ticketsHistory) }],
                    chart: { 
                        id: 'mainTickets',
                        type: 'area', 
                        height: 320, 
                        toolbar: { show: false },
                        background: 'transparent',
                        foreColor: textColor
                    },
                    colors: [colors.primary],
                    stroke: { curve: 'smooth', width: 3 },
                    fill: { 
                        type: 'gradient', 
                        gradient: { shadeIntensity: 1, opacityFrom: 0.5, opacityTo: 0.1 } 
                    },
                    grid: { borderColor: gridColor, strokeDashArray: 4 },
                    xaxis: { categories: Object.keys(ticketsHistory) }
                }).render();
            }

            // Chart Checkouts (Bar)
            if(document.querySelector("#chartCheckouts")) {
                new ApexCharts(document.querySelector("#chartCheckouts"), {
                    series: [{ name: 'Sorties', data: Object.values(checkoutsHistory) }],
                    chart: { 
                        id: 'mainCheckouts',
                        type: 'bar', 
                        height: 320, 
                        toolbar: { show: false },
                        background: 'transparent',
                        foreColor: textColor
                    },
                    colors: [colors.success],
                    plotOptions: { bar: { borderRadius: 8, columnWidth: '45%' } },
                    grid: { borderColor: gridColor, strokeDashArray: 4 },
                    xaxis: { categories: Object.keys(checkoutsHistory) }
                }).render();
            }

            // Donut Équipements
            if(document.querySelector("#chartEquipments")) {
                const equipmentData = {!! json_encode($equipmentTypeData ?? []) !!};
                new ApexCharts(document.querySelector("#chartEquipments"), {
                    series: Object.values(equipmentData),
                    labels: Object.keys(equipmentData),
                    chart: { type: 'donut', height: 300, foreColor: textColor },
                    colors: [colors.primary, colors.secondary, colors.info, colors.success],
                    stroke: { width: 0 },
                    legend: { position: 'bottom' },
                    plotOptions: { pie: { donut: { size: '75%' } } }
                }).render();
            }

            // Pie Logiciels
            if(document.querySelector("#chartSoftware")) {
                const softwareData = {!! json_encode($softwareCategoryData ?? []) !!};
                new ApexCharts(document.querySelector("#chartSoftware"), {
                    series: Object.values(softwareData),
                    labels: Object.keys(softwareData),
                    chart: { type: 'pie', height: 300, foreColor: textColor },
                    colors: [colors.primary, colors.success, colors.warning, colors.danger, colors.secondary],
                    stroke: { width: 0 },
                    legend: { position: 'bottom' }
                }).render();
            }

            // --- Theme Support JS ---
            const themeBtn = document.getElementById('themeToggle');
            const icon = themeBtn.querySelector('i');

            // Set initial icon
            updateThemeIcon(isDark);

            themeBtn.addEventListener('click', () => {
                const current = html.getAttribute('data-bs-theme');
                const dark = current !== 'dark';
                
                html.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
                localStorage.setItem('theme', dark ? 'dark' : 'light');
                
                updateThemeIcon(dark);
                
                // Reload page or refresh charts logic
                // For simplicity, we refresh the window to apply all Maxton CSS variables properly
                window.location.reload();
            });

            function updateThemeIcon(dark) {
                 if(dark) {
                    icon.classList.replace('fa-moon', 'fa-sun');
                    themeBtn.style.color = '#fbbf24';
                 } else {
                    icon.classList.replace('fa-sun', 'fa-moon');
                    themeBtn.style.color = 'inherit';
                 }
            }
        }
    </script>
</div>