// public/js/theme.js
// Appliqué AVANT le rendu pour éviter le flash (FOUC)
(function () {
    var saved = localStorage.getItem('gpi-theme') || 'light';

    // Détecter la préférence système si aucune sauvegarde
    if (!localStorage.getItem('gpi-theme')) {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            saved = 'dark';
        }
    }

    // Appliquer les deux attributs pour être compatible avec :
    //   - Bootstrap 5  → data-bs-theme
    //   - styleapp.css → data-theme
    document.documentElement.setAttribute('data-bs-theme', saved);
    document.documentElement.setAttribute('data-theme', saved);

    // Initialiser les boutons switch après chargement du DOM
    document.addEventListener('DOMContentLoaded', function () {
        _updateAllSwitches(saved);

        // Attacher l'événement sur tous les boutons .theme-toggle-btn
        document.querySelectorAll('.theme-toggle-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var current = document.documentElement.getAttribute('data-bs-theme') || 'light';
                var next = current === 'dark' ? 'light' : 'dark';

                document.documentElement.setAttribute('data-bs-theme', next);
                document.documentElement.setAttribute('data-theme', next);
                localStorage.setItem('gpi-theme', next);

                _updateAllSwitches(next);
            });
        });
    });

    function _updateAllSwitches(theme) {
        // Mise à jour des icônes lune/soleil (anciens boutons)
        document.querySelectorAll('.theme-icon-toggle').forEach(function (icon) {
            if (theme === 'dark') {
                icon.classList.remove('bi-moon');
                icon.classList.add('bi-sun');
            } else {
                icon.classList.remove('bi-sun');
                icon.classList.add('bi-moon');
            }
        });
    }
})();
