<div class="equipement-dashboard">
    <!-- Header simplifié -->
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
            <!-- Grille stats simplifiée -->
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

            <!-- Tableau -->
            <div class="table-card">
                <div class="table-toolbar">
                    <h3 class="table-title">Récapitulatif</h3>
                    <div class="toolbar-actions">
                        <input type="text" placeholder="Rechercher..." class="search-input">
                        <button class="btn-export">Exporter</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                <th>Pourcentage</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats as $stat)
                                <tr>
                                    <td class="category-cell">
                                        <span class="category-badge">
                                            <span>{{ $stat['icon'] }}</span>
                                            <span>{{ $stat['title'] }}</span>
                                        </span>
                                    </td>
                                    <td class="count-cell">{{ $stat['count'] }}</td>
                                    <td>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: {{ $this->getPercentage($stat['count']) }}%"></div>
                                            <span class="percentage-text">{{ $this->getPercentage($stat['count']) }}%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status {{ $stat['count'] > 0 ? 'status-active' : 'status-inactive' }}">
                                            {{ $stat['count'] > 0 ? 'Actif' : 'Vide' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route($stat['route']) }}" class="btn-link" wire:navigate>
                                            Voir →
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </main>
</div>

<style>
/* Variables - Palette moderne */
:root {
    --primary: #5BC4BF;
    --primary-dark: #3a9e99;
    --primary-light: #e6f4f3;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-600: #6b7280;
    --gray-900: #111827;
    --success: #10b981;
    --success-light: #d1fae5;
    --error-light: #fee2e2;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
}

.dark {
    --primary-light: #1a3a38;
    --gray-50: #111827;
    --gray-100: #1f2937;
    --gray-200: #374151;
    --gray-300: #4b5563;
    --gray-600: #9ca3af;
    --gray-900: #f9fafb;
}

/* Base */
.equipement-dashboard {
    max-width: 1400px;
    margin: 0 auto;
    padding: 1.5rem;
    background: var(--gray-50);
    min-height: 100vh;
}

/* Header */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.dashboard-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0 0 0.25rem 0;
}

.dashboard-subtitle {
    color: var(--gray-600);
    font-size: 0.875rem;
    margin: 0;
}

.total-badge {
    background: var(--primary);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 1rem;
    text-align: center;
    box-shadow: var(--shadow);
}

.total-number {
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
}

.total-label {
    font-size: 0.75rem;
    opacity: 0.9;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: white;
    padding: 1.25rem;
    border-radius: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: var(--shadow-sm);
    transition: all 0.2s ease;
    border: 1px solid var(--gray-200);
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
    border-color: var(--primary-light);
}

.stat-emoji {
    font-size: 2rem;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1.2;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-sub {
    font-size: 0.75rem;
    color: var(--gray-600);
    margin-top: 0.25rem;
}

/* Charts */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.chart-card {
    background: white;
    border-radius: 1rem;
    padding: 1.25rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.chart-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0 0 1rem 0;
}

.chart-container {
    height: 250px;
    position: relative;
}

/* Table */
.table-card {
    background: white;
    border-radius: 1rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.table-toolbar {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.table-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
}

.toolbar-actions {
    display: flex;
    gap: 0.75rem;
}

.search-input {
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--gray-300);
    border-radius: 0.5rem;
    font-size: 0.875rem;
    background: white;
    color: var(--gray-900);
}

.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
}

.btn-export {
    padding: 0.5rem 1rem;
    background: var(--gray-100);
    border: 1px solid var(--gray-300);
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-700);
    cursor: pointer;
    transition: all 0.2s;
}

.btn-export:hover {
    background: var(--gray-200);
}

.table-responsive {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table thead th {
    text-align: left;
    padding: 0.75rem 1.25rem;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid var(--gray-200);
    background: var(--gray-50);
}

.data-table tbody td {
    padding: 1rem 1.25rem;
    font-size: 0.875rem;
    color: var(--gray-900);
    border-bottom: 1px solid var(--gray-200);
}

.data-table tbody tr:hover {
    background: var(--gray-50);
}

.category-cell {
    font-weight: 500;
}

.category-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.75rem;
    background: var(--primary-light);
    border-radius: 1.5rem;
    font-size: 0.875rem;
}

.count-cell {
    font-weight: 600;
}

/* Progress bar */
.progress-bar {
    position: relative;
    background: var(--gray-200);
    border-radius: 1rem;
    height: 1.5rem;
    width: 100%;
    max-width: 150px;
    overflow: hidden;
}

.progress-fill {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    background: var(--primary);
    border-radius: 1rem;
    transition: width 0.3s ease;
}

.percentage-text {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--gray-900);
    z-index: 1;
}

/* Status */
.status {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-active {
    background: var(--success-light);
    color: var(--success);
}

.status-inactive {
    background: var(--error-light);
    color: #dc2626;
}

.btn-link {
    color: var(--primary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: color 0.2s;
}

.btn-link:hover {
    color: var(--primary-dark);
}

/* Loading */
.loading-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 400px;
    gap: 1rem;
    color: var(--gray-600);
}

.spinner {
    width: 40px;
    height: 40px;
    border: 3px solid var(--gray-200);
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
        padding: 1rem;
    }
    
    .dashboard-header {
        flex-direction: column;
        text-align: center;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .table-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    
    .toolbar-actions {
        flex-direction: column;
    }
    
    .search-input {
        width: 100%;
    }
    
    .progress-bar {
        max-width: 100px;
    }
}

@media (max-width: 640px) {
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-container {
        height: 200px;
    }
    
    .data-table td, 
    .data-table th {
        padding: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('livewire:load', function () {
    const chartData = @json($chartData);
    
    // Bar chart
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
                    borderRadius: 6,
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
                        grid: { color: '#e5e7eb' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }
    
    // Pie chart
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
                    cutout: '65%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        position: 'bottom',
                        labels: { usePointStyle: true, boxWidth: 8 }
                    }
                }
            }
        });
    }
});
</script>