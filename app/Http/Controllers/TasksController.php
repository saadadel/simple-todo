<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksStoreRequest;
use App\Http\Requests\TasksUpdateRequest;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tasks = Task::all();

        if($request->ajax())
            return response($tasks);

        return view('task.index', compact('tasks'));
    }

    public function store(TasksStoreRequest $request)
    {
        $request->storeTask();

        return response(['message'=> 'Task stored successfully']);
    }

    public function update(TasksUpdateRequest $request, Task $task)
    {
        $request->updateTask();

        return response(['message'=> 'Task updated successfully']);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response(['message'=> 'Task deleted successfully']);
    }
}
