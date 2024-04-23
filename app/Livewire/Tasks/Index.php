<?php

namespace App\Livewire\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $viewModal = false;
    public Task $taskData;
    public $statusReferences;

    public function mount()
    {
        $this->statusReferences = TaskStatus::asSelectArray();
    }

    public function loadTask($id)
    {
        $this->viewModal = true;
        $this->taskData = Task::with(['upload'])->where('id', $id)->first();
        // dd($this->task);
    }

    public function changeStatus($id, $status)
    {
        try {
            DB::beginTransaction();

            $task = Task::find($id);

            $task->update([
                'status' => $status
            ]);

            $this->notification()->success(
                $title = 'Task Status Changed',
                $description = 'Task status changed successfully'
            );

            DB::commit();
        } catch (\Throwable $th) {
            $this->notification()->error(
                $title = 'Error !!!',
                $description = 'Task status not changed'
            );
        }
    }


    public function render()
    {
        $todos = Task::with('upload')->where('status', TaskStatus::TODO)->published()->byUser()->get();
        $inProgress = Task::with('upload')->where('status', TaskStatus::IN_PROGRESS)->published()->byUser()->get();
        $done = Task::with('upload')->where('status', TaskStatus::DONE)->published()->byUser()->get();
        return view('livewire.tasks.index')->with(['todos' => $todos, 'inProgress' => $inProgress, 'done' => $done]);
    }
}
