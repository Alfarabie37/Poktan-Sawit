<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Poktan-Sawit</title>

    <!-- Custom fonts & styles SB Admin 2 -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-success">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="mb-2">
                                <i class="fas fa-seedling fa-3x text-success"></i>
                            </div>
                            <h1 class="h4 text-gray-900 font-weight-bold">POKTAN SAWIT</h1>
                            <p class="text-muted small">Silakan login untuk masuk ke sistem informasi kelompok tani</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger small">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form class="user" action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user"
                                    placeholder="Masukkan Alamat Email..." value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user"
                                    placeholder="Masukkan Password..." required>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-user btn-block font-weight-bold">
                                <i class="fas fa-sign-in-alt mr-1"></i> Masuk ke Sistem
                            </button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <small class="text-muted">Akun Demo: <b>admin@poktansawit.com</b> | Pass: <b>admin123</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
</body>
</html>