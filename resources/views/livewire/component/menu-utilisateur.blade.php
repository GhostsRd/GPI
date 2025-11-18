<div>
     <ul style="list-style: none " class="px-2 py-2 ">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                <div class="d-flex align-items-center" style="cursor: pointer" wire:click="Pageacceuil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="me-2 text-gradient text-secondary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg>
                    <h class="fw-bold text-dark mb-0" >Page d'acceuil / </h>
                </div>

                <div class="text-end">
                    {{-- <span class="text-muted small me-2">#12</span> --}}

                </div>
            </div>
            <li style="cursor: pointer" class="bg-light bg-gradient py-2 "
                wire:click="openReservationModal" data-bs-toggle="modal"
                data-bs-target="#centeredModalreservation"><svg width="20" class="text-danger-emphasis mr-1"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Nouveau 

            </li>
            <li style="cursor: pointer" wire:click="redicrectlink(3)"
                class="mt-1 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                    <svg width="20" class="text-danger-emphasis mr-1" xmlns="http://www.w3.org/2000/svg"
                        fill="#FFE300" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg> <span class="mx-2">Mes incident</span>
                </div>


                <div class="text-end">
                    <span class=" text-muted small me-2 fw-bold ">{{ count($incidentcount) }}</span>

                </div>
            </li>
            <li style="cursor: pointer" wire:click="redicrectlink(1)"
                class="mt-1 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                    <svg width="20" class="text-danger-emphasis mr-1" xmlns="http://www.w3.org/2000/svg"
                        fill="#FFE300" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg> <span class="mx-2">Mes tickets</span>
                </div>


                <div class="text-end">
                    <span class="text-muted  small me-2 fw-bold ">{{ count($ticketcounts) }}</span>

                </div>
            </li>
            <li style="cursor: pointer" wire:click="redicrectlink(4)"
                class="mt-1 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                    <svg width="20" class="text-danger-emphasis mr-1" xmlns="http://www.w3.org/2000/svg"
                        fill="#FFE300" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg> <span class="mx-2">Mes reservations</span>
                </div>


                <div class="text-end">
                    <span class=" text-muted small me-2 fw-bold ">{{ count($reservationcount) }}</span>

                </div>
            </li>
            <li style="cursor: pointer" wire:click="redicrectlink(2)"
                class="mt-1 d-flex justify-content-between align-items-center ">
                <div class="d-flex align-items-center">

                    <svg width="20" class="text-danger-emphasis mr-1" xmlns="http://www.w3.org/2000/svg"
                        fill="#FFE300" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg> <span class="mx-2">Mes checkout</span>
                </div>
                <div class="text-end">
                    <span class="text-muted  small me-2 fw-bold">{{ count($incidentcount) }}</span>

                </div>
            </li>

        </ul>
</div>
