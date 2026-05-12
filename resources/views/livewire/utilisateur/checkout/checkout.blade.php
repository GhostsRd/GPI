<div style="margin-top:5% " class=" border container-fluid mt-5   parallax-section  bg-md-white-cust ">
    <div wire:ignore.self class="sidebar checkoutmenu  rounded-3 text-dark card bg-white p-0   mt-4" id="sidebar">
        <div>
            <div>
                <div>
                    <!-- Header -->
                    <div class=" border-bottom">
                        <h4 class="modal-title mx-2 my-2 text-dark" id="ordinateurModalLabel">Nouveau checkout</h4>
                    </div>

                    <!-- Formulaire Livewire -->

                    <div class="modal-body p-2 row" style="max-height:400px;overflow-y: scroll">
                        <!-- Sujet -->
                        {{-- <p class="text-dark mb-3">Les champs indiqués <span class="text-danger">*</span> sont
                            obligatoires</p> --}}

                        <div class="mb-3  position-relative">

                            @error('sujet')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="etap_validation ">
                            <label for="sujet" class="form-label text-dark">
                                Choisir le matériel <span class="text-danger">*</span>
                            </label>

                            <div class="etap {{ $etape[1] }} ">
                                <a href="#" wire:click="$set('valeur1', 'ordinateur')" data-aos-duration="400"
                                    class=" {{ $valeur1 == 'ordinateur' ? ' shadow-lg fw-bold' : 'shadow-sm' }} nav-link text-dark card   "
                                    aria-current="true">

                                    <div class="d-flex w-100 justify-content-between">
                                        <label class="text-dark"> Ordinateur </label>

                                        <small class="text-body-secondary">En stock</small>
                                    </div>
                                </a>
                                <a href="#" wire:click="$set('valeur1', 'Telephone')" data-aos-duration="400"
                                    class=" {{ $valeur1 == 'Telephone' ? ' shadow-lg  fw-bold' : 'shadow-sm' }} nav-link text-dark card border-0 rounded-2 mb-1">

                                    <div class="d-flex w-100 justify-content-between">
                                        <label class="text-dark"> Telephone </label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>

                                </a>
                                <a href="#" wire:click="$set('valeur1', 'Peripherique')" data-aos-duration="400"
                                    class=" {{ $valeur1 == 'Peripherique' ? ' shadow-lg fw-bold' : 'shadow-sm' }} card text-dark border-0 rounded-2 mb-1 nav-link">

                                    <div class="d-flex w-100 justify-content-between">
                                        <label class="text-dark"> Peripherique </label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>

                                </a>

                                <div class="mt-4 border-bottom py-1">
                                    <button wire:click.prevent="next_form(2)"
                                        class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Suivant
                                    </button>
                                </div>
                            </div>

                            {{-- etape 2 page telephone --}}

                            <div class="etap {{ $etape[2] }}">
                                <a href="#" data-aos-duration="400" wire:click="$set('valeur2', 'Touche')"
                                    class="nav-link {{ $valeur2 == 'Touche' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} card border rounded-2 mb-1">

                                    <div class=" d-flex w-100 justify-content-between">
                                        <label class="text-dark"> Telephone Touche -</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>

                                </a>

                                <a data-aos-duration="400" wire:click="$set('valeur2', 'Android')" href="#"
                                    class="nav-link {{ $valeur2 == 'Android' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} card border rounded-2 mb-1">

                                    <div class="d-flex w-100 justify-content-between">
                                        <label class="text-dark"> Telephone Android -</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>

                                </a>

                                <a wire:click="$set('valeur2', 'Tablette')" href="#"
                                    class="nav-link {{ $valeur2 == 'Tablette' ? 'shadow-lg fw-bold text-white' : 'shadow-sm' }} card border rounded-2 mb-1">

                                    <div class=" d-flex w-100 justify-content-between">
                                        <label class="text-dark"> Telephone Tablette -</label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>

                                </a>
                                <div class="mt-4 border-bottom py-1">
                                    <button wire:click="next_form(1)"
                                        class="btn btn-outline-white  fw-bold border  px-3  btn-sm  shadow-sm">
                                        Precedent</button>
                                    <button wire:click="next_form(5)"
                                        class="btn btn-two btn-sm text-white fw-bold border  px-3  btn-sm  shadow-sm">Suivant
                                    </button>
                                </div>
                            </div>

                            {{-- etape 4 peripherique --}}


                            <div class="etap {{ $etape[4] }}">
                                <a wire:click="$set('valeur2', 'Regulateur')" href="#"
                                    class="{{ $valeur2 == 'Regulateur' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">

                                    <div class="d-flex w-100 justify-content-between">
                                        <label class="text-dark"> Regulateur
                                        </label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>

                                </a>

                                <div class="list-group">

                                    <!-- Ordinateur -->


                                    <!-- Clavier -->
                                    <a wire:click="$set('valeur2', 'Clavier')" href="#"
                                        class="{{ $valeur2 == 'Clavier' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Clavier </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Souris -->
                                    <a wire:click="$set('valeur2', 'Souris')" href="#"
                                        class="{{ $valeur2 == 'Souris' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Souris </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Webcam -->
                                    <a wire:click="$set('valeur2', 'Webcam')" href="#"
                                        class="{{ $valeur2 == 'Webcam' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Webcam </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Casque -->
                                    <a wire:click="$set('valeur2', 'Casque')" href="#"
                                        class="{{ $valeur2 == 'Casque' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Casque </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Scanner -->
                                    <a wire:click="$set('valeur2', 'Scanner')" href="#"
                                        class="{{ $valeur2 == 'Scanner' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Scanner </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Câble -->
                                    <a wire:click="$set('valeur2', 'Cable')" href="#"
                                        class="{{ $valeur2 == 'Cable' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Câble </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- USB -->
                                    <a wire:click="$set('valeur2', 'USB')" href="#"
                                        class="{{ $valeur2 == 'USB' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> USB </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Jabra -->
                                    <a wire:click="$set('valeur2', 'Jabra')" href="#"
                                        class="{{ $valeur2 == 'Jabra' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Jabra </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Powerbank -->
                                    <a wire:click="$set('valeur2', 'Powerbank')" href="#"
                                        class="{{ $valeur2 == 'Powerbank' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Powerbank </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Chargeur -->
                                    <a wire:click="$set('valeur2', 'Chargeur')" href="#"
                                        class="{{ $valeur2 == 'Chargeur' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Chargeur </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- APN -->
                                    <a wire:click="$set('valeur2', 'APN')" href="#"
                                        class="{{ $valeur2 == 'APN' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link  card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> APN </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                    <!-- Appareil Photo -->

                                    <a wire:click="$set('valeur2', 'Appareil Photo')" href="#"
                                        class="{{ $valeur2 == 'Appareil Photo' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Appareil Photo </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>
                                    <!-- Dominos -->
                                    <a wire:click="$set('valeur2', 'Dominos')" href="#"
                                        class="{{ $valeur2 == 'Dominos' ? 'shadow-lg fw-bold ' : 'shadow-sm' }} nav-link card border rounded-2 mb-1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="text-dark"> Dominos </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>
                                    </a>

                                </div>



                                <div class="">
                                    <button wire:click="next_form(1)"
                                        class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Precedent</button>
                                    <button wire:click="next_form(5)" type="submit"
                                        class="btn btn-two btn-sm text-white fw-bold border  px-3  btn-sm  shadow-sm">Valider</button>
                                </div>
                            </div>

                            {{-- validatation de l'etape --}}

                            <div class="etap py-2 {{ $etape[5] }}">
                                <h5 class="text-dark">Vos selection</h5>
                                <a href="#" data-aos="fade-down" data-aos-duration="400"
                                    class="py-2 list-group-item list-group-item-action border rounded-2 mb-1">

                                    <div class="d-flex py-2 px-1 w-100 justify-content-between">
                                        <label class="text-dark"> 1 - {{ $valeur1 }} </label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>

                                </a>


                                <a href="#" data-aos="fade-down" data-aos-duration="400"
                                    class="{{ $valeur2 ?? 'collapse' }} py-2 list-group-item list-group-item-action border rounded-2 mb-1">

                                    <div class="d-flex py-2  px-1 w-100 justify-content-between">
                                        <label class="text-dark"> 2 - {{ $valeur2 }} </label>
                                        <small class="text-body-secondary">En stock</small>
                                    </div>

                                </a>
                                <div class="">
                                    <button wire:click="next_form(1)"
                                        class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Retour</button>
                                    <button type="submit" wire:click="EnvoyerCheckout"
                                        class="btn btn-two btn-sm text-white   fw-bold btn-xs-sm btn-xs-sm  shadow-sm ">
                                        Envoyer


                                    </button>
                                </div>
                            </div>

                        </div>

                        <!-- Étape 1 -->

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-one  text-white fw-bold text-sm rounded px-3"
                            id="closeSidebar">Annuler</button>
                        {{-- <button type="submit" wire:click="EnvoyerCheckout"
                            class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Envoyer</button>
                        --}}
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div wire:ignore.self class="container-fluid main-content mt-md-3 mt-lg-3">

        <div class="row col-lg-11  offset-xs-0 offset-0  col-12">
            {{-- ici le menu --}}
            <div class="col-lg-2 bg-light py-1 px-0 d-md-block d-xl-block d-none">


                @livewire('component.menu-utilisateur')
                
            </div>

            {{-- ici le contente right --}}

            <div class="mt-2 p-xs-0 p-0 p-md-0 p-xl-2 offset-lg-1  col-lg-8 bg-white rounded-2"
                style="max-height:100vh;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
                 <div wire:loading.flex
        class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 justify-content-center align-items-center"
        style="z-index: 10;">
        <div class="text-center">
            <div class="spinner-border text-secondary" role="status" style="width: 3rem; height: 3rem;"></div>
            <p class="mt-2 fw-bold text-secondary">Chargement ...</p>
        </div>
    </div>
                <div class="row align-items-end mb-4">
                    <div class="col-lg-8 col-7">
                        <div class="ms-lg-4 ms-2">
                            <h4 class="fw-bold text-soft mb-1 d-none d-md-block">Checkout & In</h4>
                            <h5 class="fw-bold text-soft mb-1 d-block d-md-none">Mes Checkouts</h5>

                            <span class="text-subtle small">Vue d'ensemble de vos demandes de matériel</span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-5 text-end">
                        <div class="me-lg-2">
                            <div wire:click="disableRecente"
                                class="d-none d-md-inline-flex align-items-center fw-bold text-primary-pivot btn-action-soft"
                                style="cursor:pointer; font-size: 0.85rem;">
                                <i class="fas {{ $disabled ? 'fa-eye' : 'fa-eye-slash' }} me-2"></i>
                                {{ $disabled ? 'Afficher Récente' : 'Masquer Récente' }}
                            </div>

                            <span class="d-inline-block d-md-none fw-bold text-primary-pivot p-2"
                                style="cursor:pointer; font-size: 0.9rem;" id="toggleSidebar">
                                <i class="fas fa-plus-circle me-1"></i> Nouveau
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12  mx-lg-4 mx-md-4  ">
                    <div class="{{ $disabled ? 'd-none' : 'd-block' }}">

                        <div class="row border-top mx-2 col-lg-11 mt-2">
                            <div class="col-lg-6 ">

                                <h5 class=" py-2 px-2 d-flex justify-content-between">Récente</h5>
                            </div>



                        </div>
                        <div class="row p-0 mx-3 ">
                            @foreach ($checkoutrecentes as $checkoutrecente)

                            <div class="col-12 mb-3">
                                <div class="card border-0 shadow-sm rounded-4 hover-shadow transition-all position-relative overflow-hidden"
                                    style="background: #ffffff;">

                                    <div class="position-absolute top-0 start-0 bottom-0"
                                        style="width: 4px; opacity: 0.6; background-color: #0d6efd;"></div>

                                    <div class="card-body p-3 ps-4">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="d-flex align-items-center flex-grow-1" style="min-width: 0;">
                                                @php
                                                // On utilise ici la photo de l'utilisateur qui a fait le checkout
                                                $photoUser = optional($checkoutrecente->utilisateur)->photo;
                                                @endphp

                                                <div class="position-relative flex-shrink-0">
                                                    <img src="{{ $photoUser ? asset('storage/' . $photoUser) : 'https://ui-avatars.com/api/?name='.urlencode($checkoutrecente->utilisateur->nom ?? 'none').'&background=0D6EFD&color=fff' }}"
                                                        alt="Profil" width="46" height="46"
                                                        class="rounded-circle border border-2 border-white shadow-sm object-fit-cover">
                                                    <span
                                                        class="position-absolute bottom-0 end-0 p-1 bg-primary border border-2 border-white rounded-circle shadow-sm"></span>
                                                </div>

                                                <div class="ms-3 text-truncate">
                                                    <h6 class="mb-0  text-soft text-truncate"
                                                        style="font-size: 0.95rem;">
                                                        {{ $checkoutrecente->materiel_type ?? 'Matériel non spécifié' }}
                                                    </h6>
                                                    <p class="text-subtle mb-0 small text-truncate"
                                                        style="max-width: 450px;">
                                                        <span class="fw-medium text-dark">{{
                                                            $checkoutrecente->utilisateur->nom ?? 'Inconnu' }}</span>
                                                        • {{ $checkoutrecente->materiel_details ?? 'Aucun détail' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center ms-4">
                                                <div class="text-end me-3 d-none d-md-block border-end pe-3">
                                                    <small class="text-subtle d-block mb-1"
                                                        style="font-size: 0.7rem; font-weight: 500;">
                                                        <i class="far fa-clock me-1 text-primary"></i>
                                                        {{
                                                        \Carbon\Carbon::parse($checkoutrecente->created_at)->diffForHumans()
                                                        }}
                                                    </small>
                                                    <span
                                                        class="badge rounded-pill bg-light text-primary border px-2 py-1"
                                                        style="font-size: 0.7rem;">
                                                        <i class="fas fa-sign-out-alt me-1"></i> Sortie
                                                    </span>
                                                </div>

                                                <button
                                                    class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                                    style="width: 32px; height: 32px; transition: all 0.3s ease;">
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
                    </div>
                    <div class="mt-4  col-lg-11 p-0">
                        {{-- <ul class="nav mx-2 nav-tabs  text-secondary" id="myTab" role="tablist">
                            <li class="nav-item text-dark" role="presentation">
                                <button class="nav-link  active" style="color: rgb(53, 53, 53) !important"
                                    id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button"
                                    role="tab" aria-controls="active" aria-selected="true">
                                    Check in/out
                                </button>
                            </li>
                            <li class="nav-item  active text-dark" role="presentation">
                                <button class="nav-link text-dark" style="color: rgb(53, 53, 53) !important"
                                    id="link1-tab" data-bs-toggle="tab" data-bs-target="#link1" type="button" role="tab"
                                    aria-controls="link1" aria-selected="false">
                                    Reserver une equipement
                                </button>
                            </li>
                            <li class="nav-item d-none d-md-block d-lg-block   text-dark" role="presentation">
                                <button class="nav-link text-dark" style="color: rgb(53, 53, 53) !important"
                                    id="link2-tab" data-bs-toggle="tab" data-bs-target="#link2" type="button" role="tab"
                                    aria-controls="link1" aria-selected="false">
                                    Historique de vos reservation
                                </button>
                            </li>


                        </ul> --}}

                        <div class="tab-content border-0 p-2  border-top-0" id="myTabContent">
                            <div class="tab-pane fade show active " id="active" role="tabpanel"
                                aria-labelledby="active-tab">

                                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                    <div class="py-2">
                                        <label class="fw-bold text-soft mb-0 d-none d-md-block"
                                            style="font-size: 0.9rem;">
                                            Historique des checkouts
                                        </label>
                                        <label class="fw-bold text-soft mb-0 d-block d-md-none"
                                            style="font-size: 0.85rem;">
                                            Checkouts
                                        </label>
                                    </div>

                                    <div class="d-flex align-items-center gap-2">
                                        <div class="position-relative d-none d-lg-block">
                                            <span
                                                class="position-absolute top-50 start-0 translate-middle-y ps-2 text-subtle">
                                                {{-- <i class="fas fa-search" style="font-size: 0.75rem;"></i> --}}
                                            </span>
                                            <input type="text" wire:model.live.debounce.300ms="rechercheCheckout"
                                                class="form-control form-control-sm border-0 bg-light rounded-pill ps-4"
                                                placeholder="Rechercher..." style="font-size: 0.75rem; width: 150px;">
                                        </div>

                                        <div
                                            class="d-flex align-items-center shadow-sm rounded-pill px-3 py-1 bg-white">
                                            <span class="text-subtle fw-bold me-1"
                                                style="font-size: 0.7rem; text-transform: uppercase;">Filtre :</span>
                                            <select wire:model.live="filtrerCheckout"
                                                class="border-0 bg-transparent text-soft fw-semibold small outline-none"
                                                style="cursor: pointer;">
                                                <option value="">Tous</option>
                                                <option value="1">En cours</option>
                                                <option value="2">Validé</option>
                                                <option value="3">Résolu</option>
                                                <option value="4">Fermé</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group mt-2  bg-white " style="max-height:700px;overflow-y: scroll">
                                    @if ($checkouts)
                                    @foreach ($checkouts as $checkout)
                                    <a wire:click="visualisercheckout({{ $checkout->id }})" data-bs-toggle="modal"
                                        data-bs-target="#checkoutview" data-aos="fade-down" data-aos-duration="400"
                                        data-aos-delay="{{ $loop->index * 100 }}"
                                        class="list-group-item  list-group-item-action border-0 mb-2 shadow-sm rounded-3 p-3 transition-hover bg-white">

                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="flex-grow-1 me-3" style="min-width: 0;">
                                                <div class="d-flex align-items-center mb-1">
                                                    {{-- <span class="text-subtle me-2 fw-bold"
                                                        style="font-size: 0.8rem;">#{{ $checkout->id }}</span> --}}
                                                    <span class="text-soft text-capitalize text-truncate-single"
                                                        style="font-size: 0.95rem;">
                                                        {{ $checkout->materiel_type }}
                                                    </span>
                                                </div>

                                                <div class="text-subtle text-truncate-single small"
                                                    style="opacity: 0.8;">
                                                    {{ $checkout->materiel_details }}
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center shrink-0">
                                                <span
                                                    class="badge-pivot-soft status-checkout-{{ $checkout->statut }} me-3"
                                                    style="font-size: 0.6rem;">
                                                    {{ $checkout->statut == 1 ? 'En cours' : ($checkout->statut == 2 ?
                                                    'Validé' : 'Fermé') }}
                                                </span>

                                                <div class="d-flex align-items-center  ps-3">
                                                    <div class="text-end me-2 d-none d-lg-block">
                                                        <div class="text-subtle" style="font-size: 0.65rem;">
                                                            {{
                                                            \Carbon\Carbon::parse($checkout->created_at)->diffForHumans()
                                                            }}
                                                        </div>
                                                    </div>

                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($checkout->utilisateur->nom) }}&background=f1f5f9&color=64748b"
                                                        alt="Profil" width="26" height="26"
                                                        class="rounded-circle border border-2 border-white shadow-sm"
                                                        title="{{ $checkout->utilisateur->nom }}">
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                    @endforeach

                                    @else
                                    <p class="mt-4 text-center p-4">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" width="80"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>
                                        <br>
                                        <br>

                                        <span class="my-4">Aucun checkout trouvé </span>
                                        <br>

                                        <br>
                                        <button class="btn btn-light px-4">Nouveau chekout</button>
                                    </p>


                                    @endif
                                    <div class="mt-4 text-small d-flex justify-content-center">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border-0 " id="link1" role="tabpanel" aria-labelledby="link1-tab">
                                <div class=" p-xs-0  mx-1  p-0 p-md-0 p-xl-2  ">

                                    <div class="">
                                        <label class="py-2 mt-3">Choisir le materiel</label>
                                    </div>


                                    <div class="list-group mt-2 " style="max-height: 400px;overflow-y: scroll">
                                        @foreach ($ordinateurs as $ordinateur)
                                        <a href="#" wire:click="openCalendrier('ordinateur',{{ $ordinateur->id }})"
                                            title="Voir la disonibilite"
                                            class="list-group-item list-group-item-action border-0 border-bottom ">
                                            <div class="d-flex w-100 justify-content-between">
                                                <b class="mb-1 text-black-50"> {{ $ordinateur->nom }}</b>
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
                                                    <svg width="12" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6 text-success">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                                    </svg>
                                                    4 {{ $ordinateur->state }} {{ $ordinateur->os_version }}
                                                </small>
                                                <small class="text-body-secondary  ">
                                                    {{--
                                                    <button type="button"
                                                        wire:click="openCalendrier('ordinateur',{{ $ordinateur->id }})"
                                                        class="btn btn-sm border-0 btn-light" data-bs-toggle="modal"
                                                        data-bs-target="#calendarModal">
                                                        📅 Voir le disponibite
                                                    </button> --}}

                                                </small>
                                            </div>

                                            {{-- <small class="text-body-secondary">And some muted small print.</small>
                                            --}}
                                        </a>
                                        @endforeach


                                    </div>


                                </div>

                            </div>


                            <div class="tab-pane fade border-0 d-none d-md-block d-lg-block" id="link2" role="tabpanel"
                                aria-labelledby="link2-tab">
                                <div class=" p-xs-0  mx-1  p-0 p-md-0 p-xl-2  ">

                                    <div class="">
                                        <label class="py-2 mt-3">Historique de vos reservation</label>
                                    </div>


                                    <div class="list-group mt-2 " style="max-height: 400px;overflow-y: scroll">
                                        @foreach ($matreservations as $materiel)
                                        <a href="#" wire:click="visualiser( {{ $materiel->id }})"
                                            title="Voir le details"
                                            class="list-group-item list-group-item-action border-0 border-bottom ">
                                            <div class="d-flex w-100 justify-content-between">
                                                <b class="mb-1 text-black-50 text-capitalize"> {{
                                                    $materiel->equipement_type }} </b>
                                                <span class="text-muted fw-6">{{
                                                    \Carbon\Carbon::parse($materiel->date_debut)->translatedFormat('d M
                                                    Y ') }} - {{
                                                    \Carbon\Carbon::parse($materiel->date_fin)->translatedFormat('d M Y
                                                    ') }}</span>
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
                                                    Le {{
                                                    \Carbon\Carbon::parse($materiel->created_at)->translatedFormat('d M
                                                    Y H:i') }}
                                                </small>
                                                <small
                                                    class=" {{ $materiel->statut == 0 ? 'text-danger' : 'text-body-secondary' }} justify-content-end  ">
                                                    {{ match($materiel->statut) {
                                                    0 => 'Demande d\'annulation en cours',
                                                    1 => 'CREE',
                                                    2 => 'VALIDER',
                                                    3 => 'EN COURS',
                                                    4 => 'RENDU',
                                                    5 => 'ARCHIVER',
                                                    default => 'CREE',
                                                    } }}

                                                </small>
                                            </div>

                                            {{-- <small class="text-body-secondary">And some muted small print.</small>
                                            --}}
                                        </a>
                                        @endforeach


                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">

                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->

    <div wire:ignore.self class="modal fade" id="checkoutview" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="modal-header border-0 py-3 px-4 bg-light">
                    <div class="d-flex align-items-center">
                        <div class="bg-white p-2 rounded-3 shadow-sm me-3">
                            <i class="fas fa-receipt text-primary"></i>
                        </div>
                        <div>
                            <h6 class="modal-title fw-bold text-soft mb-0">Détails de l'opération</h6>
                            <small class="text-subtle">Référence #{{ $selectedCheckouts?->id }}</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                        <div>
                            <span class="text-subtle small d-block mb-1 text-uppercase fw-bold"
                                style="font-size: 0.65rem; letter-spacing: 0.5px;">État actuel</span>
                            <span class="badge-pivot-soft status-checkout-{{ $selectedCheckouts?->statut }}">
                                {{ $selectedCheckouts?->statut == 1 ? 'EN COURS' : ($selectedCheckouts?->statut == 2 ?
                                'VALIDÉ' : 'FERMÉ') }}
                            </span>
                        </div>
                        <div class="text-end">
                            <span class="text-subtle small d-block mb-1 text-uppercase fw-bold"
                                style="font-size: 0.65rem; letter-spacing: 0.5px;">Date d'émission</span>
                            <span class="text-soft fw-bold" style="font-size: 0.85rem;">{{
                                $selectedCheckouts?->created_at?->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-subtle small fw-bold text-uppercase mb-2 d-block"
                            style="font-size: 0.65rem;">Équipement sollicité</label>
                        <div class="p-3 rounded-3 border bg-white">
                            <p class="text-soft fw-bold mb-1">{{ $selectedCheckouts?->materiel_type }}</p>
                            <p class="text-subtle small mb-0">{{ $selectedCheckouts?->materiel_details }}</p>
                        </div>
                    </div>

                    <div class="p-3 rounded-4 d-flex align-items-center"
                        style="background-color: #f8fafc; border: 1px solid #eef2f6;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($selectedCheckouts?->utilisateur?->nom) }}&background=5BC4BF&color=fff"
                            class="rounded-circle me-3 border border-2 border-white shadow-sm" width="40" height="40">
                        <div class="overflow-hidden">
                            <label class="text-subtle small fw-bold text-uppercase d-block"
                                style="font-size: 0.6rem;">Demandeur</label>
                            <span class="text-soft fw-bold d-block text-truncate">{{
                                $selectedCheckouts?->utilisateur?->nom }}</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-link text-subtle text-decoration-none fw-bold me-auto"
                        data-bs-dismiss="modal">Fermer</button>

                    @if($selectedCheckouts?->statut == 1)
                    <button type="button" wire:click="annulationDemande({{ $selectedCheckouts->id }})"
                        class="btn btn-danger px-4 fw-bold shadow-sm rounded-3" style="font-size: 0.85rem;">
                        Annuler la demande
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>



</div>

<style>
    .modal-content {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .modal-backdrop.show {
        background-color: rgba(0, 0, 0, 0.2) !important;
        /* 0.2 = plus clair */
    }



    #wrap {
        width: 1100px;
        margin: 0 auto;
    }

    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
    }

    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
    }

    .external-event {
        /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
    }

    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
    }

    #external-events p input {
        margin: 0;
        vertical-align: middle;
    }

    #calendar {
        /* 		float: right; */
        margin: 0 auto;
        width: 900px;
        background-color: #FFFFFF;
        border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
    }
</style>
<script>
    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        /*  className colors

        className: default(transparent), important(red), chill(pink), success(green), info(blue)

        */


        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
        -----------------------------------------------------------------*/

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'agendaDay,agendaWeek,month',
                right: 'prev,next today'
            },
            editable: true,
            firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: true,
            defaultView: 'month',

            axisFormat: 'h:mm',
            columnFormat: {
                month: 'ddd', // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d', // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
            },
            allDaySlot: false,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent', {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },

            events: [


                @foreach ($events as $event)
                    {


                        title: "{{ $event->ordinateur->nom }}",
                        start: "{{ $event->date_debut }}",
                        end: "{{ $event->date_fin }}",
                        url: "{{ $event->url ?? '#' }}",
                        className: "success"


                    }
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach

            ],
        });


    });
</script>

<script>
    document.addEventListener('livewire:load', () => {
        Livewire.on('openModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('centeredModalreservation'));
            modal.show();
        });
    });

    document.addEventListener('livewire:load', () => {
        Livewire.on('openCalendrier', () => {
            const modal = new bootstrap.Modal(document.getElementById('calendarModal'));
            modal.show();
        });
    });
</script>