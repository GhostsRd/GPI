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

    <form class="chat-composer" id="composer" onsubmit="return false;">
      <textarea id="input" class="chat-input" rows="1" placeholder="Écris un message..."></textarea>
      <button id="sendBtn" class="btn-send">Envoyer</button>
    </form>
  </aside>

      <section class="features_area section_gap_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title">
                        <h4>Workflow de votre ticket </h4>
                        <p>
                            Votre ticket est en cour de traitement par Tantely
                            
                                                      </p>
                                  
                                              <a class="primary_btn mt-4"  href="{{route("utilisateurService")}}"><span> <svg width="15" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                              </svg>

                                        Retour
                                        </span>
                                        </a>
							
				
                    </div>
                </div>
               
            </div>
          
       <section>

    <div class="steps">
                  <div class="step active">
                    <div class="circle"><svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
              </svg>
              </div>
                    <div class="label">Creation</div>
                  </div>
                  <div class="step active " style="background: none;">
                    <div class="circle">
                      <img src="Ely.png" style="border-radius: 50%;" width="50px" alt="">
              </div>
                    <div class="label">Ely Tantely</div>
                  </div>
                  <div class="step">
                    <div class="circle" ><svg  xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
              </svg></div>
                    <div class="label">Traitement</div>
                  </div>
                  <div class="step">
                    <div title="Votre demande a ete refuser cause du non conforme materiel" class="circle" style="background-color: red;"><svg width="15" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
          </div>
      <div class="label">Decision</div>
    </div>
  </div>
</div>
