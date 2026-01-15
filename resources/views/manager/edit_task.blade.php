<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Manager Panel</a>
        <div class="ms-auto text-white">
            {{ auth()->user()->name }}
        </div>
    </div>
</nav>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Task</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('manager.task.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Task Name --}}
                        <div class="mb-3">
                            <label class="form-label">Task Name</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $task->title }}" required>
                        </div>

                        {{-- Assign Staff --}}
                        <div class="mb-3">
                            <label class="form-label">Assign Staff</label>
                            <select name="staff_id" class="form-select" required>
                                @foreach($staff as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $task->staff_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <button class="btn btn-success w-100">Update Task</button>
                    </form>
                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>
