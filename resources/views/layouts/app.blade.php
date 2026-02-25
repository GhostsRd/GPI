<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        /* Style pour le bouton de déconnexion */
        .logout-btn {
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 4px 8px;
        }
        .logout-btn:hover {
            background-color: #fee2e2 !important;
            color: #dc2626 !important;
            transform: translateX(5px);
        }
        .dropdown-item i {
            transition: transform 0.2s;
        }
        .dropdown-item:hover i {
            transform: scale(1.1);
        }
        /* Séparateur élégant */
        .dropdown-divider {
            margin: 8px 16px;
            opacity: 0.6;
        }
    </style>
</head>
<body>
<div id="app">
    <!-- Modern Navbar -->
    <nav class="navbar-modern navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container-fluid">
            <!-- Logo and Brand -->
            <a class="navbar-brand-modern text-muted" href="{{ url('/home') }}">
                <img class="shadow-sm rounded-pill" width="35" src="{{ asset('/images/logoPivot.png') }}" alt="">
                GPI - Pivot
            </a>

            <!-- Mobile Toggle -->
            <button id="mobileMenuToggle" class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Theme Toggle -->
                <button id="themeToggle" class="theme-toggle ms-auto">
                    <i id="themeIcon" class="bi {{ session('theme', 'light') === 'light' ? 'bi-moon' : 'bi-sun' }}"></i>
                </button>

                <!-- Notifications -->
                <div class="nav-item dropdown me-2">
                    <div class="dropdown-menu dropdown-menu-modern dropdown-menu-end">
                        <!-- Notification items -->
                    </div>
                </div>

                <!-- User Menu avec Déconnexion -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="user-dropdown nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                            <div class="d-flex align-items-center">
                                @if(Auth::check() && Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="user-avatar rounded-circle" width="40" height="40" alt="Photo de profil" style="object-fit: cover; border: 2px solid #6366f1;">
                                @else
                                    <img src="{{ asset('images/avtar_1.png') }}" class="user-avatar rounded-circle" width="40" height="40" alt="Photo par défaut" style="object-fit: cover; border: 2px solid #6366f1;">
                                @endif
                                <span class="ms-2 fw-bold text-dark">
                                    {{ Auth::check() ? Auth::user()->name : 'Invité' }}
                                </span>
                                <i class="bi bi-chevron-down ms-1" style="font-size: 0.8rem; color: #6b7280;"></i>
                            </div>
                        </a>

                        <!-- Dropdown Menu avec Déconnexion -->
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="min-width: 280px; border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15); padding: 1rem 0.5rem; background: white; z-index: 9999;">

                            <!-- User Info Header -->
                            <div class="px-4 py-3 text-center">
                                <div class="position-relative d-inline-block">
                                    @if(Auth::check() && Auth::user()->photo)
                                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle mb-2" width="72" height="72" alt="Photo" style="object-fit: cover; border: 4px solid #6366f1; box-shadow: 0 4px 12px rgba(99,102,241,0.3);">
                                    @else
                                        <img src="{{ asset('images/avtar_1.png') }}" class="rounded-circle mb-2" width="72" height="72" alt="Photo" style="object-fit: cover; border: 4px solid #6366f1; box-shadow: 0 4px 12px rgba(99,102,241,0.3);">
                                    @endif
                                    <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle p-1"></span>
                                </div>
                                <div class="fw-bold" style="font-size: 1.1rem;">{{ Auth::check() ? Auth::user()->name : 'Invité' }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">{{ Auth::check() ? Auth::user()->email : '' }}</div>
                                @if(Auth::check() && Auth::user()->role)
                                    <span class="badge bg-primary bg-opacity-10 text-primary mt-1 px-3 py-1 rounded-pill" style="font-size: 0.7rem; font-weight: 600;">
                                        {{ Auth::user()->role }}
                                    </span>
                                @endif
                            </div>

                            <!-- Menu Items -->
                            <div class="mt-2">
                                <!-- Profile Link -->
                                <a class="dropdown-item d-flex align-items-center px-4 py-2 rounded-3" href="{{ url('/profile') }}" style="font-size: 0.9rem; transition: all 0.2s;">
                                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; background: #eef2ff; border-radius: 10px;">
                                        <i class="bi bi-person-circle" style="color: #6366f1; font-size: 1.1rem;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Mon Profil</div>
                                        <small class="text-muted">Gérer vos informations</small>
                                    </div>
                                </a>

                                <!-- Settings Link (Optionnel) -->
                                <a class="dropdown-item d-flex align-items-center px-4 py-2 rounded-3" href="{{ url('/parametres') }}" style="font-size: 0.9rem; transition: all 0.2s;">
                                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; background: #f3e8ff; border-radius: 10px;">
                                        <i class="bi bi-gear-fill" style="color: #8b5cf6; font-size: 1.1rem;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Paramètres</div>
                                        <small class="text-muted">Préférences système</small>
                                    </div>
                                </a>

                                <!-- Divider -->
                                <div class="dropdown-divider my-2"></div>

                                <!-- Disconnect Button -->
                                <a class="dropdown-item d-flex align-items-center px-4 py-2 rounded-3 logout-btn" 
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   style="font-size: 0.9rem; color: #dc2626;">
                                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; background: #fee2e2; border-radius: 10px;">
                                        <i class="bi bi-box-arrow-right" style="color: #dc2626; font-size: 1.1rem;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Déconnexion</div>
                                        <small class="text-muted">Quitter votre session</small>
                                    </div>
                                </a>
                            </div>

                            <!-- Footer -->
                            <div class="px-4 mt-3 pt-2 text-center border-top" style="border-color: #f3f4f6 !important;">
                                <small class="text-muted" style="font-size: 0.7rem;">Version 2.0.0 • GPI Pivot</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <!-- Dans la section du navbar, juste avant le User Menu -->
<!-- Notifications -->
<ul class="navbar-nav me-3">
    <li class="nav-item dropdown">
        <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="notification-bell">
                <i class="bi bi-bell fs-5"></i>
                <!-- Badge de notification (à activer dynamiquement) -->
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; display: none;">
                    3
                    <span class="visually-hidden">notifications non lues</span>
                </span>
            </div>
        </a>

        <!-- Dropdown des notifications -->
        <div class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdown" style="width: 380px; max-width: 380px; border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15); padding: 0; background: white; z-index: 9999;">

            <!-- En-tête des notifications -->
            <div class="notification-header d-flex justify-content-between align-items-center p-3 border-bottom" style="background: #f8fafc; border-radius: 20px 20px 0 0;">
                <div>
                    <h6 class="mb-0 fw-bold">Notifications</h6>
                    <small class="text-muted">3 non lues</small>
                </div>
                <div>
                    <button class="btn btn-sm btn-link text-primary text-decoration-none" onclick="markAllAsRead()">
                        <i class="bi bi-check2-all"></i> Tout marquer comme lu
                    </button>
                </div>
            </div>

            <!-- Liste des notifications -->
            <div class="notification-list" style="max-height: 400px; overflow-y: auto;">
                <!-- Notification non lue -->
                <a href="#" class="dropdown-item notification-item unread px-3 py-3 border-bottom" style="background: #f0f9ff; transition: all 0.2s;">
                    <div class="d-flex">
                        <div class="notification-icon me-3">
                            <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #e0f2fe; border-radius: 12px;">
                                <i class="bi bi-ticket-perforated text-primary" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                        <div class="notification-content flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1 fw-semibold" style="font-size: 0.9rem;">Nouveau ticket créé</p>
                                    <small class="text-muted d-block">Ticket #1234 a été créé par Jean Dupont</small>
                                </div>
                                <small class="text-muted ms-2" style="font-size: 0.7rem;">5 min</small>
                            </div>
                            <div class="mt-1">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill" style="font-size: 0.6rem;">Ticket</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Notification non lue -->
                <a href="#" class="dropdown-item notification-item unread px-3 py-3 border-bottom" style="background: #f0f9ff;">
                    <div class="d-flex">
                        <div class="notification-icon me-3">
                            <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #dcfce7; border-radius: 12px;">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                        <div class="notification-content flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1 fw-semibold" style="font-size: 0.9rem;">Check-out approuvé</p>
                                    <small class="text-muted d-block">Votre demande pour l'ordinateur portable a été approuvée</small>
                                </div>
                                <small class="text-muted ms-2" style="font-size: 0.7rem;">30 min</small>
                            </div>
                            <div class="mt-1">
                                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill" style="font-size: 0.6rem;">Check-out</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Notification lue -->
                <a href="#" class="dropdown-item notification-item px-3 py-3 border-bottom">
                    <div class="d-flex">
                        <div class="notification-icon me-3">
                            <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #fef9c3; border-radius: 12px;">
                                <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                        <div class="notification-content flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1 fw-semibold" style="font-size: 0.9rem;">Maintenance planifiée</p>
                                    <small class="text-muted d-block">Maintenance du serveur prévue demain à 14h</small>
                                </div>
                                <small class="text-muted ms-2" style="font-size: 0.7rem;">2h</small>
                            </div>
                            <div class="mt-1">
                                <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill" style="font-size: 0.6rem;">Système</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Notification lue -->
                <a href="#" class="dropdown-item notification-item px-3 py-3 border-bottom">
                    <div class="d-flex">
                        <div class="notification-icon me-3">
                            <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #f3e8ff; border-radius: 12px;">
                                <i class="bi bi-person-plus-fill text-purple" style="color: #8b5cf6; font-size: 1.2rem;"></i>
                            </div>
                        </div>
                        <div class="notification-content flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1 fw-semibold" style="font-size: 0.9rem;">Nouvel utilisateur</p>
                                    <small class="text-muted d-block">Marie Martin a rejoint l'équipe</small>
                                </div>
                                <small class="text-muted ms-2" style="font-size: 0.7rem;">1j</small>
                            </div>
                            <div class="mt-1">
                                <span class="badge bg-purple bg-opacity-10 text-purple px-2 py-1 rounded-pill" style="color: #8b5cf6; font-size: 0.6rem;">Utilisateur</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Footer des notifications -->
            <div class="notification-footer p-3 text-center border-top">
                <a href="#" class="text-decoration-none text-primary small fw-semibold">
                    Voir toutes les notifications
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </li>
</ul>

<!-- Styles supplémentaires pour les notifications -->
<style>
    /* Style pour la cloche de notification */
    .notification-bell {
        position: relative;
        padding: 8px;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .notification-bell:hover {
        background: #eef2ff;
        transform: scale(1.05);
    }
    
    .notification-bell i {
        color: #4b5563;
        transition: color 0.3s;
    }
    
    .notification-bell:hover i {
        color: #6366f1;
    }
    
    /* Style pour les items de notification */
    .notification-item {
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }
    
    .notification-item:hover {
        background: #f8fafc !important;
        transform: translateX(5px);
        border-left-color: #6366f1;
    }
    
    .notification-item.unread:hover {
        background: #e6f4ff !important;
    }
    
    /* Animation pour la cloche */
    @keyframes bellShake {
        0% { transform: rotate(0); }
        15% { transform: rotate(5deg); }
        30% { transform: rotate(-5deg); }
        45% { transform: rotate(4deg); }
        60% { transform: rotate(-4deg); }
        75% { transform: rotate(2deg); }
        85% { transform: rotate(-2deg); }
        92% { transform: rotate(1deg); }
        100% { transform: rotate(0); }
    }
    
    .notification-bell.has-notifications {
        animation: bellShake 1s ease-in-out;
    }
    
    /* Scroll personnalisé pour la liste des notifications */
    .notification-list::-webkit-scrollbar {
        width: 6px;
    }
    
    .notification-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .notification-list::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .notification-list::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<!-- Script pour les notifications -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simuler des notifications non lues (à remplacer par des données dynamiques)
        const hasUnread = true;
        const unreadCount = 3;
        
        const badge = document.querySelector('.notification-bell .badge');
        if (badge && hasUnread) {
            badge.style.display = 'inline';
            badge.textContent = unreadCount;
            
            // Ajouter l'animation si des notifications non lues
            document.querySelector('.notification-bell').classList.add('has-notifications');
        }
        
        // Animation de la cloche au clic
        const notificationBell = document.querySelector('.notification-bell');
        if (notificationBell) {
            notificationBell.addEventListener('click', function() {
                this.classList.remove('has-notifications');
            });
        }
    });
    
    // Fonction pour marquer toutes les notifications comme lues
    function markAllAsRead() {
        const unreadItems = document.querySelectorAll('.notification-item.unread');
        unreadItems.forEach(item => {
            item.classList.remove('unread');
            item.style.background = '';
        });
        
        // Cacher le badge
        const badge = document.querySelector('.notification-bell .badge');
        if (badge) {
            badge.style.display = 'none';
        }
        
        // Mettre à jour le compteur dans l'en-tête
        const unreadText = document.querySelector('.notification-header small');
        if (unreadText) {
            unreadText.textContent = '0 non lue';
        }
        
        // Afficher une notification de succès
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'Toutes les notifications ont été marquées comme lues',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
</script>
    <!-- Modern Sidebar -->
    <aside class="sidebar-modern shadow border-0" style="z-index: 1000 !important" id="sidebarModern">
        <nav class="sidebar-nav-modern">
            <div class="card border-0 m-0 mb-2 border-bottom rounded-0 border-secondary border-5">
                <label for="" class="fw-bold text-muted text-light">Gestion de Parc Informatique</label>
            </div>

            <!-- Dashboard -->
            <div class="nav-item-modern">
                <a class="nav-link-modern" href="{{ url('/home') }}">
                    <i class="nav-icon bi bi-speedometer2 fs-6 text-secondary"></i>
                    <span>Tableau de bord</span>
                </a>
            </div>

            <!-- Parc Informatique -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#parcCollapse">
                    <i class="nav-icon bi bi-pc-display fs-6 text-secondary"></i>
                    <span>Parc Informatique</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>

                <div class="collapse" id="parcCollapse">
                    <div class="nav-submenu">
                        <!-- Sous-menu Équipements -->
                        <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#equipementCollapse">
                            <i class="bi bi-laptop"></i>
                            <span>Équipements</span>
                            <i class="nav-chevron bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse" id="equipementCollapse">
                            <div class="nav-submenu">
                                <a href="{{ url('equipement') }}" class="submenu-item">
                                    <i class="bi bi-laptop"></i>
                                    Vue d'ensemble équipements
                                </a>
                                <a href="{{ url('ordinateur') }}" class="submenu-item">
                                    <i class="bi bi-laptop"></i>
                                    Ordinateurs
                                </a>
                                <a href="{{ url('moniteur') }}" class="submenu-item">
                                    <i class="bi bi-display"></i>
                                    Moniteurs
                                </a>
                                <a href="{{ url('logiciel') }}" class="submenu-item">
                                    <i class="bi bi-window"></i>
                                    Logiciels
                                </a>
                                <a href="{{ url('imprimante') }}" class="submenu-item">
                                    <i class="bi bi-printer"></i>
                                    Imprimantes
                                </a>
                                <a href="{{ url('materiel-reseau') }}" class="submenu-item">
                                    <i class="bi bi-hdd-network"></i>
                                    Matériel Réseaux
                                </a>
                                <a href="{{ url('telephone') }}" class="submenu-item">
                                    <i class="bi bi-telephone"></i>
                                    Téléphones
                                </a>
                                <a href="{{ url('peripherique') }}" class="submenu-item">
                                    <i class="bi bi-usb-symbol"></i>
                                    Périphériques
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Utilisateurs -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#usersCollapse">
                    <i class="nav-icon bi bi-people-fill fs-6 text-secondary"></i>
                    <span>Utilisateurs</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="usersCollapse">
                    <div class="nav-submenu">
                        <a href="{{ route('utilisateurDashboard') }}" class="submenu-item">
                            <i class="bi bi-person-fill fs-6 text-secondary"></i>
                            Administrateur
                        </a>
                        <a href="{{ route('listeutilisateur') }}" class="submenu-item">
                            <i class="bi bi-person-fill fs-6 text-secondary"></i>
                            Utilisateurs
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tickets -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#ticketsCollapse">
                    <i class="nav-icon bi bi-ticket-perforated-fill fs-6 text-secondary"></i>
                    <span>Ticket & Support</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="ticketsCollapse">
                    <div class="nav-submenu">
                        <a href="{{ url('/ticket') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Gestion Tickets
                        </a>
                        <a href="{{ url('/ticket/create') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Nouveau Ticket
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
                        <a href="{{ route('checkoutadmin') }}" class="submenu-item">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Out/In
                        </a>
                        <a href="{{ route('checkout.reservation.list') }}" class="submenu-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Reservation equipement
                        </a>
                        <a href="{{ url('??') }}" class="submenu-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Rapport et statistique
                        </a>
                    </div>
                </div>
            </div>

            <!-- Incident -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#incidentcollaps">
                    <i class="bi bi-exclamation-triangle-fill text-muted"></i>
                    <span>Incident</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="incidentcollaps">
                    <div class="nav-submenu">
                        <a href="#" class="submenu-item">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Nouveau
                        </a>
                        <a href="{{ route('admin.incident.list') }}" class="submenu-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Gerer
                        </a>
                    </div>
                </div>
            </div>

            <!-- Documentation -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#documentationCollapse">
                    <i class="bi bi-journal-text text-muted"></i>
                    <span>Documentation</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="documentationCollapse">
                    <div class="nav-submenu">
                        <a href="#" class="submenu-item">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Nouveau
                        </a>
                        <a href="{{ route('documentation.admin-doc') }}" class="submenu-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Gerer
                        </a>
                    </div>
                </div>
            </div>

            <!-- Gerer -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#gestion">
                    <i class="bi bi-folder-fill text-secondary fs-6"></i>
                    <span>Gerer</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="gestion">
                    <div class="nav-submenu">
                        <a href="#" class="submenu-item">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Commentaire
                        </a>
                        <a href="#" class="submenu-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Chat
                        </a>
                        <a href="#" class="submenu-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Archive
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carte SIM -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#simCollapse">
                    <span>Carte SIM</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="simCollapse">
                    <div class="nav-submenu">
                        <a href="{{ url('/produit') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Flotte
                        </a>
                        <a href="{{ url('/parametres') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            --
                        </a>
                    </div>
                </div>
            </div>

            <h6 class="border-bottom rounded-0 border-secondary border-5"></h6>

            <!-- Paramètres -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#settingsCollapse">
                    <i class="nav-icon bi bi-gear-fill fs-6 text-secondary"></i>
                    <span>Paramètres</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="settingsCollapse">
                    <div class="nav-submenu">
                        <a href="{{ url('/produit') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Produits
                        </a>
                        <a href="{{ url('/parametres') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Configuration
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content-modern">
        {{ $slot }}
    </main>

    <!-- Formulaire caché pour la déconnexion -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({ once: true });

    Livewire.hook('message.processed', () => {
        AOS.refresh();
    });

    // Animation supplémentaire pour le bouton de déconnexion
    document.addEventListener('DOMContentLoaded', function() {
        const logoutBtn = document.querySelector('.logout-btn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
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
            });
        }
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
</body>
</html>