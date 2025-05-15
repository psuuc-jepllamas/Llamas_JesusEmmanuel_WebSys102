<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: #1e293b;
                color: #ffffff;
                min-height: 100vh;
                margin: 0;
                padding: 2rem 0;
                position: relative;
                overflow: hidden;
            }
            .navbar {
                padding: 1rem 2rem;
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                max-width: 1200px;
                margin: 0 auto;
            }
            .navbar-brand-container {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
            .navbar-brand {
                font-size: 1.5rem;
                font-weight: 600;
                color: #ffffff;
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
            }
            .navbar-brand::before {
                content: '';
                width: 12px;
                height: 12px;
                background: #ffffff;
                border-radius: 50%;
                margin-right: 0.5rem;
            }
            .login-register-buttons {
                display: flex;
                gap: 1rem;
            }
            .login-form {
                max-width: 400px;
                margin: 4rem auto;
                padding: 2rem;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
            }
            .form-label {
                color: #ffffff;
                font-weight: 500;
                margin-bottom: 0.5rem;
            }
            .form-control {
                background: #ffffff;
                color: #1f2937;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                padding: 0.75rem;
                margin-bottom: 1rem;
            }
            .form-check-input {
                border-color: #d1d5db;
                background-color: #ffffff;
            }
            .form-check-label {
                color: #cbd5e1;
                margin-left: 0.5rem;
            }
            .forgot-password {
                color: #94a3b8;
                text-decoration: none;
            }
            .forgot-password:hover {
                color: #ffffff;
            }
            .btn-primary {
                background: #2563eb;
                border: none;
                border-radius: 8px;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                text-transform: uppercase;
                color: #ffffff;
                width: 100%;
            }
            .btn-primary:hover {
                background: #1d4ed8;
            }
            .decorative-elements {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                pointer-events: none;
                z-index: 0;
            }
            .circle {
                position: absolute;
                border-radius: 50%;
                background: rgba(37, 99, 235, 0.2);
            }
            .circle-1 {
                width: 150px;
                height: 150px;
                top: 10%;
                left: 5%;
            }
            .circle-2 {
                width: 100px;
                height: 100px;
                top: 20%;
                right: 10%;
            }
            @media (max-width: 768px) {
                .navbar {
                    flex-direction: column;
                    align-items: center;
                }
                .navbar-brand-container {
                    align-items: center;
                    margin-bottom: 1rem;
                }
                .login-register-buttons {
                    flex-direction: column;
                    gap: 0.5rem;
                }
                .login-form {
                    margin: 2rem auto;
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-form">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-white" :status="session('status')" />
            <center>
                <h4 class="mb-4">Login</h4>
            </center>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <!-- Remember Me -->
                <div class="form-check mt-4">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                </div>

                <div class="mt-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password mb-3 d-block">{{ __('Forgot your password?') }}</a>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="decorative-elements">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>