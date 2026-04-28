<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GPINotification extends Notification
{
    use Queueable;

    protected $payload;

    /**
     * Create a new notification instance.
     *
     * @param array $payload Must contain: title, message, icon, color, link
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->payload['title'] ?? 'Notification',
            'message' => $this->payload['message'] ?? '',
            'icon' => $this->payload['icon'] ?? 'fas fa-info-circle',
            'color' => $this->payload['color'] ?? 'primary',
            'link' => $this->payload['link'] ?? '#',
            'action_type' => $this->payload['type'] ?? 'info',
        ];
    }
}
