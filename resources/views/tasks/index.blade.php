@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Task Management</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Add Task
            </a>
        </div>

        <form method="GET" action="{{ route('tasks.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <label for="project" class="form-label">Filter by Project:</label>
                    <select name="project_id" id="project" class="form-select" onchange="this.form.submit()">
                        <option value="">All Projects</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"
                                {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        @if ($tasks->isEmpty())
            <div class="alert alert-warning">No tasks available for the selected project.</div>
        @else
            <ul id="task-list" class="list-group">
                @foreach ($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-light"
                        data-id="{{ $task->id }}">
                        <span>
                            <strong>{{ $task->name }}</strong>
                            <small class="text-muted">(Priority: {{ $task->priority }})</small>
                        </span>
                        <div>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        const taskList = document.getElementById('task-list');
        Sortable.create(taskList, {
            animation: 150,
            onEnd: function(event) {
                const order = Array.from(taskList.children).map((item, index) => ({
                    id: item.dataset.id,
                    priority: index + 1,
                }));

                fetch('{{ route('tasks.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        order
                    }),
                });
            },
        });
    </script>
@endsection
