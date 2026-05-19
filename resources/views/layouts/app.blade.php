<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Theme Switcher Script for early execution to prevent FOUC -->
    <script src="{{ asset('js/theme.js') }}"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GPI') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jsticket.js') }}" ></script>
    <script src="{{ asset('js/jsapp.js') }}" ></script>
    <script src="{{ asset('js/jsuser.js') }}" ></script>
    <script src="{{ asset('js/equipement.js') }}"></script>
    <script src="{{ asset('/monjs.js') }}"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Styles -->
    <link href="{{ asset('css/cssticket.css') }}" rel="stylesheet">
    <link href="{{ asset('css/imprimante.css') }}" rel="stylesheet">
    <link href="{{ asset('css/peri.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ordi.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleapp.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleuser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modalview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modern-theme.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href='{{ asset('css/calendrier/assets/css/fullcalendar.css') }}' rel='stylesheet' />
    <link href='{{ asset('css/calendrier/assets/css/fullcalendar.print.css') }}' rel='stylesheet' media='print' />
    
    <script src='{{ asset('css/calendrier/assets/js/jquery-1.10.2.js') }}' type="text/javascript"></script>
    <script src='{{ asset('css/calendrier/assets/js/jquery-ui.custom.min.js') }}' type="text/javascript"></script>
    <script src='{{ asset('css/calendrier/assets/js/fullcalendar.js') }}' type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
    @stack('styles')

    <style>
        :root {
            --primary: #4fbbb2;
            --primary-light: #76cfc8;
            --primary-dark: #3a8c85;
            --secondary: #f1705a;
            --secondary-light: #f48d7b;
            --secondary-dark: #cc5a48;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --info: #3b82f6;
            --dark: #1e293b;
            --light: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-900: #0f172a;
            --border: #e2e8f0;
            --card-bg: #ffffff;
            --shadow-sm: 0 10px 25px -5px rgba(15, 23, 42, 0.08);
            --shadow-md: 0 20px 27px -8px rgba(15, 23, 42, 0.12);
            --shadow-lg: 0 30px 45px -12px rgba(79, 187, 178, 0.2);
            --blur-amount: 16px;
            --gradient-primary: linear-gradient(135deg, #4fbbb2, #f1705a);
            --gradient-teal: linear-gradient(135deg, #4fbbb2, #3a8c85);
        }

        [data-bs-theme="dark"] {
            --card-bg: rgba(30, 41, 59, 0.85);
            --light: #0f172a;
            --dark: #f8fafc;
            --gray: #94a3b8;
            --border-light: rgba(255, 255, 255, 0.08);
        }

        body {
          font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Ubuntu, Noto Sans, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji; !important";
            font-size: 0.75rem !important;
        }
        

        /* Réduction globale pour un aspect compact */
        .sidebar-modern {
            font-size: 1rem !important;
        }

        .nav-link-modern {
            font-size: 0.8rem !important;
            padding: 0.4rem 0.75rem !important;
        }

        .nav-link-modern h6 {
          
            margin: 0 !important;
            
        }

        .nav-link-modern i {
            font-size: 0.8rem !important;
        }

        .submenu-item {
          
            padding: 0.25rem 0.75rem 0.25rem 1.8rem !important;
        }

      

        .sidebar-header-modern small {
            font-size: 0.65rem !important;
        }

        .nav-heading-modern {
            font-size: 0.6rem !important;
            padding: 1rem 1rem 0.3rem !important;
        }

        /* Sidebar User Menu Styles */
        .sidebar-user-menu {
            margin-top: auto;
            border-top: 1px solid rgba(0,0,0,0.08);
            padding: 1rem 0.75rem;
        }

        [data-bs-theme="dark"] .sidebar-user-menu {
            border-top-color: rgba(255,255,255,0.08);
        }

        .sidebar-user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar-user-info:hover {
            background: rgba(99, 102, 241, 0.1);
        }

        .sidebar-user-details {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user-name {
            font-weight: 600;
            font-size: 0.75rem;
            color: var(--dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 0.6rem;
            color: var(--gray-500);
        }

        /* Dropdown menu in sidebar */
        .sidebar-dropdown {
            position: relative;
        }

        .sidebar-dropdown-menu {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            margin-bottom: 0.5rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            padding: 0.75rem;
            min-width: 280px;
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        [data-bs-theme="dark"] .sidebar-dropdown-menu {
            background: #1e293b;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .sidebar-dropdown.show .sidebar-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .sidebar-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 0.75rem;
            border-radius: 12px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.7rem;
        }

        .sidebar-dropdown-item:hover {
            background: #eef2ff;
            color: #6366f1;
        }

        [data-bs-theme="dark"] .sidebar-dropdown-item:hover {
            background: rgba(99, 102, 241, 0.2);
            color: #818cf8;
        }

        .sidebar-dropdown-item.logout:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        .sidebar-dropdown-item i {
            font-size: 1rem;
            width: 24px;
        }

        .sidebar-dropdown-divider {
            height: 1px;
            background: rgba(0,0,0,0.08);
            margin: 0.5rem 0;
        }

        [data-bs-theme="dark"] .sidebar-dropdown-divider {
            background: rgba(255,255,255,0.08);
        }

        /* Theme switch inline */
        .theme-switch-inline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.6rem 0.75rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .theme-switch-inline:hover {
            background: #eef2ff;
        }

        [data-bs-theme="dark"] .theme-switch-inline:hover {
            background: rgba(99, 102, 241, 0.2);
        }

        .theme-switch-inline .theme-toggle-icon {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Notification badge */
        .notification-badge {
            position: relative;
            display: inline-flex;
        }

        .notification-badge .badge-count {
            position: absolute;
            top: -5px;
            right: -8px;
            background: #ef4444;
            color: white;
            font-size: 0.6rem;
            font-weight: 600;
            padding: 2px 5px;
            border-radius: 20px;
            min-width: 18px;
            text-align: center;
        }

        /* Animation pour les notifications */
        @keyframes bellShake {
            0%, 100% { transform: rotate(0); }
            10%, 30%, 50%, 70%, 90% { transform: rotate(10deg); }
            20%, 40%, 60%, 80% { transform: rotate(-10deg); }
        }

        .notification-bell-animate {
            animation: bellShake 1s ease-in-out;
        }
    /* --- CONFIGURATION BASE SIDEBAR --- */
#sidebarModern {
    position: fixed;
    top: 0;
    left: 0;
    width: 65px; /* Largeur repliée (icônes seules) */
    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background-color: #ffffff;
    overflow-x: hidden;
    white-space: nowrap;
}

/* Cache le texte et les chevrons par défaut */
#sidebarModern .sidebar-text,
#sidebarModern .chevron-icon {
    opacity: 0;
    transition: opacity 0.2s ease;
}

/* Élargissement de la sidebar au survol */
#sidebarModern:hover {
    width: 240px; /* Largeur dépliée */
}

#sidebarModern:hover .sidebar-text,
#sidebarModern:hover .chevron-icon {
    opacity: 1;
}


/* --- CONFIGURATION DU MAIN CONTENT (EFFET DE POUSSE) --- */
.main-content-modern {
    /* Marge initiale équivalente à la largeur de la sidebar repliée */
    margin-left: 65px; 
    
    /* Transition identique à la sidebar pour éviter les décalages visuels saccadés */
    transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    
    /* Optionnel : Rembourrage interne pour espacer votre contenu */
    padding: 20px; 
    min-height: 100vh;
    background-color: #f8fafc; /* Un fond gris très léger moderne */
}

/* MAGIE CSS : Quand la sidebar est survolée, on POUSSE le contenu principal */
#sidebarModern:hover + .main-content-modern {
    margin-left: 240px; /* Ajusté exactement sur la largeur de la sidebar ouverte */
}
        /* Style de base pour la Sidebar en mode Icône Unique (Fermée) */
#sidebarModern {
    width: 65px; /* Largeur quand seules les icônes sont visibles */
    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background-color: #ffffff;
    overflow-x: hidden;
    white-space: nowrap;
}

/* Cache le texte et les chevrons par défaut */
#sidebarModern .sidebar-text,
#sidebarModern .chevron-icon {
    opacity: 0;
    transition: opacity 0.2s ease;
    display: inline-block;
}

/* --- AU SURVOL (HOVER) : La barre s'ouvre proprement --- */


/* Affiche le texte et les chevrons dès que la barre s'ouvre */
#sidebarModern:hover .sidebar-text,
#sidebarModern:hover .chevron-icon {
    opacity: 1;
     transition: 0.5s;
}

/* Ajustements graphiques pour les liens */
.nav-link-modern {
    color: #4b5563;
    text-decoration: none;
    border-radius: 8px;
    transition: background 0.5s;
}
.nav-link-modern:hover, .nav-link-modern.active {
    background-color: #f3f4f6;
    transition: 0.5s;
    color: #111827;
}
.submenu-item:hover {
    color: #666572 !important; /* Couleur d'accentuation au choix */
     transition: 0.5s;
}
    </style>
    
</head>
<body>
<div id="app">
    <!-- Bouton Toggle Mobile (Visible uniquement sur mobile car le navbar a été supprimé) -->
    <button class="sidebar-toggle d-lg-none shadow-sm" id="mobileSidebarToggle" style="position: fixed; top: 15px; left: 15px; z-index: 1200; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: none; border-radius: 10px; background: var(--primary); color: white;">
        <i class="bi bi-list"></i>
    </button>

   <aside class="sidebar-modern shadow border-0 d-flex flex-column sidebar-collapsed" style="z-index: 1000 !important; height: 100vh;" id="sidebarModern">
    
    <div class="sidebar-header-toggle px-3 py-3 d-flex align-items-center justify-content-between">
        <a class="d-flex align-items-center text-decoration-none" href="{{ url('/home') }}">
           <img src="{{ url('images/bureau.png') }}" alt="Logo" width="32" class="rounded-pill">
           <span class="fw-bold sidebar-text ms-2 font-logo">GPI</span>
        </a>
    </div>

    <nav class="sidebar-nav-modern py-2 flex-grow-1 overflow-y-auto" id="sidebarAccordion">
        
        <div class="nav-item-modern">
            <a class="nav-link-modern active d-flex align-items-center px-3 py-2" href="{{ url('/home') }}" title="Tableau de bord">
               <i class="bi bi-grid-1x2-fill fs-5"></i>
               <span class="sidebar-text ms-3 fw-medium">Tableau de bord</span>
            </a>
        </div>

        <div class="sidebar-divider my-2 mx-3 border-top opacity-25"></div>

        <div class="nav-item-modern">
            <a class="nav-link-modern collapsed d-flex align-items-center px-3 py-2" data-bs-toggle="collapse" data-bs-parent="#sidebarAccordion" href="#parcCollapse" title="Parc Informatique">
                <i class="bi bi-pc-display fs-5"></i>
                <span class="sidebar-text ms-3 fw-medium">Parc Info</span>
                <i class="bi bi-chevron-down ms-auto sidebar-text chevron-icon"></i>
            </a>
            <div class="collapse" id="parcCollapse">
                <div class="nav-submenu ps-4 py-1 small">
                    <a href="{{ url('equipement') }}" class="submenu-item d-flex align-items-center py-2 text-decoration-none text-muted"><i class="bi bi-laptop me-2"></i> <span class="sidebar-text">Vue d'ensemble</span></a>
                    <a href="{{ url('ordinateur') }}" class="submenu-item d-flex align-items-center py-2 text-decoration-none text-muted"><i class="bi bi-cpu me-2"></i> <span class="sidebar-text">Ordinateurs</span></a>
                    <a href="{{ url('moniteur') }}" class="submenu-item d-flex align-items-center py-2 text-decoration-none text-muted"><i class="bi bi-display me-2"></i> <span class="sidebar-text">Moniteurs</span></a>
                    <a href="{{ url('logiciel') }}" class="submenu-item d-flex align-items-center py-2 text-decoration-none text-muted"><i class="bi bi-window me-2"></i> <span class="sidebar-text">Logiciels</span></a>
                    <a href="{{ url('imprimante') }}" class="submenu-item d-flex align-items-center py-2 text-decoration-none text-muted"><i class="bi bi-printer me-2"></i> <span class="sidebar-text">Imprimantes</span></a>
                    <a href="{{ url('materiel-reseau') }}" class="submenu-item d-flex align-items-center py-2 text-decoration-none text-muted"><i class="bi bi-hdd-network me-2"></i> <span class="sidebar-text">Réseaux</span></a>
                    <a href="{{ url('telephone') }}" class="submenu-item d-flex align-items-center py-2 text-decoration-none text-muted"><i class="bi bi-telephone me-2"></i> <span class="sidebar-text">Téléphones</span></a>
                    <a href="{{ url('peripherique') }}" class="submenu-item d-flex align-items-center py-2 text-decoration-none text-muted"><i class="bi bi-usb-symbol me-2"></i> <span class="sidebar-text">Périphériques</span></a>
                </div>
            </div>
        </div>

        <div class="nav-item-modern">
            <a class="nav-link-modern collapsed d-flex align-items-center px-3 py-2" data-bs-toggle="collapse" data-bs-parent="#sidebarAccordion" href="#simCollapse" title="Cartes SIM">
                <i class="bi bi-sim fs-5"></i>
                <span class="sidebar-text ms-3 fw-medium">Cartes SIM</span>
                <i class="bi bi-chevron-down ms-auto sidebar-text chevron-icon"></i>
            </a>
            <div class="collapse" id="simCollapse">
                <div class="nav-submenu ps-4 py-1 small">
                    @if(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isManager()))
                        <a href="{{ route('admin.sim.dashboard') }}" class="submenu-item d-block py-2 text-decoration-none text-muted"><i class="bi bi-graph-up me-2"></i> <span class="sidebar-text">Analyse</span></a>
                        <a href="{{ route('admin.sim.list') }}" class="submenu-item d-block py-2 text-decoration-none text-muted"><i class="bi bi-list-ul me-2"></i> <span class="sidebar-text">Flotte SIM</span></a>
                    @endif
                    @if(Auth::check() && Auth::user()->isUser())
                        <a href="{{ route('utilisateur.sim.my-sims') }}" class="submenu-item d-block py-2 text-decoration-none text-muted"><i class="bi bi-person-badge me-2"></i> <span class="sidebar-text">Mes SIMs</span></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="sidebar-divider my-2 mx-3 border-top opacity-25"></div>

        <div class="nav-item-modern">
            <a class="nav-link-modern collapsed d-flex align-items-center px-3 py-2" data-bs-toggle="collapse" data-bs-parent="#sidebarAccordion" href="#checkoutcollaps" title="Mouvements & Réservations">
                <i class="bi bi-arrow-left-right fs-5"></i>
                <span class="sidebar-text ms-3 fw-medium">Mouvements</span>
                <i class="bi bi-chevron-down ms-auto sidebar-text chevron-icon"></i>
            </a>
            <div class="collapse" id="checkoutcollaps">
                <div class="nav-submenu ps-4 py-1 small">
                    <a href="{{ route('checkoutadmin') }}" class="submenu-item d-block py-2 text-decoration-none text-muted"><i class="bi bi-box-arrow-in-right me-2"></i> <span class="sidebar-text">Out / In</span></a>
                    <a href="{{ route('checkout.reservation.list') }}" class="submenu-item d-block py-2 text-decoration-none text-muted"><i class="bi bi-calendar-check me-2"></i> <span class="sidebar-text">Réservations</span></a>
                </div>
            </div>
        </div>

        <div class="nav-item-modern">
            <a class="nav-link-modern collapsed d-flex align-items-center px-3 py-2" data-bs-toggle="collapse" data-bs-parent="#sidebarAccordion" href="#ticketsCollapse" title="Tickets & Support">
                <i class="bi bi-ticket-perforated-fill fs-5"></i>
                <span class="sidebar-text ms-3 fw-medium">Tickets</span>
                <i class="bi bi-chevron-down ms-auto sidebar-text chevron-icon"></i>
            </a>
            <div class="collapse" id="ticketsCollapse">
                <div class="nav-submenu ps-4 py-1 small">
                    <a href="{{ url('/ticket') }}" class="submenu-item d-block py-2 text-decoration-none text-muted"><i class="bi bi-circle me-2"></i> <span class="sidebar-text">Gestion Tickets</span></a>
                </div>
            </div>
        </div>

        <div class="sidebar-divider my-2 mx-3 border-top opacity-25"></div>

        <div class="nav-item-modern">
            <a class="nav-link-modern collapsed d-flex align-items-center px-3 py-2" data-bs-toggle="collapse" data-bs-parent="#sidebarAccordion" href="#usersCollapse" title="Utilisateurs">
                <i class="bi bi-people-fill fs-5"></i>
                <span class="sidebar-text ms-3 fw-medium">Utilisateurs</span>
                <i class="bi bi-chevron-down ms-auto sidebar-text chevron-icon"></i>
            </a>
            <div class="collapse" id="usersCollapse">
                <div class="nav-submenu ps-4 py-1 small">
                    <a href="{{ route('utilisateurDashboard') }}" class="submenu-item d-block py-2 text-decoration-none text-muted"><i class="bi bi-person-workspace me-2"></i> <span class="sidebar-text">Admin</span></a>
                    <a href="{{ route('listeutilisateur') }}" class="submenu-item d-block py-2 text-decoration-none text-muted"><i class="bi bi-person-lines-fill me-2"></i> <span class="sidebar-text">Liste</span></a>
                </div>
            </div>
        </div>

        <div class="nav-item-modern">
            <a class="nav-link-modern {{ request()->routeIs('configuration') ? 'active' : '' }} d-flex align-items-center px-3 py-2" href="{{ route('configuration') }}" title="Configuration">
                <i class="bi bi-sliders fs-5"></i>
                <span class="sidebar-text ms-3 fw-medium">Configuration</span>
            </a>
        </div>
    </nav>

    <div class="sidebar-user-compact border-top py-2 px-3">
        <div class="dropdown">
            <div class="d-flex align-items-center" data-bs-toggle="dropdown" style="cursor: pointer;">
                @if(Auth::check() && Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle" width="32" height="32" style="object-fit: cover;">
                @else
                    <img src="{{ asset('images/avtar_1.png') }}" class="rounded-circle" width="32" height="32" style="object-fit: cover;">
                @endif
                <div class="sidebar-text ms-3 overflow-hidden">
                    <div class="fw-bold small text-truncate" style="max-width: 130px;">{{ Auth::check() ? Auth::user()->name : 'Invité' }}</div>
                </div>
            </div>
            </div>
    </div>
</aside>

    <main class="main-content-modern">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Formulaire caché pour la déconnexion -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Modal Notifications -->
    <div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="notificationsModalLabel">
                        <i class="bi bi-bell-fill me-2" style="color: #6366f1;"></i>
                        Notifications
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    @livewire('notifications.notification-dropdown')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Gestion du thème
    function toggleTheme() {
        const htmlElement = document.documentElement;
        const currentTheme = htmlElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        htmlElement.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        // Mettre à jour l'icône et le texte
        updateThemeUI(newTheme);
        
        // Déclencher l'événement personnalisé
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: newTheme } }));
    }
    
    function updateThemeUI(theme) {
        const themeIcon = document.getElementById('themeIcon');
        const themeText = document.getElementById('themeText');
        
        if (theme === 'dark') {
            themeIcon.className = 'bi bi-sun-fill';
            themeText.textContent = 'Clair';
        } else {
            themeIcon.className = 'bi bi-moon-stars-fill';
            themeText.textContent = 'Sombre';
        }
    }
    
    // Initialiser le thème au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
        updateThemeUI(savedTheme);
    });
    
    // Gestion des notifications
    let notificationsModal;
    
    function toggleNotificationsPanel() {
        if (!notificationsModal) {
            notificationsModal = new bootstrap.Modal(document.getElementById('notificationsModal'));
        }
        notificationsModal.show();
    }
    
    // Mettre à jour le badge des notifications
    function updateNotificationBadge(count) {
        const sidebarBadge = document.getElementById('sidebarNotificationBadge');
        const dropdownBadge = document.getElementById('dropdownNotificationBadge');
        
        if (count > 0) {
            if (sidebarBadge) {
                sidebarBadge.textContent = count > 99 ? '99+' : count;
                sidebarBadge.style.display = 'inline-block';
            }
            if (dropdownBadge) {
                dropdownBadge.textContent = count > 99 ? '99+' : count;
                dropdownBadge.style.display = 'inline-block';
            }
            // Animation sur la cloche
            const bellIcon = document.querySelector('.sidebar-user-info .bi-bell-fill');
            if (bellIcon) {
                bellIcon.classList.add('notification-bell-animate');
                setTimeout(() => {
                    bellIcon.classList.remove('notification-bell-animate');
                }, 1000);
            }
        } else {
            if (sidebarBadge) sidebarBadge.style.display = 'none';
            if (dropdownBadge) dropdownBadge.style.display = 'none';
        }
    }
    
    // Écouter les événements Livewire pour les notifications
    document.addEventListener('DOMContentLoaded', function() {
        // Écouter l'événement de mise à jour des notifications
        Livewire.on('notificationsUpdated', (data) => {
            updateNotificationBadge(data.unreadCount);
        });
        
        // Initialiser le modal
        notificationsModal = new bootstrap.Modal(document.getElementById('notificationsModal'), {
            backdrop: 'static',
            keyboard: true
        });
    });
    
    // Confirmation de déconnexion
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Déconnexion',
            text: 'Êtes-vous sûr de vouloir vous déconnecter ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Oui, déconnecter',
            cancelButtonText: 'Annuler',
            customClass: {
                popup: 'rounded-4',
                confirmButton: 'rounded-3 px-4 py-2',
                cancelButton: 'rounded-3 px-4 py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
    
    // Fermer le dropdown de la sidebar au clic ailleurs
    document.addEventListener('click', function(e) {
        const sidebarDropdown = document.getElementById('sidebarUserDropdown');
        if (sidebarDropdown && !sidebarDropdown.contains(e.target)) {
            sidebarDropdown.classList.remove('show');
        }
    });
    
    // Gestion du dropdown de la sidebar
    const userInfo = document.querySelector('.sidebar-user-info');
    const sidebarDropdown = document.getElementById('sidebarUserDropdown');
    
    if (userInfo && sidebarDropdown) {
        userInfo.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebarDropdown.classList.toggle('show');
        });
    }

    // Toggle Sidebar on Mobile
    const mobileToggle = document.getElementById('mobileSidebarToggle');
    const sidebarModern = document.getElementById('sidebarModern');
    
    if (mobileToggle && sidebarModern) {
        mobileToggle.addEventListener('click', function() {
            sidebarModern.classList.toggle('mobile-open');
        });
    }

    // Fermer la sidebar mobile au clic en dehors
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 991 && sidebarModern && !sidebarModern.contains(e.target) && !mobileToggle.contains(e.target)) {
            sidebarModern.classList.remove('mobile-open');
        }
    });
</script>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({ once: true });

    Livewire.hook('message.processed', () => {
        AOS.refresh();
    });
</script>

<!-- Scripts modaux -->
<script>
    window.addEventListener('openAffectationModal', () => {
        let modal = new bootstrap.Modal(document.getElementById('affectationModal'));
        modal.show();
    });

    window.addEventListener('closeAffectationModal', () => {
        let modal = bootstrap.Modal.getInstance(document.getElementById('affectationModal'));
        modal.hide();
    });
</script>

@stack('scripts')

<script>
    // Script pour les notifications Livewire
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('notificationsMarkedAsRead', event => {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'Toutes les notifications ont été marquées comme lues',
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        });

        window.addEventListener('toast', event => {
            const data = event.detail[0] || event.detail;
            Swal.fire({
                icon: data.type || 'success',
                title: data.type == 'success' ? 'Réussi' : (data.type == 'error' ? 'Erreur' : 'Info'),
                text: data.message,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        });

        // Gestion des flash messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('error') }}",
                timer: 5000,
                showConfirmButton: true,
                toast: false,
                position: 'center'
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Attention',
                text: "{{ session('warning') }}",
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: "{{ session('info') }}",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif
    });
</script>
</body>
</html>