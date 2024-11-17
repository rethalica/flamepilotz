<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FlamePilot - Login</title>
    <link rel="icon" href="{{ asset('favicon/logo.ico') }}" type="image">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="{{ asset('assets/css/login2.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <!-- Login Card -->
            <div class="col-xxl-8 col-xl-9 col-lg-10 col-md-10 col-sm-12">
                <div class="login-card mx-auto row align-items-center">
                    <!-- Logo section -->
                    <div class="col-lg-5 col-md-12 text-center mb-4 mb-lg-0">
                        <div class="login-logo">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Flame Pilot Logo" />
                            <h4>FlamePilot</h4>
                        </div>
                    </div>

                    <!-- Login Form Section -->
                    <div class="col-lg-7 col-md-12">
                        <div class="login-form">
                            <h3>Masuk Ke Akun Anda</h3>


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="Email" />
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan Kata Sandi" />
                                </div>
                                <div class="d-flex justify-content-end mb-4">
                                    <a href="#" class="text-decoration-none" style="color: #4a90e2">Lupa Kata
                                        Sandi?</a>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    Masuk
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>
