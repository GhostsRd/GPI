<div>
    	 <aside class="chat-popup" id="chatPopup" role="dialog" aria-modal="false" aria-label="Fenêtre de chat">
    <header class="chat-header">
      <div class="chat-avatar">GPIS</div>
      <div class="chat-title">
        <h4>GPISupport — Chat</h4>
        <p>Général · habituellement réponse sous 1h</p>
      </div>
      <button class="chat-close" id="chatClose" aria-label="Fermer">✕</button>
    </header>

    <div class="chat-messages" id="messages" aria-live="polite">
      <!-- sample messages -->

      @foreach($chats as $chat)
         

            @if($chat->sendeur_id == 2 && $chat->targetmsg_id == 1 && $chat->type == "user")
                    <div class="msg user">Bonjour {{$chat->message}}<small>Support · {{$chat->created_at}}</small></div>
            @else
                 <div class="msg agent">Bonjour {{$chat->message}}<small>Support · {{$chat->created_at}}</small></div>
            @endif
      @endforeach

    </div>

    <form class="chat-composer" wire:submit.prevent="storechat" id="composer" onsubmit="return false;">
      <textarea id="input" class="chat-input" wire:model="message" rows="1" placeholder="Écris un message..."></textarea>
      <button id="sendBtn" type="submit" class="btn-send">Envoyer</button>
    </form>
  </aside>

<!-- Section Accueil GPI Client -->
<section class="parallax-animated d-flex align-items-center text-white text-center py-5">
  <div class="container">
    <div class="row align-items-center">
      <!-- Texte -->
      <div class="col-lg-6 text-lg-start text-center">
        <h1 class="display-4  fw-bold text-uppercase mb-3" style="font-size:3rem">GPI Client</h1>
        <p class="lead mb-4">
          Nous sommes à votre service tous les jours pour garantir le bon fonctionnement de vos équipements.
        </p>
        <div class="d-flex justify-content-lg-start justify-content-center gap-3">
          <a class="btn btn-primary btn-lg rounded-pill shadow" href="#services">
            <i class="bi bi-play-circle me-2"></i> Commencer
          </a>
          <a class="btn btn-outline-light btn-lg rounded-pill shadow" href="#historique">
            <i class="bi bi-clock-history me-2"></i> Historique
          </a>
        </div>
      </div>

      <!-- Illustration animée -->
      <div class="col-lg-6 mt-4 mt-lg-0 text-center">
        <img src="https://cdn.dribbble.com/users/2015153/screenshots/16183185/media/bf1a3aee2688e6884042ecb4b9f8de66.png" 
             alt="Illustration support GPI" 
             class="img-fluid floating-image rounded-4 shadow-lg border border-light">
      </div>
    </div>
  </div>

  <!-- Particules animées -->
  <canvas id="parallaxCanvas" class="parallax-canvas"></canvas>
</section>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>

</style>

<!-- JS pour particules animées simples -->
<script>

</script>


    <section class="features_area section_gap_top" id="services">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title">
                        <h2>Nos services </h2>
                        <p>
                            Is give may shall likeness made yielding spirit a itself togeth created 
                            after sea <br> is in beast beginning signs open god you're gathering ithe
                        </p>
                    </div>
                </div>
            </div>
            <div class="row feature_inner">
					<div class="col-lg-3 col-md-6">
				<a href="{{ route('utilisateurService')}}" class="">

						
								<div class="feature_item">
									<svg xmlns="http://www.w3.org/2000/svg" width="100" style="color:#5bc4bf" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
												</svg>

									<h4>Ticket</h4>
									<p style="color: #777777;">Creeping for female light years that lesser can't evening heaven isn't bearing tree</p>
								</div>
						
				</a>
               	</div>
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('utilisateurService')}}" class="">
                    <div class="feature_item">
                        <img src="img/services/s2.png" alt="">
                        <h4>Checkout</h4>
                        <p style="color: #777777;">Creeping for female light years that lesser can't evening heaven isn't bearing tree</p>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature_item">
                       <svg xmlns="http://www.w3.org/2000/svg" width="98" style="color:#5bc4bf" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
            </svg>

                                    <h4>Documentation</h4>
                                    <p>Creeping for female light years that lesser can't evening heaven isn't bearing tree</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="feature_item">
                                    <img src="img/services/s4.png" alt="">
                                    <h4>Assistance</h4>
                                    <p>Creeping for female light years that lesser can't evening heaven isn't bearing tree</p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="testimonial_area section_gap_bottom" id="contact">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 text-center">
                                <div class="main_title">
                                    <h2>A propos</h2>
                                    <p>Is give may shall likeness made yielding spirit a itself togeth created after sea is in beast <br>
                                            beginning signs open god you're gathering ithe</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="testi_slider owl-carousel">
                                <div class="testi_item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="img/testimonials/Ely.jpg" style="width: 40px;height: 135px;" alt="">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="testi_text">
                                                <h4>Elite Martin</h4>
                                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testi_item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="img/testimonials/t1.jpg" width="40%" alt="">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="testi_text">
                                                <h4>Davil Saden</h4>
                                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testi_item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="img/testimonials/t1.jpg" alt="">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="testi_text">
                                                <h4>Elite Martin</h4>
                                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testi_item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="img/testimonials/t2.jpg" alt="">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="testi_text">
                                                <h4>Davil Saden</h4>
                                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testi_item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="img/testimonials/t1.jpg" alt="">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="testi_text">
                                                <h4>Elite Martin</h4>
                                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testi_item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="img/testimonials/t2.jpg" alt="">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="testi_text">
                                                <h4>Davil Saden</h4>
                                                <p>Him, made can't called over won't there on divide there male fish beast own his day third seed sixth seas unto. Saw from </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</div>
