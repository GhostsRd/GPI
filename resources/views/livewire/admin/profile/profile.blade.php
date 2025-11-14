<div>
    <div class="container shadow-sm rounded-2 bg-white">
        <div>
            <div class="row">
                <div class="col-lg-2 ">
                    @if (!empty($utilisateurs->photo))
                      <img width="100" class="mt-2 shadow-sm   rounded-pill" src="{{ asset('storage/'.$utilisateurs->photo) }}"
                        alt="Photo de profil">
                    @else
                    <img width="100" class="mt-2 shadow-sm   rounded-pill" src="{{ asset('images/avtar_1.png') }}"
                        alt="Photo de profil">
                    @endif

                </div>
                <div class="col-lg-7 ">
                    <h2 class="fw-bold mt-5"> {{ $utilisateurs->nom }}</h2>
                    <p class="border-start border-warning border-3  "><small class="mx-2">
                            {{ $utilisateurs->poste }}</small> </p>
                </div>
            </div>

            <div class="row  mt-4 mb-4">
                <div class="col-lg-2 text-center  col-3">

                    <div class="border bg-success-light shadow-sm py-1 rounded-2 " aria-label="Ouvrir le chat"
                        id="chatToggle">
                        <i class="bi bi-chat-dots me-2  "></i> Message
                    </div>
                </div>

                <div class="col-lg-2  col-3 text-left">
                   
                    <li class="nav-item dropdown" style="list-style: none">
                        <a  class="dropdown-toggle dropdown-item shadow-sm py-1 rounded-3 fw-6 text-center justify-content-center" href="#" id="downloadDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                          
                            <span >Plus</span>                      
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#ajouterequipement" class="dropdown-item" target="_blank">
                                    Lier equipement
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" wire:click="declaration_perte" target="_blank"
                              >
                                    Déclaration de perte
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>



            </div>

        </div>

        <div class="mt-4   p-0">
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item " role="presentation">
                    <button class="nav-link text-dark active" id="active-tab" data-bs-toggle="tab"
                        data-bs-target="#active" type="button" role="tab" aria-controls="active"
                        aria-selected="true">
                        A propos
                    </button>
                </li>
                <li class="nav-item " role="presentation">
                    <button class="nav-link text-dark" id="link1-tab" data-bs-toggle="tab" data-bs-target="#link1"
                        type="button" role="tab" aria-controls="link1" aria-selected="false">
                        Equipement
                    </button>
                </li>
                <li class="nav-item " role="presentation">
                    <button class="nav-link text-dark" id="link3-tab" data-bs-toggle="tab" data-bs-target="#link3"
                        type="button" role="tab" aria-controls="link3" aria-selected="false">
                        Ticket
                    </button>
                </li>
                <li class="nav-item " role="presentation">
                    <button class="nav-link text-dark" id="link2-tab" data-bs-toggle="tab" data-bs-target="#link2"
                        type="button" role="tab" aria-controls="link2" aria-selected="false">
                        Check In/out
                    </button>
                </li>


                <li class="nav-item " role="presentation">
                    <button class="nav-link text-dark" id="link4-tab" data-bs-toggle="tab" data-bs-target="#link4"
                        type="button" role="tab" aria-controls="link2" aria-selected="false">
                        Reservation d'equipement
                    </button>
                </li>
                <li class="nav-item " role="presentation">
                    <button class="nav-link text-dark" id="link5-tab" data-bs-toggle="tab" data-bs-target="#link5"
                        type="button" role="tab" aria-controls="link2" aria-selected="false">
                        Incident
                    </button>
                </li>
            </ul>

            <div class="tab-content border-0 p-3 border border-top-0" id="myTabContent">
                <div class="tab-pane fade show active " id="active" role="tabpanel" aria-labelledby="active-tab">
                    <h5>Contact</h5>
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
                    <h5 class="fw-bold">Historique de checkout</h5>
                    @foreach ($checkouts as $checkout)
                        <a href="#" data-aos="fade-down" data-aos-duration="400"
                            data-aos-delay="{{ $loop->index * 200 }}"
                            wire:click="visualiserCheckout({{ $checkout->id }})"
                            class="list-group-item border-bottom list-group-item-action ">

                            <div class="d-flex w-100 justify-content-between">
                                <b class="mb-1 text-black-50">
                                    {{ $checkout->materiel_type }}
                                </b>
                                <small class="text-body-secondary">
                                    {{ \Carbon\Carbon::parse($checkout->created_at)->translatedFormat('d M Y H:i') }}
                                </small>
                            </div>

                            <div class="d-flex w-100 mt-2 justify-content-between">
                                <p class="mb-1 text-capitalize">
                                    {{ $checkout->materiel_details }}</p>
                                {{-- <small class=" px-2 m-0 fw-bold rounded-pill border {{ $checkout->statut == 'En cours' ? 'text-warning' : 'text-danger' }}">
                                                        {{ $checkout->statut == 1 ? 'En cours' : ( $checkout->statut == 2 ? 'Valider' : 'Fermer' )}}
                                                    </small> --}}
                                <div class="d-flex justify-content-end">
                                    <small
                                        class="text-muted mx-2">{{ $checkout->statut == 1 ? 'En cours' : ($checkout->statut == 2 ? 'Valider' : 'Fermer') }}</small>
                                    <img class="dropdown-toggle  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ $checkout->utilisateur->nom }}"
                                        alt="Profil" width="20" height="20" class="rounded-circle me-2">
                                </div>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="tab-pane fade border-0 " id="link3" role="tabpanel" aria-labelledby="link3-tab">
                    <h5 class="fw-bold">Listes des tickets</h5>
                    @foreach ($tickets as $ticket)
                        <a wire:click="visualiserTicket('{{ $ticket->id }}')" href="#" {{-- data-aos="fade-down" --}}
                            {{-- data-aos-duration="400" data-aos-delay="{{ $loop->index * 200 }}" --}}
                            class="list-group-item py-1 list-group-item-action border-0 border-bottom">
                            <div class="d-flex w-100 py-1 justify-content-between">
                                <b class="mb-1 text-black-50 text-capitalize"> {{ $ticket->sujet }}</b>
                                <small
                                    class="text-body-secondary">{{ \Carbon\Carbon::parse($ticket->created_at)->translatedFormat('d M Y H:i') }}</small>
                            </div>

                            <div class="d-flex w-100 py-1 justify-content-between">
                                <p class="mb-1 text-capitalize mx-3">{{ $ticket->details }}</p>
                                <small class="text-body-secondary border-0 border-top-generic px-2  rounded-pill">
                                    {{ $ticket->state == 2 ?? 'Assigner' }}
                                </small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                                <small class="text-body-secondary mx-3">
                                    <svg width="12" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6 text-success">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                    </svg>

                                    {{ $ticket->equipement }}</small>
                                <small class="text-body-secondary  ">
                                    <img class="dropdown-toggle  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}"
                                        alt="Profil" width="20" height="20" class="rounded-circle me-2">
                                    <img class="dropdown-toggle  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ $ticket->responsable->name ?? 'none' }}"
                                        alt="Profil" width="20" height="20" class="rounded-circle me-2">

                                </small>
                            </div>

                            {{-- <small class="text-body-secondary">And some muted small print.</small> --}}
                        </a>
                    @endforeach
                </div>

                <div class="tab-pane fade border-0 " id="link4" role="tabpanel" aria-labelledby="link4-tab">
                    <h5>List de reservation d'equipement</h5>

                    <div>
                        <div class="list-group mt-2 " style="max-height: 400px;overflow-y: scroll">
                            @foreach ($matreservations as $materiel)
                                <a href="#" wire:click="Visualiser({{ $materiel->id }})"
                                    title="Voir le details"
                                    class="list-group-item list-group-item-action border-0 border-bottom ">
                                    <div class="d-flex w-100 justify-content-between">
                                        <b class="mb-1 text-black-50 text-capitalize">
                                            {{ $materiel->equipement_type }} </b>
                                        <small
                                            class="text-muted fw-6">{{ \Carbon\Carbon::parse($materiel->date_debut)->translatedFormat('d M Y ') }}
                                            -
                                            {{ \Carbon\Carbon::parse($materiel->date_fin)->translatedFormat('d M Y ') }}</small>
                                        <small class="text-body-secondary"></small>
                                    </div>

                                    <div class="d-flex w-100 justify-content-between">
                                        <p class="mb-1 text-capitalize"> </p>
                                        <small
                                            class="text-body-secondary border-0 border-top-generic px-2  rounded-pill">
                                        </small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <small class="text-body-secondary">
                                            {{ \Carbon\Carbon::parse($materiel->created_at)->translatedFormat('d M Y H:i') }}
                                        </small>
                                        <small class="text-body-secondary justify-content-end  badge">
                                            {{ match ($materiel->statut) {
                                                1 => 'CREE',
                                                2 => 'VALIDER',
                                                3 => 'EN COURS',
                                                4 => 'RENDU',
                                                5 => 'ARCHIVER',
                                                default => 'CREE',
                                            } }}
                                            {{--                                                   
                                                        <button type="button"
                                                            wire:click="openCalendrier('materiel',{{ $materiel->id }})"
                                                            class="btn btn-sm border-0 btn-light"
                                                            data-bs-toggle="modal" data-bs-target="#calendarModal">
                                                            📅 Voir le disponibite
                                                        </button> --}}

                                        </small>
                                    </div>

                                    {{-- <small class="text-body-secondary">And some muted small print.</small> --}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade border-0 " id="link5" role="tabpanel" aria-labelledby="link5-tab">
                    <h5>List d'incident</h5>

                    <div class="list-group "
                        style="max-height:400px;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">


                        @foreach ($incidents as $incident)
                            <a wire:click="visualiserIncidentView('{{ $incident->id }}')" href="#"
                                {{-- data-aos="fade-down" --}} data-bs-toggle="modal" data-bs-target="#ajouterequipement"
                                {{-- data-aos-duration="400" data-aos-delay="{{ $loop->index * 200 }}" --}}
                                class="list-group-item border-bottom  list-group-item-action border-0 border-bottom">
                                <div class="d-flex w-100 py-1 justify-content-between">
                                    <b class="mb-1 text-black-50">{{ $incident->id }} -
                                        {{ $incident->incident_sujet }}


                                    </b>
                                    <small class="d-flex justify-content-center">
                                        @if ($incident->equipement_type == 'Ordinateur')
                                            {{ $incident->ordinateur->nom }} {{ $incident->ordinateur->os_version }}
                                        @elseif($incident->equipement_type == 'Telephone')
                                            {{ $incident->telephone->nom }} {{ $incident->telephone->marque }}
                                        @endif
                                    </small>
                                    <small
                                        class="text-body-secondary">{{ \Carbon\Carbon::parse($incident->created_at)->translatedFormat('d M Y H:i') }}</small>
                                </div>

                                <div class="d-flex w-100 py-1 justify-content-between">
                                    <p class="mb-1 text-capitalize mx-3">{{ $incident->incident_description }}</p>
                                    <small class="text-body-secondary border-0 border-top-generic px-2  rounded-pill">

                                    </small>
                                    <small
                                        class=" {{ $incident->statut == 0 ? 'text-danger' : 'text-body-secondary' }}  rounded-pill">
                                        {{ $incident->statut == 1 ? 'En cours' : ($incident->statut == 0 ? 'Annulation de la demande en cours ...' : 'En cours de traitement') }}
                                        {{-- <a href="{{ asset('storage/' . $incident->rapport_incident) }}" target="_blank" >
                                                    <i class="bi bi-download"></i> Voir ou Télécharger le rapport
                                                </a>
                                            
                                        <a href="{{ asset('storage/' . $incident->declaration_perte) }}" target="_blank" >
                                                    <i class="bi bi-download"></i> Voir ou Télécharger le rapport
                                                </a> --}}
                                    </small>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <small class="text-body-secondary mx-3">
                                        <svg width="12" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-6 text-success">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                        </svg>

                                        {{ $incident->equipement }}</small>
                                    <small class="text-body-secondary  ">
                                        {{-- <img class="dropdown-toggle  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                            src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}"
                                            alt="Profil" width="20" height="20"
                                            class="rounded-circle me-2"> --}}
                                        <img class="dropdown-toggle  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                            src="https://ui-avatars.com/api/?name={{ $incident->utilisateur->nom ?? 'none' }}"
                                            alt="Profil" width="20" height="20"
                                            class="rounded-circle me-2">
                                    </small>
                                </div>

                                {{-- <small class="text-body-secondary">And some muted small print.</small> --}}
                            </a>
                        @endforeach

                        <div class="mt-4 d-flex justify-content-center">
                            {{-- {{ $incidents->links() }} --}}

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="ajouterequipement" style="z-index: 3000 !important" tabindex="-1"
        aria-labelledby="ajouterequipementLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="">

                <div class=" border-bottom">
                    <h5 class="modal-title mx-2 my-2 text-dark fw-bold" id="incidentModalLabel">Nouveau incident</h5>

                </div>

                <!-- Formulaire Livewire -->
                <form wire:submit.prevent="store">
                    <div class="modal-body row">
                        <!-- Sujet -->
                        <p class="text-muted mb-3 mt-3">Les champs indiqués <span class="text-danger">*</span> sont
                            obligatoires</p>

                        <div class="mb-3 col-lg-8">
                            <label for="sujet" class="form-label fw-bold text-muted ">Sujet <span
                                    class="text-danger ">*</span></label> <br>
                            <textarea type="text" placeholder="Ex: J'ai perdu mon telephone .."
                                class=" input-recherche py-1  border col-lg-8  px-2 text-dark rounded-2  @error('sujet') is-invalid border-danger  @enderror"
                                id="sujet" wire:model.debounce.500ms="incident_sujet">

                    </textarea>
                            @error('sujet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Détails -->
                        <div class="mb-3 col-lg-8">
                            <label for="details" class="form-label fw-bold text-muted">Description <span
                                    class="text-danger">*</span></label> <br>
                            <textarea type="text" placeholder="Ex: On m'a vole mon telephone"
                                class="input-recherche border col-lg-8 rounded-2  py-3 px-2  text-dark  @error('details') is-invalid border-danger @enderror"
                                id="details" wire:model.debounce.500ms="incident_description" rows="2"></textarea>
                            @error('details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="border-top border-2 mb-4">
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="nature" class="form-label fw-bold text-muted mb-2">Nature d'incident <span
                                    class="text-danger">*</span></label>
                            <div class="position-relative">
                                <i
                                    class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <select id="categorie"
                                    class="input-recherche py-2 px-1 form-select-sm ps-5 text-muted border @error('impact') is-invalid @enderror"
                                    wire:model="incident_nature">
                                    <option value="" class="text-left"> Sélectionner le nature</option>

                                    <option value="Vol">Vol</option>
                                    <option value="Perte">Perte</option>
                                    <option value="Panne">Panne</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            @error('nature')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="equipement_type" class="form-label fw-bold text-muted">Équipement <span
                                    class="text-danger">*</span></label>
                            <div class="position-relative">
                                <i
                                    class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <select id="equipement_type"
                                    class="input-recherche py-2 px-1 form-select-sm ps-5 text-muted border"
                                    wire:model="equipement_type">
                                    <option value="">Sélectionner l'equipement</option>
                                    <option value="Ordinateur">Ordinateur</option>
                                    <option value="Telephone">Téléphone</option>
                                    <option value="Peripherique">Périphérique</option>
                                    <option value="Moniteur">Moniteur</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 col-lg-6 ">
                            <label for="categorie" class="form-label fw-bold text-muted">Rapport d'incident <span
                                    class="text-danger">*</span></label>


                            <input type="file" wire:model="rapport_incident"
                                class="form-control  @error('rapport_incident') is-invalid @enderror">
                            @error('rapport_incident')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div wire:loading wire:target="rapport_incident">Telechargement...</div>


                        </div>

                        <div class="mb-3 col-lg-6 ">
                            <label for="categorie" class="form-label fw-bold text-muted">Declaration de perte <span
                                    class="text-success">( Optionnel )</span></label>
                            <input type="file" wire:model="declaration_perte" class="form-control">
                        </div>



                    </div>

                    <!-- Footer -->
                    <div class="modal-footer border-top py-2">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Fermer</button>

                    </div>

            </div>
        </div>
    </div>




    <aside wire:ignore.self class="chat-popup" id="chatPopup"  role="dialog" aria-modal="false"
        aria-label="Fenêtre de chat">
        <header class="chat-header">
            <div> <img width="50" class="mt-2 shadow-sm   rounded-pill" src="{{ asset('/images/avtar_1.png') }}"
                    alt="Photo de profil">
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
                        {{ $chat->created_at }}</small></div>

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
        .modal-content {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
        backdrop-filter: blur(0px) ;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        }

        .modal-backdrop.show {
            background-color: rgba(0, 0, 0, 0.2) !important;
            /* 0.2 = plus clair */
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
            if (soundEnabled) audio.play().catch(() => {});
        });
    </script>
