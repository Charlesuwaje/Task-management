<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    // public function index()
    // {
    //     $projects = Project::all();
    //     $tasks = Task::orderBy('priority', 'asc')->get();
    //     return view('tasks.index', compact('tasks', 'projects'));
    // }

    public function index(Request $request)
{
    $projects = Project::all();
    $tasks = Task::query();

    if ($request->has('project_id') && $request->project_id) {
        $tasks->where('project_id', $request->project_id);
    }

    $tasks = $tasks->orderBy('priority', 'asc')->get();
    // $tasks = Auth::check()
    // ? $tasks->orderBy('priority', 'asc')->get()
    // : $tasks->where('is_public', true)->orderBy('priority', 'asc')->get();

    return view('tasks.index', compact('tasks', 'projects'));
}


    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $this->taskService->create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'priority' => Task::max('priority') + 1,
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $this->taskService->update($task, $request->only('name', 'project_id'));
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->taskService->delete($task);
        return redirect()->route('tasks.index');
    }

    public function reorder(Request $request)
    {
        $this->taskService->reorder($request->order);
        return response()->json(['success' => true]);
    }
}
