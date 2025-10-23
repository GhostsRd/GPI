<div class="dashboard-container">
    <!-- En-tête du tableau de bord -->
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-text">
                <h1 class="dashboard-title">
                    <span class="title-main">Tableau de Bord</span>
                    <span class="title-sub">GPI - Gestion de Parc Informatique</span>
                </h1>
                <p class="dashboard-description">Vue d'ensemble de votre activité et performances</p>
            </div>
            <div class="header-info">
                <div class="date-info">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <span>{{ Auth::user()->name ?? 'Administrateur' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques principales -->
    <div class="stats-grid">
        <!-- Carte Tickets -->
        <div class="stat-card">
            <div class="card-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="card-content">
                <h3>Tickets</h3>
                <div class="card-value">{{ $totalTickets ?? 0 }}</div>
                <div class="card-detail">
                    <span class="badge orange">{{ $openTickets ?? 0 }} ouverts</span>
                </div>
            </div>
        </div>

        <!-- Carte Utilisateurs -->
        <div class="stat-card">
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-content">
                <h3>Utilisateurs</h3>
                <div class="card-value">{{ $totalUsers ?? 0 }}</div>
                <div class="card-detail">
                    <span class="badge bleu">{{ $activeUsers ?? 0 }} actifs</span>
                </div>
            </div>
        </div>

        <!-- Carte Équipements -->
        <div class="stat-card">
            <div class="card-icon">
                <i class="fas fa-laptop"></i>
            </div>
            <div class="card-content">
                <h3>Équipements</h3>
                <div class="card-value">{{ $totalEquipments ?? 0 }}</div>
                <div class="card-detail">
                    <span class="badge marron">{{ $availableEquipments ?? 0 }} disponibles</span>
                </div>
            </div>
        </div>

        <!-- Carte Mouvements -->
        <div class="stat-card">
            <div class="card-icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="card-content">
                <h3>Mouvements</h3>
                <div class="card-value">{{ $totalCheckouts ?? 0 }}</div>
                <div class="card-detail">
                    <span class="badge orange-light">{{ $pendingCheckouts ?? 0 }} en attente</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Graphiques -->
    <div class="charts-section">
        <div class="section-header">
            <h2><i class="fas fa-chart-bar"></i> Analytics</h2>
            <button wire:click="$refresh" class="refresh-btn">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>

        <div class="charts-grid">
            <!-- Graphique Tickets par Mois -->
            <div class="chart-card wide">
                <div class="chart-header">
                    <h3>Évolution des Tickets</h3>
                </div>
                <div class="chart-container">
                    <canvas id="ticketsChart" wire:ignore></canvas>
                </div>
            </div>

            <!-- Graphique Utilisateurs -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3>Répartition Utilisateurs</h3>
                </div>
                <div class="chart-container">
                    <canvas id="usersChart" wire:ignore></canvas>
                </div>
            </div>

            <!-- Graphique Équipements -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3>Types d'Équipements</h3>
                </div>
                <div class="chart-container">
                    <canvas id="equipmentChart" wire:ignore></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Activité Récente -->
    <div class="activity-section">
        <div class="section-header">
            <h2><i class="fas fa-history"></i> Activité Récente</h2>
        </div>

        <div class="activity-grid">
            <!-- Tickets Récents -->
            <div class="activity-card">
                <div class="card-header">
                    <h3>Tickets Récents</h3>
                    
                </div>
                <div class="activity-list">
                    @forelse($recentTickets ?? [] as $ticket)
                    <div class="activity-item">
                        <div class="activity-icon ticket">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">{{ $ticket['title'] ?? 'Ticket' }}</div>
                            <div class="activity-meta">
                                <span class="status {{ $ticket['status'] ?? 'open' }}">{{ $ticket['status'] ?? 'Ouvert' }}</span>
                                <span class="time">{{ $ticket['created_at'] ?? now() }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Aucun ticket récent</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Utilisateurs Récents -->
            <div class="activity-card">
                <div class="card-header">
                    <h3>Utilisateurs Récents</h3>
                    
                </div>
                <div class="activity-list">
                    @forelse($recentUsers ?? [] as $user)
                    <div class="activity-item">
                        <div class="activity-icon user">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">{{ $user['name'] ?? 'Utilisateur' }}</div>
                            <div class="activity-meta">
                                <span class="role">{{ $user['role'] ?? 'Utilisateur' }}</span>
                                <span class="time">{{ $user['created_at'] ?? now() }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <p>Aucun utilisateur récent</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Équipements Récents -->
            <div class="activity-card">
                <div class="card-header">
                    <h3>Équipements Récents</h3>
                    
                </div>
                <div class="activity-list">
                    @forelse($recentEquipments ?? [] as $equipment)
                    <div class="activity-item">
                        <div class="activity-icon equipment">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">{{ $equipment['name'] ?? 'Équipement' }}</div>
                            <div class="activity-meta">
                                <span class="type">{{ $equipment['type'] ?? 'Type' }}</span>
                                <span class="time">{{ $equipment['created_at'] ?? now() }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="fas fa-laptop"></i>
                        <p>Aucun équipement récent</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique Tickets
    const ticketsCtx = document.getElementById('ticketsChart');
    if (ticketsCtx) {
        new Chart(ticketsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Tickets créés',
                    data: [12, 19, 8, 15, 12, 10, 8, 14, 16, 18, 15, 20],
                    borderColor: '#FF8C42',
                    backgroundColor: 'rgba(255, 140, 66, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Graphique Utilisateurs
    const usersCtx = document.getElementById('usersChart');
    if (usersCtx) {
        new Chart(usersCtx, {
            type: 'doughnut',
            data: {
                labels: ['Actifs', 'Inactifs'],
                datasets: [{
                    data: [{{ $activeUsers ?? 75 }}, {{ $inactiveUsers ?? 25 }}],
                    backgroundColor: [
                        '#87CEEB',
                        '#FFB88C'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Graphique Équipements
    const equipmentCtx = document.getElementById('equipmentChart');
    if (equipmentCtx) {
        new Chart(equipmentCtx, {
            type: 'bar',
            data: {
                labels: ['PC', 'Laptops', 'Imprimantes', 'Réseau', 'Périphériques'],
                datasets: [{
                    label: 'Quantité',
                    data: [35, 25, 15, 10, 15],
                    backgroundColor: [
                        '#FF8C42',
                        '#8B4513',
                        '#87CEEB',
                        '#FFB88C',
                        '#A67B5B'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});

// Rafraîchissement automatique des données
setInterval(() => {
    Livewire.emit('refreshDashboard');
}, 30000); // Toutes les 30 secondes
</script>
@endpush

<style>
/* Variables CSS avec la palette demandée */
:root {
    --orange: #FF8C42;
    --orange-light: #FFB88C;
    --marron: #8B4513;
    --marron-light: #A67B5B;
    --bleu-ciel: #87CEEB;
    --bleu-ciel-light: #B0E2FF;
    
    --light: #F8F9FA;
    --dark: #212529;
    --gray: #6C757D;
    --gray-light: #E9ECEF;
    --white: #FFFFFF;
    
    --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 4px 16px rgba(0, 0, 0, 0.15);
    --radius: 8px;
    --radius-lg: 12px;
}

/* Styles généraux */
.dashboard-container {
    padding: 20px;
    background: var(--light);
    min-height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* En-tête */
.dashboard-header {
    margin-bottom: 30px;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 20px;
}

.header-text {
    flex: 1;
}

.dashboard-title {
    margin-bottom: 8px;
}

.title-main {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: var(--marron);
    margin-bottom: 4px;
}

.title-sub {
    display: block;
    font-size: 1rem;
    color: var(--orange);
    font-weight: 500;
}

.dashboard-description {
    color: var(--gray);
    font-size: 0.9rem;
}

.header-info {
    display: flex;
    gap: 20px;
    align-items: center;
}

.date-info, .user-info {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    font-size: 0.9rem;
}

.date-info i {
    color: var(--orange);
}

.user-avatar {
    width: 32px;
    height: 32px;
    background: var(--bleu-ciel);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 0.8rem;
}

/* Grille de statistiques */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--white);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--white);
}

.stat-card:nth-child(1) .card-icon { background: var(--orange); }
.stat-card:nth-child(2) .card-icon { background: var(--bleu-ciel); }
.stat-card:nth-child(3) .card-icon { background: var(--marron); }
.stat-card:nth-child(4) .card-icon { background: var(--orange-light); }

.card-content h3 {
    margin: 0 0 8px 0;
    font-size: 0.9rem;
    color: var(--gray);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 8px;
    line-height: 1;
}

.card-detail {
    display: flex;
    align-items: center;
    gap: 8px;
}

.badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--white);
}

.badge.orange { background: var(--orange); }
.badge.bleu { background: var(--bleu-ciel); }
.badge.marron { background: var(--marron); }
.badge.orange-light { background: var(--orange-light); }

/* Section Graphiques */
.charts-section {
    margin-bottom: 30px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.section-header h2 {
    font-size: 1.5rem;
    color: var(--marron);
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.section-header h2 i {
    color: var(--orange);
}

.refresh-btn {
    background: var(--orange);
    color: var(--white);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.refresh-btn:hover {
    background: var(--marron);
    transform: rotate(90deg);
}

.charts-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 20px;
}

.chart-card {
    background: var(--white);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
}

.chart-card.wide {
    grid-column: span 2;
}

.chart-header {
    margin-bottom: 15px;
}

.chart-header h3 {
    margin: 0;
    font-size: 1.1rem;
    color: var(--dark);
    font-weight: 600;
}

.chart-container {
    position: relative;
    height: 200px;
}

/* Section Activité */
.activity-section {
    margin-bottom: 30px;
}

.activity-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.activity-card {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--gray-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--light);
}

.card-header h3 {
    margin: 0;
    font-size: 1.1rem;
    color: var(--marron);
    display: flex;
    align-items: center;
    gap: 8px;
}

.view-all {
    color: var(--orange);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.3s ease;
}

.view-all:hover {
    color: var(--marron);
}

.activity-list {
    padding: 0;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    border-bottom: 1px solid var(--gray-light);
    transition: background 0.3s ease;
}

.activity-item:hover {
    background: var(--light);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 1rem;
    flex-shrink: 0;
}

.activity-icon.ticket { background: var(--orange); }
.activity-icon.user { background: var(--bleu-ciel); }
.activity-icon.equipment { background: var(--marron); }

.activity-content {
    flex: 1;
    min-width: 0;
}

.activity-title {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.activity-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.8rem;
}

.status, .role, .type {
    padding: 2px 8px;
    border-radius: 10px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.7rem;
}

.status.open { background: rgba(255, 140, 66, 0.2); color: var(--orange); }
.status.closed { background: rgba(135, 206, 235, 0.2); color: var(--bleu-ciel); }

.role { background: rgba(139, 69, 19, 0.2); color: var(--marron); }
.type { background: rgba(255, 184, 140, 0.2); color: var(--marron-light); }

.time {
    color: var(--gray);
    font-size: 0.75rem;
}

.empty-state {
    padding: 30px 20px;
    text-align: center;
    color: var(--gray);
}

.empty-state i {
    font-size: 2.5rem;
    margin-bottom: 12px;
    opacity: 0.5;
}

.empty-state p {
    margin: 0;
    font-size: 0.9rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-card.wide {
        grid-column: span 1;
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 15px;
    }
    
    .header-content {
        flex-direction: column;
    }
    
    .header-info {
        width: 100%;
        justify-content: space-between;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .activity-grid {
        grid-template-columns: 1fr;
    }
    
    .title-main {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .activity-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
    
    .time {
        align-self: flex-end;
    }
}
</style>