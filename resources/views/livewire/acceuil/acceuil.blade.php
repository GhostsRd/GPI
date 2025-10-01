<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Moderne</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
<div class="dashboard-container">
    <!-- En-tête avec toggle de thème -->
    <div class="theme-toggle-container">
        <button id="themeToggle" class="theme-toggle-btn">
            <i class="fas fa-moon"></i>
            <span class="theme-text">Mode sombre</span>
        </button>
    </div>

    <!-- En-tête du tableau de bord -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Tableau de bord</h1>
        <p class="dashboard-subtitle">Vue d'ensemble de votre activité</p>
    </div>

    <!-- Cartes de statistiques -->
    <div class="stats-grid">
        <!-- Carte Ticket -->
        <div class="stats-card animate-fade-in-up">
            <div class="card-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <h3 class="card-title">Tickets</h3>
            <div class="card-value">{{ $totalTickets }}</div>
            <p class="card-description">+12% par rapport au mois dernier</p>
            <div class="chart-container">
                <canvas id="ticketChart"></canvas>
            </div>
        </div>

        <!-- Carte Utilisateur -->
        <div class="stats-card animate-fade-in-up">
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="card-title">Utilisateurs</h3>
            <div class="card-value">{{ $totalUsers }}</div>
            <p class="card-description">+5 nouveaux utilisateurs cette semaine</p>
            <div class="chart-container">
                <canvas id="userChart"></canvas>
            </div>
        </div>

        <!-- Carte Tâche -->
        <div class="stats-card animate-fade-in-up">
            <div class="card-icon">
                <i class="fas fa-tasks"></i>
            </div>
            <h3 class="card-title">Tâches</h3>
            <div class="card-value">{{ $totalTasks }}</div>
            <p class="card-description">72% des tâches sont complétées</p>
            <div class="chart-container">
                <canvas id="taskChart"></canvas>
            </div>
        </div>

        <!-- Carte Inventaire -->
        <div class="stats-card animate-fade-in-up">
            <div class="card-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <h3 class="card-title">Inventaire</h3>
            <div class="card-value">{{ number_format($totalInventory) }}</div>
            <p class="card-description">15 articles en rupture de stock</p>
            <div class="chart-container">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Graphiques principaux -->
    <div class="row">
        <div class="col-lg-6">
            <div class="main-chart-card">
                <h3 class="main-chart-title">Tickets par mois</h3>
                <div class="main-chart">
                    <canvas id="monthlyTicketChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="main-chart-card">
                <h3 class="main-chart-title">Répartition des tâches</h3>
                <div class="main-chart">
                    <canvas id="taskDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des tâches récentes -->
    <h3 class="section-title">Tâches récentes</h3>
    <div class="table-modern">
        <div class="d-flex justify-content-between align-items-center p-3" style="border-bottom: 1px solid var(--border);">
            <h5 class="m-0" style="color: var(--primary);">Liste des tâches récentes</h5>
            <button class="see-more-btn" wire:click="exportData">
                Voir plus <i class="fas fa-arrow-right"></i>
            </button>
        </div>
        <table class="table table-hover m-0">
            <thead>
            <tr>
                <th>Quantité</th>
                <th>Unité</th>
                <th>Ristourne</th>
                <th>Collecteur</th>
                <th>Produit</th>
                <th>Régisseur</th>
            </tr>
            </thead>
            <tbody>
            @foreach($recentTasks as $task)
                <tr>
                    <td>{{ $task->quantity }}</td>
                    <td>{{ $task->unit }}</td>
                    <td>{{ $task->discount }}%</td>
                    <td>{{ $task->collector->name ?? 'N/A' }}</td>
                    <td>{{ $task->product->name ?? 'N/A' }}</td>
                    <td>{{ $task->manager->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

<script>
    // Livewire event listeners
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('notification', (data) => {
            if (window.dashboard) {
                // Votre système de notifications
                console.log('Notification:', data);
            }
        });
    });
</script>
</body>
</html>
