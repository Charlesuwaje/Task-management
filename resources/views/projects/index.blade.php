@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Projects</h1>
            <a href="{{ route('projects.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i> Add Project
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">
                @if ($projects->isEmpty())
                    <p class="text-muted text-center">No projects available. Click "Add Project" to create one.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach ($projects as $project)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $project->name }}</span>
                                <div>
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this project?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
