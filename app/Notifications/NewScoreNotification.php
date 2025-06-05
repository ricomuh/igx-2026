<?php

namespace App\Notifications;

use App\Models\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewScoreNotification extends Notification
{
    use Queueable;

    /**
     * The score instance.
     *
     * @var \App\Models\Score
     */
    protected Score $score;

    /**
     * Create a new notification instance.
     */
    public function __construct(Score $score)
    {
        $this->score = $score;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Hi ' . $this->score->username . ', thank you for playing!')
            ->greeting('Hello ' . $this->score->username . '!')
            ->line('Your score of ' . number_format($this->score->score) . ' has been recorded successfully.')
            ->line('Thank you for participating!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
