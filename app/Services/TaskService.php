<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data)
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task)
    {
        $task->delete();
    }

    public function reorder(array $order)
    {
        foreach ($order as $priority => $id) {
            Task::where('id', $id)->update(['priority' => $priority + 1]);
        }
    }
}
