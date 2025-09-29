<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Moderne</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #f8f9fa;
            --bg-secondary: #ffffff;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --accent-color: #4361ee;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --info-color: #7209b7;
            --border-color: #dee2e6;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            --card-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        [data-theme="dark"] {
            --bg-primary: #121212;
            --bg-secondary: #1e1e1e;
            --text-primary: #f8f9fa;
            --text-secondary: #adb5bd;
            --accent-color: #4895ef;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --info-color: #7209b7;
            --border-color: #343a40;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            --hover-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            transition: var(--transition);
            line-height: 1.6;
            font-size: 1rem;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .theme-toggle-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .theme-toggle-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 10px 20px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--shadow);
            font-weight: 500;
        }

        .theme-toggle-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--hover-shadow);
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        .dashboard-subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        .stats-card {
            background: var(--bg-secondary);
            border-radius: var(--card-radius);
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-primary);
        }

        .card-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--accent-color);
        }

        .card-description {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        .chart-container {
            position: relative;
            height: 200px;
            width: 100%;
        }

        .main-chart-card {
            background: var(--bg-secondary);
            border-radius: var(--card-radius);
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .main-chart-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--hover-shadow);
        }

        .main-chart-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        .main-chart {
            height: 300px;
            width: 100%;
        }

        .table-modern {
            background: var(--bg-secondary);
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
        }

        .table-modern thead th {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
        }

        .table-modern tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        .table-modern tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        [data-theme="dark"] .table-modern tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .see-more-btn {
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .see-more-btn:hover {
            background: var(--info-color);
            transform: translateX(5px);
            color: white;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 30px 0 20px;
            color: var(--text-primary);
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent-color);
        }

        /* Animations personnalisées */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-title {
                font-size: 1.8rem;
            }

            .card-value {
                font-size: 1.8rem;
            }
        }
    </style>
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
        <div class="stats-card animate-fade-in-up" data-aos="fade-up" data-aos-delay="100">
            <div class="card-icon" style="background: rgba(67, 97, 238, 0.1); color: #4361ee;">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <h3 class="card-title">Tickets</h3>
            <div class="card-value">1,248</div>
            <p class="card-description">+12% par rapport au mois dernier</p>
            <div class="chart-container">
                <canvas id="ticketChart"></canvas>
            </div>
        </div>

        <!-- Carte Utilisateur -->
        <div class="stats-card animate-fade-in-up" data-aos="fade-up" data-aos-delay="200">
            <div class="card-icon" style="background: rgba(236, 175, 62, 0.1); color: rgb(236, 175, 62);">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="card-title">Utilisateurs</h3>
            <div class="card-value">524</div>
            <p class="card-description">+5 nouveaux utilisateurs cette semaine</p>
            <div class="chart-container">
                <canvas id="userChart"></canvas>
            </div>
        </div>

        <!-- Carte Tâche -->
        <div class="stats-card animate-fade-in-up" data-aos="fade-up" data-aos-delay="300">
            <div class="card-icon" style="background: rgba(85, 221, 36, 0.1); color: #55dd24;">
                <i class="fas fa-tasks"></i>
            </div>
            <h3 class="card-title">Tâches</h3>
            <div class="card-value">89</div>
            <p class="card-description">72% des tâches sont complétées</p>
            <div class="chart-container">
                <canvas id="taskChart"></canvas>
            </div>
        </div>

        <!-- Carte Inventaire -->
        <div class="stats-card animate-fade-in-up" data-aos="fade-up" data-aos-delay="400">
            <div class="card-icon" style="background: rgba(206, 221, 36, 0.1); color: #cedd24;">
                <i class="fas fa-boxes"></i>
            </div>
            <h3 class="card-title">Inventaire</h3>
            <div class="card-value">2,847</div>
            <p class="card-description">15 articles en rupture de stock</p>
            <div class="chart-container">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Graphiques principaux -->
    <div class="row">
        <div class="col-lg-6">
            <div class="main-chart-card" data-aos="fade-right" data-aos-delay="500">
                <h3 class="main-chart-title">Tickets par mois</h3>
                <div class="main-chart">
                    <canvas id="monthlyTicketChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="main-chart-card" data-aos="fade-left" data-aos-delay="500">
                <h3 class="main-chart-title">Répartition des tâches</h3>
                <div class="main-chart">
                    <canvas id="taskDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des tâches récentes -->
    <h3 class="section-title">Tâches récentes</h3>
    <div class="table-modern" data-aos="fade-up" data-aos-delay="600">
        <div class="d-flex justify-content-between align-items-center p-3" style="border-bottom: 1px solid var(--border-color);">
            <h5 class="m-0" style="color: var(--accent-color);">Liste des tâches récentes</h5>
            <button class="see-more-btn">
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
            <tr>
                <td>150</td>
                <td>kg</td>
                <td>12.5%</td>
                <td>Jean Dupont</td>
                <td>Blé</td>
                <td>Marie Martin</td>
            </tr>
            <tr>
                <td>80</td>
                <td>L</td>
                <td>8.2%</td>
                <td>Sophie Leroy</td>
                <td>Lait</td>
                <td>Pierre Moreau</td>
            </tr>
            <tr>
                <td>200</td>
                <td>kg</td>
                <td>10.0%</td>
                <td>Luc Bernard</td>
                <td>Maïs</td>
                <td>Élise Petit</td>
            </tr>
            <tr>
                <td>50</td>
                <td>kg</td>
                <td>5.5%</td>
                <td>Thomas Robert</td>
                <td>Riz</td>
                <td>Nicolas Richard</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialiser AOS (Animate On Scroll)
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Gestion du thème
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = themeToggle.querySelector('i');
        const themeText = themeToggle.querySelector('.theme-text');

        // Vérifier le thème sauvegardé ou la préférence système
        const savedTheme = localStorage.getItem('theme') ||
            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        // Appliquer le thème
        document.documentElement.setAttribute('data-theme', savedTheme);
        updateThemeToggle(savedTheme);

        // Gérer le clic sur le bouton de changement de thème
        themeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeToggle(newTheme);

            // Mettre à jour les graphiques pour le nouveau thème
            updateChartsForTheme(newTheme);
        });

        function updateThemeToggle(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'fas fa-sun';
                themeText.textContent = 'Mode clair';
            } else {
                themeIcon.className = 'fas fa-moon';
                themeText.textContent = 'Mode sombre';
            }
        }

        // Créer les graphiques
        createCharts();

        // Fonction pour mettre à jour les couleurs des graphiques selon le thème
        function updateChartsForTheme(theme) {
            // Ici, vous devriez détruire et recréer les graphiques avec les nouvelles couleurs
            // Pour l'exemple, nous allons simplement recréer tous les graphiques
            createCharts();
        }

        function createCharts() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const textColor = isDark ? '#f8f9fa' : '#212529';
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';

            // Configuration commune pour les graphiques
            Chart.defaults.color = textColor;
            Chart.defaults.borderColor = gridColor;

            // Graphique pour Tickets (ligne)
            const ticketCtx = document.getElementById('ticketChart').getContext('2d');
            new Chart(ticketCtx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Tickets',
                        data: [45, 62, 54, 73, 62, 85, 91],
                        borderColor: '#4361ee',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        tension: 0.4,
                        fill: true
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
                            display: false
                        },
                        x: {
                            display: true,
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Graphique pour Utilisateurs (barres)
            const userCtx = document.getElementById('userChart').getContext('2d');
            new Chart(userCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                    datasets: [{
                        label: 'Utilisateurs',
                        data: [120, 190, 130, 170, 150, 200],
                        backgroundColor: 'rgba(236, 175, 62, 0.7)',
                        borderColor: 'rgb(236, 175, 62)',
                        borderWidth: 1
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
                            display: false
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Graphique pour Tâches (doughnut)
            const taskCtx = document.getElementById('taskChart').getContext('2d');
            new Chart(taskCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Complétées', 'En cours', 'En attente'],
                    datasets: [{
                        data: [72, 18, 10],
                        backgroundColor: [
                            'rgba(85, 221, 36, 0.7)',
                            'rgba(67, 97, 238, 0.7)',
                            'rgba(247, 37, 133, 0.7)'
                        ],
                        borderWidth: 0
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
                    cutout: '70%'
                }
            });

            // Graphique pour Inventaire (ligne)
            const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
            new Chart(inventoryCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                    datasets: [{
                        label: 'Inventaire',
                        data: [2650, 2700, 2850, 2800, 2750, 2847],
                        borderColor: '#cedd24',
                        backgroundColor: 'rgba(206, 221, 36, 0.1)',
                        tension: 0.4,
                        fill: true
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
                            display: false
                        },
                        x: {
                            display: true,
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Graphique principal : Tickets par mois (barres)
            const monthlyTicketCtx = document.getElementById('monthlyTicketChart').getContext('2d');
            new Chart(monthlyTicketCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                    datasets: [{
                        label: 'Tickets ouverts',
                        data: [120, 190, 130, 170, 150, 200, 180, 210, 190, 220, 240, 248],
                        backgroundColor: 'rgba(67, 97, 238, 0.7)',
                    }, {
                        label: 'Tickets résolus',
                        data: [80, 120, 100, 140, 110, 160, 130, 170, 150, 180, 200, 210],
                        backgroundColor: 'rgba(76, 201, 240, 0.7)',
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

            // Graphique principal : Répartition des tâches (polar area)
            const taskDistributionCtx = document.getElementById('taskDistributionChart').getContext('2d');
            new Chart(taskDistributionCtx, {
                type: 'polarArea',
                data: {
                    labels: ['Agricole', 'Pêche', 'Forestier', 'Élevage', 'Autre'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            'rgba(67, 97, 238, 0.7)',
                            'rgba(76, 201, 240, 0.7)',
                            'rgba(85, 221, 36, 0.7)',
                            'rgba(247, 37, 133, 0.7)',
                            'rgba(114, 9, 183, 0.7)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        }
    });
</script>
</body>
</html>
