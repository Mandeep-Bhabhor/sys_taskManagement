<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Create Task</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('add.task') }}" method="POST">
                        @csrf

                        {{-- Task Name --}}
                        <div class="mb-3">
                            <label class="form-label">Task Name</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        {{-- Staff --}}
                        <div class="mb-3">
                            <label class="form-label">Assign to Staff</label>
                            <select name="staff_id" class="form-select" required>
                                <option value="">Select Staff</option>
                                @foreach($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <button class="btn btn-success w-100">Create Task</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>
