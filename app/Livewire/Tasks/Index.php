<?php

namespace App\Livewire\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $todos = Task::where('status', TaskStatus::TODO)->published()->with('upload')->get();
        $inProgress = Task::where('status', TaskStatus::IN_PROGRESS)->published()->get();
        $done = Task::where('status', TaskStatus::DONE)->published()->get();
        return view('livewire.tasks.index')->with(['todos' => $todos, 'inProgress' => $inProgress, 'done' => $done]);
    }
}
