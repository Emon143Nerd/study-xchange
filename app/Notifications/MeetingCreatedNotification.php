<?php

namespace App\Notifications;

use App\Models\NormalUser\ResearchMeeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingCreatedNotification extends Notification
{
    use Queueable;

    public $meeting;

    /**
     * Create a new notification instance.
     */
    public function __construct(ResearchMeeting $meeting)
    {
        $this->meeting = $meeting;
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
            ->subject('New Meeting Scheduled: ' . $this->meeting->project->title)
            ->line('A new meeting has been scheduled for the research project: ' . $this->meeting->project->title)
            ->line('Proposed Times:')
            ->line('1. ' . $this->meeting->time1)
            ->line('2. ' . $this->meeting->time2)
            ->line('3. ' . $this->meeting->time3)
            ->action('Respond to Meeting', url(route('research-meeting.detail', $this->meeting->id)))
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
            'message' => 'A new meeting has been scheduled for the research project: ' . $this->meeting->project->title,
            'meeting_id' => $this->meeting->id,
            'project_id' => $this->meeting->project->id,
            'times' => [
                'time1' => $this->meeting->time1,
                'time2' => $this->meeting->time2,
                'time3' => $this->meeting->time3,
            ],
            'action_url' => route('normal-user.research-project.detail', $this->meeting->id),
        ];
    }
}
