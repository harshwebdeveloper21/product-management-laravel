<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="display-4">Welcome to {{ config('app.name', 'Laravel') }}</h1>
                            <p class="lead">Product Management System</p>
                        </div>
                        
                        @if (Route::has('login'))
                            <div class="d-flex justify-content-center gap-3">
                                @auth
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('signup') }}" class="btn btn-outline-primary btn-lg">Sign Up</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>