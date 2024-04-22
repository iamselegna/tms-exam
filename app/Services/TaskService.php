<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\TaskStatusReference;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskService
{
    public function create(array $data, bool $draft)
    {
        try {
            DB::beginTransaction();

            // Create the slug and status id for the task
            $data['slug'] = Str::slug($data['title']);
            $data['status'] = TaskStatus::TODO;

            // Create the task
            $task = Task::create(Arr::except($data, ['subTasks', 'attachment']));

            // If there are sub tasks, then store them
            if ($data['subTasks']) {
                $subTasks = Arr::map($data['subTasks'], function ($subTask) use ($task) {
                    $subTask['slug'] = Str::slug($subTask['title']);
                    return $subTask;
                });

                // Update the sub tasks
                $task->update(['sub_tasks' => $subTasks]);
            }

            // If there is an attachment, then store it
            if ($data['attachment']) {
                $attachment = $data['attachment']->store('tasks', 'public');
                $task->upload()->create([
                    'path' => $attachment
                ]);
            }

            // If draft, then mark the task as draft
            if ($draft) {
                $task->update(['is_draft' => true]);
            }

            // Assign the task to the user
            $task->user()->associate(auth()->user());

            // Save the task
            $task->save();

            // Commit the transaction
            DB::commit();

            return ['status' => 'success', 'message' => 'Task created successfully'];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $th->getMessage()];
        }
    }

    public function update($id, $data, $draft)
    {


        try {
            DB::beginTransaction();

            // Create the slug and status id for the task

            $task = Task::find($id);

            $task->update([
                'slug' => Str::slug($data['title']),
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => $data['status'],
            ]);

            // If there are sub tasks, then store them
            if ($data['subTasks']) {
                $subTasks = Arr::map($data['subTasks'], function ($subTask) use ($task) {
                    $subTask['slug'] = Str::slug($subTask['title']);
                    return $subTask;
                });

                // Update the sub tasks
                $task->update(['sub_tasks' => $subTasks]);
            }

            // If there is an attachment, then store it
            if ($data['attachment']) {
                $attachment = $data['attachment']->store('tasks', 'public');
                $task->upload()->update([
                    'path' => $attachment
                ]);
            }

            // If draft, then mark the task as draft
            if ($draft) {
                $task->update(['is_draft' => true]);
            }

            // Assign the task to the user
            $task->user()->associate(auth()->user());

            // Save the task
            $task->save();

            // Commit the transaction
            DB::commit();

            return ['status' => 'success', 'message' => 'Task created successfully'];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $th->getMessage()];
        }
    }
}
