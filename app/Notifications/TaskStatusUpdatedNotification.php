<?php
// app/Notifications/TaskStatusUpdatedNotification.php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskStatusUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $recipientEmail;

    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->recipientEmail = "besureitsbunny@gmail.com";
    }

    public function via($notifiable)
    {
        return ['mail']; // You can add more channels here, like 'database', 'slack', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->to($this->recipientEmail) // Specify the recipient email address
            ->subject('Task Status Updated')
            ->line('The status of the task has been updated.')
            ->line('Task Name: ' . $this->task->name)
            ->line('New Status: ' . $this->task->status);
    }
}
