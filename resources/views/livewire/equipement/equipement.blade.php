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
            <!-- Cartes Statistiques Principales - 4 COLONNES -->
            <div class="stats-grid-4col">
                <!-- Carte 1: Total Équipements -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon primary">
                            <span class="icon">💻</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-number">{{ $this->totalEquipements }}</div>
                        <div class="card-label">Total Équipements</div>
                        <div class="card-description">Toutes catégories</div>
                    </div>
                </div>

                <!-- Carte 2: Catégorie Majoritaire -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon success">
                            <span class="icon">👑</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-number">{{ $this->categoryWithMostItems['title'] }}</div>
                        <div class="card-label">Catégorie Majoritaire</div>
                        <div class="card-description">{{ $this->categoryWithMostItems['count'] }} unités</div>
                    </div>
                </div>

                <!-- Carte 3: Moyenne par Catégorie -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon info">
                            <span class="icon">📊</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-number">{{ $this->averagePerCategory }}</div>
                        <div class="card-label">Moyenne/Catégorie</div>
                        <div class="card-description">Équipements moyens</div>
                    </div>
                </div>

                <!-- Carte 4: Part Majoritaire -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon warning">
                            <span class="icon">🎯</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-number">
                            {{ $this->totalEquipements > 0 ? number_format(($this->categoryWithMostItems['count'] / $this->totalEquipements) * 100, 1) : 0 }}%
                        </div>
                        <div class="card-label">Part Majoritaire</div>
                        <div class="card-description">Pourcentage dominant</div>
                    </div>
                </div>
            </div>

            <!-- Cartes des Catégories d'Équipements -->
            <div class="categories-section">
                <div class="section-header">
                    <h2 class="section-title">Détail par Catégorie</h2>
                </div>

                <div class="categories-grid">
                    @foreach($stats as $stat)
                        <div class="card category-card">
                            <div class="card-header">
                                <div class="category-header">
                                    <div class="card-icon {{ $stat['color'] }}">
                                        <span class="icon">{{ $stat['icon'] }}</span>
                                    </div>
                                    <div class="category-info">
                                        <h4 class="category-name">{{ $stat['title'] }}</h4>
                                        <div class="category-count">{{ $stat['count'] }} unités</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Mini Graphique -->
                                <div class="category-chart">
                                    <div class="mini-chart">
                                        @switch($stat['title'])
                                            @case('Ordinateurs')
                                                <div class="chart-network">
                                                    <div class="node main"></div>
                                                    <div class="node secondary"></div>
                                                    <div class="node tertiary"></div>
                                                </div>
                                                @break
                                            @case('Imprimantes')
                                                <div class="chart-bars">
                                                    <div class="bar" style="height: 60%"></div>
                                                    <div class="bar" style="height: 80%"></div>
                                                    <div class="bar" style="height: 40%"></div>
                                                </div>
                                                @break
                                            @case('Téléphones')
                                                <div class="chart-radar">
                                                    <div class="radar-center"></div>
                                                    <div class="radar-point"></div>
                                                </div>
                                                @break
                                            @case('Logiciels')
                                                <div class="chart-donut">
                                                    <div class="donut-hole"></div>
                                                </div>
                                                @break
                                            @case('Périphériques')
                                                <div class="chart-line">
                                                    <div class="line-path"></div>
                                                </div>
                                                @break
                                            @case('Moniteurs')
                                                <div class="chart-circle">
                                                    <div class="circle-progress"></div>
                                                </div>
                                                @break
                                            @case('Réseau')
                                                <div class="chart-topology">
                                                    <div class="topology-node"></div>
                                                    <div class="topology-connection"></div>
                                                </div>
                                                @break
                                        @endswitch
                                    </div>
                                </div>

                                <!-- Barre de Progression -->
                                <div class="category-progress">
                                    <div class="progress-header">
                                        <span class="progress-label">Pourcentage</span>
                                        <span class="progress-percentage">{{ $this->getPercentage($stat['count']) }}%</span>
                                    </div>
                                    <div class="progress-bar-container">
                                        <div
                                            class="progress-bar {{ $stat['color'] }}"
                                            style="width: {{ $this->getProgressWidth($stat['count']) }}%"
                                            data-width="{{ $this->getProgressWidth($stat['count']) }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="category-actions">
                                    <a href="{{ route($stat['route']) }}" class="btn-card" wire:navigate>
                                        <span>Voir détails</span>
                                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Graphiques -->
            <div class="charts-section">
                <div class="card chart-card">
                    <div class="card-header">
                        <h3 class="card-title">📈 Répartition des Équipements</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                            <canvas id="equipementChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card chart-card">
                    <div class="card-header">
                        <h3 class="card-title">🥧 Distribution par Type</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                            <canvas id="equipementPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau Récapitulatif -->
            <div class="card table-card">
                <div class="card-header">
                    <div class="table-header-content">
                        <h3 class="card-title">📋 Récapitulatif des Équipements</h3>
                        <div class="table-actions">
                            <div class="search-box">
                                <input type="text" placeholder="Rechercher..." class="search-input">
                                <span class="search-icon">🔍</span>
                            </div>
                            <button class="btn-card primary">
                                <span>📥 Exporter</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table class="modern-table">
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
                                        <div class="table-category">
                                            <div class="category-badge {{ $stat['color'] }}">
                                                <span class="category-icon-small">{{ $stat['icon'] }}</span>
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
                                            <span class="status-badge status-active">Actif</span>
                                        @else
                                            <span class="status-badge status-inactive">Vide</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route($stat['route']) }}" class="btn-action btn-edit" wire:navigate title="Voir détails">
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
            </div>
        @endif
    </main>
</div>

<!-- Styles CSS avec système de cartes -->
<style>
    /* Import de la police */
    @import url(https://fonts.googleapis.com/css?family=Nunito);

    /* Variables CSS modernes */
    :root {
        /* Light Theme - Cyan */
        --primary: #06b6d4;
        --primary-light: #22d3ee;
        --primary-dark: #0891b2;
        --primary-50: #f0fdff;
        --primary-100: #ccfbf1;
        --primary-200: #99f6e4;
        --primary-300: #5eead4;
        --primary-400: #2dd4bf;
        --secondary: #8b5cf6;
        --success: #10b981;
        --warning: #f59e0b;
        --error: #ef4444;
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
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --border: #e2e8f0;
        --sidebar-bg: #ffffff;
        --sidebar-text: #1e293b;
        --sidebar-hover: #f8fafc;
        --nav-bg: #ffffff;
        --nav-text: #1e293b;
        --main-bg: #f8fafc;
        --card-bg: #ffffff;
        --shadow: rgba(15, 23, 42, 0.08);
        --shadow-lg: rgba(15, 23, 42, 0.15);
        --gradient-primary: linear-gradient(135deg, var(--primary), var(--secondary));
        --gradient-light: linear-gradient(135deg, var(--primary-50), var(--primary-100));
    }

    [data-theme="dark"] {
        /* Dark Theme - Cyan */
        --primary: #22d3ee;
        --primary-light: #67e8f9;
        --primary-dark: #06b6d4;
        --primary-50: #0c4a6e;
        --primary-100: #155e75;
        --primary-200: #0e7490;
        --primary-300: #0891b2;
        --primary-400: #06b6d4;
        --secondary: #a78bfa;
        --success: #34d399;
        --warning: #fbbf24;
        --error: #f87171;
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
        --gray-700: #f1f5f9;
        --gray-800: #f8fafc;
        --gray-900: #ffffff;
        --border: #334155;
        --sidebar-bg: #1e293b;
        --sidebar-text: #f1f5f9;
        --sidebar-hover: #334155;
        --nav-bg: #1e293b;
        --nav-text: #f1f5f9;
        --main-bg: #0f172a;
        --card-bg: #1e293b;
        --shadow: rgba(0, 0, 0, 0.25);
        --shadow-lg: rgba(0, 0, 0, 0.4);


        /* Variables Bootstrap-like */
        --bs-card-spacer-y: 1rem;
        --bs-card-spacer-x: 1rem;
        --bs-card-color: inherit;
    }

    /* Reset et box-sizing */
    *, ::after, ::before {
        box-sizing: border-box;
        margin: 0px;
        padding: 0px;
    }

    * {
        transition: background-color 0.3s, color 0.3s, border-color 0.3s, transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s, box-shadow 0.3s;
    }

    /* Application de la taille de police réduite */
    .equipement-dashboard {
        background: var(--gray-50);
        min-height: 100vh;
        padding: 1.5rem;
        position: relative;
        font-size: 0.875rem;
        font-family: 'Nunito', sans-serif;
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
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 0.5rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .dashboard-subtitle {
        color: var(--gray-600);
        font-size: 1rem;
    }

    .total-badge {
        background: var(--gradient-primary);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 14px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .total-number {
        display: block;
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
    }

    .total-label {
        font-size: 0.8rem;
        opacity: 0.9;
        font-weight: 600;
    }

    /* SYSTÈME DE CARTES PRINCIPAL */
    .card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 1px 3px var(--shadow);
        border: 1px solid var(--border);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px var(--shadow-lg);
        border-color: var(--primary-light);
    }

    .card-header {
        padding: 1.25rem 1.25rem 0.75rem;
        border-bottom: 1px solid var(--border);
        background: transparent;
    }

    .card-body {
        flex: 1 1 auto;
        padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
        color: var(--bs-card-color);
        padding: 0.75rem !important;
    }

    /* GRILLE 4 COLONNES POUR LES STATISTIQUES */
    .stats-grid-4col {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    /* Cartes de statistiques */
    .stats-grid-4col .card {
        text-align: center;
        border-top: 3px solid transparent;
    }

    .stats-grid-4col .card:hover {
        border-top-color: var(--primary);
    }

    .card-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin: 0 auto 0.75rem;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .card:hover .card-icon {
        transform: scale(1.05);
    }

    .card-icon.primary {
        background: var(--gradient-primary);
    }

    .card-icon.success {
        background: linear-gradient(135deg, var(--success), #059669);
    }

    .card-icon.warning {
        background: linear-gradient(135deg, var(--warning), #d97706);
    }

    .card-icon.info {
        background: linear-gradient(135deg, var(--info), #0891b2);
    }

    .card-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 0.25rem;
        line-height: 1;
    }

    .card-label {
        color: var(--gray-600);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .card-description {
        color: var(--gray-500);
        font-size: 0.8rem;
        line-height: 1.4;
    }

    /* Cartes des Catégories */
    .categories-section {
        margin-bottom: 2rem;
    }

    .section-header {
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        position: relative;
        padding-left: 1rem;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 24px;
        background: var(--gradient-primary);
        border-radius: 2px;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.25rem;
    }

    .category-card .card-header {
        padding: 1.25rem 1.25rem 0.75rem;
        border-bottom: none;
    }

    .category-header {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .category-card .card-icon {
        margin: 0;
        width: 48px;
        height: 48px;
        font-size: 1.25rem;
    }

    .card-icon.blue { background: var(--gradient-primary); }
    .card-icon.green { background: linear-gradient(135deg, var(--success), #059669); }
    .card-icon.yellow { background: linear-gradient(135deg, var(--warning), #d97706); }
    .card-icon.purple { background: linear-gradient(135deg, var(--secondary), #7c3aed); }
    .card-icon.pink { background: linear-gradient(135deg, #ec4899, #db2777); }
    .card-icon.indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); }
    .card-icon.red { background: linear-gradient(135deg, var(--error), #dc2626); }

    .category-info {
        flex: 1;
    }

    .category-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .category-count {
        font-size: 0.85rem;
        color: var(--gray-600);
        font-weight: 600;
    }

    /* Mini Graphiques */
    .category-chart {
        display: flex;
        justify-content: center;
        margin: 1rem 0;
    }

    .mini-chart {
        width: 80px;
        height: 80px;
        position: relative;
    }

    /* Styles des mini-graphiques */
    .chart-network {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .chart-network .node {
        position: absolute;
        border-radius: 50%;
        background: var(--primary);
    }

    .chart-network .node.main {
        width: 24px;
        height: 24px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: var(--primary);
    }

    .chart-network .node.secondary {
        width: 16px;
        height: 16px;
        top: 25%;
        left: 25%;
        background: var(--primary-light);
    }

    .chart-network .node.tertiary {
        width: 16px;
        height: 16px;
        bottom: 25%;
        right: 25%;
        background: var(--primary-light);
    }

    .chart-bars {
        display: flex;
        align-items: end;
        justify-content: space-around;
        height: 100%;
        padding: 15px 10px;
    }

    .chart-bars .bar {
        width: 10px;
        background: var(--success);
        border-radius: 3px 3px 0 0;
        animation: barGrow 1.5s ease-in-out;
    }

    @keyframes barGrow {
        from { height: 0%; }
        to { height: var(--target-height); }
    }

    /* Barre de Progression */
    .category-progress {
        margin: 1rem 0;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .progress-label {
        font-size: 0.8rem;
        color: var(--gray-600);
        font-weight: 600;
    }

    .progress-percentage {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--dark);
    }

    .progress-bar-container {
        width: 100%;
        height: 6px;
        background: var(--gray-200);
        border-radius: 8px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        border-radius: 8px;
        transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        animation: shimmer 2s infinite;
    }

    .progress-bar.blue { background: var(--gradient-primary); }
    .progress-bar.green { background: linear-gradient(135deg, var(--success), #059669); }
    .progress-bar.yellow { background: linear-gradient(135deg, var(--warning), #d97706); }
    .progress-bar.purple { background: linear-gradient(135deg, var(--secondary), #7c3aed); }
    .progress-bar.pink { background: linear-gradient(135deg, #ec4899, #db2777); }
    .progress-bar.indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); }
    .progress-bar.red { background: linear-gradient(135deg, var(--error), #dc2626); }

    /* Boutons */
    .btn-card {
        background: transparent;
        color: var(--primary);
        border: 1.5px solid var(--primary-light);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        width: 100%;
        justify-content: center;
    }

    .btn-card:hover {
        background: var(--primary-50);
        transform: translateY(-1px);
    }

    .btn-card.primary {
        background: var(--gradient-primary);
        color: white;
        border: none;
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.2);
    }

    .btn-card.primary:hover {
        box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
    }

    /* Section Graphiques */
    .charts-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .chart-card .card-header {
        padding: 1.25rem 1.25rem 0.75rem;
    }

    .chart-card .card-body {
        padding: 0.75rem !important;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chart-wrapper {
        height: 250px;
    }

    /* Tableau */
    .table-card .card-header {
        padding: 1.25rem 1.25rem 0.75rem;
    }

    .table-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        width: 100%;
    }

    .table-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        min-width: 200px;
    }

    .search-input {
        width: 100%;
        padding: 0.6rem 2.5rem 0.6rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        background: var(--card-bg);
        color: var(--dark);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .search-input::placeholder {
        color: var(--gray-400);
    }

    .search-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        transition: color 0.3s ease;
    }

    .search-box:focus-within .search-icon {
        color: var(--primary);
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8rem;
        background: var(--card-bg);
    }

    .modern-table thead {
        background: var(--gradient-primary);
    }

    .modern-table thead th {
        padding: 0.875rem 1rem;
        color: white;
        font-weight: 600;
        text-align: left;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .modern-table thead th::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 16px;
        background: rgba(255, 255, 255, 0.2);
    }

    .modern-table thead th:last-child::after {
        display: none;
    }

    .modern-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: all 0.2s ease;
        background: var(--card-bg);
    }

    .modern-table tbody tr:hover {
        background: var(--gray-50);
    }

    .modern-table tbody td {
        padding: 1rem;
        color: var(--dark);
        font-weight: 500;
        transition: all 0.2s ease;
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
    }

    .category-badge.blue { background: var(--primary-50); color: var(--primary-dark); }
    .category-badge.green { background: rgba(16, 185, 129, 0.1); color: #065f46; }
    .category-badge.yellow { background: rgba(245, 158, 11, 0.1); color: #92400e; }
    .category-badge.purple { background: rgba(139, 92, 246, 0.1); color: #5b21b6; }
    .category-badge.pink { background: rgba(236, 72, 153, 0.1); color: #9d174d; }
    .category-badge.indigo { background: rgba(99, 102, 241, 0.1); color: #3730a3; }
    .category-badge.red { background: rgba(239, 68, 68, 0.1); color: #991b1b; }

    .category-icon-small {
        font-size: 0.9rem;
    }

    /* Badges de statut */
    .status-badge {
        padding: 0.3rem 0.6rem;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        text-align: center;
        min-width: 70px;
    }

    .status-active {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-inactive {
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

    .btn-edit {
        background: rgba(59, 130, 246, 0.1);
        color: var(--primary);
    }

    .btn-edit:hover {
        background: rgba(59, 130, 246, 0.2);
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

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .table-wrapper::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 8px;
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 8px;
        opacity: 0.5;
    }

    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
        opacity: 0.7;
    }

    .sortable {
        cursor: pointer;
        user-select: none;
        transition: all 0.2s ease;
    }

    .sortable:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* RESPONSIVE */
    @media (max-width: 1200px) {
        .stats-grid-4col {
            grid-template-columns: repeat(2, 1fr);
        }

        .charts-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .stats-grid-4col {
            grid-template-columns: 1fr;
        }

        .equipement-dashboard {
            padding: 1rem;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .categories-grid {
            grid-template-columns: 1fr;
        }

        .table-header-content {
            flex-direction: column;
            align-items: stretch;
        }

        .table-actions {
            justify-content: space-between;
            width: 100%;
        }

        .search-box {
            min-width: 100%;
            order: -1;
        }
    }

    @media (max-width: 480px) {
        .equipement-dashboard {
            padding: 0.75rem;
        }

        .card-body {
            padding: 0.5rem !important;
        }
    }

    /* Focus States */
    .btn-card:focus,
    .search-input:focus,
    .btn-action:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }

    /* Mode sombre */
    @media (prefers-color-scheme: dark) {
        .equipement-dashboard {
            --card-bg: #1e293b;
            --dark: #f1f5f9;
            --border: #334155;
            --gray-50: #0f172a;
            --gray-100: #1e293b;
            --gray-200: #334155;
            --gray-300: #475569;
            --gray-400: #64748b;
            --gray-500: #94a3b8;
            --gray-600: #cbd5e1;
            --shadow: rgba(0, 0, 0, 0.3);
            --shadow-lg: rgba(0, 0, 0, 0.4);
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:load', function () {
        const chartData = @json($chartData);

        // Graphique en barres
        const barCtx = document.getElementById('equipementChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Nombre d\'équipements',
                    data: chartData.data,
                    backgroundColor: chartData.colors,
                    borderColor: chartData.colors.map(color => color),
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
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

        // Graphique camembert
        const pieCtx = document.getElementById('equipementPieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: chartData.labels,
                datasets: [{
                    data: chartData.data,
                    backgroundColor: chartData.colors,
                    borderWidth: 3,
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
                            padding: 20,
                            usePointStyle: true,
                        }
                    }
                }
            }
        });
    });
</script>
