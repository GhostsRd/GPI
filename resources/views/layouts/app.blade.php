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
                        <a href="{{ route('admin.notifications') }}" class="submenu-item">
                            <i class="bi bi-bell-fill"></i>
                            Notifications
                        </a>
                        <a href="#" class="submenu-item">
                            <i class="bi bi-chat-dots"></i>
                            Chat
                        </a>
                        <a href="#" class="submenu-item">
                            <i class="bi bi-archive"></i>
                            Archive
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carte SIM -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#simCollapse">
                    <i class="bi bi-sim text-secondary fs-6"></i>
                    <span>Gestion SIM</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="simCollapse">
                    <div class="nav-submenu">
                        @if(Auth::user()->isAdmin() || Auth::user()->isManager())
                            <a href="{{ route('admin.sim.dashboard') }}" class="submenu-item">
                                <i class="bi bi-graph-up"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('admin.sim.list') }}" class="submenu-item">
                                <i class="bi bi-list-ul"></i>
                                Flotte SIM
                            </a>
                        @endif
                        
                        @if(Auth::user()->isUser())
                            <a href="{{ route('utilisateur.sim.my-sims') }}" class="submenu-item">
                                <i class="bi bi-person-badge"></i>
                                Mes SIMs
                            </a>
                        @endif
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

<!-- Styles supplémentaires pour les notifications -->
<style>
    /* Style pour la cloche de notification */
    .notification-bell {
        position: relative;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    [data-bs-theme="dark"] .notification-bell {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.1);
    }

    .notification-bell:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #6366f1;
    }
    
    .notification-bell i {
        color: #64748b;
        font-size: 1.25rem;
        transition: all 0.3s ease;
    }
    
    .notification-bell:hover i {
        color: #6366f1;
        transform: rotate(15deg);
    }
    
    /* Indicateur de notification (Ping) */
    .notification-bell.has-notifications::after {
        content: '';
        position: absolute;
        top: 8px;
        right: 8px;
        width: 10px;
        height: 10px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid white;
        z-index: 2;
        box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
    }

    [data-bs-theme="dark"] .notification-bell.has-notifications::after {
        border-color: #1e293b;
    }

    /* Animation pour la cloche */
    @keyframes bellShake {
        0% { transform: rotate(0); }
        15% { transform: rotate(15deg); }
        30% { transform: rotate(-15deg); }
        45% { transform: rotate(10deg); }
        60% { transform: rotate(-10deg); }
        75% { transform: rotate(5deg); }
        85% { transform: rotate(-5deg); }
        100% { transform: rotate(0); }
    }
    
    .notification-bell.has-notifications i {
        animation: bellShake 1.5s ease-in-out infinite;
        color: #f59e0b;
    }
    
    /* Animation de pulsation (Ping) */
    @keyframes pingEffect {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(2.5); opacity: 0; }
    }

    .notification-bell.has-notifications::before {
        content: '';
        position: absolute;
        top: 8px;
        right: 8px;
        width: 10px;
        height: 10px;
        background: #ef4444;
        border-radius: 50%;
        z-index: 1;
        animation: pingEffect 2s cubic-bezier(0, 0, 0.2, 1) infinite;
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
    /* Animation pour le dropdown des notifications */
    .notification-dropdown {
        transform-origin: top right;
        animation: dropdownFadeIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    @keyframes dropdownFadeIn {
        from { 
            opacity: 0; 
            transform: translateY(15px) scale(0.95); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0) scale(1); 
        }
    }
</style>
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

    <script>
        // Script pour les notifications - Mis à jour pour Livewire
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