<div class="equipement-dashboard">
    <!-- Header Principal -->
    <header class="dashboard-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="dashboard-title">📊 Tableau de Bord IT</h1>
                <p class="dashboard-subtitle">Vue d'ensemble complète de votre infrastructure informatique</p>
            </div>
            <div class="header-right">
                <div class="total-badge">
                    <span class="total-number">{{ $this->totalEquipements }}</span>
                    <span class="total-label">Équipements</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu Principal -->
    <main class="dashboard-main">
        @if($loading)
            <!-- Loading State -->
            <div class="loading-container">
                <div class="loader-spinner"></div>
                <p class="loading-text">Chargement des données...</p>
            </div>
        @else
            <!-- Cartes Statistiques Principales - Version Simplifiée -->
            <div class="stats-grid-simple">
                <!-- Carte 1: Total Équipements -->
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <span>💻</span>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $this->totalEquipements }}</div>
                        <div class="stat-label">Total Équipements</div>
                        <div class="stat-description">Toutes catégories</div>
                    </div>
                </div>

                <!-- Carte 2: Catégorie Majoritaire -->
                <div class="stat-card">
                    <div class="stat-icon success">
                        <span>👑</span>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $this->categoryWithMostItems['title'] }}</div>
                        <div class="stat-label">Catégorie Majoritaire</div>
                        <div class="stat-description">{{ $this->categoryWithMostItems['count'] }} unités</div>
                    </div>
                </div>

                <!-- Carte 3: Moyenne par Catégorie -->
                <div class="stat-card">
                    <div class="stat-icon info">
                        <span>📊</span>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $this->averagePerCategory }}</div>
                        <div class="stat-label">Moyenne/Catégorie</div>
                        <div class="stat-description">Équipements moyens</div>
                    </div>
                </div>

                <!-- Carte 4: Part Majoritaire -->
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <span>🎯</span>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">
                            {{ $this->totalEquipements > 0 ? number_format(($this->categoryWithMostItems['count'] / $this->totalEquipements) * 100, 1) : 0 }}%
                        </div>
                        <div class="stat-label">Part Majoritaire</div>
                        <div class="stat-description">Pourcentage dominant</div>
                    </div>
                </div>
            </div>

            <!-- Section Graphiques -->
            <div class="charts-section">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">📈 Répartition des Équipements</h3>
                    </div>
                    <div class="chart-body">
                        <canvas id="equipementChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">🥧 Distribution par Type</h3>
                    </div>
                    <div class="chart-body">
                        <canvas id="equipementPieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tableau Récapitulatif -->
            <div class="table-section">
                <div class="table-header">
                    <h3 class="table-title">📋 Récapitulatif des Équipements</h3>
                    <div class="table-actions">
                        <div class="search-box">
                            <input type="text" placeholder="Rechercher..." class="search-input">
                            <span class="search-icon">🔍</span>
                        </div>
                        <button class="btn-export">
                            <span>📥 Exporter</span>
                        </button>
                    </div>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="sortable">Catégorie</th>
                                <th class="sortable">Quantité</th>
                                <th class="sortable">Pourcentage</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats as $stat)
                                <tr class="table-row">
                                    <td>
                                        <div class="category-info">
                                            <div class="category-badge {{ $stat['color'] }}">
                                                <span class="category-icon">{{ $stat['icon'] }}</span>
                                                <span>{{ $stat['title'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-count">{{ $stat['count'] }}</div>
                                    </td>
                                    <td>
                                        <div class="table-percentage">{{ $this->getPercentage($stat['count']) }}%</div>
                                    </td>
                                    <td>
                                        @if($stat['count'] > 0)
                                            <span class="status-badge active">Actif</span>
                                        @else
                                            <span class="status-badge inactive">Vide</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route($stat['route']) }}" class="btn-action view" wire:navigate title="Voir détails">
                                                <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                        </div>
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
    /* Variables CSS modernes */
    :root {
        --primary: #06b6d4;
        --primary-light: #22d3ee;
        --primary-dark: #0891b2;
        --primary-50: #f0fdff;
        --primary-100: #ccfbf1;
        --success: #10b981;
        --warning: #f59e0b;
        --info: #3b82f6;
        --dark: #1e293b;
        --light: #ffffff;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --border: #e2e8f0;
        --card-bg: #ffffff;
        --shadow: rgba(15, 23, 42, 0.08);
        --shadow-lg: rgba(15, 23, 42, 0.15);
        --gradient-primary: linear-gradient(135deg, var(--primary), #8b5cf6);
    }

    [data-theme="dark"] {
        --primary: #22d3ee;
        --primary-light: #67e8f9;
        --primary-dark: #06b6d4;
        --primary-50: #0c4a6e;
        --primary-100: #155e75;
        --success: #34d399;
        --warning: #fbbf24;
        --info: #60a5fa;
        --dark: #f1f5f9;
        --light: #0f172a;
        --gray-50: #1e293b;
        --gray-100: #334155;
        --gray-200: #475569;
        --gray-300: #64748b;
        --gray-400: #94a3b8;
        --gray-500: #cbd5e1;
        --gray-600: #e2e8f0;
        --border: #334155;
        --card-bg: #1e293b;
        --shadow: rgba(0, 0, 0, 0.25);
        --shadow-lg: rgba(0, 0, 0, 0.4);
    }

    /* Reset et base */
    .equipement-dashboard {
        background: var(--gray-50);
        min-height: 100vh;
        padding: 1.5rem;
        font-family: 'Nunito', 'Inter', sans-serif;
        font-size: 0.875rem;
    }

    /* Header */
    .dashboard-header {
        margin-bottom: 2rem;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1.5rem;
    }

    .header-left {
        flex: 1;
    }

    .dashboard-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .dashboard-subtitle {
        color: var(--gray-600);
        font-size: 0.9rem;
    }

    .total-badge {
        background: var(--gradient-primary);
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.2);
    }

    .total-number {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
    }

    .total-label {
        font-size: 0.75rem;
        opacity: 0.9;
        font-weight: 600;
    }

    /* Cartes Statistiques Simplifiées */
    .stats-grid-simple {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 10px;
        padding: 1.25rem;
        box-shadow: 0 1px 3px var(--shadow);
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px var(--shadow-lg);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .stat-icon.primary {
        background: var(--primary-50);
        color: var(--primary);
    }

    .stat-icon.success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .stat-icon.info {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    .stat-icon.warning {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .stat-content {
        flex: 1;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        color: var(--gray-600);
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.125rem;
    }

    .stat-description {
        color: var(--gray-500);
        font-size: 0.75rem;
    }

    /* Section Graphiques */
    .charts-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .chart-card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 1px 3px var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .chart-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border);
    }

    .chart-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    .chart-body {
        padding: 1rem;
        height: 250px;
    }

    /* Tableau */
    .table-section {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 1px 3px var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .table-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .table-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    .table-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .search-box {
        position: relative;
        min-width: 200px;
    }

    .search-input {
        width: 100%;
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.8rem;
        background: var(--gray-50);
        color: var(--dark);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
    }

    .btn-export {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-export:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(6, 182, 212, 0.3);
    }

    .table-container {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8rem;
    }

    .data-table thead {
        background: var(--gradient-primary);
    }

    .data-table th {
        padding: 0.75rem 1rem;
        color: white;
        font-weight: 600;
        text-align: left;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background-color 0.2s ease;
    }

    .data-table tbody tr:hover {
        background: var(--gray-50);
    }

    .data-table td {
        padding: 0.75rem 1rem;
        color: var(--dark);
        font-weight: 500;
    }

    /* Badges de catégorie */
    .category-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.6rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        width: fit-content;
    }

    .category-badge.blue { background: var(--primary-50); color: var(--primary-dark); }
    .category-badge.green { background: rgba(16, 185, 129, 0.1); color: #065f46; }
    .category-badge.yellow { background: rgba(245, 158, 11, 0.1); color: #92400e; }
    .category-badge.purple { background: rgba(139, 92, 246, 0.1); color: #5b21b6; }

    .category-icon {
        font-size: 0.9rem;
    }

    /* Badges de statut */
    .status-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        text-align: center;
        min-width: 60px;
    }

    .status-badge.active {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-badge.inactive {
        background: rgba(100, 116, 139, 0.1);
        color: #475569;
        border: 1px solid rgba(100, 116, 139, 0.3);
    }

    /* Actions */
    .action-buttons {
        display: flex;
        gap: 0.3rem;
    }

    .btn-action {
        width: 28px;
        height: 28px;
        border: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-action:hover {
        transform: scale(1.05);
    }

    .btn-action.view {
        background: rgba(6, 182, 212, 0.1);
        color: var(--primary);
    }

    .btn-action.view:hover {
        background: rgba(6, 182, 212, 0.2);
    }

    .action-icon {
        width: 14px;
        height: 14px;
    }

    /* Loading State */
    .loading-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 400px;
        gap: 1rem;
    }

    .loader-spinner {
        width: 48px;
        height: 48px;
        border: 3px solid var(--gray-200);
        border-top: 3px solid var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .loading-text {
        color: var(--gray-600);
        font-size: 1rem;
        font-weight: 600;
    }

    /* Animations */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .charts-section {
            grid-template-columns: 1fr;
        }
        
        .stats-grid-simple {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .equipement-dashboard {
            padding: 1rem;
        }
        
        .header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .stats-grid-simple {
            grid-template-columns: 1fr;
        }
        
        .table-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .table-actions {
            justify-content: space-between;
            width: 100%;
        }
        
        .search-box {
            min-width: 100%;
        }
    }

    @media (max-width: 480px) {
        .equipement-dashboard {
            padding: 0.75rem;
        }
        
        .stat-card {
            padding: 1rem;
        }
        
        .chart-body {
            height: 200px;
        }
    }
</style>

<script>
document.addEventListener('livewire:load', function () {
    const chartData = @json($chartData);

    // Graphique en barres
    const barCtx = document.getElementById('equipementChart');
    if (barCtx) {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Nombre d\'équipements',
                    data: chartData.data,
                    backgroundColor: chartData.colors,
                    borderColor: chartData.colors.map(color => color),
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Graphique camembert
    const pieCtx = document.getElementById('equipementPieChart');
    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: chartData.labels,
                datasets: [{
                    data: chartData.data,
                    backgroundColor: chartData.colors,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                        }
                    }
                }
            }
        });
    }
});
</script>