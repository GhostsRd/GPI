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
    </style>
</head>
<body>
<div id="app">
    <!-- Bouton Toggle Mobile (Visible uniquement sur mobile car le navbar a été supprimé) -->
    <button class="sidebar-toggle d-lg-none shadow-sm" id="mobileSidebarToggle" style="position: fixed; top: 15px; left: 15px; z-index: 1200; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: none; border-radius: 10px; background: var(--primary); color: white;">
        <i class="bi bi-list"></i>
    </button>

    <!-- Modern Sidebar -->
    <aside class="sidebar-modern shadow border-0 d-flex flex-column" style="z-index: 1000 !important; height: 100vh;" id="sidebarModern">
        <nav class="sidebar-nav-modern py-2 flex-grow-1 ">
            <!-- Dashboard -->
            <div class="nav-item-modern">
                <a class="nav-link-modern shadow-sm active" href="{{ url('/home') }}">
                   {{-- <i class="bi bi-grid-1x2-fill"></i> --}}
                   <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">
                    <h5 class="fw-bold mt-1"
                    style="font-family: 'UnifrakturCook', cursive;font-size: 20px;color: #2d4052c5;
                text-shadow: 2px 2px 5px rgba(128, 128, 128, 0.796);
                letter-spacing: 2px;"
                    >
                    GPI</h5>
                </a>
            </div>
            <div class="nav-item-modern mt-3">
                <a class="nav-link-modern " href="{{ url('/home') }}">
                   <i class="bi bi-grid-1x2-fill"></i>
                    <h5 class="fw-bold mt-1 text-muted">Tableau de bord</h5>
                </a>
            </div>

            <!-- Parc Informatique -->
            <div class="nav-item-modern mt-2 ">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#parcCollapse">
                    <i class="nav-icon bi bi-pc-display fs-6 "></i>
                    <span>Parc Informatique</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>

                <div class="collapse mt-2" id="parcCollapse">
                    <div class="nav-submenu">
                        <!-- Sous-menu Équipements -->
                        <a class="nav-link-modern collapsed py-2   " data-bs-toggle="collapse" href="#equipementCollapse">
                            <i class="bi bi-laptop"></i>
                            <span>Équipements</span>
                            <i class="nav-chevron bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse " id="equipementCollapse">
                            <div class="nav-submenu py-2">
                                <a href="{{ url('equipement') }}" class="submenu-item mt-2">
                                    <i class="bi bi-laptop"></i>
                                    Vue d'ensemble équipements
                                </a>
                                <a href="{{ url('ordinateur') }}" class="submenu-item mt-2">
                                    <i class="bi bi-laptop"></i>
                                    Ordinateurs
                                </a>
                                <a href="{{ url('moniteur') }}" class="submenu-item mt-2">
                                    <i class="bi bi-display"></i>
                                    Moniteurs
                                </a>
                                <a href="{{ url('logiciel') }}" class="submenu-item mt-2">
                                    <i class="bi bi-window"></i>
                                    Logiciels
                                </a>
                                <a href="{{ url('imprimante') }}" class="submenu-item mt-2">
                                    <i class="bi bi-printer"></i>
                                    Imprimantes
                                </a>
                                <a href="{{ url('materiel-reseau') }}" class="submenu-item mt-2 ">
                                    <i class="bi bi-hdd-network"></i>
                                    Matériel Réseaux
                                </a>
                                <a href="{{ url('telephone') }}" class="submenu-item mt-2">
                                    <i class="bi bi-telephone"></i>
                                    Téléphones
                                </a>
                                <a href="{{ url('peripherique') }}" class="submenu-item mt-2">
                                    <i class="bi bi-usb-symbol"></i>
                                    Périphériques
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Utilisateurs -->
            <div class="nav-item-modern mt-2">
                <a class="nav-link-modern mt-2 collapsed" data-bs-toggle="collapse" href="#usersCollapse">
                    <i class="nav-icon bi bi-people-fill fs-6 text-secondary"></i>
                    <span>Utilisateurs</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="usersCollapse">
                    <div class="nav-submenu">
                        <a href="{{ route('utilisateurDashboard') }}" class="mt-2 submenu-item">
                            <i class="bi bi-person-fill fs-6 text-secondary"></i>
                            Administrateur
                        </a>
                        <a href="{{ route('listeutilisateur') }}" class="submenu-item mt-2">
                            <i class="bi bi-person-fill fs-6 text-secondary"></i>
                            Utilisateurs
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tickets -->
            <div class="nav-item-modern mt-2">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#ticketsCollapse">
                    <i class="nav-icon bi bi-ticket-perforated-fill fs-6 text-secondary"></i>
                    <span>Ticket & Support</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse " id="ticketsCollapse">
                    <div class="nav-submenu">
                        <a href="{{ url('/ticket') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Gestion Tickets
                        </a>
                        
                    </div>
                </div>
            </div>

            <!-- Check-in / Check-out -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#checkoutcollaps">
                    <i class="nav-icon bi bi-arrow-left-right"></i>
                    <span>Check-in / Check-out</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="checkoutcollaps">
                    <div class="nav-submenu">
                        <a href="{{ route('checkoutadmin') }}" class="submenu-item mt-2">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Out/In
                        </a>
                        <a href="{{ route('checkout.reservation.list') }}" class="submenu-item mt-2">
                            <i class="bi bi-box-arrow-right"></i>
                            Reservation equipement
                        </a>
                        <a href="{{ url('??') }}" class="submenu-item mt-2">
                            <i class="bi bi-box-arrow-right"></i>
                            Rapport et statistique
                        </a>
                    </div>
                </div>
            </div>

            <!-- Incident -->
            <div class="nav-item-modern mt-2">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#incidentcollaps">
                    <i class="bi bi-exclamation-triangle-fill text-muted"></i>
                    <span>Incident</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse mt-2" id="incidentcollaps">
                    <div class="nav-submenu">
                       
                        <a href="{{ route('admin.incident.list') }}" class="submenu-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Gestion Incidents
                        </a>
                    </div>
                </div>
            </div>

            <!-- Documentation -->
            <div class="nav-item-modern mt-2">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#documentationCollapse">
                    <i class="bi bi-journal-text text-muted"></i>
                    <span>Documentation</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse mt-2" id="documentationCollapse">
                    <div class="nav-submenu">
                        <a href="#" class="submenu-item mt-2">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Nouveau
                        </a>
                        <a href="{{ route('documentation.admin-doc') }}" class="submenu-item mt-2">
                            <i class="bi bi-box-arrow-right"></i>
                            Gerer
                        </a>
                    </div>
                </div>
            </div>

            
            <!-- Gerer -->
            <div class="nav-item-modern mt-2">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#gestion">
                    <i class="bi bi-folder-fill text-secondary fs-6"></i>
                    <span>Gerer</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="gestion">
                    <div class="nav-submenu">
                        <a href="{{ route('admin.notifications') }}" class="submenu-item mt-2">
                            <i class="bi bi-bell-fill"></i>
                            Notifications
                        </a>
                        <a href="#" class="submenu-item mt-2">
                            <i class="bi bi-chat-dots"></i>
                            Chat
                        </a>
                        <a href="#" class="submenu-item mt-2">
                            <i class="bi bi-archive"></i>
                            Archive
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carte SIM -->
            <div class="nav-item-modern mt-2">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#simCollapse">
                    <i class="bi bi-sim text-secondary fs-6"></i>
                    <span> SIM</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="simCollapse">
                    <div class="nav-submenu">
                        @if(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isManager()))
                            <a href="{{ route('admin.sim.dashboard') }}" class="submenu-item mt-2">
                                <i class="bi bi-graph-up"></i>
                                Analyse
                            </a>
                            <a href="{{ route('admin.sim.list') }}" class="submenu-item mt-2">
                                <i class="bi bi-list-ul"></i>
                                Flotte SIM
                            </a>
                        @endif
                        
                        @if(Auth::check() && Auth::user()->isUser())
                            <a href="{{ route('utilisateur.sim.my-sims') }}" class="submenu-item mt-2">
                                <i class="bi bi-person-badge"></i>
                                Mes SIMs
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Paramètres -->
            <div class="nav-item-modern mt-2">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#settingsCollapse">
                    <i class="nav-icon bi bi-gear-fill fs-6 text-secondary"></i>
                    <span>Paramètres</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="settingsCollapse">
                    <div class="nav-submenu">
                        <a href="{{ url('/parametres') }}" class="submenu-item mt-2">
                            <i class="bi bi-circle"></i>
                            utilisateurs
                        </a>
                    </div>
                </div>
            </div>

            <!-- Configuration -->
            <div class="nav-item-modern mt-2">
                <a class="nav-link-modern {{ request()->routeIs('configuration') ? 'active' : '' }}" href="{{ route('configuration') }}">
                    <i class="nav-icon bi bi-sliders fs-6 text-secondary"></i>
                    <span>Configuration</span>
                </a>
            </div>
        </nav>

        <!-- Sidebar User Menu - Tout est regroupé ici (Profil, Notifications, Theme, Déconnexion) -->
        <div class="sidebar-user-menu">
            <div class="sidebar-dropdown" id="sidebarUserDropdown">
                <div class="sidebar-user-info" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="notification-badge">
                        @if(Auth::check() && Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle" width="36" height="36" alt="Photo" style="object-fit: cover; border: 2px solid #6366f1;">
                        @else
                            <img src="{{ asset('images/avtar_1.png') }}" class="rounded-circle" width="36" height="36" alt="Photo" style="object-fit: cover; border: 2px solid #6366f1;">
                        @endif
                        <!-- Badge pour les notifications non lues -->
                        <span class="badge-count" id="sidebarNotificationBadge" style="display: none;">0</span>
                    </div>
                    <div class="sidebar-user-details">
                        <div class="sidebar-user-name">{{ Auth::check() ? Auth::user()->name : 'Invité' }}</div>
                        <div class="sidebar-user-role">{{ Auth::check() && Auth::user()->role ? Auth::user()->role : 'Utilisateur' }}</div>
                    </div>
                    <i class="bi bi-chevron-up ms-auto" style="font-size: 0.7rem; color: #94a3b8;"></i>
                </div>

                <!-- Dropdown Menu complet -->
                <div class="sidebar-dropdown-menu">
                    <!-- User Info Header -->
                    <div class="text-center px-3 py-2">
                        @if(Auth::check() && Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle mb-2" width="56" height="56" alt="Photo" style="object-fit: cover; border: 3px solid #6366f1;">
                        @else
                            <img src="{{ asset('images/avtar_1.png') }}" class="rounded-circle mb-2" width="56" height="56" alt="Photo" style="object-fit: cover; border: 3px solid #6366f1;">
                        @endif
                        <div class="fw-bold" style="font-size: 0.85rem;">{{ Auth::check() ? Auth::user()->name : 'Invité' }}</div>
                        <div class="text-muted" style="font-size: 0.65rem;">{{ Auth::check() ? Auth::user()->email : '' }}</div>
                    </div>

                    <div class="sidebar-dropdown-divider"></div>

                    <!-- Profile Link -->
                    <a class="sidebar-dropdown-item" href="{{ url('/profile') }}">
                        <i class="bi bi-person-circle"></i>
                        <div>
                            <div class="fw-semibold">Mon Profil</div>
                            <small class="text-muted">Gérer vos informations</small>
                        </div>
                    </a>

                    <!-- Notifications Link avec Livewire -->
                    <div class="sidebar-dropdown-item" style="cursor: pointer;" onclick="toggleNotificationsPanel()">
                        <div class="notification-badge">
                            <i class="bi bi-bell-fill"></i>
                            <span class="badge-count" id="dropdownNotificationBadge" style="display: none;">0</span>
                        </div>
                        <div>
                            <div class="fw-semibold">Notifications</div>
                            <small class="text-muted">Voir vos alertes</small>
                        </div>
                    </div>

                    <!-- Theme Toggle Inline -->
                    <div class="theme-switch-inline" id="sidebarThemeToggle" onclick="toggleTheme()">
                        <div class="theme-toggle-icon">
                            <i id="themeIcon" class="bi bi-moon-stars-fill"></i>
                            <span>Thème</span>
                        </div>
                        <span id="themeText">Sombre</span>
                    </div>

                    <div class="sidebar-dropdown-divider"></div>

                    <!-- Settings Link -->
                    <a class="sidebar-dropdown-item" href="{{ url('/parametres') }}">
                        <i class="bi bi-gear-fill"></i>
                        <div>
                            <div class="fw-semibold">Paramètres</div>
                            <small class="text-muted">Préférences système</small>
                        </div>
                    </a>

                    <div class="sidebar-dropdown-divider"></div>

                    <!-- Disconnect Button -->
                    <a class="sidebar-dropdown-item logout" href="#" onclick="confirmLogout(event)" style="color: #dc2626;">
                        <i class="bi bi-box-arrow-right"></i>
                        <div>
                            <div class="fw-semibold">Déconnexion</div>
                            <small class="text-muted">Quitter votre session</small>
                        </div>
                    </a>

                    <!-- Footer -->
                    <div class="text-center mt-2 pt-2">
                        <small class="text-muted" style="font-size: 0.6rem;">Version 2.0.0 • GPI Pivot</small>
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