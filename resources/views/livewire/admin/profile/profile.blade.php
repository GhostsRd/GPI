<div class="container-fluid py-4" style="min-height: 100vh; background: transparent; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="container shadow-lg rounded-4 bg-white bg-opacity-75" style="backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.3);">
        <div>
            <!-- En-tête avec photo de profil corrigée -->
            <div class="row align-items-center g-4">
                <div class="col-lg-auto text-center">
                    @if (!empty($utilisateurs->photo) && file_exists(public_path('storage/' . $utilisateurs->photo)))
                        <img width="140" height="140" class="mt-2 shadow-md rounded-circle object-fit-cover border border-4 border-info"
                            src="{{ asset('storage/' . $utilisateurs->photo) }}" 
                            alt="Photo de {{ $utilisateurs->nom }}"
                            style="object-fit: cover;">
                    @else
                        <div class="position-relative d-inline-block">
                            <img width="140" height="140" class="mt-2 shadow-md rounded-circle bg-light border border-4 border-info-subtle"
                                src="https://ui-avatars.com/api/?name={{ urlencode($utilisateurs->nom) }}&size=140&background=4fbbb2&color=fff&bold=true&length=2" 
                                alt="Avatar de {{ $utilisateurs->nom }}">
                            <span class="position-absolute bottom-0 end-0 bg-info rounded-circle p-2 border border-3 border-white" style="width: 20px; height: 20px;"></span>
                        </div>
                    @endif
                </div>
                <div class="col-lg">
                    <h1 class="fw-800 mt-2 mb-1" style="letter-spacing: -0.02em; color: #1e293b;">{{ $utilisateurs->nom }}</h1>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">
                            <i class="bi bi-briefcase me-1"></i> {{ $utilisateurs->poste ?? 'Poste non défini' }}
                        </span>
                        <span class="text-muted small">
                            <i class="bi bi-geo-alt me-1"></i> Ranomafana
                        </span>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="row mt-4 mb-4">
                <div class="col-lg-2 text-center col-3">
                    <button class="btn btn-secondary text-white rounded-4 shadow-sm w-100 py-2 fw-600 transition-all hover-scale" aria-label="Ouvrir le chat"
                        id="chatToggle">
                        <i class="bi bi-chat-dots me-2"></i> Message
                    </button>
                </div>

                <div class="col-lg-2 col-3 text-left">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary rounded-4 shadow-sm w-100 py-2 fw-600 dropdown-toggle"
                            type="button" id="downloadDropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Plus
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#ajouterequipement" class="dropdown-item"
                                    target="_blank">
                                    Lier equipement
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" wire:click="declaration_perte" target="_blank">
                                    Déclaration de perte
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglets de navigation -->
        <div class="mt-4 p-0">
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark active px-4 py-3 border-0 transition-all" id="active-tab" data-bs-toggle="tab"
                        data-bs-target="#active" type="button" role="tab" aria-controls="active"
                        aria-selected="true" style="font-weight: 600; border-bottom: 3px solid transparent !important;">
                        À propos
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark" id="link1-tab" data-bs-toggle="tab" data-bs-target="#link1"
                        type="button" role="tab" aria-controls="link1" aria-selected="false">
                        Equipement
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark" id="link3-tab" data-bs-toggle="tab" data-bs-target="#link3"
                        type="button" role="tab" aria-controls="link3" aria-selected="false">
                        Ticket
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark" id="link2-tab" data-bs-toggle="tab" data-bs-target="#link2"
                        type="button" role="tab" aria-controls="link2" aria-selected="false">
                        Check In/out
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark" id="link4-tab" data-bs-toggle="tab" data-bs-target="#link4"
                        type="button" role="tab" aria-controls="link2" aria-selected="false">
                        Reservation d'equipement
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark" id="link5-tab" data-bs-toggle="tab" data-bs-target="#link5"
                        type="button" role="tab" aria-controls="link2" aria-selected="false">
                        Incident
                    </button>
                </li>
            </ul>

            <div class="tab-content border-0 p-3 border border-top-0" id="myTabContent">
                <!-- Onglet A propos -->
                <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                    <h5>Contact</h5>
                    <hr>

                    <p class="mb-3">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <strong>Lieu :</strong> Ranomafana
                    </p>

                    <p class="mb-3">
                        <i class="bi bi-envelope-fill me-2"></i>
                        <strong>Email :</strong> {{ $utilisateurs->email }}
                    </p>

                    <p class="mb-3">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <strong>Téléphone :</strong> +261 34 12 345 67
                    </p>
                </div>

                <!-- Onglet Equipement - Version Tableau -->
                <div class="tab-pane fade border-0" id="link1" role="tabpanel" aria-labelledby="link1-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold">Équipements liés à {{ $utilisateurs->nom }}</h5>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterequipement">
                            <i class="bi bi-plus-circle me-1"></i> Lier un équipement
                        </button>
                    </div>
                    
                    @if($equipements_lies->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-box-seam" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Aucun équipement lié à cet utilisateur</p>
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ajouterequipement">
                                <i class="bi bi-plus-circle"></i> Lier votre premier équipement
                            </button>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Équipement</th>
                                        <th>Type</th>
                                        <th>Détails</th>
                                        <th>Date d'attribution</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($equipements_lies as $liaison)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $icone = 'bi-box';
                                                        $couleur = 'text-secondary';
                                                        $nomEquip = 'Équipement';
                                                        
                                                        if($liaison->type == 'ordinateur') {
                                                            $icone = 'bi-laptop';
                                                            $couleur = 'text-primary';
                                                            $nomEquip = $liaison->ordinateur->nom ?? 'Ordinateur';
                                                        } elseif($liaison->type == 'telephone') {
                                                            $icone = 'bi-phone';
                                                            $couleur = 'text-success';
                                                            $nomEquip = $liaison->telephone->nom ?? 'Téléphone';
                                                        } elseif($liaison->type == 'flotte') {
                                                            $icone = 'bi-truck';
                                                            $couleur = 'text-warning';
                                                            $nomEquip = $liaison->flotte->nom ?? 'Véhicule';
                                                        } elseif($liaison->type == 'sim_card') {
                                                            $icone = 'bi-sim';
                                                            $couleur = 'text-info';
                                                            $nomEquip = $liaison->sim_card->phone_number ?? 'Carte SIM';
                                                        } elseif($liaison->type == 'imprimante') {
                                                            $icone = 'bi-printer';
                                                            $couleur = 'text-info';
                                                            $nomEquip = $liaison->imprimante->nom ?? 'Imprimante';
                                                        } elseif($liaison->type == 'moniteur') {
                                                            $icone = 'bi-display';
                                                            $couleur = 'text-dark';
                                                            $nomEquip = $liaison->moniteur->nom ?? 'Moniteur';
                                                        } elseif($liaison->type == 'peripherique') {
                                                            $icone = 'bi-keyboard';
                                                            $couleur = 'text-secondary';
                                                            $nomEquip = $liaison->peripherique->nom ?? 'Périphérique';
                                                        }
                                                    @endphp
                                                    <i class="bi {{ $icone }} {{ $couleur }} fs-4 me-3"></i>
                                                    <span class="fw-bold">{{ $nomEquip }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    @if($liaison->type == 'ordinateur')
                                                        Ordinateur
                                                    @elseif($liaison->type == 'telephone')
                                                        Téléphone
                                                    @elseif($liaison->type == 'flotte')
                                                        Flotte
                                                    @elseif($liaison->type == 'sim_card')
                                                        Carte SIM
                                                    @elseif($liaison->type == 'imprimante')
                                                        Imprimante
                                                    @elseif($liaison->type == 'moniteur')
                                                        Moniteur
                                                    @elseif($liaison->type == 'peripherique')
                                                        Périphérique
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if($liaison->type == 'ordinateur' && $liaison->ordinateur)
                                                    <small class="text-muted">
                                                        {{ $liaison->ordinateur->fabricant ?? '' }}
                                                        @if($liaison->ordinateur->os_version)
                                                            - {{ $liaison->ordinateur->os_version }}
                                                        @endif
                                                    </small>
                                                @elseif($liaison->type == 'telephone' && $liaison->telephone)
                                                    <small class="text-muted">
                                                        {{ $liaison->telephone->marque ?? '' }}
                                                        @if($liaison->telephone->modele)
                                                            - {{ $liaison->telephone->modele }}
                                                        @endif
                                                    </small>
                                                @elseif($liaison->type == 'flotte' && $liaison->flotte)
                                                    <small class="text-muted">
                                                        {{ $liaison->flotte->immatriculation ?? 'Sans immatriculation' }}
                                                    </small>
                                                @elseif($liaison->type == 'sim_card' && $liaison->sim_card)
                                                    <small class="text-muted">
                                                        {{ $liaison->sim_card->operator ?? '' }} - {{ $liaison->sim_card->iccid ?? '' }}
                                                    </small>
                                                @elseif($liaison->type == 'imprimante' && $liaison->imprimante)
                                                    <small class="text-muted">
                                                        {{ $liaison->imprimante->fabricant ?? '' }}
                                                        @if($liaison->imprimante->modele)
                                                            - {{ $liaison->imprimante->modele }}
                                                        @endif
                                                    </small>
                                                @elseif($liaison->type == 'moniteur' && $liaison->moniteur)
                                                    <small class="text-muted">
                                                        {{ $liaison->moniteur->fabricant ?? '' }}
                                                        @if($liaison->moniteur->modele)
                                                            - {{ $liaison->moniteur->modele }}
                                                        @endif
                                                    </small>
                                                @elseif($liaison->type == 'peripherique' && $liaison->peripherique)
                                                    <small class="text-muted">
                                                        {{ $liaison->peripherique->fabricant ?? '' }}
                                                        @if($liaison->peripherique->type)
                                                            - {{ $liaison->peripherique->type }}
                                                        @endif
                                                    </small>
                                                @endif
                                                @if($liaison->notes)
                                                    <br><small class="text-muted"><i class="bi bi-chat-dots me-1"></i>{{ $liaison->notes }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <i class="bi bi-calendar3 me-1 text-primary"></i>
                                                {{ \Carbon\Carbon::parse($liaison->date_attribution)->format('d/m/Y') }}
                                                @if($liaison->date_retour_prevue)
                                                    <br><small class="text-muted">Retour prévu: {{ \Carbon\Carbon::parse($liaison->date_retour_prevue)->format('d/m/Y') }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($liaison->statut == 'actif')
                                                    <span class="badge bg-success bg-opacity-10 text-success border-success border-opacity-25">Actif</span>
                                                @elseif($liaison->statut == 'inactif')
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border-secondary border-opacity-25">Inactif</span>
                                                @elseif($liaison->statut == 'reserve')
                                                    <span class="badge bg-warning bg-opacity-10 text-warning border-warning border-opacity-25">Réservé</span>
                                                @else
                                                    <span class="badge bg-info bg-opacity-10 text-info border-info border-opacity-25">{{ ucfirst($liaison->statut) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($liaison->statut == 'actif')
                                                <button wire:click="detacherEquipement({{ $liaison->id }})" 
                                                        wire:confirm="Êtes-vous sûr de vouloir détacher cet équipement ?"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Détacher l'équipement">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Onglet Ticket -->
                <div class="tab-pane fade border-0" id="link3" role="tabpanel" aria-labelledby="link3-tab">
                    <h5 class="fw-bold">Listes des tickets</h5>
                    @foreach ($tickets as $ticket)
                        <a wire:click="visualiserTicket('{{ $ticket->id }}')" href="#"
                            class="list-group-item py-1 list-group-item-action border-0 border-bottom">
                            <div class="d-flex w-100 py-1 justify-content-between">
                                <b class="mb-1 text-black-50 text-capitalize"> {{ $ticket->sujet }}</b>
                                <small class="text-body-secondary">{{ \Carbon\Carbon::parse($ticket->created_at)->translatedFormat('d M Y H:i') }}</small>
                            </div>

                            <div class="d-flex w-100 py-1 justify-content-between">
                                <p class="mb-1 text-capitalize mx-3">{{ $ticket->details }}</p>
                                <small class="text-body-secondary border-0 border-top-generic px-2 rounded-pill">
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
                                    {{ $ticket->equipement }}
                                </small>
                                <small class="text-body-secondary">
                                    <img class="dropdown-toggle p-0 m-0 rounded-pill" data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}"
                                        alt="Profil" width="20" height="20" class="rounded-circle me-2">
                                    <img class="dropdown-toggle p-0 m-0 rounded-pill" data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ $ticket->responsable->name ?? 'none' }}"
                                        alt="Profil" width="20" height="20" class="rounded-circle me-2">
                                </small>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Onglet Checkout -->
                <div class="tab-pane fade border-0" id="link2" role="tabpanel" aria-labelledby="link2-tab">
                    <h5 class="fw-bold">Historique de checkout</h5>
                    @foreach ($checkouts as $checkout)
                        <a href="#" data-aos="fade-down" data-aos-duration="400"
                            data-aos-delay="{{ $loop->index * 200 }}"
                            wire:click="visualiserCheckout({{ $checkout->id }})"
                            class="list-group-item border-bottom list-group-item-action">
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
                                <div class="d-flex justify-content-end">
                                    <small class="text-muted mx-2">{{ $checkout->statut == 1 ? 'En cours' : ($checkout->statut == 2 ? 'Valider' : 'Fermer') }}</small>
                                    <img class="dropdown-toggle p-0 m-0 rounded-pill" data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ $checkout->utilisateur->nom }}"
                                        alt="Profil" width="20" height="20" class="rounded-circle me-2">
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Onglet Reservation -->
                <div class="tab-pane fade border-0" id="link4" role="tabpanel" aria-labelledby="link4-tab">
                    <h5>List de reservation d'equipement</h5>
                    <div>
                        <div class="list-group mt-2" style="max-height: 400px;overflow-y: scroll">
                            @foreach ($matreservations as $materiel)
                                <a href="#" wire:click="Visualiser({{ $materiel->id }})"
                                    title="Voir le details"
                                    class="list-group-item list-group-item-action border-0 border-bottom">
                                    <div class="d-flex w-100 justify-content-between">
                                        <b class="mb-1 text-black-50 text-capitalize">
                                            {{ $materiel->equipement_type }} </b>
                                        <small class="text-muted fw-6">
                                            {{ \Carbon\Carbon::parse($materiel->date_debut)->translatedFormat('d M Y ') }} -
                                            {{ \Carbon\Carbon::parse($materiel->date_fin)->translatedFormat('d M Y ') }}
                                        </small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <small class="text-body-secondary">
                                            {{ \Carbon\Carbon::parse($materiel->created_at)->translatedFormat('d M Y H:i') }}
                                        </small>
                                        <small class="text-body-secondary justify-content-end badge">
                                            {{ match ($materiel->statut) {
                                                1 => 'CREE',
                                                2 => 'VALIDER',
                                                3 => 'EN COURS',
                                                4 => 'RENDU',
                                                5 => 'ARCHIVER',
                                                default => 'CREE',
                                            } }}
                                        </small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Onglet Incident -->
                <div class="tab-pane fade border-0" id="link5" role="tabpanel" aria-labelledby="link5-tab">
                    <h5>List d'incident</h5>
                    <div class="list-group"
                        style="max-height:400px;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
                        @foreach ($incidents as $incident)
                            <a wire:click="visualiserIncidentView('{{ $incident->id }}')" href="#"
                                class="list-group-item border-bottom list-group-item-action border-0 border-bottom">
                                <div class="d-flex w-100 py-1 justify-content-between">
                                    <b class="mb-1 text-black-50">{{ $incident->id }} - {{ $incident->incident_sujet }}</b>
                                    <small class="d-flex justify-content-center">
                                        @if ($incident->equipement_type == 'Ordinateur')
                                            {{ $incident->ordinateur->nom ?? '' }} {{ $incident->ordinateur->os_version ?? '' }}
                                        @elseif($incident->equipement_type == 'Telephone')
                                            {{ $incident->telephone->nom ?? '' }} {{ $incident->telephone->marque ?? '' }}
                                        @endif
                                    </small>
                                    <small class="text-body-secondary">{{ \Carbon\Carbon::parse($incident->created_at)->translatedFormat('d M Y H:i') }}</small>
                                </div>

                                <div class="d-flex w-100 py-1 justify-content-between">
                                    <p class="mb-1 text-capitalize mx-3">{{ $incident->incident_description }}</p>
                                    <small class="{{ $incident->statut == 0 ? 'text-danger' : 'text-body-secondary' }} rounded-pill">
                                        {{ $incident->statut == 1 ? 'En cours' : ($incident->statut == 0 ? 'Annulation de la demande en cours ...' : 'En cours de traitement') }}
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
                                        {{ $incident->equipement }}
                                    </small>
                                    <small class="text-body-secondary">
                                        <img class="dropdown-toggle p-0 m-0 rounded-pill" data-toggle="dropdown"
                                            src="https://ui-avatars.com/api/?name={{ $incident->utilisateur->nom ?? 'none' }}"
                                            alt="Profil" width="20" height="20" class="rounded-circle me-2">
                                    </small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour lier un équipement -->
    <div wire:ignore.self class="modal fade" id="ajouterequipement" style="z-index: 3000 !important" tabindex="-1"
        aria-labelledby="ajouterequipementLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="border-bottom">
                    <h5 class="modal-title mx-2 my-2 text-dark fw-bold" id="ajouterequipementLabel">
                        Lier un équipement à {{ $utilisateurs->nom }}
                    </h5>
                </div>

                <form wire:submit.prevent="lierEquipement">
                    <div class="modal-body row">
                        <p class="text-muted mb-3 mt-1">Les champs indiqués <span class="text-danger">*</span> sont obligatoires</p>

                        <!-- Liste des équipements à lier -->
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-bold text-muted d-flex justify-content-between">
                                <span>Équipements à lier</span>
                                <button type="button" wire:click="ajouterLigne" class="btn btn-sm btn-outline-success py-0">
                                    <i class="bi bi-plus-circle me-1"></i>Ajouter une ligne
                                </button>
                            </label>

                            @foreach($items_a_lier as $index => $item)
                            <div class="card mb-2 border shadow-sm">
                                <div class="card-body p-2">
                                    <div class="row g-2 align-items-center">
                                        <!-- Type d'équipement -->
                                        <div class="col-md-5">
                                            <select wire:model="items_a_lier.{{ $index }}.type" class="form-select form-select-sm @error('items_a_lier.'.$index.'.type') is-invalid @enderror">
                                                <option value="">Sélectionner un type</option>
                                                <option value="ordinateur">💻 Ordinateur</option>
                                                <option value="telephone">📱 Téléphone</option>
                                                <option value="flotte">🚗 Flotte</option>
                                                <option value="sim_card">📲 Carte SIM</option>
                                                <option value="imprimante">🖨️ Imprimante</option>
                                                <option value="moniteur">🖥️ Moniteur</option>
                                                <option value="peripherique">⌨️ Périphérique</option>
                                            </select>
                                        </div>

                                        <!-- Sélection de l'équipement -->
                                      <!-- Sélection de l'équipement -->
<div class="col-md-6">
    <select wire:model="items_a_lier.{{ $index }}.id" 
            class="form-select form-select-sm @error('items_a_lier.'.$index.'.id') is-invalid @enderror" 
            {{ empty($item['type'] ?? null) ? 'disabled' : '' }}>
        <option value="">Sélectionner un équipement</option>
        
        @if(!empty($item['type'] ?? null))
            @if($item['type'] == 'ordinateur')
                @foreach($ordinateurs as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }} - {{ $equip->fabricant ?? '' }}</option>
                @endforeach
            @elseif($item['type'] == 'telephone')
                @foreach($telephones as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }} - {{ $equip->marque ?? '' }}</option>
                @endforeach
            @elseif($item['type'] == 'flotte')
                @foreach($flottes as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom ?? 'Véhicule' }} - {{ $equip->immatriculation ?? '' }}</option>
                @endforeach
            @elseif($item['type'] == 'imprimante')
                @foreach($imprimantes as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }} - {{ $equip->fabricant ?? '' }}</option>
                @endforeach
            @elseif($item['type'] == 'moniteur')
                @foreach($moniteurs as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }} - {{ $equip->fabricant ?? '' }}</option>
                @endforeach
            @elseif($item['type'] == 'peripherique')
                @foreach($peripheriques as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }} - {{ $equip->type ?? '' }}</option>
                @endforeach
            @endif
        @endif
    </select>
</div>

                                        <!-- Bouton supprimer -->
                                        <div class="col-md-1 text-end">
                                            @if(count($items_a_lier) > 1)
                                            <button type="button" wire:click="supprimerLigne({{ $index }})" class="btn btn-sm btn-outline-danger border-0">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            @endif
                                        </div>
                                        
                                        @error('items_a_lier.'.$index.'.type') <div class="col-12 text-danger small px-2">{{ $message }}</div> @enderror
                                        @error('items_a_lier.'.$index.'.id') <div class="col-12 text-danger small px-2">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Date d'attribution -->
                        <div class="mb-3 col-lg-6">
                            <label class="form-label fw-bold text-muted">Date d'attribution <span class="text-danger">*</span></label>
                            <input type="date" wire:model="date_attribution" class="form-control @error('date_attribution') is-invalid @enderror">
                            @error('date_attribution') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date de retour prévue -->
                        <div class="mb-3 col-lg-6">
                            <label class="form-label fw-bold text-muted">Date de retour prévue (optionnel)</label>
                            <input type="date" wire:model="date_retour_prevue" class="form-control">
                        </div>

                        <!-- Description -->
                        <div class="mb-3 col-lg-12">
                            <label class="form-label fw-bold text-muted">Notes (optionnel)</label>
                            <textarea wire:model="description_liaison" class="form-control" rows="2" placeholder="Ex: Matériel principal, équipement de test, etc."></textarea>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer border-top-0 py-3 px-4 bg-light bg-opacity-50">
                        <button type="button" class="btn btn-link text-muted fw-600 text-decoration-none" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success px-5 rounded-3 fw-600 shadow-sm">Lier l'équipement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Chat Popup -->
    <aside wire:ignore.self class="chat-popup" id="chatPopup" role="dialog" aria-modal="false"
        aria-label="Fenêtre de chat">
        <header class="chat-header">
            <div> 
                @if (!empty($utilisateurs->photo) && file_exists(public_path('storage/' . $utilisateurs->photo)))
                    <img width="50" height="50" class="shadow-sm rounded-circle object-fit-cover"
                        src="{{ asset('storage/' . $utilisateurs->photo) }}" 
                        alt="Photo de {{ $utilisateurs->nom }}">
                @else
                    <img width="50" height="50" class="shadow-sm rounded-circle"
                        src="https://ui-avatars.com/api/?name={{ urlencode($utilisateurs->nom) }}&size=50&background=0D6EFD&color=fff" 
                        alt="Avatar de {{ $utilisateurs->nom }}">
                @endif
            </div>
            <div class="chat-title">
                <h4>{{ $utilisateurs->nom }}</h4>
                <p>{{ $utilisateurs->poste }}</p>
            </div>
            <button class="chat-close" id="chatClose" aria-label="Fermer">✕</button>
        </header>

        <div class="chat-messages" id="messages" aria-live="polite">
            @foreach ($Chats as $chat)
                <div class="msg {{ $chat->type == 'user' ? 'user' : 'agent' }}">
                    {{ $chat->message }}
                    <small>{{ $chat->type == 'user' ? 'Vous' : $utilisateurs->nom }} · {{ $chat->created_at->format('H:i') }}</small>
                </div>
            @endforeach
        </div>

        <form wire:submit.prevent="EnvoyerMessage" class="p-2">
            <textarea id="input" wire:model="message" class="chat-input" rows="1" placeholder="Écris un message..."></textarea>
            <button id="sendBtn" type="submit" class="btn border-0 btn-primary btn-sm">Envoyer</button>
        </form>
    </aside>

    <style>
        :root {
            --primary: #4fbbb2;
            --primary-light: #76cfc8;
            --primary-dark: #3a8c85;
            --secondary: #f1705a;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #4fbbb2;
            --dark: #1e293b;
            --light: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --border: #e2e8f0;
            --shadow-sm: 0 10px 25px -5px rgba(15, 23, 42, 0.08);
            --shadow-md: 0 20px 27px -8px rgba(15, 23, 42, 0.12);
            --shadow-lg: 0 30px 45px -12px rgba(79, 187, 178, 0.2);
            --gradient-primary: linear-gradient(135deg, #4fbbb2, #f1705a);
        }

        /* Reset minimal */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html, body {
            height: 100%
        }

        body {
            font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background: #f3f4f6
        }

        .modal-content {
            border-radius: 24px !important;
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important;
            overflow: hidden;
            backdrop-filter: blur(20px);
        }

        .modal-header {
            background: rgba(79, 187, 178, 0.03);
            border-bottom: 1px solid rgba(79, 187, 178, 0.08);
            padding: 1.5rem;
        }

        .nav-tabs .nav-link.active {
            color: #4fbbb2 !important;
            border-bottom: 3px solid #4fbbb2 !important;
            background: transparent !important;
        }

        .nav-tabs .nav-link:hover:not(.active) {
            color: #3a8c85 !important;
            border-bottom: 3px solid rgba(79, 187, 178, 0.2) !important;
        }

        .hover-scale {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-scale:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 187, 178, 0.2) !important;
        }

        .fw-800 { font-weight: 800; }
        .fw-700 { font-weight: 700; }
        .fw-600 { font-weight: 600; }

        .modal-backdrop.show {
            background-color: rgba(0, 0, 0, 0.2) !important;
        }

        /* Object fit cover pour les images */
        .object-fit-cover {
            object-fit: cover;
        }
        
        /* Style du tableau */
        .table td, .table th {
            vertical-align: middle;
        }
        
        .badge {
            font-weight: 500;
            padding: 0.4rem 0.6rem;
        }
        
        .btn-outline-danger {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
        
        /* Pour la photo de profil */
        .rounded-circle {
            border-radius: 50% !important;
        }
        
        .border-3 {
            border-width: 3px !important;
        }

        /* Chat styles */
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

        .chat-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-bottom: 1px solid #eef2f7;
            background: linear-gradient(90deg, #f8fafc, #fff)
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

        .chat-input {
            flex: 1;
            background: #f8fafc;
            border: 1px solid #e6eef9;
            padding: 10px 12px;
            border-radius: 10px;
            min-height: 40px;
            resize: none
        }

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
        // Chat functionality
        const toggle = document.getElementById('chatToggle');
        const popup = document.getElementById('chatPopup');
        const closeBtn = document.getElementById('chatClose');
        const messages = document.getElementById('messages');
        const input = document.getElementById('input');
        const sendBtn = document.getElementById('sendBtn');

        function openChat() {
            popup.classList.add('open');
            toggle.style.display = 'none';
            if(input) input.focus();
            scrollToBottom()
        }

        function closeChat() {
            popup.classList.remove('open');
            toggle.style.display = 'flex'
        }

        if(toggle) toggle.addEventListener('click', openChat);
        if(closeBtn) closeBtn.addEventListener('click', closeChat);

        function scrollToBottom() {
            if(messages) messages.scrollTop = messages.scrollHeight
        }

        if(input) {
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    if(sendBtn) sendBtn.click();
                }
            });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && popup && popup.classList.contains('open')) closeChat();
        });

        // Modal events
        window.addEventListener('close-modal', event => {
            $('#ajouterequipement').modal('hide');
        });

        window.addEventListener('notify', event => {
            alert(event.detail.message);
        });

        window.addEventListener('notify-error', event => {
            alert('Erreur: ' + event.detail.message);
        });
    </script>
</div>