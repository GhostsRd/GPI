<div>
    {{-- <div class="dashboard-header">
        <h4 class="text-muted"><strong>Checkouts / view</strong></h4>
        <p class="dashboard-subtitle">Vue d'ensemble de votre activité</p>
    </div> --}}


    <div class="container-fluid p-lg-2 p-sm-2 p-md-2 mb-sm-2 mb-md-2 ">
        <div class="row h-100">

            <div class="col-lg-9  mb-md-2 mb-sm-2">
                {{-- <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow_{{$ticketvals->priorite}} "> --}}

                <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow">
                    <div class="row">
                        <div class="col-lg-11 col-md-10 col-sm-10">
                            <label class="fw-bold  mb-1 mt-0 pt-0">
                                {{-- <i class="bi bi-ticket-detailed"></i> --}}
                                Demande de checkout <span class="text-warning" id="ticketId">#{{ $checkoutId }}</span>
                                — {{ $checkouts->materiel_type }}</label>

                        </div>

                        <div class="col-lg-1 col-mg-1 col-sm-1">
                            <div class="dropdown " style="cursor: pointer" data-bs-toggle="dropdown">
                                ☰


                                <ul class="dropdown-menu border-0">
                                    <li><a class="dropdown-item" href="#" wire:click="changerVue">
                                            <i class="bi bi-kanban me-2"></i>

                                            Panneau visuel</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('ticket') }}">
                                            <i class="bi bi-layout-text-window fs-5"></i>


                                            Table visuel</a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" wire:click="openAffectationModal" href="#">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="15"
                                                viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M15.75 4.5a3 3 0 1 1 .825 2.066l-8.421 4.679a3.002 3.002 0 0 1 0 1.51l8.421 4.679a3 3 0 1 1-.729 1.31l-8.421-4.678a3 3 0 1 1 0-4.132l8.421-4.679a3 3 0 0 1-.096-.755Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            Affecter</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('ticket') }}">
                                            <i class="bi bi-x-circle text-danger"></i>


                                            Refuser</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="#"
                                            wire:click="Removeticket({{ $checkoutId }})">
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
                    <div class="meta mt-2">Créé par <strong>{{ $checkouts->utilisateur->nom }}</strong> • <span
                            id="createdAt">{{ \Carbon\Carbon::parse($checkouts->created_at)->translatedFormat('d M Y') }}</span>
                        •
                        @if ($checkouts->statut == 'En cours')
                            <span class="badge open">En cours</span>
                        @endif
                        @if ($checkouts->statut == 'En stock')
                            <span class="badge open" style="background:#fff7ed;color:var(--warn)">En stock</span>
                        @endif
                        @if ($checkouts->statut == 'Rendu')
                            <span class="badge open" style="background:#eefbf7;color:var(--ok)">Rendu</span>
                        @endif


                    </div>
                    <div>
                        <button wire:click="afficheretape" class="btn btn-sm btn-secondary border-0 bg-white  "><span
                                class="loader"></span>
                            {{ $affichestep == 'False' ? 'Afficher les etapes ▼' : 'Masquer les etapes ▲' }}</button>

                    </div>
                    <div class="row  p-3 fond-bg rounded-3 {{ $affichestep == 'False' ? 'collapse' : '' }}">
                        <div class="steps-container row " style="display:flex;align-items:center;">
                            <div class="step {{ $current[1] }} col-lg-3" data-index="0">
                                <div class="dot ">1</div>
                                <div class="title">Nouveau</div>
                                <div class="sub">Création</div>
                            </div>
                            <div class="connector col-lg-1">
                                <div class="fill {{ $progress }}"></div>
                            </div>
                            <div class="step {{ $current[2] }} col-lg-3" data-index="1">
                                <div class="dot">2</div>
                                <div class="title">En cours</div>
                                <div class="sub">Assigné à une équipe</div>

                            </div>
                            <div class="connector col-lg-1">
                                <div class="fill {{ $progress }}"></div>
                            </div>

                            @if ($checkouts->statut == 4)
                                <div class="step {{ $current[4] }} col-lg-3" data-index="2">
                                    <div class="dot bg-danger">X</div>
                                    <div class="title">Refuser</div>
                                    <div class="sub">Decision Finale</div>

                                </div>
                            @else
                                <div class="step {{ $current[3] }} col-lg-3" data-index="2">
                                    <div class="dot">3</div>
                                    <div class="title">Rendu</div>
                                    <div class="sub">Intervention</div>

                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>

                    <div class="container-fluid mt-4 mb-3 ml-0  justify-content-center row bg-light py-2">

                        <p class="text-center  border-bottom py-2">
                            <img class="dropdown-toggle shadow-sm  p-0 m-0 rounded-pill " data-bs-toggle="modal"
                                data-bs-target="#centeredModal" data-toggle="dropdown"
                                title="{{ $checkouts->utilisateur->nom }}"
                                src="https://ui-avatars.com/api/?name={{ $checkouts->utilisateur->nom }}"
                                alt="Profil" width="40" height="40" class="rounded-circle me-2">
                            ⮕{{ $checkouts->materiel_type }} {{ $checkouts->materiel_details }}
                            ⮕ <img class="dropdown-toggle  p-0 m-0 rounded-pill  shadow-sm  " data-toggle="dropdown"
                                title="{{ $checkouts->responsable->name ?? 'Guest' }}"
                                src="https://ui-avatars.com/api/?name={{ $checkouts->responsable->name ?? 'Guest' }}"
                                alt="Profil" width="40" height="40" class="shadow rounded-circle me-2">
                            @if ($checkouts->materiel_type == 'Telephone')
                                ⮕ {{ $checkouts->telephone->nom }} {{ $checkouts->telephone->marque }}
                            @else
                                ⮕ {{ $checkouts->ordinateur->nom }} {{ $checkouts->ordinateur->modele }}
                                {{ $checkouts->ordinateur->os_version }}
                            @endif
                        </p>
                        <label for="" class="fw-bold mb-2 d-flex justify-content-center">Lier une equipement
                        </label>
                        <div class="offset-lg-3 col-lg-5 d-flex justify-content-center ">

                            <select name="" id="" wire:model="selectedvalsdata"
                                class="form-control shadow-sm border-0 text-center mb-4 " style="overflow: scroll">
                                <option class=" shadow-sm border border-0 ">Selectionner l'equipement</option>
                                @if ($checkouts->materiel_type == 'Telephone')
                                    @foreach ($TelephoneTablettes as $TelephoneTablette)
                                        <option class="bg=white shadow-sm border border-0"
                                            value="{{ $TelephoneTablette->id }}">{{ $TelephoneTablette->type }}
                                            {{ $TelephoneTablette->marque }} {{ $TelephoneTablette->modele }}
                                        </option>
                                    @endforeach
                                @elseif($checkouts->materiel_type == 'ordinateur')
                                    @foreach ($ordinateurs as $ordinateur)
                                        <option value="{{ $ordinateur->id }}">{{ $ordinateur->type }}
                                            {{ $ordinateur->marque }} {{ $ordinateur->modele }}
                                            {{ $ordinateur->os_version }} </option>
                                    @endforeach
                                @else
                                    @foreach ($TelephoneTablettes as $TelephoneTablette)
                                        <option value="{{ $TelephoneTablette->id }}">{{ $TelephoneTablette->type }}
                                            {{ $TelephoneTablette->marque }} {{ $TelephoneTablette->modele }}
                                        </option>
                                    @endforeach
                                    @foreach ($ordinateurs as $ordinateur)
                                        <option value="{{ $ordinateur->id }}">{{ $ordinateur->type }}
                                            {{ $ordinateur->marque }} {{ $ordinateur->modele }}
                                            {{ $ordinateur->os_version }} </option>
                                    @endforeach
                                @endif
                            </select>

                            {{-- <label for="">Selection le materiel</label>

                            <input type="text" wire:model.debounce.500ms="selectEquipement"
                                class="form-control border-0 shadow-sm" list="equipments">
                            <label for="" class="text-danger">{{ $selectedvalsdata }}</label>
                            <datalist id="equipments">
                                @foreach ($TelephoneTablettes as $TelephoneTablette)
                                    <option wire:click="selectvals('{{ $TelephoneTablette->id }}')"
                                        value="{{ $TelephoneTablette->id }}">{{ $TelephoneTablette->type }}
                                        {{ $TelephoneTablette->marque }} {{ $TelephoneTablette->modele }} </option>
                                @endforeach
                                @foreach ($ordinateurs as $ordinateur)
                                    <option wire:click="selectevals('{{ $ordinateur->id }}')"
                                        value="{{ $ordinateur->id }}">{{ $ordinateur->type }}
                                        {{ $ordinateur->marque }} {{ $ordinateur->modele }}
                                        {{ $ordinateur->os_version }} </option>
                                @endforeach
                            </datalist> --}}
                        </div>

                        <div class="col-lg-3">
                            <button wire:click="validerequipement"
                                class="btn btn-sm btn-outline-dark text-warning fw-bold px-2 py-1 {{ $selectedvalsdata ? '' : 'collapse' }} ">valider</button>
                        </div>
                    </div>

                    <div>
                        <button wire:click="changercomment" class="btn btn-sm btn-secondary border-0 bg-white  "><span
                                class="loader"></span>
                            {{ $affichecommentaire == 'False' ? 'Afficher Comment box ▼' : 'Masquer comment box ▲' }}</button>

                    </div>

                    <div class="container-fluid  {{ $affichecommentaire == 'False' ? 'collapse' : '' }}">
                        <form wire:submit.prevent="postCommentaire">
                            <h5 style="margin:14px 0 8px">Ajouter une commentaire pour la transition</h5>
                            <textarea wire:model="comments" class="custom-textarea bg-white" name="message" id="message"
                                placeholder="Ex: Prise en main du ticket"></textarea>
                    </div>
                    <div class="container-fluid mt-2  {{ $selectedvalsdata != '' ? 'collapse' : '' }}">
                        <div class="row ">
                            <div class="col-lg-6">
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


                    <div class="container-fluid border-top mb-2 {{ $selectedvalsdata != '' ? 'collapse' : '' }}">
                        <h5 class="mb-1 text-lg font-semibold"><strong>Historique des activités</strong></h5>

                        <div class="timeline">


                            <!-- Item 1 -->
                            @foreach ($commentaires as $comment)
                                <div class="timeline-item ">
                                    <div class="timeline-icon">
                                        <span class="icon-wrap" title="Assign">
                                            <!-- user assign icon -->
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
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
                                            • @if ($comment->statut == 1)
                                                <span class="badge open">Nouveau</span>
                                            @endif
                                            @if ($comment->statut == 2)
                                                <span class="badge open"
                                                    style="background:#fff7ed;color:var(--warn)">Valider</span>
                                            @endif
                                            @if ($comment->statut == 3)
                                                <span class="badge open"
                                                    style="background:#eefbf7;color:var(--ok)">Fermer</span>
                                            @endif



                                            • <strong class="text-capitalize">
                                                {{-- @foreach ($responsables as $resp)
                                                        @if ($comment->utilisateur_id == $resp->id)
                                                            {{ $resp->name }}
                                                        @endif
                                                    @endforeach --}}
                                            </strong> {{ $comment->commentaire }}
                                            {{-- <strong>{{ $checkout->type }}</strong>. --}}
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

                </div>
            </div>
            <div class="col-lg-3 mt-sm-4 mt-2">
                <aside class="shadow-sm p-4 bg-white rounded-2 h-100 side ">
                    <div>
                        <label class="fw-bold" style="margin:0 0 8px">Résumé</label>
                        <div class="info"><span class="text-muted fw-bold"
                                style="font-size: 0.8rem;">Statut:</span>
                            @if ($checkouts->statut == 'En cours')
                                En cours
                            @endif
                        </div>
                        <div class="info"><span class="text-muted fw-bold" style="font-size: 0.8rem;">Assigné
                                à:</span> Tech Support</div>
                        <div class="info" style="margin-top:6px"><span class="text-muted fw-bold"
                                style="font-size: 0.8rem;">Dernière mise à jour:</span> <span
                                id="lastUpdate">{{ \Carbon\Carbon::parse($checkouts->updated_at)->translatedFormat('d M Y') }}
                            </span></div>
                    </div>

                    <div>
                        <label style="margin:0 0 8px" class="fw-bold">Actions rapides</label>
                        <div style="display:flex;flex-direction:column;gap:8px">
                            <button class="btn-ghost" id="markResolved"
                                wire:click="RenouvelerCheckout({{ $checkouts->id }})">Renouveler</button>
                            <button class="btn-ghost" id="markResolved" wire:click="markResolved">Marquer comme
                                Rendu</button>
                            <button class="btn-ghost" id="markClosed"
                                wire:click="RefuserCheckout({{ $checkouts->id }})">Refuser</button>
                        </div>
                    </div>

                    {{-- <div>
                        <h4 style="margin:0 0 8px">États actuels</h4>
                        <div style="display:flex;gap:8px;flex-wrap:wrap">
                            <span class="badge open">Nouveau</span>
                            <span class="badge open" style="background:#fff7ed;color:var(--warn)">En cours</span>
                            <span class="badge open" style="background:#eefbf7;color:var(--ok)">Rendu</span>
                            <span class="badge closed">Fermé</span>
                        </div>
                    </div> --}}

                    <div>
                    <svg class="animated" id="freepik_stories-dashboard" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.com/svgjs">
                            <style>
                                svg#freepik_stories-dashboard:not(.animated) .animable {
                                    opacity: 0;
                                }

                                svg#freepik_stories-dashboard.animated #freepik--background-complete--inject-19 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideUp;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-dashboard.animated #freepik--Shadow--inject-19 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedLeft;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-dashboard.animated #freepik--Dashboard--inject-19 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomOut, 1.5s Infinite linear wind;
                                    animation-delay: 0s, 1s;
                                }

                                svg#freepik_stories-dashboard.animated #freepik--character-2--inject-19 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideLeft;
                                    animation-delay: 0s;
                                }

                                svg#freepik_stories-dashboard.animated #freepik--character-1--inject-19 {
                                    animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomOut;
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

                                @keyframes wind {
                                    0% {
                                        transform: rotate(0deg);
                                    }

                                    25% {
                                        transform: rotate(1deg);
                                    }

                                    75% {
                                        transform: rotate(-1deg);
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
                            </style>
                            <g id="freepik--background-complete--inject-19" class="animable"
                                style="transform-origin: 250px 228.23px;">
                                <rect y="382.4" width="500" height="0.25"
                                    style="fill: rgb(235, 235, 235); transform-origin: 250px 382.525px;"
                                    id="el1udykjkuiygi" class="animable"></rect>
                                <rect x="52.46" y="398.49" width="33.12" height="0.25"
                                    style="fill: rgb(235, 235, 235); transform-origin: 69.02px 398.615px;"
                                    id="elzn400vtyoq" class="animable"></rect>
                                <rect x="171.14" y="401.21" width="8.69" height="0.25"
                                    style="fill: rgb(235, 235, 235); transform-origin: 175.485px 401.335px;"
                                    id="ely6o5ic2kjc" class="animable"></rect>
                                <rect x="86.58" y="389.21" width="25.42" height="0.25"
                                    style="fill: rgb(235, 235, 235); transform-origin: 99.29px 389.335px;"
                                    id="elnl8u5hsvij" class="animable"></rect>
                                <rect x="422" y="390.89" width="27.9" height="0.25"
                                    style="fill: rgb(235, 235, 235); transform-origin: 435.95px 391.015px;"
                                    id="elkfky5aqeucj" class="animable"></rect>
                                <rect x="391.47" y="390.89" width="21.63" height="0.25"
                                    style="fill: rgb(235, 235, 235); transform-origin: 402.285px 391.015px;"
                                    id="elwcijd89eap" class="animable"></rect>
                                <rect x="277.21" y="395.11" width="51.45" height="0.25"
                                    style="fill: rgb(235, 235, 235); transform-origin: 302.935px 395.235px;"
                                    id="elfh9gl4b26gr" class="animable"></rect>
                                <path
                                    d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z"
                                    style="fill: rgb(235, 235, 235); transform-origin: 140.46px 196.4px;"
                                    id="elafssvamujs6" class="animable"></path>
                                <path
                                    d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z"
                                    style="fill: rgb(235, 235, 235); transform-origin: 356.75px 196.4px;"
                                    id="elvzlphijafo" class="animable"></path>
                                <rect x="56.11" y="72.33" width="262.94" height="148.36" rx="11.58"
                                    ry="11.58"
                                    style="fill: rgb(240, 240, 240); transform-origin: 187.58px 146.51px;"
                                    id="elxyrofb78mv" class="animable"></rect>
                                <g id="elt89zbdy6o4c">
                                    <rect x="116.3" y="17.94" width="142.57" height="257.15" rx="8.68"
                                        ry="8.68"
                                        style="fill: rgb(250, 250, 250); transform-origin: 187.585px 146.515px; transform: rotate(90deg);"
                                        class="animable"></rect>
                                </g>
                                <circle cx="77.44" cy="85.6" r="3.54"
                                    style="fill: rgb(235, 235, 235); transform-origin: 77.44px 85.6px;"
                                    id="elr58dg4s7cpq" class="animable"></circle>
                                <circle cx="91.12" cy="85.6" r="3.54"
                                    style="fill: rgb(235, 235, 235); transform-origin: 91.12px 85.6px;"
                                    id="elmtbg2u8ubrb" class="animable"></circle>
                                <circle cx="104.79" cy="85.6" r="3.54"
                                    style="fill: rgb(235, 235, 235); transform-origin: 104.79px 85.6px;"
                                    id="elqak86pqhfk" class="animable"></circle>
                                <rect x="269.18" y="94.24" width="169.67" height="116.58" rx="15.91"
                                    ry="15.91"
                                    style="fill: rgb(255, 255, 255); transform-origin: 354.015px 152.53px;"
                                    id="elmp3yc5m3yw" class="animable"></rect>
                                <path
                                    d="M422.94,211.48H285.08a16.6,16.6,0,0,1-16.57-16.57V110.14a16.6,16.6,0,0,1,16.57-16.57H422.94a16.6,16.6,0,0,1,16.57,16.57v84.77A16.6,16.6,0,0,1,422.94,211.48ZM285.08,94.9a15.26,15.26,0,0,0-15.24,15.24v84.77a15.26,15.26,0,0,0,15.24,15.24H422.94a15.26,15.26,0,0,0,15.24-15.24V110.14A15.26,15.26,0,0,0,422.94,94.9Z"
                                    style="fill: rgb(224, 224, 224); transform-origin: 354.01px 152.525px;"
                                    id="elpf5kn7mxj5c" class="animable"></path>
                                <path
                                    d="M335.7,196.28a47.53,47.53,0,0,1-19.42-15l5.38-4.1a40.67,40.67,0,0,0,69.86-8.95l6.24,2.61A47.65,47.65,0,0,1,335.7,196.28Z"
                                    style="fill: rgb(224, 224, 224); transform-origin: 357.02px 184.059px;"
                                    id="elsb1nqolmpv" class="animable"></path>
                                <path
                                    d="M397.76,170.82l-6.24-2.61A40.64,40.64,0,0,0,369.69,115l2.62-6.26a47.43,47.43,0,0,1,25.45,62.05Z"
                                    style="fill: rgb(235, 235, 235); transform-origin: 385.56px 139.78px;"
                                    id="elwaroyzbw8z" class="animable"></path>
                                <path
                                    d="M316.28,181.26a47.42,47.42,0,0,1,56-72.49L369.69,115a40.68,40.68,0,0,0-48,62.13Z"
                                    style="fill: rgb(245, 245, 245); transform-origin: 339.432px 143.183px;"
                                    id="elz1jilkb7dea" class="animable"></path>
                            </g>
                            <g id="freepik--Shadow--inject-19" class="animable"
                                style="transform-origin: 250px 416.24px;">
                                <ellipse id="freepik--path--inject-19" cx="250" cy="416.24" rx="193.89"
                                    ry="11.32" style="fill: rgb(245, 245, 245); transform-origin: 250px 416.24px;"
                                    class="animable"></ellipse>
                            </g>
                            <g id="freepik--Dashboard--inject-19" class="animable animator-active"
                                style="transform-origin: 250.77px 256.681px;">
                                <g id="ell7ac85rzy3">
                                    <g style="opacity: 0.3; transform-origin: 250.77px 229.275px;" class="animable">
                                        <rect x="84.68" y="100.59" width="332.18" height="257.37" rx="9.35"
                                            ry="9.35"
                                            style="fill: rgb(255, 255, 255); transform-origin: 250.77px 229.275px;"
                                            id="elu57cthh2ek" class="animable"></rect>
                                        <g id="elgrzp45fiek">
                                            <rect x="84.68" y="100.59" width="332.18" height="257.37" rx="9.35"
                                                ry="9.35"
                                                style="fill: rgb(206, 228, 116); opacity: 0.4; transform-origin: 250.77px 229.275px;"
                                                class="animable"></rect>
                                        </g>
                                    </g>
                                </g>
                                <g id="el78jgr5c2vhv">
                                    <rect x="97.27" y="126.27" width="307" height="103" rx="1.64"
                                        ry="1.64"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 250.77px 177.77px;"
                                        class="animable"></rect>
                                </g>
                                <rect x="99.62" y="124.03" width="302.3" height="102.85" rx="1.64"
                                    ry="1.64"
                                    style="fill: rgb(255, 255, 255); transform-origin: 250.77px 175.455px;"
                                    id="el0y62spl0k5f" class="animable"></rect>
                                <g id="el7wbj7k694lk">
                                    <rect x="121.97" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 122.97px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="el4o5pts39u78">
                                    <rect x="147.53" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 148.53px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="elfmqfuv1od98">
                                    <rect x="173.09" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 174.09px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="elcwruzne3atu">
                                    <rect x="198.65" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 199.65px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="elqrylk2k59">
                                    <rect x="224.21" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 225.21px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="elndkl02smj0k">
                                    <rect x="249.77" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 250.77px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="elsg8yxrwjg8">
                                    <rect x="275.33" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 276.33px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="eli7t4stxetv">
                                    <rect x="300.89" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 301.89px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="eltehvjzu7rk">
                                    <rect x="326.45" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 327.45px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="elnaq26etu23">
                                    <rect x="352.01" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 353.01px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <g id="elis8cgeke8oi">
                                    <rect x="377.57" y="129.29" width="2" height="92.34"
                                        style="fill: rgb(206, 228, 116); opacity: 0.1; transform-origin: 378.57px 175.46px;"
                                        class="animable"></rect>
                                </g>
                                <path
                                    d="M285.23,199.92a.47.47,0,0,1-.35-.14l-49.71-45.7-52.24,26.5a.58.58,0,0,1-.43,0l-19.25-7.46-55,20.87a.53.53,0,0,1-.68-.31.52.52,0,0,1,.3-.68l55.22-20.94a.55.55,0,0,1,.38,0l19.22,7.44L235,153a.53.53,0,0,1,.6.08l49.78,45.76,60.43-14.49,47.34-41.55a.53.53,0,0,1,.7.8l-47.44,41.64a.61.61,0,0,1-.23.11l-60.83,14.59Z"
                                    style="fill: rgb(224, 224, 224); transform-origin: 250.782px 171.304px;"
                                    id="el0n5wad1e8wm" class="animable"></path>
                                <path
                                    d="M108,206.51a.5.5,0,0,1-.31-.1.52.52,0,0,1-.11-.74L132,173a.53.53,0,0,1,.61-.18l57.89,21.66,78.81-34.85a.53.53,0,0,1,.49,0l29.35,18.16,20.42-13.92a.43.43,0,0,1,.24-.08l73.7-7.3a.54.54,0,0,1,.58.48.54.54,0,0,1-.48.58L320,164.86l-20.59,14a.53.53,0,0,1-.57,0l-29.41-18.2-78.75,34.83a.55.55,0,0,1-.4,0l-57.72-21.6-24.1,32.36A.54.54,0,0,1,108,206.51Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 250.782px 181.499px;"
                                    id="el9uzogf4zll6" class="animable"></path>
                                <g id="el0ulz74awo6o">
                                    <rect x="296.88" y="244.09" width="107.39" height="97.04" rx="13.06"
                                        ry="13.06"
                                        style="fill: rgb(206, 228, 116); opacity: 0.2; transform-origin: 350.575px 292.61px;"
                                        class="animable"></rect>
                                </g>
                                <g id="elj75f145vq9f">
                                    <polygon
                                        points="216.62 328.78 202.56 327.78 200.65 357.95 216.62 357.95 216.62 328.78"
                                        style="fill: rgb(206, 228, 116); opacity: 0.4; transform-origin: 208.635px 342.865px;"
                                        class="animable"></polygon>
                                </g>
                                <path
                                    d="M302.83,412.77H221.55a14.23,14.23,0,0,1-14-13.06l-5-70.93a12,12,0,0,1,12.14-13H296a14.22,14.22,0,0,1,14,13l5,70.93A12,12,0,0,1,302.83,412.77Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 258.778px 364.275px;"
                                    id="el290ajac3j9p" class="animable"></path>
                                <g id="elyhdi8ltlrb">
                                    <path
                                        d="M296,315.73H214.73a12,12,0,0,0-12.14,13l4,57.4H314l-4-57.4A14.22,14.22,0,0,0,296,315.73Z"
                                        style="fill: rgb(255, 255, 255); opacity: 0.8; transform-origin: 258.274px 350.929px;"
                                        class="animable"></path>
                                </g>
                                <path
                                    d="M259.7,377.89c-14.83,0-27.74-12.07-28.79-26.9A24.83,24.83,0,0,1,256,324c14.83,0,27.74,12.07,28.79,26.9a24.83,24.83,0,0,1-25.08,27ZM256,325.08a23.75,23.75,0,0,0-24,25.84,28.27,28.27,0,0,0,27.73,25.91,23.75,23.75,0,0,0,24-25.84h0A28.27,28.27,0,0,0,256,325.08Z"
                                    style="fill: rgb(255, 255, 255); transform-origin: 257.85px 350.95px;"
                                    id="el1tpf86jnbcg" class="animable"></path>
                                <polygon points="272.45 350.95 248.44 337.63 250.31 364.27 272.45 350.95"
                                    style="fill: rgb(206, 228, 116); transform-origin: 260.445px 350.95px;"
                                    id="el6l7gi0n4tky" class="animable"></polygon>
                            </g>
                            <g id="freepik--character-2--inject-19" class="animable"
                                style="transform-origin: 310.875px 256.566px;">
                                <polygon points="360.27 408.83 352.3 408.83 352.39 390.37 360.36 390.37 360.27 408.83"
                                    style="fill: rgb(181, 91, 82); transform-origin: 356.33px 399.6px;"
                                    id="el8731yb17ww2" class="animable"></polygon>
                                <polygon points="408.15 408.83 400.18 408.83 397.05 390.37 405.02 390.37 408.15 408.83"
                                    style="fill: rgb(181, 91, 82); transform-origin: 402.6px 399.6px;"
                                    id="elfviovu3bath" class="animable"></polygon>
                                <path
                                    d="M399.65,407.91h9a.64.64,0,0,1,.65.54l1.24,7.09a1.24,1.24,0,0,1-1.23,1.42c-3.13-.06-4.64-.24-8.58-.24-2.42,0-9,.25-12.31.25s-3.62-3.31-2.24-3.61c6.21-1.34,10.14-3.19,12.19-5A2,2,0,0,1,399.65,407.91Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 397.98px 412.44px;"
                                    id="eljkvop067ow" class="animable"></path>
                                <path
                                    d="M352.4,407.91h8.7a.66.66,0,0,1,.66.54l1.23,7.09a1.22,1.22,0,0,1-1.21,1.42c-3.14-.06-7.67-.24-11.62-.24-4.61,0-7.15.25-12.56.25-3.28,0-4-3.31-2.64-3.61,6.3-1.36,9.94-1.51,15.49-4.83A3.84,3.84,0,0,1,352.4,407.91Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 348.658px 412.44px;"
                                    id="elh5xu5tooxt" class="animable"></path>
                                <path
                                    d="M359.5,160.51l-10.89-3.19s-11.58,29-14.44,32c-3.88,4.07-7.78,12.76-14.12,20,.44,1.29,2.54,4.17,3.66,4.64,8.5-5.82,19-15.53,21.17-20.23C349.76,183.05,359.5,160.51,359.5,160.51Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 339.775px 185.64px;"
                                    id="el0pjfx8rr1dj" class="animable"></path>
                                <path
                                    d="M362.8,155.53c3.1,6.9-6.08,21.55-6.08,21.55L340.42,170a103.4,103.4,0,0,1,8-19.7C353.44,141.27,359.4,148,362.8,155.53Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 351.93px 161.523px;"
                                    id="elyu8lnvx5bd" class="animable"></path>
                                <g id="ele8pvrvg1e1m">
                                    <path
                                        d="M362.8,155.53c3.1,6.9-6.08,21.55-6.08,21.55L340.42,170a103.4,103.4,0,0,1,8-19.7C353.44,141.27,359.4,148,362.8,155.53Z"
                                        style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 351.93px 161.523px;"
                                        class="animable"></path>
                                </g>
                                <path d="M322.65,207.21l-8.24,4.07,6.57,7.87s1.93-1.27,4.13-6.68Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 319.76px 213.18px;"
                                    id="el5ji8rltq39e" class="animable"></path>
                                <path
                                    d="M311.26,220.77l1.71,1.42a3.22,3.22,0,0,0,4,.07l4-3.11-6.57-7.87-3.7,5.14A3.23,3.23,0,0,0,311.26,220.77Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 315.536px 217.101px;"
                                    id="elrf9gesdj4r" class="animable"></path>
                                <g id="elotmf3lrc44">
                                    <rect x="218.32" y="201.98" width="107.39" height="97.04" rx="13.06"
                                        ry="13.06"
                                        style="fill: rgb(255, 255, 255); transform-origin: 272.015px 250.5px; transform: rotate(-16.76deg);"
                                        class="animable"></rect>
                                </g>
                                <g id="elkuoyovju3">
                                    <rect x="218.32" y="201.98" width="107.39" height="97.04" rx="13.06"
                                        ry="13.06"
                                        style="fill: rgb(206, 228, 116); opacity: 0.5; transform-origin: 272.015px 250.5px; transform: rotate(-16.76deg);"
                                        class="animable"></rect>
                                </g>
                                <path d="M272.05,250.52l-32,14.92a35.3,35.3,0,0,1,52.23-43.83Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 264.515px 240.339px;"
                                    id="eldznrvcft37t" class="animable"></path>
                                <path
                                    d="M292.75,224.45a34,34,0,0,1,2.84,2.53,33.29,33.29,0,1,1-52.82,39.4l30.12-14,.49-.22.31-.44,19.06-27.22m-.46-2.84-20.24,28.91-32,14.92A35.29,35.29,0,1,0,297,225.57a34.9,34.9,0,0,0-4.71-4Z"
                                    style="fill: rgb(255, 255, 255); transform-origin: 273.658px 253.657px;"
                                    id="el2lwu94q9uh9" class="animable"></path>
                                <g id="elwzqb27baxog">
                                    <polygon
                                        points="352.39 390.37 352.34 399.89 360.32 399.89 360.37 390.37 352.39 390.37"
                                        style="opacity: 0.2; transform-origin: 356.355px 395.13px;" class="animable">
                                    </polygon>
                                </g>
                                <g id="elgoh6n9fd6mk">
                                    <polygon
                                        points="405.02 390.37 397.05 390.37 398.66 399.89 406.64 399.89 405.02 390.37"
                                        style="opacity: 0.2; transform-origin: 401.845px 395.13px;" class="animable">
                                    </polygon>
                                </g>
                                <path
                                    d="M352.67,146.11s-10.64,27.4-3.84,72.25h42.65c.61-6.55-1.91-41.81,5.88-72.66a110.26,110.26,0,0,0-14.19-1.8,156.55,156.55,0,0,0-18.13,0A82.7,82.7,0,0,0,352.67,146.11Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 371.96px 180.999px;"
                                    id="elxh3xtxzhss" class="animable"></path>
                                <g id="elbw7xwggr6r">
                                    <path
                                        d="M352.67,146.11s-10.64,27.4-3.84,72.25h42.65c.61-6.55-1.91-41.81,5.88-72.66a110.26,110.26,0,0,0-14.19-1.8,156.55,156.55,0,0,0-18.13,0A82.7,82.7,0,0,0,352.67,146.11Z"
                                        style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 371.96px 180.999px;"
                                        class="animable"></path>
                                </g>
                                <g id="elaqn0cr2lcuo">
                                    <path
                                        d="M387.73,153.32c-1,5.08.07,17.22,4.24,31.26a205.65,205.65,0,0,1,4.65-35.81v-.06C393.83,148.42,388.64,148.56,387.73,153.32Z"
                                        style="opacity: 0.2; transform-origin: 392.001px 166.6px;" class="animable">
                                    </path>
                                </g>
                                <path
                                    d="M381.61,127c-1.42,5.83-2.34,13.06,1.56,17,0,0-2.63,5.92-13.47,5.92-9.9,0-4.66-5.92-4.66-5.92,6.58-1.55,6.62-9.6,5.71-14.13Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 373.412px 138.46px;"
                                    id="elrhm4ip527uf" class="animable"></path>
                                <path
                                    d="M369.71,149.82c6.39,1.38,7.66,4,7.66,4s7.95-3.23,7.65-10.24c0,0-1.87-1.15-3-2.08C382,141.54,381.27,147,369.71,149.82Z"
                                    style="fill: rgb(255, 255, 255); transform-origin: 377.369px 147.66px;"
                                    id="elwkezmweuxi" class="animable"></path>
                                <path
                                    d="M369.71,149.82c-5.17.32-7.57,2.71-7.57,2.71s-1.3-1.69.88-8.63a23.37,23.37,0,0,1,3.52-1.1S365.5,148.32,369.71,149.82Z"
                                    style="fill: rgb(255, 255, 255); transform-origin: 365.733px 147.665px;"
                                    id="elxns620igr4e" class="animable"></path>
                                <g id="ely3o8iqerqk9">
                                    <path
                                        d="M370.74,129.78c.55,2.65.76,6.51-.5,9.57a10.68,10.68,0,0,0,2.95-.89c3.75-1.73,5.68-4.45,7.76-8.49.19-1,.41-2,.66-3Z"
                                        style="opacity: 0.2; transform-origin: 375.925px 133.16px;" class="animable">
                                    </path>
                                </g>
                                <path
                                    d="M361.67,123.4a7,7,0,0,0,3.67,4.24c2.34,1.1,4-1,3.83-3.44-.19-2.24-1.63-5.51-4.2-5.56A3.55,3.55,0,0,0,361.67,123.4Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 365.32px 123.29px;"
                                    id="elvizbtzdbnm" class="animable"></path>
                                <g id="elggnxsnu1s7">
                                    <path
                                        d="M361.67,123.4a7,7,0,0,0,3.67,4.24c2.34,1.1,4-1,3.83-3.44-.19-2.24-1.63-5.51-4.2-5.56A3.55,3.55,0,0,0,361.67,123.4Z"
                                        style="opacity: 0.2; transform-origin: 365.32px 123.29px;" class="animable">
                                    </path>
                                </g>
                                <path d="M370.07,107c-3.22-1.17-8.4,10.65-1.22,11.33S374.91,108.78,370.07,107Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 369.599px 112.641px;"
                                    id="elop8m3prpp0j" class="animable"></path>
                                <path
                                    d="M386.68,119.84c-2.48,7.64-3.56,12.23-8.44,15.36-7.34,4.72-15.82-.88-15.63-9,.18-7.32,4.21-18.59,12.47-20S389.16,112.19,386.68,119.84Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 374.932px 121.477px;"
                                    id="el7cw5xxasktk" class="animable"></path>
                                <path
                                    d="M369.71,111.2c-6.25-4.74-2.68-14.35,2.25-15,6.7-.84,10.53,12.44,18.3,13.05s4.41,13-5.68,16.41c-3.71,1.27-4.29-3.44-.59-10C381.61,116.29,373.32,113.94,369.71,111.2Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 380.456px 111.015px;"
                                    id="elhfu1pdlpl8o" class="animable"></path>
                                <path
                                    d="M369.64,127.93a5.63,5.63,0,0,0,4.15-1.33.19.19,0,0,0,0-.27.2.2,0,0,0-.27,0,5.38,5.38,0,0,1-4.55,1.12.19.19,0,0,0-.22.15.18.18,0,0,0,.14.22A6.62,6.62,0,0,0,369.64,127.93Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 371.296px 127.114px;"
                                    id="elica2phc9sde" class="animable"></path>
                                <path
                                    d="M387.9,129.13a7.88,7.88,0,0,1-5.37,2.27c-2.63,0-3.13-2.52-1.72-4.66,1.27-1.92,4.16-4.24,6.48-3.22S389.66,127.36,387.9,129.13Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 384.588px 127.336px;"
                                    id="elim9wut7j8pf" class="animable"></path>
                                <path
                                    d="M376.86,218.36s-1.08,10-2.47,23.61c-1.59,15.4-3.57,35.39-4.82,50.63a1.65,1.65,0,0,0,0,.21c-.24,2.89-.46,5.6-.63,8.08-1.79,24.85-6,97.16-6,97.16h-13.5s-5.09-73.79-4.79-99.08c.29-24.32,4.16-80.61,4.16-80.61Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 360.749px 308.205px;"
                                    id="elc1ld27afw4k" class="animable"></path>
                                <path d="M364.08,392.76c.06,0-.24,5.56-.24,5.56H348.27l-.39-6.11Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 355.984px 395.265px;"
                                    id="eldg69ubvjjcl" class="animable"></path>
                                <g id="elsh8s6fhcuyj">
                                    <path
                                        d="M374.39,242c-1.59,15.4-3.57,35.39-4.82,50.63a1.65,1.65,0,0,0,0,.21c-3-14.44-3.89-32.41-2.74-62Z"
                                        style="opacity: 0.2; transform-origin: 370.368px 261.84px;" class="animable">
                                    </path>
                                </g>
                                <path
                                    d="M364,218.36s6.22,57.61,10.1,80.44c4.24,25,21,99.25,21,99.25h14.61s-9.85-72.23-11.77-97c-2.09-26.87-6.39-82.71-6.39-82.71Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 386.855px 308.195px;"
                                    id="elogs7plgtp4m" class="animable"></path>
                                <path d="M409.85,393.09c.06,0,.5,5.23.5,5.23H394.3l-1.17-5.83Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 401.74px 395.405px;"
                                    id="ela6h1x6osubu" class="animable"></path>
                                <path
                                    d="M374.56,119.48c-.16.63-.63,1.07-1,1s-.6-.67-.44-1.3.63-1.08,1-1S374.72,118.85,374.56,119.48Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 373.84px 119.329px;"
                                    id="elhospcdhmout" class="animable"></path>
                                <path
                                    d="M367.55,117.94c-.16.63-.63,1.07-1,1s-.6-.68-.44-1.31.63-1.07,1-1S367.71,117.31,367.55,117.94Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 366.83px 117.785px;"
                                    id="elkes5kw6wgl" class="animable"></path>
                                <path d="M369.7,118.74a24.53,24.53,0,0,1-4.37,4.75c.83,1.28,2.82,1.22,2.82,1.22Z"
                                    style="fill: rgb(160, 39, 36); transform-origin: 367.515px 121.725px;"
                                    id="el8gb3kutyqo2" class="animable"></path>
                                <path
                                    d="M377,118.57a.39.39,0,0,1-.24-.23,2.82,2.82,0,0,0-1.87-1.9.36.36,0,0,1-.27-.45.42.42,0,0,1,.47-.29,3.51,3.51,0,0,1,2.39,2.37.39.39,0,0,1-.48.5Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 376.054px 117.14px;"
                                    id="elwg18t3jmo5d" class="animable"></path>
                                <path
                                    d="M392.28,112.58a.49.49,0,0,1,.32-.35,4,4,0,0,0,2.62-2.75.51.51,0,0,1,.63-.39.57.57,0,0,1,.43.65,5,5,0,0,1-3.27,3.5.56.56,0,0,1-.71-.32A.57.57,0,0,1,392.28,112.58Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 394.276px 111.173px;"
                                    id="el2krrrhnmgtn" class="animable"></path>
                                <path
                                    d="M396.88,114.4a.51.51,0,0,1-.46-.08,4,4,0,0,0-3.72-.75.52.52,0,0,1-.68-.33.57.57,0,0,1,.32-.7,5,5,0,0,1,4.72.89.57.57,0,0,1,.1.77A.51.51,0,0,1,396.88,114.4Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 394.629px 113.359px;"
                                    id="el5xpjrchjv6o" class="animable"></path>
                                <path
                                    d="M365.06,115.14a.55.55,0,0,1-.15-.08.38.38,0,0,1,0-.54,3.88,3.88,0,0,1,3.24-1.31.35.35,0,0,1,.29.43.39.39,0,0,1-.44.32h0a3.08,3.08,0,0,0-2.55,1.07A.39.39,0,0,1,365.06,115.14Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 366.624px 114.175px;"
                                    id="elnugocqy0dw" class="animable"></path>
                                <path
                                    d="M402.09,156.59,392,162.68s12.58,24.63,11.19,28.48c-1.9,5.24-4.78,16.74-8.14,22.52.32,1.27,2.17,4.22,3.27,4.75,8-5.5,16.83-23.23,16.82-28.24C415.13,178.77,402.09,156.59,402.09,156.59Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 403.57px 187.51px;"
                                    id="elz0rw7fail7" class="animable"></path>
                                <path
                                    d="M397.36,145.7c7.49,1.1,14.88,27.24,14.88,27.24L396,181.89s-6.38-12.43-9.38-21.66C383.44,150.55,389.32,144.53,397.36,145.7Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 398.991px 163.723px;"
                                    id="elicl8kfx3yfk" class="animable"></path>
                                <g id="elxk390ly85j">
                                    <path
                                        d="M397.36,145.7c7.49,1.1,14.88,27.24,14.88,27.24L396,181.89s-6.38-12.43-9.38-21.66C383.44,150.55,389.32,144.53,397.36,145.7Z"
                                        style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 398.991px 163.723px;"
                                        class="animable"></path>
                                </g>
                                <path
                                    d="M397,409.3a2.31,2.31,0,0,1-1.52-.41,1.09,1.09,0,0,1-.34-1,.63.63,0,0,1,.35-.53c.89-.45,3.4,1.13,3.68,1.31a.2.2,0,0,1,.08.19.21.21,0,0,1-.15.15A9.17,9.17,0,0,1,397,409.3Zm-1.11-1.65a.43.43,0,0,0-.24.05c-.06,0-.12.07-.13.22a.72.72,0,0,0,.22.68c.42.37,1.46.42,2.82.15A7.26,7.26,0,0,0,395.84,407.65Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 397.187px 408.294px;"
                                    id="eluqngkea6nak" class="animable"></path>
                                <path
                                    d="M399,409l-.08,0c-.81-.45-2.32-2.2-2.11-3.09a.65.65,0,0,1,.63-.49,1,1,0,0,1,.79.24c.89.76,1,3.06,1,3.16a.21.21,0,0,1-.09.17A.2.2,0,0,1,399,409Zm-1.45-3.23h-.09c-.24,0-.27.15-.28.19-.13.53.83,1.85,1.62,2.47A4.37,4.37,0,0,0,398,406,.64.64,0,0,0,397.55,405.79Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 398.01px 407.21px;"
                                    id="elgt5n0zpnlxq" class="animable"></path>
                                <path
                                    d="M349,409.3a2.9,2.9,0,0,1-1.91-.49,1,1,0,0,1-.31-.92.62.62,0,0,1,.34-.5c1-.54,4.12,1.08,4.47,1.27a.18.18,0,0,1,.09.2.2.2,0,0,1-.16.16A14.15,14.15,0,0,1,349,409.3Zm-1.36-1.65a.74.74,0,0,0-.36.07.27.27,0,0,0-.13.2.68.68,0,0,0,.2.61c.47.43,1.78.51,3.56.22A10,10,0,0,0,347.65,407.65Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 349.224px 408.297px;"
                                    id="elgxcdntt26s" class="animable"></path>
                                <path
                                    d="M351.5,409l-.08,0c-.94-.43-2.77-2.15-2.58-3.06.05-.21.21-.47.73-.52a1.3,1.3,0,0,1,1,.32c1,.83,1.09,3,1.09,3.07a.19.19,0,0,1-.08.17A.17.17,0,0,1,351.5,409Zm-1.79-3.23h-.12c-.34,0-.37.17-.38.21-.11.55,1.12,1.9,2.07,2.49a4.21,4.21,0,0,0-.93-2.46A1,1,0,0,0,349.71,405.79Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 350.243px 407.206px;"
                                    id="elkdw8ha8enoj" class="animable"></path>
                                <path d="M396.41,213.32l-7.56-.58,3.59,8.38s6.64.29,8-4.79Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 394.645px 216.932px;"
                                    id="eldjkbldlmbc" class="animable"></path>
                                <path
                                    d="M383.46,218.52l1.66,3.38a2.38,2.38,0,0,0,3.12,1.12l4.2-1.9-3.59-8.38-4.48,2.69A2.38,2.38,0,0,0,383.46,218.52Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 387.828px 217.986px;"
                                    id="eldlzmjls30pg" class="animable"></path>
                                <path
                                    d="M317.12,209.92a31.72,31.72,0,0,1-7.95,1.74.49.49,0,0,0-.46.59,2.14,2.14,0,0,0,1.49,1.5c.84.19,3,.6,3.47.69a.42.42,0,0,1,.19.09,8.73,8.73,0,0,0,4.56,1.78c1.94,0,0-4.69-.7-6.15A.46.46,0,0,0,317.12,209.92Z"
                                    style="fill: rgb(181, 91, 82); transform-origin: 313.979px 213.097px;"
                                    id="eltffws38fvie" class="animable"></path>
                            </g>
                            <g id="freepik--character-1--inject-19" class="animable"
                                style="transform-origin: 136.847px 264.402px;">
                                <path
                                    d="M150.23,140.56c.87,5.29,1.62,14.94-2.16,18.33a20.33,20.33,0,0,0,12.46,8.9c8.28-4.2,3.86-8.41,3.86-8.41-5.82-1.57-5.54-5.91-4.39-10Z"
                                    style="fill: rgb(255, 195, 189); transform-origin: 156.819px 154.175px;"
                                    id="elynxnzx5goy9" class="animable"></path>
                                <path
                                    d="M138.3,172.16c-.62,5.06-1.42,10-2.41,15s-2.07,9.9-3.51,14.84c-.73,2.48-1.57,5-2.48,7.3s-1.82,4.68-2.78,7c-1.91,4.63-3.93,9.19-6.12,13.71l-4.22-1.51c1.13-4.86,2.4-9.68,3.71-14.47s2.75-9.55,3.79-14.14,2-9.5,2.78-14.33,1.55-9.72,2.26-14.51Z"
                                    style="fill: rgb(255, 195, 189); transform-origin: 127.54px 200.53px;"
                                    id="elvl7iugzxuw" class="animable"></path>
                                <path
                                    d="M132.74,160.45c-3.52,1.34-7,15.57-7,15.57l14,10.64s5-13.86,3.2-18.4C141,163.53,136.76,158.92,132.74,160.45Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 134.535px 173.406px;"
                                    id="elpuhwgl6k5xm" class="animable"></path>
                                <path d="M117.64,226.77l-6.38,7.13,9,.26s2.89-4.9,1-8Z"
                                    style="fill: rgb(255, 195, 189); transform-origin: 116.581px 230.16px;"
                                    id="eloguzz45ddc" class="animable"></path>
                                <g id="el2sxur6kipvb">
                                    <rect x="61.39" y="238.45" width="107.39" height="97.04" rx="13.06"
                                        ry="13.06"
                                        style="fill: rgb(206, 228, 116); opacity: 0.2; transform-origin: 115.085px 286.97px; transform: rotate(-7.98deg);"
                                        class="animable"></rect>
                                </g>
                                <path
                                    d="M84.27,331.49a8.64,8.64,0,0,1-8.54-7.43l-8.68-61.93a8.62,8.62,0,0,1,7.34-9.74l70.31-9.87a8.64,8.64,0,0,1,9.74,7.35l8.69,61.93a8.64,8.64,0,0,1-7.35,9.75l-70.3,9.86A10,10,0,0,1,84.27,331.49ZM145.9,243a8.71,8.71,0,0,0-1.13.08l-70.3,9.86a8.09,8.09,0,0,0-6.9,9.15L76.26,324a8.11,8.11,0,0,0,9.14,6.89L155.71,321a8.1,8.1,0,0,0,6.9-9.14L153.92,250A8.12,8.12,0,0,0,145.9,243Z"
                                    style="fill: rgb(255, 255, 255); transform-origin: 115.089px 286.964px;"
                                    id="eleppp9k8z6te" class="animable"></path>
                                <polygon points="110.77 241.32 118.31 241.14 120.26 234.16 111.26 233.9 110.77 241.32"
                                    style="fill: rgb(255, 195, 189); transform-origin: 115.515px 237.61px;"
                                    id="elyxi7muf0by" class="animable"></polygon>
                                <path
                                    d="M180.12,166.27c.2,5.6-.77,18.67-6.66,49.11l-35.94-1.07c1-14.61,1.32-23.63-4.78-53.86a107.12,107.12,0,0,1,15.33-1.56,115.1,115.1,0,0,1,16.32.49c4.16.5,8.64,1.37,11.59,2A5.2,5.2,0,0,1,180.12,166.27Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 156.442px 187.087px;"
                                    id="elwbzepwbtmi" class="animable"></path>
                                <path
                                    d="M179.6,167.93c1.68,4.82,3.18,9.61,4.59,14.48s2.74,9.74,3.93,14.67l.44,1.85.22.93.11.46s0-.11,0-.1,0,.2.28.48a8.59,8.59,0,0,0,.9,1,40.54,40.54,0,0,0,5.43,4.11c4,2.63,8.37,5.11,12.66,7.52l-1.7,4.15A93.2,93.2,0,0,1,192,211.9a41.1,41.1,0,0,1-7-4.26,18.68,18.68,0,0,1-1.8-1.63,9.79,9.79,0,0,1-1.8-2.63,8.4,8.4,0,0,1-.35-1l-.14-.44-.26-.89-.54-1.79q-2.17-7.11-4.44-14.23L171,170.84Z"
                                    style="fill: rgb(255, 195, 189); transform-origin: 189.58px 192.705px;"
                                    id="elfddvzk8dv05" class="animable"></path>
                                <path
                                    d="M176.22,161.42c6.62,1.41,8.76,15.36,8.76,15.36l-11.37,10.39s-9.31-15.81-7.1-20.18C168.81,162.44,170.84,160.28,176.22,161.42Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 175.575px 174.145px;"
                                    id="elmbaj7nua6ij" class="animable"></path>
                                <path d="M206,212.45l9,3.4-7.3,4.84s-4.32-2.56-4-6.14Z"
                                    style="fill: rgb(255, 195, 189); transform-origin: 209.342px 216.57px;"
                                    id="elwilsiu9jh1" class="animable"></path>
                                <polygon points="218.52 220.56 212.98 224.05 207.64 220.69 214.94 215.85 218.52 220.56"
                                    style="fill: rgb(255, 195, 189); transform-origin: 213.08px 219.95px;"
                                    id="elqmxrnsexutp" class="animable"></polygon>
                                <path
                                    d="M170.14,131c.06.71.49,1.26,1,1.22s.8-.65.74-1.36-.48-1.26-1-1.22S170.09,130.26,170.14,131Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 171.011px 130.93px;"
                                    id="elftxo4gp3g5g" class="animable"></path>
                                <path d="M170.68,129.67l1.67-.63S171.58,130.44,170.68,129.67Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 171.515px 129.471px;"
                                    id="eljreapxvnqpr" class="animable"></path>
                                <path d="M170.88,132.5a19.11,19.11,0,0,0,2.91,4.34,3.08,3.08,0,0,1-2.5.68Z"
                                    style="fill: rgb(237, 132, 126); transform-origin: 172.335px 135.032px;"
                                    id="elhafpxsmbk2" class="animable"></path>
                                <path
                                    d="M167.38,129.32a.43.43,0,0,0,.42-.26c.73-1.8,3.16-2.38,3.18-2.39a.42.42,0,1,0-.19-.81c-.12,0-2.88.69-3.77,2.88a.42.42,0,0,0,.23.55A.31.31,0,0,0,167.38,129.32Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 169.175px 127.576px;"
                                    id="elska4bd3w5bl" class="animable"></path>
                                <path
                                    d="M145.85,130.34c1.25,8.7,1.59,12.41,6.38,16.53,7.19,6.21,17.6,2.76,19-6.13,1.23-8-1-20.89-9.87-23.67A12,12,0,0,0,145.85,130.34Z"
                                    style="fill: rgb(255, 195, 189); transform-origin: 158.625px 133.261px;"
                                    id="elu36s06tteqs" class="animable"></path>
                                <path
                                    d="M160.33,114.67c-3.89-4.76-22.19-4.49-17,7.77-7.71,1.06-7.62,8.55-6.92,14.2s-5.91,4.59-7.05,11.47,1.78,7.56-3.06,13,2.14,16.72,11.32,13.81,16.48,2.81,27.9.54,12.52-11.47,10-16.64c-2.34-4.83-5.58-5.54-4.89-10.15,1-6.79-3.44-13.34-7.41-15.42C168,128.7,182.17,114.94,160.33,114.67Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 150.679px 143.905px;"
                                    id="eln7ob9zci4n" class="animable"></path>
                                <path
                                    d="M163.65,134.46a4.7,4.7,0,0,0,2.93,2.49c1.63.42,2.39-1.37,1.89-3.15-.44-1.61-1.83-3.76-3.44-3.37S162.87,132.89,163.65,134.46Z"
                                    style="fill: rgb(255, 195, 189); transform-origin: 165.961px 133.698px;"
                                    id="elgdrlhcv7d3m" class="animable"></path>
                                <path
                                    d="M100.47,406.52a3.35,3.35,0,0,1-2.08-.76,1.16,1.16,0,0,1-.27-1.05.67.67,0,0,1,.41-.52c1.14-.48,4.47,1.67,4.84,1.91a.21.21,0,0,1,.09.23.2.2,0,0,1-.18.16A15.28,15.28,0,0,1,100.47,406.52Zm-1.38-2a.72.72,0,0,0-.4,0,.24.24,0,0,0-.16.21.76.76,0,0,0,.17.69c.49.53,1.93.77,3.91.64A11.37,11.37,0,0,0,99.09,404.54Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 100.778px 405.345px;"
                                    id="el0fv1jtp0c33v" class="animable"></path>
                                <path
                                    d="M103.24,406.49a.16.16,0,0,1-.09,0c-1-.58-2.88-2.69-2.62-3.67.06-.23.26-.51.85-.51a1.49,1.49,0,0,1,1.11.48c1,1,1,3.42,1,3.52a.19.19,0,0,1-.11.18A.27.27,0,0,1,103.24,406.49Zm-1.74-3.79h-.12c-.39,0-.43.15-.44.2-.16.59,1.1,2.22,2.1,3a4.81,4.81,0,0,0-.85-2.83A1.07,1.07,0,0,0,101.5,402.7Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 101.998px 404.405px;"
                                    id="el7yqbl2wkpoq" class="animable"></path>
                                <polygon points="102.63 407.93 111.48 407.93 116.05 387.43 107.2 387.43 102.63 407.93"
                                    style="fill: rgb(255, 195, 189); transform-origin: 109.34px 397.68px;"
                                    id="elr6heh0ue52j" class="animable"></polygon>
                                <path
                                    d="M102.66,405.94l9.85-1.37a.55.55,0,0,1,.66.52l.65,7.85a1.82,1.82,0,0,1-1.5,1.8c-3.44.42-5.08.44-9.41,1.05A82,82,0,0,1,92.08,417c-3.64,0-3.18-3.67-1.57-4,7.24-1.49,8.21-3.94,10.65-6.26A2.8,2.8,0,0,1,102.66,405.94Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 101.562px 410.779px;"
                                    id="elgexjhprhedv" class="animable"></path>
                                <g id="el4trxj4zr2o">
                                    <g style="opacity: 0.2; transform-origin: 110.445px 392.715px;" class="animable">
                                        <polygon
                                            points="116.05 387.43 113.69 398 104.84 398 107.19 387.43 116.05 387.43"
                                            id="elowayc1lr6r" class="animable"
                                            style="transform-origin: 110.445px 392.715px;"></polygon>
                                    </g>
                                </g>
                                <path
                                    d="M137.52,214.31c-9.71,13.71-15.33,64.05-18.82,91-3.63,28-14.28,90.67-14.28,90.67h12s16.53-63.49,22.8-90.82c6.93-30.16,21.34-90.82,21.34-90.82Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 132.49px 305.145px;"
                                    id="el0z6bxn4m8be" class="animable"></path>
                                <g id="el93kgt4zybmf">
                                    <path
                                        d="M147.53,237.61c-5.85,17.68-6.1,40-5.43,55,3.6-15.53,8.08-34.54,11.72-49.94Z"
                                        style="opacity: 0.2; transform-origin: 147.83px 265.11px;" class="animable">
                                    </path>
                                </g>
                                <path
                                    d="M161.51,407.52a3.35,3.35,0,0,0,2.14-.54,1.17,1.17,0,0,0,.38-1,.65.65,0,0,0-.35-.55c-1.09-.6-4.62,1.21-5,1.41a.23.23,0,0,0-.11.22.2.2,0,0,0,.17.17A15,15,0,0,0,161.51,407.52Zm1.57-1.83a.77.77,0,0,1,.4.08.23.23,0,0,1,.13.22.72.72,0,0,1-.24.67c-.53.49-2,.57-4,.25A11.24,11.24,0,0,1,163.08,405.69Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 161.303px 406.421px;"
                                    id="el180j76f08d1" class="animable"></path>
                                <path
                                    d="M158.76,407.21l.09,0c1.05-.48,3.14-2.39,3-3.39,0-.24-.21-.53-.79-.59a1.54,1.54,0,0,0-1.16.36c-1.12.93-1.32,3.31-1.33,3.41a.22.22,0,0,0,.09.19A.19.19,0,0,0,158.76,407.21Zm2.11-3.59H161c.38,0,.4.19.41.24.1.6-1.32,2.1-2.39,2.75a4.86,4.86,0,0,1,1.13-2.73A1.09,1.09,0,0,1,160.87,403.62Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 160.213px 405.216px;"
                                    id="elii877b9gdol" class="animable"></path>
                                <polygon points="149.94 407.93 158.8 407.93 158.37 387.43 149.51 387.43 149.94 407.93"
                                    style="fill: rgb(255, 195, 189); transform-origin: 154.155px 397.68px;"
                                    id="el191nqxl40jw" class="animable"></polygon>
                                <path
                                    d="M159.66,406.91h-9.95a.7.7,0,0,0-.71.6l-1.13,7.87a1.42,1.42,0,0,0,1.42,1.58c3.47-.06,5.14-.27,9.51-.27,2.69,0,10.42.28,14.14.28s3.92-3.67,2.37-4c-6.94-1.49-11.84-3.55-14.17-5.51A2.33,2.33,0,0,0,159.66,406.91Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 162.042px 411.94px;"
                                    id="el2etdtlqa1sx" class="animable"></path>
                                <g id="elmwpl8zaokn">
                                    <g style="opacity: 0.2; transform-origin: 154.05px 392.715px;" class="animable">
                                        <polygon
                                            points="158.36 387.43 158.59 398 149.73 398 149.51 387.43 158.36 387.43"
                                            id="elon0bl72h57" class="animable"
                                            style="transform-origin: 154.05px 392.715px;"></polygon>
                                    </g>
                                </g>
                                <path
                                    d="M173.46,215.38s-3.67,66.64-6.2,93.53c-2.64,28-7,87-7,87h-12s-2.62-60.14-.67-87.67c2.12-30-5.74-71.66-.51-93.68C152,214.6,173.46,215.38,173.46,215.38Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 159.355px 305.235px;"
                                    id="elosl9vg6akxg" class="animable"></path>
                                <polygon points="147.28 396.38 161.33 396.38 162.03 390.86 146.71 391.95 147.28 396.38"
                                    style="fill: rgb(206, 228, 116); transform-origin: 154.37px 393.62px;"
                                    id="eld9wd7jfkbst" class="animable"></polygon>
                                <polygon points="103.59 396.38 117.63 396.38 119.04 390.51 103.4 391.96 103.59 396.38"
                                    style="fill: rgb(206, 228, 116); transform-origin: 111.22px 393.445px;"
                                    id="elv9j11z5zzi" class="animable"></polygon>
                                <path
                                    d="M137,212.19l-1,3.19c-.13.24.15.51.57.52l37,1.1c.33,0,.6-.14.63-.35l.42-3.2c0-.23-.25-.42-.6-.43l-36.4-1.09A.69.69,0,0,0,137,212.19Z"
                                    style="fill: rgb(206, 228, 116); transform-origin: 155.294px 214.463px;"
                                    id="ell8h7h6m4pe" class="animable"></path>
                                <path
                                    d="M141.81,216.4l-1,0c-.2,0-.34-.11-.33-.23l.59-4.17c0-.12.19-.21.38-.21l1,0c.2,0,.34.11.33.23l-.59,4.17C142.18,216.31,142,216.41,141.81,216.4Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 141.63px 214.095px;"
                                    id="elmtihlva78js" class="animable"></path>
                                <path
                                    d="M170.84,217.27l-1,0c-.2,0-.34-.11-.32-.24l.58-4.16c0-.12.19-.22.38-.21l1,0c.19,0,.34.11.32.23l-.58,4.16C171.21,217.18,171,217.27,170.84,217.27Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 170.66px 214.965px;"
                                    id="eljr4r6hs84wt" class="animable"></path>
                                <path
                                    d="M156.33,216.83l-1,0c-.19,0-.34-.12-.32-.24l.58-4.16c0-.13.19-.22.39-.21l1,0c.19,0,.34.11.32.24l-.58,4.16C156.69,216.74,156.52,216.84,156.33,216.83Z"
                                    style="fill: rgb(38, 50, 56); transform-origin: 156.155px 214.525px;"
                                    id="ell4brxofooml" class="animable"></path>
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
        <p>
        </p>

        {{-- modal pour refuser un checkout --}}


        <div class="modal fade " id="centeredModal" tabindex="-1" aria-labelledby="centeredModalLabel"
            aria-hidden="true">
            <!-- Add modal-dialog-centered here -->
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content  ">

                    <div class="container col-lg-12 shadow-sm rounded-2 bg-white">
                        <div>
                            <div class="row">
                                <div class="col-lg-4 ">
                                    <img width="100" class="mt-2 shadow-sm   rounded-pill"
                                        src="{{ asset('/images/avtar_1.png') }}" alt="Photo de profil">

                                </div>
                                <div class="col-lg-7 mt-3">
                                    <h2 class="fw-bold "> {{ $utilisateurs->nom }}</h2>
                                    <p class="border-start border-warning border-3  "><small class="mx-2">
                                            {{ $utilisateurs->poste }}</small> </p>
                                </div>
                            </div>

                            <div class="row  mt-4 mb-4">
                                <div class=" text-center col-lg-12 ">

                                    <div class="border bg-success-light shadow-sm py-1 rounded-2 col-lg-5"
                                        data-bs-dismiss="modal" aria-label="Ouvrir le chat" id="chatToggle">
                                        <i class="bi bi-chat-dots  "></i> Message
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 text-center "> 

                <div class="border bg-success-light shadow-sm py-1 rounded-2 col-lg-6"   aria-label="Ouvrir le chat" id="chatToggle">
                     <i class="bi bi-chat-dots me-2  "></i> Voir plus
                </div>
            </div> --}}
                            </div>
                        </div>
                        <div class="mt-4   p-0">
                            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                <li class="nav-item " role="presentation">
                                    <button class="nav-link text-dark active" id="active-tab" data-bs-toggle="tab"
                                        data-bs-target="#active" type="button" role="tab"
                                        aria-controls="active" aria-selected="true">
                                        A propos
                                    </button>
                                </li>

                            </ul>
                            <hr>

                            <div class="tab-content border-0 p-3 border border-top-0" id="myTabContent">
                                <div class="tab-pane fade show active " id="active" role="tabpanel"
                                    aria-labelledby="active-tab">


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
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                        {{-- <button type="submit" class="btn btn-primary">OK</button> --}}
                    </div>
                    </form>

                </div>
            </div>
        </div>

        <aside wire:ignore.self class="chat-popup" id="chatPopup" role="dialog" tabindex="-1"
            style="z-index: 4000" aria-modal="false" aria-label="Fenêtre de chat">
            <header class="chat-header">
                <div> <img width="50" style="cursor: pointer" class="mt-2 shadow-sm   rounded-pill"
                        src="{{ asset('/images/avtar_1.png') }}" alt="Photo de profil">
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

                    <div class="msg {{ $chat->type == 'user' ? 'user' : 'agent' }}">{{ $chat->message }}<small>Vous ·
                            {{ \Carbon\Carbon::parse($chat->created_at)->translatedFormat('d M Y H:i') }} </small>
                    </div>

                    {{-- <div class="msg user">Salut, j'ai un problème avec mon compte<small>Vous · 08:56</small></div>
      
      <div class="msg agent">D'accord, peux-tu préciser ?<small>Support · 08:57</small></div>
      <div class="msg agent">{{$chat->message}}<small>Vous · {{$chat->created_at}}</small></div> --}}
                @endforeach
            </div>

            <form wire:submit.prevent="EnvoyerMessage" class="p-2">
                <textarea id="input" wire:model="message" class="chat-input" rows="1" placeholder="Écris un message..."></textarea>
                <button id="sendBtn" type="submit" class="btn border-0 btn-primary btn-sm">Envoyer</button>
            </form>
        </aside>
    </div>



    <style>
        /* Reset minimal */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html,
        body {
            height: 100%
        }

        body {
            font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background: #f3f4f6
        }

        /* Floating button */
        .chat-toggle {
            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 1000;
            width: 56px;
            height: 56px;
            border-radius: 28px;
            background: #0b84ff;
            color: #fff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(11, 132, 255, .24);
            font-weight: 700;
            font-size: 18px
        }

        /* Popup container */
        .chat-popup {
            position: fixed;
            right: 24px;
            bottom: 92px;
            z-index: 1000;
            width: 360px;
            max-width: 92vw;
            height: 520px;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 18px 50px rgba(15, 23, 42, .2);
            overflow: hidden;
            transform: translateY(20px);
            opacity: 0;
            pointer-events: none;
            transition: all .26s cubic-bezier(.2, .9, .3, 1);
        }

        .chat-popup.open {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto
        }

        /* Header */
        .chat-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-bottom: 1px solid #eef2f7;
            background: linear-gradient(90deg, #f8fafc, #fff)
        }

        .chat-avatar {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0b84ff, #0047b3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700
        }

        .chat-title {
            flex: 1
        }

        .chat-title h4 {
            font-size: 15px;
            margin-bottom: 2px
        }

        .chat-title p {
            font-size: 12px;
            color: #64748b
        }

        .chat-close {
            background: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #64748b
        }

        /* Messages area */
        .chat-messages {
            flex: 1;
            padding: 12px;
            overflow: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%)
        }

        .msg {
            max-width: 78%;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.35
        }

        .msg.agent {
            align-self: flex-start;
            background: #f1f5f9;
            color: #0f172a;
            border-bottom-left-radius: 4px
        }

        .msg.user {
            align-self: flex-end;
            background: #0b84ff;
            color: #fff;
            border-bottom-right-radius: 4px
        }

        .msg small {
            display: block;
            margin-top: 6px;
            font-size: 11px;
            opacity: .75
        }

        /* Composer */
        .chat-composer {
            padding: 10px;
            border-top: 1px solid #eef2f7;
            display: flex;
            gap: 8px;
            align-items: center
        }

        .chat-input {
            flex: 1;
            background: #f8fafc;
            border: 1px solid #e6eef9;
            padding: 10px 12px;
            border-radius: 10px;
            min-height: 40px;
            resize: none
        }

        .btn-send {
            background: #0b84ff;
            color: #fff;
            border: none;
            padding: 10px 12px;
            border-radius: 10px;
            cursor: pointer
        }

        /* Tiny responsive tweak */
        @media (max-width:420px) {
            .chat-popup {
                right: 12px;
                left: 12px;
                width: calc(100% - 24px);
                bottom: 80px
            }

            .chat-toggle {
                right: 12px;
                bottom: 12px
            }
        }
    </style>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer !'
    });
</script>
@endif

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
