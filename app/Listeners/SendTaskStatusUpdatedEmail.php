<?php

namespace App\Listeners;

use App\Events\TaskStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskStatusUpdatedEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  TaskStatusUpdated  $event
     * @return void
     */
    public function handle(TaskStatusUpdated $event)
    {
        $task = $event->task;
        $oldStatus = $event->oldStatus;
        $newStatus = $event->newStatus;
        $status = array(
            '0'=>'Hold',
            '1'=>'Assigned',
            '2'=>'Completed',
            '3'=>'Deadline Approaching',
        );

        // Logic to send email
        $recipientEmail = $task->employee->email; // Change this to the recipient's email address
        $ccEmail = 'besureitsbunny@gmail.com';
        $subject = 'Task Status Updated';
        $message = !is_null($oldStatus)?"Task status has been updated from {$status[$oldStatus]} to {$status[$newStatus]}!":"Task has been assigned to you!";

        // Send email
        Mail::raw($message, function ($mail) use ($recipientEmail, $subject,$ccEmail) {
            $mail->to($recipientEmail)
                ->cc($ccEmail)
                ->subject($subject);
        });
    }
}
