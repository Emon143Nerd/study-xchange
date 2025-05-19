<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResourceSpaceRequestResponseNotification extends Notification
{
    use Queueable;

    public $action;
    public $resourceSpaceName;
    public $creatorId;

    /**
     * Create a new notification instance.
     */
    public function __construct($action, $resourceSpaceName, $creatorId)
    {
        $this->action = $action;
        $this->resourceSpaceName = $resourceSpaceName;
        $this->creatorId = $creatorId;  // Store the creator's ID
    }



    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
//    public function toArray($notifiable)
//    {
//        return [
//            'message' => "Your join request to the resource space '{$this->resourceSpaceName}' has been {$this->action}.",
//            'resourceSpaceName' => $this->resourceSpaceName,
//            'action' => $this->action,
//            'creatorId' => $this->creatorId,  // Add creator ID to the notification data
//        ];
//    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Your join request to the resource space '{$this->resourceSpaceName}' has been {$this->action}.",
            'resourceSpaceName' => $this->resourceSpaceName,
            'action' => $this->action,
            'creatorId' => $this->creatorId,  // Correctly pass the creator ID
        ];
    }


}
