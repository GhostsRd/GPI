
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #2c5aa0;
            --secondary: #1e3a6b;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Système de notifications */
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 400px;
        }

        .notification {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            transform: translateX(400px);
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease;
            border-left: 4px solid var(--primary);
            position: relative;
            overflow: hidden;
        }

        .notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .notification.hide {
            transform: translateX(400px);
            opacity: 0;
        }

        .notification::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 5s linear;
        }

        .notification.show::before {
            transform: scaleX(1);
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            flex-shrink: 0;
        }

        .notification-success .notification-icon {
            background: var(--success);
        }

        .notification-info .notification-icon {
            background: var(--info);
        }

        .notification-warning .notification-icon {
            background: var(--warning);
        }

        .notification-error .notification-icon {
            background: var(--danger);
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .notification-message {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }

        .notification-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #aaa;
            cursor: pointer;
            transition: color 0.2s;
            flex-shrink: 0;
        }

        .notification-close:hover {
            color: var(--dark);
        }

        /* Animations générales */
        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-in-left {
            animation: slideInLeft 0.6s ease forwards;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Cards améliorées */
        .dashboard-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.1);
        }

        .stat-card {
            text-align: center;
            padding: 1.5rem;
            position: relative;
        }

        .stat-card:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 10%;
            width: 80%;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
            opacity: 0.7;
            transition: width 0.3s ease;
        }

        .stat-card:hover:after {
            width: 90%;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0.5rem 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover .stat-number {
            transform: scale(1.05);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: rotate(10deg) scale(1.1);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .icon-primary { background: linear-gradient(135deg, var(--primary) 0%, #3a6bc2 100%); color: white; }
        .icon-success { background: linear-gradient(135deg, var(--success) 0%, #34ce57 100%); color: white; }
        .icon-warning { background: linear-gradient(135deg, var(--warning) 0%, #ffd24d 100%); color: black; }
        .icon-info { background: linear-gradient(135deg, var(--info) 0%, #1fbcd3 100%); color: white; }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 18px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .badge-active { background: var(--success); color: white; padding: 0.4em 0.8em; border-radius: 12px; }
        .badge-inactive { background: var(--warning); color: black; padding: 0.4em 0.8em; border-radius: 12px; }
        .badge-admin { background: var(--primary); color: white; padding: 0.4em 0.8em; border-radius: 12px; }
        .badge-user { background: var(--info); color: white; padding: 0.4em 0.8em; border-radius: 12px; }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .action-btn {
            padding: 0.3rem 0.6rem;
            margin: 0 0.1rem;
            border: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-view { background: rgba(44, 90, 160, 0.1); color: var(--primary); }
        .btn-edit { background: rgba(40, 167, 69, 0.1); color: var(--success); }
        .btn-delete { background: rgba(220, 53, 69, 0.1); color: var(--danger); }

        .action-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--dark);
            font-weight: 600;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            font-weight: 600;
            color: var(--dark);
            padding: 1rem 0.75rem;
        }

        .table td {
            padding: 1rem 0.75rem;
            border-color: #f0f0f0;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(44, 90, 160, 0.08);
            transform: translateX(5px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(44, 90, 160, 0.2);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(44, 90, 160, 0.3);
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }

        .search-box input {
            padding-left: 40px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.1);
        }

        .recent-users .d-flex {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
            border-radius: 6px;
        }

        .recent-users .d-flex:hover {
            background-color: #f8f9fa;
            padding-left: 10px;
            padding-right: 10px;
            transform: translateX(5px);
        }

        .recent-users .d-flex:last-child {
            border-bottom: none;
        }

        /* Header styling */
        .container-fluid.py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .row.mb-4 {
            margin-bottom: 1.5rem !important;
        }

        /* Animation pour le titre */
        .page-title {
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        .page-title.animated::after {
            width: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stat-number {
                font-size: 2rem;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            .chart-container {
                height: 250px;
            }

            .search-box {
                width: 100%;
                margin-top: 10px;
            }

            .notification-container {
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }
    </style>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User Activity Chart
        const activityCtx = document.getElementById('userActivityChart').getContext('2d');
        new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Nouveaux utilisateurs',
                    data: [12, 19, 15, 25, 22, 30, 28],
                    borderColor: '#2c5aa0',
                    backgroundColor: 'rgba(44, 90, 160, 0.1)',
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

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#usersTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Animation du titre
        const pageTitle = document.querySelector('.page-title');
        setTimeout(() => {
            pageTitle.classList.add('animated');
        }, 300);

        // Système de notifications
        const notificationContainer = document.getElementById('notificationContainer');

        // Fonction pour créer une notification
        function createNotification(type, title, message, duration = 5000) {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;

            const icons = {
                success: 'bi-check-circle-fill',
                info: 'bi-info-circle-fill',
                warning: 'bi-exclamation-triangle-fill',
                error: 'bi-x-circle-fill'
            };

            notification.innerHTML = `
                <div class="notification-icon">
                    <i class="bi ${icons[type]}"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">${title}</div>
                    <p class="notification-message">${message}</p>
                </div>
                <button class="notification-close">
                    <i class="bi bi-x"></i>
                </button>
            `;

            notificationContainer.appendChild(notification);

            // Animation d'entrée
            setTimeout(() => {
                notification.classList.add('show');
            }, 10);

            // Fermeture automatique
            let timeoutId;
            if (duration > 0) {
                timeoutId = setTimeout(() => {
                    closeNotification(notification);
                }, duration);
            }

            // Fermeture manuelle
            const closeBtn = notification.querySelector('.notification-close');
            closeBtn.addEventListener('click', () => {
                clearTimeout(timeoutId);
                closeNotification(notification);
            });

            return notification;
        }

        function closeNotification(notification) {
            notification.classList.remove('show');
            notification.classList.add('hide');

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 400);
        }

        // Bouton de test de notification
        document.getElementById('testNotificationBtn').addEventListener('click', function() {
            const types = ['success', 'info', 'warning', 'error'];
            const type = types[Math.floor(Math.random() * types.length)];

            const messages = {
                success: { title: 'Succès', message: 'L\'opération s\'est terminée avec succès.' },
                info: { title: 'Information', message: 'Nouvelle mise à jour disponible.' },
                warning: { title: 'Attention', message: 'Veuillez vérifier vos paramètres.' },
                error: { title: 'Erreur', message: 'Une erreur s\'est produite lors du traitement.' }
            };

            createNotification(type, messages[type].title, messages[type].message);
        });

        // Exemple de notification automatique au chargement
        setTimeout(() => {
            createNotification('success', 'Bienvenue', 'Le tableau de bord a été chargé avec succès.', 3000);
        }, 1000);
    });
</script>
</body>
</html>
