<div style="margin-top:5%" class="border container-fluid mt-5 parallax-section">
    <!-- Messages flash -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Sidebar du formulaire de checkout -->
    <div wire:ignore.self class="sidebar shadow rounded-3 p-0 col-lg-2 bg-white py-4 card mt-5" id="sidebar">
        <div>
            <div>
                <div>
                    <!-- Header -->
                    <div class="border-bottom">
                        <h4 class="modal-title mx-2 my-2 text-dark" id="ordinateurModalLabel">Nouveau checkout</h4>
                    </div>

                    <!-- Formulaire Livewire -->
                    <div class="modal-body p-2 row" style="max-height:400px;overflow-y: scroll">
                        <div class="etap_validation">
                            <label for="sujet" class="form-label text-dark">
                                Choisir le matériel <span class="text-danger">*</span>
                            </label>

                            <!-- Étape 1: Catégorie principale -->
                            <div class="etap {{ $etape[1] }}">
                                <a href="#" wire:click.prevent="$set('valeur1', 'ordinateur')" 
                                    class="{{ $valeur1 == 'ordinateur' ? 'shadow-lg fw-bold' : 'shadow-sm' }} nav-link text-dark card mb-2">
                                    <div class="d-flex w-100 justify-content-between p-2">
                                        <label class="text-dark">Ordinateur</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>
                                </a>
                                <a href="#" wire:click.prevent="$set('valeur1', 'Telephone')" 
                                    class="{{ $valeur1 == 'Telephone' ? 'shadow-lg fw-bold' : 'shadow-sm' }} nav-link text-dark card mb-2">
                                    <div class="d-flex w-100 justify-content-between p-2">
                                        <label class="text-dark">Téléphone</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>
                                </a>
                                <a href="#" wire:click.prevent="$set('valeur1', 'Peripherique')" 
                                    class="{{ $valeur1 == 'Peripherique' ? 'shadow-lg fw-bold' : 'shadow-sm' }} card text-dark mb-2 nav-link">
                                    <div class="d-flex w-100 justify-content-between p-2">
                                        <label class="text-dark">Périphérique</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>
                                </a>

                                <div class="mt-4 border-bottom py-1">
                                    <button wire:click.prevent="next_form(2)" class="btn btn-two fw-bold border px-3 btn-sm shadow-sm">
                                        Suivant
                                    </button>
                                </div>
                            </div>

                            <!-- Étape 2: Téléphone -->
                            <div class="etap {{ $etape[2] }}">
                                <a href="#" wire:click.prevent="$set('valeur2', 'Touche')"
                                    class="nav-link {{ $valeur2 == 'Touche' ? 'shadow-lg fw-bold' : 'shadow-sm' }} card border rounded-2 mb-2">
                                    <div class="d-flex w-100 justify-content-between p-2">
                                        <label class="text-dark">Téléphone Touche</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>
                                </a>
                                <a href="#" wire:click.prevent="$set('valeur2', 'Android')"
                                    class="nav-link {{ $valeur2 == 'Android' ? 'shadow-lg fw-bold' : 'shadow-sm' }} card border rounded-2 mb-2">
                                    <div class="d-flex w-100 justify-content-between p-2">
                                        <label class="text-dark">Téléphone Android</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>
                                </a>
                                <a href="#" wire:click.prevent="$set('valeur2', 'Tablette')"
                                    class="nav-link {{ $valeur2 == 'Tablette' ? 'shadow-lg fw-bold' : 'shadow-sm' }} card border rounded-2 mb-2">
                                    <div class="d-flex w-100 justify-content-between p-2">
                                        <label class="text-dark">Tablette</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>
                                </a>
                                <div class="mt-4 border-bottom py-1">
                                    <button wire:click="next_form(1)" class="btn btn-two fw-bold border px-3 btn-sm shadow-sm">
                                        Précédent
                                    </button>
                                    <button wire:click="next_form(5)" class="btn btn-two fw-bold border px-3 btn-sm shadow-sm">
                                        Suivant
                                    </button>
                                </div>
                            </div>

                            <!-- Étape 4: Périphériques -->
                            <div class="etap {{ $etape[4] }}">
                                <div class="list-group">
                                    @foreach(['Regulateur', 'Clavier', 'Souris', 'Webcam', 'Casque', 'Scanner', 'Cable', 'USB', 'Jabra', 'Powerbank', 'Chargeur', 'APN', 'Appareil Photo', 'Dominos'] as $peripherique)
                                        <a href="#" wire:click.prevent="$set('valeur2', '{{ $peripherique }}')"
                                            class="{{ $valeur2 == $peripherique ? 'shadow-lg fw-bold' : 'shadow-sm' }} nav-link card border rounded-2 mb-2">
                                            <div class="d-flex w-100 justify-content-between p-2">
                                                <label class="text-dark">{{ $peripherique }}</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    <button wire:click="next_form(1)" class="btn btn-two fw-bold border px-3 btn-sm shadow-sm">
                                        Précédent
                                    </button>
                                    <button wire:click="next_form(5)" class="btn btn-two fw-bold border px-3 btn-sm shadow-sm">
                                        Valider
                                    </button>
                                </div>
                            </div>

                            <!-- Étape 5: Validation -->
                            <div class="etap py-2 {{ $etape[5] }}">
                                <h5 class="text-dark">Vos sélections</h5>
                                <div class="py-2 list-group-item list-group-item-action border rounded-2 mb-2">
                                    <div class="d-flex py-2 px-1 w-100 justify-content-between">
                                        <label class="text-dark">1 - {{ $valeur1 }}</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>
                                </div>

                                @if($valeur2)
                                    <div class="py-2 list-group-item list-group-item-action border rounded-2 mb-2">
                                        <div class="d-flex py-2 px-1 w-100 justify-content-between">
                                            <label class="text-dark">2 - {{ $valeur2 }}</label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-4">
                                    <button wire:click="next_form(1)" class="btn btn-two fw-bold border px-3 btn-sm shadow-sm">
                                        Précédent
                                    </button>
                                    <button type="button" wire:click="EnvoyerCheckout" 
                                        class="btn btn-two btn-sm fw-bold shadow-sm" 
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove wire:target="EnvoyerCheckout">
                                            <i class="fas fa-paper-plane me-2"></i>Envoyer
                                        </span>
                                        <span wire:loading wire:target="EnvoyerCheckout">
                                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                            Envoi...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-one text-white fw-bold text-sm rounded px-3" id="closeSidebar">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div wire:ignore.self class="container-fluid main-content mt-4">
        <div class="row col-lg-11 offset-lg-1 offset-xs-0 col-12">
            <!-- Menu utilisateur -->
            <div class="col-lg-2 bg-white py-1 px-0">
                @livewire('component.menu-utilisateur')
            </div>
            
            <!-- Contenu right -->
            <div class="border-start col-lg-9 mx-2">
                <div class="col-lg-12">
                    <h5 class="fw-bold m-2">Checkout / Réservation d'équipement</h5>
                    <span class="text-muted m-2 mt-2 pb-2">Visualisation globale des checkouts</span>
                </div>

                <div class="col-lg-12 mx-4">
                    <!-- Checkouts récents -->
                    <div class="row border-top mt-4">
                        <div class="col-lg-6">
                            <h5 class="py-2 px-2">Récents</h5>
                        </div>
                        <div class="col-lg-6">
                            <span class="d-flex justify-content-end py-3 px-2 text-primary">
                                Afficher tous les réservations
                            </span>
                        </div>
                    </div>

                    <div class="row p-0 mx-3">
                        @foreach($checkoutrecentes as $checkoutrecente)
                            <div class="col-lg-3 mx-1 border p-0 m-0 rounded-3">
                                <div class="card-body m-0 p-2">
                                    <div class="pb-2 fw-bold text-muted">Checkout</div>
                                    <strong class="d-flex justify-content-between">
                                        <div class="bg-light rounded-start-pill">
                                            <img class="border border-primary border-2 rounded-pill me-2"
                                                src="https://ui-avatars.com/api/?name={{ $checkoutrecente->utilisateur->nom ?? 'none' }}"
                                                alt="Profil" width="40" height="40">
                                            <span class="mx-2">{{ $checkoutrecente->materiel_type ?? 'Aucun' }}</span>
                                        </div>
                                    </strong>
                                    <div class="mt-2">
                                        <p class="small">{{ $checkoutrecente->materiel_details ?? 'Aucun' }}</p>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <span class="text-muted mx-2 small">
                                                {{ \Carbon\Carbon::parse($checkoutrecente->created_at)->translatedFormat('d M Y H:i') }}
                                            </span>
                                            <img src="https://ui-avatars.com/api/?name={{ $checkoutrecente->responsable->name ?? 'none' }}"
                                                alt="Profil" width="20" height="20" class="rounded-circle">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($reservationRecentes as $reservationRecent)
                            <div class="col-lg-3 mx-1 border p-0 m-0 rounded-3">
                                <div class="card-body m-0 p-2">
                                    <div class="pb-2 fw-bold text-muted">Réservation</div>
                                    <strong class="d-flex justify-content-between">
                                        <div class="bg-light rounded-start-pill">
                                            <img class="border border-success border-2 rounded-pill me-2"
                                                src="https://ui-avatars.com/api/?name={{ $reservationRecent->responsable->nom ?? 'none' }}"
                                                alt="Profil" width="40" height="40">
                                            <span class="mx-2 text-capitalize">{{ $reservationRecent->equipement_type ?? 'Aucun' }}</span>
                                        </div>
                                    </strong>
                                    <div class="mt-2">
                                        <p class="small">
                                            {{ \Carbon\Carbon::parse($reservationRecent->date_debut)->translatedFormat('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($reservationRecent->date_fin)->translatedFormat('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-lg-3 mx-2 p-0 m-0">
                            <div class="card-body m-0">
                                <span id="toggleSidebar"
                                    class="d-flex justify-content-center text-muted bg-light rounded-3 p-5"
                                    style="border: 2px dotted #d0d0d0a1; cursor:pointer">
                                    + Nouveau
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Onglets -->
                    <div class="mt-4 p-0">
                        <ul class="nav nav-tabs text-secondary" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="active-tab" data-bs-toggle="tab" 
                                    data-bs-target="#active" type="button" role="tab">
                                    Réserver un équipement
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="link1-tab" data-bs-toggle="tab" 
                                    data-bs-target="#link1" type="button" role="tab">
                                    Historique de checkout
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="link2-tab" data-bs-toggle="tab" 
                                    data-bs-target="#link2" type="button" role="tab">
                                    Historique de vos réservations
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="historique-checkout-tab" data-bs-toggle="tab" 
                                    data-bs-target="#historique-checkout" type="button" role="tab">
                                    Historique complet
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content border-0 p-3 border-top-0" id="myTabContent">
                            <!-- Onglet Réserver -->
                            <div class="tab-pane fade show active" id="active" role="tabpanel">
                                <div class="p-2">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label class="fw-bold">Liste du matériel</label>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">Filtrer par :</span>
                                            <select class="form-select form-select-sm" wire:model.live="filtrematreservation">
                                                <option value="">Tous</option>
                                                <option value="ordinateur">Ordinateur</option>
                                                <option value="telephone">Téléphone</option>
                                                <option value="moniteur">Moniteur</option>
                                                <option value="peripherique">Périphérique</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="list-group" style="max-height:400px; overflow-y:auto">
                                        @if($filtrematreservation == '' || $filtrematreservation == 'ordinateur')
                                            @if($ordinateurs->count() > 0)
                                                <div class="py-2 fw-bold">Ordinateurs</div>
                                                @foreach($ordinateurs as $ordinateur)
                                                    <a href="#" wire:click="openCalendrier('ordinateur', {{ $ordinateur->id }})"
                                                        class="list-group-item list-group-item-action border bg-light mb-1 rounded-2 materiel-item">
                                                        <div class="d-flex justify-content-between">
                                                            <b>{{ $ordinateur->nom }}</b>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <small><i class="fas fa-microchip me-1"></i>{{ $ordinateur->os_version }}</small>
                                                            <span class="badge bg-light text-dark">{{ $ordinateur->statut }}</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            @endif
                                        @endif

                                        @if($filtrematreservation == '' || $filtrematreservation == 'telephone')
                                            @if($telephones->count() > 0)
                                                <div class="py-2 fw-bold">Téléphones</div>
                                                @foreach($telephones as $telephone)
                                                    <a href="#" wire:click="openCalendrier('telephone', {{ $telephone->id }})"
                                                        class="list-group-item list-group-item-action border bg-light mb-1 rounded-2 materiel-item">
                                                        <div class="d-flex justify-content-between">
                                                            <b>{{ $telephone->nom }}</b>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <small><i class="fas fa-mobile-alt me-1"></i>{{ $telephone->marque }}</small>
                                                            <span class="badge bg-light text-dark">{{ $telephone->statut }}</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Onglet Historique de checkout -->
                            <div class="tab-pane fade" id="link1" role="tabpanel">
                                <div class="p-2">
                                    <h5 class="mb-3">Liste des checkouts</h5>
                                    <div class="list-group" style="max-height:400px; overflow-y:auto">
                                        @forelse($checkouts as $checkout)
                                            <div class="list-group-item border bg-light mb-2 rounded-2 p-3">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="mb-1">#{{ $checkout->id }} - 
                                                            <span class="text-capitalize">{{ $checkout->materiel_type }}</span>
                                                        </h6>
                                                        <p class="mb-1 small text-muted">
                                                            {{ $checkout->materiel_details }}
                                                        </p>
                                                        <small class="text-muted">
                                                            <i class="far fa-clock me-1"></i>
                                                            {{ \Carbon\Carbon::parse($checkout->created_at)->translatedFormat('d M Y H:i') }}
                                                        </small>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-end gap-2">
                                                        <span class="badge {{ $this->getStatutBadgeClass($checkout->statut) }} px-3 py-2">
                                                            {{ $this->getStatutLabel($checkout->statut) }}
                                                        </span>
                                                        <button type="button" 
                                                            class="btn btn-outline-danger btn-sm"
                                                            wire:click="openDeleteConfirmation({{ $checkout->id }})"
                                                            title="Supprimer">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center p-5">
                                                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                                <p class="text-muted">Aucun checkout trouvé</p>
                                                <button class="btn btn-light" id="toggleSidebar">
                                                    + Nouveau checkout
                                                </button>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <!-- Onglet Historique de vos réservations -->
                            <div class="tab-pane fade" id="link2" role="tabpanel">
                                <div class="p-2">
                                    <h5 class="mb-3">Historique de vos réservations</h5>
                                    <div class="list-group" style="max-height:400px; overflow-y:auto">
                                        @forelse($matreservations as $reservation)
                                            <a href="#" wire:click="visualiser({{ $reservation->id }})"
                                                class="list-group-item list-group-item-action border bg-light mb-2 rounded-2">
                                                <div class="d-flex justify-content-between">
                                                    <b class="text-capitalize">{{ $reservation->equipement_type }}</b>
                                                    <span class="badge bg-light text-dark">
                                                        {{ $reservation->statut == 0 ? 'Annulation' : 
                                                           ($reservation->statut == 1 ? 'Créé' : 
                                                           ($reservation->statut == 2 ? 'Validé' : 
                                                           ($reservation->statut == 3 ? 'En cours' : 
                                                           ($reservation->statut == 4 ? 'Rendu' : 'Archivé')))) }}
                                                    </span>
                                                </div>
                                                <div class="small text-muted mt-2">
                                                    <i class="far fa-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($reservation->date_debut)->translatedFormat('d M Y') }} -
                                                    {{ \Carbon\Carbon::parse($reservation->date_fin)->translatedFormat('d M Y') }}
                                                </div>
                                            </a>
                                        @empty
                                            <div class="text-center p-5">
                                                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                                                <p class="text-muted">Aucune réservation trouvée</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <!-- Onglet Historique complet -->
                            <div class="tab-pane fade" id="historique-checkout" role="tabpanel" aria-labelledby="historique-checkout-tab">
                                <div class="p-3">
                                    <!-- Filtres et recherche -->
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                        <h5 class="fw-bold mb-0">Historique complet des checkouts</h5>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <!-- Filtre par statut -->
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" 
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-filter me-1"></i>
                                                    @php
                                                        $statutLabels = [
                                                            1 => 'En cours',
                                                            2 => 'Validé',
                                                            3 => 'Reçu',
                                                            4 => 'Rendu'
                                                        ];
                                                    @endphp
                                                    {{ $historiqueFiltreStatut ? $statutLabels[$historiqueFiltreStatut] : 'Filtrer par statut' }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item {{ !$historiqueFiltreStatut ? 'active' : '' }}" 
                                                           href="#" wire:click.prevent="$set('historiqueFiltreStatut', '')">
                                                            Tous les statuts
                                                        </a>
                                                    </li>
                                                    @foreach($statutLabels as $key => $label)
                                                        <li>
                                                            <a class="dropdown-item {{ $historiqueFiltreStatut == $key ? 'active' : '' }}" 
                                                               href="#" wire:click.prevent="$set('historiqueFiltreStatut', {{ $key }})">
                                                                <span class="badge {{ $this->getStatutBadgeClass($key) }} me-2">{{ $label }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            
                                            <!-- Recherche -->
                                            <div class="input-group input-group-sm" style="width: 250px;">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-search text-muted"></i>
                                                </span>
                                                <input type="text" class="form-control border-start-0" 
                                                    wire:model.live.debounce.300ms="historiqueSearch" 
                                                    placeholder="Rechercher...">
                                                @if($historiqueSearch)
                                                    <button class="btn btn-outline-secondary" type="button" 
                                                        wire:click="$set('historiqueSearch', '')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @endif
                                            </div>
                                            
                                            <!-- Bouton reset -->
                                            @if($historiqueFiltreStatut || $historiqueSearch)
                                                <button class="btn btn-outline-danger btn-sm" wire:click="resetFilters">
                                                    <i class="fas fa-undo me-1"></i>Réinitialiser
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Liste des checkouts -->
                                    <div class="row g-3">
                                        @forelse($historiqueCheckouts as $checkout)
                                            <div class="col-12">
                                                <div class="card border-0 shadow-sm hover-card">
                                                    <div class="card-body p-3">
                                                        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                                                            <!-- Partie gauche : infos principales -->
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                                                    <span class="badge bg-primary">#{{ $checkout->id }}</span>
                                                                    <span class="fw-bold text-capitalize">{{ $checkout->materiel_type }}</span>
                                                                    <span class="badge {{ $this->getStatutBadgeClass($checkout->statut) }} px-3 py-2">
                                                                        <i class="fas {{ 
                                                                            $checkout->statut == 1 ? 'fa-clock' : 
                                                                            ($checkout->statut == 2 ? 'fa-check-circle' : 
                                                                            ($checkout->statut == 3 ? 'fa-box-open' : 'fa-undo')) 
                                                                        }} me-1"></i>
                                                                        {{ $this->getStatutLabel($checkout->statut) }}
                                                                    </span>
                                                                </div>
                                                                
                                                                <p class="text-muted mb-2">
                                                                    <i class="fas fa-info-circle me-1"></i>
                                                                    @if($checkout->materiel_type == 'ordinateur' && $checkout->ordinateur)
                                                                        <strong>{{ $checkout->ordinateur->nom }}</strong>
                                                                        <span class="text-muted">- {{ $checkout->ordinateur->os_version }}</span>
                                                                    @elseif($checkout->materiel_type == 'telephone' && $checkout->telephone)
                                                                        <strong>{{ $checkout->telephone->nom }}</strong>
                                                                        <span class="text-muted">- {{ $checkout->telephone->marque }}</span>
                                                                    @else
                                                                        {{ $checkout->materiel_details }}
                                                                    @endif
                                                                </p>
                                                                
                                                                <div class="row g-2 small">
                                                                    <div class="col-md-4">
                                                                        <div class="d-flex align-items-center text-muted">
                                                                            <i class="fas fa-user-circle me-2"></i>
                                                                            <span>Utilisateur: <strong>{{ $checkout->utilisateur->nom ?? 'N/A' }}</strong></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="d-flex align-items-center text-muted">
                                                                            <i class="fas fa-user-tie me-2"></i>
                                                                            <span>Responsable: <strong>{{ $checkout->responsable->name ?? 'N/A' }}</strong></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="d-flex align-items-center text-muted">
                                                                            <i class="far fa-calendar-alt me-2"></i>
                                                                            <span>{{ \Carbon\Carbon::parse($checkout->created_at)->translatedFormat('d/m/Y H:i') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                @if($checkout->commentaire)
                                                                    <div class="mt-2 p-2 bg-light rounded small">
                                                                        <i class="fas fa-quote-left text-muted me-1"></i>
                                                                        <em class="text-muted">{{ $checkout->commentaire }}</em>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            
                                                            <!-- Partie droite : actions -->
                                                            <div class="d-flex gap-2">
                                                                <button type="button" class="btn btn-outline-primary btn-sm" 
                                                                    wire:click="visualisercheckout({{ $checkout->id }})"
                                                                    data-bs-toggle="modal" data-bs-target="#checkoutview"
                                                                    title="Voir détails">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                                                    wire:click="openDeleteConfirmation({{ $checkout->id }})"
                                                                    title="Supprimer">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <div class="text-center py-5">
                                                    <div class="mb-4">
                                                        <i class="fas fa-history fa-4x text-muted opacity-50"></i>
                                                    </div>
                                                    <h6 class="text-muted mb-3">Aucun historique trouvé</h6>
                                                    @if($historiqueFiltreStatut || $historiqueSearch)
                                                        <p class="small text-muted mb-3">Essayez de modifier vos filtres de recherche</p>
                                                        <button class="btn btn-outline-primary btn-sm" wire:click="resetFilters">
                                                            <i class="fas fa-undo me-1"></i>Réinitialiser les filtres
                                                        </button>
                                                    @else
                                                        <p class="small text-muted">Aucun checkout n'a encore été créé</p>
                                                        <button class="btn btn-primary btn-sm" id="toggleSidebar">
                                                            <i class="fas fa-plus me-1"></i>Nouveau checkout
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>

                                    <!-- Pagination -->
                                    @if($historiqueCheckouts instanceof \Illuminate\Pagination\LengthAwarePaginator && $historiqueCheckouts->hasPages())
                                        <div class="d-flex justify-content-between align-items-center mt-4">
                                            <div class="text-muted small">
                                                Affichage de {{ $historiqueCheckouts->firstItem() }} à {{ $historiqueCheckouts->lastItem() }} 
                                                sur {{ $historiqueCheckouts->total() }} résultats
                                            </div>
                                            <div>
                                                {{ $historiqueCheckouts->links() }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de détails checkout -->
    <div wire:ignore.self class="modal fade" id="checkoutview" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Détails du checkout</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if($selectedCheckouts)
                        <div class="container-fluid">
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Type d'équipement :</div>
                                <div class="col-md-8 text-capitalize">{{ $selectedCheckouts->materiel_type }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Matériel :</div>
                                <div class="col-md-8">
                                    @if($selectedCheckouts->materiel_type == 'ordinateur' && $selectedCheckouts->ordinateur)
                                        {{ $selectedCheckouts->ordinateur->nom }} ({{ $selectedCheckouts->ordinateur->os_version }})
                                    @elseif($selectedCheckouts->materiel_type == 'telephone' && $selectedCheckouts->telephone)
                                        {{ $selectedCheckouts->telephone->nom }} ({{ $selectedCheckouts->telephone->marque }})
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Date de création :</div>
                                <div class="col-md-8">
                                    {{ \Carbon\Carbon::parse($selectedCheckouts->created_at)->translatedFormat('d/m/Y H:i') }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Statut :</div>
                                <div class="col-md-8">
                                    <span class="badge {{ $this->getStatutBadgeClass($selectedCheckouts->statut) }} p-2">
                                        {{ $this->getStatutLabel($selectedCheckouts->statut) }}
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Commentaire :</div>
                                <div class="col-md-8">
                                    {{ $selectedCheckouts->commentaire ?? 'Aucun commentaire' }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Confirmation de suppression
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="fas fa-trash-alt fa-4x text-danger mb-3"></i>
                    <h5 class="mb-3">Êtes-vous sûr de vouloir supprimer ?</h5>
                    <p class="text-muted mb-0">
                        Cette action est irréversible.<br>
                        @if($itemToDelete)
                            <span class="fw-bold text-danger">
                                #{{ $itemToDelete->id }} - {{ $itemToDelete->materiel_type }}
                            </span>
                        @endif
                    </p>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="button" class="btn btn-danger px-4" 
                        wire:click="confirmDelete" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="confirmDelete">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </span>
                        <span wire:loading wire:target="confirmDelete">
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Suppression...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts et Styles -->
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .materiel-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .materiel-item:hover {
            background-color: #e9ecef !important;
            transform: translateY(-2px);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
        /* Styles pour l'historique */
        .hover-card {
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }
        .hover-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
            border-color: #0d6efd;
        }
        
        /* Badges de statut */
        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #000 !important;
        }
        .badge.bg-success {
            background-color: #198754 !important;
            color: #fff !important;
        }
        .badge.bg-info {
            background-color: #0dcaf0 !important;
            color: #000 !important;
        }
        .badge.bg-secondary {
            background-color: #6c757d !important;
            color: #fff !important;
        }
        
        /* Menu déroulant des filtres */
        .dropdown-item.active {
            background-color: #e9ecef;
            color: #000;
        }
        .dropdown-item .badge {
            font-size: 0.85rem;
        }
        
        /* Animation de chargement */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
        }
        
        /* Modal */
        .modal.fade .modal-dialog {
            transform: scale(0.8);
            transition: transform 0.3s ease-in-out;
        }
        .modal.show .modal-dialog {
            transform: scale(1);
        }
        
        /* Pagination */
        .pagination {
            margin-bottom: 0;
        }
        .page-link {
            padding: 0.375rem 0.75rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .d-flex.flex-wrap {
                flex-direction: column;
                gap: 10px;
            }
            .input-group {
                width: 100% !important;
            }
            .row.g-2 > [class*="col-"] {
                margin-bottom: 5px;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Gestion du modal de suppression
            Livewire.on('openDeleteModal', () => {
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                deleteModal.show();
            });

            Livewire.on('closeDeleteModal', () => {
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModal'));
                if (deleteModal) {
                    deleteModal.hide();
                }
            });

            Livewire.on('itemDeleted', () => {
                // Notification toast si disponible
                if (typeof toastr !== 'undefined') {
                    toastr.success('Suppression effectuée avec succès');
                }
            });

            Livewire.on('checkoutCreated', () => {
                // Fermer la sidebar après création
                document.getElementById('sidebar').classList.remove('show');
            });

            // Gestion de la sidebar
            const toggleSidebar = document.getElementById('toggleSidebar');
            if (toggleSidebar) {
                toggleSidebar.addEventListener('click', () => {
                    document.getElementById('sidebar').classList.toggle('show');
                });
            }

            const closeSidebar = document.getElementById('closeSidebar');
            if (closeSidebar) {
                closeSidebar.addEventListener('click', () => {
                    document.getElementById('sidebar').classList.remove('show');
                });
            }
        });
    </script>
    @endpush
</div>