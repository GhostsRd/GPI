<div>

  <aside wire:ignore.self class="chat-popup bg-none "  id="chatPopup" role="dialog" aria-modal="false" aria-label="Fenêtre de chat">
    <header class="chat-header">
      <div > <img width="50" class="mt-2 shadow-sm   rounded-pill" src="{{ asset('/images/avtar_1.png') }}" alt="Photo de profil">
        </div>
      <div class="chat-title">
        <h4>Support</h4>
        <p>Reponse environ une heure</p>
      </div>
      <button class="chat-close" id="chatClose" aria-label="Fermer">✕</button>
    </header>
    
    <div class="chat-messages" id="messages" aria-live="polite">
        @foreach ($chats as $chat)
      <!-- sample messages -->

      <div class="msg {{$chat->type == 'agent'? 'user' : 'agent'}}">{{$chat->message}}<small>Vous · {{$chat->created_at}}</small></div>
      
      {{-- <div class="msg user">Salut, j'ai un problème avec mon compte<small>Vous · 08:56</small></div>
      
      <div class="msg agent">D'accord, peux-tu préciser ?<small>Support · 08:57</small></div>
      <div class="msg agent">{{$chat->message}}<small>Vous · {{$chat->created_at}}</small></div> --}}
      @endforeach
    </div>

    <form wire:submit.prevent="EnvoyerMessage" class="p-2">
      <textarea id="input" wire:model="message" class="chat-input w-100" rows="1" placeholder="Écris un message..."></textarea> <br>
      <button id="sendBtn" type="submit" class="btn btn-sm btn-primary mt-0">Envoyer</button>
    </form>
  </aside>



    <!-- === HERO === -->
  <section class="parallax-animated d-flex align-items-center text-white text-center py-5" style="min-height:100vh;">
    <div class="container ">
      <div class="row align-items-center">
        <div class="col-lg-6 text-lg-start text-center">

          <h1 class="fw-bold text-uppercase mb-3 " style="font-size:3rem;" data-aos="fade-zoom-in"
            data-aos-duration="3000">• GPI - Pivot •</h1>
          <p class="lead mb-4">
            Nous accompagnons les organisations dans la gestion, le suivi et la maintenance de leurs ressources
            informatiques.
          </p>
          <div class="d-flex justify-content-lg-start justify-content-center gap-3">
            <a class="btn btn-two text-white fw-bold btn-xs-sm btn-xs-sm rounded-pill shadow" href="#services">
              <i class="bi bi-play-circle me-2  " ></i> Commencer   ⮕
            </a>
            <a class="btn btn-light btn-sm rounded-pill shadow" aria-label="Ouvrir le chat" id="chatToggle" href="#">
              <i class="bi bi-clock-history me-2 btn-sm" ></i> Contact    
            </a>
            
          </div>
        </div>

        <div class="col-lg-6 d-none d-lg-block">
          <div class="mt-4 mt-lg-0 text-center t">
            <svg class="animated" width="500" id="freepik_stories-on-the-office" xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
              xmlns:svgjs="http://svgjs.com/svgjs">
              <style>
                svg#freepik_stories-on-the-office:not(.animated) .animable {
                  opacity: 0;
                }

                svg#freepik_stories-on-the-office.animated #freepik--Boards--inject-85 {
                  animation: 1.5s Infinite linear floating;
                  animation-delay: 0s;
                }

                @keyframes floating {
                  0% {
                    opacity: 1;
                    transform: translateY(0px);
                  }

                  50% {
                    transform: translateY(-10px);
                  }

                  100% {
                    opacity: 1;
                    transform: translateY(0px);
                  }
                }

                .animator-hidden {
                  display: none;
                }
              </style>
              <g id="freepik--Floor--inject-85" class="animable animator-active animator-hidden"
                style="transform-origin: 250.23px 316.83px;">
                <ellipse id="freepik--floor--inject-85" cx="250.23" cy="316.83" rx="243.48" ry="159.67"
                  style="fill: rgb(245, 245, 245); transform-origin: 250.23px 316.83px;" class="animable"></ellipse>
              </g>
              <g id="freepik--Shadows--inject-85" class="animable" style="transform-origin: 211.29px 346.515px;">
                <polygon id="freepik--Shadow--inject-85"
                  points="266.86 470.53 377.73 406.4 201.26 304.53 90.39 368.65 266.86 470.53"
                  style="fill: rgb(235, 235, 235); transform-origin: 234.06px 387.53px;" class="animable"></polygon>
                <path id="freepik--shadow--inject-85"
                  d="M55.54,287.13l62.08-35.84c.68-.39.68-1,0-1.42l-4.46-2.57a2.73,2.73,0,0,0-2.46,0L85.5,261.85a2.71,2.71,0,0,1-2.45,0L37.1,235.32a2.71,2.71,0,0,0-2.45,0l-2.16,1.25c-.68.39-.68,1,0,1.42l46,26.55a.75.75,0,0,1,0,1.42L48.63,283.14a.75.75,0,0,0,0,1.42l4.46,2.57A2.65,2.65,0,0,0,55.54,287.13Z"
                  style="fill: rgb(235, 235, 235); transform-origin: 75.055px 261.229px;" class="animable"></path>
                <ellipse id="freepik--shadow--inject-85" cx="352.18" cy="434.95" rx="38.42" ry="24.09"
                  style="fill: rgb(235, 235, 235); transform-origin: 352.18px 434.95px;" class="animable"></ellipse>
                <ellipse id="freepik--shadow--inject-85" cx="110.84" cy="410.66" rx="46.79" ry="29.34"
                  style="fill: rgb(235, 235, 235); transform-origin: 110.84px 410.66px;" class="animable"></ellipse>
                <ellipse id="freepik--shadow--inject-85" cx="175.08" cy="248.82" rx="41.98" ry="26.32"
                  style="fill: rgb(235, 235, 235); transform-origin: 175.08px 248.82px;" class="animable"></ellipse>
              </g>
              <g id="freepik--Boards--inject-85" class="animable" style="transform-origin: 231.3px 168.444px;">
                <g id="freepik--Board--inject-85" class="animable" style="transform-origin: 73.22px 175.497px;">
                  <polygon points="98.82 228.58 98.82 227.74 65.75 246.95 66.46 247.37 98.82 228.58"
                    style="fill: rgb(55, 71, 79); transform-origin: 82.285px 237.555px;" id="elc0h1hal7cen"
                    class="animable"></polygon>
                  <path
                    d="M47.56,181a.2.2,0,0,1,.1.22L35.32,236,35,237.52a.9.9,0,0,1-.49-.1h0l-.83-.48a.21.21,0,0,1-.09-.22l12.67-56.24a.2.2,0,0,1,.29-.13Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 40.6251px 208.924px;" id="elqr1rezb24bp"
                    class="animable"></path>
                  <path
                    d="M49.11,180.21,36.38,236.72a.36.36,0,0,1-.16.22l-.83.48a.83.83,0,0,1-.43.1l.36-1.55L47.69,181Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 42.035px 208.865px;" id="el5qf42ywqe2k"
                    class="animable"></path>
                  <path d="M65,278.32V280a1,1,0,0,1-.46-.1h0l-.77-.44a.33.33,0,0,1-.18-.27v-93L65,187Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 64.295px 233.095px;" id="el4r61qskk5zs"
                    class="animable"></path>
                  <path d="M66.46,186.15v93a.34.34,0,0,1-.19.25l-.77.44A.87.87,0,0,1,65,280V187Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 65.73px 233.075px;" id="ele9xhwtfc49h"
                    class="animable"></path>
                  <path
                    d="M105.11,256.75a.94.94,0,0,1-.44-.13l-.79-.45a.4.4,0,0,1-.19-.28L88.6,176.63l1.42.82,14.79,77.71Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 96.855px 216.69px;" id="elrejg5q3s9c"
                    class="animable"></path>
                  <path
                    d="M106.53,255.93h0a.33.33,0,0,1-.19.27l-.73.42,0,0a.91.91,0,0,1-.47.11l-.3-1.59L90,177.45l1.43-.82,15.07,79.23h0Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 98.265px 216.68px;" id="elww8owfh84x"
                    class="animable"></path>
                  <polygon points="65.97 249.28 100.24 229.4 100.24 227.76 65.97 247.64 65.97 249.28"
                    style="fill: rgb(69, 90, 100); transform-origin: 83.105px 238.52px;" id="elsbagwijx4ri"
                    class="animable"></polygon>
                  <path
                    d="M36.34,208.77V210a2.1,2.1,0,0,0,.93,1.63l9.85,5.68a2.08,2.08,0,0,0,1.88,0L112,181a2.1,2.1,0,0,0,.93-1.63v-1.22a2.08,2.08,0,0,0-.93-1.62l-9.85-5.69a2.08,2.08,0,0,0-1.88,0l-63,36.3A2.08,2.08,0,0,0,36.34,208.77Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 74.635px 194.075px;" id="elppfu9cb2r9"
                    class="animable"></path>
                  <g id="elvjs0bnnl5kn">
                    <path
                      d="M37.27,208.23l9.85,5.69a2.08,2.08,0,0,0,1.88,0l63-36.3a.57.57,0,0,0,0-1.08l-9.85-5.69a2.08,2.08,0,0,0-1.88,0l-63,36.3A.57.57,0,0,0,37.27,208.23Z"
                      style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 74.635px 192.385px;"
                      class="animable"></path>
                  </g>
                  <g id="ela5w5ns6wokm">
                    <path
                      d="M48.06,214.14v3.39a1.86,1.86,0,0,1-.93-.23l-9.85-5.68a2.09,2.09,0,0,1-.94-1.63v-1.22a2.1,2.1,0,0,1,.75-1.49c-.33.3-.26.69.19.95l9.85,5.69A2,2,0,0,0,48.06,214.14Z"
                      style="opacity: 0.1; transform-origin: 42.2px 212.405px;" class="animable"></path>
                  </g>
                  <path
                    d="M43.57,211.86l-2.74-1.58a3.72,3.72,0,0,1-1.67-2.7l-5.65-97.94a3.18,3.18,0,0,1,1.46-2.7L96.69,71.36a3.52,3.52,0,0,1,3.13,0L102.56,73a3.72,3.72,0,0,1,1.67,2.7l5.65,97.94a3.21,3.21,0,0,1-1.46,2.7L46.69,211.86A3.43,3.43,0,0,1,43.57,211.86Z"
                    style="fill: rgb(224, 224, 224); transform-origin: 71.695px 141.614px;" id="el61zfxpryidx"
                    class="animable"></path>
                  <path
                    d="M104.19,75.38a1,1,0,0,0-1.63-.63L40.83,110.32a3,3,0,0,0-1.08,1.18l-5.86-3.38A3,3,0,0,1,35,106.94L96.7,71.37a3.44,3.44,0,0,1,3.11,0L102.57,73A3.77,3.77,0,0,1,104.19,75.38Z"
                    style="fill: rgb(250, 250, 250); transform-origin: 69.04px 91.2492px;" id="elekaeddqmpzo"
                    class="animable"></path>
                  <path
                    d="M39.37,113,45,211a1,1,0,0,0,1.67.89l61.73-35.57a3.21,3.21,0,0,0,1.46-2.7l-5.65-97.94a1,1,0,0,0-1.67-.9L40.83,110.32A3.21,3.21,0,0,0,39.37,113Z"
                    style="fill: rgb(240, 240, 240); transform-origin: 74.615px 143.334px;" id="elm7l6cee149h"
                    class="animable"></path>
                  <path
                    d="M86.54,84.76V90a1.42,1.42,0,0,1-.66,1.13l-19.15,11a1.51,1.51,0,0,1-1.31,0l-1.62-.94a1.47,1.47,0,0,1-.66-1.14V97.46l-5.86-3.38-2.93,1.68v-6A1.42,1.42,0,0,1,55,88.62l19.15-11a1.44,1.44,0,0,1,1.31,0l10.41,6A1.42,1.42,0,0,1,86.54,84.76Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 70.445px 89.8709px;" id="elzjyrkfft0zf"
                    class="animable"></path>
                  <path
                    d="M86.54,84.76V90a1.45,1.45,0,0,1-.66,1.13l-19.15,11a1.36,1.36,0,0,1-.65.15V95.55a1.36,1.36,0,0,0,.65-.16l19.15-11c.32-.18.36-.47.12-.67A1.45,1.45,0,0,1,86.54,84.76Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 76.31px 93.0001px;" id="elgaxecdbwyck"
                    class="animable"></path>
                  <path
                    d="M55,89.37l10.41,6a1.44,1.44,0,0,0,1.31,0l19.15-11c.37-.2.37-.54,0-.75l-10.41-6a1.44,1.44,0,0,0-1.31,0L55,88.62C54.64,88.83,54.64,89.17,55,89.37Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 70.4388px 86.495px;" id="elzze4st72fn"
                    class="animable"></path>
                  <path
                    d="M55.39,170,59,167.87a.68.68,0,0,1,1.1.59l1.11,19.06a2.11,2.11,0,0,1-.95,1.77l-3.62,2.09a.68.68,0,0,1-1.1-.59l-1.11-19.06A2.08,2.08,0,0,1,55.39,170Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 57.82px 179.625px;" id="elutaxyw16q6"
                    class="animable"></path>
                  <path
                    d="M56.85,195l3.62-2.09c.57-.33,1.05-.19,1.08.3a1.9,1.9,0,0,1-1,1.49L57,196.75c-.57.33-1.05.19-1.08-.3A1.9,1.9,0,0,1,56.85,195Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 58.735px 194.83px;" id="eloc20nwa9boo"
                    class="animable"></path>
                  <path
                    d="M68.29,171.87l3.62-2.09a.67.67,0,0,1,1.09.59l.58,10a2.11,2.11,0,0,1-1,1.77L69,184.23a.68.68,0,0,1-1.1-.59l-.58-10A2.1,2.1,0,0,1,68.29,171.87Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 70.45px 177.003px;" id="elfpzeqfwvwn"
                    class="animable"></path>
                  <g id="elxmvz84hs4zh">
                    <path
                      d="M68.29,171.87l3.62-2.09a.67.67,0,0,1,1.09.59l.58,10a2.11,2.11,0,0,1-1,1.77L69,184.23a.68.68,0,0,1-1.1-.59l-.58-10A2.1,2.1,0,0,1,68.29,171.87Z"
                      style="opacity: 0.1; transform-origin: 70.45px 177.003px;" class="animable"></path>
                  </g>
                  <path
                    d="M69.21,187.81l3.62-2.09c.57-.33,1-.19,1.08.3a1.9,1.9,0,0,1-1,1.49l-3.62,2.09c-.57.33-1,.19-1.08-.3A1.9,1.9,0,0,1,69.21,187.81Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 71.06px 187.66px;" id="el8byy80glyt9"
                    class="animable"></path>
                  <path
                    d="M79.85,150.18l3.62-2.09a.67.67,0,0,1,1.09.59L86,173.22A2.14,2.14,0,0,1,85,175l-3.62,2.09a.67.67,0,0,1-1.09-.59L78.89,152A2.11,2.11,0,0,1,79.85,150.18Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 82.4447px 162.59px;" id="elw1kunv8rc6l"
                    class="animable"></path>
                  <g id="elsxm0yxjllng">
                    <path
                      d="M79.85,150.18l3.62-2.09a.67.67,0,0,1,1.09.59L86,173.22A2.14,2.14,0,0,1,85,175l-3.62,2.09a.67.67,0,0,1-1.09-.59L78.89,152A2.11,2.11,0,0,1,79.85,150.18Z"
                      style="opacity: 0.2; transform-origin: 82.4447px 162.59px;" class="animable"></path>
                  </g>
                  <path
                    d="M81.57,180.66l3.62-2.09c.57-.33,1-.19,1.08.3a1.9,1.9,0,0,1-1,1.49l-3.62,2.09c-.57.33-1.05.19-1.08-.3A1.9,1.9,0,0,1,81.57,180.66Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 83.42px 180.51px;" id="elpxs2ulw9h"
                    class="animable"></path>
                  <path
                    d="M92.84,153.87l3.62-2.09a.67.67,0,0,1,1.09.59l.76,13.7a2.14,2.14,0,0,1-1,1.77l-3.62,2.09a.67.67,0,0,1-1.09-.59l-.76-13.7A2.13,2.13,0,0,1,92.84,153.87Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 95.075px 160.855px;" id="eljy4hwbd77q"
                    class="animable"></path>
                  <g id="elfkmurm3b4b7">
                    <path
                      d="M92.84,153.87l3.62-2.09a.67.67,0,0,1,1.09.59l.76,13.7a2.14,2.14,0,0,1-1,1.77l-3.62,2.09a.67.67,0,0,1-1.09-.59l-.76-13.7A2.13,2.13,0,0,1,92.84,153.87Z"
                      style="opacity: 0.3; transform-origin: 95.075px 160.855px;" class="animable"></path>
                  </g>
                  <path
                    d="M93.93,173.51l3.62-2.09c.57-.33,1-.19,1.08.3a1.9,1.9,0,0,1-1,1.49L94,175.3c-.57.33-1.05.19-1.08-.3A1.9,1.9,0,0,1,93.93,173.51Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 95.775px 173.36px;" id="el8yf4v38ddz9"
                    class="animable"></path>
                  <path
                    d="M76.5,122.21c.51,8.51-5,19-12.2,23.24s-13.37.79-13.82-7.75c-.41-7.94,4.29-17.52,10.73-22.25l0,.63.39.22c-6.11,4.32-10.43,13.37-10.22,20.85.24,8.27,6,11.47,12.84,7.19,6.56-4.12,11.74-13.64,11.32-21.57a.78.78,0,0,1,.2-.58C76,122,76.42,121.89,76.5,122.21Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 63.4939px 131.356px;" id="eldkns4lkuhz"
                    class="animable"></path>
                  <path
                    d="M77.8,121.52c-.49-9.31-7.24-13.09-15.06-8.44a27.13,27.13,0,0,0-9.09,9.7l2.29,1.65A20.91,20.91,0,0,1,63,117c6-3.58,11.22-.66,11.59,6.5S70.33,139.37,64.31,143s-11.22.67-11.6-6.5l-3.25,1.94c.48,9.31,7.24,13.09,15.05,8.44S78.29,130.82,77.8,121.52Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 63.6441px 129.98px;" id="elpblmwa86odn"
                    class="animable"></path>
                  <path
                    d="M63.12,120.15c-4.55,2.71-8,9.3-7.73,14.72s4.21,7.61,8.76,4.9,8-9.3,7.73-14.72S67.67,117.43,63.12,120.15Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 63.635px 129.958px;" id="eljln2bvobvh"
                    class="animable"></path>
                  <g id="el5bpwv2lrlg6">
                    <g style="opacity: 0.3; transform-origin: 63.635px 129.958px;" class="animable">
                      <path
                        d="M63.12,120.15c-4.55,2.71-8,9.3-7.73,14.72s4.21,7.61,8.76,4.9,8-9.3,7.73-14.72S67.67,117.43,63.12,120.15Z"
                        id="elsjoe9i3nlcr" class="animable" style="transform-origin: 63.635px 129.958px;"></path>
                    </g>
                  </g>
                  <path
                    d="M95.34,94.74l-14.1,8.39A2.69,2.69,0,0,0,80,105.32c0,.76.67,1,1.41.59l14.1-8.4a2.68,2.68,0,0,0,1.26-2.18C96.71,94.56,96.08,94.3,95.34,94.74Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 88.385px 100.317px;" id="elcx40t3q6q8b"
                    class="animable"></path>
                  <path
                    d="M95.72,101.92l-14.1,8.39a2.71,2.71,0,0,0-1.27,2.19c0,.77.68,1,1.42.59l14.09-8.39a2.7,2.7,0,0,0,1.27-2.19C97.09,101.75,96.46,101.48,95.72,101.92Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 88.74px 107.499px;" id="ely8bbziagb5k"
                    class="animable"></path>
                  <path
                    d="M96.09,109.11,82,117.5a2.7,2.7,0,0,0-1.27,2.19c0,.76.67,1,1.41.59l14.1-8.4a2.69,2.69,0,0,0,1.27-2.18C97.47,108.93,96.83,108.67,96.09,109.11Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 89.12px 114.687px;" id="elz7938rvkhh"
                    class="animable"></path>
                  <path
                    d="M96.47,116.29l-14.1,8.39a2.69,2.69,0,0,0-1.26,2.19c0,.77.67,1,1.41.59l14.1-8.39a2.69,2.69,0,0,0,1.26-2.19C97.84,116.11,97.21,115.85,96.47,116.29Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 89.495px 121.868px;" id="eli0agqct7xw"
                    class="animable"></path>
                  <path
                    d="M96.85,123.48l-14.1,8.39a2.69,2.69,0,0,0-1.27,2.18c0,.77.68,1,1.42.59L97,126.25a2.69,2.69,0,0,0,1.27-2.18C98.22,123.3,97.59,123,96.85,123.48Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 89.875px 129.044px;" id="elfrf1f2mh38l"
                    class="animable"></path>
                </g>
                <g id="freepik--board--inject-85" class="animable" style="transform-origin: 361.791px 157.68px;">
                  <g id="freepik--board--inject-85" class="animable" style="transform-origin: 361.652px 159.071px;">
                    <path
                      d="M298.39,59.67l-.88.5V181.53c0,2.87,1.74,6.2,3.89,7.45L421,258a2.56,2.56,0,0,0,2.44.26c.19-.09.86-.49,1-.58a3.42,3.42,0,0,0,1.33-3.13V133.2Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 361.652px 159.063px;" id="el598b65gdyap"
                      class="animable"></path>
                    <g id="eleegp3csfn3f">
                      <path
                        d="M421,258,301.4,189c-2.15-1.25-3.89-4.58-3.89-7.45V60.17l127.37,73.54V255.07C424.88,257.93,423.13,259.25,421,258Z"
                        style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 361.195px 159.321px;"
                        class="animable"></path>
                    </g>
                  </g>
                  <g id="freepik--sticky-notes--inject-85" class="animable"
                    style="transform-origin: 394.88px 215.89px;">
                    <g id="freepik--notes-shadows--inject-85">
                      <g style="opacity: 0.15; transform-origin: 395.475px 215.89px;" class="animable">
                        <g id="eln2ctxp612nq">
                          <g style="opacity: 0.15; transform-origin: 382.355px 199.195px;" class="animable">
                            <polygon points="386.71 208.41 378 203.39 378 189.98 386.71 195.01 386.71 208.41"
                              id="el2e2wlay7yl6" class="animable" style="transform-origin: 382.355px 199.195px;">
                            </polygon>
                          </g>
                        </g>
                        <g id="ely3apmqdy6tn">
                          <g style="opacity: 0.15; transform-origin: 395px 206.5px;" class="animable">
                            <polygon points="399.35 215.72 390.65 210.69 390.65 197.28 399.35 202.31 399.35 215.72"
                              id="elikbweci8af" class="animable" style="transform-origin: 395px 206.5px;"></polygon>
                          </g>
                        </g>
                        <g id="elabx4p1pfrrn">
                          <g style="opacity: 0.15; transform-origin: 407.645px 213.8px;" class="animable">
                            <polygon points="412 223.02 403.29 217.99 403.29 204.58 412 209.61 412 223.02"
                              id="elndh5oziem6" class="animable" style="transform-origin: 407.645px 213.8px;"></polygon>
                          </g>
                        </g>
                        <g id="elwrnexloors">
                          <g style="opacity: 0.15; transform-origin: 382.355px 217.63px;" class="animable">
                            <polygon points="386.71 226.85 378 221.82 378 208.41 386.71 213.44 386.71 226.85"
                              id="el2z0iwa0ewyz" class="animable" style="transform-origin: 382.355px 217.63px;">
                            </polygon>
                          </g>
                        </g>
                        <polygon points="401.27 233.23 390.96 229.57 389.88 217.1 400.19 220.76 401.27 233.23"
                          id="el2wto7fb57q7" class="animable" style="transform-origin: 395.575px 225.165px;"></polygon>
                        <polygon points="412.95 241.8 404.24 236.77 404.24 223.36 412.95 228.39 412.95 241.8"
                          id="el5g3x36oztnh" class="animable" style="transform-origin: 408.595px 232.58px;"></polygon>
                      </g>
                    </g>
                    <g id="freepik--Notes--inject-85" class="animable" style="transform-origin: 394.74px 215.915px;">
                      <g id="freepik--Note--inject-85" class="animable" style="transform-origin: 381.715px 198.329px;">
                        <path
                          d="M376.81,202.94l6,3.36c.67.38,1.11-.7,1.11-1.36.68.43,2.05.7,2.12-.16l.56-7.6L377.57,192Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 381.705px 199.189px;" id="elfj7khhjsuf"
                          class="animable"></path>
                        <polygon points="377.57 191.95 386.62 197.18 386.62 195.5 377.57 190.28 377.57 191.95"
                          style="fill: rgb(55, 71, 79); transform-origin: 382.095px 193.73px;" id="elj6ek4u0m1wm"
                          class="animable"></polygon>
                        <polygon points="385.78 205.24 383.3 206.34 384.07 204.31 385.78 205.24"
                          style="fill: rgb(55, 71, 79); transform-origin: 384.54px 205.325px;" id="elp86l6m0ipkl"
                          class="animable"></polygon>
                      </g>
                      <g id="freepik--note--inject-85" class="animable" style="transform-origin: 394.365px 206.475px;">
                        <polygon points="389.46 210.24 398.47 215.37 399.27 204.48 390.22 199.25 389.46 210.24"
                          style="fill: rgb(38, 50, 56); transform-origin: 394.365px 207.31px;" id="eljpnigockpbb"
                          class="animable"></polygon>
                        <polygon points="390.22 199.25 399.27 204.48 399.27 202.81 390.22 197.58 390.22 199.25"
                          style="fill: rgb(38, 50, 56); transform-origin: 394.745px 201.03px;" id="eldws3h7pkq4d"
                          class="animable"></polygon>
                        <g id="el9re8kua8hkq">
                          <polygon points="390.22 199.25 399.27 204.48 399.27 202.81 390.22 197.58 390.22 199.25"
                            style="opacity: 0.1; transform-origin: 394.745px 201.03px;" class="animable"></polygon>
                        </g>
                      </g>
                      <g id="freepik--note--inject-85" class="animable" style="transform-origin: 407.765px 232.655px;">
                        <polygon points="402.86 236.42 411.86 241.55 412.67 230.66 403.62 225.44 402.86 236.42"
                          style="fill: rgb(38, 50, 56); transform-origin: 407.765px 233.495px;" id="elegsii9uv5w7"
                          class="animable"></polygon>
                        <polygon points="403.62 225.44 412.67 230.66 412.67 228.99 403.62 223.76 403.62 225.44"
                          style="fill: rgb(38, 50, 56); transform-origin: 408.145px 227.21px;" id="elno2ceaosvjr"
                          class="animable"></polygon>
                        <g id="eltiia4emof6m">
                          <polygon points="403.62 225.44 412.67 230.66 412.67 228.99 403.62 223.76 403.62 225.44"
                            style="opacity: 0.1; transform-origin: 408.145px 227.21px;" class="animable"></polygon>
                        </g>
                      </g>
                      <g id="freepik--note--inject-85" class="animable" style="transform-origin: 394.955px 225.615px;">
                        <polygon points="390.79 230.16 400.53 233.68 399.48 222.82 389.67 219.2 390.79 230.16"
                          style="fill: rgb(38, 50, 56); transform-origin: 395.1px 226.44px;" id="eljnqkb5ojug"
                          class="animable"></polygon>
                        <polygon points="389.67 219.2 399.48 222.82 399.19 221.16 389.38 217.55 389.67 219.2"
                          style="fill: rgb(38, 50, 56); transform-origin: 394.43px 220.185px;" id="ellim183i25k"
                          class="animable"></polygon>
                        <g id="el9yhq312qlth">
                          <polygon points="389.67 219.2 399.48 222.82 399.19 221.16 389.38 217.55 389.67 219.2"
                            style="opacity: 0.1; transform-origin: 394.43px 220.185px;" class="animable"></polygon>
                        </g>
                      </g>
                      <g id="freepik--note--inject-85" class="animable" style="transform-origin: 381.715px 217.485px;">
                        <polygon points="376.81 221.25 385.81 226.38 386.62 215.49 377.57 210.26 376.81 221.25"
                          style="fill: rgb(69, 90, 100); transform-origin: 381.715px 218.32px;" id="elch7mj4sm5o"
                          class="animable"></polygon>
                        <polygon points="377.57 210.27 386.62 215.49 386.62 213.82 377.57 208.59 377.57 210.27"
                          style="fill: rgb(38, 50, 56); transform-origin: 382.095px 212.04px;" id="elw8lf9raps4d"
                          class="animable"></polygon>
                        <polygon points="377.57 210.27 386.62 215.49 386.62 213.82 377.57 208.59 377.57 210.27"
                          style="fill: rgb(55, 71, 79); transform-origin: 382.095px 212.04px;" id="elawo8y0bji6t"
                          class="animable"></polygon>
                      </g>
                      <g id="freepik--note--inject-85" class="animable" style="transform-origin: 407.015px 212.933px;">
                        <path
                          d="M402.11,217.54l6,3.37c.67.37,1.11-.71,1.12-1.37.67.43,2.05.7,2.12-.15l.56-7.61-9.06-5.22Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 407.01px 213.773px;" id="el6cqnhu22vp4"
                          class="animable"></path>
                        <polygon points="402.86 206.56 411.92 211.78 411.92 210.11 402.86 204.88 402.86 206.56"
                          style="fill: rgb(55, 71, 79); transform-origin: 407.39px 208.33px;" id="eldmkxhw5vrge"
                          class="animable"></polygon>
                        <polygon points="411.07 219.84 408.59 220.94 409.37 218.92 411.07 219.84"
                          style="fill: rgb(55, 71, 79); transform-origin: 409.83px 219.93px;" id="el2lzjnpgf6lt"
                          class="animable"></polygon>
                      </g>
                    </g>
                  </g>
                  <g id="freepik--Chart--inject-85" class="animable" style="transform-origin: 373.9px 153.095px;">
                    <g id="eln29s76d1i2r">
                      <polygon points="402.53 200.1 347.74 168.47 347.74 106.09 402.53 137.72 402.53 200.1"
                        style="opacity: 0.15; transform-origin: 375.135px 153.095px;" class="animable"></polygon>
                    </g>
                    <path
                      d="M400.29,199.4l.25-.15a1.6,1.6,0,0,0,.73-1.26V139.32a1.62,1.62,0,0,0-.73-1.26L347.72,107.5a1.63,1.63,0,0,0-1.46,0l-.25.15a1.62,1.62,0,0,0-.73,1.26v58.67a1.6,1.6,0,0,0,.73,1.26l52.82,30.56A1.63,1.63,0,0,0,400.29,199.4Z"
                      style="fill: rgb(240, 240, 240); transform-origin: 373.275px 153.45px;" id="elw2idufvtbso"
                      class="animable"></path>
                    <path
                      d="M401.26,139.32V198a1.63,1.63,0,0,1-.72,1.27l-.25.14a1.67,1.67,0,0,1-1.3.08c.33.09.57-.1.57-.5V140.31a1.43,1.43,0,0,0-.22-.72l1.72-1A1.63,1.63,0,0,1,401.26,139.32Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 400.125px 169.088px;" id="ell9f97jxdz1a"
                      class="animable"></path>
                    <path
                      d="M346,108.49l52.82,30.56a1.6,1.6,0,0,1,.73,1.26V199c0,.46-.33.65-.73.42L346,168.84a1.6,1.6,0,0,1-.73-1.26V108.91C345.28,108.45,345.61,108.26,346,108.49Z"
                      style="fill: rgb(250, 250, 250); transform-origin: 372.41px 153.955px;" id="elx6h84ermthr"
                      class="animable"></path>
                    <g id="elcf9s7v3vlxl">
                      <path
                        d="M348.6,164c1.78,1,4.51,1.24,6.56-3.78s3.9-9.07,6.41-7.38c1.76,1.18,1.52,2.79,3.1,3.7,2.47,1.42,4.4-4.71,5.27-10.44,1.24-8.12,2.43-10.25,4.65-9,3.29,1.82,3,7.23,3,12.2,0,4.45,0,6.77,2.41,7.76,1.6.65,3.16-3.21,3.79-6.18s2-4.41,3.46-3.59,3,2.79,3,10.67c.07,7,.18,17,.3,19.16a10.86,10.86,0,0,0,5.79,9.29v7.91L348.6,166.74Z"
                        style="fill: rgb(38, 50, 56); opacity: 0.1; transform-origin: 372.47px 165.544px;"
                        class="animable"></path>
                    </g>
                    <path
                      d="M396.15,186.84a11.33,11.33,0,0,1-6-9.68c-.13-2.3-.24-13-.3-19.19-.08-7.69-1.54-9.52-2.8-10.25a1,1,0,0,0-.94-.08c-.75.34-1.42,1.59-1.8,3.35-.53,2.48-1.68,5.66-3.17,6.45a1.48,1.48,0,0,1-1.28.08c-2.72-1.12-2.72-3.64-2.72-8.21v-1.1c0-4.48,0-9.12-2.76-10.67-.65-.37-1-.27-1.19-.18-1.34.66-2.17,5.08-2.74,8.86-.34,2.23-1.65,9.62-4.24,10.87a1.84,1.84,0,0,1-1.76-.09,4.31,4.31,0,0,1-1.65-1.92,4.3,4.3,0,0,0-1.47-1.79,1.36,1.36,0,0,0-1.22-.26c-1.64.5-3.28,4.49-4.47,7.41-1,2.46-2.28,4-3.8,4.48a4.1,4.1,0,0,1-3.45-.46l.48-.84a3.22,3.22,0,0,0,2.66.38c1.24-.42,2.32-1.74,3.21-3.93,1.7-4.15,3.16-7.38,5.09-8a2.34,2.34,0,0,1,2,.38,5.25,5.25,0,0,1,1.78,2.14,3.44,3.44,0,0,0,1.29,1.54.84.84,0,0,0,.85.05c1.39-.67,2.88-4.74,3.7-10.14.94-6.2,1.86-8.88,3.28-9.58a2.14,2.14,0,0,1,2.08.2c3.3,1.82,3.28,6.76,3.26,11.53v1.09c0,4.42,0,6.44,2.12,7.31a.52.52,0,0,0,.46,0c.92-.49,2.07-3,2.67-5.8.46-2.12,1.29-3.55,2.36-4a1.92,1.92,0,0,1,1.81.12c1.58.91,3.21,2.94,3.29,11.08.06,6.17.17,16.87.3,19.15a10.28,10.28,0,0,0,5.54,8.89Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 372.505px 161.56px;" id="elih9fo52ugpq"
                      class="animable"></path>
                    <g id="elmsipgz2zl4e">
                      <g style="opacity: 0.3; transform-origin: 372.505px 161.56px;" class="animable">
                        <path
                          d="M396.15,186.84a11.33,11.33,0,0,1-6-9.68c-.13-2.3-.24-13-.3-19.19-.08-7.69-1.54-9.52-2.8-10.25a1,1,0,0,0-.94-.08c-.75.34-1.42,1.59-1.8,3.35-.53,2.48-1.68,5.66-3.17,6.45a1.48,1.48,0,0,1-1.28.08c-2.72-1.12-2.72-3.64-2.72-8.21v-1.1c0-4.48,0-9.12-2.76-10.67-.65-.37-1-.27-1.19-.18-1.34.66-2.17,5.08-2.74,8.86-.34,2.23-1.65,9.62-4.24,10.87a1.84,1.84,0,0,1-1.76-.09,4.31,4.31,0,0,1-1.65-1.92,4.3,4.3,0,0,0-1.47-1.79,1.36,1.36,0,0,0-1.22-.26c-1.64.5-3.28,4.49-4.47,7.41-1,2.46-2.28,4-3.8,4.48a4.1,4.1,0,0,1-3.45-.46l.48-.84a3.22,3.22,0,0,0,2.66.38c1.24-.42,2.32-1.74,3.21-3.93,1.7-4.15,3.16-7.38,5.09-8a2.34,2.34,0,0,1,2,.38,5.25,5.25,0,0,1,1.78,2.14,3.44,3.44,0,0,0,1.29,1.54.84.84,0,0,0,.85.05c1.39-.67,2.88-4.74,3.7-10.14.94-6.2,1.86-8.88,3.28-9.58a2.14,2.14,0,0,1,2.08.2c3.3,1.82,3.28,6.76,3.26,11.53v1.09c0,4.42,0,6.44,2.12,7.31a.52.52,0,0,0,.46,0c.92-.49,2.07-3,2.67-5.8.46-2.12,1.29-3.55,2.36-4a1.92,1.92,0,0,1,1.81.12c1.58.91,3.21,2.94,3.29,11.08.06,6.17.17,16.87.3,19.15a10.28,10.28,0,0,0,5.54,8.89Z"
                          id="elesgfrhfsa3d" class="animable" style="transform-origin: 372.505px 161.56px;"></path>
                      </g>
                    </g>
                    <g id="elc10q2y0qlqw">
                      <path
                        d="M348.6,152.88c0,1.71,3.37,10.7,10.95,11.16s10.38-8,14.06-6,3,8.08,6.4,10.15,7.1-9.51,11.23-7.67,2.7,14.5,5.15,16.81v17L348.6,166.74Z"
                        style="fill: rgb(38, 50, 56); opacity: 0.15; transform-origin: 372.495px 173.605px;"
                        class="animable"></path>
                    </g>
                    <path
                      d="M396.06,177.72c-1.18-1.11-1.51-4-1.9-7.27-.47-4-1-8.51-3.11-9.45-1.78-.79-3.64,1.62-5.45,4s-3.8,4.92-5.84,3.68c-1.82-1.09-2.55-3.18-3.26-5.2s-1.41-4-3.13-4.94c-1.34-.73-2.54.21-4.54,1.94-2.25,1.94-5,4.36-9.31,4.09-7.66-.47-11.38-9.47-11.4-11.64h1c0,1.43,3.1,10.23,10.49,10.68,3.87.23,6.5-2,8.61-3.85,2-1.69,3.65-3.15,5.65-2.06s2.82,3.33,3.57,5.47c.69,1.94,1.33,3.78,2.85,4.69,1.3.78,2.89-1.27,4.58-3.45,1.94-2.5,4.14-5.34,6.6-4.25,2.62,1.17,3.16,5.77,3.68,10.22.34,2.86.68,5.82,1.6,6.69Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 372.435px 165.325px;" id="el2ut43z2yuzx"
                      class="animable"></path>
                    <path
                      d="M351.66,116.83a2.77,2.77,0,0,1,1.25,2.16c0,.8-.56,1.12-1.25.72a2.75,2.75,0,0,1-1.24-2.16C350.42,116.76,351,116.44,351.66,116.83Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 351.665px 118.273px;" id="el9svx102irzj"
                      class="animable"></path>
                    <path
                      d="M353.86,119.27a2,2,0,0,0,.92,1.53l8.51,4.91c.51.29.92.08.92-.47a2,2,0,0,0-.92-1.52l-8.51-4.91C354.28,118.51,353.87,118.72,353.86,119.27Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 359.035px 122.257px;" id="elgy3tfwhuii"
                      class="animable"></path>
                    <path
                      d="M351.66,122.81a2.74,2.74,0,0,1,1.25,2.16c0,.79-.56,1.11-1.25.72a2.78,2.78,0,0,1-1.24-2.16C350.42,122.73,351,122.41,351.66,122.81Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 351.665px 124.247px;" id="elkzq7005mwug"
                      class="animable"></path>
                    <g id="elw9fhwhw7yhs">
                      <path
                        d="M351.66,122.81a2.74,2.74,0,0,1,1.25,2.16c0,.79-.56,1.11-1.25.72a2.78,2.78,0,0,1-1.24-2.16C350.42,122.73,351,122.41,351.66,122.81Z"
                        style="opacity: 0.3; transform-origin: 351.665px 124.247px;" class="animable"></path>
                    </g>
                    <path
                      d="M353.86,125.24a2,2,0,0,0,.92,1.53l8.51,4.91c.51.29.92.08.92-.47a2,2,0,0,0-.92-1.52l-8.51-4.91C354.28,124.48,353.87,124.69,353.86,125.24Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 359.035px 128.227px;" id="elm69qfubre3"
                      class="animable"></path>
                  </g>
                  <g id="freepik--Sheet--inject-85" class="animable" style="transform-origin: 360.16px 195.325px;">
                    <g id="elan7psmz03a9">
                      <polygon points="369.54 215.33 351.68 205.01 351.68 174.98 369.54 185.29 369.54 215.33"
                        style="opacity: 0.15; transform-origin: 360.61px 195.155px;" class="animable"></polygon>
                    </g>
                    <path
                      d="M368.23,215.61l-17-9.79a1,1,0,0,1-.45-.78V176c0-.29.2-.4.45-.26l17,9.8a1,1,0,0,1,.45.77v29C368.68,215.64,368.48,215.75,368.23,215.61Z"
                      style="fill: rgb(255, 255, 255); transform-origin: 359.73px 195.675px;" id="eli4o9asjy2me"
                      class="animable"></path>
                    <path
                      d="M366.52,190,353,182.15a1,1,0,0,1-.51-.7c0-.23.23-.28.51-.12l13.53,7.81a1,1,0,0,1,.5.7C367,190.07,366.8,190.12,366.52,190Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 359.76px 185.65px;" id="elkheok74644f"
                      class="animable"></path>
                    <path
                      d="M366.52,192.1,353,184.29a1,1,0,0,1-.51-.7c0-.23.23-.28.51-.12l13.53,7.81a1,1,0,0,1,.5.7C367,192.21,366.8,192.26,366.52,192.1Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 359.76px 187.785px;" id="eltd7npizujfk"
                      class="animable"></path>
                    <path
                      d="M366.52,196.55,353,188.73a1,1,0,0,1-.51-.7c0-.23.23-.28.51-.12l13.53,7.81a1,1,0,0,1,.5.71C367,196.65,366.8,196.71,366.52,196.55Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 359.76px 192.229px;" id="el21jqrqc1ae1"
                      class="animable"></path>
                    <path
                      d="M366.52,198.69,353,190.87a1,1,0,0,1-.51-.7c0-.23.23-.28.51-.12l13.53,7.81a1,1,0,0,1,.5.7C367,198.79,366.8,198.85,366.52,198.69Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 359.76px 194.368px;" id="el3gf5fai6a85"
                      class="animable"></path>
                    <path
                      d="M366.52,205.27,353,197.46a1,1,0,0,1-.51-.71c0-.22.23-.28.51-.12l13.53,7.82a1,1,0,0,1,.5.7C367,205.38,366.8,205.43,366.52,205.27Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 359.76px 200.951px;" id="elom2bxi2k1nh"
                      class="animable"></path>
                    <path
                      d="M366.52,203.13,353,195.32a1,1,0,0,1-.51-.71c0-.22.23-.28.51-.12l13.53,7.82a1,1,0,0,1,.5.7C367,203.24,366.8,203.29,366.52,203.13Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 359.76px 198.811px;" id="elftup4ii4jgn"
                      class="animable"></path>
                    <g id="freepik--Pushpin--inject-85" class="animable" style="transform-origin: 358.612px 183.663px;">
                      <path
                        d="M358.76,183.42l0,0,.06,0s.07,0,.11,0l.34-.2c.14-.08.31-.17.48-.28l.55-.34c.05,0-.05-.21-.11-.18l-.56.3-.49.27-.34.2s-.08,0-.08.08a.11.11,0,0,0,0,.08Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 359.513px 182.919px;" id="elseel3gm2jh"
                        class="animable"></path>
                      <path
                        d="M358.41,183.67c.27.45.7.7,1.15.46l0,0h0a.52.52,0,0,0,.19-.44,1.52,1.52,0,0,0-.69-1.19.5.5,0,0,0-.46-.06h0l0,0A.83.83,0,0,0,358.41,183.67Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 358.985px 183.316px;" id="ellhzgs5uof4"
                        class="animable"></path>
                      <g id="elq1mvckxva8">
                        <g style="opacity: 0.15; transform-origin: 358.985px 183.316px;" class="animable">
                          <path
                            d="M358.41,183.67c.27.45.7.7,1.15.46l0,0h0a.52.52,0,0,0,.19-.44,1.52,1.52,0,0,0-.69-1.19.5.5,0,0,0-.46-.06h0l0,0A.83.83,0,0,0,358.41,183.67Z"
                            id="elmmwcv0nw12r" class="animable" style="transform-origin: 358.985px 183.316px;"></path>
                        </g>
                      </g>
                      <path
                        d="M357.86,184.57l-.51-.87a4.85,4.85,0,0,0,1.08-.74s0,0,0,0v0h0a.29.29,0,0,1,.34,0,1,1,0,0,1,.45.77.3.3,0,0,1-.13.29h0l-.09,0A4.64,4.64,0,0,0,357.86,184.57Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 358.286px 183.737px;" id="elgylazu4exf"
                        class="animable"></path>
                      <path
                        d="M356.92,183.87a.54.54,0,0,1,.53-.54.58.58,0,0,1,.19,0h0l.09,0a1.19,1.19,0,0,1,.54.94.61.61,0,0,1,0,.14.55.55,0,0,1-.53.44.54.54,0,0,1-.54-.54.43.43,0,0,0,0-.05A.52.52,0,0,1,356.92,183.87Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 357.597px 184.086px;" id="eliovdtt607u"
                        class="animable"></path>
                      <g id="elf3ihl55s5o8">
                        <g style="opacity: 0.15; transform-origin: 357.597px 184.086px;" class="animable">
                          <path
                            d="M356.92,183.87a.54.54,0,0,1,.53-.54.58.58,0,0,1,.19,0h0l.09,0a1.19,1.19,0,0,1,.54.94.61.61,0,0,1,0,.14.55.55,0,0,1-.53.44.54.54,0,0,1-.54-.54.43.43,0,0,0,0-.05A.52.52,0,0,1,356.92,183.87Z"
                            id="elbgw0vpt47y" class="animable" style="transform-origin: 357.597px 184.086px;"></path>
                        </g>
                      </g>
                      <path
                        d="M357.45,183.6c-.3-.18-.54,0-.54.31a1.19,1.19,0,0,0,.54.94c.3.17.54,0,.54-.31A1.19,1.19,0,0,0,357.45,183.6Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 357.45px 184.223px;" id="el62ervcfpzq"
                        class="animable"></path>
                    </g>
                  </g>
                  <g id="freepik--sheet--inject-85" class="animable" style="transform-origin: 412.765px 157.155px;">
                    <g id="elir1wxzx91ld">
                      <polygon points="422.14 177.16 404.28 166.84 404.28 136.81 422.14 147.12 422.14 177.16"
                        style="opacity: 0.15; transform-origin: 413.21px 156.985px;" class="animable"></polygon>
                    </g>
                    <path
                      d="M420.84,177.44l-17-9.79a1,1,0,0,1-.45-.78v-29c0-.29.2-.4.45-.26l17,9.79a1,1,0,0,1,.45.78v29C421.29,177.47,421.09,177.58,420.84,177.44Z"
                      style="fill: rgb(255, 255, 255); transform-origin: 412.34px 157.525px;" id="elk7ms87jnyo"
                      class="animable"></path>
                    <path
                      d="M419.12,151.79,405.59,144a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12L419.12,151a1,1,0,0,1,.5.7C419.62,151.9,419.4,152,419.12,151.79Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 412.355px 147.497px;" id="elzb23j4631p"
                      class="animable"></path>
                    <path
                      d="M419.12,153.93l-13.53-7.81a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.5.7C419.62,154,419.4,154.09,419.12,153.93Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 412.355px 149.61px;" id="elz4cnukdtqi"
                      class="animable"></path>
                    <path
                      d="M419.12,158.38l-13.53-7.82a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.5.7C419.62,158.48,419.4,158.54,419.12,158.38Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 412.355px 154.058px;" id="eltqamg08d94r"
                      class="animable"></path>
                    <path
                      d="M419.12,160.52l-13.53-7.82a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.5.7C419.62,160.62,419.4,160.68,419.12,160.52Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 412.355px 156.198px;" id="elfbehut4sipw"
                      class="animable"></path>
                    <path
                      d="M419.12,167.1l-13.53-7.81a1,1,0,0,1-.5-.71c0-.22.22-.28.5-.12l13.53,7.82a1,1,0,0,1,.5.7C419.62,167.2,419.4,167.26,419.12,167.1Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 412.355px 162.78px;" id="eli1oh3skgtwq"
                      class="animable"></path>
                    <path
                      d="M419.12,165l-13.53-7.81a1,1,0,0,1-.5-.71c0-.22.22-.28.5-.12l13.53,7.82a1,1,0,0,1,.5.7C419.62,165.07,419.4,165.12,419.12,165Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 412.355px 160.667px;" id="elz0niy77psoq"
                      class="animable"></path>
                    <g id="freepik--pushpin--inject-85" class="animable" style="transform-origin: 411.217px 145.493px;">
                      <path
                        d="M411.37,145.25l0,0,.06,0c.05,0,.07,0,.12,0l.34-.2.48-.28.54-.34c.05,0-.05-.21-.11-.18l-.56.3-.49.27-.34.2s-.08,0-.08.08a.22.22,0,0,0,0,.08Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 412.125px 144.749px;" id="elz6d2zcqxlr"
                        class="animable"></path>
                      <path
                        d="M411,145.5a.84.84,0,0,0,1.14.46l0,0h0a.5.5,0,0,0,.19-.44,1.52,1.52,0,0,0-.69-1.19.49.49,0,0,0-.46-.06h0l0,0A.83.83,0,0,0,411,145.5Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 411.568px 145.139px;" id="elzm760x5d05o"
                        class="animable"></path>
                      <g id="eln9amtp8lv1">
                        <g style="opacity: 0.15; transform-origin: 411.568px 145.139px;" class="animable">
                          <path
                            d="M411,145.5a.84.84,0,0,0,1.14.46l0,0h0a.5.5,0,0,0,.19-.44,1.52,1.52,0,0,0-.69-1.19.49.49,0,0,0-.46-.06h0l0,0A.83.83,0,0,0,411,145.5Z"
                            id="elzy3hck9i3lj" class="animable" style="transform-origin: 411.568px 145.139px;"></path>
                        </g>
                      </g>
                      <path
                        d="M410.47,146.4l-.51-.87a4.87,4.87,0,0,0,1.07-.74l0,0,0,0h0a.28.28,0,0,1,.34,0,1,1,0,0,1,.44.77.3.3,0,0,1-.13.29h0s-.05,0-.08,0A4.46,4.46,0,0,0,410.47,146.4Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 410.886px 145.566px;" id="el8per781bxf5"
                        class="animable"></path>
                      <path
                        d="M409.52,145.7a.54.54,0,0,1,.54-.54.65.65,0,0,1,.19,0h0l.08,0a1.19,1.19,0,0,1,.54.94.66.66,0,0,1,0,.14.53.53,0,0,1-1.06-.1v0A.53.53,0,0,1,409.52,145.7Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 410.197px 145.937px;" id="elntepzdlgzh"
                        class="animable"></path>
                      <g id="eloflfdghp7rr">
                        <g style="opacity: 0.15; transform-origin: 410.197px 145.937px;" class="animable">
                          <path
                            d="M409.52,145.7a.54.54,0,0,1,.54-.54.65.65,0,0,1,.19,0h0l.08,0a1.19,1.19,0,0,1,.54.94.66.66,0,0,1,0,.14.53.53,0,0,1-1.06-.1v0A.53.53,0,0,1,409.52,145.7Z"
                            id="el0o1ryc0nnrx" class="animable" style="transform-origin: 410.197px 145.937px;"></path>
                        </g>
                      </g>
                      <path
                        d="M410.06,145.43c-.3-.18-.55,0-.55.31a1.2,1.2,0,0,0,.55.94c.3.17.54,0,.54-.31A1.19,1.19,0,0,0,410.06,145.43Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 410.055px 146.053px;" id="el4vvu05g4zwp"
                        class="animable"></path>
                    </g>
                  </g>
                  <g id="freepik--Calendar--inject-85" class="animable" style="transform-origin: 322.66px 157.38px;">
                    <g id="el869rrm418b">
                      <polygon points="343.87 203.62 303.89 180.54 303.89 109.23 343.87 132.31 343.87 203.62"
                        style="opacity: 0.15; transform-origin: 323.88px 156.425px;" class="animable"></polygon>
                    </g>
                    <polygon points="342.7 170.38 302.72 147.3 302.72 109.98 342.7 133.06 342.7 170.38"
                      style="fill: rgb(250, 250, 250); transform-origin: 322.71px 140.18px;" id="elke6eocihev8"
                      class="animable"></polygon>
                    <polygon points="341.23 165.39 304.2 144.02 304.2 114.73 341.23 136.1 341.23 165.39"
                      style="fill: rgb(38, 50, 56); transform-origin: 322.715px 140.06px;" id="el1q8rppevz9j"
                      class="animable"></polygon>
                    <g id="elhjbdzmhukl9">
                      <polygon points="341.23 165.39 304.2 144.02 304.2 114.73 341.23 136.1 341.23 165.39"
                        style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 322.715px 140.06px;"
                        class="animable"></polygon>
                    </g>
                    <polygon points="304.2 129.31 341.23 150.68 341.23 165.39 304.2 144.02 304.2 129.31"
                      style="fill: rgb(224, 224, 224); transform-origin: 322.715px 147.35px;" id="elovp6mawjfw9"
                      class="animable"></polygon>
                    <path
                      d="M341.22,150.68l-21.65-12.5s-8.67-2.53-6.76.53,9.27,5.32,13.05,12.74c2.94,5.77,15.36,12,15.36,12Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 326.878px 150.324px;" id="elz5sca2davq"
                      class="animable"></path>
                    <g id="elwfgcu3d746">
                      <path
                        d="M341.22,150.68l-21.65-12.5s-8.67-2.53-6.76.53,9.27,5.32,13.05,12.74c2.94,5.77,15.36,12,15.36,12Z"
                        style="fill: rgb(255, 255, 255); opacity: 0.65; transform-origin: 326.878px 150.324px;"
                        class="animable"></path>
                    </g>
                    <path d="M322.19,139.69s-8.37-16.14-10.78-18.51-3.51.67-4.14.4-3.07-6.85-3.07-6.85V129.3Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 313.195px 127.21px;" id="elnifde5abc3r"
                      class="animable"></path>
                    <g id="el1xb0ysi8rxp">
                      <path d="M322.19,139.69s-8.37-16.14-10.78-18.51-3.51.67-4.14.4-3.07-6.85-3.07-6.85V129.3Z"
                        style="opacity: 0.3; transform-origin: 313.195px 127.21px;" class="animable"></path>
                    </g>
                    <path
                      d="M331.33,145a6.39,6.39,0,0,0-2.45-2.88c-1.72-1-4.2-3.2-4.9-5.27s-2.67-7-4.61-7.75-6.32,5.35-6.32,5.35Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 322.19px 137.018px;" id="elnbwkivx7evd"
                      class="animable"></path>
                    <path
                      d="M334.28,137.18c0-1.89,1-2.85,2.23-2.14s2.22,2.82,2.22,4.71-1,2.85-2.22,2.14S334.28,139.07,334.28,137.18Z"
                      style="fill: rgb(255, 255, 255); transform-origin: 336.505px 138.465px;" id="elf3nb7tzd87m"
                      class="animable"></path>
                    <g id="freepik--calendar--inject-85" class="animable"
                      style="transform-origin: 322.075px 176.415px;">
                      <polygon points="341.56 171.12 301.45 147.96 301.45 182.37 341.56 205.53 341.56 171.12"
                        style="fill: rgb(250, 250, 250); transform-origin: 321.505px 176.745px;" id="el2q9vak7a3gg"
                        class="animable"></polygon>
                      <polygon points="342.7 170.46 342.7 204.86 341.56 205.53 341.56 171.12 342.7 170.46"
                        style="fill: rgb(224, 224, 224); transform-origin: 342.13px 187.995px;" id="elxbno2q28lx"
                        class="animable"></polygon>
                      <polygon points="301.45 147.96 302.59 147.3 342.7 170.46 341.56 171.12 301.45 147.96"
                        style="fill: rgb(38, 50, 56); transform-origin: 322.075px 159.21px;" id="eld4dztxdaf9m"
                        class="animable"></polygon>
                      <g id="el9e8g73ysoc">
                        <g style="opacity: 0.5; transform-origin: 322.075px 159.21px;" class="animable">
                          <polygon points="301.45 147.96 302.59 147.3 342.7 170.46 341.56 171.12 301.45 147.96"
                            style="fill: rgb(255, 255, 255); transform-origin: 322.075px 159.21px;" id="ellrmnr9rrsu"
                            class="animable"></polygon>
                        </g>
                      </g>
                      <polygon points="342.7 170.46 341.56 171.12 341.56 177.74 342.7 177.07 342.7 170.46"
                        style="fill: rgb(38, 50, 56); transform-origin: 342.13px 174.1px;" id="elrk1p4ifqq9"
                        class="animable"></polygon>
                      <g id="elhz4wyuvxf9c">
                        <g style="opacity: 0.5; transform-origin: 342.13px 174.1px;" class="animable">
                          <polygon points="342.7 170.46 341.56 171.12 341.56 177.74 342.7 177.07 342.7 170.46"
                            style="fill: rgb(69, 90, 100); transform-origin: 342.13px 174.1px;" id="eltgia25f8mj"
                            class="animable"></polygon>
                        </g>
                      </g>
                      <polygon points="341.56 177.74 301.45 154.58 301.45 147.96 341.56 171.12 341.56 177.74"
                        style="fill: rgb(38, 50, 56); transform-origin: 321.505px 162.85px;" id="el41f2p9lffus"
                        class="animable"></polygon>
                      <path
                        d="M338.83,179.87c0,.37-.27.51-.61.31l-3-1.74a1.29,1.29,0,0,1-.62-1c0-.36.28-.5.62-.31l3,1.74A1.3,1.3,0,0,1,338.83,179.87Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 336.715px 178.658px;" id="el8a7pp8z8nq4"
                        class="animable"></path>
                      <path
                        d="M333.76,176.94c0,.37-.27.51-.61.31l-3-1.73a1.34,1.34,0,0,1-.61-1c0-.36.28-.5.61-.31l3,1.74A1.3,1.3,0,0,1,333.76,176.94Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 331.65px 175.733px;" id="elhnpm3xkywl"
                        class="animable"></path>
                      <path
                        d="M328.69,174c0,.37-.28.51-.61.31l-3-1.73a1.31,1.31,0,0,1-.61-1c0-.36.27-.5.61-.31l3,1.74A1.32,1.32,0,0,1,328.69,174Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 326.58px 172.793px;" id="el3ttjj0t3fvq"
                        class="animable"></path>
                      <path
                        d="M323.62,171.08c0,.37-.28.51-.62.31l-3-1.73a1.31,1.31,0,0,1-.61-1c0-.36.27-.5.61-.31l3,1.74A1.33,1.33,0,0,1,323.62,171.08Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 321.505px 169.873px;" id="el5qke06p1nj4"
                        class="animable"></path>
                      <path
                        d="M318.54,168.15c0,.37-.27.51-.61.31l-3-1.73a1.34,1.34,0,0,1-.61-1c0-.36.28-.5.61-.3l3,1.73A1.31,1.31,0,0,1,318.54,168.15Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 316.43px 166.945px;" id="elkhg82uyvh59"
                        class="animable"></path>
                      <path
                        d="M313.47,165.23c0,.36-.27.5-.61.3l-3-1.73a1.31,1.31,0,0,1-.61-1c0-.36.27-.5.61-.3l3,1.73A1.31,1.31,0,0,1,313.47,165.23Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 311.36px 164.015px;" id="el1k7rpmdmgtt"
                        class="animable"></path>
                      <path
                        d="M308.4,162.3c0,.36-.28.5-.61.31l-3-1.74a1.3,1.3,0,0,1-.61-1c0-.37.27-.51.61-.31l3,1.73A1.32,1.32,0,0,1,308.4,162.3Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 306.29px 161.082px;" id="el9xgzhydgkv"
                        class="animable"></path>
                      <polygon points="338.57 183.35 334.88 181.22 334.88 184.55 338.57 186.73 338.57 183.35"
                        style="fill: rgb(224, 224, 224); transform-origin: 336.725px 183.975px;" id="elec3hmi7cu8"
                        class="animable"></polygon>
                      <polygon points="338.57 188.02 334.88 185.9 334.88 189.22 338.57 191.4 338.57 188.02"
                        style="fill: rgb(224, 224, 224); transform-origin: 336.725px 188.65px;" id="eln7mvz701su"
                        class="animable"></polygon>
                      <polygon points="338.57 192.69 334.88 190.57 334.88 193.89 338.57 196.07 338.57 192.69"
                        style="fill: rgb(224, 224, 224); transform-origin: 336.725px 193.32px;" id="elxlbebtkh9dj"
                        class="animable"></polygon>
                      <polygon points="338.57 197.36 334.88 195.24 334.88 198.56 338.57 200.74 338.57 197.36"
                        style="fill: rgb(224, 224, 224); transform-origin: 336.725px 197.99px;" id="els8dt6gdwp8j"
                        class="animable"></polygon>
                      <polygon points="333.5 180.42 329.8 178.29 329.8 181.62 333.5 183.8 333.5 180.42"
                        style="fill: rgb(224, 224, 224); transform-origin: 331.65px 181.045px;" id="el18nmpn27c15"
                        class="animable"></polygon>
                      <polygon points="333.5 185.09 329.8 182.97 329.8 186.29 333.5 188.47 333.5 185.09"
                        style="fill: rgb(224, 224, 224); transform-origin: 331.65px 185.72px;" id="el05539kzfhu8"
                        class="animable"></polygon>
                      <polygon points="333.5 189.76 329.8 187.63 329.8 190.96 333.5 193.14 333.5 189.76"
                        style="fill: rgb(224, 224, 224); transform-origin: 331.65px 190.385px;" id="eluz92d1bp63"
                        class="animable"></polygon>
                      <polygon points="333.5 194.43 329.8 192.31 329.8 195.63 333.5 197.81 333.5 194.43"
                        style="fill: rgb(224, 224, 224); transform-origin: 331.65px 195.06px;" id="elzate0nq0b7"
                        class="animable"></polygon>
                      <polygon points="328.42 177.49 324.73 175.36 324.73 178.69 328.42 180.87 328.42 177.49"
                        style="fill: rgb(224, 224, 224); transform-origin: 326.575px 178.115px;" id="elklgz66grya8"
                        class="animable"></polygon>
                      <polygon points="328.42 182.16 324.73 180.03 324.73 183.36 328.42 185.54 328.42 182.16"
                        style="fill: rgb(224, 224, 224); transform-origin: 326.575px 182.785px;" id="ellxx9g22xaw"
                        class="animable"></polygon>
                      <polygon points="328.42 186.83 324.73 184.7 324.73 188.03 328.42 190.21 328.42 186.83"
                        style="fill: rgb(224, 224, 224); transform-origin: 326.575px 187.455px;" id="els8bry6j6nm"
                        class="animable"></polygon>
                      <polygon points="328.42 191.5 324.73 189.38 324.73 192.7 328.42 194.88 328.42 191.5"
                        style="fill: rgb(224, 224, 224); transform-origin: 326.575px 192.13px;" id="el7ti1csy6n83"
                        class="animable"></polygon>
                      <polygon points="323.34 174.56 319.65 172.43 319.65 175.76 323.34 177.93 323.34 174.56"
                        style="fill: rgb(224, 224, 224); transform-origin: 321.495px 175.18px;" id="el4o6wmhdu0h7"
                        class="animable"></polygon>
                      <polygon points="323.34 179.23 319.65 177.1 319.65 180.43 323.34 182.6 323.34 179.23"
                        style="fill: rgb(224, 224, 224); transform-origin: 321.495px 179.85px;" id="el37tdowq3lmj"
                        class="animable"></polygon>
                      <polygon points="323.34 183.9 319.65 181.77 319.65 185.1 323.34 187.28 323.34 183.9"
                        style="fill: rgb(224, 224, 224); transform-origin: 321.495px 184.525px;" id="el96e9ubzhnmw"
                        class="animable"></polygon>
                      <polygon points="323.34 188.57 319.65 186.44 319.65 189.77 323.34 191.95 323.34 188.57"
                        style="fill: rgb(224, 224, 224); transform-origin: 321.495px 189.195px;" id="el9agc3iesmwc"
                        class="animable"></polygon>
                      <polygon points="318.26 171.62 314.57 169.5 314.57 172.82 318.26 175 318.26 171.62"
                        style="fill: rgb(224, 224, 224); transform-origin: 316.415px 172.25px;" id="eliws20o0323n"
                        class="animable"></polygon>
                      <polygon points="318.26 176.29 314.57 174.17 314.57 177.5 318.26 179.67 318.26 176.29"
                        style="fill: rgb(224, 224, 224); transform-origin: 316.415px 176.92px;" id="el7rnwds11atg"
                        class="animable"></polygon>
                      <polygon points="318.26 180.97 314.57 178.84 314.57 182.17 318.26 184.34 318.26 180.97"
                        style="fill: rgb(224, 224, 224); transform-origin: 316.415px 181.59px;" id="elnmadiajquy"
                        class="animable"></polygon>
                      <polygon points="318.26 185.64 314.57 183.51 314.57 186.84 318.26 189.01 318.26 185.64"
                        style="fill: rgb(224, 224, 224); transform-origin: 316.415px 186.26px;" id="elcle4hrv0jei"
                        class="animable"></polygon>
                      <polygon points="313.19 168.69 309.5 166.57 309.5 169.89 313.19 172.07 313.19 168.69"
                        style="fill: rgb(224, 224, 224); transform-origin: 311.345px 169.32px;" id="eligpd45i6mbd"
                        class="animable"></polygon>
                      <polygon points="313.19 173.36 309.5 171.24 309.5 174.56 313.19 176.74 313.19 173.36"
                        style="fill: rgb(224, 224, 224); transform-origin: 311.345px 173.99px;" id="elnf5s62y6ec"
                        class="animable"></polygon>
                      <polygon points="313.19 178.03 309.5 175.91 309.5 179.24 313.19 181.41 313.19 178.03"
                        style="fill: rgb(224, 224, 224); transform-origin: 311.345px 178.66px;" id="elqo6oulkvwpm"
                        class="animable"></polygon>
                      <polygon points="313.19 182.71 309.5 180.58 309.5 183.91 313.19 186.08 313.19 182.71"
                        style="fill: rgb(224, 224, 224); transform-origin: 311.345px 183.33px;" id="eleinvadpetsv"
                        class="animable"></polygon>
                      <polygon points="308.11 165.76 304.42 163.64 304.42 166.96 308.11 169.14 308.11 165.76"
                        style="fill: rgb(38, 50, 56); transform-origin: 306.265px 166.39px;" id="elymg57cclwyq"
                        class="animable"></polygon>
                      <polygon points="308.11 170.43 304.42 168.31 304.42 171.63 308.11 173.81 308.11 170.43"
                        style="fill: rgb(38, 50, 56); transform-origin: 306.265px 171.06px;" id="el4fftd9aunx8"
                        class="animable"></polygon>
                      <polygon points="308.11 175.1 304.42 172.98 304.42 176.31 308.11 178.48 308.11 175.1"
                        style="fill: rgb(38, 50, 56); transform-origin: 306.265px 175.73px;" id="el1wqw9nva4onh"
                        class="animable"></polygon>
                      <polygon points="308.11 179.77 304.42 177.65 304.42 180.98 308.11 183.15 308.11 179.77"
                        style="fill: rgb(38, 50, 56); transform-origin: 306.265px 180.4px;" id="eldwjjy1sewlf"
                        class="animable"></polygon>
                      <path
                        d="M304.52,162.45l-.29.61a.07.07,0,0,1-.1,0l-.64-.24c-.1,0-.14.1-.07.24l.47.87a.27.27,0,0,1,0,.17l-.11.79c0,.13.09.29.18.28l.58-.07a.13.13,0,0,1,.11.07l.58.73c.09.12.2.08.18-.07l-.11-.91a.13.13,0,0,1,0-.13l.46-.34c.08,0,0-.24-.07-.32l-.64-.5a.23.23,0,0,1-.09-.14l-.29-.94C304.69,162.43,304.56,162.35,304.52,162.45Z"
                        style="fill: rgb(242, 143, 143); transform-origin: 304.589px 164.188px;" id="elmtks2zgrohi"
                        class="animable"></path>
                      <path
                        d="M318.83,183a1.6,1.6,0,0,1,1-1.56c.83-.3,1.53.36,2,.92.14.15-.11.22-.22.11-.53-.5-1.52-1-2.09-.33s-.28,1.67,0,2.4a3.42,3.42,0,0,0,3.14,2.29c3.1-.24-.26-5.69-2.09-6-.15,0-.26-.26-.06-.29.93-.15,1.59.68,2.17,1.3a7.08,7.08,0,0,1,1.48,2.36c.62,1.64-.29,3.67-2.3,3A4.35,4.35,0,0,1,318.83,183Z"
                        style="fill: rgb(242, 143, 143); transform-origin: 321.59px 183.927px;" id="elo0tomdmdgi9"
                        class="animable"></path>
                      <path
                        d="M324.43,181a4.36,4.36,0,0,1,.56-.65c.07-.08.25,0,.21.13s-.33.4-.46.63a1,1,0,0,0-.08.11,3.74,3.74,0,0,1,1.3-.43,4.57,4.57,0,0,1,2.66.24c.09,0,.05.11,0,.12a.87.87,0,0,1-.39-.07,5,5,0,0,0-1.39-.1,4.62,4.62,0,0,0-1.95.5,1.29,1.29,0,0,1,1.24.31s0,.11,0,.12a7.72,7.72,0,0,1-.83-.06,3.38,3.38,0,0,0-1,.17c-.13,0-.22-.09-.22-.2A2,2,0,0,1,324.43,181Z"
                        style="fill: rgb(242, 143, 143); transform-origin: 326.377px 181.169px;" id="ele55jj1vc8wl"
                        class="animable"></path>
                    </g>
                    <g id="freepik--pushpin--inject-85" class="animable" style="transform-origin: 321.697px 124.732px;">
                      <path
                        d="M321.85,124.49l0,0s0,0,.06,0,.06,0,.11,0l.34-.2.48-.29.54-.33c.06,0,0-.22-.11-.19l-.56.3-.48.28-.35.19s-.08,0-.08.08,0,.06,0,.08Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 322.602px 123.984px;" id="el4anz8qtyzly"
                        class="animable"></path>
                      <path
                        d="M321.5,124.74a.84.84,0,0,0,1.15.46s0,0,0,0h0a.5.5,0,0,0,.19-.44,1.54,1.54,0,0,0-.68-1.19.5.5,0,0,0-.46-.06h0l0,0A.84.84,0,0,0,321.5,124.74Z"
                        style="fill: rgb(55, 71, 79); transform-origin: 322.079px 124.381px;" id="ely6kbnp1rciq"
                        class="animable"></path>
                      <path
                        d="M321,125.64l-.51-.87a4.64,4.64,0,0,0,1.07-.74l0,0h0a.28.28,0,0,1,.34,0,1,1,0,0,1,.44.77.3.3,0,0,1-.13.29h0a.11.11,0,0,1-.08,0A4.84,4.84,0,0,0,321,125.64Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 321.416px 124.806px;" id="el65xjrbs1ob3"
                        class="animable"></path>
                      <path
                        d="M320,124.94a.54.54,0,0,1,.54-.54.65.65,0,0,1,.19,0h0l.08,0a1.21,1.21,0,0,1,.55.94.59.59,0,0,1,0,.14.53.53,0,0,1-1.06-.09v-.06A.53.53,0,0,1,320,124.94Z"
                        style="fill: rgb(55, 71, 79); transform-origin: 320.682px 125.18px;" id="el8t6rmez2j32"
                        class="animable"></path>
                      <path
                        d="M320.54,124.67c-.3-.18-.55,0-.55.31a1.2,1.2,0,0,0,.55.94c.3.17.54,0,.54-.31A1.19,1.19,0,0,0,320.54,124.67Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 320.535px 125.293px;" id="elikbr84b33gi"
                        class="animable"></path>
                    </g>
                  </g>
                  <g id="freepik--Tube--inject-85" class="animable" style="transform-origin: 361.791px 97.25px;">
                    <path
                      d="M425.51,137.48l3-5.17L298.13,57.05h0a1.46,1.46,0,0,0-1.53.12,4.66,4.66,0,0,0-2.1,3.65,1.5,1.5,0,0,0,.57,1.33h0l0,0h0Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 361.501px 97.1841px;" id="elc1dk2d97wrn"
                      class="animable"></path>
                    <path
                      d="M424.88,136.1a4.66,4.66,0,0,1,2.11-3.65c1.16-.67,2.1-.12,2.1,1.22a4.65,4.65,0,0,1-2.1,3.65C425.82,138,424.88,137.45,424.88,136.1Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 426.985px 134.888px;" id="elqq4gnft3jl"
                      class="animable"></path>
                  </g>
                  <g id="freepik--sheet--inject-85" class="animable" style="transform-origin: 331.374px 95.1793px;">
                    <g id="el2ralqh4xwvo">
                      <polygon points="340.75 115.18 322.89 104.87 322.89 74.83 340.75 85.15 340.75 115.18"
                        style="opacity: 0.15; transform-origin: 331.82px 95.005px;" class="animable"></polygon>
                    </g>
                    <path
                      d="M339.45,115.47l-17-9.8a1,1,0,0,1-.45-.78v-29a.28.28,0,0,1,.45-.26l17,9.8a1,1,0,0,1,.45.78v29C339.9,115.49,339.7,115.61,339.45,115.47Z"
                      style="fill: rgb(255, 255, 255); transform-origin: 330.949px 95.5495px;" id="el2ktfto4zyeo"
                      class="animable"></path>
                    <path
                      d="M337.73,89.82,324.2,82a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12L337.73,89a1,1,0,0,1,.51.71C338.24,89.92,338,90,337.73,89.82Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 330.97px 85.5033px;" id="eljp7nscdgwvs"
                      class="animable"></path>
                    <path
                      d="M337.73,92,324.2,84.14a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.51.71C338.24,92.06,338,92.12,337.73,92Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 330.97px 87.6438px;" id="eleaqv7s391s"
                      class="animable"></path>
                    <path
                      d="M337.73,96.4,324.2,88.59a1,1,0,0,1-.5-.7c0-.23.22-.29.5-.13l13.53,7.82a1,1,0,0,1,.51.7C338.24,96.51,338,96.56,337.73,96.4Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 330.97px 92.0817px;" id="el86757buurcq"
                      class="animable"></path>
                    <path
                      d="M337.73,98.54,324.2,90.73a1,1,0,0,1-.5-.71c0-.22.22-.28.5-.12l13.53,7.82a1,1,0,0,1,.51.7C338.24,98.65,338,98.7,337.73,98.54Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 330.97px 94.2214px;" id="el8har53xy1yt"
                      class="animable"></path>
                    <path
                      d="M337.73,105.12,324.2,97.31a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.51.7C338.24,105.23,338,105.28,337.73,105.12Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 330.97px 100.805px;" id="elkc3ugj33rhc"
                      class="animable"></path>
                    <path
                      d="M337.73,103,324.2,95.17a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.51.7C338.24,103.09,338,103.14,337.73,103Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 330.97px 98.6674px;" id="el4rkkp8vuh4p"
                      class="animable"></path>
                    <g id="freepik--pushpin--inject-85" class="animable" style="transform-origin: 329.868px 83.5171px;">
                      <path
                        d="M330,83.28l0,0,.07,0s.06,0,.11,0l.34-.2.48-.29c.17-.1.36-.21.54-.33s0-.22-.11-.19l-.56.31-.49.27-.34.19s-.08,0-.08.09,0,0,0,.07Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 330.788px 82.7723px;" id="elb4uvqs6u5sq"
                        class="animable"></path>
                      <path
                        d="M329.63,83.52c.26.46.69.71,1.15.46h0a.48.48,0,0,0,.19-.44,1.54,1.54,0,0,0-.68-1.19.53.53,0,0,0-.46-.06l0,0,0,0A.84.84,0,0,0,329.63,83.52Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 330.21px 83.1707px;" id="eltmbx17hspx"
                        class="animable"></path>
                      <g id="eltjltqcyc60h">
                        <g style="opacity: 0.15; transform-origin: 330.21px 83.1707px;" class="animable">
                          <path
                            d="M329.63,83.52c.26.46.69.71,1.15.46h0a.48.48,0,0,0,.19-.44,1.54,1.54,0,0,0-.68-1.19.53.53,0,0,0-.46-.06l0,0,0,0A.84.84,0,0,0,329.63,83.52Z"
                            id="elustuk1ho7fs" class="animable" style="transform-origin: 330.21px 83.1707px;"></path>
                        </g>
                      </g>
                      <path
                        d="M329.08,84.42l-.51-.86a4.79,4.79,0,0,0,1.07-.75h0l0,0h0a.32.32,0,0,1,.34,0,1,1,0,0,1,.44.78.32.32,0,0,1-.13.29h0l-.08,0A4.84,4.84,0,0,0,329.08,84.42Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 329.496px 83.5906px;" id="elqtg2rid2uq"
                        class="animable"></path>
                      <path
                        d="M328.13,83.72a.54.54,0,0,1,.54-.53.63.63,0,0,1,.19,0h0l.08,0a1.23,1.23,0,0,1,.55.94.59.59,0,0,1,0,.14.53.53,0,0,1-1.06-.09v-.05A.55.55,0,0,1,328.13,83.72Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 328.812px 83.9699px;" id="elyqbiqrdc8vb"
                        class="animable"></path>
                      <g id="elemg2k4e8e2e">
                        <g style="opacity: 0.15; transform-origin: 328.812px 83.9699px;" class="animable">
                          <path
                            d="M328.13,83.72a.54.54,0,0,1,.54-.53.63.63,0,0,1,.19,0h0l.08,0a1.23,1.23,0,0,1,.55.94.59.59,0,0,1,0,.14.53.53,0,0,1-1.06-.09v-.05A.55.55,0,0,1,328.13,83.72Z"
                            id="elbo5z4dob65i" class="animable" style="transform-origin: 328.812px 83.9699px;"></path>
                        </g>
                      </g>
                      <path
                        d="M328.67,83.45c-.3-.17-.55,0-.55.31a1.2,1.2,0,0,0,.55.94c.3.18.54,0,.54-.31A1.19,1.19,0,0,0,328.67,83.45Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 328.665px 84.0772px;" id="eli7kf7a7l4k"
                        class="animable"></path>
                    </g>
                    <polygon points="337.78 86.21 336.31 85.36 336.31 79.78 337.78 80.63 337.78 86.21"
                      style="fill: rgb(38, 50, 56); transform-origin: 337.045px 82.995px;" id="el1g74o3pqgi9"
                      class="animable"></polygon>
                  </g>
                  <g id="freepik--sheet--inject-85" class="animable" style="transform-origin: 310.755px 83.2694px;">
                    <g id="elyft8roawt1i">
                      <polygon points="320.13 103.27 302.27 92.96 302.27 62.92 320.13 73.24 320.13 103.27"
                        style="opacity: 0.15; transform-origin: 311.2px 83.095px;" class="animable"></polygon>
                    </g>
                    <path
                      d="M318.83,103.56l-17-9.8a1,1,0,0,1-.45-.78V64c0-.29.21-.41.45-.26l17,9.79a1,1,0,0,1,.45.78v29C319.28,103.58,319.08,103.7,318.83,103.56Z"
                      style="fill: rgb(255, 255, 255); transform-origin: 310.33px 83.647px;" id="ellc25rzblfcn"
                      class="animable"></path>
                    <path
                      d="M317.11,77.91,303.58,70.1a1,1,0,0,1-.5-.71c0-.22.22-.28.5-.12l13.53,7.82a1,1,0,0,1,.51.7C317.62,78,317.39,78.07,317.11,77.91Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 310.35px 73.5887px;" id="elxqrpkmzjtie"
                      class="animable"></path>
                    <path
                      d="M317.11,80.05l-13.53-7.81a1,1,0,0,1-.5-.71c0-.22.22-.28.5-.12l13.53,7.82a1,1,0,0,1,.51.7C317.62,80.15,317.39,80.21,317.11,80.05Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 310.35px 75.73px;" id="el50edd6vkpl"
                      class="animable"></path>
                    <path
                      d="M317.11,84.49l-13.53-7.81a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.51.7C317.62,84.6,317.39,84.65,317.11,84.49Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 310.35px 80.175px;" id="els1s1txriwb"
                      class="animable"></path>
                    <path
                      d="M317.11,86.63l-13.53-7.81a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.51.7C317.62,86.74,317.39,86.79,317.11,86.63Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 310.35px 82.315px;" id="el1hdptbz301b"
                      class="animable"></path>
                    <path
                      d="M317.11,93.21,303.58,85.4a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.51.7C317.62,93.32,317.39,93.38,317.11,93.21Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 310.35px 88.8972px;" id="el1khoqag4jhc"
                      class="animable"></path>
                    <path
                      d="M317.11,91.07l-13.53-7.81a1,1,0,0,1-.5-.7c0-.23.22-.28.5-.12l13.53,7.81a1,1,0,0,1,.51.7C317.62,91.18,317.39,91.24,317.11,91.07Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 310.35px 86.7572px;" id="elkn965goo2uh"
                      class="animable"></path>
                    <g id="freepik--pushpin--inject-85" class="animable" style="transform-origin: 309.212px 71.6098px;">
                      <path
                        d="M309.36,71.37l0,0,.07,0s.06,0,.11,0l.34-.2.48-.28.54-.34c.06,0,0-.22-.11-.19l-.56.31-.49.27-.34.2s-.08,0-.08.08,0,0,0,.07Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 310.122px 70.8636px;" id="el06y5octcdm3d"
                        class="animable"></path>
                      <path
                        d="M309,71.61c.26.46.69.71,1.15.46h0a.48.48,0,0,0,.19-.44,1.55,1.55,0,0,0-.68-1.19.53.53,0,0,0-.46-.06l0,0,0,0A.84.84,0,0,0,309,71.61Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 309.58px 71.2607px;" id="el8ebg1deslnm"
                        class="animable"></path>
                      <g id="elgtadtsvhtif">
                        <g style="opacity: 0.15; transform-origin: 309.58px 71.2607px;" class="animable">
                          <path
                            d="M309,71.61c.26.46.69.71,1.15.46h0a.48.48,0,0,0,.19-.44,1.55,1.55,0,0,0-.68-1.19.53.53,0,0,0-.46-.06l0,0,0,0A.84.84,0,0,0,309,71.61Z"
                            id="el2li4jteltug" class="animable" style="transform-origin: 309.58px 71.2607px;"></path>
                        </g>
                      </g>
                      <path
                        d="M308.46,72.52l-.51-.87a5,5,0,0,0,1.07-.74s0,0,0,0l0,0h0a.3.3,0,0,1,.34,0,1,1,0,0,1,.44.77.32.32,0,0,1-.13.29h0l-.08,0A4.36,4.36,0,0,0,308.46,72.52Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 308.876px 71.6886px;" id="elrurwpo94hx"
                        class="animable"></path>
                      <path
                        d="M307.51,71.81a.54.54,0,0,1,.54-.53.63.63,0,0,1,.19,0h0l.08,0a1.2,1.2,0,0,1,.55.94.51.51,0,0,1,0,.13.53.53,0,0,1-1.06-.09v0A.55.55,0,0,1,307.51,71.81Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 308.192px 72.0533px;" id="el2rne7tcnh4d"
                        class="animable"></path>
                      <g id="elbllbig661xm">
                        <g style="opacity: 0.15; transform-origin: 308.192px 72.0533px;" class="animable">
                          <path
                            d="M307.51,71.81a.54.54,0,0,1,.54-.53.63.63,0,0,1,.19,0h0l.08,0a1.2,1.2,0,0,1,.55.94.51.51,0,0,1,0,.13.53.53,0,0,1-1.06-.09v0A.55.55,0,0,1,307.51,71.81Z"
                            id="elbx6mytun2su" class="animable" style="transform-origin: 308.192px 72.0533px;"></path>
                        </g>
                      </g>
                      <path
                        d="M308.05,71.54c-.3-.17-.55,0-.55.32a1.23,1.23,0,0,0,.55.94c.3.17.54,0,.54-.32A1.22,1.22,0,0,0,308.05,71.54Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 308.045px 72.17px;" id="elem6xfcp77xd"
                        class="animable"></path>
                    </g>
                    <polygon points="317.16 74.3 315.69 73.45 315.69 67.88 317.16 68.72 317.16 74.3"
                      style="fill: rgb(38, 50, 56); transform-origin: 316.425px 71.09px;" id="ellbcz78tpew9"
                      class="animable"></polygon>
                  </g>
                  <g id="freepik--note--inject-85" class="animable" style="transform-origin: 336.685px 117.28px;">
                    <g id="elgmh1pl34eai">
                      <polygon points="341.77 126.5 333.06 121.47 333.06 108.06 341.77 113.09 341.77 126.5"
                        style="opacity: 0.15; transform-origin: 337.415px 117.28px;" class="animable"></polygon>
                    </g>
                    <g id="freepik--note--inject-85" class="animable" style="transform-origin: 336.505px 116.443px;">
                      <path d="M331.6,121.05l6,3.37c.67.37,1.11-.71,1.11-1.36.67.43,2,.69,2.12-.16l.56-7.6-9.05-5.23Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 336.495px 117.283px;" id="eldv82ms356l"
                        class="animable"></path>
                      <polygon points="332.36 110.07 341.41 115.3 341.41 113.62 332.36 108.39 332.36 110.07"
                        style="fill: rgb(55, 71, 79); transform-origin: 336.885px 111.845px;" id="eltwuqf1eaje"
                        class="animable"></polygon>
                      <polygon points="340.57 123.36 338.09 124.45 338.86 122.43 340.57 123.36"
                        style="fill: rgb(55, 71, 79); transform-origin: 339.33px 123.44px;" id="el83atwxrt7xr"
                        class="animable"></polygon>
                    </g>
                  </g>
                </g>
              </g>
              <g id="freepik--Water--inject-85" class="animable" style="transform-origin: 441.09px 297.289px;">
                <g id="freepik--water--inject-85" class="animable" style="transform-origin: 441.09px 297.289px;">
                  <path
                    d="M420.28,282.69l16.31-9.41a9.87,9.87,0,0,1,9,0l16.31,9.41a9.93,9.93,0,0,1,4.49,7.78V368l-25.29,14.6L415.79,368V290.47A9.93,9.93,0,0,1,420.28,282.69Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 441.09px 327.397px;" id="el54p6jcwpwdp"
                    class="animable"></path>
                  <path
                    d="M441.08,305.07a9.93,9.93,0,0,0-4.49-7.78l-16.31-9.41c-2.48-1.44-4.49-.27-4.49,2.59V368l25.29,14.6Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 428.435px 334.932px;" id="elwmvjqpwlqw"
                    class="animable"></path>
                  <path
                    d="M466.37,290.47V368l-25.29,14.6V305.07a9.61,9.61,0,0,0-1.83-5.23l25.28-14.6A9.62,9.62,0,0,1,466.37,290.47Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 452.81px 333.92px;" id="elfj6gam36ryi"
                    class="animable"></path>
                  <polygon points="417.9 301.22 438.98 313.39 438.97 341.4 417.9 329.23 417.9 301.22"
                    style="fill: rgb(69, 90, 100); transform-origin: 428.44px 321.31px;" id="elp8wk7ov45pd"
                    class="animable"></polygon>
                  <g id="elp1awqx1mmy">
                    <polygon points="417.9 301.22 438.98 313.39 438.97 341.4 417.9 329.23 417.9 301.22"
                      style="opacity: 0.1; transform-origin: 428.44px 321.31px;" class="animable"></polygon>
                  </g>
                  <polygon points="423.72 325.87 423.72 304.56 438.98 313.39 438.97 334.69 423.72 325.87"
                    style="fill: rgb(38, 50, 56); transform-origin: 431.35px 319.625px;" id="elcb0a0vc0vbq"
                    class="animable"></polygon>
                  <polygon points="423.72 325.87 417.9 329.23 438.97 341.4 438.97 334.69 423.72 325.87"
                    style="fill: rgb(69, 90, 100); transform-origin: 428.435px 333.635px;" id="elm21pdjr1vn"
                    class="animable"></polygon>
                  <path d="M421,303l.77,3.72.84.48a2.56,2.56,0,0,0,2.58,0l.16-.09.32-1.42Z"
                    style="fill: rgb(250, 250, 250); transform-origin: 423.335px 305.274px;" id="el4yyj65olq88"
                    class="animable"></path>
                  <path d="M431.19,308.88l.78,3.78.84.48a2.58,2.58,0,0,0,2.58,0l.16-.09.32-1.46Z"
                    style="fill: rgb(250, 250, 250); transform-origin: 433.53px 311.183px;" id="eluvjb1ivmk"
                    class="animable"></path>
                  <path
                    d="M462.3,275.86c0-2.8-2.12-5.62-5.8-7.75a34.27,34.27,0,0,0-30.82,0c-3.68,2.13-5.8,4.95-5.8,7.75v3.45c0,2.8,2.12,5.62,5.8,7.75a34.27,34.27,0,0,0,30.82,0c3.68-2.13,5.8-4.95,5.8-7.75Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 441.09px 277.585px;" id="elw2b4b3w8wh8"
                    class="animable"></path>
                  <path
                    d="M441.09,287.27a31.74,31.74,0,0,1-15.41-3.66c-3.68-2.13-5.8-4.95-5.8-7.75s2.12-5.62,5.8-7.75a34.27,34.27,0,0,1,30.82,0c3.68,2.13,5.8,4.95,5.8,7.75s-2.12,5.62-5.8,7.75A31.85,31.85,0,0,1,441.09,287.27Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 441.09px 275.863px;" id="eljr1bolff7f"
                    class="animable"></path>
                  <g id="elsem1woupav">
                    <path
                      d="M464.21,271.12V226.31c.45-3.74-1.78-7.56-6.72-10.41-9.06-5.23-23.74-5.23-32.8,0-4.54,2.62-6.8,6.06-6.79,9.49h0v47.73H418c.42,3.06,2.65,6.06,6.71,8.41,9.06,5.23,23.74,5.23,32.8,0,4.06-2.35,6.29-5.35,6.71-8.41h0V273A8.35,8.35,0,0,0,464.21,271.12Z"
                      style="fill: rgb(38, 50, 56); opacity: 0.4; transform-origin: 441.084px 248.715px;"
                      class="animable"></path>
                  </g>
                  <g id="elxsy3zllbzsr">
                    <path
                      d="M441.09,282.47A30.35,30.35,0,0,1,426.18,279c-3.08-1.78-4.94-4-5.25-6.24l-.05-.43V241.4c0-2.44,1.92-5,5.3-6.91a33.25,33.25,0,0,1,29.82,0c3.66,2.11,5.57,4.83,5.25,7.47l0,.18V271.3l0,.18a4.5,4.5,0,0,1,0,1.16l0,.19C460.87,275,459,277.2,456,279A30.35,30.35,0,0,1,441.09,282.47Z"
                      style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 441.084px 256.72px;"
                      class="animable"></path>
                  </g>
                  <g id="elgcjijs65h9t">
                    <path
                      d="M456,234.49A31.28,31.28,0,0,0,441.09,231a35.26,35.26,0,0,0-14.91,3.53c-3.39,1.59-5.33,4.43-5.3,7.47s1.91,5.88,5.3,7.47A35.26,35.26,0,0,0,441.09,253,30.35,30.35,0,0,0,456,249.43c3.66-2.11,5.25-4.73,5.25-7.47C461.42,239.13,459.75,236.55,456,234.49Z"
                      style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 441.071px 242.001px;"
                      class="animable"></path>
                  </g>
                  <g id="elgpcwt9dpsj">
                    <path
                      d="M441.09,236.78a31.85,31.85,0,0,1-15.41-3.66c-3.68-2.13-5.8-5-5.8-7.75s2.12-5.62,5.8-7.75a34.27,34.27,0,0,1,30.82,0c3.68,2.13,5.8,4.95,5.8,7.75s-2.12,5.62-5.8,7.75A31.85,31.85,0,0,1,441.09,236.78Z"
                      style="fill: rgb(38, 50, 56); opacity: 0.2; transform-origin: 441.09px 225.373px;"
                      class="animable"></path>
                  </g>
                  <path
                    d="M433,301.38l-.9.52,0,.07a1.29,1.29,0,0,0-.16.66,3.08,3.08,0,0,0,1.39,2.4,1.33,1.33,0,0,0,.65.19l0,.07.9-.52h0a1,1,0,0,0,.41-.89,3.08,3.08,0,0,0-1.39-2.41A1,1,0,0,0,433,301.38Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 433.616px 303.301px;" id="elusg60qquol"
                    class="animable"></path>
                  <g id="elki8zroqxkc">
                    <path
                      d="M433,301.38l-.9.52,0,.07a1.29,1.29,0,0,0-.16.66,3.08,3.08,0,0,0,1.39,2.4,1.33,1.33,0,0,0,.65.19l0,.07.9-.52h0a1,1,0,0,0,.41-.89,3.08,3.08,0,0,0-1.39-2.41A1,1,0,0,0,433,301.38Z"
                      style="opacity: 0.15; transform-origin: 433.616px 303.301px;" class="animable"></path>
                  </g>
                  <path
                    d="M434.47,304.4c0,.88-.62,1.24-1.39.8a3.08,3.08,0,0,1-1.39-2.41c0-.88.62-1.24,1.39-.8A3.08,3.08,0,0,1,434.47,304.4Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 433.08px 303.595px;" id="elpoy680lozma"
                    class="animable"></path>
                  <path
                    d="M422.8,295.55l-.9.52.05.08a1.14,1.14,0,0,0-.16.65,3.09,3.09,0,0,0,1.38,2.41,1.26,1.26,0,0,0,.65.18l0,.08.9-.52h0a1,1,0,0,0,.41-.9,3.06,3.06,0,0,0-1.39-2.4A1,1,0,0,0,422.8,295.55Z"
                    style="fill: rgb(224, 224, 224); transform-origin: 423.461px 297.473px;" id="elxan2g2gzl3"
                    class="animable"></path>
                  <path
                    d="M424.27,298.57c0,.89-.62,1.25-1.39.8a3.06,3.06,0,0,1-1.38-2.4c0-.88.62-1.24,1.38-.8A3.06,3.06,0,0,1,424.27,298.57Z"
                    style="fill: rgb(250, 250, 250); transform-origin: 422.885px 297.773px;" id="elzc3jse0v5yh"
                    class="animable"></path>
                </g>
              </g>
              <g id="freepik--Clock--inject-85" class="animable" style="transform-origin: 456.286px 158.995px;">
                <g id="freepik--clock--inject-85" class="animable" style="transform-origin: 456.286px 158.995px;">
                  <path
                    d="M445.2,141h0l0,0h0l2.81-1.67h0l0,0h0c2.78-1.4,6.49-1,10.48,1.58,8,5.17,14.16,17.09,13.69,26.62-.23,4.75-2.05,8-4.82,9.45h0l0,0h0l-2.81,1.67h0c-2.78,1.42-6.49,1-10.49-1.57-8-5.17-14.15-17.09-13.69-26.62C440.61,145.71,442.44,142.45,445.2,141Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 456.276px 158.995px;" id="eln7dsuckz7ha"
                    class="animable"></path>
                  <path
                    d="M464.79,178.53,467.4,177h0l0,0c2.77-1.44,4.59-4.7,4.82-9.45a29.73,29.73,0,0,0-2.89-13.36l-2.82,1.67a29.48,29.48,0,0,1,2.9,13.36C469.22,173.82,467.46,177,464.79,178.53Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 468.508px 166.36px;" id="el56qhni5wgjr"
                    class="animable"></path>
                  <path
                    d="M454.07,177.08c-8-5.17-14.15-17.09-13.69-26.62s7.34-13.07,15.37-7.91,14.15,17.09,13.69,26.62S462.1,182.25,454.07,177.08Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 454.91px 159.817px;" id="eloqqlurkr9w"
                    class="animable"></path>
                  <path
                    d="M460.8,176.41c4.73.23,5.5-5.09,5.61-7.38.41-8.41-5.23-19.37-12.3-23.92a10.72,10.72,0,0,0-5.09-1.89c-4.73-.23-5.5,5.09-5.61,7.39-.41,8.4,5.23,19.36,12.3,23.92a10.7,10.7,0,0,0,5.09,1.88Z"
                    style="fill: rgb(250, 250, 250); transform-origin: 454.91px 159.815px;" id="elsivdgiczm4a"
                    class="animable"></path>
                  <path
                    d="M454.33,162a1.4,1.4,0,0,1-.17-.22,1.88,1.88,0,0,1-.35-.89V148.68c0-.29.23-.25.52.08a2.12,2.12,0,0,1,.51,1.11v10.66l5.68-.73c.17,0,.49.31.72.74s.26.81.09.83l-6.6.86C454.64,162.24,454.48,162.13,454.33,162Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 457.624px 155.358px;" id="el61vfqdft7y3"
                    class="animable"></path>
                  <path
                    d="M451.42,167.58a.35.35,0,0,1-.07-.09.67.67,0,0,1-.15-.44l2.86-6.32c0-.08.15,0,.27.16s.18.37.14.44l-2.85,6.33C451.59,167.72,451.51,167.68,451.42,167.58Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 452.841px 164.193px;" id="el7xk1djp4dfj"
                    class="animable"></path>
                  <path
                    d="M454.16,158.82a3.84,3.84,0,0,1,1.81,3c.06,1.18-.66,1.75-1.61,1.27a3.91,3.91,0,0,1-1.81-3C452.5,158.9,453.22,158.34,454.16,158.82Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 454.261px 160.954px;" id="elq1x6ipjzh1l"
                    class="animable"></path>
                </g>
              </g>
              <g id="freepik--Window--inject-85" class="animable" style="transform-origin: 237.145px 97.205px;">
                <g id="freepik--window--inject-85" class="animable" style="transform-origin: 237.145px 97.205px;">
                  <g id="freepik--window--inject-85" class="animable" style="transform-origin: 237.145px 97.205px;">
                    <polygon
                      points="284.11 164.18 280.5 166.27 190.17 114.11 193.78 112.03 231.72 133.93 235.34 136.02 237.14 137.06 237.15 137.06 280.5 162.1 284.11 164.18"
                      style="fill: rgb(245, 245, 245); transform-origin: 237.14px 139.15px;" id="el9g3hhb3pow7"
                      class="animable"></polygon>
                    <polygon points="235.34 54.23 235.34 138.1 231.72 136.02 231.72 52.14 235.34 54.23"
                      style="fill: rgb(235, 235, 235); transform-origin: 233.53px 95.12px;" id="el7f31rlowowm"
                      class="animable"></polygon>
                    <polygon points="237.15 53.19 237.15 137.06 237.14 137.06 235.34 138.1 235.34 54.23 237.15 53.19"
                      style="fill: rgb(224, 224, 224); transform-origin: 236.245px 95.645px;" id="elj8e9p0fko2"
                      class="animable"></polygon>
                    <polygon points="235.34 54.23 231.72 52.15 233.53 51.1 237.14 53.19 235.34 54.23"
                      style="fill: rgb(250, 250, 250); transform-origin: 234.43px 52.665px;" id="elpk2hwd94fw"
                      class="animable"></polygon>
                    <path
                      d="M237.15,53.19l-3.62-2.1L186.56,24V116.2l97.55,56.32V80.3ZM280.5,166.27l-90.33-52.16V30.24l3.62,2.08h0l37.93,21.9h0l3.6,2.08h0l1.8,1h0l43.35,25Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 235.335px 98.26px;" id="elihqc9ngtnp"
                      class="animable"></path>
                    <polygon points="280.5 82.39 280.5 162.1 237.15 137.06 237.15 57.36 280.5 82.39"
                      style="fill: rgb(38, 50, 56); transform-origin: 258.825px 109.73px;" id="elck0yfdkyxeo"
                      class="animable"></polygon>
                    <g id="elhnarkd4n7ib">
                      <polygon points="280.5 82.39 280.5 162.1 237.15 137.06 237.15 57.36 280.5 82.39"
                        style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 258.825px 109.73px;"
                        class="animable"></polygon>
                    </g>
                    <polygon points="231.72 54.23 231.72 133.93 193.78 112.03 193.79 32.33 231.72 54.23"
                      style="fill: rgb(38, 50, 56); transform-origin: 212.75px 83.13px;" id="elhfodx5rsipa"
                      class="animable"></polygon>
                    <g id="elkjqt5vak2zk">
                      <polygon points="231.72 54.23 231.72 133.93 193.78 112.03 193.79 32.33 231.72 54.23"
                        style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 212.75px 83.13px;"
                        class="animable"></polygon>
                    </g>
                    <polygon points="193.79 32.32 193.79 32.33 193.78 112.03 190.17 114.11 190.17 30.24 193.79 32.32"
                      style="fill: rgb(224, 224, 224); transform-origin: 191.98px 72.175px;" id="elnkuz9j3kqs"
                      class="animable"></polygon>
                    <polygon points="186.56 23.98 190.17 21.89 287.73 78.22 284.11 80.3 186.56 23.98"
                      style="fill: rgb(245, 245, 245); transform-origin: 237.145px 51.095px;" id="el2a2t7dx7adc"
                      class="animable"></polygon>
                    <polygon points="287.73 78.22 284.11 80.3 284.11 172.52 287.72 170.44 287.73 78.22"
                      style="fill: rgb(224, 224, 224); transform-origin: 285.92px 125.37px;" id="elngq8z7lja9"
                      class="animable"></polygon>
                    <g id="eln0hgmx9d1r8">
                      <polygon points="235.34 56.31 231.73 54.23 231.73 56.32 235.34 58.4 235.34 56.31"
                        style="opacity: 0.1; transform-origin: 233.535px 56.315px;" class="animable"></polygon>
                    </g>
                    <g id="elwuby8eeseyf">
                      <polygon points="235.34 58.4 237.14 57.36 235.34 56.31 235.34 58.4"
                        style="opacity: 0.1; transform-origin: 236.24px 57.355px;" class="animable"></polygon>
                    </g>
                  </g>
                  <g id="el7xj6uzz6nrq">
                    <polygon points="259.11 80.03 280.5 92.4 280.47 162.1 259.07 149.72 259.11 80.03"
                      style="opacity: 0.05; transform-origin: 269.785px 121.065px;" class="animable"></polygon>
                  </g>
                  <g id="elnapcncjvkuj">
                    <polygon points="280.5 105.45 259.1 93.08 259.11 85.86 280.5 98.23 280.5 105.45"
                      style="opacity: 0.05; transform-origin: 269.8px 95.655px;" class="animable"></polygon>
                  </g>
                  <g id="el5kw0laal8ro">
                    <polygon points="280.49 118.7 259.1 106.33 259.1 99.1 280.5 111.47 280.49 118.7"
                      style="opacity: 0.05; transform-origin: 269.8px 108.9px;" class="animable"></polygon>
                  </g>
                  <g id="elp7g7hfjfdc">
                    <polygon points="280.49 131.95 259.09 119.58 259.1 112.35 280.49 124.72 280.49 131.95"
                      style="opacity: 0.05; transform-origin: 269.79px 122.15px;" class="animable"></polygon>
                  </g>
                  <g id="elgdwb8tmq9ks">
                    <polygon points="280.48 145.19 259.09 132.82 259.09 125.6 280.49 137.97 280.48 145.19"
                      style="opacity: 0.05; transform-origin: 269.79px 135.395px;" class="animable"></polygon>
                  </g>
                  <g id="elihejhrnljt">
                    <polygon points="280.48 158.44 259.08 146.07 259.09 138.84 280.48 151.22 280.48 158.44"
                      style="opacity: 0.05; transform-origin: 269.78px 148.64px;" class="animable"></polygon>
                  </g>
                  <g id="elolqcd9yxpf">
                    <polygon points="249.78 144.36 259.07 149.72 259.1 102.72 249.8 97.35 249.78 144.36"
                      style="opacity: 0.05; transform-origin: 254.44px 123.535px;" class="animable"></polygon>
                  </g>
                  <g id="elynlyu7hw2f">
                    <path d="M216.23,65V53.81L211.4,51V62.17l-5.05-2.93V48.12l-12.54-7.25v71.18l27.48,15.86v-60Z"
                      style="opacity: 0.05; transform-origin: 207.55px 84.39px;" class="animable"></path>
                  </g>
                  <g id="elh1afhm3z63i">
                    <g style="opacity: 0.05; transform-origin: 207.305px 91.67px;" class="animable">
                      <polygon points="215.02 83.55 218.15 85.36 218.15 72.74 215.02 70.93 215.02 83.55"
                        id="elvo6kx9bp4kl" class="animable" style="transform-origin: 216.585px 78.145px;"></polygon>
                      <polygon points="209.48 80.34 212.61 82.15 212.61 69.54 209.48 67.73 209.48 80.34"
                        id="elamv7m2egjw7" class="animable" style="transform-origin: 211.045px 74.94px;"></polygon>
                      <polygon points="215.02 102.43 218.15 104.23 218.15 91.62 215.02 89.81 215.02 102.43"
                        id="elmonoqot22z8" class="animable" style="transform-origin: 216.585px 97.02px;"></polygon>
                      <polygon points="209.48 99.23 212.61 101.03 212.61 88.42 209.48 86.61 209.48 99.23"
                        id="ely9vit6sjf5q" class="animable" style="transform-origin: 211.045px 93.82px;"></polygon>
                      <polygon points="215.02 121.31 218.15 123.12 218.15 110.5 215.02 108.69 215.02 121.31"
                        id="el1j6zci5iiil" class="animable" style="transform-origin: 216.585px 115.905px;"></polygon>
                      <polygon points="209.48 118.11 212.61 119.92 212.61 107.3 209.48 105.49 209.48 118.11"
                        id="el3xe823mkpdk" class="animable" style="transform-origin: 211.045px 112.705px;"></polygon>
                      <polygon points="202.01 76.03 205.14 77.84 205.14 65.22 202.01 63.42 202.01 76.03"
                        id="elsv3w9kv8q8" class="animable" style="transform-origin: 203.575px 70.63px;"></polygon>
                      <polygon points="196.46 72.83 199.6 74.64 199.6 62.02 196.46 60.22 196.46 72.83"
                        id="elz2tbxgqxa79" class="animable" style="transform-origin: 198.03px 67.43px;"></polygon>
                      <polygon points="202.01 94.91 205.14 96.72 205.14 84.11 202.01 82.3 202.01 94.91"
                        id="el8h0wgxlt79s" class="animable" style="transform-origin: 203.575px 89.51px;"></polygon>
                      <polygon points="196.46 91.71 199.6 93.52 199.6 80.91 196.46 79.1 196.46 91.71" id="elc121bo4cay9"
                        class="animable" style="transform-origin: 198.03px 86.31px;"></polygon>
                      <polygon points="202.01 113.79 205.14 115.6 205.14 102.99 202.01 101.18 202.01 113.79"
                        id="ellkvmdfr0caq" class="animable" style="transform-origin: 203.575px 108.39px;"></polygon>
                      <polygon points="196.46 110.59 199.6 112.4 199.6 99.79 196.46 97.98 196.46 110.59"
                        id="elw113957lmpk" class="animable" style="transform-origin: 198.03px 105.19px;"></polygon>
                    </g>
                  </g>
                </g>
              </g>
              <g id="freepik--character-3--inject-85" class="animable" style="transform-origin: 261.944px 240.516px;">
                <g id="freepik--Character--inject-85" class="animable" style="transform-origin: 261.944px 240.516px;">
                  <g id="freepik--Chair--inject-85" class="animable" style="transform-origin: 266.975px 259.967px;">
                    <path d="M267,321.25a.93.93,0,0,0,.93-.93V260.5a.93.93,0,0,0-1.86,0v59.82A.93.93,0,0,0,267,321.25Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 267px 290.413px;" id="elskhwit5rqp"
                      class="animable"></path>
                    <path
                      d="M230,299.48a.93.93,0,0,0,.87-.59l18.34-46.43a.93.93,0,0,0-1.73-.69L229.1,298.2a.94.94,0,0,0,.52,1.21A.83.83,0,0,0,230,299.48Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 239.156px 275.332px;" id="el9rpnldsh8e5"
                      class="animable"></path>
                    <path
                      d="M232.17,293.9a.92.92,0,0,0,.67-.29L267,257.49l34.07,36a.93.93,0,1,0,1.35-1.27L267.65,255.5a.91.91,0,0,0-.67-.3h0a.93.93,0,0,0-.68.3l-34.81,36.83a.94.94,0,0,0,0,1.32A1,1,0,0,0,232.17,293.9Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 266.974px 274.55px;" id="el3nohsoq5edk"
                      class="animable"></path>
                    <path
                      d="M304,299.48a.83.83,0,0,0,.34-.07.93.93,0,0,0,.52-1.21l-18.34-46.43a.93.93,0,1,0-1.73.69l18.34,46.43A1,1,0,0,0,304,299.48Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 294.824px 275.33px;" id="elplmkcm7vv5"
                      class="animable"></path>
                    <path
                      d="M231.23,292.47l-2.43,6.4a.78.78,0,0,0,0,.16v.12c0,.13.19.29.37.4a1.65,1.65,0,0,0,1.47,0,.63.63,0,0,0,.29-.3h0l0-.09,2.25-6Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 230.988px 296.096px;" id="elhehcwy8w5cb"
                      class="animable"></path>
                    <path
                      d="M302.72,292.47l2.43,6.4a.78.78,0,0,1,0,.16v.12c0,.13-.19.29-.37.4a1.65,1.65,0,0,1-1.47,0,.63.63,0,0,1-.29-.3h0l0-.09-2.25-6Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 302.962px 296.096px;" id="elj18gvwplar"
                      class="animable"></path>
                    <path
                      d="M265.9,315.69V321a.54.54,0,0,0,.32.44,1.67,1.67,0,0,0,1.51,0,.54.54,0,0,0,.32-.44v-5.29A2.28,2.28,0,0,0,265.9,315.69Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 266.975px 318.525px;" id="elbm62dv3595q"
                      class="animable"></path>
                    <path
                      d="M232,254.64c0-1.41,1.23-2.9,3.83-4.59,4.8-3.11,15.53-9.36,22.25-13.09a.05.05,0,0,1,.05-.05c5.17-3.14,10-18.08,13.57-29.43,1.22-3.87,2.72-6.06,4.49-7.09l2.31-1.3c3.51-2.11,8.12.42,13.86,3.56,5.29,2.89,9.42,6.6,10.25,16.43.5,6,0,17.42-1.19,26.09h0c-1.76,14.48-3.92,14.5-7.06,16.93-5.39,4.17-17.55,10-22.67,12-9.3,3.66-16.89-2-22.55-4.77a132.12,132.12,0,0,1-15-8.89c-1.42-1-2.15-2.07-2.13-3.16C232,256.87,232,255.09,232,254.64Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 267.401px 236.805px;" id="elpflhtvu8ade"
                      class="animable"></path>
                    <g id="el8lj8856sdj3">
                      <path
                        d="M232,254.64c0-1.41,1.23-2.9,3.83-4.59,4.8-3.11,15.53-9.36,22.25-13.09a.05.05,0,0,1,.05-.05c5.17-3.14,10-18.08,13.57-29.43,1.22-3.87,2.72-6.06,4.49-7.09l2.31-1.3c3.51-2.11,8.12.42,13.86,3.56,5.29,2.89,9.42,6.6,10.25,16.43.5,6,0,17.42-1.19,26.09h0c-1.76,14.48-3.92,14.5-7.06,16.93-5.39,4.17-17.55,10-22.67,12-9.3,3.66-16.89-2-22.55-4.77a132.12,132.12,0,0,1-15-8.89c-1.42-1-2.15-2.07-2.13-3.16C232,256.87,232,255.09,232,254.64Z"
                        style="opacity: 0.25; transform-origin: 267.401px 236.805px;" class="animable"></path>
                    </g>
                    <path
                      d="M276.34,200.27c3.48-1.82,8,.66,13.59,3.72,3.58,2,6.64,4.29,8.49,8.65l2.36-1.37c-1.85-4.34-4.9-6.66-8.47-8.62-5.74-3.14-10.35-5.67-13.86-3.56Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 288.56px 205.477px;" id="elgix90i5dj9s"
                      class="animable"></path>
                    <path
                      d="M235.78,250.05c3.12-2,3.19-2.53,22.4-13.18l-.09,0c5.17-3.14,10-18.07,13.56-29.42,3.64-11.53,9.69-8.19,18.28-3.49,5.29,2.9,9.42,6.6,10.25,16.43s-1,34.2-4.34,37.15c-3.66,4-18.34,11.56-24.2,13.87-9.3,3.65-16.89-2-22.55-4.78a130.84,130.84,0,0,1-15-8.88C230.87,255.44,231.17,253.05,235.78,250.05Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 266.165px 236.11px;" id="el2w614x5earr"
                      class="animable"></path>
                    <path d="M258.09,236.9h0Z" style="fill: rgb(38, 50, 56); transform-origin: 258.09px 236.9px;"
                      id="eln23ibutzy3m" class="animable"></path>
                    <g id="el34no782i2tt">
                      <g style="opacity: 0.1; transform-origin: 279.224px 228.655px;" class="animable">
                        <path
                          d="M289.93,204c-8.59-4.7-14.64-8-18.28,3.49-3.58,11.35-8.4,26.29-13.57,29.43,0,0,8.87,0,21.72,6.93,13.35,7.21,15.39,14.27,16,13.76,3.37-2.8,5.2-27.35,4.37-37.18S295.22,206.89,289.93,204Z"
                          id="el3223stmegmg" class="animable" style="transform-origin: 279.224px 228.655px;"></path>
                      </g>
                    </g>
                  </g>
                  <g id="freepik--character--inject-85" class="animable" style="transform-origin: 261.822px 239.876px;">
                    <path
                      d="M233.71,211.58a14.27,14.27,0,0,0-3.23-2.38c-.83-.48-1.79-.77-2.66-1.2a15.84,15.84,0,0,1-3.66-2.4,6.73,6.73,0,0,1-1.35-1.52,12.06,12.06,0,0,1-.94-2,6.72,6.72,0,0,1-.45-2,3.53,3.53,0,0,1,.46-2,1.75,1.75,0,0,1,.89-.79,1.72,1.72,0,0,1,1.26.11,6,6,0,0,1,1.09.71,24.6,24.6,0,0,0,4.74,2.75,2.3,2.3,0,0,0,1.69.26,3.68,3.68,0,0,0-.46-1.39,6.25,6.25,0,0,1-.6-1.35,1.8,1.8,0,0,1,.17-1.42.68.68,0,0,1,.72-.32,1,1,0,0,1,.3.23c.5.52,1,1,1.5,1.55a10.06,10.06,0,0,1,1.15,1.57c.5.76.86,1.5,1.28,2.29a17.5,17.5,0,0,0,3.49,4.14c1.55,1.49,7.44,7.33,8.93,8.64,0,0,8.66-13.85,11-17.44,4.15-6.48,11.86-5.05,11.86-5.05l-2.31,9.6s-13.91,20-16.26,22.72a4.5,4.5,0,0,1-6.82.22,61.27,61.27,0,0,1-4.13-4.69c-2-2.38-4-4.77-6-7.11C234.77,212.72,234.25,212.14,233.71,211.58Z"
                      style="fill: rgb(255, 168, 167); transform-origin: 246.151px 209.502px;" id="ela6qsxu675m5"
                      class="animable"></path>
                    <path
                      d="M271.62,192.3s-6.35-1-9.5,1.67c-2.93,2.54-3.91,4-7.81,10.67-3.57,6.09-6.09,9.57-6.09,9.57s2.57,6.42,7.77,6.29l8.64-11.44Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 259.92px 206.309px;" id="elotwrn0njx6"
                      class="animable"></path>
                    <path
                      d="M259.72,212.58a30.54,30.54,0,0,1-.37,9.74c-1.06,4.36-2.26,7.93-2.26,7.93a9.8,9.8,0,0,0,8.06,3c5.59-.52,4.5-13.78,1.46-17.17A10.47,10.47,0,0,0,259.72,212.58Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 263.104px 222.938px;" id="el8dlc76dos5n"
                      class="animable"></path>
                    <path d="M255.51,316.84l-.69-.15c.1-2.2.36-4.21-.12-5.28l1.18-2.64Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 255.29px 312.805px;" id="elicobja7x57n"
                      class="animable"></path>
                    <path d="M257.9,306.93c-.26,1.5-1.22,3-1.48,6a25.06,25.06,0,0,0-.17,3.81l-.74.14.37-8.07Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 256.705px 311.905px;" id="elmnbrekxc6h"
                      class="animable"></path>
                    <path
                      d="M240,317.81a2,2,0,0,0,.41,1.13c.36.31,1.5,1.37,5.39,1.4s5.31-.84,6.72-2,2-4.27,2.26-5.75a11.08,11.08,0,0,1,3.1-5.7,2.58,2.58,0,0,0,.21-1.49,4.89,4.89,0,0,0-4.81,3.06c-1.62,3.45-3,7.5-6.18,8.28A49.92,49.92,0,0,1,240,317.81Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 249.061px 312.867px;" id="eltujgohi2v4"
                      class="animable"></path>
                    <path
                      d="M242.21,314.57c-1.25.94-2.18,1.34-2.14,2.29s1,1.45,1.8,1.75a13.36,13.36,0,0,0,6,.39c2-.22,4.12-1,5-2.74a7.77,7.77,0,0,0,.57-1.64,24.26,24.26,0,0,1,1.82-5.43,12.53,12.53,0,0,1,1.2-2.07,5.38,5.38,0,0,0,1.37-2.33,5.55,5.55,0,0,0-1.06-3l0,0a4.57,4.57,0,0,1-.69-3.54l.56-5.46-8.74,1.48s.47,4.81.47,6.05a21.28,21.28,0,0,1-.8,5.43,27.62,27.62,0,0,1-2.62,6.06,5.92,5.92,0,0,1-1,1.34A16.69,16.69,0,0,1,242.21,314.57Z"
                      style="fill: rgb(255, 168, 167); transform-origin: 248.949px 305.983px;" id="elxj5pgj439q9"
                      class="animable"></path>
                    <path
                      d="M257.92,303.21c-.48-1-1.2-1.65-1.67-2.52a9.35,9.35,0,0,0-1.16,2.29c-.29.76-1.17,4.52-2.3,7.48a5.75,5.75,0,0,1-3.78,3.86,6.58,6.58,0,0,1-3.21.15h0c-2-.41-1.43-1.82-1.43-1.82a26.09,26.09,0,0,1-4,2.9,1.64,1.64,0,0,0-.31,2.27c.53.52,2.36,1.82,7.22,1.44,4.31-.33,5.44-2.24,5.9-3.1a20.35,20.35,0,0,0,1.15-3.95,12.76,12.76,0,0,1,1.78-4.15c.11-.16.21-.31.31-.43h0c.32-.4.69-.84,1.11-1.28s.56-.5.67-.84A3.23,3.23,0,0,0,257.92,303.21Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 249.017px 310.009px;" id="el31eqyq05rpv"
                      class="animable"></path>
                    <path d="M234.49,309.51l-.68-.2c.26-2.19.67-4.17.27-5.28l1.37-2.54Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 234.63px 305.5px;" id="elswxl04rfpyf"
                      class="animable"></path>
                    <path d="M237.61,299.81c-.37,1.47-1.44,2.89-1.92,5.83a24.6,24.6,0,0,0-.45,3.78l-.75.09,1-8Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 236.05px 304.66px;" id="elvddiugey9x"
                      class="animable"></path>
                    <path
                      d="M219,309.33a2,2,0,0,0,.33,1.16c.33.34,1.4,1.43,5.27,1.74s5.36-.39,6.84-1.4,2.27-4.11,2.68-5.57a11,11,0,0,1,3.52-5.45,2.61,2.61,0,0,0,.32-1.48,4.89,4.89,0,0,0-5,2.7c-1.87,3.32-3.52,7.26-6.77,7.8A50.21,50.21,0,0,1,219,309.33Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 228.484px 305.298px;" id="elh4gfrxnys5q"
                      class="animable"></path>
                    <path
                      d="M221.39,306.26c-1.32.85-2.27,1.17-2.3,2.13s.91,1.52,1.67,1.87a13.25,13.25,0,0,0,5.91.83c2-.07,4.18-.66,5.24-2.35a7.5,7.5,0,0,0,.69-1.59,24.1,24.1,0,0,1,2.22-5.29,12.05,12.05,0,0,1,1.35-2,5.42,5.42,0,0,0,1.53-2.23,5.53,5.53,0,0,0-.83-3.11v0c-.67-1.4-.87-1.95-.52-4.24l1-4.76-8.36.79s-.31,3.29-.39,5.76a17.65,17.65,0,0,1-1.2,5.71,27.81,27.81,0,0,1-3,5.85,6,6,0,0,1-1.08,1.27A16.68,16.68,0,0,1,221.39,306.26Z"
                      style="fill: rgb(255, 168, 167); transform-origin: 228.396px 298.33px;" id="elsavkepa47me"
                      class="animable"></path>
                    <path
                      d="M237.82,295.85a24.32,24.32,0,0,0-1.4-2.33,8.6,8.6,0,0,0-1.33,2c-.49.93-1.49,4.58-2.84,7.46a5.8,5.8,0,0,1-4.05,3.57,6.5,6.5,0,0,1-3.22-.1h0c-2-.56-1.28-1.93-1.28-1.93a25.53,25.53,0,0,1-4.23,2.6,1.63,1.63,0,0,0-.48,2.24c.49.56,2.22,2,7.09,2,4.32,0,5.59-1.83,6.12-2.66a20.91,20.91,0,0,0,1.44-3.85,13,13,0,0,1,2.08-4l.34-.4h0c.35-.37.75-.79,1.2-1.2s.6-.45.74-.78A3.63,3.63,0,0,0,237.82,295.85Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 228.449px 302.44px;" id="elo6mifta7oif"
                      class="animable"></path>
                    <path
                      d="M229.32,249.54c3.05-3.63,9.52-6.66,14.94-9.12s9.49-4.93,15.5-7.37c8.19,3,20.92,0,29.34-3.57,2.09,2.81,4.47,13.68,3.7,18.51-.75,4.66-2.4,10.18-13.36,14.62-6.53,2.65-20.07,8-20.07,8S260,274,259,281.05s-2.42,14.7-2.42,14.7a9.92,9.92,0,0,1-8.5.32s-2.53-20.58-3.16-27.18c-.33-3.45.25-5.77,1.15-6.78a31.78,31.78,0,0,1,6.64-5.46l-11.42,3.28s1.54,4.78-.29,12.46c-1.65,6.89-4.2,15.78-4.2,15.78s-2.71,2-8.26-.3c0,0-.31-21.15-.47-27.78C227.91,254.17,227.94,251.19,229.32,249.54Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 260.476px 263.177px;" id="elshveh7h6o0i"
                      class="animable"></path>
                    <g id="elve7alj0dyc">
                      <path
                        d="M229.32,249.54c3.05-3.63,9.52-6.66,14.94-9.12s9.49-4.93,15.5-7.37c8.19,3,20.92,0,29.34-3.57,2.09,2.81,4.47,13.68,3.7,18.51-.75,4.66-2.4,10.18-13.36,14.62-6.53,2.65-20.07,8-20.07,8S260,274,259,281.05s-2.42,14.7-2.42,14.7a9.92,9.92,0,0,1-8.5.32s-2.53-20.58-3.16-27.18c-.33-3.45.25-5.77,1.15-6.78a31.78,31.78,0,0,1,6.64-5.46l-11.42,3.28s1.54,4.78-.29,12.46c-1.65,6.89-4.2,15.78-4.2,15.78s-2.71,2-8.26-.3c0,0-.31-21.15-.47-27.78C227.91,254.17,227.94,251.19,229.32,249.54Z"
                        style="opacity: 0.5; transform-origin: 260.476px 263.177px;" class="animable"></path>
                    </g>
                    <path
                      d="M281.31,193s9.21,1.49,10.3,2c-9,5.71-2.56,19.62-2.56,19.62l-1.87,9.83c1.21,3.73,4.2,9.37,5.75,15-12.39,6.69-32.6,3.16-33.88-6.18.81-3.62,1.32-8.78,1.83-11.44,0-2,.25-4.23.17-7.46a9.29,9.29,0,0,1-1.47-10.87c3.76-6.68,9.91-11.38,11.8-11.3Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 275.693px 217.554px;" id="el3b29ft6tsny"
                      class="animable"></path>
                    <path
                      d="M268.57,165.51c-3.07,1.21-4.68,4.82-5.08,13.59-.33,7.44,1.95,9.43,3.12,10s3.53.45,5.82.23l-.17,3.07s-4.27,4.31-4.21,6.37,5.1,3.32,8.17,1.52,5.86-6.53,5.86-6.53l.58-9.23s1.24,1.39,3.64-.43c2-1.51,2.79-4.21,1.43-5.79a3.26,3.26,0,0,0-5.24.68,12.89,12.89,0,0,0-4.41-8.55C274,167,271.9,165.56,268.57,165.51Z"
                      style="fill: rgb(255, 168, 167); transform-origin: 275.933px 183.332px;" id="el9mdd7l67lao"
                      class="animable"></path>
                    <path
                      d="M283.94,193.47s4,.36,5.3.57c1.87.29,5.95,6.69,3.78,13.92-2.34,7.78-4.49,15.19-4.31,16.88s4,11.89,4,11.89c-1.07,1.53-3.33,2.4-5.28,2.67L285,231l.5,9a42.55,42.55,0,0,1-9.76.4S276.78,211.57,283.94,193.47Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 284.69px 216.993px;" id="eldjleyzce7rw"
                      class="animable"></path>
                    <path
                      d="M290.49,194.65c5.26.38,7.81,2.19,9.32,8.29,1.36,5.49,4.22,18.91,4.76,22.47.49,3.25.67,4.48-1,7.33-1.39,2.33-11.47,15.28-12.69,17.22a51.23,51.23,0,0,1-4.62,6.13,12.18,12.18,0,0,1-6.77,3.84c-2.82.35-6-1.32-5.87-2.95s4.94-3.53,7.18-6.56a15.37,15.37,0,0,1-2.5.82c-1.17.25-2.35-.07-2.6-.75s.9-.85,2-1.63c.68-.47,1.93-1.56,3.44-2.46,1-.6,2.45-.92,3.25-1.64a46.33,46.33,0,0,0,4.61-6.87c2.26-4,5.8-9.87,5.8-9.87L290.64,210S288.21,198.31,290.49,194.65Z"
                      style="fill: rgb(255, 168, 167); transform-origin: 289.263px 227.313px;" id="elskbai2q6379"
                      class="animable"></path>
                    <path
                      d="M289.24,194a16.44,16.44,0,0,1,6,1.11,8.61,8.61,0,0,1,4,4.5c.71,1.72,5.65,25.55,5.65,25.55s-1.3,1.47-4.87,2.11a12.74,12.74,0,0,1-5.89,0l-4.38-18.7S286.49,199.94,289.24,194Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 296.514px 210.807px;" id="elptppt8yrcl"
                      class="animable"></path>
                    <path
                      d="M269.16,161.66c3.91-2.06,6-2.43,9.57-2.18,3.35.22,7.46,1.65,9.67,4.16a16.47,16.47,0,0,1,3.89,7,15.86,15.86,0,0,1-.59,8.68c-1.77,5.59-9.31,9.61-9.46,12l.42-6.74s1.24,1.38,3.64-.44c2-1.5,2.79-4.21,1.43-5.79a3.26,3.26,0,0,0-5.24.68l-.11,1.91a2,2,0,0,1-1.89-2.12l.18-3.11c-3.39-.43-10-2.45-9.61-9.83,0,0-.89,4.34,1.26,7.59,0,0-4.93-.82-4.71-5.48,0,0-.66,5.44-3.68,5.84a4.42,4.42,0,0,1-1.54-1.86C260.81,168.17,262.35,161.27,269.16,161.66Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 277.23px 175.366px;" id="el91oj3sk0mn"
                      class="animable"></path>
                    <path d="M299.26,192.88h0a7.73,7.73,0,0,1-7.74-7.73V170.39h0a7.75,7.75,0,0,1,7.74,7.74Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 295.39px 181.635px;" id="elpo38f3o03k"
                      class="animable"></path>
                    <path d="M273.31,176.83a1.06,1.06,0,0,0,.91,1.2,1.09,1.09,0,1,0-.91-1.2Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 274.391px 176.954px;" id="elhai46yra0w"
                      class="animable"></path>
                    <path d="M274,182.82l-3.81.94a1.94,1.94,0,0,0,2.33,1.5A2.07,2.07,0,0,0,274,182.82Z"
                      style="fill: rgb(177, 102, 104); transform-origin: 272.119px 184.064px;" id="ell1t4w0gpd8"
                      class="animable"></path>
                    <path
                      d="M272.46,184.11a1.58,1.58,0,0,0-1.41.88,1.82,1.82,0,0,0,1.48.27,2,2,0,0,0,1.05-.68A1.55,1.55,0,0,0,272.46,184.11Z"
                      style="fill: rgb(242, 143, 143); transform-origin: 272.315px 184.712px;" id="eluwnh8ibhzn"
                      class="animable"></path>
                    <path d="M273.78,174.05l2.35,1.34a1.34,1.34,0,0,0-.46-1.86A1.43,1.43,0,0,0,273.78,174.05Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 275.055px 174.377px;" id="el81uv6oyvg9"
                      class="animable"></path>
                    <path d="M264.8,173.47l2.51-1a1.34,1.34,0,0,0-1.73-.8A1.42,1.42,0,0,0,264.8,173.47Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 266.011px 172.528px;" id="elhap24rq6r1j"
                      class="animable"></path>
                    <polygon points="269.8 175.88 268.8 181.64 266.01 180.45 269.8 175.88"
                      style="fill: rgb(242, 143, 143); transform-origin: 267.905px 178.76px;" id="elznxbi0ehz3l"
                      class="animable"></polygon>
                    <path
                      d="M272.43,189.37c2.4-.15,7.41-1.23,8.31-3.12a5.07,5.07,0,0,1-1.89,2.36c-1.56,1.16-6.5,2.21-6.5,2.21Z"
                      style="fill: rgb(242, 143, 143); transform-origin: 276.545px 188.535px;" id="elp6ju68k0ko"
                      class="animable"></path>
                    <path
                      d="M264.72,175.61a1.05,1.05,0,1,0,2.09.24,1.06,1.06,0,0,0-.91-1.2A1.08,1.08,0,0,0,264.72,175.61Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 265.767px 175.713px;" id="elsp7qzctp1b"
                      class="animable"></path>
                    <g id="eljzgq90fmh7o">
                      <path
                        d="M252.69,256.65s8.64-5.5,12.24-8.14a20.3,20.3,0,0,1-4.32-5.08,10.12,10.12,0,0,0,1.75,5l-9,6.73-12.14,4.81Z"
                        style="opacity: 0.2; transform-origin: 253.075px 251.7px;" class="animable"></path>
                    </g>
                  </g>
                </g>
              </g>
              <g id="freepik--character-2--inject-85" class="animable" style="transform-origin: 147.966px 164.605px;">
                <g id="freepik--character--inject-85" class="animable" style="transform-origin: 147.966px 164.605px;">
                  <path
                    d="M103,93.55c.41.42.83.84,1.26,1.25.58.55,1.76,1.43,2.34,2,.17.17.86.61.92.81a12.88,12.88,0,0,1-.68-2.94,1.82,1.82,0,0,1,1.42-2c.39,0,.42.94,1.23,2.31,1,1.75,2.4,2.66,3,4.78a3.9,3.9,0,0,0,2,2.15l16.26,8.07s11.9-4.41,18.06-6.82c7.16-2.81,15.36-5.48,16.73-4l-13.68,12.36s-10.41,5.64-18.51,8.87c-2.73,1.09-4.24.7-6.45-.79a147.59,147.59,0,0,1-13.86-9.16,94.68,94.68,0,0,0-8.85-5.72c-2.37-1.32-5.12-3.1-6.23-5.7a5.48,5.48,0,0,1,0-4.5,5.65,5.65,0,0,0,.79-1.78,10.84,10.84,0,0,0-.06-1.13,1.2,1.2,0,0,1,.4-1,1,1,0,0,1,1.08,0,3.32,3.32,0,0,1,.82.77Q102,92.47,103,93.55Z"
                    style="fill: rgb(255, 189, 167); transform-origin: 131.508px 105.732px;" id="elnqp6x7h7e1i"
                    class="animable"></path>
                  <path
                    d="M165.35,98.45c-6.14-.91-9.22,1-13.43,2.72-5,2.07-21.11,8.32-21.11,8.32l-10.39-4.9s-2.39,5.4-5,7.59c0,0,9.34,6.62,11.93,8.23s2.75,1.53,6.83.19,22.51-6,22.51-6Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 140.385px 109.913px;" id="elv3qtykmdols"
                    class="animable"></path>
                  <g id="freepik--Botom--inject-85" class="animable" style="transform-origin: 168.887px 204.103px;">
                    <path d="M192.71,247.71a8,8,0,0,1-7.1.21L183.89,234l8.44.86Z"
                      style="fill: rgb(255, 189, 167); transform-origin: 188.3px 241.325px;" id="elviq0z25cui"
                      class="animable"></path>
                    <path d="M166.68,240.12c-1.7,4-5,3-8.8.59l.23-14.06,8.93-.27Z"
                      style="fill: rgb(255, 189, 167); transform-origin: 162.46px 234.601px;" id="elfe1j4ev20tv"
                      class="animable"></path>
                    <path
                      d="M177.37,261.4a3.3,3.3,0,0,0,.16,2.16c.29.43,1.95,1.75,4.87,1.88a11.8,11.8,0,0,0,6.86-1.42,4.82,4.82,0,0,0,2.47-3.85c.11-1.59-.12-3.11.6-4.36s1.74-2.45,2-3.07a6.25,6.25,0,0,0-.08-3.23Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 185.881px 257.503px;" id="elliwzj6rz9v"
                      class="animable"></path>
                    <path
                      d="M184.6,247.33a8,8,0,0,1-.29,1.78,16.5,16.5,0,0,1-1.6,3.53,15.74,15.74,0,0,1-1.11,1.68c-.82,1-1.84,1.88-2.7,2.86a5.72,5.72,0,0,0-1.62,3.47c-.05,2.19,2.34,2.86,4.17,3.13a13.47,13.47,0,0,0,5.92-.47,5.46,5.46,0,0,0,3.87-4.47c.08-.61,0-1.23.08-1.84a8.52,8.52,0,0,1,1.58-3.87,11.62,11.62,0,0,0,1.24-2.12c.53-1.37,0-2.88-.37-4.21-.35-1.15-.75-2.46-1.15-2.34a1.49,1.49,0,0,1-.08.7,3.14,3.14,0,0,0-.3.7,4.88,4.88,0,0,1-.31.91,2.38,2.38,0,0,1-.93,1.1c-.05-.83-.11-1.65-.16-2.47a1.11,1.11,0,0,0-.21-.72,1.16,1.16,0,0,0-.71-.28,15.05,15.05,0,0,0-4.68-.25.83.83,0,0,0-.62.29.89.89,0,0,0-.08.56C184.58,245.8,184.63,246.57,184.6,247.33Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 185.822px 253.994px;" id="elre0mqdcwohp"
                      class="animable"></path>
                    <path
                      d="M182.43,253.11c.79-.63,2.61-.7,3.61-.62a6.12,6.12,0,0,1,2.86.91.64.64,0,0,0,.83-.09h0a.61.61,0,0,0-.08-.93,6.27,6.27,0,0,0-3.23-1.08c-2.45-.1-3.16.34-3.16.34S182.17,252.39,182.43,253.11Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 186.149px 252.399px;" id="elznvm7lqmfv"
                      class="animable"></path>
                    <path
                      d="M180.62,255.4c1-.63,3-.6,4-.53a5.67,5.67,0,0,1,2.79,1,.65.65,0,0,0,.83-.09h0a.62.62,0,0,0-.09-.93,6.36,6.36,0,0,0-3.29-1.18c-2.46-.1-3.08.42-3.08.42A2,2,0,0,0,180.62,255.4Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 184.515px 254.818px;" id="el5v5p9v97m2p"
                      class="animable"></path>
                    <path
                      d="M187.33,248.92a6.16,6.16,0,0,0-3.07.35c-.43.26-.69.95-.41,1.11a5.78,5.78,0,0,1,2.72-.45,8,8,0,0,1,2.67.65,7.09,7.09,0,0,1,.69.32.58.58,0,0,0,.8-.27h0a.56.56,0,0,0-.23-.7A8,8,0,0,0,187.33,248.92Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 187.254px 249.914px;" id="elmirht1wszw"
                      class="animable"></path>
                    <path
                      d="M143.51,249.8a2.66,2.66,0,0,0,.17,1.94c.29.56,3.31,2.15,7.3,1.76a16.77,16.77,0,0,0,8.2-3.14,9.63,9.63,0,0,1,5.06-1.47c2-.17,4.56-1.24,5-2.18a4.45,4.45,0,0,0-.14-2.52Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 156.38px 248.875px;" id="elgwo4hyzjuic"
                      class="animable"></path>
                    <path
                      d="M159.24,237l-1.05-.36a.93.93,0,0,0-.59-.05.87.87,0,0,0-.41.68,9.89,9.89,0,0,1-.38,1.75,4.53,4.53,0,0,1-1.09,1.22,18.31,18.31,0,0,1-3.15,2.16c-1.28.74-2.55,1.33-3.88,2s-3.18,1.1-4.24,1.86a2.89,2.89,0,0,0,.16,4.77,14.19,14.19,0,0,0,9.9.39c2.3-.73,4.8-3.29,7.84-3.62,1.94-.21,5.59-.86,6.79-2.37.44-.67-.23-2.72-.79-4.49-.61-1.93-.91-5-1.55-4.79,0,.65-.58,1.05-.9,1.6a10.8,10.8,0,0,0-.65,1.57,2.82,2.82,0,0,1-1,1.36,1.27,1.27,0,0,1-1.57,0c-.59-.57-.28-1.62-.72-2.31a2.46,2.46,0,0,0-1.39-.86Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 156.276px 244.134px;" id="elpljcq1vrhoc"
                      class="animable"></path>
                    <path
                      d="M154.35,241.3a1.82,1.82,0,0,1,1.41-1,5.2,5.2,0,0,1,3.44,1.18.72.72,0,0,1-.07,1.2h0a.69.69,0,0,1-.82-.07A5.59,5.59,0,0,0,154.35,241.3Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 156.92px 241.541px;" id="el6iyxu6kqmyy"
                      class="animable"></path>
                    <path
                      d="M151.67,242.91a2.07,2.07,0,0,1,1.67-.92,6.49,6.49,0,0,1,3.77,1.28.71.71,0,0,1-.07,1.16h0a.68.68,0,0,1-.79-.07A5.58,5.58,0,0,0,151.67,242.91Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 154.524px 243.257px;" id="elj9xhcmrh85"
                      class="animable"></path>
                    <path
                      d="M148.69,244.38a2.33,2.33,0,0,1,1.74-.84,6.24,6.24,0,0,1,3.61,1.3A.71.71,0,0,1,154,246h0a.69.69,0,0,1-.8-.07A5.31,5.31,0,0,0,148.69,244.38Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 151.506px 244.818px;" id="el6cq41iy4yjn"
                      class="animable"></path>
                    <path
                      d="M189.43,145.75c1,15.28,2.51,49,2.51,49,.22,1.9.92,6.46,1.26,13.3.51,9.93-.28,31.85-.28,31.85a10.7,10.7,0,0,1-8.48.67s-5.64-31.26-7.45-41c-1.59-8.56-4.68-24.7-4.68-24.7l-1.45,20.87a69,69,0,0,1-.34,12.62c-.57,4.53-3.29,24.19-3.29,24.19a18.09,18.09,0,0,1-9.59.08s-.87-32.09-1.08-36.27c-.23-4.75-1.23-53.65-1.23-53.65Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 174.351px 191.929px;" id="elzkgdy3gvzhs"
                      class="animable"></path>
                    <path d="M172.31,174.84l-2.64-12.46s-6.28-.37-9.85-3.76c0,0,.72,3.41,8.66,5.23l2.64,12.61.26,11.73Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 166.065px 173.405px;" id="elivxmchug60g"
                      class="animable"></path>
                  </g>
                  <path
                    d="M186.55,100.3c3,.53,3.2,2,3.85,5a24.23,24.23,0,0,1,.77,7.32l-2.24,17.61.77,20.27c-4.83,5.26-24.15,6.94-34.7-.76,0,0,.11-33.31.6-38.65.85-9.34,5.08-12.66,11.3-12.64l10.63.9Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 173.099px 126.718px;" id="elfwce0qzf5jo"
                    class="animable"></path>
                  <path d="M175.31,76.69a9.44,9.44,0,1,1-9.4-9.47A9.42,9.42,0,0,1,175.31,76.69Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 165.87px 76.6599px;" id="elao9m8p4dsld"
                    class="animable"></path>
                  <path
                    d="M178.27,78.53l2-5.41a3.57,3.57,0,0,1,2.93,1c1.25,1.29.54,5.32-1,9.26,0,0-1.56,7.18-2.18,8.36a3.22,3.22,0,0,1-1.88,1.51Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 180.99px 83.1722px;" id="elxfwlr1jqq1g"
                    class="animable"></path>
                  <path
                    d="M178.42,83.74c.58.35,1.4-.76,2.12-1.5a2.51,2.51,0,0,1,4.19.69c1.18,2.5-1,5.78-2.87,6.35-3.16,1-3.63-1-3.63-1L178,99.61a10.15,10.15,0,0,1-7.68,5.79c-5.59.74-4.42-3.87-2.58-6.12l0-3.47a19.76,19.76,0,0,1-4.25.21c-2.32-.37-3.77-2.21-4.47-4.72-1.11-4-1.53-7.3-.55-15.22,1.08-8.7,11.2-8.75,16.65-5.29S178.42,83.74,178.42,83.74Z"
                    style="fill: rgb(255, 189, 167); transform-origin: 171.492px 87.0637px;" id="el2cskhk8pafg"
                    class="animable"></path>
                  <path
                    d="M178.36,84.5c.91-.26,1.58-1.72,2.18-2.26,1-.9-.26-9.12-.26-9.12a3.87,3.87,0,0,0-.94-4.15c-1.36-1.51-3.64-1.68-7.54-2.31-1.92-.31-4.18-.46-6.08-.81A19,19,0,0,1,160.06,64a1.71,1.71,0,0,0-1.08-.28,1,1,0,0,0-.68.57,1.81,1.81,0,0,0-.16.89,3.32,3.32,0,0,0,.16,1c.06.19.43.74.35.9-.19.39-1.69-.27-2-.36a.33.33,0,0,0-.22,0c-.06,0-.09.08-.12.14a3.63,3.63,0,0,0,.17,3.15,10.69,10.69,0,0,0,5.36,4.56,14.83,14.83,0,0,0,7.3,1,13.88,13.88,0,0,0,3.12-.73,8.81,8.81,0,0,0,.68,1.07,5.33,5.33,0,0,0,1,.89,4.29,4.29,0,0,0,1.21.56c.45.12.87.06,1.12.54a2.25,2.25,0,0,1,.18,1l.09,3a5.1,5.1,0,0,0,.2,1.51,1.67,1.67,0,0,0,1,1.07A1,1,0,0,0,178.36,84.5Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 168.478px 74.1273px;" id="elxwnh2kn6rx"
                    class="animable"></path>
                  <path
                    d="M167.71,95.81s5.18-1,7-2a6,6,0,0,0,2.51-2.47,8.08,8.08,0,0,1-1.43,2.92c-1.33,1.69-8.08,2.91-8.08,2.91Z"
                    style="fill: rgb(240, 153, 122); transform-origin: 172.465px 94.255px;" id="el9ld85uw957i"
                    class="animable"></path>
                  <path d="M168.48,82.17a1,1,0,1,0,1-1.07A1.05,1.05,0,0,0,168.48,82.17Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 169.479px 82.1px;" id="el4cyprsp233j"
                    class="animable"></path>
                  <path d="M169.72,79l2.3,1.49a1.44,1.44,0,0,0-.43-2A1.33,1.33,0,0,0,169.72,79Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 170.987px 79.3919px;" id="elk5fxd60rrxb"
                    class="animable"></path>
                  <path d="M170.21,88.48l-3.65,1.57a2,2,0,0,0,2.68,1.06A1.94,1.94,0,0,0,170.21,88.48Z"
                    style="fill: rgb(240, 153, 122); transform-origin: 168.483px 89.8852px;" id="el4215khi57nc"
                    class="animable"></path>
                  <path d="M159,80.11l2.19-1.33a1.23,1.23,0,0,0-1.72-.46A1.34,1.34,0,0,0,159,80.11Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 160.011px 79.125px;" id="elsappcqtzjaf"
                    class="animable"></path>
                  <path d="M159.82,81.85a1,1,0,1,0,2.07,0,1,1,0,0,0-1-1.08A1.06,1.06,0,0,0,159.82,81.85Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 160.857px 81.8275px;" id="el7qq6efal8wk"
                    class="animable"></path>
                  <polygon points="165.6 81.29 164.72 87.91 161.34 86.46 165.6 81.29"
                    style="fill: rgb(240, 153, 122); transform-origin: 163.47px 84.6px;" id="elrwz2udre4h"
                    class="animable"></polygon>
                  <path
                    d="M159.15,149.92v2.26a.69.69,0,0,1-.91.67,13.23,13.23,0,0,1-2.51-1,5.91,5.91,0,0,1-1.85-1.49l-.11-3.44Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 156.46px 149.903px;" id="elbe6ip5ls21b"
                    class="animable"></path>
                  <path
                    d="M153.77,146.9c1.27,2.06,5.38,3,5.38,3s-.09-1.48,0-9.61.4-23.2,2.17-30A36.39,36.39,0,0,1,166,99.87a2.11,2.11,0,0,1,1.64-1v-.4c-6.14-.1-7.4.52-10,3.78s-3.11,9.4-3.42,16.35C154,125.34,152,141.82,153.77,146.9Zm19.35-17.75c-.49,18.66.71,27.95.93,29.47,0,0,13.84-.52,17.19-5.06-.4-5.88-.92-16.42-1.28-23.08l2-22.78a7.37,7.37,0,0,0-4.25-7.33l-9.64-1.26c-.81,1.88-2.62,4.33-3.5,8C173.47,111.86,173.39,118.65,173.12,129.15Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 172.516px 128.54px;" id="ely040sr82lw"
                    class="animable"></path>
                  <path
                    d="M167.7,97.92a8,8,0,0,0-4.82,2.88,27.93,27.93,0,0,0-3.59,6.63,2.57,2.57,0,0,0,.53,2.49s-1.82,4.62-1.52,6.85a23.93,23.93,0,0,0,1.49,5s2.34-13.81,4.53-18c2.31-4.49,3.37-4.47,3.37-4.47Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 162.983px 109.845px;" id="elunnzctisdmj"
                    class="animable"></path>
                  <path
                    d="M178,98c1.35.32,4.86,1.73,4.86,1.73s-3.16,7.33-4.27,9.22a4.83,4.83,0,0,1-2.74,2.28,30,30,0,0,1,.27,6.48,34.88,34.88,0,0,1-2.88,7.19c0-.21-1.32-8.75.76-16.78a26.7,26.7,0,0,1,4-9Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 177.844px 111.45px;" id="el1a1cpzaitgn"
                    class="animable"></path>
                  <polygon points="128.34 127.09 154.23 128.87 159.12 158.62 134.56 156.28 128.34 127.09"
                    style="fill: rgb(38, 50, 56); transform-origin: 143.73px 142.855px;" id="elivc89ylguka"
                    class="animable"></polygon>
                  <g id="ely4qdrsasfre">
                    <polygon points="128.34 127.09 154.23 128.87 159.12 158.62 134.56 156.28 128.34 127.09"
                      style="opacity: 0.1; transform-origin: 143.73px 142.855px;" class="animable"></polygon>
                  </g>
                  <g id="elnhag5dcnl4g">
                    <path
                      d="M148.42,146.35c-.16.59.24,1.44,1.42,2.44.94.81,1.56,2.22,3.18,2.61a10.9,10.9,0,0,0,5,.34l-.66-4.07Z"
                      style="opacity: 0.15; transform-origin: 153.203px 149.118px;" class="animable"></path>
                  </g>
                  <g id="el2hswisl619i">
                    <path d="M135.67,130.19s0-.41-.13-.92,1.49-.81,3.48-.68l3.82.24c2,.13,3.67.65,3.74,1.15l.13.92Z"
                      style="opacity: 0.15; transform-origin: 141.121px 129.73px;" class="animable"></path>
                  </g>
                  <path
                    d="M134.18,126.91c-.05-.32.59-.52,1.42-.45l1.51.12s-.27-2,3.1-1.89S144.1,127,144.1,127l1.61.15c.89.08,1.67.39,1.75.7l.14.56-13.34-.91S134.22,127.23,134.18,126.91Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 140.889px 126.548px;" id="elmw1hca5klt"
                    class="animable"></path>
                  <path
                    d="M136,127.6c1.22.06,1.73.12,1.84.9s.15,1.56.15,1.56l5.9.41s-.18-1.12-.23-1.57.18-.75,1.12-.69l.12-.38-9.26-.55Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 140.27px 128.875px;" id="elnyl434g5rqd"
                    class="animable"></path>
                  <path d="M135.5,130.31s-.06-.41-.13-.92,1.49-.81,3.48-.68l3.82.24c2,.13,3.66.65,3.73,1.15l.13.92Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 140.949px 129.85px;" id="elt6lhucrx2a"
                    class="animable"></path>
                  <path
                    d="M155.87,138.9c1.84.09,4.67.73,6.25,1a8,8,0,0,0,2.49.14,12,12,0,0,0,2-.39c2.26-1,20.33-8.43,20.33-8.43l-3.07-17.78s-.72-11.42,4.26-12.62c3.84,1.74,5.06,5.12,6.82,12.64,2,8.6,3.57,18.64,2.77,21.36-.54,1.88-.65,3.89-4.84,5.51-4.43,1.72-9.37,2.88-24,7.06a72.36,72.36,0,0,1-8.38,2.39c-7.44,1.17-10.41-.18-11.89-3.06-.43-.83-.49-1.76-.88-2.61a6,6,0,0,1-.61-1.43,1.09,1.09,0,0,1,.62-1.27,1.71,1.71,0,0,1,.71,0c1.18.23,2.35.46,3.53.62a23.33,23.33,0,0,0,4.09.15.78.78,0,0,0,.21,0c.2-.09.15-.17,0-.24"
                    style="fill: rgb(255, 189, 167); transform-origin: 172.509px 125.51px;" id="eltn1ra14eo"
                    class="animable"></path>
                  <path
                    d="M187.72,100.37c3.46.43,5.73,3.33,6.46,6.75,1.15,5.37,1.69,8.44,3,15.24,1.2,6.18,1.67,13.22.9,15.15s-4.71,3.2-7.19,3.93c-3.7,1.1-14.7,3.83-14.7,3.83.08-2.58-1.39-7-3.65-8.53l13.88-6.17-3.56-15.77S181.33,103.32,187.72,100.37Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 185.498px 122.82px;" id="elyx80p3jtcpb"
                    class="animable"></path>
                </g>
              </g>
              <g id="freepik--Table--inject-85" class="animable" style="transform-origin: 234.89px 348.515px;">
                <g id="freepik--table--inject-85" class="animable" style="transform-origin: 234.89px 348.515px;">
                  <g id="freepik--table--inject-85" class="animable" style="transform-origin: 234.89px 348.515px;">
                    <polygon points="102.37 369.49 100.48 368.4 100.48 291.77 102.37 292.86 102.37 369.49"
                      style="fill: rgb(55, 71, 79); transform-origin: 101.425px 330.63px;" id="elk9ucz8b00lj"
                      class="animable"></polygon>
                    <polygon points="102.37 369.49 104.26 368.4 104.26 291.77 102.37 292.86 102.37 369.49"
                      style="fill: rgb(69, 90, 100); transform-origin: 103.315px 330.63px;" id="elbsj5lhzyihg"
                      class="animable"></polygon>
                    <polygon points="152.51 321.91 150.62 320.82 150.62 264.96 152.51 266.05 152.51 321.91"
                      style="fill: rgb(55, 71, 79); transform-origin: 151.565px 293.435px;" id="elela85flbfos"
                      class="animable"></polygon>
                    <polygon points="152.51 321.91 154.4 320.78 154.4 264.93 152.51 266.05 152.51 321.91"
                      style="fill: rgb(69, 90, 100); transform-origin: 153.455px 293.42px;" id="elecjcwgz27mt"
                      class="animable"></polygon>
                    <polygon points="154.4 264.96 102.37 295.03 102.37 292.85 154.4 262.78 154.4 264.96"
                      style="fill: rgb(69, 90, 100); transform-origin: 128.385px 278.905px;" id="el55579d4yayj"
                      class="animable"></polygon>
                    <polygon points="203.59 311.89 201.71 310.84 201.03 235.85 202.92 236.9 203.59 311.89"
                      style="fill: rgb(55, 71, 79); transform-origin: 202.31px 273.87px;" id="elaodp9mlu35i"
                      class="animable"></polygon>
                    <polygon points="203.59 311.89 205.48 310.84 204.81 235.86 202.92 236.9 203.59 311.89"
                      style="fill: rgb(69, 90, 100); transform-origin: 204.2px 273.875px;" id="eldw5t3zj8blm"
                      class="animable"></polygon>
                    <polygon points="204.81 235.85 152.5 266.1 152.5 263.92 204.81 233.71 204.81 235.85"
                      style="fill: rgb(69, 90, 100); transform-origin: 178.655px 249.905px;" id="eloysviuvpvxl"
                      class="animable"></polygon>
                    <polygon points="203.03 257.42 152.61 286.57 152.6 284.47 203.03 255.32 203.03 257.42"
                      style="fill: rgb(69, 90, 100); transform-origin: 177.815px 270.945px;" id="ellebi21m7z6h"
                      class="animable"></polygon>
                    <polyline points="152.51 282.42 104.26 310.21 104.26 312.38 152.51 284.52"
                      style="fill: rgb(55, 71, 79); transform-origin: 128.385px 297.4px;" id="ela3yg3bj9w4"
                      class="animable"></polyline>
                    <polyline points="154.4 283.44 202.92 255.38 202.92 253.24 154.4 281.26"
                      style="fill: rgb(55, 71, 79); transform-origin: 178.66px 268.34px;" id="elzwmfw14be3"
                      class="animable"></polyline>
                    <polygon points="152.61 286.57 102.37 315.58 102.37 313.47 152.6 284.47 152.61 286.57"
                      style="fill: rgb(69, 90, 100); transform-origin: 127.49px 300.025px;" id="elofabp0p5or"
                      class="animable"></polygon>
                    <polygon points="152.79 328.4 266.86 394.11 266.86 387.78 152.79 321.91 152.79 328.4"
                      style="fill: rgb(55, 71, 79); transform-origin: 209.825px 358.01px;" id="elz56ja9xqmld"
                      class="animable"></polygon>
                    <polygon points="102.37 299.19 154.68 329.38 154.68 323.05 102.37 292.86 102.37 299.19"
                      style="fill: rgb(55, 71, 79); transform-origin: 128.525px 311.12px;" id="elmm3kzej50u"
                      class="animable"></polygon>
                    <polygon points="266.86 464.4 264.98 463.31 264.98 386.69 266.86 387.79 266.86 464.4"
                      style="fill: rgb(55, 71, 79); transform-origin: 265.92px 425.545px;" id="el11p0n2b7pbkp"
                      class="animable"></polygon>
                    <polygon points="266.86 464.4 268.75 463.31 268.75 386.7 266.86 387.79 266.86 464.4"
                      style="fill: rgb(69, 90, 100); transform-origin: 267.805px 425.55px;" id="ely68sj8w6f6r"
                      class="animable"></polygon>
                    <polygon points="317 435.68 315.12 434.59 315.12 359.89 317 360.98 317 435.68"
                      style="fill: rgb(55, 71, 79); transform-origin: 316.06px 397.785px;" id="elf7zoqejh28l"
                      class="animable"></polygon>
                    <polygon points="317 435.68 318.89 434.56 318.89 359.85 317 360.98 317 435.68"
                      style="fill: rgb(69, 90, 100); transform-origin: 317.945px 397.765px;" id="elutvhl6ne8rm"
                      class="animable"></polygon>
                    <polygon points="318.89 363.95 266.86 394.11 266.86 387.78 318.89 357.71 318.89 363.95"
                      style="fill: rgb(69, 90, 100); transform-origin: 292.875px 375.91px;" id="elx4dfliysamc"
                      class="animable"></polygon>
                    <polygon points="367.41 406.53 365.53 405.49 365.53 330.78 367.41 331.83 367.41 406.53"
                      style="fill: rgb(55, 71, 79); transform-origin: 366.47px 368.655px;" id="el7rxgzjsxom2"
                      class="animable"></polygon>
                    <polygon points="367.41 406.53 369.3 405.49 369.3 330.79 367.41 331.83 367.41 406.53"
                      style="fill: rgb(69, 90, 100); transform-origin: 368.355px 368.66px;" id="el24rtsbovik8"
                      class="animable"></polygon>
                    <polygon points="369.3 334.85 317 364.91 317 358.84 369.3 328.64 369.3 334.85"
                      style="fill: rgb(69, 90, 100); transform-origin: 343.15px 346.775px;" id="elytkwygtfter"
                      class="animable"></polygon>
                    <polygon points="367.52 352.35 317.1 381.5 317.1 379.4 367.52 350.25 367.52 352.35"
                      style="fill: rgb(69, 90, 100); transform-origin: 342.31px 365.875px;" id="elr1segjehasr"
                      class="animable"></polygon>
                    <polyline points="317.01 377.35 268.75 405.14 268.75 407.31 317 379.45"
                      style="fill: rgb(55, 71, 79); transform-origin: 292.88px 392.33px;" id="eltwcxit24wx"
                      class="animable"></polyline>
                    <polyline points="318.89 378.37 367.42 350.31 367.42 348.17 318.89 376.19"
                      style="fill: rgb(55, 71, 79); transform-origin: 343.155px 363.27px;" id="eloocroh7plpi"
                      class="animable"></polyline>
                    <polygon points="317.1 381.5 266.86 410.51 266.86 408.39 317.1 379.4 317.1 381.5"
                      style="fill: rgb(69, 90, 100); transform-origin: 291.98px 394.955px;" id="elzx0o58pey1k"
                      class="animable"></polygon>
                    <polygon points="266.86 387.79 369.3 328.64 202.92 232.63 100.48 291.77 266.86 387.79"
                      style="fill: rgb(38, 50, 56); transform-origin: 234.89px 310.21px;" id="elus7lety3lw9"
                      class="animable"></polygon>
                    <g id="el3n89vay0wrz">
                      <polygon points="266.86 387.79 369.3 328.64 202.92 232.63 100.48 291.77 266.86 387.79"
                        style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 234.89px 310.21px;"
                        class="animable"></polygon>
                    </g>
                    <polygon points="266.86 464.4 266.86 463.4 264.98 462.31 264.98 463.31 266.86 464.4"
                      style="fill: rgb(38, 50, 56); transform-origin: 265.92px 463.355px;" id="elrpq0ejrm5vr"
                      class="animable"></polygon>
                    <polygon points="266.86 464.4 266.86 463.4 268.75 462.31 268.75 463.31 266.86 464.4"
                      style="fill: rgb(38, 50, 56); transform-origin: 267.805px 463.355px;" id="el0921t7ukyai"
                      class="animable"></polygon>
                    <polygon points="317.01 435.68 317.01 434.67 315.12 433.58 315.12 434.59 317.01 435.68"
                      style="fill: rgb(38, 50, 56); transform-origin: 316.065px 434.63px;" id="elbv2o6ghygf"
                      class="animable"></polygon>
                    <polygon points="317.01 435.68 317.01 434.67 318.89 433.58 318.89 434.59 317.01 435.68"
                      style="fill: rgb(38, 50, 56); transform-origin: 317.95px 434.63px;" id="elnpuca884wve"
                      class="animable"></polygon>
                    <polygon points="367.41 406.53 367.41 405.53 365.53 404.44 365.53 405.44 367.41 406.53"
                      style="fill: rgb(38, 50, 56); transform-origin: 366.47px 405.485px;" id="elze91m4wnkk"
                      class="animable"></polygon>
                    <polygon points="367.41 406.53 367.41 405.53 369.3 404.44 369.3 405.44 367.41 406.53"
                      style="fill: rgb(38, 50, 56); transform-origin: 368.355px 405.485px;" id="el4hcrpswdnq7"
                      class="animable"></polygon>
                    <polygon points="102.37 369.49 102.37 368.49 100.48 367.4 100.48 368.4 102.37 369.49"
                      style="fill: rgb(38, 50, 56); transform-origin: 101.425px 368.445px;" id="elv2brc0urv5"
                      class="animable"></polygon>
                    <polygon points="102.37 369.49 102.37 368.49 104.26 367.4 104.26 368.4 102.37 369.49"
                      style="fill: rgb(38, 50, 56); transform-origin: 103.315px 368.445px;" id="elxvs5fhslm0s"
                      class="animable"></polygon>
                  </g>
                  <g id="freepik--Notebooks--inject-85" class="animable" style="transform-origin: 281.195px 293.24px;">
                    <path
                      d="M283.11,286.16,294.26,292l.23.36v.29a.4.4,0,0,1-.23.36l-14.69,8.49a.83.83,0,0,1-.39.09.79.79,0,0,1-.38-.09l-10.9-6.3v-.29Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 281.195px 293.875px;" id="elzu1hnkmn9op"
                      class="animable"></path>
                    <path
                      d="M279.18,301.33a.83.83,0,0,0,.39-.09l14.69-8.49a.4.4,0,0,0,.23-.36.41.41,0,0,0-.23-.36l-10.66-6.15-15.7,9.06,10.9,6.3A.79.79,0,0,0,279.18,301.33Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 281.195px 293.605px;" id="elba06cbpri05"
                      class="animable"></path>
                    <path
                      d="M283.6,285l10.54,6.09.11.15v1.13h0a.18.18,0,0,1-.11.15L279.45,301a.62.62,0,0,1-.53,0l-10.54-6.09v-1.13Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 281.315px 293.03px;" id="els2uqoc9yjb9"
                      class="animable"></path>
                    <path
                      d="M268.38,293.81l.14.08,1.71,1,.32.18,8.37,4.83a.55.55,0,0,0,.53,0l14.69-8.48a.16.16,0,0,0,0-.3L294,291l-10.4-6-15.09,8.71,0,0Z"
                      style="fill: rgb(240, 240, 240); transform-origin: 281.312px 292.484px;" id="el0dipa0tqso8o"
                      class="animable"></path>
                    <path
                      d="M279.18,300v1.13a.6.6,0,0,0,.27-.06l14.69-8.49a.18.18,0,0,0,.11-.15v-1.13a.19.19,0,0,1-.11.15l-14.69,8.48A.5.5,0,0,1,279.18,300Z"
                      style="fill: rgb(224, 224, 224); transform-origin: 286.715px 296.215px;" id="elhefzu98j1sm"
                      class="animable"></path>
                    <path
                      d="M268.38,293.66l1.9,1.1.3.17,8.34,4.81a.55.55,0,0,0,.53,0l13.15-7.59.34-.19A3.36,3.36,0,0,0,294,291l0,0,0-.08a.24.24,0,0,0-.19-.27,4.65,4.65,0,0,1-1-.41h0l-9.27-5.35Z"
                      style="fill: rgb(255, 255, 255); transform-origin: 281.191px 292.349px;" id="eljelqk27ewz"
                      class="animable"></path>
                    <g id="elm0e5clhq998">
                      <path
                        d="M270.35,293.53a.15.15,0,0,1,0,.28.53.53,0,0,1-.49,0c-.14-.08-.14-.2,0-.28A.53.53,0,0,1,270.35,293.53Z"
                        style="opacity: 0.1; transform-origin: 270.101px 293.67px;" class="animable"></path>
                    </g>
                    <path
                      d="M268.44,293.37a2.11,2.11,0,0,0,0,.25l.17-.1a.76.76,0,0,1,0-.15.66.66,0,0,1,.25-.6.34.34,0,0,1,.17,0,.58.58,0,0,1,.3.09,1.83,1.83,0,0,1,.74,1.06l.18,0a2,2,0,0,0-.83-1.19.62.62,0,0,0-.65-.05A.83.83,0,0,0,268.44,293.37Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 269.343px 293.265px;" id="el92x952h6dli"
                      class="animable"></path>
                    <path d="M268.47,293.71a.08.08,0,0,1,0,0l0,0Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 268.47px 293.71px;" id="elww6ksn7ddol"
                      class="animable"></path>
                    <g id="elr8zh7s6rkue">
                      <path
                        d="M271.82,292.68a.15.15,0,0,1,0,.28.53.53,0,0,1-.49,0,.15.15,0,0,1,0-.28A.53.53,0,0,1,271.82,292.68Z"
                        style="opacity: 0.1; transform-origin: 271.575px 292.82px;" class="animable"></path>
                    </g>
                    <path
                      d="M269.91,292.52a2.11,2.11,0,0,0,0,.25l.17-.1c0-.05,0-.1,0-.15a.66.66,0,0,1,.25-.6.35.35,0,0,1,.18-.05.64.64,0,0,1,.3.09,1.82,1.82,0,0,1,.73,1.06l.18,0a2,2,0,0,0-.82-1.19.64.64,0,0,0-.66-.05A.83.83,0,0,0,269.91,292.52Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 270.813px 292.366px;" id="eli1g5g60y8em"
                      class="animable"></path>
                    <g id="elk1prwx5d5dg">
                      <path
                        d="M273.29,291.83c.14.07.14.2,0,.28a.53.53,0,0,1-.49,0c-.13-.08-.13-.21,0-.28A.53.53,0,0,1,273.29,291.83Z"
                        style="opacity: 0.1; transform-origin: 273.049px 291.97px;" class="animable"></path>
                    </g>
                    <path
                      d="M271.38,291.67a2.29,2.29,0,0,0,0,.25l.17-.1v-.15a.68.68,0,0,1,.24-.6A.41.41,0,0,1,272,291a.64.64,0,0,1,.3.09,1.83,1.83,0,0,1,.74,1.06l.18,0a2,2,0,0,0-.83-1.19.64.64,0,0,0-.66,0A.84.84,0,0,0,271.38,291.67Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 272.298px 291.509px;" id="el1dwj5fwpq44i"
                      class="animable"></path>
                    <g id="ela931gopctgt">
                      <path
                        d="M274.77,291c.13.07.13.2,0,.28a.53.53,0,0,1-.49,0c-.14-.08-.14-.21,0-.28A.53.53,0,0,1,274.77,291Z"
                        style="opacity: 0.1; transform-origin: 274.521px 291.14px;" class="animable"></path>
                    </g>
                    <path
                      d="M272.86,290.82a1.1,1.1,0,0,0,0,.25l.17-.1a.76.76,0,0,1,0-.15.66.66,0,0,1,.25-.6.34.34,0,0,1,.17-.05.61.61,0,0,1,.3.09,1.83,1.83,0,0,1,.74,1.06l.18,0a2,2,0,0,0-.83-1.19.62.62,0,0,0-.65-.05A.82.82,0,0,0,272.86,290.82Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 273.761px 290.665px;" id="elaziwd106pca"
                      class="animable"></path>
                    <g id="elwkjox60ph78">
                      <path
                        d="M276.24,290.13c.13.07.13.2,0,.28a.53.53,0,0,1-.49,0c-.14-.08-.14-.21,0-.28A.53.53,0,0,1,276.24,290.13Z"
                        style="opacity: 0.1; transform-origin: 275.991px 290.27px;" class="animable"></path>
                    </g>
                    <path
                      d="M274.33,290a2.29,2.29,0,0,0,0,.25l.17-.1a.76.76,0,0,1,0-.15.66.66,0,0,1,.25-.6.35.35,0,0,1,.18-.05.64.64,0,0,1,.3.09,1.87,1.87,0,0,1,.73,1.06.52.52,0,0,0,.18,0,2.08,2.08,0,0,0-.82-1.18.64.64,0,0,0-.66-.05A.82.82,0,0,0,274.33,290Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 275.233px 289.855px;" id="elivdtpmvdstk"
                      class="animable"></path>
                    <g id="elzrvjnelpx2p">
                      <path
                        d="M277.71,289.28c.14.07.14.2,0,.28a.53.53,0,0,1-.49,0c-.13-.08-.13-.21,0-.28A.53.53,0,0,1,277.71,289.28Z"
                        style="opacity: 0.1; transform-origin: 277.469px 289.42px;" class="animable"></path>
                    </g>
                    <path
                      d="M275.8,289.12a2.29,2.29,0,0,0,0,.25l.17-.1s0-.1,0-.15a.66.66,0,0,1,.25-.6.37.37,0,0,1,.18,0,.64.64,0,0,1,.3.09,1.88,1.88,0,0,1,.74,1.06.57.57,0,0,0,.18,0,2,2,0,0,0-.83-1.18.64.64,0,0,0-.66-.05A.84.84,0,0,0,275.8,289.12Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 276.708px 289.024px;" id="elx40qq41m57"
                      class="animable"></path>
                    <g id="ellxvcom8cvl">
                      <path
                        d="M279.18,288.43c.14.07.14.2,0,.28a.51.51,0,0,1-.48,0c-.14-.08-.14-.21,0-.28A.51.51,0,0,1,279.18,288.43Z"
                        style="opacity: 0.1; transform-origin: 278.94px 288.57px;" class="animable"></path>
                    </g>
                    <path
                      d="M277.28,288.27a2.18,2.18,0,0,0,0,.25l.18-.1a.76.76,0,0,1,0-.15.68.68,0,0,1,.24-.6.41.41,0,0,1,.18-.05.64.64,0,0,1,.3.09,1.83,1.83,0,0,1,.74,1.06l.18,0a2,2,0,0,0-.83-1.18.64.64,0,0,0-.66-.05A.84.84,0,0,0,277.28,288.27Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 278.188px 288.121px;" id="elu4iv070xe7"
                      class="animable"></path>
                    <g id="elomvurhspzf">
                      <path
                        d="M280.66,287.58c.13.07.13.2,0,.28a.53.53,0,0,1-.49,0c-.14-.08-.14-.21,0-.28A.53.53,0,0,1,280.66,287.58Z"
                        style="opacity: 0.1; transform-origin: 280.411px 287.72px;" class="animable"></path>
                    </g>
                    <path
                      d="M278.75,287.42a1.1,1.1,0,0,0,0,.25l.17-.1a.76.76,0,0,1,0-.15.66.66,0,0,1,.25-.6.34.34,0,0,1,.17-.05.58.58,0,0,1,.3.09,1.83,1.83,0,0,1,.74,1.06.52.52,0,0,0,.18,0,2.07,2.07,0,0,0-.83-1.19.64.64,0,0,0-.65,0A.82.82,0,0,0,278.75,287.42Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 279.651px 287.285px;" id="el1zrv7gq82k7"
                      class="animable"></path>
                    <g id="elxsxwwhf8yl">
                      <path
                        d="M282.13,286.72a.16.16,0,0,1,0,.29.53.53,0,0,1-.49,0,.16.16,0,0,1,0-.29A.6.6,0,0,1,282.13,286.72Z"
                        style="opacity: 0.1; transform-origin: 281.885px 286.869px;" class="animable"></path>
                    </g>
                    <path
                      d="M280.22,286.57a2.29,2.29,0,0,0,0,.25l.17-.1a.76.76,0,0,1,0-.15.66.66,0,0,1,.25-.6.35.35,0,0,1,.18-.05.64.64,0,0,1,.3.09,1.82,1.82,0,0,1,.73,1.06.52.52,0,0,0,.18,0,2.06,2.06,0,0,0-.82-1.19.66.66,0,0,0-.66,0A.82.82,0,0,0,280.22,286.57Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 281.123px 286.435px;" id="el3i1c7n7zqid"
                      class="animable"></path>
                    <g id="el1aj36vfbqzl">
                      <path
                        d="M283.6,285.87a.15.15,0,0,1,0,.29.53.53,0,0,1-.49,0,.16.16,0,0,1,0-.29A.6.6,0,0,1,283.6,285.87Z"
                        style="opacity: 0.1; transform-origin: 283.365px 286.019px;" class="animable"></path>
                    </g>
                    <path
                      d="M281.69,285.72a2.29,2.29,0,0,0,0,.25l.17-.1v-.15a.68.68,0,0,1,.24-.6.41.41,0,0,1,.18-.05.64.64,0,0,1,.3.09,1.83,1.83,0,0,1,.74,1.06l.18,0a2.07,2.07,0,0,0-.83-1.19.66.66,0,0,0-.66,0A.84.84,0,0,0,281.69,285.72Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 282.593px 285.581px;" id="elfxkphiphhvk"
                      class="animable"></path>
                    <path
                      d="M280.66,298.37a.29.29,0,0,1-.16,0l-8.11-4.68a.32.32,0,0,1-.11-.42.31.31,0,0,1,.42-.12l8.11,4.69a.3.3,0,0,1,.11.42A.31.31,0,0,1,280.66,298.37Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 276.604px 295.746px;" id="elemx7fhm2wtn"
                      class="animable"></path>
                    <path
                      d="M281.64,297.8a.32.32,0,0,1-.16,0l-8.1-4.68a.31.31,0,1,1,.31-.53l8.1,4.68a.31.31,0,0,1,.12.42A.31.31,0,0,1,281.64,297.8Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 277.568px 295.167px;" id="eljukd7tbfc2"
                      class="animable"></path>
                    <path
                      d="M282.62,297.24a.27.27,0,0,1-.15-.05l-8.11-4.68a.3.3,0,0,1-.11-.42.32.32,0,0,1,.42-.11l8.1,4.68a.31.31,0,0,1-.15.58Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 278.567px 294.591px;" id="el6innri78kq3"
                      class="animable"></path>
                    <path
                      d="M283.6,296.67a.28.28,0,0,1-.15,0L275.34,292a.3.3,0,0,1-.11-.42.31.31,0,0,1,.42-.12l8.11,4.68a.31.31,0,0,1-.16.58Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 279.552px 294.071px;" id="el04313ite0ee3"
                      class="animable"></path>
                    <path
                      d="M284.58,296.1a.28.28,0,0,1-.15,0l-8.11-4.68a.32.32,0,0,1-.11-.42.3.3,0,0,1,.42-.11l8.11,4.68a.31.31,0,0,1-.16.57Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 280.527px 293.493px;" id="elut8osumsrak"
                      class="animable"></path>
                    <path
                      d="M285.57,295.54a.3.3,0,0,1-.16-.05l-8.11-4.68a.32.32,0,0,1-.11-.42.31.31,0,0,1,.42-.11l8.11,4.68a.31.31,0,0,1-.15.58Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 281.515px 292.89px;" id="el3p9vk8gk9b"
                      class="animable"></path>
                    <path
                      d="M286.55,295a.32.32,0,0,1-.16,0l-8.1-4.68a.31.31,0,0,1,.3-.54l8.11,4.68a.31.31,0,0,1-.15.58Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 282.505px 292.396px;" id="elqm3lku7qjak"
                      class="animable"></path>
                    <path
                      d="M287.53,294.4a.26.26,0,0,1-.15,0l-8.11-4.68a.31.31,0,0,1,.31-.53l8.1,4.68a.31.31,0,0,1,.12.42A.31.31,0,0,1,287.53,294.4Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 283.495px 291.789px;" id="elofxsu8s86"
                      class="animable"></path>
                    <path
                      d="M288.51,293.83a.28.28,0,0,1-.15,0l-8.11-4.68a.3.3,0,0,1-.11-.42.31.31,0,0,1,.42-.11l8.11,4.68a.32.32,0,0,1,.11.42A.31.31,0,0,1,288.51,293.83Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 284.456px 291.21px;" id="elap8i6l8yr1"
                      class="animable"></path>
                    <path
                      d="M289.49,293.27a.42.42,0,0,1-.15,0l-8.11-4.68a.32.32,0,0,1-.11-.42.31.31,0,0,1,.42-.12l8.11,4.68a.31.31,0,0,1,.11.42A.32.32,0,0,1,289.49,293.27Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 285.442px 290.644px;" id="elojuk7iyt1fh"
                      class="animable"></path>
                    <path
                      d="M290.48,292.7a.29.29,0,0,1-.16,0L282.21,288a.32.32,0,0,1-.11-.42.3.3,0,0,1,.42-.11l8.11,4.68a.3.3,0,0,1,.11.42A.29.29,0,0,1,290.48,292.7Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 286.424px 290.068px;" id="elhuo1bsx1yrn"
                      class="animable"></path>
                    <path
                      d="M291.46,292.13a.32.32,0,0,1-.16,0l-8.1-4.68a.31.31,0,0,1-.12-.42.3.3,0,0,1,.42-.11l8.11,4.68a.3.3,0,0,1,.11.42A.29.29,0,0,1,291.46,292.13Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 287.403px 289.508px;" id="elj1i6388mrnf"
                      class="animable"></path>
                    <path
                      d="M292.44,291.57a.37.37,0,0,1-.15,0l-8.11-4.69a.3.3,0,0,1-.11-.42.32.32,0,0,1,.42-.11l8.1,4.68a.31.31,0,0,1-.15.58Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 288.387px 288.961px;" id="el5qdaf3a7i6"
                      class="animable"></path>
                    <path
                      d="M279.66,298.94a.37.37,0,0,1-.15,0l-8.58-5a.31.31,0,0,1-.11-.43.32.32,0,0,1,.42-.11l8.57,5a.31.31,0,0,1-.15.58Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 275.371px 296.171px;" id="el5eu2i538fs3"
                      class="animable"></path>
                    <g id="el1tbdh4x4vsm">
                      <g style="opacity: 0.25; transform-origin: 280.676px 292.698px;" class="animable">
                        <path
                          d="M275.57,292.79a1.31,1.31,0,0,0,.41-.43.36.36,0,0,1,.19,0c.23,0,0,.12,0,.21s0,.06,0,.05.57-.12.46.15a0,0,0,0,0,0,0c.05,0,.28.05.25.11s0,.05,0,.05a4.51,4.51,0,0,1,.52,0l.24,0c.05.07,0,.2-.06.25a0,0,0,0,0,0,.05c.09.05.16.1.1.19s0,.06,0,.06c.22.07.62-.12.69.15s0,.2.21.18c0,0,.07-.07,0-.07-.22,0-.06-.25-.18-.33s-.42.08-.55,0,0-.09-.06-.19-.07,0-.09,0,0,0,0,0,0,0,0-.06,0,0,0-.07c.05-.25-.35-.19-.51-.2a2.72,2.72,0,0,1-.3,0s0-.06,0-.07l-.24-.09s.05-.1,0-.15-.35-.06-.45,0h-.08a.07.07,0,0,0,.07-.07s0,0,0-.09-.08-.08-.15-.09a.39.39,0,0,0-.21,0,.47.47,0,0,0,0-.23c-.06-.24-.34-.06-.48,0s0,.08,0,.07.24-.11.32-.09,0,.22-.05.34l-.16.08a.78.78,0,0,0-.33.21C275.25,292.82,275.41,292.87,275.57,292.79Zm.09-.26.12-.07a.56.56,0,0,1-.21.22s-.17.07-.12,0A.41.41,0,0,1,275.66,292.53Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 276.871px 292.906px;" id="elqlsmt4ncbi"
                          class="animable"></path>
                        <path
                          d="M279.06,294.74s0,0,0,0c.19.06.37-.17.44-.39.06,0,.22,0,.24.08l0,.11a0,0,0,0,0,0,0c.1,0,.43-.12.38.06,0,0,0,0,0,0s.28,0,.31.09-.12.12-.05.21.15,0,.21,0,.08,0,.12,0,0,0,0,.07,0,.05.05.06.07,0,.1,0,0,0,.07,0l.13,0s.18.08.17.05-.09.14,0,.22.34,0,.42,0,.06-.09,0-.09l-.2,0c-.17-.07-.12-.13-.09-.21a0,0,0,0,0,0-.05c-.12,0-.2-.1-.28-.1s-.12.05-.14.05-.07,0-.07-.13a0,0,0,0,0-.05,0c-.08,0-.28.18-.28,0,0,0,.08-.08.09-.12s0-.11-.11-.12-.11,0-.16,0c-.21,0,0,0-.11-.06s-.08-.06-.2-.06l-.13,0c-.11,0,0,0,0-.08s0-.09,0-.15-.09-.09-.19-.07l-.18.06c0-.16,0-.28-.17-.28s-.08.07,0,.08.11.14.08.26A.7.7,0,0,0,279.06,294.74Zm.19-.13a.51.51,0,0,1,.13-.14s0,0,0,0S279.21,294.72,279.25,294.61Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 280.381px 294.613px;" id="elm3l43yvyir8"
                          class="animable"></path>
                        <path
                          d="M276.68,295.69a1.27,1.27,0,0,0,.41-.42.55.55,0,0,1,.18,0c.24,0,0,.13,0,.22s0,.05,0,.05.57-.13.46.14c0,0,0,.05,0,.05s.28.05.25.1,0,.05,0,.05a4.51,4.51,0,0,1,.52,0l.24,0c.05.06,0,.2-.06.24a0,0,0,0,0,0,.06c.09,0,.16.09.1.19s0,.05,0,.06c.23.06.63-.12.69.14s0,.21.22.19c0,0,.07-.07,0-.07-.22,0-.06-.25-.18-.34s-.42.08-.55,0,0-.1-.06-.19-.08,0-.09,0l0,0s0,0,0-.06,0,0,0-.07c.05-.25-.35-.18-.51-.2a1.5,1.5,0,0,1-.3,0s0-.06,0-.07l-.24-.1s.05-.09,0-.14-.34-.06-.44-.06h-.08s.06,0,.07-.07,0-.05,0-.1-.08-.08-.15-.09a.93.93,0,0,0-.22,0,.37.37,0,0,0,0-.22c-.06-.25-.34-.07-.48,0s-.05.08,0,.07a1.07,1.07,0,0,1,.32-.1c.13,0,0,.22,0,.34l-.16.08a.8.8,0,0,0-.33.22C276.36,295.72,276.52,295.77,276.68,295.69Zm.09-.26.12-.06a.63.63,0,0,1-.21.22s-.17.06-.12,0A.42.42,0,0,1,276.77,295.43Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 278.006px 295.814px;" id="elr02hocdakn"
                          class="animable"></path>
                        <path
                          d="M273.63,293.88s0,0,0,0c.19.06.37-.17.44-.39.07,0,.22,0,.24.08l0,.11a0,0,0,0,0,0,0c.1,0,.44-.12.38.06a0,0,0,0,0,0,0c.08.06.27,0,.3.09s-.12.12,0,.21.15,0,.22,0,.07-.05.11,0,0,0,0,.06,0,.05.05.07h.1s0,0,.07,0l.13,0s.19.08.17.05-.09.14,0,.21.34,0,.42,0,.07-.08,0-.08l-.2,0c-.17-.08-.12-.13-.09-.21s0-.05,0-.05-.19-.11-.28-.11l-.14.06c-.13,0-.07,0-.07-.14s0,0-.05,0-.27.19-.28,0c0,0,.09-.07.09-.11s0-.11-.1-.13a.47.47,0,0,0-.17,0c-.21,0,0,0-.11-.06a.18.18,0,0,0-.19-.06.71.71,0,0,1-.14,0c-.11,0,0,0,0-.07s0-.09,0-.15-.09-.1-.19-.08l-.18.06c0-.15,0-.28-.17-.27s-.08.07,0,.08.11.14.08.26C273.81,293.58,273.64,293.73,273.63,293.88Zm.18-.14a.45.45,0,0,1,.14-.13l0,.05S273.77,293.85,273.81,293.74Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 274.973px 293.745px;" id="el0yisj7m8xv8"
                          class="animable"></path>
                        <path
                          d="M281.56,289.48a1.42,1.42,0,0,0,.41-.43.35.35,0,0,1,.18,0c.24,0,0,.12,0,.21s0,.06,0,0,.57-.12.46.15a0,0,0,0,0,0,0c.05,0,.28.05.25.11s0,.05,0,.05a4.51,4.51,0,0,1,.52,0l.24,0c.05.07,0,.2-.06.25s0,0,0,.05.16.1.1.19,0,.06,0,.06c.23.07.63-.12.69.15s0,.2.22.18c0,0,.07-.07,0-.07-.22,0-.06-.25-.18-.33s-.42.07-.55,0,0-.09-.06-.19-.08,0-.09,0,0,0,0,0,0,0,0-.06,0,0,0-.07c.05-.25-.35-.19-.51-.2a2.72,2.72,0,0,1-.3,0s0-.06,0-.07l-.24-.09s.05-.1,0-.15-.34-.06-.44,0h-.08a.09.09,0,0,0,.07-.07s0,0,0-.09-.08-.09-.15-.09a.45.45,0,0,0-.22,0,.39.39,0,0,0,0-.23c-.06-.24-.34-.06-.48,0s-.05.08,0,.07.24-.11.32-.09,0,.22,0,.34l-.16.08a.78.78,0,0,0-.33.21C281.24,289.51,281.4,289.56,281.56,289.48Zm.09-.26.12-.07a.63.63,0,0,1-.21.22s-.17.07-.12,0A.41.41,0,0,1,281.65,289.22Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 282.886px 289.546px;" id="elneh1xyjqimq"
                          class="animable"></path>
                        <path
                          d="M285.05,291.43s0,0,0,0c.19.06.37-.17.43-.39.07,0,.23,0,.25.08l0,.11a0,0,0,0,0,0,0c.1,0,.43-.12.38.06,0,0,0,0,0,0s.28,0,.31.09-.12.12,0,.21.15,0,.21,0,.08,0,.12,0,0,.05,0,.07,0,.05.05.06.06,0,.1,0,0,0,.07,0l.13,0s.18.08.16.05-.08.14,0,.22.34,0,.41,0,.07-.09,0-.09l-.19,0c-.17-.07-.13-.13-.09-.21s0-.05,0-.05-.19-.1-.27-.1a1.09,1.09,0,0,0-.14.05c-.14,0-.07,0-.07-.13s0,0-.05,0-.28.18-.28,0c0,0,.08-.08.09-.12s0-.11-.11-.12-.11,0-.16,0c-.22,0,0,0-.11-.06s-.08-.06-.2-.06a.57.57,0,0,1-.13,0c-.12,0,0,0,0-.07s0-.09,0-.15-.09-.09-.19-.07a.54.54,0,0,0-.18.06c0-.16,0-.28-.17-.28s-.08.07,0,.08.11.14.08.26A.7.7,0,0,0,285.05,291.43Zm.19-.14a.51.51,0,0,1,.13-.13l0,0S285.2,291.41,285.24,291.29Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 286.386px 291.308px;" id="elkcn7kcdsoym"
                          class="animable"></path>
                        <path
                          d="M282.67,292.38a1.27,1.27,0,0,0,.41-.42.55.55,0,0,1,.18,0c.24,0,0,.13,0,.22a0,0,0,0,0,.05.05c.17,0,.57-.13.46.14a0,0,0,0,0,0,.05c.05,0,.28.05.25.1a0,0,0,0,0,0,0,4.69,4.69,0,0,1,.53,0l.24,0c0,.06,0,.2-.06.24a0,0,0,0,0,0,.06c.09,0,.16.09.1.19a0,0,0,0,0,0,.06c.23.06.63-.13.69.14s0,.21.22.19c0,0,.07-.07,0-.08-.22,0-.06-.24-.18-.33s-.42.08-.56,0,0-.1-.05-.2-.08,0-.09,0l0,0a.22.22,0,0,0,0-.06s0,0,0-.07c0-.25-.35-.18-.52-.2a1.4,1.4,0,0,1-.29,0s0-.06,0-.07l-.24-.1s.05-.09,0-.14-.34-.06-.44-.06h-.08s.06,0,.07-.07,0-.05,0-.1-.09-.08-.15-.09a.6.6,0,0,0-.22,0,.37.37,0,0,0,0-.22c-.06-.25-.34-.07-.48,0s-.05.08,0,.07a1,1,0,0,1,.32-.1c.13,0,0,.22-.05.34l-.16.08a.74.74,0,0,0-.33.22C282.35,292.41,282.51,292.46,282.67,292.38Zm.08-.26.13-.06a.63.63,0,0,1-.21.22s-.17.06-.13,0A.54.54,0,0,1,282.75,292.12Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 284.031px 292.451px;" id="elyfs7z8xfpss"
                          class="animable"></path>
                        <path
                          d="M279.61,290.57s0,0,0,0c.19.06.37-.17.44-.39.07,0,.22,0,.24.08a.66.66,0,0,0,0,.11,0,0,0,0,0,0,0c.1,0,.44-.12.38.06a.06.06,0,0,0,0,0c.09.06.28,0,.31.09s-.12.12,0,.21.15,0,.21,0,.08-.05.12,0,0,0,0,.06,0,.05.05.07h.1s0,0,.07,0l.13,0s.18.08.17.05-.09.14,0,.21.34,0,.42,0,.06-.08,0-.08l-.2,0c-.17-.08-.12-.13-.09-.21s0-.06,0-.05-.2-.11-.28-.11l-.14.06c-.13,0-.07-.05-.07-.14s0,0-.05,0-.27.19-.28,0c0,0,.08-.07.09-.11s0-.11-.11-.13a.45.45,0,0,0-.16,0c-.21,0,0,0-.11-.06a.18.18,0,0,0-.19-.06.71.71,0,0,1-.14,0c-.11,0,0,0,0-.07s0-.09,0-.15-.09-.1-.19-.08l-.18.06c0-.15,0-.28-.17-.27s-.08.07,0,.08.11.14.08.26C279.8,290.27,279.63,290.42,279.61,290.57Zm.19-.14a.51.51,0,0,1,.13-.13.08.08,0,0,1,0,.05S279.76,290.54,279.8,290.43Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 280.956px 290.435px;" id="el8b1zetoqr2r"
                          class="animable"></path>
                        <path
                          d="M282.05,294.38a1.23,1.23,0,0,0,.42-.43.33.33,0,0,1,.18,0c.24,0,0,.13,0,.22s0,.05,0,.05.56-.13.45.14a0,0,0,0,0,0,.05c.05,0,.28.05.26.1a0,0,0,0,0,0,0,4.51,4.51,0,0,1,.52,0,.88.88,0,0,1,.24,0c.06.06,0,.2-.05.24a0,0,0,0,0,0,.06c.09,0,.16.09.1.19a0,0,0,0,0,0,.06c.22.06.62-.13.69.14s0,.21.22.19c0,0,.06-.08,0-.08-.21,0-.05-.24-.18-.33s-.42.08-.55,0,0-.09-.06-.19-.07,0-.09,0l0,0a.21.21,0,0,1,0-.06s0,0,0-.07c.05-.25-.35-.19-.51-.2a1.5,1.5,0,0,1-.3,0s0-.06,0-.07l-.24-.1s.05-.09,0-.14-.35-.06-.45-.06h-.08s.07,0,.07-.07,0-.06,0-.1-.08-.08-.15-.09a.52.52,0,0,0-.21,0,.36.36,0,0,0,0-.22c-.06-.25-.33-.07-.48,0s0,.08,0,.06a1.41,1.41,0,0,1,.32-.09c.13,0,0,.22,0,.34l-.16.08c-.12.06-.26.1-.33.22S281.89,294.46,282.05,294.38Zm.09-.26.12-.06a.5.5,0,0,1-.21.22s-.17.06-.12,0A.54.54,0,0,1,282.14,294.12Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 283.388px 294.446px;" id="elokjl8m6uo0o"
                          class="animable"></path>
                        <path
                          d="M279.52,292.75s0,0,0,0c.19.06.37-.17.44-.39.07,0,.22,0,.25.08a1,1,0,0,1-.05.11,0,0,0,0,0,0,0c.11,0,.44-.12.38.06,0,0,0,0,0,0s.27,0,.3.09-.12.12-.05.21.15,0,.22,0,.07,0,.12,0,0,.05,0,.07,0,0,0,.06.07,0,.1,0,.05,0,.07,0a.5.5,0,0,1,.13,0s.19.08.17.05-.09.14,0,.22.34,0,.42,0,.07-.08,0-.08l-.2,0c-.17-.08-.12-.13-.09-.21s0-.05,0-.05-.19-.11-.28-.1-.12.05-.14.05-.07,0-.07-.14,0,0,0,0-.27.18-.28,0,.09-.08.09-.12,0-.11-.1-.13a.47.47,0,0,0-.17,0c-.21,0,0,0-.11-.06a.18.18,0,0,0-.19-.06.71.71,0,0,1-.14,0c-.11,0,0,0,0-.07s0-.09,0-.15-.09-.09-.18-.08a.89.89,0,0,0-.19.07c0-.16,0-.28-.17-.28s-.08.07,0,.08.1.14.07.26S279.53,292.61,279.52,292.75Zm.18-.14a.45.45,0,0,1,.14-.13l0,0S279.66,292.72,279.7,292.61Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 280.798px 292.623px;" id="ellp8kyy7l2b"
                          class="animable"></path>
                        <path
                          d="M277.63,290.88a.49.49,0,0,1,0,.24s0,0,0,0,.44-.13.39,0a0,0,0,0,0,0,.05c.09.05.28-.05.3.09s-.11.12,0,.21.15,0,.21,0,.08-.06.12,0,0,0,0,.06,0,.05,0,.06.06,0,.1,0l.06,0a.32.32,0,0,1,.14,0s.18.09.16.05-.08.14,0,.22.34,0,.41,0,.07-.08,0-.08l-.2,0c-.17-.07-.13-.12-.1-.21a0,0,0,0,0,0-.05c-.11,0-.19-.1-.28-.1l-.13,0c-.14,0-.07,0-.08-.13s0,0,0,0-.28.19-.28,0c0,0,.08-.08.09-.12s0-.1-.11-.12a.5.5,0,0,0-.17,0c-.21,0,0,0-.1,0a.22.22,0,0,0-.2-.07.3.3,0,0,1-.13,0c-.12,0,0,0-.05-.08s.05-.09,0-.15-.16-.15-.19,0v.05S277.63,290.86,277.63,290.88Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 278.581px 291.282px;" id="eln9lrnwxly2"
                          class="animable"></path>
                      </g>
                    </g>
                  </g>
                  <g id="freepik--Pencil--inject-85" class="animable" style="transform-origin: 268.673px 298.485px;">
                    <g id="freepik--shadow--inject-85">
                      <path d="M275.56,302c-.16.43-.62.69-1.38.8l-10.94-6.41-1.42-1.44a.11.11,0,0,1,.12-.18l2.61.87Z"
                        style="opacity: 0.1; transform-origin: 268.673px 298.781px;" class="animable"></path>
                    </g>
                    <path d="M264.45,294.62l-2.33-.45a.08.08,0,0,0-.07.12l1.59,1.79Z"
                      style="fill: rgb(255, 168, 167); transform-origin: 263.245px 295.125px;" id="elvsa2lkbzfi"
                      class="animable"></path>
                    <path d="M262.05,294.29a.08.08,0,0,1,.07-.12l.46.09h0a.4.4,0,0,0-.19.37v0Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 262.31px 294.4px;" id="elruhxhbdqsoe"
                      class="animable"></path>
                    <path
                      d="M272.32,301.06l-.19-.11-.23-.13-8.26-4.74a1.2,1.2,0,0,1,.81-1.45l8.26,4.73.44.25C272.86,299.47,272,300.9,272.32,301.06Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 268.376px 297.845px;" id="elckiy62hxkbe"
                      class="animable"></path>
                    <path
                      d="M271.59,300.64l-.42-.24c-.13-.07-.06-.38.09-.7s.58-.83.74-.74l.32.18.11.06c-.17-.08-.55.33-.74.75s-.22.6-.11.68h0Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 271.766px 299.795px;" id="elyqg5hxal4g"
                      class="animable"></path>
                    <path d="M271.49,300.58c-.29-.15.54-1.59.83-1.44l.43.25c-.29-.16-1.13,1.28-.84,1.43Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 272.09px 299.975px;" id="elk26s2h4y97n"
                      class="animable"></path>
                    <path
                      d="M272.32,301.06l-.42-.24c-.29-.15.51-1.55.81-1.46h0l.42.24C272.86,299.47,272,300.9,272.32,301.06Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 272.484px 300.208px;" id="elcb32i88qnk5"
                      class="animable"></path>
                    <g id="elcifcpakvx3s">
                      <path
                        d="M262,294.21l.08,0,1.69.92,8.74,5s0,0,0,0c-.25.38-.43.87-.27,1l-.19-.11-.23-.13-8.26-4.74h0l-1.58-1.79A.08.08,0,0,1,262,294.21Z"
                        style="opacity: 0.15; transform-origin: 267.223px 297.67px;" class="animable"></path>
                    </g>
                    <path
                      d="M274.1,302.08l-1.78-1c-.13-.07-.06-.37.09-.69s.57-.84.74-.76h0l1.79,1c.36.21,0,1-.37,1.32A.43.43,0,0,1,274.1,302.08Z"
                      style="fill: rgb(242, 143, 143); transform-origin: 273.67px 300.863px;" id="elmoadq7ir6hn"
                      class="animable"></path>
                    <g id="eluhc71bzohfl">
                      <path
                        d="M274,301.52a1.3,1.3,0,0,1,.73-.88.28.28,0,0,1,.26,0c.27.25,0,1-.42,1.28a.42.42,0,0,1-.46.12C274,302,273.93,301.8,274,301.52Z"
                        style="opacity: 0.1; transform-origin: 274.535px 301.336px;" class="animable"></path>
                    </g>
                  </g>
                  <g id="freepik--Laptop--inject-85" class="animable" style="transform-origin: 233.37px 265.4px;">
                    <g id="el4umo4s0i1xi">
                      <path d="M207.17,268.08l20-11.53a1.13,1.13,0,0,1,1.15,0l34.66,20a.26.26,0,0,1,0,.45l-20.17,11.64Z"
                        style="opacity: 0.1; transform-origin: 235.14px 272.516px;" class="animable"></path>
                    </g>
                    <path
                      d="M208.66,265.65v.45a1.85,1.85,0,0,0,.92,1.6l32.29,18.64a1.77,1.77,0,0,0,.92.25,1.83,1.83,0,0,0,.93-.25l17.6-10.13a1.86,1.86,0,0,0,.92-1.6V274h0a.22.22,0,0,1-.11.2l-19.33,11.16Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 235.45px 276.12px;" id="el0qabf8v8efgl"
                      class="animable"></path>
                    <path d="M208.66,265.65l19.14-11a1.08,1.08,0,0,1,1.1,0l33.22,19.18a.24.24,0,0,1,0,.42l-19.33,11.16Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 235.452px 269.955px;" id="el0npzwirf4jk"
                      class="animable"></path>
                    <polygon points="242.97 283.73 253.29 277.78 223.1 260.35 212.72 266.27 242.97 283.73"
                      style="fill: rgb(55, 71, 79); transform-origin: 233.005px 272.04px;" id="elc9nz2a2pdm"
                      class="animable"></polygon>
                    <polygon
                      points="212.72 266.27 213.11 266.5 223.1 260.8 252.9 278.01 253.29 277.78 223.1 260.35 212.72 266.27"
                      style="fill: rgb(38, 50, 56); transform-origin: 233.005px 269.18px;" id="elenms3ortbhj"
                      class="animable"></polygon>
                    <polygon
                      points="212.72 266.27 213.11 266.5 223.1 260.8 252.9 278.01 253.29 277.78 223.1 260.35 212.72 266.27"
                      style="fill: rgb(38, 50, 56); transform-origin: 233.005px 269.18px;" id="el4zh0rgi69ql"
                      class="animable"></polygon>
                    <polygon
                      points="248.04 267.17 247.85 267.28 242.79 270.2 233.79 265 233.6 264.89 238.85 261.86 248.04 267.17"
                      style="fill: rgb(38, 50, 56); transform-origin: 240.82px 266.03px;" id="elwiw39cftkso"
                      class="animable"></polygon>
                    <polygon points="247.85 267.28 242.79 270.2 233.79 265 238.85 262.08 247.85 267.28"
                      style="fill: rgb(55, 71, 79); transform-origin: 240.82px 266.14px;" id="elbs9ww6qk3pc"
                      class="animable"></polygon>
                    <path d="M242.79,285.36v1.23a1.77,1.77,0,0,1-.92-.25L209.58,267.7a1.85,1.85,0,0,1-.92-1.6v-.45Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 225.725px 276.12px;" id="elo5r9kn9yi3"
                      class="animable"></path>
                    <path d="M242.79,285.36v1.23a1.77,1.77,0,0,1-.92-.25L209.58,267.7a1.85,1.85,0,0,1-.92-1.6v-.45Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 225.725px 276.12px;" id="elzo0ghczyqs8"
                      class="animable"></path>
                    <path
                      d="M242.27,285.63a2.18,2.18,0,0,1-1.88-.14l-32.15-18.56a2.19,2.19,0,0,1-1.06-1.53l-3.52-21a2.19,2.19,0,0,1,.61-1.91l33.41,19.29a1.6,1.6,0,0,1,.79,1.13Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 222.95px 264.135px;" id="eljkoo14lgan"
                      class="animable"></path>
                    <path
                      d="M242.79,285.36l-.22.13-.3.14-3.8-22.71a1.6,1.6,0,0,0-.79-1.13L204.27,242.5a1.9,1.9,0,0,1,.45-.34l33.47,19.32a1.64,1.64,0,0,1,.79,1.13Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 223.53px 263.895px;" id="eln57eon9tmdo"
                      class="animable"></path>
                    <path
                      d="M238.16,262.21l.51-.29a1.49,1.49,0,0,1,.31.69l3.81,22.75-.22.13-.3.14-3.8-22.71A1.81,1.81,0,0,0,238.16,262.21Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 240.475px 273.775px;" id="elue7kty7wr5"
                      class="animable"></path>
                    <path
                      d="M224.16,266.26a7.05,7.05,0,0,0-3.24-4.17c-1.55-.9-2.62-.49-2.38.92a7.08,7.08,0,0,0,3.24,4.17C223.33,268.07,224.4,267.66,224.16,266.26Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 221.35px 264.632px;" id="elr19ksqiyrqb"
                      class="animable"></path>
                  </g>
                  <g id="freepik--Folder--inject-85" class="animable" style="transform-origin: 224.44px 338.786px;">
                    <g id="elb3okw8bp7ak">
                      <g style="opacity: 0.1; transform-origin: 224.265px 339.165px;" class="animable">
                        <path
                          d="M221.13,353.49a1.71,1.71,0,0,0,.85-.22L246,339.39a1,1,0,0,0,.53-.82,1,1,0,0,0-.49-.85L226.2,325.09a1.77,1.77,0,0,0-.93-.25,1.72,1.72,0,0,0-.86.22l-7.16,4.13a1.32,1.32,0,0,0-.51,1.72l.3.56a.25.25,0,0,1-.09.31l-14.42,8.39a1,1,0,0,0-.53.82,1,1,0,0,0,.5.85l17.69,11.39A1.7,1.7,0,0,0,221.13,353.49Z"
                          id="el9a76gvgjnue" class="animable" style="transform-origin: 224.265px 339.165px;"></path>
                      </g>
                    </g>
                    <path
                      d="M220.78,352.06l-18-10.43c-.35-.2-.35-.53,0-.74l24.7-14.05a1.41,1.41,0,0,1,1.28,0l17.85,10.3c.36.21.36.54,0,.74l-24.54,14.17A1.38,1.38,0,0,1,220.78,352.06Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 224.699px 339.451px;" id="elkajxld89e4m"
                      class="animable"></path>
                    <path
                      d="M246.62,337.12l-20.27-12.88a1.36,1.36,0,0,0-1.27,0l-7.3,4.22a.79.79,0,0,0-.31,1l.3.58a.79.79,0,0,1-.3,1l-14.71,8.56a.42.42,0,0,0,0,.78l18,11.62a1.33,1.33,0,0,0,1.27,0l24.54-14.17A.41.41,0,0,0,246.62,337.12Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 224.649px 338.122px;" id="elyam3hv6yca"
                      class="animable"></path>
                  </g>
                  <g id="freepik--Files--inject-85" class="animable" style="transform-origin: 290.481px 342.833px;">
                    <g id="eldi44647k2si">
                      <path
                        d="M264.89,346.08l22.44-12.95a1.18,1.18,0,0,1,1.15,0l27.46,15.81a.25.25,0,0,1,0,.44L293.3,362.43Z"
                        style="opacity: 0.1; transform-origin: 290.481px 347.705px;" class="animable"></path>
                    </g>
                    <path
                      d="M267.2,345.7a.5.5,0,0,0,.25.38L292,360.24a.51.51,0,0,0,.48,0l22-11.13v-.49l-25-14.44-22,11.13A.5.5,0,0,0,267.2,345.7Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 290.84px 347.24px;" id="elcvtzyddhdzh"
                      class="animable"></path>
                    <g id="elyc3nen66ixi">
                      <path
                        d="M292.23,359.81v.48a.66.66,0,0,1-.25-.05l-24.53-14.16a.42.42,0,0,1,0-.77c-.14.07-.14.2,0,.28L292,359.75A.51.51,0,0,0,292.23,359.81Z"
                        style="opacity: 0.1; transform-origin: 279.714px 352.8px;" class="animable"></path>
                    </g>
                    <g id="ele0oo2lhkyx">
                      <path d="M314.47,348.62l-22,11.13a.55.55,0,0,1-.5,0l-24.53-14.16c-.14-.08-.14-.21,0-.28l22-11.13Z"
                        style="opacity: 0.5; transform-origin: 290.902px 346.995px;" class="animable"></path>
                    </g>
                    <g id="el4gkomf417kw">
                      <path d="M314.47,348.62v.49l-22,11.13a.51.51,0,0,1-.25.05v-.48a.51.51,0,0,0,.25-.06Z"
                        style="opacity: 0.2; transform-origin: 303.345px 354.455px;" class="animable"></path>
                    </g>
                    <polygon points="314.13 348.82 289.11 334.38 289.11 327.95 314.13 342.46 314.13 348.82"
                      style="fill: rgb(38, 50, 56); transform-origin: 301.62px 338.385px;" id="elc06u6cwtmh"
                      class="animable"></polygon>
                    <g id="el7dbb46do50r">
                      <polygon points="314.13 348.82 289.11 334.38 289.11 327.95 314.13 342.46 314.13 348.82"
                        style="opacity: 0.7; transform-origin: 301.62px 338.385px;" class="animable"></polygon>
                    </g>
                    <path
                      d="M267.51,342.24a.66.66,0,0,0-.31.53v1.3a.69.69,0,0,0,.31.53l24.41,14.08a.66.66,0,0,0,.61,0l18.65-10.08v-2l-25-14.44Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 289.19px 345.457px;" id="elaul7kicomdj"
                      class="animable"></path>
                    <path
                      d="M286.16,332.15l-18.65,10.09c-.17.09-.17.25,0,.35l24.41,14.09a.72.72,0,0,0,.61,0l18.65-10.09Z"
                      style="fill: rgb(250, 250, 250); transform-origin: 289.281px 344.449px;" id="elgsrsmg8nzz"
                      class="animable"></path>
                    <path
                      d="M308.8,346.75a.52.52,0,0,0,.21.07.62.62,0,0,0,.33,0l.1,0c.17-.09.15-.26,0-.37a.6.6,0,0,0-.29-.08.57.57,0,0,0-.35.05l0,0C308.59,346.51,308.62,346.65,308.8,346.75Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 309.107px 346.602px;" id="elg0zuvcaz5yf"
                      class="animable"></path>
                    <path
                      d="M292.23,356.74v2a.62.62,0,0,1-.31-.07L267.5,344.6a.68.68,0,0,1-.3-.53v-1.31a.68.68,0,0,1,.23-.47c-.09.09-.07.21.07.3l24.42,14.08A.53.53,0,0,0,292.23,356.74Z"
                      style="fill: rgb(230, 230, 230); transform-origin: 279.715px 350.515px;" id="elojfegntwvse"
                      class="animable"></path>
                    <path
                      d="M312.07,344a1.24,1.24,0,0,0-1.27.07,4.35,4.35,0,0,0-1.72,2.56l.41.06A4,4,0,0,1,311,344.4a1.1,1.1,0,0,1,.53-.16.53.53,0,0,1,.31.09,1.56,1.56,0,0,1,.5,1.42,4.37,4.37,0,0,1-1.7,3.36,1,1,0,0,1-.63.15l-.45.26,0,0a1,1,0,0,0,.53.14,1.51,1.51,0,0,0,.73-.21,4.76,4.76,0,0,0,1.91-3.71A2,2,0,0,0,312.07,344Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 310.912px 346.759px;" id="el6bnd5g52eqn"
                      class="animable"></path>
                    <path
                      d="M267.2,341.61a.5.5,0,0,0,.25.39L292,356.15a.51.51,0,0,0,.48,0l22-13.44v-.48l-25-14.45-22,13.45A.49.49,0,0,0,267.2,341.61Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 290.84px 341.995px;" id="eljuujixuxo4"
                      class="animable"></path>
                    <g id="eleqb7q82e77r">
                      <path
                        d="M292.23,355.72v.49a.51.51,0,0,1-.25-.06L267.45,342a.5.5,0,0,1-.25-.39.52.52,0,0,1,.25-.39.15.15,0,0,0,0,.29L292,355.67A.51.51,0,0,0,292.23,355.72Z"
                        style="opacity: 0.1; transform-origin: 279.715px 348.715px;" class="animable"></path>
                    </g>
                    <path d="M314.47,342.23l-22,13.44a.65.65,0,0,1-.5,0l-24.53-14.16a.15.15,0,0,1,0-.29l22-13.44Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 290.899px 341.75px;" id="elk18tqy4axc"
                      class="animable"></path>
                    <g id="elhu6z159u82e">
                      <path d="M314.47,342.23v.48l-22,13.44a.42.42,0,0,1-.25.06v-.49a.51.51,0,0,0,.25-.05Z"
                        style="opacity: 0.2; transform-origin: 303.345px 349.221px;" class="animable"></path>
                    </g>
                    <polygon points="314.47 348.63 314.47 342.24 314.13 342.46 314.13 348.82 314.47 348.63"
                      style="fill: rgb(38, 50, 56); transform-origin: 314.3px 345.53px;" id="elmbl9ptxm2ff"
                      class="animable"></polygon>
                    <g id="el8dlifbhwzmj">
                      <polygon points="314.47 348.63 314.47 342.24 314.13 342.46 314.13 348.82 314.47 348.63"
                        style="opacity: 0.2; transform-origin: 314.3px 345.53px;" class="animable"></polygon>
                    </g>
                    <path
                      d="M313.67,342.13a.4.4,0,0,0,.24-.33v-.49l-24.13-13.63a1.29,1.29,0,0,0-1.12,0L267,340.21l25,14.43Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 290.455px 341.096px;" id="elkyma32selsn"
                      class="animable"></path>
                    <g id="ele9yyn7u7sb">
                      <path
                        d="M313.67,342.13a.4.4,0,0,0,.24-.33v-.49l-24.13-13.63a1.29,1.29,0,0,0-1.12,0L267,340.21l25,14.43Z"
                        style="opacity: 0.2; transform-origin: 290.455px 341.096px;" class="animable"></path>
                    </g>
                    <path d="M313.67,341.64a.34.34,0,0,0,0-.65L289.78,327.2a1.23,1.23,0,0,0-1.12,0L267,339.72l25,14.44Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 290.455px 340.613px;" id="el331raw00yly"
                      class="animable"></path>
                    <g id="elbqiimms2o9h">
                      <path
                        d="M313.67,341.64a.34.34,0,0,0,0-.65L289.78,327.2a1.23,1.23,0,0,0-1.12,0L267,339.72l25,14.44Z"
                        style="opacity: 0.5; transform-origin: 290.455px 340.613px;" class="animable"></path>
                    </g>
                    <path
                      d="M272,336.45,288,327.18a1.23,1.23,0,0,1,1.12,0l22,12.73,2.09-1.22v2.47l0,0c.07.15,0,.32-.19.44l-18.39,10.61-25-14.44v-2.7Z"
                      style="fill: rgb(235, 235, 235); transform-origin: 291.433px 339.628px;" id="el19blwrv53l7"
                      class="animable"></path>
                    <path d="M313,338.92c.31-.18.31-.47,0-.64l-23.9-13.8a1.23,1.23,0,0,0-1.12,0l-18.4,10.62,25,14.43Z"
                      style="fill: rgb(250, 250, 250); transform-origin: 291.406px 336.938px;" id="elbhb85o87to"
                      class="animable"></path>
                    <polygon points="294.65 349.54 294.65 352.24 269.62 337.8 269.62 335.1 294.65 349.54"
                      style="fill: rgb(230, 230, 230); transform-origin: 282.135px 343.67px;" id="el0rkqs439e33e"
                      class="animable"></polygon>
                    <path
                      d="M294.35,348.48a.74.74,0,0,0,.21.07.53.53,0,0,0,.33,0,.17.17,0,0,0,.1,0c.17-.09.15-.26,0-.37a.75.75,0,0,0-.29-.09.65.65,0,0,0-.35.06s0,0,0,0S294.17,348.38,294.35,348.48Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 294.69px 348.331px;" id="elpn80oejmgko"
                      class="animable"></path>
                    <path
                      d="M291.52,350.59a1.46,1.46,0,0,0,.28.94,1,1,0,0,0,.81.38h0a1.59,1.59,0,0,0,.78-.23l.14-.09-.31-.18c-.77.43-1.38.07-1.38-.82a3.06,3.06,0,0,1,1.39-2.4.91.91,0,0,1,1-.05.72.72,0,0,1,.29.41.53.53,0,0,0,.33,0,1.24,1.24,0,0,0-.23-.49,1,1,0,0,0-.81-.37,1.51,1.51,0,0,0-.78.23A3.37,3.37,0,0,0,291.52,350.59Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 293.184px 349.8px;" id="elwmpozpir7x"
                      class="animable"></path>
                    <path d="M292.32,348l21.59-10.55v.36a.64.64,0,0,1-.28.48l-21.31,10.2Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 303.115px 342.97px;" id="elhzx7ad6zt6p"
                      class="animable"></path>
                    <g id="elnwmnus3h5d">
                      <path d="M292.32,348l21.59-10.55v.36a.64.64,0,0,1-.28.48l-21.31,10.2Z"
                        style="opacity: 0.2; transform-origin: 303.115px 342.97px;" class="animable"></path>
                    </g>
                    <path d="M313.67,337.81a.34.34,0,0,0,0-.64l-23.89-13.8a1.23,1.23,0,0,0-1.12,0L267,333.78l25,14.44Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 290.448px 335.728px;" id="el7ffpp1amlee"
                      class="animable"></path>
                    <polygon points="292 354.64 266.97 340.2 266.97 333.77 292 348.22 292 354.64"
                      style="fill: rgb(38, 50, 56); transform-origin: 279.485px 344.205px;" id="elhfv659y15c6"
                      class="animable"></polygon>
                    <g id="eljt8g3ws5j0q">
                      <polygon points="292 354.64 266.97 340.2 266.97 333.77 292 348.22 292 354.64"
                        style="opacity: 0.1; transform-origin: 279.485px 344.205px;" class="animable"></polygon>
                    </g>
                    <path
                      d="M287.06,350.52a1,1,0,0,0,.81-.38,1.54,1.54,0,0,0,.28-.94,3.41,3.41,0,0,0-1.55-2.69,1.62,1.62,0,0,0-.78-.23c-.66,0-1.1.53-1.1,1.32a3.42,3.42,0,0,0,1.56,2.69,1.62,1.62,0,0,0,.78.23Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 286.435px 348.4px;" id="eldaopugi62d6"
                      class="animable"></path>
                    <path
                      d="M287.83,349.2c0,.89-.62,1.25-1.39.81a3.09,3.09,0,0,1-1.39-2.41c0-.89.62-1.25,1.39-.8A3.06,3.06,0,0,1,287.83,349.2Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 286.44px 348.402px;" id="el1ke6losd7bg"
                      class="animable"></path>
                    <path
                      d="M282.78,346v.48c0,1-.68,1.37-1.52.88l-10.85-6.26a3.39,3.39,0,0,1-1.53-2.64V338c0-1,.69-1.37,1.53-.88l10.85,6.26A3.38,3.38,0,0,1,282.78,346Z"
                      style="fill: rgb(245, 245, 245); transform-origin: 275.83px 342.24px;" id="el3x8mwyjq0q8"
                      class="animable"></path>
                    <polygon points="292.33 354.45 292.33 348.06 292 348.22 292 354.64 292.33 354.45"
                      style="fill: rgb(38, 50, 56); transform-origin: 292.165px 351.35px;" id="elsix2uhj6pxo"
                      class="animable"></polygon>
                    <g id="elk9g9b755gt">
                      <polygon points="292.33 354.45 292.33 348.06 292 348.22 292 354.64 292.33 354.45"
                        style="opacity: 0.2; transform-origin: 292.165px 351.35px;" class="animable"></polygon>
                    </g>
                  </g>
                  <g id="freepik--Coffee--inject-85" class="animable" style="transform-origin: 269.352px 277.553px;">
                    <g id="freepik--shadow--inject-85">
                      <path
                        d="M273.51,282.39c2.36,1.3,2.36,3.42,0,4.73a9.79,9.79,0,0,1-8.55,0c-2.36-1.31-2.36-3.43,0-4.73A9.79,9.79,0,0,1,273.51,282.39Z"
                        style="opacity: 0.1; transform-origin: 269.235px 284.755px;" class="animable"></path>
                    </g>
                    <path d="M265,284.56c.67-.91,2.4-1.56,4.44-1.59h-.15C267.29,283,265.58,283.64,265,284.56Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 267.22px 283.765px;" id="el9mwzbjsyjh"
                      class="animable"></path>
                    <g id="freepik--coffee--inject-85" class="animable" style="transform-origin: 269.382px 276.913px;">
                      <path
                        d="M265.57,274.65a12.44,12.44,0,0,1,7.52.2c2,.83,2,2.09-.07,2.81a12.42,12.42,0,0,1-7.53-.19C263.4,276.64,263.43,275.38,265.57,274.65Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 269.262px 276.159px;" id="elujijsx55w8"
                        class="animable"></path>
                      <g id="el3uj67aaoopl">
                        <g style="opacity: 0.3; transform-origin: 269.262px 276.159px;" class="animable">
                          <path
                            d="M265.57,274.65a12.44,12.44,0,0,1,7.52.2c2,.83,2,2.09-.07,2.81a12.42,12.42,0,0,1-7.53-.19C263.4,276.64,263.43,275.38,265.57,274.65Z"
                            id="el9lagfbv0upr" class="animable" style="transform-origin: 269.262px 276.159px;"></path>
                        </g>
                      </g>
                      <path
                        d="M264,272.05l10.84.29-1.15,12.75h0c-.07.46-.51.91-1.35,1.24a9.56,9.56,0,0,1-6.5-.16c-.85-.38-1.29-.85-1.33-1.32h0Z"
                        style="fill: rgb(250, 250, 250); transform-origin: 269.42px 279.436px;" id="elq3p0k4mkrms"
                        class="animable"></path>
                      <path
                        d="M274.79,272.34l-.24,2.59a4.53,4.53,0,0,1-.91.46,13.21,13.21,0,0,1-8.64-.22l-.28-.14a5.36,5.36,0,0,1-.67-.4l-.1-2.58Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 269.37px 274.03px;" id="elbnhawjdg2bg"
                        class="animable"></path>
                      <path
                        d="M263.25,272.41l.05-2,1.27,0a3.63,3.63,0,0,1,.56-.24,13.15,13.15,0,0,1,8.63.22c.2.09.37.18.53.27l1.22,0-.05,2h0c0,.64-.62,1.26-1.8,1.72a13.11,13.11,0,0,1-8.63-.23C263.83,273.7,263.24,273,263.25,272.41Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 269.38px 272.274px;" id="el7z1gxvz7fwl"
                        class="animable"></path>
                      <g id="eloxid350oh1l">
                        <g style="opacity: 0.2; transform-origin: 269.38px 272.274px;" class="animable">
                          <path
                            d="M263.25,272.41l.05-2,1.27,0a3.63,3.63,0,0,1,.56-.24,13.15,13.15,0,0,1,8.63.22c.2.09.37.18.53.27l1.22,0-.05,2h0c0,.64-.62,1.26-1.8,1.72a13.11,13.11,0,0,1-8.63-.23C263.83,273.7,263.24,273,263.25,272.41Z"
                            id="elow83vrie1bj" class="animable" style="transform-origin: 269.38px 272.274px;"></path>
                        </g>
                      </g>
                      <path
                        d="M265.17,268.75a13.15,13.15,0,0,1,8.63.22c2.32,1,2.28,2.6-.09,3.51a13.18,13.18,0,0,1-8.63-.22C262.68,271.23,262.72,269.65,265.17,268.75Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 269.41px 270.614px;" id="elasswzfy4xqb"
                        class="animable"></path>
                      <path
                        d="M264.44,270h0l.44-1.6,3.1.08a12.2,12.2,0,0,1,3.08.08l3,.07.35,1.62h0c.17.59-.3,1.19-1.45,1.61a11.28,11.28,0,0,1-7.12-.18C264.69,271.22,264.22,270.6,264.44,270Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 269.416px 270.375px;" id="elcvtahzfbfid"
                        class="animable"></path>
                      <g id="el73xcivl3i4d">
                        <path
                          d="M264.44,270h0l.44-1.6,3.1.08a12.2,12.2,0,0,1,3.08.08l3,.07.35,1.62h0c.17.59-.3,1.19-1.45,1.61a11.28,11.28,0,0,1-7.12-.18C264.69,271.22,264.22,270.6,264.44,270Z"
                          style="opacity: 0.2; transform-origin: 269.416px 270.375px;" class="animable"></path>
                      </g>
                      <path
                        d="M266.24,267.42a11,11,0,0,1,6.54.17c1.76.71,1.73,1.8-.06,2.42a11,11,0,0,1-6.54-.17C264.36,269.12,264.39,268,266.24,267.42Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 269.458px 268.715px;" id="eluu0m2z816bc"
                        class="animable"></path>
                      <path
                        d="M265.47,268.61s0,.12.2.24a3.07,3.07,0,0,0,.74.4,9.64,9.64,0,0,0,3.07.54,9.09,9.09,0,0,0,3-.38,2.6,2.6,0,0,0,.74-.37c.15-.11.19-.2.19-.22s-.15-.34-.9-.64a9.15,9.15,0,0,0-3-.54,9.61,9.61,0,0,0-3.09.38C265.67,268.28,265.48,268.56,265.47,268.61Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 269.44px 268.715px;" id="el2xto30rxk8c"
                        class="animable"></path>
                      <g id="elznub9msxicb">
                        <g style="opacity: 0.5; transform-origin: 269.44px 268.715px;" class="animable">
                          <path
                            d="M265.47,268.61s0,.12.2.24a3.07,3.07,0,0,0,.74.4,9.64,9.64,0,0,0,3.07.54,9.09,9.09,0,0,0,3-.38,2.6,2.6,0,0,0,.74-.37c.15-.11.19-.2.19-.22s-.15-.34-.9-.64a9.15,9.15,0,0,0-3-.54,9.61,9.61,0,0,0-3.09.38C265.67,268.28,265.48,268.56,265.47,268.61Z"
                            id="el47ifgkms6ri" class="animable" style="transform-origin: 269.44px 268.715px;"></path>
                        </g>
                      </g>
                      <path
                        d="M265.67,268.85a3.07,3.07,0,0,0,.74.4,9.64,9.64,0,0,0,3.07.54,9.09,9.09,0,0,0,3-.38,2.6,2.6,0,0,0,.74-.37,2.84,2.84,0,0,0-.72-.4,9.15,9.15,0,0,0-3-.54,9.33,9.33,0,0,0-3.09.39A2.69,2.69,0,0,0,265.67,268.85Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 269.445px 268.945px;" id="elvpcfqkbaib"
                        class="animable"></path>
                      <g id="el7d0mc8quq76">
                        <g style="opacity: 0.2; transform-origin: 269.445px 268.945px;" class="animable">
                          <path
                            d="M265.67,268.85a3.07,3.07,0,0,0,.74.4,9.64,9.64,0,0,0,3.07.54,9.09,9.09,0,0,0,3-.38,2.6,2.6,0,0,0,.74-.37,2.84,2.84,0,0,0-.72-.4,9.15,9.15,0,0,0-3-.54,9.33,9.33,0,0,0-3.09.39A2.69,2.69,0,0,0,265.67,268.85Z"
                            id="el4kujyf1azlo" class="animable" style="transform-origin: 269.445px 268.945px;"></path>
                        </g>
                      </g>
                      <g id="elh4byzv8ipg">
                        <g style="opacity: 0.5; transform-origin: 267.263px 269.071px;" class="animable">
                          <path
                            d="M267.51,268.94a1,1,0,0,0-.73-.16c-.13.07,0,.26.24.42a.93.93,0,0,0,.72.16C267.87,269.28,267.77,269.09,267.51,268.94Z"
                            id="els5l03hptbed" class="animable" style="transform-origin: 267.263px 269.071px;"></path>
                        </g>
                      </g>
                      <path
                        d="M274.16,281c0,.48-.51.95-1.48,1.29a11.69,11.69,0,0,1-7.09-.18c-1-.39-1.47-.88-1.46-1.36l-.19-4.7c0,.51.51,1,1.55,1.45a12.42,12.42,0,0,0,7.53.19c1-.36,1.55-.86,1.57-1.36Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 269.265px 279.402px;" id="elc7cbkvc3vmh"
                        class="animable"></path>
                      <path
                        d="M270.84,281.16a5.4,5.4,0,0,0,.44-.78,2.44,2.44,0,0,1,1.26-1.05.16.16,0,0,1,.19.08,1.84,1.84,0,0,1-2.35,2.25.06.06,0,0,1,0-.09A1.49,1.49,0,0,0,270.84,281.16Z"
                        style="fill: rgb(55, 71, 79); transform-origin: 271.58px 280.538px;" id="elffcwdfj3szj"
                        class="animable"></path>
                      <path
                        d="M272.25,279.18a2.57,2.57,0,0,0-.79.45,2.65,2.65,0,0,0-.58.75,2.3,2.3,0,0,1-.72.92.16.16,0,0,1-.21,0,1.61,1.61,0,0,1,.42-2,1.65,1.65,0,0,1,1.9-.38A.15.15,0,0,1,272.25,279.18Z"
                        style="fill: rgb(55, 71, 79); transform-origin: 271.052px 280.054px;" id="elmi6qsmowqz"
                        class="animable"></path>
                    </g>
                  </g>
                  <g id="eljhrxnt8k72">
                    <g style="opacity: 0.1; transform-origin: 239.362px 345.465px;" class="animable">
                      <path
                        d="M259.26,344.11l-22.2,12.82a1.38,1.38,0,0,1-1.25,0l-16.35-9.44a.38.38,0,0,1,0-.72L241.67,334a1.38,1.38,0,0,1,1.25,0l16.34,9.44C259.61,343.58,259.61,343.91,259.26,344.11Z"
                        id="el09xyyvkhjv08" class="animable" style="transform-origin: 239.362px 345.465px;"></path>
                    </g>
                  </g>
                  <path
                    d="M259.26,343.16,237.06,356a1.38,1.38,0,0,1-1.25,0l-16.35-9.43a.38.38,0,0,1,0-.72L241.67,333a1.38,1.38,0,0,1,1.25,0l16.34,9.44C259.61,342.64,259.61,343,259.26,343.16Z"
                    style="fill: rgb(235, 235, 235); transform-origin: 239.362px 344.5px;" id="elxavk42icdq9"
                    class="animable"></path>
                  <path
                    d="M242.92,333l15.52,9-21.38,12.35a1.38,1.38,0,0,1-1.25,0l-15.52-9L241.67,333A1.38,1.38,0,0,1,242.92,333Z"
                    style="fill: rgb(224, 224, 224); transform-origin: 239.365px 343.675px;" id="ellu9ee4xigso"
                    class="animable"></path>
                  <path
                    d="M259.26,340.9l-22.2,12.83a1.44,1.44,0,0,1-1.25,0l-16.35-9.44a.38.38,0,0,1,0-.72l22.21-12.82a1.38,1.38,0,0,1,1.25,0l16.34,9.43C259.61,340.38,259.61,340.7,259.26,340.9Z"
                    style="fill: rgb(250, 250, 250); transform-origin: 239.362px 342.236px;" id="eld3ps5jxvxb7"
                    class="animable"></path>
                  <g id="freepik--Cup--inject-85" class="animable" style="transform-origin: 235.459px 311.183px;">
                    <g id="elgm5s33fwsvn">
                      <g style="opacity: 0.1; transform-origin: 233.694px 318.013px;" class="animable">
                        <path
                          d="M238.69,315.8c2.77,1.17,2.79,3.11,0,4.33a14.23,14.23,0,0,1-10,.09c-2.76-1.17-2.78-3.11,0-4.33A14.31,14.31,0,0,1,238.69,315.8Z"
                          id="elypk4371l5v" class="animable" style="transform-origin: 233.694px 318.013px;"></path>
                      </g>
                    </g>
                    <path
                      d="M239.9,315.88a3.43,3.43,0,0,0,1.86-.21c.75-.33,1.21-1.23,1.74-2.68.45-1.23,1.18-4.73.66-5.61-.79-1.35-2.48-1.15-3.87-1.11h-.48l0,1.7h.52c.78,0,2.09-.05,2.3.38.33.84-.64,5.33-1.33,5.81a3.42,3.42,0,0,1-2,0l-.6,1.48A5.26,5.26,0,0,0,239.9,315.88Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 241.52px 311.081px;" id="elc9nkcijg4a5"
                      class="animable"></path>
                    <g id="elnxmf2fpzk">
                      <g style="opacity: 0.15; transform-origin: 241.52px 311.081px;" class="animable">
                        <path
                          d="M239.9,315.88a3.43,3.43,0,0,0,1.86-.21c.75-.33,1.21-1.23,1.74-2.68.45-1.23,1.18-4.73.66-5.61-.79-1.35-2.48-1.15-3.87-1.11h-.48l0,1.7h.52c.78,0,2.09-.05,2.3.38.33.84-.64,5.33-1.33,5.81a3.42,3.42,0,0,1-2,0l-.6,1.48A5.26,5.26,0,0,0,239.9,315.88Z"
                          id="elg6spehli3ea" class="animable" style="transform-origin: 241.52px 311.081px;"></path>
                      </g>
                    </g>
                    <path
                      d="M240.74,304c-.17-.68-.85-1.33-2.05-1.84a14.31,14.31,0,0,0-10,.09c-1.19.53-1.86,1.2-2,1.87h0c-.43,4.47.41,9.62,2,12.47l0,.05,0,.05h0a3.45,3.45,0,0,0,1.31,1.21,8.38,8.38,0,0,0,7.57-.06,3.43,3.43,0,0,0,1.29-1.24h0a.05.05,0,0,1,0,0l0-.07c1.56-2.87,2.31-8,1.8-12.49Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 233.698px 310.038px;" id="el8bw0bzopnzp"
                      class="animable"></path>
                    <g id="elsk738wdk7e">
                      <g style="opacity: 0.4; transform-origin: 233.694px 304.354px;" class="animable">
                        <path
                          d="M238.69,302.14c2.77,1.18,2.79,3.12,0,4.34a14.34,14.34,0,0,1-10,.09c-2.76-1.17-2.78-3.11,0-4.34A14.31,14.31,0,0,1,238.69,302.14Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 233.694px 304.354px;" id="el7ozz93ym839"
                          class="animable"></path>
                      </g>
                    </g>
                    <path
                      d="M237.74,302.9c2.23.77,2.24,2,0,2.84a14.14,14.14,0,0,1-8,.07c-2.23-.76-2.24-2,0-2.83A14.05,14.05,0,0,1,237.74,302.9Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 233.74px 304.355px;" id="elsh91a4xe9v"
                      class="animable"></path>
                    <g id="el2rrbenzwru4">
                      <g style="opacity: 0.1; transform-origin: 233.74px 304.355px;" class="animable">
                        <path
                          d="M237.74,302.9c2.23.77,2.24,2,0,2.84a14.14,14.14,0,0,1-8,.07c-2.23-.76-2.24-2,0-2.83A14.05,14.05,0,0,1,237.74,302.9Z"
                          id="elkqyxxctfr5" class="animable" style="transform-origin: 233.74px 304.355px;"></path>
                      </g>
                    </g>
                    <path
                      d="M237.75,304.62a4,4,0,0,1,1.12.55,4.53,4.53,0,0,1-1.11.57,14.14,14.14,0,0,1-8,.07,4,4,0,0,1-1.12-.55,4.08,4.08,0,0,1,1.11-.57A14.05,14.05,0,0,1,237.75,304.62Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 233.755px 305.213px;" id="elgaxgisdgz2"
                      class="animable"></path>
                  </g>
                  <g id="freepik--Document--inject-85" class="animable" style="transform-origin: 144.743px 291.237px;">
                    <g id="elp4ymh0v74up">
                      <g style="opacity: 0.2; transform-origin: 144.743px 291.778px;" class="animable">
                        <path
                          d="M120.29,294a.15.15,0,0,0,.08.21l20.13,11.63a.51.51,0,0,0,.25.05.4.4,0,0,0,.25-.05l28.1-16.23a.16.16,0,0,0,.09-.09.12.12,0,0,0,0-.14l0,0,0,0L149,277.73a.5.5,0,0,0-.5,0L120.37,294l0,0h0a.12.12,0,0,0-.07,0Z"
                          id="elthfxyci0hjh" class="animable" style="transform-origin: 144.743px 291.778px;"></path>
                      </g>
                    </g>
                    <g id="freepik--List--inject-85" class="animable" style="transform-origin: 144.516px 290.655px;">
                      <path
                        d="M168.15,288.21v.48a.53.53,0,0,1-.24.42L141,304.67a.51.51,0,0,1-.48,0l-19.32-11.15a.52.52,0,0,1-.24-.41v-.49a.52.52,0,0,1,.24-.41l27-15.57a.51.51,0,0,1,.48,0l19.31,11.15A.51.51,0,0,1,168.15,288.21Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 144.556px 290.655px;" id="elh84r312t9v6"
                        class="animable"></path>
                      <g id="elqml1lvuqa8p">
                        <path
                          d="M121.13,292.23c-.1.07-.09.18,0,.25l19.32,11.15a.44.44,0,0,0,.23.06v1a.45.45,0,0,1-.24-.06l-19.32-11.15a.52.52,0,0,1-.24-.41v-.49A.51.51,0,0,1,121.13,292.23Z"
                          style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 130.78px 298.46px;"
                          class="animable"></path>
                      </g>
                      <g id="elu2pdmvhwfua">
                        <path
                          d="M168,287.82h0l0,0h0a.52.52,0,0,1,.12.26v.54a.57.57,0,0,1-.24.42l-27,15.56a.5.5,0,0,1-.24.06v-1a.51.51,0,0,0,.25-.06l27-15.56a.28.28,0,0,0,.09-.1.16.16,0,0,0,0-.13Z"
                          style="opacity: 0.15; transform-origin: 154.38px 296.235px;" class="animable"></path>
                      </g>
                      <path
                        d="M160.85,281c0-.18-.1-.36-.39-.53a1.82,1.82,0,0,0-.86-.23h-.08a14.76,14.76,0,0,0-2.2.45h0a5.08,5.08,0,0,1-1.89-.21h-.54a5.83,5.83,0,0,1-1.22,0c-.32,0-.56,0-.74,0h-.07a.86.86,0,0,0-.54.11l-1.08.62v.36l8.09,4.67,1.08-.62a.32.32,0,0,0,.18-.33v-.35a1.4,1.4,0,0,0-.09-.46,2,2,0,0,1-.06-.27,1.38,1.38,0,0,0,0-.26v-.36a.69.69,0,0,0,0-.13c-.06-.18-.31-.37-.39-.65l0-.09c.17-.39.78-.85.77-1.28C160.85,281.25,160.86,281,160.85,281Zm-1.66,1a2.07,2.07,0,0,1-.58.23,1.59,1.59,0,0,1-1.1-.09.53.53,0,0,1-.2-.19,1.12,1.12,0,0,1,.44-.42,2,2,0,0,1,1.48-.22l.2.08a.53.53,0,0,1,.2.19A1,1,0,0,1,159.19,282Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 156.047px 283.24px;" id="elct59ie0t1yi"
                        class="animable"></path>
                      <path
                        d="M152.3,280.46l-1.08.62,8.09,4.67,1.08-.62c.14-.08.28-.19.09-.78s0-.75,0-1-.6-.55-.36-1.1,1.36-1.24.38-1.81a1.82,1.82,0,0,0-.86-.23h-.08a14.76,14.76,0,0,0-2.2.45h0a5.08,5.08,0,0,1-1.89-.21h-.54a5.83,5.83,0,0,1-1.22,0c-.32,0-.56,0-.74,0h-.07A.86.86,0,0,0,152.3,280.46Zm6.67,4.18a.52.52,0,0,1,.45,0c.1.06.07.17-.07.25a.47.47,0,0,1-.44,0C158.8,284.84,158.83,284.72,159,284.64Zm-1.22-3.49a2,2,0,0,1,1.48-.22l.2.08c.4.23.29.67-.24,1a2.07,2.07,0,0,1-.58.23,1.59,1.59,0,0,1-1.1-.09C157.11,281.89,157.22,281.46,157.75,281.15Zm-5-.11a.5.5,0,0,1,.44,0c.11.06.08.18-.06.26a.52.52,0,0,1-.45,0C152.56,281.23,152.59,281.12,152.73,281Z"
                        style="fill: rgb(55, 71, 79); transform-origin: 156.058px 282.98px;" id="elx2w9uhj72f"
                        class="animable"></path>
                      <path
                        d="M141.46,301.94l-16.8-9.7a.33.33,0,0,1-.15-.25v-.19a.33.33,0,0,1,.15-.25l22.2-12.82a.37.37,0,0,1,.29,0L164,288.44a.32.32,0,0,1,.14.24v.19a.34.34,0,0,1-.14.25l-22.21,12.82A.3.3,0,0,1,141.46,301.94Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 144.325px 290.345px;" id="ela5rkfzsyh0s"
                        class="animable"></path>
                      <path
                        d="M124.62,291.58s0,.1,0,.14l16.8,9.7a.25.25,0,0,0,.15,0V302a.37.37,0,0,1-.15,0l-16.8-9.7a.3.3,0,0,1-.14-.25v-.19A.36.36,0,0,1,124.62,291.58Z"
                        style="fill: rgb(250, 250, 250); transform-origin: 133.025px 296.794px;" id="el96l4szi8zmq"
                        class="animable"></path>
                      <path
                        d="M164,288.46l0,0,0,0a.2.2,0,0,1,0,.08s0,0,0,0v.22a.35.35,0,0,1-.14.25l-22.21,12.82a.32.32,0,0,1-.14,0v-.52a.32.32,0,0,0,.14,0L164,288.6C164,288.56,164,288.5,164,288.46Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 152.757px 295.149px;" id="elh44pwk356uh"
                        class="animable"></path>
                      <path
                        d="M145.44,281.69l-.2.11a.12.12,0,0,0,0,.22l13.49,7.79a.39.39,0,0,0,.39,0l.19-.11c.11-.06.11-.16,0-.22l-13.49-7.79A.42.42,0,0,0,145.44,281.69Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 152.28px 285.753px;" id="eln9haw4g81p"
                        class="animable"></path>
                      <path
                        d="M144.26,282.37l-.19.11c-.11.06-.11.16,0,.22l13.49,7.79a.37.37,0,0,0,.38,0l.2-.11a.12.12,0,0,0,0-.22l-13.5-7.79A.42.42,0,0,0,144.26,282.37Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 151.1px 286.434px;" id="elroslv1486nl"
                        class="animable"></path>
                      <path
                        d="M143.09,283.05l-.2.11a.12.12,0,0,0,0,.22l13.49,7.79a.45.45,0,0,0,.39,0l.19-.11c.11-.06.11-.16,0-.22l-13.49-7.79A.42.42,0,0,0,143.09,283.05Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 149.93px 287.109px;" id="elh9ozie76pjv"
                        class="animable"></path>
                      <path
                        d="M140.49,284.55l-.19.11c-.11.06-.11.16,0,.22l13.49,7.79a.42.42,0,0,0,.38,0l.2-.11a.12.12,0,0,0,0-.22l-13.5-7.79A.42.42,0,0,0,140.49,284.55Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 147.33px 288.61px;" id="eldten4cwqkjv"
                        class="animable"></path>
                      <path
                        d="M139.31,285.23l-.19.11c-.11.06-.11.16,0,.22l13.49,7.79a.42.42,0,0,0,.38,0l.2-.11a.12.12,0,0,0,0-.22l-13.49-7.79A.45.45,0,0,0,139.31,285.23Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 146.15px 289.29px;" id="el7lxt9egf0c5"
                        class="animable"></path>
                      <path
                        d="M138.14,285.9l-.2.12a.12.12,0,0,0,0,.22l13.5,7.79a.42.42,0,0,0,.38,0l.19-.11c.11-.07.11-.17,0-.23l-13.49-7.79A.42.42,0,0,0,138.14,285.9Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 144.98px 289.965px;" id="elyr1g7ievyhh"
                        class="animable"></path>
                      <path
                        d="M135.54,287.4l-.19.12c-.11.06-.11.16,0,.22l13.49,7.79a.42.42,0,0,0,.38,0l.2-.12a.12.12,0,0,0,0-.22l-13.49-7.79A.45.45,0,0,0,135.54,287.4Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 142.38px 291.465px;" id="el23vwvyrfjn7"
                        class="animable"></path>
                      <path
                        d="M134.36,288.08l-.19.12c-.11.06-.11.16,0,.22l13.49,7.79a.42.42,0,0,0,.38,0l.2-.11c.11-.07.11-.17,0-.23l-13.49-7.79A.45.45,0,0,0,134.36,288.08Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 141.205px 292.146px;" id="elj0q0dky8u4"
                        class="animable"></path>
                      <path
                        d="M133.19,288.76l-.19.11c-.11.07-.11.16,0,.23l13.49,7.79a.42.42,0,0,0,.38,0l.2-.12a.12.12,0,0,0,0-.22l-13.49-7.79A.44.44,0,0,0,133.19,288.76Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 140.03px 292.825px;" id="el6p1695658wc"
                        class="animable"></path>
                      <path
                        d="M157.85,285.4l-1.2-.94a.72.72,0,0,1-.06-.1s0,0,0,0l.29-.27.93-.85a.23.23,0,0,0,.09-.18v-.36a.37.37,0,0,0-.11-.24,1,1,0,0,1-.19-.46.81.81,0,0,1,.22-.43,1,1,0,0,0,.34-.92,1,1,0,0,0-.59-1.07,2.22,2.22,0,0,0-.92-.22h0a2.19,2.19,0,0,0-1.38.49,1.72,1.72,0,0,1-.89.34,2.89,2.89,0,0,1-.82,0,.68.68,0,0,0-.19,0h0a.5.5,0,0,0-.38.12l-.8.74-.3.27v0a.76.76,0,0,1-.68.09c-.44-.18-.65-.29-1.37-.61a1.58,1.58,0,0,0-.65-.14h0a2.16,2.16,0,0,0-1,.24v.36l9.9,5.72a.82.82,0,0,0,.19-.5v-.36A1,1,0,0,0,157.85,285.4Zm-2-5a1.32,1.32,0,0,1,1.29-.22.35.35,0,0,1,.14.06.66.66,0,0,1,.35.37.79.79,0,0,1-.19.27,1.13,1.13,0,0,1-.4.23,1.38,1.38,0,0,1-1-.06.77.77,0,0,1-.35-.37A.73.73,0,0,1,155.81,280.4Z"
                        style="fill: rgb(55, 71, 79); transform-origin: 153.235px 283.17px;" id="elx21erm250ro"
                        class="animable"></path>
                      <path
                        d="M148.17,280.89l9.9,5.72c.27-.37.3-.75-.22-1.21l-1.2-.94s-.26-.29,0-.49l.29-.27.93-.85s.21-.15,0-.42a1,1,0,0,1,0-1.24,1,1,0,0,0-.25-1.64,2.22,2.22,0,0,0-.92-.22h0a2.19,2.19,0,0,0-1.38.49,1.72,1.72,0,0,1-.89.34,2.89,2.89,0,0,1-.82,0,.68.68,0,0,0-.19,0h0a.5.5,0,0,0-.38.12l-.8.74-.3.27v0a.76.76,0,0,1-.68.09c-.44-.18-.65-.29-1.37-.61a1.58,1.58,0,0,0-.65-.14h0A2.16,2.16,0,0,0,148.17,280.89Zm8.93-1.07a.35.35,0,0,1,.14.06.58.58,0,0,1,.16,1,1.13,1.13,0,0,1-.4.23,1.38,1.38,0,0,1-1-.06.58.58,0,0,1-.15-1A1.32,1.32,0,0,1,157.1,279.82Z"
                        style="fill: rgb(69, 90, 100); transform-origin: 153.215px 282.97px;" id="elnjaplhidlb"
                        class="animable"></path>
                    </g>
                  </g>
                  <g id="freepik--laptop--inject-85" class="animable" style="transform-origin: 184.616px 301.64px;">
                    <path
                      d="M211.58,320a1.82,1.82,0,0,1-.86,1.43L192,332.28a1.93,1.93,0,0,1-1.72,0l-33-19a1.62,1.62,0,0,1,0-2.86L176,299.57a1.87,1.87,0,0,1,1.72,0l33,19A1.82,1.82,0,0,1,211.58,320Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 184.001px 315.921px;" id="elc2oczz12olj"
                      class="animable"></path>
                    <path
                      d="M210.72,319.6,192,330.41a1.87,1.87,0,0,1-1.72,0l-33-19c-.47-.27-.47-.71,0-1L176,299.57a1.87,1.87,0,0,1,1.72,0l33,19A.52.52,0,0,1,210.72,319.6Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 184.048px 314.99px;" id="elpl31fipb3"
                      class="animable"></path>
                    <path
                      d="M191.13,330.62v1.86a1.71,1.71,0,0,0,.86-.2l18.73-10.82a1.82,1.82,0,0,0,.86-1.43,1.86,1.86,0,0,0-.77-1.37c.39.28.36.68-.09.94L192,330.42A1.82,1.82,0,0,1,191.13,330.62Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 201.355px 325.57px;" id="el6c2lc84mh8h"
                      class="animable"></path>
                    <path
                      d="M212.39,318.64c.45-.26.42-.69.42-1.24V291.53A1.88,1.88,0,0,0,212,290l-33-19a1.82,1.82,0,0,0-1.67,0c-.44.25-.42.69-.42,1.24v25.87a1.94,1.94,0,0,0,.86,1.49l33,19A1.89,1.89,0,0,0,212.39,318.64Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 194.86px 294.8px;" id="elyl369kn304s"
                      class="animable"></path>
                    <path
                      d="M176.88,272.21c0-.55.39-.77.86-.5l33,19a1.71,1.71,0,0,1,.61.64l1.23-.71h0A1.71,1.71,0,0,0,212,290l-33-19a1.8,1.8,0,0,0-1.66,0C176.86,271.22,176.88,271.66,176.88,272.21Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 194.73px 281.074px;" id="elifhh3v2znt"
                      class="animable"></path>
                    <path
                      d="M210.82,318.66a1.87,1.87,0,0,0,1.57,0c.44-.26.42-.69.42-1.24V291.53a1.7,1.7,0,0,0-.25-.85l-1.23.71h0a1.73,1.73,0,0,1,.25.85v25.87C211.58,318.62,211.25,318.85,210.82,318.66Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 211.815px 304.756px;" id="elmqc9k5w272m"
                      class="animable"></path>
                    <path
                      d="M210.26,291.74l-31.8-18.35c-.28-.16-.51,0-.51.3v22.58a1.13,1.13,0,0,0,.51.89l31.8,18.36c.28.16.52,0,.52-.3V292.64A1.18,1.18,0,0,0,210.26,291.74Z"
                      style="fill: rgb(250, 250, 250); transform-origin: 194.365px 294.455px;" id="elbyqhpnbb42n"
                      class="animable"></path>
                    <path
                      d="M208.34,318.66,177.73,301a1,1,0,0,0-.86,0l-.51.28a.26.26,0,0,0,0,.5L207,319.43a.93.93,0,0,0,.86,0l.5-.28A.26.26,0,0,0,208.34,318.66Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 192.347px 310.219px;" id="elf2dojbxdye"
                      class="animable"></path>
                    <path
                      d="M205.94,320.08l-30.61-17.67a.86.86,0,0,0-.79,0l-8,4.6c-.2.11-.17.32.07.45l30.58,17.65a.87.87,0,0,0,.78.05l8-4.58C206.21,320.42,206.18,320.22,205.94,320.08Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 186.272px 313.772px;" id="elf86bqy14pa7"
                      class="animable"></path>
                    <path
                      d="M179.55,309.84l.92-.53s0-.06,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.55A.12.12,0,0,0,179.55,309.84Zm1.13-1.93-.92.53s0,.06,0,.08l1,.56a.15.15,0,0,0,.13,0l.92-.53s0-.05,0-.08l-1-.55A.18.18,0,0,0,180.68,307.91Zm3.09,1.79-.91.53a0,0,0,0,0,0,.08l1.63.94a.15.15,0,0,0,.13,0l.92-.53s0-.05,0-.08l-1.62-.93A.14.14,0,0,0,183.77,309.7Zm-1.69-1-.92.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0l.91-.53s0-.05,0-.08l-.95-.55A.14.14,0,0,0,182.08,308.72Zm3.76,2.17-.92.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0l.91-.53s0,0,0-.08l-1-.55A.17.17,0,0,0,185.84,310.89Zm1.4.81-.92.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0l.91-.53a0,0,0,0,0,0-.08l-1-.55A.14.14,0,0,0,187.24,311.7Zm-3.32,2.17.92-.53s0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.91.52s0,.06,0,.08l1,.56A.17.17,0,0,0,183.92,313.87Zm1.4.81.92-.53s0,0,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.91.53s0,.06,0,.08l1,.56A.17.17,0,0,0,185.32,314.68Zm1.4.81.92-.53s0-.06,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.91.53s0,.06,0,.08l1,.56A.17.17,0,0,0,186.72,315.49Zm1.4.81.92-.53s0-.06,0-.08l-1-.55a.12.12,0,0,0-.13,0l-.92.53s0,.06,0,.08l1,.55A.12.12,0,0,0,188.12,316.3ZM181,310.65l.91-.53s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.55A.14.14,0,0,0,181,310.65Zm1.56,2.41.92-.53s0,0,0-.08l-.88-.51c-.05,0-.05-.06,0-.08l1.18-.68s0-.05,0-.08l-1.11-.64a.17.17,0,0,0-.14,0l-2.22,1.28s0,.06,0,.09l2.14,1.23A.14.14,0,0,0,182.52,313.06Zm6.12-.55-.92.53a0,0,0,0,0,0,.08l1,.56a.17.17,0,0,0,.14,0l.91-.53a0,0,0,0,0,0-.08l-1-.55A.14.14,0,0,0,188.64,312.51Zm1.4.81-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0l.91-.53a0,0,0,0,0,0-.08l-1-.55A.14.14,0,0,0,190,313.32Zm8.81,8.11a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.56a.17.17,0,0,0,.14,0Zm2.4-1.64-.92.53s0,.06,0,.08l1,.55a.12.12,0,0,0,.13,0l.92-.53s0-.06,0-.08l-1-.55A.12.12,0,0,0,201.25,319.79Zm-.72,1.1a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0Zm-4.65,1.4.92-.53s0-.06,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.91.53s0,.06,0,.08l1,.56A.17.17,0,0,0,195.88,322.29Zm2.32.28s0-.06,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.91.53s0,.06,0,.08l.95.56a.17.17,0,0,0,.14,0Zm1.64-3.59-.91.53s0,.06,0,.08l.95.56a.17.17,0,0,0,.14,0l.92-.53s0-.06,0-.08l-1-.55A.14.14,0,0,0,199.84,319Zm-7-4-.92.53s0,0,0,.08l1,.55a.14.14,0,0,0,.14,0l.92-.53a0,0,0,0,0,0-.08l-1-.56A.17.17,0,0,0,192.84,314.94Zm5.6,3.23-.91.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0l.92-.53s0-.06,0-.08l-1-.55A.14.14,0,0,0,198.44,318.17Zm-7-4-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0l.92-.53a0,0,0,0,0,0-.08l-1-.56A.17.17,0,0,0,191.44,314.13Zm2.8,1.62-.92.53s0,.05,0,.08l1,.55a.14.14,0,0,0,.14,0l.92-.52s0-.06,0-.08l-1-.56A.17.17,0,0,0,194.24,315.75Zm1.4.81-.91.53s0,.05,0,.08l1,.55a.17.17,0,0,0,.14,0l.92-.53s0-.05,0-.08l-1-.55A.14.14,0,0,0,195.64,316.56Zm1.4.8-.91.53a0,0,0,0,0,0,.08l1,.56a.17.17,0,0,0,.14,0l.92-.53s0-.05,0-.08l-1-.55A.17.17,0,0,0,197,317.36Zm-6.11.56.91-.53s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.55A.14.14,0,0,0,190.93,317.92Zm-13.35-11.79-.92.53s0,0,0,.08l1,.55a.17.17,0,0,0,.14,0l.92-.53s0-.06,0-.08l-1-.56A.17.17,0,0,0,177.58,306.13Zm1.69,1-.91.53s0,.05,0,.08l.95.55c.05,0,.11,0,.14,0l.92-.53s0-.05,0-.08l-1-.55A.17.17,0,0,0,179.27,307.11Zm-3.09-1.79-.92.53s0,0,0,.08l1,.55a.14.14,0,0,0,.14,0l.91-.53a0,0,0,0,0,0-.08l-1-.56A.17.17,0,0,0,176.18,305.32Zm8,7.2.92-.53a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.56A.17.17,0,0,0,184.2,312.52ZM173.86,305s0,.06,0,.08l1,.55a.14.14,0,0,0,.14,0l.91-.53a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0Zm15.67,12.07.91-.53s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.55A.14.14,0,0,0,189.53,317.11Zm-17.18-9.92.91-.53a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.56A.17.17,0,0,0,172.35,307.19Zm2.71.05.91-.53s0,0,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.56A.17.17,0,0,0,175.06,307.24Zm-2.51-1.44s0,.05,0,.08l1,.55a.17.17,0,0,0,.14,0l.91-.53s0,0,0-.08l-1-.55s-.11,0-.14,0Zm.61-.78-.95-.56a.17.17,0,0,0-.14,0l-2.23,1.28s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0l2.22-1.28S173.21,305,173.16,305Zm3.11,1.86-.92.53a0,0,0,0,0,0,.08l1,.56a.17.17,0,0,0,.14,0l.92-.53s0,0,0-.08l-1-.55A.14.14,0,0,0,176.27,306.88ZM186.81,313l-.91.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0l.92-.53a0,0,0,0,0,0-.08l-1-.55A.14.14,0,0,0,186.81,313Zm-12.15-5.5a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0Zm10.75,4.69-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0l.92-.53a0,0,0,0,0,0-.08l-1-.55A.14.14,0,0,0,185.41,312.16Zm12,8.46s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.56a.17.17,0,0,0,.14,0Zm.57-1.18-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0l.91-.53a0,0,0,0,0,0-.08l-1-.55A.14.14,0,0,0,198,319.44Zm-2.89.9.92-.53s0-.05,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.52s0,.06,0,.08l1,.56A.17.17,0,0,0,195.13,320.34Zm-1.4-.81.91-.53s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.92.53s0,.05,0,.08l1,.55A.14.14,0,0,0,193.73,319.53Zm-1.4-.8.91-.53a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,.05,0,.08l1,.55A.17.17,0,0,0,192.33,318.73Zm4.29-.1-.92.53s0,.06,0,.08l1,.55a.14.14,0,0,0,.14,0l.91-.53a0,0,0,0,0,0-.08l-1-.55A.14.14,0,0,0,196.62,318.63Zm-1.4-.81-.92.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0l.91-.53s0-.06,0-.08l-.95-.55A.14.14,0,0,0,195.22,317.82Zm-5.61-3.23-.91.53s0,.05,0,.08l.95.55a.17.17,0,0,0,.14,0l.92-.53s0-.06,0-.08l-1-.56A.17.17,0,0,0,189.61,314.59Zm1.4.81-.91.53s0,.05,0,.08l.95.55c.05,0,.11,0,.14,0l.92-.52s0-.06,0-.09l-1-.55A.17.17,0,0,0,191,315.4Zm-2.8-1.62-.91.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0l.92-.53s0-.06,0-.08l-1-.56A.17.17,0,0,0,188.21,313.78Zm5.61,3.23-.92.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0l.91-.53s0,0,0-.08L194,317A.18.18,0,0,0,193.82,317Zm-1.4-.8-.92.52s0,.06,0,.09l1,.55a.15.15,0,0,0,.13,0l.92-.53s0,0,0-.08l-1-.55S192.45,316.18,192.42,316.21Zm2.06,5.27.92-.53s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.91.53a0,0,0,0,0,0,.08l1,.56A.17.17,0,0,0,194.48,321.48Zm7.26-.27,1,.55a.14.14,0,0,0,.14,0l.91-.53s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53S201.7,321.19,201.74,321.21Zm-1.83.46,1.48.85a.17.17,0,0,0,.14,0l.91-.53s0-.05,0-.08l-1.47-.85a.17.17,0,0,0-.14,0l-.92.53S199.87,321.64,199.91,321.67Zm3.2-1.51,1.18.68a.14.14,0,0,0,.14,0l.91-.53s0-.06,0-.08l-1.18-.68a.17.17,0,0,0-.14,0l-.91.53S203.07,320.14,203.11,320.16Zm0-1.13s0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.91.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0Zm-4.88,3.18,1.85,1.07a.17.17,0,0,0,.14,0l.91-.53s0-.06,0-.08l-1.84-1.06a.14.14,0,0,0-.14,0l-.92.53A0,0,0,0,0,198.23,322.21Zm-.64,1.14,1.18.68a.14.14,0,0,0,.14,0l.91-.53s0-.06,0-.08l-1.18-.68a.12.12,0,0,0-.13,0l-.92.53S197.55,323.33,197.59,323.35ZM192.7,313a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0Zm2.8,1.62a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,.05,0,.08l1,.55a.17.17,0,0,0,.14,0Zm6.21,3.58s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.91.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0Zm-7.61-4.39a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0Zm2.8,1.61s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.91.53s0,.05,0,.08l1,.55a.14.14,0,0,0,.14,0Zm-.93,8.42s0,.05,0,.08l1.48.85a.17.17,0,0,0,.14,0l.91-.53s0-.05,0-.08l-1.47-.85a.17.17,0,0,0-.14,0Zm2.94-7.25s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.91.53s0,.05,0,.08l1,.55a.17.17,0,0,0,.14,0Zm1.4.8s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.91.53s0,.05,0,.08l1,.55a.17.17,0,0,0,.14,0ZM170,308.87a0,0,0,0,0,0,.08l2.36,1.37a.17.17,0,0,0,.14,0l.92-.53a0,0,0,0,0,0-.08l-2.36-1.36a.14.14,0,0,0-.14,0Zm3.1,1.79s0,.06,0,.08l1,.55a.12.12,0,0,0,.13,0l.92-.53s0-.06,0-.08l-1-.55a.12.12,0,0,0-.13,0Zm20,10,.92-.53s0-.05,0-.08l-1-.55a.14.14,0,0,0-.14,0L192,320s0,0,0,.08l1,.55A.17.17,0,0,0,193.08,320.67Zm-17.16-8.39s0,.06,0,.08l1,.55a.14.14,0,0,0,.14,0l.91-.53s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0Zm-7.3-4.22s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0l.91-.53s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0Zm-1.39-.72,1,.55a.17.17,0,0,0,.14,0l2.22-1.28s0-.06,0-.08l-.95-.56a.17.17,0,0,0-.14,0l-2.23,1.29S167.19,307.31,167.23,307.34Zm13.92,8a0,0,0,0,0,0,.08l1.18.68a.14.14,0,0,0,.14,0l.92-.53a0,0,0,0,0,0-.08l-1.18-.68a.14.14,0,0,0-.14,0Zm-3.53-2s0,.05,0,.08l1.48.85a.17.17,0,0,0,.14,0l.91-.53s0-.05,0-.08l-1.48-.85a.17.17,0,0,0-.14,0Zm6.78,3.91s0,.06,0,.08l7.89,4.56a.15.15,0,0,0,.13,0l.92-.53s0,0,0-.08l-7.89-4.55a.15.15,0,0,0-.13,0Zm8.33,4.81s0,.06,0,.08l1.18.68a.14.14,0,0,0,.14,0l.91-.53a0,0,0,0,0,0-.08l-1.18-.68a.17.17,0,0,0-.14,0Zm-9.95-5.74s0,.05,0,.08L184,317a.17.17,0,0,0,.14,0l.92-.53s0-.05,0-.08l-1.18-.68a.17.17,0,0,0-.14,0Zm11.57,6.68a0,0,0,0,0,0,.08l1.18.68a.17.17,0,0,0,.14,0l.92-.53a0,0,0,0,0,0-.08l-1.18-.68a.14.14,0,0,0-.14,0Zm-14.82-8.56a0,0,0,0,0,0,.08l1.18.69a.17.17,0,0,0,.14,0l.92-.53a0,0,0,0,0,0-.08l-1.18-.68a.17.17,0,0,0-.14,0Zm-5-2.89s0,.06,0,.08l1,.55a.14.14,0,0,0,.14,0l.91-.53s0-.06,0-.08l-.95-.56a.17.17,0,0,0-.14,0Zm-2.08-2.71.91-.53s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,.05,0,.08l1,.55A.17.17,0,0,0,172.44,308.76Zm5.71.27.92-.53s0-.06,0-.08l-1-.55a.12.12,0,0,0-.13,0l-.92.53s0,.06,0,.08l.95.56A.17.17,0,0,0,178.15,309Zm3.72,5.17.92-.53s0-.05,0-.08L180,312a.14.14,0,0,0-.14,0l-.91.53a0,0,0,0,0,0,.08l2.81,1.62A.15.15,0,0,0,181.87,314.2ZM174.76,309s0,0,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.92.53s0,.05,0,.08l1,.55a.17.17,0,0,0,.14,0Zm.39-.22.92-.53a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55A.14.14,0,0,0,175.15,308.81Zm8.13,6.2.91-.53s0-.05,0-.08l-1-.55a.18.18,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.56A.17.17,0,0,0,183.28,315Zm-5.43-4.19s0-.05,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.56a.15.15,0,0,0,.13,0Zm12.43,8.24.92-.53a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,.05,0,.08l1,.55A.17.17,0,0,0,190.28,319.06Zm-1.4-.81.92-.53a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55A.14.14,0,0,0,188.88,318.25Zm2.8,1.61.92-.52s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,0,0,.08l1,.55A.14.14,0,0,0,191.68,319.86Zm-5.6-3.23.91-.53a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0L185,316s0,.06,0,.08l1,.56A.17.17,0,0,0,186.08,316.63Zm1.4.81.91-.53a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55A.14.14,0,0,0,187.48,317.44Zm-2.8-1.62.91-.53a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.56A.17.17,0,0,0,184.68,315.82Zm-7.54-11.4s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.24.14s0,.05,0,.08l.95.55a.17.17,0,0,0,.14,0Zm7.63,4s0-.05,0-.08l-.95-.55c-.05,0-.11,0-.14,0l-.92.53s0,.05,0,.08l1,.55a.17.17,0,0,0,.14,0Zm-2.8-1.61s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.91.53s0,0,0,.08l.95.55a.18.18,0,0,0,.14,0Zm4.51,2.6s0-.05,0-.08l-.95-.55a.14.14,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0Zm-3.11-1.79s0-.06,0-.08l-1-.56a.15.15,0,0,0-.13,0l-.92.53s0,.05,0,.08l1,.55s.1,0,.13,0Zm5.91,3.41a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0Zm-1.4-.81a0,0,0,0,0,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.56a.17.17,0,0,0,.14,0Zm-7.94-4.2s0-.05,0-.08l-1-.55a.14.14,0,0,0-.14,0l-.24.14s0,.06,0,.08l1,.56a.15.15,0,0,0,.13,0Zm-4.2-2.42s0-.06,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.24.14a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0Zm-1.26.72s0-.06,0-.08l-.95-.55a.14.14,0,0,0-.14,0l-.92.53s0,.06,0,.08l1,.55a.14.14,0,0,0,.14,0ZM171,308l.91-.53a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53s0,.05,0,.08l1,.55A.14.14,0,0,0,171,308Zm7.5-2.72s0-.05,0-.08l-1-.55a.17.17,0,0,0-.14,0l-.24.15s0,.05,0,.08l1,.55s.11,0,.14,0Zm12.15,6.63a0,0,0,0,0,0-.08l-1-.56a.17.17,0,0,0-.14,0l-.92.53a0,0,0,0,0,0,.08l1,.55a.14.14,0,0,0,.14,0Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 186.26px 313.85px;" id="el3xr40xn9pzc"
                      class="animable"></path>
                    <polygon
                      points="185.62 319.61 185.43 319.73 180.21 322.74 170.92 317.38 170.73 317.27 176.15 314.14 185.62 319.61"
                      style="fill: rgb(55, 71, 79); transform-origin: 178.175px 318.44px;" id="elpgl15g35qg"
                      class="animable"></polygon>
                    <polygon points="185.43 319.73 180.21 322.74 170.92 317.38 176.15 314.37 185.43 319.73"
                      style="fill: rgb(38, 50, 56); transform-origin: 178.175px 318.555px;" id="elllnsrmc3rcc"
                      class="animable"></polygon>
                  </g>
                </g>
              </g>
              <g id="freepik--character-4--inject-85" class="animable" style="transform-origin: 340.864px 334.925px;">
                <g id="freepik--character--inject-85" class="animable" style="transform-origin: 340.864px 334.925px;">
                  <g id="freepik--character--inject-85" class="animable" style="transform-origin: 340.864px 334.925px;">
                    <path
                      d="M370.89,267.67c4.57.21,7.15.81,9.47,4.19s9.26,19.26,10.3,21.34,2,4.88.49,7.37-13.91,18.37-13.91,18.37l-4.77-7.13,8.94-13.65-9.73-15.25Z"
                      style="fill: rgb(177, 102, 104); transform-origin: 381.411px 293.305px;" id="eleh692lwwpq4"
                      class="animable"></path>
                    <path
                      d="M370.25,267.67c1.62-.18,4.6-2.63,7.52-.52s4.23,6.1,6,9.89c1.2,2.57,7.7,16.87,8.17,18.23a5.39,5.39,0,0,1-.46,5.49c-1.59,2.29-6.57,8.25-6.57,8.25a9.35,9.35,0,0,1-6.13-6.83L380.9,298l-6.78-10.09Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 381.367px 287.654px;" id="elirfj6xqesb9"
                      class="animable"></path>
                    <g id="elpvjmqk7muho">
                      <path
                        d="M383.34,300.38l-2.22-3.24s-2.25-5-1.67-9.08c1.17-8.48.15-11.92-1.52-15.19l-6.59.53,2.78,14.52L380.9,298A12.67,12.67,0,0,0,383.34,300.38Z"
                        style="opacity: 0.1; transform-origin: 377.34px 286.625px;" class="animable"></path>
                    </g>
                    <path
                      d="M353.64,429.24s.74,2,1.17,3.75c.33,1.4.83,3.73.38,4.81s-2.35,1.83-5.33,1.92c-1.93.06-4.88,1.48-6.9,2.71s-6.48,1.9-8.74,1.72c-2.66-.21-5.47-1.64-5.94-2.72s-.88-2.57,6.21-5.14c.05,0,8.57-3.16,11.47-6.61Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 341.712px 436.709px;" id="eli3wendd977p"
                      class="animable"></path>
                    <path
                      d="M353.64,429.43l-1.37-.11-6.31.36c-2.9,3.45-11.42,6.59-11.47,6.61l-1.14.43c-1.21,1-.09,2.72,2.89,2.87s12.07-3.3,14.08-4.36A6.09,6.09,0,0,0,353.64,429.43Z"
                      style="fill: rgb(177, 102, 104); transform-origin: 343.261px 434.457px;" id="elun6d4ci9xai"
                      class="animable"></path>
                    <path d="M353.54,426.72s.06,1.73.1,2.71-1.06,2.5-4.08,2.51c-2.12,0-3.62-.51-3.6-2.26l-.1-2.51Z"
                      style="fill: rgb(177, 102, 104); transform-origin: 349.751px 429.33px;" id="elu27r7qt413"
                      class="animable"></path>
                    <path
                      d="M378.45,418.88c.55.2.7,1.25.81,3.33.08,1.57.45,4.31-1.39,4.88s-4.54.32-5.74-1.15a71.35,71.35,0,0,0-4.63-5.69c-1.85-1.94-3.84-3.75-4.61-6.49-.69-2.47-.15-3.56,1.54-4.3s3.25-.24,5.69,1.65a11.5,11.5,0,0,0,2.15,1C373.85,412.56,377.9,418.68,378.45,418.88Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 370.971px 418.252px;" id="el3fcjx22wabd"
                      class="animable"></path>
                    <path d="M378.38,412.08l.08,7.43s-1.58,3.4-6.45.24c-.11-.24-.6-7.53-.6-7.53Z"
                      style="fill: rgb(177, 102, 104); transform-origin: 374.935px 416.587px;" id="elh785a8dsujv"
                      class="animable"></path>
                    <path
                      d="M372.27,412.14a11.5,11.5,0,0,1-2.15-1h0c-1.93-.54-5.93.32-4,3a21.56,21.56,0,0,0,5.9,5.61c2.19,1,2.89-.36,2.89-.36l-1-5.95A4.69,4.69,0,0,0,372.27,412.14Z"
                      style="fill: rgb(177, 102, 104); transform-origin: 370.259px 415.552px;" id="el4az1trdddv9"
                      class="animable"></path>
                    <path
                      d="M381.17,380a86.47,86.47,0,0,1-1.2-12.59s.62-12.19,1.28-24.5c1.46-27.39-.64-26.38-8.18-40.37,0,0-23.57-7.71-27.53,2.59,0,0-.88,9.47-1.11,16.1-.59,16.92-1.56,48.8-1.05,54.76s.1,8.86.77,21.48c.57,10.59,1.38,30,1.38,30,4.36,2.29,8.35-.74,8.35-.74s5.5-25.55,5.15-32.43c-.44-8.4-.21-15.39-.21-15.39s3.1-21.14,3.64-25.52c.16,10.6,2.45,21.61,4.16,31.91,2,11.84,4.71,28.72,4.71,28.72,4.35,2.29,7.28,1.06,7.28,1.06S382.43,388.28,381.17,380Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 362.46px 364.047px;" id="elfaglmq5chc"
                      class="animable"></path>
                    <path
                      d="M381.17,380a86.47,86.47,0,0,1-1.2-12.59s.62-12.19,1.28-24.5c1.46-27.39-.64-26.38-8.18-40.37,0,0-23.57-7.71-27.53,2.59,0,0-.88,9.47-1.11,16.1-.59,16.92-1.56,48.8-1.05,54.76s.1,8.86.77,21.48c.57,10.59,1.38,30,1.38,30,4.36,2.29,8.35-.74,8.35-.74s5.5-25.55,5.15-32.43c-.44-8.4-.21-15.39-.21-15.39s3.1-21.14,3.64-25.52c.16,10.6,2.45,21.61,4.16,31.91,2,11.84,4.71,28.72,4.71,28.72,4.35,2.29,7.28,1.06,7.28,1.06S382.43,388.28,381.17,380Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 362.46px 364.047px;" id="elocnhsvrugy8"
                      class="animable"></path>
                    <g id="elo902z7lpdo">
                      <path
                        d="M381.17,380a86.47,86.47,0,0,1-1.2-12.59s.62-12.19,1.28-24.5c1.46-27.39-.64-26.38-8.18-40.37,0,0-23.57-7.71-27.53,2.59,0,0-.88,9.47-1.11,16.1-.59,16.92-1.56,48.8-1.05,54.76s.1,8.86.77,21.48c.57,10.59,1.38,30,1.38,30,4.36,2.29,8.35-.74,8.35-.74s5.5-25.55,5.15-32.43c-.44-8.4-.21-15.39-.21-15.39s3.1-21.14,3.64-25.52c.16,10.6,2.45,21.61,4.16,31.91,2,11.84,4.71,28.72,4.71,28.72,4.35,2.29,7.28,1.06,7.28,1.06S382.43,388.28,381.17,380Z"
                        style="opacity: 0.3; transform-origin: 362.46px 364.047px;" class="animable"></path>
                    </g>
                    <g id="el7z45xht3uij">
                      <path
                        d="M366.41,330.13l-3.94,23.51c.16,8.51,1.66,17.27,3.14,25.71a203.36,203.36,0,0,1-1.25-25.17l4.35-22c5.42-.84,7.3-4.14,7.65-5.56C372.67,330.91,366.41,330.13,366.41,330.13Z"
                        style="opacity: 0.2; transform-origin: 369.415px 352.985px;" class="animable"></path>
                    </g>
                    <polygon points="357.31 261.38 357.93 275.58 368.53 274.93 368.19 260.16 357.31 261.38"
                      style="fill: rgb(177, 102, 104); transform-origin: 362.92px 267.87px;" id="el4zkkttqiw7a"
                      class="animable"></polygon>
                    <path
                      d="M378.77,276.53c-.46-3.3-1.64-7.31-4.82-8.68a13.07,13.07,0,0,0-7.15-.42c-.45,1.51-5.93,3.44-8.64.84-2.63.55-5.85,1.15-9.39,2-2.81.68-4.45,11.31-6.29,14.73-2.18,4-.06,9.52,2.7,11.64,0,0,.05,3.87.36,8.43,4.84,4.05,13.89,5.16,20.88,3.34,5.26-1.38,6.73-3.13,7.85-6.88.47-1.56.89-2.92,1.87-5.64C378.41,289.59,379.39,280.92,378.77,276.53Z"
                      style="fill: rgb(55, 71, 79); transform-origin: 360.266px 288.188px;" id="elw0h4lmeww4"
                      class="animable"></path>
                    <path
                      d="M357.46,265.21c-.6,0-1,.25-1.71,1.19-1,1.29-2.4,2.85-2.4,2.85s1.24,2.28,5.17,3.06a17.16,17.16,0,0,0,9.3-.39c2-.83,2.34-1.5,2.6-2.4a6.29,6.29,0,0,0-.81-3.62c-.58-1.26-1.32-1.2-1.32-1.2v1s-.21,1.09-3.25,1.62-6.64,0-7.52-.84Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 361.895px 268.736px;" id="eljulit4b32g"
                      class="animable"></path>
                    <path
                      d="M342.53,238a5.72,5.72,0,0,1,0-1.8,5.42,5.42,0,0,1,7.16-4.13,5.33,5.33,0,0,1,3-5.82,6.76,6.76,0,0,1,5.22.21,4.08,4.08,0,0,1,2.28,2,5.73,5.73,0,0,1,10.44,1.41c1.72-.39,4.16.38,4.94,2.1.87,1.95-.2,4.37.2,6.42.26,1.32.83,2.57,1.08,3.91a32.6,32.6,0,0,1,.42,4.53c.24,6.27-14.31,10.35-14,14.65l-7.76-9.44c0-.4-1.1-1.37-1.35-1.71-.46-.62-.87-1.29-1.3-1.94a12.18,12.18,0,0,0-5.35-4.27,9.91,9.91,0,0,1-3.82-3.14A6.74,6.74,0,0,1,342.53,238Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 359.866px 243.575px;" id="elq7anlx0z92"
                      class="animable"></path>
                    <path d="M348.64,248.43s-2.51,3.74-2.18,4.14a6.14,6.14,0,0,0,1.92.81Z"
                      style="fill: rgb(154, 74, 77); transform-origin: 347.535px 250.905px;" id="elrdt5dlyqv7d"
                      class="animable"></path>
                    <path
                      d="M356.33,236.6c-2.45,1.24-6.67,3.53-7.76,12.38-1.11,9.08.94,12.24,2.2,13.43.86.8,5.24,1.1,7.53.4,2.87-.88,9.07-3.89,12-8.58,3.42-5.51,4.13-12.87.18-15.75C364.9,234.43,358.4,235.55,356.33,236.6Z"
                      style="fill: rgb(177, 102, 104); transform-origin: 360.708px 249.409px;" id="eli2tdb5s4w4f"
                      class="animable"></path>
                    <path
                      d="M351,262.57c1,.57,4.07.87,6.37.45l-.07-1.74a16.37,16.37,0,0,1-3.14,1.09A10.32,10.32,0,0,1,351,262.57Z"
                      style="fill: rgb(154, 74, 77); transform-origin: 354.185px 262.248px;" id="elmf3zqzuap8"
                      class="animable"></path>
                    <path
                      d="M355.25,236.33a9.58,9.58,0,0,0-2.84,1.64,3.74,3.74,0,0,0-1,1.29,3,3,0,0,0-.2,1.46,3.89,3.89,0,0,0,2.28,3.16,3.79,3.79,0,0,0-.61,3.16,7.54,7.54,0,0,0,2.24,3.23.46.46,0,0,0,.18.13c.14,0,.28,0,.41-.12,1.53-1,2.48-2.8,4.65-2.09,2.85.94,2.71,4.45.47,6.64a4.8,4.8,0,0,1-3,1.41,2.32,2.32,0,0,1-1.57-.55s.08,4.58,4.07,6.4a15.8,15.8,0,0,0,8.5.1c1.5-1.91,4-4.35,6.1-6.53,6.83-7.18,7.22-17.62-2.85-20.91-.35-.12-.7-.22-1.05-.31a21.54,21.54,0,0,0-14.64,1.38Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 365.534px 248.235px;" id="elkblhwp7pwbj"
                      class="animable"></path>
                    <path d="M354.93,253.47a2.11,2.11,0,0,1-1.29-2.71,2.17,2.17,0,0,1,2.75-1.27Z"
                      style="fill: rgb(38, 50, 56); transform-origin: 354.952px 251.418px;" id="el15i8vlqi1luj"
                      class="animable"></path>
                    <path
                      d="M348.39,270.45c-5.11.64-9.15,1.71-11.38,6.57-3.77,8.26-7.86,15-10.83,18.21-3.18,3.4-16.19,9.39-19.13,8.91s-5.86-3.85-7.37-3,1.29,4.15,1.11,4.88-5.14,0-8-1.43-5.21,2.06-2,5.87,11.13,3.95,17.77,2.61,19.16-4.82,24.25-9c6.17-5.09,8.27-8.94,10.9-13.5C353.25,280.78,348.39,270.45,348.39,270.45Z"
                      style="fill: rgb(177, 102, 104); transform-origin: 319.437px 292.145px;" id="el2e3hk2xvulg"
                      class="animable"></path>
                    <path
                      d="M349.2,270.18c-2.54-.44-7.71.29-9.69,2.57s-3.14,4.44-6,10.46-7,13.25-17.13,18c0,0,.93,6.35,4.37,8.63,0,0,7.27-1.49,11.55-4.58s10.32-10.41,12.83-14.33S352.19,283.35,349.2,270.18Z"
                      style="fill: rgb(69, 90, 100); transform-origin: 333.282px 289.949px;" id="elqpvkxmdn2sg"
                      class="animable"></path>
                  </g>
                </g>
              </g>
              <g id="freepik--character-1--inject-85" class="animable" style="transform-origin: 124.399px 342.457px;">
                <g id="freepik--character--inject-85" class="animable" style="transform-origin: 124.399px 342.457px;">
                  <polygon points="108.4 285.6 107.35 297.25 94.38 294.78 95.73 282.74 108.4 285.6"
                    style="fill: rgb(158, 103, 103); transform-origin: 101.39px 289.995px;" id="eliy2t1mr2cn"
                    class="animable"></polygon>
                  <path d="M116.37,270.93s2.82,4.29,2.5,4.71-2.4.8-2.4.8Z"
                    style="fill: rgb(135, 76, 76); transform-origin: 117.633px 273.685px;" id="el3lpmfgani5f"
                    class="animable"></path>
                  <path
                    d="M108.52,259.08c5.72,1.2,7.37,3.72,7.91,12.8.56,9.48-.41,12.46-1.65,13.74-.85.86-5.52,1-7.88.37-3-.81-9.62-3.18-12.75-7.95-3.67-5.62-4.64-13.22-.7-16.35C99,257.3,106.2,258.59,108.52,259.08Z"
                    style="fill: rgb(158, 103, 103); transform-origin: 103.752px 272.45px;" id="elproqghezkhm"
                    class="animable"></path>
                  <path
                    d="M108.4,284.66l-.06,1.6c2.45.3,5.74.07,6.44-.64l0,0a13.05,13.05,0,0,1-2.42,0A14.54,14.54,0,0,1,108.4,284.66Z"
                    style="fill: rgb(135, 76, 76); transform-origin: 111.56px 285.524px;" id="elkp3f6adcxn"
                    class="animable"></path>
                  <path
                    d="M117.69,263h0a13.1,13.1,0,0,1-5.53,1.74,11.18,11.18,0,0,1-.91,4.5c-.35,1-1.62,4.18-2.88,2.4-.91-1.29-1.74-2.46-3.54-2.19-3,.44-3.38,4.23-1.5,6.54s3.62,1.42,3.62,1.42-.09,5-2.31,7.85c0,0-2.53.82-7.18-.18-2.86-.6-6.9-4.18-8.6-8-3.59-8-3.84-15.2,1.27-17.35.55-3.69,3.45-5.34,6.76-6.1,4.59-1.06,9.26,1.91,13.71.12.94-.37,1.81-.92,2.76-1.24a1.88,1.88,0,0,1,1.64,0,2,2,0,0,1,.68,1.27,3.5,3.5,0,0,1-.24,2.63,7.94,7.94,0,0,1,2.09-.71,2.63,2.63,0,0,1,2.09.52,2.71,2.71,0,0,1,.8,1.84A5.65,5.65,0,0,1,117.69,263Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 103.321px 268.949px;" id="eltcnjqd9z088"
                    class="animable"></path>
                  <path d="M90,261l-3.42-2A2,2,0,0,1,90,261Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 88.3655px 259.619px;" id="elx0tm2g2lti8"
                    class="animable"></path>
                  <path
                    d="M132.56,377.4c0-.12-.69-7.19-.69-7.19s.5.72,4.59.36a22.39,22.39,0,0,0,4.55-1.05l.27,5.13c.72,2.08,4.32,1.79,8.17,2,.65,0,1.32,0,2,0h0c2.06.24,3.9,1.82,1.48,3.19s-6,1.44-9.36,1.47C139.6,381.4,132.6,381.37,132.56,377.4Z"
                    style="fill: rgb(158, 103, 103); transform-origin: 142.975px 375.425px;" id="elcn2k2g6lbfi"
                    class="animable"></path>
                  <path
                    d="M160,380.94a16.3,16.3,0,0,1-.17,1.88c-.14.76-2.54,3.23-6.09,4.23s-7.57.43-9.57.65-4,.79-6.37.95-4.93-.07-6.93-1.93c-.23-.55-.26-1.42-.1-1.54C131.23,384.86,160,380.94,160,380.94Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 145.335px 384.816px;" id="elc6ahuc0ltio"
                    class="animable"></path>
                  <path
                    d="M141.76,375.41c1.28,1.25,4.39,1.06,7.69,1.25,3.11.18,6.73-.31,8.68.77s3.25,3.73-.09,6.38a19.42,19.42,0,0,1-4.06,2c-3.5,1.37-7.17.66-9.51.83-3,.22-4.85,1.23-7.61,1.08-3.56-.19-5.61-1.46-6.05-2.5s.28-8.65,1.75-8.23c0,0,.21,2.54,6.32,1.15C141.54,377.5,141.76,376,141.76,375.41Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 145.388px 381.573px;" id="elio5yfkhwm9g"
                    class="animable"></path>
                  <path d="M141.65,331.68c.29,7.08,0,40,0,40a10.76,10.76,0,0,1-9.83,1.76l-3.41-37.79Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 135.094px 352.809px;" id="el7n6u144rp8l"
                    class="animable"></path>
                  <path
                    d="M152,389.54c0-.12-1.29-6.88-1.29-6.88s1.29.86,5.38.62a18.51,18.51,0,0,0,4-.75l.66,5c.65,2.1,4.26,1.93,8.11,2.26.64.06,1.31.08,2,.1H171c2.05.3,3.84,1.93,1.38,3.23s-6.08,1.25-9.4,1.18C159,394.2,152,393.5,152,389.54Z"
                    style="fill: rgb(158, 103, 103); transform-origin: 162.141px 388.43px;" id="elb0ko2x76mye"
                    class="animable"></path>
                  <path
                    d="M180,394.31a3.77,3.77,0,0,1-.19,2.12c-.42,1.21-3.34,2.94-6.95,3.69s-7.57.15-9.57.32-4.19.91-6.53,1a9.46,9.46,0,0,1-6.43-2.18c-.31-.49-.4-1.43-.24-1.55C150.48,397.4,180,394.31,180,394.31Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 165.042px 397.879px;" id="elafd7q26cqi"
                    class="animable"></path>
                  <path
                    d="M161.29,388.28c1.24,1.28,4.35,1.2,7.65,1.48,3.1.27,6.73-.1,8.65,1s3.95,3.65.53,6.2a20.56,20.56,0,0,1-5,2.2c-3.61,1-7.16.25-9.5.35-3,.13-4.89,1.09-7.64.86-3.55-.3-5.57-1.64-6-2.69s.55-8.63,2-8.17c0,0,.14,2.54,6.29,1.34C161,390.36,161.27,388.84,161.29,388.28Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 164.921px 394.343px;" id="el9ojsja79tde"
                    class="animable"></path>
                  <path d="M158.91,345.43c.82,7.33,1.6,28.56,2.15,39.16a14.65,14.65,0,0,1-10.59,1.18l-7.55-38.09Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 151.99px 365.849px;" id="eltdlhoy6oi8m"
                    class="animable"></path>
                  <path
                    d="M111.37,432.32a.89.89,0,0,0,.89-.89V374.55a.89.89,0,0,0-1.77,0v56.88A.88.88,0,0,0,111.37,432.32Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 111.375px 403.037px;" id="elz60k994e4ob"
                    class="animable"></path>
                  <path
                    d="M76.18,411.61a.88.88,0,0,0,.82-.56l17.44-44.14a.88.88,0,1,0-1.64-.65L75.36,410.4a.88.88,0,0,0,.49,1.15A1,1,0,0,0,76.18,411.61Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 84.8985px 388.656px;" id="elo8ltf20206a"
                    class="animable"></path>
                  <path
                    d="M78.27,406.31a.88.88,0,0,0,.65-.28l32.45-34.34,32.4,34.2a.88.88,0,0,0,1.28-1.22l-33-34.88a.89.89,0,0,0-.64-.27h0a.91.91,0,0,0-.64.27l-33.1,35a.89.89,0,0,0,.64,1.49Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 111.366px 387.915px;" id="elcjftakj20io"
                    class="animable"></path>
                  <path
                    d="M146.56,411.61a1,1,0,0,0,.33-.06.89.89,0,0,0,.5-1.15l-17.45-44.14a.88.88,0,1,0-1.64.65l17.44,44.14A.88.88,0,0,0,146.56,411.61Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 137.844px 388.656px;" id="el3wkv2pykhig"
                    class="animable"></path>
                  <path
                    d="M147,355c.63-3.56-2.27-6.35-7.74-10a128.3,128.3,0,0,0-15.85-8.9c-4.57-2.1-9.25-1.91-15.11,1.1-8.14,4.18-32.62,19-32.62,19S112.28,376.9,119.32,376,144,363.6,145.37,359.57,147,355,147,355Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 111.383px 355.366px;" id="ell3mzjutc6cp"
                    class="animable"></path>
                  <path
                    d="M115.79,371.63c5.25,4.76,10.74.66,19.44-5C145.06,360.27,147,355,147,355a21.41,21.41,0,0,1-.73,5.75c-.74,1.84-2.33,3.92-9.42,8.81s-12.23,7.34-17,8.24l-3.76-.52"
                    style="fill: rgb(38, 50, 56); transform-origin: 131.395px 366.4px;" id="elpwrln85b0pm"
                    class="animable"></path>
                  <g id="elc67v0uz1tyj">
                    <path
                      d="M135.23,366.65C145.06,360.27,147,355,147,355a21.41,21.41,0,0,1-.73,5.75c-.74,1.84-2.33,3.92-9.42,8.81s-12.23,7.34-17,8.24l-3.76-.52-.29-5.69C121,376.39,126.53,372.29,135.23,366.65Z"
                      style="opacity: 0.5; transform-origin: 131.4px 366.4px;" class="animable"></path>
                  </g>
                  <path
                    d="M77.38,405,75.08,411a.41.41,0,0,0,0,.16.2.2,0,0,0,0,.11.71.71,0,0,0,.34.38,1.53,1.53,0,0,0,1.41,0,.57.57,0,0,0,.27-.29h0l0-.08,2.14-5.7Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 77.1561px 408.411px;" id="elbb8706qxr6a"
                    class="animable"></path>
                  <path
                    d="M145.36,405l2.31,6.08a.78.78,0,0,1,0,.16v.11a.73.73,0,0,1-.35.38,1.51,1.51,0,0,1-1.4,0,.56.56,0,0,1-.28-.29h0l0-.08-2.14-5.7Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 145.587px 408.451px;" id="elvmv73cywzm"
                    class="animable"></path>
                  <path
                    d="M110.35,427v5a.52.52,0,0,0,.3.42,1.59,1.59,0,0,0,1.44,0,.52.52,0,0,0,.3-.42v-5A2.17,2.17,0,0,0,110.35,427Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 111.37px 429.669px;" id="elxvzwjzg59rn"
                    class="animable"></path>
                  <path
                    d="M87.16,340.9s29.37-8.87,34.47-10.27,14.9-3.75,17.77-2.47,4.31,2.77,4.57,6.9c.06.78,0,4.56,0,4.56s-14.87,6.05-26.5,6.05S87.16,340.9,87.16,340.9Z"
                    style="fill: rgb(55, 71, 79); transform-origin: 115.578px 336.73px;" id="elsxpp2qe7ejp"
                    class="animable"></path>
                  <path
                    d="M87.05,337.22c-1.84,6.28-2.42,12.43,2,17,3.2,3.3,16.48,15.07,28.11,11.5,13-4,28.53-15.27,28.53-15.27s10,.31,10.09-2.64c0-.72,3.17-1.61,3.14-2.4-.41-8.65-6.23-12.25-14.91-10.68-9.11,1.65-29.47,7.46-29.47,7.46Z"
                    style="fill: rgb(69, 90, 100); transform-origin: 122.296px 350.379px;" id="elbocobreb32g"
                    class="animable"></path>
                  <g id="els9h8qtuo56">
                    <path
                      d="M101.59,363.4c-2.19-8-4.81-18.14-4.81-18.14l12,3.79c2.48,7.84,3.73,12.1,9.93,11.09s27-9.72,27-9.72-15.53,11.29-28.53,15.27C111.94,367.29,106.4,365.81,101.59,363.4Z"
                      style="fill: rgb(55, 71, 79); opacity: 0.5; transform-origin: 121.245px 355.809px;"
                      class="animable"></path>
                  </g>
                  <path
                    d="M89.7,291c-4-.88-8.28,2-10.74,8.23S70.63,320.86,69.63,325c-.45,1.86,14.84,18.61,14.33,18.37-.15-.08,4.49-8.09,4.49-8.09L80.68,325l4.93-11.58Z"
                    style="fill: rgb(158, 103, 103); transform-origin: 79.6601px 317.109px;" id="eloqnuchu39gm"
                    class="animable"></path>
                  <path d="M90,290.35c-5.22-1.46-8.8.26-11.14,5.9S74.42,308.06,71.41,318c0,0,10.51,6.49,17.43,3.95Z"
                    style="fill: rgb(224, 224, 224); transform-origin: 80.705px 306.198px;" id="el0a5pq7v2nxai"
                    class="animable"></path>
                  <path
                    d="M83.1,295.57c1.66-3.8,3.66-5.32,7.86-5.23,1.41,0,3.88.32,3.88.32.5,2,8.64,3.89,13,1.61,1.59.41,5.76,1.23,7.08,1.67,3.79,1.26,4.37,5.59,5,17.95,0,0,0,26.25-.85,33.61-5.37,6.84-18.47,5.91-23.93,4.84C83.71,348.13,81.93,342,81.93,342s-1.18-21.59-1.05-30.55C81,303.86,82.17,297.72,83.1,295.57Z"
                    style="fill: rgb(245, 245, 245); transform-origin: 100.395px 320.711px;" id="elc9okm681wuv"
                    class="animable"></path>
                  <path
                    d="M157.85,316.14c-1.84.87-24.06,18.5-27.51,16.7s-16.44-21.26-16.44-21.26a29.33,29.33,0,0,1,1.37-17.4c3.15.3,5,.12,8.06,5.56C125.94,304.37,134,320,134,320q4.65-2.46,9.26-5c2.53-1.39,5.07-2.77,7.55-4.26a9.23,9.23,0,0,0,1.94-1.26c1.21-1.25.93-4.2.87-5.81a18.93,18.93,0,0,0-.16-2.26c-.12-.91-.35-3.16,1.32-2.48a2.1,2.1,0,0,1,.81.64,3.61,3.61,0,0,1,.62,1.12c.33,1,.25,2,.56,3a.89.89,0,0,0,.21.38.71.71,0,0,0,.53.15c2.41-.13,4.62-3.56,5.68-5.37A4.93,4.93,0,0,1,165,296.7c1.3-.65,2.91.2,3.78,1.36a7.65,7.65,0,0,1,1.32,5.29,10.56,10.56,0,0,1-3,6.73A32.3,32.3,0,0,1,157.85,316.14Z"
                    style="fill: rgb(158, 103, 103); transform-origin: 141.663px 313.574px;" id="eletd2ogconhk"
                    class="animable"></path>
                  <path
                    d="M116.08,377.32c-3-.15-5.34-2.34-12.45-5.31-13.14-5.47-23-9.85-26.75-16.74s-6.41-26.74-5.48-35.35a11.45,11.45,0,0,1,.65-2.85l-.93-.13,2.4-2h0c2.45-2,6.45-.22,9.46,1.42,8.6,4.68,15.33,9.22,20.65,25.65,4,12.35,6.63,23.62,12.16,29.65"
                    style="fill: rgb(38, 50, 56); transform-origin: 93.6px 345.686px;" id="el0lge09ia5dbd"
                    class="animable"></path>
                  <g id="elaba14xbstse">
                    <path
                      d="M72.05,317.07l-.93-.13,2.4-2h0c2.45-2,6.45-.22,9.46,1.42,8.6,4.68,15.33,9.22,20.65,25.65,4,12.35,6.63,23.62,12.16,29.65l.29,5.69c-3-.15-5.34-2.34-12.45-5.31-13.14-5.47-23-9.85-26.75-16.74s-6.42-26.74-5.48-35.35A11.45,11.45,0,0,1,72.05,317.07Z"
                      style="opacity: 0.3; transform-origin: 93.6px 345.701px;" class="animable"></path>
                  </g>
                  <path
                    d="M80.49,318.44c8.6,4.68,15.32,9.23,20.64,25.65s8.23,30.94,18.71,33.75c0,0-4.74,1.89-19.26-4.26C96,371.63,90.35,368.07,86.67,366c-7.22-4.05-11.59-7.37-12.28-8.61C70.57,350.54,68,330.64,68.91,322S76.18,316.1,80.49,318.44Z"
                    style="fill: rgb(38, 50, 56); transform-origin: 94.2831px 347.105px;" id="elwfbdflfan0a"
                    class="animable"></path>
                  <path
                    d="M108,289.86c-5.31,1.72-11.51.48-12.82-2.26l.11-1s-.59-.82-1.44.75-1.75,3-1.75,3-.5,3.24,4.34,5.17A13.9,13.9,0,0,0,108,294.8c1.81-1.13,2.81-1.85,2.81-1.85l1.45.32s-1.8-2.77-2.65-4-1.45-1.21-1.45-1.21Z"
                    style="fill: rgb(224, 224, 224); transform-origin: 102.173px 291.417px;" id="elr8g9u9qc9g"
                    class="animable"></path>
                  <path
                    d="M114.88,293.94c3.78.33,5,0,7.41,3.31s11.8,22.18,11.8,22.18l13.24-6.62,5.18,7.11s-15,11.4-18.14,13.06-4.18,1.73-6.88-1.3-13.3-18.93-13.3-18.93S109.75,305,114.88,293.94Z"
                    style="fill: rgb(224, 224, 224); transform-origin: 132.458px 314.03px;" id="el5lzbfwyqxxo"
                    class="animable"></path>
                </g>
              </g>
              <defs>
                <filter id="active" height="200%">
                  <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
                  <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                  <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                  <feMerge>
                    <feMergeNode in="OUTLINE"></feMergeNode>
                    <feMergeNode in="SourceGraphic"></feMergeNode>
                  </feMerge>
                </filter>
                <filter id="hover" height="200%">
                  <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
                  <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
                  <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                  <feMerge>
                    <feMergeNode in="OUTLINE"></feMergeNode>
                    <feMergeNode in="SourceGraphic"></feMergeNode>
                  </feMerge>
                  <feColorMatrix type="matrix"
                    values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 ">
                  </feColorMatrix>
                </filter>
              </defs>
            </svg>

  </section>

  <section class="text-center bg-white ">
    <h3 class="border-top  py-4 fw-bold"> C'est quoi GPI - Pivot ? </h3>

         <p class="py-2 col-8 offset-2"> Notre système  vous permet de signaler rapidement tout problème ou demande auprès de notre équipe.
        Chaque ticket et checkout est suivi en temps réel, attribué à un responsable et priorisé selon son urgence. Vous pouvez
        échanger facilement avec nos agents, suivre l’avancement et recevoir des notifications jusqu’à la résolution
        complète de votre demande. </p>


    <div class="row container">
      
      <div class="col-lg-3 "></div>
      <div class="col-lg-3 mt-1" data-aos="fade-right" data-aos-duration="15500">

        <svg class="animated" width="250" id="freepik_stories-documents" xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
          xmlns:svgjs="http://svgjs.com/svgjs">
          <style>
            svg#freepik_stories-documents:not(.animated) .animable {
              opacity: 0;
            }

            svg#freepik_stories-documents.animated #freepik--background-complete--inject-20 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideDown;
              animation-delay: 0s;
            }

            svg#freepik_stories-documents.animated #freepik--Shadow--inject-20 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedRight;
              animation-delay: 0s;
            }

            svg#freepik_stories-documents.animated #freepik--Character--inject-20 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomOut;
              animation-delay: 0s;
            }

            svg#freepik_stories-documents.animated #freepik--Documents--inject-20 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn, 1.5s Infinite linear floating;
              animation-delay: 0s, 1s;
            }

            @keyframes slideDown {
              0% {
                opacity: 0;
                transform: translateY(-30px);
              }

              100% {
                opacity: 1;
                transform: translateY(0);
              }
            }

            @keyframes lightSpeedRight {
              from {
                transform: translate3d(50%, 0, 0) skewX(-20deg);
                opacity: 0;
              }

              60% {
                transform: skewX(10deg);
                opacity: 1;
              }

              80% {
                transform: skewX(-2deg);
              }

              to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
              }
            }

            @keyframes zoomOut {
              0% {
                opacity: 0;
                transform: scale(1.5);
              }

              100% {
                opacity: 1;
                transform: scale(1);
              }
            }

            @keyframes fadeIn {
              0% {
                opacity: 0;
              }

              100% {
                opacity: 1;
              }
            }

            @keyframes floating {
              0% {
                opacity: 1;
                transform: translateY(0px);
              }

              50% {
                transform: translateY(-10px);
              }

              100% {
                opacity: 1;
                transform: translateY(0px);
              }
            }

            .animator-hidden {
              display: none;
            }
          </style>
          <g id="freepik--background-complete--inject-20" class="animable animator-hidden"
            style="transform-origin: 250px 226.665px;">
            <rect y="382.4" width="500" height="0.25"
              style="fill: rgb(230, 230, 230); transform-origin: 250px 382.525px;" id="elgev8tb3ucie" class="animable">
            </rect>
            <rect x="449.63" y="391.22" width="18.77" height="0.25"
              style="fill: rgb(230, 230, 230); transform-origin: 459.015px 391.345px;" id="elv1j94ko9slr"
              class="animable"></rect>
            <rect x="373.07" y="398.08" width="8.69" height="0.25"
              style="fill: rgb(230, 230, 230); transform-origin: 377.415px 398.205px;" id="elobgkot5xr8"
              class="animable"></rect>
            <rect x="279.96" y="394.63" width="19.36" height="0.25"
              style="fill: rgb(230, 230, 230); transform-origin: 289.64px 394.755px;" id="el1nbdef2vgqd"
              class="animable"></rect>
            <rect x="80.93" y="394.5" width="43.19" height="0.25"
              style="fill: rgb(230, 230, 230); transform-origin: 102.525px 394.625px;" id="elfndk25kxsuv"
              class="animable"></rect>
            <rect x="65.7" y="394.5" width="6.33" height="0.25"
              style="fill: rgb(230, 230, 230); transform-origin: 68.865px 394.625px;" id="el55r2rp5pz9w"
              class="animable"></rect>
            <rect x="189.3" y="388.58" width="93.68" height="0.25"
              style="fill: rgb(230, 230, 230); transform-origin: 236.14px 388.705px;" id="elqktd7475sq9"
              class="animable"></rect>
            <path
              d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z"
              style="fill: rgb(230, 230, 230); transform-origin: 140.46px 196.4px;" id="elv6ytq5un1o" class="animable">
            </path>
            <path
              d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z"
              style="fill: rgb(230, 230, 230); transform-origin: 356.75px 196.4px;" id="el6tyes78wtkf" class="animable">
            </path>
            <rect x="58.71" y="73.68" width="202.25" height="144.13"
              style="fill: rgb(250, 250, 250); transform-origin: 159.835px 145.745px;" id="elm0owzmela3p"
              class="animable"></rect>
            <rect x="60.46" y="73.68" width="204.24" height="144.13"
              style="fill: rgb(245, 245, 245); transform-origin: 162.58px 145.745px;" id="el0vysk1quo08g"
              class="animable"></rect>
            <g id="el0hxjf1purk2r">
              <rect x="96.4" y="48.86" width="132.36" height="193.76"
                style="fill: rgb(250, 250, 250); transform-origin: 162.58px 145.74px; transform: rotate(90deg);"
                class="animable"></rect>
            </g>
            <polygon points="100.98 211.92 131.72 79.56 172.02 79.56 141.28 211.92 100.98 211.92"
              style="fill: rgb(255, 255, 255); transform-origin: 136.5px 145.74px;" id="elsphi8fcr01j" class="animable">
            </polygon>
            <polygon points="147.8 211.92 178.55 79.56 196.75 79.56 166 211.92 147.8 211.92"
              style="fill: rgb(255, 255, 255); transform-origin: 172.275px 145.74px;" id="elgxz2rdj6p64"
              class="animable"></polygon>
            <g id="elzszxmg8dool">
              <rect x="192.95" y="145.41" width="132.36" height="0.67"
                style="fill: rgb(250, 250, 250); transform-origin: 259.13px 145.745px; transform: rotate(90deg);"
                class="animable"></rect>
            </g>
            <path
              d="M54.78,73.44v57.12H69.89S97,112.85,103.21,76.42a6.06,6.06,0,0,0-6-7.09H58.89A4.11,4.11,0,0,0,54.78,73.44Z"
              style="fill: rgb(224, 224, 224); transform-origin: 79.0391px 99.945px;" id="el5e449ngajfq"
              class="animable"></path>
            <path d="M54.78,235.44V135.17H69.89s30.67,59.05,34.22,100.27Z"
              style="fill: rgb(224, 224, 224); transform-origin: 79.445px 185.305px;" id="eljzt9u7lvbz"
              class="animable"></path>
            <rect x="53.82" y="130.56" width="17.14" height="4.61" rx="1.51"
              style="fill: rgb(245, 245, 245); transform-origin: 62.39px 132.865px;" id="el9hc04c26h8" class="animable">
            </rect>
            <path
              d="M269,73.44v57.12H253.86s-27.15-17.71-33.32-54.14a6.07,6.07,0,0,1,6-7.09h38.36A4.12,4.12,0,0,1,269,73.44Z"
              style="fill: rgb(224, 224, 224); transform-origin: 244.727px 99.945px;" id="eltphtxnwzwh"
              class="animable"></path>
            <path d="M269,235.44V135.17H253.86s-30.66,59.05-34.22,100.27Z"
              style="fill: rgb(224, 224, 224); transform-origin: 244.32px 185.305px;" id="elk4awk3u9yv"
              class="animable"></path>
            <g id="elsl6xx2b9ca">
              <rect x="252.8" y="130.56" width="17.14" height="4.61" rx="1.51"
                style="fill: rgb(245, 245, 245); transform-origin: 261.37px 132.865px; transform: rotate(180deg);"
                class="animable"></rect>
            </g>
            <rect x="231.2" y="253.66" width="33.23" height="128.74"
              style="fill: rgb(250, 250, 250); transform-origin: 247.815px 318.03px;" id="elxj1zbi5zvw8"
              class="animable"></rect>
            <polygon points="255.56 382.4 264.43 382.4 264.43 367.53 246.26 367.53 255.56 382.4"
              style="fill: rgb(244, 248, 255); transform-origin: 255.345px 374.965px;" id="el8h5y36nj48b"
              class="animable"></polygon>
            <rect x="72.22" y="253.66" width="33.23" height="128.74"
              style="fill: rgb(224, 224, 224); transform-origin: 88.835px 318.03px;" id="el3jwsxhrsduu"
              class="animable"></rect>
            <rect x="97.71" y="253.66" width="166.72" height="123.62"
              style="fill: rgb(250, 250, 250); transform-origin: 181.07px 315.47px;" id="elh75lwu1fsf5"
              class="animable"></rect>
            <path d="M147.8,231.8c0,12,11.56,21.86,25.7,21.86h12.76c14.13,0,25.69-9.84,25.69-21.86Z"
              style="fill: rgb(235, 235, 235); transform-origin: 179.875px 242.73px;" id="elrxe9cflyugs"
              class="animable"></path>
            <path
              d="M140.4,204.33h24s-4.17,11-4.17,17.48,18.26,31.85-7.83,31.85-7.83-25.38-7.83-31.85S140.4,204.33,140.4,204.33Z"
              style="fill: rgb(224, 224, 224); transform-origin: 152.4px 228.995px;" id="eltehvx55q4td"
              class="animable"></path>
            <rect x="104.59" y="261.19" width="152.96" height="31.17"
              style="fill: rgb(235, 235, 235); transform-origin: 181.07px 276.775px;" id="el9bwpvhg1osh"
              class="animable"></rect>
            <polygon points="106.58 382.4 97.71 382.4 97.71 367.53 115.89 367.53 106.58 382.4"
              style="fill: rgb(250, 250, 250); transform-origin: 106.8px 374.965px;" id="el1ngp1f0etit"
              class="animable"></polygon>
            <path d="M176.37,276.77a4.7,4.7,0,1,0,4.7-4.7A4.7,4.7,0,0,0,176.37,276.77Z"
              style="fill: rgb(250, 250, 250); transform-origin: 181.07px 276.77px;" id="elwwtumjzrwbf"
              class="animable"></path>
            <rect x="104.59" y="299.89" width="152.96" height="31.17"
              style="fill: rgb(235, 235, 235); transform-origin: 181.07px 315.475px;" id="el5urw92j70i9"
              class="animable"></rect>
            <path d="M176.37,315.47a4.7,4.7,0,1,0,4.7-4.7A4.7,4.7,0,0,0,176.37,315.47Z"
              style="fill: rgb(250, 250, 250); transform-origin: 181.07px 315.47px;" id="elzj4gs4f0rit"
              class="animable"></path>
            <rect x="104.59" y="338.58" width="152.96" height="31.17"
              style="fill: rgb(235, 235, 235); transform-origin: 181.07px 354.165px;" id="el19c1n1tsccz"
              class="animable"></rect>
            <circle cx="181.07" cy="354.17" r="4.7"
              style="fill: rgb(250, 250, 250); transform-origin: 181.07px 354.17px;" id="el9yibdr135sd"
              class="animable"></circle>
            <rect x="295.65" y="71.94" width="74.23" height="52.84"
              style="fill: rgb(224, 224, 224); transform-origin: 332.765px 98.36px;" id="elpwilof918l" class="animable">
            </rect>
            <rect x="299.87" y="71.94" width="76.07" height="52.84"
              style="fill: rgb(245, 245, 245); transform-origin: 337.905px 98.36px;" id="el2omw8oy3we3"
              class="animable"></rect>
            <g id="eli7dt84urdpj">
              <rect x="316.34" y="65.17" width="43.14" height="66.37"
                style="fill: rgb(255, 255, 255); transform-origin: 337.91px 98.355px; transform: rotate(90deg);"
                class="animable"></rect>
            </g>
            <g id="elzugp6xhcoqk">
              <rect x="328.9" y="76.85" width="18.01" height="43.01"
                style="fill: rgb(245, 245, 245); transform-origin: 337.905px 98.355px; transform: rotate(90deg);"
                class="animable"></rect>
            </g>
            <rect x="384.92" y="98.36" width="45.18" height="47.38"
              style="fill: rgb(224, 224, 224); transform-origin: 407.51px 122.05px;" id="el98ayzkdypz5"
              class="animable"></rect>
            <rect x="389.15" y="98.36" width="47.03" height="47.38"
              style="fill: rgb(245, 245, 245); transform-origin: 412.665px 122.05px;" id="elsb3qqu27e8m"
              class="animable"></rect>
            <g id="el2nbeuj487ed">
              <rect x="393.82" y="103.38" width="37.68" height="37.33"
                style="fill: rgb(255, 255, 255); transform-origin: 412.66px 122.045px; transform: rotate(90deg);"
                class="animable"></rect>
            </g>
            <path
              d="M405.68,122.05h0a6.28,6.28,0,0,1,6.27-6.28h1.42a6.28,6.28,0,0,1,6.27,6.28h0a6.27,6.27,0,0,1-6.27,6.27H412A6.27,6.27,0,0,1,405.68,122.05Z"
              style="fill: rgb(245, 245, 245); transform-origin: 412.66px 122.045px;" id="el2iaqqzqfmbo"
              class="animable"></path>
            <polygon
              points="500 161.85 380.7 161.85 359.01 161.85 359.01 189.42 359.01 189.42 359.01 189.42 359.01 189.42 337.32 189.42 337.32 216.99 337.32 216.99 315.63 216.99 315.63 244.56 315.63 244.56 293.94 244.56 293.94 272.13 293.94 272.13 272.25 272.13 272.25 299.69 272.25 299.69 250.56 299.69 250.56 327.26 250.56 327.26 250.56 327.26 250.56 327.26 228.87 327.26 228.87 354.83 228.87 354.83 228.87 354.83 228.87 354.83 207.18 354.83 207.18 382.4 228.87 382.4 500 382.4 500 161.85"
              style="fill: rgb(250, 250, 250); transform-origin: 353.59px 272.125px;" id="elbz1vqy8fh7j"
              class="animable"></polygon>
            <rect x="204.95" y="354.83" width="123.63" height="8.27"
              style="fill: rgb(235, 235, 235); transform-origin: 266.765px 358.965px;" id="elwcm0o8hbd9c"
              class="animable"></rect>
            <rect x="226.64" y="327.26" width="123.63" height="8.27"
              style="fill: rgb(235, 235, 235); transform-origin: 288.455px 331.395px;" id="elrfsaynu70j"
              class="animable"></rect>
            <rect x="248.33" y="299.69" width="123.63" height="8.27"
              style="fill: rgb(235, 235, 235); transform-origin: 310.145px 303.825px;" id="elfnvm3ezebv6"
              class="animable"></rect>
            <rect x="270.02" y="272.12" width="123.63" height="8.27"
              style="fill: rgb(235, 235, 235); transform-origin: 331.835px 276.255px;" id="el2knrsjia09d"
              class="animable"></rect>
            <rect x="291.71" y="244.56" width="123.63" height="8.27"
              style="fill: rgb(235, 235, 235); transform-origin: 353.525px 248.695px;" id="eluyt3o84nup"
              class="animable"></rect>
            <rect x="313.4" y="216.99" width="123.63" height="8.27"
              style="fill: rgb(235, 235, 235); transform-origin: 375.215px 221.125px;" id="el5bqluriuiwe"
              class="animable"></rect>
            <rect x="335.09" y="189.42" width="123.63" height="8.27"
              style="fill: rgb(235, 235, 235); transform-origin: 396.905px 193.555px;" id="elzsf2q2f9nxs"
              class="animable"></rect>
            <rect x="356.78" y="161.85" width="123.63" height="8.27"
              style="fill: rgb(235, 235, 235); transform-origin: 418.595px 165.985px;" id="elo3cdwq1r44l"
              class="animable"></rect>
            <polygon
              points="478.31 161.85 478.31 189.42 478.31 189.42 478.31 189.42 478.31 189.42 456.62 189.42 456.62 216.99 456.62 216.99 456.62 216.99 456.62 216.99 434.93 216.99 434.93 244.56 434.93 244.56 434.93 244.56 434.93 244.56 413.24 244.56 413.24 272.13 413.24 272.13 391.55 272.13 391.55 299.69 391.55 299.69 369.86 299.69 369.86 327.26 369.86 327.26 348.17 327.26 348.17 354.83 348.17 354.83 326.48 354.83 326.48 382.4 348.17 382.4 500 382.4 500 189.42 500 161.85 478.31 161.85"
              style="fill: rgb(255, 255, 255); transform-origin: 413.24px 272.125px;" id="elv7o5lw6nfwa"
              class="animable"></polygon>
          </g>
          <g id="freepik--Shadow--inject-20" class="animable" style="transform-origin: 250px 416.24px;">
            <ellipse cx="250" cy="416.24" rx="193.89" ry="11.32"
              style="fill: rgb(245, 245, 245); transform-origin: 250px 416.24px;" id="elj2rcn7avf9" class="animable">
            </ellipse>
          </g>
          <g id="freepik--Character--inject-20" class="animable" style="transform-origin: 356.554px 275.525px;">
            <path
              d="M365.15,162c1.4,4.69,8.62,13.47,9.19,19.86s-11.74,16.61-11.74,16.61-9.2-30.76-3.44-34.35S365.15,162,365.15,162Z"
              style="fill: rgb(38, 50, 56); transform-origin: 365.812px 180.086px;" id="el6qsaz9e8gjw" class="animable">
            </path>
            <path
              d="M339.87,195.23c-2.18,1.82-4.32,3.35-6.55,4.92s-4.53,3-6.87,4.34a77.83,77.83,0,0,1-7.25,3.79c-1.26.57-2.51,1.13-3.81,1.62-.64.26-1.29.51-1.95.73l-2,.7a13.24,13.24,0,0,1-5.26.38,30.07,30.07,0,0,1-4.36-.84,57.61,57.61,0,0,1-7.81-2.78,104.07,104.07,0,0,1-14.19-7.55l1.87-3.48c2.36,1,4.78,2,7.18,2.87s4.82,1.79,7.24,2.54a60.74,60.74,0,0,0,7.2,1.88,23.5,23.5,0,0,0,3.39.41,7.07,7.07,0,0,0,2.52-.26,64.62,64.62,0,0,0,6.68-3c1.11-.58,2.21-1.17,3.29-1.81s2.18-1.26,3.25-1.92c2.15-1.33,4.25-2.74,6.33-4.19s4.15-3,6-4.47Z"
              style="fill: rgb(229, 138, 123); transform-origin: 309.845px 200.464px;" id="elhwk0c08dctb"
              class="animable"></path>
            <path
              d="M345.15,184.58c-2.48-1.94-12.74,4.41-15.85,7.06l2.27,13.73s14.75-6.18,15.63-10.4C348.13,190.56,347,186.06,345.15,184.58Z"
              style="fill: rgb(185, 215, 126); transform-origin: 338.416px 194.794px;" id="elcuxiw04k8fj"
              class="animable"></path>
            <g id="elp4qfskj6jzg">
              <path
                d="M345.15,184.58c-2.48-1.94-12.74,4.41-15.85,7.06l2.27,13.73s14.75-6.18,15.63-10.4C348.13,190.56,347,186.06,345.15,184.58Z"
                style="opacity: 0.2; transform-origin: 338.416px 194.794px;" class="animable"></path>
            </g>
            <path
              d="M379.66,226.13l-31.14,6.07c-16.09-43.57-12.59-45-12.59-45a62.53,62.53,0,0,1,7-3.3l.42-.16c2-.73,2.4-.84,5.06-1.62,4.58-1.09,8.85-2,14.14-2.75l1-.14c1-.12,1.91-.22,2.83-.31.62-.07,1.24-.11,1.83-.15l2-.11c3.42-.17,5.87-.12,5.87-.12C375.13,205.75,376.67,213.56,379.66,226.13Z"
              style="fill: rgb(185, 215, 126); transform-origin: 357.634px 205.367px;" id="el87l314l3sy6"
              class="animable"></path>
            <g id="el0kdkp1q6drbl">
              <path
                d="M379.66,226.13l-31.14,6.07c-16.09-43.57-12.59-45-12.59-45a62.53,62.53,0,0,1,7-3.3l.42-.16c2-.73,2.4-.84,5.06-1.62,4.58-1.09,8.85-2,14.14-2.75l1-.14c1-.12,1.91-.22,2.83-.31.62-.07,1.24-.11,1.83-.15l2-.11c3.42-.17,5.87-.12,5.87-.12C375.13,205.75,376.67,213.56,379.66,226.13Z"
                style="opacity: 0.2; transform-origin: 357.634px 205.367px;" class="animable"></path>
            </g>
            <path d="M355.27,165.13c-2,3.31,5.25,4.84,9.54,1.45,3.43-2.72,2.62-9-.32-10.46S355.27,165.13,355.27,165.13Z"
              style="fill: rgb(185, 215, 126); transform-origin: 360.993px 162.234px;" id="elbpxg8bnwad"
              class="animable"></path>
            <g id="el2m3ash3ezjc">
              <path
                d="M355.27,165.13c-2,3.31,5.25,4.84,9.54,1.45,3.43-2.72,2.62-9-.32-10.46S355.27,165.13,355.27,165.13Z"
                style="opacity: 0.4; transform-origin: 360.993px 162.234px;" class="animable"></path>
            </g>
            <polygon points="385.58 406.47 377.79 407.05 374.94 389.12 382.73 388.54 385.58 406.47"
              style="fill: rgb(229, 138, 123); transform-origin: 380.26px 397.795px;" id="els74jqv5tfm"
              class="animable"></polygon>
            <polygon points="440.68 381.41 434.07 385.57 422.3 371.61 428.91 367.44 440.68 381.41"
              style="fill: rgb(229, 138, 123); transform-origin: 431.49px 376.505px;" id="elm4oisc6pq19"
              class="animable"></polygon>
            <polygon points="374.94 389.12 376.52 399.08 384.2 397.79 382.74 388.55 374.94 389.12"
              style="fill: rgb(207, 111, 100); transform-origin: 379.57px 393.815px;" id="el2nkrrh5f1uv"
              class="animable"></polygon>
            <polygon points="428.92 367.45 422.3 371.61 427.18 377.39 433.94 373.4 428.92 367.45"
              style="fill: rgb(207, 111, 100); transform-origin: 428.12px 372.42px;" id="elx5gnsoeb1c" class="animable">
            </polygon>
            <path
              d="M349,232.2s-.11,61.82,4.94,85.1c5.26,24.22,20.73,79.32,20.73,79.32l11.22-1.45s-8.77-55.66-12.51-79.73c-4.07-26.23-1.57-87.68-1.57-87.68Z"
              style="fill: rgb(185, 215, 126); transform-origin: 367.445px 312.19px;" id="el2gtmm7n5tsx"
              class="animable"></path>
            <g id="ele7uxbmy4sw">
              <path
                d="M349,232.2s-.11,61.82,4.94,85.1c5.26,24.22,20.73,79.32,20.73,79.32l11.22-1.45s-8.77-55.66-12.51-79.73c-4.07-26.23-1.57-87.68-1.57-87.68Z"
                style="opacity: 0.7; transform-origin: 367.445px 312.19px;" class="animable"></path>
            </g>
            <g id="eltplw7habtx">
              <path d="M371.11,255.16l-5.5-5.48c.21,23.75,1.54,35.48,6.11,48.26C371,284.43,370.94,268.45,371.11,255.16Z"
                style="opacity: 0.5; transform-origin: 368.665px 273.81px;" class="animable"></path>
            </g>
            <path
              d="M356.74,230.6s16.77,51.09,25.09,80.52c8.78,31.05,42.44,65.39,42.44,65.39l9.66-5.58s-23-32.6-31.46-61.57c-17.2-58.81-10.13-71.27-22.82-83.23Z"
              style="fill: rgb(185, 215, 126); transform-origin: 395.335px 301.32px;" id="elgjqx6a9gwrm"
              class="animable"></path>
            <g id="elj2t95qp8sin">
              <path
                d="M356.74,230.6s16.77,51.09,25.09,80.52c8.78,31.05,42.44,65.39,42.44,65.39l9.66-5.58s-23-32.6-31.46-61.57c-17.2-58.81-10.13-71.27-22.82-83.23Z"
                style="opacity: 0.7; transform-origin: 395.335px 301.32px;" class="animable"></path>
            </g>
            <path
              d="M343.56,147.09c4.46,1.49,8.51,12.56,8.68,16.92s-12.92,10.37-12.92,10.37-5.77-14-4.16-23C335.86,147.47,343.56,147.09,343.56,147.09Z"
              style="fill: rgb(38, 50, 56); transform-origin: 343.559px 160.735px;" id="el5b1ttzgd7nv" class="animable">
            </path>
            <path d="M282.35,197.43l-5.29-5.76-1.73,7.22s3.76,3.32,6.8,2.18Z"
              style="fill: rgb(229, 138, 123); transform-origin: 278.84px 196.489px;" id="elymdcirl9h1k"
              class="animable"></path>
            <polygon points="271.7 190.02 268 192.96 275.33 198.89 277.06 191.67 271.7 190.02"
              style="fill: rgb(229, 138, 123); transform-origin: 272.53px 194.455px;" id="el5bt8rpyvhll"
              class="animable"></polygon>
            <path
              d="M432,384.08l6.18-6.23a.63.63,0,0,1,.82-.06l5.63,4.18a1.25,1.25,0,0,1,.11,1.87c-2.2,2.13-3.36,3.05-6.08,5.79-1.67,1.69-3.94,4.32-6.25,6.65s-4.74.16-4-1c3.37-5.27,2.77-7.24,3-9.92A2,2,0,0,1,432,384.08Z"
              style="fill: rgb(38, 50, 56); transform-origin: 436.692px 387.491px;" id="el7292to29yde" class="animable">
            </path>
            <path
              d="M377.27,405.93h8.78a.66.66,0,0,1,.65.54l1.38,6.94a1.18,1.18,0,0,1-1.17,1.39c-3.07-.05-4.55-.23-8.41-.23-2.37,0-7.27.24-10.55.24s-3.63-3.24-2.28-3.53c6-1.32,8.35-3.13,10.32-4.87A2,2,0,0,1,377.27,405.93Z"
              style="fill: rgb(38, 50, 56); transform-origin: 376.514px 410.37px;" id="ela6raxflqko" class="animable">
            </path>
            <g id="elxmnk9uudts">
              <path d="M377.09,194.31l-4.8,2.86L377.83,218C376.62,211.69,377.16,204.76,377.09,194.31Z"
                style="fill: rgb(185, 215, 126); opacity: 0.27; mix-blend-mode: multiply; transform-origin: 375.06px 206.155px;"
                class="animable"></path>
            </g>
            <path
              d="M349.81,161.79c3.41,2.85,8.36,7,14.19,2.15,5-4.18,8.5-15.15-.47-15.55C358.84,148.18,349.81,161.79,349.81,161.79Z"
              style="fill: rgb(38, 50, 56); transform-origin: 359.437px 157.28px;" id="eltln8rxrjs8g" class="animable">
            </path>
            <path
              d="M358.05,163.74c0,4.72.73,13.23,4.5,15.65,0,0-.34,4.86-8.8,6.5-9.29,1.81-5.34-3.75-5.34-3.75,4.84-2.2,4-5.94,2.4-9.3Z"
              style="fill: rgb(229, 138, 123); transform-origin: 355.063px 174.996px;" id="el3z1niq4bpbg"
              class="animable"></path>
            <path
              d="M355.1,167.45l-4.28,5.39a15.19,15.19,0,0,1,.92,2.42c1.88-.66,4.13-3.3,3.94-5.37A6.83,6.83,0,0,0,355.1,167.45Z"
              style="fill: rgb(207, 111, 100); transform-origin: 353.256px 171.355px;" id="el2rj7nwzk61f"
              class="animable"></path>
            <path
              d="M358.5,152.9c1,7.69,1.61,10.92-1.47,15.57-4.63,7-14.29,6.55-17.58-.68-3-6.51-4.12-18,2.72-22.45A10.57,10.57,0,0,1,358.5,152.9Z"
              style="fill: rgb(229, 138, 123); transform-origin: 348.204px 158.529px;" id="elcifuhm21hpu"
              class="animable"></path>
            <path
              d="M345.14,139.43c-5.2,3.69,5.23,4.78,5.24,10.13,0,2.21,3.63,9.22,8.79,8.82l5-8.88C369.43,141,357,131,345.14,139.43Z"
              style="fill: rgb(38, 50, 56); transform-origin: 354.549px 147.318px;" id="el5n75p66igtd" class="animable">
            </path>
            <path
              d="M345.14,139.43c-9.15-.48-13.14,6.8-12.09,13.34a59.6,59.6,0,0,1,19.54-1.55C365.13,152.5,345.14,139.43,345.14,139.43Z"
              style="fill: rgb(38, 50, 56); transform-origin: 344.805px 146.089px;" id="eljphgo73x01m" class="animable">
            </path>
            <path
              d="M361,159.53a5.65,5.65,0,0,1-1.31,4.12c-1.29,1.51-3,.62-3.6-1.17-.51-1.62-.45-4.35,1.29-5.21A2.55,2.55,0,0,1,361,159.53Z"
              style="fill: rgb(229, 138, 123); transform-origin: 358.416px 160.726px;" id="elq1h1cqvm909"
              class="animable"></path>
            <path
              d="M347.39,157.27c.12.62-.11,1.18-.51,1.26s-.83-.36-.95-1,.11-1.19.51-1.27S347.27,156.65,347.39,157.27Z"
              style="fill: rgb(38, 50, 56); transform-origin: 346.66px 157.395px;" id="el0m9az2w3y1e" class="animable">
            </path>
            <path d="M340.4,158.63c.12.62-.11,1.19-.51,1.27s-.83-.36-.95-1,.11-1.19.51-1.26S340.28,158,340.4,158.63Z"
              style="fill: rgb(38, 50, 56); transform-origin: 339.67px 158.771px;" id="elcygztxs8c34" class="animable">
            </path>
            <path d="M339.64,157.65l-1.57-.13S339.06,158.53,339.64,157.65Z"
              style="fill: rgb(38, 50, 56); transform-origin: 338.855px 157.765px;" id="el9zkb0c7g62p" class="animable">
            </path>
            <path d="M342.46,159.34a17.1,17.1,0,0,1-1.44,4.37,2.71,2.71,0,0,0,2.29,0Z"
              style="fill: rgb(223, 87, 83); transform-origin: 342.165px 161.652px;" id="elki7udrudt5" class="animable">
            </path>
            <path
              d="M345.92,165.71a.18.18,0,0,1-.18-.15.18.18,0,0,1,.15-.21,5,5,0,0,0,3.62-2.7.18.18,0,1,1,.34.14,5.27,5.27,0,0,1-3.89,2.92Z"
              style="fill: rgb(38, 50, 56); transform-origin: 347.801px 164.122px;" id="el7eqkh44n58p" class="animable">
            </path>
            <path
              d="M349,154.61a.38.38,0,0,1-.25-.09,2.94,2.94,0,0,0-2.56-.76A.37.37,0,0,1,346,153a3.71,3.71,0,0,1,3.25.93.37.37,0,0,1,0,.52A.36.36,0,0,1,349,154.61Z"
              style="fill: rgb(38, 50, 56); transform-origin: 347.531px 153.77px;" id="elag557ehqyqi" class="animable">
            </path>
            <path
              d="M336.53,156a.32.32,0,0,1-.14,0,.37.37,0,0,1-.2-.49,3.67,3.67,0,0,1,2.53-2.23.36.36,0,0,1,.43.3.36.36,0,0,1-.29.43,3,3,0,0,0-2,1.79A.38.38,0,0,1,336.53,156Z"
              style="fill: rgb(38, 50, 56); transform-origin: 337.659px 154.64px;" id="el3esacy6uj84" class="animable">
            </path>
            <path
              d="M429.68,387.71a1.06,1.06,0,0,1-.86-.48.63.63,0,0,1-.11-.62c.35-.94,3.11-1.54,3.42-1.61a.19.19,0,0,1,.19.08.17.17,0,0,1,0,.2c-.54.89-1.6,2.38-2.59,2.43Zm2.09-2.25c-1.09.28-2.53.78-2.71,1.28a.25.25,0,0,0,.06.27.68.68,0,0,0,.6.33C430.25,387.31,431,386.62,431.77,385.46Z"
              style="fill: rgb(185, 215, 126); transform-origin: 430.512px 386.354px;" id="elf20hx6fbccq"
              class="animable"></path>
            <path
              d="M431.32,385.46c-1,0-2.25-.25-2.62-.79a.65.65,0,0,1,.07-.81,1,1,0,0,1,.73-.38h.08c1.12,0,2.66,1.51,2.72,1.57a.18.18,0,0,1,.05.18.19.19,0,0,1-.13.13A3.61,3.61,0,0,1,431.32,385.46Zm-1.74-1.61h-.06a.6.6,0,0,0-.46.24c-.14.19-.1.3-.05.37.3.46,1.83.72,2.77.61A4.42,4.42,0,0,0,429.58,383.85Z"
              style="fill: rgb(185, 215, 126); transform-origin: 430.474px 384.47px;" id="elpff3umkhqvc"
              class="animable"></path>
            <path
              d="M374.4,407.3a3,3,0,0,1-1.91-.48,1,1,0,0,1-.38-.89.58.58,0,0,1,.28-.5c.92-.54,4.14,1.06,4.5,1.24a.19.19,0,0,1,.1.19.19.19,0,0,1-.14.16A13.33,13.33,0,0,1,374.4,407.3Zm-1.48-1.62a.66.66,0,0,0-.34.07.19.19,0,0,0-.1.19.7.7,0,0,0,.25.6c.5.43,1.79.5,3.49.22A10.46,10.46,0,0,0,372.92,405.68Z"
              style="fill: rgb(185, 215, 126); transform-origin: 374.548px 406.315px;" id="el1pdjhb2trin"
              class="animable"></path>
            <path
              d="M376.81,407h-.07c-1-.43-2.93-2.13-2.79-3,0-.2.18-.46.68-.51h.15c1.74,0,2.19,3.18,2.21,3.32a.2.2,0,0,1-.07.18A.2.2,0,0,1,376.81,407Zm-2-3.16h-.11c-.32,0-.34.15-.34.19-.08.53,1.24,1.86,2.24,2.45C376.4,405.7,375.89,403.86,374.77,403.86Z"
              style="fill: rgb(185, 215, 126); transform-origin: 375.467px 405.247px;" id="el662ebdh0mcb"
              class="animable"></path>
            <path d="M346.63,156.29l-1.57-.14S346.05,157.17,346.63,156.29Z"
              style="fill: rgb(38, 50, 56); transform-origin: 345.845px 156.399px;" id="elqwr8ktg0tg" class="animable">
            </path>
            <path
              d="M353.5,192.54c-16.73,3.73-11.56-6.39-10.56-8.62l.42-.16c2-.73,2.4-.84,5.06-1.62a100.71,100.71,0,0,1,14.14-2.75l1-.14c1-.13,1.91-.23,2.83-.31.62-.07,1.24-.11,1.83-.15l2-.12h0C370.56,180.23,371.39,188.57,353.5,192.54Z"
              style="fill: rgb(229, 138, 123); transform-origin: 355.873px 186.014px;" id="ell75ibo5dyv7"
              class="animable"></path>
            <path
              d="M379.76,224.21l1.95,2.52c.15.19-.06.46-.42.53l-32.66,6.36c-.28.06-.54,0-.59-.21l-.83-2.73c0-.19.16-.4.46-.46l31.54-6.14A.57.57,0,0,1,379.76,224.21Z"
              style="fill: rgb(38, 57, 90); transform-origin: 364.485px 228.849px;" id="elcimdz3mtbvn" class="animable">
            </path>
            <path
              d="M376.21,228.56l.85-.16c.17,0,.28-.14.25-.25l-1.1-3.54c0-.11-.2-.16-.37-.13l-.84.16c-.17,0-.28.15-.25.25l1.1,3.55C375.88,228.54,376.05,228.6,376.21,228.56Z"
              style="fill: rgb(185, 215, 126); transform-origin: 376.03px 226.522px;" id="elb9rpuls8q2m"
              class="animable"></path>
            <path d="M357.08,240.36l-6.51-2.42,1,6.19s4.72,1.7,7.13-.48Z"
              style="fill: rgb(229, 138, 123); transform-origin: 354.635px 241.351px;" id="elvc5t8fqdggr"
              class="animable"></path>
            <polygon points="344.37 239.58 342.82 243.64 351.57 244.13 350.57 237.94 344.37 239.58"
              style="fill: rgb(229, 138, 123); transform-origin: 347.195px 241.035px;" id="el0fnezjwi6xh8"
              class="animable"></polygon>
            <path
              d="M351.06,233.46l.85-.16c.16,0,.28-.14.24-.25l-1.1-3.54c0-.11-.19-.16-.36-.13l-.85.16c-.17,0-.28.15-.24.25l1.1,3.55C350.73,233.44,350.89,233.5,351.06,233.46Z"
              style="fill: rgb(185, 215, 126); transform-origin: 350.875px 231.422px;" id="el487hftrmhor"
              class="animable"></path>
            <path
              d="M363.64,231l.84-.16c.17,0,.28-.14.25-.25l-1.1-3.54c0-.11-.2-.16-.37-.13l-.84.16c-.17,0-.28.15-.25.25l1.1,3.55A.32.32,0,0,0,363.64,231Z"
              style="fill: rgb(185, 215, 126); transform-origin: 363.45px 228.965px;" id="elrodlsy4g9aj"
              class="animable"></path>
            <path
              d="M360.08,175.42c.71-.27,1.6,2.23,1.38,2.55-.51.73-9.85,3.28-10.27,1.85a6.24,6.24,0,0,1,.35-2.28C351.81,177.06,353.88,177.94,360.08,175.42Z"
              style="fill: rgb(185, 215, 126); transform-origin: 356.34px 177.824px;" id="el5nci10kmb1w"
              class="animable"></path>
            <path d="M358.5,175.48c.36-.83,1.39-2.16,2.29-1.4s1.28,2.4.69,2.67S357.88,176.87,358.5,175.48Z"
              style="fill: rgb(185, 215, 126); transform-origin: 360.09px 175.357px;" id="el7x0ve6v3h12"
              class="animable"></path>
            <path d="M360.41,175.91c.62-.66,2-1.57,2.63-.55s.4,2.69-.24,2.74S359.36,177,360.41,175.91Z"
              style="fill: rgb(185, 215, 126); transform-origin: 361.795px 176.502px;" id="elqzzrxeshgi"
              class="animable"></path>
            <path
              d="M360.75,175.76a2.77,2.77,0,0,1,1.39-2.67c1.14-.74,2.25-1.22,2.69-2a5.52,5.52,0,0,1,.11,2.24c-.23,1.07-3.78,1.89-3.54,2.82Z"
              style="fill: rgb(185, 215, 126); transform-origin: 362.872px 173.62px;" id="elq9q5fye603r"
              class="animable"></path>
            <path
              d="M360.6,175.71a2.77,2.77,0,0,1-.28-3c.54-1.24,1.22-2.24,1.18-3.12a5.57,5.57,0,0,1,1.31,1.82c.38,1-2.15,3.63-1.44,4.29Z"
              style="fill: rgb(185, 215, 126); transform-origin: 361.427px 172.65px;" id="elvuobibxvlm"
              class="animable"></path>
            <path
              d="M430.15,371.06a.12.12,0,0,1-.1-.06c-.23-.32-23.09-32.94-31.47-61.6A420,420,0,0,1,386,253.32c-1.73-10.68-2.78-17.13-6.22-22.42a.13.13,0,0,1,0-.18.13.13,0,0,1,.17,0c3.48,5.34,4.53,11.81,6.26,22.52a421.15,421.15,0,0,0,12.6,56c8.37,28.62,31.21,61.2,31.44,61.53a.14.14,0,0,1,0,.17A.13.13,0,0,1,430.15,371.06Z"
              style="fill: rgb(185, 215, 126); transform-origin: 405.011px 300.874px;" id="elvbf8hpmddtq"
              class="animable"></path>
            <g id="elh1e3v6q9uhm">
              <path
                d="M430.15,371.06a.12.12,0,0,1-.1-.06c-.23-.32-23.09-32.94-31.47-61.6A420,420,0,0,1,386,253.32c-1.73-10.68-2.78-17.13-6.22-22.42a.13.13,0,0,1,0-.18.13.13,0,0,1,.17,0c3.48,5.34,4.53,11.81,6.26,22.52a421.15,421.15,0,0,0,12.6,56c8.37,28.62,31.21,61.2,31.44,61.53a.14.14,0,0,1,0,.17A.13.13,0,0,1,430.15,371.06Z"
                style="opacity: 0.4; transform-origin: 405.011px 300.874px;" class="animable"></path>
            </g>
            <polygon points="387.9 395.13 372.62 397.11 371.62 392.85 387.53 389.48 387.9 395.13"
              style="fill: rgb(185, 215, 126); transform-origin: 379.76px 393.295px;" id="elh3u2ra4fpz"
              class="animable"></polygon>
            <polygon points="434.74 370.59 423.47 377.1 419.67 373.85 432 365.51 434.74 370.59"
              style="fill: rgb(185, 215, 126); transform-origin: 427.205px 371.305px;" id="elnn2lkg8r2gg"
              class="animable"></polygon>
            <path
              d="M381.85,189.13c.54,2.78.85,5.4,1.15,8.11s.41,5.39.49,8.1a80.09,80.09,0,0,1-.18,8.19c-.11,1.37-.23,2.74-.42,4.12-.08.68-.17,1.37-.3,2.06l-.37,2.12a13.32,13.32,0,0,1-2.21,4.79,29.67,29.67,0,0,1-2.84,3.41,56.66,56.66,0,0,1-6.2,5.5,103.64,103.64,0,0,1-13.46,8.79L355.37,241c2-1.59,4-3.23,6-4.9s3.9-3.36,5.73-5.12a62.64,62.64,0,0,0,5.11-5.39,23.76,23.76,0,0,0,2-2.78,7,7,0,0,0,1-2.33,66.19,66.19,0,0,0,.57-7.32c0-1.25,0-2.5,0-3.75s-.05-2.52-.11-3.78c-.12-2.52-.35-5-.62-7.56s-.62-5.09-1-7.46Z"
              style="fill: rgb(229, 138, 123); transform-origin: 369.447px 216.725px;" id="elq547c6w56si"
              class="animable"></path>
            <path
              d="M380.64,180.63c4.27,3.46,3.25,13.74,3.25,13.74l-14.4,4.74s.66-11.85,1.38-16.11C371.71,177.93,376.43,177.22,380.64,180.63Z"
              style="fill: rgb(185, 215, 126); transform-origin: 376.743px 188.82px;" id="elcnerjiqcg4h"
              class="animable"></path>
            <g id="elj57kx4ffgl">
              <path
                d="M380.64,180.63c4.27,3.46,3.25,13.74,3.25,13.74l-14.4,4.74s.66-11.85,1.38-16.11C371.71,177.93,376.43,177.22,380.64,180.63Z"
                style="opacity: 0.2; transform-origin: 376.743px 188.82px;" class="animable"></path>
            </g>
          </g>
          <g id="freepik--Documents--inject-20" class="animable animator-active"
            style="transform-origin: 234.376px 260.956px;">
            <path
              d="M190.41,223.53h0A11,11,0,0,0,179.69,215h-80a11,11,0,0,0-11,11V403.82a11,11,0,0,0,11,11h254a11,11,0,0,0,11-11V254.45a11,11,0,0,0-11-11H215.44A25.68,25.68,0,0,1,190.41,223.53Z"
              style="fill: rgb(185, 215, 126); transform-origin: 226.69px 314.91px;" id="elz5pj5nxhbrk"
              class="animable"></path>
            <g id="elzbxiiw0vw5">
              <path
                d="M190.41,223.53h0A11,11,0,0,0,179.69,215h-80a11,11,0,0,0-11,11V403.82a11,11,0,0,0,11,11h254a11,11,0,0,0,11-11V254.45a11,11,0,0,0-11-11H215.44A25.68,25.68,0,0,1,190.41,223.53Z"
                style="opacity: 0.6; transform-origin: 226.69px 314.91px;" class="animable"></path>
            </g>
            <g id="el2ezerbmq8fd">
              <path d="M162.17,168.15l7.13,23.09a11.61,11.61,0,0,0,14.51,7.66l23.08-7.13Z"
                style="fill: rgb(185, 215, 126); opacity: 0.22; transform-origin: 184.53px 183.783px;" class="animable">
              </path>
            </g>
            <path
              d="M162.17,168.15l-82.5,25.49A11.59,11.59,0,0,0,72,208.14l47.1,152.48a11.6,11.6,0,0,0,14.51,7.66L239.2,335.66a11.59,11.59,0,0,0,7.66-14.5l-40-129.39Z"
              style="fill: rgb(185, 215, 126); transform-origin: 159.43px 268.474px;" id="elrbs11qx7dhk"
              class="animable"></path>
            <g id="elsosz3rttfqd">
              <path
                d="M162.17,168.15l-82.5,25.49A11.59,11.59,0,0,0,72,208.14l47.1,152.48a11.6,11.6,0,0,0,14.51,7.66L239.2,335.66a11.59,11.59,0,0,0,7.66-14.5l-40-129.39Z"
                style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 159.43px 268.474px;" class="animable">
              </path>
            </g>
            <g id="elqa9w4yritq">
              <g style="opacity: 0.28; transform-origin: 170.745px 334.76px;" class="animable">
                <path
                  d="M206.56,329l-68.64,21.2a5.08,5.08,0,0,1-6.34-3.34h0a5.08,5.08,0,0,1,3.35-6.33l68.64-21.21a5.08,5.08,0,0,1,6.34,3.35h0A5.08,5.08,0,0,1,206.56,329Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 170.745px 334.76px;" id="el76lyvewiceh"
                  class="animable"></path>
              </g>
            </g>
            <g id="elfghxfdkaxcr">
              <g style="opacity: 0.28; transform-origin: 113.045px 205.343px;" class="animable">
                <path
                  d="M132.69,204.58l-36.3,11.21a5.09,5.09,0,0,1-6.34-3.34h0a5.09,5.09,0,0,1,3.35-6.34l36.3-11.21a5.07,5.07,0,0,1,6.34,3.34h0A5.09,5.09,0,0,1,132.69,204.58Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 113.045px 205.343px;" id="el2egrg9ertik"
                  class="animable"></path>
              </g>
            </g>
            <g id="el280nusbonux">
              <g style="opacity: 0.28; transform-origin: 130.836px 220.89px;" class="animable">
                <path
                  d="M162.31,216.47l-60,18.53A5.08,5.08,0,0,1,96,231.65h0a5.07,5.07,0,0,1,3.34-6.33l60-18.53a5.08,5.08,0,0,1,6.34,3.34h0A5.1,5.1,0,0,1,162.31,216.47Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 130.836px 220.89px;" id="el1cy1d2vstlc"
                  class="animable"></path>
              </g>
            </g>
            <g id="elnqfe9ztquj">
              <g style="opacity: 0.28; transform-origin: 150.536px 235.821px;" class="animable">
                <path
                  d="M195.81,227.16l-87.56,27a5.07,5.07,0,0,1-6.33-3.34h0a5.09,5.09,0,0,1,3.34-6.34l87.56-27a5.08,5.08,0,0,1,6.33,3.34h0A5.08,5.08,0,0,1,195.81,227.16Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 150.536px 235.821px;" id="elmt1yym885h8"
                  class="animable"></path>
              </g>
            </g>
            <g id="el4gui4qlv5ry">
              <g style="opacity: 0.28; transform-origin: 174.8px 249.386px;" class="animable">
                <path
                  d="M201.74,246.36l-50.9,15.73a5.08,5.08,0,0,1-6.33-3.35h0a5.08,5.08,0,0,1,3.34-6.33l50.9-15.73a5.1,5.1,0,0,1,6.34,3.35h0A5.08,5.08,0,0,1,201.74,246.36Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 174.8px 249.386px;" id="elljhlzec55sk"
                  class="animable"></path>
              </g>
            </g>
            <g id="elix9d0mpp1zk">
              <g style="opacity: 0.28; transform-origin: 119.348px 266.516px;" class="animable">
                <path
                  d="M127.5,269.3l-13.31,4.11a5.08,5.08,0,0,1-6.34-3.34h0a5.08,5.08,0,0,1,3.35-6.34l13.31-4.11a5.09,5.09,0,0,1,6.34,3.34h0A5.1,5.1,0,0,1,127.5,269.3Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 119.348px 266.516px;" id="elqz0nouodyxk"
                  class="animable"></path>
              </g>
            </g>
            <g id="elj5s2t4v3zj">
              <g style="opacity: 0.28; transform-origin: 162.405px 274.255px;" class="animable">
                <path
                  d="M207.68,265.57l-87.56,27.05a5.08,5.08,0,0,1-6.33-3.35h0a5.07,5.07,0,0,1,3.34-6.33l87.56-27.05a5.08,5.08,0,0,1,6.33,3.34h0A5.08,5.08,0,0,1,207.68,265.57Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 162.405px 274.255px;" id="elmb4whyveyt8"
                  class="animable"></path>
              </g>
            </g>
            <g id="ell8sstxjux2">
              <g style="opacity: 0.28; transform-origin: 151.446px 298.675px;" class="animable">
                <path
                  d="M179.82,295.21l-53.77,16.61a5.08,5.08,0,0,1-6.33-3.34h0a5.09,5.09,0,0,1,3.34-6.34l53.77-16.61a5.09,5.09,0,0,1,6.34,3.35h0A5.07,5.07,0,0,1,179.82,295.21Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 151.446px 298.675px;" id="elkt0tzlmeyj"
                  class="animable"></path>
              </g>
            </g>
            <g id="elnfsyc7xwez">
              <g style="opacity: 0.28; transform-origin: 204.937px 282.153px;" class="animable">
                <path
                  d="M213.61,284.78l-14.35,4.43a5.09,5.09,0,0,1-6.34-3.35h0a5.08,5.08,0,0,1,3.35-6.33l14.35-4.43a5.07,5.07,0,0,1,6.33,3.34h0A5.08,5.08,0,0,1,213.61,284.78Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 204.937px 282.153px;" id="el674ss2yqokw"
                  class="animable"></path>
              </g>
            </g>
            <g id="el1vxsm3w4myx">
              <g style="opacity: 0.28; transform-origin: 174.285px 312.637px;" class="animable">
                <path
                  d="M219.54,304,132,331a5.08,5.08,0,0,1-6.34-3.35h0a5.07,5.07,0,0,1,3.35-6.33l87.55-27.05a5.1,5.1,0,0,1,6.34,3.35h0A5.08,5.08,0,0,1,219.54,304Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 174.285px 312.637px;" id="elv5vr2o6wnp9"
                  class="animable"></path>
              </g>
            </g>
            <path
              d="M221.42,110.81l26.18,58.34a6.31,6.31,0,0,1-3.16,8.32L133.38,227.32a6.3,6.3,0,0,1-8.32-3.16L98.87,165.82a6.3,6.3,0,0,1,3.16-8.33l111.06-49.85a6.32,6.32,0,0,1,8.33,3.17Z"
              style="fill: rgb(185, 215, 126); transform-origin: 173.232px 167.482px;" id="el5p9u273bjqj"
              class="animable"></path>
            <g id="ell175al0xls">
              <path
                d="M221.42,110.81l26.18,58.34a6.31,6.31,0,0,1-3.16,8.32L133.38,227.32a6.3,6.3,0,0,1-8.32-3.16L98.87,165.82a6.3,6.3,0,0,1,3.16-8.33l111.06-49.85a6.32,6.32,0,0,1,8.33,3.17Z"
                style="opacity: 0.3; transform-origin: 173.232px 167.482px;" class="animable"></path>
            </g>
            <g id="el4pbu194wrib">
              <rect x="200.4" y="108.68" width="3.89" height="1"
                style="fill: rgb(185, 215, 126); transform-origin: 202.345px 109.18px; transform: rotate(-24.16deg);"
                class="animable"></rect>
            </g>
            <g id="elig6jwaxm80o">
              <rect x="184" y="114.19" width="12.13" height="1"
                style="fill: rgb(185, 215, 126); transform-origin: 190.065px 114.69px; transform: rotate(-24.16deg);"
                class="animable"></rect>
            </g>
            <g id="eliyuike3kil">
              <rect x="99.33" y="171.59" width="1" height="7.4"
                style="fill: rgb(185, 215, 126); transform-origin: 99.83px 175.29px; transform: rotate(-24.18deg);"
                class="animable"></rect>
            </g>
            <g id="eln1gwzmacfu">
              <path
                d="M217.7,107.43l-28.64,56.1a25.65,25.65,0,0,1-29.3,13.15L98.81,160.79a6.39,6.39,0,0,1,3.22-3.3l111.06-49.85A6.3,6.3,0,0,1,217.7,107.43Z"
                style="fill: rgb(185, 215, 126); opacity: 0.6; transform-origin: 158.255px 142.299px;" class="animable">
              </path>
            </g>
            <path
              d="M257.07,179.23l-86.18,5.32A11.6,11.6,0,0,0,160,196.84l9.83,159.28A11.6,11.6,0,0,0,182.14,367l110.3-6.81a11.58,11.58,0,0,0,10.86-12.29L295,212.73Z"
              style="fill: rgb(185, 215, 126); transform-origin: 231.651px 273.127px;" id="elwmr3qa132sc"
              class="animable"></path>
            <g id="eld00mqdz5r6q">
              <path
                d="M257.07,179.23l-86.18,5.32A11.6,11.6,0,0,0,160,196.84l9.83,159.28A11.6,11.6,0,0,0,182.14,367l110.3-6.81a11.58,11.58,0,0,0,10.86-12.29L295,212.73Z"
                style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 231.651px 273.127px;" class="animable">
              </path>
            </g>
            <g id="elzpkt0u58txc">
              <g style="opacity: 0.22; transform-origin: 226.12px 343.16px;" class="animable">
                <path
                  d="M262.28,346l-71.71,4.43a5.08,5.08,0,0,1-5.36-4.75h0a5.09,5.09,0,0,1,4.74-5.37l71.71-4.42a5.08,5.08,0,0,1,5.37,4.74h0A5.08,5.08,0,0,1,262.28,346Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 226.12px 343.16px;" id="elhynflnpx42"
                  class="animable"></path>
              </g>
            </g>
            <g id="el6bqy8r4t614">
              <g style="opacity: 0.22; transform-origin: 200.561px 203.775px;" class="animable">
                <path
                  d="M219.84,207.68,181.91,210a5.09,5.09,0,0,1-5.37-4.74h0a5.09,5.09,0,0,1,4.75-5.37l37.93-2.34a5.07,5.07,0,0,1,5.36,4.74h0A5.08,5.08,0,0,1,219.84,207.68Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 200.561px 203.775px;" id="elt6hhuilusg"
                  class="animable"></path>
              </g>
            </g>
            <g id="eldcbp93qq6wk">
              <g style="opacity: 0.22; transform-origin: 214.17px 223.095px;" class="animable">
                <path
                  d="M245.82,226.22l-62.67,3.86a5.07,5.07,0,0,1-5.37-4.74h0a5.08,5.08,0,0,1,4.75-5.37l62.66-3.86a5.07,5.07,0,0,1,5.37,4.74h0A5.08,5.08,0,0,1,245.82,226.22Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 214.17px 223.095px;" id="eld5ksegmwz1c"
                  class="animable"></path>
              </g>
            </g>
            <g id="elbg6ajuzcv8i">
              <g style="opacity: 0.22; transform-origin: 229.785px 242.271px;" class="animable">
                <path
                  d="M275.85,244.51l-91.46,5.64A5.09,5.09,0,0,1,179,245.4h0a5.07,5.07,0,0,1,4.74-5.36l91.47-5.65a5.08,5.08,0,0,1,5.36,4.75h0A5.08,5.08,0,0,1,275.85,244.51Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 229.785px 242.271px;" id="els4581fnrm6b"
                  class="animable"></path>
              </g>
            </g>
            <g id="elt4k0z2zxa2p">
              <g style="opacity: 0.22; transform-origin: 250.19px 261.155px;" class="animable">
                <path
                  d="M277.09,264.57l-53.17,3.28a5.08,5.08,0,0,1-5.37-4.74h0a5.07,5.07,0,0,1,4.74-5.37l53.17-3.28a5.07,5.07,0,0,1,5.37,4.74h0A5.08,5.08,0,0,1,277.09,264.57Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 250.19px 261.155px;" id="elrjhp90dwdos"
                  class="animable"></path>
              </g>
            </g>
            <g id="el397hy57qp5t">
              <g style="opacity: 0.22; transform-origin: 192.27px 264.725px;" class="animable">
                <path
                  d="M199.53,269.35l-13.91.86a5.07,5.07,0,0,1-5.36-4.74h0A5.08,5.08,0,0,1,185,260.1l13.91-.86a5.09,5.09,0,0,1,5.37,4.75h0A5.08,5.08,0,0,1,199.53,269.35Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 192.27px 264.725px;" id="el8skfx3ide6p"
                  class="animable"></path>
              </g>
            </g>
            <g id="elts1emir40rh">
              <g style="opacity: 0.22; transform-origin: 232.28px 282.395px;" class="animable">
                <path
                  d="M278.33,284.63l-91.47,5.64a5.08,5.08,0,0,1-5.37-4.74h0a5.09,5.09,0,0,1,4.75-5.37l91.46-5.64a5.08,5.08,0,0,1,5.37,4.75h0A5.07,5.07,0,0,1,278.33,284.63Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 232.28px 282.395px;" id="eluxju5gxf3l"
                  class="animable"></path>
              </g>
            </g>
            <g id="el9ri4nvj913">
              <g style="opacity: 0.22; transform-origin: 215.871px 303.55px;" class="animable">
                <path
                  d="M244.27,306.87l-56.17,3.47a5.09,5.09,0,0,1-5.37-4.75h0a5.08,5.08,0,0,1,4.75-5.36l56.17-3.47a5.08,5.08,0,0,1,5.36,4.75h0A5.06,5.06,0,0,1,244.27,306.87Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 215.871px 303.55px;" id="el4843ne0t98p"
                  class="animable"></path>
              </g>
            </g>
            <g id="elg8ojh6f1c2b">
              <g style="opacity: 0.22; transform-origin: 271.754px 300.105px;" class="animable">
                <path
                  d="M279.56,304.7l-15,.92a5.07,5.07,0,0,1-5.36-4.74h0a5.07,5.07,0,0,1,4.74-5.37l15-.92a5.07,5.07,0,0,1,5.37,4.74h0A5.09,5.09,0,0,1,279.56,304.7Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 271.754px 300.105px;" id="eldl1h97xvndm"
                  class="animable"></path>
              </g>
            </g>
            <g id="eljr28wkmog6">
              <g style="opacity: 0.22; transform-origin: 234.755px 322.525px;" class="animable">
                <path
                  d="M280.8,324.76l-91.46,5.64a5.08,5.08,0,0,1-5.37-4.74h0a5.08,5.08,0,0,1,4.74-5.37l91.47-5.64a5.07,5.07,0,0,1,5.36,4.74h0A5.07,5.07,0,0,1,280.8,324.76Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 234.755px 322.525px;" id="el7rmiwphr8nl"
                  class="animable"></path>
              </g>
            </g>
            <g id="elhw97a2qb31u">
              <path d="M257.07,179.23l1.49,24.12a11.6,11.6,0,0,0,12.29,10.87L295,212.73Z"
                style="fill: rgb(185, 215, 126); opacity: 0.22; transform-origin: 276.035px 196.736px;"
                class="animable"></path>
            </g>
            <g id="elxcyd75e5bg">
              <path
                d="M228.85,239.4h0a8.65,8.65,0,0,0-9-8.53H139.75c-6.07,0-12,4.93-13.14,11L95,403.82c-1.18,6.07,2.78,11,8.85,11h254c6.07,0,11.95-4.92,13.14-11l26.07-133.5c1.18-6.08-2.78-11-8.85-11H250C238,259.32,229.26,251.06,228.85,239.4Z"
                style="fill: rgb(185, 215, 126); opacity: 0.5; transform-origin: 246.03px 322.841px;" class="animable">
              </path>
            </g>
          </g>
          <defs>
            <filter id="active" height="200%">
              <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
              <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
              <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
              <feMerge>
                <feMergeNode in="OUTLINE"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
              </feMerge>
            </filter>
            <filter id="hover" height="200%">
              <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
              <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
              <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
              <feMerge>
                <feMergeNode in="OUTLINE"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
              </feMerge>
              <feColorMatrix type="matrix"
                values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 ">
              </feColorMatrix>
            </filter>
          </defs>
        </svg>
        <h5>Documentation</h5>
        <p>Vous pouver se documenter par ici</p>
      </div>
      <div class="col-lg-3 " data-aos="fade-up" data-aos-duration="15500">
        <svg class="animated" width="300" id="freepik_stories-reminders" xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
          xmlns:svgjs="http://svgjs.com/svgjs">
          <style>
            svg#freepik_stories-reminders:not(.animated) .animable {
              opacity: 0;
            }

            svg#freepik_stories-reminders.animated #freepik--background-complete--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideUp;
              animation-delay: 0s;
            }

            svg#freepik_stories-reminders.animated #freepik--Shadow--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideLeft;
              animation-delay: 0s;
            }

            svg#freepik_stories-reminders.animated #freepik--Desk--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomIn;
              animation-delay: 0s;
            }

            svg#freepik_stories-reminders.animated #freepik--Drawer--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideRight;
              animation-delay: 0s;
            }

            svg#freepik_stories-reminders.animated #freepik--device-1--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedRight;
              animation-delay: 0s;
            }

            svg#freepik_stories-reminders.animated #freepik--device-2--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomIn;
              animation-delay: 0s;
            }

            svg#freepik_stories-reminders.animated #freepik--Calendar--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideDown;
              animation-delay: 0s;
            }

            svg#freepik_stories-reminders.animated #freepik--Character--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedRight;
              animation-delay: 0s;
            }

            svg#freepik_stories-reminders.animated #freepik--Reminders--inject-2 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomIn;
              animation-delay: 0s;
            }

            @keyframes slideUp {
              0% {
                opacity: 0;
                transform: translateY(30px);
              }

              100% {
                opacity: 1;
                transform: inherit;
              }
            }

            @keyframes slideLeft {
              0% {
                opacity: 0;
                transform: translateX(-30px);
              }

              100% {
                opacity: 1;
                transform: translateX(0);
              }
            }

            @keyframes zoomIn {
              0% {
                opacity: 0;
                transform: scale(0.5);
              }

              100% {
                opacity: 1;
                transform: scale(1);
              }
            }

            @keyframes slideRight {
              0% {
                opacity: 0;
                transform: translateX(30px);
              }

              100% {
                opacity: 1;
                transform: translateX(0);
              }
            }

            @keyframes lightSpeedRight {
              from {
                transform: translate3d(50%, 0, 0) skewX(-20deg);
                opacity: 0;
              }

              60% {
                transform: skewX(10deg);
                opacity: 1;
              }

              80% {
                transform: skewX(-2deg);
              }

              to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
              }
            }

            @keyframes slideDown {
              0% {
                opacity: 0;
                transform: translateY(-30px);
              }

              100% {
                opacity: 1;
                transform: translateY(0);
              }
            }

            .animator-hidden {
              display: none;
            }
          </style>
          <g id="freepik--background-complete--inject-2" class="animable animator-hidden"
            style="transform-origin: 249.02px 228.92px;">
            <rect x="415.8" y="399.21" width="33.12" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 432.36px 399.335px;" id="ela27xrryp8tp"
              class="animable"></rect>
            <rect x="321.55" y="401.92" width="8.69" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 325.895px 402.045px;" id="elf0gc8dnyzp"
              class="animable"></rect>
            <rect x="395.61" y="389.92" width="19.19" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 405.205px 390.045px;" id="eleapwfqd0ftr"
              class="animable"></rect>
            <rect x="51.48" y="391.6" width="43.19" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 73.075px 391.725px;" id="el7tcli27be65"
              class="animable"></rect>
            <rect x="103.58" y="391.6" width="6.33" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 106.745px 391.725px;" id="elouaz7hihst"
              class="animable"></rect>
            <rect x="130.49" y="395.82" width="93.68" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 177.33px 395.945px;" id="eltmtflc36dol"
              class="animable"></rect>
            <path
              d="M236,338.51H42.94a5.71,5.71,0,0,1-5.71-5.71V61.37a5.71,5.71,0,0,1,5.71-5.7H236a5.71,5.71,0,0,1,5.71,5.7V332.8A5.71,5.71,0,0,1,236,338.51ZM42.94,55.92a5.46,5.46,0,0,0-5.46,5.45V332.8a5.47,5.47,0,0,0,5.46,5.46H236a5.47,5.47,0,0,0,5.46-5.46V61.37A5.46,5.46,0,0,0,236,55.92Z"
              style="fill: rgb(235, 235, 235); transform-origin: 139.47px 197.09px;" id="elbrxod8i109d"
              class="animable"></path>
            <path
              d="M452.33,338.51H259.23a5.71,5.71,0,0,1-5.7-5.71V61.37a5.71,5.71,0,0,1,5.7-5.7h193.1a5.71,5.71,0,0,1,5.71,5.7V332.8A5.71,5.71,0,0,1,452.33,338.51ZM259.23,55.92a5.45,5.45,0,0,0-5.45,5.45V332.8a5.46,5.46,0,0,0,5.45,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V61.37a5.46,5.46,0,0,0-5.46-5.45Z"
              style="fill: rgb(235, 235, 235); transform-origin: 355.785px 197.09px;" id="elyq10amh411j"
              class="animable"></path>
            <rect x="-0.98" y="383.11" width="500" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 249.02px 383.235px;" id="elm70sli7sy2"
              class="animable"></rect>
            <rect x="134.22" y="84.15" width="69.61" height="236.14"
              style="fill: rgb(250, 250, 250); transform-origin: 169.025px 202.22px;" id="el2i6pbnmcfhr"
              class="animable"></rect>
            <rect x="118.57" y="167.74" width="87.03" height="150.49"
              style="fill: rgb(224, 224, 224); transform-origin: 162.085px 242.985px;" id="elew34lcj5o58"
              class="animable"></rect>
            <polygon
              points="135.28 146.71 135.28 184.46 142.15 184.46 182.03 184.46 188.89 184.46 188.89 146.71 135.28 146.71"
              style="fill: rgb(224, 224, 224); transform-origin: 162.085px 165.585px;" id="elzlpvmmya4"
              class="animable"></polygon>
            <rect x="124.14" y="173.31" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 129.71px 178.88px;" id="elgk2uvrgwx2" class="animable">
            </rect>
            <rect x="145.72" y="173.31" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 151.29px 178.88px;" id="el9l5yaq58h5d"
              class="animable"></rect>
            <rect x="167.31" y="173.31" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 172.88px 178.88px;" id="ell7psvkr3m7p"
              class="animable"></rect>
            <rect x="188.89" y="173.31" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 194.46px 178.88px;" id="elps05kicb2uf"
              class="animable"></rect>
            <rect x="124.14" y="193.56" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 129.71px 199.13px;" id="el7tofr6uuq8m"
              class="animable"></rect>
            <rect x="145.72" y="193.56" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 151.29px 199.13px;" id="elv6v8lm5lep8"
              class="animable"></rect>
            <rect x="167.31" y="193.56" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 172.88px 199.13px;" id="eld6l2ghyyvzf"
              class="animable"></rect>
            <rect x="188.89" y="193.56" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 194.46px 199.13px;" id="el1qzls5s0f5y"
              class="animable"></rect>
            <rect x="124.14" y="213.8" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 129.71px 219.37px;" id="elxkpqynlyqup"
              class="animable"></rect>
            <rect x="145.72" y="213.8" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 151.29px 219.37px;" id="elg1efx04pgvp"
              class="animable"></rect>
            <rect x="167.31" y="213.8" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 172.88px 219.37px;" id="elm2f9152rw6" class="animable">
            </rect>
            <rect x="145.72" y="155.81" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 151.29px 161.38px;" id="elenvpbn10vt" class="animable">
            </rect>
            <rect x="167.31" y="155.81" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 172.88px 161.38px;" id="ell5cjyn2jpuj"
              class="animable"></rect>
            <rect x="188.89" y="213.8" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 194.46px 219.37px;" id="elv3t937nffbl"
              class="animable"></rect>
            <rect x="124.14" y="234.05" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 129.71px 239.62px;" id="elyu0dkj3f7np"
              class="animable"></rect>
            <rect x="145.72" y="234.05" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 151.29px 239.62px;" id="elka05m3n9t4e"
              class="animable"></rect>
            <rect x="167.31" y="234.05" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 172.88px 239.62px;" id="elv4cfl46irom"
              class="animable"></rect>
            <rect x="188.89" y="234.05" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 194.46px 239.62px;" id="elword165x82f"
              class="animable"></rect>
            <rect x="124.14" y="254.29" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 129.71px 259.86px;" id="el1wlbb27coja"
              class="animable"></rect>
            <rect x="145.72" y="254.29" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 151.29px 259.86px;" id="elm4se6l2qpqg"
              class="animable"></rect>
            <rect x="167.31" y="254.29" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 172.88px 259.86px;" id="elx25rdy9kggo"
              class="animable"></rect>
            <rect x="188.89" y="254.29" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 194.46px 259.86px;" id="elxsdqbo1fu08"
              class="animable"></rect>
            <rect x="124.14" y="274.54" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 129.71px 280.11px;" id="elcixqssdzcmr"
              class="animable"></rect>
            <rect x="145.72" y="274.54" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 151.29px 280.11px;" id="elnqhtfv8wwj" class="animable">
            </rect>
            <rect x="167.31" y="274.54" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 172.88px 280.11px;" id="el9xqz2pzk70r"
              class="animable"></rect>
            <rect x="188.89" y="274.54" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 194.46px 280.11px;" id="elbh8cdrmk4mm"
              class="animable"></rect>
            <rect x="124.14" y="294.78" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 129.71px 300.35px;" id="elvq8un94dct" class="animable">
            </rect>
            <rect x="145.72" y="294.78" width="11.14" height="11.14"
              style="fill: rgb(250, 250, 250); transform-origin: 151.29px 300.35px;" id="eljvu3t0srgn" class="animable">
            </rect>
            <rect x="167.31" y="294.78" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 172.88px 300.35px;" id="elb7o4omi204" class="animable">
            </rect>
            <rect x="188.89" y="294.78" width="11.14" height="11.14"
              style="fill: rgb(240, 240, 240); transform-origin: 194.46px 300.35px;" id="elp5d9afx12n9"
              class="animable"></rect>
            <g id="el8kjok9cbuvn">
              <rect x="134.08" y="84.15" width="69.61" height="236.14"
                style="fill: rgb(255, 255, 255); opacity: 0.1; transform-origin: 168.885px 202.22px;" class="animable">
              </rect>
            </g>
            <g id="eli77pygz0r2m">
              <g style="opacity: 0.3; transform-origin: 173.645px 202.225px;" class="animable">
                <polygon points="196.88 84.15 174.69 84.15 150.41 320.3 172.6 320.3 196.88 84.15"
                  style="fill: rgb(255, 255, 255); transform-origin: 173.645px 202.225px;" id="elkuey4vz18od"
                  class="animable"></polygon>
              </g>
            </g>
            <rect x="133.63" y="81.16" width="70.78" height="5.99"
              style="fill: rgb(224, 224, 224); transform-origin: 169.02px 84.155px;" id="elep94q1jh8dn"
              class="animable"></rect>
            <rect x="133.63" y="318.23" width="70.78" height="5.99"
              style="fill: rgb(235, 235, 235); transform-origin: 169.02px 321.225px;" id="elnwq47q4m2t"
              class="animable"></rect>
            <path d="M207.16,329.33H130.43v-254h76.73Zm-70.88-5.85h65V81.16h-65Z"
              style="fill: rgb(235, 235, 235); transform-origin: 168.795px 202.33px;" id="el9n9mijvk9qr"
              class="animable"></path>
            <rect x="58.29" y="84.15" width="69.61" height="236.14"
              style="fill: rgb(250, 250, 250); transform-origin: 93.095px 202.22px;" id="el5xso9ksvrdr"
              class="animable"></rect>
            <rect x="63.11" y="246" width="59.53" height="73.05"
              style="fill: rgb(230, 230, 230); transform-origin: 92.875px 282.525px;" id="el8m3yd10xivu"
              class="animable"></rect>
            <polygon
              points="117.45 254.1 103.6 254.1 99.79 254.1 95.98 254.1 95.98 261.72 99.79 261.72 103.6 261.72 117.45 261.72 117.45 254.1"
              style="fill: rgb(230, 230, 230); transform-origin: 106.715px 257.91px;" id="elearzjyn2jij"
              class="animable"></polygon>
            <polygon
              points="117.45 268.87 103.6 268.87 99.79 268.87 95.98 268.87 95.98 276.49 99.79 276.49 103.6 276.49 117.45 276.49 117.45 268.87"
              style="fill: rgb(250, 250, 250); transform-origin: 106.715px 272.68px;" id="el5ollr9ztzrr"
              class="animable"></polygon>
            <polygon
              points="117.45 283.63 103.6 283.63 99.79 283.63 95.98 283.63 95.98 291.25 99.79 291.25 103.6 291.25 117.45 291.25 117.45 283.63"
              style="fill: rgb(230, 230, 230); transform-origin: 106.715px 287.44px;" id="elsifp2qp3wco"
              class="animable"></polygon>
            <polygon
              points="117.45 298.39 103.6 298.39 97.72 298.39 95.98 298.39 95.98 306.01 97.72 306.01 103.6 306.01 117.45 306.01 117.45 298.39"
              style="fill: rgb(250, 250, 250); transform-origin: 106.715px 302.2px;" id="elcglvorxjxan"
              class="animable"></polygon>
            <polygon
              points="89.76 254.1 75.91 254.1 72.1 254.1 68.29 254.1 68.29 261.72 72.1 261.72 75.91 261.72 89.76 261.72 89.76 254.1"
              style="fill: rgb(250, 250, 250); transform-origin: 79.025px 257.91px;" id="el4ccv9fo50pl"
              class="animable"></polygon>
            <polygon
              points="89.76 268.87 75.91 268.87 70.54 268.87 68.29 268.87 68.29 276.49 70.54 276.49 75.91 276.49 89.76 276.49 89.76 268.87"
              style="fill: rgb(250, 250, 250); transform-origin: 79.025px 272.68px;" id="el4nrx4fgsz8i"
              class="animable"></polygon>
            <polygon
              points="89.76 283.63 75.91 283.63 72.1 283.63 68.29 283.63 68.29 291.25 72.1 291.25 75.91 291.25 89.76 291.25 89.76 283.63"
              style="fill: rgb(230, 230, 230); transform-origin: 79.025px 287.44px;" id="elpqa5voz7cf9"
              class="animable"></polygon>
            <polygon
              points="89.76 298.39 75.91 298.39 72.1 298.39 68.29 298.39 68.29 306.01 72.1 306.01 75.91 306.01 89.76 306.01 89.76 298.39"
              style="fill: rgb(250, 250, 250); transform-origin: 79.025px 302.2px;" id="elctztgyfliig" class="animable">
            </polygon>
            <g id="elc86hkj1hhcj">
              <rect x="58.06" y="84.15" width="69.61" height="236.14"
                style="fill: rgb(255, 255, 255); opacity: 0.1; transform-origin: 92.865px 202.22px;" class="animable">
              </rect>
            </g>
            <g id="elvfhxwo5uo0q">
              <g style="opacity: 0.3; transform-origin: 97.715px 202.225px;" class="animable">
                <polygon points="120.95 84.15 98.76 84.15 74.48 320.3 96.67 320.3 120.95 84.15"
                  style="fill: rgb(255, 255, 255); transform-origin: 97.715px 202.225px;" id="ellv475xmf4c"
                  class="animable"></polygon>
              </g>
            </g>
            <rect x="57.71" y="81.16" width="70.78" height="5.99"
              style="fill: rgb(224, 224, 224); transform-origin: 93.1px 84.155px;" id="elcjo2fu9r2w4" class="animable">
            </rect>
            <rect x="57.71" y="318.23" width="70.78" height="5.99"
              style="fill: rgb(235, 235, 235); transform-origin: 93.1px 321.225px;" id="ell9keiml55q" class="animable">
            </rect>
            <path d="M131.24,329.33H54.5v-254h76.74Zm-70.89-5.85h65V81.16h-65Z"
              style="fill: rgb(235, 235, 235); transform-origin: 92.87px 202.33px;" id="elxwkdzhkimug" class="animable">
            </path>
            <path
              d="M161.09,339.3a4.51,4.51,0,0,1,4.8-2.4,4.78,4.78,0,0,1,3.58,4.15,4,4,0,0,1,4.55-.12,4.53,4.53,0,0,1,1.84,4.41,3.35,3.35,0,0,1,4.87,1,3.78,3.78,0,0,1-1.49,5,2.41,2.41,0,0,1-.12,4.8,2.61,2.61,0,0,1,2.4,2.29,2.7,2.7,0,0,1-1.81,2.84,2.19,2.19,0,0,1,.52,3.39,2,2,0,0,1-3.11-1,.64.64,0,0,1-1,.16.72.72,0,0,1,.2-1.07,1.2,1.2,0,0,1-2.06-.53c.4,2.16-2.17,4.19-4,3.17a1.81,1.81,0,0,1-1.19,2.44,4.14,4.14,0,0,1-2.9-.57,6.53,6.53,0,0,0-2.85-1,8.93,8.93,0,0,0-2.54.71,7.65,7.65,0,0,1-7.76-2,3.31,3.31,0,0,1-5.54-.84,2.47,2.47,0,0,1-2.17,2,2.44,2.44,0,0,1-2.37-1.7c0,.47,0,.94-.07,1.41-1.93.46-3.83-2-3-3.93a3,3,0,0,1-2.86-2.61,3.1,3.1,0,0,1,2.14-3.3,5.83,5.83,0,0,1-.12-11.05,2.8,2.8,0,0,1,2.65.36,1.68,1.68,0,0,1,0,2.52,5.36,5.36,0,0,1,2.28-6,4.78,4.78,0,0,1,6,1.28,3,3,0,0,1,0-3.32,2.61,2.61,0,0,1,3-1,3,3,0,0,1,3.25-2.46,3.13,3.13,0,0,1,2.44,3.34,1.52,1.52,0,0,1,2.75-.52C162.15,338.88,161.09,339.3,161.09,339.3Z"
              style="fill: rgb(235, 235, 235); transform-origin: 158.328px 352.103px;" id="el1s0xo6o9g35"
              class="animable"></path>
            <path
              d="M160.55,353.68a2.77,2.77,0,0,1,2.06-.5,1.93,1.93,0,0,1,1.5,1.41,1.47,1.47,0,0,1-1,1.69c-.86.21-1.72-.5-2.59-.37a7.84,7.84,0,0,0-.91.27c-1.25.33-2.5-.49-3.54-1.26a4,4,0,0,1-1-.94,1.3,1.3,0,0,1-.1-1.3,1.68,1.68,0,0,1,1.71-.56,6.71,6.71,0,0,1,3.49,1.46l-.09-.6Z"
              style="fill: rgb(250, 250, 250); transform-origin: 159.49px 354.194px;" id="elxtwcuifp65d"
              class="animable"></path>
            <path
              d="M142.3,352.6a3.38,3.38,0,0,1,1.09-.58,1,1,0,0,1,.82,1.83,3.25,3.25,0,0,1-1.6.54c-.58.09-1.31.11-1.59-.4a1,1,0,0,1,.27-1.15,2.79,2.79,0,0,1,1.14-.57Z"
              style="fill: rgb(250, 250, 250); transform-origin: 142.871px 353.187px;" id="elbpiqoonjsof"
              class="animable"></path>
            <path
              d="M171.13,343.11a4,4,0,0,1,2.33,2.79c.08.37.07.84-.25,1a1,1,0,0,1-.79,0l-3.34-.79a4.81,4.81,0,0,1,1.5.8,1.61,1.61,0,0,1,.58,1.53,1.56,1.56,0,0,1-1.55,1,3.34,3.34,0,0,1-1.84-.74,2.3,2.3,0,0,1-1.16-1.71c0-.71.89-1.38,1.44-.92a12.14,12.14,0,0,1-3.59-1.63,3.45,3.45,0,0,1-1-1,1.4,1.4,0,0,1-.1-1.37c1.14-2.07,2.58,1,3.28,1.24C167.94,344,169.44,342.4,171.13,343.11Z"
              style="fill: rgb(250, 250, 250); transform-origin: 168.364px 345.4px;" id="elkebi0jvm9ub"
              class="animable"></path>
            <path
              d="M176.32,352a1.1,1.1,0,0,1-.29,1.16.71.71,0,0,1-1.07-.22,3.77,3.77,0,0,1,2,1.13c.47.63.35,1.73-.39,2a1.82,1.82,0,0,1-1.39-.31,25.35,25.35,0,0,1-3.45-2.27c.33.76-.47,1.63-1.3,1.7a4.05,4.05,0,0,1-2.32-.81c-.87-.53-1.87-1.34-1.64-2.34a1.7,1.7,0,0,1,2.16-1,5,5,0,0,1,2.09,1.61c-.47-.69.2-1.7,1-1.81a2.48,2.48,0,0,1,2.09,1c-.93-.51-1.14-1.83.11-2C174.76,349.64,176.13,351.29,176.32,352Z"
              style="fill: rgb(250, 250, 250); transform-origin: 171.838px 352.962px;" id="elkc7ey8kqcx"
              class="animable"></path>
            <path
              d="M150.82,349a1.35,1.35,0,1,1,.68,2.59,2.1,2.1,0,0,1,1.41.73,1.08,1.08,0,0,1,.3.84,1,1,0,0,1-1,.76,3.06,3.06,0,0,1-1.3-.36,2.34,2.34,0,0,1,1.28.37.82.82,0,0,1,.19,1.17,1.06,1.06,0,0,1-1.07.12,5.24,5.24,0,0,1-2.19-1.23,2.12,2.12,0,0,1-1.83.77,1.26,1.26,0,0,1-1-1.49,1.35,1.35,0,0,1,1.14-.83,3.45,3.45,0,0,1,1.45.23,2.78,2.78,0,0,1-1.17-1.28c-.17-.57.21-1.32.79-1.28s1,1,1.52,1.28C150.62,350.76,149.41,349.51,150.82,349Z"
              style="fill: rgb(250, 250, 250); transform-origin: 149.739px 352.107px;" id="elhewys3bifl"
              class="animable"></path>
            <path
              d="M162.73,346.23a2.71,2.71,0,0,1,1,2.42,2.79,2.79,0,0,1-1.43,2.47,2.28,2.28,0,0,1-2.94-1.77,3.23,3.23,0,0,1,1.8-3.23A1.76,1.76,0,0,1,162.73,346.23Z"
              style="fill: rgb(250, 250, 250); transform-origin: 161.545px 348.607px;" id="elu92ayrij2cn"
              class="animable"></path>
            <path
              d="M154.3,345.15l-.31.27a1.5,1.5,0,1,1,0,1.88,2.26,2.26,0,0,1-2.63-.5,1.71,1.71,0,0,1,.36-2.5,1.4,1.4,0,0,1,2,1.19l.36-.4Z"
              style="fill: rgb(250, 250, 250); transform-origin: 153.815px 346.012px;" id="elt3zuyovb4p8"
              class="animable"></path>
            <path
              d="M145,346.66a4.78,4.78,0,0,1,1.43,2,1.64,1.64,0,0,1-.95,2c-.81.21-1.57-.46-2-1.15a2.52,2.52,0,0,1-.5-2.12c.24-.71,1.27-1.13,1.78-.58Z"
              style="fill: rgb(250, 250, 250); transform-origin: 144.712px 348.628px;" id="el141zkoz8jobc"
              class="animable"></path>
            <path
              d="M158.4,341.77a1.37,1.37,0,0,1,1.9-.52,1.66,1.66,0,0,1,.59,2,2.14,2.14,0,0,1-1.72,1.24c-.92.1-2-.64-1.8-1.54a1.93,1.93,0,0,1-1.75.66,4.68,4.68,0,0,1-1.82-.68c-.76-.45-1.58-1.13-1.5-2a1.57,1.57,0,0,1,1.44-1.31,2.67,2.67,0,0,1,1.94.72,16.33,16.33,0,0,0,1.23,1.12,1.53,1.53,0,0,0,1.56.22Z"
              style="fill: rgb(250, 250, 250); transform-origin: 156.655px 342.058px;" id="elz9c1gm59unm"
              class="animable"></path>
            <polygon points="146.94 382.73 170.01 382.73 172.27 359.48 144.69 359.48 146.94 382.73"
              style="fill: rgb(235, 235, 235); transform-origin: 158.48px 371.105px;" id="elfi45q84ow0k"
              class="animable"></polygon>
            <polygon points="142.9 360.68 174.29 360.68 174.85 357.59 142.34 357.59 142.9 360.68"
              style="fill: rgb(245, 245, 245); transform-origin: 158.595px 359.135px;" id="el9divc3gp0gi"
              class="animable"></polygon>
            <rect x="276.27" y="106.88" width="164.01" height="73.62" rx="19.67"
              style="fill: rgb(224, 224, 224); transform-origin: 358.275px 143.69px;" id="elr8r96os07ha"
              class="animable"></rect>
            <rect x="267.63" y="107.42" width="164.01" height="73.62" rx="19.67"
              style="fill: rgb(235, 235, 235); transform-origin: 349.635px 144.23px;" id="eld6eam38zodl"
              class="animable"></rect>
            <path
              d="M289.85,114.36H410.39a13.74,13.74,0,0,1,13.74,13.74v13.73a0,0,0,0,1,0,0h-148a0,0,0,0,1,0,0V128.1A13.74,13.74,0,0,1,289.85,114.36Z"
              style="fill: rgb(224, 224, 224); transform-origin: 350.13px 128.095px;" id="eltjhi6t22cu"
              class="animable"></path>
            <path
              d="M276.11,145.54h148a0,0,0,0,1,0,0v13.73A13.74,13.74,0,0,1,410.39,173H289.85a13.74,13.74,0,0,1-13.74-13.74V145.54A0,0,0,0,1,276.11,145.54Z"
              style="fill: rgb(224, 224, 224); transform-origin: 350.11px 159.27px;" id="el50eb0y75kjr"
              class="animable"></path>
            <rect x="363.84" y="119.68" width="20.98" height="22.33"
              style="fill: rgb(230, 230, 230); transform-origin: 374.33px 130.845px;" id="elabgcpjs5gr5"
              class="animable"></rect>
            <rect x="358.46" y="119.68" width="5.37" height="22.33"
              style="fill: rgb(245, 245, 245); transform-origin: 361.145px 130.845px;" id="el219gd9pcocf"
              class="animable"></rect>
            <rect x="374.56" y="116.23" width="15.76" height="25.77"
              style="fill: rgb(230, 230, 230); transform-origin: 382.44px 129.115px;" id="elfyhpzsf52hl"
              class="animable"></rect>
            <rect x="370.01" y="116.23" width="4.56" height="25.77"
              style="fill: rgb(245, 245, 245); transform-origin: 372.29px 129.115px;" id="elz39h1wcm5ma"
              class="animable"></rect>
            <rect x="379.2" y="119.68" width="13.29" height="22.33"
              style="fill: rgb(235, 235, 235); transform-origin: 385.845px 130.845px;" id="elwzy2j57z2i8"
              class="animable"></rect>
            <rect x="376.16" y="119.68" width="3.03" height="22.33"
              style="fill: rgb(245, 245, 245); transform-origin: 377.675px 130.845px;" id="el2ngqqu87nty"
              class="animable"></rect>
            <rect x="390.07" y="123.46" width="17.43" height="18.55"
              style="fill: rgb(230, 230, 230); transform-origin: 398.785px 132.735px;" id="elgk3sgde79eg"
              class="animable"></rect>
            <rect x="385.61" y="123.46" width="4.46" height="18.55"
              style="fill: rgb(245, 245, 245); transform-origin: 387.84px 132.735px;" id="elnbtdj96sf38"
              class="animable"></rect>
            <rect x="398.98" y="120.6" width="13.09" height="21.41"
              style="fill: rgb(230, 230, 230); transform-origin: 405.525px 131.305px;" id="elfxf1i91nd0i"
              class="animable"></rect>
            <rect x="395.2" y="120.6" width="3.79" height="21.41"
              style="fill: rgb(245, 245, 245); transform-origin: 397.095px 131.305px;" id="eleofrs3gyvjf"
              class="animable"></rect>
            <rect x="402.84" y="123.46" width="12.72" height="18.55"
              style="fill: rgb(230, 230, 230); transform-origin: 409.2px 132.735px;" id="el4b51z8t8fn" class="animable">
            </rect>
            <rect x="400.31" y="123.46" width="2.52" height="18.55"
              style="fill: rgb(240, 240, 240); transform-origin: 401.57px 132.735px;" id="eljotihxdwe6"
              class="animable"></rect>
            <rect x="298.56" y="149.83" width="20.98" height="22.33"
              style="fill: rgb(230, 230, 230); transform-origin: 309.05px 160.995px;" id="elcryfacweib"
              class="animable"></rect>
            <rect x="293.18" y="149.83" width="5.37" height="22.33"
              style="fill: rgb(245, 245, 245); transform-origin: 295.865px 160.995px;" id="elj78egw13aba"
              class="animable"></rect>
            <rect x="309.28" y="146.39" width="15.76" height="25.77"
              style="fill: rgb(230, 230, 230); transform-origin: 317.16px 159.275px;" id="elss1suiy0fl"
              class="animable"></rect>
            <rect x="304.73" y="146.39" width="4.56" height="25.77"
              style="fill: rgb(245, 245, 245); transform-origin: 307.01px 159.275px;" id="elafk96j95r4"
              class="animable"></rect>
            <rect x="370.12" y="149.83" width="20.98" height="22.33"
              style="fill: rgb(230, 230, 230); transform-origin: 380.61px 160.995px;" id="el8pv1q7mdbnj"
              class="animable"></rect>
            <rect x="364.75" y="149.83" width="5.37" height="22.33"
              style="fill: rgb(245, 245, 245); transform-origin: 367.435px 160.995px;" id="el188wrzid87y"
              class="animable"></rect>
            <rect x="380.84" y="146.39" width="15.76" height="25.77"
              style="fill: rgb(230, 230, 230); transform-origin: 388.72px 159.275px;" id="elz2do7rqgxpc"
              class="animable"></rect>
            <rect x="376.29" y="146.39" width="4.56" height="25.77"
              style="fill: rgb(245, 245, 245); transform-origin: 378.57px 159.275px;" id="elf4luzl5jpn"
              class="animable"></rect>
            <rect x="313.92" y="149.83" width="13.29" height="22.33"
              style="fill: rgb(235, 235, 235); transform-origin: 320.565px 160.995px;" id="elh45p1fqxbur"
              class="animable"></rect>
            <rect x="310.88" y="149.83" width="3.04" height="22.33"
              style="fill: rgb(245, 245, 245); transform-origin: 312.4px 160.995px;" id="elhmye7w7ygsj"
              class="animable"></rect>
            <rect x="324.79" y="153.61" width="17.43" height="18.55"
              style="fill: rgb(230, 230, 230); transform-origin: 333.505px 162.885px;" id="elk9655yrewca"
              class="animable"></rect>
            <rect x="320.33" y="153.61" width="4.46" height="18.55"
              style="fill: rgb(245, 245, 245); transform-origin: 322.56px 162.885px;" id="eltcl8huh2o8h"
              class="animable"></rect>
            <rect x="333.7" y="150.75" width="13.09" height="21.41"
              style="fill: rgb(230, 230, 230); transform-origin: 340.245px 161.455px;" id="elwxdmfn7xp7d"
              class="animable"></rect>
            <rect x="329.92" y="150.75" width="3.79" height="21.41"
              style="fill: rgb(245, 245, 245); transform-origin: 331.815px 161.455px;" id="elia0slgcq03d"
              class="animable"></rect>
            <rect x="337.56" y="153.61" width="12.72" height="18.55"
              style="fill: rgb(230, 230, 230); transform-origin: 343.92px 162.885px;" id="el7c9cy8v8ow2"
              class="animable"></rect>
            <rect x="335.03" y="153.61" width="2.52" height="18.55"
              style="fill: rgb(240, 240, 240); transform-origin: 336.29px 162.885px;" id="el60p1vhp812k"
              class="animable"></rect>
          </g>
          <g id="freepik--Shadow--inject-2" class="animable" style="transform-origin: 245.18px 412.39px;">
            <ellipse id="freepik--path--inject-2" cx="245.18" cy="412.39" rx="193.89" ry="11.32"
              style="fill: rgb(245, 245, 245); transform-origin: 245.18px 412.39px;" class="animable"></ellipse>
          </g>
          <g id="freepik--Desk--inject-2" class="animable" style="transform-origin: 151.255px 354.295px;">
            <path
              d="M255.29,327.66v53.27A28.31,28.31,0,0,1,227,409.24H208.35a28.32,28.32,0,0,0,28.31-28.31V327.66a28.32,28.32,0,0,0-28.31-28.31H227A28.31,28.31,0,0,1,255.29,327.66Z"
              style="fill: rgb(185, 215, 126); transform-origin: 231.82px 354.295px;" id="elxyrdj3u2apk"
              class="animable"></path>
            <g id="elxktc00ysgyc">
              <path
                d="M255.29,327.66v53.27A28.31,28.31,0,0,1,227,409.24H208.35a28.32,28.32,0,0,0,28.31-28.31V327.66a28.32,28.32,0,0,0-28.31-28.31H227A28.31,28.31,0,0,1,255.29,327.66Z"
                style="opacity: 0.1; transform-origin: 231.82px 354.295px;" class="animable"></path>
            </g>
            <path
              d="M94.15,409.24H75.51a28.31,28.31,0,0,1-28.3-28.31V327.66a28.31,28.31,0,0,1,28.3-28.31H94.15a28.31,28.31,0,0,0-28.31,28.31v53.27A28.31,28.31,0,0,0,94.15,409.24Z"
              style="fill: rgb(185, 215, 126); transform-origin: 70.68px 354.295px;" id="eljqxubdthf5h"
              class="animable"></path>
            <path
              d="M94.15,409.24H75.51a28.31,28.31,0,0,1-28.3-28.31V327.66a28.31,28.31,0,0,1,28.3-28.31H94.15a28.31,28.31,0,0,0-28.31,28.31v53.27A28.31,28.31,0,0,0,94.15,409.24Z"
              style="fill: rgb(185, 215, 126); transform-origin: 70.68px 354.295px;" id="elt9f2juu0xih"
              class="animable"></path>
            <path
              d="M227,299.35H94.15a28.31,28.31,0,0,0-28.31,28.31v53.27a28.31,28.31,0,0,0,28.31,28.3H227a28.3,28.3,0,0,0,28.3-28.3V327.66A28.3,28.3,0,0,0,227,299.35Zm0,0H94.15a28.31,28.31,0,0,0-28.31,28.31v53.27a28.31,28.31,0,0,0,28.31,28.3H227a28.3,28.3,0,0,0,28.3-28.3V327.66A28.3,28.3,0,0,0,227,299.35Zm21.3,81.58a21.32,21.32,0,0,1-21.3,21.3H94.15a21.33,21.33,0,0,1-21.31-21.3V327.66a21.33,21.33,0,0,1,21.31-21.31H227a21.33,21.33,0,0,1,21.3,21.31Zm0,0a21.32,21.32,0,0,1-21.3,21.3H94.15a21.33,21.33,0,0,1-21.31-21.3V327.66a21.33,21.33,0,0,1,21.31-21.31H227a21.33,21.33,0,0,1,21.3,21.31Z"
              style="fill: rgb(185, 215, 126); transform-origin: 160.57px 354.29px;" id="elqbj5m5fs4y" class="animable">
            </path>
            <g id="elk8je3rc7vzl">
              <path
                d="M227,299.35H94.15a28.31,28.31,0,0,0-28.31,28.31v53.27a28.31,28.31,0,0,0,28.31,28.3H227a28.3,28.3,0,0,0,28.3-28.3V327.66A28.3,28.3,0,0,0,227,299.35Zm21.3,81.58a21.32,21.32,0,0,1-21.3,21.3H94.15a21.33,21.33,0,0,1-21.31-21.3V327.66a21.33,21.33,0,0,1,21.31-21.31H227a21.33,21.33,0,0,1,21.3,21.31Z"
                style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 160.57px 354.29px;" class="animable">
              </path>
            </g>
          </g>
          <g id="freepik--Drawer--inject-2" class="animable" style="transform-origin: 375.745px 347.76px;">
            <polygon points="322.26 409.25 410.18 409.25 413.11 293.51 316.29 293.51 322.26 409.25"
              style="fill: rgb(185, 215, 126); transform-origin: 364.7px 351.38px;" id="elqyitqzw8q1a" class="animable">
            </polygon>
            <g id="eln3zl21najs">
              <polygon points="322.26 409.25 410.18 409.25 413.11 293.51 316.29 293.51 322.26 409.25"
                style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 364.7px 351.38px;" class="animable">
              </polygon>
            </g>
            <polygon points="405.69 409.25 431.07 409.25 437.04 293.51 408.15 293.51 405.69 409.25"
              style="fill: rgb(185, 215, 126); transform-origin: 421.365px 351.38px;" id="elzyv7bkzfdb"
              class="animable"></polygon>
            <polygon points="307.02 295.46 401.92 295.46 402.12 286.27 306.52 286.27 307.02 295.46"
              style="fill: rgb(185, 215, 126); transform-origin: 354.32px 290.865px;" id="elrau2cw4rr1d"
              class="animable"></polygon>
            <g id="ellci0gzdg5v">
              <polygon points="307.02 295.46 401.92 295.46 402.12 286.27 306.52 286.27 307.02 295.46"
                style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 354.32px 290.865px;" class="animable">
              </polygon>
            </g>
            <polygon points="400.77 295.46 444.47 295.46 444.97 286.27 400.96 286.27 400.77 295.46"
              style="fill: rgb(185, 215, 126); transform-origin: 422.87px 290.865px;" id="el6d07u7e4z6s"
              class="animable"></polygon>
            <g id="el5y01bog8y7r">
              <polygon points="400.77 295.46 444.47 295.46 444.97 286.27 400.96 286.27 400.77 295.46"
                style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 422.87px 290.865px;" class="animable">
              </polygon>
            </g>
            <polygon points="323.55 318.27 401.65 318.27 401.94 300.66 322.73 300.66 323.55 318.27"
              style="fill: rgb(185, 215, 126); transform-origin: 362.335px 309.465px;" id="elerbh4pmbfkt"
              class="animable"></polygon>
            <g id="elm8wj2q9c4cq">
              <polygon points="323.55 318.27 401.65 318.27 401.94 300.66 322.73 300.66 323.55 318.27"
                style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 362.335px 309.465px;" class="animable">
              </polygon>
            </g>
            <path
              d="M358.76,309.83a2.4,2.4,0,0,1-2.28-2.44,2.3,2.3,0,0,1,2.2-2.45h2.95a2.39,2.39,0,0,1,2.28,2.45,2.3,2.3,0,0,1-2.2,2.44Z"
              style="fill: rgb(185, 215, 126); transform-origin: 360.195px 307.385px;" id="elavs70za5id"
              class="animable"></path>
            <g id="elwq01kbqje8">
              <path
                d="M358.76,309.83a2.4,2.4,0,0,1-2.28-2.44,2.3,2.3,0,0,1,2.2-2.45h2.95a2.39,2.39,0,0,1,2.28,2.45,2.3,2.3,0,0,1-2.2,2.44Z"
                style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 360.195px 307.385px;" class="animable">
              </path>
            </g>
            <path
              d="M356.48,307.39a2.4,2.4,0,0,0,2.28,2.44,2.29,2.29,0,0,0,2.2-2.44,2.4,2.4,0,0,0-2.28-2.45A2.3,2.3,0,0,0,356.48,307.39Z"
              style="fill: rgb(185, 215, 126); transform-origin: 358.72px 307.385px;" id="eluxoy7r40bpk"
              class="animable"></path>
            <g id="el6420vq9otdd">
              <path
                d="M356.48,307.39a2.4,2.4,0,0,0,2.28,2.44,2.29,2.29,0,0,0,2.2-2.44,2.4,2.4,0,0,0-2.28-2.45A2.3,2.3,0,0,0,356.48,307.39Z"
                style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 358.72px 307.385px;" class="animable">
              </path>
            </g>
            <polygon points="324.58 340.26 401.29 340.26 401.57 323.28 323.79 323.28 324.58 340.26"
              style="fill: rgb(185, 215, 126); transform-origin: 362.68px 331.77px;" id="el9lp79dzs9lj"
              class="animable"></polygon>
            <g id="eln4c57k5x1ep">
              <polygon points="324.58 340.26 401.29 340.26 401.57 323.28 323.79 323.28 324.58 340.26"
                style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 362.68px 331.77px;" class="animable">
              </polygon>
            </g>
            <path
              d="M359.17,332.12a2.34,2.34,0,0,1-2.25-2.35,2.23,2.23,0,0,1,2.16-2.36H362a2.34,2.34,0,0,1,2.25,2.36,2.25,2.25,0,0,1-2.17,2.35Z"
              style="fill: rgb(185, 215, 126); transform-origin: 360.584px 329.765px;" id="elrheza9n55f"
              class="animable"></path>
            <g id="el4e3dzfy55ap">
              <path
                d="M359.17,332.12a2.34,2.34,0,0,1-2.25-2.35,2.23,2.23,0,0,1,2.16-2.36H362a2.34,2.34,0,0,1,2.25,2.36,2.25,2.25,0,0,1-2.17,2.35Z"
                style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 360.584px 329.765px;" class="animable">
              </path>
            </g>
            <path
              d="M356.92,329.77a2.34,2.34,0,0,0,2.25,2.35,2.24,2.24,0,0,0,2.16-2.35,2.34,2.34,0,0,0-2.25-2.36A2.24,2.24,0,0,0,356.92,329.77Z"
              style="fill: rgb(185, 215, 126); transform-origin: 359.125px 329.765px;" id="eludzdb40be8"
              class="animable"></path>
            <g id="ely6nw4xd8cf">
              <path
                d="M356.92,329.77a2.34,2.34,0,0,0,2.25,2.35,2.24,2.24,0,0,0,2.16-2.35,2.34,2.34,0,0,0-2.25-2.36A2.24,2.24,0,0,0,356.92,329.77Z"
                style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 359.125px 329.765px;" class="animable">
              </path>
            </g>
            <polygon points="325.57 402.49 400.94 402.49 401.21 345.1 324.81 345.1 325.57 402.49"
              style="fill: rgb(185, 215, 126); transform-origin: 363.01px 373.795px;" id="eldg7ogeya42v"
              class="animable"></polygon>
            <g id="elekzx325t2d">
              <g style="opacity: 0.4; transform-origin: 363.01px 373.795px;" class="animable">
                <polygon points="325.57 402.49 400.94 402.49 401.21 345.1 324.81 345.1 325.57 402.49"
                  style="fill: rgb(255, 255, 255); transform-origin: 363.01px 373.795px;" id="el1zhzjzoigmq"
                  class="animable"></polygon>
              </g>
            </g>
            <path
              d="M359.56,353.63a2.27,2.27,0,0,1-2.21-2.27,2.18,2.18,0,0,1,2.12-2.28h2.86a2.27,2.27,0,0,1,2.2,2.28,2.18,2.18,0,0,1-2.13,2.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 360.94px 351.355px;" id="elwhj6un3t7ci"
              class="animable"></path>
            <g id="el9dzvld5k2w">
              <path
                d="M359.56,353.63a2.27,2.27,0,0,1-2.21-2.27,2.18,2.18,0,0,1,2.12-2.28h2.86a2.27,2.27,0,0,1,2.2,2.28,2.18,2.18,0,0,1-2.13,2.27Z"
                style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 360.94px 351.355px;" class="animable">
              </path>
            </g>
            <path
              d="M357.35,351.36a2.27,2.27,0,0,0,2.21,2.27,2.17,2.17,0,0,0,2.12-2.27,2.27,2.27,0,0,0-2.21-2.28A2.18,2.18,0,0,0,357.35,351.36Z"
              style="fill: rgb(185, 215, 126); transform-origin: 359.515px 351.355px;" id="elb3l09l5nh1f"
              class="animable"></path>
            <g id="elqaq87b8tl5">
              <path
                d="M357.35,351.36a2.27,2.27,0,0,0,2.21,2.27,2.17,2.17,0,0,0,2.12-2.27,2.27,2.27,0,0,0-2.21-2.28A2.18,2.18,0,0,0,357.35,351.36Z"
                style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 359.515px 351.355px;" class="animable">
              </path>
            </g>
          </g>
          <g id="freepik--device-1--inject-2" class="animable" style="transform-origin: 145.888px 257.464px;">
            <path d="M194,299.35h15.68V298a4.77,4.77,0,0,0-5-4.76l-6.14.33a4.77,4.77,0,0,0-4.51,4.76Z"
              style="fill: rgb(185, 215, 126); transform-origin: 201.84px 296.292px;" id="elonvupth4og"
              class="animable"></path>
            <g id="elyjcytxl0v2r">
              <path d="M194,299.35h15.68V298a4.77,4.77,0,0,0-5-4.76l-6.14.33a4.77,4.77,0,0,0-4.51,4.76Z"
                style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 201.84px 296.292px;" class="animable">
              </path>
            </g>
            <path d="M119.82,299.35h23.64l3.76-33a2.31,2.31,0,0,0-2.31-2.21H129.07a2.32,2.32,0,0,0-2.32,2.21Z"
              style="fill: rgb(185, 215, 126); transform-origin: 133.52px 281.745px;" id="el0fcep7a0ei55"
              class="animable"></path>
            <g id="el95wlrxr52bm">
              <path d="M119.82,299.35h23.64l3.76-33a2.31,2.31,0,0,0-2.31-2.21H129.07a2.32,2.32,0,0,0-2.32,2.21Z"
                style="opacity: 0.6; transform-origin: 133.52px 281.745px;" class="animable"></path>
            </g>
            <path d="M83.73,215.58h5.91l6.63,62.35h-5.9a2,2,0,0,1-2-1.77l-6.26-58.8A1.57,1.57,0,0,1,83.73,215.58Z"
              style="fill: rgb(185, 215, 126); transform-origin: 89.1828px 246.754px;" id="elqv6dqxq2ndh"
              class="animable"></path>
            <g id="eluynvymovrv">
              <path d="M83.73,215.58h5.91l6.63,62.35h-5.9a2,2,0,0,1-2-1.77l-6.26-58.8A1.57,1.57,0,0,1,83.73,215.58Z"
                style="opacity: 0.6; transform-origin: 89.1828px 246.754px;" class="animable"></path>
            </g>
            <path
              d="M92.86,277.93h88.46a1.56,1.56,0,0,0,1.58-1.77l-6.25-58.8a2,2,0,0,0-2-1.78H86.23a1.56,1.56,0,0,0-1.58,1.78l6.25,58.8A2,2,0,0,0,92.86,277.93Z"
              style="fill: rgb(185, 215, 126); transform-origin: 133.774px 246.755px;" id="el5ipobgcbfm"
              class="animable"></path>
            <path
              d="M94.52,272.17h83.41a1.36,1.36,0,0,0,1.38-1.54l-5.46-51.31a1.75,1.75,0,0,0-1.71-1.54H88.73a1.36,1.36,0,0,0-1.38,1.54l5.46,51.31A1.75,1.75,0,0,0,94.52,272.17Z"
              style="fill: rgb(185, 215, 126); transform-origin: 133.33px 244.975px;" id="elle2ybtputs"
              class="animable"></path>
            <g id="elzp7paa9cynm">
              <path
                d="M94.52,272.17h83.41a1.36,1.36,0,0,0,1.38-1.54l-5.46-51.31a1.75,1.75,0,0,0-1.71-1.54H88.73a1.36,1.36,0,0,0-1.38,1.54l5.46,51.31A1.75,1.75,0,0,0,94.52,272.17Z"
                style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 133.33px 244.975px;" class="animable">
              </path>
            </g>
            <g id="elu6q5fszk4e">
              <rect x="117.65" y="296.78" width="31.64" height="2.56" rx="0.96"
                style="fill: rgb(185, 215, 126); transform-origin: 133.47px 298.06px; transform: rotate(-180deg);"
                class="animable"></rect>
            </g>
            <g id="eleinyus3o2j">
              <rect x="117.65" y="296.78" width="31.64" height="2.56" rx="0.96"
                style="opacity: 0.6; transform-origin: 133.47px 298.06px; transform: rotate(-180deg);" class="animable">
              </rect>
            </g>
            <path d="M178.24,272.17l-24.79-21.54c-2.35-2-5.37-2-6.73,0l-14.36,21.54Z"
              style="fill: rgb(235, 235, 235); transform-origin: 155.3px 260.65px;" id="elx5d990wwzlr" class="animable">
            </path>
            <path
              d="M153.45,250.63l24.79,21.54H154.47c2.37-1.2,7.95-1.84,7.29-4.58-.86-3.57-11.92-2.32-12.74-5.71s7.06-2.32,6.07-6.43c-.52-2.16-2.56-4.5-4.39-6.24A6.16,6.16,0,0,1,153.45,250.63Z"
              style="fill: rgb(245, 245, 245); transform-origin: 163.6px 260.69px;" id="ellecugvcgx1o" class="animable">
            </path>
            <path d="M141.76,272.17l-11-10.87c-1.05-1-2.38-1-3,0l-6.36,10.87Z"
              style="fill: rgb(235, 235, 235); transform-origin: 131.58px 266.36px;" id="el25macsr2qmr"
              class="animable"></path>
            <path
              d="M130.78,261.3l11,10.87H131.23c1.05-.6,3.52-.93,3.23-2.31-.38-1.8-5.28-1.17-5.65-2.88s3.13-1.17,2.69-3.24a7.66,7.66,0,0,0-1.94-3.15A2.67,2.67,0,0,1,130.78,261.3Z"
              style="fill: rgb(250, 250, 250); transform-origin: 135.281px 266.38px;" id="eltux6ancb59"
              class="animable"></path>
            <path d="M123,272.17,107.57,261.3c-1.46-1-3.33-1-4.18,0l-8.92,10.87Z"
              style="fill: rgb(235, 235, 235); transform-origin: 108.735px 266.36px;" id="el4p6nwc7ocfd"
              class="animable"></path>
            <path
              d="M107.57,261.3,123,272.17H108.2c1.47-.6,4.94-.93,4.53-2.31-.54-1.8-7.4-1.17-7.91-2.88s4.38-1.17,3.77-3.24a7.83,7.83,0,0,0-2.73-3.15A4.22,4.22,0,0,1,107.57,261.3Z"
              style="fill: rgb(250, 250, 250); transform-origin: 113.891px 266.38px;" id="el2q3crk6ijbw"
              class="animable"></path>
            <path
              d="M183.64,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.42.42,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,183.64,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 184.748px 295.68px;" id="eldbetgd1tax"
              class="animable"></path>
            <path
              d="M180.59,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,180.59,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 181.698px 295.68px;" id="elcczua6z6sy"
              class="animable"></path>
            <path
              d="M177.55,297.27h2.2a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,177.55,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 178.649px 295.68px;" id="eljgubxzb2jhm"
              class="animable"></path>
            <path
              d="M174.5,297.27h2.2a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,174.5,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 175.599px 295.68px;" id="el6xuel8jtquq"
              class="animable"></path>
            <path
              d="M171.45,297.27h2.2a.43.43,0,0,0,.43-.43v-2.33a.42.42,0,0,0-.43-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,171.45,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 172.554px 295.68px;" id="elpwuzlaytx8h"
              class="animable"></path>
            <path
              d="M168.4,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42H169a.41.41,0,0,0-.4.31l-.63,2.34A.43.43,0,0,0,168.4,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 169.494px 295.68px;" id="elbzp4spo2o4v"
              class="animable"></path>
            <path
              d="M165.35,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42H166a.42.42,0,0,0-.4.31l-.63,2.34A.43.43,0,0,0,165.35,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 166.469px 295.68px;" id="elx77fgugoskb"
              class="animable"></path>
            <path
              d="M162.3,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.42.42,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,162.3,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 163.408px 295.68px;" id="elqko471zzvqq"
              class="animable"></path>
            <path
              d="M159.25,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,159.25,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 160.358px 295.68px;" id="elwxubbp6eyub"
              class="animable"></path>
            <path
              d="M156.21,297.27h2.2a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,156.21,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 157.309px 295.68px;" id="el5oq9cvr0qu7"
              class="animable"></path>
            <path
              d="M153.16,297.27h2.2a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,153.16,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 154.259px 295.68px;" id="el6oexemht25m"
              class="animable"></path>
            <path
              d="M150.11,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.59a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,150.11,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 151.214px 295.68px;" id="elywhl8sutqc"
              class="animable"></path>
            <path
              d="M147.06,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.59a.41.41,0,0,0-.4.31l-.63,2.34A.43.43,0,0,0,147.06,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 148.164px 295.68px;" id="elaqnki6zxf0l"
              class="animable"></path>
            <path
              d="M144,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.59a.42.42,0,0,0-.4.31l-.62,2.34A.42.42,0,0,0,144,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 145.108px 295.68px;" id="elacsb3zl46tt"
              class="animable"></path>
            <path
              d="M141,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.42.42,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,141,297.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 142.108px 295.68px;" id="elamxwf1pe4a5"
              class="animable"></path>
            <g id="elrqs23lhiblo">
              <rect x="138.74" y="295.68" width="49.32" height="3.67"
                style="fill: rgb(185, 215, 126); transform-origin: 163.4px 297.515px; transform: rotate(180deg);"
                class="animable"></rect>
            </g>
            <g id="eldg3v73e41pt">
              <g style="opacity: 0.7; transform-origin: 163.405px 296.72px;" class="animable">
                <path
                  d="M183.64,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.42.42,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,183.64,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 184.748px 295.68px;" id="eldhp4ig4adce"
                  class="animable"></path>
                <path
                  d="M180.59,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,180.59,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 181.698px 295.68px;" id="elxqb5z8j6dws"
                  class="animable"></path>
                <path
                  d="M177.55,297.27h2.2a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,177.55,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 178.649px 295.68px;" id="eltpiz1aaazn"
                  class="animable"></path>
                <path
                  d="M174.5,297.27h2.2a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,174.5,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 175.599px 295.68px;" id="elp9pag704wxe"
                  class="animable"></path>
                <path
                  d="M171.45,297.27h2.2a.43.43,0,0,0,.43-.43v-2.33a.42.42,0,0,0-.43-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,171.45,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 172.554px 295.68px;" id="ellerhuaskoma"
                  class="animable"></path>
                <path
                  d="M168.4,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42H169a.41.41,0,0,0-.4.31l-.63,2.34A.43.43,0,0,0,168.4,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 169.494px 295.68px;" id="el1yzvlus3wwb"
                  class="animable"></path>
                <path
                  d="M165.35,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42H166a.42.42,0,0,0-.4.31l-.63,2.34A.43.43,0,0,0,165.35,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 166.469px 295.68px;" id="elipp76j21fx"
                  class="animable"></path>
                <path
                  d="M162.3,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.42.42,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,162.3,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 163.408px 295.68px;" id="elu5yxv7th5"
                  class="animable"></path>
                <path
                  d="M159.25,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,159.25,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 160.358px 295.68px;" id="el0hfhjhnzmhwb"
                  class="animable"></path>
                <path
                  d="M156.21,297.27h2.2a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,156.21,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 157.309px 295.68px;" id="el2krwyv46edf"
                  class="animable"></path>
                <path
                  d="M153.16,297.27h2.2a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,153.16,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 154.259px 295.68px;" id="elmnxdsuy1w1"
                  class="animable"></path>
                <path
                  d="M150.11,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.59a.43.43,0,0,0-.41.31l-.62,2.34A.43.43,0,0,0,150.11,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 151.214px 295.68px;" id="el1bu89v4reye"
                  class="animable"></path>
                <path
                  d="M147.06,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.59a.41.41,0,0,0-.4.31l-.63,2.34A.43.43,0,0,0,147.06,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 148.164px 295.68px;" id="elxpq2ladawb"
                  class="animable"></path>
                <path
                  d="M144,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.59a.42.42,0,0,0-.4.31l-.62,2.34A.42.42,0,0,0,144,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 145.108px 295.68px;" id="elw2hhch5cuzf"
                  class="animable"></path>
                <path
                  d="M141,297.27h2.21a.42.42,0,0,0,.42-.43v-2.33a.42.42,0,0,0-.42-.42h-1.58a.42.42,0,0,0-.41.31l-.62,2.34A.42.42,0,0,0,141,297.27Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 142.108px 295.68px;" id="el7hauozzvb5g"
                  class="animable"></path>
                <g id="elgxqqlz9xrll">
                  <rect x="138.74" y="295.68" width="49.32" height="3.67"
                    style="fill: rgb(255, 255, 255); transform-origin: 163.4px 297.515px; transform: rotate(180deg);"
                    class="animable"></rect>
                </g>
                <g id="el9hlexhaqr0v">
                  <rect x="153.87" y="295.68" width="34.2" height="3.67"
                    style="opacity: 0.1; transform-origin: 170.97px 297.515px; transform: rotate(180deg);"
                    class="animable"></rect>
                </g>
              </g>
            </g>
            <g id="els390rrgvesr">
              <g style="opacity: 0.2; transform-origin: 140.36px 221.79px;" class="animable">
                <path
                  d="M143.1,217.71a13.12,13.12,0,0,0,1.14,4.33,32.37,32.37,0,0,0,2.55,4.82c-4.93.11-8.65.37-10.5.07a15.44,15.44,0,0,1-2.2-10.42c2.92,1,6.46.21,9.46,1Z"
                  id="el3i60cdposyx" class="animable" style="transform-origin: 140.36px 221.79px;"></path>
              </g>
            </g>
            <path
              d="M143,216.46a13.36,13.36,0,0,0,1.68,4.21,33.25,33.25,0,0,0,3.14,4.58,56.47,56.47,0,0,1-10.54.15,12.46,12.46,0,0,1-3.23-8.89C137.6,216.51,143,216.46,143,216.46Z"
              style="fill: rgb(255, 255, 255); transform-origin: 140.93px 221.019px;" id="el3niolm2b5d7"
              class="animable"></path>
            <g id="eletrybfypt66">
              <g style="opacity: 0.2; transform-origin: 129.46px 221.76px;" class="animable">
                <path
                  d="M132.2,217.67a12.87,12.87,0,0,0,1.14,4.34,31.46,31.46,0,0,0,2.55,4.82c-4.93.11-8.65.37-10.5.07a15.44,15.44,0,0,1-2.2-10.42c2.91,1,6.45.2,9.46,1Z"
                  id="el38plvq14qk" class="animable" style="transform-origin: 129.46px 221.76px;"></path>
              </g>
            </g>
            <path
              d="M132.14,216.43a13.36,13.36,0,0,0,1.68,4.21,33,33,0,0,0,3.14,4.58,56.21,56.21,0,0,1-10.54.14,12.42,12.42,0,0,1-3.23-8.88C126.7,216.48,132.14,216.43,132.14,216.43Z"
              style="fill: rgb(255, 255, 255); transform-origin: 130.07px 220.986px;" id="elkos3nhmo1f"
              class="animable"></path>
            <g id="eltokmbb9pudm">
              <g style="opacity: 0.2; transform-origin: 104.39px 279.5px;" class="animable">
                <path
                  d="M107.13,275.41a12.64,12.64,0,0,0,1.14,4.34,31.46,31.46,0,0,0,2.55,4.82c-4.93.11-8.65.37-10.5.07a15.44,15.44,0,0,1-2.2-10.42c2.91,1,6.45.2,9.46,1Z"
                  id="elfku3foqcnug" class="animable" style="transform-origin: 104.39px 279.5px;"></path>
              </g>
            </g>
            <path
              d="M107.07,274.16a13.32,13.32,0,0,0,1.68,4.22,33.58,33.58,0,0,0,3.14,4.58,56.21,56.21,0,0,1-10.54.14,12.42,12.42,0,0,1-3.23-8.88C101.63,274.22,107.07,274.16,107.07,274.16Z"
              style="fill: rgb(255, 255, 255); transform-origin: 105px 278.721px;" id="elas2qnf2hdrc" class="animable">
            </path>
            <g id="elpphyjl7z6e">
              <g style="opacity: 0.2; transform-origin: 170.501px 221.696px;" class="animable">
                <path
                  d="M173.24,217.61a13.12,13.12,0,0,0,1.14,4.33,31.56,31.56,0,0,0,2.55,4.83c-4.93.1-8.65.36-10.5.07a15.46,15.46,0,0,1-2.2-10.42c2.91,1,6.45.2,9.46,1Z"
                  id="elfuceeanzkks" class="animable" style="transform-origin: 170.501px 221.696px;"></path>
              </g>
            </g>
            <path
              d="M173.18,216.36a13.36,13.36,0,0,0,1.68,4.21,33.06,33.06,0,0,0,3.14,4.59,57.11,57.11,0,0,1-10.54.14,12.45,12.45,0,0,1-3.23-8.88C167.74,216.42,173.18,216.36,173.18,216.36Z"
              style="fill: rgb(255, 255, 255); transform-origin: 171.11px 220.919px;" id="elkllsow2nu5g"
              class="animable"></path>
            <path
              d="M152.79,243.32H116.65a2,2,0,0,1-1.94-1.78h0a1.6,1.6,0,0,1,1.63-1.78h36.14a2,2,0,0,1,1.94,1.78h0A1.62,1.62,0,0,1,152.79,243.32Z"
              style="fill: rgb(240, 240, 240); transform-origin: 134.564px 241.54px;" id="elnzfzrzosdm"
              class="animable"></path>
          </g>
          <g id="freepik--device-2--inject-2" class="animable" style="transform-origin: 329.36px 274.395px;">
            <path d="M334.14,264.47v19.94h5.1s.49,1.47,0,1.47H327V264.47Z"
              style="fill: rgb(185, 215, 126); transform-origin: 333.229px 275.175px;" id="elkjhrgzr0gk"
              class="animable"></path>
            <g id="elnodzo97hrwp">
              <path d="M334.14,264.47v19.94h5.1s.49,1.47,0,1.47H327V264.47Z"
                style="opacity: 0.6; transform-origin: 333.229px 275.175px;" class="animable"></path>
            </g>
            <g id="freepik--smartphone-screen--inject-2" class="animable" style="transform-origin: 326.26px 274.395px;">
              <g id="freepik--group--inject-2" class="animable" style="transform-origin: 326.26px 274.395px;">
                <path
                  d="M329.82,285.88H320.7a1.42,1.42,0,0,1-1.43-1.57L321,264.47a1.75,1.75,0,0,1,1.7-1.56h9.12a1.42,1.42,0,0,1,1.43,1.56l-1.74,19.84A1.75,1.75,0,0,1,329.82,285.88Z"
                  style="fill: rgb(185, 215, 126); transform-origin: 326.26px 274.395px;" id="elc0xe3yc9dm"
                  class="animable"></path>
                <g id="elyhu012lw39">
                  <path
                    d="M329.82,285.88H320.7a1.42,1.42,0,0,1-1.43-1.57L321,264.47a1.75,1.75,0,0,1,1.7-1.56h9.12a1.42,1.42,0,0,1,1.43,1.56l-1.74,19.84A1.75,1.75,0,0,1,329.82,285.88Z"
                    style="opacity: 0.1; transform-origin: 326.26px 274.395px;" class="animable"></path>
                </g>
                <g id="els3rjltthkf">
                  <path
                    d="M326.11,284.41a.84.84,0,0,1-.81.75.68.68,0,0,1-.68-.75.83.83,0,0,1,.81-.74A.67.67,0,0,1,326.11,284.41Z"
                    style="fill: none; stroke: rgb(255, 255, 255); stroke-miterlimit: 10; stroke-width: 0.5px; opacity: 0.8; transform-origin: 325.365px 284.415px;"
                    class="animable"></path>
                </g>
                <g id="ell5fnxukylq">
                  <g style="opacity: 0.8; transform-origin: 327.15px 264.37px;" class="animable">
                    <path
                      d="M325.3,264.74a.46.46,0,0,1-.11-.36v-.06a.51.51,0,0,1,.51-.47h2.95a.45.45,0,0,1,.35.15.44.44,0,0,1,.11.35v.07a.53.53,0,0,1-.51.47h-3A.45.45,0,0,1,325.3,264.74Zm3.61-.41-.26-.06H325.7a.1.1,0,0,0-.09.08v.07l-.21,0,.26.07h3a.1.1,0,0,0,.09-.09v-.06Z"
                      style="fill: rgb(255, 255, 255); transform-origin: 327.15px 264.37px;" id="el0zuxa7utjtsd"
                      class="animable"></path>
                  </g>
                </g>
                <g id="elu8arnj1yuf">
                  <polygon points="330.74 282.57 320.24 282.57 321.72 265.65 332.22 265.65 330.74 282.57"
                    style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 326.23px 274.11px;"
                    class="animable"></polygon>
                </g>
                <g id="elktd5mfw9t">
                  <polygon points="328.01 262.98 322.93 285.88 325.98 285.88 331.01 262.98 328.01 262.98"
                    style="fill: rgb(255, 255, 255); opacity: 0.1; isolation: isolate; transform-origin: 326.97px 274.43px;"
                    class="animable"></polygon>
                </g>
                <g id="elol3od2zq40g">
                  <polygon points="325.63 262.98 320.55 285.88 322.09 285.88 327.12 262.98 325.63 262.98"
                    style="fill: rgb(255, 255, 255); opacity: 0.1; isolation: isolate; transform-origin: 323.835px 274.43px;"
                    class="animable"></polygon>
                </g>
              </g>
            </g>
            <g id="eldfwo0qd1h6">
              <path
                d="M329.82,285.88h.88a1.74,1.74,0,0,0,1.7-1.57l1.74-19.84a1.41,1.41,0,0,0-1.43-1.56h-.88a1.41,1.41,0,0,1,1.43,1.56l-1.74,19.84A1.76,1.76,0,0,1,329.82,285.88Z"
                style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 331.984px 274.395px;" class="animable">
              </path>
            </g>
          </g>
          <g id="freepik--Calendar--inject-2" class="animable" style="transform-origin: 395.435px 273.146px;">
            <polygon points="407.01 286.5 419.35 286.5 413.18 262.26 407.01 286.5"
              style="fill: rgb(185, 215, 126); transform-origin: 413.18px 274.38px;" id="elhw481ahhhyv"
              class="animable"></polygon>
            <g id="elml7y7hma1t">
              <polygon points="407.01 286.5 419.35 286.5 413.18 262.26 407.01 286.5"
                style="opacity: 0.6; transform-origin: 413.18px 274.38px;" class="animable"></polygon>
            </g>
            <polygon points="371.52 286.5 377.69 262.26 413.18 262.26 407.01 286.5 371.52 286.5"
              style="fill: rgb(185, 215, 126); transform-origin: 392.35px 274.38px;" id="elsbcpfnoznl" class="animable">
            </polygon>
            <g id="elvkc8j008wvl">
              <polygon points="371.52 286.5 377.69 262.26 413.18 262.26 407.01 286.5 371.52 286.5"
                style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 392.35px 274.38px;" class="animable">
              </polygon>
            </g>
            <path
              d="M381.06,260a2.45,2.45,0,0,1,3.26,1.33,2.37,2.37,0,0,1,1.29-1.33,2.46,2.46,0,0,1,3.26,1.33,2.37,2.37,0,0,1,1.29-1.33,2.46,2.46,0,0,1,3.26,1.33,2.33,2.33,0,0,1,1.29-1.33,2.44,2.44,0,0,1,3.25,1.33,2.38,2.38,0,0,1,1.3-1.33,2.44,2.44,0,0,1,3.25,1.33A2.37,2.37,0,0,1,403.8,260a2.45,2.45,0,0,1,3.26,1.33,2.37,2.37,0,0,1,1.29-1.33,2.52,2.52,0,0,1,3.49,2.29c0,.36-.55.36-.56,0a1.93,1.93,0,1,0-3.3,1.36c.24.27-.16.67-.4.4a2.68,2.68,0,0,1-.67-1.52.24.24,0,0,1-.18-.24,1.93,1.93,0,1,0-3.3,1.36c.24.27-.16.67-.4.4a2.68,2.68,0,0,1-.67-1.52.25.25,0,0,1-.18-.24,1.93,1.93,0,1,0-3.3,1.36c.24.27-.16.67-.4.4a2.68,2.68,0,0,1-.67-1.52.26.26,0,0,1-.18-.24,1.93,1.93,0,1,0-3.3,1.36c.24.27-.15.67-.4.4a2.75,2.75,0,0,1-.67-1.52.26.26,0,0,1-.18-.24,1.93,1.93,0,1,0-3.3,1.36c.25.27-.15.67-.4.4a2.75,2.75,0,0,1-.67-1.52.26.26,0,0,1-.18-.24,1.93,1.93,0,1,0-3.29,1.36c.24.27-.16.67-.4.4a2.62,2.62,0,0,1-.67-1.52.26.26,0,0,1-.19-.24,1.93,1.93,0,1,0-3.29,1.36c.24.27-.16.67-.4.4A2.52,2.52,0,0,1,381.06,260Z"
              style="fill: rgb(185, 215, 126); transform-origin: 395.71px 261.966px;" id="eldctb42thplv"
              class="animable"></path>
            <g id="ellyyvepeafzn">
              <path
                d="M381.06,260a2.45,2.45,0,0,1,3.26,1.33,2.37,2.37,0,0,1,1.29-1.33,2.46,2.46,0,0,1,3.26,1.33,2.37,2.37,0,0,1,1.29-1.33,2.46,2.46,0,0,1,3.26,1.33,2.33,2.33,0,0,1,1.29-1.33,2.44,2.44,0,0,1,3.25,1.33,2.38,2.38,0,0,1,1.3-1.33,2.44,2.44,0,0,1,3.25,1.33A2.37,2.37,0,0,1,403.8,260a2.45,2.45,0,0,1,3.26,1.33,2.37,2.37,0,0,1,1.29-1.33,2.52,2.52,0,0,1,3.49,2.29c0,.36-.55.36-.56,0a1.93,1.93,0,1,0-3.3,1.36c.24.27-.16.67-.4.4a2.68,2.68,0,0,1-.67-1.52.24.24,0,0,1-.18-.24,1.93,1.93,0,1,0-3.3,1.36c.24.27-.16.67-.4.4a2.68,2.68,0,0,1-.67-1.52.25.25,0,0,1-.18-.24,1.93,1.93,0,1,0-3.3,1.36c.24.27-.16.67-.4.4a2.68,2.68,0,0,1-.67-1.52.26.26,0,0,1-.18-.24,1.93,1.93,0,1,0-3.3,1.36c.24.27-.15.67-.4.4a2.75,2.75,0,0,1-.67-1.52.26.26,0,0,1-.18-.24,1.93,1.93,0,1,0-3.3,1.36c.25.27-.15.67-.4.4a2.75,2.75,0,0,1-.67-1.52.26.26,0,0,1-.18-.24,1.93,1.93,0,1,0-3.29,1.36c.24.27-.16.67-.4.4a2.62,2.62,0,0,1-.67-1.52.26.26,0,0,1-.19-.24,1.93,1.93,0,1,0-3.29,1.36c.24.27-.16.67-.4.4A2.52,2.52,0,0,1,381.06,260Z"
                style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 395.71px 261.966px;" class="animable">
              </path>
            </g>
            <path
              d="M381.8,271.15l-.17,1H377l.14-.78L380,269c.72-.59.9-1,1-1.31.1-.58-.24-.92-1-.92a2.17,2.17,0,0,0-1.6.66l-.71-.63a3.51,3.51,0,0,1,2.59-1c1.38,0,2.14.7,1.94,1.82a3.11,3.11,0,0,1-1.4,2l-2,1.61Z"
              style="fill: rgb(185, 215, 126); transform-origin: 379.626px 268.974px;" id="el0amfa0wa25sj"
              class="animable"></path>
            <path
              d="M387.14,270.24a2.62,2.62,0,0,1-2.86,2,3.43,3.43,0,0,1-2.25-.73l.67-.91a2.5,2.5,0,0,0,1.74.62c.84,0,1.41-.37,1.51-1s-.25-.94-1.21-.94h-.58l.14-.8L386,266.8h-2.87l.17-1h4.32l-.14.79-1.86,1.83C386.82,268.58,387.3,269.29,387.14,270.24Z"
              style="fill: rgb(185, 215, 126); transform-origin: 384.825px 269.029px;" id="elnwamk7oyx6k"
              class="animable"></path>
            <path
              d="M381.8,271.15l-.17,1H377l.14-.78L380,269c.72-.59.9-1,1-1.31.1-.58-.24-.92-1-.92a2.17,2.17,0,0,0-1.6.66l-.71-.63a3.51,3.51,0,0,1,2.59-1c1.38,0,2.14.7,1.94,1.82a3.11,3.11,0,0,1-1.4,2l-2,1.61Z"
              style="fill: rgb(255, 255, 255); transform-origin: 379.626px 268.974px;" id="el2f1zea9hb9a"
              class="animable"></path>
            <path
              d="M387.14,270.24a2.62,2.62,0,0,1-2.86,2,3.43,3.43,0,0,1-2.25-.73l.67-.91a2.5,2.5,0,0,0,1.74.62c.84,0,1.41-.37,1.51-1s-.25-.94-1.21-.94h-.58l.14-.8L386,266.8h-2.87l.17-1h4.32l-.14.79-1.86,1.83C386.82,268.58,387.3,269.29,387.14,270.24Z"
              style="fill: rgb(255, 255, 255); transform-origin: 384.825px 269.029px;" id="elyunp14iqh5a"
              class="animable"></path>
            <polygon
              points="404.57 284.31 375.05 284.31 378 273.28 378.97 273.54 376.35 283.31 403.8 283.31 408.21 266.84 388.58 266.84 388.58 265.84 409.52 265.84 404.57 284.31"
              style="fill: rgb(185, 215, 126); transform-origin: 392.285px 275.075px;" id="elotlw2vfkak"
              class="animable"></polygon>
          </g>
          <g id="freepik--Character--inject-2" class="animable" style="transform-origin: 251.321px 246.947px;">
            <g id="freepik--group--inject-2" class="animable" style="transform-origin: 263.057px 258.188px;">
              <path
                d="M221.64,139.87c5.81-1.35,10.79-3.17,16.73-3.84a128.49,128.49,0,0,1,15.33-.36c4.28,25.46,8.1,62,8.91,68.41l-41.5,7.13a199.81,199.81,0,0,0-7.82-39.08c-8.36-28.46-3.22-28.09-3.22-28.09A77.87,77.87,0,0,1,221.64,139.87Z"
                style="fill: rgb(185, 215, 126); transform-origin: 235.558px 173.398px;" id="elxyh0nyeupb9"
                class="animable"></path>
              <path
                d="M240.41,135.37l-.62.8c-.8,1-1.61,2.07-2.47,3.07,0,0,0,0,0,0a45.34,45.34,0,0,1-9.88,5.48,13.82,13.82,0,0,1-4-2,4.69,4.69,0,0,1-.67-2.42,3.23,3.23,0,0,1,.19-1.15,6.27,6.27,0,0,0,3-3.33,3.21,3.21,0,0,0,.22-.79c.44-2.11-.29-4.47-1.29-6.71l9.24-11.11C234,122.72,234.85,133,240.41,135.37Z"
                style="fill: rgb(178, 91, 82); transform-origin: 231.59px 130.965px;" id="elinos6hja5xo"
                class="animable"></path>
              <path
                d="M222.74,140.3a4.69,4.69,0,0,0,.67,2.42,5.65,5.65,0,0,1-1.13-1.09,2.53,2.53,0,0,1-.66-1.82l.57-.27a6.42,6.42,0,0,0,.74-.39A3.23,3.23,0,0,0,222.74,140.3Z"
                style="fill: rgb(178, 91, 82); transform-origin: 222.514px 140.935px;" id="el1dpeybs9twy"
                class="animable"></path>
              <path
                d="M241.58,135.75s-.75.72-2.07,1.81c-.61.5-1.35,1.07-2.19,1.68.86-1,1.67-2,2.47-3.07l.62-.8a3.12,3.12,0,0,0,.62.23A4.94,4.94,0,0,0,241.58,135.75Z"
                style="fill: rgb(178, 91, 82); transform-origin: 239.45px 137.305px;" id="elxwz9u618pi"
                class="animable"></path>
              <g id="eldtc9p4ql1cr">
                <path
                  d="M231,124.79c.18,2.57-2.64,8.17-5.05,6.56a18.45,18.45,0,0,0-1.07-3l5.47-6.57A8.59,8.59,0,0,1,231,124.79Z"
                  style="opacity: 0.2; isolation: isolate; transform-origin: 227.944px 126.708px;" class="animable">
                </path>
              </g>
              <path
                d="M231.76,104a10.66,10.66,0,0,0-14.7-3.36c-7,4.34-6.1,15.93-3.26,22.56,3.15,7.35,13.24,9.25,18.06,2.31,3.21-4.61,2.32-9.11,1.48-16.88A10.74,10.74,0,0,0,231.76,104Z"
                style="fill: rgb(178, 91, 82); transform-origin: 222.906px 114.418px;" id="elolilfla36"
                class="animable"></path>
              <path
                d="M237.46,112.37l-4.75,5.5s-1.52-1-2.05-6.29c-.18-1.37-1.69-1.73-2.11-3.14s.08-6,1.33-6.14,7.61-.4,7.61-.4Z"
                style="fill: rgb(178, 91, 82); transform-origin: 232.947px 109.885px;" id="ela43xc5644oc"
                class="animable"></path>
              <g id="elcf1v08n7y5">
                <path
                  d="M237.46,112.37l-4.75,5.5s-1.52-1-2.05-6.29c-.18-1.37-1.69-1.73-2.11-3.14s.08-6,1.33-6.14,7.61-.4,7.61-.4Z"
                  style="opacity: 0.2; isolation: isolate; transform-origin: 232.947px 109.885px;" class="animable">
                </path>
              </g>
              <path
                d="M240.82,268.37c-.66,10-4,45.41-4,45.41,2.58,38.45-3.87,90.84-3.87,90.84l-8.33.37s-4.75-125.13-4.18-137.86Z"
                style="fill: rgb(178, 91, 82); transform-origin: 230.606px 336.06px;" id="elj4tqsmsyk4"
                class="animable"></path>
              <path
                d="M240.82,268.37c-.21,3.17-.69,8.9-1.25,15.26-.11,1.16-.21,2.35-.32,3.55-1.15,12.8-2.46,26.6-2.46,26.6,2.58,38.44-3.87,90.84-3.87,90.84l-8.33.38s-4.74-125.13-4.18-137.87Z"
                style="fill: rgb(178, 91, 82); transform-origin: 230.592px 336.065px;" id="el3pw89yb6rn7"
                class="animable"></path>
              <path
                d="M251.83,205.92l-5.22,28.87c-4.49,52.45-8.62,94.49-8.62,94.49.07.8.15,1.62.24,2.47a201,201,0,0,1-.18,43.66L236,393.68l-13.24.27c.4-12.44-2.74-48.19-3.06-81.2-.53-54.63,1.25-103,1.25-103Z"
                style="fill: rgb(185, 215, 126); transform-origin: 235.716px 299.935px;" id="elp5dynn2ccmh"
                class="animable"></path>
              <g id="el333ljnguhhs">
                <path
                  d="M251.83,205.92l-5.22,28.87c-4.49,52.45-8.62,94.49-8.62,94.49.07.8.15,1.62.24,2.47a201,201,0,0,1-.18,43.66L236,393.68l-13.24.27c.4-12.44-2.74-48.19-3.06-81.2-.53-54.63,1.25-103,1.25-103Z"
                  style="opacity: 0.6; transform-origin: 235.716px 299.935px;" class="animable"></path>
              </g>
              <g id="eliesj930w4jl">
                <path d="M247.64,225.17l-3.74,40.56c-2.54-16.06-5.36-36.36-3.39-53.18Z"
                  style="opacity: 0.3; isolation: isolate; transform-origin: 243.744px 239.14px;" class="animable">
                </path>
              </g>
              <path
                d="M311.32,389.82c-4.6-9.15-11.38-20.66-11.38-20.66L313,373.71s4.95,10.43,6,13.55C316.68,388,313.56,388.9,311.32,389.82Z"
                style="fill: rgb(178, 91, 82); transform-origin: 309.47px 379.49px;" id="elkkzwqok03jd"
                class="animable"></path>
              <g id="elo7wimsfsvio">
                <polygon points="256.5 277.89 258.41 284.06 275.51 278.26 274.31 273.03 256.5 277.89"
                  style="opacity: 0.2; isolation: isolate; transform-origin: 266.005px 278.545px;" class="animable">
                </polygon>
              </g>
              <path
                d="M269.31,252.32c2.73,11.76,9.56,39.1,11.92,46.94,14.29,19.54,22.31,51.58,33.58,78.34l-7.31,5s-32-56.06-41.43-79.47c-2.44-6-13.36-34.64-16.27-44.94Z"
                style="fill: rgb(178, 91, 82); transform-origin: 282.305px 317.46px;" id="elnns7sktytse"
                class="animable"></path>
              <path
                d="M301,375.5s-24.72-46.3-31.41-57.65c-15-25.37-33.42-109.63-33.42-109.63l26.41-4.14s21.23,99.13,22.71,101.36c13.75,20.73,27.6,64.38,27.6,64.38Z"
                style="fill: rgb(185, 215, 126); transform-origin: 274.53px 289.79px;" id="eltww6aevikjq"
                class="animable"></path>
              <g id="elrfrr7auu9i">
                <g style="opacity: 0.6; transform-origin: 274.53px 289.79px;" class="animable">
                  <path
                    d="M301,375.5s-24.72-46.3-31.41-57.65c-15-25.37-33.42-109.63-33.42-109.63l26.41-4.14s21.23,99.13,22.71,101.36c13.75,20.73,27.6,64.38,27.6,64.38Z"
                    id="el8yh2lmyyixr" class="animable" style="transform-origin: 274.53px 289.79px;"></path>
                </g>
              </g>
              <path d="M222.67,114.14c-.4.07-.65.63-.54,1.26s.52,1.08.93,1,.66-.63.55-1.26S223.07,114.07,222.67,114.14Z"
                style="fill: rgb(38, 50, 56); transform-origin: 222.87px 115.271px;" id="elcqh4hvvi3ki"
                class="animable"></path>
              <path d="M214.7,115.17c-.41.07-.65.63-.55,1.26s.53,1.08.94,1,.66-.63.55-1.26S215.11,115.1,214.7,115.17Z"
                style="fill: rgb(38, 50, 56); transform-origin: 214.897px 116.301px;" id="el0sjgldsihgjr"
                class="animable"></path>
              <path d="M218.29,119.79a3.67,3.67,0,0,1-3.09-.05,22.54,22.54,0,0,0,2.07-5.87Z"
                style="fill: rgb(79, 15, 26); transform-origin: 216.745px 116.988px;" id="ellh6pce0d92"
                class="animable"></path>
              <path
                d="M224,110h0a.37.37,0,0,0,0-.52,3.68,3.68,0,0,0-3.25-1h0a.36.36,0,0,0-.26.45.37.37,0,0,0,.45.27,3,3,0,0,1,2.56.83.39.39,0,0,0,.33.09A.31.31,0,0,0,224,110Z"
                style="fill: rgb(38, 50, 56); transform-origin: 222.291px 109.273px;" id="elvneczla1ju"
                class="animable"></path>
              <path
                d="M211.68,111.79a3,3,0,0,1,1.92-1.9h0a.38.38,0,0,0,.23-.38.37.37,0,0,0-.41-.34,3.7,3.7,0,0,0-2.44,2.37v0a.35.35,0,0,0,.24.44.26.26,0,0,0,.15,0A.4.4,0,0,0,211.68,111.79Z"
                style="fill: rgb(38, 50, 56); transform-origin: 212.398px 110.579px;" id="elipdti289vs"
                class="animable"></path>
              <path
                d="M222.59,406.79c-2.42,2.18-7,4.48-14.58,6.14-1.69.37-1.15,4.44,3,4.44s11.82-1,14.79-1.26c4.84-.34,12.48-1.22,10.17-5.49,0,0-1.06-.71-3-7.27l-8.41.75A26.33,26.33,0,0,1,222.59,406.79Z"
                style="fill: rgb(178, 91, 82); transform-origin: 221.754px 410.36px;" id="eluorgetc235"
                class="animable"></path>
              <g id="elgq3ebx61zi">
                <path
                  d="M247.78,143c-.23.71-3.73,5.62.36,16,3.07,7.82,5.45,10.71,5.45,10.71.93,1.49.33-15.06-3.69-24.08C248.68,143,248.75,140.07,247.78,143Z"
                  style="opacity: 0.1; isolation: isolate; transform-origin: 250.069px 155.791px;" class="animable">
                </path>
              </g>
              <path
                d="M253,135.7s-7.83,3.37-5.5,13a214.92,214.92,0,0,0,7,23.23,4,4,0,0,1-.87,4.17l-15.26,16.11,2.35,5.3s23.62-16.55,25.37-21.76c.85-2.52,1-7.52-1.45-19.67-.77-3.83-1.62-7.12-1.93-8.48C260.18,136.66,256.74,135.1,253,135.7Z"
                style="fill: rgb(185, 215, 126); transform-origin: 252.511px 166.55px;" id="elt3bw6tc3ees"
                class="animable"></path>
              <g id="el4n5iuotpag">
                <path
                  d="M253,135.7s-7.83,3.37-5.5,13a214.92,214.92,0,0,0,7,23.23,4,4,0,0,1-.87,4.17l-15.26,16.11,2.35,5.3s23.62-16.55,25.37-21.76c.85-2.52,1-7.52-1.45-19.67-.77-3.83-1.62-7.12-1.93-8.48C260.18,136.66,256.74,135.1,253,135.7Z"
                  style="fill: rgb(255, 255, 255); opacity: 0.13; transform-origin: 252.511px 166.55px;"
                  class="animable"></path>
              </g>
              <path
                d="M240,191.68l-4.17,2.2a5.65,5.65,0,0,0-2.72,3.23l-1.75,5.31a1.36,1.36,0,0,0,.69,1.64l3.35,1.69a1.37,1.37,0,0,0,1.74-.47l3.22-4.86,3.23-5.58S241.57,190.83,240,191.68Z"
                style="fill: rgb(178, 91, 82); transform-origin: 237.442px 198.725px;" id="elvripq5ecwc"
                class="animable"></path>
              <g id="el9ysfrariol8">
                <path
                  d="M240,191.68l-4.17,2.2a5.65,5.65,0,0,0-2.72,3.23l-1.75,5.31a1.36,1.36,0,0,0,.69,1.64l3.35,1.69a1.37,1.37,0,0,0,1.74-.47l3.22-4.86,3.23-5.58S241.57,190.83,240,191.68Z"
                  style="opacity: 0.1; transform-origin: 237.442px 198.725px;" class="animable"></path>
              </g>
              <path d="M220.93,121.81c-.4.07-.65.63-.54,1.26s.51,1.08.93,1,.65-.63.55-1.26S221.33,121.74,220.93,121.81Z"
                style="fill: rgb(38, 50, 56); transform-origin: 221.129px 122.941px;" id="el3r0opj9ucoc"
                class="animable"></path>
            </g>
            <g id="elusifuk5vyv">
              <g style="opacity: 0.6; transform-origin: 214.85px 114.685px;" class="animable">
                <path d="M211,113.53a4.74,4.74,0,0,0-.51,1.68,3.63,3.63,0,0,0,.76,2.24l1.26-4.29S211.45,113,211,113.53Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 211.5px 115.294px;" id="elag3a91gs3r"
                  class="animable"></path>
                <path d="M217.75,112.93l.57,1.27a6.88,6.88,0,0,1,.89-2.28S217.29,112,217.75,112.93Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 218.444px 113.06px;" id="elc6kz8rrdqgt"
                  class="animable"></path>
              </g>
            </g>
            <path
              d="M213,119.53a2.59,2.59,0,0,1-1.95-.85,6.24,6.24,0,0,1-1.18-3.7,2.78,2.78,0,0,1,.9-2c1.73-1.53,5.28-1.25,5.43-1.24l.47,0,0,.47c0,.44.26,4.37-1,5.89a3.59,3.59,0,0,1-2.62,1.38Zm2.4-6.71c-1,0-2.92.13-3.91,1a1.69,1.69,0,0,0-.52,1.22,5.35,5.35,0,0,0,.89,2.9,1.48,1.48,0,0,0,1.17.49,2.5,2.5,0,0,0,1.81-1c.74-.88.83-3.31.79-4.63Z"
              style="fill: rgb(38, 50, 56); transform-origin: 213.281px 115.622px;" id="eldfwyt0q509" class="animable">
            </path>
            <path
              d="M222.12,117.92a4.85,4.85,0,0,1-2.12-.49c-2-1-3.19-4.74-3.32-5.16l-.14-.48.46-.19c.17-.06,4-1.6,6.48-.81a2.83,2.83,0,0,1,1.8,1.68,5.55,5.55,0,0,1-.05,3.81A3.41,3.41,0,0,1,222.12,117.92Zm-4.23-5.48c.45,1.25,1.43,3.45,2.59,4,1.5.73,3.2.42,3.78-.67a4.52,4.52,0,0,0,0-2.89,1.71,1.71,0,0,0-1.11-1C221.51,111.32,219,112.08,217.89,112.44Z"
              style="fill: rgb(38, 50, 56); transform-origin: 221.066px 114.245px;" id="elkbqlnfiyrws" class="animable">
            </path>
            <path d="M217.89,112.55c-1.37-.24-1.93.28-1.95.31l-.38-.37A2.73,2.73,0,0,1,218,112Z"
              style="fill: rgb(38, 50, 56); transform-origin: 216.78px 112.379px;" id="elcnbb0gcg5fv" class="animable">
            </path>
            <path
              d="M223.7,111.8l-.09-.51,1.7-.29,7.45-2.24a.45.45,0,0,1,.39.07l1.45,1.1-.78.27s-.64-.91-1.09-.86c-.28,0-5.64,1.75-7.27,2.21Z"
              style="fill: rgb(38, 50, 56); transform-origin: 229.105px 110.271px;" id="elmi76z2wpm4" class="animable">
            </path>
            <g id="elvfizeypygk">
              <rect x="209.85" y="113.55" width="1.45" height="0.52"
                style="fill: rgb(38, 50, 56); transform-origin: 210.575px 113.81px; transform: rotate(-9.73deg);"
                class="animable"></rect>
            </g>
            <path
              d="M234,109.93c-2.24.6-3.11,4.06-3,6.28.11,2.46,1.86,4.1,3.78,2.53a7.78,7.78,0,0,0,2.72-4.89C237.85,111.46,236.26,109.33,234,109.93Z"
              style="fill: rgb(178, 91, 82); transform-origin: 234.27px 114.592px;" id="el8cjgynwt9c" class="animable">
            </path>
            <path
              d="M208,95.73l24.17-3.79a6.08,6.08,0,0,1,3.54.14c2,.92,2.38,3.51,2.51,5.69.12,1.93.1,4.17-1.41,5.37a5.84,5.84,0,0,1-3,.94c-6,.71-11.93.52-17.91.68C210.29,104.9,208.46,101,208,95.73Z"
              style="fill: rgb(38, 50, 56); transform-origin: 223.132px 98.2527px;" id="el8s5a3ah3a8n" class="animable">
            </path>
            <path
              d="M217.24,405.88c-1.49-.09-2.91-.41-3.31-1.18a1.25,1.25,0,0,1,.09-1.33,1.36,1.36,0,0,1,.91-.65c1.95-.45,5.84,2.38,6,2.5a.35.35,0,0,1,.12.32.33.33,0,0,1-.23.25A18,18,0,0,1,217.24,405.88Zm-1.7-2.63a2.39,2.39,0,0,0-.53,0,.83.83,0,0,0-.55.39c-.21.37-.16.55-.1.67.5.87,3.42,1.09,5.57.9a11.58,11.58,0,0,0-4.39-2Z"
              style="fill: rgb(185, 215, 126); transform-origin: 217.417px 404.301px;" id="elsv7izxg0a5"
              class="animable"></path>
            <path
              d="M220.74,405.77l-.11,0c-1.36-.79-4-3.75-3.68-5.18a1,1,0,0,1,1.06-.8,1.89,1.89,0,0,1,1.5.54c1.41,1.46,1.54,4.92,1.55,5.07a.33.33,0,0,1-.09.3Zm-2.54-5.4-.17-.06c-.48,0-.52.24-.54.31-.23.83,1.6,3.16,3,4.22a7.6,7.6,0,0,0-1.32-4.06A1.33,1.33,0,0,0,218.2,400.37Z"
              style="fill: rgb(185, 215, 126); transform-origin: 218.995px 402.776px;" id="elrw0t900z45d"
              class="animable"></path>
            <path
              d="M222.73,403.53l11.17.1a1,1,0,0,1,1,.91L237,414.88c.15,1.05-1.64,2.24-1.75,2.23-6.83.68-21.52.87-26.37.72s-5.37-5.52-3.37-5.95c8.94-1.88,12.36-4.77,15.25-7.53A2.64,2.64,0,0,1,222.73,403.53Z"
              style="fill: rgb(38, 50, 56); transform-origin: 220.711px 410.704px;" id="elwujhqbvvjhm" class="animable">
            </path>
            <path
              d="M304.44,390.46c-1.21.68-2.49,1.13-3.19.73a1.17,1.17,0,0,1-.6-1.09,1.25,1.25,0,0,1,.39-1c1.3-1.34,5.78-1.07,6-1.06a.33.33,0,0,1,.26.2.27.27,0,0,1-.06.3A16.68,16.68,0,0,1,304.44,390.46Zm-2.65-1.22a2.34,2.34,0,0,0-.41.29.78.78,0,0,0-.23.59c0,.4.15.51.26.58.83.43,3.23-.87,4.82-2.09a10.71,10.71,0,0,0-4.44.65Z"
              style="fill: rgb(185, 215, 126); transform-origin: 303.984px 389.676px;" id="ely61prnw4skc"
              class="animable"></path>
            <path
              d="M307.14,388.62l-.12,0c-1.46.06-5-.95-5.49-2.22a1,1,0,0,1,.44-1.16,1.73,1.73,0,0,1,1.45-.33c1.83.43,3.67,3.09,3.76,3.2a.32.32,0,0,1,.08.28Zm-4.71-3-.16,0c-.37.27-.29.45-.27.52.23.77,2.84,1.68,4.45,1.83a7.12,7.12,0,0,0-3.08-2.53A1.18,1.18,0,0,0,302.43,385.65Z"
              style="fill: rgb(185, 215, 126); transform-origin: 304.375px 386.745px;" id="elicna074aejs"
              class="animable"></path>
            <path
              d="M307.57,385.85l8.83-5.53a1,1,0,0,1,1.21.24l6.88,7c.65.75-.17,2.58-.25,2.63-5,4-16.47,11.49-20.35,13.8s-7-1.64-5.64-3c6.08-6,7.31-10,8.2-13.57A2.51,2.51,0,0,1,307.57,385.85Z"
              style="fill: rgb(38, 50, 56); transform-origin: 311.332px 392.456px;" id="elv966tyoj5up" class="animable">
            </path>
            <path
              d="M203.8,109.34l2.76-5a1.36,1.36,0,0,1,1-.71l5.21-.94a1.39,1.39,0,0,1,1.35.49l1.37,1.7a1.41,1.41,0,0,1-.14,1.93,15.41,15.41,0,0,0-3.48,4.38c-1.32,2.79-2.95,3.35-5.73,4.19S201.65,111.5,203.8,109.34Z"
              style="fill: rgb(178, 91, 82); transform-origin: 209.319px 109.071px;" id="elgmbk7rsg79l"
              class="animable"></path>
            <g id="el1ltnulyaqh">
              <g style="opacity: 0.1; isolation: isolate; transform-origin: 209.319px 109.071px;" class="animable">
                <path
                  d="M203.8,109.34l2.76-5a1.36,1.36,0,0,1,1-.71l5.21-.94a1.39,1.39,0,0,1,1.35.49l1.37,1.7a1.41,1.41,0,0,1-.14,1.93,15.41,15.41,0,0,0-3.48,4.38c-1.32,2.79-2.95,3.35-5.73,4.19S201.65,111.5,203.8,109.34Z"
                  id="el65xyadim81m" class="animable" style="transform-origin: 209.319px 109.071px;"></path>
              </g>
            </g>
            <path
              d="M213.61,142.55s-21.82-4.37-21.13-5l15.38-22.28-5.1-4s-23.95,21.91-24.84,29.34,32.8,15,32.8,15C221,152.42,213.61,142.55,213.61,142.55Z"
              style="fill: rgb(185, 215, 126); transform-origin: 197.042px 133.44px;" id="elvpgvo2ttx1"
              class="animable"></path>
            <polygon points="245.27 194.84 243.17 196.27 237.73 191.33 239.4 189.5 245.27 194.84"
              style="fill: rgb(38, 50, 56); transform-origin: 241.5px 192.885px;" id="elp3km2lg8t2" class="animable">
            </polygon>
            <g id="elrvjtu2isn5o">
              <path d="M236.73,189.71h3.57a1,1,0,0,1,1,1v.62a0,0,0,0,1,0,0h-5.53a0,0,0,0,1,0,0v-.62a1,1,0,0,1,1-1Z"
                style="fill: rgb(38, 50, 56); transform-origin: 238.535px 190.52px; transform: rotate(-47.72deg);"
                class="animable"></path>
            </g>
            <path
              d="M244.13,85.3a1.05,1.05,0,0,1-.77-.32,1.09,1.09,0,0,1,0-1.55l3.34-3.35a1.1,1.1,0,1,1,1.55,1.55L244.91,85A1.09,1.09,0,0,1,244.13,85.3Z"
              style="fill: rgb(185, 215, 126); transform-origin: 245.839px 82.4946px;" id="el4z9ehz1h6gb"
              class="animable"></path>
            <path d="M238.7,83a1.09,1.09,0,0,1-1.09-1.1V77.22a1.1,1.1,0,1,1,2.19,0v4.72A1.1,1.1,0,0,1,238.7,83Z"
              style="fill: rgb(185, 215, 126); transform-origin: 238.705px 79.5077px;" id="elc9plsu4itea"
              class="animable"></path>
            <path
              d="M233.26,85.29a1.09,1.09,0,0,1-.77-.32l-3.34-3.34a1.1,1.1,0,0,1,1.55-1.55L234,83.42A1.09,1.09,0,0,1,234,85,1.13,1.13,0,0,1,233.26,85.29Z"
              style="fill: rgb(185, 215, 126); transform-origin: 231.615px 82.5556px;" id="elwsaakvwbpwe"
              class="animable"></path>
            <path d="M251.11,90.73h-4.73a1.1,1.1,0,1,1,0-2.2h4.73a1.1,1.1,0,0,1,0,2.2Z"
              style="fill: rgb(185, 215, 126); transform-origin: 248.745px 89.63px;" id="elup1sk6zwiu" class="animable">
            </path>
          </g>
          <g id="freepik--Reminders--inject-2" class="animable" style="transform-origin: 265.16px 216.41px;">
            <path
              d="M84.1,178.75v23.64a2.23,2.23,0,0,0,2.23,2.24h35.08l8.66,6.69a1.65,1.65,0,0,0,2.64-1.33v-5.36h1.35a2.24,2.24,0,0,0,2.24-2.24V178.74a2.23,2.23,0,0,0-2.24-2.21H86.32A2.21,2.21,0,0,0,84.1,178.75Z"
              style="fill: rgb(255, 255, 255); transform-origin: 110.2px 194.09px;" id="el4xdswdbz6xe" class="animable">
            </path>
            <path
              d="M131.06,212.15a2.16,2.16,0,0,1-1.3-.43l-8.52-6.59H86.33a2.74,2.74,0,0,1-2.73-2.74V178.75A2.72,2.72,0,0,1,86.32,176h47.76a2.73,2.73,0,0,1,2.72,2.71v23.65a2.74,2.74,0,0,1-2.74,2.74h-.85V210A2.16,2.16,0,0,1,131.06,212.15ZM86.32,177a1.72,1.72,0,0,0-1.72,1.72v23.64a1.73,1.73,0,0,0,1.73,1.74h35.25l8.79,6.79a1.14,1.14,0,0,0,.69.23,1.16,1.16,0,0,0,1.15-1.16v-5.86h1.85a1.74,1.74,0,0,0,1.74-1.74V178.74a1.73,1.73,0,0,0-1.73-1.71H86.32Z"
              style="fill: rgb(185, 215, 126); transform-origin: 110.2px 194.075px;" id="elok977kcvt9" class="animable">
            </path>
            <polygon points="103 199.37 91.54 199.37 92.95 194.44 101.59 194.44 103 199.37"
              style="fill: rgb(255, 255, 255); transform-origin: 97.27px 196.905px;" id="eldjhnkbi3h1" class="animable">
            </polygon>
            <path d="M103.67,199.87H90.87l1.7-5.93H102Zm-11.47-1h10.14l-1.12-3.93h-7.9Z"
              style="fill: rgb(185, 215, 126); transform-origin: 97.27px 196.905px;" id="el51pn768yo9t"
              class="animable"></path>
            <path d="M97.39,183.63a3.26,3.26,0,1,1-3.26-3.25A3.26,3.26,0,0,1,97.39,183.63Z"
              style="fill: rgb(255, 255, 255); transform-origin: 94.13px 183.64px;" id="elq6lgm4hqhvh" class="animable">
            </path>
            <path
              d="M94.13,187.39a3.76,3.76,0,1,1,3.76-3.76A3.75,3.75,0,0,1,94.13,187.39Zm0-6.51a2.76,2.76,0,1,0,2.76,2.75A2.75,2.75,0,0,0,94.13,180.88Z"
              style="fill: rgb(185, 215, 126); transform-origin: 94.13px 183.63px;" id="el1km5vdhodml" class="animable">
            </path>
            <path d="M103.9,183.63a3.26,3.26,0,1,1-3.25-3.25A3.26,3.26,0,0,1,103.9,183.63Z"
              style="fill: rgb(255, 255, 255); transform-origin: 100.64px 183.64px;" id="elwgg4tlx9lu" class="animable">
            </path>
            <path
              d="M100.65,187.39a3.76,3.76,0,1,1,3.75-3.76A3.76,3.76,0,0,1,100.65,187.39Zm0-6.51a2.76,2.76,0,1,0,2.75,2.75A2.76,2.76,0,0,0,100.65,180.88Z"
              style="fill: rgb(185, 215, 126); transform-origin: 100.64px 183.63px;" id="el2lkdd8dfi2b"
              class="animable"></path>
            <circle cx="97.27" cy="190.02" r="8.8" style="fill: rgb(255, 255, 255); transform-origin: 97.27px 190.02px;"
              id="elelj6p9c65iv" class="animable"></circle>
            <path
              d="M97.27,199.32a9.31,9.31,0,1,1,9.3-9.3A9.31,9.31,0,0,1,97.27,199.32Zm0-17.61a8.31,8.31,0,1,0,8.3,8.31A8.31,8.31,0,0,0,97.27,181.71Z"
              style="fill: rgb(185, 215, 126); transform-origin: 97.26px 190.01px;" id="elvten6x9m1em" class="animable">
            </path>
            <polygon
              points="100.36 192.73 96.77 190.28 96.77 183.63 97.77 183.63 97.77 189.75 100.93 191.9 100.36 192.73"
              style="fill: rgb(185, 215, 126); transform-origin: 98.85px 188.18px;" id="elo4spky9k4sk" class="animable">
            </polygon>
            <path d="M112.92,188.31h13a1.13,1.13,0,1,0,0-2.26h-13a1.13,1.13,0,0,0,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 119.424px 187.18px;" id="elwdtr2468f8j"
              class="animable"></path>
            <path d="M114.72,192.79H125.9a1.13,1.13,0,0,0,0-2.26H114.72a1.13,1.13,0,0,0,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 120.31px 191.66px;" id="elrcnztrsvo2" class="animable">
            </path>
            <path d="M116.52,197.26h9.38a1.13,1.13,0,0,0,0-2.26h-9.38a1.13,1.13,0,1,0,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 121.21px 196.13px;" id="elub4vxmnxa3g"
              class="animable"></path>
            <path
              d="M295.65,230V206.36a2.23,2.23,0,0,0-2.23-2.23H258.33l-8.65-6.69a1.6,1.6,0,0,0-1-.34,1.66,1.66,0,0,0-1.66,1.66v5.37h-1.35a2.23,2.23,0,0,0-2.23,2.23V230a2.23,2.23,0,0,0,2.23,2.22h47.75A2.22,2.22,0,0,0,295.65,230Z"
              style="fill: rgb(255, 255, 255); transform-origin: 269.545px 214.66px;" id="elj435b7yggm"
              class="animable"></path>
            <path
              d="M250,197l8.51,6.59h34.92a2.73,2.73,0,0,1,2.73,2.73V230a2.72,2.72,0,0,1-2.72,2.72H245.67A2.73,2.73,0,0,1,243,230V206.36a2.73,2.73,0,0,1,2.73-2.73h.85v-4.87a2.16,2.16,0,0,1,2.16-2.16A2.19,2.19,0,0,1,250,197Zm-4.31,34.69h47.75a1.72,1.72,0,0,0,1.72-1.72V206.36a1.73,1.73,0,0,0-1.73-1.73H258.16l-8.78-6.8a1.21,1.21,0,0,0-.69-.23,1.16,1.16,0,0,0-1.16,1.16v5.87h-1.85a1.73,1.73,0,0,0-1.73,1.73V230a1.71,1.71,0,0,0,.51,1.22,1.74,1.74,0,0,0,1.21.5Z"
              style="fill: rgb(185, 215, 126); transform-origin: 269.58px 214.66px;" id="el53oekt2ai32"
              class="animable"></path>
            <path d="M264.83,216.89h-13a1.13,1.13,0,1,1,0-2.26h13a1.13,1.13,0,0,1,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 258.326px 215.76px;" id="elwn5778humjm"
              class="animable"></path>
            <path d="M263,221.37H251.85a1.14,1.14,0,1,1,0-2.27H263a1.14,1.14,0,0,1,0,2.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 257.318px 220.235px;" id="elwe47dn6y71s"
              class="animable"></path>
            <path d="M261.23,225.84h-9.38a1.13,1.13,0,1,1,0-2.26h9.38a1.13,1.13,0,0,1,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 256.54px 224.71px;" id="el6egfw5mjdzs"
              class="animable"></path>
            <polygon points="285.91 228.6 274.44 228.6 275.85 223.67 284.5 223.67 285.91 228.6"
              style="fill: rgb(255, 255, 255); transform-origin: 280.175px 226.135px;" id="el9s4am3p1klv"
              class="animable"></polygon>
            <path d="M286.58,229.1h-12.8l1.7-5.93h9.4Zm-11.47-1h10.14l-1.12-3.93h-7.9Z"
              style="fill: rgb(185, 215, 126); transform-origin: 280.18px 226.135px;" id="elaif96h63xhk"
              class="animable"></path>
            <path d="M280.3,212.87a3.26,3.26,0,1,1-3.26-3.26A3.26,3.26,0,0,1,280.3,212.87Z"
              style="fill: rgb(255, 255, 255); transform-origin: 277.04px 212.87px;" id="elmstaqq5d48" class="animable">
            </path>
            <path
              d="M277,216.62a3.76,3.76,0,1,1,3.76-3.75A3.76,3.76,0,0,1,277,216.62Zm0-6.51a2.76,2.76,0,1,0,2.76,2.76A2.77,2.77,0,0,0,277,210.11Z"
              style="fill: rgb(185, 215, 126); transform-origin: 277px 212.86px;" id="elkpm3s588ys" class="animable">
            </path>
            <path d="M286.81,212.87a3.26,3.26,0,1,1-3.26-3.26A3.26,3.26,0,0,1,286.81,212.87Z"
              style="fill: rgb(255, 255, 255); transform-origin: 283.55px 212.87px;" id="el0ytr5ersards"
              class="animable"></path>
            <path
              d="M283.55,216.62a3.76,3.76,0,1,1,3.76-3.75A3.75,3.75,0,0,1,283.55,216.62Zm0-6.51a2.76,2.76,0,1,0,2.76,2.76A2.76,2.76,0,0,0,283.55,210.11Z"
              style="fill: rgb(185, 215, 126); transform-origin: 283.55px 212.86px;" id="elstljk1qbuka"
              class="animable"></path>
            <circle cx="280.18" cy="219.25" r="8.8"
              style="fill: rgb(255, 255, 255); transform-origin: 280.18px 219.25px;" id="elp3mu5u3lb2f"
              class="animable"></circle>
            <path
              d="M280.18,228.55a9.3,9.3,0,1,1,9.3-9.3A9.31,9.31,0,0,1,280.18,228.55Zm0-17.6a8.3,8.3,0,1,0,8.3,8.3A8.31,8.31,0,0,0,280.18,211Z"
              style="fill: rgb(185, 215, 126); transform-origin: 280.18px 219.25px;" id="el6vw1lxqclx2"
              class="animable"></path>
            <polygon
              points="285.91 219.75 279.67 219.75 279.8 212.86 280.8 212.88 280.69 218.75 285.91 218.75 285.91 219.75"
              style="fill: rgb(185, 215, 126); transform-origin: 282.79px 216.305px;" id="elbtkxuot3l3"
              class="animable"></polygon>
            <path
              d="M371.46,223.41v23.65a2.23,2.23,0,0,1-2.24,2.23H334.14L325.49,256a1.65,1.65,0,0,1-2.65-1.32v-5.37h-1.35a2.23,2.23,0,0,1-2.23-2.23V223.41a2.22,2.22,0,0,1,2.23-2.22h47.75A2.23,2.23,0,0,1,371.46,223.41Z"
              style="fill: rgb(255, 255, 255); transform-origin: 345.36px 238.764px;" id="elwq5g8w6p3n"
              class="animable"></path>
            <path
              d="M324.5,256.82a2.16,2.16,0,0,1-2.16-2.16v-4.87h-.85a2.73,2.73,0,0,1-2.73-2.73V223.41a2.74,2.74,0,0,1,.8-1.93,2.85,2.85,0,0,1,1.93-.79h47.75a2.72,2.72,0,0,1,2.72,2.72v23.65a2.74,2.74,0,0,1-2.74,2.73H334.31l-8.52,6.59A2.16,2.16,0,0,1,324.5,256.82Zm-3-35.13a1.72,1.72,0,0,0-1.72,1.72v23.65a1.72,1.72,0,0,0,1.73,1.73h1.85v5.87a1.16,1.16,0,0,0,1.16,1.16,1.12,1.12,0,0,0,.68-.23l8.79-6.8h35.25a1.73,1.73,0,0,0,1.74-1.73V223.41a1.72,1.72,0,0,0-1.72-1.72H321.48Z"
              style="fill: rgb(185, 215, 126); transform-origin: 345.36px 238.755px;" id="elkv8ocbgv6m"
              class="animable"></path>
            <path d="M342.64,233h-13a1.13,1.13,0,0,1,0-2.26h13a1.13,1.13,0,0,1,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 336.14px 231.87px;" id="el8sihb3ofj12"
              class="animable"></path>
            <path d="M340.84,237.46H329.65a1.14,1.14,0,0,1,0-2.27h11.19a1.14,1.14,0,0,1,0,2.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 335.245px 236.325px;" id="el3lf6x4bznmv"
              class="animable"></path>
            <path d="M339,241.93h-9.39a1.13,1.13,0,0,1,0-2.26H339a1.13,1.13,0,0,1,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 334.305px 240.8px;" id="elzdn6hrv106" class="animable">
            </path>
            <polygon points="364.05 244.24 352.58 244.24 353.99 239.31 362.64 239.31 364.05 244.24"
              style="fill: rgb(255, 255, 255); transform-origin: 358.315px 241.775px;" id="el3zzva5xrht"
              class="animable"></polygon>
            <path d="M364.72,244.74h-12.8l1.7-5.93H363Zm-11.47-1h10.14l-1.12-3.93h-7.9Z"
              style="fill: rgb(185, 215, 126); transform-origin: 358.32px 241.775px;" id="elp6mhi6vwaf"
              class="animable"></path>
            <path d="M358.44,228.5a3.26,3.26,0,1,1-3.26-3.25A3.26,3.26,0,0,1,358.44,228.5Z"
              style="fill: rgb(255, 255, 255); transform-origin: 355.18px 228.51px;" id="elnjk7wsyihol"
              class="animable"></path>
            <path
              d="M355.18,232.26a3.76,3.76,0,1,1,3.76-3.76A3.77,3.77,0,0,1,355.18,232.26Zm0-6.51a2.76,2.76,0,1,0,2.76,2.75A2.76,2.76,0,0,0,355.18,225.75Z"
              style="fill: rgb(185, 215, 126); transform-origin: 355.18px 228.5px;" id="eltdzm8vnnzct" class="animable">
            </path>
            <path d="M365,228.5a3.26,3.26,0,1,1-3.26-3.25A3.26,3.26,0,0,1,365,228.5Z"
              style="fill: rgb(255, 255, 255); transform-origin: 361.74px 228.51px;" id="elpuc7gbhj7xk"
              class="animable"></path>
            <path
              d="M361.69,232.26a3.76,3.76,0,1,1,3.76-3.76A3.76,3.76,0,0,1,361.69,232.26Zm0-6.51a2.76,2.76,0,1,0,2.76,2.75A2.75,2.75,0,0,0,361.69,225.75Z"
              style="fill: rgb(185, 215, 126); transform-origin: 361.69px 228.5px;" id="elh6q288uu1dn" class="animable">
            </path>
            <circle cx="358.32" cy="234.88" r="8.8"
              style="fill: rgb(255, 255, 255); transform-origin: 358.32px 234.88px;" id="elvhxmimxfpfo"
              class="animable"></circle>
            <path
              d="M358.32,244.18a9.3,9.3,0,1,1,9.3-9.3A9.31,9.31,0,0,1,358.32,244.18Zm0-17.6a8.3,8.3,0,1,0,8.3,8.3A8.31,8.31,0,0,0,358.32,226.58Z"
              style="fill: rgb(185, 215, 126); transform-origin: 358.32px 234.88px;" id="elkytr6tmctl9"
              class="animable"></path>
            <polygon
              points="359.13 239.41 357.82 234.88 357.82 228.5 358.82 228.5 358.82 234.81 360.09 239.13 359.13 239.41"
              style="fill: rgb(185, 215, 126); transform-origin: 358.955px 233.955px;" id="elj1mg5m7y3ar"
              class="animable"></polygon>
            <path
              d="M446.21,213.36V237a2.23,2.23,0,0,1-2.23,2.23H408.9l-8.66,6.7a1.65,1.65,0,0,1-2.64-1.33v-5.37h-1.35A2.23,2.23,0,0,1,394,237V213.35a2.24,2.24,0,0,1,2.24-2.22H444A2.22,2.22,0,0,1,446.21,213.36Z"
              style="fill: rgb(255, 255, 255); transform-origin: 420.105px 228.695px;" id="elxs1aw8zctme"
              class="animable"></path>
            <path
              d="M399.25,246.76a2.16,2.16,0,0,1-2.15-2.16v-4.87h-.85a2.74,2.74,0,0,1-2.74-2.73V213.35a2.74,2.74,0,0,1,2.72-2.72H444a2.72,2.72,0,0,1,2.72,2.73V237a2.73,2.73,0,0,1-2.73,2.73H409.07l-8.52,6.59A2.17,2.17,0,0,1,399.25,246.76Zm-3-35.13a1.73,1.73,0,0,0-1.73,1.72V237a1.73,1.73,0,0,0,1.74,1.73h1.85v5.87a1.16,1.16,0,0,0,1.15,1.16,1.14,1.14,0,0,0,.69-.23l8.79-6.8H444a1.72,1.72,0,0,0,1.73-1.73V213.36a1.73,1.73,0,0,0-1.72-1.73H396.24Z"
              style="fill: rgb(185, 215, 126); transform-origin: 420.115px 228.695px;" id="elh4iqqd6wbn6"
              class="animable"></path>
            <path d="M417.39,222.92h-13a1.13,1.13,0,0,1,0-2.26h13a1.13,1.13,0,0,1,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 410.89px 221.79px;" id="elymu8fvigi2d"
              class="animable"></path>
            <path d="M415.59,227.4H404.41a1.14,1.14,0,0,1,0-2.27h11.18a1.14,1.14,0,0,1,0,2.27Z"
              style="fill: rgb(185, 215, 126); transform-origin: 410px 226.265px;" id="eldlzqf8acpu" class="animable">
            </path>
            <path d="M413.79,231.87h-9.38a1.13,1.13,0,0,1,0-2.26h9.38a1.13,1.13,0,0,1,0,2.26Z"
              style="fill: rgb(185, 215, 126); transform-origin: 409.1px 230.74px;" id="elg7gxgd3bkr" class="animable">
            </path>
            <polygon points="438.11 234.63 426.64 234.63 428.05 229.7 436.7 229.7 438.11 234.63"
              style="fill: rgb(255, 255, 255); transform-origin: 432.375px 232.165px;" id="eljzgzlfy36tn"
              class="animable"></polygon>
            <path d="M438.77,235.13H426l1.69-5.93h9.41Zm-11.47-1h10.15l-1.13-3.93h-7.89Z"
              style="fill: rgb(185, 215, 126); transform-origin: 432.385px 232.165px;" id="el4cztnsq33v"
              class="animable"></path>
            <path d="M432.49,218.9a3.26,3.26,0,1,1-3.25-3.26A3.26,3.26,0,0,1,432.49,218.9Z"
              style="fill: rgb(255, 255, 255); transform-origin: 429.23px 218.9px;" id="elbov3qntvde" class="animable">
            </path>
            <path
              d="M429.24,222.65A3.76,3.76,0,1,1,433,218.9,3.75,3.75,0,0,1,429.24,222.65Zm0-6.51A2.76,2.76,0,1,0,432,218.9,2.77,2.77,0,0,0,429.24,216.14Z"
              style="fill: rgb(185, 215, 126); transform-origin: 429.24px 218.89px;" id="elm2vvvc0yr0t"
              class="animable"></path>
            <path d="M439,218.9a3.26,3.26,0,1,1-3.26-3.26A3.26,3.26,0,0,1,439,218.9Z"
              style="fill: rgb(255, 255, 255); transform-origin: 435.74px 218.9px;" id="ela2jm1sb83ii" class="animable">
            </path>
            <path
              d="M435.75,222.65a3.76,3.76,0,1,1,3.76-3.75A3.76,3.76,0,0,1,435.75,222.65Zm0-6.51a2.76,2.76,0,1,0,2.76,2.76A2.77,2.77,0,0,0,435.75,216.14Z"
              style="fill: rgb(185, 215, 126); transform-origin: 435.75px 218.89px;" id="el8abimyy18op"
              class="animable"></path>
            <circle cx="432.37" cy="225.28" r="8.8"
              style="fill: rgb(255, 255, 255); transform-origin: 432.37px 225.28px;" id="eleh4rrxc4cza"
              class="animable"></circle>
            <path
              d="M432.37,234.58a9.31,9.31,0,1,1,9.31-9.3A9.31,9.31,0,0,1,432.37,234.58Zm0-17.61a8.31,8.31,0,1,0,8.31,8.31A8.32,8.32,0,0,0,432.37,217Z"
              style="fill: rgb(185, 215, 126); transform-origin: 432.37px 225.27px;" id="els4f6t2pqrxa"
              class="animable"></path>
            <polygon
              points="432.63 231.22 431.63 231.18 431.87 225.41 428.82 220.67 429.66 220.13 432.88 225.14 432.63 231.22"
              style="fill: rgb(185, 215, 126); transform-origin: 430.85px 225.675px;" id="el01w8hvo6upb5"
              class="animable"></polygon>
          </g>
          <defs>
            <filter id="active" height="200%">
              <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
              <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
              <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
              <feMerge>
                <feMergeNode in="OUTLINE"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
              </feMerge>
            </filter>
            <filter id="hover" height="200%">
              <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
              <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
              <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
              <feMerge>
                <feMergeNode in="OUTLINE"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
              </feMerge>
              <feColorMatrix type="matrix"
                values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 ">
              </feColorMatrix>
            </filter>
          </defs>
        </svg>
        <h4>Creer votre ticket</h4>
        <p>Voici un petit guide pour vous aider à créer et suivre vos tickets :</p>

      </div>

      <div class="col-lg-3 px-4" data-aos="fade-left" data-aos-duration="15500">
        <svg class="animated" width="250" id="freepik_stories-ecommerce-checkout-laptop"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" version="1.1"
          xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
          <style>
            svg#freepik_stories-ecommerce-checkout-laptop:not(.animated) .animable {
              opacity: 0;
            }

            svg#freepik_stories-ecommerce-checkout-laptop.animated #freepik--background-complete--inject-5 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideLeft;
              animation-delay: 0s;
            }

            svg#freepik_stories-ecommerce-checkout-laptop.animated #freepik--Shadow--inject-5 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideUp;
              animation-delay: 0s;
            }

            svg#freepik_stories-ecommerce-checkout-laptop.animated #freepik--Device--inject-5 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideRight;
              animation-delay: 0s;
            }

            svg#freepik_stories-ecommerce-checkout-laptop.animated #freepik--Tab--inject-5 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedLeft, 1.5s Infinite linear floating;
              animation-delay: 0s, 1s;
            }

            svg#freepik_stories-ecommerce-checkout-laptop.animated #freepik--Character--inject-5 {
              animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideRight;
              animation-delay: 0s;
            }

            @keyframes slideLeft {
              0% {
                opacity: 0;
                transform: translateX(-30px);
              }

              100% {
                opacity: 1;
                transform: translateX(0);
              }
            }

            @keyframes slideUp {
              0% {
                opacity: 0;
                transform: translateY(30px);
              }

              100% {
                opacity: 1;
                transform: inherit;
              }
            }

            @keyframes slideRight {
              0% {
                opacity: 0;
                transform: translateX(30px);
              }

              100% {
                opacity: 1;
                transform: translateX(0);
              }
            }

            @keyframes lightSpeedLeft {
              from {
                transform: translate3d(-50%, 0, 0) skewX(20deg);
                opacity: 0;
              }

              60% {
                transform: skewX(-10deg);
                opacity: 1;
              }

              80% {
                transform: skewX(2deg);
              }

              to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
              }
            }

            @keyframes floating {
              0% {
                opacity: 1;
                transform: translateY(0px);
              }

              50% {
                transform: translateY(-10px);
              }

              100% {
                opacity: 1;
                transform: translateY(0px);
              }
            }

            .animator-hidden {
              display: none;
            }
          </style>
          <g id="freepik--background-complete--inject-5" class="animable animator-hidden"
            style="transform-origin: 250px 231.005px;">
            <rect y="382.4" width="500" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 250px 382.525px;" id="elh4nzym6rznp" class="animable">
            </rect>
            <rect x="416.78" y="398.49" width="33.12" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 433.34px 398.615px;" id="elbcw411swsd"
              class="animable"></rect>
            <rect x="322.53" y="401.21" width="8.69" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 326.875px 401.335px;" id="elbw2bt8ss60r"
              class="animable"></rect>
            <rect x="396.59" y="389.21" width="19.19" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 406.185px 389.335px;" id="el1yr952k1l1li"
              class="animable"></rect>
            <rect x="52.46" y="390.89" width="43.19" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 74.055px 391.015px;" id="el2tssgzi612a"
              class="animable"></rect>
            <rect x="104.56" y="390.89" width="6.33" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 107.725px 391.015px;" id="elkki5q45l8y"
              class="animable"></rect>
            <rect x="131.47" y="395.11" width="93.68" height="0.25"
              style="fill: rgb(235, 235, 235); transform-origin: 178.31px 395.235px;" id="el2gn1aaqyrbs"
              class="animable"></rect>
            <path
              d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z"
              style="fill: rgb(235, 235, 235); transform-origin: 140.46px 196.4px;" id="el5vi9hyt9cxh" class="animable">
            </path>
            <path
              d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z"
              style="fill: rgb(235, 235, 235); transform-origin: 356.75px 196.4px;" id="el9tqj5yke2bh" class="animable">
            </path>
            <rect x="49.78" y="371.41" width="58.09" height="35.6" rx="4.22"
              style="fill: rgb(235, 235, 235); transform-origin: 78.825px 389.21px;" id="el68gyrl39lf8"
              class="animable"></rect>
            <path
              d="M67.7,385.56H54.91a.82.82,0,0,1-.82-.82h0a.83.83,0,0,1,.82-.83H67.7a.83.83,0,0,1,.83.83h0A.83.83,0,0,1,67.7,385.56Z"
              style="fill: rgb(250, 250, 250); isolation: isolate; transform-origin: 61.31px 384.735px;"
              id="elsb5d8tbtxut" class="animable"></path>
            <path
              d="M103.91,376.83H91.12a.83.83,0,0,1-.82-.83h0a.83.83,0,0,1,.82-.83h12.79a.83.83,0,0,1,.83.83h0A.83.83,0,0,1,103.91,376.83Z"
              style="fill: rgb(250, 250, 250); isolation: isolate; transform-origin: 97.52px 376px;" id="elkije8fs9kg"
              class="animable"></path>
            <path
              d="M67.7,403H54.91a.83.83,0,0,1-.82-.83h0a.83.83,0,0,1,.82-.83H67.7a.83.83,0,0,1,.83.83h0A.83.83,0,0,1,67.7,403Z"
              style="fill: rgb(250, 250, 250); isolation: isolate; transform-origin: 61.31px 402.17px;"
              id="eljzx3w7fm068" class="animable"></path>
            <path
              d="M58.28,389.65H54.91a.83.83,0,0,1-.82-.83h0a.82.82,0,0,1,.82-.82h3.37a.82.82,0,0,1,.82.82h0A.83.83,0,0,1,58.28,389.65Z"
              style="fill: rgb(250, 250, 250); isolation: isolate; transform-origin: 56.595px 388.825px;"
              id="el2mn75kqox3i" class="animable"></path>
            <rect x="90.5" y="394.47" width="14.03" height="10.04" rx="1.71"
              style="fill: rgb(224, 224, 224); isolation: isolate; transform-origin: 97.515px 399.49px;"
              id="elns1cqiboaz" class="animable"></rect>
            <rect x="81.39" y="86.58" width="76.2" height="46.7" rx="4.22"
              style="fill: rgb(235, 235, 235); transform-origin: 119.49px 109.93px;" id="elfuvsmv4968b"
              class="animable"></rect>
            <path
              d="M104.9,105.15H88.13A1.09,1.09,0,0,1,87,104.07h0A1.09,1.09,0,0,1,88.13,103H104.9a1.09,1.09,0,0,1,1.09,1.09h0A1.09,1.09,0,0,1,104.9,105.15Z"
              style="fill: rgb(250, 250, 250); isolation: isolate; transform-origin: 96.495px 104.075px;"
              id="elqxrh0d9lzim" class="animable"></path>
            <path
              d="M152.41,93.69H135.63a1.08,1.08,0,0,1-1.08-1.09h0a1.08,1.08,0,0,1,1.08-1.08h16.78a1.08,1.08,0,0,1,1.08,1.08h0A1.08,1.08,0,0,1,152.41,93.69Z"
              style="fill: rgb(250, 250, 250); isolation: isolate; transform-origin: 144.02px 92.605px;"
              id="elgyqh2mjkuzj" class="animable"></path>
            <rect x="87.04" y="125.84" width="18.95" height="2.17" rx="0.79"
              style="fill: rgb(250, 250, 250); isolation: isolate; transform-origin: 96.515px 126.925px;"
              id="el4jck5hmlfz8" class="animable"></rect>
            <path
              d="M92.54,110.51H88.13A1.09,1.09,0,0,1,87,109.42h0a1.09,1.09,0,0,1,1.09-1.08h4.41a1.08,1.08,0,0,1,1.08,1.08h0A1.08,1.08,0,0,1,92.54,110.51Z"
              style="fill: rgb(250, 250, 250); isolation: isolate; transform-origin: 90.29px 109.425px;"
              id="el49ury646pbh" class="animable"></path>
            <rect x="134.82" y="116.84" width="18.4" height="13.17" rx="1.71"
              style="fill: rgb(224, 224, 224); isolation: isolate; transform-origin: 144.02px 123.425px;"
              id="eloocamld9fiq" class="animable"></rect>
            <path
              d="M304.88,115.19v5.41h-4v-5.36c-4.73-.29-9.31-1.83-11.82-4l2.17-4.87a18.53,18.53,0,0,0,9.65,3.67v-9.65c-5.36-1.31-11.1-3-11.1-9.75,0-4.92,3.57-9.22,11.1-9.94V75.23h4v5.36a20.71,20.71,0,0,1,9.79,2.94l-2,4.88a19.89,19.89,0,0,0-7.81-2.61v9.75c5.35,1.3,11.19,3,11.19,9.7C316.07,110.17,312.45,114.42,304.88,115.19Zm-4-20.65V86c-3.43.53-4.87,2.26-4.87,4.39C296.05,92.65,298.12,93.72,300.92,94.54Zm9,11.14c0-2.36-2.13-3.47-5-4.29v8.54C308.4,109.4,309.9,107.76,309.9,105.68Z"
              style="fill: rgb(224, 224, 224); transform-origin: 302.555px 97.915px;" id="elwgqx265i84j"
              class="animable"></path>
            <path
              d="M430.12,348.29v4.12h-3v-4.09c-3.6-.22-7.1-1.4-9-3.05l1.65-3.72a14.14,14.14,0,0,0,7.36,2.8V337c-4.08-1-8.46-2.32-8.46-7.43,0-3.75,2.72-7,8.46-7.58v-4.15h3v4.08a15.91,15.91,0,0,1,7.47,2.24l-1.51,3.72a15.23,15.23,0,0,0-6-2v7.43c4.08,1,8.53,2.28,8.53,7.4C438.65,344.46,435.89,347.7,430.12,348.29Zm-3-15.75V326c-2.61.41-3.71,1.73-3.71,3.35C423.39,331.11,425,331.92,427.1,332.54Zm6.84,8.5c0-1.8-1.61-2.65-3.82-3.28v6.52C432.8,343.87,433.94,342.62,433.94,341Z"
              style="fill: rgb(224, 224, 224); transform-origin: 428.37px 335.125px;" id="eln123n33l92j"
              class="animable"></path>
            <path
              d="M53.64,307.63a7.36,7.36,0,0,1-2-5.46,8.24,8.24,0,0,1,.92-4,6.24,6.24,0,0,1,2.53-2.56,8.07,8.07,0,0,1,7.29,0,6.32,6.32,0,0,1,2.54,2.56,8.35,8.35,0,0,1,.91,4,7.39,7.39,0,0,1-2,5.46,7.58,7.58,0,0,1-10.22,0Zm20.78-12.51h6.45L62.64,321.81H56.19ZM60,304.71a7.07,7.07,0,0,0,0-5.07,1.32,1.32,0,0,0-2.41,0,7.07,7.07,0,0,0,0,5.07,1.32,1.32,0,0,0,2.41,0Zm13.25,15.5a7.37,7.37,0,0,1-2-5.45,8.28,8.28,0,0,1,.91-4,6.18,6.18,0,0,1,2.54-2.55,8,8,0,0,1,7.28,0,6.18,6.18,0,0,1,2.54,2.55,8.28,8.28,0,0,1,.92,4,7.38,7.38,0,0,1-2,5.45,7.56,7.56,0,0,1-10.22,0Zm6.31-2.92a6.93,6.93,0,0,0,0-5.07,1.31,1.31,0,0,0-2.4,0,6.93,6.93,0,0,0,0,5.07,1.31,1.31,0,0,0,2.4,0Z"
              style="fill: rgb(224, 224, 224); transform-origin: 68.5395px 308.469px;" id="eldtt9wcatsum"
              class="animable"></path>
            <path
              d="M380.48,158.1a10.49,10.49,0,0,1-2.81-7.74,11.69,11.69,0,0,1,1.3-5.69,8.78,8.78,0,0,1,3.6-3.62,11.4,11.4,0,0,1,10.34,0,8.9,8.9,0,0,1,3.6,3.62,11.81,11.81,0,0,1,1.29,5.69A10.45,10.45,0,0,1,395,158.1a10.77,10.77,0,0,1-14.51,0ZM410,140.34h9.15l-25.87,37.89h-9.15ZM389.44,154a9.87,9.87,0,0,0,0-7.2,1.86,1.86,0,0,0-3.41,0,10,10,0,0,0,0,7.2,1.86,1.86,0,0,0,3.41,0Zm18.81,22a10.49,10.49,0,0,1-2.81-7.74,11.65,11.65,0,0,1,1.3-5.68,8.75,8.75,0,0,1,3.6-3.63,11.38,11.38,0,0,1,10.33,0,8.75,8.75,0,0,1,3.6,3.63,11.65,11.65,0,0,1,1.3,5.68,10.45,10.45,0,0,1-2.81,7.74,10.74,10.74,0,0,1-14.51,0Zm9-4.14a9.87,9.87,0,0,0,0-7.2,1.86,1.86,0,0,0-3.41,0,9.87,9.87,0,0,0,0,7.2,1.86,1.86,0,0,0,3.41,0Z"
              style="fill: rgb(224, 224, 224); transform-origin: 401.62px 159.316px;" id="el4ix2iorccnk"
              class="animable"></path>
          </g>
          <g id="freepik--Shadow--inject-5" class="animable" style="transform-origin: 250px 416.24px;">
            <ellipse id="freepik--path--inject-5" cx="250" cy="416.24" rx="193.89" ry="11.32"
              style="fill: rgb(245, 245, 245); transform-origin: 250px 416.24px;" class="animable"></ellipse>
          </g>
          <g id="freepik--Device--inject-5" class="animable animator-hidden"
            style="transform-origin: 251.885px 295.085px;">
            <path
              d="M410.5,173.94H93.26a13.21,13.21,0,0,0-13.21,13.21v201a13.22,13.22,0,0,0,13.21,13.22h42.11v-6.44a3.43,3.43,0,0,1,3.43-3.43H365a3.42,3.42,0,0,1,3.43,3.43v6.44H410.5a13.21,13.21,0,0,0,13.21-13.22v-201A13.2,13.2,0,0,0,410.5,173.94Z"
              style="fill: rgb(38, 50, 56); transform-origin: 251.88px 287.655px;" id="elmygi17k9hmb" class="animable">
            </path>
            <g id="elc1zrcj9ni3f">
              <path
                d="M410.5,173.94H93.26a13.21,13.21,0,0,0-13.21,13.21v201a13.22,13.22,0,0,0,13.21,13.22h42.11v-6.44a3.43,3.43,0,0,1,3.43-3.43H365a3.42,3.42,0,0,1,3.43,3.43v6.44H410.5a13.21,13.21,0,0,0,13.21-13.22v-201A13.2,13.2,0,0,0,410.5,173.94Z"
                style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 251.88px 287.655px;" class="animable"
                id="el31jclgh2na2"></path>
            </g>
            <path d="M254.66,182.59a2.78,2.78,0,1,1-2.78-2.78A2.77,2.77,0,0,1,254.66,182.59Z"
              style="fill: #B9D77E; transform-origin: 251.88px 182.59px;" id="el8jynbcqwx6d" class="animable"></path>
            <rect x="54.09" y="396.43" width="395.59" height="9.9"
              style="fill: rgb(38, 50, 56); transform-origin: 251.885px 401.38px;" id="elevnc67xykgg" class="animable">
            </rect>
            <g id="elakcqzxj9cum">
              <rect x="54.09" y="396.43" width="395.59" height="9.9"
                style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 251.885px 401.38px;" class="animable"
                id="elld0x4foh6y"></rect>
            </g>
            <path d="M54.09,406.33l6.12,4.9a22.74,22.74,0,0,0,14.23,5H429.32a22.74,22.74,0,0,0,14.23-5l6.13-4.9Z"
              style="fill: rgb(38, 50, 56); transform-origin: 251.885px 411.28px;" id="el8qmyjciqzwy" class="animable">
            </path>
            <g id="el08vb20w0v6l">
              <path d="M54.09,406.33l6.12,4.9a22.74,22.74,0,0,0,14.23,5H429.32a22.74,22.74,0,0,0,14.23-5l6.13-4.9Z"
                style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 251.885px 411.28px;" class="animable"
                id="elxm698b1lh7"></path>
            </g>
            <g id="el1ufy5ta4xy4j">
              <path
                d="M213.87,396.75a4.62,4.62,0,0,0,4.62,4.63h66.78a4.62,4.62,0,0,0,4.62-4.63c0-.11,0-.21,0-.32h-76C213.89,396.54,213.87,396.64,213.87,396.75Z"
                style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 251.88px 398.905px;" class="animable"
                id="el6qkwnl3mad5"></path>
            </g>
            <rect x="94.59" y="194.17" width="313.67" height="178.52"
              style="fill: #B9D77E; transform-origin: 251.425px 283.43px;" id="eluhnqn8rfmcj" class="animable"></rect>
            <g id="elml8z1hh8c9p">
              <g style="opacity: 0.9; transform-origin: 251.425px 283.43px;" class="animable" id="elfqf9p0pgeal">
                <rect x="94.59" y="194.17" width="313.67" height="178.52"
                  style="fill: rgb(255, 255, 255); transform-origin: 251.425px 283.43px;" id="eldhgog2k3oqm"
                  class="animable"></rect>
              </g>
            </g>
            <rect x="136.31" y="222.72" width="226.66" height="7.5"
              style="fill: #B9D77E; transform-origin: 249.64px 226.47px;" id="eljaojq8itqd" class="animable"></rect>
            <g id="el20783uqgx5">
              <g style="opacity: 0.8; transform-origin: 249.64px 226.47px;" class="animable" id="elzo3b53swrm">
                <rect x="136.31" y="222.72" width="226.66" height="7.5"
                  style="fill: rgb(255, 255, 255); transform-origin: 249.64px 226.47px;" id="elslu2ectcfe"
                  class="animable"></rect>
              </g>
            </g>
            <rect x="362.96" y="222.72" width="8.12" height="7.5"
              style="fill: #B9D77E; transform-origin: 367.02px 226.47px;" id="el8r9tn12uzjy" class="animable"></rect>
            <g id="elh3g5j1bv9pc">
              <g style="opacity: 0.5; transform-origin: 367.02px 226.47px;" class="animable" id="eljj9xf111c1">
                <rect x="362.96" y="222.72" width="8.12" height="7.5"
                  style="fill: rgb(255, 255, 255); transform-origin: 367.02px 226.47px;" id="elzwobonme95j"
                  class="animable"></rect>
              </g>
            </g>
            <rect x="94.59" y="194.17" width="313.67" height="8.48"
              style="fill: #B9D77E; transform-origin: 251.425px 198.41px;" id="elllj1k6lwwr" class="animable"></rect>
            <path d="M385.71,198.41a2.44,2.44,0,1,1-2.43-2.43A2.43,2.43,0,0,1,385.71,198.41Z"
              style="fill: rgb(255, 255, 255); transform-origin: 383.27px 198.42px;" id="eltxg6h6xmtrj"
              class="animable"></path>
            <path d="M395.05,198.41a2.44,2.44,0,1,1-2.44-2.43A2.43,2.43,0,0,1,395.05,198.41Z"
              style="fill: rgb(255, 255, 255); transform-origin: 392.61px 198.42px;" id="elzzynvvftml" class="animable">
            </path>
            <path d="M404.38,198.41A2.43,2.43,0,1,1,402,196,2.43,2.43,0,0,1,404.38,198.41Z"
              style="fill: rgb(255, 255, 255); transform-origin: 401.95px 198.429px;" id="ellu9y262hzwk"
              class="animable"></path>
            <path
              d="M101.61,229.6a4.08,4.08,0,0,1-1.22-.48l.68-1.55a4.37,4.37,0,0,0,1,.42,3.75,3.75,0,0,0,1.07.16,1.63,1.63,0,0,0,.64-.09.27.27,0,0,0,.19-.25.32.32,0,0,0-.25-.3,5.2,5.2,0,0,0-.82-.22,8.66,8.66,0,0,1-1.22-.33,2.06,2.06,0,0,1-.84-.57,1.58,1.58,0,0,1-.36-1.09,1.86,1.86,0,0,1,.33-1.08,2.15,2.15,0,0,1,1-.77,4,4,0,0,1,1.61-.28,6,6,0,0,1,1.27.14,3.94,3.94,0,0,1,1.11.41l-.64,1.54a4,4,0,0,0-1.76-.47c-.55,0-.82.14-.82.4s.08.22.24.28a4.14,4.14,0,0,0,.8.21,8,8,0,0,1,1.22.31,2.16,2.16,0,0,1,.86.57,1.57,1.57,0,0,1,.37,1.08,1.8,1.8,0,0,1-.34,1.08,2.24,2.24,0,0,1-1,.77,4.11,4.11,0,0,1-1.61.28A7,7,0,0,1,101.61,229.6Z"
              style="fill: rgb(38, 50, 56); transform-origin: 103.231px 226.47px;" id="elkvd7hd7gc3i" class="animable">
            </path>
            <path d="M108,225h-1.85v-1.66H112V225h-1.84v4.66H108Z"
              style="fill: rgb(38, 50, 56); transform-origin: 109.075px 226.5px;" id="elqegk1zndidc" class="animable">
            </path>
            <path
              d="M113.9,229.35a3.29,3.29,0,0,1-1.27-1.18,3.37,3.37,0,0,1,0-3.4,3.29,3.29,0,0,1,1.27-1.18,4.2,4.2,0,0,1,3.66,0,3.23,3.23,0,0,1,0,5.76,4.2,4.2,0,0,1-3.66,0Zm2.55-1.5a1.4,1.4,0,0,0,.51-.54,1.74,1.74,0,0,0,.19-.84,1.67,1.67,0,0,0-.19-.83,1.43,1.43,0,0,0-.51-.55,1.38,1.38,0,0,0-1.43,0,1.29,1.29,0,0,0-.51.55,1.67,1.67,0,0,0-.19.83,1.74,1.74,0,0,0,.19.84,1.27,1.27,0,0,0,.51.54,1.38,1.38,0,0,0,1.43,0Z"
              style="fill: rgb(38, 50, 56); transform-origin: 115.749px 226.47px;" id="elsx7oy5cib8" class="animable">
            </path>
            <path
              d="M122.78,228h-.58v1.59h-2.13v-6.32h3a3.75,3.75,0,0,1,1.52.29,2.21,2.21,0,0,1,1.36,2.1,2.12,2.12,0,0,1-1.19,2l1.32,1.95h-2.27Zm.84-2.89A.94.94,0,0,0,123,225h-.77v1.48H123a.94.94,0,0,0,.65-.2.67.67,0,0,0,.22-.54A.68.68,0,0,0,123.62,225.15Z"
              style="fill: rgb(38, 50, 56); transform-origin: 123.075px 226.44px;" id="elk8fa5jo2mee" class="animable">
            </path>
            <path d="M132,228v1.61h-5.25v-6.32h5.13v1.61h-3v.74h2.67v1.53h-2.67V228Z"
              style="fill: rgb(38, 50, 56); transform-origin: 129.375px 226.45px;" id="elzi8tlg14s9" class="animable">
            </path>
            <path d="M379,230.21a1.08,1.08,0,1,1-1.08-1.08A1.08,1.08,0,0,1,379,230.21Z"
              style="fill: rgb(38, 50, 56); transform-origin: 377.92px 230.21px;" id="elp35dpl5mpjb" class="animable">
            </path>
            <path d="M385.71,230.21a1.09,1.09,0,1,1-1.08-1.08A1.09,1.09,0,0,1,385.71,230.21Z"
              style="fill: rgb(38, 50, 56); transform-origin: 384.62px 230.22px;" id="elw3zcnxj3u3" class="animable">
            </path>
            <path
              d="M377,222.55l-.73-2.34h-2.74V221h2.19l2.06,6.68h7.19l.64-4.42Zm7.41,4.55-6.13-.07-1.16-3.89,7.79.57Z"
              style="fill: rgb(38, 50, 56); transform-origin: 379.57px 223.945px;" id="el2m2xkpf7dv1" class="animable">
            </path>
            <rect x="94.59" y="202.65" width="313.67" height="16.12"
              style="fill: #B9D77E; transform-origin: 251.425px 210.71px;" id="elbdi7bdavk9" class="animable"></rect>
            <g id="ela11d55ukwh">
              <g style="opacity: 0.7; transform-origin: 251.425px 210.71px;" class="animable" id="elrxvrnz5hq4k">
                <rect x="94.59" y="202.65" width="313.67" height="16.12"
                  style="fill: rgb(255, 255, 255); transform-origin: 251.425px 210.71px;" id="ely3cd0sqhk2j"
                  class="animable"></rect>
              </g>
            </g>
            <rect x="115" y="206.29" width="188.94" height="8.83" rx="3.38"
              style="fill: rgb(38, 50, 56); transform-origin: 209.47px 210.705px;" id="elok3pxuud8wo" class="animable">
            </rect>
            <g id="eld8f2zwj7kgc">
              <rect x="115" y="206.29" width="188.94" height="8.83" rx="3.38"
                style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 209.47px 210.705px;" class="animable"
                id="elo2d1yu4n9g"></rect>
            </g>
            <polygon
              points="298.12 207.32 299.22 209.55 301.68 209.91 299.9 211.64 300.32 214.09 298.12 212.94 295.92 214.09 296.34 211.64 294.56 209.91 297.02 209.55 298.12 207.32"
              style="fill: #B9D77E; transform-origin: 298.12px 210.705px;" id="elpiow4qxdjkd" class="animable">
            </polygon>
            <polygon
              points="106.09 206.08 101.23 210.94 102.65 210.94 102.65 215.33 109.53 215.33 109.53 210.94 110.95 210.94 106.09 206.08"
              style="fill: #B9D77E; transform-origin: 106.09px 210.705px;" id="elcxvgbo1hazq" class="animable">
            </polygon>
            <path
              d="M283.87,265h2.69a3.78,3.78,0,0,1,1.62.33,2.5,2.5,0,0,1,1.08,1,2.64,2.64,0,0,1,.39,1.45,2.7,2.7,0,0,1-.39,1.46,2.48,2.48,0,0,1-1.08.94,3.64,3.64,0,0,1-1.62.34h-2.69Zm2.62,4a1.34,1.34,0,0,0,.94-2.26,1.31,1.31,0,0,0-.94-.33h-.78V269Z"
              style="fill: #B9D77E; transform-origin: 286.76px 267.76px;" id="elotnvrhfqt2" class="animable"></path>
            <path
              d="M294.79,268.69h-3a.71.71,0,0,0,.31.37,1,1,0,0,0,.55.13,1.26,1.26,0,0,0,.47-.07,1.85,1.85,0,0,0,.42-.24l.92.93a2.37,2.37,0,0,1-1.86.68,3.06,3.06,0,0,1-1.36-.28,2.2,2.2,0,0,1-.91-.79,2.21,2.21,0,0,1,0-2.29,2.16,2.16,0,0,1,.86-.78,2.67,2.67,0,0,1,1.24-.29,2.76,2.76,0,0,1,1.19.26,2.08,2.08,0,0,1,.85.76,2.19,2.19,0,0,1,.31,1.2S294.81,268.44,294.79,268.69ZM292,267.42a.78.78,0,0,0-.23.42h1.38a.73.73,0,0,0-.24-.42.68.68,0,0,0-.45-.15A.71.71,0,0,0,292,267.42Z"
              style="fill: #B9D77E; transform-origin: 292.404px 268.279px;" id="el7edp57nyqfx" class="animable"></path>
            <path d="M295.37,264.62h1.76v5.8h-1.76Z" style="fill: #B9D77E; transform-origin: 296.25px 267.52px;"
              id="elgpjavecait" class="animable"></path>
            <path
              d="M298,265.55a.81.81,0,0,1-.29-.65.79.79,0,0,1,.29-.64,1.12,1.12,0,0,1,.77-.26,1.16,1.16,0,0,1,.77.24.8.8,0,0,1,.29.63.88.88,0,0,1-.29.67,1.12,1.12,0,0,1-.77.26A1.17,1.17,0,0,1,298,265.55Zm-.11.59h1.76v4.28h-1.76Z"
              style="fill: #B9D77E; transform-origin: 298.77px 267.209px;" id="elzf0ivbhp5s" class="animable"></path>
            <path d="M305.22,266.14l-1.72,4.28h-1.83L300,266.14h1.81l.86,2.29.92-2.29Z"
              style="fill: #B9D77E; transform-origin: 302.61px 268.28px;" id="ell7sxhtrrgkr" class="animable"></path>
            <path
              d="M309.9,268.69h-3a.71.71,0,0,0,.31.37,1,1,0,0,0,.55.13,1.26,1.26,0,0,0,.47-.07,1.85,1.85,0,0,0,.42-.24l.92.93a2.36,2.36,0,0,1-1.86.68,3.06,3.06,0,0,1-1.36-.28,2.2,2.2,0,0,1-.91-.79,2.21,2.21,0,0,1,0-2.29,2.16,2.16,0,0,1,.86-.78,2.67,2.67,0,0,1,1.24-.29,2.73,2.73,0,0,1,1.19.26,2.08,2.08,0,0,1,.85.76,2.19,2.19,0,0,1,.31,1.2S309.92,268.44,309.9,268.69Zm-2.76-1.27a.73.73,0,0,0-.24.42h1.38a.73.73,0,0,0-.24-.42.75.75,0,0,0-.9,0Z"
              style="fill: #B9D77E; transform-origin: 307.514px 268.279px;" id="elsifyig1lbi" class="animable"></path>
            <path
              d="M313.54,266.06v1.57l-.39,0a.81.81,0,0,0-.91.92v1.9h-1.76v-4.28h1.68v.46A1.72,1.72,0,0,1,313.54,266.06Z"
              style="fill: #B9D77E; transform-origin: 312.01px 268.254px;" id="el8su1ckywhlm" class="animable"></path>
            <path
              d="M318.92,266.14l-1.76,4.36a2.37,2.37,0,0,1-.84,1.17,2.09,2.09,0,0,1-1.22.34,2.35,2.35,0,0,1-.73-.11,1.68,1.68,0,0,1-.57-.27l.59-1.21a1.06,1.06,0,0,0,.3.16,1,1,0,0,0,.32.06.54.54,0,0,0,.44-.17l-1.8-4.33h1.81l.89,2.29.89-2.29Z"
              style="fill: #B9D77E; transform-origin: 316.285px 269.076px;" id="ellhptgy3so9n" class="animable"></path>
            <path d="M325.32,269.46h-2.08l-.37,1H321l2.39-5.47h1.81l2.39,5.47h-1.91Zm-.51-1.32-.53-1.38-.53,1.38Z"
              style="fill: #B9D77E; transform-origin: 324.295px 267.725px;" id="elwb0agdpk4wr" class="animable"></path>
            <path
              d="M332.52,264.62v5.8h-1.68v-.36a1.49,1.49,0,0,1-1.17.43,2.17,2.17,0,0,1-1-.26,2,2,0,0,1-.75-.78,2.47,2.47,0,0,1-.28-1.17,2.41,2.41,0,0,1,.28-1.17,2,2,0,0,1,.75-.78,2.07,2.07,0,0,1,1-.27,1.5,1.5,0,0,1,1.08.37v-1.81Zm-1.93,4.28a.92.92,0,0,0,.2-.62.89.89,0,0,0-.2-.62.68.68,0,0,0-1,0,.89.89,0,0,0-.2.62.92.92,0,0,0,.2.62.68.68,0,0,0,1,0Z"
              style="fill: #B9D77E; transform-origin: 330.08px 267.557px;" id="eltadgccws2kl" class="animable"></path>
            <path
              d="M338,264.62v5.8h-1.68v-.36a1.49,1.49,0,0,1-1.17.43,2.17,2.17,0,0,1-1-.26,2,2,0,0,1-.75-.78,2.47,2.47,0,0,1-.28-1.17,2.41,2.41,0,0,1,.28-1.17,2,2,0,0,1,.75-.78,2.07,2.07,0,0,1,1-.27,1.5,1.5,0,0,1,1.08.37v-1.81Zm-1.93,4.28a.92.92,0,0,0,.19-.62.89.89,0,0,0-.19-.62.63.63,0,0,0-.5-.22.62.62,0,0,0-.5.22.89.89,0,0,0-.2.62.92.92,0,0,0,.2.62.62.62,0,0,0,.5.22A.63.63,0,0,0,336.1,268.9Z"
              style="fill: #B9D77E; transform-origin: 335.56px 267.557px;" id="elg4anovio2k" class="animable"></path>
            <path
              d="M341.87,266.06v1.57l-.39,0a.81.81,0,0,0-.91.92v1.9h-1.76v-4.28h1.68v.46A1.72,1.72,0,0,1,341.87,266.06Z"
              style="fill: #B9D77E; transform-origin: 340.34px 268.254px;" id="elw8ggxh28tzr" class="animable"></path>
            <path
              d="M346.86,268.69h-3a.67.67,0,0,0,.31.37,1,1,0,0,0,.55.13,1.33,1.33,0,0,0,.47-.07,1.85,1.85,0,0,0,.42-.24l.92.93a2.4,2.4,0,0,1-1.87.68,3.09,3.09,0,0,1-1.36-.28,2.17,2.17,0,0,1-.9-.79,2,2,0,0,1-.32-1.14,2.07,2.07,0,0,1,1.18-1.93,2.67,2.67,0,0,1,1.24-.29,2.72,2.72,0,0,1,1.18.26,2,2,0,0,1,.85.76,2.19,2.19,0,0,1,.32,1.2S346.87,268.44,346.86,268.69Zm-2.77-1.27a.67.67,0,0,0-.23.42h1.37a.72.72,0,0,0-.23-.42.69.69,0,0,0-.46-.15A.68.68,0,0,0,344.09,267.42Z"
              style="fill: #B9D77E; transform-origin: 344.471px 268.279px;" id="el9sgfk5cosmp" class="animable"></path>
            <path
              d="M348,270.38a2.94,2.94,0,0,1-.86-.31l.48-1.16a2.57,2.57,0,0,0,.71.28,3.09,3.09,0,0,0,.78.1,1.34,1.34,0,0,0,.43-.05.16.16,0,0,0,.12-.15c0-.07-.05-.12-.15-.14a4,4,0,0,0-.5-.08,7.25,7.25,0,0,1-.89-.16,1.4,1.4,0,0,1-.64-.38,1.08,1.08,0,0,1-.28-.8,1.19,1.19,0,0,1,.25-.75,1.71,1.71,0,0,1,.75-.52,3.22,3.22,0,0,1,1.19-.2,5,5,0,0,1,.95.09,2.71,2.71,0,0,1,.79.27l-.48,1.16a2.51,2.51,0,0,0-1.24-.31c-.38,0-.58.07-.58.2s.06.12.16.15l.49.08a5.53,5.53,0,0,1,.89.16,1.56,1.56,0,0,1,.64.38,1.14,1.14,0,0,1,.28.81,1.24,1.24,0,0,1-.25.73,1.79,1.79,0,0,1-.75.52,3.38,3.38,0,0,1-1.21.19A4.83,4.83,0,0,1,348,270.38Z"
              style="fill: #B9D77E; transform-origin: 349.216px 268.275px;" id="elp33ybdf96h" class="animable"></path>
            <path
              d="M352.44,270.38a3.05,3.05,0,0,1-.86-.31l.49-1.16a2.62,2.62,0,0,0,.7.28,3.11,3.11,0,0,0,.79.1,1.43,1.43,0,0,0,.43-.05.16.16,0,0,0,.12-.15c0-.07-.05-.12-.16-.14a3.78,3.78,0,0,0-.49-.08,6.92,6.92,0,0,1-.89-.16,1.44,1.44,0,0,1-.65-.38,1.12,1.12,0,0,1-.27-.8,1.19,1.19,0,0,1,.25-.75,1.62,1.62,0,0,1,.74-.52,3.26,3.26,0,0,1,1.19-.2,4.94,4.94,0,0,1,.95.09,2.78,2.78,0,0,1,.8.27l-.49,1.16a2.47,2.47,0,0,0-1.23-.31c-.39,0-.58.07-.58.2s.05.12.15.15l.5.08a5.39,5.39,0,0,1,.88.16,1.44,1.44,0,0,1,.64.38,1.09,1.09,0,0,1,.28.81,1.17,1.17,0,0,1-.25.73,1.73,1.73,0,0,1-.75.52,3.34,3.34,0,0,1-1.21.19A5,5,0,0,1,352.44,270.38Z"
              style="fill: #B9D77E; transform-origin: 353.656px 268.275px;" id="elqi6nf1m4kua" class="animable"></path>
            <rect x="283.49" y="284.86" width="57.49" height="3.43"
              style="fill: #B9D77E; transform-origin: 312.235px 286.575px;" id="elo9xhrxp6v4" class="animable"></rect>
            <rect x="283.49" y="290.37" width="45.72" height="3.43"
              style="fill: #B9D77E; transform-origin: 306.35px 292.085px;" id="elfr0nwht0jvo" class="animable"></rect>
            <rect x="283.49" y="295.88" width="63.15" height="3.43"
              style="fill: #B9D77E; transform-origin: 315.065px 297.595px;" id="el1ek0nz1phgm" class="animable"></rect>
            <rect x="283.49" y="301.39" width="53.02" height="3.43"
              style="fill: #B9D77E; transform-origin: 310px 303.105px;" id="elyx6f5kd49ir" class="animable"></rect>
            <rect x="284.12" y="320.45" width="79.24" height="13.11" rx="5.44"
              style="fill: #B9D77E; transform-origin: 323.74px 327.005px;" id="el5g09vlunbwk" class="animable"></rect>
            <path
              d="M296.2,324.67a1.64,1.64,0,0,1,.7,2.34,1.67,1.67,0,0,1-.7.58,2.67,2.67,0,0,1-1.06.2h-.64v1.08H293v-4.4h2.12A2.67,2.67,0,0,1,296.2,324.67Zm-.7,1.84a.49.49,0,0,0,.15-.38.48.48,0,0,0-.15-.38.68.68,0,0,0-.46-.14h-.54v1H295A.68.68,0,0,0,295.5,326.51Z"
              style="fill: rgb(255, 255, 255); transform-origin: 295.071px 326.67px;" id="el86hjft1adlh"
              class="animable"></path>
            <path
              d="M300.47,325.77A1.55,1.55,0,0,1,301,327v1.85h-1.32v-.45a1,1,0,0,1-1,.51,1.62,1.62,0,0,1-.7-.14,1,1,0,0,1-.58-.93.87.87,0,0,1,.39-.77,2.09,2.09,0,0,1,1.18-.26h.57c0-.27-.26-.41-.64-.41a1.55,1.55,0,0,0-.47.08,1.2,1.2,0,0,0-.41.19l-.46-.93a2.64,2.64,0,0,1,.72-.29,3.37,3.37,0,0,1,.83-.1A2.08,2.08,0,0,1,300.47,325.77ZM299.35,328a.45.45,0,0,0,.18-.24v-.24h-.35c-.29,0-.43.1-.43.29a.25.25,0,0,0,.09.2.36.36,0,0,0,.24.08A.4.4,0,0,0,299.35,328Z"
              style="fill: rgb(255, 255, 255); transform-origin: 299.2px 327.133px;" id="eljyad97b749" class="animable">
            </path>
            <path
              d="M305.33,325.43l-1.41,3.51a2,2,0,0,1-.68.94,1.69,1.69,0,0,1-1,.27,2.32,2.32,0,0,1-.58-.08,1.31,1.31,0,0,1-.46-.23l.47-1a.92.92,0,0,0,.24.13.85.85,0,0,0,.26.05.45.45,0,0,0,.35-.14l-1.44-3.48h1.45l.71,1.84.73-1.84Z"
              style="fill: rgb(255, 255, 255); transform-origin: 303.205px 327.776px;" id="el55ed492e8rj"
              class="animable"></path>
            <path
              d="M311.1,325.75a1.6,1.6,0,0,1,.37,1.16v2h-1.42v-1.72c0-.39-.13-.59-.38-.59a.41.41,0,0,0-.33.15.77.77,0,0,0-.12.48v1.68H307.8v-1.72c0-.39-.13-.59-.38-.59a.41.41,0,0,0-.33.15.77.77,0,0,0-.12.48v1.68h-1.42v-3.44h1.35v.32a1.35,1.35,0,0,1,1-.38,1.41,1.41,0,0,1,.62.13,1,1,0,0,1,.45.39,1.45,1.45,0,0,1,.5-.39,1.57,1.57,0,0,1,.65-.13A1.35,1.35,0,0,1,311.1,325.75Z"
              style="fill: rgb(255, 255, 255); transform-origin: 308.513px 327.159px;" id="elufxonclkukn"
              class="animable"></path>
            <path
              d="M315.79,327.48H313.4a.57.57,0,0,0,.25.3.87.87,0,0,0,.44.1,1,1,0,0,0,.38-.06,1.18,1.18,0,0,0,.34-.19l.74.75a1.93,1.93,0,0,1-1.5.55,2.54,2.54,0,0,1-1.1-.23,1.66,1.66,0,0,1-.72-.64,1.59,1.59,0,0,1-.26-.91,1.71,1.71,0,0,1,.95-1.56,2.16,2.16,0,0,1,1-.22,2.31,2.31,0,0,1,.95.2,1.74,1.74,0,0,1,.68.61,1.78,1.78,0,0,1,.26,1S315.8,327.28,315.79,327.48Zm-2.23-1a.56.56,0,0,0-.18.34h1.1a.55.55,0,0,0-.19-.33.54.54,0,0,0-.36-.12A.62.62,0,0,0,313.56,326.45Z"
              style="fill: rgb(255, 255, 255); transform-origin: 313.89px 327.152px;" id="elohlj4dlspqf"
              class="animable"></path>
            <path
              d="M319.66,325.75a1.56,1.56,0,0,1,.39,1.16v2h-1.42v-1.72c0-.39-.14-.59-.42-.59a.51.51,0,0,0-.39.17.75.75,0,0,0-.15.52v1.62h-1.42v-3.44h1.35v.34a1.45,1.45,0,0,1,.47-.3,1.56,1.56,0,0,1,.57-.1A1.41,1.41,0,0,1,319.66,325.75Z"
              style="fill: rgb(255, 255, 255); transform-origin: 318.152px 327.158px;" id="el4dg0mgno9w"
              class="animable"></path>
            <path
              d="M323.2,328.75a1.83,1.83,0,0,1-.88.18,1.62,1.62,0,0,1-1.11-.35,1.32,1.32,0,0,1-.39-1v-.88h-.47v-1h.47v-1h1.42v1H323v1h-.71v.86a.37.37,0,0,0,.08.25.29.29,0,0,0,.22.09.58.58,0,0,0,.32-.1Z"
              style="fill: rgb(255, 255, 255); transform-origin: 321.775px 326.817px;" id="elvadqcmgn6d"
              class="animable"></path>
            <path d="M329.41,328.87v-2l-1,1.61h-.65l-1-1.54v1.94h-1.35v-4.4h1.21l1.44,2.34,1.39-2.34h1.22v4.4Z"
              style="fill: rgb(255, 255, 255); transform-origin: 328.04px 326.68px;" id="elqo0q6penzc" class="animable">
            </path>
            <path
              d="M335.07,327.48h-2.38a.57.57,0,0,0,.25.3.84.84,0,0,0,.44.1,1,1,0,0,0,.38-.06,1.15,1.15,0,0,0,.33-.19l.75.75a1.94,1.94,0,0,1-1.51.55,2.5,2.5,0,0,1-1.09-.23,1.69,1.69,0,0,1-.73-.64,1.74,1.74,0,0,1,.7-2.47,2.12,2.12,0,0,1,1-.22,2.24,2.24,0,0,1,.95.2,1.7,1.7,0,0,1,.69.61,1.77,1.77,0,0,1,.25,1S335.09,327.28,335.07,327.48Zm-2.22-1a.58.58,0,0,0-.19.34h1.11a.55.55,0,0,0-.19-.33.57.57,0,0,0-.37-.12A.61.61,0,0,0,332.85,326.45Z"
              style="fill: rgb(255, 255, 255); transform-origin: 333.176px 327.153px;" id="el80hgyi16ly4"
              class="animable"></path>
            <path
              d="M338.07,328.75a1.76,1.76,0,0,1-.87.18,1.62,1.62,0,0,1-1.11-.35,1.32,1.32,0,0,1-.39-1v-.88h-.47v-1h.47v-1h1.42v1h.7v1h-.7v.86a.33.33,0,0,0,.08.25.26.26,0,0,0,.21.09.58.58,0,0,0,.32-.1Z"
              style="fill: rgb(255, 255, 255); transform-origin: 336.65px 326.817px;" id="el6zxkzy3nxey"
              class="animable"></path>
            <path
              d="M341.84,325.75a1.56,1.56,0,0,1,.39,1.16v2h-1.42v-1.72c0-.39-.14-.59-.42-.59a.51.51,0,0,0-.39.17.75.75,0,0,0-.15.52v1.62h-1.42V324.2h1.42v1.51a1.56,1.56,0,0,1,2,0Z"
              style="fill: rgb(255, 255, 255); transform-origin: 340.332px 326.555px;" id="el5weghytxuic"
              class="animable"></path>
            <path
              d="M343.69,328.7a1.74,1.74,0,0,1-.71-.63,1.7,1.7,0,0,1-.26-.92,1.72,1.72,0,0,1,1-1.56,2.54,2.54,0,0,1,2.07,0,1.69,1.69,0,0,1,.71.64,1.67,1.67,0,0,1,.25.92,1.69,1.69,0,0,1-.25.92,1.74,1.74,0,0,1-.71.63,2.44,2.44,0,0,1-2.07,0Zm1.43-1.05a.72.72,0,0,0,.16-.5.7.7,0,0,0-.16-.5.53.53,0,0,0-.8,0,.7.7,0,0,0-.16.5.72.72,0,0,0,.16.5.56.56,0,0,0,.8,0Z"
              style="fill: rgb(255, 255, 255); transform-origin: 344.735px 327.15px;" id="elon3g1anc6xj"
              class="animable"></path>
            <path
              d="M351,324.2v4.67h-1.35v-.29a1.18,1.18,0,0,1-.95.35,1.59,1.59,0,0,1-.83-.22,1.56,1.56,0,0,1-.6-.62,1.92,1.92,0,0,1-.23-.94,1.9,1.9,0,0,1,.23-.94,1.65,1.65,0,0,1,.6-.63,1.68,1.68,0,0,1,.83-.21,1.23,1.23,0,0,1,.88.29V324.2Zm-1.55,3.45a.76.76,0,0,0,.15-.5.75.75,0,0,0-.15-.5.52.52,0,0,0-.41-.18.52.52,0,0,0-.4.18.75.75,0,0,0-.16.5.77.77,0,0,0,.16.5.54.54,0,0,0,.4.17A.55.55,0,0,0,349.42,327.65Z"
              style="fill: rgb(255, 255, 255); transform-origin: 349.02px 326.567px;" id="eldut3at7ks2h"
              class="animable"></path>
            <rect x="178.66" y="245.04" width="98.47" height="5.02"
              style="fill: #B9D77E; transform-origin: 227.895px 247.55px;" id="elt7eyooplt6f" class="animable"></rect>
            <rect x="178.66" y="252.02" width="21.61" height="5.02"
              style="fill: #B9D77E; transform-origin: 189.465px 254.53px;" id="elpi11j0gh0em" class="animable"></rect>
            <rect x="178.66" y="259.01" width="29.69" height="5.02"
              style="fill: #B9D77E; transform-origin: 193.505px 261.52px;" id="el7dc3pl8jb9f" class="animable"></rect>
            <rect x="178.97" y="266" width="24.21" height="5.02"
              style="fill: #B9D77E; transform-origin: 191.075px 268.51px;" id="elr7amwwtuxic" class="animable"></rect>
            <rect x="147.46" y="245.04" width="25.99" height="25.99" rx="3.89"
              style="fill: #B9D77E; transform-origin: 160.455px 258.035px;" id="eljtctttqemji" class="animable"></rect>
            <g id="el2d36uks8zrf">
              <rect x="154.83" y="252.41" width="11.24" height="11.24" rx="1.01"
                style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 160.45px 258.03px;" class="animable"
                id="el68iomxtpk2f"></rect>
            </g>
            <g id="elakgqay3hwpi">
              <rect x="159.16" y="253.48" width="5.53" height="5.53" rx="0.87"
                style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 161.925px 256.245px;" class="animable"
                id="elx2vbta5vpu"></rect>
            </g>
            <rect x="124.59" y="252.02" width="9.5" height="9.5"
              style="fill: #B9D77E; transform-origin: 129.34px 256.77px;" id="el9te8sihtxz" class="animable"></rect>
            <polygon points="125.58 257.47 128.26 260.5 133.62 253.03 127.89 258.59 125.58 257.47"
              style="fill: rgb(255, 255, 255); transform-origin: 129.6px 256.765px;" id="elqmsrn6trf1e"
              class="animable"></polygon>
            <rect x="178.66" y="284.37" width="98.47" height="5.02"
              style="fill: #B9D77E; transform-origin: 227.895px 286.88px;" id="elpuo1g1je22" class="animable"></rect>
            <rect x="178.66" y="291.36" width="21.61" height="5.02"
              style="fill: #B9D77E; transform-origin: 189.465px 293.87px;" id="elesqbl3hyci" class="animable"></rect>
            <rect x="178.66" y="298.35" width="29.69" height="5.02"
              style="fill: #B9D77E; transform-origin: 193.505px 300.86px;" id="elop8eb0l58jd" class="animable"></rect>
            <rect x="178.97" y="305.33" width="24.21" height="5.02"
              style="fill: #B9D77E; transform-origin: 191.075px 307.84px;" id="el7nz7lbzvgy7" class="animable"></rect>
            <rect x="147.46" y="284.37" width="25.99" height="25.99" rx="3.89"
              style="fill: #B9D77E; transform-origin: 160.455px 297.365px;" id="ela0sx64nwpkp" class="animable"></rect>
            <g id="elow0xp43d38r">
              <rect x="154.83" y="291.74" width="11.24" height="11.24" rx="1.01"
                style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 160.45px 297.36px;" class="animable"
                id="elmxfyup5wy5s"></rect>
            </g>
            <g id="el1muntljnuzuj">
              <rect x="159.16" y="292.82" width="5.53" height="5.53" rx="0.87"
                style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 161.925px 295.585px;" class="animable"
                id="eljj4a4cy3o9"></rect>
            </g>
            <rect x="124.59" y="291.36" width="9.5" height="9.5"
              style="fill: #B9D77E; transform-origin: 129.34px 296.11px;" id="el6v5zecy65ci" class="animable"></rect>
            <polygon points="125.58 296.81 128.26 299.84 133.62 292.37 127.89 297.92 125.58 296.81"
              style="fill: rgb(255, 255, 255); transform-origin: 129.6px 296.105px;" id="elge27ddt18uo"
              class="animable"></polygon>
            <rect x="178.66" y="323.71" width="98.47" height="5.02"
              style="fill: #B9D77E; transform-origin: 227.895px 326.22px;" id="elvmmyb2lvhkg" class="animable"></rect>
            <rect x="178.66" y="330.69" width="21.61" height="5.02"
              style="fill: #B9D77E; transform-origin: 189.465px 333.2px;" id="elb35m889vesi" class="animable"></rect>
            <rect x="178.66" y="337.68" width="29.69" height="5.02"
              style="fill: #B9D77E; transform-origin: 193.505px 340.19px;" id="elhlgubme6rzw" class="animable"></rect>
            <rect x="178.97" y="344.67" width="24.21" height="5.02"
              style="fill: #B9D77E; transform-origin: 191.075px 347.18px;" id="elze13ud22zhk" class="animable"></rect>
            <rect x="147.46" y="323.71" width="25.99" height="25.99" rx="3.89"
              style="fill: #B9D77E; transform-origin: 160.455px 336.705px;" id="elah6s3tt16ts" class="animable"></rect>
            <g id="ellue2x8t7n6p">
              <rect x="154.83" y="331.08" width="11.24" height="11.24" rx="1.01"
                style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 160.45px 336.7px;" class="animable"
                id="el9ygkghz94tw"></rect>
            </g>
            <g id="el1bwn71yea3j">
              <rect x="159.16" y="332.15" width="5.53" height="5.53" rx="0.87"
                style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 161.925px 334.915px;" class="animable"
                id="els4jc99ypui"></rect>
            </g>
            <rect x="124.59" y="330.69" width="9.5" height="9.5"
              style="fill: #B9D77E; transform-origin: 129.34px 335.44px;" id="ell2vvag3rjco" class="animable"></rect>
            <polygon points="125.58 336.14 128.26 339.17 133.62 331.7 127.89 337.26 125.58 336.14"
              style="fill: rgb(255, 255, 255); transform-origin: 129.6px 335.435px;" id="elyyb7dy7vlcp"
              class="animable"></polygon>
          </g>
          <g id="freepik--Tab--inject-5" class="animable" style="transform-origin: 209.44px 163.7px;">
            <g id="ell62hqglgkma">
              <g style="opacity: 0.2; transform-origin: 213.19px 167.925px;" class="animable" id="el361alwpy3fx">
                <rect x="159.77" y="88.3" width="106.84" height="159.25" id="elrogrhub14g" class="animable"
                  style="transform-origin: 213.19px 167.925px;"></rect>
              </g>
            </g>
            <rect x="152.28" y="79.85" width="106.84" height="159.25"
              style="fill: #B9D77E; transform-origin: 205.7px 159.475px;" id="ellu0jp4fa4c" class="animable"></rect>
            <g id="el1bcr34jmbo3i">
              <g style="opacity: 0.5; transform-origin: 205.7px 159.475px;" class="animable" id="el8i3z874vwug">
                <rect x="152.28" y="79.85" width="106.84" height="159.25"
                  style="fill: rgb(255, 255, 255); transform-origin: 205.7px 159.475px;" id="eltz0dvjlpnod"
                  class="animable"></rect>
              </g>
            </g>
            <rect x="152.27" y="79.85" width="106.86" height="10.66"
              style="fill: #B9D77E; transform-origin: 205.7px 85.18px;" id="ely51053cn2jf" class="animable"></rect>
            <path d="M255.68,85.13A3.17,3.17,0,1,1,252.51,82,3.17,3.17,0,0,1,255.68,85.13Z"
              style="fill: rgb(255, 255, 255); transform-origin: 252.51px 85.17px;" id="elmhy6vc08rlh" class="animable">
            </path>
            <path
              d="M240.26,227.69H172.32a11.49,11.49,0,0,1-11.5-11.49h0a11.49,11.49,0,0,1,11.5-11.49h67.94a11.49,11.49,0,0,1,11.5,11.49h0A11.49,11.49,0,0,1,240.26,227.69Z"
              style="fill: #B9D77E; transform-origin: 206.29px 216.2px;" id="el63epdcb6cih" class="animable"></path>
            <path
              d="M170.08,220.21a4.52,4.52,0,0,1-1.82-1.7,4.93,4.93,0,0,1,0-4.93,4.43,4.43,0,0,1,1.82-1.69,5.45,5.45,0,0,1,2.6-.61,5.73,5.73,0,0,1,2.37.47,4.32,4.32,0,0,1,1.72,1.35l-1.94,1.74a2.48,2.48,0,0,0-2-1.07,2,2,0,0,0-1.55.62,2.31,2.31,0,0,0-.59,1.66,2.34,2.34,0,0,0,.59,1.66,2,2,0,0,0,1.55.61,2.49,2.49,0,0,0,2-1.06l1.94,1.73a4.32,4.32,0,0,1-1.72,1.35,6.06,6.06,0,0,1-5-.13Z"
              style="fill: rgb(255, 255, 255); transform-origin: 172.185px 216.048px;" id="eltryxt65daz"
              class="animable"></path>
            <path d="M186.64,211.49v9.11h-3.07v-3.36h-2.84v3.36h-3.08v-9.11h3.08v3.23h2.84v-3.23Z"
              style="fill: rgb(255, 255, 255); transform-origin: 182.145px 216.045px;" id="elb2n7uplvi98"
              class="animable"></path>
            <path d="M195.7,218.29v2.31h-7.58v-9.11h7.41v2.32h-4.39v1.06H195v2.22h-3.86v1.2Z"
              style="fill: rgb(255, 255, 255); transform-origin: 191.91px 216.045px;" id="elm3rthm494uk"
              class="animable"></path>
            <path
              d="M199,220.21a4.56,4.56,0,0,1-1.81-1.7,4.93,4.93,0,0,1,0-4.93,4.47,4.47,0,0,1,1.81-1.69,5.52,5.52,0,0,1,2.61-.61,5.79,5.79,0,0,1,2.37.47,4.39,4.39,0,0,1,1.72,1.35l-1.94,1.74a2.48,2.48,0,0,0-2-1.07,2,2,0,0,0-1.54.62,2.26,2.26,0,0,0-.59,1.66,2.3,2.3,0,0,0,.59,1.66,2,2,0,0,0,1.54.61,2.5,2.5,0,0,0,2-1.06l1.94,1.73a4.39,4.39,0,0,1-1.72,1.35,6.09,6.09,0,0,1-5-.13Z"
              style="fill: rgb(255, 255, 255); transform-origin: 201.115px 216.047px;" id="el28lh12b9eo3"
              class="animable"></path>
            <path d="M210.28,217.58l-.69.77v2.25h-3v-9.11h3v3.31l3-3.31h3.34l-3.64,4,3.83,5.1h-3.56Z"
              style="fill: rgb(255, 255, 255); transform-origin: 211.355px 216.045px;" id="elapf5r6pn6o8"
              class="animable"></path>
            <path
              d="M218.34,220.2a4.74,4.74,0,0,1-1.83-6.61,4.62,4.62,0,0,1,1.83-1.7,6,6,0,0,1,5.29,0,4.72,4.72,0,0,1,1.84,1.7,4.67,4.67,0,0,1-1.84,6.61,6,6,0,0,1-5.29,0ZM222,218a2,2,0,0,0,.74-.79,2.53,2.53,0,0,0,.27-1.2,2.57,2.57,0,0,0-.27-1.21,2,2,0,0,0-.74-.79,2,2,0,0,0-2.8.79,2.46,2.46,0,0,0-.28,1.21,2.42,2.42,0,0,0,.28,1.2,2,2,0,0,0,2.8.79Z"
              style="fill: rgb(255, 255, 255); transform-origin: 221.003px 216.045px;" id="el8d3zmwygezh"
              class="animable"></path>
            <path
              d="M228.34,219.68a4.24,4.24,0,0,1-1.17-3.18v-5h3.07v4.92a2.35,2.35,0,0,0,.36,1.46,1.26,1.26,0,0,0,1,.45,1.24,1.24,0,0,0,1-.45,2.35,2.35,0,0,0,.36-1.46v-4.92h3v5a4.24,4.24,0,0,1-1.17,3.18,5.3,5.3,0,0,1-6.54,0Z"
              style="fill: rgb(255, 255, 255); transform-origin: 231.565px 216.155px;" id="el1flzjeecopt"
              class="animable"></path>
            <path d="M239.31,213.87h-2.67v-2.38h8.41v2.38h-2.67v6.73h-3.07Z"
              style="fill: rgb(255, 255, 255); transform-origin: 240.845px 216.045px;" id="el7bj57rzcy7"
              class="animable"></path>
            <path d="M174.29,122h-4V118.4H183V122h-4v10.18h-4.65Z"
              style="fill: #B9D77E; transform-origin: 176.645px 125.29px;" id="elrskcjucfit" class="animable"></path>
            <path
              d="M185.43,131.66a5.47,5.47,0,0,1-2.24-2,5.54,5.54,0,0,1,0-5.77,5.4,5.4,0,0,1,2.24-2,7.68,7.68,0,0,1,6.45,0,5.48,5.48,0,0,1,2.23,7.75,5.38,5.38,0,0,1-2.23,2,7.58,7.58,0,0,1-6.45,0Zm4.48-3.3a2.36,2.36,0,0,0,.49-1.57,2.27,2.27,0,0,0-.49-1.55,1.73,1.73,0,0,0-2.53,0,2.27,2.27,0,0,0-.49,1.55,2.36,2.36,0,0,0,.49,1.57,1.71,1.71,0,0,0,2.53,0Z"
              style="fill: #B9D77E; transform-origin: 188.644px 126.77px;" id="eln8z1hseduj" class="animable"></path>
            <path
              d="M204.24,131.81a5.56,5.56,0,0,1-2.74.57,5,5,0,0,1-3.48-1.09A4.16,4.16,0,0,1,196.8,128v-2.75h-1.48V122h1.48v-3h4.45v3h2.2v3.25h-2.2V128a1.08,1.08,0,0,0,.25.77.9.9,0,0,0,.67.28,1.74,1.74,0,0,0,1-.3Z"
              style="fill: #B9D77E; transform-origin: 199.78px 125.696px;" id="elguzc25ytdjj" class="animable"></path>
            <path
              d="M214.52,122.49A4.84,4.84,0,0,1,216,126.4v5.79h-4.13v-1.42a3,3,0,0,1-3,1.61,4.82,4.82,0,0,1-2.18-.44,3.27,3.27,0,0,1-1.36-1.2,3.19,3.19,0,0,1-.46-1.7,2.76,2.76,0,0,1,1.22-2.43,6.67,6.67,0,0,1,3.7-.82h1.79c-.14-.84-.82-1.26-2-1.26a5.11,5.11,0,0,0-1.48.22,4.12,4.12,0,0,0-1.28.62l-1.42-2.93a7.94,7.94,0,0,1,2.24-.9,11.1,11.1,0,0,1,2.61-.32A6.5,6.5,0,0,1,214.52,122.49Zm-3.51,7a1.44,1.44,0,0,0,.55-.77v-.75h-1.1c-.9,0-1.36.31-1.36.91a.78.78,0,0,0,.29.62,1.18,1.18,0,0,0,.78.25A1.46,1.46,0,0,0,211,129.45Z"
              style="fill: #B9D77E; transform-origin: 210.442px 126.803px;" id="elun1qd5u053" class="animable"></path>
            <path d="M217.94,117.58h4.45v14.61h-4.45Z" style="fill: #B9D77E; transform-origin: 220.165px 124.885px;"
              id="elq1rye4znn7j" class="animable"></path>
            <rect x="165.27" y="152.64" width="31.3" height="3.44"
              style="fill: #B9D77E; transform-origin: 180.92px 154.36px;" id="elb1rhuwzij9q" class="animable"></rect>
            <rect x="165.27" y="144.18" width="22.73" height="3.44"
              style="fill: rgb(38, 50, 56); transform-origin: 176.635px 145.9px;" id="el79pqic2jz8h" class="animable">
            </rect>
            <rect x="165.27" y="161.82" width="37.19" height="3.44"
              style="fill: #B9D77E; transform-origin: 183.865px 163.54px;" id="el4wvu8chr5z" class="animable"></rect>
            <rect x="227.17" y="161.82" width="17.22" height="3.44"
              style="fill: #B9D77E; transform-origin: 235.78px 163.54px;" id="el87fanxd1qs" class="animable"></rect>
            <rect x="165.27" y="175.7" width="26.4" height="3.44"
              style="fill: #B9D77E; transform-origin: 178.47px 177.42px;" id="el98d03adyt4" class="animable"></rect>
          </g>
          <g id="freepik--Character--inject-5" class="animable" style="transform-origin: 178.307px 303.228px;">
            <path
              d="M97.91,193.08c-3.2,0-6.27,2.89-8.15,8.26s-.53,13.17-.27,16.85-1.62,9-1.62,9c4.35-3.55,7.31-8,7.81-14.13a15.4,15.4,0,0,1-.44,7.37,22.51,22.51,0,0,0,5.93-8.25c2.4-5.5,2.13-13.31,2.13-13.31S101.12,193.08,97.91,193.08Z"
              style="fill: rgb(38, 50, 56); transform-origin: 95.5896px 210.135px;" id="elnfvhoseu1kb" class="animable">
            </path>
            <path d="M95.6,199.62c-.13,2.81,1,8,7.9,3.35s-1.2-7.45-4.51-6.79A3.83,3.83,0,0,0,95.6,199.62Z"
              style="fill: #B9D77E; transform-origin: 100.897px 200.458px;" id="el6riqxgaqt29" class="animable"></path>
            <path
              d="M98.92,199.91c-.88,5.75,1.87,11,3.54,17.88s.26,8.4.26,8.4,14.64-2.3,22.26-15.82-6.13-22.42-14.6-19.78C106.21,188.5,99.79,194.31,98.92,199.91Z"
              style="fill: rgb(38, 50, 56); transform-origin: 112.976px 208.158px;" id="el20cmod014fv" class="animable">
            </path>
            <path
              d="M134.49,232.9c.08.77.2,1.71.31,2.58s.26,1.78.4,2.66c.3,1.78.63,3.55,1,5.31s.82,3.49,1.29,5.21,1,3.41,1.66,5.05l.23.61.12.31.09.22a3.26,3.26,0,0,0,.2.43,3.38,3.38,0,0,0,.24.46,18.58,18.58,0,0,0,1.31,2,46.19,46.19,0,0,0,3.47,3.94c2.51,2.58,5.27,5.11,8,7.54l-2.17,3.25a65.6,65.6,0,0,1-9.86-6.3,41.6,41.6,0,0,1-4.53-4.06,21.84,21.84,0,0,1-2.11-2.55,8.85,8.85,0,0,1-.49-.75,7.79,7.79,0,0,1-.46-.81l-.22-.42-.16-.34-.32-.69a63.62,63.62,0,0,1-3.94-11.27c-.48-1.92-.9-3.85-1.22-5.79-.16-1-.31-1.95-.44-2.94s-.22-1.93-.3-3Z"
              style="fill: rgb(255, 181, 115); transform-origin: 139.7px 252.685px;" id="elsse0b4pja4" class="animable">
            </path>
            <path d="M131.76,225.53c2.66.67,4.52,11.62,4.52,11.62l-7.33,5s-7-11-5-14S127.88,224.54,131.76,225.53Z"
              style="fill: #B9D77E; transform-origin: 129.935px 233.621px;" id="elk39koejwa9" class="animable"></path>
            <g id="eltr9v84n901k">
              <g style="opacity: 0.5; transform-origin: 129.935px 233.621px;" class="animable" id="elvtzwhro25n">
                <path d="M131.76,225.53c2.66.67,4.52,11.62,4.52,11.62l-7.33,5s-7-11-5-14S127.88,224.54,131.76,225.53Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 129.935px 233.621px;" id="elgnqfhcyh3hq"
                  class="animable"></path>
              </g>
            </g>
            <g id="el0u1885vc0c2b">
              <path d="M131.52,228l2,11-1,.71v.69A70.89,70.89,0,0,1,131,252.77l-1.67-4.45-1.48-5.79,1.64-.74Z"
                style="opacity: 0.2; transform-origin: 130.685px 240.385px;" class="animable" id="elgavdze2l91u"></path>
            </g>
            <path d="M154.07,269.34l5,1.94-5.62,3.39s-3.59-2.08-3.5-4.76l.55-.31A4.19,4.19,0,0,1,154.07,269.34Z"
              style="fill: rgb(255, 181, 115); transform-origin: 154.509px 271.864px;" id="eli2yqiut8z4f"
              class="animable"></path>
            <polygon points="162.14 274.95 157.91 278.47 153.43 274.67 159.05 271.28 162.14 274.95"
              style="fill: rgb(255, 181, 115); transform-origin: 157.785px 274.875px;" id="elrzamg06rxcl"
              class="animable"></polygon>
            <path
              d="M131.76,225.53s3.07,1.08-3.09,38.94h-26.2c.44-10.67.53-17.25-4.56-39.14a77,77,0,0,1,11-1.46,84.3,84.3,0,0,1,11.9,0C126,224.34,131.76,225.53,131.76,225.53Z"
              style="fill: #B9D77E; transform-origin: 115.218px 244.065px;" id="elq4as9g5hc3n" class="animable"></path>
            <g id="elkgp2u4n3gz">
              <g style="opacity: 0.4; transform-origin: 115.218px 244.065px;" class="animable" id="elhrsllclvgzg">
                <path
                  d="M131.76,225.53s3.07,1.08-3.09,38.94h-26.2c.44-10.67.53-17.25-4.56-39.14a77,77,0,0,1,11-1.46,84.3,84.3,0,0,1,11.9,0C126,224.34,131.76,225.53,131.76,225.53Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 115.218px 244.065px;" id="el2z4s8w08fcf"
                  class="animable"></path>
              </g>
            </g>
            <g id="eli23tvrzd24e">
              <path d="M100.8,238.78l2.44.71.84-1.78s13.6,4.7,19.52,2.44c3.82-1.46,5.17-2.93,5.17-2.93l-28.72-2.11Z"
                style="opacity: 0.2; transform-origin: 114.41px 237.937px;" class="animable" id="elk4zf8cedfsj"></path>
            </g>
            <polygon points="111.03 409.71 117.49 409.71 120.13 394.77 113.68 394.77 111.03 409.71"
              style="fill: rgb(255, 181, 115); transform-origin: 115.58px 402.24px;" id="el6qldjvgvchj"
              class="animable"></polygon>
            <path
              d="M118,409h-7.25a.51.51,0,0,0-.52.44l-.82,5.73a1,1,0,0,0,1,1.15c2.53,0,3.75-.19,6.93-.19,2,0,7.6.2,10.31.2s2.85-2.67,1.72-2.92c-5.06-1.08-8.62-2.58-10.33-4A1.7,1.7,0,0,0,118,409Z"
              style="fill: rgb(38, 50, 56); transform-origin: 119.718px 412.665px;" id="eldl85vmht2mb" class="animable">
            </path>
            <g id="elwyyc4slihn">
              <g style="opacity: 0.2; transform-origin: 116.22px 398.63px;" class="animable" id="elc52g7e0pgy">
                <polygon points="120.13 394.78 118.77 402.48 112.31 402.48 113.67 394.78 120.13 394.78"
                  id="elcf6vmwpybha" class="animable" style="transform-origin: 116.22px 398.63px;"></polygon>
              </g>
            </g>
            <path
              d="M109,223.88a81.26,81.26,0,0,1,11.89,0l.78.07c1,1.8,1.19,4.57-1.09,8.63,0,0-10.43-4.2-13.15-8.6C107.91,223.94,108.43,223.9,109,223.88Z"
              style="fill: rgb(255, 181, 115); transform-origin: 114.904px 228.121px;" id="elb1r3sy7o9du"
              class="animable"></path>
            <path
              d="M128.67,264.47s5.09,49.7,4.67,69.38C132.9,354.31,120.17,401,120.17,401h-8.72s6.61-45.48,5.84-65.58c-.84-21.91-7.8-70.94-7.8-70.94Z"
              style="fill: rgb(38, 50, 56); transform-origin: 121.427px 332.735px;" id="elddfwztya5lf" class="animable">
            </path>
            <g id="elft8sygwl6fe">
              <path
                d="M128.67,264.47s5.09,49.7,4.67,69.38C132.9,354.31,120.17,401,120.17,401h-8.72s6.61-45.48,5.84-65.58c-.84-21.91-7.8-70.94-7.8-70.94Z"
                style="fill: rgb(38, 50, 56); opacity: 0.3; transform-origin: 121.427px 332.735px;" class="animable"
                id="elkyebl1e7wf"></path>
            </g>
            <polygon points="110.69 401.3 120.93 401.3 121.68 398.04 110.22 397.64 110.69 401.3"
              style="fill: rgb(38, 50, 56); transform-origin: 115.95px 399.47px;" id="elpnx8n87bto" class="animable">
            </polygon>
            <g id="el8ha0tvpetq">
              <path
                d="M117.37,276.83c6.44,12.95,1.29,36.57-1,45.36-1.17-13.2-3.14-29.33-4.67-41.18C112.69,274.31,114.4,270.87,117.37,276.83Z"
                style="opacity: 0.2; transform-origin: 116.097px 297.976px;" class="animable" id="el831xu4zefvb"></path>
            </g>
            <polygon points="54.81 352.01 56.99 358.08 71.85 355.28 69.68 349.2 54.81 352.01"
              style="fill: rgb(255, 181, 115); transform-origin: 63.33px 353.64px;" id="elwacgx6ivdzs" class="animable">
            </polygon>
            <path
              d="M58.74,358.28l-.51-7.23a.57.57,0,0,0-.48-.54l-5.83-1.17a.9.9,0,0,0-1.08,1c.22,2.53.46,3.75.68,6.93.14,2,.32,7.56.51,10.27s2.9,3,3.06,1.89c.75-5,2-8.45,3.33-10.06A1.51,1.51,0,0,0,58.74,358.28Z"
              style="fill: rgb(38, 50, 56); transform-origin: 54.7898px 359.679px;" id="eljidzke4ugs" class="animable">
            </path>
            <g id="elqjeeatheg7">
              <g style="opacity: 0.2; transform-origin: 66.93px 352.96px;" class="animable" id="ell63rmwcpgc">
                <polygon points="71.85 355.27 64.19 356.72 62.01 350.65 69.67 349.2 71.85 355.27" id="el3bx1pp69thg"
                  class="animable" style="transform-origin: 66.93px 352.96px;"></polygon>
              </g>
            </g>
            <path
              d="M121.43,264.47s-7.16,51.29-12,70.59c-5,20.07-42.68,21.78-42.68,21.78L62.91,349s22-5.84,31.45-19.05c4.11-21.62,7.88-65.48,7.88-65.48Z"
              style="fill: rgb(38, 50, 56); transform-origin: 92.17px 310.655px;" id="el5cphzwpy97s" class="animable">
            </path>
            <g id="elvgtzohyymn9">
              <path
                d="M121.43,264.47s-7.16,51.29-12,70.59c-5,20.07-42.68,21.78-42.68,21.78L62.91,349s22-5.84,31.45-19.05c4.11-21.62,7.88-65.48,7.88-65.48Z"
                style="fill: rgb(38, 50, 56); opacity: 0.3; transform-origin: 92.17px 310.655px;" class="animable"
                id="elqk3b5tlecs8"></path>
            </g>
            <polygon points="62.47 348.27 65.83 357.94 69.3 357.98 65.93 347.07 62.47 348.27"
              style="fill: rgb(38, 50, 56); transform-origin: 65.885px 352.525px;" id="elv1r9ab5qa1n" class="animable">
            </polygon>
            <path
              d="M57.77,360.63a2.7,2.7,0,0,0,.51,1.58,1,1,0,0,0,.77.32.44.44,0,0,0,.39-.23c.38-.77-1.12-3.41-1.29-3.71a.18.18,0,0,0-.16-.09.14.14,0,0,0-.13.11A11.58,11.58,0,0,0,57.77,360.63Zm1.43,1.22a.46.46,0,0,1,0,.28.16.16,0,0,1-.16.09.62.62,0,0,1-.5-.2,4.26,4.26,0,0,1-.38-2.89A9.22,9.22,0,0,1,59.2,361.85Z"
              style="fill: #B9D77E; transform-origin: 58.6304px 360.515px;" id="elxo2aoxts36" class="animable"></path>
            <path
              d="M57.86,358.64a.64.64,0,0,0,0,.07c.41.78,1.91,2.39,2.64,2.31.17,0,.38-.13.39-.55a1.2,1.2,0,0,0-.32-.86A4.94,4.94,0,0,0,58,358.5a.15.15,0,0,0-.16.14Zm2.74,1.69a.28.28,0,0,1,0,.09c0,.28-.12.29-.16.3-.44,0-1.61-1.05-2.14-1.86a4.14,4.14,0,0,1,2.06.93A.92.92,0,0,1,60.6,360.33Z"
              style="fill: #B9D77E; transform-origin: 59.3654px 359.761px;" id="elp6peghfftm" class="animable"></path>
            <path
              d="M120.41,410.1a2.4,2.4,0,0,0,1.56-.4.85.85,0,0,0,.28-.75.49.49,0,0,0-.26-.4c-.79-.44-3.36.88-3.65,1a.15.15,0,0,0-.08.16.14.14,0,0,0,.12.12A10.87,10.87,0,0,0,120.41,410.1Zm1.15-1.34a.55.55,0,0,1,.28.06.15.15,0,0,1,.1.16.53.53,0,0,1-.17.49c-.39.35-1.45.41-2.88.18A8.16,8.16,0,0,1,121.56,408.76Z"
              style="fill: #B9D77E; transform-origin: 120.258px 409.285px;" id="elzvpbnarghx" class="animable"></path>
            <path
              d="M118.41,409.87l.06,0c.77-.34,2.29-1.73,2.17-2.47,0-.17-.15-.38-.57-.43a1.11,1.11,0,0,0-.85.27,4.24,4.24,0,0,0-1,2.48.13.13,0,0,0,.06.14A.16.16,0,0,0,118.41,409.87Zm1.53-2.62h.1c.28,0,.29.14.3.17.07.44-1,1.54-1.75,2a3.54,3.54,0,0,1,.83-2A.81.81,0,0,1,119.94,407.25Z"
              style="fill: #B9D77E; transform-origin: 119.432px 408.422px;" id="elh6yezkn7tc" class="animable"></path>
            <path
              d="M110.13,210.48c.75,3.82,1.5,10.84-1.18,13.39,0,0,1,3.89,8.16,3.89,7.83,0,3.74-3.89,3.74-3.89-4.27-1-4.16-4.18-3.41-7.16Z"
              style="fill: rgb(255, 181, 115); transform-origin: 115.434px 219.12px;" id="elmxxsj05uts"
              class="animable"></path>
            <g id="eluv60mjl01s">
              <path
                d="M113.11,213l4.32,3.69a12.1,12.1,0,0,0-.36,2.11c-1.63-.23-3.88-2-4-3.73A5.87,5.87,0,0,1,113.11,213Z"
                style="opacity: 0.2; transform-origin: 115.213px 215.9px;" class="animable" id="elmw5hsl13wed"></path>
            </g>
            <path
              d="M106,203.84c1.46,6.24,2,8.91,5.68,11.6,5.61,4.05,12.95.89,13.39-5.65.39-5.89-2.07-15.1-8.66-16.56A8.74,8.74,0,0,0,106,203.84Z"
              style="fill: rgb(255, 181, 115); transform-origin: 115.429px 205.129px;" id="elxbh3f7r287"
              class="animable"></path>
            <path d="M108.58,198.22c2.26,1.73,1.27,8-1.53,9.93C102.67,207.1,101.84,193.05,108.58,198.22Z"
              style="fill: rgb(38, 50, 56); transform-origin: 106.734px 202.616px;" id="elm67dhp81swc" class="animable">
            </path>
            <path
              d="M116.47,192c2.53.44,5.74,4.2,6.42,5.73-3.8-.7-14.27,2.54-14.27,2.54s-4.68-.52-2.05-4.13S116.47,192,116.47,192Z"
              style="fill: rgb(38, 50, 56); transform-origin: 114.329px 196.135px;" id="elusz2r30xqh" class="animable">
            </path>
            <path d="M117,203.8c.09.52.43.89.77.83s.54-.52.45-1-.43-.89-.77-.83S116.88,203.29,117,203.8Z"
              style="fill: rgb(38, 50, 56); transform-origin: 117.605px 203.715px;" id="ele4dzr4dckno" class="animable">
            </path>
            <path d="M122.76,202.82c.09.51.43.88.77.82s.53-.52.45-1-.43-.88-.77-.83S122.67,202.3,122.76,202.82Z"
              style="fill: rgb(38, 50, 56); transform-origin: 123.368px 202.726px;" id="elxdr0waqnf28" class="animable">
            </path>
            <path d="M123.07,201.84l1.17-.57S123.77,202.34,123.07,201.84Z"
              style="fill: rgb(38, 50, 56); transform-origin: 123.655px 201.622px;" id="elobq1we6tzur" class="animable">
            </path>
            <path d="M120.5,204.05a13.9,13.9,0,0,0,2.39,3,2.22,2.22,0,0,1-1.77.65Z"
              style="fill: rgb(237, 137, 62); transform-origin: 121.695px 205.879px;" id="ele2dasxz43cm"
              class="animable"></path>
            <path
              d="M118.66,210.15a7.1,7.1,0,0,0,.77-.07.16.16,0,0,0,.12-.18.16.16,0,0,0-.17-.13,4.13,4.13,0,0,1-3.59-1,.14.14,0,0,0-.21,0,.16.16,0,0,0,0,.22A4.29,4.29,0,0,0,118.66,210.15Z"
              style="fill: rgb(38, 50, 56); transform-origin: 117.544px 209.437px;" id="elkez608phum" class="animable">
            </path>
            <path
              d="M105.28,209.91a4.69,4.69,0,0,0,2.84,2.17c1.59.4,2.35-1,1.88-2.51-.42-1.33-1.76-3.15-3.34-2.9A2.1,2.1,0,0,0,105.28,209.91Z"
              style="fill: rgb(255, 181, 115); transform-origin: 107.53px 209.398px;" id="elb4ibdp62j05"
              class="animable"></path>
            <path
              d="M113.81,203a.3.3,0,0,0,.28-.22,3.63,3.63,0,0,1,2.17-1.93.31.31,0,0,0,.19-.39.3.3,0,0,0-.38-.19,4.17,4.17,0,0,0-2.56,2.33.31.31,0,0,0,.2.39Z"
              style="fill: rgb(38, 50, 56); transform-origin: 114.98px 201.627px;" id="eltil0f5pscc" class="animable">
            </path>
            <path
              d="M123.42,199.84a.31.31,0,0,0,.15-.57,3.06,3.06,0,0,0-2.78-.19.31.31,0,0,0-.14.42.32.32,0,0,0,.41.13h0a2.42,2.42,0,0,1,2.2.17A.32.32,0,0,0,123.42,199.84Z"
              style="fill: rgb(38, 50, 56); transform-origin: 122.164px 199.337px;" id="el2271ytern0z" class="animable">
            </path>
            <path d="M117.27,202.83l1.17-.57S118,203.33,117.27,202.83Z"
              style="fill: rgb(38, 50, 56); transform-origin: 117.855px 202.612px;" id="el6j023hmzh2h" class="animable">
            </path>
            <path
              d="M102.08,262.93l-.67,2.35c-.09.18.12.36.42.36h27c.24,0,.44-.11.45-.26l.24-2.35c0-.16-.19-.3-.45-.3H102.5A.47.47,0,0,0,102.08,262.93Z"
              style="fill: rgb(250, 250, 250); transform-origin: 115.454px 264.184px;" id="eljuxlpnfw00s"
              class="animable"></path>
            <path
              d="M105.64,265.9h-.71c-.14,0-.25-.08-.24-.16l.33-3.05c0-.09.14-.16.28-.16H106c.14,0,.25.07.24.16l-.33,3.05C105.91,265.82,105.78,265.9,105.64,265.9Z"
              style="fill: #B9D77E; transform-origin: 105.465px 264.215px;" id="el9zaestbai9n" class="animable"></path>
            <g id="eleluj6jdmont">
              <g style="opacity: 0.3; transform-origin: 105.465px 264.215px;" class="animable" id="el9aflit9o50c">
                <path
                  d="M105.64,265.9h-.71c-.14,0-.25-.08-.24-.16l.33-3.05c0-.09.14-.16.28-.16H106c.14,0,.25.07.24.16l-.33,3.05C105.91,265.82,105.78,265.9,105.64,265.9Z"
                  id="elyxwohm6yt5c" class="animable" style="transform-origin: 105.465px 264.215px;"></path>
              </g>
            </g>
            <path
              d="M126.81,265.9h-.71c-.15,0-.25-.08-.24-.16l.33-3.05c0-.09.13-.16.28-.16h.71c.14,0,.24.07.24.16l-.34,3.05C127.07,265.82,127,265.9,126.81,265.9Z"
              style="fill: #B9D77E; transform-origin: 126.64px 264.215px;" id="elryr42i5ft1m" class="animable"></path>
            <g id="elt5fndl9gqp">
              <path
                d="M126.81,265.9h-.71c-.15,0-.25-.08-.24-.16l.33-3.05c0-.09.13-.16.28-.16h.71c.14,0,.24.07.24.16l-.34,3.05C127.07,265.82,127,265.9,126.81,265.9Z"
                style="opacity: 0.3; transform-origin: 126.64px 264.215px;" class="animable" id="elecpa6m5oncp"></path>
            </g>
            <path
              d="M116.22,265.9h-.71c-.14,0-.25-.08-.24-.16l.34-3.05c0-.09.13-.16.27-.16h.71c.14,0,.25.07.24.16l-.33,3.05C116.49,265.82,116.37,265.9,116.22,265.9Z"
              style="fill: #B9D77E; transform-origin: 116.05px 264.215px;" id="elo6iqlahg9f" class="animable"></path>
            <g id="eloel0t3kcuza">
              <path
                d="M116.22,265.9h-.71c-.14,0-.25-.08-.24-.16l.34-3.05c0-.09.13-.16.27-.16h.71c.14,0,.25.07.24.16l-.33,3.05C116.49,265.82,116.37,265.9,116.22,265.9Z"
                style="opacity: 0.3; transform-origin: 116.05px 264.215px;" class="animable" id="elf2rf8ctdw8l"></path>
            </g>
            <g id="elbzii0rg7wq8">
              <rect x="144.21" y="212.22" width="10.64" height="6.52" rx="1.82"
                style="fill: #B9D77E; transform-origin: 149.53px 215.48px; transform: rotate(-44.61deg);"
                class="animable" id="el39wtrxdzqgj"></rect>
            </g>
            <g id="eldi2179ltpol">
              <path
                d="M147.61,216.43l-1.67,1.65a.14.14,0,0,1-.21,0h0a.16.16,0,0,1,0-.22l1.67-1.64a.14.14,0,0,1,.21,0h0A.14.14,0,0,1,147.61,216.43Z"
                style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.4; transform-origin: 146.672px 217.15px;"
                class="animable" id="elzbt85dbah8e"></path>
            </g>
            <g id="elikr29saejpc">
              <path
                d="M151.21,210.64l-1.67,1.64a.15.15,0,0,1-.21,0h0a.14.14,0,0,1,0-.21l1.67-1.65a.14.14,0,0,1,.21,0h0A.16.16,0,0,1,151.21,210.64Z"
                style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.4; transform-origin: 150.268px 211.348px;"
                class="animable" id="el62d0xw2ig4x"></path>
            </g>
            <g id="elsfhqay6xudf">
              <path
                d="M149.85,218.71l-1.67,1.64a.15.15,0,0,1-.21,0h0a.16.16,0,0,1,0-.22l1.67-1.64a.15.15,0,0,1,.21,0h0A.16.16,0,0,1,149.85,218.71Z"
                style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.4; transform-origin: 148.91px 219.42px;"
                class="animable" id="elf5wlifwz0wt"></path>
            </g>
            <g id="el7sh7h6rb37n">
              <path
                d="M146.91,218.18l-.44.43a.16.16,0,0,1-.22,0h0a.15.15,0,0,1,0-.21l.43-.44a.17.17,0,0,1,.22,0h0A.16.16,0,0,1,146.91,218.18Z"
                style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.4; transform-origin: 146.578px 218.287px;"
                class="animable" id="el2uj7cbj3pfh"></path>
            </g>
            <g id="eludnwgvi7w4f">
              <path
                d="M154.2,214.81l-.52.52a.93.93,0,0,1-1.3,0h0a.92.92,0,0,1,0-1.3l.52-.52a.93.93,0,0,1,1.3,0h0A.92.92,0,0,1,154.2,214.81Z"
                style="isolation: isolate; opacity: 0.2; transform-origin: 153.29px 214.42px;" class="animable"
                id="elueloqq5uaz"></path>
            </g>
            <path
              d="M100.75,227c1.55.61,3.26,1.27,4.92,1.84s3.35,1.17,5,1.69a67.41,67.41,0,0,0,10,2.44l.62.09.16,0c.07,0,0,0,0,0s0,0,0,0a2.27,2.27,0,0,0,.57-.07,11.16,11.16,0,0,0,2-.71,43.89,43.89,0,0,0,4.49-2.4c3-1.81,6.08-3.84,9.06-5.85l2.6,2.9A71,71,0,0,1,132,234.8a39.66,39.66,0,0,1-4.87,3.41,17.1,17.1,0,0,1-3.06,1.45,9.37,9.37,0,0,1-2.13.47c-.23,0-.44,0-.69,0h-.52l-.75,0c-1-.05-2-.18-3-.29s-2-.28-2.9-.48c-1.92-.34-3.79-.81-5.64-1.31s-3.67-1.08-5.47-1.7-3.54-1.28-5.38-2.09Z"
              style="fill: rgb(255, 181, 115); transform-origin: 118.88px 232.08px;" id="elpnmjrdlvjf" class="animable">
            </path>
            <path d="M137.42,224.36l3.94-5.76,1.75,6.32s-3,2.9-5.52,2.09Z"
              style="fill: rgb(255, 181, 115); transform-origin: 140.265px 222.876px;" id="elssvqd6iunna"
              class="animable"></path>
            <polygon points="146.53 216.96 147.71 222.33 143.11 224.92 141.36 218.6 146.53 216.96"
              style="fill: rgb(255, 181, 115); transform-origin: 144.535px 220.94px;" id="eljri3m6j057b"
              class="animable"></polygon>
            <path d="M92.39,235.34c1.91,2,10.2,3.2,10.2,3.2l5.24-11.37s-7.63-3.24-10.76-1.52S90.22,233.09,92.39,235.34Z"
              style="fill: #B9D77E; transform-origin: 99.786px 231.843px;" id="el8hwyv28in2" class="animable"></path>
            <g id="eltkzseqgiopg">
              <g style="opacity: 0.5; transform-origin: 99.786px 231.843px;" class="animable" id="el1xt9lk8jjus">
                <path
                  d="M92.39,235.34c1.91,2,10.2,3.2,10.2,3.2l5.24-11.37s-7.63-3.24-10.76-1.52S90.22,233.09,92.39,235.34Z"
                  style="fill: rgb(255, 255, 255); transform-origin: 99.786px 231.843px;" id="eltzcrrpfcrc"
                  class="animable"></path>
              </g>
            </g>
            <path
              d="M199.14,292.7l-2.93.27c-4,12.9-9.46,13-11.09,12.72-3-.53-4.74-3.8-3.87-7.28,1.2-4.8,6.64-6.76,10.05-7.6-2.11-3.19-2.9-8.5-1.63-12h0a5.77,5.77,0,0,1,5.83-4.18,4.28,4.28,0,0,1,3.91,2c2.37,3.88-1.38,12.24-2.59,14.74Zm-4.69-2.89c1.75-3.78,3.52-9.47,2.25-11.54-.2-.33-.41-.67-1.44-.7a2.51,2.51,0,0,0-2.67,2h0C191.47,282.68,192.62,287.77,194.45,289.81Zm-10,8.64c-.05.15-.09.3-.13.45-.5,2,.45,3.69,1.63,3.9s4.37-1.53,7-9.46C190.54,293.78,185.63,295.07,184.4,298.45Z"
              style="fill: rgb(38, 50, 56); transform-origin: 190.603px 290.187px;" id="elukqkcpx4vc" class="animable">
            </path>
            <polygon points="303.87 299.8 283.89 355.08 185 319.35 204.91 264.25 303.87 299.8"
              style="fill: #B9D77E; transform-origin: 244.435px 309.665px;" id="el62h0s1aqcrq" class="animable">
            </polygon>
            <g id="elx2v9jnt355h">
              <polygon points="303.87 299.8 283.89 355.08 185 319.35 204.91 264.25 303.87 299.8"
                style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 244.435px 309.665px;" class="animable"
                id="elv91v4nn94cp"></polygon>
            </g>
            <polygon points="199.87 278.19 198.24 282.69 297.2 318.24 298.82 313.75 199.87 278.19"
              style="fill: rgb(38, 50, 56); transform-origin: 248.53px 298.215px;" id="elrglzhdxkzz" class="animable">
            </polygon>
            <polygon points="287.89 344.02 286.69 347.32 187.74 311.76 188.93 308.47 287.89 344.02"
              style="fill: rgb(38, 50, 56); transform-origin: 237.815px 327.895px;" id="elota2912l7" class="animable">
            </polygon>
            <g id="elv1tv3mhg52">
              <polygon points="291.83 333.12 283.89 355.08 185 319.35 192.87 297.56 291.83 333.12"
                style="isolation: isolate; opacity: 0.2; transform-origin: 238.415px 326.32px;" class="animable"
                id="elzuyyks39yl8"></polygon>
            </g>
            <path
              d="M224.7,307l-1-2.25c-11.37.53-13-3.77-13.26-5.14-.44-2.54,1.65-4.85,4.67-5.16,4.14-.42,7.26,3.33,8.9,5.8a12.68,12.68,0,0,1,9-4.74h0a4.86,4.86,0,0,1,5,3.42,3.61,3.61,0,0,1-.5,3.69c-2.39,3-10.1,2.41-12.42,2.17Zm1-4.55c3.49.31,8.52.08,9.79-1.52.21-.26.42-.52.14-1.34a2.1,2.1,0,0,0-2.35-1.54h0A10.29,10.29,0,0,0,225.66,302.49ZM215.92,297l-.39,0c-1.71.18-2.8,1.42-2.62,2.41s2.46,3,9.5,2.86C221.39,300.53,219,297,215.92,297Z"
              style="fill: rgb(38, 50, 56); transform-origin: 224.343px 300.709px;" id="elgwrigpcugka" class="animable">
            </path>
            <polygon points="249.08 337.5 199.52 337.5 199.52 303.46 248.92 303.46 249.08 337.5"
              style="fill: #B9D77E; transform-origin: 224.3px 320.48px;" id="el7pdjrh1dc0k" class="animable"></polygon>
            <g id="elaxpb37sox15">
              <polygon points="249.08 337.5 199.52 337.5 199.52 303.46 248.92 303.46 249.08 337.5"
                style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 224.3px 320.48px;" class="animable"
                id="el35vw409z8q7"></polygon>
            </g>
            <polygon points="236.42 303.46 232.39 303.46 232.55 337.5 236.58 337.5 236.42 303.46"
              style="fill: rgb(38, 50, 56); transform-origin: 234.485px 320.48px;" id="el0s4nez78cs4r" class="animable">
            </polygon>
            <polygon points="209.44 337.5 206.48 337.5 206.32 303.46 209.28 303.46 209.44 337.5"
              style="fill: rgb(38, 50, 56); transform-origin: 207.88px 320.48px;" id="el8kgusd24nyh" class="animable">
            </polygon>
            <g id="eld28fu1atd8">
              <polygon points="219.22 337.5 199.52 337.5 199.52 303.46 219.06 303.46 219.22 337.5"
                style="isolation: isolate; opacity: 0.2; transform-origin: 209.37px 320.48px;" class="animable"
                id="eljpat307231"></polygon>
            </g>
            <path
              d="M236.81,343.22c-3.12.76-13.56,3-18.17-.62a5.68,5.68,0,0,1-2.27-4.9c.09-3.25,2.11-5.13,5.44-5.58h0c4.35-.59,10.8,1.58,14.59,4.73,1.21-3.65,3.92-9.3,9.85-9.5,4.31-.15,8.2,2.59,8.69,6.11.26,1.9-.19,8-16.19,9.44l-.49,3.24Zm-14.22-7.66h0c-1.73.23-2.56.91-2.6,2.56a1.82,1.82,0,0,0,.77,1.8c2.46,1.92,9.51,1.27,14.23.2C232.6,337.57,226.44,335,222.59,335.56Zm16.82,3.72c9.84-1.08,12.17-4.09,12-5.64-.19-1.38-2.23-2.86-4.68-2.77a4.91,4.91,0,0,0-.55,0C241.93,331.48,240.07,336.71,239.41,339.28Z"
              style="fill: rgb(38, 50, 56); transform-origin: 235.671px 336.742px;" id="elgojk1ra90ul" class="animable">
            </path>
            <g id="elsfr6fdhffvh">
              <rect x="206.71" y="339.22" width="63" height="23.03"
                style="fill: #B9D77E; transform-origin: 238.21px 350.735px; transform: rotate(-7.68deg);"
                class="animable" id="elat0o099uy94"></rect>
            </g>
            <g id="el8fkhn3cyvol">
              <rect x="206.71" y="339.22" width="63" height="23.03"
                style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 238.21px 350.735px; transform: rotate(-7.68deg);"
                class="animable" id="el5dxl22azmkc"></rect>
            </g>
            <g id="ely9acxlvqyna">
              <rect x="244.51" y="336.69" width="25.03" height="23.03"
                style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 257.025px 348.205px; transform: rotate(-7.68deg);"
                class="animable" id="ela6tl0rbwzf5"></rect>
            </g>
            <g id="el0e1ywhncogcg">
              <rect x="222.72" y="340.97" width="5.12" height="23.03"
                style="fill: rgb(38, 50, 56); transform-origin: 225.28px 352.485px; transform: rotate(-7.68deg);"
                class="animable" id="elld8wtqo01wq"></rect>
            </g>
            <g id="elrtbnpd47fl">
              <rect x="256.92" y="336.45" width="3.76" height="23.03"
                style="fill: rgb(38, 50, 56); transform-origin: 258.8px 347.965px; transform: rotate(-7.68deg);"
                class="animable" id="elcbllxgiunsb"></rect>
            </g>
            <path
              d="M183.93,300.24l-1.43,1.24c-4.35-10.65-9.86-19-18.38-21.39l1.43-1.23C173.67,281,179.34,289.27,183.93,300.24Z"
              style="fill: rgb(38, 50, 56); transform-origin: 174.025px 290.17px;" id="elw3mq8vs83sk" class="animable">
            </path>
            <g id="ele3qn8dkr4hi">
              <path
                d="M183.93,300.24l-1.43,1.24c-4.35-10.65-9.86-19-18.38-21.39l1.43-1.23C173.67,281,179.34,289.27,183.93,300.24Z"
                style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 174.025px 290.17px;" class="animable"
                id="ela7axszttm3"></path>
            </g>
            <path
              d="M178.36,300.34l-2,1.42c-4.12-8.32-3.62-12.59-13.88-19l1.95-1.42C174.69,288.23,174.69,292.49,178.36,300.34Z"
              style="fill: rgb(38, 50, 56); transform-origin: 170.42px 291.55px;" id="el12u7a08i84k" class="animable">
            </path>
            <g id="elckydxyhqwy7">
              <path
                d="M178.36,300.34l-2,1.42c-4.12-8.32-3.62-12.59-13.88-19l1.95-1.42C174.69,288.23,174.69,292.49,178.36,300.34Z"
                style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 170.42px 291.55px;" class="animable"
                id="elbokp84oa2w"></path>
            </g>
            <path
              d="M303.33,300.3H176.48a2.45,2.45,0,0,0-2.23,3.47l29.43,64.62a2.48,2.48,0,0,0,2.6,1.41L299,356a2.46,2.46,0,0,0,2.08-2.2L305.77,303A2.45,2.45,0,0,0,303.33,300.3Zm-.34,4L298.53,353a2.35,2.35,0,0,1-2,2.11L207.7,368.33a2.36,2.36,0,0,1-2.49-1.35L177,305.09a2.35,2.35,0,0,1,2.13-3.33h121.5A2.35,2.35,0,0,1,303,304.33Z"
              style="fill: rgb(38, 50, 56); transform-origin: 239.905px 335.062px;" id="elm2kfe5xbznj" class="animable">
            </path>
            <polygon points="213.58 368.36 211.73 368.36 181.59 300.3 183.43 300.3 213.58 368.36"
              style="fill: rgb(38, 50, 56); transform-origin: 197.585px 334.33px;" id="elauk2snq05b9" class="animable">
            </polygon>
            <polygon points="221.88 367.05 220.04 367.05 191.21 300.3 193.06 300.3 221.88 367.05"
              style="fill: rgb(38, 50, 56); transform-origin: 206.545px 333.675px;" id="elgypk0vli1ir" class="animable">
            </polygon>
            <polygon points="229.57 365.74 227.73 365.74 202.83 300.3 204.68 300.3 229.57 365.74"
              style="fill: rgb(38, 50, 56); transform-origin: 216.2px 333.02px;" id="el8kef7e2vjb7" class="animable">
            </polygon>
            <polygon points="237.8 364.36 235.96 364.36 213.58 300.3 215.42 300.3 237.8 364.36"
              style="fill: rgb(38, 50, 56); transform-origin: 225.69px 332.33px;" id="elm6k31mdglg" class="animable">
            </polygon>
            <polygon points="245.26 363.36 243.42 363.36 224.81 300.3 226.65 300.3 245.26 363.36"
              style="fill: rgb(38, 50, 56); transform-origin: 235.035px 331.83px;" id="elxbono9sn26s" class="animable">
            </polygon>
            <polygon points="253.68 362.13 251.84 362.13 235.34 300.3 237.19 300.3 253.68 362.13"
              style="fill: rgb(38, 50, 56); transform-origin: 244.51px 331.215px;" id="elx29uks6a45r" class="animable">
            </polygon>
            <polygon points="261.62 360.67 259.78 360.67 246.19 300.3 248.03 300.3 261.62 360.67"
              style="fill: rgb(38, 50, 56); transform-origin: 253.905px 330.485px;" id="elh0tfo71qvgv" class="animable">
            </polygon>
            <polygon points="269.95 359.74 268.1 359.74 257.18 300.3 259.03 300.3 269.95 359.74"
              style="fill: rgb(38, 50, 56); transform-origin: 263.565px 330.02px;" id="elernpxqg4gn" class="animable">
            </polygon>
            <polygon points="277.87 358.74 276.02 358.74 268.49 300.3 270.33 300.3 277.87 358.74"
              style="fill: rgb(38, 50, 56); transform-origin: 273.18px 329.52px;" id="el16xjdg07t8" class="animable">
            </polygon>
            <polygon points="285.79 357.28 283.94 357.28 279.52 300.3 281.37 300.3 285.79 357.28"
              style="fill: rgb(38, 50, 56); transform-origin: 282.655px 328.79px;" id="elrcmldvl6mpe" class="animable">
            </polygon>
            <polygon points="293.94 356.51 292.1 356.51 290.94 300.3 292.79 300.3 293.94 356.51"
              style="fill: rgb(38, 50, 56); transform-origin: 292.44px 328.405px;" id="el8sv7rj2kn4q" class="animable">
            </polygon>
            <polygon points="303 319.68 303 321.52 185.2 326.83 185.2 324.98 303 319.68"
              style="fill: rgb(38, 50, 56); transform-origin: 244.1px 323.255px;" id="el1n96eomie64" class="animable">
            </polygon>
            <polygon points="301.52 339 301.52 340.85 196.51 352.32 196.51 350.48 301.52 339"
              style="fill: rgb(38, 50, 56); transform-origin: 249.015px 345.66px;" id="elyrziez5kcn" class="animable">
            </polygon>
            <path d="M213.58,409.6A6.62,6.62,0,1,1,207,403,6.61,6.61,0,0,1,213.58,409.6Z"
              style="fill: #B9D77E; transform-origin: 206.96px 409.62px;" id="ell4t96ni3wi" class="animable"></path>
            <path
              d="M212,409.56a4.6,4.6,0,0,1-4.38,3.23,3.85,3.85,0,0,1-3.92-3.23L201.64,397h16.82l-2,7a3.47,3.47,0,0,1-.72,1.32Z"
              style="fill: rgb(38, 50, 56); transform-origin: 210.05px 404.896px;" id="elnpxysh632a" class="animable">
            </path>
            <g id="elk2n4uf539ac">
              <path
                d="M212,409.56a4.6,4.6,0,0,1-4.38,3.23,3.85,3.85,0,0,1-3.92-3.23L201.64,397h16.82l-2,7a3.47,3.47,0,0,1-.72,1.32Z"
                style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 210.05px 404.896px;" class="animable"
                id="elld4mkehcfbr"></path>
            </g>
            <path d="M276.89,409.6A6.62,6.62,0,1,0,283.5,403,6.61,6.61,0,0,0,276.89,409.6Z"
              style="fill: #B9D77E; transform-origin: 283.51px 409.62px;" id="el2pxosp4php6" class="animable"></path>
            <path
              d="M278.46,409.56a4.62,4.62,0,0,0,4.39,3.23,3.85,3.85,0,0,0,3.92-3.23L288.83,397H272l2.05,7a3.34,3.34,0,0,0,.72,1.32Z"
              style="fill: rgb(38, 50, 56); transform-origin: 280.415px 404.896px;" id="el7uxjwhruwcw" class="animable">
            </path>
            <g id="elpe5z6avxbq">
              <path
                d="M278.46,409.56a4.62,4.62,0,0,0,4.39,3.23,3.85,3.85,0,0,0,3.92-3.23L288.83,397H272l2.05,7a3.34,3.34,0,0,0,.72,1.32Z"
                style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 280.415px 404.896px;" class="animable"
                id="el77ngc06smqt"></path>
            </g>
            <g id="elh8mwzwjwpdu">
              <path
                d="M303.33,300.3H176.48a2.45,2.45,0,0,0-2.23,3.47l29.43,64.62a2.48,2.48,0,0,0,2.6,1.41L299,356a2.46,2.46,0,0,0,2.08-2.2L305.77,303A2.45,2.45,0,0,0,303.33,300.3Zm-2.68,1.46a2.35,2.35,0,0,1,2.34,2.57l-1.41,15.41-8.39.38-.37-18.36Zm-113.76,25,6.29-.28,10.3,23.25-5.84.63Zm8.1-.36,7.35-.33,9.8,22.71-6.9.75ZM273.87,342l-7,.76-3.57-19.48,8.15-.36Zm-.63-19.17,8-.36,1.44,18.56-7,.77ZM265,343l-7.21.79-4.51-20,8.12-.36Zm-9,1-7,.76-5.48-20.54,7.93-.36Zm-8.77.95-7.19.79-6.22-21.08,7.9-.36Zm-9,1-6.66.73-7.53-21.56,7.93-.36Zm-8.43.93-7.16.78-8.41-22.1,8-.36Zm-8.93,1-7,.77L204.15,326l8.31-.38Zm-8,2.72,6.9,16-6.61,1L206,351.28Zm1.76-.19,6.91-.76,6,15.78-6,.9Zm8.68-.95,7.11-.78,5.42,15.51-6.55,1Zm8.89-1,6.56-.72L243.32,363l-5.69.85Zm8.34-.91,7.15-.78,4,15-6.66,1Zm8.94-1,6.91-.75,3.32,14.78-6.24.93Zm8.71-.95,7.13-.78L268,359.33l-6.49,1Zm8.94-1,6.93-.75L276,358.14l-6.13.92Zm8.75-1,6.91-.76L283.92,357l-6.16.92Zm8.74-1,7.14-.78.28,13.83-6.34.94Zm-.14-1.83-1.44-18.44,8.31-.37.37,18Zm8.71-18.9,8.18-.37-1.61,17.6-6.2.68ZM291,301.76l.38,18.44-8.41.38-1.46-18.82Zm-11.33,0,1.46,18.9L273,321l-2.49-19.27Zm-11,0,2.49,19.35-8.25.37-3.62-19.72Zm-11.23,0,3.64,19.81-8.19.36-4.54-20.17Zm-10.93,0L251.08,322l-8,.36-5.5-20.62Zm-10.79,0,5.52,20.7-7.95.36-6.21-21.06Zm-10.49,0,6.24,21.14-8,.36-7.51-21.5Zm-11.15,0,7.54,21.58-8,.36-8.34-21.94Zm-10.7,0,8.38,22-8.4.38-9.68-22.41Zm-11.54,0,9.7,22.49-7.36.33-10.11-22.82Zm-12.7,0h3.09l10.14,22.9-6.32.28-9-19.85A2.35,2.35,0,0,1,179.15,301.76ZM205.21,367l-6.77-14.87,5.82-.63,7.21,16.29-3.77.56A2.36,2.36,0,0,1,205.21,367Zm93.32-14a2.35,2.35,0,0,1-2,2.11l-2.62.39-.28-13.75,6-.65Z"
                style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 239.905px 335.062px;" class="animable"
                id="el68k2qz5ri5"></path>
            </g>
            <path
              d="M156.66,279.87l7.56,4.37,3.33-5.76L160,274.11a3.32,3.32,0,0,0-4.54,1.22h0A3.32,3.32,0,0,0,156.66,279.87Z"
              style="fill: #B9D77E; transform-origin: 161.28px 278.952px;" id="eljevmmgfscgl" class="animable"></path>
            <g id="elgj4360b1srm">
              <rect x="243.94" y="346.88" width="3.58" height="98.44"
                style="fill: rgb(38, 50, 56); transform-origin: 245.73px 396.1px; transform: rotate(-90deg);"
                class="animable" id="elbb4ekbg5rhm"></rect>
            </g>
            <g id="el1jjzezhcju8">
              <rect x="220.55" y="360.33" width="3.58" height="17.79"
                style="fill: rgb(38, 50, 56); transform-origin: 222.34px 369.225px; transform: rotate(-98.81deg);"
                class="animable" id="eluw7sw0zk7dp"></rect>
            </g>
            <path d="M194.13,392.38c-.7.89.38,2.24,2.38,1.93v3.58c-6.71.23-8-4.5-5-7.89Z"
              style="fill: rgb(38, 50, 56); transform-origin: 193.246px 393.949px;" id="el9xndtxvasg5" class="animable">
            </path>
            <path d="M210.51,374a5.38,5.38,0,0,1,3.31-1.68l-.54-3.54a9.72,9.72,0,0,0-5.43,2.84Z"
              style="fill: rgb(38, 50, 56); transform-origin: 210.835px 371.39px;" id="elixb61reke8" class="animable">
            </path>
            <g id="ela5hwril38v">
              <rect x="243.94" y="346.88" width="3.58" height="98.44"
                style="fill: rgb(38, 50, 56); transform-origin: 245.73px 396.1px; transform: rotate(-90deg);"
                class="animable" id="el3ggqg5r8yfr"></rect>
            </g>
            <g id="el6kzxeh2htof">
              <rect x="220.55" y="360.33" width="3.58" height="17.79"
                style="fill: rgb(38, 50, 56); transform-origin: 222.34px 369.225px; transform: rotate(-98.81deg);"
                class="animable" id="ella1m0jx7cr"></rect>
            </g>
            <path d="M194.13,392.38c-.7.89.38,2.24,2.38,1.93v3.58c-6.71.23-8-4.5-5-7.89Z"
              style="fill: rgb(38, 50, 56); transform-origin: 193.246px 393.949px;" id="el9bhrturmf5q" class="animable">
            </path>
            <path d="M210.51,374a5.38,5.38,0,0,1,3.31-1.68l-.54-3.54a9.72,9.72,0,0,0-5.43,2.84Z"
              style="fill: rgb(38, 50, 56); transform-origin: 210.835px 371.39px;" id="ele1cvi9sjlrj" class="animable">
            </path>
            <g id="elxpwfydsb8q">
              <rect x="199.2" y="369.72" width="3.58" height="24.59"
                style="fill: rgb(38, 50, 56); transform-origin: 200.99px 382.015px; transform: rotate(-138.23deg);"
                class="animable" id="els2v0ntkoly"></rect>
            </g>
            <g id="elbijrbxbejfg">
              <rect x="199.2" y="369.72" width="3.58" height="24.59"
                style="fill: rgb(38, 50, 56); transform-origin: 200.99px 382.015px; transform: rotate(-138.23deg);"
                class="animable" id="el8ab2bs1bht"></rect>
            </g>
            <g id="elpgbyu5vngi">
              <path
                d="M196.51,394.31c-2,.31-3.08-1-2.38-1.93h0L210.51,374h0a5.38,5.38,0,0,1,3.31-1.68l17.59-2.73-.55-3.53-17.58,2.72a9.72,9.72,0,0,0-5.43,2.84L191.47,390h0c-3,3.39-1.67,8.12,5,7.89h98.43v-3.58Z"
                style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 242.425px 381.979px;" class="animable"
                id="elj9boqsky6s"></path>
            </g>
          </g>
          <defs>
            <filter id="active" height="200%">
              <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
              <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
              <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
              <feMerge>
                <feMergeNode in="OUTLINE"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
              </feMerge>
            </filter>
            <filter id="hover" height="200%">
              <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
              <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
              <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
              <feMerge>
                <feMergeNode in="OUTLINE"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
              </feMerge>
              <feColorMatrix type="matrix"
                values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 ">
              </feColorMatrix>
            </filter>
          </defs>
        </svg>
        <h4>Faire une demande de CheckOut</h4>
        <p>Voici un petit guide pour vous aider à créer et suivre vos tickets :</p>

      </div>

    
    </div>
  </section>


  <section id="services" class="py-5 mt-5  bg-light">
    <div class="container text-center mt-5 py-5">

        <h2 class="fw-bold"> Commencez à utiliser notre plateforme</h2>
      <div class="row">
        <div class="col-lg-2">
        <div>
           <svg class="animated" width="400" id="freepik_stories-sharing-ideas" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><style>svg#freepik_stories-sharing-ideas:not(.animated) .animable {opacity: 0;}svg#freepik_stories-sharing-ideas.animated #freepik--background-complete--inject-24 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) lightSpeedLeft;animation-delay: 0s;}svg#freepik_stories-sharing-ideas.animated #freepik--Shadow--inject-24 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideRight;animation-delay: 0s;}svg#freepik_stories-sharing-ideas.animated #freepik--Floor--inject-24 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideRight;animation-delay: 0s;}svg#freepik_stories-sharing-ideas.animated #freepik--speech-bubble--inject-24 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideRight,1.5s Infinite  linear floating;animation-delay: 0s,1s;}svg#freepik_stories-sharing-ideas.animated #freepik--character-2--inject-24 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) zoomIn;animation-delay: 0s;}svg#freepik_stories-sharing-ideas.animated #freepik--character-1--inject-24 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideUp;animation-delay: 0s;}svg#freepik_stories-sharing-ideas.animated #freepik--Plant--inject-24 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideLeft;animation-delay: 0s;}            @keyframes lightSpeedLeft {              from {                transform: translate3d(-50%, 0, 0) skewX(20deg);                opacity: 0;              }              60% {                transform: skewX(-10deg);                opacity: 1;              }              80% {                transform: skewX(2deg);              }              to {                opacity: 1;                transform: translate3d(0, 0, 0);              }            }                    @keyframes slideRight {                0% {                    opacity: 0;                    transform: translateX(30px);                }                100% {                    opacity: 1;                    transform: translateX(0);                }            }                    @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }                    @keyframes zoomIn {                0% {                    opacity: 0;                    transform: scale(0.5);                }                100% {                    opacity: 1;                    transform: scale(1);                }            }                    @keyframes slideUp {                0% {                    opacity: 0;                    transform: translateY(30px);                }                100% {                    opacity: 1;                    transform: inherit;                }            }                    @keyframes slideLeft {                0% {                    opacity: 0;                    transform: translateX(-30px);                }                100% {                    opacity: 1;                    transform: translateX(0);                }            }        .animator-hidden { display: none; }</style><g id="freepik--background-complete--inject-24" class="animable animator-hidden" style="transform-origin: 252.31px 212.052px;"><polygon points="284.1 354.4 459.83 354.4 463.49 282.29 280.44 282.29 284.1 354.4" style="fill: rgb(235, 235, 235); transform-origin: 371.965px 318.345px;" id="ellobj2r9llc" class="animable"></polygon><path d="M451.51,315.3H378l-1.38-25h76.45Zm-72.63-.89h71.79l1.5-23.26H377.6Z" style="fill: rgb(219, 219, 219); transform-origin: 414.845px 302.8px;" id="elkfxue1295" class="animable"></path><path d="M450.15,344.1H380.91l-1.12-22.6h71.77Zm-68.39-.89h67.56l1.3-20.82h-69.9Z" style="fill: rgb(219, 219, 219); transform-origin: 415.675px 332.8px;" id="elv8iyx3vgpm8" class="animable"></path><path d="M421.85,305.5H409.5l-.78-6h13.9Zm-11.57-.89h10.79l.55-4.26H409.73Z" style="fill: rgb(219, 219, 219); transform-origin: 415.67px 302.5px;" id="eljjixinehhd" class="animable"></path><path d="M421.85,335.82H409.5l-.78-6h13.9Zm-11.57-.89h10.79l.55-4.26H409.73Z" style="fill: rgb(219, 219, 219); transform-origin: 415.67px 332.82px;" id="els1n0u6ypuni" class="animable"></path><path d="M365.09,315.3H291.62l-1.38-25h76.45Zm-72.63-.89h71.8l1.49-23.26H291.18Z" style="fill: rgb(219, 219, 219); transform-origin: 328.465px 302.8px;" id="ele0gxuh8kuyt" class="animable"></path><path d="M363.73,344.1H294.49l-1.12-22.6h71.77Zm-68.39-.89H362.9l1.3-20.82H294.3Z" style="fill: rgb(219, 219, 219); transform-origin: 329.255px 332.8px;" id="el4z18t0d9jn" class="animable"></path><path d="M335.43,305.5H323.08l-.78-6h13.91Zm-11.57-.89h10.79l.55-4.26H323.31Z" style="fill: rgb(219, 219, 219); transform-origin: 329.255px 302.5px;" id="el48libvx515o" class="animable"></path><path d="M335.43,335.82H323.08l-.78-6h13.91Zm-11.57-.89h10.79l.55-4.26H323.31Z" style="fill: rgb(219, 219, 219); transform-origin: 329.255px 332.82px;" id="elavnada7qihf" class="animable"></path><polygon points="299.86 354.4 298.76 362.25 296.54 378.04 292.2 378.04 292.2 354.4 299.86 354.4" style="fill: rgb(235, 235, 235); transform-origin: 296.03px 366.22px;" id="elzi9rmee3s37" class="animable"></polygon><polygon points="299.86 354.4 298.76 362.25 292.2 362.25 292.2 354.4 299.86 354.4" style="fill: rgb(219, 219, 219); transform-origin: 296.03px 358.325px;" id="elhblrp5bzft9" class="animable"></polygon><polygon points="444.07 354.4 445.18 362.25 447.4 378.04 451.74 378.04 451.74 354.4 444.07 354.4" style="fill: rgb(235, 235, 235); transform-origin: 447.905px 366.22px;" id="elq6ucff0xy3" class="animable"></polygon><polygon points="444.07 354.4 445.18 362.25 451.74 362.25 451.74 354.4 444.07 354.4" style="fill: rgb(219, 219, 219); transform-origin: 447.905px 358.325px;" id="ely9w191tyx0n" class="animable"></polygon><g id="elojsn8zs13p"><rect x="288.65" y="113.98" width="166.63" height="7.31" style="fill: rgb(235, 235, 235); transform-origin: 371.965px 117.635px; transform: rotate(180deg);" class="animable" id="elwea81h0zv7q"></rect></g><rect x="438.63" y="121.29" width="7.31" height="24.17" style="fill: rgb(235, 235, 235); transform-origin: 442.285px 133.375px;" id="elcusqw29ll8w" class="animable"></rect><rect x="438.63" y="121.29" width="7.31" height="7.47" style="fill: rgb(219, 219, 219); transform-origin: 442.285px 125.025px;" id="ele4oegnenz1h" class="animable"></rect><rect x="297.99" y="121.29" width="7.31" height="24.17" style="fill: rgb(235, 235, 235); transform-origin: 301.645px 133.375px;" id="eleu3x6u11sbe" class="animable"></rect><rect x="297.99" y="121.29" width="7.31" height="7.47" style="fill: rgb(219, 219, 219); transform-origin: 301.645px 125.025px;" id="elu90zmsxf1v" class="animable"></rect><g id="elrbpwfex5wn"><rect x="395.03" y="84.83" width="46.57" height="11.73" style="fill: rgb(199, 199, 199); transform-origin: 418.315px 90.695px; transform: rotate(90deg);" class="animable" id="el8tm6wcd2glj"></rect></g><g id="elluc3x5w4qi"><rect x="415.76" y="61.61" width="5.12" height="11.73" style="fill: rgb(219, 219, 219); transform-origin: 418.32px 67.475px; transform: rotate(90deg);" class="animable" id="elkyyeefkixss"></rect></g><g id="ell8yvxrppugs"><rect x="417.37" y="71.68" width="1.9" height="11.73" style="fill: rgb(219, 219, 219); transform-origin: 418.32px 77.545px; transform: rotate(90deg);" class="animable" id="eld3r2d61f8v"></rect></g><g id="elgvsm4dw2j8s"><rect x="415.03" y="98.72" width="5.12" height="13.19" style="fill: rgb(219, 219, 219); transform-origin: 417.59px 105.315px; transform: rotate(90deg);" class="animable" id="el7k5ttpa4pu4"></rect></g><g id="elcoz2ihtyk6g"><rect x="381.19" y="82.72" width="54.33" height="8.2" style="fill: rgb(219, 219, 219); transform-origin: 408.355px 86.82px; transform: rotate(90deg);" class="animable" id="elav44iuzuus"></rect></g><g id="el5dkxkeu0slj"><rect x="397.94" y="72.75" width="20.89" height="4.92" style="fill: rgb(235, 235, 235); transform-origin: 408.385px 75.21px; transform: rotate(90deg);" class="animable" id="eld6blcu6z6hs"></rect></g><g id="eliwyjz2vfoo"><rect x="340.98" y="87.88" width="54.33" height="8.2" style="fill: rgb(199, 199, 199); transform-origin: 368.145px 91.98px; transform: rotate(135.33deg);" class="animable" id="eltldq907902g"></rect></g><g id="elcsi9j5qwhsp"><rect x="354.86" y="92.29" width="20.89" height="4.92" style="fill: rgb(219, 219, 219); transform-origin: 365.305px 94.75px; transform: rotate(135.33deg);" class="animable" id="elrv3siwsilq"></rect></g><g id="el5m7r6hy9zf9"><rect x="376.67" y="86.4" width="41.26" height="13.92" style="fill: rgb(166, 166, 166); transform-origin: 397.3px 93.36px; transform: rotate(90deg);" class="animable" id="elg3kuo0psax7"></rect></g><g id="eleqntasufvdt"><rect x="395.38" y="100.73" width="3.85" height="13.92" style="fill: rgb(199, 199, 199); transform-origin: 397.305px 107.69px; transform: rotate(90deg);" class="animable" id="elefyfee143z"></rect></g><g id="el7bayrxq1qku"><rect x="396.56" y="95.54" width="1.49" height="13.92" style="fill: rgb(199, 199, 199); transform-origin: 397.305px 102.5px; transform: rotate(90deg);" class="animable" id="ell03obf09mvi"></rect></g><g id="el88ojjq9wmk"><rect x="409.6" y="89.79" width="38.78" height="9.61" style="fill: rgb(166, 166, 166); transform-origin: 428.99px 94.595px; transform: rotate(90deg);" class="animable" id="eltslwac1xmk"></rect></g><g id="elzy2b5plc7io"><rect x="427.18" y="103.26" width="3.61" height="9.61" style="fill: rgb(199, 199, 199); transform-origin: 428.985px 108.065px; transform: rotate(90deg);" class="animable" id="elmw5egmlz0o"></rect></g><g id="eln697bxqub6o"><rect x="427.18" y="80.2" width="3.61" height="9.61" style="fill: rgb(199, 199, 199); transform-origin: 428.985px 85.005px; transform: rotate(90deg);" class="animable" id="elc4u1d3pwgfu"></rect></g><g id="eld11tmpkw4uo"><rect x="428.29" y="85.19" width="1.4" height="9.61" style="fill: rgb(199, 199, 199); transform-origin: 428.99px 89.995px; transform: rotate(90deg);" class="animable" id="elr4sw26ze5"></rect></g><path d="M322.35,64.3c8.2,8,9.58,20.46,7.85,31.34-.05.25-.43.18-.43,0,0-2.48.07-4.94.07-7.38l-.13-.33a16.53,16.53,0,0,1-5.33-5.73c-1.37-2.69-1.91-5.73-3-8.54-.09-.27.19-.2.38-.06,5,3.68,6.58,7.64,8,12.94a43.42,43.42,0,0,0-.86-8.24,28.08,28.08,0,0,0-6.82-13.73A.16.16,0,0,1,322.35,64.3Z" style="fill: rgb(166, 166, 166); transform-origin: 326.11px 80.0235px;" id="elcuvmbvdledn" class="animable"></path><path d="M320.8,65.24c-1.41.05-2.29,2.3-3.39,3a1.06,1.06,0,0,1-1.56-.24c-1.09-1.53.41-3.4,1.81-4.45a15.39,15.39,0,0,1-2.92,1.34,1,1,0,0,1-1.32-.79c-.48-2.07,2.12-3,3.91-3-.87-.6-3.35-2.23-2-3s4.24,1.53,5.19,2.3c1.4,1.14,3.06,2.83,3.12,4.6C323.7,66.94,321.89,65.67,320.8,65.24Z" style="fill: rgb(219, 219, 219); transform-origin: 318.502px 63.2125px;" id="el5of48rsjx43" class="animable"></path><path d="M321.21,65.59c-1.8-.82-5.27.36-5.56-.33-.6-1.39,2.17-2.34,3.66-2.52-1.37-.38-4-1-3.93-2.3.1-1.62,4.05-.23,6,1.31,2.52,1.93,2.51,3.79,2.09,4.16S321.51,65.72,321.21,65.59Z" style="fill: rgb(235, 235, 235); transform-origin: 319.529px 62.8751px;" id="elfa600oldi76" class="animable"></path><path d="M341,63.51c-8.51,7.71-10.35,20.07-9,31,0,.25.42.2.43,0,.09-2.48.11-4.94.21-7.38l.14-.32a16.52,16.52,0,0,0,5.54-5.52c1.47-2.64,2.13-5.66,3.28-8.43.11-.27-.18-.2-.37-.07-5.13,3.49-6.87,7.39-8.5,12.62a43.47,43.47,0,0,1,1.18-8.2,28.09,28.09,0,0,1,7.34-13.46C341.37,63.6,341.17,63.37,341,63.51Z" style="fill: rgb(166, 166, 166); transform-origin: 336.612px 79.0729px;" id="elppoohn19syo" class="animable"></path><path d="M342.53,64.5c1.41.1,2.21,2.39,3.28,3.09a1.06,1.06,0,0,0,1.57-.19c1.14-1.47-.28-3.41-1.64-4.51a15.82,15.82,0,0,0,2.87,1.46,1,1,0,0,0,1.35-.74c.55-2.06-2-3.08-3.79-3.19.88-.57,3.42-2.11,2.14-3s-4.3,1.37-5.28,2.1c-1.44,1.08-3.16,2.71-3.29,4.47C339.58,66.1,341.43,64.89,342.53,64.5Z" style="fill: rgb(219, 219, 219); transform-origin: 344.883px 62.5349px;" id="el0q799v95155c" class="animable"></path><path d="M342.11,64.83c1.83-.75,5.25.56,5.57-.11.65-1.36-2.08-2.42-3.57-2.66,1.39-.32,4.05-.82,4-2.15,0-1.62-4-.38-6.09,1.08-2.59,1.83-2.64,3.69-2.24,4.08S341.81,65,342.11,64.83Z" style="fill: rgb(235, 235, 235); transform-origin: 343.853px 62.1841px;" id="elbl3dnju1jka" class="animable"></path><path d="M332.33,83.88a83.26,83.26,0,0,1-2.64,12.19.3.3,0,0,1-.59-.12c.56-3.76,1.57-7.44,2.13-11.2a56.83,56.83,0,0,0,.66-11.51c-.36-6.33-2.08-13.06-6.21-18-.09-.12.1-.28.19-.17,8.27,9.64,7,21.47,6.95,22.53,1.17-4,2.38-8.57,6.81-12.64.19-.17.34-.09.31.21-.79,7.4-2.85,11.27-7.15,15.23C332.67,81.56,332.52,82.72,332.33,83.88Z" style="fill: rgb(166, 166, 166); transform-origin: 332.8px 75.6712px;" id="el2huplgpjl8c" class="animable"></path><path d="M325.6,56.33c-1.49-.66-3.54,1.23-5,1.36a1.21,1.21,0,0,1-1.49-1c-.37-2.12,2.13-3.32,4.11-3.7-1.25-.07-2.48.26-3.71-.07a1.18,1.18,0,0,1-1-1.49c.55-2.39,3.71-2,5.59-1.18-.6-1.06-2.35-4-.58-4.18s3.64,3.73,4.23,5c.88,1.88,1.75,4.47.93,6.34C327.74,59.55,326.51,57.33,325.6,56.33Z" style="fill: rgb(219, 219, 219); transform-origin: 323.737px 52.1868px;" id="elzo0dtnh8eo" class="animable"></path><path d="M325.85,56.9c-1.46-1.76-5.65-2.28-5.61-3.14.08-1.74,3.43-1.34,5.08-.78-1.25-1.08-3.68-3-2.93-4.36.92-1.63,4.31,1.8,5.61,4.4,1.64,3.27.69,5.19.07,5.37C327.22,58.63,326.09,57.19,325.85,56.9Z" style="fill: rgb(235, 235, 235); transform-origin: 324.576px 53.3071px;" id="elztkw8b8ge4" class="animable"></path><path d="M337.78,86.11,341.42,114h-22.2c.46-2.47,4.59-27.91,4.59-27.91Z" style="fill: rgb(219, 219, 219); transform-origin: 330.32px 100.045px;" id="el0ni2yk628igf" class="animable"></path><rect x="409.19" y="277.88" width="16.81" height="4.41" style="fill: rgb(199, 199, 199); transform-origin: 417.595px 280.085px;" id="el46osnargw1v" class="animable"></rect><rect x="415.29" y="222.22" width="4.6" height="55.66" style="fill: rgb(199, 199, 199); transform-origin: 417.59px 250.05px;" id="eles0pyftah06" class="animable"></rect><rect x="415.29" y="222.22" width="4.6" height="23.3" style="fill: rgb(166, 166, 166); transform-origin: 417.59px 233.87px;" id="elugynso6h5wc" class="animable"></rect><polygon points="441.93 235.71 393.24 235.71 396.78 224.08 396.91 223.67 407.2 189.84 427.97 189.84 438.27 223.68 438.27 223.68 438.38 224.07 441.93 235.71" style="fill: rgb(235, 235, 235); transform-origin: 417.585px 212.775px;" id="el57il0i2khtd" class="animable"></polygon><circle cx="408.6" cy="197.66" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 408.6px 197.66px;" id="el1sncvycav93" class="animable"></circle><circle cx="414.59" cy="197.66" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 414.59px 197.66px;" id="el8jn7ic720ii" class="animable"></circle><circle cx="420.59" cy="197.66" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 420.59px 197.66px;" id="elpuvb6nmai" class="animable"></circle><circle cx="426.58" cy="197.66" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 426.58px 197.66px;" id="elzk9wphuwjg" class="animable"></circle><circle cx="411.6" cy="193.46" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 411.6px 193.46px;" id="elubwh6q2a3bq" class="animable"></circle><circle cx="417.59" cy="193.46" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 417.59px 193.46px;" id="elf5yzb9ctci9" class="animable"></circle><circle cx="423.59" cy="193.46" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 423.59px 193.46px;" id="elrrntxfrx2en" class="animable"></circle><path d="M402.93,206.37a.33.33,0,0,1-.33.33.32.32,0,0,1-.32-.33.32.32,0,0,1,.32-.32A.32.32,0,0,1,402.93,206.37Z" style="fill: rgb(255, 255, 255); transform-origin: 402.605px 206.375px;" id="eloywpzgm5iuc" class="animable"></path><path d="M408.93,206.37a.33.33,0,0,1-.66,0,.33.33,0,0,1,.66,0Z" style="fill: rgb(255, 255, 255); transform-origin: 408.6px 206.37px;" id="eljvxhov2yx4r" class="animable"></path><path d="M414.92,206.37a.33.33,0,0,1-.33.33.32.32,0,0,1-.32-.33.32.32,0,0,1,.32-.32A.32.32,0,0,1,414.92,206.37Z" style="fill: rgb(255, 255, 255); transform-origin: 414.595px 206.375px;" id="el5kapsvqhmxu" class="animable"></path><path d="M420.92,206.37a.33.33,0,0,1-.66,0,.33.33,0,0,1,.66,0Z" style="fill: rgb(255, 255, 255); transform-origin: 420.59px 206.37px;" id="elj9be9m5o20r" class="animable"></path><path d="M426.91,206.37a.33.33,0,0,1-.33.33.32.32,0,0,1-.32-.33.32.32,0,0,1,.32-.32A.32.32,0,0,1,426.91,206.37Z" style="fill: rgb(255, 255, 255); transform-origin: 426.585px 206.375px;" id="elus31t6oyvw" class="animable"></path><path d="M432.91,206.37a.33.33,0,0,1-.66,0,.33.33,0,0,1,.66,0Z" style="fill: rgb(255, 255, 255); transform-origin: 432.58px 206.37px;" id="el8mjcep0q2h2" class="animable"></path><path d="M405.93,202.18a.33.33,0,1,1-.33-.33A.32.32,0,0,1,405.93,202.18Z" style="fill: rgb(255, 255, 255); transform-origin: 405.6px 202.18px;" id="elk4haobdauzh" class="animable"></path><circle cx="411.6" cy="202.18" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 411.6px 202.18px;" id="el0xgkuni9yis" class="animable"></circle><circle cx="417.59" cy="202.18" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 417.59px 202.18px;" id="elp74173mwh2f" class="animable"></circle><circle cx="423.59" cy="202.18" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 423.59px 202.18px;" id="elvawuq24muce" class="animable"></circle><circle cx="429.58" cy="202.18" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 429.58px 202.18px;" id="el46fcdb7ze98" class="animable"></circle><circle cx="402.6" cy="215.09" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 402.6px 215.09px;" id="elrpdvb7b5qq" class="animable"></circle><circle cx="408.6" cy="215.09" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 408.6px 215.09px;" id="el1ymh77kk4qj" class="animable"></circle><circle cx="414.59" cy="215.09" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 414.59px 215.09px;" id="elw1smkh90ofg" class="animable"></circle><circle cx="420.59" cy="215.09" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 420.59px 215.09px;" id="elscohh2kk418" class="animable"></circle><circle cx="426.58" cy="215.09" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 426.58px 215.09px;" id="ely1bstvavac" class="animable"></circle><circle cx="432.58" cy="215.09" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 432.58px 215.09px;" id="elqasrv3j3gs" class="animable"></circle><path d="M405.93,210.89a.33.33,0,0,1-.66,0,.33.33,0,0,1,.66,0Z" style="fill: rgb(255, 255, 255); transform-origin: 405.6px 210.89px;" id="el6w3fqpmtw4c" class="animable"></path><path d="M411.92,210.89a.33.33,0,1,1-.65,0,.33.33,0,0,1,.65,0Z" style="fill: rgb(255, 255, 255); transform-origin: 411.595px 210.947px;" id="elyag54fzqg4s" class="animable"></path><path d="M417.92,210.89a.33.33,0,1,1-.66,0,.33.33,0,0,1,.66,0Z" style="fill: rgb(255, 255, 255); transform-origin: 417.59px 210.89px;" id="eliqharhje4ln" class="animable"></path><path d="M423.91,210.89a.33.33,0,1,1-.65,0,.33.33,0,0,1,.65,0Z" style="fill: rgb(255, 255, 255); transform-origin: 423.585px 210.947px;" id="ele0jpbss6jg6" class="animable"></path><path d="M429.91,210.89a.33.33,0,1,1-.66,0,.33.33,0,0,1,.66,0Z" style="fill: rgb(255, 255, 255); transform-origin: 429.58px 210.89px;" id="eljr8kpxxqroh" class="animable"></path><path d="M396.94,223.8a.3.3,0,0,1-.16.28l.13-.41A.31.31,0,0,1,396.94,223.8Z" style="fill: rgb(255, 255, 255); transform-origin: 396.86px 223.875px;" id="elimu5gs4x7zs" class="animable"></path><circle cx="402.6" cy="223.81" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 402.6px 223.81px;" id="elfwdi5hac84g" class="animable"></circle><circle cx="408.6" cy="223.81" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 408.6px 223.81px;" id="el7hag6h0ln75" class="animable"></circle><circle cx="414.59" cy="223.81" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 414.59px 223.81px;" id="el3aqhf9zagvm" class="animable"></circle><circle cx="420.59" cy="223.81" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 420.59px 223.81px;" id="el11jbhwofaywp" class="animable"></circle><circle cx="426.58" cy="223.81" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 426.58px 223.81px;" id="eli2ehtoz3s88" class="animable"></circle><circle cx="432.58" cy="223.81" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 432.58px 223.81px;" id="elovw2lcahrli" class="animable"></circle><path d="M438.38,224.07a.31.31,0,0,1-.13-.27.5.5,0,0,1,0-.12Z" style="fill: rgb(255, 255, 255); transform-origin: 438.313px 223.875px;" id="elpryq4z7z56j" class="animable"></path><circle cx="399.61" cy="219.61" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 399.61px 219.61px;" id="eljcfsbc9mja" class="animable"></circle><path d="M405.93,219.61a.33.33,0,1,1-.33-.33A.33.33,0,0,1,405.93,219.61Z" style="fill: rgb(255, 255, 255); transform-origin: 405.6px 219.61px;" id="el96zn483rwhc" class="animable"></path><circle cx="411.6" cy="219.61" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 411.6px 219.61px;" id="elzl8eggogqmj" class="animable"></circle><circle cx="417.59" cy="219.61" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 417.59px 219.61px;" id="eleyhw3qck1xc" class="animable"></circle><circle cx="423.59" cy="219.61" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 423.59px 219.61px;" id="el9o5ooe6l8t" class="animable"></circle><circle cx="429.58" cy="219.61" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 429.58px 219.61px;" id="eltoina4cfh2i" class="animable"></circle><circle cx="435.58" cy="219.61" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 435.58px 219.61px;" id="elzv9zz92gmuc" class="animable"></circle><path d="M396.94,232.53a.33.33,0,1,1-.33-.33A.32.32,0,0,1,396.94,232.53Z" style="fill: rgb(255, 255, 255); transform-origin: 396.61px 232.53px;" id="elne87m7efk5a" class="animable"></path><path d="M402.93,232.53a.32.32,0,0,1-.33.32.33.33,0,0,1,0-.65A.33.33,0,0,1,402.93,232.53Z" style="fill: rgb(255, 255, 255); transform-origin: 402.629px 232.525px;" id="elcoo7xmueg3q" class="animable"></path><path d="M408.93,232.53a.33.33,0,1,1-.33-.33A.32.32,0,0,1,408.93,232.53Z" style="fill: rgb(255, 255, 255); transform-origin: 408.6px 232.53px;" id="el1bw574hhjb3" class="animable"></path><path d="M414.92,232.53a.32.32,0,0,1-.33.32.33.33,0,0,1,0-.65A.33.33,0,0,1,414.92,232.53Z" style="fill: rgb(255, 255, 255); transform-origin: 414.619px 232.525px;" id="el0hnta1joj1jb" class="animable"></path><path d="M420.92,232.53a.33.33,0,1,1-.33-.33A.32.32,0,0,1,420.92,232.53Z" style="fill: rgb(255, 255, 255); transform-origin: 420.59px 232.53px;" id="el9av0qe8nzso" class="animable"></path><path d="M426.91,232.53a.32.32,0,0,1-.33.32.33.33,0,0,1,0-.65A.33.33,0,0,1,426.91,232.53Z" style="fill: rgb(255, 255, 255); transform-origin: 426.609px 232.525px;" id="elin8ewz26dhn" class="animable"></path><path d="M432.91,232.53a.33.33,0,1,1-.33-.33A.32.32,0,0,1,432.91,232.53Z" style="fill: rgb(255, 255, 255); transform-origin: 432.58px 232.53px;" id="eldxetggd11j" class="animable"></path><path d="M438.9,232.53a.32.32,0,0,1-.33.32.33.33,0,0,1,0-.65A.33.33,0,0,1,438.9,232.53Z" style="fill: rgb(255, 255, 255); transform-origin: 438.599px 232.525px;" id="elyn4fda5c63j" class="animable"></path><circle cx="399.61" cy="228.33" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 399.61px 228.33px;" id="elqo50p0tjym9" class="animable"></circle><path d="M405.93,228.33a.33.33,0,0,1-.66,0,.33.33,0,0,1,.66,0Z" style="fill: rgb(255, 255, 255); transform-origin: 405.6px 228.33px;" id="elpieigdgxji" class="animable"></path><circle cx="411.6" cy="228.33" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 411.6px 228.33px;" id="elc4c8onhnxkc" class="animable"></circle><circle cx="417.59" cy="228.33" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 417.59px 228.33px;" id="elxcs20vrx1ce" class="animable"></circle><circle cx="423.59" cy="228.33" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 423.59px 228.33px;" id="elw17mr2pwo1m" class="animable"></circle><circle cx="429.58" cy="228.33" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 429.58px 228.33px;" id="elgmswdq5wpna" class="animable"></circle><circle cx="435.58" cy="228.33" r="0.33" style="fill: rgb(255, 255, 255); transform-origin: 435.58px 228.33px;" id="el8r7qaj33guf" class="animable"></circle><polygon points="105.56 300.67 74.07 300.67 56.04 210.82 84.88 197.57 105.56 300.67" style="fill: rgb(219, 219, 219); transform-origin: 80.8px 249.12px;" id="ell598bnocs6q" class="animable"></polygon><polygon points="195.68 300.67 105.56 300.67 84.88 197.57 175 197.57 195.68 300.67" style="fill: rgb(235, 235, 235); transform-origin: 140.28px 249.12px;" id="el0ro76nf8y2ai" class="animable"></polygon><rect x="41.13" y="252.46" width="48.26" height="99.02" style="fill: rgb(219, 219, 219); transform-origin: 65.26px 301.97px;" id="elqpk6z6vg6es" class="animable"></rect><polygon points="218.84 351.48 205.66 351.48 186.01 252.46 218.84 252.46 218.84 351.48" style="fill: rgb(219, 219, 219); transform-origin: 202.425px 301.97px;" id="elr3fnwxyjcka" class="animable"></polygon><rect x="89.39" y="252.46" width="26.52" height="99.02" style="fill: rgb(235, 235, 235); transform-origin: 102.65px 301.97px;" id="el2it8fe009dc" class="animable"></rect><rect x="218.85" y="252.46" width="26.52" height="99.02" style="fill: rgb(235, 235, 235); transform-origin: 232.11px 301.97px;" id="elkw36lq7plo9" class="animable"></rect><rect x="115.9" y="300.67" width="102.94" height="50.81" style="fill: rgb(235, 235, 235); transform-origin: 167.37px 326.075px;" id="el430h0g172r3" class="animable"></rect><rect x="115.9" y="278.7" width="102.94" height="22.17" style="fill: rgb(235, 235, 235); transform-origin: 167.37px 289.785px;" id="el9di33fuk04w" class="animable"></rect><path d="M95.89,252.46l10-.18,10-.12h.31v.31l.11,11.59,0,11.59c0,7.72.06,15.45,0,23.17s0,15.45-.13,23.18-.17,15.45-.34,23.17q-.24-11.58-.33-23.17c-.1-7.73-.11-15.45-.13-23.18s0-15.45,0-23.17l0-11.59.11-11.59.3.3-10-.12Z" style="fill: rgb(219, 219, 219); transform-origin: 106.113px 298.665px;" id="el71ian918id5" class="animable"></path><path d="M218.85,252.46c.2,7.75.3,15.51.38,23.26l.11,23.26-.11,23.27-.14,11.63-.24,11.63-.25-11.63-.14-11.63L218.35,299l.11-23.26C218.54,268,218.64,260.21,218.85,252.46Z" style="fill: rgb(219, 219, 219); transform-origin: 218.845px 298.985px;" id="elyu8lgn49j6o" class="animable"></path><path d="M218.85,300.67c-8.58.2-17.16.3-25.74.38l-25.74.12-25.73-.12-12.87-.14-12.87-.24,12.87-.25,12.87-.14,25.73-.11,25.74.11C201.69,300.36,210.27,300.46,218.85,300.67Z" style="fill: rgb(219, 219, 219); transform-origin: 167.375px 300.67px;" id="el8oj8u1vimn" class="animable"></path><path d="M218.85,278.7c-8.58.21-17.16.3-25.74.38l-25.74.12-25.73-.12-12.87-.14-12.87-.24,12.87-.25,12.87-.14,25.73-.11,25.74.12C201.69,278.4,210.27,278.49,218.85,278.7Z" style="fill: rgb(219, 219, 219); transform-origin: 167.375px 278.7px;" id="elsw097ommjdd" class="animable"></path><polygon points="59.47 351.48 58.82 359.5 57.29 378.04 50.3 378.04 48.78 359.5 48.13 351.48 59.47 351.48" style="fill: rgb(199, 199, 199); transform-origin: 53.8px 364.76px;" id="eliqj49u9z6of" class="animable"></polygon><polygon points="48.13 351.48 59.47 351.48 58.82 359.5 48.78 359.5 48.13 351.48" style="fill: rgb(166, 166, 166); transform-origin: 53.8px 355.49px;" id="el7khs7khdzyh" class="animable"></polygon><polygon points="108.32 351.48 107.66 359.5 106.14 378.04 99.15 378.04 97.63 359.5 96.98 351.48 108.32 351.48" style="fill: rgb(199, 199, 199); transform-origin: 102.65px 364.76px;" id="elcgrw627vix8" class="animable"></polygon><polygon points="96.98 351.48 108.32 351.48 107.66 359.5 97.63 359.5 96.98 351.48" style="fill: rgb(166, 166, 166); transform-origin: 102.65px 355.49px;" id="el8vimb82b46q" class="animable"></polygon><polygon points="189.34 351.48 188.69 359.5 187.16 378.04 180.18 378.04 178.65 359.5 178 351.48 189.34 351.48" style="fill: rgb(199, 199, 199); transform-origin: 183.67px 364.76px;" id="eljvet4cbjl7q" class="animable"></polygon><polygon points="178 351.48 189.34 351.48 188.69 359.5 178.65 359.5 178 351.48" style="fill: rgb(166, 166, 166); transform-origin: 183.67px 355.49px;" id="elnxlw987ihei" class="animable"></polygon><polygon points="238.2 351.48 237.55 359.5 236.02 378.04 229.03 378.04 227.51 359.5 226.86 351.48 238.2 351.48" style="fill: rgb(199, 199, 199); transform-origin: 232.53px 364.76px;" id="elvzc1hoy9g7" class="animable"></polygon><polygon points="238.2 351.48 237.55 359.5 227.51 359.5 226.86 351.48 238.2 351.48" style="fill: rgb(166, 166, 166); transform-origin: 232.53px 355.49px;" id="els9cv01nt34" class="animable"></polygon></g><g id="freepik--Shadow--inject-24" class="animable" style="transform-origin: 229.19px 435.98px;"><ellipse cx="70.43" cy="434.6" rx="41.04" ry="8.65" style="fill: rgb(235, 235, 235); transform-origin: 70.43px 434.6px;" id="el784j1wfk0y" class="animable"></ellipse><ellipse cx="250" cy="435.98" rx="178.99" ry="26.05" style="fill: rgb(235, 235, 235); transform-origin: 250px 435.98px;" id="els04q9f53znh" class="animable"></ellipse></g><g id="freepik--Floor--inject-24" class="animable" style="transform-origin: 250px 378.04px;"><polygon points="40.02 378.04 92.51 377.79 145.01 377.71 250 377.54 354.99 377.7 407.49 377.79 459.98 378.04 407.49 378.28 354.99 378.37 250 378.54 145.01 378.37 92.51 378.28 40.02 378.04" style="fill: rgb(38, 50, 56); transform-origin: 250px 378.04px;" id="eleigwto1c4mf" class="animable"></polygon></g><g id="freepik--speech-bubble--inject-24" class="animable animator-active animator-hidden" style="transform-origin: 249.624px 102.892px;"><path d="M192.16,123.79a37.86,37.86,0,0,1-6.47-20.9c0-26.47,29.08-47.94,64.92-47.94s64.89,21.47,64.89,47.94-29.05,48-64.89,48c-17.38,0-33.14-5-44.78-13.27l-22.36,5.69Z" style="fill: rgb(255, 255, 255); transform-origin: 249.485px 102.92px;" id="elgatjqkqh63q" class="animable"></path><path d="M192.16,123.79A38.17,38.17,0,0,1,185.61,104a37.51,37.51,0,0,1,5.19-20.22A50.65,50.65,0,0,1,205.08,68.4a69.22,69.22,0,0,1,18.8-9.52,86.48,86.48,0,0,1,41.76-3,77.07,77.07,0,0,1,20.15,6.28,61.87,61.87,0,0,1,17.38,12A44,44,0,0,1,314.33,92a36.42,36.42,0,0,1,.18,21,43.51,43.51,0,0,1-10.86,18.05,61.5,61.5,0,0,1-17.22,12.19A83.18,83.18,0,0,1,245.29,151a90.28,90.28,0,0,1-10.48-1.27,82.61,82.61,0,0,1-10.24-2.61,69.38,69.38,0,0,1-18.87-9.34l.19,0-22.39,5.57-.22.06.09-.21Zm0,0-8.59,19.51-.12-.15,22.33-5.8.1,0,.09.07a70.28,70.28,0,0,0,18.78,9.18,80.88,80.88,0,0,0,10.17,2.55,88.76,88.76,0,0,0,10.41,1.23,82.54,82.54,0,0,0,40.76-7.76,60.67,60.67,0,0,0,17-12.08,42.62,42.62,0,0,0,10.58-17.71,35.62,35.62,0,0,0-.24-20.48,43,43,0,0,0-10.86-17.54,61.07,61.07,0,0,0-17.09-11.87,76.86,76.86,0,0,0-19.92-6.28,85.9,85.9,0,0,0-41.44,2.84,68.73,68.73,0,0,0-18.67,9.37A51.31,51.31,0,0,0,191.17,84a37.26,37.26,0,0,0-5.35,20A38.11,38.11,0,0,0,192.16,123.79Z" style="fill: rgb(38, 50, 56); transform-origin: 249.624px 102.892px;" id="ela0du8zp5k99" class="animable"></path></g><g id="freepik--character-2--inject-24" class="animable animator-hidden" style="transform-origin: 314.26px 249.441px;"><path d="M279,445.73c2,.67,60,.5,62.21-.9.83-.52,1.3-9,1.58-19.19.06-2.21.1-4.48.14-6.8,0-2.74.08-5.52.1-8.22.07-12.1-.1-22.76-.1-22.76H305.29l-.05,22.76v8.22l.2,6.8s-22.17,10-24.42,11.79S277,445.06,279,445.73Z" style="fill: rgb(221, 106, 87); transform-origin: 310.588px 416.985px;" id="ellmf2ddlaefs" class="animable"></path><path d="M279,445.73c2,.67,60,.5,62.21-.9.83-.52,1.3-9,1.58-19.19.06-2.21.1-4.48.14-6.8,0-2.74.08-5.52.1-8.22H305.24v8.22l.2,6.8s-22.17,10-24.42,11.79S277,445.06,279,445.73Z" style="fill: rgb(255, 255, 255); transform-origin: 310.579px 428.365px;" id="elr8hqvjvgwm" class="animable"></path><path d="M278.86,445.81c1.32.44,26,.53,44,.15,4.16-.08,8-.2,11-.33,4.23-.2,7.07-.43,7.53-.72,1-.66,1.51-13.06,1.74-26.14H305.23l.19,6.84s-22.29,10.05-24.56,11.86S276.83,445.13,278.86,445.81Z" style="fill: #FFA000; transform-origin: 310.549px 432.485px;" id="elv8uj9qajesc" class="animable"></path><path d="M279.69,443.48c9.77-.27,49.2-.43,58.88,0,.08,0,.08.06,0,.06-9.68.48-49.11.32-58.88.05C279.48,443.63,279.48,443.49,279.69,443.48Z" style="fill: rgb(38, 50, 56); transform-origin: 309.081px 443.531px;" id="el450dtcs5lid" class="animable"></path><path d="M304,423.45c3.85-.73,8.55-.16,11.5,2.57.11.11,0,.27-.16.23a54.57,54.57,0,0,0-11.32-2.32A.24.24,0,0,1,304,423.45Z" style="fill: rgb(38, 50, 56); transform-origin: 309.657px 424.708px;" id="el5gf7amu99cv" class="animable"></path><path d="M301.26,425.13c3.85-.73,8.55-.16,11.5,2.57.11.11,0,.27-.17.23a54.35,54.35,0,0,0-11.31-2.32A.24.24,0,0,1,301.26,425.13Z" style="fill: rgb(38, 50, 56); transform-origin: 306.917px 426.388px;" id="elz3lhsciwmep" class="animable"></path><path d="M298.49,426.81c3.85-.73,8.55-.16,11.5,2.58.11.1,0,.26-.17.22a54.35,54.35,0,0,0-11.31-2.32A.24.24,0,0,1,298.49,426.81Z" style="fill: rgb(38, 50, 56); transform-origin: 304.148px 428.068px;" id="elosmsh24itr" class="animable"></path><path d="M295.72,428.49c3.85-.73,8.55-.16,11.5,2.58.11.1,0,.26-.17.22A54.35,54.35,0,0,0,295.74,429,.24.24,0,0,1,295.72,428.49Z" style="fill: rgb(38, 50, 56); transform-origin: 301.37px 429.748px;" id="elytqmkpzfh5" class="animable"></path><path d="M298.65,420.05c2.72,2.1,6.26,3,9.44,4.12a.48.48,0,0,0,.6-.48.1.1,0,0,0,.09-.14,20.51,20.51,0,0,0-5.94-8.79c-1.61-1.34-4.43-2.27-5.93-.19S297.06,418.82,298.65,420.05Zm-1-3.1c-.69-4.21,3.84-2,5-1a21.25,21.25,0,0,1,2.05,2.19c1.33,1.6,2.42,3.35,3.58,5.06-1.53-.67-3.09-1.2-4.64-1.81C301.79,420.69,298,419.28,297.66,417Z" style="fill: rgb(38, 50, 56); transform-origin: 302.554px 418.767px;" id="elkw9ss6jfkbq" class="animable"></path><path d="M321.6,417.66c-.93-2.4-3.89-2.2-5.79-1.3a20.55,20.55,0,0,0-7.95,7,.11.11,0,0,0,.05.16.49.49,0,0,0,.47.62c3.37-.34,7-.28,10.17-1.64C320.4,421.73,322.49,419.92,321.6,417.66Zm-8.22,4.94c-1.65.21-3.31.33-4.95.6a60.21,60.21,0,0,1,4.73-4,21.7,21.7,0,0,1,2.53-1.62c1.37-.72,6.31-1.72,4.59,2.19C319.33,421.93,315.35,422.36,313.38,422.6Z" style="fill: rgb(38, 50, 56); transform-origin: 314.827px 419.938px;" id="elh6oecwh7gyp" class="animable"></path><path d="M355.55,227.05s-10.2,100.87-10.44,102.15c0,.16-2.11,76.78-2.11,76.78H305.24s-.05-63.43,1.51-78.39c2-19.08,13.42-100.54,13.42-100.54Z" style="fill: rgb(221, 106, 87); transform-origin: 330.395px 316.515px;" id="ellsopotgkfq" class="animable"></path><path d="M320.17,227.05h37.66l-5.94,66.05-43-1.07C312.5,263,320.17,227.05,320.17,227.05Z" style="fill: rgb(55, 71, 79); transform-origin: 333.36px 260.075px;" id="el3vzeewm1fnc" class="animable"></path><path d="M357.83,227.05l-5.94,66.05-9.26-.22c-6.71-29.16-16-65.83-16-65.83Z" style="fill: rgb(38, 50, 56); transform-origin: 342.23px 260.075px;" id="elx1kdwncgbam" class="animable"></path><path d="M311.51,284.74c1.1-.1,2.28,0,3.38,0,1.25,0,2.51,0,3.75,0q3.63,0,7.24.09c4.85.1,9.72.32,14.56.66l4,.29c1.42.11,2.85.3,4.27.34.11,0,.1.13,0,.13-2.44-.1-4.93,0-7.37,0s-4.82-.06-7.23-.12c-4.86-.12-9.73-.35-14.57-.71-1.33-.1-2.67-.17-4-.26L313.4,285c-.64,0-1.27,0-1.9-.13A.09.09,0,0,1,311.51,284.74Z" style="fill: rgb(38, 50, 56); transform-origin: 330.133px 285.473px;" id="elbtmww6qi6h" class="animable"></path><path d="M359.73,447.67c2.13.14,58.17-14.66,59.95-16.58.49-.52-3-16.77-5.18-26.08a7.47,7.47,0,0,0-5.44-5.86c-7.35-1.46-23.23,1.37-29.06,7.46-1.48,1.55-1.7,8.42-1.7,8.42l1.9,6.53s-18.92,15.27-20.64,17.57S357.6,447.53,359.73,447.67Z" style="fill: rgb(199, 199, 199); transform-origin: 388.964px 423.222px;" id="el069ii8hla2tx" class="animable"></path><path d="M359.58,447.79c2.14.14,58.49-14.74,60.29-16.67.82-.89-1.84-13-4.92-25.73L378.26,415l1.91,6.57s-19,15.35-20.76,17.67S357.43,447.65,359.58,447.79Z" style="fill: #FFA000; transform-origin: 389.025px 426.59px;" id="elpelkvebi2ah" class="animable"></path><path d="M359.79,445.32c9.38-2.72,47.5-12.84,57-14.82.08,0,.09,0,0,.06-9.25,2.91-47.44,12.71-57,14.92C359.63,445.53,359.59,445.38,359.79,445.32Z" style="fill: rgb(38, 50, 56); transform-origin: 388.254px 437.995px;" id="elgz6fxrky027" class="animable"></path><path d="M378.28,419.79c3.54-1.67,8.24-2.3,11.78-.41.13.08,0,.27-.1.27a53.73,53.73,0,0,0-11.54.61A.25.25,0,0,1,378.28,419.79Z" style="fill: rgb(38, 50, 56); transform-origin: 384.131px 419.242px;" id="elzqa517fnrzs" class="animable"></path><path d="M376,422.12c3.53-1.68,8.23-2.31,11.77-.41.14.07,0,.27-.1.26a54.32,54.32,0,0,0-11.53.61A.24.24,0,0,1,376,422.12Z" style="fill: rgb(38, 50, 56); transform-origin: 381.83px 421.567px;" id="elwt1h8ybp1ae" class="animable"></path><path d="M373.77,424.44c3.54-1.67,8.23-2.3,11.77-.4.14.07,0,.26-.1.26a53.67,53.67,0,0,0-11.53.61A.25.25,0,0,1,373.77,424.44Z" style="fill: rgb(38, 50, 56); transform-origin: 379.618px 423.893px;" id="el643kde5gy8o" class="animable"></path><path d="M371.52,426.77c3.53-1.68,8.23-2.31,11.77-.41.14.07,0,.27-.1.26a55,55,0,0,0-11.53.61A.24.24,0,0,1,371.52,426.77Z" style="fill: rgb(38, 50, 56); transform-origin: 377.35px 426.217px;" id="el6ijgf36j2if" class="animable"></path><path d="M372.21,417.86c3.17,1.35,6.82,1.28,10.19,1.61a.48.48,0,0,0,.46-.62.11.11,0,0,0,.05-.16,20.59,20.59,0,0,0-8-7c-1.89-.89-4.85-1.08-5.78,1.32S370.36,417.07,372.21,417.86Zm-1.73-2.74c-1.74-3.91,3.21-2.92,4.58-2.21a23,23,0,0,1,2.53,1.61c1.7,1.21,3.19,2.63,4.75,4-1.65-.26-3.3-.38-4.95-.58C375.42,417.69,371.43,417.27,370.48,415.12Z" style="fill: rgb(38, 50, 56); transform-origin: 375.917px 415.274px;" id="elrtq0li0e67" class="animable"></path><path d="M393.82,409.75c-1.51-2.08-4.32-1.14-5.93.21a20.5,20.5,0,0,0-5.92,8.8.11.11,0,0,0,.09.14.48.48,0,0,0,.61.48c3.17-1.17,6.71-2,9.43-4.15C393.69,414,395.25,411.72,393.82,409.75Zm-6.71,6.87c-1.54.61-3.11,1.15-4.64,1.82a61,61,0,0,1,3.58-5.07,22.23,22.23,0,0,1,2-2.2c1.15-1,5.68-3.25,5,1C392.71,414.46,389,415.88,387.11,416.62Z" style="fill: rgb(38, 50, 56); transform-origin: 388.174px 413.966px;" id="elto0tsykm5o" class="animable"></path><path d="M322.58,227.11s2.1,10.45,7.27,18.67c0,0,7.31,4.38,9.32,5.85,0,0,8.51,67.65,10.36,75a229.9,229.9,0,0,0,6.66,22.12L396,337.88s-4.4-14.34-7.16-22.88c-1.12-3.49-10-59.12-9.82-60.68,2.5-18.64-5.33-27.27-5.33-27.27Z" style="fill: rgb(221, 106, 87); transform-origin: 359.29px 287.9px;" id="el345kc9494rp" class="animable"></path><path d="M346.2,303.21c-.27-2.37-.57-4.73-.85-7.09-.57-4.65-1.08-9.33-1.75-14,0-.07-.14-.06-.13,0,.16,4.78.65,9.57,1.19,14.32q.39,3.47.9,6.92c.35,2.39.86,4.75,1.24,7.13,0,.1.17,0,.15,0C346.63,308.07,346.48,305.63,346.2,303.21Z" style="fill: rgb(38, 50, 56); transform-origin: 345.211px 296.303px;" id="elf18i9yhunt5" class="animable"></path><g id="elxf4jyhajvw"><rect x="382.16" y="352.22" width="7.86" height="49.98" style="fill: rgb(219, 219, 219); transform-origin: 386.09px 377.21px; transform: rotate(-16.28deg);" class="animable" id="elihui3rfra0p"></rect></g><path d="M375.24,364.92c-.34.38,3.38,4.32,4.5,4.51s5.92-.71,7.58-2c.8-.61,1.62-5.82,1.51-6.16S378.21,361.56,375.24,364.92Z" style="fill: rgb(199, 199, 199); transform-origin: 382.029px 365.322px;" id="eltmssmzxa6b8" class="animable"></path><path d="M400.16,400c.33-.39-3.44-4.27-4.56-4.44s-5.9.79-7.55,2.08c-.79.61-1.54,5.83-1.43,6.18S397.25,403.42,400.16,400Z" style="fill: rgb(199, 199, 199); transform-origin: 393.395px 399.719px;" id="elmek93mg6jw" class="animable"></path><path d="M354.14,343.25c-2.12,0,5.32,16.69,8.36,18.91,3.54,2.59,12.1,3.72,20.13,1.82,6.94-1.64,13.05-7.29,15.13-10.29s-2.24-23.1-3.05-22.48C391.19,333.9,380.73,342.89,354.14,343.25Z" style="fill: rgb(166, 166, 166); transform-origin: 376.043px 348.062px;" id="el6xlt5ioq25k" class="animable"></path><path d="M321.47,227.05h53.36A39.08,39.08,0,0,1,380,254.44s2.59,18.35,6.69,34.34L342.78,294l-4.95-43.37-9-5.24Z" style="fill: rgb(55, 71, 79); transform-origin: 354.08px 260.525px;" id="elg2v4pqtvjt5" class="animable"></path><path d="M352.78,230.82a16.52,16.52,0,0,0,6.07,8.7,20.48,20.48,0,0,0,11,3.78c.67,0,.73,1.06,0,1.06-8.08,0-16.25-5.11-17.43-13.49C352.42,230.68,352.73,230.64,352.78,230.82Z" style="fill: rgb(38, 50, 56); transform-origin: 361.398px 237.532px;" id="elwbgesbmxqr" class="animable"></path><path d="M328,244.41a38.6,38.6,0,0,1,7,3.72c2.32,1.44,4.48,3.13,6.72,4.69a.09.09,0,0,1-.08.15c-2.35-1.36-4.81-2.54-7.14-3.94a44.68,44.68,0,0,1-6.62-4.43A.12.12,0,0,1,328,244.41Z" style="fill: rgb(38, 50, 56); transform-origin: 334.8px 248.689px;" id="elwel4q03uszd" class="animable"></path><path d="M327,230.27c.36,1.55.82,3.09,1.22,4.63s.69,2.93,1.14,4.36a7.53,7.53,0,0,0,2.22,3.59c.6.5,1.25,1,1.88,1.41.35.25.71.48,1.07.73-.06-.2-.1-.41-.15-.62-.13-.59-.26-1.18-.38-1.77-.29-1.31-.56-2.62-.82-3.94-.52-2.58-1-5.19-1.66-7.74a.08.08,0,0,1,.16,0c.76,2.52,1.59,5,2.27,7.56.34,1.25,1.61,7.44,1.67,7.87s.13.91.17,1.37a5.48,5.48,0,0,1,.06,1.4c0,.11-.16.1-.21,0h0a5.64,5.64,0,0,1-.45-1.33c-.14-.44-.26-.89-.36-1.34,0-.16-.07-.33-.1-.49-.63-.35-1.22-.81-1.82-1.2s-1.28-.83-1.89-1.3a7,7,0,0,1-2.4-3.39,25.9,25.9,0,0,1-.94-4.45c-.28-1.76-.5-3.53-.83-5.28C326.81,230.21,327,230.16,327,230.27Z" style="fill: rgb(38, 50, 56); transform-origin: 331.357px 239.704px;" id="eloneagv54hmk" class="animable"></path><path d="M345.45,287c1.06-.27,2.25-.36,3.34-.53s2.48-.35,3.71-.54q3.57-.56,7.16-1c4.81-.65,9.65-1.19,14.49-1.61l4-.33c1.42-.11,2.85-.15,4.27-.32.1,0,.11.11,0,.12-2.43.28-4.87.79-7.28,1.17s-4.77.69-7.17,1c-4.81.63-9.65,1.16-14.49,1.55-1.33.11-2.66.25-4,.37l-2.13.16c-.64,0-1.26.16-1.9.16C345.35,287.14,345.35,287,345.45,287Z" style="fill: rgb(38, 50, 56); transform-origin: 363.937px 284.935px;" id="el8pme4df8gjn" class="animable"></path><path d="M309,179.29c.53.08,3,.47,6.6,1.06a20.58,20.58,0,0,0,3.77-11.88c0-1,1.53,4.83-.41,12.42,7,1.11,16.45,2.62,24.74,3.87.6-3.22,1.31-6.19,1.31-6.19a36.48,36.48,0,0,0,.49,6.47l3.32.49a127.47,127.47,0,0,1,2.49-13.73,44.55,44.55,0,0,0,2.23,14.41c5.27.73,8.75,1.12,8.56.84-6.74-10.24-.18-14.72-1.35-23.08-1.42-10-9.54-12.69-8.31-19.91,1-5.88,3.18-16.49-4-19.79a14.5,14.5,0,0,0-15.18-5.1c-12.39,2.92-10.2,21.75-11.51,25.34-1.86,5.14-4.63,6.66-7.32,12.44s-.52,10.27-.76,14.45S307.7,179.1,309,179.29Z" style="fill: rgb(38, 50, 56); transform-origin: 335.458px 152.91px;" id="ellxrimrqvgms" class="animable"></path><path d="M362.54,185.77a20.48,20.48,0,0,1-1.86-5.51,10.88,10.88,0,0,1,.77-5.54,58.26,58.26,0,0,0,1.76-5.7,15.37,15.37,0,0,0,.24-6.16A13.58,13.58,0,0,0,361,157.2a37.51,37.51,0,0,0-4-4.47,21.85,21.85,0,0,1-3.67-4.45,10.63,10.63,0,0,1-1.4-5.56,10,10,0,0,0,.76,5.89,20.35,20.35,0,0,0,3.45,4.92A43.56,43.56,0,0,1,359.8,158a12.82,12.82,0,0,1,2.12,5.11,15.4,15.4,0,0,1-.2,5.57c-.36,1.88-1,3.73-1.49,5.65a20.69,20.69,0,0,0-.6,3,8.88,8.88,0,0,0,.26,3.09A16.85,16.85,0,0,0,362.54,185.77Z" style="fill: rgb(38, 50, 56); transform-origin: 357.717px 164.245px;" id="elujr6myf8qrl" class="animable"></path><path d="M325.73,125a30,30,0,0,0-2.56,6.82c-.62,2.36-1.13,4.73-1.61,7.11l-.74,3.53a17.86,17.86,0,0,1-1,3.35,19.25,19.25,0,0,1-4,5.66,26.88,26.88,0,0,0-2.35,2.89,16.34,16.34,0,0,0-1.79,3.35,24.25,24.25,0,0,0-1,3.61,15.21,15.21,0,0,0-.3,3.75c.05,1.26.23,2.47.37,3.65a18.24,18.24,0,0,1,.08,3.54A7.43,7.43,0,0,1,307,178a7.54,7.54,0,0,0,4.47-5.6,18.51,18.51,0,0,0,.19-3.71c-.05-1.24-.19-2.43-.17-3.59a19.31,19.31,0,0,1,1.48-6.8,16.79,16.79,0,0,1,1.67-3,25.76,25.76,0,0,1,2.26-2.71c.8-.9,1.64-1.82,2.39-2.84a15.41,15.41,0,0,0,1.87-3.31,19.42,19.42,0,0,0,1-3.64c.23-1.2.42-2.4.6-3.6.38-2.39.72-4.78,1.16-7.15A35,35,0,0,1,325.73,125Z" style="fill: rgb(38, 50, 56); transform-origin: 316.365px 151.5px;" id="el0k8vnevz98u" class="animable"></path><path d="M338.78,169c-10,4.31-47.78,1.56-56.08-4.09-12.35-8.41-24.35-25.81-28.18-32.52-1.67-2.92,22.57-13.7,24.8-10.87,4.76,6,13,21.4,15.21,23s22.6,9.51,34,12.47C343.82,161,343.82,166.85,338.78,169Z" style="fill: rgb(221, 106, 87); transform-origin: 298.112px 146.081px;" id="elpmwkbjj164n" class="animable"></path><path d="M259.8,140.6c-1.17-1.21-11.3-10-14.18-16.82-1.52-3.6-4.59-14-2.51-15.18,1.89-1.1,3.43,1.54,3.43,1.54s-1.3-4.65,1.36-6.14,5,3.09,5,3.09-1-4.87,1.76-6.17,4.36,3.71,4.36,3.71-1.11-4.41,1.61-4.52c3.27-.14,4.4,8.22,6.76,11.85.54.82,12.06,15.93,12.06,15.93Z" style="fill: rgb(221, 106, 87); transform-origin: 260.93px 120.354px;" id="elvwich6rlu1" class="animable"></path><path d="M259.22,104.67c.84,6.14,2.27,8.69,6.2,13.36.08.09,0,.23-.13.14-4.26-4.23-6.52-7.16-6.37-13.48C258.92,104.38,259.18,104.37,259.22,104.67Z" style="fill: rgb(38, 50, 56); transform-origin: 262.182px 111.325px;" id="eluqlzobewobh" class="animable"></path><path d="M253.1,107.1c1.43,6.31,3,9.08,6.72,14.28.05.07-.07.17-.13.1-4.11-4.79-6.3-7.76-6.9-14.25C252.76,106.93,253,106.81,253.1,107.1Z" style="fill: rgb(38, 50, 56); transform-origin: 256.31px 114.219px;" id="elj8kmowcgkge" class="animable"></path><path d="M246.73,110.38c1.83,6,3.38,9.12,7.68,13.7.1.11,0,.27-.16.17-4.84-4.24-6.8-8.11-7.69-13.79C246.5,110.07,246.62,110,246.73,110.38Z" style="fill: rgb(38, 50, 56); transform-origin: 250.497px 117.205px;" id="el54t3157qxva" class="animable"></path><path d="M275.74,102.56c-6.48,16.77-18.41,17.08-21.47,21.21a85.65,85.65,0,0,0-4.59,8.25l-18.07-4.66a80.6,80.6,0,0,0,0-9.44c-.66-5.09-11-11.14-8.5-29,1.6-11.7,14.78-27.44,33.9-22.5S280,91.54,275.74,102.56Z" style="fill: #FFA000; transform-origin: 250.013px 98.7538px;" id="el4in38wfqle7" class="animable"></path><g id="el1zlh9gyatpp"><rect x="221.84" y="114.16" width="30.19" height="1" style="fill: rgb(255, 255, 255); transform-origin: 236.935px 114.66px; transform: rotate(-86.08deg);" class="animable" id="els8imdq7jx8"></rect></g><g id="elriiy9l4tq7j"><rect x="236.08" y="117.84" width="30.19" height="1" style="fill: rgb(255, 255, 255); transform-origin: 251.175px 118.34px; transform: rotate(-64.99deg);" class="animable" id="elnjsomsm0x5"></rect></g><path d="M246,111.79a3,3,0,0,1-.72-.09c-1.63-.42-2.74-2.31-3.31-4.51a2.24,2.24,0,0,1-1.76.43c-2.71-.71-2.36-6.57-2.34-6.82l.5,0c0,.06-.35,5.7,2,6.3a1.86,1.86,0,0,0,1.51-.48,12.63,12.63,0,0,1,0-5.44c.41-1.57,1.23-2.32,2.27-2.06,1.2.31,1.64,1.45,1.2,3.12a9.71,9.71,0,0,1-2.89,4.6c.5,2.12,1.51,4,3,4.34,1.12.29,2.47-.3,3.81-1.66l.33-.35a7.69,7.69,0,0,1-.41-5.26c.52-2,1.6-3.07,2.82-2.76a1.35,1.35,0,0,1,1,1c.45,1.6-.85,4.8-2.79,7.08a2.71,2.71,0,0,0,1.62,1.2c1.67.44,4.12-3.14,4.94-4.55l.43.25c-.13.22-3.16,5.39-5.5,4.79a3.18,3.18,0,0,1-1.82-1.31l-.24.25A5.43,5.43,0,0,1,246,111.79Zm5.54-10.16c-.95,0-1.62,1.26-1.93,2.43a7.64,7.64,0,0,0,.27,4.74c1.75-2.14,2.95-5.08,2.56-6.48a.83.83,0,0,0-.61-.65A1,1,0,0,0,251.56,101.63Zm-7.83-2c-.82,0-1.22,1.06-1.39,1.73a11.94,11.94,0,0,0,0,5,9.41,9.41,0,0,0,2.53-4.15c.25-1,.31-2.2-.85-2.5A.82.82,0,0,0,243.73,99.6Z" style="fill: rgb(255, 255, 255); transform-origin: 247.527px 105.43px;" id="el02ilftgptmcq" class="animable"></path><g id="elvaplkgsnf3"><rect x="228.78" y="128.84" width="23.02" height="4.5" style="fill: rgb(38, 50, 56); transform-origin: 240.29px 131.09px; transform: rotate(14.48deg);" class="animable" id="elxhzb48e690f"></rect></g><g id="elacwdzv7gxw5"><rect x="227.47" y="133.91" width="23.02" height="4.5" style="fill: rgb(38, 50, 56); transform-origin: 238.98px 136.16px; transform: rotate(14.48deg);" class="animable" id="elevshen21fqc"></rect></g><g id="elbw23uw6yrno"><rect x="226.16" y="138.97" width="23.02" height="4.5" style="fill: rgb(38, 50, 56); transform-origin: 237.67px 141.22px; transform: rotate(14.48deg);" class="animable" id="elimtrkhreget"></rect></g><path d="M284.36,129s-2.07-7.49-3.71-10.58-12-12.37-14.1-10.26c-2.75,2.74,2.16,9.27,5,12.16,0,0-6.37,6.32-3.86,11.77S284.36,129,284.36,129Z" style="fill: rgb(221, 106, 87); transform-origin: 275.05px 120.88px;" id="elt5rp1iihzdo" class="animable"></path><path d="M266,109.15c-.71,4.31,3.24,7.86,5.77,10.86a.36.36,0,0,1-.13.58c-2.49,2.82-5.18,7.54-4.24,11.4a.09.09,0,1,1-.17.06c-1.58-4,.69-8.85,3.62-11.78-2.64-3-6.45-6.77-4.89-11.12C266,109.12,266.05,109.13,266,109.15Z" style="fill: rgb(38, 50, 56); transform-origin: 268.732px 120.621px;" id="el2fj597u0o6r" class="animable"></path><path d="M250.28,58.53a14.09,14.09,0,0,1,0-7.44,14.09,14.09,0,0,1,0,7.44Z" style="fill: rgb(38, 50, 56); transform-origin: 250.28px 54.81px;" id="elq1y7b4g1sqk" class="animable"></path><path d="M233.21,63a12.3,12.3,0,0,1-2.29-3,12.51,12.51,0,0,1-1.43-3.47,12.3,12.3,0,0,1,2.29,3A12.51,12.51,0,0,1,233.21,63Z" style="fill: rgb(38, 50, 56); transform-origin: 231.35px 59.765px;" id="ela592oa2qsfk" class="animable"></path><path d="M220.64,75.32a12.51,12.51,0,0,1-3.47-1.43,12.3,12.3,0,0,1-3-2.29A12.21,12.21,0,0,1,217.67,73,12.7,12.7,0,0,1,220.64,75.32Z" style="fill: rgb(38, 50, 56); transform-origin: 217.405px 73.46px;" id="eldj8ex0d86p5" class="animable"></path><path d="M215.94,92.31a12.54,12.54,0,0,1-3.72.5,12.22,12.22,0,0,1-3.72-.5,14.09,14.09,0,0,1,7.44,0Z" style="fill: rgb(38, 50, 56); transform-origin: 212.22px 92.3113px;" id="elw3wgdgamtd" class="animable"></path><path d="M220.36,109.38a12.3,12.3,0,0,1-3,2.29,12.51,12.51,0,0,1-3.47,1.43,12.7,12.7,0,0,1,3-2.29A12.51,12.51,0,0,1,220.36,109.38Z" style="fill: rgb(38, 50, 56); transform-origin: 217.125px 111.24px;" id="elo0iqbw4rumh" class="animable"></path><path d="M279.36,109.86a12.51,12.51,0,0,1,3.47,1.43,12.05,12.05,0,0,1,3,2.29,12.51,12.51,0,0,1-3.47-1.43A12.7,12.7,0,0,1,279.36,109.86Z" style="fill: rgb(38, 50, 56); transform-origin: 282.595px 111.72px;" id="elvo2e05yhfbr" class="animable"></path><path d="M284.06,92.86a14.09,14.09,0,0,1,7.44,0,14.09,14.09,0,0,1-7.44,0Z" style="fill: rgb(38, 50, 56); transform-origin: 287.78px 92.86px;" id="elqhdikhyw1jp" class="animable"></path><path d="M279.64,75.8a13.92,13.92,0,0,1,6.44-3.72,12.7,12.7,0,0,1-3,2.29A12.51,12.51,0,0,1,279.64,75.8Z" style="fill: rgb(38, 50, 56); transform-origin: 282.86px 73.94px;" id="eltiavb1nnjp8" class="animable"></path><path d="M267.27,63.23a12.51,12.51,0,0,1,1.43-3.47,12.3,12.3,0,0,1,2.29-3,12.51,12.51,0,0,1-1.43,3.47A12.7,12.7,0,0,1,267.27,63.23Z" style="fill: rgb(38, 50, 56); transform-origin: 269.13px 59.995px;" id="elhhhgclbrzl" class="animable"></path><path d="M262.31,148.21c.36-.48,23.17-19.24,23.17-19.24s6.85,12.47,9.23,14.67S326.24,156,336.2,159c10.66,3.25,9.78,12-7.47,12.63s-37.57-1.21-45.12-5.16C276.31,162.64,262.31,148.21,262.31,148.21Z" style="fill: rgb(199, 199, 199); transform-origin: 302.739px 150.361px;" id="eltxrrpc7hui" class="animable"></path><path d="M267.43,149.87c9-6,17.48-13.72,19.06-15,.08-.06,0-.17-.1-.11-1.48,1.29-12.16,9-19.07,14.95C267.24,149.82,267.35,149.93,267.43,149.87Z" style="fill: rgb(38, 50, 56); transform-origin: 276.907px 142.315px;" id="elzm2ahuehsf" class="animable"></path><path d="M319.63,203.19l-2.95,29.27s47.42-1.39,59.15-2.74c0,0-12-53.94-25.25-67.12-6.63-6.59-14-5.75-18.56-.74-1.14,1.27-14.6,20.79-15.79,28.08C315.2,196.36,319.63,203.19,319.63,203.19Z" style="fill: rgb(199, 199, 199); transform-origin: 345.952px 195.17px;" id="elsj1vncqkjgr" class="animable"></path><path d="M355.63,168c16.29,20.32,27.69,60.7,18.78,63.65-8.14,2.7-32.77-2.49-42.8-5.79-2.94-1,5.06-23.75,8.22-22.72,3.8,1.25,13.62,3.51,14,3.52.86,0-6.12-26.81-8.2-37.06C342.76,155.29,349.51,160.33,355.63,168Z" style="fill: rgb(221, 106, 87); transform-origin: 354.251px 196.455px;" id="elsvckn48zy9f" class="animable"></path><path d="M309.3,195.15a3.69,3.69,0,0,0,0,4.22,5.46,5.46,0,0,0-2.84,2.42c-1,2,1.68,4.5,1.68,4.5a6.72,6.72,0,0,0-2.59,3c-.78,2,1.59,4.92,1.59,4.92a5.94,5.94,0,0,0-.6,4.09c.95,3.69,6.49,5.45,10,6.6s14.55,1.14,16.65,1.35l7.6-22.47s-14.27-9.65-18.59-10.42C318.52,192.74,311.06,192.87,309.3,195.15Z" style="fill: rgb(221, 106, 87); transform-origin: 323.091px 209.646px;" id="elke46e933bsg" class="animable"></path><path d="M309.54,199.06c4-.24,7.92.73,11.85,1.48.09,0,.06.15,0,.13-3.9-.78-7.91-.79-11.84-1.42C309.41,199.24,309.43,199.07,309.54,199.06Z" style="fill: rgb(38, 50, 56); transform-origin: 315.449px 199.847px;" id="elgo5nx5swl9n" class="animable"></path><path d="M308.27,206a10.47,10.47,0,0,1,2.72.46c.95.23,1.89.48,2.83.74,1.89.52,3.76,1.08,5.62,1.7.08,0,.06.16,0,.14-1.88-.52-3.77-1-5.67-1.44l-2.85-.64a12.21,12.21,0,0,1-2.67-.7A.14.14,0,0,1,308.27,206Z" style="fill: rgb(38, 50, 56); transform-origin: 313.832px 207.521px;" id="eliols3zmvk6p" class="animable"></path><path d="M307.18,214.26a7.34,7.34,0,0,1,2.42.55l2.57.75c1.71.49,3.42,1,5.15,1.41a.07.07,0,0,1,0,.14c-1.76-.43-3.52-.84-5.27-1.28l-2.59-.67a7.21,7.21,0,0,1-2.28-.81A.05.05,0,0,1,307.18,214.26Z" style="fill: rgb(38, 50, 56); transform-origin: 312.271px 215.685px;" id="elp3445orv72" class="animable"></path><path d="M353,205.79c1.31-.94-6.39-26.29-8.11-37.68s3.38-10.34,10.8-.66c7.95,10.37,20.73,32.9,22.21,55.13.46,6.95,1.44,12-14.39,10.35a182.21,182.21,0,0,1-27.32-4.71l5.56-24.79S352.62,206.06,353,205.79Z" style="fill: rgb(199, 199, 199); transform-origin: 357.145px 196.561px;" id="elr7fauhp4op7" class="animable"></path><path d="M341.8,228.48c2.86-9.75,4.39-20.43,4.79-22.27,0-.09-.12-.11-.14,0-.29,1.83-3.36,13.85-4.8,22.27A.08.08,0,1,0,341.8,228.48Z" style="fill: rgb(38, 50, 56); transform-origin: 344.117px 217.361px;" id="el4lr0y4ih4oo" class="animable"></path><path d="M364.89,208.76a19.86,19.86,0,0,0-2.94-.87l-2.75-.74-1.19-.31h.11l1.64-.09c.55,0,1.1-.11,1.64-.11.09,0,.1-.14,0-.14-.54,0-1.09,0-1.63,0s-1.13,0-1.69,0-1,0-1.49,0c-.89-.23-1.78-.45-2.67-.65-.25-1.81-.72-3.63-1.12-5.41s-.86-3.73-1.33-5.58-1-3.63-1.49-5.43c-.27-.9-1.65-6.41-2.13-7.86,0-.09-.14-.06-.12.05.23,1.44,1.63,7.1,1.83,8,.14.67.29,1.33.44,2l-.07-.1c-.32-.52-.65-1-1-1.54-.65-1.05-1.29-2.1-1.83-3.2a.08.08,0,0,0-.15.07c.51,1.14,1,2.29,1.53,3.42.28.55.56,1.11.87,1.65a8.3,8.3,0,0,0,1,1.54h0l.36,1.64c.41,1.83.83,3.66,1.24,5.49.37,1.67.67,3.39,1.11,5-1.83-.4-3.66-.77-5.49-1.16l-2.81-.57c-1-.2-2.06-.28-3.05-.55-.09,0-.13.12,0,.14,1,.19,2,.58,2.94.84l2.76.73c1.95.5,3.89,1,5.84,1.49s3.88.85,5.82,1.24l2.92.57a19.75,19.75,0,0,0,2.85.49A0,0,0,0,0,364.89,208.76Z" style="fill: rgb(38, 50, 56); transform-origin: 353.258px 195.164px;" id="elml6spn54e1g" class="animable"></path><path d="M367.24,233.25c-8.53-1-23.81-3.47-30.86-5-.09,0-.12.11,0,.14a123.16,123.16,0,0,0,30.86,5.22A.17.17,0,0,0,367.24,233.25Z" style="fill: rgb(38, 50, 56); transform-origin: 351.86px 230.93px;" id="elcyy4itueel6" class="animable"></path><path d="M340.75,158c-5.37,1.11-12,8.67-11.25,10s5.16-1,5.16-1-.43,3.6,1.76,4.16,6.64-3.38,8.13-6.59C346.79,159.74,345.31,157,340.75,158Z" style="fill: rgb(255, 255, 255); transform-origin: 337.511px 164.504px;" id="elbegzj801r6q" class="animable"></path><path d="M344.83,160.67c-.36.89-5.67,6.2-9.85,5.37-1.36-.28-.2-7.78-.2-7.78l0-.57-.56-8,10-4.47,1.44-.58s0,2.21,0,5V150c0,.15,0,.3,0,.45,0,.41,0,.83,0,1.24s0,.63,0,1l0,1A52.44,52.44,0,0,1,344.83,160.67Z" style="fill: rgb(221, 106, 87); transform-origin: 339.94px 155.384px;" id="elnohetu0ndy" class="animable"></path><path d="M345.62,149.57a16.17,16.17,0,0,1-10.88,8.12l-.56-8,10-4.47,1.44-.58S345.64,146.82,345.62,149.57Z" style="fill: rgb(38, 50, 56); transform-origin: 339.904px 151.165px;" id="elqt6h34negym" class="animable"></path><path d="M324.25,137.64c-1.42,14.05,6.83,16.49,9.86,16.79,2.75.28,12.16.86,15-13s-3.22-18.93-9.48-19.89S325.67,123.58,324.25,137.64Z" style="fill: rgb(221, 106, 87); transform-origin: 336.959px 137.952px;" id="elb55nniemp0c" class="animable"></path><path d="M326.72,134a8,8,0,0,0,1-.1,1.54,1.54,0,0,0,1-.29.52.52,0,0,0,.07-.61,1.28,1.28,0,0,0-1.2-.42,1.86,1.86,0,0,0-1.21.53A.54.54,0,0,0,326.72,134Z" style="fill: rgb(38, 50, 56); transform-origin: 327.553px 133.279px;" id="el21wk0zdzhr1" class="animable"></path><path d="M335.94,135a7.21,7.21,0,0,1-.93-.3,1.56,1.56,0,0,1-.89-.48.5.5,0,0,1,.06-.61,1.25,1.25,0,0,1,1.25-.17,1.87,1.87,0,0,1,1.08.76A.54.54,0,0,1,335.94,135Z" style="fill: rgb(38, 50, 56); transform-origin: 335.313px 134.177px;" id="ele1woiyhags" class="animable"></path><path d="M333.71,138.31s.06.06.06.1c-.15,1-.16,2.06.66,2.49,0,0,0,.06,0,0C333.38,140.67,333.41,139.19,333.71,138.31Z" style="fill: rgb(38, 50, 56); transform-origin: 333.979px 139.618px;" id="elkb3oo5eqo5e" class="animable"></path><path d="M334.68,137.42c1.55.08,1.29,3.17-.15,3.1S333.38,137.36,334.68,137.42Z" style="fill: rgb(38, 50, 56); transform-origin: 334.651px 138.97px;" id="elmybzqk15z2k" class="animable"></path><path d="M335.28,137.64c.25.2.49.53.81.59s.69-.23,1-.52c0,0,.05,0,.05,0,0,.59-.32,1.18-1,1.21s-1-.53-1.06-1.13C335.06,137.71,335.17,137.56,335.28,137.64Z" style="fill: rgb(38, 50, 56); transform-origin: 336.109px 138.269px;" id="ely6dbtfbjmnd" class="animable"></path><path d="M328.21,137.65s-.08,0-.08.08c0,1-.26,2.06-1.15,2.31,0,0,0,.05,0,.05C328.06,140,328.32,138.57,328.21,137.65Z" style="fill: rgb(38, 50, 56); transform-origin: 327.607px 138.87px;" id="elghceqk39h8" class="animable"></path><path d="M327.43,136.59c-1.53-.24-1.89,2.84-.47,3.06S328.72,136.79,327.43,136.59Z" style="fill: rgb(38, 50, 56); transform-origin: 327.15px 138.119px;" id="elwcj5wl33pom" class="animable"></path><path d="M326.77,136.71c-.27.14-.54.41-.84.39s-.55-.38-.72-.72c0,0,0,0-.06,0-.08.59,0,1.23.59,1.41s.95-.3,1.16-.87C326.94,136.84,326.87,136.66,326.77,136.71Z" style="fill: rgb(38, 50, 56); transform-origin: 326.018px 137.104px;" id="eloik7wvs3qv" class="animable"></path><path d="M333.13,146c-.24.21-.48.51-.83.53a2.64,2.64,0,0,1-1-.28,0,0,0,0,0,0,0,1.3,1.3,0,0,0,1.2.57,1,1,0,0,0,.79-.81C333.24,145.94,333.17,145.92,333.13,146Z" style="fill: rgb(38, 50, 56); transform-origin: 332.295px 146.387px;" id="el2pcb5pxi3ou" class="animable"></path><path d="M329.47,142.1a20.89,20.89,0,0,0-.4,2.08c0,.06.15.11.38.15h0a3.22,3.22,0,0,0,3.23-.89c.06-.06,0-.14-.09-.11a4.86,4.86,0,0,1-3,.56c0-.2.66-2.4.56-2.42a5.63,5.63,0,0,0-1.57.2c.62-3,1.71-5.79,2.28-8.75a.1.1,0,0,0-.18-.06,49.84,49.84,0,0,0-2.85,9.32C327.75,142.56,329.19,142.19,329.47,142.1Z" style="fill: rgb(38, 50, 56); transform-origin: 330.265px 138.637px;" id="elsmhwstafb5r" class="animable"></path><path d="M329.5,143.87a4,4,0,0,0,1.29,1.51,1.78,1.78,0,0,0,1,.29c.8,0,1-.74.95-1.36a4.2,4.2,0,0,0-.15-1A5.09,5.09,0,0,1,329.5,143.87Z" style="fill: rgb(38, 50, 56); transform-origin: 331.124px 144.49px;" id="elhtyjp841tyr" class="animable"></path><path d="M330.79,145.38a1.78,1.78,0,0,0,1,.29c.8,0,1-.74.95-1.36A1.83,1.83,0,0,0,330.79,145.38Z" style="fill: rgb(255, 155, 188); transform-origin: 331.769px 144.98px;" id="elrlx3q8h7daj" class="animable"></path><path d="M348.4,142.09c-3.63-.27-4.25-11.48-4.32-12.86,0,.87-.05,5.48-.41,5.65a3.49,3.49,0,0,1-1.13-.26h0a10.27,10.27,0,0,0-.07-1.65c0-.26-.12.55-.29,1.53l-.67-.21a13.23,13.23,0,0,0-.21-3.51c-.09-.44-.28,1.51-.76,3.2a44.59,44.59,0,0,0-9.45-2c-.91-.06-1.69-.08-2.38-.08.05-1.35.26-2.79.15-2.49a13.39,13.39,0,0,0-.67,2.5l-1,0c0-1.92,1-4.94.68-4.49a13.44,13.44,0,0,0-2,4.65c-1.32.21-1.69.45-1.72.11a16.09,16.09,0,0,1,5.25-9.73c4.7-4.1,13.81-4.83,18.66,2,0,0,4.1,2.91,4.6,7.36S350.5,142.24,348.4,142.09Z" style="fill: rgb(38, 50, 56); transform-origin: 338.436px 130.715px;" id="el23ns4wigmmb" class="animable"></path><path d="M346.79,142.32s3.14-4.37,5.13-3.24-.42,7.48-2.79,8.33a2.39,2.39,0,0,1-3.18-1.33Z" style="fill: rgb(221, 106, 87); transform-origin: 349.304px 143.25px;" id="el0sp2phyl8o9" class="animable"></path><path d="M351.18,140.88a0,0,0,0,1,0,.07,6,6,0,0,0-3.18,3.73,1.32,1.32,0,0,1,2-.33s0,.1-.05.09a1.45,1.45,0,0,0-1.62.48,6.64,6.64,0,0,0-.79,1.3c-.08.15-.35.07-.29-.1v0C347.25,144,348.93,141.06,351.18,140.88Z" style="fill: rgb(38, 50, 56); transform-origin: 349.211px 143.59px;" id="elh717jpdv1zv" class="animable"></path></g><g id="freepik--character-1--inject-24" class="animable" style="transform-origin: 185.118px 283.65px;"><path d="M218.82,446.22c-2.06.67-60.91-.09-63.13-1.55-.85-.53-1.24-9.11-1.41-19.5v-.32c0-2.14-.07-4.34-.07-6.58,0-.3,0-.61,0-.92-.09-15,.15-30.52.15-30.52l39.36.39-1.18,30.24-.05,1.2-.23,6.26,0,.64s22.4,10.37,24.67,12.22S220.89,445.57,218.82,446.22Z" style="fill: rgb(235, 148, 129); transform-origin: 186.973px 416.648px;" id="elg37dnflk3d" class="animable"></path><path d="M218.82,446.22c-2.06.67-60.91-.09-63.13-1.55-.85-.53-1.24-9.11-1.41-19.5v-.32c0-2.14-.07-4.34-.07-6.58,0-.3,0-.61,0-.92l38.33.11-.05,1.2-.23,6.26,0,.64s22.4,10.37,24.67,12.22S220.89,445.57,218.82,446.22Z" style="fill: rgb(235, 235, 235); transform-origin: 186.983px 431.908px;" id="elddkg6tzszr9" class="animable"></path><path d="M218.82,446.22c-1.27.42-24.07.28-41.92-.22-11.14-.31-20.35-.77-21.2-1.32s-1.24-8.88-1.41-19.07c0-.14,0-.29,0-.43s0-.23,0-.33l38,.07,0,.65s22.4,10.36,24.67,12.21S220.89,445.57,218.82,446.22Z" style="fill: #FFA000; transform-origin: 187.027px 435.659px;" id="elcqwsao6q7cj" class="animable"></path><path d="M218.19,443.93c-9.92-.37-49.95-.93-59.78-.55-.08,0-.08.06,0,.06,9.82.59,49.85.83,59.77.66C218.39,444.09,218.4,443.94,218.19,443.93Z" style="fill: rgb(38, 50, 56); transform-origin: 188.346px 443.703px;" id="el1ioe4w1ov0t" class="animable"></path><path d="M196.47,425.08c-3.89-.78-8.68-.24-11.69,2.5-.12.11,0,.27.16.23a55.54,55.54,0,0,1,11.51-2.24A.25.25,0,0,0,196.47,425.08Z" style="fill: rgb(38, 50, 56); transform-origin: 190.696px 426.285px;" id="el72zhlhc0pkl" class="animable"></path><path d="M199.27,426.81c-3.9-.77-8.68-.24-11.7,2.51-.12.1,0,.27.16.23a54.38,54.38,0,0,1,11.51-2.24A.25.25,0,0,0,199.27,426.81Z" style="fill: rgb(38, 50, 56); transform-origin: 193.513px 428.022px;" id="eld0fwm2d03p" class="animable"></path><path d="M202.06,428.55c-3.89-.78-8.67-.24-11.69,2.5-.12.11,0,.27.16.23A55.54,55.54,0,0,1,202,429,.25.25,0,0,0,202.06,428.55Z" style="fill: rgb(38, 50, 56); transform-origin: 196.249px 429.755px;" id="el3zt4we6lqf4" class="animable"></path><path d="M201.66,416.63c-1.51-2.13-4.38-1.22-6,.13a20.85,20.85,0,0,0-6.12,8.86c0,.08,0,.13.09.15a.48.48,0,0,0,.6.49c3.24-1.15,6.85-2,9.64-4.09C201.46,420.94,203.08,418.65,201.66,416.63Zm-6.9,6.88c-1.58.61-3.18,1.13-4.74,1.79,1.2-1.72,2.32-3.49,3.69-5.09a23.12,23.12,0,0,1,2.1-2.21c1.18-1,5.8-3.23,5.06,1C200.46,421.4,196.64,422.79,194.76,423.51Z" style="fill: rgb(38, 50, 56); transform-origin: 195.873px 420.819px;" id="elwrmofj0gtjm" class="animable"></path><path d="M179.6,424.48c3.2,1.41,6.9,1.39,10.31,1.76a.48.48,0,0,0,.48-.62.11.11,0,0,0,.06-.16,20.92,20.92,0,0,0-8-7.21c-1.91-.94-4.91-1.16-5.89,1.26S177.73,423.65,179.6,424.48Zm-1.73-2.81c-1.7-4,3.3-2.92,4.69-2.18a23.27,23.27,0,0,1,2.55,1.67,62,62,0,0,1,4.76,4.11c-1.67-.29-3.34-.43-5-.66C182.85,424.35,178.81,423.87,177.87,421.67Z" style="fill: rgb(38, 50, 56); transform-origin: 183.39px 421.915px;" id="elmcrufzuvun" class="animable"></path><path d="M176.9,446c-11.14-.31-20.35-.77-21.2-1.32s-1.24-8.88-1.41-19.07C158.86,429.69,170.21,439.81,176.9,446Z" style="fill: rgb(38, 50, 56); transform-origin: 165.595px 435.805px;" id="el9jj5zpf1g5u" class="animable"></path><path d="M142.27,217.32s8.84,99.43,10.28,107c.33,1.73.54,11.13.67,23.21.31,26.35.13,73.89.13,73.89h41.48s-1.23-82.36-3.07-97.52-13.58-106.6-13.58-106.6Z" style="fill: rgb(69, 90, 100); transform-origin: 168.55px 319.36px;" id="elhfz0g8sz1i4" class="animable"></path><path d="M193,414.22c-6.47-.14-4.61-.19-11.08-.25-3.17,0-24-.21-27,.28-.06,0-.06.12,0,.13,3,.49,23.78.31,27,.28,6.47-.07,4.61-.12,11.08-.25A.1.1,0,0,0,193,414.22Z" style="fill: rgb(38, 50, 56); transform-origin: 173.972px 414.321px;" id="elasssly6v1ub" class="animable"></path><path d="M161.23,367.13q-.07-9-.14-18.05c0-5.82,0-11.66-.31-17.48-.56-11.79-2.95-23.38-4.65-35s-3.12-23.36-4.41-35.08c-1.44-13.14-2.71-26.3-4.06-39.45,0-.09-.15-.09-.14,0,1.95,23.48,4.13,46.95,7.38,70.29q1.22,8.71,2.65,17.39c1,5.85,1.93,11.71,2.4,17.63s.52,11.61.58,17.41l.18,18c.13,13.36.26,33.91.39,47.27a.2.2,0,0,0,.4,0C161.41,398.16,161.32,379,161.23,367.13Z" style="fill: rgb(38, 50, 56); transform-origin: 154.51px 316.131px;" id="el9pyvnge9h4w" class="animable"></path><path d="M133.53,217.32s17.58,99.43,19,107c.33,1.73.54,11.13.67,23.21v0L173,217.32Z" style="fill: rgb(38, 50, 56); transform-origin: 153.265px 282.425px;" id="elpwmbkqnzor" class="animable"></path><path d="M170.65,449.73c-2.1.52-60.74-4.41-62.86-6-.81-.59-.59-9.18,0-19.55,0-.11,0-.21,0-.32.11-2.14.24-4.34.39-6.57,0-.3,0-.61,0-.92,1-15,2.32-30.43,2.32-30.43l39.24,3.18-3.33,30.08-.13,1.19-.68,6.23-.06.64s21.6,11.92,23.74,13.93S172.76,449.22,170.65,449.73Z" style="fill: rgb(235, 148, 129); transform-origin: 139.487px 417.854px;" id="elc7hsjzupiwe" class="animable"></path><path d="M170.65,449.73c-2.1.52-60.74-4.41-62.86-6-.81-.59-.59-9.18,0-19.55,0-.11,0-.21,0-.32.11-2.14.24-4.34.39-6.57,0-.3,0-.61,0-.92l38.23,2.83-.13,1.19-.68,6.23-.06.64s21.6,11.92,23.74,13.93S172.76,449.22,170.65,449.73Z" style="fill: rgb(235, 235, 235); transform-origin: 139.487px 433.069px;" id="eltp1ip437oqp" class="animable"></path><path d="M170.65,449.73c-2.1.52-60.74-4.41-62.86-6-.81-.59-.59-9.18,0-19.55,0-.11,0-.21,0-.32l37.86,2.76-.06.64s21.6,11.92,23.74,13.93S172.76,449.22,170.65,449.73Z" style="fill: #FFA000; transform-origin: 139.494px 436.814px;" id="ely0jyuupw0db" class="animable"></path><path d="M170.18,447.4c-9.86-1.07-49.75-4.47-59.59-4.78-.08,0-.08.05,0,.06,9.75,1.28,49.67,4.35,59.58,4.88C170.38,447.58,170.39,447.42,170.18,447.4Z" style="fill: rgb(38, 50, 56); transform-origin: 140.431px 445.091px;" id="el4rhanroulj5" class="animable"></path><path d="M149.86,427.06c-3.83-1.06-8.64-.86-11.85,1.66-.12.1,0,.28.15.25a54.26,54.26,0,0,1,11.64-1.42A.25.25,0,0,0,149.86,427.06Z" style="fill: rgb(38, 50, 56); transform-origin: 144.001px 427.714px;" id="el9hs83zo7o9k" class="animable"></path><path d="M152.52,429c-3.83-1.06-8.63-.86-11.84,1.66-.12.1,0,.27.15.25a54.19,54.19,0,0,1,11.64-1.42A.25.25,0,0,0,152.52,429Z" style="fill: rgb(38, 50, 56); transform-origin: 146.667px 429.653px;" id="el99h5oh8ihrj" class="animable"></path><path d="M155.19,430.91c-3.83-1.05-8.64-.85-11.84,1.67-.13.1,0,.27.14.24a55.56,55.56,0,0,1,11.64-1.42A.25.25,0,0,0,155.19,430.91Z" style="fill: rgb(38, 50, 56); transform-origin: 149.333px 431.568px;" id="elas1xaggbmdd" class="animable"></path><path d="M155.63,419c-1.35-2.24-4.28-1.53-6-.3a20.88,20.88,0,0,0-6.74,8.41.11.11,0,0,0,.08.15c0,.29.23.63.57.53,3.31-.92,7-1.49,9.9-3.4C155.13,423.28,156.91,421.11,155.63,419Zm-7.37,6.37c-1.62.49-3.25.9-4.85,1.45,1.32-1.63,2.56-3.32,4-4.82A21.79,21.79,0,0,1,149.7,420c1.25-1,6-2.82,5,1.39C154.1,423.67,150.19,424.79,148.26,425.37Z" style="fill: rgb(38, 50, 56); transform-origin: 149.474px 422.676px;" id="el1k25jruqivk" class="animable"></path><path d="M133.07,425.26c3.09,1.64,6.78,1.88,10.17,2.49.35.07.55-.29.51-.58a.11.11,0,0,0,.07-.16,20.91,20.91,0,0,0-7.47-7.76c-1.84-1.07-4.82-1.51-6,.84S131.27,424.31,133.07,425.26Zm-1.52-2.92c-1.42-4.1,3.5-2.68,4.82-1.84a22.8,22.8,0,0,1,2.43,1.84,62.27,62.27,0,0,1,4.46,4.44c-1.64-.41-3.3-.67-5-1C136.33,425.36,132.33,424.6,131.55,422.34Z" style="fill: rgb(38, 50, 56); transform-origin: 136.92px 423.071px;" id="elv75a982dx6" class="animable"></path><path d="M147.35,423.68l-41.45-1.75S117.22,331,117.43,325.4c.54-14.5,10.17-108.11,10.17-108.11h50.62S175,238.9,169.56,252.6A63.45,63.45,0,0,0,159,257.43s-4.74,61.91-4.92,69.63C153.71,342.33,147.35,423.68,147.35,423.68Z" style="fill: rgb(69, 90, 100); transform-origin: 142.06px 320.485px;" id="el9o5h7ujysq" class="animable"></path><path d="M146.24,416.09c-6.46-.41-4.6-.38-11.06-.72-3.17-.16-24-1.23-26.93-.86-.07,0-.08.12,0,.13,2.94.61,23.74,1.31,26.91,1.42,6.47.21,4.61.08,11.08.22A.1.1,0,0,0,146.24,416.09Z" style="fill: rgb(38, 50, 56); transform-origin: 127.251px 415.356px;" id="elnpkailye5qf" class="animable"></path><path d="M131.32,222.84c-1.88,23.57-3.81,47.15-6,70.7s-4.7,47.25-7.78,70.78c-1.72,13.15-3.63,31.67-5.67,44.77,0,.09.12.13.13,0,4.18-23.28,7.25-52.17,9.86-75.67s4.75-47.06,6.65-70.62c1.08-13.33,2.05-26.67,3.07-40C131.63,222.64,131.33,222.65,131.32,222.84Z" style="fill: rgb(38, 50, 56); transform-origin: 121.728px 315.931px;" id="el021ekcac2cif" class="animable"></path><path d="M171.37,251.66A78.77,78.77,0,0,0,159,257.43a.14.14,0,0,0,.11.26c4.18-1.8,8.44-3.51,12.51-5.53A.28.28,0,0,0,171.37,251.66Z" style="fill: rgb(38, 50, 56); transform-origin: 165.337px 254.669px;" id="elh5qxy10ll0m" class="animable"></path><path d="M172.7,223c0-.15-.27-.18-.26,0,0,4.95-.29,9.32-.7,13.95-.2,2.15-1.93,14-5.66,13.17-.62-.15-.94-.76-1-1.7a14.79,14.79,0,0,1,.5-3.65c.41-2.49.74-5,1-7.5a68.83,68.83,0,0,0-.16-14.06.12.12,0,0,0-.24,0A128.6,128.6,0,0,1,165,242.63c-.47,3.09-2,7.74,1.21,8.22s5.42-7.31,5.82-9.44A70.89,70.89,0,0,0,172.7,223Z" style="fill: rgb(38, 50, 56); transform-origin: 168.617px 236.874px;" id="el0tpnxjvsf1zm" class="animable"></path><path d="M166.18,250.43a19.82,19.82,0,0,0-.84,2.46,5.67,5.67,0,0,0-.35,2,.15.15,0,0,0,.26.05,7.12,7.12,0,0,0,.87-2c.28-.76.58-1.52.84-2.29A.41.41,0,0,0,166.18,250.43Z" style="fill: rgb(38, 50, 56); transform-origin: 165.976px 252.593px;" id="elh6pzt3ibw9b" class="animable"></path><path d="M149.3,226.9a6.19,6.19,0,0,0-.16-1.55c0-.07-.12-.06-.15,0a6.54,6.54,0,0,0-.17,1.33c0,.51-.12,1-.17,1.53a25,25,0,0,1-.55,3.11,11.08,11.08,0,0,1-2.85,5.12,14.85,14.85,0,0,1-4.82,3.17,55.15,55.15,0,0,1-6.18,1.77.08.08,0,0,0,0,.15,17.87,17.87,0,0,0,6.69-1.31,14.42,14.42,0,0,0,5-3.21,11.21,11.21,0,0,0,2.92-5.26,15.7,15.7,0,0,0,.41-3.12A14.44,14.44,0,0,0,149.3,226.9Z" style="fill: rgb(38, 50, 56); transform-origin: 141.755px 233.416px;" id="el092z6arsyg07" class="animable"></path><path d="M157,170.72c1.88,7.77,19.7,46.07,31.63,49.35,12.48,3.44,46.92-11.32,50.17-12.47,8.91-3.16-9.09-29.32-13.7-26.2-7.7,5.21-25.47,14.39-29.07,12.83-7.56-3.28-21.33-20.33-31.6-29.82C158.25,158.69,154.94,162.12,157,170.72Z" style="fill: rgb(235, 148, 129); transform-origin: 198.815px 191.09px;" id="elrcaoip5hf2h" class="animable"></path><path d="M236.69,208.34c1.56-.65,13.85-4.64,19.17-9.76,2.81-2.72,9.72-11.05,8.28-13-1.31-1.75-3.76.07-3.76.07s3-3.76,1.17-6.18-5.83.87-5.83.87,2.82-4.09.8-6.37-5.47,1.69-5.47,1.69,2.76-3.61.31-4.79c-3-1.41-7.28,5.83-10.88,8.24-.82.54-17.36,9.89-17.36,9.89Z" style="fill: rgb(235, 148, 129); transform-origin: 243.728px 189.515px;" id="elqujdbay98b" class="animable"></path><path d="M250.88,175.66c-3.19,5.32-5.51,7.09-11,9.84-.1.05,0,.22.07.18,5.59-2.21,8.81-4,11.17-9.88C251.26,175.51,251,175.4,250.88,175.66Z" style="fill: rgb(38, 50, 56); transform-origin: 245.499px 180.6px;" id="ell1b4rg6s0c" class="animable"></path><path d="M255.55,180.31c-3.8,5.23-6.3,7.18-11.8,10.48-.08,0,0,.18.07.14,5.67-2.79,8.85-4.66,12-10.39C255.92,180.28,255.72,180.07,255.55,180.31Z" style="fill: rgb(38, 50, 56); transform-origin: 249.782px 185.57px;" id="elr89g9edbzs" class="animable"></path><path d="M260.11,185.83c-4.05,4.8-6.7,7-12.45,9.57a.12.12,0,0,0,.08.22c6.12-2,9.44-4.79,12.5-9.65C260.45,185.63,260.36,185.53,260.11,185.83Z" style="fill: rgb(38, 50, 56); transform-origin: 253.981px 190.636px;" id="elfjqnu1lndlb" class="animable"></path><path d="M218.2,188.13s4.85-6.08,7.57-8.28,15.87-6.66,17-3.87c1.46,3.59-5.63,7.67-9.36,9.21,0,0,3.37,8.32-1.08,12.34S218.2,188.13,218.2,188.13Z" style="fill: rgb(235, 148, 129); transform-origin: 230.583px 186.685px;" id="elurrk576zwc" class="animable"></path><path d="M242.84,177.1c-1,4.23-6.07,5.94-9.58,7.71a.36.36,0,0,0-.11.58c1.18,3.58,1.8,9-.59,12.15-.07.09.06.21.14.12,3-3.06,2.85-8.41,1.31-12.25,3.62-1.75,8.59-3.69,8.87-8.3C242.88,177.08,242.85,177.07,242.84,177.1Z" style="fill: rgb(38, 50, 56); transform-origin: 237.71px 187.387px;" id="elo8396esgxug" class="animable"></path><path d="M166.67,200.7l19.21-15.82s-10-11.8-18.67-19.55-16.05-7.16-10.14,10.7S166.67,200.7,166.67,200.7Z" style="fill: #FFA000; transform-origin: 170.411px 180.648px;" id="el4uqiolfcuek" class="animable"></path><path d="M157.1,167.63v.27h-.84a1.39,1.39,0,0,1-1.25-.78,12.45,12.45,0,0,1-.07-1.32,1.35,1.35,0,0,1,.19.69,1.14,1.14,0,0,0,1.13,1.14Z" style="fill: rgb(255, 255, 255); transform-origin: 156.02px 166.85px;" id="elo2tpez2n06b" class="animable"></path><path d="M176.65,178.56h-.83a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.14-1.14h-.88v-.27h.88a1.41,1.41,0,0,1,1.41,1.41,1.14,1.14,0,0,0,1.14,1.13h.83Z" style="fill: rgb(255, 255, 255); transform-origin: 174.52px 177.15px;" id="elmrm6peldd2" class="animable"></path><path d="M168.36,198.61a1.13,1.13,0,0,0-.32,1l-.24.2a1.39,1.39,0,0,1,.36-1.35,1.13,1.13,0,0,0,0-1.61l-.62-.62.2-.2.62.63A1.41,1.41,0,0,1,168.36,198.61Z" style="fill: rgb(255, 255, 255); transform-origin: 168.146px 197.92px;" id="eloakuiyv0rts" class="animable"></path><path d="M162.65,172.42l-.2-.19.59-.59a1.4,1.4,0,0,1,2,0,1.13,1.13,0,0,0,1.6,0l.62-.62.2.19-.62.62a1.4,1.4,0,0,1-2,0,1.15,1.15,0,0,0-1.6,0Z" style="fill: rgb(255, 255, 255); transform-origin: 164.955px 171.72px;" id="elucy1ylite7" class="animable"></path><path d="M175,189.19l-.19-.19.59-.59a1.41,1.41,0,0,1,2,0,1.15,1.15,0,0,0,1.61,0l.62-.63.19.2-.62.62a1.41,1.41,0,0,1-2,0,1.15,1.15,0,0,0-1.61,0Z" style="fill: rgb(255, 255, 255); transform-origin: 177.315px 188.485px;" id="el5k89jxl3or3" class="animable"></path><path d="M165.23,187.76H165v-.87a1.42,1.42,0,0,1,1.41-1.42,1.13,1.13,0,0,0,1.13-1.13v-.83h.28v.83a1.41,1.41,0,0,1-1.41,1.41,1.14,1.14,0,0,0-1.14,1.14Z" style="fill: rgb(255, 255, 255); transform-origin: 166.41px 185.635px;" id="elrexjv6f5678" class="animable"></path><path d="M179,190.55,166.67,200.7s-3.69-6.81-9.6-24.67c-4.55-13.74-1.24-17.26,4.49-14.61C167.19,170.84,175.26,184.32,179,190.55Z" style="fill: rgb(38, 50, 56); transform-origin: 166.969px 180.651px;" id="elocq7ztvq1xj" class="animable"></path><path d="M165.13,196.1a197.61,197.61,0,0,0,16.41-13.73c.06-.05,0-.15-.1-.09-1.27,1.18-10.5,8.31-16.42,13.72C165,196.06,165.05,196.16,165.13,196.1Z" style="fill: rgb(38, 50, 56); transform-origin: 173.29px 189.19px;" id="el84j1ny7ulvb" class="animable"></path><path d="M122.75,239.23c.15.16,61.73-1.79,62.27-2.44.75-.91-12.43-62.08-22.89-75-2.62-3.24-11.43-4.12-14.89-.52-10,10.42-11.85,17.86-14.25,24.79-1.77,5.13-3.8,13.84-5.56,22.75C124.49,223.46,122.22,238.67,122.75,239.23Z" style="fill: #FFA000; transform-origin: 153.862px 199.089px;" id="elefrwcxfj0in" class="animable"></path><path d="M171.28,212.87h-.83a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.14-1.14H167v-.27h.88a1.41,1.41,0,0,1,1.41,1.41,1.13,1.13,0,0,0,1.14,1.13h.83Z" style="fill: rgb(255, 255, 255); transform-origin: 169.14px 211.46px;" id="elzetyl4yi6j" class="animable"></path><path d="M157.1,167.9h-.84a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.13-1.13h-.88v-.28h.88a1.41,1.41,0,0,1,1.41,1.41,1.14,1.14,0,0,0,1.13,1.14h.84Z" style="fill: rgb(255, 255, 255); transform-origin: 154.97px 166.49px;" id="el89beizj1e7c" class="animable"></path><path d="M138.2,198.64h-.83a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.14-1.14h-.88v-.28h.88a1.42,1.42,0,0,1,1.41,1.42,1.14,1.14,0,0,0,1.14,1.13h.83Z" style="fill: rgb(255, 255, 255); transform-origin: 136.07px 197.225px;" id="elp8xopg5yhvg" class="animable"></path><path d="M159.23,194.82h-.84a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.13-1.14H155V192h.88a1.41,1.41,0,0,1,1.41,1.41,1.14,1.14,0,0,0,1.13,1.13h.84Z" style="fill: rgb(255, 255, 255); transform-origin: 157.13px 193.41px;" id="elr92q4fpzgyo" class="animable"></path><path d="M148.63,217h-.84a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.13-1.13h-.88v-.28h.88a1.41,1.41,0,0,1,1.41,1.41,1.14,1.14,0,0,0,1.13,1.14h.84Z" style="fill: rgb(255, 255, 255); transform-origin: 146.5px 215.59px;" id="elntefghyhv9" class="animable"></path><path d="M161.83,235.71H161a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.13-1.13h-.88v-.28h.88a1.41,1.41,0,0,1,1.41,1.41,1.14,1.14,0,0,0,1.13,1.14h.84Z" style="fill: rgb(255, 255, 255); transform-origin: 159.71px 234.3px;" id="elxiiaw56b3ji" class="animable"></path><path d="M133.15,234.36h-.83a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.14-1.14h-.88v-.27h.88a1.41,1.41,0,0,1,1.41,1.41,1.14,1.14,0,0,0,1.14,1.13h.83Z" style="fill: rgb(255, 255, 255); transform-origin: 131.02px 232.95px;" id="elyynicwphysj" class="animable"></path><path d="M160.56,221.11l-.59-.59a1.42,1.42,0,0,1,0-2,1.13,1.13,0,0,0,0-1.6l-.62-.62.19-.2.63.63a1.41,1.41,0,0,1,.41,1,1.43,1.43,0,0,1-.41,1,1.12,1.12,0,0,0,0,1.6l.58.59Z" style="fill: rgb(255, 255, 255); transform-origin: 160.05px 218.605px;" id="elrb8le72ln0h" class="animable"></path><path d="M177.16,234.92l-.59-.59a1.42,1.42,0,0,1,0-2,1.13,1.13,0,0,0,0-1.6l-.62-.62.19-.2.62.62a1.42,1.42,0,0,1,0,2,1.13,1.13,0,0,0,0,1.6l.59.59Z" style="fill: rgb(255, 255, 255); transform-origin: 176.65px 232.415px;" id="el8gs9bg3mfc" class="animable"></path><path d="M168.75,201l-.59-.59a1.41,1.41,0,0,1,0-2,1.13,1.13,0,0,0,0-1.61l-.62-.62.2-.2.62.63a1.41,1.41,0,0,1,0,2,1.15,1.15,0,0,0,0,1.61l.59.59Z" style="fill: rgb(255, 255, 255); transform-origin: 168.245px 198.49px;" id="elwwu5iy7yvds" class="animable"></path><path d="M139.23,184.87l-.59-.59a1.41,1.41,0,0,1,0-2,1.13,1.13,0,0,0,0-1.61l-.62-.62.2-.19.62.62a1.43,1.43,0,0,1,.41,1,1.41,1.41,0,0,1-.41,1,1.15,1.15,0,0,0,0,1.61l.59.59Z" style="fill: rgb(255, 255, 255); transform-origin: 138.725px 182.365px;" id="eltc68fyrzmja" class="animable"></path><path d="M157.16,182.15l-.59-.59a1.41,1.41,0,0,1,0-2,1.15,1.15,0,0,0,0-1.61l-.62-.62.19-.19.62.62a1.4,1.4,0,0,1,.42,1,1.38,1.38,0,0,1-.42,1,1.15,1.15,0,0,0,0,1.61l.59.59Z" style="fill: rgb(255, 255, 255); transform-origin: 156.65px 179.645px;" id="elpkx58x9c9t" class="animable"></path><path d="M137.59,212.24l-.59-.59a1.42,1.42,0,0,1,0-2,1.12,1.12,0,0,0,0-1.6l-.62-.62.2-.2.62.62a1.42,1.42,0,0,1,0,2,1.13,1.13,0,0,0,0,1.6l.59.59Z" style="fill: rgb(255, 255, 255); transform-origin: 137.085px 209.735px;" id="el8r0j4y5oeww" class="animable"></path><path d="M165.19,226.27l-.19-.19.59-.59a1.41,1.41,0,0,1,2,0,1.15,1.15,0,0,0,1.61,0l.62-.62.19.19-.62.62a1.4,1.4,0,0,1-1,.42,1.38,1.38,0,0,1-1-.42,1.15,1.15,0,0,0-1.61,0Z" style="fill: rgb(255, 255, 255); transform-origin: 167.505px 225.57px;" id="elt5grvyld7zr" class="animable"></path><path d="M136,223.63l-.2-.2.59-.58a1.42,1.42,0,0,1,2,0,1.13,1.13,0,0,0,1.6,0l.62-.63.2.2-.62.62a1.42,1.42,0,0,1-2,0,1.13,1.13,0,0,0-1.6,0Z" style="fill: rgb(255, 255, 255); transform-origin: 138.305px 222.925px;" id="el8zheemdvgeg" class="animable"></path><path d="M144.65,203.4l-.19-.19.59-.59a1.41,1.41,0,0,1,2,0,1.15,1.15,0,0,0,1.61,0l.62-.62.19.19-.62.63a1.42,1.42,0,0,1-2,0,1.13,1.13,0,0,0-1.61,0Z" style="fill: rgb(255, 255, 255); transform-origin: 146.965px 202.7px;" id="elnzj2bdrg4x" class="animable"></path><path d="M141.21,235.52l-.19-.19.59-.59a1.41,1.41,0,0,1,2,0,1.15,1.15,0,0,0,1.61,0l.62-.62.19.19-.62.62a1.39,1.39,0,0,1-2,0,1.17,1.17,0,0,0-1.61,0Z" style="fill: rgb(255, 255, 255); transform-origin: 143.525px 234.82px;" id="el4ymk1nimnvf" class="animable"></path><path d="M167.33,171.34l-.49.49a1.4,1.4,0,0,1-2,0,1.15,1.15,0,0,0-1.6,0l-.59.59-.2-.19.59-.59a1.4,1.4,0,0,1,2,0,1.13,1.13,0,0,0,1.6,0l.57-.57A1.59,1.59,0,0,1,167.33,171.34Z" style="fill: rgb(255, 255, 255); transform-origin: 164.89px 171.745px;" id="elf2td0y0clv" class="animable"></path><path d="M178.09,205a1.37,1.37,0,0,1-.62-.35,1.12,1.12,0,0,0-1.6,0l-.59.58-.19-.19.58-.59a1.42,1.42,0,0,1,2,0,1.08,1.08,0,0,0,.34.23C178,204.79,178.07,204.9,178.09,205Z" style="fill: rgb(255, 255, 255); transform-origin: 176.59px 204.634px;" id="eluc1zt9y2j1" class="animable"></path><path d="M144.19,174.76l-.19-.2.58-.59a1.42,1.42,0,0,1,2,0,1.1,1.1,0,0,0,.8.34h0a1.1,1.1,0,0,0,.8-.34l.63-.62.19.2-.62.62a1.39,1.39,0,0,1-1,.41h0a1.41,1.41,0,0,1-1-.41,1.13,1.13,0,0,0-1.6,0Z" style="fill: rgb(255, 255, 255); transform-origin: 146.5px 174.055px;" id="ele0biyblut4g" class="animable"></path><path d="M176.2,221.58h-.28v-.88a1.41,1.41,0,0,1,1.41-1.41,1.14,1.14,0,0,0,1.14-1.14v-.83h.27v.83a1.41,1.41,0,0,1-1.41,1.41,1.14,1.14,0,0,0-1.13,1.14Z" style="fill: rgb(255, 255, 255); transform-origin: 177.33px 219.45px;" id="eljv10f68ismd" class="animable"></path><path d="M149.41,228.89h-.27V228a1.41,1.41,0,0,1,1.41-1.41,1.13,1.13,0,0,0,1.13-1.14v-.83H152v.83a1.41,1.41,0,0,1-1.41,1.41,1.14,1.14,0,0,0-1.14,1.14Z" style="fill: rgb(255, 255, 255); transform-origin: 150.57px 226.755px;" id="el1ssa2q7s4ad" class="animable"></path><path d="M156,208.79h-.27v-.88a1.41,1.41,0,0,1,1.41-1.41,1.14,1.14,0,0,0,1.13-1.14v-.83h.28v.83a1.42,1.42,0,0,1-1.41,1.42,1.14,1.14,0,0,0-1.14,1.13Z" style="fill: rgb(255, 255, 255); transform-origin: 157.14px 206.66px;" id="elbs53y04a6nf" class="animable"></path><path d="M127.76,218.23h-.28v-.88a1.42,1.42,0,0,1,1.41-1.41,1.14,1.14,0,0,0,1.14-1.13V214h.27v.84a1.41,1.41,0,0,1-1.41,1.41,1.14,1.14,0,0,0-1.13,1.13Z" style="fill: rgb(255, 255, 255); transform-origin: 128.89px 216.115px;" id="el4me54ctvxvc" class="animable"></path><path d="M145.83,191.55h-.28v-.88a1.41,1.41,0,0,1,1.41-1.41,1.14,1.14,0,0,0,1.14-1.14v-.83h.27v.83a1.41,1.41,0,0,1-1.41,1.41,1.14,1.14,0,0,0-1.13,1.14Z" style="fill: rgb(255, 255, 255); transform-origin: 146.96px 189.42px;" id="el4i5tau1rgha" class="animable"></path><path d="M165.23,187.76H165v-.87a1.42,1.42,0,0,1,1.41-1.42,1.13,1.13,0,0,0,1.13-1.13v-.83h.28v.83a1.41,1.41,0,0,1-1.41,1.41,1.14,1.14,0,0,0-1.14,1.14Z" style="fill: rgb(255, 255, 255); transform-origin: 166.41px 185.635px;" id="eld69fijpu61r" class="animable"></path><path d="M159.14,169.51c-2.55.5-8.61-3.5-11.31-7.23-.18-.26-.12-3.21-.21-6.8-.07-2.17-.19-4.59-.47-6.79-.05-.45,1.59.18,1.59.18l2.93.34,9.7,1.12a35.41,35.41,0,0,0-.28,8.61,4.64,4.64,0,0,0,.21.89s0,.09,0,.15C161.83,161.66,163.13,168.72,159.14,169.51Z" style="fill: rgb(235, 148, 129); transform-origin: 154.54px 159.04px;" id="ell4yjp82bib7" class="animable"></path><path d="M161.3,159.83s0,.09,0,.15a8.25,8.25,0,0,1-1.41.25c-9.32,1-12-10.72-12-10.72l3.69-.3,9.7,1.12a35.41,35.41,0,0,0-.28,8.61A4.64,4.64,0,0,0,161.3,159.83Z" style="fill: rgb(38, 50, 56); transform-origin: 154.595px 154.75px;" id="elq2h4hhzjpol" class="animable"></path><path d="M162.7,123s4.69,1.89,5.59,6.62-.12,9.71-.53,10S162.7,123,162.7,123Z" style="fill: rgb(38, 50, 56); transform-origin: 165.675px 131.312px;" id="elpd4y2w32pf" class="animable"></path><path d="M151.5,156.09h0" style="fill: none; stroke: rgb(244, 166, 157); stroke-linecap: round; stroke-linejoin: round; stroke-width: 0px; transform-origin: 151.5px 156.09px;" id="elhjbwq0u65lo" class="animable"></path><path d="M144.59,130.06c-1.49,4.94,1.15,19.18,4.66,22.35,5.1,4.59,13.43,5,17.33-1.11,3.77-5.94,0-24.44-3.92-27.31C156.88,119.75,146.79,122.77,144.59,130.06Z" style="fill: rgb(235, 148, 129); transform-origin: 156.152px 138.961px;" id="elv6hll9bxxzi" class="animable"></path><path d="M157.7,138s-.06.06-.06.09c.22,1,.31,2.08-.5,2.57,0,0,0,.06,0,.05C158.19,140.34,158.06,138.84,157.7,138Z" style="fill: rgb(38, 50, 56); transform-origin: 157.551px 139.356px;" id="el0ram0xojqpw9" class="animable"></path><path d="M156.65,137.14c-1.56.18-1.08,3.29.36,3.13S158,137,156.65,137.14Z" style="fill: rgb(38, 50, 56); transform-origin: 156.791px 138.706px;" id="eledv9j5e2za" class="animable"></path><path d="M163.37,136.91s.09,0,.09.07c.12,1,.42,2.06,1.34,2.24,0,0,0,.06,0,.06C163.71,139.29,163.33,137.84,163.37,136.91Z" style="fill: rgb(38, 50, 56); transform-origin: 164.084px 138.095px;" id="el8fvfurm70kn" class="animable"></path><path d="M164.08,135.77c1.53-.36,2.13,2.73.71,3.06S162.8,136.06,164.08,135.77Z" style="fill: rgb(38, 50, 56); transform-origin: 164.481px 137.298px;" id="el19ho5r7zgfx" class="animable"></path><path d="M155.21,135.91c.4-.18.75-.4,1.14-.61a2.12,2.12,0,0,0,1-.85.66.66,0,0,0-.23-.78,1.65,1.65,0,0,0-1.67.09,2.38,2.38,0,0,0-1.22,1.24A.72.72,0,0,0,155.21,135.91Z" style="fill: rgb(38, 50, 56); transform-origin: 155.789px 134.732px;" id="el67v9urkb7ld" class="animable"></path><path d="M165,134.39c-.44,0-.85-.08-1.29-.13a2.07,2.07,0,0,1-1.28-.39.66.66,0,0,1-.09-.81,1.65,1.65,0,0,1,1.58-.55,2.39,2.39,0,0,1,1.6.69A.71.71,0,0,1,165,134.39Z" style="fill: rgb(38, 50, 56); transform-origin: 163.974px 133.434px;" id="els0bqh5wgg7k" class="animable"></path><path d="M158.18,147.06c.27.19.54.47.9.44a2.48,2.48,0,0,0,1-.4s.06,0,0,.05a1.35,1.35,0,0,1-1.15.71,1.05,1.05,0,0,1-.89-.74C158.07,147.07,158.14,147,158.18,147.06Z" style="fill: rgb(38, 50, 56); transform-origin: 159.073px 147.448px;" id="el2yz6kj62rmu" class="animable"></path><path d="M158.75,144a3.36,3.36,0,0,0,2.42,1.13,4.82,4.82,0,0,0,1.19-.13l.22-.06.2-.07a.23.23,0,0,0,.16-.24h0a.44.44,0,0,0,0-.1h0l0-.09c-.09-.74-.34-1.86-.34-1.86.3.09,1.78.5,1.69.12a49.85,49.85,0,0,0-2.79-9.74.09.09,0,0,0-.17.05c.53,3.08,1.61,6,2.19,9.14a5.65,5.65,0,0,0-1.62-.23c-.1,0,.51,2.15.53,2.49v0a4.61,4.61,0,0,1-3.56-.53C158.75,143.88,158.68,144,158.75,144Z" style="fill: rgb(38, 50, 56); transform-origin: 161.508px 139.02px;" id="eluwu8vlmo7f" class="animable"></path><path d="M161.86,144.71a3.94,3.94,0,0,1-1.37,1.45,1.82,1.82,0,0,1-1.06.23c-.8-.09-.93-.79-.88-1.42a4.25,4.25,0,0,1,.21-1A5.1,5.1,0,0,0,161.86,144.71Z" style="fill: rgb(38, 50, 56); transform-origin: 160.2px 145.184px;" id="el37popky3uhx" class="animable"></path><path d="M160.49,146.16a1.82,1.82,0,0,1-1.06.23c-.8-.09-.93-.79-.88-1.42A1.85,1.85,0,0,1,160.49,146.16Z" style="fill: rgb(255, 155, 188); transform-origin: 159.515px 145.678px;" id="el49fh1cy1wt2" class="animable"></path><path d="M145.81,141.67c1.63.24,2.69-4.73,2.92-6.61.2-1.66-.08-6.78,0-7.14s7.49,3.4,11.24,1.64,5.83-5.71,5.63-7.36-5.74-5.07-10-4.63-9.13,6.71-9.13,6.71a19.4,19.4,0,0,0,1.48-2.8,4.68,4.68,0,0,0-2.85,3.36s.16-2.53-.05-2.54-2,2.41-1.29,3.92c0,0-2.12,2.5-2,4.87S143.89,141.4,145.81,141.67Z" style="fill: rgb(38, 50, 56); transform-origin: 153.684px 129.605px;" id="eldzmo1y4oxw6" class="animable"></path><path d="M162.59,128.3a13.44,13.44,0,0,1-3.51,1.91,9,9,0,0,1-4.34,0,13.49,13.49,0,0,1-4.06-1.62c-1.11-.66-2.14-1.5-3.3-2-.29-.14-.53.28-.34.5a14.34,14.34,0,0,0,8,4.14,8.21,8.21,0,0,0,7.61-2.83S162.61,128.28,162.59,128.3Z" style="fill: rgb(38, 50, 56); transform-origin: 154.811px 128.949px;" id="el07prz53zl7pl" class="animable"></path><path d="M162.78,137.94c-.4-2.44.58-4.64,2.2-4.91s3.25,1.51,3.65,3.95-.59,4.63-2.2,4.9S163.18,140.38,162.78,137.94Zm.59-.1c.35,2.11,1.67,3.66,3,3.45s2-2.11,1.71-4.22-1.68-3.66-3-3.44S163,135.73,163.37,137.84Z" style="fill: #FFA000; transform-origin: 165.705px 137.455px;" id="elx20il2tj7jp" class="animable"></path><path d="M151.66,139.76a4.19,4.19,0,1,1,4.85,3.75A4.34,4.34,0,0,1,151.66,139.76Zm.59-.09a3.59,3.59,0,1,0,2.91-4.42A3.75,3.75,0,0,0,152.25,139.67Z" style="fill: #FFA000; transform-origin: 155.832px 139.365px;" id="el29zeu0g42ru" class="animable"></path><path d="M159.65,138c2.09-1.14,3.21-.58,3.22-.57l.29-.53c-.06,0-1.39-.74-3.79.57Z" style="fill: #FFA000; transform-origin: 161.265px 137.346px;" id="elasp5bcq4wj5" class="animable"></path><path d="M151.89,139.33v-.6c-.39,0-7.05-.21-8.05-.1s-3.23,1.85-3.48,2.05l.38.47a11.34,11.34,0,0,1,3.12-1.92h0C144.68,139.14,148.56,139.26,151.89,139.33Z" style="fill: #FFA000; transform-origin: 146.125px 139.874px;" id="elhwqvo7eahc5" class="animable"></path><path d="M147.66,141.67s-3.32-4.54-5.38-3.34.5,7.82,3,8.68a2.5,2.5,0,0,0,3.31-1.42Z" style="fill: rgb(235, 148, 129); transform-origin: 145.059px 142.667px;" id="elzdywjxv7g1f" class="animable"></path><path d="M143.06,140.21s-.05,0,0,.07a6.3,6.3,0,0,1,3.35,3.87,1.37,1.37,0,0,0-2.07-.33c-.05,0,0,.1,0,.09a1.52,1.52,0,0,1,1.7.5,6.94,6.94,0,0,1,.84,1.35c.08.15.36.06.3-.12l0,0C147.19,143.41,145.42,140.38,143.06,140.21Z" style="fill: rgb(38, 50, 56); transform-origin: 145.113px 143.023px;" id="el1qdv3hixkl1" class="animable"></path><path d="M139.24,179.52c-.34,6.66-.76,42.32,5.71,50.74,9.63,12.53,28.72,24.14,36,27.78,3.19,1.58,17.76-21.27,14.64-23.45-6.68-4.67-28.75-17.19-30.55-19.39s-8-25.16-11.83-37C148.12,162.29,140.06,163.33,139.24,179.52Z" style="fill: rgb(235, 148, 129); transform-origin: 167.551px 212.462px;" id="elgyg1tg7180j" class="animable"></path><path d="M181,258.11c10.13,5.89,30.39,5.2,33.16,4.38,2.36-.69,3.57-1.07,3.57-1.07,4.26-1.15,5.42-3.5,5.42-3.5s5.32.11,5.92-3.09c.69-3.59-6.92-3.05-11.28-5.3-10-5.17-22.78-15.32-25.51-17.1Z" style="fill: rgb(235, 148, 129); transform-origin: 205.057px 247.729px;" id="el449g79rf6nk" class="animable"></path><path d="M203.5,251.48a74.12,74.12,0,0,0,9,4,73.52,73.52,0,0,0,10.57,2.31.09.09,0,0,1,0,.18,38.53,38.53,0,0,1-19.7-6.27C203.23,251.64,203.35,251.4,203.5,251.48Z" style="fill: rgb(38, 50, 56); transform-origin: 213.234px 254.717px;" id="el6zlq8ppniga" class="animable"></path><path d="M199.5,257.06c3,1.26,8.21,3.45,18.24,4.26a0,0,0,0,1,0,.06,34.46,34.46,0,0,1-18.36-4C199.2,257.27,199.3,257,199.5,257.06Z" style="fill: rgb(38, 50, 56); transform-origin: 208.513px 259.248px;" id="elw7egos0wrhp" class="animable"></path><path d="M206.13,242.53c-1-1.19-.42-1.74,2.34-1.21s13.21,4.93,14.44,1.15-13.62-9.79-18.27-10.31-12.61.27-12.61.27C194.68,234.18,201,239,206.13,242.53Z" style="fill: rgb(235, 148, 129); transform-origin: 207.506px 237.986px;" id="elgvul8uxhzp" class="animable"></path><path d="M137.54,206.68l24-6.74s-4.37-14.81-9.21-25.42-11.81-13-13.6,5.71S137.54,206.68,137.54,206.68Z" style="fill: #FFA000; transform-origin: 149.492px 186.512px;" id="elao3v886wium" class="animable"></path><path d="M159.23,194.82h-.84a1.41,1.41,0,0,1-1.41-1.41,1.14,1.14,0,0,0-1.13-1.14H155V192h.88a1.41,1.41,0,0,1,1.41,1.41,1.14,1.14,0,0,0,1.13,1.13h.84Z" style="fill: rgb(255, 255, 255); transform-origin: 157.13px 193.41px;" id="elea3r0vdydl" class="animable"></path><path d="M139.43,184.68l-.2.19-.59-.59a1.52,1.52,0,0,1-.28-.4h0l.12-1.38h0a1.46,1.46,0,0,1,.16-.19,1.13,1.13,0,0,0,0-1.6l0-.36.16.16a1.43,1.43,0,0,1,.41,1,1.41,1.41,0,0,1-.41,1,1.15,1.15,0,0,0,0,1.61Z" style="fill: rgb(255, 255, 255); transform-origin: 138.895px 182.61px;" id="elx01bihwzd8" class="animable"></path><path d="M144.65,203.4l-.19-.19.59-.59a1.41,1.41,0,0,1,2,0,1.15,1.15,0,0,0,1.61,0l.62-.62.19.19-.62.63a1.42,1.42,0,0,1-2,0,1.13,1.13,0,0,0-1.61,0Z" style="fill: rgb(255, 255, 255); transform-origin: 146.965px 202.7px;" id="elzxmxmtq0qqn" class="animable"></path><path d="M144.19,174.76l-.19-.2.58-.59a1.42,1.42,0,0,1,2,0,1.1,1.1,0,0,0,.8.34h0a1.1,1.1,0,0,0,.8-.34l.63-.62.19.2-.62.62a1.39,1.39,0,0,1-1,.41h0a1.41,1.41,0,0,1-1-.41,1.13,1.13,0,0,0-1.6,0Z" style="fill: rgb(255, 255, 255); transform-origin: 146.5px 174.055px;" id="elfeji30fzis" class="animable"></path><path d="M145.83,191.55h-.28v-.88a1.41,1.41,0,0,1,1.41-1.41,1.14,1.14,0,0,0,1.14-1.14v-.83h.27v.83a1.41,1.41,0,0,1-1.41,1.41,1.14,1.14,0,0,0-1.13,1.14Z" style="fill: rgb(255, 255, 255); transform-origin: 146.96px 189.42px;" id="el7k54xgz6q34" class="animable"></path><path d="M138.2,198.36v.28h-.71a2.72,2.72,0,0,1,0-.28Z" style="fill: rgb(255, 255, 255); transform-origin: 137.843px 198.5px;" id="elge6p4kapt4u" class="animable"></path><path d="M138.36,201.47A199.22,199.22,0,0,0,159,195.66c.08,0,0-.15,0-.13-1.64.56-13,3.29-20.6,5.8C138.22,201.36,138.27,201.49,138.36,201.47Z" style="fill: rgb(38, 50, 56); transform-origin: 148.657px 198.5px;" id="elxgiq7sexe9i" class="animable"></path><path d="M139.67,206.08a12.45,12.45,0,0,0-2.1.59c0-3.77.24-7.49.47-11.25.12-1.9.25-3.8.37-5.71s.34-3.88.29-5.81a.05.05,0,0,0-.1,0,43.55,43.55,0,0,0-.7,5l0-.22c-.12-.84-.24-1.67-.3-2.52a.08.08,0,0,0-.16,0c0,.85,0,1.72.08,2.57,0,.4.1.8.17,1.2l.09.35c-.18,1.68-.34,3.36-.45,5.05-.12,1.9-.18,3.81-.2,5.71a49.56,49.56,0,0,0,.2,5.92,10.45,10.45,0,0,0,2.35-.75S139.73,206.08,139.67,206.08Z" style="fill: rgb(38, 50, 56); transform-origin: 138.406px 195.405px;" id="elvr6xqc0k1di" class="animable"></path><path d="M161.64,200c-.81-3-1.64-6.15-2.67-9.08-.36-1-.76-2-1.15-3-.2-1.18-.54-2.33-.83-3.49,0-.1-.17,0-.15,0,.14.66.27,1.32.41,2q-.84-2.07-1.74-4.11s-.1,0-.08,0c1,2.9,2,5.82,3,8.74s2.07,5.84,3,8.79c0,0-1.51.45-1.49.5A12.93,12.93,0,0,0,161.64,200Z" style="fill: rgb(38, 50, 56); transform-origin: 158.534px 191.335px;" id="el9p6xvqy3ddl" class="animable"></path></g><g id="freepik--Plant--inject-24" class="animable" style="transform-origin: 70.925px 371.68px;"><path d="M98.44,336.51c-3.07-3-7-6.64-11.73-5.35-4.42,1.22-6.11,6-6.9,10.06-1,5.17-1.81,10.4-2.63,15.61s-1.61,10.53-2.37,15.8c-.43,3-.85,5.95-1.26,8.93-.21,1.49-.42,3-.62,4.47s-.45,2.92-.53,4.39c0,.47.71.54.81.09.57-2.48.81-5.07,1.17-7.59s.73-5.06,1.1-7.6q1.11-7.54,2.26-15.09t2.35-15.09c.68-4.26,1-9.55,4.78-12.36a7.29,7.29,0,0,1,7.06-.67,21.08,21.08,0,0,1,6.42,4.49A.06.06,0,0,0,98.44,336.51Z" style="fill: rgb(38, 50, 56); transform-origin: 85.4293px 360.853px;" id="eldnvly10n9um" class="animable"></path><path d="M94.24,333.44s-6.28-2.26-9.37,2.32.6,16.22,29.17,22.8a80.79,80.79,0,0,0-6.87-25.83C101,319.37,90.13,324.43,94.24,333.44Z" style="fill: #FFA000; transform-origin: 99.0028px 341.56px;" id="el0qkqo7z8up5" class="animable"></path><path d="M112.4,356.65a22.34,22.34,0,0,0-1.44-2.32c-.48-.73-1-1.47-1.45-2.2-.36-.55-.74-1.09-1.11-1.63,0-.13,0-.27,0-.41s.06-.5.1-.74c.07-.54.14-1.07.22-1.61s.17-1.06.27-1.59a8.54,8.54,0,0,1,.38-1.68c0-.09-.12-.13-.13,0a6.33,6.33,0,0,1-.25.95c-.07.23-.13.48-.19.72-.14.54-.28,1.08-.4,1.63s-.21,1-.29,1.51c0,.25-.08.49-.11.74-.51-.73-1-1.45-1.57-2.15-1.51-2-3.12-3.93-4.78-5.8,0,0,0,0,0-.05a51.25,51.25,0,0,1,.74-8.93c0-.08-.1-.12-.12,0a30.45,30.45,0,0,0-1.07,8.54c-.6-.67-1.2-1.33-1.81-2q-2.09-2.25-4.25-4.41c-.06-.06-.15,0-.1.08,2.41,2.59,4.7,5.29,6.92,8a50.6,50.6,0,0,0-5.22.2c-1.94.14-3.86.39-5.79.65-.08,0,0,.14,0,.13a53,53,0,0,1,5.78-.52c1.86-.08,3.71,0,5.58,0q1.8,2.25,3.56,4.51h-.26c-.44,0-.88,0-1.32,0-.86,0-1.73.08-2.6.15a39,39,0,0,0-5.27.79.07.07,0,0,0,0,.13c1.76-.2,3.52-.37,5.28-.43.84,0,1.69,0,2.53,0h1.31a1.55,1.55,0,0,0,.72-.06c.77,1,1.54,2,2.3,3,.61.79,1.21,1.6,1.79,2.41s1.15,1.74,1.82,2.51C112.34,356.78,112.43,356.71,112.4,356.65Z" style="fill: rgb(38, 50, 56); transform-origin: 101.66px 344.893px;" id="elzz4kg1aiei9" class="animable"></path><path d="M97,339.93a18.35,18.35,0,0,0-3.06-.15c-1,0-2,0-3,.06-.1,0-.09.14,0,.13,1-.07,2.07-.09,3.11-.08s2,.11,3,.09A0,0,0,0,0,97,339.93Z" style="fill: rgb(38, 50, 56); transform-origin: 93.9594px 339.876px;" id="el5oisbikh3kx" class="animable"></path><path d="M105.94,342.23c.11-1,.24-2,.44-2.92,0-.09-.11-.12-.12,0-.15,1-.33,1.92-.48,2.88-.07.48-.13,1-.19,1.45a6.2,6.2,0,0,0-.12,1.36.09.09,0,0,0,.17,0,8.84,8.84,0,0,0,.15-1.36C105.83,343.16,105.88,342.69,105.94,342.23Z" style="fill: rgb(38, 50, 56); transform-origin: 105.924px 342.146px;" id="elbrnxl3k4i9" class="animable"></path><path d="M104.06,331.42c-.25.95-.5,1.91-.68,2.87-.08.49-.16,1-.23,1.48a6.34,6.34,0,0,0-.09,1.44,0,0,0,0,0,.07,0,8,8,0,0,0,.23-1.38c.06-.47.14-.94.22-1.42.17-1,.35-2,.6-3C104.2,331.38,104.08,331.34,104.06,331.42Z" style="fill: rgb(38, 50, 56); transform-origin: 103.617px 334.292px;" id="elwuwadzb0dzc" class="animable"></path><path d="M66.85,389.36c-.15-1.8-.33-3.59-.52-5.39-.37-3.56-.81-7.11-1.28-10.66s-.94-7.08-1.5-10.6a26.19,26.19,0,0,0-1.09-4.81,4.59,4.59,0,0,0-2.67-3c-3.36-1.16-5.63,2.32-7,4.79,0,.07.07.13.12.06.81-1.17,3.06-4.45,5.6-4.29,1.72.1,3.09,1.31,3.92,5.59,2,10.66,3.9,32.3,4.12,33.71.11.75.64.72.64-.09C67.21,392.9,67,391.12,66.85,389.36Z" style="fill: rgb(38, 50, 56); transform-origin: 59.9907px 374.985px;" id="elcnin0rovrbi" class="animable"></path><path d="M53.71,358.35s2.94-10.37-3.56-5.18C39.34,361.8,39,380.58,39,380.58s19.22-11.16,21.61-18.52C64.13,351.09,53.71,358.35,53.71,358.35Z" style="fill: #FFA000; transform-origin: 50.1681px 366.148px;" id="el862by8b4eu4" class="animable"></path><path d="M57.35,363.44c-1.51.31-3,.51-4.56.73-.72.1-1.44.21-2.17.3-.48.07-1,.12-1.47.18,1.44-2,2.88-3.94,4.25-5.95.05-.08-.06-.16-.13-.1a47.43,47.43,0,0,0-3.21,3.71c-.28-.8-.57-1.6-.85-2.41a27.88,27.88,0,0,1-.91-2.81c0-.08-.15,0-.13,0,.26.95.45,1.92.7,2.87s.53,1.83.86,2.73c-.71.91-1.38,1.85-2,2.8-.33-.94-.74-1.85-1-2.8,0-.08-.15,0-.12,0,.34,1.05.53,2.14.85,3.2-.44.65-.88,1.29-1.3,1.94-.78,1.2-1.51,2.42-2.23,3.65a.31.31,0,0,0-.17.29c-1.21,2.1-2.37,4.24-3.5,6.39,0,.07.07.13.11.06,1.14-2.13,2.41-4.19,3.73-6.22h0a3.91,3.91,0,0,1,.63-.12l.66-.14c.5-.11,1-.24,1.49-.36,1-.24,1.94-.47,2.93-.64.08,0,0-.14,0-.13-1.16.22-2.33.36-3.51.49-.55.07-1.11.14-1.66.23h-.08c.69-1.05,1.39-2.1,2.1-3.13s1.42-2,2.14-3c.67-.09,1.33-.27,2-.39l2.23-.44c1.49-.29,3-.62,4.47-.87C57.47,363.56,57.43,363.43,57.35,363.44Z" style="fill: rgb(38, 50, 56); transform-origin: 48.88px 367.653px;" id="elv460bu21n4j" class="animable"></path><path d="M45.8,364.47l-.26-.83a17,17,0,0,1-.44-1.74c0-.08-.14,0-.13,0,.13.59.27,1.17.4,1.75a11.42,11.42,0,0,0,.5,1.73.12.12,0,0,0,.22-.07C46,365.05,45.89,364.76,45.8,364.47Z" style="fill: rgb(38, 50, 56); transform-origin: 45.5298px 363.649px;" id="elynqf27jy7x" class="animable"></path><path d="M59.31,361c-.87.13-1.76.2-2.64.27s-1.76.2-2.64.34c-.05,0-.05.08,0,.07.89-.06,1.76-.13,2.65-.24s1.75-.25,2.64-.31C59.4,361.17,59.39,361,59.31,361Z" style="fill: rgb(38, 50, 56); transform-origin: 56.6839px 361.34px;" id="elguorhh62enk" class="animable"></path><path d="M81,376.23c-.34-7.64-.83-15.27-1.6-22.87-.38-3.79-.81-7.58-1.34-11.35a80.5,80.5,0,0,0-2.19-11,21.06,21.06,0,0,0-3.65-7.74,8.3,8.3,0,0,0-7.39-3.23c-3.34.42-6,2.52-8.36,4.81-2.61,2.57-5,5.37-7.42,8.12-.62.69-1.22,1.39-1.83,2.09,0,.07,0,.16.1.09,2.36-2.71,4.82-5.36,7.39-7.88,2.38-2.33,4.83-4.88,8.12-5.85a8.39,8.39,0,0,1,4.71-.11,7.4,7.4,0,0,1,3.22,2,16.83,16.83,0,0,1,3.64,7.07c2,7,2.79,14.38,3.55,21.63s1.3,14.75,1.67,22.15.66,14.88,1.38,22.3c.09.91.2,1.83.32,2.74.08.61,1,.61,1,0C81.69,391.57,81.34,383.91,81,376.23Z" style="fill: rgb(38, 50, 56); transform-origin: 64.77px 359.83px;" id="elcnoj95glbnd" class="animable"></path><path d="M56.05,325.7s4.36-8.08-.79-10.66S32.85,331.7,27.81,359.86c0,0,27.86-12.33,37.32-24.61S63.87,320.26,56.05,325.7Z" style="fill: #FFA000; transform-origin: 48.3234px 337.334px;" id="elzoeft3lq78" class="animable"></path><path d="M60.14,332.26c-3.13,0-6.25-.23-9.38-.21l1.76-2A28.67,28.67,0,0,0,55,327.19c0-.07,0-.16-.11-.11a21.31,21.31,0,0,0-2.37,2.38c-.79.83-1.57,1.67-2.34,2.51-1.2,1.29-2.37,2.61-3.54,3.93,0-.13,0-.26,0-.38,0-.55,0-1.1,0-1.65,0-1.06,0-2.12,0-3.18,0-2.16,0-4.32.16-6.47,0-.08-.12-.08-.13,0-.15,2.15-.37,4.3-.48,6.47,0,1.06-.07,2.12-.09,3.19,0,.54,0,1.09,0,1.64,0,.3,0,.61,0,.92-.19.21-.38.41-.56.62-2.5,2.85-4.87,5.81-7.18,8.81,0-.16,0-.33,0-.5,0-.33-.07-.66-.1-1-.09-.72-.18-1.43-.29-2.15s-.21-1.34-.32-2-.31-1.52-.37-2.28a.07.07,0,1,0-.13,0,22.19,22.19,0,0,1,.27,2.3c.06.68.12,1.37.19,2.06s.12,1.38.19,2.07c0,.33.07.66.1,1l.06.5a.89.89,0,0,0,.14.39l-1.19,1.56c-1.58,2.09-3.14,4.21-4.69,6.32,0,.06,0,.15.1.09,1.47-1.92,3-3.8,4.51-5.66,1.15,0,2.31,0,3.46-.06l3.63,0c.08,0,.08-.13,0-.13l-3.62.05c-1.1,0-2.23-.05-3.33,0q2-2.46,4.07-4.89l1.5-1.77a7.26,7.26,0,0,0,1.4,0h1.65c1,0,2.06,0,3.08,0,2.13,0,4.26-.11,6.38-.11a.07.07,0,0,0,0-.13c-2.13,0-4.26-.12-6.39-.17l-3.09-.08H43.88c-.32,0-.64,0-1,0l3.51-4.16a.16.16,0,0,0,.07-.07c1.14-1.35,2.28-2.7,3.44-4l.47-.55c3.25.1,6.49-.11,9.74-.05C60.23,332.39,60.23,332.26,60.14,332.26Z" style="fill: rgb(38, 50, 56); transform-origin: 46.2121px 339.205px;" id="elmf6qqdw66km" class="animable"></path><path d="M58.54,337.8h-.76c-.07,0-.07.11,0,.11h.76C58.63,337.93,58.63,337.8,58.54,337.8Z" style="fill: rgb(38, 50, 56); transform-origin: 58.1675px 337.856px;" id="el47gop4flipi" class="animable"></path><path d="M56.86,337.81l-3-.06-1.51-.05a5.46,5.46,0,0,0-1.4,0s0,.08,0,.1a5.44,5.44,0,0,0,1.4.1l1.5,0h3A.07.07,0,0,0,56.86,337.81Z" style="fill: rgb(38, 50, 56); transform-origin: 53.911px 337.782px;" id="el5bxyhzp1f" class="animable"></path><path d="M48.1,347.21a41.11,41.11,0,0,0-6.16-.55,0,0,0,1,0,0,0c2,.2,4.09.31,6.13.64C48.15,347.35,48.18,347.22,48.1,347.21Z" style="fill: rgb(38, 50, 56); transform-origin: 45.0435px 346.986px;" id="el16fro566wi" class="animable"></path><path d="M39.72,338.25l-.06-.54c0-.4-.12-.8-.18-1.21-.12-.76-.26-1.52-.4-2.29,0-.07-.14,0-.13,0,.1.79.18,1.58.26,2.37,0,.39.06.78.1,1.16a3.42,3.42,0,0,0,.15,1.11c.06.12.24.07.27,0A1.26,1.26,0,0,0,39.72,338.25Z" style="fill: rgb(38, 50, 56); transform-origin: 39.3554px 336.551px;" id="elg5zcz30zlgl" class="animable"></path><path d="M80.72,315.33c-1-1.86-2.26-4.31-4.75-4.15-2.06.13-3,2.22-3.42,4-1.36,5.36-1.45,11-1.72,16.51-.56,11.61-1.06,23.24-1.13,34.86q0,4.85,0,9.67c0,3.29,0,6.6.23,9.88a.24.24,0,0,0,.48,0c0-2.82-.08-5.63-.09-8.44s0-5.49,0-8.23q.14-8.34.45-16.67c.2-5.52.44-11,.68-16.56.12-2.76.23-5.52.36-8.27s.23-5.35.54-8c.17-1.49.39-3,.7-4.44a6.11,6.11,0,0,1,1.29-3,2.8,2.8,0,0,1,3.63-.27,7.73,7.73,0,0,1,2.57,3.22C80.65,315.47,80.76,315.4,80.72,315.33Z" style="fill: rgb(38, 50, 56); transform-origin: 75.2142px 348.756px;" id="el7wrmi669hql" class="animable"></path><path d="M80.05,314.44s-2-7.22,2.48-3.61c7.53,6,7.8,19.1,7.8,19.1S76.94,322.15,75.27,317C72.79,309.39,80.05,314.44,80.05,314.44Z" style="fill: #FFA000; transform-origin: 82.5419px 319.875px;" id="elago9zv6c2kn" class="animable"></path><path d="M87.51,324.57c-.12-.2-.25-.4-.38-.6a4.14,4.14,0,0,0,0-.61c0-.31,0-.62,0-.94,0-.61,0-1.22.07-1.83,0-.08-.13-.08-.13,0,0,.6-.06,1.19-.07,1.79l0,.9q0,.18,0,.39c-.53-.82-1.06-1.63-1.62-2.42l-.5-.68a14.31,14.31,0,0,1,0-2.36c0-.84,0-1.68,0-2.52a.07.07,0,0,0-.13,0c0,.88-.07,1.75-.11,2.62a16.68,16.68,0,0,0,0,1.87c-1.29-1.76-2.67-3.45-4.05-5.14,0-.05-.15,0-.1.08.86,1.09,1.68,2.21,2.49,3.34-1.58-.37-3.18-.58-4.78-.81-.08,0-.11.11,0,.12,1.69.26,3.36.68,5,1.05h0c.64.9,1.28,1.81,1.91,2.72l.76,1.12h-.07l-.53-.08-1.11-.1c-.77-.06-1.54-.1-2.32-.14-.08,0-.08.13,0,.13.76,0,1.51.07,2.27.15l1.2.15.52.06.15,0,1.29,1.9c.76,1.12,1.43,2.32,2.24,3.4a.06.06,0,0,0,.1-.07A34.1,34.1,0,0,0,87.51,324.57Z" style="fill: rgb(38, 50, 56); transform-origin: 83.8746px 321.588px;" id="el1m29ytwl4pv" class="animable"></path><path d="M84.18,316.4c0-.28,0-.56,0-.84a13,13,0,0,1,.07-1.77.07.07,0,1,0-.13,0c0,.58-.06,1.17-.09,1.75,0,.29,0,.58,0,.88v.4a1.18,1.18,0,0,0,0,.42.06.06,0,0,0,.11,0,1.26,1.26,0,0,0,0-.39Z" style="fill: rgb(38, 50, 56); transform-origin: 84.1331px 315.485px;" id="elmfg28nzoxb9" class="animable"></path><path d="M82.52,319.4c-.5-.09-1-.11-1.51-.16s-1.1-.09-1.65-.16a.06.06,0,1,0,0,.12c1.06.07,2.11.26,3.17.3A.05.05,0,0,0,82.52,319.4Z" style="fill: rgb(38, 50, 56); transform-origin: 80.9376px 319.29px;" id="elmerj2vdwimk" class="animable"></path><path d="M86.73,319.44c0,.06,0,.21,0,.28v.74c0,.17,0,.33,0,.5a1.07,1.07,0,0,0,0,.44,0,0,0,0,0,0,0,.47.47,0,0,0,0-.21v-.73c0-.17,0-.34,0-.51v-.23c0-.07,0-.22,0-.28S86.64,319.32,86.73,319.44Z" style="fill: rgb(38, 50, 56); transform-origin: 86.7159px 320.385px;" id="elfpbn8ijhkw" class="animable"></path><path d="M81,353.89c-2.82-2.11-5.35-5.15-9.14-5.3-3.12-.12-5.31,2.23-6.57,4.85a27.37,27.37,0,0,0-1.53,4.32c-.56,2-1.09,4-1.59,6-1,3.93-1.83,7.89-2.51,11.88-.38,2.22-.74,4.45-1,6.69a56.48,56.48,0,0,0-.65,6.85.35.35,0,0,0,.69.08c.39-1.87.55-3.8.82-5.7s.57-3.8.89-5.7q1-5.69,2.24-11.32c.81-3.54,1.6-7.14,2.75-10.59.81-2.47,2.13-5.36,4.8-6.24C74.28,348.31,78,351.75,81,354,81,354,81.1,353.94,81,353.89Z" style="fill: rgb(38, 50, 56); transform-origin: 69.5272px 369.056px;" id="el1y8690u31fg" class="animable"></path><path d="M78.12,351.87s-2.59-7.41,1.16-8.87c5.63-2.17,20.35,14.41,17.47,39.82A143.94,143.94,0,0,1,77,369.5c-8.4-7.05-10.55-16.25-6.85-18.64S78.12,351.87,78.12,351.87Z" style="fill: #FFA000; transform-origin: 82.7635px 362.815px;" id="eld9b556jxj2c" class="animable"></path><path d="M95.05,377.38a19.81,19.81,0,0,0-1.37-2.57c-.48-.87-1-1.73-1.47-2.59-1-1.67-1.95-3.35-2.95-5l-.49-.8.06-.3.17-.73c.12-.55.22-1.11.32-1.67.2-1.08.39-2.19.69-3.25,0-.08-.11-.11-.13,0-.23,1.09-.58,2.16-.9,3.22-.16.53-.32,1.05-.46,1.58l-.14.54c-1.21-2-2.44-3.95-3.77-5.86a2.69,2.69,0,0,0,.13-.81c0-.38.09-.75.13-1.12.1-.84.19-1.67.32-2.5a46.87,46.87,0,0,1,.89-4.87c0-.08-.11-.1-.13,0-.4,1.59-.84,3.2-1.15,4.82-.15.79-.29,1.59-.39,2.39-.06.41-.1.81-.14,1.21,0,.12,0,.24,0,.37-.41-.58-.81-1.16-1.24-1.72-1.3-1.71-2.65-3.38-4-5,0-.06-.16,0-.1.07a91.9,91.9,0,0,1,6.4,9.35c.37.6.73,1.2,1.1,1.79l-.36,0c-.48-.06-1-.09-1.44-.14-1-.08-1.91-.17-2.87-.24-1.92-.16-3.84-.27-5.75-.48-.08,0-.11.12,0,.13,1.93.22,3.86.53,5.79.8l2.85.39a11.22,11.22,0,0,0,2.19.22L89,368.14c-.16,0-.34,0-.5,0H85.78l-3.71,0c-.08,0-.07.13,0,.13,1.25,0,2.49.08,3.74.14l1.78.11.89.07a2,2,0,0,0,.78,0l1.92,3.12c.59,1,1.18,1.92,1.79,2.86a22.82,22.82,0,0,0,1.93,2.9C95,377.5,95.08,377.46,95.05,377.38Z" style="fill: rgb(38, 50, 56); transform-origin: 85.4974px 364.031px;" id="eljzsrq2fwxoh" class="animable"></path><path d="M89.63,356.84a18.12,18.12,0,0,1-.51,2.41c-.21.83-.45,1.64-.72,2.45a.08.08,0,1,0,.15.05c.26-.8.48-1.61.68-2.43s.33-1.65.52-2.46A.06.06,0,1,0,89.63,356.84Z" style="fill: rgb(38, 50, 56); transform-origin: 89.071px 359.303px;" id="el7r3oyawvem" class="animable"></path><path d="M81.27,361.8a.93.93,0,0,0-.62-.23l-1.08-.15c-.66-.09-1.33-.16-2-.24-1.38-.16-2.77-.3-4.16-.47-.08,0-.1.12,0,.13,1.31.16,2.61.35,3.92.52.64.09,1.27.18,1.92.25l.92.11a3.19,3.19,0,0,1,1.06.18C81.27,361.93,81.31,361.85,81.27,361.8Z" style="fill: rgb(38, 50, 56); transform-origin: 77.3144px 361.308px;" id="eltxwpw914k3" class="animable"></path><path d="M89.61,373c-.66-.06-1.32-.08-2-.1l-1,0-.47,0a2.56,2.56,0,0,1-.62,0c-.09,0-.1.14,0,.13a2.8,2.8,0,0,1,.58,0l.52,0,1,.06c.66,0,1.32.08,2,.09C89.68,373.12,89.69,373,89.61,373Z" style="fill: rgb(38, 50, 56); transform-origin: 87.5581px 373.04px;" id="elcvt03o1h9qn" class="animable"></path><path d="M93.62,370.13l.21-1.11c.14-.74.27-1.47.41-2.2a.07.07,0,0,0-.13,0l-.48,2.14L93.39,370c0,.16-.07.33-.1.49a1.38,1.38,0,0,0-.06.53c0,.06.1.11.14,0A2.67,2.67,0,0,0,93.62,370.13Z" style="fill: rgb(38, 50, 56); transform-origin: 93.7327px 368.931px;" id="el9kpp1bo9ecq" class="animable"></path><polygon points="92.1 392.03 91.47 402.54 89.6 433.54 51.26 433.54 49.39 402.54 48.76 392.03 92.1 392.03" style="fill: rgb(69, 90, 100); transform-origin: 70.43px 412.785px;" id="elxcsk0u212nf" class="animable"></polygon><polygon points="92.1 392.03 91.47 402.54 49.39 402.54 48.76 392.03 92.1 392.03" style="fill: rgb(38, 50, 56); transform-origin: 70.43px 397.285px;" id="elfcwr5nq7fzl" class="animable"></polygon><rect x="45.83" y="384.6" width="49.21" height="10.51" style="fill: rgb(69, 90, 100); transform-origin: 70.435px 389.855px;" id="el1e4edf3i2x5" class="animable"></rect></g><defs>     <filter id="active" height="200%">         <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>    </filter>    <filter id="hover" height="200%">        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>            <feColorMatrix type="matrix" values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>    </filter></defs></svg> </div>
      </div>
      <div class="col-lg-9">

          <p class="py-5"> Notre système  vous permet de signaler rapidement tout problème ou demande auprès de notre équipe.
          Chaque ticket et checkout est suivi en temps réel, attribué à un responsable et priorisé selon son urgence. Vous pouvez
          échanger facilement avec nos agents, suivre l’avancement et recevoir des notifications jusqu’à la résolution
          complète de votre demande. </p>
        <div class="row g-4 py-5">
          <div class="col-md-3" data-aos="fade-right" data-aos-duration="3500">
            <div class="card bg-white blob-bg border-0 shadow-sm h-100">
              <div class="card-body">
                <h5 class="card-title">Ticket contenu</h5>
                <p class="card-text">Création de sites modernes, rapides et optimisés pour tous les appareils.</p>
                <a href="{{ url('/utilisateur-service') }}" class="btn btn-two text-white fw-bold btn-xs-sm btn-xs-sm rounded-pill shadow-sm">Commencer   ⮕ </a>
              </div>
            </div>
          </div>

          <div class="col-md-3 " data-aos="fade-down" data-aos-duration="2500">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
                <h5 class="card-title">CheckIn / CheckOut</h5>
                <p class="card-text">Des applications intuitives conçues pour Android et iOS.</p>
                <a href="{{ url('/utilisateur-checkout') }}" class="btn btn-two text-white fw-bold btn-xs-sm btn-xs-sm rounded-pill shadow-sm">Commencer   ⮕</a>
              </div>
            </div>
          </div>
          <div class="col-md-3" data-aos="fade-up" data-aos-duration="1500">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
                <h5 class="card-title">Incident</h5>
                <p class="card-text">Expériences utilisateurs soignées et interfaces modernes.</p>
                <a href="{{ url('/utilisateur-incident') }}" class="btn btn-two text-white fw-bold btn-xs-sm btn-xs-sm rounded-pill shadow-sm">Commencer   ⮕</a>
              </div>
            </div>
          </div>
          <div class="col-md-3" data-aos="fade-left" data-aos-duration="1500">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body">
                <h5 class="card-title">Documentation</h5>
                <p class="card-text">Expériences utilisateurs soignées et interfaces modernes.</p>
                <a href="#" class="btn btn-two text-white fw-bold btn-xs-sm btn-xs-sm rounded-pill shadow-sm">Commencer   ⮕</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      
    </div>
  </section>


  <section id="" class="py-5 bg-white">
    <div class="container text-center">
      <h2 class="section-title">Services informatique</h2>
      <p class="text-muted mb-5">Des passionnés unis pour créer des solutions modernes et performantes.</p>

      <div class="row g-4" data-aos="fade-right" data-aos-duration="1500">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm p-4">
          
              <img class=" rounded-pill mx-auto mb-3 "
                                data-toggle="dropdown"
                                src="{{url('images/eliane.png')}}"
                                alt="Profil" width="120" height="120" class="rounded-circle me-2">
            <h5 class="fw-bold mb-0">Lina Rakoto</h5>
            <p class="text-muted">Directeur Support Administratif</p>
            <p class="small">Spécialiste en interfaces modernes et expériences utilisateurs.</p>
          </div>
        </div>


        <div class="col-md-4" data-aos="fade-down" data-aos-duration="1500">
          <div class="card border-0 shadow-sm p-4">
            <img src="{{url('images/nicolas.png')}}" class="rounded-circle mx-auto mb-3" width="120" height="120"
              alt="Membre">
            <h5 class="fw-bold mb-0">Nicola Rijavola</h5>
            <p class="text-muted">Responsable Parc Informatique</p>
            <p class="small">Expert Laravel et architecture serveur robuste.</p>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-left" data-aos-duration="2000">
          <div class="card border-0 shadow-sm p-4">
            <img src="{{url('images/ely.png')}}" class="rounded-circle mx-auto mb-3" width="120" height="120"
              alt="Membre">
            <h5 class="fw-bold mb-0">Tantely Ely</h5>
            <p class="text-muted">Charge de securite IT et Support Technique UI/UX</p>
            <p class="small">Conçoit des expériences élégantes et intuitives pour nos utilisateurs.</p>
          </div>
        </div>
        <div class="col-md-2">

        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-duration="1500">
          <div class="card border-0 shadow-sm p-4">
            <img src="{{url('images/fandresena.png')}}" class="rounded-circle mx-auto mb-3" width="120" height="120"
              alt="Membre">
            <h5 class="fw-bold mb-0">Fandresena</h5>
            <p class="text-muted">Technicien de Maintenance</p>
            <p class="small">Conçoit des expériences élégantes et intuitives pour nos utilisateurs.</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-duration="1500">
          <div class="card border-0 shadow-sm p-4">
            <img src="{{url('images/hasina.png')}}" class="rounded-circle mx-auto mb-3" width="120" height="120"
              alt="Membre">
            <h5 class="fw-bold mb-0">Hasina Samuela</h5>
            <p class="text-muted">Charger de Support utilisateurs et de Maintenance</p>
            <p class="small">Conçoit des expériences élégantes et intuitives pour nos utilisateurs.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

 <footer class=" parallax-footer  text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1">&copy; 2025 MonSite. Tous droits réservés.</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">Accueil</a></li>
            <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">À propos</a></li>
            <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">Contact</a></li>
            <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">Politique de confidentialité</a></li>
        </ul>
    </div>
</footer>

</div>
 <style>
    /* Reset minimal */
    *{box-sizing:border-box;margin:0;padding:0}
    html,body{height:100%}
    body{font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background:#f3f4f6}

    /* Floating button */
    .chat-toggle{
      position:fixed;right:24px;bottom:24px;z-index:1000;
      width:56px;height:56px;border-radius:28px;background:#0b84ff;color:#fff;border:none;cursor:pointer;
      display:flex;align-items:center;justify-content:center;box-shadow:0 6px 18px rgba(11,132,255,.24);font-weight:700;font-size:18px
    }

    /* Popup container */
    .chat-popup{
      position:fixed;right:24px;bottom:92px;z-index:1000;width:360px;max-width:92vw;height:520px;max-height:80vh;
      display:none;flex-direction:column;border-radius:14px;background:#fff;box-shadow:0 18px 50px rgba(15,23,42,.2);overflow:hidden;
      transform:translateY(20px);opacity:0;pointer-events:none;transition:all .26s cubic-bezier(.2,.9,.3,1);
    }
    .chat-popup.open{transform:translateY(0);opacity:1;pointer-events:auto; display:flex;}

    /* Header */
    .chat-header{display:flex;align-items:center;gap:12px;padding:12px 14px;border-bottom:1px solid #eef2f7;background:linear-gradient(90deg,#f8fafc,#fff)}
    .chat-avatar{width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,#0b84ff,#0047b3);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700}
    .chat-title{flex:1}
    .chat-title h4{font-size:15px;margin-bottom:2px}
    .chat-title p{font-size:12px;color:#64748b}
    .chat-close{background:transparent;border:none;font-size:20px;cursor:pointer;color:#64748b}

    /* Messages area */
    .chat-messages{flex:1;padding:12px;overflow:auto;display:flex;flex-direction:column;gap:10px;background:linear-gradient(180deg,#ffffff 0%,#fbfdff 100%)}
    .msg{max-width:78%;padding:10px 14px;border-radius:12px;font-size:14px;line-height:1.35}
    .msg.agent{align-self:flex-start;background:#f1f5f9;color:#0f172a;border-bottom-left-radius:4px}
    .msg.user{align-self:flex-end;background:#0b84ff;color:#fff;border-bottom-right-radius:4px}
    .msg small{display:block;margin-top:6px;font-size:11px;opacity:.75}

    /* Composer */
    .chat-composer{padding:10px;border-top:1px solid #eef2f7;display:flex;gap:8px;align-items:center}
    .chat-input{flex:1;background:#f8fafc;border:1px solid #e6eef9;padding:10px 12px;border-radius:10px;min-height:40px;resize:none}
    .btn-send{background:#0b84ff;color:#fff;border:none;padding:10px 12px;border-radius:10px;cursor:pointer}

    /* Tiny responsive tweak */
    @media (max-width:420px){
      .chat-popup{right:12px;left:12px;width:calc(100% - 24px);bottom:80px}
      .chat-toggle{right:12px;bottom:12px}
    }
  </style>


<script>
   document.addEventListener('livewire:load', () => {
        Livewire.hook('message.processed', (message, component) => {
            const el = document.getElementById('chat-messages');
            el.scrollTop = el.scrollHeight; // 👇 toujours en bas après chaque update
        });
    });
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