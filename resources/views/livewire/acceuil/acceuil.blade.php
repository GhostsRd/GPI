<div class="container-fluid py-2" style="min-height: 100vh; background: var(--gray-50); font-size: 0.7rem;">
    <!-- Assets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #5BC4BF;
            --primary-light: #d4f0ef;
            --primary-dark: #3A9692;
            --gray-50: #f8fafb;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
            --radius: 8px;
            --radius-lg: 12px;
        }

        * { font-family: 'Inter', sans-serif; }

        [data-bs-theme="dark"] {
            --gray-50: #0f172a;
            --gray-100: #1e293b;
            --gray-200: #334155;
            --gray-300: #475569;
            --gray-400: #64748b;
            --gray-500: #94a3b8;
            --gray-600: #cbd5e1;
            --gray-700: #e2e8f0;
            --gray-800: #f1f5f9;
            --gray-900: #f8fafb;
            --primary-light: #1a3a39;
        }

        [data-bs-theme="dark"] .container-fluid { background: var(--gray-50) !important; }

        /* Cards compactes */
        .card {
            background: white;
            border: none !important;
            border-radius: var(--radius-lg);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04) !important;
            transition: transform 0.15s ease;
            overflow: hidden;
        }

        [data-bs-theme="dark"] .card {
            background: var(--gray-100);
        }

        .card:hover {
            transform: translateY(-1px);
        }

        .tv-mode .card:hover {
            transform: none;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--gray-200);
            padding: 0.5rem 0.8rem;
        }

        .card-header h6 {
            color: var(--gray-800);
            font-weight: 600;
            font-size: 0.65rem;
            margin: 0;
            letter-spacing: 0.3px;
        }

        .card-body { 
            padding: 0.7rem; 
        }

        /* Stats cards compactes */
        .stat-card {
            padding: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-info h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0;
            line-height: 1.2;
        }

        .stat-info p {
            font-size: 0.55rem;
            font-weight: 500;
            color: var(--gray-500);
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .stat-icon {
            width: 28px;
            height: 28px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: var(--primary-dark);
            background: var(--primary-light);
        }

        .stat-trend {
            font-size: 0.55rem;
            margin-top: 0.2rem;
            color: var(--gray-500);
        }

        .stat-trend .up { color: #10b981; }
        .stat-trend .down { color: #ef4444; }

        /* Badges très petits */
        .badge {
            padding: 0.15rem 0.4rem;
            font-weight: 500;
            font-size: 0.55rem;
            border-radius: 4px;
            border: none;
        }

        .badge-primary {
            background: var(--primary-light);
            color: var(--primary-dark);
        }

        .badge-success {
            background: #ecfdf5;
            color: #059669;
        }

        .badge-warning {
            background: #fffbeb;
            color: #d97706;
        }

        .badge-danger {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-info {
            background: #eff6ff;
            color: #2563eb;
        }

        [data-bs-theme="dark"] .badge-primary { background: rgba(91,196,191,0.15); }
        [data-bs-theme="dark"] .badge-success { background: rgba(16,185,129,0.15); }
        [data-bs-theme="dark"] .badge-warning { background: rgba(245,158,11,0.15); }
        [data-bs-theme="dark"] .badge-danger { background: rgba(239,68,68,0.15); }
        [data-bs-theme="dark"] .badge-info { background: rgba(59,130,246,0.15); }

        .text-grey-dashboard { 
            color: #000000 !important; 
            opacity: 0.7;
        }

        /* Boutons compacts */
        .btn-icon {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            border: 1px solid var(--gray-200);
            background: white;
            color: var(--gray-600);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
            cursor: pointer;
            font-size: 0.65rem;
        }

        [data-bs-theme="dark"] .btn-icon {
            background: var(--gray-100);
            border-color: var(--gray-200);
            color: var(--gray-600);
        }

        .btn-icon:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-refresh {
            padding: 0.25rem 0.7rem;
            border-radius: 6px;
            border: none;
            background: var(--primary);
            color: white;
            font-weight: 500;
            font-size: 0.65rem;
            transition: all 0.15s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-refresh:hover {
            background: var(--primary-dark);
            color: white;
        }

        /* Tables compactes */
        .table { 
            margin-bottom: 0; 
        }

        .table thead th {
            background: var(--gray-50);
            color: var(--gray-500);
            font-weight: 600;
            font-size: 0.55rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 0.4rem 0.6rem;
            border-bottom: 1px solid var(--gray-200);
            border-top: none;
        }

        .table td {
            padding: 0.4rem 0.6rem;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
            font-size: 0.65rem;
        }

        .table tbody tr {
            transition: background 0.1s ease;
        }

        .table tbody tr:hover {
            background: var(--gray-50);
        }

        [data-bs-theme="dark"] .table thead th { background: var(--gray-200); }
        [data-bs-theme="dark"] .table td { border-color: var(--gray-200); }

        /* Progress bar fine */
        .progress {
            height: 3px;
            border-radius: 2px;
            background: var(--gray-200);
            overflow: hidden;
        }

        .progress-bar {
            background: var(--primary);
            border-radius: 2px;
        }

        /* Page header compact */
        .page-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.1rem;
        }

        .page-subtitle {
            color: var(--gray-500);
            font-size: 0.6rem;
            font-weight: 400;
        }

        /* Timeline compacte */
        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 1.5px;
            background: var(--gray-200);
            border-radius: 1px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 0.8rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 0.3rem;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--primary);
            border: 1.5px solid white;
            box-shadow: 0 0 0 1.5px var(--primary-light);
        }

        .timeline-date {
            font-size: 0.5rem;
            color: var(--gray-400);
            margin-bottom: 0.15rem;
        }

        .timeline-content {
            background: var(--gray-50);
            padding: 0.5rem 0.6rem;
            border-radius: var(--radius);
            border: 1px solid var(--gray-200);
            transition: border-color 0.15s ease;
        }

        .timeline-content:hover {
            border-color: var(--primary);
        }

        .timeline-content h6 {
            color: var(--gray-800);
            font-size: 0.65rem;
            margin-bottom: 0.2rem;
        }

        .timeline-content p {
            font-size: 0.55rem;
            margin-bottom: 0;
        }

        [data-bs-theme="dark"] .timeline-content { background: var(--gray-200); }

        /* Chart containers compacts */
        .chart-container {
            width: 100%;
            height: 200px;
        }

        .small-chart {
            height: 35px;
            width: 100%;
            margin-top: 0.3rem;
        }

        .rainbow-text {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .fw-600 { font-weight: 600; }
        .text-xs { font-size: 0.6rem; }
        .text-xxs { font-size: 0.55rem; }

        /* Form select compact */
        .form-select-sm {
            border-radius: var(--radius);
            border-color: var(--gray-200);
            font-size: 0.65rem;
            color: var(--gray-700);
            background-color: white;
            padding: 0.2rem 1.5rem 0.2rem 0.5rem;
        }

        [data-bs-theme="dark"] .form-select-sm {
            background-color: var(--gray-200);
            border-color: var(--gray-300);
            color: var(--gray-700);
        }

        /* Grille compacte */
        .row.g-3 {
            --bs-gutter-y: 0.6rem;
            --bs-gutter-x: 0.6rem;
        }

        /* Mode TV Optimizations */
        .tv-mode {
            cursor: none;
        }

        .tv-mode:hover {
            cursor: default;
        }

        .tv-mode .tv-hidden {
            display: none !important;
        }

        .tv-mode .card {
            transition: none;
        }

        /* Fullscreen indicator */
        .fullscreen-indicator {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 10px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .fullscreen-indicator.show {
            opacity: 1;
        }

        /* Large screen optimizations */
        @media (min-width: 1920px) {
            .container-fluid {
                max-width: 1920px;
                margin: 0 auto;
            }
            
            .page-title { font-size: 1.2rem; }
            .stat-info h3 { font-size: 1.2rem; }
            .card-header h6 { font-size: 0.75rem; }
            .chart-container { height: 250px; }
        }

        /* TV Settings Panel */
        .tv-settings-panel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            z-index: 10000;
            width: 350px;
            max-width: 90%;
            display: none;
        }

        [data-bs-theme="dark"] .tv-settings-panel {
            background: var(--gray-100);
        }

        .tv-settings-panel.show {
            display: block;
            animation: slideIn 0.2s ease;
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

        .tv-settings-panel .card-header {
            padding: 0.6rem 1rem;
        }

        .tv-settings-panel .card-body {
            padding: 1rem;
        }

        .tv-settings-panel .form-label {
            font-size: 0.7rem;
            margin-bottom: 0.25rem;
        }

        .tv-settings-panel .form-check-label {
            font-size: 0.65rem;
        }

        .tv-settings-panel hr {
            margin: 0.8rem 0;
        }
    </style>

    <!-- Header compact -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="page-title">Tableau de bord</h1>
            <p class="page-subtitle">Vue d'ensemble — Gestion de Parc & Support</p>
        </div>
        <div class="d-flex gap-1">
            <button class="btn-icon" id="fullscreenBtn" title="Plein écran">
                <i class="fas fa-expand"></i>
            </button>
            <button class="btn-icon" id="tvSettingsBtn" title="Paramètres TV">
                <i class="fas fa-tv"></i>
            </button>
            <button class="btn-icon" id="themeToggle">
                <i class="fas fa-moon"></i>
            </button>
            <button class="btn-refresh" wire:click="$refresh">
                <i class="fas fa-sync-alt me-1"></i>Act.
            </button>
        </div>
    </div>

    <!-- TV Settings Panel -->
    <div class="tv-settings-panel" id="tvSettingsPanel">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"><i class="fas fa-tv me-2"></i>Paramètres TV</h6>
            <button class="btn-icon btn-sm" id="closeSettingsBtn" style="width: 24px; height: 24px;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <label class="form-label fw-bold">Mode d'affichage</label>
                <select class="form-select form-select-sm" id="displayMode">
                    <option value="normal">Normal</option>
                    <option value="tv">Mode TV</option>
                    <option value="kiosk">Mode Kiosque</option>
                </select>
            </div>
            <div class="mb-2">
                <label class="form-label fw-bold">Rafraîchissement</label>
                <select class="form-select form-select-sm" id="autoRefresh">
                    <option value="0">Désactivé</option>
                    <option value="15">15 sec</option>
                    <option value="30">30 sec</option>
                    <option value="60">1 min</option>
                    <option value="300">5 min</option>
                </select>
            </div>
            <div class="mb-2">
                <label class="form-label fw-bold">Masquer</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="hideButtons">
                    <label class="form-check-label">Boutons d'action</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="hideHeader">
                    <label class="form-check-label">En-tête</label>
                </div>
            </div>
            <hr>
            <div class="d-grid gap-2">
                <button class="btn-refresh" id="applyTVSettings">
                    <i class="fas fa-check me-1"></i>Appliquer
                </button>
                <button class="btn-refresh" id="exitTVMode" style="background: #ef4444;">
                    <i class="fas fa-sign-out-alt me-1"></i>Quitter
                </button>
            </div>
        </div>
    </div>

    <!-- Fullscreen Indicator -->
    <div class="fullscreen-indicator" id="fullscreenIndicator">
        <i class="fas fa-expand me-1"></i> Plein écran
    </div>

    @php
        $hasPrimaryData = ($stats['total_incidents'] ?? 0) > 0 || 
                          ($stats['total_tickets'] ?? 0) > 0 || 
                          ($stats['total_equipments'] ?? 0) > 0 || 
                          ($stats['total_sims'] ?? 0) > 0 || 
                          ($stats['total_checkouts'] ?? 0) > 0;
        
        $hasSecondaryData = ($stats['active_users'] ?? 0) > 0 || 
                            ($stats['total_software'] ?? 0) > 0 || 
                            ($stats['resolution_rate'] ?? 0) > 0 || 
                            ($stats['average_rating'] ?? 0) > 0;
    @endphp

    @if($hasPrimaryData)
    <!-- Stats Cards Principales - TOUTES UNIFORMISÉES -->
    <div class="row g-3 mb-3">
    <!-- Incidents -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Incidents</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ number_format($stats['total_incidents'] ?? 0) }}</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-exclamation-triangle text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1">
                    <span class="badge bg-white text-danger fw-bold me-1 text-xxs">{{ $stats['incidents_trend'] ?? '+0%' }}</span>
                    <span class="text-grey-dashboard text-xxs">cette semaine</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tickets -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Tickets</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ number_format($stats['total_tickets'] ?? 0) }}</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-ticket-alt text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1 text-grey-dashboard text-xxs">
                    <i class="fas fa-clock me-1"></i> {{ number_format($stats['pending_tickets'] ?? 0) }} en attente
                </div>
            </div>
        </div>
    </div>

    <!-- Équipements -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Équipements</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ number_format($stats['total_equipments'] ?? 0) }}</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-laptop text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1 text-grey-dashboard text-xxs">
                    <i class="fas fa-check-circle me-1"></i> {{ number_format($stats['available_equipments'] ?? 0) }} disponibles
                </div>
            </div>
        </div>
    </div>

    <!-- SIM Flotte -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Flotte SIM</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ number_format($stats['total_sims'] ?? 0) }}</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-sim-card text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1 text-grey-dashboard text-xxs">
                    <i class="fas fa-user-tag me-1"></i> {{ number_format($stats['assigned_sims'] ?? 0) }} attribuées
                </div>
            </div>
        </div>
    </div>

    <!-- Sorties -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Sorties</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ number_format($stats['total_checkouts'] ?? 0) }}</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-exchange-alt text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1 text-grey-dashboard text-xxs">
                    <i class="fas fa-arrow-right me-1"></i> {{ number_format($stats['pending_checkouts'] ?? 0) }} en attente
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($hasSecondaryData)
    <!-- Stats Cards Secondaires - TOUTES UNIFORMISÉES (même taille que les principales) -->
    <div class="row g-3 mb-3">
    <!-- Utilisateurs -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Utilisateurs</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ number_format($stats['active_users'] ?? 0) }}</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1">
                    <span class="badge bg-white text-dark fw-bold me-1 text-xxs">+{{ number_format($stats['new_users'] ?? 0) }}</span>
                    <span class="text-grey-dashboard text-xxs">ce mois</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Logiciels -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Logiciels</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ number_format($stats['total_software'] ?? 0) }}</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-code text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1 text-grey-dashboard text-xxs">
                    <i class="fas fa-key me-1"></i> {{ number_format($stats['total_licenses'] ?? 0) }} licences
                </div>
            </div>
        </div>
    </div>

    <!-- Résolution -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #2dd4bf 0%, #0d9488 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Résolution</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ $stats['resolution_rate'] ?? 0 }}%</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-chart-line text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="progress mt-1" style="height: 3px;">
                    <div class="progress-bar bg-white" style="width: {{ $stats['resolution_rate'] ?? 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Satisfaction -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Satisfaction</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">{{ number_format($stats['average_rating'] ?? 0, 1) }}/5</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-smile text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1 text-grey-dashboard text-xxs">
                    <i class="fas fa-star text-white me-1"></i> {{ number_format($stats['total_feedbacks'] ?? 0) }} avis
                </div>
            </div>
        </div>
    </div>

    <!-- Performance -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Performance</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">99.9%</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-server text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="progress mt-1" style="height: 3px; background: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" style="width: 99%;"></div>
                </div>
                <div class="mt-1 text-grey-dashboard text-xxs">
                    <i class="fas fa-check-circle me-1"></i> Services opérationnels
                </div>
            </div>
        </div>
    </div>

    <!-- Temps réponse -->
    <div class="col-md-6 col-xl-2-4 col-xxl-2">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-grey-dashboard text-xxs text-uppercase mb-0">Temps réponse</p>
                        <h3 class="fw-bold mb-0 text-white" style="font-size: 1rem;">12m</h3>
                    </div>
                    <div class="rounded-circle p-1" style="background: rgba(255,255,255,0.2); width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-bolt text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
                <div class="mt-1">
                    <span class="badge bg-white text-pink fw-bold me-1 text-xxs">-15%</span>
                    <span class="text-grey-dashboard text-xxs">vs hier</span>
                </div>
            </div>
        </div>
    </div>
    @endif

 

    <!-- Graphiques -->
    <div class="row g-3 mb-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">📈 Évolution tickets & incidents</h6>
                    <span class="badge badge-primary text-xxs">{{ $stats['tickets_growth'] ?? '+0%' }} vs mois dernier</span>
                </div>
                <div class="card-body">
                    <div id="chartTicketsIncidents" class="chart-container"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">📊 Activité sorties & retours</h6>
                    <span class="badge badge-primary text-xxs">{{ $stats['checkouts_growth'] ?? '+0%' }} vs mois dernier</span>
                </div>
                <div class="card-body">
                    <div id="chartCheckoutsReturns" class="chart-container"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row g-3 mb-3">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">🖥️ Équipements par type</h6>
                    <span class="badge badge-primary text-xxs">Total: {{ number_format($stats['total_equipments'] ?? 0) }}</span>
                </div>
                <div class="card-body">
                    <div id="chartEquipments" class="chart-container"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">💿 Logiciels par catégorie</h6>
                    <span class="badge badge-primary text-xxs">{{ number_format($stats['total_licenses'] ?? 0) }} licences</span>
                </div>
                <div class="card-body">
                    <div id="chartSoftware" class="chart-container"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">⚠️ Incidents par priorité</h6>
                    <span class="badge badge-primary text-xxs">{{ number_format($stats['total_incidents'] ?? 0) }} incidents</span>
                </div>
                <div class="card-body">
                    <div id="chartIncidentsPriority" class="chart-container"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableaux -->
    <div class="row g-3 mb-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">🎫 Derniers tickets</h6>
                    <a href="{{ route('ticket') }}" class="btn-refresh text-decoration-none tv-hidden" style="padding: 0.2rem 0.5rem; font-size: 0.55rem;">
                        <i class="fas fa-eye me-1"></i>Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-3">ID</th>
                                <th>Titre</th>
                                <th>Priorité</th>
                                <th>Statut</th>
                                <th class="text-end pe-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTickets as $ticket)
                            <tr>
                                <td class="ps-3 text-xxs">#{{ $ticket['id'] }}</td>
                                <td class="text-xs">{{ Str::limit($ticket['title'], 25) }}</td>
                                <td>
                                    @php
                                        $priorityClass = match($ticket['priority']) {
                                            'Haute', 'Critique', 'Élevée' => 'danger',
                                            'Moyenne' => 'warning',
                                            'Basse' => 'success',
                                            default => 'primary'
                                        };
                                    @endphp
                                    <span class="badge badge-{{ $priorityClass }}">{{ $ticket['priority'] }}</span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($ticket['status']) {
                                            'Ouvert' => 'primary',
                                            'En cours' => 'warning',
                                            'Résolu', 'Fermé' => 'success',
                                            default => 'primary'
                                        };
                                    @endphp
                                    <span class="badge badge-{{ $statusClass }}">{{ $ticket['status'] }}</span>
                                </td>
                                <td class="text-end pe-3 text-xxs">{{ $ticket['date'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-2">
                                    <p class="text-muted mb-0 text-xxs">Aucun ticket récent</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">🚨 Derniers incidents</h6>
                    <a href="{{ route('admin.incident.list') }}" class="btn-refresh text-decoration-none tv-hidden" style="padding: 0.2rem 0.5rem; font-size: 0.55rem;">
                        <i class="fas fa-eye me-1"></i>Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-3">ID</th>
                                <th>Titre</th>
                                <th>Priorité</th>
                                <th>Statut</th>
                                <th class="text-end pe-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentIncidents as $incident)
                            <tr>
                                <td class="ps-3 text-xxs">#{{ $incident['id'] }}</td>
                                <td class="text-xs">{{ Str::limit($incident['title'], 25) }}</td>
                                <td>
                                    @php
                                        $priorityClass = match($incident['priority']) {
                                            'Critique' => 'danger',
                                            'Élevée', 'Haute' => 'warning',
                                            'Moyenne' => 'primary',
                                            'Basse' => 'success',
                                            default => 'primary'
                                        };
                                    @endphp
                                    <span class="badge badge-{{ $priorityClass }}">{{ $incident['priority'] }}</span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($incident['status']) {
                                            'Ouvert' => 'danger',
                                            'En cours' => 'warning',
                                            'Résolu' => 'success',
                                            default => 'primary'
                                        };
                                    @endphp
                                    <span class="badge badge-{{ $statusClass }}">{{ $incident['status'] }}</span>
                                </td>
                                <td class="text-end pe-3 text-xxs">{{ $incident['date'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-2">
                                    <p class="text-muted mb-0 text-xxs">Aucun incident récent</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Derniers équipements et sorties -->
    <div class="row g-3 mb-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">🖥️ Derniers équipements</h6>
                    <a href="{{ route('equipement') }}" class="btn-refresh text-decoration-none tv-hidden" style="padding: 0.2rem 0.5rem; font-size: 0.55rem;">
                        <i class="fas fa-eye me-1"></i>Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-3">Nom</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Attribué à</th>
                                <th class="text-end pe-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentEquipments as $equipment)
                            <tr>
                                <td class="ps-3 text-xs">{{ Str::limit($equipment['name'], 20) }}</td>
                                <td class="text-xxs">{{ $equipment['type'] }}</td>
                                <td>
                                    @php
                                        $statusClass = match($equipment['status']) {
                                            'Disponible' => 'success',
                                            'Attribué' => 'primary',
                                            'En maintenance' => 'warning',
                                            'Hors service' => 'danger',
                                            default => 'primary'
                                        };
                                    @endphp
                                    <span class="badge badge-{{ $statusClass }}">{{ $equipment['status'] }}</span>
                                </td>
                                <td class="text-xxs">{{ Str::limit($equipment['assigned_to'] ?? '-', 15) }}</td>
                                <td class="text-end pe-3 text-xxs">{{ $equipment['date_added'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-2">
                                    <p class="text-muted mb-0 text-xxs">Aucun équipement récent</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">📤 Dernières sorties</h6>
                    <a href="{{ route('checkoutadmin') }}" class="btn-refresh text-decoration-none tv-hidden" style="padding: 0.2rem 0.5rem; font-size: 0.55rem;">
                        <i class="fas fa-eye me-1"></i>Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-3">Équipement</th>
                                <th>Utilisateur</th>
                                <th>Date sortie</th>
                                <th>Retour prévu</th>
                                <th class="text-end pe-3">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentCheckouts as $checkout)
                            <tr>
                                <td class="ps-3 text-xs">{{ Str::limit($checkout['equipment'], 20) }}</td>
                                <td class="text-xxs">{{ Str::limit($checkout['user'], 15) }}</td>
                                <td class="text-xxs">{{ $checkout['checkout_date'] }}</td>
                                <td class="text-xxs">{{ $checkout['expected_return'] ?? 'N/A' }}</td>
                                <td class="text-end pe-3">
                                    @php
                                        $today = \Carbon\Carbon::now();
                                        $expectedReturn = $checkout['expected_return'] ?? null;
                                        $daysLeft = 999;
                                        if ($expectedReturn && $expectedReturn !== 'N/A') {
                                            try {
                                                $returnDate = \Carbon\Carbon::createFromFormat('d/m/Y', $expectedReturn);
                                                $daysLeft = $today->diffInDays($returnDate, false);
                                            } catch(\Exception $e) { $daysLeft = 999; }
                                        }
                                    @endphp
                                    @if($daysLeft < 0)
                                        <span class="badge badge-danger">En retard</span>
                                    @elseif($daysLeft <= 2)
                                        <span class="badge badge-warning">Bientôt</span>
                                    @else
                                        <span class="badge badge-success">En cours</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-2">
                                    <p class="text-muted mb-0 text-xxs">Aucune sortie récente</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique des activités -->
    <div class="row g-3 mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">📋 Historique des activités</h6>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="badge badge-primary text-xxs">{{ count($unifiedActivities ?? []) }} événements</span>
                        <a href="{{ route('admin.activites') }}" class="btn-refresh text-decoration-none tv-hidden" style="padding: 0.2rem 0.5rem; font-size: 0.55rem;">
                            <i class="fas fa-eye me-1"></i>Voir tous
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="timeline p-3">
                        @forelse(collect($unifiedActivities ?? [])->take(10) as $activity)
                        <div class="timeline-item">
                            <div class="timeline-date">
                                <i class="far fa-clock me-1"></i>
                                {{ $activity['date'] ?? '' }}
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <span class="badge badge-{{ $activity['color'] ?? 'primary' }} mb-1">
                                            <i class="{{ $activity['icon'] ?? 'fas fa-bell' }} me-1"></i>
                                            {{ ucfirst($activity['type'] ?? 'Activité') }}
                                        </span>
                                        <h6 class="mb-1">{{ $activity['title'] ?? '' }}</h6>
                                        <p class="text-muted mb-0 text-xxs">{{ $activity['description'] ?? '' }}</p>
                                    </div>
                                    <div class="text-end ms-2">
                                        <small class="text-muted text-xxs">{{ $activity['user'] ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-3">
                            <i class="fas fa-history fa-2x mb-2" style="color: var(--gray-300);"></i>
                            <p class="text-muted mb-0 text-xxs">Aucune activité récente</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        let charts = {};
        let refreshInterval = null;
        let autoRefreshTimer = null;

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

        function exitTVMode() {
            localStorage.removeItem('tvMode');
            localStorage.removeItem('autoRefresh');
            localStorage.removeItem('hideButtons');
            localStorage.removeItem('hideHeader');
            localStorage.removeItem('qualityMode');
            
            if (autoRefreshTimer) {
                clearInterval(autoRefreshTimer);
                autoRefreshTimer = null;
            }
            
            document.body.classList.remove('tv-mode');
            
            document.querySelectorAll('.tv-hidden').forEach(el => {
                el.classList.remove('tv-hidden');
            });
            
            if (document.querySelector('.tv-header-hidden')) {
                document.querySelector('.page-title').parentElement.classList.remove('tv-hidden');
            }
            
            location.reload();
        }

        function applyTVSettings() {
            const displayMode = document.getElementById('displayMode').value;
            const autoRefresh = parseInt(document.getElementById('autoRefresh').value);
            const hideButtons = document.getElementById('hideButtons').checked;
            const hideHeader = document.getElementById('hideHeader').checked;
            
            localStorage.setItem('displayMode', displayMode);
            localStorage.setItem('autoRefresh', autoRefresh);
            localStorage.setItem('hideButtons', hideButtons);
            localStorage.setItem('hideHeader', hideHeader);
            
            if (displayMode === 'tv' || displayMode === 'kiosk') {
                localStorage.setItem('tvMode', 'true');
                document.body.classList.add('tv-mode');
                
                if (displayMode === 'kiosk') {
                    setTimeout(() => {
                        enterFullscreen();
                    }, 500);
                }
            } else {
                localStorage.removeItem('tvMode');
                document.body.classList.remove('tv-mode');
            }
            
            if (autoRefreshTimer) {
                clearInterval(autoRefreshTimer);
                autoRefreshTimer = null;
            }
            
            if (autoRefresh > 0) {
                autoRefreshTimer = setInterval(() => {
                    if (window.Livewire) {
                        window.Livewire.dispatch('refreshCharts');
                    }
                    initCharts();
                }, autoRefresh * 1000);
            }
            
            if (hideButtons) {
                document.querySelectorAll('.btn-refresh:not(.tv-force-show), .btn-icon:not(.tv-force-show)').forEach(el => {
                    el.classList.add('tv-hidden');
                });
            } else {
                document.querySelectorAll('.tv-hidden').forEach(el => {
                    if (!el.classList.contains('tv-force-hidden')) {
                        el.classList.remove('tv-hidden');
                    }
                });
            }
            
            if (hideHeader) {
                document.querySelector('.page-title')?.parentElement?.classList.add('tv-hidden');
            } else {
                document.querySelector('.page-title')?.parentElement?.classList.remove('tv-hidden');
            }
            
            document.getElementById('tvSettingsPanel').classList.remove('show');
            
            const indicator = document.getElementById('fullscreenIndicator');
            indicator.textContent = '✓ Paramètres TV appliqués';
            indicator.classList.add('show');
            setTimeout(() => {
                indicator.classList.remove('show');
                indicator.textContent = '<i class="fas fa-expand me-1"></i> Plein écran';
            }, 2000);
        }

        function loadTVSettings() {
            const displayMode = localStorage.getItem('displayMode');
            const autoRefresh = localStorage.getItem('autoRefresh');
            const hideButtons = localStorage.getItem('hideButtons');
            const hideHeader = localStorage.getItem('hideHeader');
            const tvMode = localStorage.getItem('tvMode');
            
            if (displayMode && document.getElementById('displayMode')) {
                document.getElementById('displayMode').value = displayMode;
            }
            if (autoRefresh && document.getElementById('autoRefresh')) {
                document.getElementById('autoRefresh').value = autoRefresh;
            }
            if (hideButtons && document.getElementById('hideButtons')) {
                document.getElementById('hideButtons').checked = hideButtons === 'true';
            }
            if (hideHeader && document.getElementById('hideHeader')) {
                document.getElementById('hideHeader').checked = hideHeader === 'true';
            }
            
            if (tvMode === 'true') {
                applyTVSettings();
            }
        }

        function initCharts() {
            try {
                const dataTickets = @json($monthlyTickets ?? []);
                const dataIncidents = @json($monthlyIncidents ?? []);
                const dataCheckouts = @json($monthlyCheckouts ?? []);
                const dataEquip = @json($equipmentByType ?? []);
                const dataSoft = @json($softwareByCategory ?? []);
                const priorityData = @json($incidentsByPriority ?? []);

                for (let key in charts) {
                    if (charts[key] && typeof charts[key].destroy === 'function') {
                        try { charts[key].destroy(); } catch(e) {}
                    }
                }
                charts = {};

                const baseOptions = {
                    chart: {
                        toolbar: { show: false },
                        animations: { enabled: true, speed: 600 },
                        background: 'transparent'
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 2 },
                    fill: { 
                        opacity: 1, 
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: "vertical",
                            shadeIntensity: 0.25,
                            gradientToColors: ['#3A9692'],
                            inverseColors: true,
                            opacityFrom: 0.4,
                            opacityTo: 0.05,
                            stops: [0, 100]
                        }
                    },
                    colors: ['#5BC4BF', '#94a3b8', '#3A9692', '#cbd5e1'],
                    grid: {
                        borderColor: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#374151' : '#e5e7eb',
                        strokeDashArray: 3,
                    },
                    xaxis: {
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: { 
                            style: { 
                                colors: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280',
                                fontSize: '9px',
                                fontWeight: 500
                            }
                        }
                    },
                    yaxis: {
                        labels: { 
                            style: { 
                                colors: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280',
                                fontSize: '9px',
                                fontWeight: 500
                            }
                        }
                    },
                    tooltip: { 
                        theme: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'dark' : 'light',
                        style: { fontSize: '10px' }
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontSize: '9px',
                        fontWeight: 500,
                        itemMargin: { horizontal: 5, vertical: 2 },
                        labels: {
                            colors: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280'
                        }
                    }
                };

                // Tickets/Incidents
                if (document.getElementById('chartTicketsIncidents')) {
                    const ticketsData = Object.values(dataTickets);
                    const incidentsData = Object.values(dataIncidents);
                    const categories = Object.keys(dataTickets).length > 0 ? Object.keys(dataTickets) : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'];
                    
                    charts.ticketsIncidents = new ApexCharts(document.getElementById('chartTicketsIncidents'), {
                        ...baseOptions,
                        series: [
                            { name: 'Tickets', data: ticketsData.length ? ticketsData : [12, 19, 15, 25, 30, 35] },
                            { name: 'Incidents', data: incidentsData.length ? incidentsData : [8, 12, 10, 18, 22, 25] }
                        ],
                        chart: { ...baseOptions.chart, type: 'area', height: 200 },
                        xaxis: { ...baseOptions.xaxis, categories: categories }
                    });
                    charts.ticketsIncidents.render();
                }

                // Sorties
                if (document.getElementById('chartCheckoutsReturns')) {
                    const checkoutsData = Object.values(dataCheckouts);
                    const categories = Object.keys(dataCheckouts).length > 0 ? Object.keys(dataCheckouts) : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'];
                    
                    charts.checkoutsReturns = new ApexCharts(document.getElementById('chartCheckoutsReturns'), {
                        ...baseOptions,
                        series: [{ name: 'Sorties', data: checkoutsData.length ? checkoutsData : [5, 8, 12, 15, 20, 25] }],
                        chart: { ...baseOptions.chart, type: 'bar', height: 200 },
                        plotOptions: { bar: { borderRadius: 4, columnWidth: '60%' } },
                        xaxis: { ...baseOptions.xaxis, categories: categories }
                    });
                    charts.checkoutsReturns.render();
                }

                // Équipements
                if (document.getElementById('chartEquipments') && Object.keys(dataEquip).length > 0) {
                    const values = Object.values(dataEquip).map(v => Number(v) || 0);
                    const sum = values.reduce((a, b) => a + b, 0);
                    
                    charts.equipments = new ApexCharts(document.getElementById('chartEquipments'), {
                        ...baseOptions,
                        series: sum > 0 ? values : [1],
                        labels: Object.keys(dataEquip).length ? Object.keys(dataEquip) : ['Aucune donnée'],
                        chart: { ...baseOptions.chart, type: 'donut', height: 200 },
                        colors: ['#5BC4BF', '#94a3b8', '#3A9692', '#cbd5e1', '#7ED6D3'],
                        plotOptions: { pie: { donut: { size: '65%' } } },
                        legend: { position: 'bottom', fontSize: '8px' },
                        dataLabels: { enabled: false }
                    });
                    charts.equipments.render();
                }

                // Logiciels
                if (document.getElementById('chartSoftware') && Object.keys(dataSoft).length > 0) {
                    const values = Object.values(dataSoft).map(v => Number(v) || 0);
                    const sum = values.reduce((a, b) => a + b, 0);

                    charts.software = new ApexCharts(document.getElementById('chartSoftware'), {
                        ...baseOptions,
                        series: sum > 0 ? values : [1],
                        labels: Object.keys(dataSoft).length ? Object.keys(dataSoft) : ['Aucune donnée'],
                        chart: { ...baseOptions.chart, type: 'pie', height: 200 },
                        colors: ['#5BC4BF', '#94a3b8', '#3A9692', '#cbd5e1', '#7ED6D3'],
                        legend: { position: 'bottom', fontSize: '8px' },
                        dataLabels: { enabled: false }
                    });
                    charts.software.render();
                }

                // Incidents priorité
                if (document.getElementById('chartIncidentsPriority') && Object.keys(priorityData).length > 0) {
                    const values = Object.values(priorityData).map(v => Number(v) || 0);
                    const sum = values.reduce((a, b) => a + b, 0);

                    charts.priority = new ApexCharts(document.getElementById('chartIncidentsPriority'), {
                        ...baseOptions,
                        series: sum > 0 ? values : [1],
                        labels: Object.keys(priorityData).length ? Object.keys(priorityData) : ['Aucune donnée'],
                        chart: { ...baseOptions.chart, type: 'polarArea', height: 200 },
                        colors: ['#dc2626', '#d97706', '#5BC4BF', '#2563eb', '#7c3aed'],
                        fill: { opacity: 0.8 },
                        legend: { position: 'bottom', fontSize: '8px' },
                        dataLabels: { enabled: true, style: { fontSize: '9px', fontWeight: 600 } }
                    });
                    charts.priority.render();
                }
            } catch(e) {
                console.error('Erreur charts:', e);
            }
        }

        // Theme toggle
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const html = document.documentElement;
                const theme = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-bs-theme', theme);
                localStorage.setItem('theme', theme);
                
                const icon = document.querySelector('#themeToggle i');
                if (icon) {
                    icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                }

                const textColor = theme === 'dark' ? '#9ca3af' : '#6b7280';
                const gridColor = theme === 'dark' ? '#374151' : '#e5e7eb';
                
                Object.values(charts).forEach(chart => {
                    if (chart && chart.updateOptions) {
                        chart.updateOptions({
                            grid: { borderColor: gridColor },
                            xaxis: { labels: { style: { colors: textColor } } },
                            yaxis: { labels: { style: { colors: textColor } } },
                            tooltip: { theme: theme === 'dark' ? 'dark' : 'light' },
                            legend: { labels: { colors: textColor } }
                        });
                    }
                });
            });
        }

        // Fullscreen
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        if (fullscreenBtn) {
            fullscreenBtn.addEventListener('click', enterFullscreen);
        }

        // TV Settings
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

        document.addEventListener('click', (e) => {
            if (tvSettingsPanel && tvSettingsPanel.classList.contains('show')) {
                if (!tvSettingsPanel.contains(e.target) && !tvSettingsBtn.contains(e.target)) {
                    tvSettingsPanel.classList.remove('show');
                }
            }
        });

        // Mouse detection for TV mode
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

        // Initialization
        document.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', saved);
            const icon = document.querySelector('#themeToggle i');
            if (icon) {
                icon.className = saved === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            }
            
            loadTVSettings();
            initCharts();
        });

        // Livewire hooks
        if (window.Livewire) {
            Livewire.hook('morph.updated', () => {
                setTimeout(() => initCharts(), 100);
            });
        }
    </script>
</div>