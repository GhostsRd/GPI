// Gestion des interactions pour l'inventaire
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes de statistiques
    const statCards = document.querySelectorAll('.stats-widget');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });

    // Gestion des tooltips Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'hover'
        });
    });

    // Confirmation de suppression améliorée
    const deleteForms = document.querySelectorAll('form[action*="destroy"]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet équipement ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });

    // Gestion de la recherche en temps réel (si applicable)
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Simuler la soumission du formulaire pour Livewire
                this.form.dispatchEvent(new Event('submit', { bubbles: true }));
            }, 500);
        });
    }

    // Animation des lignes du tableau
    const tableRows = document.querySelectorAll('.table tbody tr');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
        row.classList.add('fade-in');
    });

    // Gestion des modals
    const importModal = document.getElementById('importModal');
    if (importModal) {
        importModal.addEventListener('shown.bs.modal', function () {
            const fileInput = this.querySelector('input[type="file"]');
            fileInput?.focus();
        });
    }

    // Feedback visuel pour les boutons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!this.disabled) {
                // Effet de pulsation sur clic
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            }
        });
    });

    // Gestion des états de chargement
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Chargement...';
            }
        });
    });

    // Auto-dismiss des alertes
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.classList.contains('show')) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    });

    // Amélioration de l'accessibilité
    document.addEventListener('keydown', function(e) {
        // Fermer les modals avec ESC
        if (e.key === 'Escape') {
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                const modal = bootstrap.Modal.getInstance(openModal);
                modal?.hide();
            }
        }
    });
});

// Fonctions utilitaires pour Livewire
window.equipementManager = {
    // Exporter avec feedback
    exportData: function(url) {
        const btn = event.target;
        const originalHtml = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Export...';

        // Simuler le téléchargement
        setTimeout(() => {
            window.location.href = url;
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        }, 1000);
    },

    // Importer avec progression
    importData: function(form) {
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalHtml = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Import...';

        // Ici vous pouvez ajouter une logique de progression
        // si vous utilisez Livewire avec upload
    },

    // Recherche avancée
    advancedSearch: function() {
        const form = event.target.form;
        form.dispatchEvent(new Event('submit', { bubbles: true }));
    },

    // Réinitialiser les filtres
    resetFilters: function() {
        const inputs = document.querySelectorAll('input[name="search"], select[name], input[name]');
        inputs.forEach(input => {
            if (input.name === 'search') input.value = '';
            else if (input.type === 'select') input.selectedIndex = 0;
        });

        // Soumettre le formulaire vide
        const form = document.querySelector('form[method="GET"]');
        form?.submit();
    }
};

// Support pour le mode sombre
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    document.documentElement.setAttribute('data-theme', 'dark');
}

// Observer les changements de thème
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    document.documentElement.setAttribute('data-theme', e.matches ? 'dark' : 'light');
});
