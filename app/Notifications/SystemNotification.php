<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SystemNotification extends Notification
{
    use Queueable;

    public $message;
    public $title;
    public $type;
    public $url;

    /**
     * Create a new notification instance.
     *
     * @param string $title
     * @param string $message
     * @param string $type (e.g. 'warning', 'success', 'info', 'danger')
     * @param string|null $url
     */
    public function __construct($title, $message, $type = 'info', $url = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', \App\Broadcasting\WhatsappChannel::class];
    }
    
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
            'url' => $this->url,
            'icon' => $this->getIcon(),
        ];
    }

    private function getIcon()
    {
        return match($this->type) {
            'warning' => 'ki-time',
            'success' => 'ki-check-circle',
            'danger' => 'ki-message-text-2',
            default => 'ki-information-5'
        };
    }
}
