<div class="container-fluid py-4">
    <!-- Main Table Card - Search and filters now in header -->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border-0 shadow-lg fade-in" style="border-radius: 24px; animation-delay: 0.1s; background: var(--card-bg);">
                <div class="card-header border-0 bg-transparent py-4 px-4">
                    <!-- Header with title, filters and switch -->
                    
                    <!-- Print only form header (mimicking user image) -->
                    <div class="print-only-header">
                        <div class="form-logo">
                            <img src="{{ asset('images/logoPivot.png') }}" alt="Logo">
                        </div>
                        
                        <div class="form-title-box">
                            <h1>JOURNAL DES ACTIVITÉS</h1>
                        </div>

                        <div class="form-header-blocks">
                            <div class="header-block">
                                <span class="block-title">Service demandeur</span>
                                <div class="block-content">
                                    Département : <span class="dotted-line">DSI / Support IT</span><br>
                                    Demandeur : <span class="dotted-line">{{ auth()->user()->name ?? 'Administrateur' }}</span>
                                </div>
                            </div>
                            <div class="header-block">
                                <span class="block-title">Lieu de bénéficiaire</span>
                                <div class="block-content">
                                    Site : <span class="dotted-line">Siège Principal</span><br>
                                    Période : <span class="dotted-line">du {{ now()->startOfMonth()->format('d/m/Y') }} au {{ now()->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="header-block">
                                <span class="block-title">Service Maintenance</span>
                                <div class="block-content">
                                    N° de réf : <span class="dotted-line">ACT-{{ now()->format('Ymd') }}</span><br>
                                    Date : <span class="dotted-line">{{ now()->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-4">
                        <!-- Left side: Title and counter -->
                        <div class="d-flex align-items-center">
                            <div class="stats-indicator me-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                    <i class="fas fa-list me-2"></i>{{ $activities->total() ?? 0 }} activités
                                </span>
                            </div>
                            <h5 class="fw-700 mb-0 ms-2">Historique complet</h5>
                        </div>

                        <!-- TV Display Controls -->
                        <div class="d-flex gap-2 tv-controls no-print">
                            <button class="btn btn-icon-only border-0 bg-light rounded-circle shadow-sm" id="tvModeBtn" style="width: 40px; height: 40px;" title="Mode TV">
                                <i class="fas fa-tv text-muted"></i>
                            </button>
                            <button class="btn btn-icon-only border-0 bg-light rounded-circle shadow-sm" id="fullscreenBtn" style="width: 40px; height: 40px;" title="Plein écran">
                                <i class="fas fa-expand text-muted"></i>
                            </button>
                            <button class="btn btn-icon-only border-0 bg-light rounded-circle shadow-sm" id="tvSettingsBtn" style="width: 40px; height: 40px;" title="Paramètres TV">
                                <i class="fas fa-cog text-muted"></i>
                            </button>
                        </div>

                        <!-- Center: Search and filters -->
                        <div class="d-flex flex-column flex-md-row align-items-center gap-3 flex-grow-1 justify-content-center">
                            <div class="position-relative search-input-wrapper" style="width: 100%; max-width: 350px;">
                                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <input type="text" wire:model.debounce.300ms="search" 
                                    class="form-control border-0 shadow-sm ps-5" 
                                    style="border-radius: 50px; width: 100%; height: 45px; background: var(--card-bg); border: 1px solid rgba(0,0,0,0.03) !important;" 
                                    placeholder="Rechercher une activité...">
                                @if(strlen($search) > 0)
                                <button wire:click="$set('search', '')" class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent" style="right: 5px !important;">
                                    <i class="fas fa-times-circle text-muted"></i>
                                </button>
                                @endif
                            </div>
                            
                            <div class="filter-select-wrapper">
                                <select wire:model="typeFilter" class="form-select border-0 shadow-sm" style="border-radius: 50px; width: 200px; height: 45px; background: var(--card-bg); border: 1px solid rgba(0,0,0,0.03) !important; cursor: pointer; padding-left: 20px;">
                                    <option value="all">Toutes les activités</option>
                                    <option value="ticket">🎫 Tickets uniquement</option>
                                    <option value="incident">⚠️ Incidents uniquement</option>
                                    <option value="checkout">🚪 Checkouts uniquement</option>
                                </select>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle border-0 shadow-sm d-flex align-items-center gap-2 px-4 h-45" 
                                        type="button" id="dropdownExport" data-bs-toggle="dropdown" aria-expanded="false" 
                                        style="border-radius: 50px; background: #198754;">
                                    <i class="fas fa-file-export"></i>
                                    <span class="fw-600">Exporter</span>
                                </button>
                                <ul class="dropdown-menu border-0 shadow-lg p-2" aria-labelledby="dropdownExport" style="border-radius: 15px;">
                                    <li>
                                        <button class="dropdown-item py-2 d-flex align-items-center gap-2" wire:click="exportExcel()" style="border-radius: 10px;">
                                            <i class="fas fa-file-excel text-success"></i> Excel (.xlsx)
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item py-2 d-flex align-items-center gap-2" wire:click="exportCSV()" style="border-radius: 10px;">
                                            <i class="fas fa-file-csv text-info"></i> CSV (.csv)
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item py-2 d-flex align-items-center gap-2" wire:click="exportPDF()" style="border-radius: 10px;">
                                            <i class="fas fa-file-pdf text-danger"></i> PDF (.pdf)
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Right side: Active only switch -->
                        <div class="form-check form-switch custom-switch">
                            <input class="form-check-input" type="checkbox" wire:model="onlyActive" id="activeOnly">
                            <label class="form-check-label fw-600 text-muted ms-2" for="activeOnly" style="cursor: pointer;">
                                <i class="fas fa-clock me-1"></i>En cours uniquement
                            </label>
                        </div>
                    </div>
                </div>

                <!-- TV Settings Panel -->
                <div class="tv-settings-panel" id="tvSettingsPanel">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-tv me-2"></i>Paramètres d'affichage TV - Journal des activités</h6>
                        <button class="btn-icon-only border-0 bg-transparent rounded-circle" id="closeSettingsBtn" style="width: 30px; height: 30px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mode d'affichage</label>
                            <select class="form-select" id="displayMode">
                                <option value="normal">Normal</option>
                                <option value="tv">Mode TV (Plein écran auto)</option>
                                <option value="kiosk">Mode Kiosque</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Rafraîchissement automatique</label>
                            <select class="form-select" id="autoRefresh">
                                <option value="0">Désactivé</option>
                                <option value="15">15 secondes</option>
                                <option value="30">30 secondes</option>
                                <option value="60">1 minute</option>
                                <option value="300">5 minutes</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Masquer les éléments</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hideControls">
                                <label class="form-check-label">Masquer les contrôles TV</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hideSearch">
                                <label class="form-check-label">Masquer la recherche et les filtres</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hidePagination">
                                <label class="form-check-label">Masquer la pagination</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Taille du texte</label>
                            <select class="form-select" id="textSize">
                                <option value="normal">Normal</option>
                                <option value="large">Grand</option>
                                <option value="xlarge">Très grand</option>
                            </select>
                        </div>
                        <hr>
                        <div class="d-grid gap-2">
                            <button class="btn-refresh" id="applyTVSettings">
                                <i class="fas fa-check me-2"></i>Appliquer
                            </button>
                            <button class="btn-refresh" id="exitTVMode" style="background: #ef4444;">
                                <i class="fas fa-sign-out-alt me-2"></i>Quitter mode TV
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive px-2" id="printableActivities">
                    <table class="table table-hover align-middle mb-0" id="activitiesTable">
                        <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="ps-2 py-3 border-0 text-muted small fw-700 uppercase row-number-header" style="letter-spacing: 0.05em; width: 40px;">N°</th>
                                <th class="ps-4 py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Date & Heure</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Type</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Description</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Utilisateur</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Assigné à</th>
                                <th class="py-3 border-0 text-muted small fw-700 uppercase" style="letter-spacing: 0.05em;">Statut</th>
                                <th class="text-end pe-4 py-3 border-0 text-muted small fw-700 uppercase no-print" style="letter-spacing: 0.05em;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $index => $activity)
                            <tr style="transition: all 0.2s ease;">
                                <td class="ps-2 text-center fw-bold row-number">
                                    {{ $index + 1 }}
                                </td>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="date-badge me-2">
                                            <span class="fw-700 text-dark">{{ $activity['date']->format('d') }}</span>
                                            <span class="text-muted small">{{ $activity['date']->format('M') }}</span>
                                        </div>
                                        <div>
                                            <div class="fw-600 mb-0 small">{{ $activity['date']->translatedFormat('d M Y') }}</div>
                                            <div class="text-muted small">{{ $activity['date']->format('H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $activity['color'] }} bg-opacity-10 text-{{ $activity['color'] }} px-3 py-2 rounded-pill fw-600" style="font-size: 0.72rem;">
                                        <i class="{{ $activity['icon'] }} me-2"></i>{{ $activity['type'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-700 text-dark">{{ $activity['title'] }}</div>
                                    <div class="text-muted small">ID: #{{ $activity['id'] }}</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <span class="fw-600 text-muted">{{ $activity['user'] }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted small fw-500">{{ $activity['assigned_to'] }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $activity['color'] }} px-3 py-1 rounded-pill fw-600" style="font-size: 0.68rem; letter-spacing: 0.02em;">
                                        {{ $activity['status'] }}
                                    </span>
                                </td>
                                <td class="text-end pe-4 no-print">
                                    <button class="btn btn-icon-only border-0 bg-light rounded-circle shadow-sm" style="width: 34px; height: 34px; transition: all 0.3s ease;" title="Voir les détails">
                                        <i class="fas fa-eye text-muted small"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="py-4">
                                        <div class="empty-state-icon mb-3">
                                            <i class="fas fa-search fa-4x" style="color: var(--gray-300);"></i>
                                        </div>
                                        <h6 class="fw-600 text-muted">Aucune activité trouvée</h6>
                                        <p class="text-muted small">Essayez de modifier vos filtres ou votre recherche</p>
                                        <button wire:click="resetFilters" class="btn btn-sm btn-outline-primary rounded-pill px-4 mt-2">
                                            <i class="fas fa-redo me-2"></i>Réinitialiser
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($activities->hasPages())
                <div class="card-footer border-0 bg-transparent py-4 px-4 no-print" id="paginationContainer">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="text-muted small">
                            Affichage de {{ $activities->firstItem() ?? 0 }} à {{ $activities->lastItem() ?? 0 }} sur {{ $activities->total() }} activités
                        </div>
                        <div class="pagination-custom">
                            {{ $activities->links() }}
                        </div>
                        <div class="per-page-selector">
                            <select wire:model="perPage" class="form-select form-select-sm border-0 bg-light rounded-pill" style="width: auto; cursor: pointer;">
                                <option value="10">10 par page</option>
                                <option value="25">25 par page</option>
                                <option value="50">50 par page</option>
                                <option value="100">100 par page</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Fullscreen Indicator -->
    <div class="fullscreen-indicator" id="fullscreenIndicator">
        <i class="fas fa-expand me-1"></i> Mode plein écran activé
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <script>
        let autoRefreshTimer = null;

        // Fonction pour entrer en plein écran
        function enterFullscreen() {
            const elem = document.documentElement;
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
            
            const indicator = document.getElementById('fullscreenIndicator');
            indicator.classList.add('show');
            setTimeout(() => {
                indicator.classList.remove('show');
            }, 2000);
        }

        // Fonction pour quitter le mode TV
        function exitTVMode() {
            localStorage.removeItem('tvModeActivities');
            localStorage.removeItem('autoRefreshActivities');
            localStorage.removeItem('hideControlsActivities');
            localStorage.removeItem('hideSearchActivities');
            localStorage.removeItem('hidePaginationActivities');
            localStorage.removeItem('textSizeActivities');
            localStorage.removeItem('displayModeActivities');
            
            if (autoRefreshTimer) {
                clearInterval(autoRefreshTimer);
                autoRefreshTimer = null;
            }
            
            document.body.classList.remove('tv-mode');
            
            // Afficher les éléments masqués
            document.querySelectorAll('.tv-hidden').forEach(el => {
                el.classList.remove('tv-hidden');
            });
            
            // Réinitialiser la taille du texte
            document.body.style.fontSize = '';
            document.querySelectorAll('.table td, .table th').forEach(el => {
                el.style.fontSize = '';
            });
            
            location.reload();
        }

        // Fonction pour appliquer les paramètres TV
        function applyTVSettings() {
            const displayMode = document.getElementById('displayMode').value;
            const autoRefresh = parseInt(document.getElementById('autoRefresh').value);
            const hideControls = document.getElementById('hideControls').checked;
            const hideSearch = document.getElementById('hideSearch').checked;
            const hidePagination = document.getElementById('hidePagination').checked;
            const textSize = document.getElementById('textSize').value;
            
            // Sauvegarder les paramètres
            localStorage.setItem('displayModeActivities', displayMode);
            localStorage.setItem('autoRefreshActivities', autoRefresh);
            localStorage.setItem('hideControlsActivities', hideControls);
            localStorage.setItem('hideSearchActivities', hideSearch);
            localStorage.setItem('hidePaginationActivities', hidePagination);
            localStorage.setItem('textSizeActivities', textSize);
            
            // Appliquer le mode d'affichage
            if (displayMode === 'tv' || displayMode === 'kiosk') {
                localStorage.setItem('tvModeActivities', 'true');
                document.body.classList.add('tv-mode');
                
                if (displayMode === 'kiosk') {
                    setTimeout(() => {
                        enterFullscreen();
                    }, 500);
                }
            } else {
                localStorage.removeItem('tvModeActivities');
                document.body.classList.remove('tv-mode');
            }
            
            // Appliquer le rafraîchissement automatique
            if (autoRefreshTimer) {
                clearInterval(autoRefreshTimer);
                autoRefreshTimer = null;
            }
            
            if (autoRefresh > 0) {
                autoRefreshTimer = setInterval(() => {
                    if (window.Livewire) {
                        window.Livewire.dispatch('refreshActivities');
                    }
                }, autoRefresh * 1000);
            }
            
            // Masquer les éléments
            if (hideControls) {
                document.querySelectorAll('.tv-controls').forEach(el => {
                    el.classList.add('tv-hidden');
                });
            } else {
                document.querySelectorAll('.tv-controls').forEach(el => {
                    el.classList.remove('tv-hidden');
                });
            }
            
            if (hideSearch) {
                document.querySelectorAll('.search-input-wrapper, .filter-select-wrapper, .dropdown, .custom-switch').forEach(el => {
                    el.classList.add('tv-hidden');
                });
            } else {
                document.querySelectorAll('.search-input-wrapper, .filter-select-wrapper, .dropdown, .custom-switch').forEach(el => {
                    el.classList.remove('tv-hidden');
                });
            }
            
            if (hidePagination) {
                const pagination = document.getElementById('paginationContainer');
                if (pagination) pagination.classList.add('tv-hidden');
            } else {
                const pagination = document.getElementById('paginationContainer');
                if (pagination) pagination.classList.remove('tv-hidden');
            }
            
            // Appliquer la taille du texte
            let fontSize = '';
            let tableFontSize = '';
            switch(textSize) {
                case 'large':
                    fontSize = '1.1rem';
                    tableFontSize = '0.95rem';
                    break;
                case 'xlarge':
                    fontSize = '1.2rem';
                    tableFontSize = '1rem';
                    break;
                default:
                    fontSize = '';
                    tableFontSize = '';
            }
            
            if (fontSize) {
                document.body.style.fontSize = fontSize;
                document.querySelectorAll('.table td, .table th').forEach(el => {
                    el.style.fontSize = tableFontSize;
                });
            } else {
                document.body.style.fontSize = '';
                document.querySelectorAll('.table td, .table th').forEach(el => {
                    el.style.fontSize = '';
                });
            }
            
            // Fermer le panneau
            document.getElementById('tvSettingsPanel').classList.remove('show');
            
            // Afficher une notification
            const indicator = document.getElementById('fullscreenIndicator');
            indicator.textContent = '✓ Paramètres TV appliqués';
            indicator.classList.add('show');
            setTimeout(() => {
                indicator.classList.remove('show');
                indicator.innerHTML = '<i class="fas fa-expand me-1"></i> Mode plein écran activé';
            }, 2000);
        }

        // Charger les paramètres sauvegardés
        function loadTVSettings() {
            const displayMode = localStorage.getItem('displayModeActivities');
            const autoRefresh = localStorage.getItem('autoRefreshActivities');
            const hideControls = localStorage.getItem('hideControlsActivities');
            const hideSearch = localStorage.getItem('hideSearchActivities');
            const hidePagination = localStorage.getItem('hidePaginationActivities');
            const textSize = localStorage.getItem('textSizeActivities');
            const tvMode = localStorage.getItem('tvModeActivities');
            
            if (displayMode && document.getElementById('displayMode')) {
                document.getElementById('displayMode').value = displayMode;
            }
            if (autoRefresh && document.getElementById('autoRefresh')) {
                document.getElementById('autoRefresh').value = autoRefresh;
            }
            if (hideControls && document.getElementById('hideControls')) {
                document.getElementById('hideControls').checked = hideControls === 'true';
            }
            if (hideSearch && document.getElementById('hideSearch')) {
                document.getElementById('hideSearch').checked = hideSearch === 'true';
            }
            if (hidePagination && document.getElementById('hidePagination')) {
                document.getElementById('hidePagination').checked = hidePagination === 'true';
            }
            if (textSize && document.getElementById('textSize')) {
                document.getElementById('textSize').value = textSize;
            }
            
            if (tvMode === 'true') {
                applyTVSettings();
            }
        }

        // Gestion du plein écran
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        if (fullscreenBtn) {
            fullscreenBtn.addEventListener('click', enterFullscreen);
        }

        // Gestion du mode TV
        const tvModeBtn = document.getElementById('tvModeBtn');
        if (tvModeBtn) {
            tvModeBtn.addEventListener('click', () => {
                document.getElementById('displayMode').value = 'tv';
                applyTVSettings();
            });
        }

        // Gestion du panneau des paramètres TV
        const tvSettingsBtn = document.getElementById('tvSettingsBtn');
        const tvSettingsPanel = document.getElementById('tvSettingsPanel');
        const closeSettingsBtn = document.getElementById('closeSettingsBtn');
        const applyTVSettingsBtn = document.getElementById('applyTVSettings');
        const exitTVModeBtn = document.getElementById('exitTVMode');

        if (tvSettingsBtn) {
            tvSettingsBtn.addEventListener('click', () => {
                tvSettingsPanel.classList.toggle('show');
            });
        }

        if (closeSettingsBtn) {
            closeSettingsBtn.addEventListener('click', () => {
                tvSettingsPanel.classList.remove('show');
            });
        }

        if (applyTVSettingsBtn) {
            applyTVSettingsBtn.addEventListener('click', applyTVSettings);
        }

        if (exitTVModeBtn) {
            exitTVModeBtn.addEventListener('click', exitTVMode);
        }

        // Fermer le panneau en cliquant en dehors
        document.addEventListener('click', (e) => {
            if (tvSettingsPanel && tvSettingsPanel.classList.contains('show')) {
                if (!tvSettingsPanel.contains(e.target) && !tvSettingsBtn.contains(e.target)) {
                    tvSettingsPanel.classList.remove('show');
                }
            }
        });

        // Détection de la souris pour mode TV
        let mouseTimeout;
        document.addEventListener('mousemove', () => {
            if (document.body.classList.contains('tv-mode')) {
                document.body.style.cursor = 'auto';
                clearTimeout(mouseTimeout);
                mouseTimeout = setTimeout(() => {
                    document.body.style.cursor = 'none';
                }, 3000);
            }
        });

        // Écouter l'événement d'impression
        window.addEventListener('print-activities', event => {
            window.print();
        });

        // Charger les paramètres au démarrage
        document.addEventListener('DOMContentLoaded', () => {
            loadTVSettings();
        });
    </script>

    <style>
        .print-only-header {
            display: none;
        }

        /* Mode TV */
        .tv-mode {
            cursor: none;
        }

        .tv-mode:hover {
            cursor: default;
        }

        .tv-mode .tv-hidden {
            display: none !important;
        }

        /* TV Settings Panel */
        .tv-settings-panel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            z-index: 10000;
            width: 450px;
            max-width: 90%;
            display: none;
        }

        [data-bs-theme="dark"] .tv-settings-panel {
            background: var(--gray-100);
        }

        .tv-settings-panel.show {
            display: block;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -40%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .btn-refresh {
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            border: none;
            background: var(--primary, #5BC4BF);
            color: white;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-refresh:hover {
            background: var(--primary-dark, #3A9692);
            color: white;
        }

        .fullscreen-indicator {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .fullscreen-indicator.show {
            opacity: 1;
        }

        @media print {
            body {
                background: white !important;
                color: black !important;
                font-family: 'Times New Roman', serif;
                padding: 10mm;
            }

            .print-only-header {
                display: block !important;
                width: 100%;
            }

            .form-logo {
                text-align: center;
                margin-bottom: 10px;
            }

            .form-logo img {
                height: 60px;
                object-fit: contain;
            }

            .form-title-box {
                border: 2px solid #000;
                text-align: center;
                padding: 10px;
                margin-bottom: 20px;
            }

            .form-title-box h1 {
                margin: 0;
                font-size: 1.8rem;
                font-weight: 900;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            .form-header-blocks {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                border: 1px solid #000;
                margin-bottom: 20px;
            }

            .header-block {
                padding: 5px 10px;
                border: 0.5px solid #000;
                font-size: 0.85rem;
                min-height: 80px;
            }

            .block-title {
                text-decoration: underline;
                font-weight: 700;
                display: block;
                margin-bottom: 5px;
            }

            .block-content {
                line-height: 1.4;
            }

            .dotted-line {
                border-bottom: 1px dotted #000;
                display: inline-block;
                min-width: 100px;
            }

            body * {
                visibility: hidden;
            }

            #printableActivities, #printableActivities *, .print-only-header, .print-only-header * {
                visibility: visible;
            }

            #printableActivities {
                position: static !important;
                margin-top: 0 !important;
                width: 100% !important;
            }

            .no-print {
                display: none !important;
            }

            .tv-controls, .tv-settings-panel {
                display: none !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            .table {
                width: 100% !important;
                border-collapse: collapse !important;
                border: 2px solid #000 !important;
            }

            .table th {
                background-color: #e9ecef !important;
                color: #000 !important;
                border: 1px solid #000 !important;
                padding: 8px 4px !important;
                font-size: 0.8rem !important;
                text-transform: uppercase;
            }

            .table td {
                border: 1px solid #000 !important;
                padding: 6px 4px !important;
                font-size: 0.8rem !important;
                vertical-align: middle !important;
            }

            .row-number {
                width: 30px;
                text-align: center;
                font-weight: bold;
            }

            .badge {
                border: none !important;
                background: transparent !important;
                color: #000 !important;
                padding: 0 !important;
                font-weight: normal !important;
            }

            .date-badge {
                background: transparent !important;
                border: none !important;
                padding: 0 !important;
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .avatar-sm { 
            font-size: 0.8rem; 
            transition: all 0.3s ease;
        }
        
        .custom-switch .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-icon-only {
            transition: all 0.3s ease;
        }
        
        .btn-icon-only:hover {
            transform: translateY(-2px);
            background: var(--primary) !important;
            color: white !important;
            box-shadow: 0 5px 15px rgba(79, 187, 178, 0.3) !important;
        }
        
        .btn-icon-only:hover i {
            color: white !important;
        }

        .table > :not(caption) > * > * {
            padding: 1rem 0.5rem;
        }

        tr:hover {
            background-color: rgba(79, 187, 178, 0.02) !important;
            transform: scale(1);
        }

        .uppercase {
            text-transform: uppercase;
        }

        /* Améliorations design */
        .search-input-wrapper input:focus,
        .filter-select-wrapper select:focus {
            box-shadow: 0 0 0 3px rgba(79, 187, 178, 0.1) !important;
            outline: none;
        }

        .date-badge {
            background: rgba(79, 187, 178, 0.1);
            border-radius: 8px;
            padding: 4px 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            line-height: 1.2;
            min-width: 40px;
        }

        .date-badge span:first-child {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .date-badge span:last-child {
            font-size: 0.65rem;
            text-transform: uppercase;
        }

        .pagination-custom nav .pagination {
            margin-bottom: 0;
            gap: 5px;
        }

        .pagination-custom .page-link {
            border: none;
            border-radius: 50px !important;
            margin: 0 2px;
            color: #6c757d;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .pagination-custom .page-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 187, 178, 0.3);
        }

        .pagination-custom .active .page-link {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .empty-state-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Header responsive adjustments */
        @media (max-width: 992px) {
            .card-header .d-flex {
                gap: 1rem !important;
            }
            
            .search-input-wrapper {
                max-width: 100% !important;
            }
            
            .filter-select-wrapper select {
                width: 100% !important;
            }
        }

        @media (max-width: 768px) {
            .card-header {
                padding: 1.5rem !important;
            }
            
            .filter-select-wrapper {
                width: 100%;
            }
            
            .filter-select-wrapper select {
                width: 100% !important;
            }
        }

        /* Grand écran optimizations */
        @media (min-width: 1920px) {
            .container-fluid {
                max-width: 1920px;
                margin: 0 auto;
            }
            
            .table td, .table th {
                padding: 1rem 0.75rem !important;
            }
            
            .card-header .d-flex {
                gap: 1.5rem !important;
            }
        }
    </style>
</div>