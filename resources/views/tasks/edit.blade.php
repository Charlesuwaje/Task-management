@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h3 class="mb-0">Edit Task</h3>
                    </div>
                    <div class="d-flex justify-content-end mb-3 mt-2 p-2">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Tasks
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Task Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $task->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="project_id" class="form-label">Project:</label>
                                <select name="project_id" id="project_id" class="form-select">
                                    <option value="">No Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ $task->project_id == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="fas fa-edit me-1"></i> Update Task
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
