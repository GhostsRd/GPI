<div class="dashboard-container">
    <!-- En-tête -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">
                <i class="fas fa-chart-line me-2"></i>
                Tableau de Bord GPI
            </h1>
            <p class="dashboard-subtitle">Vue d'ensemble de votre activité</p>
        </div>
        <div class="header-actions">
            <select class="period-select" wire:model="activityFilter">
                <option value="today">Aujourd'hui</option>
                <option value="week">Cette semaine</option>
                <option value="month">Ce mois</option>
                <option value="year">Cette année</option>
            </select>
            <button class="refresh-btn" wire:click="refreshCharts">
                <i class="fas fa-sync-alt"></i>
                Actualiser
            </button>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="stats-grid">
        <!-- Carte Utilisateurs -->
        <div class="stat-card">
            <div class="card-icon users">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-content">
                <h3>{{ $totalUsers }}</h3>
                <p>Utilisateurs</p>
                <div class="progress-info">
                    <span class="progress-text">{{ $activeUsers }} actifs</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $totalUsers > 0 ? ($activeUsers / $totalUsers) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Tickets -->
        <div class="stat-card">
            <div class="card-icon tickets">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="card-content">
                <h3>{{ $totalTickets }}</h3>
                <p>Tickets</p>
                <div class="progress-info">
                    <span class="progress-text">{{ $openTickets }} ouverts</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $totalTickets > 0 ? ($openTickets / $totalTickets) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Équipements -->
        <div class="stat-card">
            <div class="card-icon equipments">
                <i class="fas fa-laptop"></i>
            </div>
            <div class="card-content">
                <h3>{{ $totalEquipments }}</h3>
                <p>Équipements</p>
                <div class="progress-info">
                    <span class="progress-text">{{ $availableEquipments }} disponibles</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $totalEquipments > 0 ? ($availableEquipments / $totalEquipments) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Checkouts -->
        <div class="stat-card">
            <div class="card-icon checkouts">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="card-content">
                <h3>{{ $totalCheckouts }}</h3>
                <p>Checkouts</p>
                <div class="progress-info">
                    <span class="progress-text">{{ $pendingCheckouts }} en attente</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $totalCheckouts > 0 ? ($pendingCheckouts / $totalCheckouts) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="charts-grid">
        <!-- Graphique Statut des Tickets -->
        <div class="chart-card">
            <div class="chart-header">
                <h3>Statut des Tickets</h3>
                <small>Total: {{ array_sum(array_values($ticketStatusData)) }} tickets</small>
            </div>
            <div class="chart-container">
                @php
                    $hasTicketData = !empty($ticketStatusData) && array_sum(array_values($ticketStatusData)) > 0;
                @endphp
                @if($hasTicketData)
                    <canvas id="ticketsChart-{{ $this->id }}"></canvas>
                @else
                    <div class="empty-chart">
                        <i class="fas fa-chart-pie"></i>
                        <p>Aucune donnée de tickets disponible</p>
                        <small>Vérifiez que vous avez des tickets dans la base de données</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- Graphique Répartition des Équipements -->
        <div class="chart-card">
            <div class="chart-header">
                <h3>Répartition des Équipements</h3>
                <small>Total: {{ array_sum(array_values($equipmentChartData)) }} équipements</small>
            </div>
            <div class="chart-container">
                @php
                    $hasEquipmentData = !empty($equipmentChartData) && array_sum(array_values($equipmentChartData)) > 0;
                @endphp
                @if($hasEquipmentData)
                    <canvas id="equipmentsChart-{{ $this->id }}"></canvas>
                @else
                    <div class="empty-chart">
                        <i class="fas fa-chart-bar"></i>
                        <p>Aucune donnée d'équipement disponible</p>
                        <small>Vérifiez que vous avez des équipements dans la base de données</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- Graphique Statut des Équipements -->
        <div class="chart-card">
            <div class="chart-header">
                <h3>Statut des Équipements</h3>
                <small>Total: {{ array_sum(array_values($equipmentStatusData)) }} équipements</small>
            </div>
            <div class="chart-container">
                @php
                    $hasStatusData = !empty($equipmentStatusData) && array_sum(array_values($equipmentStatusData)) > 0;
                @endphp
                @if($hasStatusData)
                    <canvas id="equipmentStatusChart-{{ $this->id }}"></canvas>
                @else
                    <div class="empty-chart">
                        <i class="fas fa-chart-pie"></i>
                        <p>Aucun statut d'équipement disponible</p>
                        <small>Les équipements doivent avoir un statut défini</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- Graphique Tickets Mensuels -->
        <div class="chart-card">
            <div class="chart-header">
                <h3>Tickets Mensuels</h3>
                <small>Année: {{ date('Y') }}</small>
            </div>
            <div class="chart-container">
                @php
                    $hasMonthlyData = !empty($monthlyTicketsData) && array_sum($monthlyTicketsData) > 0;
                @endphp
                @if($hasMonthlyData)
                    <canvas id="monthlyTicketsChart-{{ $this->id }}"></canvas>
                @else
                    <div class="empty-chart">
                        <i class="fas fa-chart-line"></i>
                        <p>Aucune donnée mensuelle disponible</p>
                        <small>Les tickets de cette année apparaîtront ici</small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Activités récentes -->
    <div class="activities-grid">
        <div class="activity-card">
            <div class="activity-header">
                <h3><i class="fas fa-ticket-alt me-2"></i>Tickets Récents</h3>
            </div>
            <div class="activity-list">
                @if($recentTickets && count($recentTickets) > 0)
                    @foreach($recentTickets as $ticket)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-title">{{ $ticket['title'] }}</p>
                                <div class="activity-meta">
                                    <span class="status-badge {{ $ticket['status_class'] }}">{{ $ticket['status'] }}</span>
                                    <span class="activity-time">{{ $ticket['created_at'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Aucun ticket récent</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="activity-card">
            <div class="activity-header">
                <h3><i class="fas fa-laptop me-2"></i>Équipements Récents</h3>
            </div>
            <div class="activity-list">
                @if($recentEquipments && count($recentEquipments) > 0)
                    @foreach($recentEquipments as $equipment)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-title">{{ $equipment['name'] }}</p>
                                <div class="activity-meta">
                                    <span class="status-badge {{ $equipment['status_class'] }}">{{ $equipment['status'] }}</span>
                                    <span class="activity-type">{{ $equipment['type'] }}</span>
                                </div>
                                <p class="activity-date">{{ $equipment['added_date'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-laptop"></i>
                        <p>Aucun équipement récent</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="activity-card">
            <div class="activity-header">
                <h3><i class="fas fa-bell me-2"></i>Activités Récentes</h3>
            </div>
            <div class="activity-list">
                @if($recentActivities && count($recentActivities) > 0)
                    @foreach($recentActivities as $activity)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-{{ $activity['icon'] }}"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-title">{{ $activity['description'] }}</p>
                                <p class="activity-time">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-bell"></i>
                        <p>Aucune activité récente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* En-tête */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, #35b4a1ff 0%, #5eead4 100%);
    border-radius: 15px;
    color: white;
}

.header-content h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.header-content p {
    opacity: 0.9;
    font-size: 1.1rem;
}

.header-actions {
    display: flex;
    gap: 15px;
    align-items: center;
}

.period-select {
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    backdrop-filter: blur(10px);
}

.period-select option {
    color: #333;
}

.refresh-btn {
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 8px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.refresh-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

/* Cartes de statistiques */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.card-icon.users { background: linear-gradient(135deg, #667eea, #00f2fe); }
.card-icon.tickets { background: linear-gradient(135deg, #4facfe, #00f2fe); }
.card-icon.equipments { background: linear-gradient(135deg, #4facfe, #00f2fe); }
.card-icon.checkouts { background: linear-gradient(135deg, #43e97b, #38f9d7); }

.card-content h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.card-content p {
    color: #718096;
    font-weight: 600;
    margin-bottom: 15px;
}

.progress-info {
    width: 100%;
}

.progress-text {
    font-size: 0.9rem;
    color: #4a5568;
    display: block;
    margin-bottom: 5px;
}

.progress-bar {
    width: 100%;
    height: 6px;
    background: #e2e8f0;
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 3px;
    transition: width 0.5s ease;
}

.stat-card:nth-child(1) .progress-fill { background: #667eea; }
.stat-card:nth-child(2) .progress-fill { background: #f093fb; }
.stat-card:nth-child(3) .progress-fill { background: #4facfe; }
.stat-card:nth-child(4) .progress-fill { background: #43e97b; }

/* Graphiques */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.chart-header {
    padding: 20px;
    border-bottom: 1px solid #e2e8f0;
    background: #f7fafc;
}

.chart-header h3 {
    color: #2d3748;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
}

.chart-header small {
    color: #718096;
    font-size: 0.85rem;
}

.chart-container {
    padding: 20px;
    height: 300px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-chart {
    text-align: center;
    color: #a0aec0;
    padding: 40px 20px;
}

.empty-chart i {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}

.empty-chart p {
    font-size: 1rem;
    margin: 0 0 10px 0;
}

.empty-chart small {
    font-size: 0.85rem;
    opacity: 0.7;
}

/* Activités récentes */
.activities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 20px;
}

.activity-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.activity-header {
    padding: 20px;
    border-bottom: 1px solid #e2e8f0;
    background: #f7fafc;
}

.activity-header h3 {
    color: #2d3748;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
}

.activity-list {
    padding: 20px;
    max-height: 400px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f1f5f9;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #f7fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #667eea;
    flex-shrink: 0;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 5px;
}

.activity-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 5px;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-warning { background: #fed7d7; color: #c53030; }
.status-success { background: #c6f6d5; color: #276749; }
.status-info { background: #bee3f8; color: #2c5aa0; }
.status-danger { background: #fed7d7; color: #c53030; }
.status-light { background: #e2e8f0; color: #4a5568; }

.activity-time, .activity-type, .activity-date {
    font-size: 0.85rem;
    color: #718096;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #a0aec0;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}

.empty-state p {
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .activities-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-container {
        height: 250px;
    }
}
</style>

@script
<script>
    // Fonction pour initialiser tous les graphiques
    function initializeCharts() {
        console.log('Initialisation des graphiques...');
        
        // Graphique des tickets par statut
        initializeTicketChart();
        
        // Graphique des équipements par type
        initializeEquipmentChart();
        
        // Graphique des statuts d'équipements
        initializeEquipmentStatusChart();
        
        // Graphique des tickets mensuels
        initializeMonthlyTicketsChart();
    }

    function initializeTicketChart() {
        const ticketsCtx = document.getElementById('ticketsChart-{{ $this->id }}');
        if (!ticketsCtx) {
            console.log('Canvas ticketsChart non trouvé');
            return;
        }

        const ticketData = @json($ticketStatusData ?? []);
        const hasData = ticketData && Object.keys(ticketData).length > 0 && Object.values(ticketData).some(val => val > 0);

        if (!hasData) {
            console.log('Aucune donnée pour le graphique des tickets');
            return;
        }

        console.log('Données tickets:', ticketData);

        try {
            // Détruire le graphique existant s'il y en a un
            if (ticketsCtx.chart) {
                ticketsCtx.chart.destroy();
            }

            ticketsCtx.chart = new Chart(ticketsCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(ticketData),
                    datasets: [{
                        data: Object.values(ticketData),
                        backgroundColor: ['#f093fb', '#4facfe', '#43e97b', '#fed7d7'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: { 
                                padding: 20,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
            console.log('Graphique tickets initialisé avec succès');
        } catch (error) {
            console.error('Erreur initialisation graphique tickets:', error);
        }
    }

    function initializeEquipmentChart() {
        const equipmentsCtx = document.getElementById('equipmentsChart-{{ $this->id }}');
        if (!equipmentsCtx) {
            console.log('Canvas equipmentsChart non trouvé');
            return;
        }

        const equipmentData = @json($equipmentChartData ?? []);
        const hasData = equipmentData && Object.keys(equipmentData).length > 0 && Object.values(equipmentData).some(val => val > 0);

        if (!hasData) {
            console.log('Aucune donnée pour le graphique des équipements');
            return;
        }

        console.log('Données équipements:', equipmentData);

        try {
            // Détruire le graphique existant s'il y en a un
            if (equipmentsCtx.chart) {
                equipmentsCtx.chart.destroy();
            }

            equipmentsCtx.chart = new Chart(equipmentsCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(equipmentData),
                    datasets: [{
                        label: 'Nombre d\'équipements',
                        data: Object.values(equipmentData),
                        backgroundColor: '#667eea',
                        borderRadius: 8,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            console.log('Graphique équipements initialisé avec succès');
        } catch (error) {
            console.error('Erreur initialisation graphique équipements:', error);
        }
    }

    function initializeEquipmentStatusChart() {
        const equipmentStatusCtx = document.getElementById('equipmentStatusChart-{{ $this->id }}');
        if (!equipmentStatusCtx) {
            console.log('Canvas equipmentStatusChart non trouvé');
            return;
        }

        const equipmentStatusData = @json($equipmentStatusData ?? []);
        const hasData = equipmentStatusData && Object.keys(equipmentStatusData).length > 0 && Object.values(equipmentStatusData).some(val => val > 0);

        if (!hasData) {
            console.log('Aucune donnée pour le graphique des statuts d\'équipements');
            return;
        }

        console.log('Données statuts équipements:', equipmentStatusData);

        try {
            // Détruire le graphique existant s'il y en a un
            if (equipmentStatusCtx.chart) {
                equipmentStatusCtx.chart.destroy();
            }

            equipmentStatusCtx.chart = new Chart(equipmentStatusCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(equipmentStatusData),
                    datasets: [{
                        data: Object.values(equipmentStatusData),
                        backgroundColor: ['#43e97b', '#4facfe', '#f093fb', '#fed7d7'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: { 
                                padding: 20,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
            console.log('Graphique statuts équipements initialisé avec succès');
        } catch (error) {
            console.error('Erreur initialisation graphique statuts équipements:', error);
        }
    }

    function initializeMonthlyTicketsChart() {
        const monthlyTicketsCtx = document.getElementById('monthlyTicketsChart-{{ $this->id }}');
        if (!monthlyTicketsCtx) {
            console.log('Canvas monthlyTicketsChart non trouvé');
            return;
        }

        const monthlyData = @json($monthlyTicketsData ?? []);
        const hasData = monthlyData && monthlyData.length > 0 && monthlyData.some(val => val > 0);

        if (!hasData) {
            console.log('Aucune donnée pour le graphique des tickets mensuels');
            return;
        }

        console.log('Données tickets mensuels:', monthlyData);

        try {
            // Détruire le graphique existant s'il y en a un
            if (monthlyTicketsCtx.chart) {
                monthlyTicketsCtx.chart.destroy();
            }

            monthlyTicketsCtx.chart = new Chart(monthlyTicketsCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                    datasets: [{
                        label: 'Tickets créés',
                        data: monthlyData,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
            console.log('Graphique tickets mensuels initialisé avec succès');
        } catch (error) {
            console.error('Erreur initialisation graphique tickets mensuels:', error);
        }
    }

    // Initialiser les graphiques quand la page est chargée
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM chargé, initialisation des graphiques...');
        // Petit délai pour s'assurer que Livewire est chargé
        setTimeout(initializeCharts, 100);
    });

    // Réinitialiser les graphiques après les mises à jour Livewire
    Livewire.hook('morph.updated', (el, component) => {
        if (component.$wire.__instance.id === '{{ $this->id }}') {
            console.log('Composant mis à jour, réinitialisation des graphiques...');
            setTimeout(initializeCharts, 100);
        }
    });

    // Écouter l'événement de rafraîchissement des graphiques
    window.addEventListener('chartsRefreshed', function() {
        console.log('Événement chartsRefreshed reçu, réinitialisation des graphiques...');
        setTimeout(initializeCharts, 100);
    });

    // Réinitialiser quand on clique sur le bouton actualiser
    document.addEventListener('livewire:init', () => {
        Livewire.on('refreshCharts', () => {
            setTimeout(initializeCharts, 100);
        });
    });
</script>
@endscript