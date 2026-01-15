@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Manager Panel</a>
            <div class="ms-auto text-white">
                {{ auth()->user()->name }}
            </div>
             <div class='m-4'>
               <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <h3 class="mb-4">All Tasks</h3>

        @if ($tasks->isEmpty())
            <div class="alert alert-info">
                No tasks available.
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Assigned Staff</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->staff->name ?? 'N/A' }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $task->status == 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $task->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($task->status == 'pending')
                                            <a href="{{ route('manager.task.edit', $task->id) }}"
                                                class="btn btn-sm btn-primary">
                                                Edit
                                            </a>
                                        @else
                                            <span class="text-muted">Locked</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        @endif

    </div>

</body>

</html>
