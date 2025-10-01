// dashboard.js - Fonctionnalités du Dashboard
class Dashboard {
    constructor() {
        this.init();
    }

    init() {
        this.initTheme();
        this.initCharts();
        this.initAnimations();
        this.initNotifications();
    }

    // Gestion du thème
    initTheme() {
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = themeToggle?.querySelector('i');
        const themeText = themeToggle?.querySelector('.theme-text');

        if (!themeToggle) return;

        // Vérifier le thème sauvegardé ou la préférence système
        const savedTheme = localStorage.getItem('theme') ||
            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        // Appliquer le thème
        document.documentElement.setAttribute('data-theme', savedTheme);
        this.updateThemeToggle(savedTheme, themeIcon, themeText);

        // Gérer le clic sur le bouton de changement de thème
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            this.updateThemeToggle(newTheme, themeIcon, themeText);
            this.updateChartsForTheme(newTheme);
        });
    }

    updateThemeToggle(theme, icon, text) {
        if (theme === 'dark') {
            icon.className = 'fas fa-sun';
            text.textContent = 'Mode clair';
        } else {
            icon.className = 'fas fa-moon';
            text.textContent = 'Mode sombre';
        }
    }

    // Initialisation des graphiques
    initCharts() {
        this.createMiniCharts();
        this.createMainCharts();
    }

    createMiniCharts() {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const textColor = isDark ? '#f8f9fa' : '#1e293b';
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';

        // Configuration commune
        Chart.defaults.color = textColor;
        Chart.defaults.borderColor = gridColor;

        // Graphique Tickets
        this.createTicketChart();
        this.createUserChart();
        this.createTaskChart();
        this.createInventoryChart();
    }

    createTicketChart() {
        const ctx = document.getElementById('ticketChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    data: [45, 62, 54, 73, 62, 85, 91],
                    borderColor: '#06b6d4',
                    backgroundColor: 'rgba(6, 182, 212, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: {
                        display: true,
                        grid: { display: false }
                    }
                }
            }
        });
    }

    createUserChart() {
        const ctx = document.getElementById('userChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                datasets: [{
                    data: [120, 190, 130, 170, 150, 200],
                    backgroundColor: 'rgba(6, 182, 212, 0.7)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    createTaskChart() {
        const ctx = document.getElementById('taskChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Complétées', 'En cours', 'En attente'],
                datasets: [{
                    data: [72, 18, 10],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(6, 182, 212, 0.7)',
                        'rgba(245, 158, 11, 0.7)'
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                cutout: '70%'
            }
        });
    }

    createInventoryChart() {
        const ctx = document.getElementById('inventoryChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                datasets: [{
                    data: [2650, 2700, 2850, 2800, 2750, 2847],
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: {
                        display: true,
                        grid: { display: false }
                    }
                }
            }
        });
    }

    createMainCharts() {
        this.createMonthlyTicketChart();
        this.createTaskDistributionChart();
    }

    createMonthlyTicketChart() {
        const ctx = document.getElementById('monthlyTicketChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Tickets ouverts',
                    data: [120, 190, 130, 170, 150, 200, 180, 210, 190, 220, 240, 248],
                    backgroundColor: 'rgba(6, 182, 212, 0.7)',
                }, {
                    label: 'Tickets résolus',
                    data: [80, 120, 100, 140, 110, 160, 130, 170, 150, 180, 200, 210],
                    backgroundColor: 'rgba(139, 92, 246, 0.7)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    }

    createTaskDistributionChart() {
        const ctx = document.getElementById('taskDistributionChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: ['Agricole', 'Pêche', 'Forestier', 'Élevage', 'Autre'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        'rgba(6, 182, 212, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(239, 68, 68, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right' }
                }
            }
        });
    }

    updateChartsForTheme(theme) {
        // Détruire et recréer les graphiques pour le nouveau thème
        Chart.helpers.each(Chart.instances, (chart) => {
            chart.destroy();
        });
        this.initCharts();
    }

    // Animations
    initAnimations() {
        // Animation au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stats-card, .main-chart-card, .table-modern').forEach(el => {
            observer.observe(el);
        });
    }

    // Système de notifications
    initNotifications() {
        // Votre système de notifications existant
        console.log('Système de notifications initialisé');
    }
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    window.dashboard = new Dashboard();
});

// Gestion du responsive
window.addEventListener('resize', function() {
    // Les graphiques Chart.js se redimensionnent automatiquement
});
