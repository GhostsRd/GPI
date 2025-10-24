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
        {{-- <div class=" card col-lg-3 mt-2 bg-white d-flex justify-content-end">
            <h3>Notification</h3>
            <p>Voici votre premier notification</p>
        </div> --}}



  @livewire('component.chat')

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
