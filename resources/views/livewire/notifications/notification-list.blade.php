<div class="container-fluid py-4" x-data="{ showFilters: false }">
    <!-- Stats Header Modern -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-wrapper bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-bell fs-4 text-primary"></i>
                        </div>
                        <span class="badge bg-light text-dark rounded-pill">Total</span>
                    </div>
                    <h2 class="display-6 fw-bold mb-1">{{ $stats['total'] }}</h2>
                    <p class="text-muted small mb-0">Toutes les notifications</p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-wrapper bg-danger bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-envelope-exclamation fs-4 text-danger"></i>
                        </div>
                        <span class="badge bg-light text-dark rounded-pill">Non lues</span>
                    </div>
                    <h2 class="display-6 fw-bold mb-1">{{ $stats['unread'] }}</h2>
                    <p class="text-muted small mb-0">{{ $stats['unread'] > 0 ? $stats['unread'].' notification(s) en attente' : 'Tout est lu' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift transition-all">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-wrapper bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-calendar-check fs-4 text-success"></i>
                        </div>
                        <span class="badge bg-light text-dark rounded-pill">Aujourd'hui</span>
                    </div>
                    <h2 class="display-6 fw-bold mb-1">{{ $stats['today'] }}</h2>
                    <p class="text-muted small mb-0">Dernières 24 heures</p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <button wire:click="markAllAsRead" class="btn btn-outline-primary rounded-3 btn-hover-slide">
                            <i class="bi bi-check2-all me-2"></i> Marquer tout comme lu
                        </button>
                        <button wire:click="deleteAll" onclick="confirm('Supprimer toutes les notifications ? Cette action est irréversible.') || event.stopImmediatePropagation()" class="btn btn-outline-danger rounded-3 btn-hover-slide">
                            <i class="bi bi-trash3 me-2"></i> Tout supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <!-- Filters Header -->
        <div class="card-header bg-white border-0 p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" wire:model.debounce.300ms="search" 
                               class="form-control ps-5 py-2 rounded-3 border-0 bg-light" 
                               placeholder="Rechercher une notification...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <div class="btn-group btn-group-sm rounded-3 shadow-sm" role="group">
                            <button type="button" wire:click="$set('filterStatus', 'all')" 
                                    class="btn {{ $filterStatus == 'all' ? 'btn-primary' : 'btn-light' }} px-3">
                                Toutes
                            </button>
                            <button type="button" wire:click="$set('filterStatus', 'unread')" 
                                    class="btn {{ $filterStatus == 'unread' ? 'btn-primary' : 'btn-light' }} px-3">
                                Non lues
                            </button>
                            <button type="button" wire:click="$set('filterStatus', 'read')" 
                                    class="btn {{ $filterStatus == 'read' ? 'btn-primary' : 'btn-light' }} px-3">
                                Lues
                            </button>
                        </div>
                        <button @click="showFilters = !showFilters" 
                                class="btn btn-light btn-sm shadow-sm rounded-3 px-3">
                            <i class="bi bi-funnel me-1"></i> Filtres
                            <i class="bi bi-chevron-down ms-1" :class="{ 'rotate-180': showFilters }"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Advanced Filters Panel -->
            <div x-show="showFilters" x-collapse.duration.300ms class="mt-4">
                <div class="bg-light rounded-3 p-3">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-8">
                            <label class="small fw-semibold text-muted mb-2 d-block">Type d'activité</label>
                            <select wire:model="filterType" class="form-select form-select-sm rounded-3 border-0">
                                <option value="all">Tous les types</option>
                                @foreach($availableTypes as $type)
                                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button wire:click="$set('filterType', 'all')" class="btn btn-sm btn-link text-muted text-decoration-none">
                                <i class="bi bi-arrow-repeat me-1"></i> Réinitialiser
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="list-group list-group-flush">
            @forelse($notifications as $notification)
                <div class="list-group-item border-0 p-4 transition-all notification-item {{ $notification->unread() ? 'unread' : '' }}">
                    <div class="d-flex gap-3">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <div class="rounded-3 p-3 d-flex align-items-center justify-content-center 
                                        bg-{{ $notification->data['color'] ?? 'primary' }} bg-opacity-10">
                                <i class="{{ $notification->data['icon'] ?? 'bi bi-bell' }} fs-5 text-{{ $notification->data['color'] ?? 'primary' }}"></i>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1 fw-semibold">
                                        {{ $notification->data['title'] ?? 'Notification' }}
                                        @if($notification->unread())
                                            <span class="badge bg-primary rounded-pill ms-2">Nouveau</span>
                                        @endif
                                    </h6>
                                </div>
                                <small class="text-muted ms-2">
                                    <i class="bi bi-clock me-1"></i> {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </div>
                            
                            <p class="text-secondary mb-3">{{ $notification->data['message'] }}</p>
                            
                            <div class="d-flex gap-2">
                                @if($notification->unread())
                                    <button wire:click="markAsRead('{{ $notification->id }}')" 
                                            class="btn btn-sm btn-link text-primary text-decoration-none p-0">
                                        <i class="bi bi-check2-circle me-1"></i> Marquer comme lu
                                    </button>
                                @endif
                                @if($notification->data['link'] ?? false)
                                    <button wire:click="showDetail('{{ $notification->id }}')" 
                                            class="btn btn-sm btn-link text-secondary text-decoration-none p-0">
                                        <i class="bi bi-eye me-1"></i> Voir détails
                                    </button>
                                @endif
                                <button wire:click="delete('{{ $notification->id }}')" 
                                        class="btn btn-sm btn-link text-danger text-decoration-none p-0 ms-auto">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <div class="empty-state-icon mx-auto bg-light rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h5 class="fw-semibold mb-2">Aucune notification</h5>
                    <p class="text-muted mb-4">Aucune notification ne correspond à vos critères</p>
                    @if($search || $filterType != 'all' || $filterStatus != 'all')
                        <button wire:click="$set('search', ''); $set('filterType', 'all'); $set('filterStatus', 'all');" 
                                class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-arrow-repeat me-2"></i> Réinitialiser les filtres
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
            <div class="card-footer bg-white border-0 p-4">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

    <!-- Detail Modal -->
    <div wire:ignore.self class="modal fade" id="notificationDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                @if($selectedNotification)
                    <div class="modal-header border-0 p-4 pb-0">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="rounded-3 p-2 bg-{{ $selectedNotification['color'] }} bg-opacity-10">
                                <i class="{{ $selectedNotification['icon'] }} fs-5 text-{{ $selectedNotification['color'] }}"></i>
                            </div>
                            <h5 class="modal-title fw-semibold">{{ $selectedNotification['title'] }}</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label class="small fw-semibold text-muted mb-2 d-block">Message</label>
                            <p class="mb-0">{{ $selectedNotification['message'] }}</p>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="small fw-semibold text-muted mb-2 d-block">Date</label>
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    {{ $selectedNotification['full_date'] }}
                                </span>
                            </div>
                            <div class="col-6">
                                <label class="small fw-semibold text-muted mb-2 d-block">Type</label>
                                <span class="badge bg-{{ $selectedNotification['color'] }} bg-opacity-10 text-{{ $selectedNotification['color'] }} rounded-pill">
                                    {{ ucfirst($selectedNotification['type']) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 justify-content-center gap-2">
                        @if($selectedNotification['link'] && $selectedNotification['link'] !== '#')
                            <a href="{{ $selectedNotification['link'] }}" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-box-arrow-up-right me-2"></i> Accéder
                            </a>
                        @endif
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Fermer</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Modern Styles */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
        }
        
        .transition-all {
            transition: all 0.2s ease;
        }
        
        .notification-item {
            transition: background-color 0.2s ease;
        }
        
        .notification-item:hover {
            background-color: #f8f9fa;
        }
        
        .notification-item.unread {
            background: linear-gradient(90deg, rgba(var(--bs-primary-rgb), 0.02) 0%, transparent 3%);
            border-left: 3px solid var(--bs-primary);
        }
        
        .btn-hover-slide {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-hover-slide:hover {
            transform: translateX(4px);
        }
        
        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.2s ease;
        }
        
        .empty-state-icon {
            transition: transform 0.2s ease;
        }
        
        .empty-state-icon:hover {
            transform: scale(1.05);
        }
        
        /* Smooth transitions for Alpine */
        [x-cloak] { display: none !important; }
        
        /* Modern scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            // Alpine is already initialized
        });
        
        window.addEventListener('openNotificationModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('notificationDetailModal'));
            modal.show();
        });
    </script>
    @endpush
</div>