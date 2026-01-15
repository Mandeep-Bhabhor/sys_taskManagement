<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Staff Panel</a>

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

        <h3 class="mb-4">My Assigned Tasks</h3>

        @if ($tasks->isEmpty())
            <div class="alert alert-info">
                No tasks assigned to you. Enjoy the silence.
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Status</th>
                                <th>Assigned On</th>
                                <th>Complete the task </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $task->status == 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $task->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($task->status != 'completed')
                                            <form action="{{ route('task.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-sm btn-success">Mark Complete</button>
                                            </form>
                                        @else
                                            <span class="text-muted">Done</span>
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
