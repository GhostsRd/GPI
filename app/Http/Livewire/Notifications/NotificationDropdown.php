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
            
            $this->unreadCount = $user->unreadNotifications->count();
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->loadNotifications();
            $this->emit('notificationReceived'); // Notify other components
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        
        $this->loadNotifications();
        $this->dispatchBrowserEvent('notificationsMarkedAsRead');
        $this->emit('notificationReceived');
    }

    public function render()
    {
        return view('livewire.notifications.notification-dropdown');
    }
}
