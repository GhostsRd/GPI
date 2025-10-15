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
    <script src="{{ asset('/monjs.js') }}"></script>


    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    <link href="{{ asset('/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/cssticket.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleapp.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleuser.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modalview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleequipement.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/push.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fluxticket.css') }}">


    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">

    {{-- select multiple --}}
        
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- aos --}}

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @livewireStyles
</head>

<body class="light-mode">
    <div id="app">

        <header class="">
            <nav class="navbar success navbar-expand-md navbar-light bg-white shadow-sm ">
                <div class="container">
                    <!-- Logo -->
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('utilisateur') }}">
                        <img id="logoPivot" width="30" src="{{ asset('images/logog.png') }}" alt="Pivot ONG">
                        <span class="fw-bold">PI - Pivot</span>
                    </a>

                    <div class="collapse navbar-collapse">

                        <ul class="navbar-nav align-items-center offset-lg-1 ">
                            <!-- Home -->
                            <li class="nav-item ms-3">
                                <a class="nav-link" href="{{ route('utilisateur') }}" title="Accueil">
                                    Home
                                </a>
                            </li>

                            <!-- Chat -->
                            <li class="nav-item ms-3">
                                <a class="nav-link" href="{{ route('utilisateurService') }}">
                                    Ticket

                                </a>
                            </li>
                            <li class="nav-item ms-3">
                                <a class="nav-link" href="#">
                                    Checkout

                                </a>
                            </li>
                            <li class="nav-item ms-3">
                                <a class="nav-link" href="#">
                                    Equipement

                                </a>
                            </li>
                            <li class="nav-item ms-3">
                                <a class="nav-link" href="#">
                                    Documentation

                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Toggle button for mobile -->
                    <a class="navbar-toggler" data-bs-toggle="collapse">
                        <div class="col-lg-1 col-mg-1 col-sm-1">
                            <span class=" " data-bs-toggle="offcanvas" data-bs-target="#infoTicket"><svg
                                    width="30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </span>
                        </div>
                    </a>





                    <!-- Navbar links -->
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav align-items-center">
                            <!-- Home -->
                  

                            <!-- Chat -->
                            <li class="nav-item ms-3">
                                <a class="nav-link" href="#" id="openChatBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                    </svg>
                                    <sub class="text-danger fw-bold  rounded-5 "> 1</sub>
                                </a>
                            </li>
                            <!-- Profile -->
                            <li class="nav-item ms-3">
                                <div class="dropdown">

                                    <img class="dropdown-toggle rounded-pill" data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}"
                                        alt="Profil" width="40" height="40"
                                        class="rounded-circle me-2"><span
                                        class="text-capitalize">{{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}</span>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('utilisateurProfile') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="rounded-circle shadow-sm">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                            Profile</a>



                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">

                                            <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                            </svg>
                                            Deconnecter</a>
                                        <form id="logout-form" action="{{ route('utilisateurLogout') }}"
                                            method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>

              
        </li> 
                        </ul>
                    </div>
                </div>
            </nav>

    </div>
    </header>


    {{-- chatbot --}}

    <!-- Fenêtre de chat -->
    <aside id="chatPopup" class="card position-fixed bottom-0 end-0 m-4 shadow-sm border-0"
        style="width: 350px; height: 450px; display: none; z-index: 1055;">

        <!-- En-tête -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="bg-light text-primary fw-bold rounded-circle d-flex justify-content-center align-items-center me-2"
                    style="width: 30px; height: 30px;">
                    GP
                </div>
                <div>
                    <h6 class="mb-0">GPISupport — Chat</h6>
                    <small>Général · réponse sous 1h</small>
                </div>
            </div>
            <button type="button" id="closeChatBtn" class="btn btn-light btn-sm" aria-label="Fermer">✕</button>
        </div>


        <!-- Pied -->
        <div class="card-footer bg-white">
            <form class="d-flex w-100" wire:submit.prevent="storechat">
                <textarea class="form-control me-2" wire:model="message" rows="1" placeholder="Écris un message..."></textarea>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>

    </aside>

    {{-- fin chatmsg --}}



    <div class="container-fluid">
        <div>
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
    </div>




    </div>

    <div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="infoTicket" aria-labelledby="infoTicketLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="infoTicketLabel">
                <i class="bi bi-person-workspace me-2 text-primary"></i> GPI - Pivot
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
        </div>

        <div class="offcanvas-body">
            <nav class="nav flex-column">
                <a href="#" class="nav-link text-dark">
                    <i class="bi bi-house-door me-2 text-primary"></i> Accueil
                </a>
                <a href="{{ route('utilisateurService') }}" class="nav-link text-dark">
                    <i class="bi bi-gear me-2 text-primary"></i> Ticket
                </a>

                <a href="#services" class="nav-link text-dark">
                    <i class="bi bi-gear me-2 text-primary"></i> Checkout
                </a>

                <a href="#" class="nav-link text-dark">
                    <i class="bi bi-clock-history me-2 text-primary"></i> Equipement
                </a>
                <a href="#" class="nav-link text-dark">
                    <i class="bi bi-clock-history me-2 text-primary"></i> Documentation
                </a>

                <a href="#" class="nav-link text-dark">
                    <div class="dropdown border">

                        <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-toggle shadow-sm rounded-5"
                            width="30" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="rounded-circle shadow-sm">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg> <span
                            class="text-capitalize">{{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}</span>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('utilisateurProfile') }}">Modifier</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">Deconnecter</a>
                            <form id="logout-form" action="{{ route('utilisateurLogout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </a>
                <hr>
            </nav>
        </div>

    </div>




    @livewireScripts
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   
    <script>
        AOS.init({
            once: true
        });

        Livewire.hook('message.processed', () => {
            AOS.refresh(); // réactive les animations pour les nouveaux éléments
        });

          
    </script>
    <script src="{{ asset('js/modalview.js') }}"></script>
    <script>
        const openChatBtn = document.getElementById('openChatBtn');
        const closeChatBtn = document.getElementById('closeChatBtn');
        const chatPopup = document.getElementById('chatPopup');

        openChatBtn.addEventListener('click', () => {
            chatPopup.style.display = 'block';
            openChatBtn.style.display = 'none';
        });

        closeChatBtn.addEventListener('click', () => {
            chatPopup.style.display = 'none';
            openChatBtn.style.display = 'block';
        });
    </script>
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            document.body.classList.toggle('sidebar-open');
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/stellar.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendors/isotope/isotope-min.js') }}"></script>
    <script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{ asset('js/gmaps.min.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    


</body>

</html>
