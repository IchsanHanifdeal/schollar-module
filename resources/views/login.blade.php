<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('{{ url('img/cover.jpg') }}');
            background-size: cover;
            background-position: center;
            background-color: rgba(0,0,0,0.5);
            background-blend-mode: darken;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center text-white mb-4">
            <h2>Welcome to the {{ config('app.name') }}</h2>
            <p>Please login to continue</p>
            <hr>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-header text-center bg-primary">
                        <h2 class="text-white">Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required autofocus placeholder="Enter username" value="{{ old('username') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <a href="{{ route('register') }}" class="btn btn-info">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
</body>
</html>
