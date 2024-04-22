<?php

namespace App\Livewire\Tasks\Management;

use App\Services\TaskService;
use App\Traits\TaskTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    use TaskTrait;


    public function store($draft = false)
    {
        $validated = Validator::make(
            [
                'title' => $this->title,
                'content' => $this->content,
                'attachment' => $this->attachment,
                'subTasks' => $this->subTasks
            ],
            [
                'title' => 'required|max:100|unique:tasks,title',
                'content' => 'required|max:255',
                'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'subTasks' => 'nullable',
                'subTasks.*.title' => 'required|max:100',
                'subTasks.*.content' => 'required|max:255'
            ]
        )->validate();

        $taskService = new TaskService();

        $task = $taskService->create($validated, $draft);

        if ($task['status'] === 'success') {
            $this->dispatch('alert', title: 'Success', description: $task['message'], icon: 'success');
            $this->reset();
        } else {
            $this->dispatch('alert', title: 'Error!', description: $task['message'], icon: 'error');
        }
    }
    public function render()
    {
        return view('livewire.tasks.management.create');
    }
}
