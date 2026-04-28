<div class="dropdown" wire:poll.30s="loadNotifications">
    <a class="nav-link position-relative dropdown-toggle-no-caret" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="notification-bell {{ $unreadCount > 0 ? 'has-notifications' : '' }}">
            <i class="bi bi-bell fs-5"></i>
            @if($unreadCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                    {{ $unreadCount }}
                    <span class="visually-hidden">notifications non lues</span>
                </span>
            @endif
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdown" style="width: 380px; max-width: 380px; border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15); padding: 0; background: white; z-index: 9999;">
        <div class="notification-header d-flex justify-content-between align-items-center p-3 border-bottom" style="background: #f8fafc; border-radius: 20px 20px 0 0;">
            <div>
                <h6 class="mb-0 fw-bold">Notifications</h6>
                <small class="text-muted">{{ $unreadCount }} non lue{{ $unreadCount > 1 ? 's' : '' }}</small>
            </div>
            @if($unreadCount > 0)
                <div>
                    <button class="btn btn-sm btn-link text-primary text-decoration-none" wire:click="markAllAsRead">
                        <i class="bi bi-check2-all"></i> Tout marquer comme lu
                    </button>
                </div>
            @endif
        </div>
        <div class="notification-list" style="max-height: 400px; overflow-y: auto;">
            @forelse($notifications as $notification)
                <a href="{{ $notification->data['link'] ?? '#' }}" wire:click.prevent="markAsRead('{{ $notification->id }}')" class="dropdown-item notification-item {{ $notification->unread() ? 'unread' : '' }} px-3 py-3 border-bottom" style="{{ $notification->unread() ? 'background: #f0f9ff;' : '' }} transition: all 0.2s;">
                    <div class="d-flex">
                        <div class="notification-icon me-3">
                            <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: {{ $notification->unread() ? 'rgba(79, 187, 178, 0.1)' : '#f1f5f9' }}; border-radius: 12px;">
                                <i class="{{ $notification->data['icon'] ?? 'bi bi-info-circle' }} text-{{ $notification->data['color'] ?? 'primary' }}" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                        <div class="notification-content flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-0 {{ $notification->unread() ? 'fw-bold text-dark' : 'text-muted' }}" style="font-size: 0.85rem;">
                                        {{ $notification->data['title'] ?? 'Notification' }}
                                    </h6>
                                    <p class="mb-0 text-muted" style="font-size: 0.8rem; line-height: 1.2;">
                                        {{ $notification->data['message'] }}
                                    </p>
                                </div>
                                <small class="text-muted ms-2" style="font-size: 0.65rem; white-space: nowrap;">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-4 text-center">
                    <i class="bi bi-bell-slash text-muted mb-2 fs-3"></i>
                    <p class="text-muted small mb-0">Aucune notification</p>
                </div>
            @endforelse
        </div>
        <div class="notification-footer p-3 text-center border-top">
            <a href="{{ route('admin.notifications') }}" class="text-decoration-none text-primary small fw-semibold">
                Voir toutes les notifications
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
