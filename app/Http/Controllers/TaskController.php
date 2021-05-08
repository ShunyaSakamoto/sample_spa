<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        return Task::Paginate(10);
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function store(TaskRequest $request)
    {
        return Task::create($request->all());
    }

    public function update(Request $request, Task $task)
    {
        return $task->update($request->all());
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        return $task;
    }
}
