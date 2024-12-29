@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Create Task</h3>
                    </div>
                    <div class="d-flex justify-content-end mb-3 mt-2 p-2">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Tasks
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Task Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter task name" required>
                            </div>

                            <div class="mb-3">
                                <label for="project_id" class="form-label">Project:</label>
                                <select name="project_id" id="project_id" class="form-select">
                                    <option value="">No Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus-circle me-1"></i> Create Task
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
