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
                            <input type="text" placeholder="Rechercher une catégorie..." id="categorySearch">
                        </div>
                    </div>
                </div>

                <!-- Liste style moderne -->
                <div class="items-list" id="itemsList">
                    @foreach($stats as $index => $stat)
                        <div class="list-item" data-category="{{ strtolower($stat['title']) }}">
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

                <div class="table-footer-simple">
                    <div class="footer-info">
                        {{ count($stats) }} catégories au total
                    </div>
                    <div class="footer-actions">
                        <button class="btn-outline-simple" wire:click="exportData">
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
    --primary-dark: #4AA39E;
    --primary-light: #e6f4f3;
    --primary-soft: rgba(91, 196, 191, 0.1);
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-300: #cbd5e1;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-600: #475569;
    --gray-700: #334155;
    --gray-800: #1e293b;
    --gray-900: #0f172a;
    --success: #10b981;
    --success-light: #d1fae5;
    --danger: #ef4444;
    --danger-light: #fee2e2;
}

/* Base */
.equipement-dashboard {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0.5rem;
    background: var(--gray-50);
    min-height: 100vh;
}

/* Header compact */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.dashboard-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0 0 0.125rem 0;
}

.dashboard-subtitle {
    color: var(--gray-500);
    font-size: 0.65rem;
    margin: 0;
}

.total-badge {
    background: var(--primary);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 10px;
    text-align: center;
    min-width: 80px;
}

.total-number {
    font-size: 1rem;
    font-weight: 700;
    line-height: 1;
}

.total-label {
    font-size: 0.55rem;
    opacity: 0.9;
}

/* Stats Grid compact */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.stat-card {
    background: white;
    padding: 0.6rem;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border: 1px solid var(--gray-200);
    transition: all 0.2s ease;
}

.stat-card:hover {
    border-color: var(--primary);
    box-shadow: 0 2px 8px rgba(91, 196, 191, 0.1);
    transform: translateY(-1px);
}

.stat-emoji {
    font-size: 1.25rem;
}

.stat-number {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--gray-800);
    line-height: 1.2;
}

.stat-label {
    font-size: 0.55rem;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.stat-sub {
    font-size: 0.55rem;
    color: var(--gray-500);
    margin-top: 0.125rem;
}

/* Charts compact */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.chart-card {
    background: white;
    border-radius: 12px;
    padding: 0.75rem;
    border: 1px solid var(--gray-200);
    transition: all 0.2s ease;
}

.chart-card:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.chart-title {
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--gray-700);
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.chart-container {
    height: 180px;
    position: relative;
}

/* Tableau redesign compact */
.table-wrapper {
    background: white;
    border-radius: 12px;
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.table-header-simple {
    padding: 0.6rem 0.75rem;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
    background: var(--gray-50);
}

.table-header-simple h3 {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0;
}

.table-actions-simple {
    display: flex;
    gap: 0.5rem;
}

.search-simple {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    background: white;
    border: 1px solid var(--gray-300);
    border-radius: 8px;
    padding: 0.3rem 0.6rem;
}

.search-simple span {
    font-size: 0.65rem;
    opacity: 0.6;
}

.search-simple input {
    border: none;
    outline: none;
    font-size: 0.7rem;
    background: transparent;
    width: 160px;
}

.search-simple input::placeholder {
    color: var(--gray-400);
    font-size: 0.65rem;
}

/* Liste des items compact */
.items-list {
    display: flex;
    flex-direction: column;
}

.list-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.6rem 0.75rem;
    border-bottom: 1px solid var(--gray-200);
    transition: all 0.2s ease;
    gap: 0.75rem;
}

.list-item:hover {
    background: var(--primary-soft);
}

.item-main {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.item-icon {
    width: 34px;
    height: 34px;
    background: var(--primary-soft);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.item-info {
    flex: 1;
}

.item-name {
    font-weight: 600;
    color: var(--gray-800);
    font-size: 0.75rem;
    margin-bottom: 0.2rem;
}

.item-stats {
    display: flex;
    gap: 0.4rem;
    margin-bottom: 0.35rem;
    flex-wrap: wrap;
}

.stat-badge {
    font-size: 0.6rem;
    color: var(--gray-600);
    background: var(--gray-100);
    padding: 0.1rem 0.4rem;
    border-radius: 12px;
}

/* Barre de progression fluide */
.progress-simple {
    height: 3px;
    background: var(--gray-200);
    border-radius: 2px;
    overflow: hidden;
    width: 100%;
    max-width: 180px;
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
    font-size: 0.65rem;
    font-weight: 500;
    white-space: nowrap;
    transition: all 0.2s;
    padding: 0.3rem 0.6rem;
    border-radius: 6px;
}

.action-link:hover {
    background: var(--primary-soft);
    color: var(--primary-dark);
}

.item-status {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.6rem;
    color: var(--gray-600);
    flex-shrink: 0;
    min-width: 60px;
}

.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.status-dot.active {
    background: var(--success);
    box-shadow: 0 0 0 1px var(--success-light);
}

.status-dot.inactive {
    background: var(--gray-400);
}

/* Pied de tableau compact */
.table-footer-simple {
    padding: 0.6rem 0.75rem;
    border-top: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
    background: var(--gray-50);
}

.footer-info {
    font-size: 0.6rem;
    color: var(--gray-600);
}

.btn-outline-simple {
    background: transparent;
    border: 1px solid var(--gray-300);
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.6rem;
    font-weight: 500;
    color: var(--gray-700);
    cursor: pointer;
    transition: all 0.2s;
}

.btn-outline-simple:hover {
    background: var(--gray-100);
    border-color: var(--gray-400);
}

/* Loading compact */
.loading-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 250px;
    gap: 0.5rem;
    color: var(--gray-500);
}

.spinner {
    width: 28px;
    height: 28px;
    border: 2px solid var(--gray-200);
    border-top-color: var(--primary);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .charts-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .equipement-dashboard {
        padding: 0.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .list-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
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
    .chart-container {
        height: 160px;
    }
    
    .item-stats {
        flex-direction: column;
        gap: 0.2rem;
    }
    
    .stat-badge {
        display: inline-block;
        width: fit-content;
    }
    
    .progress-simple {
        max-width: 100%;
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
                    backgroundColor: 'var(--primary)',
                    borderRadius: 4,
                    barPercentage: 0.65,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { 
                        backgroundColor: '#1e293b',
                        titleFont: { size: 11 },
                        bodyFont: { size: 10 },
                        padding: 6
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { color: '#e2e8f0', drawBorder: false },
                        ticks: { font: { size: 9 }, stepSize: 1 }
                    },
                    x: { 
                        grid: { display: false },
                        ticks: { font: { size: 9 } }
                    }
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
                    backgroundColor: ['#5BC4BF', '#4AA39E', '#7FD9D4', '#3A8C85', '#2A6E68', '#1A504B'],
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
                        labels: { 
                            usePointStyle: true, 
                            boxWidth: 6,
                            font: { size: 9 },
                            padding: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleFont: { size: 11 },
                        bodyFont: { size: 10 },
                        padding: 6
                    }
                }
            }
        });
    }
    
    // Search filter
    const searchInput = document.getElementById('categorySearch');
    const itemsList = document.getElementById('itemsList');
    const items = itemsList ? itemsList.querySelectorAll('.list-item') : [];
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            items.forEach(item => {
                const category = item.getAttribute('data-category') || '';
                if (category.includes(searchTerm) || searchTerm === '') {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});
</script>
</div>