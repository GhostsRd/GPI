<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    <script src="{{ asset('js/theme.js') }}"></script>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    {{-- <link href="{{ asset('/style.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('css/cssticket.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleapp.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modern-theme.css') }}" rel="stylesheet">
    <link href='{{ asset('css/calendrier/assets/css/fullcalendar.css') }}' rel='stylesheet' />
    <link href='{{ asset('css/calendrier/assets/css/fullcalendar.print.css') }}' rel='stylesheet' media='print' />
    <script src='{{ asset('css/calendrier/assets/js/jquery-1.10.2.js') }}' type="text/javascript"></script>
    <script src='{{ asset('css/calendrier/assets/js/jquery-ui.custom.min.js') }}' type="text/javascript"></script>
    <script src='{{ asset('css/calendrier/assets/js/fullcalendar.js') }}' type="text/javascript"></script>

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/push.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fluxticket.css') }}">

    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">

    {{-- select multiple --}}

    <!-- main css -->
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    {{-- aos --}}

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        
        /* === Navbar === */
        .hero {
            background: url('https://picsum.photos/1200/500') center/cover no-repeat;
            /*color: white;*/
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .about {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .about h2 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .navbar {
            background: #5BC4BF !important;
            transition: all 0.4s ease;
            background: transparent;
        }

        .navbar.scrolled {
            background: #5BC4BF !important;
            color: #5BC4BF !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
            color: #fff;
        }

        .nav-link {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar.scrolled .navbar-brand .nav-link {
            color: #5BC4BF !important;
        }

        /* === Parallax === */
        .parallax-animated {
            background:
                url("{{ 'images/wave2.jpg' }}") no-repeat center fixed;
            background-size: cover;
            width: 100% !important;
            position: relative;
            overflow: hidden;
        }

        .parallax-footer {
            background:
                url("{{ 'images/footer.jpg' }}") no-repeat center fixed;
            background-size: cover;
            width: 100% !important;
            position: relative;
            overflow: hidden;
        }


        .parallax-section {
            background: no-repeat center fixed;
            background-size: cover;
            width: 100% !important;
            position: relative;
            overflow: hidden;
        }

        .wave-foot {

            width: 100%;


        }
        @media (max-width: 768px) {
        .bg-md-white-cust {
            background-color: white !important;
        }
    }


        .bg-blob {

            background-size: cover;
            background: url('waveti2.jpg') no-repeat;
        }

        .parallax-wave {
            width: 100%;

            background-size: cover;
            background: url('wave.jpg') no-repeat;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
        }

        .footer-wave {
            background: linear-gradient(#5bc4bf00, #c9c8c800, #ffffff4b),
                url('waveti2.jpg') no-repeat fied center;
            background-size: cover;

            position: relative;
            overflow: hidden;

        }

        /* === Waves === */
        .wave {
            position: relative;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave svg {
            position: relative;
            display: block;
            width: calc(132% + 1.3px);
            height: 100px;
        }

        .wave path {
            fill: #ffffff;
        }

        /* === Boutons === */
        .btn-one {
            background-color: #e65e4b;
            border: none;
        }

        .btn-two {
            background-color: #e65e4b;
            border: none;
        }

        .btn-two:hover {
            background-color: #d45241;
            color: #fff !important;
        }

        .btn-one:hover {
            background-color: #e65e4b;
        }

        /* === Couleurs === */
        .text-orange {
            color: #FF725E !important;
        }

        .text-teal {
            color: #5BC4BF !important;
        }

        .bg-teal {
            color: #5BC4BF !important;
        }

        .card-bg {
            background: #5BC4BF;
        }

        .bg-green {
            background: #b9d77e;
        }

        .bg-orange {
            background: #f9a66c;
        }

        .bg-blue {
            background: #8bd0e5;
        }

        /* === Navbar Premium Improvements === */
        .navbar-actions-group {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 15px;
        }

        .profile-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 12px;
            border-radius: 40px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            text-decoration: none !important;
            color: white !important;
        }

        .profile-trigger:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-avatar-container {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e65e4b;
        }

        .profile-name {
            font-size: 0.85rem;
            font-weight: 600;
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-separator {
            width: 1px;
            height: 24px;
            background: rgba(255, 255, 255, 0.2);
            margin: 0 5px;
        }

        .theme-toggle-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* === Feature cards === */
        .feature_item {
            transition: all 0.3s ease;
            border-radius: 15px;
            background: #fff;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .feature_item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .carousel-item {
            height: 100vh;
            background-size: cover;
            background-position: center;
        }

        .carousel-caption {
            bottom: 200px;
        }

        .section-title {
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 40px;
        }

        .card {
            border: none;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        section {
            padding: 80px 0;
        }

        footer {
            /*background: #111;*/
            color: #ccc;
            padding: 40px 0;
        }


        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 120px;
        }

        .wave path {
            fill: #f8f9fa;
            /* couleur de la vague */
        }

        .blob-bg {
            background: url("blob.jpg");
        }

        .etap.remove {
            display: none;
        }

        .etap.active {
            display: block;
        }
           .materiel-item {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .materiel-item:hover {
        background-color: #e9ecef;
        /* gris plus foncé */
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .modal-content {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .modal-backdrop.show {
        background-color: rgba(0, 0, 0, 0.2) !important;
        /* 0.2 = plus clair */
    }

    .modern-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        max-width: 550px;
    }

    .modern-label {
        font-weight: 600;
        color: #5f6a73;
        font-size: 15px;
    }

    .required {
        color: #e63946;
    }

    .modern-textarea {
        width: 100%;
        min-height: 10px;
        padding: 10px 14px;
        border: none;
        border-bottom: 1px solid #d0d7dd;
        /* border-radius: 8px; */
        font-size: 15px;
        resize: vertical;
        outline: none;
        transition: all .25s ease;
        background: #fff;
        color: #2d2d2d;
    }

    .modern-textarea:focus {
        border: 0;
        border-bottom: 1px solid #5BC4BF;
        /* box-shadow: 0 0 0 2px rgba(11, 170, 79, 0.15); */
    }

    .modern-textarea.invalid {
        border-color: #e63946;
        background: #fff8f8;
    }

    .error-text {
        font-size: 13px;
        color: #e63946;
        margin: 0;
    }
    </style>
    @livewireStyles
</head>

<body class="bg-light"   >
    <nav class="navbar navbar-expand-lg fixed-top sh ">
        <div class="container">
            
             @livewire('component.routing')  
      
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav mx-4">
                    <hr class="d-block d-lg-none">
                    <label for="" class="d-block d-lg-none fw-bold text-white">Menu</label>
                    <li class="nav-item"><a class="nav-link" href="{{ route('utilisateurService') }}">• Ticket</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('checkout') }}">• Checkout</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('utilisateur.incident') }}">• Incident</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('mes.reservation') }}">• Reservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">• Contact</a></li>

                    <hr class="d-block d-lg-none">
                    <div class="navbar-actions-group">
                        <!-- Profile Dropdown -->
                        <div class="dropdown" id="userDropdown">
                            <a href="#" class="profile-trigger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="profile-avatar-container">
                                    @if (empty(Auth::guard('utilisateur')->user()->photo))
                                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}&background=e65e4b&color=fff"
                                            alt="Profil" width="32" height="32">
                                    @else
                                        <img src="{{ asset('storage/' . Auth::guard('utilisateur')->user()->photo) }}"
                                            alt="Profil" width="32" height="32">
                                    @endif
                                </div>
                                <span class="profile-name">{{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end bg-white border-0 shadow-lg rounded-3 py-2"
                                aria-labelledby="userDropdown">
                                <!-- Profil -->
                                <li>
                                    <a class="dropdown-item d-flex align-items-center px-3 py-2"
                                        href="{{ url('/utilisateur-profile') }}">
                                        <i class="fas fa-user-circle me-2 text-primary"></i>
                                        <span>Mon profil</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center px-3 py-2"
                                        href="{{ url('/utilisateur-parametres') }}">
                                        <i class="fas fa-cog me-2 text-secondary"></i>
                                        <span>Paramètres</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center px-3 py-2 text-danger"
                                        href="{{ route('utilisateurLogout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        <span>Se déconnecter</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('utilisateurLogout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <!-- Separator -->
                        <div class="nav-separator d-none d-lg-block"></div>

                        <!-- Theme Toggle -->
                        <div class="theme-toggle-wrapper">
                            <div class="theme-switch theme-toggle-btn" title="Changer le thème"></div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <main>
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Effet de changement de navbar au scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 80);
        });
    </script>
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

      window.addEventListener('toggleSidebarmodel',()=>{
        const btn = document.getElementById('toggleSidebar');

           if(btn){btn.click();}
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const toggle = document.getElementById('chatToggle');
        const popup = document.getElementById('chatPopup');
        const closeBtn = document.getElementById('chatClose');
        const messages = document.getElementById('messages');
        const input = document.getElementById('input');
        const sendBtn = document.getElementById('sendBtn');

        function openChat() {
            popup.classList.add('open');
            toggle.style.display = 'none';
            input.focus();
            scrollToBottom()
        }

        function closeChat() {
            popup.classList.remove('open');
            toggle.style.display = 'flex'
        }

        toggle.addEventListener('click', openChat);
        closeBtn.addEventListener('click', closeChat);

        // send message
        function appendMessage(text, who) {
            const el = document.createElement('div');
            el.className = 'msg ' + (who === 'user' ? 'user' : 'agent');
            const now = new Date();
            const hh = now.getHours().toString().padStart(2, '0');
            const mm = now.getMinutes().toString().padStart(2, '0');
            el.innerHTML = text + '<small>' + (who === 'user' ? 'Vous' : 'Support') + ' · ' + hh + ':' + mm + '</small>';
            messages.appendChild(el);
            scrollToBottom();
        }

        function scrollToBottom() {
            messages.scrollTop = messages.scrollHeight
        }



        // simple escape to avoid injection when inserting HTML
        function escapeHtml(s) {
            return s.replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;')
                .replaceAll("'", "&#39;")
        }

        // allow enter to send (shift+enter for newline)
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendBtn.click();
            }
        });

        // accessibility: close with escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && popup.classList.contains('open')) closeChat();
        });
    </script>

</body>

</html>
