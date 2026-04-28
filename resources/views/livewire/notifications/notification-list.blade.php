<div class="container-fluid py-4" x-data="{ showFilters: false }">
    <!-- Stats Header -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="stats-card glass-card p-4 h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #4fbbb2, #3a8c85);">
                <div class="position-relative z-1 text-white">
                    <p class="text-white text-opacity-75 small fw-bold mb-1 text-uppercase letter-spacing-1">Total</p>
                    <h2 class="fw-black mb-0">{{ $stats['total'] }}</h2>
                    <div class="mt-2 small">
                        <span class="text-white text-opacity-50">Toutes les notifications</span>
                    </div>
                </div>
                <i class="bi bi-bell position-absolute end-0 bottom-0 mb-n3 me-n2 text-white opacity-25" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stats-card glass-card p-4 h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #f1705a, #cc5a48);">
                <div class="position-relative z-1 text-white">
                    <p class="text-white text-opacity-75 small fw-bold mb-1 text-uppercase letter-spacing-1">Nouvelles</p>
                    <h2 class="fw-black mb-0">{{ $stats['unread'] }}</h2>
                    <div class="mt-2 small">
                        <span class="text-white text-opacity-75 fw-semibold">{{ $stats['unread'] > 0 ? 'Action requise' : 'À jour' }}</span>
                    </div>
                </div>
                <i class="bi bi-envelope-exclamation position-absolute end-0 bottom-0 mb-n3 me-n2 text-white opacity-25" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stats-card glass-card p-4 h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #4b5563, #1f2937);">
                <div class="position-relative z-1 text-white">
                    <p class="text-white text-opacity-75 small fw-bold mb-1 text-uppercase letter-spacing-1">Aujourd'hui</p>
                    <h2 class="fw-black mb-0">{{ $stats['today'] }}</h2>
                    <div class="mt-2 small">
                        <span class="text-white text-opacity-50">Dernières 24h</span>
                    </div>
                </div>
                <i class="bi bi-calendar-check position-absolute end-0 bottom-0 mb-n3 me-n2 text-white opacity-25" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stats-card glass-card p-4 h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden bg-white">
                <div class="position-relative z-1">
                    <p class="text-muted small fw-bold mb-1 text-uppercase letter-spacing-1">Actions rapides</p>
                    <div class="d-grid gap-2 mt-2">
                        <button wire:click="markAllAsRead" class="btn btn-sm btn-outline-primary rounded-3 text-start">
                            <i class="bi bi-check2-all me-2"></i> Tout lire
                        </button>
                        <button wire:click="deleteAll" onclick="confirm('Supprimer tout ?') || event.stopImmediatePropagation()" class="btn btn-sm btn-outline-danger rounded-3 text-start">
                            <i class="bi bi-trash3 me-2"></i> Tout supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
        <!-- Main Actions & Search -->
        <div class="p-4 border-bottom">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="search-bar position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" wire:model.debounce.300ms="search" class="form-control ps-5 rounded-4 border-0 bg-light py-2" placeholder="Rechercher une notification (titre, message)...">
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex justify-content-md-end gap-2">
                        <div class="btn-group rounded-4 overflow-hidden border shadow-sm">
                            <button type="button" wire:click="$set('filterStatus', 'all')" class="btn btn-sm {{ $filterStatus == 'all' ? 'btn-primary' : 'btn-white' }}">Toutes</button>
                            <button type="button" wire:click="$set('filterStatus', 'unread')" class="btn btn-sm {{ $filterStatus == 'unread' ? 'btn-primary' : 'btn-white' }}">Non lues</button>
                            <button type="button" wire:click="$set('filterStatus', 'read')" class="btn btn-sm {{ $filterStatus == 'read' ? 'btn-primary' : 'btn-white' }}">Lues</button>
                        </div>
                        <button @click="showFilters = !showFilters" class="btn btn-white btn-sm border shadow-sm rounded-4 px-3" :class="{ 'active': showFilters }">
                            <i class="bi bi-funnel me-1"></i> Filtres
                        </button>
                    </div>
                </div>
            </div>

            <!-- Advanced Filters -->
            <div x-show="showFilters" x-transition class="mt-3 p-3 bg-light rounded-4 border">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label class="small fw-bold text-muted mb-1 d-block text-uppercase letter-spacing-1">Type d'activité</label>
                        <select wire:model="filterType" class="form-select form-select-sm border-0 rounded-3">
                            <option value="all">Tous les types</option>
                            @foreach($availableTypes as $type)
                                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8 text-end align-self-end">
                        <button wire:click="$set('filterType', 'all')" class="btn btn-link btn-sm text-decoration-none text-muted">Réinitialiser</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="p-0">
            <div class="list-group list-group-flush">
                @forelse($notifications as $notification)
                    <div class="notification-dashboard-item border-0 p-4 transition-all {{ $notification->unread() ? 'is-unread' : '' }}" style="border-left: 4px solid transparent !important;">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon-container me-4">
                                <div class="icon-circle shadow-sm d-flex align-items-center justify-content-center bg-{{ $notification->data['color'] ?? 'primary' }} bg-opacity-10 text-{{ $notification->data['color'] ?? 'primary' }}">
                                    <i class="{{ $notification->data['icon'] ?? 'bi bi-bell' }} fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-1">
                                    <h6 class="mb-0 fw-bold d-flex align-items-center text-dark">
                                        {{ $notification->data['title'] ?? 'Notification' }}
                                        @if($notification->unread())
                                            <span class="badge bg-primary ms-2 rounded-pill" style="font-size: 0.6rem;">Nouveau</span>
                                        @endif
                                    </h6>
                                    <div class="text-muted small">
                                        <i class="bi bi-clock me-1"></i> {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <p class="mb-3 text-muted pe-md-5">{{ $notification->data['message'] }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div class="d-flex gap-3">
                                        @if($notification->unread())
                                            <button wire:click="markAsRead('{{ $notification->id }}')" class="btn btn-soft-primary btn-sm rounded-3">
                                                <i class="bi bi-check2 me-1"></i> Lu
                                            </button>
                                        @endif
                                        @if($notification->data['link'] ?? false)
                                            <button wire:click="showDetail('{{ $notification->id }}')" class="btn btn-white btn-sm border shadow-sm rounded-3">
                                                <i class="bi bi-eye me-1"></i> Voir détails
                                            </button>
                                        @endif
                                    </div>
                                    <button wire:click="delete('{{ $notification->id }}')" class="btn btn-link btn-sm text-danger text-decoration-none opacity-50 hover-opacity-100 p-0">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <div class="empty-state-icon bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="bi bi-bell-slash text-muted" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold text-dark">Aucune notification</h5>
                        <p class="text-muted px-4">Nous n'avons trouvé aucune notification correspondant à vos critères.</p>
                        @if($search || $filterType != 'all' || $filterStatus != 'all')
                            <button wire:click="$set('search', ''); $set('filterType', 'all'); $set('filterStatus', 'all');" class="btn btn-primary rounded-pill px-4 mt-2">
                                Réinitialiser les filtres
                            </button>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
            <div class="p-4 bg-light border-top d-flex justify-content-center">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

    <!-- Additional Styles -->
    <style>
        .fw-black { font-weight: 900; }
        .letter-spacing-1 { letter-spacing: 0.05em; }
        
        .glass-card {
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }

        .notification-dashboard-item {
            border-bottom: 1px solid #f1f5f9 !important;
            transition: all 0.2s ease;
        }
        
        .notification-dashboard-item:hover {
            background-color: #f8fafc;
        }
        
        .notification-dashboard-item.is-unread {
            background-color: rgba(79, 187, 178, 0.02);
            border-left: 4px solid var(--primary) !important;
        }

        .icon-circle {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            flex-shrink: 0;
        }
        
        .btn-white {
            background-color: white;
            color: #4b5563;
        }
        
        .btn-white:hover, .btn-white.active {
            background-color: #f8fafc;
        }
        
        .btn-soft-primary {
            background-color: rgba(79, 187, 178, 0.1);
            color: var(--primary);
            border: none;
        }
        
        .btn-soft-primary:hover {
            background-color: var(--primary);
            color: white;
        }

        .transition-all { transition: all 0.3s ease; }
        .hover-opacity-100:hover { opacity: 1 !important; }
        
        .empty-state-icon i {
            animation: pulse-light 2s infinite;
        }
        
        @keyframes pulse-light {
            0% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 0.5; }
        }
    </style>

    <!-- Detail Modal -->
    <div wire:ignore.self class="modal fade" id="notificationDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                @if($selectedNotification)
                    <div class="modal-header border-0 pb-0">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle-sm bg-{{ $selectedNotification['color'] }} bg-opacity-10 text-{{ $selectedNotification['color'] }} me-2">
                                <i class="{{ $selectedNotification['icon'] }}"></i>
                            </div>
                            <h5 class="modal-title fw-bold">{{ $selectedNotification['title'] }}</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="mb-4">
                            <label class="small fw-bold text-muted text-uppercase letter-spacing-1 d-block mb-1">Message</label>
                            <p class="fs-5 text-dark mb-0">{{ $selectedNotification['message'] }}</p>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="small fw-bold text-muted text-uppercase letter-spacing-1 d-block mb-1">Date</label>
                                <span class="text-dark small"><i class="bi bi-calendar3 me-1"></i> {{ $selectedNotification['full_date'] }}</span>
                            </div>
                            <div class="col-6">
                                <label class="small fw-bold text-muted text-uppercase letter-spacing-1 d-block mb-1">Type</label>
                                <span class="badge bg-{{ $selectedNotification['color'] }} bg-opacity-10 text-{{ $selectedNotification['color'] }} rounded-pill px-3">
                                    {{ ucfirst($selectedNotification['type']) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 justify-content-center">
                        @if($selectedNotification['link'] && $selectedNotification['link'] !== '#')
                            <a href="{{ $selectedNotification['link'] }}" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-box-arrow-up-right me-2"></i> Accéder à la ressource
                            </a>
                        @endif
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Fermer</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('openNotificationModal', event => {
            var myModal = new bootstrap.Modal(document.getElementById('notificationDetailModal'));
            myModal.show();
        });
    </script>
    @endpush

    <style>
        .icon-circle-sm {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</div>
