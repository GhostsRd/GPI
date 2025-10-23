<div>

    <div class="container shadow-sm rounded-2 bg-white">
        <div >
            <div class="row">
            <div class="col-lg-2 ">
                <img width="100" class="mt-2 shadow-sm   rounded-pill" src="{{ asset('/images/avtar_1.png') }}" alt="Photo de profil">

            </div>
            <div class="col-lg-7 ">
                <h2 class="fw-bold mt-5"> {{ $utilisateurs->nom }}</h2>
                <p class="border-start border-warning border-3  "><small class="mx-2"> {{ $utilisateurs->poste }}</small> </p>
            </div>
        </div>
       
        <div class="row  mt-4 mb-4">
            <div class="col-lg-2 text-center  col-3"> 

                <div class="border bg-success-light shadow-sm py-1 rounded-2 "  aria-label="Ouvrir le chat" id="chatToggle">
                     <i class="bi bi-chat-dots me-2  "></i> Message
                </div>
            </div>

            <div class="col-lg-2  col-3 text-left"> 

               <i class="bi bi-three-dots-vertical fs-5"></i>
            </div>


            
            {{-- <div class="col-lg-2 col-3">
                <div class="border rounded-2 shadow-sm py-1 rounded-2">
                    Checkout
                </div>
            </div>
            <div class="col-lg-2 col-3">
                <div class="border rounded-2 shadow-sm py-1 rounded-2">
                    Equipement
                </div>
            </div> --}}
          
        </div>

        </div>
        
            <div class="mt-4   p-0">
                 <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                    <li class="nav-item " role="presentation">
                        <button class="nav-link text-dark active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="true">
                            A propos
                        </button>
                    </li>
                    <li class="nav-item " role="presentation">
                        <button class="nav-link text-dark" id="link1-tab" data-bs-toggle="tab" data-bs-target="#link1" type="button" role="tab" aria-controls="link1" aria-selected="false">
                            Equipement
                        </button>
                    </li>
                    <li class="nav-item " role="presentation">
                        <button class="nav-link text-dark" id="link2-tab" data-bs-toggle="tab" data-bs-target="#link2" type="button" role="tab" aria-controls="link2" aria-selected="false">
                            Checkout
                        </button>
                    </li>
        
                    <li class="nav-item " role="presentation">
                        <button class="nav-link text-dark" id="link3-tab" data-bs-toggle="tab" data-bs-target="#link3" type="button" role="tab" aria-controls="link3" aria-selected="false">
                            Ticket
                        </button>
                    </li>
                   
                    </ul>
        
                    <div class="tab-content border-0 p-3 border border-top-0" id="myTabContent">
                    <div class="tab-pane fade show active " id="active" role="tabpanel" aria-labelledby="active-tab">
                        <h5 >Contact</h5>
                        <hr>

                        <p class="mb-3">
                        <i class="bi bi-lieu-fill me-2 "></i>
                        <strong>Lieu :</strong> Ranomafana
                        </p>

                        <p class="mb-3">
                        <i class="bi bi-envelope-fill me-2 "></i>
                        <strong>Email :</strong> {{ $utilisateurs->email }}

                        <p class="mb-3">
                        <i class="bi bi-telephone-fill me-2 "></i>
                        <strong>Téléphone :</strong> +261 34 12 345 67
                        </p>

                        
                    </div>
                    <div class="tab-pane fade border-0 " id="link1" role="tabpanel" aria-labelledby="link1-tab">
                        <p>
                        Ce deuxième onglet contient du contenu complémentaire ou des fonctionnalités secondaires. 
                        Il aide à organiser les informations de manière plus claire.
                        </p>
                    </div>
                    <div class="tab-pane fade border-0 " id="link2" role="tabpanel" aria-labelledby="link2-tab">
                        <p>
                        Ce troisième onglet peut être utilisé pour afficher des détails supplémentaires, 
                        des statistiques ou des options avancées selon le contexte de la page.
                        </p>
                    </div>
                    <div class="tab-pane fade border-0 " id="link3" role="tabpanel" aria-labelledby="link3-tab">
                        <p class="text-muted">
                        Cet onglet est désactivé pour le moment. Il pourra être activé ultérieurement lorsque la fonctionnalité correspondante sera disponible.
                        </p>
                    </div>
        
                 
                    </div>
        
            </div>
            
        </div>
        <div class=" card col-lg-3 mt-2 bg-white d-flex justify-content-end">
            <h3>Notification</h3>
            <p>Voici votre premier notification</p>
        </div>



<aside wire:ignore.self class="chat-popup" id="chatPopup" role="dialog" aria-modal="false" aria-label="Fenêtre de chat">
    <header class="chat-header">
      <div > <img width="50" class="mt-2 shadow-sm   rounded-pill" src="{{ asset('/images/avtar_1.png') }}" alt="Photo de profil">
</div>
      <div class="chat-title">
        <h4>{{ $utilisateurs->nom }}</h4>
        <p>{{ $utilisateurs->poste }}</p>
      </div>
      <button class="chat-close" id="chatClose" aria-label="Fermer">✕</button>
    </header>
    
    <div class="chat-messages" id="messages" aria-live="polite">
        @foreach ($Chats as $chat)
      <!-- sample messages -->

      <div class="msg {{$chat->type == 'user'? 'user' : 'agent'}}">{{$chat->message}}<small>Vous · {{$chat->created_at}}</small></div>
      
      {{-- <div class="msg user">Salut, j'ai un problème avec mon compte<small>Vous · 08:56</small></div>
      
      <div class="msg agent">D'accord, peux-tu préciser ?<small>Support · 08:57</small></div>
      <div class="msg agent">{{$chat->message}}<small>Vous · {{$chat->created_at}}</small></div> --}}
      @endforeach
    </div>

    <form wire:submit.prevent="EnvoyerMessage">
      <textarea id="input" wire:model="message" class="chat-input" rows="1" placeholder="Écris un message..."></textarea>
      <button id="sendBtn" type="submit" class="btn-send">Envoyer</button>
    </form>
  </aside>


{{-- <div wire:poll.60s="checkNotifications">
    <h4>Notification récente</h4>

    @php
        $last = $notifications ? end($notifications) : null;
    @endphp

    @if ($last)
        <div class="list-group">
            <div class="list-group-item">
                <strong>{{ $last['title'] }}</strong>: {{ $last['message'] }}
                <span class="text-muted float-end">
                    {{ \Carbon\Carbon::parse($last['created_at'])->diffForHumans() }}
                </span>
            </div>
        </div>
    @else
        <div class="list-group">
            <div class="list-group-item">Aucune notification</div>
        </div>
    @endif

    <audio id="notifSound" src="{{ asset('song/notif.wav') }}" preload="auto"></audio>
</div> --}}

{{-- <audio id="notifSound" src="{{ asset('song/notif.wav') }}" preload="auto"></audio> --}}
{{-- <button id="enableSound" class="btn btn-outline-secondary">
    🔊 Activer les sons
</button> --}}

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
      display:flex;flex-direction:column;border-radius:14px;background:#fff;box-shadow:0 18px 50px rgba(15,23,42,.2);overflow:hidden;
      transform:translateY(20px);opacity:0;pointer-events:none;transition:all .26s cubic-bezier(.2,.9,.3,1);
    }
    .chat-popup.open{transform:translateY(0);opacity:1;pointer-events:auto}

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
let soundEnabled = false;
const audio = document.getElementById('notifSound');

document.getElementById('enableSound').addEventListener('click', () => {
    audio.play().then(() => {
        soundEnabled = true;
        audio.pause();
        alert("✅ Sons activés !");
    }).catch(err => console.warn("Autoplay bloqué :", err));
});

// Exemple d’événement Livewire
window.addEventListener('playSound', () => {
    if (soundEnabled) audio.play().catch(()=>{});
});
</script>


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