<div class="container-fluid py-4"
    style="min-height: 100vh; background: transparent; font-family: 'Plus Jakarta Sans', sans-serif;">
   <div class="container shadow-lg rounded-4 bg-white bg-opacity-75 p-4 p-md-5"
     style="backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.3);">
    
    <div class="row align-items-center g-4">
        <div class="col-md-auto text-center">
            @if (!empty($utilisateurs->photo) && file_exists(public_path('storage/' . $utilisateurs->photo)))
                <img width="140" height="140"
                     class="shadow rounded-circle object-fit-cover border border-4 border-info"
                     src="{{ asset('storage/' . $utilisateurs->photo) }}" 
                     alt="Photo de {{ $utilisateurs->nom }}">
            @else
                <div class="position-relative d-inline-block">
                    <img width="140" height="140"
                         class="shadow rounded-circle bg-light border border-4 border-info-subtle object-fit-cover"
                         src="https://ui-avatars.com/api/?name={{ urlencode($utilisateurs->nom) }}&size=140&background=4fbbb2&color=fff&bold=true&length=2"
                         alt="Avatar de {{ $utilisateurs->nom }}">
                    <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-3 border-white"
                          style="width: 22px; height: 22px;" title="En ligne"></span>
                </div>
            @endif
        </div>
        <div class="col-md text-center text-md-start">
            <h1 class="fw-bold h2 mb-2" style="letter-spacing: -0.02em; color: #1e293b;">{{ $utilisateurs->nom }}</h1>
            <div class="d-flex flex-wrap justify-content-center justify-content-md-start align-items-center gap-2">
                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                    <i class="bi bi-briefcase me-1"></i> {{ $utilisateurs->poste ?? 'Poste non défini' }}
                </span>
                <span class="text-muted small ms-1">
                    <i class="bi bi-geo-alt me-1"></i> Ranomafana
                </span>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2 mt-4 mb-4 justify-content-center justify-content-md-start">
        <button class="btn btn-primary rounded-pill shadow-sm px-4 py-2 fw-semibold" aria-label="Ouvrir le chat" id="chatToggle">
            <i class="bi bi-chat-dots me-2"></i> Message
        </button>

        <div class="dropdown">
            <button class="btn btn-outline-secondary rounded-pill shadow-sm px-4 py-2 fw-semibold dropdown-toggle"
                    type="button" id="downloadDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots me-1"></i> Plus d'actions
            </button>
            <ul class="dropdown-menu shadow rounded-3 border-0 mt-2" aria-labelledby="downloadDropdown">
                <li>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ajouterequipement" class="dropdown-item py-2">
                        <i class="bi bi-link-45deg me-2 text-primary"></i> Lier un équipement
                    </button>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <button type="button" class="dropdown-item py-2 text-danger" wire:click="declaration_perte">
                        <i class="bi bi-exclamation-triangle me-2"></i> Déclaration de perte
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-5">
        <ul class="nav nav-tabs nav-underline border-bottom" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark active fw-semibold pb-3" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="true">
                    À propos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-semibold pb-3" id="link1-tab" data-bs-toggle="tab" data-bs-target="#link1" type="button" role="tab" aria-controls="link1" aria-selected="false">
                    Équipements
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-semibold pb-3" id="link3-tab" data-bs-toggle="tab" data-bs-target="#link3" type="button" role="tab" aria-controls="link3" aria-selected="false">
                    Tickets
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-semibold pb-3" id="link2-tab" data-bs-toggle="tab" data-bs-target="#link2" type="button" role="tab" aria-controls="link2" aria-selected="false">
                    Check In/Out
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-semibold pb-3" id="link4-tab" data-bs-toggle="tab" data-bs-target="#link4" type="button" role="tab" aria-controls="link4" aria-selected="false">
                    Réservations
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-semibold pb-3" id="link5-tab" data-bs-toggle="tab" data-bs-target="#link5" type="button" role="tab" aria-controls="link5" aria-selected="false">
                    Incidents
                </button>
            </li>
        </ul>

        <div class="tab-content pt-4" id="myTabContent">
            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                <h5 class="fw-bold mb-3">Informations de contact</h5>
                <div class="card card-body border-0 bg-light rounded-3 p-3">
                    <p class="mb-2 d-flex align-items-center">
                        <i class="bi bi-geo-alt-fill text-muted me-3 fs-5"></i>
                        <span><strong>Lieu :</strong> Ranomafana</span>
                    </p>
                    <p class="mb-2 d-flex align-items-center">
                        <i class="bi bi-envelope-fill text-muted me-3 fs-5"></i>
                        <span><strong>Email :</strong> <a href="mailto:{{ $utilisateurs->email }}" class="text-decoration-none">{{ $utilisateurs->email }}</a></span>
                    </p>
                    <p class="mb-0 d-flex align-items-center">
                        <i class="bi bi-telephone-fill text-muted me-3 fs-5"></i>
                        <span><strong>Téléphone :</strong> +261 34 12 345 67</span>
                    </p>
                </div>
            </div>

            <div class="tab-pane fade" id="link1" role="tabpanel" aria-labelledby="link1-tab">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                    <h5 class="fw-bold mb-0">Équipements liés</h5>
                    <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#ajouterequipement">
                        <i class="bi bi-plus-circle me-1"></i> Lier un équipement
                    </button>
                </div>

                @if($equipements_lies->isEmpty())
                    <div class="text-center py-5 bg-light rounded-3 border border-dashed">
                        <i class="bi bi-box-seam text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2">Aucun équipement lié à cet utilisateur</p>
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill mt-1" data-bs-toggle="modal" data-bs-target="#ajouterequipement">
                            Lier un premier équipement
                        </button>
                    </div>
                @else
                    <div class="table-responsive rounded-3 border">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Équipement</th>
                                    <th>Type</th>
                                    <th>Détails</th>
                                    <th>Date d'attribution</th>
                                    <th>Statut</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($equipements_lies as $liaison)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @php
                                                $icone = match($liaison->type) {
                                                    'ordinateur' => 'bi-laptop text-primary',
                                                    'telephone' => 'bi-phone text-success',
                                                    'flotte' => 'bi-truck text-warning',
                                                    'sim_card' => 'bi-sim text-info',
                                                    'imprimante' => 'bi-printer text-info',
                                                    'moniteur' => 'bi-display text-dark',
                                                    default => 'bi-box text-secondary'
                                                };
                                                $nomEquip = match($liaison->type) {
                                                    'ordinateur' => $liaison->ordinateur->nom ?? 'Ordinateur',
                                                    'telephone' => $liaison->telephone->nom ?? 'Téléphone',
                                                    'flotte' => $liaison->flotte->nom ?? 'Véhicule',
                                                    'sim_card' => $liaison->sim_card->phone_number ?? 'Carte SIM',
                                                    'imprimante' => $liaison->imprimante->nom ?? 'Imprimante',
                                                    'moniteur' => $liaison->moniteur->nom ?? 'Moniteur',
                                                    default => 'Équipement'
                                                };
                                            @endphp
                                            <i class="bi {{ $icone }} fs-4 me-3"></i>
                                            <span class="fw-semibold">{{ $nomEquip }}</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">{{ ucfirst($liaison->type) }}</span></td>
                                    <td>
                                        <small class="text-muted">
                                            @if($liaison->type == 'ordinateur' && $liaison->ordinateur)
                                                {{ $liaison->ordinateur->fabricant ?? '' }} {{ $liaison->ordinateur->os_version ? '- ' . $liaison->ordinateur->os_version : '' }}
                                            @elseif($liaison->type == 'telephone' && $liaison->telephone)
                                                {{ $liaison->telephone->marque ?? '' }} {{ $liaison->telephone->modele ? '- ' . $liaison->telephone->modele : '' }}
                                            @elseif($liaison->type == 'flotte' && $liaison->flotte)
                                                {{ $liaison->flotte->immatriculation ?? 'Sans immatriculation' }}
                                            @elseif($liaison->type == 'sim_card' && $liaison->sim_card)
                                                {{ $liaison->sim_card->operator ?? '' }} - {{ $liaison->sim_card->iccid ?? '' }}
                                            @endif
                                        </small>
                                        @if($liaison->notes)
                                            <br><small class="text-muted"><i class="bi bi-chat-dots me-1"></i>{{ $liaison->notes }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small"><i class="bi bi-calendar3 me-1 text-muted"></i>{{ \Carbon\Carbon::parse($liaison->date_attribution)->format('d/m/Y') }}</div>
                                        @if($liaison->date_retour_prevue)
                                            <small class="text-danger">Retour : {{ \Carbon\Carbon::parse($liaison->date_retour_prevue)->format('d/m/Y') }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = match($liaison->statut) {
                                                'actif' => 'bg-success text-success',
                                                'reserve' => 'bg-warning text-warning',
                                                default => 'bg-secondary text-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} bg-opacity-10 border border-current">{{ ucfirst($liaison->statut) }}</span>
                                    </td>
                                    <td class="text-end">
                                        @if($liaison->statut == 'actif')
                                            <button wire:click="detacherEquipement({{ $liaison->id }})"
                                                    wire:confirm="Êtes-vous sûr de vouloir détacher cet équipement ?"
                                                    class="btn btn-sm btn-outline-danger rounded-circle" title="Détacher">
                                                <i class="bi bi-trash3"></i>
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

            <div class="tab-pane fade" id="link3" role="tabpanel" aria-labelledby="link3-tab">
                <h5 class="fw-bold mb-3">Historique des tickets</h5>
                <div class="list-group gap-2">
                    @foreach ($tickets as $ticket)
                    <div class="list-group-item list-group-item-action rounded-3 border p-3">
                        <div class="d-flex w-100 justify-content-between align-items-start mb-2">
                            <button wire:click="visualiserTicket('{{ $ticket->id }}')" class="btn p-0 border-0 fw-bold text-start text-dark text-capitalize">
                                {{ $ticket->sujet }}
                            </button>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($ticket->created_at)->translatedFormat('d M Y H:i') }}</small>
                        </div>
                        <p class="mb-3 text-muted small">{{ $ticket->details }}</p>
                        <div class="d-flex w-100 justify-content-between align-items-center border-top pt-2">
                            <span class="small text-muted">
                                <i class="bi bi-tools text-success me-1"></i> {{ $ticket->equipement }}
                            </span>
                            <div class="d-flex align-items-center gap-1">
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border me-2">{{ $ticket->state == 2 ? 'Assigné' : 'En attente' }}</span>
                                <img src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}&size=24" alt="Profil" width="24" height="24" class="rounded-circle">
                                <img src="https://ui-avatars.com/api/?name={{ $ticket->responsable->name ?? 'None' }}&size=24&background=eee" alt="Responsable" width="24" height="24" class="rounded-circle">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">
                <h5 class="fw-bold mb-3">Historique de checkout</h5>
                <div class="list-group gap-2">
                    @foreach ($checkouts as $checkout)
                    <div class="list-group-item list-group-item-action rounded-3 border p-3" data-aos="fade-down">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-dark">{{ $checkout->materiel_type }}</span>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($checkout->created_at)->translatedFormat('d M Y H:i') }}</small>
                        </div>
                        <p class="mb-3 text-muted small">{{ $checkout->materiel_details }}</p>
                        <div class="d-flex w-100 justify-content-between align-items-center border-top pt-2">
                            @php
                                $checkStatut = match($checkout->statut) {
                                    1 => ['En cours', 'bg-warning text-warning'],
                                    2 => ['Validé', 'bg-success text-success'],
                                    default => ['Fermé', 'bg-secondary text-secondary']
                                };
                            @endphp
                            <span class="badge {{ $checkStatut[1] }} bg-opacity-10 border">{{ $checkStatut[0] }}</span>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($checkout->utilisateur->nom) }}&size=24" alt="Profil" width="24" height="24" class="rounded-circle">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="link4" role="tabpanel" aria-labelledby="link4-tab">
                <h5 class="fw-bold mb-3">Liste des réservations d'équipements</h5>
                <div class="list-group gap-2" style="max-height: 450px; overflow-y: auto;">
                    @foreach ($matreservations as $materiel)
                    <div class="list-group-item list-group-item-action rounded-3 border p-3">
                        <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-dark text-capitalize">{{ $materiel->equipement_type }}</span>
                            <span class="badge bg-light text-muted border fw-normal">
                                <i class="bi bi-calendar-range me-1"></i>
                                {{ \Carbon\Carbon::parse($materiel->date_debut)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($materiel->date_fin)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <div class="d-flex w-100 justify-content-between align-items-center border-top pt-2 mt-2">
                            <small class="text-muted">Créé le {{ \Carbon\Carbon::parse($materiel->created_at)->translatedFormat('d M Y H:i') }}</small>
                            @php
                                $resStatut = match ($materiel->statut) {
                                    1 => ['CRÉÉ', 'bg-info text-info'],
                                    2 => ['VALIDÉ', 'bg-success text-success'],
                                    3 => ['EN COURS', 'bg-warning text-warning'],
                                    4 => ['RENDU', 'bg-secondary text-secondary'],
                                    5 => ['ARCHIVÉ', 'bg-dark text-white'],
                                    default => ['CRÉÉ', 'bg-info text-info'],
                                };
                            @endphp
                            <span class="badge {{ $resStatut[1] }} bg-opacity-10 border">{{ $resStatut[0] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="link5" role="tabpanel" aria-labelledby="link5-tab">
                <h5 class="fw-bold mb-3">Liste des incidents déclarés</h5>
                <div class="list-group gap-2" style="max-height: 450px; overflow-y: auto;">
                    @foreach ($incidents as $incident)
                    <div class="list-group-item list-group-item-action rounded-3 border p-3">
                        <div class="d-flex w-100 justify-content-between align-items-start mb-2">
                            <div>
                                <span class="fw-bold text-danger me-2">#{{ $incident->id }}</span>
                                <span class="fw-bold text-dark">{{ $incident->incident_sujet }}</span>
                            </div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($incident->created_at)->translatedFormat('d M Y H:i') }}</small>
                        </div>
                        <div class="mb-2">
                            <span class="badge bg-light text-dark border small fw-normal">
                                <i class="bi bi-laptop me-1"></i>
                                @if ($incident->equipement_type == 'Ordinateur')
                                    {{ $incident->ordinateur->nom ?? '' }} {{ $incident->ordinateur->os_version ?? '' }}
                                @elseif($incident->equipement_type == 'Telephone')
                                    {{ $incident->telephone->nom ?? '' }} {{ $incident->telephone->marque ?? '' }}
                                @endif
                            </span>
                        </div>
                        <p class="text-muted small mb-3">{{ $incident->incident_description }}</p>
                        <div class="d-flex w-100 justify-content-between align-items-center border-top pt-2">
                            <span class="small text-muted">
                                <i class="bi bi-hdd-stack text-success me-1"></i> {{ $incident->equipement }}
                            </span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge {{ $incident->statut == 0 ? 'bg-danger text-danger' : 'bg-warning text-warning' }} bg-opacity-10 border">
                                    {{ $incident->statut == 1 ? 'En cours' : ($incident->statut == 0 ? 'Annulation demandée' : 'En traitement') }}
                                </span>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($incident->utilisateur->nom ?? 'none') }}&size=24" alt="Profil" width="24" height="24" class="rounded-circle">
                            </div>
                        </div>
                    </div>
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
                        <p class="text-muted mb-3 mt-1">Les champs indiqués <span class="text-danger">*</span> sont
                            obligatoires</p>

                        <!-- Liste des équipements à lier -->
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-bold text-muted d-flex justify-content-between">
                                <span>Équipements à lier</span>
                                <button type="button" wire:click="ajouterLigne"
                                    class="btn btn-sm btn-outline-success py-0">
                                    <i class="bi bi-plus-circle me-1"></i>Ajouter une ligne
                                </button>
                            </label>

                            @foreach($items_a_lier as $index => $item)
                            <div class="card mb-2 border shadow-sm">
                                <div class="card-body p-2">
                                    <div class="row g-2 align-items-center">
                                        <!-- Type d'équipement -->
                                        <div class="col-md-5">
                                            <select wire:model="items_a_lier.{{ $index }}.type"
                                                class="form-select form-select-sm @error('items_a_lier.'.$index.'.type') is-invalid @enderror">
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
                                                <option value="{{ $equip->id }}">{{ $equip->nom }} - {{
                                                    $equip->fabricant ?? '' }}</option>
                                                @endforeach
                                                @elseif($item['type'] == 'telephone')
                                                @foreach($telephones as $equip)
                                                <option value="{{ $equip->id }}">{{ $equip->nom }} - {{ $equip->marque
                                                    ?? '' }}</option>
                                                @endforeach
                                                @elseif($item['type'] == 'flotte')
                                                @foreach($flottes as $equip)
                                                <option value="{{ $equip->id }}">{{ $equip->nom ?? 'Véhicule' }} - {{
                                                    $equip->immatriculation ?? '' }}</option>
                                                @endforeach
                                                @elseif($item['type'] == 'imprimante')
                                                @foreach($imprimantes as $equip)
                                                <option value="{{ $equip->id }}">{{ $equip->nom }} - {{
                                                    $equip->fabricant ?? '' }}</option>
                                                @endforeach
                                                @elseif($item['type'] == 'moniteur')
                                                @foreach($moniteurs as $equip)
                                                <option value="{{ $equip->id }}">{{ $equip->nom }} - {{
                                                    $equip->fabricant ?? '' }}</option>
                                                @endforeach
                                                @elseif($item['type'] == 'peripherique')
                                                @foreach($peripheriques as $equip)
                                                <option value="{{ $equip->id }}">{{ $equip->nom }} - {{ $equip->type ??
                                                    '' }}</option>
                                                @endforeach
                                                @endif
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Bouton supprimer -->
                                        <div class="col-md-1 text-end">
                                            @if(count($items_a_lier) > 1)
                                            <button type="button" wire:click="supprimerLigne({{ $index }})"
                                                class="btn btn-sm btn-outline-danger border-0">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            @endif
                                        </div>

                                        @error('items_a_lier.'.$index.'.type') <div
                                            class="col-12 text-danger small px-2">{{ $message }}</div> @enderror
                                        @error('items_a_lier.'.$index.'.id') <div class="col-12 text-danger small px-2">
                                            {{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Date d'attribution -->
                        <div class="mb-3 col-lg-6">
                            <label class="form-label fw-bold text-muted">Date d'attribution <span
                                    class="text-danger">*</span></label>
                            <input type="date" wire:model="date_attribution"
                                class="form-control @error('date_attribution') is-invalid @enderror">
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
                            <textarea wire:model="description_liaison" class="form-control" rows="2"
                                placeholder="Ex: Matériel principal, équipement de test, etc."></textarea>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer border-top-0 py-3 px-4 bg-light bg-opacity-50">
                        <button type="button" class="btn btn-link text-muted fw-600 text-decoration-none"
                            data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success px-5 rounded-3 fw-600 shadow-sm">Lier
                            l'équipement</button>
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
                    src="{{ asset('storage/' . $utilisateurs->photo) }}" alt="Photo de {{ $utilisateurs->nom }}">
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
                <small>{{ $chat->type == 'user' ? 'Vous' : $utilisateurs->nom }} · {{ $chat->created_at->format('H:i')
                    }}</small>
            </div>
            @endforeach
        </div>

        <form wire:submit.prevent="EnvoyerMessage" class="p-2">
            <textarea id="input" wire:model="message" class="chat-input" rows="1"
                placeholder="Écris un message..."></textarea>
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

        html,
        body {
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

        .fw-800 {
            font-weight: 800;
        }

        .fw-700 {
            font-weight: 700;
        }

        .fw-600 {
            font-weight: 600;
        }

        .modal-backdrop.show {
            background-color: rgba(0, 0, 0, 0.2) !important;
        }

        /* Object fit cover pour les images */
        .object-fit-cover {
            object-fit: cover;
        }

        /* Style du tableau */
        .table td,
        .table th {
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