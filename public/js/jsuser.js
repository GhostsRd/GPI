// app.js - Fonctionnalités principales
class App {
    constructor() {
        this.init();
    }

    init() {
        this.initNotifications();
        this.initSearch();
        this.initAnimations();
        this.initCharts();
    }

    // Système de notifications
    initNotifications() {
        this.notificationContainer = document.getElementById('notificationContainer');

        // Créer le container s'il n'existe pas
        if (!this.notificationContainer) {
            this.notificationContainer = document.createElement('div');
            this.notificationContainer.className = 'notification-container';
            this.notificationContainer.id = 'notificationContainer';
            document.body.appendChild(this.notificationContainer);
        }
    }

    createNotification(type, title, message, duration = 5000) {
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

        this.notificationContainer.appendChild(notification);

        // Animation d'entrée
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Fermeture automatique
        let timeoutId;
        if (duration > 0) {
            timeoutId = setTimeout(() => {
                this.closeNotification(notification);
            }, duration);
        }

        // Fermeture manuelle
        const closeBtn = notification.querySelector('.notification-close');
        closeBtn.addEventListener('click', () => {
            clearTimeout(timeoutId);
            this.closeNotification(notification);
        });

        return notification;
    }

    closeNotification(notification) {
        notification.classList.remove('show');
        notification.classList.add('hide');

        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 400);
    }

    // Recherche en temps réel
    initSearch() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('#usersTable tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    }

    // Animations
    initAnimations() {
        // Animation du titre
        const pageTitle = document.querySelector('.page-title');
        if (pageTitle) {
            setTimeout(() => {
                pageTitle.classList.add('animated');
            }, 300);
        }

        // Animation des cartes au scroll
        this.initScrollAnimations();
    }

    initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observer les cartes de statistiques
        document.querySelectorAll('.stat-card').forEach(card => {
            observer.observe(card);
        });
    }

    // Initialisation des graphiques
    initCharts() {
        const activityCtx = document.getElementById('userActivityChart');
        if (activityCtx) {
            this.initUserActivityChart();
        }
    }

    initUserActivityChart() {
        const ctx = document.getElementById('userActivityChart').getContext('2d');
        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Nouveaux utilisateurs',
                    data: [12, 19, 15, 25, 22, 30, 28],
                    borderColor: '#06b6d4',
                    backgroundColor: 'rgba(6, 182, 212, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: getComputedStyle(document.documentElement).getPropertyValue('--dark').trim(),
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: getComputedStyle(document.documentElement).getPropertyValue('--border').trim()
                        },
                        ticks: {
                            color: getComputedStyle(document.documentElement).getPropertyValue('--gray-500').trim()
                        }
                    },
                    y: {
                        grid: {
                            color: getComputedStyle(document.documentElement).getPropertyValue('--border').trim()
                        },
                        ticks: {
                            color: getComputedStyle(document.documentElement).getPropertyValue('--gray-500').trim()
                        }
                    }
                }
            }
        });
    }

    // Méthode utilitaire pour tester les notifications
    testNotification(type = null) {
        const types = ['success', 'info', 'warning', 'error'];
        const selectedType = type || types[Math.floor(Math.random() * types.length)];

        const messages = {
            success: { title: 'Succès', message: 'L\'opération s\'est terminée avec succès.' },
            info: { title: 'Information', message: 'Nouvelle mise à jour disponible.' },
            warning: { title: 'Attention', message: 'Veuillez vérifier vos paramètres.' },
            error: { title: 'Erreur', message: 'Une erreur s\'est produite lors du traitement.' }
        };

        this.createNotification(selectedType, messages[selectedType].title, messages[selectedType].message);
    }
}

// Initialisation de l'application
document.addEventListener('DOMContentLoaded', function() {
    window.app = new App();

    // Bouton de test de notification
    const testBtn = document.getElementById('testNotificationBtn');
    if (testBtn) {
        testBtn.addEventListener('click', () => {
            window.app.testNotification();
        });
    }

    // Notification de bienvenue
    setTimeout(() => {
        window.app.createNotification('success', 'Bienvenue', 'Le tableau de bord a été chargé avec succès.', 3000);
    }, 1000);
});

// Gestion du responsive
window.addEventListener('resize', function() {
    // Réinitialiser les graphiques si nécessaire
    if (window.userActivityChart) {
        // Les graphiques Chart.js se redimensionnent automatiquement
    }
});
