@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Projects
            </a>
        </div>

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Project Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $project->name }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Project</button>
        </form>
    </div>
@endsection
