<!DOCTYPE html>

<head>
    <title>Admin Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <form action='{{ route('admin.register') }}' method='POST'>
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <nb>
            <input type="radio" name="role" value="admin"> Admin
            <input type="radio" name="role" value="user"> User 
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</body>

</html>
