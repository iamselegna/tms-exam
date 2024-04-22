<?php

namespace App\Traits;

use App\Enums\TaskStatus;

trait TaskTrait
{
    public $title;
    public $content;
    public $status;
    public $attachment;
    public $subTasks = [];

    public function addSubTask()
    {
        // Check if there are less than 5 sub tasks
        if (count($this->subTasks) < 5) {
            $this->subTasks[] = ['title' => '', 'content' => '', 'status' => TaskStatus::TODO];
        }
    }

    public function removeSubTask($index)
    {
        // This will remove the sub task from the array
        unset($this->subTasks[$index]);
    }
}
