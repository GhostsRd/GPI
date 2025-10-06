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


    </div>

    <form class="chat-composer" id="composer" onsubmit="return false;">
      <textarea id="input" class="chat-input" rows="1" placeholder="Écris un message..."></textarea>
      <button id="sendBtn" class="btn-send">Envoyer</button>
    </form>
  </aside>

  <section class=" section_gap_top">
  
    <div class="col-lg-9  mb-md-2 mb-sm-2">
        <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow_1 ">
          <div class="row">
            <div class="col-lg-11 col-md-10 col-sm-10">
             <label class="fw-bold  mb-1 mt-0 pt-0" >Ticket #<span id="ticketId">415</span> —hiho</label> 

             </div>
             <div class="col-lg-1 col-mg-1 col-sm-1">
                <svg wire:click="openAffectationModal"  width="30"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
             </div>
          </div>
          
        

          </span>
            {{-- <div class="meta mt-2">Créé par <strong>{{$utilisateurs->nom}}</strong> • <span id="createdAt">{{ \Carbon\Carbon::parse($ticketvals->created_at)->translatedFormat('d M Y') }}</span> • 
            @if($ticketvals->state == 1) <span class="badge open">Nouveau</span> @endif
            @if($ticketvals->state == 2) <span class="badge open" style="background:#fff7ed;color:var(--warn)">Assigné</span> @endif
            @if($ticketvals->state == 3) <span class="badge open" style="background:#eefbf7;color:var(--ok)">En cours</span> @endif
            @if($ticketvals->state == 4) <span class="badge open" style="background:#f0f9ff;color:#0369a1">Résolu</span> @endif
            @if($ticketvals->state == 5) <span class="badge closed">Fermé</span> @endif
        
           </div> --}}

          <div class="row  p-3 fond-bg rounded-3">
            <div class="steps-container row" style="display:flex;align-items:center;">
              <div class="step current col-lg-1" wire:click="currentStep(1)" data-index="0">
                <div class="dot bg-primary ">1</div>
                <div class="title">Nouveau</div>
                <div class="sub">Création</div>
              </div>
              <div class="connector col-lg-1">
                <div class="fill fill_20"></div>
              </div>
              <div class="step future col-lg-2" wire:click="currentStep(2)" data-index="1">
                <div class="dot">2</div>
                <div class="title">Assigné</div>
                <div class="sub">Assigné à une équipe</div>
                
              </div>
              <div class="connector col-lg-1">
                <div class="fill fill_20"></div>
              </div>
              <div class="step future col-lg-1" wire:click="currentStep(3)" data-index="2">
                <div class="dot">3</div>
                <div class="title">En cours</div>
                <div class="sub">Intervention</div>
                
              </div>
              <div class="connector col-lg-1">
                <div class="fill fill_20"></div>
              </div>
              <div class="step future col-lg-1" wire:click="currentStep(4)" data-index="3">
                <div class="dot">4</div>
                <div class="title">Résolu</div>
                <div class="sub">Résolution proposée</div>  
              </div>
              <div class="connector col-lg-1">
                <div class="fill fill_20"></div>
              </div>
              <div class="step future col-lg-1" wire:click="currentStep(5)" data-index="4">
                <div class="dot">5</div>
                <div class="title">Fermé</div>
                <div class="sub">Ticket fermé</div>
              </div>
            </div>
          </div>
          <div class="container-fluid mt-4 mb-3 ml-0">
            <h5>Details</h5>
            <p>sdfrdsfv</p>
          </div>

            <hr>
  

          </div>
          
        </div>
        
      </div>

</section>

</div>
