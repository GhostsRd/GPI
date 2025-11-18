<div>
    <style>
        /* Design System Moderne */
        :root {
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary: #8b5cf6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1f2937;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .dashboard {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            font-family: 'Inter', system-ui, sans-serif;
        }

        /* Cartes avec effet néomorphisme amélioré */
        .neo-card {
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            border-radius: 24px;
            box-shadow: 
                20px 20px 60px #d9d9d9,
                -20px -20px 60px #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .neo-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 
                25px 25px 80px #c9c9c9,
                -25px -25px 80px #ffffff;
        }

        /* Cartes statistiques avec dégradés */
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.08),
                0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            background: var(--gradient);
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            transition: all 0.4s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(8deg);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        /* Barres de progression animées */
        .progress-track {
            background: rgba(226, 232, 240, 0.6);
            border-radius: 12px;
            overflow: hidden;
            height: 10px;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            border-radius: 12px;
            background: var(--gradient);
            position: relative;
            transition: width 1.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Graphiques containers */
        .chart-wrapper {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative;
            overflow: hidden;
        }

        .chart-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient);
        }

        /* Badges modernes */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .badge-success { background: rgba(16, 185, 129, 0.15); color: #065f46; border-color: rgba(16, 185, 129, 0.3); }
        .badge-warning { background: rgba(245, 158, 11, 0.15); color: #92400e; border-color: rgba(245, 158, 11, 0.3); }
        .badge-danger { background: rgba(239, 68, 68, 0.15); color: #991b1b; border-color: rgba(239, 68, 68, 0.3); }
        .badge-info { background: rgba(59, 130, 246, 0.15); color: #1e40af; border-color: rgba(59, 130, 246, 0.3); }

        /* Cartes d'activité */
        .activity-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 20px;
            margin: 12px 0;
            border-left: 4px solid;
            border-image: var(--gradient) 1;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            transform: translateX(8px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        /* Boutons modernes */
        .btn-primary {
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Inputs et selects */
        .input-modern {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(226, 232, 240, 0.8);
            border-radius: 12px;
            padding: 12px 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .input-modern:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        .stagger > * {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .stagger > *:nth-child(1) { animation-delay: 0.1s; }
        .stagger > *:nth-child(2) { animation-delay: 0.2s; }
        .stagger > *:nth-child(3) { animation-delay: 0.3s; }
        .stagger > *:nth-child(4) { animation-delay: 0.4s; }

        /* Typographie */
        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--gradient);
            border-radius: 2px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stat-card {
                margin-bottom: 1rem;
            }
            
            .stat-card:hover {
                transform: none;
            }
            
            .activity-card:hover {
                transform: none;
            }
            
            .chart-wrapper {
                padding: 16px;
            }
            
            .section-title::after {
                width: 40px;
            }
        }

        @media (max-width: 640px) {
            .dashboard {
                padding: 1rem;
            }
            
            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }
            
            .btn-primary {
                padding: 12px 20px;
                font-size: 0.9rem;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .dashboard {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            }
            
            .neo-card,
            .stat-card,
            .chart-wrapper {
                background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
                border-color: rgba(255, 255, 255, 0.1);
                color: #f8fafc;
            }
            
            .input-modern {
                background: rgba(30, 41, 59, 0.9);
                border-color: rgba(255, 255, 255, 0.1);
                color: #f8fafc;
            }
        }

        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>

    <div class="dashboard">
        <div class="container mx-auto px-4 py-6">
            <!-- Header -->
            <div class="text-center mb-12 fade-in-up">
                <h1 class="text-4xl md:text-5xl font-bold text-gradient mb-4">
                    🚀 Tableau de Bord GPI
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Supervision complète de votre infrastructure informatique en temps réel
                </p>
            </div>

            <!-- Controls Bar -->
            <div class="neo-card p-6 mb-8 fade-in-up">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                    <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
                        <div class="w-full sm:w-auto">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                📅 Période
                            </label>
                            <select wire:model="activityFilter" class="input-modern w-full">
                                <option value="today">Aujourd'hui</option>
                                <option value="week">Cette semaine</option>
                                <option value="month">Ce mois</option>
                                <option value="year">Cette année</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-auto">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                👁️ Affichage
                            </label>
                            <select class="input-modern w-full">
                                <option>Vue d'ensemble</option>
                                <option>Détail technique</option>
                                <option>Rapports avancés</option>
                            </select>
                        </div>
                    </div>
                    <button wire:click="refreshCharts" class="btn-primary flex items-center gap-3 w-full lg:w-auto justify-center">
                        <i class="fas fa-sync-alt"></i>
                        <span>Actualiser les données</span>
                    </button>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="mb-12">
                <h2 class="section-title text-2xl md:text-3xl text-gray-800 dark:text-white">
                    📊 Métriques Clés
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger">
                    <!-- Users Card -->
                    <div class="stat-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">
                                    👥 Utilisateurs
                                </p>
                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                    {{ $totalUsers }}
                                </h3>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-green-600 dark:text-green-400 font-semibold">
                                    ✅ Actifs: {{ $activeUsers }}
                                </span>
                                <span class="text-gray-500 font-medium">
                                    {{ $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0 }}%
                                </span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" 
                                     style="width: {{ $totalUsers > 0 ? ($activeUsers / $totalUsers) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Tickets Card -->
                    <div class="stat-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">
                                    🎫 Tickets
                                </p>
                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                    {{ $totalTickets }}
                                </h3>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-orange-600 dark:text-orange-400 font-semibold">
                                    🔥 Ouverts: {{ $openTickets }}
                                </span>
                                <span class="text-gray-500 font-medium">
                                    {{ $totalTickets > 0 ? round(($openTickets / $totalTickets) * 100, 1) : 0 }}%
                                </span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" 
                                     style="width: {{ $totalTickets > 0 ? ($openTickets / $totalTickets) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Equipment Card -->
                    <div class="stat-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">
                                    💻 Équipements
                                </p>
                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                    {{ $totalEquipments }}
                                </h3>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-laptop"></i>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-green-600 dark:text-green-400 font-semibold">
                                    ✅ Disponibles: {{ $availableEquipments }}
                                </span>
                                <span class="text-gray-500 font-medium">
                                    {{ $totalEquipments > 0 ? round(($availableEquipments / $totalEquipments) * 100, 1) : 0 }}%
                                </span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" 
                                     style="width: {{ $totalEquipments > 0 ? ($availableEquipments / $totalEquipments) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Checkouts Card -->
                    <div class="stat-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">
                                    🔄 Checkouts
                                </p>
                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                    {{ $totalCheckouts }}
                                </h3>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-purple-600 dark:text-purple-400 font-semibold">
                                    ⏳ En attente: {{ $pendingCheckouts }}
                                </span>
                                <span class="text-gray-500 font-medium">
                                    {{ $totalCheckouts > 0 ? round(($pendingCheckouts / $totalCheckouts) * 100, 1) : 0 }}%
                                </span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" 
                                     style="width: {{ $totalCheckouts > 0 ? ($pendingCheckouts / $totalCheckouts) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="mb-12">
                <h2 class="section-title text-2xl md:text-3xl text-gray-800 dark:text-white mb-8">
                    📈 Analytics
                </h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Tickets Chart -->
                    <div class="chart-wrapper">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6 flex items-center gap-3">
                            <i class="fas fa-chart-pie text-blue-500"></i>
                            Répartition des Tickets
                        </h3>
                        <div style="height: 280px;">
                            <canvas id="ticketsChart"></canvas>
                        </div>
                    </div>

                    <!-- Equipment Chart -->
                    <div class="chart-wrapper">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6 flex items-center gap-3">
                            <i class="fas fa-chart-bar text-green-500"></i>
                            Inventaire des Équipements
                        </h3>
                        <div style="height: 280px;">
                            <canvas id="equipmentsChart"></canvas>
                        </div>
                    </div>

                    <!-- Status Chart -->
                    <div class="chart-wrapper">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6 flex items-center gap-3">
                            <i class="fas fa-chart-pie text-purple-500"></i>
                            Statut des Équipements
                        </h3>
                        <div style="height: 280px;">
                            <canvas id="equipmentStatusChart"></canvas>
                        </div>
                    </div>

                    <!-- Incidents Chart -->
                    <div class="chart-wrapper">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6 flex items-center gap-3">
                            <i class="fas fa-exclamation-triangle text-red-500"></i>
                            Incidents par Type
                        </h3>
                        <div style="height: 280px;">
                            <canvas id="incidentsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mb-12">
                <h2 class="section-title text-2xl md:text-3xl text-gray-800 dark:text-white mb-8">
                    ⚡ Activité Récente
                </h2>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Recent Tickets -->
                    <div class="neo-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-3">
                                <i class="fas fa-ticket-alt text-blue-500"></i>
                                Tickets Récents
                            </h3>
                            <span class="badge badge-info">{{ count($recentTickets) }}</span>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentTickets as $ticket)
                                <div class="activity-card">
                                    <p class="font-semibold text-gray-800 dark:text-white mb-2">
                                        {{ $ticket['title'] }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="badge badge-{{ $ticket['status_class'] }}">
                                            {{ $ticket['status'] }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $ticket['created_at'] }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-400">
                                    <i class="fas fa-inbox text-4xl mb-3"></i>
                                    <p>Aucun ticket récent</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Equipment -->
                    <div class="neo-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-3">
                                <i class="fas fa-laptop text-green-500"></i>
                                Équipements Récents
                            </h3>
                            <span class="badge badge-success">{{ count($recentEquipments) }}</span>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentEquipments as $equipment)
                                <div class="activity-card">
                                    <p class="font-semibold text-gray-800 dark:text-white mb-2">
                                        {{ $equipment['name'] }}
                                    </p>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="badge badge-{{ $equipment['status_class'] }}">
                                            {{ $equipment['status'] }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $equipment['type'] }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500">{{ $equipment['added_date'] }}</p>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-400">
                                    <i class="fas fa-laptop text-4xl mb-3"></i>
                                    <p>Aucun équipement récent</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- System Activity -->
                    <div class="neo-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-3">
                                <i class="fas fa-history text-purple-500"></i>
                                Journal Système
                            </h3>
                            <span class="badge badge-warning">{{ count($recentActivities) }}</span>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentActivities as $activity)
                                <div class="activity-card">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 mt-1">
                                            <i class="fas fa-{{ $activity['icon'] }} text-blue-500 text-lg"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-800 dark:text-white">
                                                {{ $activity['description'] }}
                                            </p>
                                            <p class="text-sm text-gray-500 mt-1">{{ $activity['time'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-400">
                                    <i class="fas fa-clock text-4xl mb-3"></i>
                                    <p>Aucune activité récente</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all charts
            initializeCharts();
            
            // Refresh charts when Livewire updates
            window.addEventListener('chartsRefreshed', function() {
                initializeCharts();
            });

            function initializeCharts() {
                // Tickets Chart
                const ticketsCtx = document.getElementById('ticketsChart')?.getContext('2d');
                if (ticketsCtx) {
                    new Chart(ticketsCtx, {
                        type: 'doughnut',
                        data: {
                            labels: {!! json_encode(array_keys($ticketStatusData)) !!},
                            datasets: [{
                                data: {!! json_encode(array_values($ticketStatusData)) !!},
                                backgroundColor: ['#f59e0b', '#3b82f6', '#10b981'],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom' }
                            }
                        }
                    });
                }

                // Equipment Chart
                const equipmentsCtx = document.getElementById('equipmentsChart')?.getContext('2d');
                if (equipmentsCtx) {
                    new Chart(equipmentsCtx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode(array_keys($equipmentChartData)) !!},
                            datasets: [{
                                label: 'Équipements',
                                data: {!! json_encode(array_values($equipmentChartData)) !!},
                                backgroundColor: '#3b82f6',
                                borderRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                }

                // Equipment Status Chart
                const statusCtx = document.getElementById('equipmentStatusChart')?.getContext('2d');
                if (statusCtx) {
                    new Chart(statusCtx, {
                        type: 'pie',
                        data: {
                            labels: {!! json_encode(array_keys($equipmentStatusData)) !!},
                            datasets: [{
                                data: {!! json_encode(array_values($equipmentStatusData)) !!},
                                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444']
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom' }
                            }
                        }
                    });
                }

                // Incidents Chart
                const incidentsCtx = document.getElementById('incidentsChart')?.getContext('2d');
                if (incidentsCtx) {
                    new Chart(incidentsCtx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode(array_keys($incidentsChartData)) !!},
                            datasets: [{
                                label: 'Incidents',
                                data: {!! json_encode(array_values($incidentsChartData)) !!},
                                backgroundColor: ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444'],
                                borderRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                }
            }
        });
    </script>
</div>