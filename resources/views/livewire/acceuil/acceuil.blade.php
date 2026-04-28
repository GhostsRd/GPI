<div class="container-fluid py-4" style="min-height: 100vh; background: var(--gray-50);">
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
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.07), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.08), 0 4px 6px -4px rgb(0 0 0 / 0.03);
            --radius: 12px;
            --radius-lg: 16px;
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

        /* Cards */
        .card {
            background: white;
            border: none !important;
            border-radius: var(--radius-lg);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
            transition: transform 0.2s ease;
            overflow: hidden;
        }

        [data-bs-theme="dark"] .card {
            background: var(--gray-100);
            border-color: var(--gray-200);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Mode TV - désactiver animations */
        .tv-mode .card:hover {
            transform: none;
        }

        .tv-mode .btn-icon:hover {
            transform: none;
        }

        .card-header {
            background: transparent;
            border-bottom: none;
            padding: 1.25rem 1.5rem 0.5rem 1.5rem;
        }

        .card-header h6 {
            color: var(--gray-800);
            font-weight: 600;
        }

        .card-body { padding: 1.5rem; }

        /* Stats cards */
        .stat-card {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: none;
        }

        .stat-info h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.125rem;
            line-height: 1.2;
        }

        .stat-info p {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--gray-500);
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--primary-dark);
            background: var(--primary-light);
        }

        .stat-trend {
            font-size: 0.75rem;
            margin-top: 0.5rem;
            color: var(--gray-500);
        }

        .stat-trend .up { color: #10b981; }
        .stat-trend .down { color: #ef4444; }

        /* Badges */
        .badge {
            padding: 0.35rem 0.75rem;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 6px;
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

        /* Buttons */
        .btn-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
            border: 1px solid var(--gray-200);
            background: white;
            color: var(--gray-600);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            cursor: pointer;
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
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius);
            border: none;
            background: var(--primary);
            color: white;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-refresh:hover {
            background: var(--primary-dark);
            color: white;
        }

        /* Tables */
        .table { margin-bottom: 0; }

        .table thead th {
            background: var(--gray-50);
            color: var(--gray-500);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            border-top: none;
        }

        .table td {
            padding: 0.875rem 1.25rem;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
            font-size: 0.875rem;
        }

        .table tbody tr {
            transition: background 0.15s ease;
        }

        .table tbody tr:hover {
            background: var(--gray-50);
        }

        [data-bs-theme="dark"] .table thead th { background: var(--gray-200); }
        [data-bs-theme="dark"] .table td { border-color: var(--gray-200); }

        /* Progress bar */
        .progress {
            height: 6px;
            border-radius: 3px;
            background: var(--gray-200);
            overflow: hidden;
        }

        .progress-bar {
            background: var(--primary);
            border-radius: 3px;
        }

        /* Page header */
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: var(--gray-500);
            font-size: 0.9rem;
            font-weight: 400;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 2.5rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--gray-200);
            border-radius: 2px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2.5rem;
            top: 0.5rem;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--primary);
            border: 2px solid white;
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .timeline-date {
            font-size: 0.75rem;
            color: var(--gray-400);
            margin-bottom: 0.25rem;
        }

        .timeline-content {
            background: var(--gray-50);
            padding: 1rem 1.25rem;
            border-radius: var(--radius);
            border: 1px solid var(--gray-200);
            transition: border-color 0.2s ease;
        }

        .timeline-content:hover {
            border-color: var(--primary);
        }

        .timeline-content h6 {
            color: var(--gray-800);
            font-size: 0.875rem;
        }

        [data-bs-theme="dark"] .timeline-content { background: var(--gray-200); }

        /* Chart container */
        .chart-container {
            width: 100%;
            height: 300px;
            margin-top: 0.5rem;
        }

        .small-chart {
            height: 40px;
            width: 100%;
            margin-top: 0.5rem;
        }

        .rainbow-text {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .fw-600 { font-weight: 600; }

        /* Form select override */
        .form-select-sm {
            border-radius: var(--radius);
            border-color: var(--gray-200);
            font-size: 0.8rem;
            color: var(--gray-700);
            background-color: white;
        }

        [data-bs-theme="dark"] .form-select-sm {
            background-color: var(--gray-200);
            border-color: var(--gray-300);
            color: var(--gray-700);
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
            padding: 5px 10px;
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

        /* Large screen optimizations */
        @media (min-width: 1920px) {
            .container-fluid {
                max-width: 1920px;
                margin: 0 auto;
            }
            
            .page-title { font-size: 2.5rem; }
            .stat-info h3 { font-size: 2.8rem; }
            .card-header h6 { font-size: 1.2rem; }
            .chart-container { height: 400px; }
            .row.g-4 { --bs-gutter-y: 2rem; --bs-gutter-x: 2rem; }
            .table td, .table th { font-size: 1rem; }
        }

        /* Mode TV settings panel */
        .tv-settings-panel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            z-index: 10000;
            width: 400px;
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
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Tableau de bord</h1>
            <p class="page-subtitle">Vue d'ensemble de l'activité — Gestion de Parc & Support</p>
        </div>
        <div class="d-flex gap-2">
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
                <i class="fas fa-sync-alt me-2"></i>Actualiser
            </button>
        </div>
    </div>

    <!-- TV Settings Panel -->
    <div class="tv-settings-panel" id="tvSettingsPanel">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"><i class="fas fa-tv me-2"></i>Paramètres d'affichage TV</h6>
            <button class="btn-icon btn-sm" id="closeSettingsBtn" style="width: 30px; height: 30px;">
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
                    <input class="form-check-input" type="checkbox" id="hideButtons">
                    <label class="form-check-label">Masquer les boutons d'action</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="hideHeader">
                    <label class="form-check-label">Masquer l'en-tête</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Qualité d'affichage</label>
                <select class="form-select" id="qualityMode">
                    <option value="high">Haute qualité (animations)</option>
                    <option value="low">Basse qualité (performances)</option>
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

    <!-- Fullscreen Indicator -->
    <div class="fullscreen-indicator" id="fullscreenIndicator">
        <i class="fas fa-expand me-1"></i> Mode plein écran activé
    </div>

    <!-- Stats Cards Principales (DONNÉES RÉELLES DEPUIS LA BASE) -->
    <div class="row g-4 mb-4">
        <!-- Incidents -->
        <div class="col-md-6 col-xl-4 col-xxl-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card stat-card shadow-sm border-0">
                <div class="stat-info">
                    <p class="text-xs text-uppercase fw-bold text-muted mb-1">Incidents</p>
                    <h3 class="h2 fw-bold mb-0 text-dark">{{ number_format($stats['total_incidents'] ?? 0) }}</h3>
                    <div class="stat-trend mt-2">
                        <i class="fas fa-arrow-up text-danger me-1"></i>
                        <span class="small text-muted">{{ $stats['incidents_trend'] ?? '+0%' }} cette semaine</span>
                    </div>
                </div>
                <div class="stat-icon bg-danger-subtle rounded-3 p-3 text-danger">
                    <i class="fas fa-exclamation-triangle fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Tickets -->
        <div class="col-md-6 col-xl-4 col-xxl-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card stat-card shadow-sm border-0">
                <div class="stat-info">
                    <p class="text-xs text-uppercase fw-bold text-muted mb-1">Tickets</p>
                    <h3 class="h2 fw-bold mb-0 text-dark">{{ number_format($stats['total_tickets'] ?? 0) }}</h3>
                    <div class="stat-trend mt-2">
                        <i class="fas fa-clock text-primary me-1"></i>
                        <span class="small text-muted">{{ number_format($stats['pending_tickets'] ?? 0) }} en attente</span>
                    </div>
                </div>
                <div class="stat-icon bg-primary-subtle rounded-3 p-3 text-primary" style="background: var(--primary-light) !important; color: var(--primary-dark) !important;">
                    <i class="fas fa-ticket-alt fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Équipements -->
        <div class="col-md-6 col-xl-4 col-xxl-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card stat-card shadow-sm border-0">
                <div class="stat-info">
                    <p class="text-xs text-uppercase fw-bold text-muted mb-1">Équipements</p>
                    <h3 class="h2 fw-bold mb-0 text-dark">{{ number_format($stats['total_equipments'] ?? 0) }}</h3>
                    <div class="stat-trend mt-2">
                        <i class="fas fa-check-circle text-success me-1"></i>
                        <span class="small text-muted">{{ number_format($stats['available_equipments'] ?? 0) }} disponibles</span>
                    </div>
                </div>
                <div class="stat-icon bg-success-subtle rounded-3 p-3 text-success">
                    <i class="fas fa-laptop fs-4"></i>
                </div>
            </div>
        </div>

        <!-- SIM Flotte -->
        <div class="col-md-6 col-xl-4 col-xxl-3" data-aos="fade-up" data-aos-delay="400">
            <div class="card stat-card shadow-sm border-0">
                <div class="stat-info">
                    <p class="text-xs text-uppercase fw-bold text-muted mb-1">Flotte SIM</p>
                    <h3 class="h2 fw-bold mb-0 text-dark">{{ number_format($stats['total_sims'] ?? 0) }}</h3>
                    <div class="stat-trend mt-2">
                        <i class="fas fa-user-tag text-warning me-1"></i>
                        <span class="small text-muted">{{ number_format($stats['assigned_sims'] ?? 0) }} attribuées</span>
                    </div>
                </div>
                <div class="stat-icon bg-warning-subtle rounded-3 p-3 text-warning">
                    <i class="fas fa-sim-card fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Sorties -->
        <div class="col-md-6 col-xl-4 col-xxl-3" data-aos="fade-up" data-aos-delay="500">
            <div class="card stat-card shadow-sm border-0">
                <div class="stat-info">
                    <p class="text-xs text-uppercase fw-bold text-muted mb-1">Sorties</p>
                    <h3 class="h2 fw-bold mb-0 text-dark">{{ number_format($stats['total_checkouts'] ?? 0) }}</h3>
                    <div class="stat-trend mt-2">
                        <i class="fas fa-arrow-right text-info me-1"></i>
                        <span class="small text-muted">{{ number_format($stats['pending_checkouts'] ?? 0) }} en attente</span>
                    </div>
                </div>
                <div class="stat-icon bg-info-subtle rounded-3 p-3 text-info">
                    <i class="fas fa-exchange-alt fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Secondaires (DONNÉES RÉELLES) -->
    <div class="row g-4 mb-4">
        <!-- Utilisateurs -->
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="500">
            <div class="card stat-card">
                <div class="stat-info">
                    <p>Utilisateurs actifs</p>
                    <h3>{{ number_format($stats['active_users'] ?? 0) }}</h3>
                    <div class="stat-trend">
                        <i class="fas fa-user-plus up"></i>
                        <span>+{{ number_format($stats['new_users'] ?? 0) }} ce mois</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <!-- Logiciels -->
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="600">
            <div class="card stat-card">
                <div class="stat-info">
                    <p>Logiciels</p>
                    <h3>{{ number_format($stats['total_software'] ?? 0) }}</h3>
                    <div class="stat-trend">
                        <i class="fas fa-key me-1"></i>
                        <span>{{ number_format($stats['total_licenses'] ?? 0) }} licences</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-code"></i>
                </div>
            </div>
        </div>

        <!-- Résolution -->
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="700">
            <div class="card stat-card">
                <div class="stat-info">
                    <p>Taux de résolution</p>
                    <h3>{{ $stats['resolution_rate'] ?? 0 }}%</h3>
                    <div class="progress mt-2" style="width: 90%;">
                        <div class="progress-bar" style="width: {{ $stats['resolution_rate'] ?? 0 }}%"></div>
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div id="sparkResolution" class="small-chart mt-3" wire:ignore></div>
            </div>
        </div>

        <!-- Satisfaction -->
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="800">
            <div class="card stat-card">
                <div class="stat-info">
                    <p>Satisfaction</p>
                    <h3>{{ number_format($stats['average_rating'] ?? 0, 1) }}/5</h3>
                    <div class="stat-trend">
                        <i class="fas fa-star" style="color: #fbbf24;"></i>
                        <span>Basé sur {{ number_format($stats['total_feedbacks'] ?? 0) }} avis</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-smile"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 - Évolution (DONNÉES RÉELLES) -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="900">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600 rainbow-text">Évolution des tickets & incidents</h6>
                    <span class="badge badge-primary">{{ $stats['tickets_growth'] ?? '+0%' }} vs mois dernier</span>
                </div>
                <div class="card-body">
                    <div id="chartTicketsIncidents" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="1000">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600 rainbow-text">Activité des sorties & retours</h6>
                    <span class="badge badge-primary">{{ $stats['checkouts_growth'] ?? '+0%' }} vs mois dernier</span>
                </div>
                <div class="card-body">
                    <div id="chartCheckoutsReturns" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 - Répartition (DONNÉES RÉELLES) -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="1100">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Équipements par type</h6>
                    <span class="badge badge-primary">Total: {{ number_format($stats['total_equipments'] ?? 0) }}</span>
                </div>
                <div class="card-body">
                    <div id="chartEquipments" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="1200">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Logiciels par catégorie</h6>
                    <span class="badge badge-primary">{{ number_format($stats['total_licenses'] ?? 0) }} licences</span>
                </div>
                <div class="card-body">
                    <div id="chartSoftware" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="1300">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Incidents par priorité</h6>
                    <span class="badge badge-primary">{{ number_format($stats['total_incidents'] ?? 0) }} incidents</span>
                </div>
                <div class="card-body">
                    <div id="chartIncidentsPriority" class="chart-container" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableaux récapitulatifs avec Voir plus (DONNÉES RÉELLES) -->
    <div class="row g-4 mb-4">
        <!-- Derniers tickets -->
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="1400">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Derniers tickets</h6>
                    <a href="{{ route('ticket') }}" class="btn-refresh text-decoration-none tv-hidden">
                        <i class="fas fa-eye me-2"></i>Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Titre</th>
                                <th>Utilisateur</th>
                                <th>Priorité</th>
                                <th>Statut</th>
                                <th class="text-end pe-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTickets as $ticket)
                            <tr>
                                <td class="ps-4">#{{ $ticket['id'] }}</td>
                                <td>{{ $ticket['title'] }}</td>
                                <td>{{ $ticket['user'] }}</td>
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
                                <td class="text-end pe-4">{{ $ticket['date'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x mb-2" style="color: var(--gray-300);"></i>
                                    <p class="text-muted mb-0">Aucun ticket récent</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Derniers incidents -->
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="1500">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Derniers incidents</h6>
                    <a href="{{ route('admin.incident.list') }}" class="btn-refresh text-decoration-none tv-hidden">
                        <i class="fas fa-eye me-2"></i>Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Titre</th>
                                <th>Équipement</th>
                                <th>Priorité</th>
                                <th>Statut</th>
                                <th class="text-end pe-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentIncidents as $incident)
                            <tr>
                                <td class="ps-4">#{{ $incident['id'] }}</td>
                                <td>{{ $incident['title'] }}</td>
                                <td>{{ $incident['equipment'] }}</td>
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
                                <td class="text-end pe-4">{{ $incident['date'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x mb-2" style="color: var(--gray-300);"></i>
                                    <p class="text-muted mb-0">Aucun incident récent</p>
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
    <div class="row g-4 mb-4">
        <!-- Derniers équipements -->
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="1600">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Derniers équipements ajoutés</h6>
                    <a href="{{ route('equipement') }}" class="btn-refresh text-decoration-none tv-hidden">
                        <i class="fas fa-eye me-2"></i>Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Nom</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Attribué à</th>
                                <th class="text-end pe-4">Date d'ajout</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentEquipments as $equipment)
                            <tr>
                                <td class="ps-4">{{ $equipment['name'] }}</td>
                                <td>{{ $equipment['type'] }}</td>
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
                                <td>{{ $equipment['assigned_to'] ?? '-' }}</td>
                                <td class="text-end pe-4">{{ $equipment['date_added'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x mb-2" style="color: var(--gray-300);"></i>
                                    <p class="text-muted mb-0">Aucun équipement récent</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Dernières sorties -->
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="1700">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Dernières sorties</h6>
                    <a href="{{ route('checkoutadmin') }}" class="btn-refresh text-decoration-none tv-hidden">
                        <i class="fas fa-eye me-2"></i>Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Équipement</th>
                                <th>Utilisateur</th>
                                <th>Date sortie</th>
                                <th>Retour prévu</th>
                                <th>Statut</th>
                                <th class="text-end pe-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentCheckouts as $checkout)
                            <tr>
                                <td class="ps-4">{{ $checkout['equipment'] }}</td>
                                <td>{{ $checkout['user'] }}</td>
                                <td>{{ $checkout['checkout_date'] }}</td>
                                <td>{{ $checkout['expected_return'] ?? 'N/A' }}</td>
                                <td>
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
                                <td class="text-end pe-4">
                                    <button class="btn-icon btn-sm tv-hidden" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x mb-2" style="color: var(--gray-300);"></i>
                                    <p class="text-muted mb-0">Aucune sortie récente</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique complet des activités -->
    <div class="row g-4 mb-4">
        <div class="col-12" data-aos="fade-up" data-aos-delay="1800">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-600">Historique des activités</h6>
                    <div class="d-flex gap-3 align-items-center">
                        <span class="badge">{{ count($unifiedActivities ?? []) }} événements</span>
                        <select class="form-select form-select-sm tv-hidden" style="width: auto; background: rgba(255,255,255,0.1); border: 1px solid var(--primary); color: var(--gray-800);">
                            <option>Toutes les activités</option>
                            <option>Tickets</option>
                            <option>Incidents</option>
                            <option>Équipements</option>
                            <option>Sorties</option>
                            <option>Utilisateurs</option>
                        </select>
                        <a href="{{ route('admin.activites') }}" class="btn-refresh text-decoration-none tv-hidden">
                            <i class="fas fa-eye me-2"></i>Voir tous
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="timeline p-4">
                        @forelse($unifiedActivities ?? [] as $activity)
                        <div class="timeline-item">
                            <div class="timeline-date">
                                <i class="far fa-clock me-1"></i>
                                {{ $activity['date'] ?? '' }}
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="badge badge-{{ $activity['color'] ?? 'primary' }} mb-2">
                                            <i class="{{ $activity['icon'] ?? 'fas fa-bell' }} me-2"></i>
                                            {{ ucfirst($activity['type'] ?? 'Activité') }}
                                        </span>
                                        <h6 class="mb-1">{{ $activity['title'] ?? '' }}</h6>
                                        <p class="text-muted mb-0 small">{{ $activity['description'] ?? '' }}</p>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted">{{ $activity['user'] ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <i class="fas fa-history fa-3x mb-3" style="color: var(--gray-300);"></i>
                            <p class="text-muted mb-0">Aucune activité récente</p>
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
            
            // Afficher les éléments masqués
            document.querySelectorAll('.tv-hidden').forEach(el => {
                el.classList.remove('tv-hidden');
            });
            
            if (document.querySelector('.tv-header-hidden')) {
                document.querySelector('.page-title').parentElement.classList.remove('tv-hidden');
            }
            
            location.reload();
        }

        // Fonction pour appliquer les paramètres TV
        function applyTVSettings() {
            const displayMode = document.getElementById('displayMode').value;
            const autoRefresh = parseInt(document.getElementById('autoRefresh').value);
            const hideButtons = document.getElementById('hideButtons').checked;
            const hideHeader = document.getElementById('hideHeader').checked;
            const qualityMode = document.getElementById('qualityMode').value;
            
            // Sauvegarder les paramètres
            localStorage.setItem('displayMode', displayMode);
            localStorage.setItem('autoRefresh', autoRefresh);
            localStorage.setItem('hideButtons', hideButtons);
            localStorage.setItem('hideHeader', hideHeader);
            localStorage.setItem('qualityMode', qualityMode);
            
            // Appliquer le mode d'affichage
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
            
            // Appliquer le rafraîchissement automatique
            if (autoRefreshTimer) {
                clearInterval(autoRefreshTimer);
                autoRefreshTimer = null;
            }
            
            if (autoRefresh > 0) {
                autoRefreshTimer = setInterval(() => {
                    if (window.Livewire) {
                        window.Livewire.dispatch('refreshCharts');
                    }
                    // Rafraîchir les graphiques sans recharger la page
                    initCharts();
                }, autoRefresh * 1000);
            }
            
            // Masquer les éléments
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
            
            // Appliquer le mode qualité
            if (qualityMode === 'low') {
                const style = document.createElement('style');
                style.id = 'qualityModeStyle';
                style.textContent = `
                    .card, .btn-icon, .btn-refresh { transition: none !important; }
                    .card:hover { transform: none !important; }
                    [data-aos] { opacity: 1 !important; transform: none !important; }
                    .chart-container { transition: none !important; }
                `;
                const oldStyle = document.getElementById('qualityModeStyle');
                if (oldStyle) oldStyle.remove();
                document.head.appendChild(style);
            } else {
                const oldStyle = document.getElementById('qualityModeStyle');
                if (oldStyle) oldStyle.remove();
            }
            
            // Fermer le panneau
            document.getElementById('tvSettingsPanel').classList.remove('show');
            
            // Afficher une notification
            const indicator = document.getElementById('fullscreenIndicator');
            indicator.textContent = '✓ Paramètres TV appliqués';
            indicator.classList.add('show');
            setTimeout(() => {
                indicator.classList.remove('show');
                indicator.textContent = '<i class="fas fa-expand me-1"></i> Mode plein écran activé';
            }, 2000);
        }

        // Charger les paramètres sauvegardés
        function loadTVSettings() {
            const displayMode = localStorage.getItem('displayMode');
            const autoRefresh = localStorage.getItem('autoRefresh');
            const hideButtons = localStorage.getItem('hideButtons');
            const hideHeader = localStorage.getItem('hideHeader');
            const qualityMode = localStorage.getItem('qualityMode');
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
            if (qualityMode && document.getElementById('qualityMode')) {
                document.getElementById('qualityMode').value = qualityMode;
            }
            
            if (tvMode === 'true') {
                applyTVSettings();
            }
        }

        function initCharts() {
            try {
                // Récupération des données depuis les variables PHP/Livewire
                const dataTickets = @json($monthlyTickets ?? []);
                const dataIncidents = @json($monthlyIncidents ?? []);
                const dataCheckouts = @json($monthlyCheckouts ?? []);
                const dataEquip = @json($equipmentByType ?? []);
                const dataSoft = @json($softwareByCategory ?? []);
                const priorityData = @json($incidentsByPriority ?? []);
                const incidentTrend = @json($incidentTrend ?? []);

                for (let key in charts) {
                    if (charts[key] && typeof charts[key].destroy === 'function') {
                        try { charts[key].destroy(); } catch(e) {}
                    }
                }
                charts = {};

                const baseOptions = {
                    chart: {
                        toolbar: { show: false },
                        animations: {
                            enabled: document.getElementById('qualityMode')?.value !== 'low',
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: { enabled: true, delay: 150 },
                            dynamicAnimation: { enabled: true, speed: 350 }
                        },
                        background: 'transparent'
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 3 },
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
                        strokeDashArray: 4,
                        padding: { left: 10, right: 10 }
                    },
                    xaxis: {
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: { 
                            style: { 
                                colors: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280',
                                fontSize: '12px',
                                fontWeight: 500
                            }
                        }
                    },
                    yaxis: {
                        labels: { 
                            style: { 
                                colors: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280',
                                fontSize: '12px',
                                fontWeight: 500
                            }
                        }
                    },
                    tooltip: { 
                        theme: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'dark' : 'light',
                        style: { fontSize: '12px' },
                        shared: true,
                        intersect: false
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        fontSize: '13px',
                        fontWeight: 500,
                        labels: {
                            colors: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280'
                        }
                    },
                    noData: {
                        text: 'Aucune donnée disponible',
                        align: 'center',
                        verticalAlign: 'middle',
                        style: {
                            color: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#9ca3af' : '#6b7280',
                            fontSize: '14px'
                        }
                    }
                };

                const createSpark = (id, data, color = '#5BC4BF') => {
                    const element = document.getElementById(id);
                    if (!element) return;
                    
                    charts[id] = new ApexCharts(element, {
                        chart: { 
                            type: 'area', 
                            height: 50, 
                            sparkline: { enabled: true },
                            animations: { enabled: document.getElementById('qualityMode')?.value !== 'low' }
                        },
                        stroke: { curve: 'smooth', width: 2 },
                        colors: [color],
                        fill: { 
                            opacity: 0.3, 
                            type: 'gradient',
                            gradient: {
                                shade: 'light',
                                type: "vertical",
                                shadeIntensity: 0.5,
                                gradientToColors: [color],
                                inverseColors: true,
                                opacityFrom: 0.5,
                                opacityTo: 0.1,
                                stops: [0, 100]
                            }
                        },
                        series: [{ data: Array.isArray(data) ? data : [] }],
                        tooltip: { enabled: false }
                    });
                    charts[id].render();
                };

                // Sparklines
                const incidentTrendArray = Array.isArray(incidentTrend) ? incidentTrend : Object.values(incidentTrend);
                createSpark('sparkResolution', [85, 88, 90, 92, 91, 94, 93, 95, 94]);
                createSpark('sparkIncidents', incidentTrendArray, '#ef4444');

                // Graphique Tickets/Incidents
                if (document.getElementById('chartTicketsIncidents')) {
                    const ticketsData = Object.values(dataTickets);
                    const incidentsData = Array.isArray(incidentTrend) && incidentTrend.length > 0 ? incidentTrend.slice(-12) : Object.values(dataIncidents);
                    const categories = Object.keys(dataTickets).length > 0 ? Object.keys(dataTickets) : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'];
                    
                    charts.ticketsIncidents = new ApexCharts(document.getElementById('chartTicketsIncidents'), {
                        ...baseOptions,
                        series: [
                            { name: 'Tickets', data: ticketsData.length ? ticketsData : [12, 19, 15, 25, 30, 35] },
                            { name: 'Incidents', data: incidentsData.length ? incidentsData : [8, 12, 10, 18, 22, 25] }
                        ],
                        chart: { ...baseOptions.chart, type: 'area', height: 300 },
                        xaxis: { ...baseOptions.xaxis, categories: categories.length ? categories : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'] }
                    });
                    charts.ticketsIncidents.render();
                }

                // Graphique Sorties
                if (document.getElementById('chartCheckoutsReturns')) {
                    const checkoutsData = Object.values(dataCheckouts);
                    const categories = Object.keys(dataCheckouts).length > 0 ? Object.keys(dataCheckouts) : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'];
                    
                    charts.checkoutsReturns = new ApexCharts(document.getElementById('chartCheckoutsReturns'), {
                        ...baseOptions,
                        series: [{ name: 'Sorties', data: checkoutsData.length ? checkoutsData : [5, 8, 12, 15, 20, 25] }],
                        chart: { ...baseOptions.chart, type: 'bar', height: 300 },
                        plotOptions: { 
                            bar: { 
                                borderRadius: 8, 
                                columnWidth: '60%',
                                distributed: true,
                                colors: {
                                    ranges: [{
                                        from: 0,
                                        to: 100,
                                        color: '#5BC4BF'
                                    }]
                                }
                            } 
                        },
                        xaxis: { ...baseOptions.xaxis, categories: categories }
                    });
                    charts.checkoutsReturns.render();
                }

                // Graphique Équipements par type (donut)
                if (document.getElementById('chartEquipments') && Object.keys(dataEquip).length > 0) {
                    const values = Object.values(dataEquip).map(v => Number(v) || 0);
                    const sum = values.reduce((a, b) => a + b, 0);
                    
                    charts.equipments = new ApexCharts(document.getElementById('chartEquipments'), {
                        ...baseOptions,
                        series: sum > 0 ? values : [1],
                        labels: Object.keys(dataEquip).length ? Object.keys(dataEquip) : ['Aucune donnée'],
                        chart: { ...baseOptions.chart, type: 'donut', height: 300 },
                        colors: ['#5BC4BF', '#94a3b8', '#3A9692', '#cbd5e1', '#7ED6D3'],
                        plotOptions: { 
                            pie: { 
                                donut: { 
                                    size: '65%',
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            label: 'Total',
                                            fontSize: '14px',
                                            fontWeight: 600,
                                            color: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#fff' : '#333'
                                        }
                                    }
                                },
                                expandOnClick: false
                            } 
                        },
                        legend: { position: 'bottom', fontSize: '12px', itemMargin: { horizontal: 10, vertical: 5 } },
                        stroke: { show: false },
                        dataLabels: { enabled: false }
                    });
                    charts.equipments.render();
                } else if (document.getElementById('chartEquipments')) {
                    document.getElementById('chartEquipments').innerHTML = '<div class="text-center text-muted py-5">Aucune donnée équipement</div>';
                }

                // Graphique Logiciels
                if (document.getElementById('chartSoftware') && Object.keys(dataSoft).length > 0) {
                    const values = Object.values(dataSoft).map(v => Number(v) || 0);
                    const sum = values.reduce((a, b) => a + b, 0);

                    charts.software = new ApexCharts(document.getElementById('chartSoftware'), {
                        ...baseOptions,
                        series: sum > 0 ? values : [1],
                        labels: Object.keys(dataSoft).length ? Object.keys(dataSoft) : ['Aucune donnée'],
                        chart: { ...baseOptions.chart, type: 'pie', height: 300 },
                        colors: ['#5BC4BF', '#94a3b8', '#3A9692', '#cbd5e1', '#7ED6D3', '#64748b'],
                        legend: { position: 'bottom', fontSize: '12px', itemMargin: { horizontal: 10, vertical: 5 } },
                        stroke: { show: false },
                        dataLabels: { enabled: false }
                    });
                    charts.software.render();
                }

                // Graphique Incidents par priorité
                if (document.getElementById('chartIncidentsPriority') && Object.keys(priorityData).length > 0) {
                    const values = Object.values(priorityData).map(v => Number(v) || 0);
                    const sum = values.reduce((a, b) => a + b, 0);

                    charts.priority = new ApexCharts(document.getElementById('chartIncidentsPriority'), {
                        ...baseOptions,
                        series: sum > 0 ? values : [1],
                        labels: Object.keys(priorityData).length ? Object.keys(priorityData) : ['Aucune donnée'],
                        chart: { ...baseOptions.chart, type: 'polarArea', height: 300 },
                        colors: ['#dc2626', '#d97706', '#5BC4BF', '#2563eb', '#7c3aed'],
                        stroke: { show: false },
                        fill: { opacity: 0.8, type: 'solid' },
                        legend: { position: 'bottom', fontSize: '12px', itemMargin: { horizontal: 10, vertical: 5 } },
                        dataLabels: { enabled: true, style: { fontSize: '11px', fontWeight: 600 } }
                    });
                    charts.priority.render();
                }
            } catch(e) {
                console.error('Erreur charts:', e);
            }
        }

        // Theme toggle avec animation
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

        // Gestion du plein écran
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        if (fullscreenBtn) {
            fullscreenBtn.addEventListener('click', enterFullscreen);
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

        // Initialisation
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

        // Refresh charts via Livewire event
        window.addEventListener('chartsRefreshed', () => {
            initCharts();
        });
        
        // Pour Livewire, on réinitialise les graphiques après chaque mise à jour
        if (window.Livewire) {
            Livewire.hook('morph.updated', () => {
                setTimeout(() => initCharts(), 100);
            });
        }
    </script>
</div>