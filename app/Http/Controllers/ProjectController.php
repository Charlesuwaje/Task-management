<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        Project::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('projects.index');
    }

    public function edit($id)
    {
        $project = Project::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string']);
        $project = Project::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}
