@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-primary mb-4 text-center">Users Tasks and Projects</h1>

        @if ($users->isEmpty())
            <div class="alert alert-warning text-center">No users with tasks or projects found.</div>
        @else
            @foreach ($users as $user)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-user-circle me-2"></i>{{ $user->name }}
                            <small class="text-light">({{ $user->email }})</small>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h5 class="text-secondary mb-3"><i class="fas fa-tasks me-2"></i>Tasks:</h5>
                        @if ($user->tasks->isEmpty())
                            <p class="text-muted">No tasks created by this user.</p>
                        @else
                            <ul class="list-group mb-4">
                                @foreach ($user->tasks as $task)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $task->name }}</strong>
                                            <small class="text-muted d-block">
                                                Created: {{ $task->created_at->format('d M Y, h:i A') }}
                                            </small>
                                        </div>
                                        <span class="badge bg-info text-dark">Task</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <h5 class="text-secondary mb-3"><i class="fas fa-project-diagram me-2"></i>Projects:</h5>
                        @if ($user->projects->isEmpty())
                            <p class="text-muted">No projects created by this user.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($user->projects as $project)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $project->name }}</strong>
                                            <small class="text-muted d-block">
                                                Created: {{ $project->created_at->format('d M Y, h:i A') }}
                                            </small>
                                        </div>
                                        <span class="badge bg-success text-white">Project</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('vendor.pagination.bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
