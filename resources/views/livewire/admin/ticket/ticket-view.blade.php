<div>
    {{-- <div class="dashboard-header">
        <h4 class="text-muted"><strong>Ticket / view</strong></h4>
        <p class="dashboard-subtitle">Vue d'ensemble de votre activité</p>
    </div> --}}


    <div class="container-fluid p-lg-2 p-sm-2 p-md-2 mb-sm-2 mb-md-2 ">
        <div class="row h-100">

            <div class="col-lg-9  mb-md-2 mb-sm-2">
                {{-- <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow_{{$ticketvals->priorite}} "> --}}

                <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow-lg">
                    <div class="row">
                        <div class="col-lg-11 col-md-10 col-sm-10">
                            <label class="fw-bold  mb-1 mt-0 pt-0">
                              {{-- <i class="bi bi-ticket-detailed"></i>  --}}
                             Demande de Ticket #<span
                                    id="ticketId">{{ $ticketId }}</span> — {{ $ticketvals->sujet }}</label>

                        </div>

                        <div class="col-lg-1 col-mg-1 col-sm-1">
                            <div class="dropdown">

                                <svg class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                    width="30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>

                                <ul class="dropdown-menu border-0">
                                    <li><a class="dropdown-item" href="#" wire:click="changerVue">
                                            <i class="bi bi-kanban me-2"></i>

                                            Panneau visuel</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('ticket') }}">
                                            <i class="bi bi-layout-text-window fs-5"></i>


                                            Table visuel</a>
                                    </li>


                                    @if ($ticketvals->archive == false)
                                        <li><a class="dropdown-item" href="#"
                                                wire:click="archiveTicket({{ $ticketId }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                    <path
                                                        d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                                                    <path fill-rule="evenodd"
                                                        d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087ZM12 10.5a.75.75 0 0 1 .75.75v4.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l1.72 1.72v-4.94a.75.75 0 0 1 .75-.75Z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                Archiver</a>
                                        </li>
                                    @else
                                        <li><a class="dropdown-item" href="#"
                                                wire:click="archiveTicket({{ $ticketId }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                    <path
                                                        d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                                                    <path fill-rule="evenodd"
                                                        d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087ZM12 10.5a.75.75 0 0 1 .75.75v4.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l1.72 1.72v-4.94a.75.75 0 0 1 .75-.75Z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                Desarchiver</a>
                                        </li>
                                    @endif

                                    <li><a class="dropdown-item" wire:click="openAffectationModal" href="#">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18"
                                                viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M15.75 4.5a3 3 0 1 1 .825 2.066l-8.421 4.679a3.002 3.002 0 0 1 0 1.51l8.421 4.679a3 3 0 1 1-.729 1.31l-8.421-4.678a3 3 0 1 1 0-4.132l8.421-4.679a3 3 0 0 1-.096-.755Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            Affecter</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="#"
                                            wire:click="Removeticket({{ $ticketId }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            Supprimer</a></li>
                                </ul>
                            </div>




                        </div>
                    </div>



                    </span>
                    <div class="meta mt-2">Créé par <strong>{{ $utilisateurs->nom }}</strong> • <span
                            id="createdAt">{{ \Carbon\Carbon::parse($ticketvals->created_at)->translatedFormat('d M Y') }}</span>
                        •
                        @if ($ticketvals->state == 1)
                            <span class="badge open">Nouveau</span>
                        @endif
                        @if ($ticketvals->state == 2)
                            <span class="badge open" style="background:#fff7ed;color:var(--warn)">Assigné</span>
                        @endif
                        @if ($ticketvals->state == 3)
                            <span class="badge open" style="background:#eefbf7;color:var(--ok)">En cours</span>
                        @endif
                        @if ($ticketvals->state == 4)
                            <span class="badge open" style="background:#f0f9ff;color:#0369a1">Résolu</span>
                        @endif
                        @if ($ticketvals->state == 5)
                            <span class="badge closed">Fermé</span>
                        @endif

                    </div>

                    <div>
                        <button wire:click="afficheretape" class="btn btn-sm btn-secondary border-0 bg-white  "><span
                                class="loader"></span>
                            {{ $affichestep == 'False' ? 'Afficher les etapes ▼' : 'Masquer les etapes▲' }}</button>

                    </div>

                    <div class="row  p-3 fond-bg rounded-3  {{ $affichestep == 'False' ? 'collapse' : '' }}" >
                        <div class="steps-container row" style="display:flex;align-items:center;">
                            <div class="step {{ $current[1] }} col-lg-1" wire:click="currentStep(1)" data-index="0">
                                <div class="dot ">1</div>
                                <div class="title">Nouveau</div>
                                <div class="sub">Création</div>
                            </div>
                            <div class="connector col-lg-1">
                                <div class="fill {{ $progress }}"></div>
                            </div>
                            <div class="step {{ $current[2] }} col-lg-2" wire:click="currentStep(2)"
                                data-index="1">
                                <div class="dot">2</div>
                                <div class="title">Assigné</div>
                                <div class="sub">Assigné à une équipe</div>

                            </div>
                            <div class="connector col-lg-1">
                                <div class="fill {{ $progress }}"></div>
                            </div>
                            <div class="step {{ $current[3] }} col-lg-1" wire:click="currentStep(3)"
                                data-index="2">
                                <div class="dot">3</div>
                                <div class="title">En cours</div>
                                <div class="sub">Intervention</div>

                            </div>
                            <div class="connector col-lg-1">
                                <div class="fill {{ $progress }}"></div>
                            </div>
                            <div class="step {{ $current[4] }} col-lg-1" wire:click="currentStep(4)"
                                data-index="3">
                                <div class="dot">4</div>
                                <div class="title">Résolu</div>
                                <div class="sub">Résolution proposée</div>
                            </div>
                            <div class="connector col-lg-1">
                                <div class="fill {{ $progress }}"></div>
                            </div>
                            <div class="step {{ $current[5] }} col-lg-1" wire:click="currentStep(5)"
                                data-index="4">
                                <div class="dot">5</div>
                                <div class="title">Fermé</div>
                                <div class="sub">Ticket fermé</div>
                            </div>
                        </div>
                    </div>

                    @if ($ticketvals->archive == false)

                        <div class="container-fluid mt-4 mb-3 ml-0">
                            <h5>Details</h5>
                            <p>{{ $ticketvals->details }}</p>
                        </div>

                        <button  wire:click="changercomment" 
                                    class="btn btn-sm btn-secondary border-0 bg-white  "><span class="loader"></span>
                                    {{ $affichecommentaire == 'False' ? 'Afficher Comment box ▼' : 'Masquer comment box ▲' }}</button>

                        <div class="container-fluid {{ $affichecommentaire == 'False' ? 'collapse' : '' }}">
                            <form wire:submit.prevent="postCommentaire">
                                <h5 style="margin:14px 0 8px">Ajouter un commentaire pour la transition</h5>
                                <textarea wire:model="comments" class="custom-textarea" name="message" id="message"
                                    placeholder="Ex: Prise en main du ticket"></textarea>
                        </div>
                        <div class="container-fluid mt-3">
                            <div class="row ">
                                <div class="col-lg-3">
                                    {{-- <button 
                                    wire:click="submitForm" id="nextBtn"
                                    class="btn btn-sm btn-primary border fw-bold relative flex items-center justify-center gap-2 px-3 py-2 rounded-md font-semibold"
                                      >
                                    <!-- Spinner : visible uniquement pendant le loading -->
                                    <span wire:loading wire:target="submitForm" class="loader"></span>

                                    <!-- Texte du bouton : caché pendant le loading -->
                                    <span wire:loading.remove wire:target="submitForm">Envoyer</span>
                                </button> --}}

                                    <button id="prevBtn" wire:click="previousStep"
                                        class="btn btn-sm btn-outline-warning border-0 fw-bold">Reculer</button>
                                    <button type="submit" wire:click="nextStep"
                                        class="btn btn-sm btn-secondary border fw-bold"><span class="loader"></span>
                                        Passer</button>

                                </div>
                            </div>
                            </form>
                        </div>

                        <hr>
                        <div class="container-fluid mt-4 mb-2">
                            <h5 class="mb-1 text-lg font-semibold"><strong>Historique des activités</strong></h5>

                            <div class="timeline">


                                <!-- Item 1 -->
                                @foreach ($commentaires as $comment)
                                    <div class="timeline-item ">
                                        <div class="timeline-icon">
                                            <span class="icon-wrap" title="Assign">
                                                <!-- user assign icon -->
                                                <svg width="16" height="16" viewBox="0 0 24 24"
                                                    fill="none" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zM4 20c0-2.761 2.239-5 5-5h6c2.761 0 5 2.239 5 5v1H4v-1z"
                                                        fill="var(--accent)" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-date">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                    <path d="M12 7v5l4 2" stroke="currentColor" stroke-width="1.6"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>


                                                {{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}
                                                • @if ($comment->etat == 1)
                                                    <span class="badge open">Nouveau</span>
                                                @endif
                                                @if ($comment->etat == 2)
                                                    <span class="badge open"
                                                        style="background:#fff7ed;color:var(--warn)">Assigné</span>
                                                @endif
                                                @if ($comment->etat == 3)
                                                    <span class="badge open"
                                                        style="background:#eefbf7;color:var(--ok)">En cours</span>
                                                @endif
                                                @if ($comment->etat == 4)
                                                    <span class="badge open"
                                                        style="background:#f0f9ff;color:#0369a1">Résolu</span>
                                                @endif
                                                @if ($comment->etat == 5)
                                                    <span class="badge closed">Fermé</span>
                                                @endif


                                                • <strong class="text-capitalize">
                                                    @foreach ($responsables as $resp)
                                                        @if ($comment->utilisateur_id == $resp->id)
                                                            {{ $resp->name }}
                                                        @endif
                                                    @endforeach
                                                </strong> {{ $comment->commentaire }}
                                                <strong>{{ $ticketvals->categorie }}</strong>.
                                            </div>

                                            <button wire:click="destroyComment({{ $comment->id }})" type="button"
                                                class="btn border-0 p-0 btn-outline-danger btn-sm mx-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                            </button>

                                        </div>


                                    </div>
                                @endforeach

                                <div class="mt-4 container " style="font-size:0.8rem">
                                    {{ $commentaires->links() }}
                                </div>

                            </div>

                        </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <img src="{{ url('images/archive.png') }}" width="300">
                        </div>

                    @endif

                </div>


            </div>
            <div class="col-lg-3 mt-sm-4 mt-2">
                <aside class="shadow-sm p-4 bg-white rounded-2 h-100 side ">
                    <div>
                        <label class="fw-bold" style="margin:0 0 8px">Résumé</label>
                        <div class="info"><span class="text-muted fw-bold"
                                style="font-size: 0.8rem;">Priorité:</span>
                            @if ($ticketvals->priorite == 0)
                                Eleve
                            @endif
                        </div>
                        <div class="info"><span class="text-muted fw-bold" style="font-size: 0.8rem;">Assigné
                                à:</span> Tech Support</div>
                        <div class="info" style="margin-top:6px"><span class="text-muted fw-bold"
                                style="font-size: 0.8rem;">Dernière mise à jour:</span> <span
                                id="lastUpdate">{{ \Carbon\Carbon::parse($ticketvals->updated_at)->translatedFormat('d M Y') }}
                            </span></div>
                    </div>

                    <div>
                        <label style="margin:0 0 8px" class="fw-bold">Actions rapides</label>
                        <div style="display:flex;flex-direction:column;gap:8px">
                            <button class="btn-ghost" id="markResolved" wire:click="markResolved">Marquer comme
                                Résolu</button>
                            <button class="btn-ghost" id="markClosed"
                                wire:click="FermerTicket({{ $ticketvals->id }})">Fermer ticket</button>
                        </div>
                    </div>

                    {{-- <div>
                <h4 style="margin:0 0 8px">États actuels</h4>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                  <span class="badge open">Nouveau</span>
                  <span class="badge open" style="background:#fff7ed;color:var(--warn)">Assigné</span>
                  <span class="badge open" style="background:#eefbf7;color:var(--ok)">En cours</span>
                  <span class="badge" style="background:#f0f9ff;color:#0369a1">Résolu</span>
                  <span class="badge closed">Fermé</span>
                </div>
              </div> --}}
                    <div class="mt-2">
                        <svg class="animated" id="freepik_stories-time-management" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.com/svgjs">
                            <style>
                                svg#freepik_stories-time-management:not(.animated) .animable {
                                    opacity: 0;
                                }

                                svg#freepik_stories-time-management.animated #freepik--Floor--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-time-management.animated #freepik--Shadows--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-time-management.animated #freepik--Calendar--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-time-management.animated #freepik--Gears--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomIn;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-time-management.animated #freepik--Wrench--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-time-management.animated #freepik--Books--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedRight;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-time-management.animated #freepik--List--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideRight, 1.5s Infinite linear floating;
                                    animation-delay: 0s, 1s;
                                }

                                svg#freepik_stories-time-management.animated #freepik--Pencil--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideLeft;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-time-management.animated #freepik--Character--inject-1--inject-73 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) fadeIn;
                                    animation-delay: 0s;
                                }

                                @keyframes fadeIn {
                                    0% {
                                        opacity: 0;
                                    }

                                    100% {
                                        opacity: 1;
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

                                .animator-hidden {
                                    display: none;
                                }
                            </style><!--Time Management-->
                            <g id="freepik--Floor--inject-1--inject-73" class="animable"
                                style="transform-origin: 250px 344.42px;">
                                <ellipse id="freepik--floor--inject-1--inject-73" cx="250" cy="344.42"
                                    rx="239.65" ry="138.36"
                                    style="fill: rgb(245, 245, 245); transform-origin: 250px 344.42px;"
                                    class="animable"></ellipse>
                            </g>
                            <g id="freepik--Shadows--inject-1--inject-73" class="animable animator-hidden"
                                style="transform-origin: 246.341px 342.218px;">
                                <path id="freepik--Shadow--inject-1--inject-73"
                                    d="M213.53,421.53l71.39,41.22a3.83,3.83,0,0,0,3.46,0l96.35-55.63c1-.55,1-1.44,0-2l-71.39-41.21a3.79,3.79,0,0,0-3.47,0l-96.34,55.62A1.05,1.05,0,0,0,213.53,421.53Z"
                                    style="fill: rgb(224, 224, 224); transform-origin: 299.14px 413.326px;"
                                    class="animable"></path>
                                <path id="freepik--shadow--inject-1--inject-73"
                                    d="M317,331.87l54.42,31.4a3.83,3.83,0,0,0,3.46,0l76.42-44c1-.55,1-1.44,0-2l-54.41-31.39a3.79,3.79,0,0,0-3.47,0L317,329.87A1.06,1.06,0,0,0,317,331.87Z"
                                    style="fill: rgb(224, 224, 224); transform-origin: 384.171px 324.571px;"
                                    class="animable"></path>
                                <g id="freepik--shadow--inject-1--inject-73">
                                    <path
                                        d="M452.59,343.5l-4.69-2.71a2.84,2.84,0,0,0-2.86,0l-53.75,31.5-6.37,7.5,13.27-3.52,54.4-31.41A.79.79,0,0,0,452.59,343.5Z"
                                        style="fill: rgb(69, 90, 100); opacity: 0.1; transform-origin: 418.949px 360.097px;"
                                        class="animable"></path>
                                </g>
                                <path id="freepik--shadow--inject-1--inject-73"
                                    d="M149.85,431.44a27.5,27.5,0,0,1-13.73-3.36l-.64-.39a2.69,2.69,0,0,1-1.23-2.85,2.94,2.94,0,0,1,2.68-2.23l13.9-2,.74-1.55-3.33-1.95-13.66,2-.49,0a3.32,3.32,0,0,1-2.79-5.1,14.07,14.07,0,0,1,5-4.54,27.76,27.76,0,0,1,13.5-3.23,32.08,32.08,0,0,1,5.58.48l58-33.48a8.49,8.49,0,0,1-.11-4.5c.72-2.87,2.87-5.4,6.22-7.3a29.78,29.78,0,0,1,27.25.12l.64.39a2.7,2.7,0,0,1,1.22,2.85A2.94,2.94,0,0,1,246,367l-13.91,2-.74,1.55,3.33,1.95,13.66-2a2.77,2.77,0,0,1,.49,0,3.32,3.32,0,0,1,2.79,5.1,14.09,14.09,0,0,1-5,4.55,27.75,27.75,0,0,1-13.5,3.22,32.08,32.08,0,0,1-5.58-.48l-58,33.48a8.53,8.53,0,0,1,.11,4.51c-.72,2.87-2.87,5.39-6.22,7.3A27.86,27.86,0,0,1,149.85,431.44Z"
                                    style="fill: rgb(224, 224, 224); transform-origin: 191.46px 394.823px;"
                                    class="animable"></path>
                                <path id="freepik--shadow--inject-1--inject-73"
                                    d="M268.61,316.55l-43.84-25.31a1.25,1.25,0,0,1,0-2.36L341,221.76a4.51,4.51,0,0,1,4.08,0L389,247.07a1.25,1.25,0,0,1,0,2.36L272.69,316.55A4.51,4.51,0,0,1,268.61,316.55Z"
                                    style="fill: rgb(224, 224, 224); transform-origin: 306.885px 269.155px;"
                                    class="animable"></path>
                                <path id="freepik--shadow--inject-1--inject-73"
                                    d="M104.22,416.49l129-74.38c4.78-2.76,4.78-7.24,0-10l-43.61-25.18c-4.78-2.76-12.54-2.76-17.32,0l-129,74.38c-4.78,2.77-4.78,7.24,0,10L86.9,416.49C91.68,419.25,99.44,419.25,104.22,416.49Z"
                                    style="fill: rgb(224, 224, 224); transform-origin: 138.255px 361.71px;"
                                    class="animable"></path>
                            </g>
                            <g id="freepik--Calendar--inject-1--inject-73" class="animable animator-hidden"
                                style="transform-origin: 309.024px 225.315px;">
                                <g id="freepik--calendar--inject-1--inject-73" class="animable"
                                    style="transform-origin: 309.024px 225.315px;">
                                    <g id="freepik--calendar--inject-1--inject-73" class="animable"
                                        style="transform-origin: 309.024px 225.315px;">
                                        <path
                                            d="M231.89,292.08a1.89,1.89,0,0,1-.8-2L250.31,205a3.58,3.58,0,0,1,1.47-2L366.18,137a2.52,2.52,0,0,1,2.27,0,1.91,1.91,0,0,1,.81,2L350,224a3.49,3.49,0,0,1-1.47,2L234.16,292A2.52,2.52,0,0,1,231.89,292.08Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 300.173px 214.521px;"
                                            id="el6spjn21bdwi" class="animable"></path>
                                        <g id="elpr57wp6yjh">
                                            <path
                                                d="M231.89,292.08a1.89,1.89,0,0,1-.8-2L250.31,205a3.58,3.58,0,0,1,1.47-2L366.18,137a2.52,2.52,0,0,1,2.27,0,1.91,1.91,0,0,1,.81,2L350,224a3.49,3.49,0,0,1-1.47,2L234.16,292A2.52,2.52,0,0,1,231.89,292.08Z"
                                                style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 300.173px 214.521px;"
                                                class="animable"></path>
                                        </g>
                                        <path
                                            d="M252.51,206.29l-19.22,85.1c-.17.73.23,1,.87.65L348.56,226a3.49,3.49,0,0,0,1.47-2l19.23-85.1c.16-.73-.23-1-.88-.64L254,204.29A3.55,3.55,0,0,0,252.51,206.29Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 301.273px 215.147px;"
                                            id="elun0l6mq8x0m" class="animable"></path>
                                        <g id="elpp66ioggqc7">
                                            <path
                                                d="M252.51,206.29l-19.22,85.1c-.17.73.23,1,.87.65L348.56,226a3.49,3.49,0,0,0,1.47-2l19.23-85.1c.16-.73-.23-1-.88-.64L254,204.29A3.55,3.55,0,0,0,252.51,206.29Z"
                                                style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 301.273px 215.147px;"
                                                class="animable"></path>
                                        </g>
                                        <g id="el483kez9dvjq">
                                            <path
                                                d="M252.51,206.29l-19.22,85.1c-.17.73.23,1,.87.65L348.56,226a3.49,3.49,0,0,0,1.47-2l19.23-85.1c.16-.73-.23-1-.88-.64L254,204.29A3.55,3.55,0,0,0,252.51,206.29Z"
                                                style="opacity: 0.05; transform-origin: 301.273px 215.147px;"
                                                class="animable"></path>
                                        </g>
                                        <path
                                            d="M370.66,138.2a2.51,2.51,0,0,0-2.28.05L254,204.29a2.15,2.15,0,0,0-1,2l15,105.41a3.1,3.1,0,0,0,1.29,2,2.54,2.54,0,0,0,2.28,0L386,247.61a2.17,2.17,0,0,0,1-2L372,140.18A3.1,3.1,0,0,0,370.66,138.2Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 320px 225.96px;"
                                            id="elthpz1jqvrm8" class="animable"></path>
                                        <g id="el6lvy3p9i24">
                                            <path
                                                d="M370.66,138.2a2.51,2.51,0,0,0-2.28.05L254,204.29a2.15,2.15,0,0,0-1,2l15,105.41a3.1,3.1,0,0,0,1.29,2,2.54,2.54,0,0,0,2.28,0L386,247.61a2.17,2.17,0,0,0,1-2L372,140.18A3.1,3.1,0,0,0,370.66,138.2Z"
                                                style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 320px 225.96px;"
                                                class="animable"></path>
                                        </g>
                                        <path
                                            d="M255.21,207.58l15,105.41a.86.86,0,0,0,1.37.67L386,247.61a2.17,2.17,0,0,0,1-2L372,140.18a.85.85,0,0,0-1.37-.66l-114.39,66A2.16,2.16,0,0,0,255.21,207.58Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 321.103px 226.585px;"
                                            id="el1adm6nmgrk8" class="animable"></path>
                                        <g id="elctyb5b4r90f">
                                            <path
                                                d="M255.21,207.58l15,105.41a.86.86,0,0,0,1.37.67L386,247.61a2.17,2.17,0,0,0,1-2L372,140.18a.85.85,0,0,0-1.37-.66l-114.39,66A2.16,2.16,0,0,0,255.21,207.58Z"
                                                style="fill: rgb(255, 255, 255); opacity: 0.95; transform-origin: 321.103px 226.585px;"
                                                class="animable"></path>
                                        </g>
                                        <path d="M263.54,280.17l-13.43,7.75h0a2,2,0,0,0-.83,0l-15.85,3.05h0L262.67,274Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 248.485px 282.485px;"
                                            id="eljeon207yot" class="animable"></path>
                                        <g id="elu2uamgpfq6">
                                            <path
                                                d="M263.54,280.17l-13.43,7.75h0a2,2,0,0,0-.83,0l-15.85,3.05h0L262.67,274Z"
                                                style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 248.485px 282.485px;"
                                                class="animable"></path>
                                        </g>
                                        <g id="eluywyemwxo79">
                                            <path
                                                d="M263.54,280.17l-13.43,7.75h0a2,2,0,0,0-.83,0l-15.85,3.05h0L262.67,274Z"
                                                style="opacity: 0.2; transform-origin: 248.485px 282.485px;"
                                                class="animable"></path>
                                        </g>
                                        <path d="M267.92,310.9l-16.5-22.24a2.26,2.26,0,0,0-1.25-.78l13.37-7.71Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 259.045px 295.535px;"
                                            id="elk3fts06a3s9" class="animable"></path>
                                        <g id="elmff7e553nq">
                                            <path d="M267.92,310.9l-16.5-22.24a2.26,2.26,0,0,0-1.25-.78l13.37-7.71Z"
                                                style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 259.045px 295.535px;"
                                                class="animable"></path>
                                        </g>
                                        <g id="elqrinxtru9wd">
                                            <path d="M267.92,310.9l-16.5-22.24a2.26,2.26,0,0,0-1.25-.78l13.37-7.71Z"
                                                style="opacity: 0.1; transform-origin: 259.045px 295.535px;"
                                                class="animable"></path>
                                        </g>
                                        <path
                                            d="M267.41,311.94l-16-20.75a2.59,2.59,0,0,0-2.17-.88l-14.94,2.16a4.4,4.4,0,0,1-2.44-.44c-.61-.35-.51-.75.23-.89l17.16-3.31a2.34,2.34,0,0,1,2.14.84l18.21,24.52c.44.61.31.81-.3.46A8,8,0,0,1,267.41,311.94Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 250.661px 300.815px;"
                                            id="elu8lzugagklm" class="animable"></path>
                                        <g id="el10rlmn37a4s">
                                            <path
                                                d="M267.41,311.94l-16-20.75a2.59,2.59,0,0,0-2.17-.88l-14.94,2.16a4.4,4.4,0,0,1-2.44-.44c-.61-.35-.51-.75.23-.89l17.16-3.31a2.34,2.34,0,0,1,2.14.84l18.21,24.52c.44.61.31.81-.3.46A8,8,0,0,1,267.41,311.94Z"
                                                style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 250.661px 300.815px;"
                                                class="animable"></path>
                                        </g>
                                        <path
                                            d="M369.29,138.47a1.86,1.86,0,0,0-.83-1.54,2.54,2.54,0,0,0-2.28,0L251.78,203a3.61,3.61,0,0,0-1.47,2l-2.71,12,2.2,1.27,116.74-67.4,2.72-12a2.13,2.13,0,0,0,0-.42Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 308.445px 177.465px;"
                                            id="el1703fdip7qf" class="animable"></path>
                                        <g id="ell7mzr3dyzbn">
                                            <path
                                                d="M369.26,138.89c.16-.73-.23-1-.88-.64L254,204.29a3.55,3.55,0,0,0-1.48,2l-2.71,12,116.74-67.4Z"
                                                style="opacity: 0.6; transform-origin: 309.553px 178.191px;"
                                                class="animable"></path>
                                        </g>
                                        <g id="el78x3q8hipyt">
                                            <path
                                                d="M253.09,205.13a3.13,3.13,0,0,0-.57,1.16l-2.72,12L247.6,217l2.71-12a3.24,3.24,0,0,1,.58-1.16Z"
                                                style="opacity: 0.5; transform-origin: 250.345px 211.065px;"
                                                class="animable"></path>
                                        </g>
                                        <g id="elfr49xun7ytb">
                                            <path
                                                d="M369.29,138.47c-.05-.41-.41-.52-.91-.22L254,204.29a3.08,3.08,0,0,0-.9.84l-2.2-1.27a3.18,3.18,0,0,1,.89-.84L366.18,137a2.54,2.54,0,0,1,2.28,0A1.86,1.86,0,0,1,369.29,138.47Z"
                                                style="opacity: 0.2; transform-origin: 310.095px 170.93px;"
                                                class="animable"></path>
                                        </g>
                                        <path
                                            d="M372.09,141.19h0l-.14-1,0-.15s0,0,0,0h0a3.13,3.13,0,0,0-1.25-1.79,2.51,2.51,0,0,0-2.28.05L254,204.29a2,2,0,0,0-.79.9h0a2,2,0,0,0-.2,1.12l2.16,15.1,2.2,1.28,116.75-67.4Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 313.559px 180.345px;"
                                            id="elgpi0gzinycs" class="animable"></path>
                                        <g id="elbyh03kfums">
                                            <path
                                                d="M374.11,155.29l-116.75,67.4-2.15-15.11a2,2,0,0,1,.19-1.12,2.17,2.17,0,0,1,.79-.9l114.4-66a.83.83,0,0,1,1.31.43V140l0,.15.14,1h0Z"
                                                style="opacity: 0.4; transform-origin: 314.653px 181.037px;"
                                                class="animable"></path>
                                        </g>
                                        <g id="elupusgdu70gh">
                                            <path
                                                d="M257.36,222.69l-2.2-1.28L253,206.31a2,2,0,0,1,.2-1.12l2.21,1.27a2,2,0,0,0-.2,1.12Z"
                                                style="opacity: 0.5; transform-origin: 255.174px 213.94px;"
                                                class="animable"></path>
                                        </g>
                                        <g id="el76z6i20bk7f">
                                            <path
                                                d="M371.91,140a.83.83,0,0,0-1.32-.47l-114.4,66a2,2,0,0,0-.78.9l-2.21-1.27a2,2,0,0,1,.79-.9l114.39-66a2.51,2.51,0,0,1,2.28-.05A3,3,0,0,1,371.91,140Z"
                                                style="opacity: 0.3; transform-origin: 312.555px 172.195px;"
                                                class="animable"></path>
                                        </g>
                                        <g id="el5svzosc3qsh">
                                            <g style="opacity: 0.2; transform-origin: 314.155px 179.746px;"
                                                class="animable">
                                                <path
                                                    d="M265.7,207.7a3.94,3.94,0,0,1,1.86-3.62c1.22-.7,2.35-.22,2.54,1.08a3.93,3.93,0,0,1-1.87,3.62A1.54,1.54,0,0,1,265.7,207.7Z"
                                                    id="el2eqie6hdsla" class="animable"
                                                    style="transform-origin: 267.9px 206.451px;"></path>
                                                <path
                                                    d="M281.13,198.8a3.91,3.91,0,0,1,1.87-3.62c1.21-.71,2.35-.22,2.53,1.07a3.94,3.94,0,0,1-1.86,3.63C282.45,200.58,281.31,200.1,281.13,198.8Z"
                                                    id="elugzoa0w7sek" class="animable"
                                                    style="transform-origin: 283.33px 197.528px;"></path>
                                                <path
                                                    d="M296.54,189.9a3.92,3.92,0,0,1,1.86-3.62c1.22-.7,2.35-.22,2.54,1.08a4,4,0,0,1-1.87,3.62C297.86,191.68,296.72,191.2,296.54,189.9Z"
                                                    id="elyd8s5va3hf" class="animable"
                                                    style="transform-origin: 298.738px 188.63px;"></path>
                                                <path
                                                    d="M327.37,172.1a3.92,3.92,0,0,1,1.86-3.62c1.22-.7,2.35-.22,2.54,1.08a3.94,3.94,0,0,1-1.87,3.62C328.69,173.88,327.55,173.4,327.37,172.1Z"
                                                    id="elo3tu1akb2cq" class="animable"
                                                    style="transform-origin: 329.569px 170.83px;"></path>
                                                <path
                                                    d="M342.8,163.19a3.91,3.91,0,0,1,1.87-3.62c1.21-.7,2.35-.22,2.53,1.08a3.92,3.92,0,0,1-1.86,3.62C344.12,165,343,164.49,342.8,163.19Z"
                                                    id="eluj4a4919t8d" class="animable"
                                                    style="transform-origin: 345px 161.927px;"></path>
                                                <path
                                                    d="M358.21,154.29a3.94,3.94,0,0,1,1.86-3.62c1.22-.7,2.35-.22,2.54,1.08a3.93,3.93,0,0,1-1.87,3.62C359.53,156.07,358.39,155.59,358.21,154.29Z"
                                                    id="elyw990iubojo" class="animable"
                                                    style="transform-origin: 360.41px 153.02px;"></path>
                                            </g>
                                        </g>
                                        <path
                                            d="M270.37,203.06a7.23,7.23,0,0,1-.12,1.33,6.56,6.56,0,0,1-.17.67,4.08,4.08,0,0,1-1.84,2.46,3.81,3.81,0,0,1-1.95.51l-.54,0-.06-.29a3.47,3.47,0,0,1,.29-1.77,2,2,0,0,0,1.23-.21,2.56,2.56,0,0,0,1-1.92.38.38,0,0,0,0-.1,6.12,6.12,0,0,0,0-.65,10.68,10.68,0,0,0-2.06-5.85,11.37,11.37,0,0,0-1.46-1.69,8.28,8.28,0,0,0-1.47-1.1,3,3,0,0,0-2.86-.39,2.92,2.92,0,0,0-1.1,2.67,8,8,0,0,0,.23,1.82l-1.85,1.07,0-.12a10.39,10.39,0,0,1-.41-2.77,4.84,4.84,0,0,1,2.14-4.46c1.37-.79,3.11-.65,4.93.39a10.14,10.14,0,0,1,2.27,1.83,12.53,12.53,0,0,1,1.39,1.73A12.83,12.83,0,0,1,270.37,203.06Z"
                                            style="fill: rgb(55, 71, 79); transform-origin: 263.79px 199.897px;"
                                            id="elm10pizpfb3" class="animable"></path>
                                        <path
                                            d="M285.8,194.15a7.15,7.15,0,0,1-.12,1.33,5,5,0,0,1-.16.69,4.12,4.12,0,0,1-1.85,2.44,3.81,3.81,0,0,1-1.95.51l-.53,0a1.36,1.36,0,0,1-.06-.29,3.37,3.37,0,0,1,.28-1.77,2,2,0,0,0,1.23-.21,2.51,2.51,0,0,0,1-1.92.31.31,0,0,0,0-.09,4.41,4.41,0,0,0,0-.66,11.49,11.49,0,0,0-3.52-7.54,7.93,7.93,0,0,0-1.47-1.1,3,3,0,0,0-2.86-.38,2.91,2.91,0,0,0-1.1,2.66,8,8,0,0,0,.23,1.82l-1.85,1.07,0-.12a10.36,10.36,0,0,1-.4-2.77,4.84,4.84,0,0,1,2.13-4.46c1.37-.79,3.12-.65,4.93.39a10.14,10.14,0,0,1,2.27,1.83,13.85,13.85,0,0,1,1.39,1.73A12.75,12.75,0,0,1,285.8,194.15Z"
                                            style="fill: rgb(55, 71, 79); transform-origin: 279.225px 190.987px;"
                                            id="elva069bzsfcp" class="animable"></path>
                                        <path
                                            d="M301.2,185.25a8.36,8.36,0,0,1-.11,1.34,5.2,5.2,0,0,1-.17.68,4,4,0,0,1-1.84,2.44,3.82,3.82,0,0,1-1.95.52,3.15,3.15,0,0,1-.53,0,1.36,1.36,0,0,1-.06-.29,3.37,3.37,0,0,1,.28-1.77,1.88,1.88,0,0,0,1.22-.21,2.5,2.5,0,0,0,1-1.92.28.28,0,0,0,0-.09,4.33,4.33,0,0,0,0-.66,10.73,10.73,0,0,0-2.06-5.84,10.89,10.89,0,0,0-1.46-1.69,8.35,8.35,0,0,0-1.47-1.11,3,3,0,0,0-2.86-.38,2.91,2.91,0,0,0-1.1,2.67,8,8,0,0,0,.23,1.82l-1.86,1.07,0-.13a10.37,10.37,0,0,1-.41-2.76c0-2.09.76-3.67,2.13-4.46s3.12-.66,4.93.39a10.36,10.36,0,0,1,2.28,1.82,13.85,13.85,0,0,1,1.39,1.73A12.82,12.82,0,0,1,301.2,185.25Z"
                                            style="fill: rgb(55, 71, 79); transform-origin: 294.625px 182.106px;"
                                            id="el9vqv0a3rsxv" class="animable"></path>
                                        <path
                                            d="M332,167.48a7.24,7.24,0,0,1-.11,1.33,7,7,0,0,1-.17.69,4.12,4.12,0,0,1-1.85,2.44,3.85,3.85,0,0,1-1.94.51,3.08,3.08,0,0,1-.53,0,1.55,1.55,0,0,1-.07-.31,3.41,3.41,0,0,1,.27-1.75,2,2,0,0,0,1.24-.2,2.55,2.55,0,0,0,1.05-2,.15.15,0,0,1,0-.07,6.18,6.18,0,0,0,0-.65,10.76,10.76,0,0,0-2.07-5.87,10.87,10.87,0,0,0-1.47-1.69,8.15,8.15,0,0,0-1.45-1.08,3,3,0,0,0-2.86-.39,2.94,2.94,0,0,0-1.09,2.67,7.74,7.74,0,0,0,.22,1.79L319.4,164l0-.1a10.37,10.37,0,0,1-.41-2.76c0-2.09.76-3.67,2.13-4.46a4.84,4.84,0,0,1,4.93.39,9.72,9.72,0,0,1,2.26,1.81,14.09,14.09,0,0,1,1.4,1.73A12.87,12.87,0,0,1,332,167.48Z"
                                            style="fill: rgb(55, 71, 79); transform-origin: 325.495px 164.322px;"
                                            id="el2a883o6q33d" class="animable"></path>
                                        <path
                                            d="M347.48,158.57a7.34,7.34,0,0,1-.12,1.34c-.05.24-.1.46-.17.69a4,4,0,0,1-1.84,2.43,3.81,3.81,0,0,1-2,.51,4.71,4.71,0,0,1-.53,0,1.65,1.65,0,0,1-.07-.32,3.34,3.34,0,0,1,.27-1.74,1.93,1.93,0,0,0,1.24-.21,2.52,2.52,0,0,0,1.05-2,.15.15,0,0,0,0-.07,6,6,0,0,0,0-.65,10.63,10.63,0,0,0-2.08-5.86,11,11,0,0,0-1.46-1.7,8.52,8.52,0,0,0-1.45-1.08,3,3,0,0,0-2.86-.38,2.89,2.89,0,0,0-1.1,2.67,8.31,8.31,0,0,0,.22,1.78l-1.85,1.08,0-.1a10.37,10.37,0,0,1-.41-2.76c0-2.09.76-3.68,2.14-4.46s3.12-.66,4.92.38A10,10,0,0,1,343.7,150h0a13.92,13.92,0,0,1,1.4,1.73A12.82,12.82,0,0,1,347.48,158.57Z"
                                            style="fill: rgb(55, 71, 79); transform-origin: 340.9px 155.391px;"
                                            id="el7z4ull024mf" class="animable"></path>
                                        <path
                                            d="M362.88,149.67a7.34,7.34,0,0,1-.12,1.34,6.57,6.57,0,0,1-.16.67,4.11,4.11,0,0,1-1.85,2.46,3.88,3.88,0,0,1-1.95.5l-.52,0a1.65,1.65,0,0,1-.07-.32,3.37,3.37,0,0,1,.27-1.74,2,2,0,0,0,1.24-.21,2.53,2.53,0,0,0,1-2,.13.13,0,0,0,0-.06,4.41,4.41,0,0,0,0-.66,10.65,10.65,0,0,0-2.07-5.86,10.94,10.94,0,0,0-1.47-1.69,8,8,0,0,0-1.44-1.09,3,3,0,0,0-2.86-.38,2.89,2.89,0,0,0-1.1,2.67,7.74,7.74,0,0,0,.22,1.79l-1.86,1.07,0-.1a10.37,10.37,0,0,1-.41-2.76c0-2.09.76-3.67,2.13-4.46a4.86,4.86,0,0,1,4.93.38,10,10,0,0,1,2.25,1.81,12.54,12.54,0,0,1,1.4,1.74A12.79,12.79,0,0,1,362.88,149.67Z"
                                            style="fill: rgb(55, 71, 79); transform-origin: 356.305px 146.491px;"
                                            id="eliiq0wggsm9" class="animable"></path>
                                        <polygon
                                            points="259.91 240.44 376.64 173.1 374.11 155.29 257.36 222.64 259.91 240.44"
                                            style="fill: rgb(206, 228, 116); transform-origin: 317px 197.865px;"
                                            id="elz3rcbphrso" class="animable"></polygon>
                                        <g id="el063ptfi0ewc7">
                                            <g style="opacity: 0.65; transform-origin: 317px 197.865px;"
                                                class="animable">
                                                <polygon
                                                    points="259.91 240.44 376.64 173.1 374.11 155.29 257.36 222.64 259.91 240.44"
                                                    style="fill: rgb(255, 255, 255); transform-origin: 317px 197.865px;"
                                                    id="eljfckqxx8xhi" class="animable"></polygon>
                                            </g>
                                        </g>
                                        <path
                                            d="M269.11,244.76c.15,1,1.06,1.32,2,.75l8.76-5a3.1,3.1,0,0,0,1.52-2.81c-.14-1-1.05-1.32-2-.75l-8.76,5A3.11,3.11,0,0,0,269.11,244.76Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 275.25px 241.23px;"
                                            id="el20u86c4vpm4" class="animable"></path>
                                        <path
                                            d="M283.89,236.23c.14,1,1.05,1.32,2,.75l8.76-5a3.09,3.09,0,0,0,1.53-2.81c-.14-1-1-1.32-2-.75l-8.76,5A3.09,3.09,0,0,0,283.89,236.23Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 290.035px 232.7px;"
                                            id="el8k9fjf9eyy8" class="animable"></path>
                                        <path
                                            d="M298.67,227.7c.14,1,1.05,1.32,2,.75l8.76-5a3.08,3.08,0,0,0,1.52-2.81c-.14-1-1.05-1.32-2-.75l-8.76,5A3.09,3.09,0,0,0,298.67,227.7Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 304.81px 224.17px;"
                                            id="elv4v8si7riw" class="animable"></path>
                                        <path
                                            d="M313.44,219.17c.14,1,1.05,1.32,2,.75l8.76-5.06a3.07,3.07,0,0,0,1.52-2.8c-.14-1-1.05-1.32-2-.76L315,216.36A3.08,3.08,0,0,0,313.44,219.17Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 319.58px 215.614px;"
                                            id="el3wxu7m5kccg" class="animable"></path>
                                        <path
                                            d="M328.22,210.63c.14,1,1,1.32,2,.76l8.76-5.06a3.09,3.09,0,0,0,1.53-2.8c-.14-1-1.05-1.32-2-.76l-8.76,5.06A3.08,3.08,0,0,0,328.22,210.63Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 334.365px 207.08px;"
                                            id="elz9tylhrg6w" class="animable"></path>
                                        <path
                                            d="M343,202.1c.14,1,1.05,1.32,2,.76l8.76-5.06a3.09,3.09,0,0,0,1.52-2.81c-.14-1-1.05-1.32-2-.75l-8.76,5.06A3.08,3.08,0,0,0,343,202.1Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 349.14px 198.546px;"
                                            id="elb3995513ime" class="animable"></path>
                                        <path
                                            d="M357.77,193.57c.14,1,1.05,1.32,2,.75l8.76-5a3.08,3.08,0,0,0,1.53-2.81c-.14-1-1-1.32-2-.75l-8.76,5.06A3.07,3.07,0,0,0,357.77,193.57Z"
                                            style="fill: rgb(206, 228, 116); transform-origin: 363.916px 190.04px;"
                                            id="elvqbltyb1tu" class="animable"></path>
                                        <g id="elwdsi4m2xcgp">
                                            <g style="opacity: 0.17; transform-origin: 324.441px 249.437px;"
                                                class="animable">
                                                <path
                                                    d="M379.8,244.86a.46.46,0,0,1-.49-.36l-7.14-49.84a.37.37,0,0,1,.39-.4.49.49,0,0,1,.5.36l7.13,49.84A.37.37,0,0,1,379.8,244.86Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 376.18px 219.561px;"
                                                    id="el669zxzja0k4" class="animable"></path>
                                                <path
                                                    d="M365,253.4a.46.46,0,0,1-.49-.36l-7.14-49.84a.37.37,0,0,1,.39-.4.46.46,0,0,1,.49.36L365.41,253A.37.37,0,0,1,365,253.4Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 361.39px 228.1px;"
                                                    id="elevticne9gx6" class="animable"></path>
                                                <path
                                                    d="M350.24,261.93a.48.48,0,0,1-.5-.36l-7.13-49.84a.37.37,0,0,1,.38-.4.47.47,0,0,1,.5.36l7.14,49.84A.37.37,0,0,1,350.24,261.93Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 346.62px 236.63px;"
                                                    id="elvvi6v7114u" class="animable"></path>
                                                <path
                                                    d="M335.46,270.47a.48.48,0,0,1-.5-.37l-7.14-49.84a.37.37,0,0,1,.39-.39.47.47,0,0,1,.5.36l7.13,49.84A.37.37,0,0,1,335.46,270.47Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 331.83px 245.17px;"
                                                    id="elax2sxf9guvv" class="animable"></path>
                                                <path
                                                    d="M320.68,279a.47.47,0,0,1-.5-.36L313,228.8a.37.37,0,0,1,.39-.4.48.48,0,0,1,.5.36l7.13,49.84A.37.37,0,0,1,320.68,279Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 317.01px 253.7px;"
                                                    id="elbxk6apfnc" class="animable"></path>
                                                <path
                                                    d="M305.89,287.54a.47.47,0,0,1-.49-.37l-7.14-49.84c0-.21.14-.38.39-.39a.46.46,0,0,1,.49.36l7.14,49.84A.37.37,0,0,1,305.89,287.54Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 302.271px 262.24px;"
                                                    id="elg80zrtckaoc" class="animable"></path>
                                                <path
                                                    d="M291.11,296.07a.48.48,0,0,1-.5-.36l-7.13-49.84a.37.37,0,0,1,.39-.4.46.46,0,0,1,.49.36l7.14,49.84A.37.37,0,0,1,291.11,296.07Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 287.49px 270.77px;"
                                                    id="elepqz0eo679p" class="animable"></path>
                                                <path
                                                    d="M276.33,304.6a.47.47,0,0,1-.5-.36l-7.14-49.84a.38.38,0,0,1,.39-.4.48.48,0,0,1,.5.37l7.14,49.84A.37.37,0,0,1,276.33,304.6Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 272.705px 279.3px;"
                                                    id="eliypv2kvhdco" class="animable"></path>
                                                <path
                                                    d="M271,267.22a.47.47,0,0,1-.41-.17.33.33,0,0,1,.08-.52l103.48-59.75a.51.51,0,0,1,.62.12.33.33,0,0,1-.09.52L271.19,267.16A.42.42,0,0,1,271,267.22Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 322.678px 236.973px;"
                                                    id="elpks67egc45" class="animable"></path>
                                                <path
                                                    d="M272.76,279.68a.5.5,0,0,1-.41-.17.33.33,0,0,1,.09-.52l103.47-59.75a.52.52,0,0,1,.63.12.34.34,0,0,1-.09.52L273,279.62A.39.39,0,0,1,272.76,279.68Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 324.442px 249.432px;"
                                                    id="elb9xn8rmy0an" class="animable"></path>
                                                <path
                                                    d="M274.54,292.14a.5.5,0,0,1-.41-.17.34.34,0,0,1,.09-.53L377.7,231.7a.51.51,0,0,1,.62.12.33.33,0,0,1-.09.52L274.76,292.08A.43.43,0,0,1,274.54,292.14Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 326.225px 261.892px;"
                                                    id="eliiyezl73mxg" class="animable"></path>
                                                <path
                                                    d="M276.33,304.6a.45.45,0,0,1-.23,0,.41.41,0,0,1-.27-.32l-7.14-49.84a.36.36,0,0,1,.18-.34l103.47-59.74a.51.51,0,0,1,.45,0,.44.44,0,0,1,.27.31l7.13,49.84a.34.34,0,0,1-.17.34L276.54,304.54A.37.37,0,0,1,276.33,304.6Zm-6.72-50,7,49,102.66-59.27-7-49Z"
                                                    style="fill: rgb(206, 228, 116); transform-origin: 324.441px 249.461px;"
                                                    id="el66jdhftyceu" class="animable"></path>
                                            </g>
                                        </g>
                                        <g id="ely55pkeiking">
                                            <g style="opacity: 0.17; transform-origin: 324.441px 249.437px;"
                                                class="animable">
                                                <path
                                                    d="M379.8,244.86a.46.46,0,0,1-.49-.36l-7.14-49.84a.37.37,0,0,1,.39-.4.49.49,0,0,1,.5.36l7.13,49.84A.37.37,0,0,1,379.8,244.86Z"
                                                    id="el0kapybppbifh" class="animable"
                                                    style="transform-origin: 376.18px 219.561px;"></path>
                                                <path
                                                    d="M365,253.4a.46.46,0,0,1-.49-.36l-7.14-49.84a.37.37,0,0,1,.39-.4.46.46,0,0,1,.49.36L365.41,253A.37.37,0,0,1,365,253.4Z"
                                                    id="elvfrlmoa4r1j" class="animable"
                                                    style="transform-origin: 361.39px 228.1px;"></path>
                                                <path
                                                    d="M350.24,261.93a.48.48,0,0,1-.5-.36l-7.13-49.84a.37.37,0,0,1,.38-.4.47.47,0,0,1,.5.36l7.14,49.84A.37.37,0,0,1,350.24,261.93Z"
                                                    id="elrzj2k21z2z8" class="animable"
                                                    style="transform-origin: 346.62px 236.63px;"></path>
                                                <path
                                                    d="M335.46,270.47a.48.48,0,0,1-.5-.37l-7.14-49.84a.37.37,0,0,1,.39-.39.47.47,0,0,1,.5.36l7.13,49.84A.37.37,0,0,1,335.46,270.47Z"
                                                    id="elt3upn6vb3np" class="animable"
                                                    style="transform-origin: 331.83px 245.17px;"></path>
                                                <path
                                                    d="M320.68,279a.47.47,0,0,1-.5-.36L313,228.8a.37.37,0,0,1,.39-.4.48.48,0,0,1,.5.36l7.13,49.84A.37.37,0,0,1,320.68,279Z"
                                                    id="elcih24tbs6lk" class="animable"
                                                    style="transform-origin: 317.01px 253.7px;"></path>
                                                <path
                                                    d="M305.89,287.54a.47.47,0,0,1-.49-.37l-7.14-49.84c0-.21.14-.38.39-.39a.46.46,0,0,1,.49.36l7.14,49.84A.37.37,0,0,1,305.89,287.54Z"
                                                    id="elpwqefswk88" class="animable"
                                                    style="transform-origin: 302.271px 262.24px;"></path>
                                                <path
                                                    d="M291.11,296.07a.48.48,0,0,1-.5-.36l-7.13-49.84a.37.37,0,0,1,.39-.4.46.46,0,0,1,.49.36l7.14,49.84A.37.37,0,0,1,291.11,296.07Z"
                                                    id="elu3n315euift" class="animable"
                                                    style="transform-origin: 287.49px 270.77px;"></path>
                                                <path
                                                    d="M276.33,304.6a.47.47,0,0,1-.5-.36l-7.14-49.84a.38.38,0,0,1,.39-.4.48.48,0,0,1,.5.37l7.14,49.84A.37.37,0,0,1,276.33,304.6Z"
                                                    id="elgv2ozycxa6i" class="animable"
                                                    style="transform-origin: 272.705px 279.3px;"></path>
                                                <path
                                                    d="M271,267.22a.47.47,0,0,1-.41-.17.33.33,0,0,1,.08-.52l103.48-59.75a.51.51,0,0,1,.62.12.33.33,0,0,1-.09.52L271.19,267.16A.42.42,0,0,1,271,267.22Z"
                                                    id="el0f7cr2c38cd9" class="animable"
                                                    style="transform-origin: 322.678px 236.973px;"></path>
                                                <path
                                                    d="M272.76,279.68a.5.5,0,0,1-.41-.17.33.33,0,0,1,.09-.52l103.47-59.75a.52.52,0,0,1,.63.12.34.34,0,0,1-.09.52L273,279.62A.39.39,0,0,1,272.76,279.68Z"
                                                    id="elhlvek1rk3n" class="animable"
                                                    style="transform-origin: 324.442px 249.432px;"></path>
                                                <path
                                                    d="M274.54,292.14a.5.5,0,0,1-.41-.17.34.34,0,0,1,.09-.53L377.7,231.7a.51.51,0,0,1,.62.12.33.33,0,0,1-.09.52L274.76,292.08A.43.43,0,0,1,274.54,292.14Z"
                                                    id="eltv340mojtqb" class="animable"
                                                    style="transform-origin: 326.225px 261.892px;"></path>
                                                <path
                                                    d="M276.33,304.6a.45.45,0,0,1-.23,0,.41.41,0,0,1-.27-.32l-7.14-49.84a.36.36,0,0,1,.18-.34l103.47-59.74a.51.51,0,0,1,.45,0,.44.44,0,0,1,.27.31l7.13,49.84a.34.34,0,0,1-.17.34L276.54,304.54A.37.37,0,0,1,276.33,304.6Zm-6.72-50,7,49,102.66-59.27-7-49Z"
                                                    id="elah69axp1mms" class="animable"
                                                    style="transform-origin: 324.441px 249.461px;"></path>
                                            </g>
                                        </g>
                                    </g>
                                    <path
                                        d="M302.23,207.88a7.38,7.38,0,0,1-.23,1.85,6.67,6.67,0,0,1-.63,1.6,5.81,5.81,0,0,1-.92,1.28,5.25,5.25,0,0,1-1.1.88,2.86,2.86,0,0,1-1.15.41,1.47,1.47,0,0,1-.9-.18,1.51,1.51,0,0,1-.6-.76,3.55,3.55,0,0,1-.23-1.32.66.66,0,0,1,.06-.27.35.35,0,0,1,.15-.18l1.24-.72c.12-.07.2-.08.24-.05a.68.68,0,0,1,.12.28.8.8,0,0,0,.36.56c.16.08.4,0,.71-.15a2.09,2.09,0,0,0,.83-.91,3.24,3.24,0,0,0,.27-1.38v-4.16l-3.3,1.91a.15.15,0,0,1-.19,0,.33.33,0,0,1-.07-.24v-1.58a.74.74,0,0,1,.07-.32.5.5,0,0,1,.19-.23L302,201.4a.14.14,0,0,1,.18,0,.29.29,0,0,1,.08.24Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 299.366px 207.639px;"
                                        id="el5929wll4t0o" class="animable"></path>
                                    <path
                                        d="M303.51,208.74a4,4,0,0,1,.49-1.91,6.52,6.52,0,0,1,1.59-1.86l1.13-.95a.76.76,0,0,0-.13-.51c-.08-.11-.23-.1-.43,0a1.13,1.13,0,0,0-.35.29,2.62,2.62,0,0,0-.17.28,1.07,1.07,0,0,1-.17.24.86.86,0,0,1-.18.14l-1.23.71a.15.15,0,0,1-.16,0,.25.25,0,0,1,0-.21,2.65,2.65,0,0,1,.19-.82,5.81,5.81,0,0,1,.48-1,6.19,6.19,0,0,1,.72-.94,4.16,4.16,0,0,1,.92-.73,2.4,2.4,0,0,1,1-.37,1,1,0,0,1,.72.2,1.35,1.35,0,0,1,.42.7,4,4,0,0,1,.14,1.12v4.51a.72.72,0,0,1-.08.32.49.49,0,0,1-.18.23l-1.22.7a.14.14,0,0,1-.18,0,.33.33,0,0,1-.08-.24v-.41a5,5,0,0,1-.58,1,3.13,3.13,0,0,1-.9.78,1.66,1.66,0,0,1-.74.25.8.8,0,0,1-.54-.18,1.2,1.2,0,0,1-.34-.55A3.23,3.23,0,0,1,303.51,208.74Zm2.2-.94a1.27,1.27,0,0,0,.4-.34,2.44,2.44,0,0,0,.32-.49,2.78,2.78,0,0,0,.21-.57,2.61,2.61,0,0,0,.08-.6l-.89.72a2.14,2.14,0,0,0-.42.49,1.06,1.06,0,0,0-.16.56c0,.19,0,.29.12.32S305.56,207.89,305.71,207.8Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 306px 205.677px;"
                                        id="elaezwdg5upgh" class="animable"></path>
                                    <path
                                        d="M315.17,203.8a.67.67,0,0,1-.08.33.49.49,0,0,1-.18.23l-1.22.7a.14.14,0,0,1-.18,0,.33.33,0,0,1-.08-.24V201a1.59,1.59,0,0,0-.2-.91c-.14-.18-.35-.18-.64,0a1.44,1.44,0,0,0-.63.76,2.9,2.9,0,0,0-.2,1.14v3.76a.8.8,0,0,1-.08.33.49.49,0,0,1-.18.23l-1.22.7a.15.15,0,0,1-.19,0,.33.33,0,0,1-.07-.24v-6.94a.78.78,0,0,1,.07-.33.53.53,0,0,1,.19-.22l1.17-.68a.14.14,0,0,1,.18,0,.3.3,0,0,1,.08.23v.35c.05-.13.12-.27.19-.43a3.68,3.68,0,0,1,.28-.45,3.78,3.78,0,0,1,.38-.43,2.78,2.78,0,0,1,.51-.37,1.91,1.91,0,0,1,.85-.29.86.86,0,0,1,.67.23,1.81,1.81,0,0,1,.43.81,5.59,5.59,0,0,1,.15,1.43Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 312.595px 202.125px;"
                                        id="elnmwwczh3t4" class="animable"></path>
                                    <path
                                        d="M316.68,196a.79.79,0,0,1,.08-.32.49.49,0,0,1,.18-.23l1.22-.7a.14.14,0,0,1,.18,0,.33.33,0,0,1,.08.24v3.77a1.79,1.79,0,0,0,.18.92c.13.19.33.2.61,0a1.34,1.34,0,0,0,.61-.73,3.31,3.31,0,0,0,.18-1.13v-3.77a.78.78,0,0,1,.07-.33.47.47,0,0,1,.19-.22l1.22-.71a.14.14,0,0,1,.18,0,.32.32,0,0,1,.08.23V200a.8.8,0,0,1-.08.33.54.54,0,0,1-.18.23l-1.13.64a.14.14,0,0,1-.18,0,.33.33,0,0,1-.08-.24v-.34a3.15,3.15,0,0,1-.19.43,2.61,2.61,0,0,1-.27.44,3.78,3.78,0,0,1-.38.43,3,3,0,0,1-.52.38c-.63.36-1.12.38-1.49,0a3.08,3.08,0,0,1-.56-2.25Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 319.195px 197.667px;"
                                        id="elr28dhnlahbh" class="animable"></path>
                                    <path
                                        d="M323,197.47a4.07,4.07,0,0,1,.49-1.9,6.72,6.72,0,0,1,1.59-1.86l1.13-1a.83.83,0,0,0-.12-.51c-.09-.11-.23-.1-.44,0a1,1,0,0,0-.34.29,3,3,0,0,0-.18.28,1.09,1.09,0,0,1-.16.24.94.94,0,0,1-.19.14l-1.23.71a.15.15,0,0,1-.16,0,.3.3,0,0,1,0-.21,2.75,2.75,0,0,1,.2-.83,5.29,5.29,0,0,1,.47-1,7,7,0,0,1,.73-.94,3.9,3.9,0,0,1,.91-.73,2.48,2.48,0,0,1,1-.37,1,1,0,0,1,.72.2,1.35,1.35,0,0,1,.42.7,4,4,0,0,1,.14,1.12v4.51a.72.72,0,0,1-.08.32.45.45,0,0,1-.19.23l-1.21.7c-.08,0-.14,0-.19,0a.33.33,0,0,1-.08-.24V197a4.54,4.54,0,0,1-.57,1,3,3,0,0,1-.91.78,1.62,1.62,0,0,1-.74.25.84.84,0,0,1-.54-.18,1.28,1.28,0,0,1-.33-.55A2.88,2.88,0,0,1,323,197.47Zm2.21-.93a1.36,1.36,0,0,0,.39-.34,2.07,2.07,0,0,0,.32-.49,3.54,3.54,0,0,0,.22-.57,2.6,2.6,0,0,0,.07-.61l-.89.73a2.14,2.14,0,0,0-.42.49,1.16,1.16,0,0,0-.16.56c0,.18,0,.29.12.32A.44.44,0,0,0,325.22,196.54Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 325.49px 194.402px;"
                                        id="el7f82hc1dubr" class="animable"></path>
                                    <path
                                        d="M333,186.15a.14.14,0,0,1,.18,0c.06,0,.08.12.08.23v1.51a.61.61,0,0,1-.08.32.49.49,0,0,1-.18.23l-.88.51a2,2,0,0,0-.89,1.88v3.66a.78.78,0,0,1-.07.33.57.57,0,0,1-.19.23l-1.22.7a.14.14,0,0,1-.18,0,.33.33,0,0,1-.08-.24v-6.94a.8.8,0,0,1,.08-.33.46.46,0,0,1,.18-.22l1.12-.65c.08,0,.14,0,.19,0a.33.33,0,0,1,.08.24V188a4.1,4.1,0,0,1,.53-.84,2.56,2.56,0,0,1,.75-.64Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 331.375px 190.95px;"
                                        id="elpb34f0iyabt" class="animable"></path>
                                    <path
                                        d="M337.06,194a1.9,1.9,0,0,1-.09.29.49.49,0,0,1-.19.23l-1.26.73a.13.13,0,0,1-.17,0,.32.32,0,0,1-.07-.22s0-.07,0-.11l.74-3.09L334.08,186a.31.31,0,0,1,0-.1.75.75,0,0,1,.06-.29.49.49,0,0,1,.17-.2l1.26-.73a.14.14,0,0,1,.19,0,.69.69,0,0,1,.1.19l1.07,3.25,1.06-4.49a1.25,1.25,0,0,1,.1-.29.48.48,0,0,1,.18-.23l1.28-.73a.12.12,0,0,1,.16,0,.29.29,0,0,1,.07.22.41.41,0,0,1,0,.11Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 336.93px 188.816px;"
                                        id="elksgiuyor9cm" class="animable"></path>
                                    <path
                                        d="M367.91,214.61l.87,1.23a.19.19,0,0,0,.23.07l1.47-.57c.23-.09.37.2.24.49l-.86,1.84a.49.49,0,0,0,0,.35l.5,1.61c.08.26-.13.61-.35.6l-1.4-.09a.3.3,0,0,0-.26.15l-1.16,1.56c-.19.25-.45.18-.46-.12v-1.9a.28.28,0,0,0-.13-.26l-1.21-.64c-.19-.1-.15-.5.07-.67l1.4-1.09a.57.57,0,0,0,.18-.3l.41-2C367.47,214.59,367.77,214.42,367.91,214.61Z"
                                        style="fill: rgb(242, 143, 143); transform-origin: 368.019px 218.266px;"
                                        id="el4o8nx88m2cp" class="animable"></path>
                                    <path
                                        d="M376.44,214.13a5.09,5.09,0,0,0-3.75-4.19c-2.8-.71-4.78,1.21-6.23,2.81-.38.43.44.59.75.29,1.52-1.47,4.51-3,6.63-1.2s1.55,4.57.9,6.64a9.66,9.66,0,0,1-9.2,6.74c-10.1-.23-1.44-15.77,4.36-16.87.47-.09.71-.74.06-.8-3-.3-4.84,2.07-6.46,3.87a17.2,17.2,0,0,0-3.86,6.73c-1.33,4.64,2.41,10.11,8.63,8.07C373.72,224.43,377.53,219.4,376.44,214.13Z"
                                        style="fill: rgb(242, 143, 143); transform-origin: 367.999px 217.092px;"
                                        id="elk7kmynayg6f" class="animable"></path>
                                    <path
                                        d="M304.91,269.06a5.09,5.09,0,0,0-3.75-4.19c-2.8-.71-4.78,1.2-6.23,2.81-.38.42.44.58.75.29,1.52-1.47,4.51-3,6.63-1.2s1.55,4.57.9,6.64a9.66,9.66,0,0,1-9.2,6.74c-10.1-.23-1.44-15.77,4.36-16.87.47-.09.71-.74.06-.81-3-.29-4.84,2.08-6.46,3.88a17.13,17.13,0,0,0-3.86,6.73c-1.33,4.63,2.41,10.11,8.63,8.07C302.19,279.36,306,274.32,304.91,269.06Z"
                                        style="fill: rgb(242, 143, 143); transform-origin: 296.469px 272.017px;"
                                        id="elyfxqx7e8hxe" class="animable"></path>
                                </g>
                            </g>
                            <g id="freepik--Gears--inject-1--inject-73" class="animable"
                                style="transform-origin: 279.58px 85.25px;">
                                <g id="freepik--gears--inject-1--inject-73" class="animable"
                                    style="transform-origin: 279.58px 85.25px;">
                                    <path
                                        d="M337.35,82.21l-1.28-7.44-6.63,4.37a9.15,9.15,0,0,0-2.53-3.06l3.18-8.59-5.91-1.32-4.37,8.32A15.81,15.81,0,0,0,315.27,76l-1.89-6.27-7.08,5.56.47,7.39a39.69,39.69,0,0,0-3.92,5.17L297,87.53l-4.1,9.19,5,2.14a30,30,0,0,0-1,5.83l-6.38,5.86,1.28,7.43,6.64-4.36a9,9,0,0,0,2.52,3.06l-3.18,8.58,5.91,1.32,6.25-6.09c1.44-.22,1.09-2.94,2.66-3.7l1.89,6.26,7.08-5.56-.18-2.91c1.43-1.59,6.84-5.1,8-6.94l1.46-2.42L335,96l-1.91-3.46L331,88.07ZM315.73,106.7c-5.42,4.27-7.08,5.2-8.06-.5s2.19-14.4,7.62-18.67,7.51-4.58,8.49,1.12S321.16,102.43,315.73,106.7Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 313.935px 96.375px;"
                                        id="eluv4ehfe7u8" class="animable"></path>
                                    <polygon points="324.18 66.17 331.91 70.63 327.55 78.95 319.81 74.49 324.18 66.17"
                                        style="fill: rgb(245, 245, 245); transform-origin: 325.86px 72.56px;"
                                        id="el6n68t22n64c" class="animable"></polygon>
                                    <polygon points="343.8 79.23 337.17 83.6 329.44 79.14 336.07 74.77 343.8 79.23"
                                        style="fill: rgb(245, 245, 245); transform-origin: 336.62px 79.185px;"
                                        id="elb1n972h6v7j" class="animable"></polygon>
                                    <polygon points="342.73 100.49 337.71 98.35 329.98 93.89 335 96.03 342.73 100.49"
                                        style="fill: rgb(224, 224, 224); transform-origin: 336.355px 97.19px;"
                                        id="elitzf7g130u" class="animable"></polygon>
                                    <polygon
                                        points="297.82 125.26 305.55 129.72 308.73 121.14 301 116.68 297.82 125.26"
                                        style="fill: rgb(224, 224, 224); transform-origin: 303.275px 123.2px;"
                                        id="elh9gpjtk3j6q" class="animable"></polygon>
                                    <polygon
                                        points="322.26 127.51 314.53 123.05 312.64 116.78 320.37 121.24 322.26 127.51"
                                        style="fill: rgb(224, 224, 224); transform-origin: 317.45px 122.145px;"
                                        id="el1mb60w6du6w" class="animable"></polygon>
                                    <path
                                        d="M345.08,86.66l-1.28-7.43-6.63,4.37a9.19,9.19,0,0,0-2.53-3.07L337.82,72l-5.91-1.32L327.55,79A15.76,15.76,0,0,0,323,80.43l-1.89-6.27L314,79.72l.47,7.39a39,39,0,0,0-3.92,5.17L304.74,92l-4.1,9.19,5,2.14a30,30,0,0,0-1,5.83L298.29,115l1.28,7.43,6.64-4.37a9,9,0,0,0,2.52,3.07l-3.18,8.58,5.91,1.32,4.37-8.32a15.81,15.81,0,0,0,4.54-1.48l1.89,6.27,7.08-5.56-.46-7.39a39.84,39.84,0,0,0,3.91-5.17l5.84.29,4.1-9.19-5-2.14a30,30,0,0,0,1-5.83Zm-21.62,24.5c-5.42,4.27-10.62,3.1-11.6-2.6s2.62-13.78,8.05-18,10.62-3.1,11.61,2.6S328.89,106.89,323.46,111.16Z"
                                        style="fill: rgb(235, 235, 235); transform-origin: 321.685px 100.855px;"
                                        id="eloi8tkrm33nb" class="animable"></path>
                                    <polygon points="321.11 74.16 313.38 69.7 306.3 75.26 314.03 79.72 321.11 74.16"
                                        style="fill: rgb(245, 245, 245); transform-origin: 313.705px 74.71px;"
                                        id="elqy5lq36mku" class="animable"></polygon>
                                    <polygon points="306.3 75.26 306.77 82.65 314.5 87.11 314.03 79.72 306.3 75.26"
                                        style="fill: rgb(224, 224, 224); transform-origin: 310.4px 81.185px;"
                                        id="el8mszjpnh3j8" class="animable"></polygon>
                                    <polygon points="310.58 92.28 302.85 87.82 297.01 87.53 304.74 91.99 310.58 92.28"
                                        style="fill: rgb(245, 245, 245); transform-origin: 303.795px 89.905px;"
                                        id="eln5lrbzxq7e8" class="animable"></polygon>
                                    <polygon points="297.01 87.53 292.91 96.72 300.64 101.18 304.74 91.99 297.01 87.53"
                                        style="fill: rgb(224, 224, 224); transform-origin: 298.825px 94.355px;"
                                        id="elm5xx6f0e3d9" class="animable"></polygon>
                                    <polygon
                                        points="304.67 109.15 296.94 104.69 290.56 110.55 298.3 115.01 304.67 109.15"
                                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 109.85px;"
                                        id="elu4oh3edhzfb" class="animable"></polygon>
                                    <polygon
                                        points="299.57 122.44 291.84 117.98 290.56 110.55 298.3 115.01 299.57 122.44"
                                        style="fill: rgb(224, 224, 224); transform-origin: 295.065px 116.495px;"
                                        id="elj7up1x6xdgc" class="animable"></polygon>
                                    <polygon points="331.91 70.63 324.18 66.17 330.09 67.49 337.82 71.95 331.91 70.63"
                                        style="fill: rgb(245, 245, 245); transform-origin: 331px 69.06px;"
                                        id="eluagw9zm3uh" class="animable"></polygon>
                                    <path
                                        d="M276,67V55.89l-8.84,4a15.65,15.65,0,0,0-2.38-5.25l5.56-11.23-6.79-3.92L256.57,49.9a15.75,15.75,0,0,0-5.75.56l-1-9.64-9.61,5.55-1,10.76a46.76,46.76,0,0,0-5.74,6.07l-6.94-2.42-6.8,11.77,5.57,4.8a48.41,48.41,0,0,0-2.39,8l-8.83,6.22v11.1l8.83-4a15.92,15.92,0,0,0,2.39,5.26l-5.57,11.22,6.8,3.92,6.94-10.43a15.71,15.71,0,0,0,5.74-.56l1,9.64,9.61-5.55,1-10.76a18,18,0,0,0,7.71-5.4l5,1.75L270.3,86l-4.17-3.6c1-2.65,1.15-6.89,1-9.21ZM245.05,94.7c-7.38,4.26-12,1.24-12-7.27s6.09-19,13.47-23.21,11.84-1.16,11.84,7.36S252.42,90.45,245.05,94.7Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 245.04px 79.28px;"
                                        id="el72e6xvdvwsl" class="animable"></path>
                                    <polygon points="271.24 43.93 263.5 39.47 256.57 49.9 264.3 54.36 271.24 43.93"
                                        style="fill: rgb(245, 245, 245); transform-origin: 263.905px 46.915px;"
                                        id="elmhtcfbr82oc" class="animable"></polygon>
                                    <polygon points="283.69 60.35 275.96 55.89 267.12 59.87 274.85 64.33 283.69 60.35"
                                        style="fill: rgb(245, 245, 245); transform-origin: 275.405px 60.11px;"
                                        id="elxw3vxstemm" class="animable"></polygon>
                                    <polygon
                                        points="247.97 122.21 240.24 117.75 239.27 108.11 247 112.57 247.97 122.21"
                                        style="fill: rgb(224, 224, 224); transform-origin: 243.62px 115.16px;"
                                        id="ellfi34b0e5w" class="animable"></polygon>
                                    <polygon
                                        points="219.79 115.18 227.52 119.64 233.09 108.41 225.36 103.96 219.79 115.18"
                                        style="fill: rgb(224, 224, 224); transform-origin: 226.44px 111.8px;"
                                        id="elwr2xsqkhz7e" class="animable"></polygon>
                                    <path
                                        d="M283.69,71.45V60.35l-8.84,4a15.71,15.71,0,0,0-2.38-5.26L278,47.85l-6.79-3.92L264.3,54.36a15.75,15.75,0,0,0-5.75.56l-1-9.64L248,50.83l-1,10.76a46.76,46.76,0,0,0-5.74,6.07l-6.94-2.42L227.52,77l5.57,4.8a48.41,48.41,0,0,0-2.39,8L221.87,96v11.1l8.83-4a15.86,15.86,0,0,0,2.39,5.25l-5.57,11.23,6.8,3.92,6.94-10.43a15.71,15.71,0,0,0,5.74-.56l1,9.64,9.61-5.55,1-10.76a47.51,47.51,0,0,0,5.75-6.07l6.94,2.42L278,90.48l-5.56-4.8a47.42,47.42,0,0,0,2.38-8ZM252.78,99.16c-7.38,4.26-13.35.81-13.35-7.71s6-18.87,13.35-23.13,13.35-.8,13.35,7.71S260.15,94.9,252.78,99.16Z"
                                        style="fill: rgb(235, 235, 235); transform-origin: 252.78px 83.715px;"
                                        id="elgoegffpl2k5" class="animable"></path>
                                    <polygon points="233.53 63.2 241.26 67.66 234.32 65.24 226.59 60.78 233.53 63.2"
                                        style="fill: rgb(245, 245, 245); transform-origin: 233.925px 64.22px;"
                                        id="eluk7q2jbweyg" class="animable"></polygon>
                                    <g id="ellhun7bk7rt">
                                        <rect x="220.26" y="64.43" width="13.59" height="8.92"
                                            style="fill: rgb(245, 245, 245); transform-origin: 227.055px 68.89px; transform: rotate(-60.03deg);"
                                            class="animable"></rect>
                                    </g>
                                    <polygon points="219.79 72.55 227.52 77.01 233.09 81.81 225.36 77.35 219.79 72.55"
                                        style="fill: rgb(224, 224, 224); transform-origin: 226.44px 77.18px;"
                                        id="el8fbf29l8e0n" class="animable"></polygon>
                                    <polygon points="222.97 85.36 230.7 89.82 221.87 96.04 214.14 91.58 222.97 85.36"
                                        style="fill: rgb(245, 245, 245); transform-origin: 222.42px 90.7px;"
                                        id="elwsht0qf8fx" class="animable"></polygon>
                                    <polygon
                                        points="214.14 91.58 221.87 96.04 221.87 107.14 214.14 102.68 214.14 91.58"
                                        style="fill: rgb(224, 224, 224); transform-origin: 218.005px 99.36px;"
                                        id="eltrasr0t4odk" class="animable"></polygon>
                                    <polygon points="257.58 45.28 249.85 40.82 240.24 46.37 247.97 50.83 257.58 45.28"
                                        style="fill: rgb(245, 245, 245); transform-origin: 248.91px 45.825px;"
                                        id="elqul0l3xsm7" class="animable"></polygon>
                                </g>
                            </g>
                            <g id="freepik--Wrench--inject-1--inject-73" class="animable"
                                style="transform-origin: 191.43px 392.402px;">
                                <g id="freepik--wrench--inject-1--inject-73" class="animable"
                                    style="transform-origin: 191.43px 392.402px;">
                                    <path
                                        d="M249.61,373a1.38,1.38,0,0,1-.21.74,11.66,11.66,0,0,1-4.07,3.6c-5,2.83-12.14,3.58-18.29,2.29l-60.76,35.08.11.19,1-.16v3.45c0,2.6-1.73,5.21-5.21,7.18-6.88,3.92-18,3.87-24.75-.11l-.44-.27a.58.58,0,0,1-.25-.46v-3.25l15.82.91,2.31-4.82-1.29-.76-4.78-2.8L134,415.92a.66.66,0,0,1-.75-.65v-3.62l4.28-.71s12.14-3.59,18.3-2.29l60.75-35.08a6.42,6.42,0,0,1-1.05-3.61s0-3.42,0-3.42l.92.33a11.24,11.24,0,0,1,4.29-4c6.89-3.92,25.43-2.8,25.43-2.8v3.38a.32.32,0,0,1-.28.32l-15.53,2.28-1,2.12-1.3,2.7,6.08,3.56L249.24,369l.37.65Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 191.43px 394.1px;"
                                        id="el32bbjl5fcuy" class="animable"></path>
                                    <path
                                        d="M154.82,413.88l-1.29,2.7-4.78-2.8L134,415.92a.66.66,0,0,1-.75-.65v-3.62l15.47-1.33Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 144.035px 413.45px;"
                                        id="elexwaerqjh1v" class="animable"></path>
                                    <path
                                        d="M230.38,362.63l15.81-2.55v3.41a.32.32,0,0,1-.28.32l-15.53,2.28-1,2.12-1.29-.76Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 237.14px 364.145px;"
                                        id="elysl0fzj0oa" class="animable"></path>
                                    <polygon
                                        points="227.04 379.6 227.04 376.14 166.28 411.22 166.28 414.68 227.04 379.6"
                                        style="fill: rgb(55, 71, 79); transform-origin: 196.66px 395.41px;"
                                        id="elsj2h5wtuag" class="animable"></polygon>
                                    <path
                                        d="M137.57,407.48a11.62,11.62,0,0,0-4.16,3.72.82.82,0,0,0,.8,1.25l14.54-2.13,6.07,3.56-2.31,4.83-15.22,2.23c-.57.08-.76.31-.46.5l.55.34c6.79,4,17.87,4,24.75.11,5.05-2.87,6.43-7.07,4.15-10.67L227,376.14c6.15,1.3,13.31.55,18.29-2.28a11.75,11.75,0,0,0,4.15-3.72.82.82,0,0,0-.81-1.25L234.15,371l-6.07-3.56,2.3-4.83,15.23-2.23c.54-.08.73-.32.45-.5l-.55-.34c-6.78-4-17.86-4-24.75-.11-5,2.87-6.42,7.07-4.15,10.67L155.86,405.2C149.7,403.9,142.55,404.65,137.57,407.48Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 191.425px 390.66px;"
                                        id="el7w8ha2d7xb" class="animable"></path>
                                </g>
                            </g>
                            <g id="freepik--Books--inject-1--inject-73" class="animable"
                                style="transform-origin: 386.047px 308.206px;">
                                <g id="freepik--books--inject-1--inject-73" class="animable"
                                    style="transform-origin: 386.047px 308.206px;">
                                    <polygon
                                        points="322.79 328.32 374.04 357.76 447.41 315.4 396.16 285.96 322.79 328.32"
                                        style="fill: rgb(69, 90, 100); transform-origin: 385.1px 321.86px;"
                                        id="eluqai4nvz86j" class="animable"></polygon>
                                    <path
                                        d="M374.51,356,324.7,327.22q1.53-4.39-.22-10.27L374,345.47S374.79,348,374.51,356Z"
                                        style="fill: rgb(245, 245, 245); transform-origin: 349.525px 336.475px;"
                                        id="el4ttcf5z6zrb" class="animable"></path>
                                    <path
                                        d="M372,342.26a8.39,8.39,0,0,1,3.78,6.55v7.65c0,2.41-1.7,3.39-3.78,2.19l-49.25-28.43v-1.9l48.72,28c1.26.72,2.27.14,2.27-1.31l0-7.09a5,5,0,0,0-2.27-3.93l-48.68-28v-2.15Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 349.265px 336.501px;"
                                        id="els9b8ve53l1e" class="animable"></path>
                                    <path
                                        d="M322.79,313.84l73.37-42.36L445.4,299.9a8.36,8.36,0,0,1,3.78,6.55v7.66a2.64,2.64,0,0,1-1.11,2.44l-73.36,42.36a2.66,2.66,0,0,0,1.1-2.44v-7.66a8.35,8.35,0,0,0-3.78-6.55Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 385.992px 315.195px;"
                                        id="elogoj67ypua" class="animable"></path>
                                    <path
                                        d="M374.71,345.08a7.68,7.68,0,0,1,1.11,3.73v7.66a2.66,2.66,0,0,1-1.1,2.44l73.36-42.36a2.64,2.64,0,0,0,1.11-2.44v-7.66a7.65,7.65,0,0,0-1.11-3.72Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 411.957px 330.82px;"
                                        id="el5ip2w4fw5q9" class="animable"></path>
                                    <polygon
                                        points="339.36 310.65 380.16 334.05 447.56 295.14 406.76 271.74 339.36 310.65"
                                        style="fill: rgb(206, 228, 116); transform-origin: 393.46px 302.895px;"
                                        id="eletvod5hlz6p" class="animable"></polygon>
                                    <g id="el8ofysqfrf89">
                                        <polygon
                                            points="339.36 310.65 380.16 334.05 447.56 295.14 406.76 271.74 339.36 310.65"
                                            style="opacity: 0.35; transform-origin: 393.46px 302.895px;"
                                            class="animable"></polygon>
                                    </g>
                                    <path
                                        d="M380.62,332.27l-39.36-22.72q1.55-4.4-.21-10.27l39.11,22.48S380.9,324.24,380.62,332.27Z"
                                        style="fill: rgb(235, 235, 235); transform-origin: 360.867px 315.775px;"
                                        id="elybi1aj3rnsp" class="animable"></path>
                                    <path
                                        d="M380.62,332.27l-39.36-22.72q1.55-4.4-.21-10.27l39.11,22.48S380.9,324.24,380.62,332.27Z"
                                        style="fill: rgb(245, 245, 245); transform-origin: 360.867px 315.775px;"
                                        id="elx9omin3hqgg" class="animable"></path>
                                    <path
                                        d="M378.15,318.56a8.33,8.33,0,0,1,3.78,6.55v7.65c0,2.41-1.69,3.39-3.78,2.18l-38.79-22.39v-1.9l38.27,22c1.25.72,2.26.13,2.26-1.31l0-7.09a5,5,0,0,0-2.27-3.93l-38.23-22v-2.15Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 360.645px 315.814px;"
                                        id="elbgijucmfiq" class="animable"></path>
                                    <g id="eldjjvfwlos5">
                                        <path
                                            d="M378.15,318.56a8.33,8.33,0,0,1,3.78,6.55v7.65c0,2.41-1.69,3.39-3.78,2.18l-38.79-22.39v-1.9l38.27,22c1.25.72,2.26.13,2.26-1.31l0-7.09a5,5,0,0,0-2.27-3.93l-38.23-22v-2.15Z"
                                            style="opacity: 0.25; transform-origin: 360.645px 315.814px;"
                                            class="animable"></path>
                                    </g>
                                    <path
                                        d="M339.36,296.17l67.4-38.92,38.79,22.39a8.39,8.39,0,0,1,3.78,6.55v7.66a2.64,2.64,0,0,1-1.11,2.44l-67.4,38.92a2.68,2.68,0,0,0,1.11-2.45V325.1a8.36,8.36,0,0,0-3.78-6.55Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 394.352px 296.23px;"
                                        id="elw1f5e7p8ep9" class="animable"></path>
                                    <g id="el4bh30a91wn2">
                                        <path
                                            d="M380.83,321.38a7.74,7.74,0,0,1,1.1,3.72v7.66a2.68,2.68,0,0,1-1.11,2.45l67.4-38.92a2.64,2.64,0,0,0,1.11-2.44v-7.66a7.76,7.76,0,0,0-1.11-3.72Z"
                                            style="opacity: 0.15; transform-origin: 415.082px 308.84px;"
                                            class="animable"></path>
                                    </g>
                                </g>
                            </g>
                            <g id="freepik--List--inject-1--inject-73" class="animable animator-active"
                                style="transform-origin: 299.93px 409.739px;">
                                <g id="freepik--list--inject-1--inject-73" class="animable"
                                    style="transform-origin: 299.93px 409.739px;">
                                    <path
                                        d="M382.58,401.13v1.7a1.85,1.85,0,0,1-.84,1.46L287.4,458.76a1.91,1.91,0,0,1-1.68,0l-67.58-39a1.85,1.85,0,0,1-.84-1.46v-1.69a1.85,1.85,0,0,1,.84-1.46l94.34-54.47a1.84,1.84,0,0,1,1.68,0l67.58,39A1.84,1.84,0,0,1,382.58,401.13Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 299.94px 409.716px;"
                                        id="eli4i22tbkndq" class="animable"></path>
                                    <g id="el6h2d7sq8a3e">
                                        <path
                                            d="M218,415.21c-.34.27-.31.65.12.89l67.58,39a1.63,1.63,0,0,0,.84.2V459a1.77,1.77,0,0,1-.84-.2l-67.58-39a1.85,1.85,0,0,1-.84-1.46v-1.69A1.87,1.87,0,0,1,218,415.21Z"
                                            style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 251.91px 437.105px;"
                                            class="animable"></path>
                                    </g>
                                    <g id="elb3twtholz1">
                                        <path
                                            d="M381.88,399.78l0,0,.07.06,0,0,.12.12h0a1.81,1.81,0,0,1,.42.91.71.71,0,0,1,0,.2v1.7a1.9,1.9,0,0,1-.84,1.46L287.4,458.76a1.77,1.77,0,0,1-.84.2v-3.64a1.56,1.56,0,0,0,.84-.2l94.35-54.47a.65.65,0,0,0,.31-.33.43.43,0,0,0-.1-.46A.3.3,0,0,0,381.88,399.78Z"
                                            style="opacity: 0.15; transform-origin: 334.529px 429.37px;"
                                            class="animable"></path>
                                    </g>
                                    <path
                                        d="M357,375.73c0-.63-.38-1.26-1.4-1.85a6.27,6.27,0,0,0-3-.8h-.26c-2.63,0-5.37,1.22-7.7,1.56h-.1c-3.27.45-5-.57-6.6-.73a7.15,7.15,0,0,0-.78,0c-.36,0-.71,0-1.1,0a22.75,22.75,0,0,1-4.26-.09c-1.13-.12-2-.18-2.59-.19H329a3.41,3.41,0,0,0-1.91.37l-3.78,2.19v1.25l28.32,16.36,3.78-2.19a1.11,1.11,0,0,0,.64-1.15v-1.24a5.31,5.31,0,0,0-.31-1.6,6.49,6.49,0,0,1-.22-.94,6.46,6.46,0,0,0,.12-.89c0-.15,0-1,0-1.28a1.39,1.39,0,0,0-.07-.44c-.18-.64-1.07-1.31-1.36-2.27a2.79,2.79,0,0,1,.12-.34c.59-1.36,2.71-3,2.71-4.47C357,376.8,357,376,357,375.73Zm-5.82,3.62a7.27,7.27,0,0,1-2.05.79,5.68,5.68,0,0,1-3.85-.3,1.8,1.8,0,0,1-.68-.66,3.64,3.64,0,0,1,1.53-1.48,7.18,7.18,0,0,1,5.18-.78,3,3,0,0,1,.71.29,1.8,1.8,0,0,1,.68.66A3.55,3.55,0,0,1,351.22,379.35Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 340.175px 383.44px;"
                                        id="eljsuayrhnfrj" class="animable"></path>
                                    <path
                                        d="M327.09,374l-3.78,2.19,28.32,16.35,3.78-2.18c.48-.28,1-.66.33-2.74s.13-2.6-.17-3.55-2.07-1.95-1.24-3.87,4.77-4.33,1.31-6.33a6.27,6.27,0,0,0-3-.8h-.26c-2.63,0-5.37,1.22-7.7,1.56h-.1c-3.27.45-5-.57-6.6-.73a7.15,7.15,0,0,0-.78,0c-.36,0-.71,0-1.1,0a22.75,22.75,0,0,1-4.26-.09c-1.13-.12-2-.18-2.59-.19H329A3.41,3.41,0,0,0,327.09,374Zm23.36,14.66a1.76,1.76,0,0,1,1.56-.14c.37.22.26.62-.23.91a1.77,1.77,0,0,1-1.55.13C349.85,389.35,350,389,350.45,388.67Zm-4.28-12.23a7.23,7.23,0,0,1,5.18-.78,3,3,0,0,1,.71.29c1.39.81,1,2.33-.84,3.41a7.56,7.56,0,0,1-2.05.78,5.68,5.68,0,0,1-3.85-.3C343.93,379,344.31,377.51,346.17,376.44Zm-17.57-.39a1.77,1.77,0,0,1,1.55-.13c.38.22.28.62-.22.9a1.75,1.75,0,0,1-1.56.13C328,376.74,328.11,376.33,328.6,376.05Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 340.175px 382.805px;"
                                        id="elz0g3h6kugbp" class="animable"></path>
                                    <path
                                        d="M289.18,449.19l-58.81-33.95a1.11,1.11,0,0,1-.51-.87v-.66a1.11,1.11,0,0,1,.51-.87L308.07,368a1.12,1.12,0,0,1,1,0l58.81,33.95a1.13,1.13,0,0,1,.5.88v.65a1.13,1.13,0,0,1-.5.87l-77.7,44.86A1.06,1.06,0,0,1,289.18,449.19Z"
                                        style="fill: rgb(245, 245, 245); transform-origin: 299.12px 408.604px;"
                                        id="el00ctesv12lmo9" class="animable"></path>
                                    <path
                                        d="M230.24,412.93c-.14.16-.1.36.13.49l58.81,34a1,1,0,0,0,.5.12v1.81a.93.93,0,0,1-.5-.12l-58.81-33.95a1.08,1.08,0,0,1-.5-.87v-.66A1.21,1.21,0,0,1,230.24,412.93Z"
                                        style="fill: rgb(250, 250, 250); transform-origin: 259.775px 431.14px;"
                                        id="elnloxoztno6i" class="animable"></path>
                                    <path
                                        d="M368,402l.14.14.06.08a1.71,1.71,0,0,1,.14.27,1.21,1.21,0,0,1,.05.18.57.57,0,0,1,0,.13v.65a1.1,1.1,0,0,1-.5.87l-77.7,44.86a1,1,0,0,1-.51.12V447.5a1.07,1.07,0,0,0,.51-.12l77.7-44.86C368.12,402.38,368.16,402.17,368,402Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 329.037px 425.65px;"
                                        id="ell63x18vouzi" class="animable"></path>
                                    <polygon
                                        points="303.18 378.07 312.63 383.45 303.18 388.9 293.73 383.53 303.18 378.07"
                                        style="fill: rgb(250, 250, 250); transform-origin: 303.18px 383.485px;"
                                        id="eltavjx2mru3" class="animable"></polygon>
                                    <path
                                        d="M303.18,378.52l-8.67,5,8.67,4.93,8.67-5Zm-9.78,5.2a.41.41,0,0,1,0-.19.39.39,0,0,1,.19-.34l9.45-5.45a.37.37,0,0,1,.38,0l9.45,5.37a.4.4,0,0,1,0,.68l-9.45,5.45a.37.37,0,0,1-.38,0l-9.45-5.38A.32.32,0,0,1,293.4,383.72Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 303.224px 383.49px;"
                                        id="elxkazjn5soym" class="animable"></path>
                                    <path
                                        d="M317,386.37l-.68.39a.41.41,0,0,0,0,.78l33.29,19.22a1.5,1.5,0,0,0,1.34,0l.69-.4a.41.41,0,0,0,0-.77l-33.29-19.22A1.46,1.46,0,0,0,317,386.37Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 333.973px 396.561px;"
                                        id="eljv1pcfq0ew" class="animable"></path>
                                    <path
                                        d="M312.89,388.75l-.68.39c-.37.22-.37.57,0,.78l33.28,19.22a1.53,1.53,0,0,0,1.35,0l.68-.4a.41.41,0,0,0,0-.77l-33.29-19.22A1.5,1.5,0,0,0,312.89,388.75Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 329.861px 398.944px;"
                                        id="elmi5ozf98y2i" class="animable"></path>
                                    <path
                                        d="M308.79,391.12l-.69.39a.41.41,0,0,0,0,.78l33.29,19.22a1.5,1.5,0,0,0,1.34,0l.69-.4a.41.41,0,0,0,0-.77l-33.29-19.22A1.44,1.44,0,0,0,308.79,391.12Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 325.753px 401.311px;"
                                        id="el0vt44o2d5roc" class="animable"></path>
                                    <polygon
                                        points="300.77 385.06 301.5 382.12 303.69 381.94 303.28 383.61 315.33 382.62 315.02 383.88 300.77 385.06"
                                        style="fill: rgb(206, 228, 116); transform-origin: 308.05px 383.5px;"
                                        id="el1v19irby0bo" class="animable"></polygon>
                                    <polygon
                                        points="285.86 388.07 295.31 393.45 285.86 398.9 276.42 393.52 285.86 388.07"
                                        style="fill: rgb(250, 250, 250); transform-origin: 285.865px 393.485px;"
                                        id="elk5h7cs03ua" class="animable"></polygon>
                                    <path
                                        d="M285.86,388.52l-8.66,5,8.66,4.93,8.67-5Zm-9.78,5.2a.41.41,0,0,1-.05-.19.39.39,0,0,1,.19-.34l9.45-5.45a.37.37,0,0,1,.38,0l9.45,5.37a.4.4,0,0,1,.2.34.37.37,0,0,1-.2.33l-9.44,5.46a.39.39,0,0,1-.39,0l-9.44-5.38A.4.4,0,0,1,276.08,393.72Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 285.865px 393.49px;"
                                        id="elubjrey3gn1" class="animable"></path>
                                    <path
                                        d="M299.7,396.37l-.68.39c-.38.21-.38.56,0,.78l33.28,19.22a1.5,1.5,0,0,0,1.34,0l.69-.4a.41.41,0,0,0,0-.77L301,396.37A1.44,1.44,0,0,0,299.7,396.37Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 316.667px 406.566px;"
                                        id="el4usut34kxz4" class="animable"></path>
                                    <path
                                        d="M295.57,398.75l-.68.39a.41.41,0,0,0,0,.78l33.29,19.22a1.5,1.5,0,0,0,1.34,0l.68-.4c.38-.21.38-.56,0-.77l-33.28-19.22A1.46,1.46,0,0,0,295.57,398.75Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 312.546px 408.941px;"
                                        id="el8068e3qi3mt" class="animable"></path>
                                    <path
                                        d="M291.47,401.12l-.68.39a.41.41,0,0,0,0,.78l33.28,19.22a1.53,1.53,0,0,0,1.35,0l.68-.4a.41.41,0,0,0,0-.77l-33.29-19.22A1.44,1.44,0,0,0,291.47,401.12Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 308.438px 411.311px;"
                                        id="elg4xcmzdtrqg" class="animable"></path>
                                    <polygon
                                        points="283.46 395.06 284.19 392.12 286.38 391.94 285.96 393.61 298.02 392.62 297.7 393.88 283.46 395.06"
                                        style="fill: rgb(206, 228, 116); transform-origin: 290.74px 393.5px;"
                                        id="el4o8v7pfnn48" class="animable"></polygon>
                                    <path
                                        d="M268.55,398.52l-8.67,5,8.67,4.93,8.66-5Zm-9.78,5.2a.36.36,0,0,1-.06-.2.38.38,0,0,1,.2-.33l9.44-5.46a.41.41,0,0,1,.39,0l9.44,5.38a.4.4,0,0,1,.2.34.39.39,0,0,1-.19.33l-9.45,5.45a.41.41,0,0,1-.39,0l-9.44-5.38A.38.38,0,0,1,258.77,403.72Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 268.545px 403.48px;"
                                        id="el7c4s66eoafe" class="animable"></path>
                                    <path
                                        d="M282.38,406.36l-.68.4a.41.41,0,0,0,0,.77L315,426.75a1.44,1.44,0,0,0,1.34,0l.68-.39a.41.41,0,0,0,0-.78l-33.29-19.22A1.5,1.5,0,0,0,282.38,406.36Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 299.367px 416.557px;"
                                        id="el5aypdiqr5up" class="animable"></path>
                                    <path
                                        d="M278.26,408.75l-.69.39a.41.41,0,0,0,0,.77l33.29,19.23a1.5,1.5,0,0,0,1.34,0l.69-.4a.41.41,0,0,0,0-.77L279.6,408.75A1.44,1.44,0,0,0,278.26,408.75Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 295.23px 418.941px;"
                                        id="el2qwss6ixxw7" class="animable"></path>
                                    <path
                                        d="M274.15,411.11l-.68.4a.41.41,0,0,0,0,.77l33.29,19.22a1.44,1.44,0,0,0,1.34,0l.69-.39a.41.41,0,0,0,0-.78L275.5,411.11A1.53,1.53,0,0,0,274.15,411.11Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 291.137px 421.309px;"
                                        id="el98no5c7zw9" class="animable"></path>
                                    <polygon
                                        points="265.91 405.46 266.64 402.52 268.83 402.34 268.42 404.02 280.47 403.02 280.16 404.29 265.91 405.46"
                                        style="fill: rgb(206, 228, 116); transform-origin: 273.19px 403.9px;"
                                        id="eldgzm4t1n4xu" class="animable"></polygon>
                                    <path
                                        d="M251.23,408.51l-8.67,5,8.67,4.93,8.67-5Zm-9.78,5.2a.38.38,0,0,1,0-.19.39.39,0,0,1,.19-.34l9.45-5.45a.37.37,0,0,1,.38,0l9.45,5.38a.37.37,0,0,1,.19.33.39.39,0,0,1-.19.34l-9.45,5.45a.37.37,0,0,1-.38,0l-9.45-5.37A.4.4,0,0,1,241.45,413.71Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 251.274px 413.48px;"
                                        id="elgh60xlrczul" class="animable"></path>
                                    <path
                                        d="M265.07,416.36l-.69.4a.41.41,0,0,0,0,.77l33.29,19.22a1.44,1.44,0,0,0,1.34,0l.69-.39c.37-.22.37-.57,0-.78l-33.29-19.22A1.5,1.5,0,0,0,265.07,416.36Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 282.044px 426.559px;"
                                        id="elbdoabtlnvz" class="animable"></path>
                                    <path
                                        d="M260.94,418.74l-.68.4a.41.41,0,0,0,0,.77l33.28,19.22a1.46,1.46,0,0,0,1.35,0l.68-.39a.41.41,0,0,0,0-.78l-33.29-19.22A1.5,1.5,0,0,0,260.94,418.74Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 277.922px 428.939px;"
                                        id="elx0ylasdz9kn" class="animable"></path>
                                    <path
                                        d="M256.84,421.11l-.69.4a.41.41,0,0,0,0,.77l33.29,19.22a1.44,1.44,0,0,0,1.34,0l.69-.39a.41.41,0,0,0,0-.78l-33.29-19.22A1.5,1.5,0,0,0,256.84,421.11Z"
                                        style="fill: rgb(224, 224, 224); transform-origin: 273.817px 431.309px;"
                                        id="elxbahpf7nqz" class="animable"></path>
                                    <polygon
                                        points="248.37 415.87 249.1 412.93 251.29 412.75 250.87 414.42 262.93 413.43 262.61 414.69 248.37 415.87"
                                        style="fill: rgb(206, 228, 116); transform-origin: 255.65px 414.31px;"
                                        id="elak8voe6izs" class="animable"></polygon>
                                    <path
                                        d="M346.52,391.3,342.33,388a2.76,2.76,0,0,1-.24-.34l.12-.12,1-.95,3.25-3a.81.81,0,0,0,.31-.63v-1.26a1.33,1.33,0,0,0-.37-.84,3.3,3.3,0,0,1-.68-1.61,2.6,2.6,0,0,1,.77-1.48,3.38,3.38,0,0,0,1.21-3.23,3.43,3.43,0,0,0-2.1-3.74,7.19,7.19,0,0,0-3.2-.77h-.14a7.24,7.24,0,0,0-4.82,1.71,6.33,6.33,0,0,1-3.13,1.19,9,9,0,0,1-2.88,0,5.72,5.72,0,0,0-.66-.07h-.07a1.71,1.71,0,0,0-1.33.43l-2.8,2.6-1,.95-.05,0a2.56,2.56,0,0,1-2.36.34c-1.54-.65-2.27-1-4.78-2.15a5.65,5.65,0,0,0-2.31-.47h0a7.62,7.62,0,0,0-3.38.85v1.26l34.65,20a3,3,0,0,0,.66-1.73V393.8A3.48,3.48,0,0,0,346.52,391.3Zm-7.15-17.47a4.72,4.72,0,0,1,4.53-.8,3.48,3.48,0,0,1,.48.21,2.5,2.5,0,0,1,1.23,1.29,2.4,2.4,0,0,1-.67,1,4,4,0,0,1-1.39.8,4.82,4.82,0,0,1-3.64-.22,1.18,1.18,0,0,1-.54-2.25Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 330.345px 383.349px;"
                                        id="el5r5t4ijk5j5" class="animable"></path>
                                    <path
                                        d="M312.64,375.54l34.65,20c.94-1.28,1-2.61-.77-4.24L342.33,388s-.91-1-.12-1.72l1-.95,3.25-3s.74-.52-.06-1.47-1.18-3.19.09-4.35c2-1.84,1.61-4.39-.89-5.71a7.19,7.19,0,0,0-3.2-.77h-.14a7.24,7.24,0,0,0-4.82,1.71,6.33,6.33,0,0,1-3.13,1.19,9,9,0,0,1-2.88,0,5.72,5.72,0,0,0-.66-.07h-.07a1.71,1.71,0,0,0-1.33.43l-2.8,2.6-1,.95-.05,0a2.56,2.56,0,0,1-2.36.34c-1.54-.65-2.27-1-4.78-2.15a5.65,5.65,0,0,0-2.31-.47h0A7.62,7.62,0,0,0,312.64,375.54Zm31.26-3.77a3.51,3.51,0,0,1,.48.22,2,2,0,0,1,.56,3.51,4,4,0,0,1-1.39.8,4.82,4.82,0,0,1-3.64-.22,2,2,0,0,1-.54-3.51A4.72,4.72,0,0,1,343.9,371.77Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 330.289px 382.784px;"
                                        id="elq8s9l7k9ofg" class="animable"></path>
                                </g>
                            </g>
                            <g id="freepik--Pencil--inject-1--inject-73" class="animable"
                                style="transform-origin: 417.54px 355.161px;">
                                <g id="freepik--pencil--inject-1--inject-73" class="animable"
                                    style="transform-origin: 417.54px 355.161px;">
                                    <path
                                        d="M441,346.89l-1,.58-1.15.71-41.61,25.24c.34-.82,0-2.45-.85-4-1-1.81-2.54-3.21-3.62-3.24l41.3-25.06,2.21-1.34C434.9,340.74,439.56,347.82,441,346.89Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 416.885px 356.6px;"
                                        id="el3zps6ntl54i" class="animable"></path>
                                    <path
                                        d="M436.14,339.88c.61-.4,1.71.73,2.77,2.18,1.42,1.91,2.6,4.47,1.79,5l-1.58,1-.57.33c.81-.52-.37-3.08-1.78-5-1-1.39-2.18-2.44-2.8-2.16h0Z"
                                        style="fill: rgb(235, 235, 235); transform-origin: 437.467px 344.094px;"
                                        id="elvahzj3ottam" class="animable"></path>
                                    <path
                                        d="M434.43,340.9c1.42-.92,6.07,6.2,4.66,7.13l-2.14,1.3c1.41-.92-3.24-8.05-4.66-7.12Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 435.822px 345.074px;"
                                        id="elsrpoqr5fi0p" class="animable"></path>
                                    <path
                                        d="M430.25,343.45l2.12-1.29c1.38-.92,5.94,5.92,4.77,7a.22.22,0,0,1-.07.06l-2.14,1.28C436.32,349.6,431.65,342.52,430.25,343.45Z"
                                        style="fill: rgb(235, 235, 235); transform-origin: 433.79px 346.288px;"
                                        id="el07aio9xxy7x8" class="animable"></path>
                                    <polygon
                                        points="392.77 366.18 392.77 366.19 392.77 366.19 392.78 366.18 392.77 366.18 386.49 373.66 386.5 373.66 392.77 366.18"
                                        style="fill: rgb(250, 250, 250); transform-origin: 389.635px 369.92px;"
                                        id="el2hlx5m80k7u" class="animable"></polygon>
                                    <polygon points="386.49 373.66 384.97 375.47 386.49 373.66 386.49 373.66"
                                        style="fill: rgb(224, 224, 224); transform-origin: 385.73px 374.565px;"
                                        id="elk71q9rl3ui" class="animable"></polygon>
                                    <path
                                        d="M396.14,368.06a4.56,4.56,0,0,0-3.36-1.88h0l-6.28,7.48a1.1,1.1,0,0,1,.68.35c.77,1,.71,1.49.71,1.49l9.36-2.08C398.14,372,397.47,369.68,396.14,368.06Z"
                                        style="fill: rgb(255, 168, 167); transform-origin: 392.077px 370.84px;"
                                        id="elgkwwb5v3z2w" class="animable"></path>
                                    <path
                                        d="M387.17,374a.85.85,0,0,0-.68-.35L385,375.47h0a.36.36,0,0,0,0,.51.35.35,0,0,0,.33.09l2.54-.57S388,375,387.17,374Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 386.386px 374.865px;"
                                        id="el93eiiqkgqxh" class="animable"></path>
                                    <path
                                        d="M449.39,341.77,441,346.9a.47.47,0,0,1-.15.06c.57-.69-.55-3.08-1.9-4.9-1-1.33-2.13-2.35-2.77-2.18l8.78-5.35c1.92-1.39,4.55,2.23,5.11,4.85A2.19,2.19,0,0,1,449.39,341.77Z"
                                        style="fill: rgb(242, 143, 143); transform-origin: 443.183px 340.591px;"
                                        id="el6fcx7bojmkv" class="animable"></path>
                                    <g id="elp3efp92tqq">
                                        <path
                                            d="M449.39,341.77a2.19,2.19,0,0,0,.64-2.39c0-.12-.06-.25-.1-.38l-52.44,31.67L385,376a.35.35,0,0,0,.33.09l2.54-.57,9.36-2.08h0Z"
                                            style="opacity: 0.15; transform-origin: 417.577px 357.55px;"
                                            class="animable"></path>
                                    </g>
                                </g>
                            </g>
                            <g id="freepik--Character--inject-1--inject-73" class="animable"
                                style="transform-origin: 144.253px 230.945px;">
                                <g id="freepik--Clock--inject-1--inject-73" class="animable"
                                    style="transform-origin: 144.253px 291.777px;">
                                    <path
                                        d="M76.84,365.22,63.92,390.43a6.69,6.69,0,1,0,11.8,6.29l13-25.35c1.26-2.43-.38-5.78-3.67-7.47S78.09,362.79,76.84,365.22Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 76.082px 381.703px;"
                                        id="elmg2iz9czah9" class="animable"></path>
                                    <path
                                        d="M177.79,312.45,203,325.37a6.69,6.69,0,0,0,6.29-11.8l-25.35-13c-2.43-1.26-5.78.39-7.48,3.67S175.36,311.2,177.79,312.45Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 194.06px 313.098px;"
                                        id="elram3pa263ge" class="animable"></path>
                                    <path
                                        d="M199.57,200.62h0l-.12-.06h0l-45.55-23.37,0,0-.17-.08h0c-13.47-6.82-31.47-4.82-50.85,7.66-38.93,25.07-68.67,82.89-66.43,129.14,1.12,23.06,10,38.88,23.4,45.85h0l.12.06h0l45.57,23.37h0l.14.07h0c13.48,6.85,31.49,4.85,50.89-7.64,38.93-25.08,68.67-82.89,66.42-129.15C221.85,223.42,213,207.6,199.57,200.62Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 129.721px 280.196px;"
                                        id="elq6neogrth4" class="animable"></path>
                                    <g id="elaosbhsn42">
                                        <path
                                            d="M104.52,382.65,60,359.8h0l-.13-.08c-13.41-7-22.27-22.82-23.39-45.84-1-20.63,4.37-43.54,14.06-64.82L96,272.44C86.33,293.72,81,316.63,82,337.26,83.08,359.82,91.58,375.45,104.52,382.65Z"
                                            style="opacity: 0.1; transform-origin: 70.4406px 315.855px;"
                                            class="animable"></path>
                                    </g>
                                    <g id="elyom34u1ofa7">
                                        <ellipse cx="152.48" cy="291.87" rx="102.69" ry="59.29"
                                            style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 152.48px 291.87px; transform: rotate(-62.78deg);"
                                            class="animable"></ellipse>
                                    </g>
                                    <path
                                        d="M123.92,372.39c-23,1.12-26.68-24.69-27.23-35.84-2-40.79,25.36-93.94,59.69-116,8.74-5.63,17.27-8.79,24.66-9.15,23-1.12,26.69,24.69,27.23,35.84,2,40.79-25.35,93.94-59.69,116.05-8.74,5.63-17.27,8.79-24.65,9.15Z"
                                        style="fill: rgb(250, 250, 250); transform-origin: 152.48px 291.902px;"
                                        id="eloscervaqf6k" class="animable"></path>
                                    <path
                                        d="M142.89,345.76a1.1,1.1,0,0,1-.35-.05,1.05,1.05,0,0,1-.71-1.3l13.85-46.68a1,1,0,1,1,2,.59L143.85,345A1.08,1.08,0,0,1,142.89,345.76Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 149.755px 321.371px;"
                                        id="eld5ygf1rproo" class="animable"></path>
                                    <path
                                        d="M182,285.31a3.14,3.14,0,0,1-.88.94L158,302.56l-37.3-22.8a3.15,3.15,0,1,1,3.29-5.38L157.72,295l19.79-13.94a3.16,3.16,0,0,1,4.51,4.23Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 150.835px 288.238px;"
                                        id="els8x4hmz87f" class="animable"></path>
                                    <path
                                        d="M156.19,287.87c4.58-2.95,8.51-.93,8.78,4.51s-3.24,12.24-7.82,15.19-8.51.93-8.77-4.51S151.61,290.82,156.19,287.87Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 156.675px 297.72px;"
                                        id="eliovgrtor9oj" class="animable"></path>
                                </g>
                                <g id="freepik--character--inject-1--inject-73" class="animable"
                                    style="transform-origin: 134.377px 164.856px;">
                                    <path
                                        d="M180.07,127.8a7,7,0,0,1,4.9-1.55,18.27,18.27,0,0,0,2.74,0,3.52,3.52,0,0,0,2.88-1.82c.13-.28.2-.57.33-.84.21-.43.55-.78.78-1.2a2.76,2.76,0,0,0,.25-2,1.63,1.63,0,0,1-.11-.78,1.54,1.54,0,0,1,.35-.59,2.82,2.82,0,0,0,.26-2.87,4,4,0,0,1-.34-.73c-.13-.55.17-1.1.19-1.66.11-2.51-4.06-2.15-5.55-1.81-.42.1-2.51.52-3.46.75a13.38,13.38,0,0,0,0-4.14c-.35-2.65-2.88-3.9-3.18-2.34-.17.89,0,3.39-1.07,5.47a11.66,11.66,0,0,0-1.53,3c-.39,1.41-.87,2.4-4,5.39-2.92,2.79-14,11.67-14,11.67S147.88,111.65,145,106.3c-5.81-10.87-16.08-8.58-16.08-8.58l2.2,14.43s18.5,29.34,21.67,33.39,7.41,2.8,9.69.76C165.77,143.37,174.32,133.48,180.07,127.8Z"
                                        style="fill: rgb(177, 102, 104); transform-origin: 160.823px 122.863px;"
                                        id="ele22jrwwdxa" class="animable"></path>
                                    <path
                                        d="M127.39,97.9s8.78-2.09,13.08,2c4,3.8,5.63,7,10.74,16.72,4.7,8.9,8,14,8,14s-4.07,9-11.46,8.44L136.24,122.2Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 143.3px 118.226px;"
                                        id="el0zz9rmvec9b" class="animable"></path>
                                    <g id="el68npna2324">
                                        <path
                                            d="M127.39,97.9s8.78-2.09,13.08,2c4,3.8,5.63,7,10.74,16.72,4.7,8.9,8,14,8,14s-4.07,9-11.46,8.44L136.24,122.2Z"
                                            style="opacity: 0.6; transform-origin: 143.3px 118.226px;"
                                            class="animable"></path>
                                    </g>
                                    <path
                                        d="M184.36,113.63c-1.18.34-1.94,1.15-2.27,3.23-.2,1.24-1.13,3.36-2.63,4a3.29,3.29,0,0,0,1.88-.44c.75-.54.93-.58,1.22-.14a2.3,2.3,0,0,0,.83.69,1.63,1.63,0,0,0-.49,1.88c.45,1.17,3.33,1.72,5.91.93,0,0-4.05.49-4.72-.88s1.64-2.54,3.22-2.68c0,0-3.86.22-4.21-1.1s1.35-2,3.63-2.11c0,0-3.16,0-3.5-1.13A1.92,1.92,0,0,1,184.36,113.63Z"
                                        style="fill: rgb(154, 74, 77); transform-origin: 184.135px 118.89px;"
                                        id="el9ws6lruiy7o" class="animable"></path>
                                    <path
                                        d="M142.12,126.47s-1.33,7.27-.12,13.4,2.1,11.34,2.1,11.34-3.71,4.25-10.73,3.28c-7.64-1.06-5.31-19.19-.92-23.64A14.42,14.42,0,0,1,142.12,126.47Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 136.242px 140.552px;"
                                        id="eljcs5a7q4bxc" class="animable"></path>
                                    <g id="el3jtn7ljvlzh">
                                        <path
                                            d="M142.12,126.47s-1.33,7.27-.12,13.4,2.1,11.34,2.1,11.34-3.71,4.25-10.73,3.28c-7.64-1.06-5.31-19.19-.92-23.64A14.42,14.42,0,0,1,142.12,126.47Z"
                                            style="opacity: 0.5; transform-origin: 136.242px 140.552px;"
                                            class="animable"></path>
                                    </g>
                                    <path d="M141.34,272.65l1-.16c0-3-.23-5.8.5-7.24l-1.46-3.69Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 142.09px 267.105px;"
                                        id="el0vr9c6dqv9pp" class="animable"></path>
                                    <path
                                        d="M138.69,258.91c.26,2.07,1.48,4.18,1.65,8.27a35.34,35.34,0,0,1,0,5.23l1,.24V261.56Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 140.015px 265.78px;"
                                        id="elgbybpmyuhh" class="animable"></path>
                                    <path
                                        d="M162.53,275a2.76,2.76,0,0,1-.63,1.53c-.52.41-2.15,1.78-7.49,1.58s-7.23-1.48-9.08-3.11-2.43-6-2.74-8a15.2,15.2,0,0,0-3.9-8,3.52,3.52,0,0,1-.2-2.07,6.73,6.73,0,0,1,6.41,4.51c2,4.84,3.62,10.48,7.95,11.74A66.86,66.86,0,0,0,162.53,275Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 150.474px 267.53px;"
                                        id="elvx32rhxc3va" class="animable"></path>
                                    <path
                                        d="M159.73,270.37c1.66,1.37,2.91,2,2.79,3.28s-1.48,1.93-2.58,2.28c-2.6.84-5.57.57-8.2.16S146.15,274.5,145,272a10,10,0,0,1-.67-2.29,33.24,33.24,0,0,0-2.16-7.57,18,18,0,0,0-1.52-2.92,7.48,7.48,0,0,1-1.72-3.28c-.13-1,.64-2.51,1.64-4.1l0,0a6.38,6.38,0,0,0,1.17-4.82l-.43-7.53,11.9,2.59s-.95,6.56-1,8.27a29.81,29.81,0,0,0,.77,7.49,37.75,37.75,0,0,0,3.2,8.48,8.19,8.19,0,0,0,1.27,1.9A21.43,21.43,0,0,0,159.73,270.37Z"
                                        style="fill: rgb(177, 102, 104); transform-origin: 150.722px 257.985px;"
                                        id="elsq7y0qlb5w" class="animable"></path>
                                    <path
                                        d="M138.89,253.8c.73-1.35,1.75-2.18,2.45-3.35a13.09,13.09,0,0,1,1.46,3.21c.34,1.06,1.3,6.27,2.68,10.41,1,3.11,2.68,4.73,4.93,5.53a8.94,8.94,0,0,0,4.41.41h0c2.76-.44,2.07-2.41,2.07-2.41a34.94,34.94,0,0,0,5.34,4.23,2.25,2.25,0,0,1,.28,3.13c-.76.68-3.35,2.35-10,1.53-5.89-.73-7.32-3.42-7.9-4.63a29.11,29.11,0,0,1-1.34-5.49,17.28,17.28,0,0,0-2.18-5.8,6.69,6.69,0,0,0-.4-.62h0a22.1,22.1,0,0,0-1.43-1.83c-.42-.49-.74-.72-.87-1.19A4.47,4.47,0,0,1,138.89,253.8Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 150.657px 263.581px;"
                                        id="elmyp4pvte8r" class="animable"></path>
                                    <path d="M161.63,263.79l1-.14c.09-3-.06-5.8.7-7.22L162,252.7Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 162.48px 258.245px;"
                                        id="el1yj9fecnn53" class="animable"></path>
                                    <path
                                        d="M159.37,250c.2,2.07,1.36,4.21,1.41,8.31a33.65,33.65,0,0,1-.15,5.22l1,.28L162,252.7Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 160.685px 256.905px;"
                                        id="elwga1ahlo2xc" class="animable"></path>
                                    <path
                                        d="M182.74,266.7a2.71,2.71,0,0,1-.68,1.51c-.52.39-2.19,1.65-7.52,1.29s-7.19-1.62-9-3.3-2.25-6-2.5-8.1a15.15,15.15,0,0,0-3.67-8.12,3.65,3.65,0,0,1-.14-2.08,6.74,6.74,0,0,1,6.28,4.69c1.86,4.9,3.31,10.58,7.61,12A67.65,67.65,0,0,0,182.74,266.7Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 170.94px 258.732px;"
                                        id="elhersa78zih" class="animable"></path>
                                    <path
                                        d="M180.07,262c1.62,1.42,2.85,2.06,2.7,3.36s-1.54,1.88-2.65,2.2a18,18,0,0,1-8.2-.07c-2.69-.51-5.54-1.75-6.63-4.26a10.08,10.08,0,0,1-.61-2.31,33.18,33.18,0,0,0-1.94-7.62,16.87,16.87,0,0,0-1.44-3,7.5,7.5,0,0,1-1.62-3.34c-.1-1,.71-2.49,1.76-4l0,0c1.19-1.76,1.57-2.46,1.57-5.65l-.38-6.67,11.83,2.93s-.89,4.38-1.27,7.74a24.19,24.19,0,0,0,.45,8,37.67,37.67,0,0,0,3,8.57,8.06,8.06,0,0,0,1.2,1.94A22.44,22.44,0,0,0,180.07,262Z"
                                        style="fill: rgb(177, 102, 104); transform-origin: 171.227px 249.319px;"
                                        id="elqxw7qzw1e9p" class="animable"></path>
                                    <path
                                        d="M159.88,244.55a34.86,34.86,0,0,1,2.38-2.86,11,11,0,0,1,1.41,2.94c.48,1.36,1.09,6.53,2.34,10.7.94,3.13,2.55,4.8,4.77,5.67a8.88,8.88,0,0,0,4.39.53h0c2.78-.36,2.15-2.36,2.15-2.36a35,35,0,0,0,5.21,4.4,2.23,2.23,0,0,1,.19,3.13c-.78.66-3.42,2.26-10,1.24-5.87-.9-7.22-3.63-7.77-4.86a29.86,29.86,0,0,1-1.17-5.52,17.19,17.19,0,0,0-2-5.87c-.13-.23-.26-.44-.38-.62h0c-.39-.59-.86-1.24-1.38-1.88s-.72-.74-.84-1.21A5,5,0,0,1,159.88,244.55Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 171.196px 254.981px;"
                                        id="el99u5hfm9bhm" class="animable"></path>
                                    <path
                                        d="M110,166.77a39.08,39.08,0,0,1,3.67-9.48c11.32,5.38,15.66,3.81,27.08.15,5.33,5.88,12.95,8.89,20.23,12.61s15.54,7.6,20.1,12.3c2.06,2.12,1.44,7.29.4,13.93-1.41,9-7,37.44-7,37.44-7.75,2.76-11.75-1.82-11.75-1.82s-1.22-12-2.2-21.68S163,196,163,196s-23.27-8.82-32.07-10.64C116.27,182.28,108.09,180.41,110,166.77Z"
                                        style="fill: rgb(55, 71, 79); transform-origin: 146.085px 195.947px;"
                                        id="el3ccqwo5iy8y" class="animable"></path>
                                    <path
                                        d="M93.09,171.94c1-6.4,7.48-19.83,8.69-22.15,11.32,5.38,27.57,11.31,39,7.65a39.28,39.28,0,0,1-8.4,19.34c17.21,12.58,20.74,17,24.94,22.18,1.16,1.45,2.29,4.43,1.6,8.58-1.47,9-6,37.09-6,37.09a13.62,13.62,0,0,1-11.64-1s-1.41-10.64-2.39-20.32.06-14.43.06-14.43-23.24-10.36-32-14.4C92.1,187.72,92.07,178.33,93.09,171.94Z"
                                        style="fill: rgb(69, 90, 100); transform-origin: 125.922px 197.641px;"
                                        id="ela6dlyvsln2f" class="animable"></path>
                                    <path
                                        d="M113.72,98.3S101,99.77,99.47,100.45c11.94,8.4,2.27,27.08,2.27,27.08l4.58,14.34c-1.9,5-8.06,11.45-9.94,19.36,16.57,10,37.57,8.1,44.39-3.79-.35-5.79-.3-14.55-.83-18.23.16-2.71-.08-5.82.23-10.25a12.77,12.77,0,0,0,2.7-14.82c-4.74-9.4-12.88-16.24-15.48-16.24Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 120.262px 132.791px;"
                                        id="eluxnqdci306" class="animable"></path>
                                    <path
                                        d="M109.8,98.69s-8,.65-10.33,1.76-6.22,7.83-2.74,17.6,6.63,21.23,6.27,23.54-6.62,15.7-6.62,15.7a9,9,0,0,0,6,4.24l3.82-11.33L105,162.5s7.9,1.63,13.37,1.16C118.37,163.66,118.49,124,109.8,98.69Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 106.857px 131.218px;"
                                        id="el1fayigx3jw3" class="animable"></path>
                                    <g id="eluh953ek1zcf">
                                        <g style="opacity: 0.5; transform-origin: 106.857px 131.218px;"
                                            class="animable">
                                            <path
                                                d="M109.8,98.69s-8,.65-10.33,1.76-6.22,7.83-2.74,17.6,6.63,21.23,6.27,23.54-6.62,15.7-6.62,15.7a9.14,9.14,0,0,0,6,4.24l3.82-11.33L105,162.5s7.9,1.63,13.37,1.16C118.37,163.66,118.49,124,109.8,98.69Z"
                                                id="el6lbchjy9gy3" class="animable"
                                                style="transform-origin: 106.857px 131.218px;"></path>
                                        </g>
                                    </g>
                                    <path
                                        d="M124.15,51.88c-11.81-.82-23.77,8.64-21.29,24.43,1.69,10.74,8,14.48,10,14.54l12.09.49c2.79-8.49,16.27-9.55,19.17-22.1S136,52.7,124.15,51.88Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 123.56px 71.5853px;"
                                        id="elqtwtyh6ajo" class="animable"></path>
                                    <path
                                        d="M101.33,57.1c-4.71,1.51-7,5.57-8.32,10.09-1,3.33-1.54,6.81-2.94,10a10.37,10.37,0,0,1-1.79,2.89,19.45,19.45,0,0,1-3.59,2.62,7.55,7.55,0,0,0-3,3.18c-.76,1.86,1,3.62,2.52,4.58a11,11,0,0,0,9.53.87,10.42,10.42,0,0,0,6.44-6.62c1-2.9,1-5.71.94-8.71s.12-6.36,1.36-9.24a6.66,6.66,0,0,1,2-2.77,12.16,12.16,0,0,1,2.93-1.4A5.12,5.12,0,0,0,110,60.69c1.53-2.53-2.15-3.8-4-4A10.65,10.65,0,0,0,101.33,57.1Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 95.9353px 74.3126px;"
                                        id="elju64jn6tla" class="animable"></path>
                                    <path d="M109.06,57.9l-5.12-2.37a2.75,2.75,0,0,1,3.69-1.47A3,3,0,0,1,109.06,57.9Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 106.616px 55.8561px;"
                                        id="elldpu1vv4for" class="animable"></path>
                                    <path d="M109.07,57.19,108,51.67a2.72,2.72,0,0,1,3.35,2.1A3,3,0,0,1,109.07,57.19Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 109.696px 54.3865px;"
                                        id="elnbpjrk8hf9d" class="animable"></path>
                                    <path
                                        d="M135.81,62.37c3.91,2.19,5.41,7.36,4.31,19.25-.93,10.07-4.37,12.34-6.07,12.94s-4.82,0-7.87-.77L125.83,98s5,6.6,4.49,9.35-7.49,3.54-11.28.55-6.8-8.45-6.8-8.45l1.05-14s-1.94,1.63-4.82-1.27c-2.39-2.39-3-6.19-.86-8.06A4.43,4.43,0,0,1,114.54,78a30.84,30.84,0,0,0,12.25-3.77C133.22,70.75,135.24,66.47,135.81,62.37Z"
                                        style="fill: rgb(177, 102, 104); transform-origin: 123.384px 86.0882px;"
                                        id="el0l3vhymko7jd" class="animable"></path>
                                    <path
                                        d="M127.79,77.66A1.3,1.3,0,0,1,126.5,79a1.33,1.33,0,0,1,0-2.65A1.3,1.3,0,0,1,127.79,77.66Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 126.538px 77.675px;"
                                        id="elle2cvdwa84o" class="animable"></path>
                                    <path
                                        d="M128.78,86.88,131.66,88a1.52,1.52,0,0,1-2,.93A1.62,1.62,0,0,1,128.78,86.88Z"
                                        style="fill: rgb(154, 74, 77); transform-origin: 130.17px 87.9582px;"
                                        id="el7nfjqmouooa" class="animable"></path>
                                    <path
                                        d="M139.14,75.13l-2.83-1.33a1.51,1.51,0,0,1,2-.79A1.65,1.65,0,0,1,139.14,75.13Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 137.786px 74.0055px;"
                                        id="elyzl1u6rkhk" class="animable"></path>
                                    <path d="M137.79,77.66a1.28,1.28,0,1,1-1.25-1.35A1.31,1.31,0,0,1,137.79,77.66Z"
                                        style="fill: rgb(38, 50, 56); transform-origin: 136.511px 77.5897px;"
                                        id="el326htpj062g" class="animable"></path>
                                    <polygon points="131.79 76.31 131.14 84.58 135.24 83.61 131.79 76.31"
                                        style="fill: rgb(154, 74, 77); transform-origin: 133.19px 80.445px;"
                                        id="ellqwvasfdr5" class="animable"></polygon>
                                    <path
                                        d="M126.18,93.79c-3.21-.65-9.76-3-10.62-5.75a6.89,6.89,0,0,0,2.11,3.53c1.88,1.85,8.37,4.24,8.37,4.24Z"
                                        style="fill: rgb(154, 74, 77); transform-origin: 120.87px 91.925px;"
                                        id="el7230ckh993k" class="animable"></path>
                                    <path
                                        d="M112.35,97.9,106.85,99s2.55,11,9.34,13,9.33-2.2,9.33-2.2A24.85,24.85,0,0,1,112.35,97.9Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 116.185px 105.22px;"
                                        id="elzsnrc693o5" class="animable"></path>
                                    <g id="eltkjvpkpud6">
                                        <path
                                            d="M112.35,97.9,106.85,99s2.55,11,9.34,13,9.33-2.2,9.33-2.2A24.85,24.85,0,0,1,112.35,97.9Z"
                                            style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 116.185px 105.22px;"
                                            class="animable"></path>
                                    </g>
                                    <path d="M125.83,98s3.8,8.62-.31,11.81c0,0,5.44,1.62,6.89-.68s-1.2-8.85-3.47-11.37Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 129.172px 104.062px;"
                                        id="el2ig49a1hk35" class="animable"></path>
                                    <g id="elplw9uqy2o9o">
                                        <path
                                            d="M125.83,98s3.8,8.62-.31,11.81c0,0,5.44,1.62,6.89-.68s-1.2-8.85-3.47-11.37Z"
                                            style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 129.172px 104.062px;"
                                            class="animable"></path>
                                    </g>
                                    <path
                                        d="M103.53,189.12l0,.95a2.74,2.74,0,0,0,1.31,2.36l25.51,15.17a2.69,2.69,0,0,0,2.69,0l47.57-26.56a2.7,2.7,0,0,0,1.39-2.32v-.65L131.7,206.18Z"
                                        style="fill: rgb(235, 235, 235); transform-origin: 142.765px 193.015px;"
                                        id="elvm9jhmua4wh" class="animable"></path>
                                    <path
                                        d="M182,178.11l-27.74-16.55a1.6,1.6,0,0,0-1.61,0l-48.93,27.32a.36.36,0,0,0,0,.62l28,16.71Z"
                                        style="fill: rgb(250, 250, 250); transform-origin: 142.772px 183.776px;"
                                        id="el5fa0qc9mutg" class="animable"></path>
                                    <polygon points="131.47 203.8 116.51 194.88 161 170.05 176.04 178.93 131.47 203.8"
                                        style="fill: rgb(224, 224, 224); transform-origin: 146.275px 186.925px;"
                                        id="elujn1edstqnr" class="animable"></polygon>
                                    <polygon
                                        points="124.41 179.49 124.69 179.66 132.02 184.03 145.28 176.63 145.56 176.48 137.95 171.94 124.41 179.49"
                                        style="fill: rgb(224, 224, 224); transform-origin: 134.985px 177.985px;"
                                        id="elqujb9j7qkwi" class="animable"></polygon>
                                    <polygon
                                        points="124.69 179.66 132.02 184.03 145.28 176.63 137.94 172.25 124.69 179.66"
                                        style="fill: rgb(230, 230, 230); transform-origin: 134.985px 178.14px;"
                                        id="ellbg0zfgxrn" class="animable"></polygon>
                                    <path
                                        d="M131.7,206.18l0,1.8a2.79,2.79,0,0,0,1.35-.34l47.57-26.56a2.7,2.7,0,0,0,1.39-2.32v-.65Z"
                                        style="fill: rgb(235, 235, 235); transform-origin: 156.855px 193.045px;"
                                        id="elzvfxwme1gjd" class="animable"></path>
                                    <g id="elna9ioaxyd3">
                                        <g style="opacity: 0.5; mix-blend-mode: multiply; transform-origin: 156.855px 193.045px;"
                                            class="animable">
                                            <path
                                                d="M131.7,206.18l0,1.8a2.79,2.79,0,0,0,1.35-.34l47.57-26.56a2.7,2.7,0,0,0,1.39-2.32v-.65Z"
                                                style="fill: rgb(224, 224, 224); transform-origin: 156.855px 193.045px;"
                                                id="elfns5jdlxo5p" class="animable"></path>
                                        </g>
                                    </g>
                                    <path
                                        d="M132.45,206.59a3.19,3.19,0,0,0,2.76-.17L182.57,180a3.23,3.23,0,0,0,1.59-2.21l5.58-30.59a3.22,3.22,0,0,0-.86-2.81l-49.22,27.48a2.37,2.37,0,0,0-1.17,1.64Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 161.12px 175.608px;"
                                        id="elf1qt7kaduwp" class="animable"></path>
                                    <g id="el0tse5727fll">
                                        <g style="opacity: 0.7; transform-origin: 161.12px 175.608px;"
                                            class="animable">
                                            <path
                                                d="M132.45,206.59a3.19,3.19,0,0,0,2.76-.17L182.57,180a3.23,3.23,0,0,0,1.59-2.21l5.58-30.59a3.22,3.22,0,0,0-.86-2.81l-49.22,27.48a2.37,2.37,0,0,0-1.17,1.64Z"
                                                style="fill: rgb(255, 255, 255); transform-origin: 161.12px 175.608px;"
                                                id="elisj9p06ywfe" class="animable"></path>
                                        </g>
                                    </g>
                                    <path
                                        d="M131.7,206.18l.32.19a3.48,3.48,0,0,0,.43.22l6-33.1a2.37,2.37,0,0,1,1.17-1.64l49.22-27.48a4,4,0,0,0-.64-.51l-49.32,27.53a2.35,2.35,0,0,0-1.17,1.64Z"
                                        style="fill: rgb(250, 250, 250); transform-origin: 160.27px 175.225px;"
                                        id="elyvb2etzac1n" class="animable"></path>
                                    <path
                                        d="M159.32,178.67c.37-2,2.53-4.75,4.82-6s3.84-.65,3.47,1.4-2.54,4.74-4.83,6S158.94,180.71,159.32,178.67Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 163.464px 176.371px;"
                                        id="elxp5p8bxgf5k" class="animable"></path>
                                    <path
                                        d="M107.74,184.18c-2.59-1.78-19.07-13.76-25.66-18.87-6.85-5.31-6.43-7-5.6-10.85,1.64-7.57,10.1-31.82,13-38.89,3.2-7.89,4.21-13.26,9.85-14.27,4.3,3.39,7.56,11.43,2.68,25.61l-9.25,27.63s7.06,8.37,11.7,12.71,8.75,8.41,12.09,9.39c3,.88,6.45,1.48,7.5,2.44a81.88,81.88,0,0,1,7.08,8.21c1,1.62,3.32,4.9,0,6-3,1-5.49-.34-8-2a31.15,31.15,0,0,1-3.29-2.72,12,12,0,0,1-7.11-1.41C110.87,186,107.74,184.18,107.74,184.18Z"
                                        style="fill: rgb(177, 102, 104); transform-origin: 104.441px 147.467px;"
                                        id="elq7bx7xu8rm" class="animable"></path>
                                    <path
                                        d="M99.47,100.45c-5,.85-6.45,4.32-10.16,14-2.61,6.81-12,36.52-12,36.52s5.22,6,15.36,3.55l11.7-31.68S108.1,107.84,99.47,100.45Z"
                                        style="fill: rgb(206, 228, 116); transform-origin: 91.2409px 127.779px;"
                                        id="elursezyonup" class="animable"></path>
                                    <g id="elfek20sm9sr">
                                        <g style="opacity: 0.6; transform-origin: 91.2409px 127.779px;"
                                            class="animable">
                                            <path
                                                d="M99.47,100.45c-5,.85-6.45,4.32-10.16,14-2.61,6.81-12,36.52-12,36.52s5.22,6,15.36,3.55l11.7-31.68S108.1,107.84,99.47,100.45Z"
                                                id="elwu67w0wse8b" class="animable"
                                                style="transform-origin: 91.2409px 127.779px;"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                            <defs>
                                <filter id="active" height="200%">
                                    <feMorphology in="SourceAlpha" result="DILATED" operator="dilate"
                                        radius="2"></feMorphology>
                                    <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                                    <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE">
                                    </feComposite>
                                    <feMerge>
                                        <feMergeNode in="OUTLINE"></feMergeNode>
                                        <feMergeNode in="SourceGraphic"></feMergeNode>
                                    </feMerge>
                                </filter>
                                <filter id="hover" height="200%">
                                    <feMorphology in="SourceAlpha" result="DILATED" operator="dilate"
                                        radius="2"></feMorphology>
                                    <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
                                    <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE">
                                    </feComposite>
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
                    </div>
                </aside>
            </div>
        </div>

        <div class="modal fade" id="affectationModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered"> <!-- 👈 centré verticalement -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Affecter un ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <label for="assigned_to" class="form-label">Choisir un technicien</label>
                        <select class="form-select border-0 shadow-sm" id="assigned_to" wire:model="assigned_to">
                            <option value="" class="border-0 ">-- Sélectionner --</option>
                            @foreach ($responsables as $user)
                                <option class="border-0 shadow-sm" value="{{ $user->id }}">{{ $user->name }}
                                    ({{ $user->poste }})</option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-success" wire:click="affecter">Valider</button>
                    </div>
                </div>
            </div>
        </div>

      



    </div>
