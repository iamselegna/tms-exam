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
    public function create(array $data)
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

            // Assign the task to the user
            $task->user()->associate(auth()->user());

            // Save the task
            $task->save();

            // Commit the transaction
            DB::commit();

            return ['status' => 'success', 'message' => 'Task created successfully'];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Failed to create task.'];
        }
    }

    public function update($id, $data)
    {


        try {
            DB::beginTransaction();

            // Create the slug and status id for the task

            $task = Task::find($id);

            $allDone = $someNotDone = false;

            if (count($data['subTasks']) > 0) {

                $allDone = count(array_filter($data['subTasks'], function ($subTask) {
                    return $subTask['status'] !== TaskStatus::DONE;
                })) === 0;

                $someNotDone = count(array_filter($data['subTasks'], function ($subTask) {
                    return $subTask['status'] !== TaskStatus::DONE;
                })) > 0;
            }

            $task->update([
                'slug' => Str::slug($data['title']),
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => $allDone ? ($someNotDone ? TaskStatus::IN_PROGRESS : TaskStatus::DONE) : $data['status'],
                'is_draft' => $data['is_draft'],
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

            // Save the task
            $task->save();

            // Commit the transaction
            DB::commit();

            return ['status' => 'success', 'message' => 'Task updated successfully'];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Failed to update task.'];
        }
    }
}
