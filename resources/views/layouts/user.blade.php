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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    {{-- <link href="{{ asset('/style.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('css/cssticket.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleapp.css') }}" rel="stylesheet">




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
            background-color: #5BC4BF;
            border: none;
        }

        .btn-two:hover{
            color: #000 !important;
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
    </style>

    
    <style>
        .etap.remove {
            display: none;
        }

        .etap.active {
            display: block;
        }
    </style>
    @livewireStyles
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top sh ">
        <div class="container">
            <a class="navbar-brand text-white " href="{{ route('utilisateur') }}">
                <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40"
                    class="rounded-pill me-2">


                GPI - Pivot
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('utilisateurService') }}">• Ticket</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('checkout') }}">• Checkout</a></li>
                    <li class="nav-item"><a class="nav-link" href="#apropos">• À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">• Contact</a></li>
                    <li class="nav-item ms-lg-3 bg-teal dropdown dropdown-toggle"  id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <a href="#"
                            class="btn btn-one  text-white fw-bold text-sm rounded-pill px-3">
                            <img class="dropdown-toggle  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}"
                                alt="Profil" width="20" height="20" class="rounded-circle me-2">
                            {{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}</a>
                         
                            <ul class="dropdown-menu bg-white border-0 shadow-sm" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route("utilisateurProfile") }}"><i class="bi bi-person-fill me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    
                                            <a class="dropdown-item-modern text-danger" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i> Se déconnecter
                                            </a>

                                            <form id="logout-form" action="{{ route('utilisateurLogout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                </li>
                            </ul>
                        
                    </li>


                </ul>
            </div>
        </div>
    </nav>


    <div>
        <main>
            {{ $slot }}
        </main>
    </div>

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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <script>
    const toggle = document.getElementById('chatToggle');
    const popup = document.getElementById('chatPopup');
    const closeBtn = document.getElementById('chatClose');
    const messages = document.getElementById('messages');
    const input = document.getElementById('input');
    const sendBtn = document.getElementById('sendBtn');

    function openChat(){popup.classList.add('open');toggle.style.display='none';input.focus();scrollToBottom()}
    function closeChat(){popup.classList.remove('open');toggle.style.display='flex'}

    toggle.addEventListener('click',openChat);
    closeBtn.addEventListener('click',closeChat);

    // send message
    function appendMessage(text,who){
      const el = document.createElement('div');
      el.className = 'msg ' + (who === 'user' ? 'user' : 'agent');
      const now = new Date();
      const hh = now.getHours().toString().padStart(2,'0');
      const mm = now.getMinutes().toString().padStart(2,'0');
      el.innerHTML = text + '<small>' + (who === 'user' ? 'Vous' : 'Support') + ' · ' + hh + ':' + mm + '</small>';
      messages.appendChild(el);
      scrollToBottom();
    }

    function scrollToBottom(){messages.scrollTop = messages.scrollHeight}

    

    // simple escape to avoid injection when inserting HTML
    function escapeHtml(s){return s.replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'","&#39;")}

    // allow enter to send (shift+enter for newline)
    input.addEventListener('keydown', (e)=>{
      if(e.key === 'Enter' && !e.shiftKey){e.preventDefault();sendBtn.click();}
    });

    // accessibility: close with escape
    document.addEventListener('keydown', (e)=>{if(e.key === 'Escape' && popup.classList.contains('open')) closeChat();});
  </script>

</body>

</html>
