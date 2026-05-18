<div wire:poll.30s="loadNotifications">
    <div class="d-flex justify-content-between align-items-center pb-3 border-bottom">
        <small class="text-muted">{{ $unreadCount }} non lue{{ $unreadCount > 1 ? 's' : '' }}</small>
        @if($unreadCount > 0)
            <button class="btn btn-sm btn-link text-primary text-decoration-none p-0" wire:click="markAllAsRead">
                <i class="bi bi-check2-all"></i> Tout marquer comme lu
            </button>
        @endif
    </div>
    
    <div class="notification-list mt-2" style="max-height: 60vh; overflow-y: auto;">
        @forelse($notifications as $notification)
            <a href="{{ $notification->data['link'] ?? '#' }}" wire:click.prevent="markAsRead('{{ $notification->id }}')" class="d-block text-decoration-none notification-item {{ $notification->unread() ? 'unread' : '' }} p-3 mb-2 rounded-3" style="{{ $notification->unread() ? 'background: rgba(79, 187, 178, 0.05); border: 1px solid rgba(79, 187, 178, 0.2);' : 'background: transparent; border: 1px solid var(--border);' }} transition: all 0.2s;">
                <div class="d-flex">
                    <div class="notification-icon me-3">
                        <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: {{ $notification->unread() ? 'rgba(79, 187, 178, 0.1)' : '#f1f5f9' }}; border-radius: 12px;">
                            <i class="{{ $notification->data['icon'] ?? 'bi bi-info-circle' }} text-{{ $notification->data['color'] ?? 'primary' }}" style="font-size: 1.2rem;"></i>
                        </div>
                    </div>
                    <div class="notification-content flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h6 class="mb-0 {{ $notification->unread() ? 'fw-bold text-dark' : 'text-muted' }}" style="font-size: 0.9rem;">
                                {{ $notification->data['title'] ?? 'Notification' }}
                            </h6>
                            <small class="text-muted ms-2" style="font-size: 0.7rem; white-space: nowrap;">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <p class="mb-0 text-muted" style="font-size: 0.85rem; line-height: 1.4;">
                            {{ $notification->data['message'] }}
                        </p>
                    </div>
                </div>
            </a>
        @empty
            <div class="p-5 text-center">
                <i class="bi bi-bell-slash text-muted mb-3" style="font-size: 2.5rem;"></i>
                <h6 class="fw-bold text-dark">Aucune notification</h6>
                <p class="text-muted small mb-0">Vous êtes à jour !</p>
            </div>
        @endforelse
    </div>
    
    <div class="notification-footer p-3 text-center border-top mt-2">
        <a href="{{ route('admin.notifications') }}" class="text-decoration-none text-primary small fw-semibold">
            Voir toutes les notifications
            <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>
