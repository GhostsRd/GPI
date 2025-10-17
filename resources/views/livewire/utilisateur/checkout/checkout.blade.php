<div>

    <div wire:ignore.self class="sidebar rounded-3 p-0 shadow-lg colg-lg-3  " id="sidebar">
        <div>
            <div>
                <div>
                    <!-- Header -->
                    <div class=" border-bottom">
                        <h4 class="modal-title mx-2 my-2 " id="ordinateurModalLabel">Nouveau Checkout</h4>
                    </div>

                    <!-- Formulaire Livewire -->
                    <form>
                        <div class="modal-body row">
                            <!-- Sujet -->
                            <p class="text-dark mb-3">Les champs indiqués <span class="text-danger">*</span> sont
                                obligatoires</p>

                            <div class="mb-3 col-lg-6 position-relative">
                                <label for="sujet" class="form-label">
                                    Tapez ici le matériel <span class="text-danger">*</span>
                                </label>

                                <input type="text" wire:model="search" class="form-control"
                                    placeholder="Cherchez un matériel (ex: HP Elitebook, Dell 24 pouces...)">

                                {{-- @if (!empty($filteredMateriels))
                                    <ul class="list-group mt-2 shadow-sm">
                                        @foreach ($filteredMateriels as $materiel)
                                            <li class="list-group-item list-group-item-action"
                                                wire:click="selectMateriel('{{ $materiel->label }}')">
                                                {{ $materiel->label }}
                                                <span
                                                    class="badge bg-secondary float-end">{{ ucfirst($materiel->type) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif --}}

                                @error('sujet')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="etap_validation text-dark ">
                                <label for="sujet" class="form-label">
                                    Choisir le matériel <span class="text-danger">*</span>
                                </label>
                                <div class="etap {{ $etape[1] }}">
                                    <a href="#" wire:click="$set('valeur1', 'ordinateur')" data-aos-duration="400"
                                        class=" {{ $valeur1 == 'ordinateur' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border-0  "
                                        aria-current="true">

                                        <div class="d-flex w-100 justify-content-between">
                                            <label># Ordinateur -</label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>

                                    <a href="#" wire:click="$set('valeur1', 'Telephone')" data-aos-duration="400"
                                        class=" {{ $valeur1 == 'Telephone' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border-0 rounded-2 mb-1">

                                        <div class="d-flex w-100 justify-content-between">
                                            <label># Telephone -</label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>

                                    <a href="#" wire:click="$set('valeur1', 'Peripherique')"
                                        data-aos-duration="400"
                                        class="{{ $valeur1 == 'Peripherique' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">

                                        <div class="d-flex w-100 justify-content-between">
                                            <label># Peripherique -</label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>


                                    <div class="">
                                        <button wire:click="next_form(2)"
                                            class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Suivant</button>
                                    </div>


                                </div>

                                {{-- etape 2 page telephone --}}

                                <div class="etap {{ $etape[2] }}">
                                    <a data-aos-duration="400" wire:click="$set('valeur2', 'Touche')"
                                        class="{{ $valeur2 == 'Touche' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">

                                        <div class=" d-flex w-100 justify-content-between">
                                            <label># Telephone touche -</label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>

                                    <a data-aos-duration="400" wire:click="$set('valeur2', 'Android')"
                                        class="{{ $valeur2 == 'Android' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">

                                        <div class="d-flex w-100 justify-content-between">
                                            <label># Telephone Android -</label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>

                                    <a wire:click="$set('valeur2', 'Tablette')"
                                        class="{{ $valeur2 == 'Tablette' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">

                                        <div class=" d-flex w-100 justify-content-between">
                                            <label># Telephone Tablette -</label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>
                                    <div class="">
                                        <button wire:click="next_form(1)"
                                            class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Precedent</button>
                                        <button wire:click="next_form(5)"
                                            class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Suivant</button>
                                    </div>
                                </div>

                                {{-- etape 4 peripherique --}}


                                <div class="etap {{ $etape[4] }}">
                                    <a wire:click="$set('valeur2', 'Regulateur')" href="#"
                                        class="{{ $valeur2 == 'Regulateur' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">

                                        <div class="d-flex w-100 justify-content-between">
                                            <label># Regulateur
                                                -</label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>

                                    <div class="list-group">

                                        <!-- Ordinateur -->
                                        <a wire:click="$set('valeur2', 'Ordinateur')" href="#"
                                            class="{{ $valeur2 == 'Ordinateur' ? 'bg-secondary shadow ' : 'shadow-sm' }}  card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Ordinateur -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Clavier -->
                                        <a wire:click="$set('valeur2', 'Clavier')" href="#"
                                            class="{{ $valeur2 == 'Clavier' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Clavier -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Souris -->
                                        <a wire:click="$set('valeur2', 'Souris')" href="#"
                                            class="{{ $valeur2 == 'Souris' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Souris -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Webcam -->
                                        <a wire:click="$set('valeur2', 'Webcam')" href="#"
                                            class="{{ $valeur2 == 'Webcam' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Webcam -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Casque -->
                                        <a wire:click="$set('valeur2', 'Casque')" href="#"
                                            class="{{ $valeur2 == 'Casque' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Casque -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Scanner -->
                                        <a wire:click="$set('valeur2', 'Scanner')" href="#"
                                            class="{{ $valeur2 == 'Scanner' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Scanner -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Câble -->
                                        <a wire:click="$set('valeur2', 'Cable')" href="#"
                                            class="{{ $valeur2 == 'Cable' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Câble -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- USB -->
                                        <a wire:click="$set('valeur2', 'USB')" href="#"
                                            class="{{ $valeur2 == 'USB' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># USB -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Jabra -->
                                        <a wire:click="$set('valeur2', 'Jabra')" href="#"
                                            class="{{ $valeur2 == 'Jabra' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Jabra -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Powerbank -->
                                        <a wire:click="$set('valeur2', 'Powerbank')" href="#"
                                            class="{{ $valeur2 == 'Powerbank' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Powerbank -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Chargeur -->
                                        <a wire:click="$set('valeur2', 'Chargeur')" href="#"
                                            class="{{ $valeur2 == 'Chargeur' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Chargeur -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- APN -->
                                        <a wire:click="$set('valeur2', 'APN')" href="#"
                                            class="{{ $valeur2 == 'APN' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># APN -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Appareil Photo -->
                                        <a wire:click="$set('valeur2', 'Appareil Photo')" href="#"
                                            class="{{ $valeur2 == 'Appareil Photo' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Appareil Photo -</blabel>
                                                    <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                        <!-- Dominos -->
                                        <a wire:click="$set('valeur2', 'Dominos')" href="#"
                                            class="{{ $valeur2 == 'Dominos' ? 'bg-secondary shadow ' : 'shadow-sm' }} card border rounded-2 mb-1">
                                            <div class="d-flex w-100 justify-content-between">
                                                <label># Dominos -</label>
                                                <small class="text-body-secondary">En stock</small>
                                            </div>
                                        </a>

                                    </div>



                                    <div class="">
                                        <button wire:click="next_form(1)"
                                            class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Precedent</button>
                                        <button wire:click="next_form(5)" type="submit"
                                            class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Valider</button>
                                    </div>
                                </div>

                                {{-- validatation de l'etape --}}

                                <div class="etap {{ $etape[5] }}">
                                    <h5>Vos selection</h5>
                                    <a href="#" data-aos="fade-down" data-aos-duration="400"
                                        class="list-group-item list-group-item-action border rounded-2 mb-1">

                                        <div class="d-flex w-100 justify-content-between">
                                            <label> 1 - {{ $valeur1 }} </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>

                                    <a href="#" data-aos="fade-down" data-aos-duration="400"
                                        class="list-group-item list-group-item-action border rounded-2 mb-1">

                                        <div class="d-flex w-100 justify-content-between">
                                            <label> 2 - {{ $valeur2 }} </label>
                                            <small class="text-body-secondary">En stock</small>
                                        </div>

                                    </a>
                                    <div class="">
                                        <button wire:click="next_form(1)"
                                            class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Precedent</button>
                                        <button type="submit" wire:click="EnvoyerCheckout"
                                            class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Envoyer</button>
                                    </div>
                                </div>




                            </div>

                            <!-- Étape 1 -->






                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary border px-3"
                                id="closeSidebar">Annuler</button>
                            {{-- <button type="submit" wire:click="EnvoyerCheckout"
                                class="btn btn-outline-success  fw-bold border  px-3  btn-sm  shadow-sm">Envoyer</button> --}}
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>



    <div wire:ignore.self class="container-fluid main-content">
        <div class="row col-lg-11 offset-lg-1 offset-xs-0 col-12">
            <div class="col-lg-3 bg-white py-1 px-0 shadow-sm">


                <ul style="list-style: none " class="px-2 py-2 ">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="me-2 text-gradient text-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                            </svg>
                            <h class="fw-bold text-dark mb-0">Acceuil / Checkout</h>
                        </div>

                        <div class="text-end">
                            {{-- <span class="text-muted small me-2">#12</span> --}}

                        </div>
                    </div>
                    <li style="cursor: pointer" class="bg-light bg-gradient py-2 " id="toggleSidebar"><svg
                            width="20" class="text-danger-emphasis mr-1" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Nouveau Checkout

                    </li>
                    <li style="cursor: pointer" wire:click="visiterordinateur"
                        class="mt-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">

                            <svg width="20" class="text-danger-emphasis mr-1" xmlns="http://www.w3.org/2000/svg"
                                fill="#FFE300" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                            </svg> Equipements
                        </div>
                        <div class="text-end">
                            <span class=" text-danger small me-2 fw-bold "></span>

                        </div>
                    </li>
                    <li style="cursor: pointer" wire:click="visiterordinateur"
                        class="mt-1 d-flex justify-content-between align-items-center pl-4">
                        <div class="d-flex align-items-center">

                            <svg width="20" class="text-danger-emphasis mr-1" xmlns="http://www.w3.org/2000/svg"
                                fill="#FFE300" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                            </svg> Mes checkout
                        </div>
                        <div class="text-end">
                            <span class=" text-danger small me-2 fw-bold "></span>

                        </div>
                    </li>

                    <li style="cursor: pointer" wire:click="visiterTicket"
                        class="mt-1 d-flex justify-content-between align-items-center ">
                        <div class="d-flex align-items-center">

                            <svg width="20" class="text-danger-emphasis mr-1" xmlns="http://www.w3.org/2000/svg"
                                fill="#FFE300" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                            </svg> Mes tickets
                        </div>
                        <div class="text-end">
                            <span class="text-muted small me-2">#12</span>

                        </div>
                    </li>

                </ul>

                <div class="justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        x="0px" y="0px" viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;"
                        xml:space="preserve">
                        <g id="BACKGROUND">
                            <rect x="-0.792" y="0.268" style="fill:#FFFFFF;" width="499.999" height="500.001" />
                        </g>
                        <g id="OBJECTS">
                            <g>
                                <g>
                                    <g>
                                        <g>
                                            <g>
                                                <polygon style="fill:#E9E9FF;"
                                                    points="163.51,179.966 90.458,222.409 166.74,266.676 240.085,224.511       " />
                                                <polygon style="fill:#B8B8D8;"
                                                    points="240.085,224.511 240.085,305.51 166.74,348.436 166.74,266.676       " />
                                                <polygon style="fill:#777793;"
                                                    points="90.458,222.409 90.458,227.036 166.74,271.461 166.74,266.676       " />
                                                <polygon style="fill:#777793;"
                                                    points="162.771,264.37 162.771,346.146 166.74,348.436 166.74,266.676       " />
                                            </g>
                                        </g>
                                        <polygon style="fill:#B8B8D8;"
                                            points="162.285,361.774 90.458,320.018 90.458,227.036 164.756,270.027     " />
                                    </g>
                                    <g>
                                        <g>
                                            <polygon style="fill:#9B9BBA;"
                                                points="218.608,394.35 306.53,343.502 305.729,190.251 218.037,228.657      " />
                                            <polygon style="fill:#777793;"
                                                points="218.608,235.834 162.348,202.88 162.348,361.868 218.608,394.35      " />
                                        </g>
                                        <g>
                                            <polygon style="fill:#E9E9FF;"
                                                points="231.634,153.749 159.615,194.929 222.212,231.068 293.455,189.441      " />
                                            <g>
                                                <g>
                                                    <polygon style="fill:#47476D;"
                                                        points="235.141,208.048 280.526,181.976 244.565,161.215 199.293,187.354        " />
                                                    <polygon style="fill:#221F4F;"
                                                        points="237.903,196.216 261.465,182.002 242.322,171.27 218.609,185.076        " />
                                                </g>
                                            </g>
                                            <polygon style="fill:#9B9BBA;"
                                                points="199.293,187.354 235.141,208.048 222.212,231.068 159.615,194.929      " />
                                            <path style="fill:#ABABCE;"
                                                d="M200.873,188.32c-9.107,5.294-9.137,13.878-0.052,19.158c9.107,5.291,23.972,5.291,33.134,0       c0.063-0.035,0.114-0.075,0.176-0.112L200.873,188.32z" />
                                            <polygon style="fill:#47476D;"
                                                points="201.813,195.303 221.149,206.45 223.312,205.237 204.022,194.067      " />
                                            <polygon style="fill:#47476D;"
                                                points="159.615,194.929 159.615,201.589 222.212,238.17 222.212,231.068      " />
                                            <polygon style="fill:#777793;"
                                                points="293.455,189.441 222.212,231.068 222.212,238.17 300.11,193.285      " />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <polygon style="fill:#B8B8D8;"
                                                points="231.572,50.399 231.572,153.655 373.076,235.353 373.076,132.099      " />
                                            <polygon style="fill:#D5D5EF;"
                                                points="372.94,387.774 373.076,132.099 390.825,121.695 390.825,377.155      " />
                                            <polygon style="fill:#E9E9FF;"
                                                points="249.168,40.446 231.572,50.399 373.076,132.099 390.825,121.695      " />
                                            <polygon style="fill:#B8B8D8;"
                                                points="300.048,193.191 300.048,348.361 373.076,387.774 373.076,235.353      " />
                                        </g>
                                        <g>
                                            <g>
                                                <polygon style="fill:#777793;"
                                                    points="361.049,186.124 361.049,205.515 336.561,191.376 336.561,172.198       " />
                                                <polygon style="fill:#47476D;"
                                                    points="357.855,192.9 357.855,195.507 339.111,185.005 339.111,182.206       " />

                                                <line
                                                    style="fill:none;stroke:#221F4F;stroke-width:0.5;stroke-miterlimit:10;"
                                                    x1="357.855" y1="194.371" x2="339.111" y2="183.893" />
                                            </g>
                                            <g>
                                                <polygon style="fill:#777793;"
                                                    points="361.049,163.412 361.049,182.803 336.561,168.663 336.561,149.485       " />
                                                <polygon style="fill:#47476D;"
                                                    points="357.855,170.188 357.855,172.795 339.111,162.292 339.111,159.493       " />

                                                <line
                                                    style="fill:none;stroke:#221F4F;stroke-width:0.5;stroke-miterlimit:10;"
                                                    x1="357.855" y1="171.658" x2="339.111" y2="161.182" />
                                            </g>
                                            <g>
                                                <polygon style="fill:#47476D;"
                                                    points="314.311,179.882 298.304,170.735 314.915,160.909 330.238,170.288       " />
                                                <g>
                                                    <polygon style="fill:#221F4F;"
                                                        points="314.227,142.754 314.632,161.104 298.304,170.735 298.219,158.88 306.761,147.063                 " />
                                                    <polygon style="fill:#9B9BBA;"
                                                        points="313.968,142.624 314.227,142.754 306.761,147.063 306.496,146.883        " />
                                                    <polygon style="fill:#9B9BBA;"
                                                        points="298.219,158.88 306.761,147.063 306.496,146.883 297.96,158.712        " />
                                                    <polygon style="fill:#9B9BBA;"
                                                        points="298.304,170.735 298.219,158.88 297.96,158.712 297.96,170.54        " />
                                                </g>
                                                <polygon style="fill:#D5D5EF;"
                                                    points="310.397,147.518 314.314,145.341 328.508,152.899 324.138,155.421       " />
                                                <g>
                                                    <polygon style="fill:#B8B8D8;"
                                                        points="302.361,169.799 315.702,177.501 324.34,155.537 310.397,147.518        " />
                                                    <g>
                                                        <polygon style="fill:#A8EB57;"
                                                            points="321.191,156.06 310.876,150.178 308.71,155.764 318.505,161.35         " />
                                                        <g>
                                                            <polygon style="fill:#777793;"
                                                                points="316.358,162.611 314.244,161.394 313.472,163.506 315.548,164.727          " />
                                                            <polygon style="fill:#777793;"
                                                                points="313.472,160.962 311.356,159.745 310.585,161.855 312.66,163.077          " />
                                                            <polygon style="fill:#777793;"
                                                                points="310.65,159.295 308.537,158.079 307.764,160.19 309.843,161.411          " />
                                                            <polygon style="fill:#777793;"
                                                                points="315.233,165.44 313.118,164.225 312.346,166.335 314.424,167.555          " />
                                                            <polygon style="fill:#777793;"
                                                                points="312.346,163.79 310.23,162.574 309.461,164.685 311.537,165.905          " />
                                                            <polygon style="fill:#777793;"
                                                                points="309.524,162.124 307.41,160.909 306.641,163.02 308.716,164.24          " />
                                                            <polygon style="fill:#777793;"
                                                                points="314.122,168.285 312.006,167.069 311.234,169.181 313.31,170.401          " />
                                                            <polygon style="fill:#777793;"
                                                                points="311.234,166.635 309.121,165.419 308.35,167.532 310.423,168.751          " />
                                                            <polygon style="fill:#777793;"
                                                                points="308.415,164.97 306.301,163.753 305.527,165.865 307.602,167.085          " />
                                                            <polygon style="fill:#83CE17;"
                                                                points="313.027,171.098 310.914,169.883 310.143,171.995 312.221,173.213          " />
                                                            <polygon style="fill:#FFA500;"
                                                                points="310.143,169.449 308.028,168.231 307.258,170.344 309.332,171.564          " />
                                                            <polygon style="fill:#F05A00;"
                                                                points="307.322,167.783 305.207,166.566 304.436,168.679 306.511,169.898          " />
                                                        </g>
                                                    </g>
                                                </g>
                                                <g>
                                                    <polygon style="fill:#47476D;"
                                                        points="330.238,151.901 330.238,170.288 314.311,179.882 314.227,168.027 322.773,156.21                 " />
                                                    <polygon style="fill:#E9E9FF;"
                                                        points="329.978,151.77 330.238,151.901 322.773,156.21 322.507,156.03        " />
                                                    <polygon style="fill:#E9E9FF;"
                                                        points="314.227,168.027 322.773,156.21 322.507,156.03 313.97,167.86        " />
                                                    <polygon style="fill:#9B9BBA;"
                                                        points="314.311,179.882 314.227,168.027 313.97,167.86 313.97,179.686        " />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <polygon style="fill:#9B9BBA;"
                                                            points="282.452,123.665 282.452,183.03 243.338,160.406 243.213,101.952         " />
                                                        <polygon style="fill:#221F4F;"
                                                            points="270.787,145.784 270.787,175.008 251.523,163.905 251.523,134.663         " />
                                                        <polygon style="fill:#F05A00;"
                                                            points="270.787,150.028 251.523,139.206 251.523,134.663 270.787,145.784         " />
                                                        <polygon style="fill:#221F4F;"
                                                            points="278.341,150.145 278.341,164.735 274.913,162.757 274.913,148.167         " />
                                                    </g>
                                                    <g>
                                                        <path style="fill:#F05A00;"
                                                            d="M259.22,159.448c0.24-0.112,0.278-0.541,0.084-0.958c-0.194-0.417-0.547-0.663-0.787-0.552          c-0.24,0.113-0.279,0.541-0.086,0.958C258.626,159.313,258.979,159.559,259.22,159.448z" />
                                                        <path style="fill:#F05A00;"
                                                            d="M259.779,157.613c0.241-0.112,0.278-0.54,0.084-0.958c-0.194-0.416-0.546-0.663-0.786-0.551          c-0.24,0.112-0.279,0.54-0.085,0.958C259.186,157.477,259.538,157.725,259.779,157.613z" />
                                                        <path style="fill:#F05A00;"
                                                            d="M260.897,159.653c0.241-0.113,0.279-0.542,0.084-0.958c-0.193-0.417-0.546-0.664-0.787-0.552          c-0.239,0.112-0.277,0.541-0.084,0.958C260.306,159.517,260.657,159.765,260.897,159.653z" />
                                                        <path style="fill:#F05A00;"
                                                            d="M261.604,157.885c0.24-0.111,0.278-0.541,0.084-0.958c-0.191-0.416-0.546-0.664-0.787-0.552          c-0.24,0.112-0.277,0.54-0.084,0.958C261.013,157.749,261.363,157.997,261.604,157.885z" />
                                                        <path style="fill:#F05A00;"
                                                            d="M262.724,160.23c0.24-0.112,0.277-0.541,0.084-0.958c-0.193-0.417-0.545-0.664-0.786-0.552          c-0.241,0.113-0.278,0.541-0.084,0.958C262.13,160.094,262.483,160.341,262.724,160.23z" />
                                                        <path style="fill:#F05A00;"
                                                            d="M260.059,161.491c0.24-0.112,0.278-0.542,0.085-0.958c-0.194-0.417-0.547-0.664-0.787-0.552          c-0.24,0.112-0.278,0.541-0.084,0.958C259.466,161.355,259.817,161.602,260.059,161.491z" />
                                                        <path style="fill:#F05A00;"
                                                            d="M261.796,161.793c0.24-0.112,0.277-0.542,0.085-0.958c-0.194-0.417-0.547-0.664-0.788-0.552          c-0.239,0.112-0.277,0.542-0.084,0.958C261.202,161.657,261.556,161.904,261.796,161.793z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <polygon style="fill:#ABABCE;"
                                                            points="296.059,94.888 296.059,153.246 232.883,116.771 232.883,58.413         " />
                                                        <polygon style="fill:#221F4F;"
                                                            points="291.7,96.341 291.7,146.648 237.243,115.206 237.243,64.902         " />
                                                        <polygon style="fill:#D5D5EF;"
                                                            points="299.218,151.421 296.059,153.246 296.059,94.888 299.216,93.065         " />
                                                        <polygon style="fill:#E9E9FF;"
                                                            points="236.005,56.557 299.216,93.065 296.059,94.888 232.883,58.413         " />
                                                    </g>
                                                    <polygon style="opacity:0.3;fill:#553098;"
                                                        points="237.243,64.902 291.7,146.648 291.7,96.341        " />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                    <g>
                                        <polygon style="opacity:0.3;fill:#777793;"
                                            points="218.726,308.458 254.335,373.341 300.03,346.768 299.896,262.901     " />
                                        <g>
                                            <polygon style="fill:#E9E9FF;"
                                                points="300.066,256.373 218.726,303.336 326.052,365.617 407.957,318.531      " />
                                            <polygon style="fill:#B8B8D8;"
                                                points="407.957,318.531 407.957,408.986 326.052,456.924 326.052,365.617      " />
                                            <polygon style="fill:#777793;"
                                                points="218.726,303.336 218.726,308.458 326.052,370.963 326.052,365.617      " />
                                            <polygon style="fill:#777793;"
                                                points="321.62,363.045 321.62,454.364 326.052,456.924 326.052,365.617      " />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <polygon style="fill:#777793;"
                                                points="310.098,88.588 310.098,62.173 303.059,57.795 303.059,84.522      " />
                                            <polygon style="fill:#9B9BBA;"
                                                points="310.067,88.533 315.862,85.31 315.862,58.598 310.095,62.215      " />
                                        </g>
                                        <g>
                                            <polygon style="fill:#83CE17;"
                                                points="310.344,54.167 310.344,78.348 289.246,66.256 289.246,42.174      " />
                                            <polygon style="fill:#A8EB57;"
                                                points="331.04,66.301 310.344,78.348 310.344,54.167 330.876,42.127      " />
                                            <polygon style="fill:#C9FF7B;"
                                                points="310.344,30.085 289.246,42.174 310.344,54.167 330.876,42.127      " />
                                        </g>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <g>
                                            <polygon style="fill:#F78028;"
                                                points="331.484,329.892 336.571,243.135 284.625,213.414 278.73,300.971      " />
                                            <polygon style="fill:#F05A00;"
                                                points="359.868,314.097 352.373,233.767 342.729,235.906 336.571,243.135 331.484,329.892        347.68,315.959      " />
                                            <polygon style="fill:#415C71;"
                                                points="300.423,204.045 352.373,233.767 342.729,235.906 336.571,243.135 284.625,213.414        295.872,210.468      " />
                                        </g>
                                        <path style="fill-rule:evenodd;clip-rule:evenodd;fill:#415C71;"
                                            d="M326.693,241.083c0.808,6.67-0.854,12.282-5.009,14.685      c-6.93,3.998-18.103-2.395-24.959-14.28c-4.121-7.14-5.725-14.62-4.871-20.334l-1.827-1.046      c-0.85,6.254,0.957,14.376,5.426,22.115c7.555,13.093,19.861,20.133,27.49,15.729c4.511-2.604,6.369-8.626,5.577-15.818      L326.693,241.083z" />
                                    </g>
                                    <g>
                                        <g>
                                            <polygon style="fill:#A8EB57;"
                                                points="343.226,349.613 338.585,270.495 385.958,243.391 391.334,323.239      " />
                                            <polygon style="fill:#83CE17;"
                                                points="317.342,335.206 324.179,261.95 332.97,263.903 338.585,270.495 343.226,349.613        328.456,336.907      " />
                                            <polygon style="fill:#415C71;"
                                                points="371.554,234.848 324.179,261.95 332.97,263.903 338.585,270.495 385.958,243.391        375.702,240.706      " />
                                        </g>
                                        <path style="fill:#415C71;"
                                            d="M376.689,252.709l-0.942,0.543c0.422,0.783,0.826,1.592,1.212,2.422      c6.196,13.313,6.987,28.006-2.539,32.769c-7.581,3.793-20.281-5.913-26.476-19.23c-0.019-0.039-1.237,0.649-1.237,0.649      c0.204,0.478,0.417,0.952,0.638,1.428c6.989,15.027,19.69,23.924,28.363,19.893c8.665-4.036,10.027-19.487,3.037-34.507      C378.106,255.3,377.417,253.98,376.689,252.709z" />
                                    </g>
                                    <g>
                                        <g>
                                            <polygon style="fill:#83CE17;"
                                                points="288.145,337.664 292.266,267.386 250.184,243.31 245.409,314.237      " />
                                            <polygon style="fill:#A8EB57;"
                                                points="311.135,325.623 305.063,260.554 297.254,262.286 292.266,268.142 288.145,338.42        301.263,327.134      " />
                                            <polygon style="fill:#415C71;"
                                                points="262.981,236.477 305.063,260.554 297.254,262.286 292.266,268.142 250.184,244.066        259.294,241.68      " />
                                        </g>
                                        <path style="fill-rule:evenodd;clip-rule:evenodd;fill:#415C71;"
                                            d="M284.262,266.478c0.652,5.405-0.691,9.95-4.056,11.897      c-5.615,3.239-14.664-1.94-20.219-11.565c-3.341-5.784-4.64-11.845-3.948-16.473l-1.479-0.848      c-0.688,5.067,0.775,11.645,4.396,17.915c6.119,10.605,16.089,16.307,22.268,12.74c3.652-2.11,5.159-6.986,4.515-12.813      L284.262,266.478z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path style="fill:#B27343;"
                                            d="M231.759,215.283c0,0,5.101-3.872,8.598-5.297c3.523-1.413,6.793-3.009,10.417-5.951      c1.726-1.4,6.289-9.167,2.65-13.622c-1.547-1.895-5.01,2.495-7.596,4.29c-3.049,2.117-5.282,3.045-5.282,3.045      s0.351-1.338,0.351-4.019c0-2.323-1.584-3.781-6.092,5.915c-3.774,8.116-10.974,6.391-10.974,6.391L231.759,215.283z" />
                                        <path style="opacity:0.2;fill:#FAC1AC;"
                                            d="M252.465,198.064c-4.652,3.776-8.849,5.825-13.372,7.639      c-3.533,1.439-8.328,4.816-10.215,6.192l2.903,3.387c0,0,5.101-3.872,8.599-5.297c3.523-1.413,6.792-3.009,10.415-5.951      c1.211-0.982,3.808-5.095,4.001-9.002C253.938,196.48,253.066,197.575,252.465,198.064z" />
                                    </g>
                                    <g>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <path style="fill:#221F4F;"
                                                            d="M135.968,447.253l1.511,1.01c0,0,3.54,0.496,7.576-0.507          c4.049-1.007,8.592-0.762,7.833,3.031c-0.76,3.784-7.323,6.816-10.101,8.088c-2.778,1.255-11.413,5.43-15.705,4.42          c-4.294-1.005-4.2-3.426-4.271-4.744c-0.213-3.908,0.082-12.565,0.082-12.565L135.968,447.253z" />
                                                    </g>
                                                    <path style="fill:#415C71;"
                                                        d="M122.765,394.858c0.338-15.425,4.56-26.883,4.56-26.883s-0.79-59.225-2.504-74.201         c-1.718-14.98,1.513-25.147,2.763-29.679c0.223-4.787,3.205-5.714,3.205-5.714l40.408,7.493l-8.155,60.798         c-5.408,24.771-6.735,54.349-12.148,61.232c-9.289,11.814-10.136,54.001-11.486,65.08c0,0-6.119,3.965-11.159,3.308         c-7.067-0.922-6.952-3.577-6.952-8.157C121.296,448.136,122.422,410.286,122.765,394.858z" />
                                                </g>
                                                <path style="opacity:0.2;fill:#415C71;"
                                                    d="M139.788,369.521c9.257-44.335-22.658-89.018-0.208-109.508l-8.792-1.631        c0,0-2.982,0.927-3.205,5.714c-1.25,4.532-4.133,18.486-2.415,33.466c1.714,14.976,2.156,70.414,2.156,70.414        s-4.222,11.458-4.56,26.883c-0.342,15.428-1.469,53.277-1.469,53.277c0,4.58-0.115,7.235,6.952,8.157        c3.88,0.506,8.388-1.723,10.263-2.777C122.068,421.403,132.232,405.702,139.788,369.521z" />
                                            </g>
                                            <g>
                                                <g>
                                                    <path style="fill:#221F4F;"
                                                        d="M203.861,436.584l1.611,1.067c0,0,3.766,0.536,8.055-0.536         c4.311-1.074,9.147-0.803,8.342,3.222c-0.819,4.04-7.796,7.26-10.754,8.608c-2.954,1.337-8.441,3.261-14.818,3.357         c-5.864,0.089-6.434-1.271-6.752-2.709c-0.898-4.067,2.489-14.157,2.489-14.157L203.861,436.584z" />
                                                </g>
                                                <path style="fill:#415C71;"
                                                    d="M137.576,260.684c0,0-5.964,16.684,1.917,32.095c6.364,12.447,57.839,75.114,57.839,75.114        s-6.292,27.114-7.388,39.011c-1.095,11.898,0.736,20.155-0.865,30.992c0,0-1.734,6.107,0.865,6.628        c4.184,0.839,12.015-0.506,14.715-2.105c2.701-1.598,11.406-58.697,17.297-66.219c5.79-7.388,3.653-12.627,0-24.293        c-3.652-11.664-34.521-85.808-34.521-85.808L137.576,260.684z" />
                                                <path style="opacity:0.2;fill:#415C71;"
                                                    d="M197.945,413.635c1.257-13.648,20.468-37.192,19.457-48.536        c-2.302-25.799-39.12-78.479-46.422-92.759c-3.461-6.764-29.05-5.153-29.131-11.192l-4.273-0.464        c0,0-5.964,16.684,1.917,32.095c6.364,12.447,57.839,75.114,57.839,75.114s-6.292,27.114-7.388,39.011        c-1.095,11.898,0.736,20.155-0.865,30.992c0,0-1.734,6.107,0.865,6.628c3.858,0.773,10.811-0.311,13.988-1.738        C204.762,432.495,196.85,425.544,197.945,413.635z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path style="fill:#F78028;"
                                                    d="M167.16,159.44c6.006,2.466,15.417,6.843,22.282,13.341c6.847,6.486,4.084,25.007,4.81,34.759        c0.725,9.736-3.911,63.769-3.911,63.769s-19.378,7.642-30.929,6.567c-11.547-1.088-28.264-7.708-33.677-17.447        c0,0,1.597-41.42,0.552-54.87c-1.343-17.278,0.534-35.074,2.452-41.92c1.477-5.278,12.613-15.237,24.518-9.456        C153.257,154.184,163.723,158.028,167.16,159.44z" />
                                                <path style="opacity:0.4;fill:#F05A00;"
                                                    d="M174.548,257.477c-23.211,4.441-40.558-33.836-42.854-69.195        c-0.985-15.171,0.739-25.021,7.729-34.599c-5.671,2.21-9.822,6.878-10.684,9.957c-1.918,6.847-3.795,24.642-2.452,41.92        c1.045,13.45-0.552,54.87-0.552,54.87c5.413,9.739,22.13,16.359,33.677,17.447c11.55,1.074,30.929-6.567,30.929-6.567        s0.653-6.87,1.694-21.068C186.616,255.862,184.148,255.641,174.548,257.477z" />
                                            </g>
                                            <g>
                                                <path style="fill:#F78028;"
                                                    d="M187.406,171.14c-6.448-0.862-9.528,5.235-11.38,8.635c-4.499,8.26-6.079,29.753-5.008,38.373        c1.295,10.427,2.876,18.621,10.102,25.852c4.231,4.234,6.661,4.227,14.363,0c7.701-4.229,40.198-29.046,40.198-29.046        s1.555-5.413-0.792-8.447c-2.347-3.035-5.029-3.963-5.029-3.963l-30.403,15.88c0,0-2.357-31.582-4.259-36.302        C193.296,177.402,190.742,171.586,187.406,171.14z" />
                                                <path style="fill:#F05A00;"
                                                    d="M201.949,233.343c-7.702,4.227-10.131,4.234-14.363,0c-7.226-7.231-8.807-15.425-10.102-25.852        c-0.928-7.468,0.135-24.595,3.361-34.41c-2.28,1.902-3.754,4.741-4.818,6.694c-4.5,8.26-6.078,29.753-5.008,38.373        c1.295,10.427,2.875,18.621,10.102,25.852c4.231,4.234,6.661,4.227,14.363,0c7.701-4.229,40.198-29.046,40.198-29.046        s0.898-3.139,0.29-5.976C226.161,216.381,207.536,230.276,201.949,233.343z" />
                                            </g>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path style="fill:#B27343;"
                                                d="M184.61,111.938c1.765,15.622,2.695,15.737,1.037,24.838c-0.472,2.59-2.237,7.608-5.572,8.946       c-3.333,1.335-8.753-0.078-8.753-0.078v19.524c0,0-11.285,4.056-18.968-1.616v-7.673v-39.49       C152.354,116.39,165.479,101.835,184.61,111.938z" />
                                            <polygon style="fill:#B27343;"
                                                points="183.94,133.817 188.952,131.639 185.502,119.242      " />
                                        </g>
                                        <path style="fill:#5B3C29;"
                                            d="M185.269,108.369c-2.329-12.932-51.686-17.792-43.333,17.593      c2.612,11.064,12.563,17.723,12.563,17.723s12.626-5.472,12.494-9.867c-0.438-14.583,2.353-18.303,5.315-18.942      C175.88,114.106,186.927,117.581,185.269,108.369z" />
                                        <path style="fill:#B27343;"
                                            d="M170.887,130.083c0,3.199-2.208,5.793-4.933,5.793c-2.724,0-4.933-2.594-4.933-5.793      c0-3.2,2.21-5.793,4.933-5.793C168.679,124.29,170.887,126.884,170.887,130.083z" />
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="mt-2 p-xs-0 p-0 p-md-0 p-xl-2  col-lg-9">
                <section class="p-0">
                    <div class="card bg-none border-0 m-0 p-0 mb-1">
                        <select class="form-select" wire:init wire:model="state">
                            <option value="">Tous</option>
                            <option value="En service">En service</option>
                            <option value="En stock">En stock</option>
                            <option value="Disponible">Disponible</option>
                            <option value="Hors service">Hors service</option>
                            <option value="En réparation">En réparation</option>
                        </select>
                    </div>
                    <div class="list-group mt-2" style="overflow-y: none">
                        <a href="#"
                            class="list-group-item border shadow-sm bg-light   bg-gradient list-group-item-action "
                            aria-current="true">
                            <div class="d-flex active w-100 justify-content-between">
                                <h5 class="mb-1">Liste de checkout</h5>
                                <small>
                                    <input type="text" wire:model="recherche"
                                        class="input-recherche border p-1 px-5 rounded-2"
                                        placeholder="Recherche par sujet..">
                                </small>
                            </div>
                        </a>



                        {{-- checkout form step by step --}}





                        @foreach ($checkouts as $checkout)
                            <a wire:click="visualiser('{{ $checkout->id }}')" href="#" data-aos="fade-down"
                                data-aos-duration="400" data-aos-delay="{{ $loop->index * 200 }}"
                                class="list-group-item list-group-item-action border">

                                <div class="d-flex w-100 justify-content-between">
                                    <b class="mb-1 text-black-50"># {{ $checkout->id }} - {{ $checkout->materiel_type }} :
                                       </b>
                                    <small class="text-body-secondary">
                                        {{ \Carbon\Carbon::parse($checkout->created_at)->translatedFormat('d M Y H:i') }}
                                    </small>
                                </div>

                                <div class="d-flex w-100 justify-content-between">
                                    <p class="mb-1 text-capitalize"> {{ $checkout->materiel_details }}</p>
                                     <small class=" px-2 m-0 fw-bold rounded-pill border {{ $checkout->statut == 'En cours' ? 'text-warning' : 'text-danger' }}">
                                        {{ $checkout->statut }}
                                    </small>
                                     <img class="dropdown-toggle  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                            src="https://ui-avatars.com/api/?name={{ $checkout->utilisateur->nom }}"
                                            alt="Profil" width="20" height="20"
                                            class="rounded-circle me-2">
                                </div>

                                <div class="d-flex w-100 justify-content-between">
                                   
                                </div>
                            </a>
                        @endforeach




                        <div class="mt-4 d-flex justify-content-center">
                            {{ $checkouts->links() }}

                        </div>

                    </div>

                </section>
            </div>
        </div>
    </div>

</div>
