<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard GPI Pivot</title>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        @media (max-width: 768px) {
            .chart-container {
                height: 250px;
            }
        }
        
        .activity-item {
            border-left: 3px solid #3b82f6;
            padding-left: 1rem;
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: #b45309;
        }
        
        .status-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #047857;
        }
        
        .status-info {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1d4ed8;
        }
        
        .status-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: #b91c1c;
        }
        
        .status-light {
            background-color: rgba(248, 250, 252, 0.1);
            color: #64748b;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard GPI Pivot</h1>
            <p class="text-gray-600">Vue d'ensemble de votre parc informatique</p>
        </div>
        
        <!-- Filtres -->
        <div class="mb-6 bg-white rounded-lg shadow p-4">
            <div class="flex flex-wrap items-center justify-between">
                <div>
                    <span class="text-sm font-medium text-gray-700">Période:</span>
                    <select wire:model="activityFilter" class="ml-2 border border-gray-300 rounded-md px-3 py-1 text-sm">
                        <option value="today">Aujourd'hui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="year">Cette année</option>
                    </select>
                </div>
                <button wire:click="refreshCharts" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Actualiser
                </button>
            </div>
        </div>
        
        <!-- Cartes de statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Carte Utilisateurs -->
            <div class="stat-card bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Utilisateurs</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</h3>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-green-600">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            Actifs: {{ $activeUsers }}
                        </span>
                        <span class="text-gray-500">
                            {{ $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-green-500 h-2 rounded-full" 
                             style="width: {{ $totalUsers > 0 ? ($activeUsers / $totalUsers) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
            
            <!-- Carte Tickets -->
            <div class="stat-card bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100 text-orange-500 mr-4">
                        <i class="fas fa-ticket-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tickets</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalTickets }}</h3>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-orange-600">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            Ouverts: {{ $openTickets }}
                        </span>
                        <span class="text-gray-500">
                            {{ $totalTickets > 0 ? round(($openTickets / $totalTickets) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-orange-500 h-2 rounded-full" 
                             style="width: {{ $totalTickets > 0 ? ($openTickets / $totalTickets) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
            
            <!-- Carte Équipements -->
            <div class="stat-card bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                        <i class="fas fa-laptop text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Équipements</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalEquipments }}</h3>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-green-600">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            Disponibles: {{ $availableEquipments }}
                        </span>
                        <span class="text-gray-500">
                            {{ $totalEquipments > 0 ? round(($availableEquipments / $totalEquipments) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-green-500 h-2 rounded-full" 
                             style="width: {{ $totalEquipments > 0 ? ($availableEquipments / $totalEquipments) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
            
            <!-- Carte Checkouts -->
            <div class="stat-card bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                        <i class="fas fa-exchange-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Checkouts</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalCheckouts }}</h3>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-purple-600">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            En attente: {{ $pendingCheckouts }}
                        </span>
                        <span class="text-gray-500">
                            {{ $totalCheckouts > 0 ? round(($pendingCheckouts / $totalCheckouts) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-purple-500 h-2 rounded-full" 
                             style="width: {{ $totalCheckouts > 0 ? ($pendingCheckouts / $totalCheckouts) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Graphiques et tableaux -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Graphique des tickets par statut -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Statut des Tickets</h2>
                <div class="chart-container">
                    <canvas id="ticketsChart"></canvas>
                </div>
            </div>
            
            <!-- Graphique des équipements par type -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Répartition des Équipements</h2>
                <div class="chart-container">
                    <canvas id="equipmentsChart"></canvas>
                </div>
            </div>
            
            <!-- Graphique des statuts d'équipements -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Statut des Équipements</h2>
                <div class="chart-container">
                    <canvas id="equipmentStatusChart"></canvas>
                </div>
            </div>
            
            <!-- Graphique des tickets mensuels -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tickets par Mois ({{ date('Y') }})</h2>
                <div class="chart-container">
                    <canvas id="monthlyTicketsChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Tableaux récents -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Tickets récents -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Tickets Récents</h2>
                </div>
                <div class="p-4">
                    @if($recentTickets && count($recentTickets) > 0)
                        <div class="space-y-4">
                            @foreach($recentTickets as $ticket)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <i class="fas fa-ticket-alt text-gray-400"></i>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $ticket['title'] }}</p>
                                        <div class="flex items-center mt-1">
                                            <span class="status-badge status-{{ $ticket['status_class'] }}">{{ $ticket['status'] }}</span>
                                            <span class="text-xs text-gray-500 ml-2">{{ $ticket['created_at'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Aucun ticket récent</p>
                    @endif
                </div>
            </div>
            
            <!-- Équipements récents -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Équipements Récents</h2>
                </div>
                <div class="p-4">
                    @if($recentEquipments && count($recentEquipments) > 0)
                        <div class="space-y-4">
                            @foreach($recentEquipments as $equipment)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <i class="fas fa-laptop text-gray-400"></i>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $equipment['name'] }}</p>
                                        <div class="flex items-center mt-1">
                                            <span class="status-badge status-{{ $equipment['status_class'] }}">{{ $equipment['status'] }}</span>
                                            <span class="text-xs text-gray-500 ml-2">{{ $equipment['type'] }}</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">{{ $equipment['added_date'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Aucun équipement récent</p>
                    @endif
                </div>
            </div>
            
            <!-- Activités récentes -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Activités Récentes</h2>
                </div>
                <div class="p-4">
                    @if($recentActivities && count($recentActivities) > 0)
                        <div class="space-y-4">
                            @foreach($recentActivities as $activity)
                                <div class="activity-item">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <i class="fas fa-{{ $activity['icon'] }} text-blue-500"></i>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <p class="text-sm font-medium text-gray-900">{{ $activity['description'] }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Aucune activité récente</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Graphique des tickets par statut
            const ticketsCtx = document.getElementById('ticketsChart').getContext('2d');
            const ticketsChart = new Chart(ticketsCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_keys($ticketStatusData)) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($ticketStatusData)) !!},
                        backgroundColor: [
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)'
                        ],
                        borderColor: [
                            'rgb(245, 158, 11)',
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
            
            // Graphique des équipements par type
            const equipmentsCtx = document.getElementById('equipmentsChart').getContext('2d');
            const equipmentsChart = new Chart(equipmentsCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($equipmentChartData)) !!},
                    datasets: [{
                        label: 'Nombre d\'équipements',
                        data: {!! json_encode(array_values($equipmentChartData)) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            // Graphique des statuts d'équipements
            const equipmentStatusCtx = document.getElementById('equipmentStatusChart').getContext('2d');
            const equipmentStatusChart = new Chart(equipmentStatusCtx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode(array_keys($equipmentStatusData)) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($equipmentStatusData)) !!},
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(239, 68, 68, 0.8)'
                        ],
                        borderColor: [
                            'rgb(16, 185, 129)',
                            'rgb(59, 130, 246)',
                            'rgb(245, 158, 11)',
                            'rgb(239, 68, 68)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
            
            // Graphique des tickets mensuels
            const monthlyTicketsCtx = document.getElementById('monthlyTicketsChart').getContext('2d');
            const monthlyTicketsChart = new Chart(monthlyTicketsCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                    datasets: [{
                        label: 'Tickets créés',
                        data: {!! json_encode($monthlyTicketsData) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            // Rafraîchir les graphiques lorsque l'événement est déclenché
            window.addEventListener('chartsRefreshed', function() {
                ticketsChart.update();
                equipmentsChart.update();
                equipmentStatusChart.update();
                monthlyTicketsChart.update();
            });
        });
    </script>
</body>
</html>