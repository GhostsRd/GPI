<div class="checkout-dashboard">
    <!-- Header -->
    <div class="checkout-header">
        <h1 class="checkout-title">Dashboard Checkout</h1>
        <div class="checkout-actions">
            <select wire:model="selectedPeriod" class="filter-select">
                <option value="today">Aujourd'hui</option>
                <option value="week">Cette semaine</option>
                <option value="month">Ce mois</option>
                <option value="year">Cette année</option>
            </select>
            <button class="btn-modern" wire:click="exportTransactions">
                <i class="fas fa-download me-2"></i>Exporter
            </button>
            <button class="btn-modern">
                <i class="fas fa-cog me-2"></i>Paramètres
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="checkout-stats-grid">
        @foreach($stats as $key => $stat)
            <div class="checkout-stat-card">
                <div class="stat-card-header">
                    <h3 class="stat-card-title">{{ str_replace('_', ' ', ucfirst($key)) }}</h3>
                    <div class="stat-card-icon">
                        <i class="{{ $stat['icon'] }}"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ $stat['value'] }}</div>
                <div class="stat-card-change {{ $stat['change_type'] === 'positive' ? 'change-positive' : 'change-negative' }}">
                    <i class="fas fa-arrow-{{ $stat['change_type'] === 'positive' ? 'up' : 'down' }}"></i>
                    {{ $stat['change'] }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Main Layout -->
    <div class="checkout-main-layout">
        <!-- Transactions Section -->
        <div class="checkout-transactions">
            <div class="transactions-header">
                <h2 class="transactions-title">Transactions Récentes</h2>
                <div class="transactions-filters">
                    <select class="filter-select">
                        <option>Toutes les transactions</option>
                        <option>Complétées seulement</option>
                        <option>En attente</option>
                    </select>
                    <select class="filter-select">
                        <option>Toutes les méthodes</option>
                        <option>Carte Bancaire</option>
                        <option>PayPal</option>
                        <option>Stripe</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="transactions-table">
                    <thead>
                    <tr>
                        <th>ID Transaction</th>
                        <th>Client</th>
                        <th>Montant</th>
                        <th>Méthode</th>
                        <th>Statut</th>
                        <th>Heure</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td class="font-mono">{{ $transaction['id'] }}</td>
                            <td>{{ $transaction['customer'] }}</td>
                            <td class="transaction-amount">{{ $transaction['amount'] }}</td>
                            <td>{{ $transaction['method'] }}</td>
                            <td>
                                    <span class="transaction-status status-{{ $transaction['status'] }}">
                                        {{ $transaction['status'] === 'completed' ? 'Complété' :
                                           ($transaction['status'] === 'pending' ? 'En attente' : 'Échoué') }}
                                    </span>
                            </td>
                            <td>{{ $transaction['date'] }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="action-btn btn-view" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($transaction['status'] === 'completed')
                                        <button class="action-btn btn-edit"
                                                wire:click="processRefund('{{ $transaction['id'] }}')"
                                                title="Rembourser">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="checkout-sidebar">
            <!-- Payment Methods -->
            <div class="payment-methods-card">
                <h3 class="payment-methods-title">Méthodes de Paiement</h3>
                <div class="payment-methods-grid">
                    @foreach($paymentMethods as $method)
                        <div class="payment-method {{ $method['active'] ? 'active' : '' }}">
                            <div class="payment-icon">
                                <i class="{{ $method['icon'] }}"></i>
                            </div>
                            <div class="payment-name">{{ $method['name'] }}</div>
                            <div class="payment-amount">{{ $method['amount'] }} ({{ $method['percentage'] }})</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity-card">
                <h3 class="recent-activity-title">Activité Récente</h3>
                <div class="activity-list">
                    @foreach($recentActivity as $activity)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="{{ $activity['icon'] }}"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">{{ $activity['title'] }}</div>
                                <div class="activity-description">{{ $activity['description'] }}</div>
                            </div>
                            <div class="activity-time">{{ $activity['time'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="checkout-analytics">
        <div class="analytics-chart">
            <h3 class="analytics-title">Performance des Paiements</h3>
            <div class="chart-container-large">
                <canvas id="paymentAnalyticsChart"></canvas>
            </div>
        </div>

        <div class="quick-actions-card">
            <h3 class="quick-actions-title">Actions Rapides</h3>
            <div class="actions-grid">
                <a href="#" class="action-button">
                    <div class="action-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="action-text">Nouveau Paiement</div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="action-button">
                    <div class="action-icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <div class="action-text">Traiter Remboursement</div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="action-button">
                    <div class="action-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-text">Rapports Détaillés</div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="action-button">
                    <div class="action-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="action-text">Paramètres Paiement</div>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment Analytics Chart
            const paymentCtx = document.getElementById('paymentAnalyticsChart').getContext('2d');
            new Chart(paymentCtx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Paiements réussis',
                        data: [120, 150, 180, 130, 200, 170, 190],
                        borderColor: '#06b6d4',
                        backgroundColor: 'rgba(6, 182, 212, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Paiements échoués',
                        data: [5, 8, 12, 6, 15, 10, 8],
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

            // Livewire event listeners
            Livewire.on('notification', (data) => {
                // Votre système de notifications
                console.log('Checkout notification:', data);
            });
        });
    </script>
@endpush
