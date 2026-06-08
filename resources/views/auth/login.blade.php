<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Semob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center" style="height: 100vh;">
    <div class="card mx-auto shadow" style="width: 400px;">
        <div class="card-header bg-dark text-white text-center"><h4>Rental Mobil Semob</h4></div>
        <div class="card-body">
            @if($errors->has('loginError')) <div class="alert alert-danger">{{ $errors->first('loginError') }}</div> @endif
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required placeholder="admin@gmail.com / user@gmail.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="password">
                </div>
                <button type="submit" class="btn btn-dark w-100">Login</button>
            </form>
        </div>
    </div>
</body>
</html>