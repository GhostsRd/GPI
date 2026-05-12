<div class="bg-white rounded shadow-sm transition-all shadow-none"
    style="width: {{ $isCollapsed ? '75px' : '260px' }}; min-height: 100vh; transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative;">

    <div wire:loading.flex class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 justify-content-center align-items-center" style="z-index: 10;">
        <div class="spinner-border text-secondary" role="status" style="width: 1.5rem; height: 1.5rem;"></div>
    </div>

    @php
    // Définition des items du menu
    $menuItems = [
        ['id' => 3, 'label' => 'Mes incidents', 'count' => count($incidentcount), 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
        ['id' => 1, 'label' => 'Mes tickets', 'count' => count($ticketcounts), 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
        ['id' => 4, 'label' => 'Mes réservations', 'count' => count($reservationcount), 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['id' => 2, 'label' => 'Mes checkout', 'count' => count($incidentcount), 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
    ];
    @endphp

    <div class="d-flex align-items-center {{ $isCollapsed ? 'justify-content-center' : 'justify-content-end' }} p-3">
        <button wire:click="toggleSidebar" class="btn btn-sm btn-light rounded-circle shadow-sm border-0">
            <i class="fas {{ $isCollapsed ? 'fa-bars' : 'fa-times' }} text-secondary"></i>
        </button>
    </div>  

    <ul class="nav flex-column px-2">
        
        <div class="d-flex align-items-center mb-4 {{ $isCollapsed ? 'justify-content-center' : 'ps-2' }}" 
             style="cursor: pointer" wire:click="Pageacceuil">
            <div class="bg-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-secondary">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
            @if(!$isCollapsed)
                <h6 class="fw-bold text-secondary mb-0 ms-2 text-truncate">Page d'accueil</h6>
            @endif
        </div>

        <li class="nav-link-pivot hover d-flex {{ $isCollapsed ? 'justify-content-center' : 'ps-2' }} align-items-center mb-3"
            wire:click="openReservationModal" style="cursor: pointer;">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                @if(!$isCollapsed)
                    <span class="ms-3 fw-bold">Nouveau</span>
                @endif
            </div>
        </li>

        @if(!$isCollapsed)
            <p class="text-uppercase text-muted small fw-bold mb-2 ps-2" style="letter-spacing: 1px; font-size: 0.65rem;">
                Mon Activité
            </p>
        @else
            <hr class="mx-2 opacity-25">
        @endif

        @foreach($menuItems as $item)
        <li wire:loading.attr="disabled"
            class="nav-link-pivot d-flex {{ $isCollapsed ? 'justify-content-center' : 'justify-content-between px-2' }} align-items-center mb-1"
            wire:click="redicrectlink({{ $item['id'] }})" 
            title="{{ $item['label'] }}"
            style="cursor: pointer; position: relative;">
            
            <div class="d-flex align-items-center">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}" />
                </svg>
                @if(!$isCollapsed)
                    <span class="ms-3 text-truncate">{{ $item['label'] }}</span>
                @endif
            </div>

            @if($item['count'] > 0)
                @if(!$isCollapsed)
                    <span class="badge-count">{{ $item['count'] }}</span>
                @else
                    <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill border border-light shadow-sm" 
                          style="font-size: 0.55rem; transform: translate(12px, -5px) !important; background-color: #5BC4BF; color: white;">
                        {{ $item['count'] }}
                    </span>
                @endif
            @endif
        </li>
        @endforeach
    </ul>
</div>