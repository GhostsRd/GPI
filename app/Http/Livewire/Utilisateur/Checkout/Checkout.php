{{-- resources/views/livewire/equipement-dashboard.blade.php --}}
<div class="equipement-dashboard" x-data="{ showFilters: false }">
    <!-- Header Principal -->
    <header class="dashboard-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="dashboard-title">📊 Tableau de Bord IT</h1>
                <p class="dashboard-subtitle">Vue d'ensemble complète de votre infrastructure informatique</p>
            </div>
            <div class="header-right">
                <div class="total-badge">
                    <span class="total-number">{{ $totalEquipements }}</span>
                    <span class="total-label">Équipements</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Actions Bar -->
    <div class="actions-bar mb-3">
        <button class="btn-refresh" wire:click="refresh" wire:loading.attr="disabled">
            <span wire:loading.remove>🔄 Rafraîchir</span>
            <span wire:loading>🔄 Chargement...</span>
        </button>
    </div>

    <!-- Messages Flash -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Contenu Principal -->
    <main class="dashboard-main">
        @if($loading)
            <!-- Loading State -->
            <div class="loading-container">
                <div class="loader-spinner"></div>
                <p class="loading-text">Chargement des données...</p>
            </div>
        @else
            <!-- Cartes Statistiques Principales -->
            <div class="stats-grid-simple">
                <!-- Carte 1: Total Équipements -->
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <span>💻</span>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalEquipements }}</div>
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
                        <div class="stat-number">{{ $categoryWithMostItems['title'] }}</div>
                        <div class="stat-label">Catégorie Majoritaire</div>
                        <div class="stat-description">{{ $categoryWithMostItems['count'] }} unités</div>
                    </div>
                </div>

                <!-- Carte 3: Moyenne par Catégorie -->
                <div class="stat-card">
                    <div class="stat-icon info">
                        <span>📊</span>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $averagePerCategory }}</div>
                        <div class="stat-label">Moyenne/Catégorie</div>
                        <div class="stat-description">Équipements moyens</div>
                    </div>
                </div>

                <!-- Carte 4: Équipements Liés -->
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                        <span>🔗</span>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $equipementsLiesCount }}</div>
                        <div class="stat-label">Équipements Liés</div>
                        <div class="stat-description">Aux utilisateurs</div>
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

            <!-- Statistiques par type -->
            <div class="type-stats-grid mb-4">
                @foreach($typeStats as $type => $stats)
                    <div class="type-stat-card">
                        <div class="type-stat-header">
                            <span class="type-icon">
                                @if($type == 'ordinateur') 💻
                                @elseif($type == 'telephone') 📱
                                @elseif($type == 'flotte') 🚗
                                @endif
                            </span>
                            <span class="type-title">{{ $stats['label'] }}</span>
                        </div>
                        <div class="type-stat-body">
                            <div class="type-stat-item">
                                <span class="stat-label">Total:</span>
                                <span class="stat-value">{{ $stats['total'] }}</span>
                            </div>
                            <div class="type-stat-item">
                                <span class="stat-label">Actifs:</span>
                                <span class="stat-value success">{{ $stats['actif'] }}</span>
                            </div>
                            <div class="type-stat-item">
                                <span class="stat-label">Réservés:</span>
                                <span class="stat-value warning">{{ $stats['reserve'] }}</span>
                            </div>
                            <div class="type-stat-item">
                                <span class="stat-label">Inactifs:</span>
                                <span class="stat-value inactive">{{ $stats['inactif'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tableau Récapitulatif des Équipements -->
            <div class="table-section">
                <div class="table-header">
                    <h3 class="table-title">📋 Récapitulatif des Équipements</h3>
                    <div class="table-actions">
                        <div class="search-box">
                            <input type="text" wire:model.live="search" placeholder="Rechercher..." class="search-input">
                            <span class="search-icon">🔍</span>
                        </div>
                    </div>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                <th>Pourcentage</th>
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

            <!-- Section Liaisons Utilisateurs -->
            <div class="table-section mt-4">
                <div class="table-header">
                    <h3 class="table-title">🔗 Équipements Liés aux Utilisateurs</h3>
                    <div class="table-actions">
                        <button class="btn-filter" @click="showFilters = !showFilters">
                            <span>🔍 Filtres</span>
                        </button>
                        <div class="search-box">
                            <input type="text" wire:model.live="searchLiaison" placeholder="Rechercher par utilisateur..." class="search-input">
                            <span class="search-icon">🔍</span>
                        </div>
                        <button class="btn-export" wire:click="exportLiaisons">
                            <span>📥 Exporter</span>
                        </button>
                        @if($searchLiaison || $filterType || $filterStatus)
                            <button class="btn-reset" wire:click="resetFilters" title="Réinitialiser les filtres">
                                <span>🔄</span>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Filtres avancés -->
                <div class="filters-panel" x-show="showFilters" x-transition>
                    <div class="filters-grid">
                        <div class="filter-item">
                            <label>Type d'équipement</label>
                            <select wire:model.live="filterType" class="filter-select">
                                <option value="">Tous les types</option>
                                @foreach($equipementTypes as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-item">
                            <label>Statut</label>
                            <select wire:model.live="filterStatus" class="filter-select">
                                <option value="">Tous les statuts</option>
                                @foreach($statusTypes as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Type Équipement</th>
                                <th>Équipement</th>
                                <th>Date Attribution</th>
                                <th>Date Retour Prévue</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($liaisons as $liaison)
                                <tr class="table-row">
                                    <td>
                                        <div class="category-info">
                                            <div class="category-badge purple">
                                                <span class="category-icon">👤</span>
                                                <span>{{ $liaison->utilisateur->nom ?? 'N/A' }} {{ $liaison->utilisateur->prenom ?? '' }}</span>
                                            </div>
                                            <small class="user-email">{{ $liaison->utilisateur->email ?? '' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="category-badge {{ $liaison->type == 'ordinateur' ? 'blue' : ($liaison->type == 'telephone' ? 'green' : 'yellow') }}">
                                            <span class="category-icon">
                                                @if($liaison->type == 'ordinateur') 💻
                                                @elseif($liaison->type == 'telephone') 📱
                                                @elseif($liaison->type == 'flotte') 🚗
                                                @endif
                                            </span>
                                            <span>{{ $equipementTypes[$liaison->type] ?? ucfirst($liaison->type) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="equipement-detail">
                                            @if($liaison->type == 'ordinateur' && $liaison->ordinateur)
                                                <strong>{{ $liaison->ordinateur->nom }}</strong>
                                                <small>{{ $liaison->ordinateur->fabricant }} {{ $liaison->ordinateur->modele }}</small>
                                                <small class="text-muted">{{ $liaison->ordinateur->numero_serie }}</small>
                                            @elseif($liaison->type == 'telephone' && $liaison->telephone)
                                                <strong>{{ $liaison->telephone->nom }}</strong>
                                                <small>{{ $liaison->telephone->marque }} {{ $liaison->telephone->modele }}</small>
                                                <small class="text-muted">{{ $liaison->telephone->imei }}</small>
                                            @elseif($liaison->type == 'flotte' && $liaison->flotte)
                                                <strong>{{ $liaison->flotte->marque }} {{ $liaison->flotte->modele }}</strong>
                                                <small>{{ $liaison->flotte->immatriculation }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-date">{{ $liaison->date_attribution ? $liaison->date_attribution->format('d/m/Y') : 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <div class="table-date">{{ $liaison->date_retour_prevue ? $liaison->date_retour_prevue->format('d/m/Y') : 'Non défini' }}</div>
                                    </td>
                                    <td>
                                        @if($liaison->statut == 'actif')
                                            <span class="status-badge active">Actif</span>
                                        @elseif($liaison->statut == 'reserve')
                                            <span class="status-badge" style="background: rgba(245, 158, 11, 0.1); color: #92400e;">Réservé</span>
                                        @else
                                            <span class="status-badge inactive">Inactif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.utilisateur.profile', $liaison->utilisateur_id) }}" class="btn-action view" title="Voir utilisateur" wire:navigate>
                                                <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </a>
                                            <button wire:click="voirDetailsLiaison({{ $liaison->id }})" class="btn-action view" title="Voir détails">
                                                <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>
                                            @if($liaison->statut == 'actif')
                                                <button wire:click="desactiverLiaison({{ $liaison->id }})" 
                                                        wire:confirm="Êtes-vous sûr de vouloir désactiver cette liaison ?"
                                                        class="btn-action delete" title="Désactiver">
                                                    <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="empty-state">
                                            <span class="empty-icon">🔗</span>
                                            <p class="empty-text">Aucun équipement lié aux utilisateurs</p>
                                            @if($searchLiaison || $filterType || $filterStatus)
                                                <button class="btn-reset mt-2" wire:click="resetFilters">
                                                    Réinitialiser les filtres
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($liaisons instanceof \Illuminate\Pagination\LengthAwarePaginator && $liaisons->hasPages())
                    <div class="pagination-container p-3 border-top">
                        {{ $liaisons->links() }}
                    </div>
                @endif
            </div>
        @endif
    </main>

    <style>
        /* Styles supplémentaires pour les nouvelles sections */
        .actions-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .btn-refresh {
            background: var(--gray-100);
            border: 1px solid var(--border);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: var(--dark);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-refresh:hover {
            background: var(--gray-200);
        }

        .btn-filter {
            background: var(--gray-100);
            border: 1px solid var(--border);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: var(--dark);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-reset {
            background: var(--gray-100);
            border: 1px solid var(--border);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .filters-panel {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            background: var(--gray-50);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .filter-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-item label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
        }

        .filter-select {
            padding: 0.5rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: white;
            font-size: 0.8rem;
        }

        .type-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .type-stat-card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 1rem;
            border: 1px solid var(--border);
        }

        .type-stat-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border);
        }

        .type-icon {
            font-size: 1.25rem;
        }

        .type-title {
            font-weight: 600;
            color: var(--dark);
        }

        .type-stat-body {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }

        .type-stat-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .type-stat-item .stat-label {
            font-size: 0.7rem;
            color: var(--gray-500);
        }

        .type-stat-item .stat-value {
            font-size: 1rem;
            font-weight: 600;
        }

        .stat-value.success { color: #10b981; }
        .stat-value.warning { color: #f59e0b; }
        .stat-value.inactive { color: #64748b; }

        .equipement-detail {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .equipement-detail strong {
            font-size: 0.8rem;
        }

        .equipement-detail small {
            font-size: 0.7rem;
            color: var(--gray-500);
        }

        .user-email {
            display: block;
            font-size: 0.7rem;
            color: var(--gray-500);
            margin-top: 0.2rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.8rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.3);
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
</div>