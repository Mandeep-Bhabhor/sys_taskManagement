<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h3 class="mb-4">Manage Users</h3>

    <div class="row">
        @foreach($users as $user)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">
                            <strong>Email:</strong> {{ $user->email }} <br>
                            <strong>Role:</strong> 
                            <span class="badge bg-info text-dark">
                                {{ ucfirst($user->role) }}
                            </span><br>
                            <strong>Status:</strong>
                            @if($user->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Banned</span>
                            @endif
                        </p>

                        <div class="d-flex justify-content-between">
                            @if($user->is_active)
                                <form action="{{ route('admin.user.ban', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger btn-sm">Ban</button>
                                </form>
                            @else
                                <form action="{{ route('admin.user.activate', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">Activate</button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

</body>
</html>
