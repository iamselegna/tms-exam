<?php

namespace App\Livewire\Tasks\Management;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Services\TaskService;
use App\Traits\TaskTrait;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    use TaskTrait;

    public Task $task;
    public $statusReferences;

    public function mount($slug)
    {
        $this->task = Task::with(['upload'])->where('slug', $slug)->first();
        $this->title = $this->task->title;
        $this->content = $this->task->content;
        // dd($this->task->status->value);
        $this->status = $this->task->status->value;
        $this->subTasks = $this->task->sub_tasks ?? [];
        $this->statusReferences = TaskStatus::asSelectArray();
    }

    public function store($draft = false)
    {
        // dd($this->task);
        $validated = Validator::make(
            [
                'title' => $this->title,
                'content' => $this->content,
                'status' => $this->status,
                'attachment' => $this->attachment,
                'subTasks' => $this->subTasks,
                'is_draft' => $draft,
            ],
            [
                'title' => ['required', 'max:100', Rule::unique('tasks', 'title')->ignore($this->task->id)],
                'content' => 'required|max:255',
                'status' => ['required', new EnumValue(TaskStatus::class)],
                'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'subTasks' => 'nullable',
                'subTasks.*.title' => 'required|max:100',
                'subTasks.*.content' => 'required|max:255',
                'subTasks.*.status' => ['required', new EnumValue(TaskStatus::class)],
                'is_draft' => 'nullable',
            ]
        )->validate();

        $taskService = new TaskService();

        $task = $taskService->update($this->task->id, $validated, $draft);

        if ($task['status'] === 'success') {
            $this->dispatch('alert', title: 'Success', description: $task['message'], icon: 'success');
            // $this->resetExcept(['statusReferences']);
        } else {
            $this->dispatch('alert', title: 'Error!', description: $task['message'], icon: 'error');
        }
    }

    public function render()
    {
        return view('livewire.tasks.management.update');
    }
}
