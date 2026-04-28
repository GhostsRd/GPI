<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class NotificationList extends Component
{
    use WithPagination;
    
    public $filterStatus = 'all'; // all, unread, read
    public $filterType = 'all';
    public $search = '';
    public $selectedNotification = null;
    
    protected $queryString = [
        'filterStatus' => ['except' => 'all'],
        'filterType' => ['except' => 'all'],
        'search' => ['except' => ''],
    ];

    protected $listeners = ['notificationReceived' => '$refresh'];

    protected $paginationTheme = 'bootstrap';

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
            $this->emit('notificationReceived');
            return $notification;
        }
        return null;
    }

    public function showDetail($id)
    {
        $notification = $this->markAsRead($id);
        if ($notification) {
            $this->selectedNotification = [
                'id' => $notification->id,
                'title' => $notification->data['title'] ?? 'Notification',
                'message' => $notification->data['message'] ?? '',
                'icon' => $notification->data['icon'] ?? 'bi bi-bell',
                'color' => $notification->data['color'] ?? 'primary',
                'link' => $notification->data['link'] ?? '#',
                'created_at' => $notification->created_at->diffForHumans(),
                'full_date' => $notification->created_at->format('d/m/Y H:i'),
                'type' => $notification->data['type'] ?? 'info'
            ];
            $this->dispatchBrowserEvent('openNotificationModal');
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->emit('notificationReceived');
    }

    public function delete($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->delete();
            $this->emit('notificationReceived');
        }
    }

    public function deleteAll()
    {
        Auth::user()->notifications()->delete();
        $this->emit('notificationReceived');
    }

    public function getStatsProperty()
    {
        $user = Auth::user();
        return [
            'total' => $user->notifications()->count(),
            'unread' => $user->unreadNotifications()->count(),
            'today' => $user->notifications()->whereDate('created_at', now()->toDateString())->count(),
        ];
    }

    public function getNotificationTypesProperty()
    {
        // Get unique types from data column
        $notifications = Auth::user()->notifications()->get();
        return $notifications->map(fn($n) => $n->data['type'] ?? 'info')->unique()->values();
    }

    public function render()
    {
        $query = Auth::user()->notifications();

        if ($this->filterStatus === 'unread') {
            $query->whereNull('read_at');
        } elseif ($this->filterStatus === 'read') {
            $query->whereNotNull('read_at');
        }

        if ($this->filterType !== 'all') {
            $query->where('data->type', $this->filterType);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('data->title', 'like', '%' . $this->search . '%')
                  ->orWhere('data->message', 'like', '%' . $this->search . '%');
            });
        }

        $notifications = $query->latest()->paginate(10);

        return view('livewire.notifications.notification-list', [
            'notifications' => $notifications,
            'stats' => $this->stats,
            'availableTypes' => $this->notificationTypes
        ]);
    }
}
