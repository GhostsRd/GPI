// JavaScript pour le composant tickets
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Animation des cartes de statistiques au scroll
    const statsCards = document.querySelectorAll('.stat-card');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                statsObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    statsCards.forEach(card => {
        statsObserver.observe(card);
    });

    // Gestion de la recherche avec debounce
    let searchTimeout;
    const searchInput = document.querySelector('input[wire\\:model*="search"]');

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Livewire émettra automatiquement l'événement grâce à wire:model
                console.log('Recherche:', e.target.value);
            }, 500);
        });
    }

    // Effet de glow sur les cartes de stats au hover
    statsCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 8px 25px var(--shadow-lg)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 4px 15px var(--shadow)';
        });
    });

    // Animation des icônes dans les cartes stats
    statsCards.forEach(card => {
        const icon = card.querySelector('.stat-icon');
        if (icon) {
            card.addEventListener('mouseenter', function() {
                icon.style.transform = 'scale(1.1) rotate(5deg)';
            });

            card.addEventListener('mouseleave', function() {
                icon.style.transform = 'scale(1) rotate(0deg)';
            });
        }
    });

    // Gestion des cases à cocher avec feedback visuel
    const checkboxes = document.querySelectorAll('.checkbox-modern');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.parentElement.style.backgroundColor = 'rgba(6, 182, 212, 0.05)';
            } else {
                this.parentElement.parentElement.style.backgroundColor = '';
            }
        });
    });

    // Select all functionality
    const selectAllCheckbox = document.querySelector('input[wire\\:model*="selectAll"]');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const individualCheckboxes = document.querySelectorAll('input[wire\\:model*="selectedTickets"]');
            individualCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
                checkbox.dispatchEvent(new Event('change'));
            });
        });
    }

    // Animation des lignes du tableau
    const tableRows = document.querySelectorAll('.modern-table tbody tr');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
        row.style.animation = 'fadeInUp 0.4s ease-out forwards';
        row.style.opacity = '0';
    });

    // Effet de pulsation pour les boutons d'action
    const actionButtons = document.querySelectorAll('.btn-action');
    actionButtons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.05)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Gestion des notifications
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `mynotif ${type}`;
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-danger'} me-2"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('active');
        }, 100);

        setTimeout(() => {
            notification.classList.remove('active');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 4000);
    }

    // Exposer la fonction de notification globalement
    window.showTicketNotification = showNotification;

    // Auto-hide pour les notifications existantes
    const existingNotifications = document.querySelectorAll('.mynotif');
    existingNotifications.forEach(notification => {
        if (notification.classList.contains('active')) {
            setTimeout(() => {
                notification.classList.remove('active');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 4000);
        }
    });

    // Effet de loading pour les boutons d'action
    actionButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.classList.contains('btn-delete')) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')) {
                    e.preventDefault();
                    return;
                }
            }

            const originalHtml = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.disabled = true;

            // Réinitialiser après 2 secondes (au cas où)
            setTimeout(() => {
                this.innerHTML = originalHtml;
                this.disabled = false;
            }, 2000);
        });
    });

    // Animation du sélecteur de catégorie
    const categorySelect = document.querySelector('select[wire\\:model*="categorie"]');
    if (categorySelect) {
        categorySelect.addEventListener('focus', function() {
            this.style.borderColor = 'var(--primary)';
            this.style.boxShadow = '0 0 0 3px rgba(6, 182, 212, 0.1)';
        });

        categorySelect.addEventListener('blur', function() {
            this.style.borderColor = 'var(--border)';
            this.style.boxShadow = 'none';
        });
    }

    // Effet de parallaxe léger sur le header des stats
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const statsHeader = document.querySelector('.stats-header');
        if (statsHeader) {
            const rate = scrolled * -0.1;
            statsHeader.style.transform = `translateY(${rate}px)`;
        }
    });

    // Highlight des lignes sélectionnées
    function updateSelectedRows() {
        const selectedCheckboxes = document.querySelectorAll('input[wire\\:model*="selectedTickets"]:checked');
        tableRows.forEach(row => {
            const checkbox = row.querySelector('input[wire\\:model*="selectedTickets"]');
            if (checkbox && checkbox.checked) {
                row.style.backgroundColor = 'rgba(6, 182, 212, 0.08)';
                row.style.borderLeft = '3px solid var(--primary)';
            } else {
                row.style.backgroundColor = '';
                row.style.borderLeft = '3px solid transparent';
            }
        });
    }

    // Observer les changements dans les checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedRows);
    });

    // Initialisation
    updateSelectedRows();

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + F pour focus la recherche
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            const searchInput = document.querySelector('input[wire\\:model*="search"]');
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }

        // Ctrl/Cmd + N pour nouveau ticket
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            const newTicketBtn = document.querySelector('button[wire\\:click*="openCreateModal"]');
            if (newTicketBtn) {
                newTicketBtn.click();
            }
        }
    });

    // Indicateur visuel pour les lignes avec priorité haute
    const highPriorityRows = document.querySelectorAll('.priorite_haute');
    highPriorityRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.boxShadow = 'inset 4px 0 0 var(--error)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.boxShadow = 'none';
        });
    });

    console.log('Ticket dashboard initialized successfully');
});

// Fonctions utilitaires pour les tickets
const TicketUtils = {
    // Formatage des dates
    formatDate: function(dateString) {
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        return new Date(dateString).toLocaleDateString('fr-FR', options);
    },

    // Calcul de la durée depuis la création
    getTimeSinceCreation: function(createdAt) {
        const created = new Date(createdAt);
        const now = new Date();
        const diffMs = now - created;
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

        if (diffDays === 0) {
            return "Aujourd'hui";
        } else if (diffDays === 1) {
            return "Hier";
        } else if (diffDays < 7) {
            return `Il y a ${diffDays} jours`;
        } else {
            return this.formatDate(createdAt);
        }
    },

    // Priorité en couleur
    getPriorityColor: function(priority) {
        const colors = {
            'haute': 'var(--error)',
            'moyenne': 'var(--warning)',
            'basse': 'var(--success)'
        };
        return colors[priority] || 'var(--gray-500)';
    },

    // Statut en icône
    getStatusIcon: function(status) {
        const icons = {
            'ouvert': 'fa-clock',
            'en_cours': 'fa-spinner',
            'résolu': 'fa-check-circle',
            'fermé': 'fa-lock'
        };
        return icons[status] || 'fa-question-circle';
    }
};

// Exposer les utilitaires globalement
window.TicketUtils = TicketUtils;
