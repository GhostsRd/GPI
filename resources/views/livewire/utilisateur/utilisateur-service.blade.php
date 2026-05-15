<div style="margin-top:5%" class=" bg-md-white-cust ">

    <div wire:ignore.self class="sidebar  rounded-3 text-dark card bg-light p-0  colg-lg-3 mt-4 " id="sidebar">

        <!-- Header -->
        <div class=" border-bottom">
            <h5 class="modal-title mx-2 my-2 text-dark fw-bold" id="ticketModalLabel">Créer un ticket</h5>

        </div>

        <!-- Formulaire Livewire -->
        <form wire:submit.prevent="store">
            <div class="modal-body row ">
                <!-- Sujet -->
                <p class="text-muted mb-3 mt-3">Tous les champs sont
                    obligatoires</p>

                <div class="mb-3 ">

                    <textarea type="text" placeholder="Quelle est le sujet de votre ticket ?"
                        class=" modern-textarea  py-1  @error('sujet') is-invalid border-danger  @enderror" id="sujet"
                        wire:model.debounce.500ms="sujet">

                    </textarea>
                    @error('sujet')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Détails -->
                <div class="mb-3 ">

                    <textarea type="text" placeholder="Ex: Details de votre ticket"
                        class="modern-textarea py-1  @error('details') is-invalid border-danger @enderror" id="details"
                        wire:model.debounce.500ms="details" rows="2"></textarea>
                    @error('details')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if (!empty($details))
                <div class="border-top border-2 mb-4">
                </div>
                <div class="mb-3  col-12 ">
                    <label for="categorie" class="form-label fw-bold text-muted">Catégorie <span
                            class="text-danger">*</span></label>




                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="categorie"
                            class="modern-textarea py-2 px-1 form-select-sm ps-5 text-muted border-0 border-bottom @error('categorie') is-invalid border-danger @enderror"
                            wire:model="categorie" wire:change="steps2">
                            <option value="" class="text-left"> Sélectionner une catégorie </option>
                            <option value="Réseau">Réseau</option>
                            <option value="Logiciel" class="text-left">Logiciel</option>
                            <option value="Matériel">Matériel</option>
                            <option value="Sécurité">Sécurité</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    @error('categorie')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3  col-12">
                    <label for="impact" class="form-label fw-bold text-muted mb-2">Impact <span
                            class="text-danger">*</span></label>
                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="categorie"
                            class="modern-textarea py-2 px-1 form-select-sm ps-5 text-muted border-0 border-bottom @error('impact') is-invalid @enderror"
                            wire:model="impact" wire:change="steps2">
                            <option value="" class="text-left"> Sélectionner l'impact</option>

                            <option value="Utilisateur">Un utilisateur ou un groupe</option>
                            <option value="Service">Un service ou département</option>
                            <option value="Organisation">Toute l’organisation</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    @error('impact')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror



                </div>
                <!-- Priorité -->
                <div class="mb-3  col-12">
                    <label for="priorite" class="form-label fw-bold text-muted">Priorité</label>
                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="priorite"
                            class="modern-textarea py-2 px-1 form-select-sm ps-5 text-muted border-0 border-bottom @error('priorite') is-invalid @enderror"
                            wire:model="priorite" wire:change="steps2">
                            <option value="" class="text-left"> Sélectionner </option>


                            <option value="Basse">Basse</option>
                            <option value="Normale">Normale</option>
                            <option value="Haute">Urgent</option>
                            <option value="Critique">Critique</option>
                        </select>
                    </div>

                    @error('priorite')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-12">
                    <label for="equipement" class="form-label fw-bold text-muted">Équipement <span
                            class="text-danger">*</span></label>

                    <div class="position-relative">
                        <i class="bi bi-list position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <select id="equipement"
                            class="modern-textarea py-2 px-1 form-select-sm ps-5 text-muted border-0 border-bottom @error('equipement') is-invalid @enderror"
                            wire:model="equipement" wire:change="steps2">
                            <option value="" class="text-left"> Sélectionner un équipement </option>

                            <option value="PC">PC</option>
                            <option value="Imprimante">Imprimante</option>
                            <option value="Routeur">Routeur</option>
                            <option value="Switch">Switch</option>
                            <option value="Serveur">Serveur</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>


                    @error('equipement')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif

            </div>

            <!-- Footer -->
            <div class="modal-footer border-top py-1 ">
                <button type="button" class="btn btn-outline-light text-dark border px-3 "
                    id="closeSidebar">Quitter</button>
                <button type="submit" class="btn m-1   fw-bold border px-3  btn-two text-white  shadow-sm">Envoyer
                    <div wire:loading wire:target="store">...</div>
                </button>
            </div>
        </form>

    </div>

    <div class="container-fluid  ">
        <div class="row col-lg-11  offset-xs-0 col-12">
            <div class="col-lg-2 bg-lg-light bg-md-light py-1 px-0 d-md-none   d-xl-block d-none">
                @livewire('component.menu-utilisateur')
            </div>
            <div class="mt-2 p-xs-0 p-0 p-md-0 p-xl-2 offset-lg-1 shadow-sm  py-5 col-lg-8 bg-white rounded-2"
                style="max-height:100vh;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">

                <div class="row align-items-end mb-4">
                    <div class="col-8 col-lg-6">
                        <div class="ms-md-4">
                            <h4 class="fw-bold text-soft mb-1 d-none d-md-block">Mes tickets</h4>
                            <h5 class="fw-bold text-soft mb-1 d-block d-md-none">Mes tickets</h5>
                            <p class="text-subtle mb-0 small" style="letter-spacing: 0.3px;">
                                Gestion et suivi de votre activité
                            </p>
                        </div>
                    </div>

                    <div class="col-4 col-lg-6 text-end">
                        <div class="me-md-2">
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


                <section class="p-0 mx-4 mx-md-3  mx-lg-3  ">
                    <div class="{{ $disabled ? 'd-none' : 'd-block' }}">
                        <div class="row border-top mt-2">
                            <div class="col-lg-6 ">
                                <h5 class=" py-2 px-2 d-flex justify-content-between">Récente</h5>
                            </div>
                        </div>

                        <div class="row p-0 mx-3 ">
                            @foreach ($ticketrecentes as $ticketrecent)
                            <div class="col-12 mb-3">
                                <div class="card border-0 shadow-sm rounded-4 hover-shadow transition-all position-relative overflow-hidden"
                                    style="background: #ffffff;">

                                    <div class="position-absolute top-0 start-0 bottom-0"
                                        style="width: 4px; opacity: 0.6;"></div>

                                    <div class="card-body p-3 ps-4">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="d-flex align-items-center flex-grow-1" style="min-width: 0;">
                                                @php
                                                $photo = optional($ticketrecent->responsable)->photo;
                                                @endphp

                                                <div class="position-relative flex-shrink-0">
                                                    <img src="{{ $photo ? asset('storage/' . $photo) : asset('/images/avtar_1.png') }}"
                                                        alt="Profil" width="46" height="46"
                                                        class="rounded-circle border border-2 border-white shadow-sm object-fit-cover">
                                                    <span
                                                        class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle shadow-sm"></span>
                                                </div>

                                                <div class="ms-3 text-truncate">
                                                    <h6 class="mb-0 fw-bold text-soft text-truncate"
                                                        style="font-size: 0.95rem;">
                                                        {{ $ticketrecent->sujet }}
                                                    </h6>
                                                    <p class="text-subtle  mb-0 small text-truncate"
                                                        style="max-width: 450px;">
                                                        {{ $ticketrecent->details }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center ms-4">
                                                <div class="text-end me-3 d-none d-md-block border-end pe-3">
                                                    <small class="text-subtle d-block mb-1"
                                                        style="font-size: 0.7rem; font-weight: 500;">
                                                        <i class="far fa-clock me-1 text-primary-pivot"></i>
                                                        {{
                                                        \Carbon\Carbon::parse($ticketrecent->created_at)->diffForHumans()
                                                        }}
                                                    </small>
                                                    <span class="badge-pivot-soft status-{{ $ticketrecent->state }}">
                                                        {{ match($ticketrecent->state) {
                                                        1 => 'En cours',
                                                        2 => 'En traitement',
                                                        3 => 'En résolution',
                                                        4 => 'Résolu',
                                                        default => 'Fermé'
                                                        } }}
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

                    <div
                        class="d-flex flex-wrap align-items-center justify-content-between mb-3 mt-4 pb-2 border-bottom shadow-none">


                        <div class="d-flex align-items-center gap-3 flex-grow-1 me-4">

                            <div class="position-relative flex-grow-1">

                                <input type="text" wire:model.live="recherche"
                                    class="form-control form-control-sm border-0 bg-light rounded-2 ps-5 pe-3 shadow-none w-100 "
                                    placeholder="Rechercher un sujet..."
                                    style="min-width: 250px; font-size: 0.85rem; color: #475569;">
                            </div>

                            <div class="d-flex align-items-center  border-0 shadow-sm rounded-2 px-3 bg-white border"
                                style="height: 38px;"">
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
                    <div class="list-group "
                        style="max-height:700px;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">


                        <div wire:loading.flex
                            class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 justify-content-center align-items-center"
                            style="z-index: 10;">
                            <div class="text-center">
                                <div class="spinner-border text-secondary" role="status"
                                    style="width: 3rem; height: 3rem;"></div>
                                <p class="mt-2 fw-bold text-secondary">Chargement des tickets...</p>
                            </div>
                        </div>


                        @forelse ($tickets as $ticket)
                        <a href="#"
                            class="list-group-item list-group-item-action border-0 mb-2 shadow-sm rounded-3 p-3 bg-white">
                            <div class="d-flex align-items-center justify-content-between">

                                <div class="flex-grow-1" style="min-width: 0;">
                                    <div class="d-flex align-items-center">
                                        <span class=" text-soft text-truncate-single"
                                            style="font-size: 0.9rem; max-width: 70%;">
                                            {{ $ticket->sujet }}
                                        </span>
                                        <span class="mx-2 text-subtle">|</span>
                                        <span class="text-subtle  text-truncate-single">{{$ticket->equipement}}</span>
                                    </div>

                                    <div class="text-subtle text-truncate-single mt-1" style="opacity: 0.8;">
                                        {{ $ticket->details }}
                                    </div>
                                </div>

                                <div class="d-flex align-items-center  ms-3 shadow-none">
                                    <span class="badge-pivot-soft status-{{ $ticket->state }} me-3"
                                        style="font-size: 0.6rem;">
                                        {{ $ticket->state == 4 ? 'Résolu' : 'En traitement' }}

                                    </span>

                                    <div class="text-end " style="min-width: 80px;">
                                        <div class="text-soft " style="font-size: 0.75rem;">
                                            {{\Carbon\Carbon::parse($ticket->created_at)->format('H:i')}}</div>
                                        <div class="text-subtle" style="font-size: 0.65rem;">{{
                                            \Carbon\Carbon::parse($ticket->created_at)->diffForHumans()}}</div>
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

                            <h6 class="fw-bold text-dark mb-1">Aucun ticket trouvé</h6>
                            <p class="text-muted small mb-0">Essayez de modifier vos filtres ou votre recherche.</p>


                        </div>
                        @endforelse
                        {{-- @if ($tickets->first()?->state > 4)
                        <span class="mx-3 py-1 fw-normal">RESOLU</span>
                        @endif --}}

                        <div class="mt-4 d-flex justify-content-center">
                            {{-- {{ $tickets->links() }} --}}

                        </div>

                    </div>

                </section>
            </div>
        </div>
    </div>

</div>
<style>
    .materiel-item {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .materiel-item:hover {
        background-color: #e9ecef;
        /* gris plus foncé */
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<script></script>