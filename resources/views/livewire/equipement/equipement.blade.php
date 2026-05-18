<div class="equipement-dashboard">
    <!-- Header simplifié compact -->
    <header class="dashboard-header">
        <div>
            <h1 class="dashboard-title">Tableau de bord IT</h1>
            <p class="dashboard-subtitle">Infrastructure informatique</p>
        </div>
        <div class="total-badge">
            <span class="total-number">{{ $this->totalEquipements }}</span>
            <span class="total-label">équipements</span>
        </div>
    </header>

    <main class="dashboard-main">
        @if($loading)
            <div class="loading-state">
                <div class="spinner"></div>
                <p>Chargement...</p>
            </div>
        @else
            <!-- Grille stats compacte -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-emoji">💻</span>
                    <div>
                        <div class="stat-number">{{ $this->totalEquipements }}</div>
                        <div class="stat-label">Total équipements</div>
                    </div>
                </div>

                <div class="stat-card">
                    <span class="stat-emoji">👑</span>
                    <div>
                        <div class="stat-number">{{ $this->categoryWithMostItems['title'] }}</div>
                        <div class="stat-label">Catégorie majoritaire</div>
                        <div class="stat-sub">{{ $this->categoryWithMostItems['count'] }} unités</div>
                    </div>
                </div>

                <div class="stat-card">
                    <span class="stat-emoji">📊</span>
                    <div>
                        <div class="stat-number">{{ $this->averagePerCategory }}</div>
                        <div class="stat-label">Moyenne par catégorie</div>
                    </div>
                </div>

                <div class="stat-card">
                    <span class="stat-emoji">🎯</span>
                    <div>
                        <div class="stat-number">
                            {{ $this->totalEquipements > 0 ? number_format(($this->categoryWithMostItems['count'] / $this->totalEquipements) * 100, 1) : 0 }}%
                        </div>
                        <div class="stat-label">Part majoritaire</div>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">Répartition des équipements</h3>
                    <div class="chart-container">
                        <canvas id="equipementChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <h3 class="chart-title">Distribution par type</h3>
                    <div class="chart-container">
                        <canvas id="equipementPieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tableau redesign simple et fluide -->
            <div class="table-wrapper">
                <div class="table-header-simple">
                    <h3>Récapitulatif des équipements</h3>
                    <div class="table-actions-simple">
                        <div class="search-simple">
                            <span>🔍</span>
                            <input type="text" placeholder="Rechercher une catégorie...">
                        </div>
                    </div>
                </div>

                <!-- Liste style moderne - remplace le tableau classique -->
                <div class="items-list">
                    @foreach($stats as $stat)
                        <div class="list-item">
                            <div class="item-main">
                                <div class="item-icon">
                                    <span>{{ $stat['icon'] }}</span>
                                </div>
                                <div class="item-info">
                                    <div class="item-name">{{ $stat['title'] }}</div>
                                    <div class="item-stats">
                                        <span class="stat-badge">
                                            {{ $stat['count'] }} équipements
                                        </span>
                                        <span class="stat-badge">
                                            {{ $this->getPercentage($stat['count']) }}% du total
                                        </span>
                                    </div>
                                    <!-- Barre de progression fluide -->
                                    <div class="progress-simple">
                                        <div class="progress-simple-fill" style="width: {{ $this->getPercentage($stat['count']) }}%"></div>
                                    </div>
                                </div>
                                <div class="item-action">
                                    <a href="{{ route($stat['route']) }}" class="action-link" wire:navigate>
                                        Voir les détails →
                                    </a>
                                </div>
                            </div>
                            <div class="item-status">
                                @if($stat['count'] > 0)
                                    <span class="status-dot active"></span>
                                    <span>Actif</span>
                                @else
                                    <span class="status-dot inactive"></span>
                                    <span>Vide</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pied de tableau simple -->
                <div class="table-footer-simple">
                    <div class="footer-info">
                        {{ count($stats) }} catégories au total
                    </div>
                    <div class="footer-actions">
                        <button class="btn-outline-simple">
                            📥 Exporter les données
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </main>
</div>

<style>
/* Variables */
:root {
    --primary: #5BC4BF;
    --primary-dark: #3a9e99;
    --primary-light: #e6f4f3;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-900: #111827;
    --success: #10b981;
    --success-light: #d1fae5;
    --error-light: #fee2e2;
}

/* Base */
.equipement-dashboard {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
    background: var(--gray-50);
    min-height: 100vh;
}

/* Header */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.dashboard-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0 0 0.25rem 0;
}

.dashboard-subtitle {
    color: var(--gray-500);
    font-size: 0.75rem;
    margin: 0;
}

.total-badge {
    background: var(--primary);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.75rem;
    text-align: center;
}

.total-number {
    font-size: 1.25rem;
    font-weight: 700;
    line-height: 1;
}

.total-label {
    font-size: 0.625rem;
    opacity: 0.9;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: white;
    padding: 0.75rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    border: 1px solid var(--gray-200);
    transition: all 0.2s;
}

.stat-card:hover {
    border-color: var(--primary-light);
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.stat-emoji {
    font-size: 1.5rem;
}

.stat-number {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1.2;
}

.stat-label {
    font-size: 0.625rem;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.stat-sub {
    font-size: 0.625rem;
    color: var(--gray-500);
    margin-top: 0.125rem;
}

/* Charts */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.chart-card {
    background: white;
    border-radius: 0.75rem;
    padding: 1rem;
    border: 1px solid var(--gray-200);
}

.chart-title {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--gray-700);
    margin: 0 0 0.75rem 0;
}

.chart-container {
    height: 200px;
    position: relative;
}

/* Tableau redesign simple */
.table-wrapper {
    background: white;
    border-radius: 0.75rem;
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

/* En-tête simplifié */
.table-header-simple {
    padding: 1rem;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    background: var(--gray-50);
}

.table-header-simple h3 {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
}

.table-actions-simple {
    display: flex;
    gap: 0.5rem;
}

.search-simple {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: white;
    border: 1px solid var(--gray-300);
    border-radius: 0.5rem;
    padding: 0.375rem 0.75rem;
}

.search-simple span {
    font-size: 0.75rem;
    opacity: 0.6;
}

.search-simple input {
    border: none;
    outline: none;
    font-size: 0.75rem;
    background: transparent;
    width: 180px;
}

.search-simple input::placeholder {
    color: var(--gray-400);
}

/* Liste des items - remplace le tableau */
.items-list {
    display: flex;
    flex-direction: column;
}

.list-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.875rem 1rem;
    border-bottom: 1px solid var(--gray-200);
    transition: all 0.2s ease;
    gap: 1rem;
}

.list-item:hover {
    background: var(--gray-50);
    transform: translateX(2px);
}

.item-main {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.item-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-light);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.item-info {
    flex: 1;
}

.item-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.item-stats {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    flex-wrap: wrap;
}

.stat-badge {
    font-size: 0.688rem;
    color: var(--gray-600);
    background: var(--gray-100);
    padding: 0.125rem 0.5rem;
    border-radius: 1rem;
}

/* Barre de progression fluide */
.progress-simple {
    height: 4px;
    background: var(--gray-200);
    border-radius: 2px;
    overflow: hidden;
    width: 100%;
    max-width: 200px;
}

.progress-simple-fill {
    height: 100%;
    background: var(--primary);
    border-radius: 2px;
    transition: width 0.3s ease;
}

.item-action {
    flex-shrink: 0;
}

.action-link {
    color: var(--primary);
    text-decoration: none;
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
    transition: all 0.2s;
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
}

.action-link:hover {
    background: var(--primary-light);
    color: var(--primary-dark);
}

.item-status {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.688rem;
    color: var(--gray-600);
    flex-shrink: 0;
    min-width: 70px;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.status-dot.active {
    background: var(--success);
    box-shadow: 0 0 0 2px var(--success-light);
}

.status-dot.inactive {
    background: var(--gray-400);
}

/* Pied de tableau */
.table-footer-simple {
    padding: 0.875rem 1rem;
    border-top: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
    background: var(--gray-50);
}

.footer-info {
    font-size: 0.688rem;
    color: var(--gray-600);
}

.btn-outline-simple {
    background: transparent;
    border: 1px solid var(--gray-300);
    padding: 0.375rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.688rem;
    font-weight: 500;
    color: var(--gray-700);
    cursor: pointer;
    transition: all 0.2s;
}

.btn-outline-simple:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
}

/* Loading */
.loading-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 300px;
    gap: 0.75rem;
    color: var(--gray-500);
}

.spinner {
    width: 32px;
    height: 32px;
    border: 2px solid var(--gray-200);
    border-top-color: var(--primary);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .equipement-dashboard {
        padding: 0.75rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .list-item {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .item-main {
        width: 100%;
    }
    
    .item-status {
        width: 100%;
        justify-content: flex-start;
        padding-left: 3rem;
    }
    
    .item-action {
        width: 100%;
    }
    
    .action-link {
        display: inline-block;
        width: 100%;
        text-align: center;
    }
    
    .table-header-simple {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-simple input {
        width: 100%;
    }
    
    .table-footer-simple {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 640px) {
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-container {
        height: 180px;
    }
    
    .item-stats {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .stat-badge {
        display: inline-block;
        width: fit-content;
    }
}
</style>

<script>
document.addEventListener('livewire:load', function () {
    const chartData = @json($chartData);
    
    const barCtx = document.getElementById('equipementChart');
    if (barCtx && window.Chart) {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Équipements',
                    data: chartData.data,
                    backgroundColor: '#5BC4BF',
                    borderRadius: 4,
                    barPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { backgroundColor: '#111827' }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { font: { size: 10 } }
                    },
                    x: { 
                        grid: { display: false },
                        ticks: { font: { size: 10 } }
                    }
                }
            }
        });
    }
    
    const pieCtx = document.getElementById('equipementPieChart');
    if (pieCtx && window.Chart) {
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: chartData.labels,
                datasets: [{
                    data: chartData.data,
                    backgroundColor: ['#5BC4BF', '#3a9e99', '#7ed4cf', '#2a7a76', '#1a5a57'],
                    borderWidth: 0,
                    cutout: '60%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        position: 'bottom',
                        labels: { 
                            usePointStyle: true, 
                            boxWidth: 6,
                            font: { size: 10 }
                        }
                    }
                }
            }
        });
    }
});
</script>