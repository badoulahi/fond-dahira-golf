<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('login-form/style.css') }}">
</head>

<body>
    <div class="creative-bg">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
        </div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="card-decoration">
                <div class="deco-line line-1"></div>
                <div class="deco-line line-2"></div>
                <div class="deco-line line-3"></div>
            </div>

            <div class="login-header">
                <div class="creative-logo">
                    <div class="logo-circle circle-1"></div>
                    <div class="logo-circle circle-2"></div>
                    <div class="logo-circle circle-3"></div>
                </div>
                <h2>DAHIRA GOLF</h2>
                <p>Connectez-vous à votre compte</p>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger text-red-500">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif

            <form action="{{ route('manager.store') }}" method="post" class="login-form" id="loginForm" novalidate>
                @csrf
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-decoration"></div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="off">
                        <label for="email">Login</label>
                        <div class="input-waves">
                            <div class="wave wave-1"></div>
                            <div class="wave wave-2"></div>
                            <div class="wave wave-3"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <div class="input-decoration"></div>
                        <input type="password" id="password" name="password" value="{{ old('password') }}" required />
                        <label for="password">Mot de passe</label>
                        <button type="button" class="password-toggle" id="passwordToggle"
                            aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-bg"></span>
                    <span class="btn-text">Se Connecter</span>
                </button>
            </form>
        </div>
    </div>

    <script src="{{ asset('login-form/form-utils.js') }}"></script>
    <script src="{{ asset('login-form/script.js') }}"></script>
</body>

</html>
