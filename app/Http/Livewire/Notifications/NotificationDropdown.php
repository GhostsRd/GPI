<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationDropdown extends Component
{
    public $unreadCount = 0;
    public $notifications = [];

    protected $listeners = ['notificationReceived' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->notifications = $user->notifications()
                ->latest()
                ->take(10)
                ->get();
            
            $this->unreadCount = $user->unreadNotifications()->count();
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->loadNotifications();
            $this->emit('notificationReceived'); // Notifier les autres composants
            
            // Redirection vers le lien si présent
            if (isset($notification->data['link']) && $notification->data['link'] !== '#') {
                return redirect($notification->data['link']);
            } else {
                // Si pas de lien, afficher le contenu dans un toast
                $this->dispatchBrowserEvent('toast', [
                    'type' => 'info',
                    'message' => $notification->data['message'] ?? 'Notification lue'
                ]);
            }
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        
        $this->loadNotifications();
        $this->dispatchBrowserEvent('notificationsMarkedAsRead');
        $this->emit('notificationReceived');
    }

    public function render()
    {
        return view('livewire.notifications.notification-dropdown');
    }
}
