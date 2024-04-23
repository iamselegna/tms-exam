<?php

namespace App\Livewire\Tasks\Management;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\TaskStatusReference;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Index extends Component
{
    use WithPagination;
    use Actions;

    public $search;
    public $perPage = 10;
    public $orderBy = 'title';
    public $statusReferences;
    public $statusFilter;
    public $filterByTitle = false;
    public $filterByTitleSort = 'desc';
    public $filterByCreatedAt = true;
    public $filterByCreatedAtSort = 'desc';
    public $viewModal = false;

    public Task $taskData;

    public function mount()
    {
        $this->statusReferences = TaskStatus::asSelectArray();
    }

    public function confirmDelete($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete the task?',
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'delete',
            'params'      => $id,
        ]);
    }

    public function delete($id)
    {
        Task::destroy($id);
        $this->dispatch('alert', title: 'Success', description: 'Task deleted successfully', icon: 'success');
    }

    public function loadTask($id)
    {
        $this->viewModal = true;
        $this->taskData = Task::with(['upload'])->where('id', $id)->first();
        // dd($this->task);
    }

    public function toggleDraft($id, $status)
    {
        try {
            DB::beginTransaction();

            $task = Task::find($id);

            $task->update([
                'is_draft' => $status
            ]);

            $this->notification()->success(
                $title = 'Draft Status Changed',
                $description = 'Draft status changed successfully'
            );

            DB::commit();
        } catch (\Throwable $th) {
            $this->notification()->error(
                $title = 'Error !!!',
                $description = 'Draft status not changed'
            );
        }
    }

    public function render()
    {
        $tasks = Task::query()
            ->byUser()
            ->when($this->search, function ($query) {
                $query->search($this->search);
            })
            ->when($this->filterByTitle, function ($query) {
                $query->orderBy('title', $this->filterByTitleSort);
            })
            ->when($this->filterByCreatedAt, function ($query) {
                $query->orderBy('created_at', $this->filterByCreatedAtSort);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->paginate($this->perPage);

        return view('livewire.tasks.management.index')->with('tasks', $tasks);
    }
}
