<?php

namespace App\Notifications;

use App\Models\NormalUser\ResourceSpace\ResourceSpaceJoiningRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResourceSpaceJoinRequestNotification extends Notification
{
    use Queueable;

    public $joinRequest;
    public $action;

    public function __construct(ResourceSpaceJoiningRequest $joinRequest, $action)
    {
        $this->joinRequest = $joinRequest;
        $this->action = $action;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // You can also add 'mail' if you want email notifications.
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }


    public function toArray(object $notifiable): array
    {
        return [
            // You can customize this as per your requirements
        ];
    }


    public function toDatabase($notifiable)
    {

        return [
            'resource_space_id' => $this->joinRequest->resource_space_id,
            'requester_id' => $this->joinRequest->user_id,
            'requester_name' => $this->joinRequest->user->name,
            'action' => $this->action,
        ];
    }

}

