<div style="margin-top: 5%" class=" bg-md-white-cust ">
     <div wire:loading.flex
        class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 justify-content-center align-items-center"
        style="z-index: 10;">
        <div class="spinner-border text-secondary" role="status" style="width: 1.5rem; height: 1.5rem;"></div>
    </div>
    <div wire:ignore.self class="sidebar  rounded-3 text-dark card bg-light p-0  colg-lg-3 mt-4 " id="sidebar">

        <!-- Header -->
        <div class=" border-bottom">
            <h5 class="modal-title mx-2 my-2 text-dark fw-bold" id="incidentModalLabel">Nouveau incident</h5>

        </div>

        <!-- Formulaire Livewire -->
        <form wire:submit.prevent="store">
            <div class="modal-body row" style="max-height:400px;overflow-y: scroll; scrollbar-width: none;">
                <!-- Sujet -->
                <p class="text-dark  mb-3 mt-3">Veuillez remplir tous les champs.</p>

                <div class="mb-3 ">
                    <div>
                        {{-- <label for="sujet" class="modern-label">
                            Sujet <span class="required">*</span>
                        </label> --}}

                        <textarea id="sujet" cols="2" placeholder="Quelle  est le sujet de votre incident? "
                            class="modern-textarea @error('sujet') invalid @enderror"
                            wire:model.debounce.500ms="incident_sujet">
                        </textarea>

                        @error('sujet')
                        <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Détails -->
                <div class="mb-3  ">
                    {{-- <label for="details" class="form-label fw-bold text-muted">Description <span --}} <textarea
                            type="text" placeholder="Details de votre incident ..."
                            class="modern-textarea w-100  @error('details') is-invalid border-danger @enderror"
                            id="details" wire:model.debounce.500ms="incident_description" rows="2"></textarea>
                            @error('details')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                </div>
                @if (!empty($incident_description))
                <div class="border-top border-2 mb-4">
                </div>

                <div class="mb-3   py-2">
                    <label for="nature" class="form-label fw-bold text-muted mb-2">Quelle est le nature de
                        l'incident<span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="categorie"
                            class="modern-textarea py-2 px-1 form-select-sm ps-5 text-muted border-0 border-bottom @error('impact') is-invalid @enderror"
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

                <div class="mb-3 ">
                    <label for="equipement_type" class="form-label fw-bold text-muted">Équipement <span
                            class="text-danger">*</span></label>
                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="equipement_type"
                            class="modern-textarea py-2 px-1 form-select-sm ps-5 text-muted border-0 border-bottom"
                            wire:model="equipement_type">
                            <option value="">Sélectionner l'equipement</option>
                            <option value="Ordinateur">Ordinateur</option>
                            <option value="Telephone">Téléphone</option>
                            <option value="Peripherique">Périphérique</option>
                            <option value="sim_card">Carte SIM</option>
                            <option value="Moniteur">Moniteur</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                </div>

                @if ($equipement_type === 'Ordinateur')
                <div class="mb-3 ">
                    <label for="equipement_id" class="form-label fw-bold text-muted">Sélectionner le matériel
                        <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="equipement_id"
                            class="modern-textarea py-2 px-4 form-select-sm ps-5 text-muted border-0 border-bottom @error('equipement_id') is-invalid @enderror"
                            wire:model="equipement_id">
                            <option value="">Sélectionner </option>

                            @foreach ($checkouts as $checkout)
                            @if ($checkout->materiel_type === 'ordinateur' && !$incidents->contains('equipement_id',
                            $checkout->equipement_id))
                            <option value="{{ $checkout->ordinateur->id }}">
                                Ordinateur : {{ $checkout->ordinateur->nom }}
                            </option>
                            @endif
                            @endforeach
                            @foreach ($EquipementLier as $equipement)
                            @if($equipement->ordinateur?->id && !$incidents->contains('equipement_id',
                            $equipement->ordinateur->id))

                            <option value="{{ $equipement->ordinateur->id }}">
                                Ordinateur : {{ $equipement->ordinateur->nom }}
                            </option>
                            @endif
                            @endforeach
                            {{-- <option value="Imprimante">Imprimante</option>
                            <option value="Routeur">Routeur</option>
                            <option value="Switch">Switch</option>
                            <option value="Serveur">Serveur</option>
                            <option value="autre">Autre</option> --}}
                        </select>
                    </div>
                    @error('equipement_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @elseif($equipement_type == 'Telephone')
                <div class="mb-3 ">
                    <label for="equipement_id" class="form-label fw-bold text-muted">Sélectionner le matériel
                        <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="equipement_id"
                            class="modern-textarea py-2 px-4 form-select-sm ps-5 text-muted border-0 border-bottom @error('equipement_id') is-invalid @enderror"
                            wire:model="equipement_id">
                            <option value="">Sélectionner </option>

                            @foreach ($EquipementLier as $equipement)

                            @if($equipement->telephone?->id && !$incidents->contains('equipement_id',
                            $equipement->telephone->id))

                            <option value="{{ $equipement->telephone->id  }}">
                                telephone : {{ $equipement->telephone->nom}}
                            </option>
                            @endif

                            @endforeach

                            @foreach ($checkouts as $checkout)
                            @if ($checkout->materiel_type == 'Telephone' && !$incidents->contains('equipement_id',
                            $checkout->equipement_id))
                            <option value="{{ $checkout->telephone->id }}">
                                {{ $checkout->telephone->nom }}
                                {{ $checkout->telephone->marque }}</option>
                            @endif
                            @endforeach

                            {{-- <option value="Imprimante">Imprimante</option>
                            <option value="Routeur">Routeur</option>
                            <option value="Switch">Switch</option>
                            <option value="Serveur">Serveur</option>
                            <option value="autre">Autre</option> --}}
                        </select>
                    </div>
                    @error('equipement_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @elseif($equipement_type == 'Peripherique')
                <div class="mb-3 ">
                    <label for="equipement_id" class="form-label fw-bold text-muted">Sélectionner le peripherique
                        <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="equipement_id"
                            class="modern-textarea py-2 px-4 form-select-sm ps-5 text-muted border-0 border-bottom @error('equipement_id') is-invalid @enderror"
                            wire:model="equipement_id">
                            <option value="">Sélectionner </option>

                            @foreach ($EquipementLier as $equipement)

                            @if($equipement->peripherique?->id && !$incidents->contains('equipement_id',
                            $equipement->peripherique->id))

                            <option value="{{ $equipement->peripherique->id  }}">
                                Peripherique : {{ $equipement->peripherique->nom}}
                            </option>
                            @endif

                            @endforeach

                            @foreach ($checkouts as $checkout)
                            @if ($checkout->materiel_type == 'Peripherique' && !$incidents->contains('equipement_id',
                            $checkout->equipement_id))
                            <option value="{{ $checkout->peripherique->id }}">
                                {{ $checkout->peripherique->type }}
                                {{ $checkout->peripherique->nom }}</option>
                            @endif
                            @endforeach


                        </select>
                    </div>
                    @error('equipement_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @elseif($equipement_type == 'sim_card')
                <div class="mb-3 ">
                    <label for="equipement_id" class="form-label fw-bold text-muted">Sélectionner la carte SIM
                        <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="equipement_id"
                            class="modern-textarea py-2 px-4 form-select-sm ps-5 text-muted border-0 border-bottom @error('equipement_id') is-invalid @enderror"
                            wire:model="equipement_id">
                            <option value="">Sélectionner </option>

                            @foreach ($EquipementLier as $equipement)
                            @if($equipement->sim_card?->id && !$incidents->contains('equipement_id',
                            $equipement->sim_card->id))
                            <option value="{{ $equipement->sim_card->id  }}">
                                SIM : {{ $equipement->sim_card->phone_number }} - {{ $equipement->sim_card->operator }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @error('equipement_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif

                <div class="mb-3 col-lg-6 ">
                    <label for="categorie" class="form-label fw-bold text-muted">Rapport d'incident <span
                            class="text-danger">*</span></label>


                    <input type="file" wire:model="rapport_incident"
                        class="form-control border-0 border-bottom  @error('rapport_incident') is-invalid @enderror">
                    @error('rapport_incident')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div wire:loading wire:target="rapport_incident">Telechargement...</div>


                </div>

                <div class="mb-3 col-lg-6 ">
                    <label for="categorie" class="form-label fw-bold text-muted">Declaration de perte <span
                            class="text-success">( Optionnel )</span></label>
                    <input type="file" wire:model="declaration_perte" class="form-control border-0 border-bottom">
                    <div wire:loading wire:target="declaration_perte">Telechargement...</div>
                </div>
                @endif

            </div>

            <!-- Footer -->
            <div class="modal-footer border-top py-1 ">
                <button type="button" class="btn btn-outline-light text-dark border px-3 "
                    id="closeSidebar">Quitter</button>
                <button type="submit" class="btn m-1   fw-bold border px-3  btn-two text-white  shadow-sm">


                    Envoyer
                    <span wire:loading wire:target="store" class="spinner-border spinner-border-sm ms-2" role="status"
                        aria-hidden="true"></span>
                </button>
            </div>
        </form>

    </div>

    <div class="container-fluid ">
        <div class="row col-lg-11  offset-xs-0 col-12">
            <div class="col-lg-2 bg-light py-1 px-0 d-md-block d-xl-block d-none ">


                @livewire('component.menu-utilisateur')


            </div>
            <div class="mt-2 offset-lg-1 p-xs-0 p-0 p-md-0 p-xl-2 py-5 bg-white  col-lg-8 rounded-2"
                style="max-height:100vh;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
                <div class="row align-items-end mb-4">
                    <div class="col-8 col-lg-6">
                        <div class="ms-md-4">
                            <h4 class="fw-bold text-soft mb-1 d-none d-md-block">Incidents</h4>
                            <h5 class="fw-bold text-soft mb-1 d-block d-md-none">Liste de vos incidents</h5>

                            <p class="text-subtle mb-0 small" style="letter-spacing: 0.3px;">
                                Gestion d'incident et suivi technique
                            </p>
                        </div>
                    </div>

                    <div class="col-4 col-lg-6 text-end">
                        <div class="me-md-2">

                            {{-- Action Desktop : Masquer/Afficher --}}
                            <div wire:click="disableRecente"
                                class="d-none d-md-inline-flex align-items-center fw-bold text-primary-pivot btn-action-soft"
                                style="cursor:pointer; font-size: 0.85rem;">
                                <i class="fas {{ $disabled ? 'fa-eye' : 'fa-eye-slash' }} me-2"></i>
                                {{ $disabled ? 'Afficher Récentes' : 'Masquer Récentes' }}
                            </div>

                            {{-- Action Mobile : Nouveau --}}
                            <span class="d-inline-block d-md-none fw-bold text-primary-pivot p-2"
                                style="cursor:pointer; font-size: 0.9rem;" id="toggleSidebar">
                                <i class="fas fa-plus-circle me-1"></i> Nouveau
                            </span>

                        </div>
                    </div>
                </div>

                <section class="p-0  mx-4 mx-md-3 mx-lg-3">
                    <div class="row p-0 ">
                        <div class="{{ $disabled ? 'd-none' : 'd-block' }}">
                            <div class="row border-top mt-2">
                                <div class="col-lg-6 ">
                                    <h5 class=" py-2 px-2 d-flex justify-content-between">Récente</h5>
                                </div>

                            </div>

                            @foreach ($Incidentsrecentes as $incidentrecent)
                            <div class="col-12 mb-3">
                                <div class="card border-0 shadow-sm rounded-4 hover-shadow transition-all position-relative overflow-hidden"
                                    style="background: #ffffff;">



                                    <div class="card-body p-3 ps-4">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="d-flex align-items-center flex-grow-1" style="min-width: 0;">
                                                @php
                                                $photoUser = optional($incidentrecent->utilisateur)->photo;
                                                @endphp

                                                <div class="position-relative flex-shrink-0">
                                                    <img src="{{ $photoUser ? asset('storage/' . $photoUser) : 'https://ui-avatars.com/api/?name='.urlencode($incidentrecent->utilisateur->nom ?? 'none').'&background=E9ECEF&color=495057' }}"
                                                        alt="Profil" width="46" height="46"
                                                        class="rounded-circle border border-2 border-white shadow-sm object-fit-cover">
                                                    <span
                                                        class="position-absolute bottom-0 end-0 p-1 bg-secondary border border-2 border-white rounded-circle shadow-sm"></span>
                                                </div>

                                                <div class="ms-3 text-truncate">
                                                    <h6 class="mb-0 fw-bold text-soft text-truncate"
                                                        style="font-size: 0.95rem;">
                                                        {{ $incidentrecent->incident_nature }} : {{
                                                        $incidentrecent->incident_sujet }}
                                                    </h6>
                                                    <p class="text-subtle mb-0 small text-truncate"
                                                        style="max-width: 450px;">
                                                        <span class="fw-medium text-dark">{{
                                                            $incidentrecent->utilisateur->nom ?? 'Utilisateur' }}</span>
                                                        • {{ $incidentrecent->incident_description ?? 'Aucun détail
                                                        fourni' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center ms-4">
                                                <div class="text-end me-3 d-none d-md-block border-end pe-3">
                                                    <small class="text-subtle d-block mb-1"
                                                        style="font-size: 0.7rem; font-weight: 500;">
                                                        <i class="far fa-clock me-1"></i>
                                                        {{
                                                        \Carbon\Carbon::parse($incidentrecent->created_at)->diffForHumans()
                                                        }}
                                                    </small>

                                                    <div class="d-flex gap-1 justify-content-end">
                                                        @if($incidentrecent->rapport_incident)
                                                        <span class="badge bg-light text-subtle border-0 fw-normal"
                                                            style="font-size: 0.6rem;">
                                                            <i class="bi bi-paperclip"></i> Rapport
                                                        </span>
                                                        @endif
                                                        <span
                                                            class="badge-pivot-soft status-{{ $incidentrecent->statut }}">
                                                            Incident
                                                        </span>
                                                    </div>
                                                </div>

                                                <button
                                                    class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                                    style="width: 32px; height: 32px;">
                                                    <i class="fas fa-chevron-right text-subtle"
                                                        style="font-size: 0.8rem;"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <div
                            class="d-flex flex-wrap align-items-center justify-content-between mb-3 mt-4 pb-2 border-bottom shadow-none">


                            <div class="d-flex align-items-center gap-3 flex-grow-1 me-4">

                                <div class="position-relative flex-grow-1" >

                                    <input type="text" wire:model.live="Recheche"
                                        class="form-control form-control-sm  border-0 bg-light rounded-2 ps-5 pe-3 shadow-none w-100 "
                                        placeholder="Rechercher un sujet..."
                                        style="min-width: 250px; font-size: 0.85rem; color: #475569;">
                                </div>

                                <div class="d-flex align-items-center  border-0 shadow-sm rounded-pill px-3 bg-white border"
                                    style="height: 38px;">
                                <label class=" text-subtle small fw-bold mb-0 me-2" style="white-space: nowrap;">Filtre
                                    :</label>
                                    <select wire:model.live="filtrerticket"
                                        class="border-0  bg-transparent text-soft small fw-semibold outline-none"
                                        style="cursor: pointer; width: auto; min-width: 100px;">
                                        <option value="">Tous</option>
                                        <option value="1">En cours</option>
                                        <option value="2">En traitement</option>
                                        <option value="3">Résolu</option>
                                        <option value="4">Fermé</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="list-group  mt-2 px-lg-4 px-md-4 px-2"
                            style="max-height:700px;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">




                            @forelse ($incidents as $incident)
                            <a wire:click="visualiser('{{ $incident->id }}')" href="#" data-bs-toggle="modal"
                                data-bs-target="#incidentDetailModal"
                                class="list-group-item list-group-item-action border-0 mb-2 shadow-sm rounded-3 p-3 bg-white transition-all">

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="flex-grow-1" style="min-width: 0;">
                                        <div class="d-flex align-items-center">
                                            <span class=" text-soft text-truncate-single"
                                                style="font-size: 0.9rem; max-width: 70%;">
                                                {{ $incident->incident_nature }} : {{ $incident->incident_sujet }}
                                            </span>

                                            <span class="mx-2 text-subtle">|</span>

                                            <span class="text-subtle text-truncate-single small">
                                                <i class="fas fa-tools me-1" style="font-size: 0.75rem;"></i>
                                                {{ $incident->equipement_type }}
                                            </span>
                                        </div>

                                        <div class="text-subtle text-truncate-single mt-1"
                                            style="opacity: 0.8; font-size: 0.85rem;">
                                            {{ $incident->incident_description }}
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center ms-3 shadow-none">
                                        <span class="badge-pivot-soft status-{{ $incident->statut }} me-3"
                                            style="font-size: 0.6rem;">
                                            {{ match($incident->statut) {
                                            0 => 'Annulé',
                                            1 => 'En cours',
                                            2 => 'Reçu',
                                            3 => 'Résolu',
                                            default => 'Nouveau'
                                            } }}
                                        </span>

                                        <div class="text-end" style="min-width: 85px;">
                                            <div class="text-soft " style="font-size: 0.75rem;">
                                                {{ \Carbon\Carbon::parse($incident->created_at)->format('H:i') }}
                                            </div>
                                            <div class="text-subtle" style="font-size: 0.65rem;">
                                                {{ \Carbon\Carbon::parse($incident->created_at)->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @empty
                            <div
                                class="d-flex flex-column align-items-center justify-content-center p-5 mt-4 rounded-4 bg-light border border-dashed">
                                <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-warning opacity-75" width="40"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>

                                <h6 class="fw-bold text-dark mb-1">Aucun incident trouvé</h6>
                                <p class="text-muted small mb-0">Essayez de modifier vos filtres ou votre recherche.</p>

                               
                            </div>
                            @endforelse

                            <div class="mt-4 d-flex justify-content-center">
                                {{-- {{ $incidents->links() }} --}}

                            </div>

                        </div>

                </section>
            </div>
        </div>


    </div>

    <!-- Bouton pour ouvrir la modal -->

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="incidentDetailModal" tabindex="-1"
        aria-labelledby="incidentDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="incidentDetailModalLabel">A propos de l'incident</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Sujet :</div>
                            <div class="col-md-8" id="commentaire">
                                {{ $selectedIncidents?->incident_sujet }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Details :</div>
                            <div class="col-md-8" id="commentaire">
                                {{ $selectedIncidents?->incident_description }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Type d'équipement :</div>
                            <div class="col-md-8" id="equipement_type">{{ $selectedIncidents?->equipement_type }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Matériel :</div>
                            <div class="col-md-8" id="equipement_id">
                                @if ($selectedIncidents?->equipement_type == 'Ordinateur')
                                {{ $selectedIncidents?->ordinateur->nom }}
                                {{ $selectedIncidents?->ordinateur->os_version }}
                                @endif
                                @if ($selectedIncidents?->equipement_type == 'Telephone')
                                {{ $selectedIncidents?->telephone->nom }}
                                {{ $selectedIncidents?->telephone->marque }}
                                @endif

                                @if ($selectedIncidents?->equipement_type == 'Peripherique')
                                {{ $selectedIncidents?->peripherique->nom }}
                                {{ $selectedIncidents?->peripherique->details }}
                                @endif


                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Responsable :</div>
                            <div class="col-md-8" id="responsable">{{ $selectedIncidents?->utilisateur->nom }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Date de creation :</div>
                            <div class="col-md-8" id="date_debut">{{ $selectedIncidents?->created_at }}</div>
                        </div>
                        {{-- <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Date de fin :</div>
                            <div class="col-md-8" id="date_fin">2025-11-12</div>
                        </div> --}}
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Statut :</div>
                            <div class="col-md-8" id="statut">EN COURS</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Rapport :</div>
                            <div class="col-md-8" id="rapport">
                                <a href="{{ asset('storage/' . $selectedIncidents?->rapport_incident) }}"
                                    target="_blank">
                                    <i class="bi bi-download"></i> Télécharger le rapport
                                </a>
                            </div>
                        </div>
                        @if ($selectedIncidents?->declaration_perte)
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold text-muted">Declaration de perte :</div>
                            <div class="col-md-8" id="rapport">
                                <a href="{{ asset('storage/' . $selectedIncidents?->declaration_perte) }}"
                                    target="_blank">
                                    <i class="bi bi-download"></i> Télécharger le declation de perte
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Fermer</button>
                    @if ($selectedIncidents?->statut == 1)
                    <button type="button" wire:click="annulationDemande({{ $selectedIncidents?->id }})"
                        class="btn btn-danger px-4" data-bs-dismiss="modal">
                        Annuller la
                        demande</button>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>