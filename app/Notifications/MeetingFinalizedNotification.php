<?php

namespace App\Notifications;

use App\Models\NormalUser\ResearchMeeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingFinalizedNotification extends Notification
{
    use Queueable;
    public $meeting;
    public $finalizedTime;

    /**
     * Create a new notification instance.
     */
    public function __construct(ResearchMeeting $meeting, $finalizedTime)
    {
        $this->meeting = $meeting;
        $this->finalizedTime = $finalizedTime;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Meeting Finalized: ' . $this->meeting->project->title)
            ->line('The meeting time for the project "' . $this->meeting->project->title . '" has been finalized.')
            ->line('Finalized Time: ' . $this->finalizedTime)
            ->line('Zoom Link: ' . ($this->meeting->zoom_link ?? 'Not provided'))
            ->line('Meet Link: ' . ($this->meeting->meet_link ?? 'Not provided'))
            ->action('View Meeting Details', url(route('research-meeting.detail', $this->meeting->id)))
            ->line('Thank you for your participation!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'The meeting time for the project "' . $this->meeting->project->title . '" has been finalized.',
            'finalized_time' => $this->finalizedTime,
            'meeting_id' => $this->meeting->id,
            'project_id' => $this->meeting->project->id,
            'meeting_link' => $this->meeting->meeting_link,
            'action_url' => route('normal-user.research-project.detail', $this->meeting->id),
        ];
    }
}
