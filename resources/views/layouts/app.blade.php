<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GPI') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jsticket.js') }}" ></script>
    <script src="{{ asset('js/jsapp.js') }}" ></script>
    <script src="{{ asset('js/jsuser.js') }}" ></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('/monjs.js') }}"></script>


    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="{{asset('niceadmin/css/style.css')}}" rel="stylesheet">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cssticket.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleapp.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleuser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modalview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('/style.css') }}" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    {{-- aos --}}

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @livewireStyles
</head>
<body>
<div id="app">
    <!-- Modern Navbar -->
    <nav class="navbar-modern navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container-fluid">
            <!-- Logo and Brand -->
            <a class="navbar-brand-modern" href="{{ url('/home') }}">
                <img class="shadow-sm rounded-2" width="35" src="{{ asset('/images/logoPivot.png') }}" alt="">
                {{ config('app.name', 'GPI') }}
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

                <!-- User Menu -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <div class="user-dropdown" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/avtar_1.png') }}" class="user-avatar" width="40" height="40" alt="">
                                <span class="ms-2 fw-bold text-dark">{{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}</span>
                            </div>
                        </div>

                        <div class="dropdown-menu dropdown-menu-modern dropdown-menu-end">


                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item-modern text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modern Sidebar -->
    <aside class="sidebar-modern shadow-sm border-0" id="sidebarModern">



        <nav class="sidebar-nav-modern">
            <h6 class="nav-heading-modern">Visualisation</h6>

            <!-- Dashboard -->
            <div class="nav-item-modern">
                <a class="nav-link-modern" href="{{ url('/home') }}">
                    <i class="nav-icon bi bi-speedometer2"></i>
                    <span>Tableau de bord</span>
                </a>
            </div>

            <!-- Parc Informatique -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#parcCollapse">
                    <i class="nav-icon bi bi-pc-display"></i>
                    <span>Parc Informatique</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="parcCollapse">
                    <div class="nav-submenu">
                        <a href="{{ url('/equipements') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Équipements
                        </a>
                        <a href="{{ url('/inventaire') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Inventaire
                        </a>
                    </div>
                </div>
            </div>

            <!-- Utilisateurs -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#usersCollapse">
                    <i class="nav-icon bi bi-people"></i>
                    <span>Utilisateurs</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="usersCollapse">
                    <div class="nav-submenu">
                        <a href="{{ route('utilisateurDashboard') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Visualiser
                        </a>
                        <a href="{{ url('/utilisateurs/create') }}" class="submenu-item">
                            <i class="bi bi-circle"></i>
                            Ajouter
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tickets -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#ticketsCollapse">
                    <i class="nav-icon bi bi-ticket-perforated"></i>
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

            <!-- Utilisateurs -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#checkoutcollaps">
                    <i class="nav-icon bi bi-arrow-left-right"></i>
                    <span>Check-in / Check-out</span>
                    <i class="nav-chevron bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="checkoutcollaps">
                    <div class="nav-submenu">
                        <a href="{{ route('checkout') }}" class="submenu-item">
                            <i class=" bi bi-box-arrow-in-right"></i>
                            Check-in
                        </a>
                        <a href="{{ url('??') }}" class="submenu-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Check-out
                        </a>
                    </div>
                </div>
            </div>

            <h6 class="nav-heading-modern">Paramètres</h6>

            <!-- Paramètres -->
            <div class="nav-item-modern">
                <a class="nav-link-modern collapsed" data-bs-toggle="collapse" href="#settingsCollapse">
                    <i class="nav-icon bi bi-gear"></i>
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
</div>

@livewireScripts
<script src="{{ asset('js/modalview.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
