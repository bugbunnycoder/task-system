<?php
// app/Events/TaskStatusUpdated.php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class TaskStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $oldStatus;
    public $newStatus;

    /**
     * Create a new event instance.
     *
     * @param Task $task The task instance
     * @param int $oldStatus The old status
     * @param int $newStatus The new status
     * @return void
     */
    public function __construct(Task $task, $oldStatus, $newStatus)
    {
        $this->task = $task;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }
}
