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

    <link href="{{asset('niceadmin/css/style.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/style.css') }}" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/owl-carousel/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
	<link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
  
	<!-- main css -->
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{-- aos --}}

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @livewireStyles
</head>
<body class="light-mode">
    <div id="app">
        
<header class="">
	<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('utilisateur') }}">
      <img id="logoPivot" src="{{ asset('images/logoPivot.png') }}" alt="Pivot ONG">
      <span class="fw-bold">Pivot ONG</span>
    </a>

    <!-- Toggle button for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav align-items-center">
        <!-- Home -->
        <li class="nav-item ms-3">
          <a class="nav-link" href="{{ route('utilisateur') }}" title="Accueil">
            <svg width="25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12 8.954 3.045c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
            </svg>
          </a>
        </li>

        <!-- Chat -->
        <li class="nav-item ms-3">
          <a class="nav-link" href="#" id="chatToggle" title="Ouvrir le chat">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
            </svg>
            <sub class="text-danger fw-bold  rounded-5 "> 1</sub>
          </a>
        </li>

        {{-- Membre --}}
          <li class="nav-item ms-3">
          <a class="nav-link" href="{{route('utilisateurMembre')}}"  title="Membres">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>

            </a>
            </li>

        <!-- Profile -->
        <li class="nav-item ms-3">
          <a class="nav-link d-flex align-items-center" href="{{ route('utilisateurProfile') }}" title="Profil">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="rounded-circle shadow-sm">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
          </a>
        </li>

        <!-- Dark/Light mode toggle -->
        <li class="nav-item ms-3">
          <button class="btn btn-sm btn-outline-secondary" id="modeToggle">🌙</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

		</div>
	</header>


  

        <div class="container-fluid">
                <div >
                    <main >
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

    </div>





    <footer class="footer_area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<div class="footer_top flex-column">
						<div class="footer_logo">
							<a href="#">
								<h1>GPI</h1>
								<!-- <img src="img/logo.png" alt=""> -->
							</a>
							<h4>Follow Me</h4>
						</div>
						<div class="footer_social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row footer_bottom justify-content-center">
				<p class="col-lg-8 col-sm-12 footer-text">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
			</div>
		</div>
	</footer>
    @livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Dark / Light mode
const modeBtn = document.getElementById('modeToggle');
modeBtn.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  modeBtn.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
});
</script>

    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('js/popper.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/stellar.js')}}"></script>
	<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{asset('vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{asset('vendors/isotope/isotope-min.js')}}"></script>
	<script src="{{asset('vendors/owl-carousel/owl.carousel.min.js')}}"></script>
	<script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
	<script src="{{asset('js/mail-script.js')}}"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="{{asset('js/gmaps.min.js')}}"></script>
	<script src="{{asset('js/theme.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}
    <script> </script>
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

    sendBtn.addEventListener('click', ()=>{
      const v = input.value.trim();
      if(!v) return;
      appendMessage(escapeHtml(v),'user');
      input.value = '';
      // simulate reply
      setTimeout(()=>{appendMessage('Merci, nous regardons ça et revenons vers vous.', 'agent')}, 800);
    });

    // simple escape to avoid injection when inserting HTML
    function escapeHtml(s){return s.replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'","&#39;")}

    // allow enter to send (shift+enter for newline)
    input.addEventListener('keydown', (e)=>{
      if(e.key === 'Enter' && !e.shiftKey){e.preventDefault();sendBtn.click();}
    });

    // accessibility: close with escape
    document.addEventListener('keydown', (e)=>{if(e.key === 'Escape' && popup.classList.contains('open')) closeChat();});
  </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      once: false,
      mirror: false,
      useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
      disableMutationObserver: false,
      disable: false, 
    });
  </script>
   
    
</body>
</html>
