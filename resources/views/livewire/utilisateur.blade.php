<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body style="background: #f5f7fb;">
<!-- Container pour les notifications -->
<div class="notification-container" id="notificationContainer"></div>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1 page-title">Dashboard Utilisateurs</h1>
                    <p class="text-muted">Gestion des utilisateurs de l'application</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary d-flex align-items-center" id="testNotificationBtn">
                        <i class="bi bi-bell me-2"></i> Tester Notification
                    </button>
                    <button class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-download me-2"></i> Exporter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon icon-primary">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h3 class="stat-number">{{ $totalUsers }}</h3>
                <p class="text-muted">Utilisateurs Totaux</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon icon-success">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h3 class="stat-number">{{ $activeUsers }}</h3>
                <p class="text-muted">Utilisateurs Actifs</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon icon-warning">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <h3 class="stat-number">{{ $inactiveUsers }}</h3>
                <p class="text-muted">Utilisateurs Inactifs</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon icon-info">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3 class="stat-number">{{ $adminUsers }}</h3>
                <p class="text-muted">Administrateurs</p>
            </div>
        </div>
    </div>

    <!-- Charts and User List -->
    <div class="row">
        <!-- Left Column - Charts -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="dashboard-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Activité des Utilisateurs</h5>
                </div>
                <div class="chart-container">
                    <canvas id="userActivityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Right Column - Recent Users -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="dashboard-card p-4">
                <h5 class="fw-bold mb-4">Utilisateurs Récents</h5>
                <div class="recent-users">
                    @foreach($recentUsers as $user)
                        <div class="d-flex align-items-center mb-3">
                            <div class="user-avatar me-3">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-medium">{{ $user->name }}</p>
                                <small class="text-muted">{{ $user->email }}</small>
                            </div>
                            <span class="badge {{ $user->isActive() ? 'badge-active' : 'badge-inactive' }}">
                            {{ $user->isActive() ? 'Actif' : 'Inactif' }}
                        </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Liste des Utilisateurs</h5>
                    <div class="d-flex gap-2">
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Rechercher..." id="searchInput">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="usersTable">
                        <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Dernière connexion</th>
                            <th>Date d'inscription</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recentUsers as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-medium">{{ $user->name }}</p>
                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                <span class="badge {{ $user->isAdmin() ? 'badge-admin' : 'badge-user' }}">
                                    {{ $user->role ?? 'Utilisateur' }}
                                </span>
                                </td>
                                <td>
                                <span class="badge {{ $user->isActive() ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $user->isActive() ? 'Actif' : 'Inactif' }}
                                </span>
                                </td>
                                <td>{{ $user->getLastLoginFormatted() }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <button class="action-btn btn-view"><i class="bi bi-eye"></i></button>
                                    <button class="action-btn btn-edit"><i class="bi bi-pencil"></i></button>
                                    <button class="action-btn btn-delete"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
