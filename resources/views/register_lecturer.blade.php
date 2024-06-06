<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $title }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            background-image: url('{{ url('img/cover.jpg') }}');
            background-size: cover;
            background-position: center;
            background-color: rgba(0, 0, 0, 0.5);
            background-blend-mode: darken;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="text-center text-white mb-4">
            <h2>Welcome to the {{ config('app.name') }}</h2>
            <p>Please Register to continue</p>
            <hr>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-header text-center bg-primary">
                        <h2 class="text-white">Lecturer Register</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register_lecturer.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="nip" class="form-label">NIP:</label>
                                    <input type="text" class="form-control" id="nip" name="nip" required
                                        autofocus placeholder="Enter NIP" value="{{ old('nip') }}">
                                        @error('nip')
                                            <span class="mt-3 text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        autofocus placeholder="Enter Name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required
                                    placeholder="Enter username" value="{{ old('username') }}">
                                    @error('username')
                                        <span class="mt-3 text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="mt-3 text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required
                                        placeholder="Enter password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <span class="fas fa-eye" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Register</button>
                                <a href="{{ route('login') }}" class="btn btn-info">Login</a>
                                <a href="{{ route('register') }}">Not a lecturer? Register as a student</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fas fa-eye');
                this.classList.toggle('fas fa-eye-slash');
            });
        });
    </script>

</body>

</html>
