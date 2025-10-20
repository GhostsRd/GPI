<div>
    <div class="dashboard-header">
        <h4 class="text-muted"><strong>Checkouts / view</strong></h4>
        <p class="dashboard-subtitle">Vue d'ensemble de votre activité</p>
    </div>


    <div class="container-fluid p-lg-2 p-sm-2 p-md-2 mb-sm-2 mb-md-2 ">
        <div class="row h-100">

            <div class="col-lg-9  mb-md-2 mb-sm-2">
                {{-- <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow_{{$ticketvals->priorite}} "> --}}

                <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow">
                    <div class="row">
                        <div class="col-lg-11 col-md-10 col-sm-10">
                            <label class="fw-bold  mb-1 mt-0 pt-0"><i class="bi bi-ticket-detailed"></i> Checkout #<span
                                    id="ticketId">{{ $checkoutId }}</span> — {{ $checkouts->materiel_type }}</label>

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

                    <div class="row  p-3 fond-bg rounded-3">
                        <div class="steps-container row" style="display:flex;align-items:center;">
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
                            <div class="step {{ $current[3] }} col-lg-3" data-index="2">
                                <div class="dot">3</div>
                                <div class="title">Rendu</div>
                                <div class="sub">Intervention</div>

                            </div>

                        </div>
                    </div>
                    <hr>

                    <div class="container-fluid mt-4 mb-3 ml-0">
                        <h5>Details</h5>
                        <p>{{ $checkouts->materiel_type }} {{ $checkouts->materiel_details }}</p>
                        <label for="" class="fw-bold">Selection le materiel </label>
                        <div class="col-lg-3">

                            <select name="" id="" class="form-control shadow-sm border-0  disabled"
                                style="overflow: scroll">
                                @foreach ($TelephoneTablettes as $TelephoneTablette)
                                    <option value="{{ $TelephoneTablette->id }}">{{ $TelephoneTablette->type }}
                                        {{ $TelephoneTablette->marque }} {{ $TelephoneTablette->modele }} </option>
                                @endforeach

                                @foreach ($ordinateurs as $ordinateur)
                                    <option value="{{ $ordinateur->id }}">{{ $ordinateur->type }}
                                        {{ $ordinateur->marque }} {{ $ordinateur->modele }}
                                        {{ $ordinateur->os_version }} </option>
                                @endforeach
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
                    </div>
                    <div class="container-fluid">
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
                                    class="btn btn-sm btn-outline-primary border-0 fw-bold">Reculer</button>
                                <button type="submit" wire:click="nextStep"
                                    class="btn btn-sm btn-primary border fw-bold"><span class="loader"></span>
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
                            <button class="btn-ghost" id="markResolved" wire:click="markResolved">Marquer comme
                                Résolu</button>
                            <button class="btn-ghost" id="markClosed"
                                wire:click="FermerTicket({{ $checkouts->id }})">Fermer ticket</button>
                        </div>
                    </div>

                    <div>
                        <h4 style="margin:0 0 8px">États actuels</h4>
                        <div style="display:flex;gap:8px;flex-wrap:wrap">
                            <span class="badge open">Nouveau</span>
                            <span class="badge open" style="background:#fff7ed;color:var(--warn)">En cours</span>
                            <span class="badge open" style="background:#eefbf7;color:var(--ok)">Rendu</span>
                            <span class="badge closed">Fermé</span>
                        </div>
                    </div>
                </aside>



            </div>
        </div>



        <p>
            <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#demoCollapse">
                Afficher / Cacher
            </button>
        </p>



    </div>
