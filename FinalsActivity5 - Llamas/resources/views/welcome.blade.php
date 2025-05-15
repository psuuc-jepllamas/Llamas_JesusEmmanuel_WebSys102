<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Landing</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                align-items: center;
                max-width: 1200px;
                margin: 0 auto;
            }
            .navbar-brand {
                font-size: 1.5rem;
                font-weight: 600;
                color: #ffffff;
            }
            .navbar-brand::before {
                content: '';
                width: 12px;
                height: 12px;
                background: #ffffff;
                border-radius: 50%;
                margin-right: 0.5rem;
            }
            .nav-links a {
                color: black;
                text-decoration: none;
                margin-left: 1.5rem;
                font-weight: 500;
            }
            .nav-links a:hover {
                color: #ffffff;
            }
            .hero {
                max-width: 1200px;
                margin: 4rem auto;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 2rem;
            }
            .hero-text {
                flex: 1;
            }
            h1 {
                font-size: 3rem;
                font-weight: 700;
                margin-bottom: 1rem;
                line-height: 1.2;
            }
            p {
                font-size: 1.1rem;
                color: #cbd5e1;
                margin-bottom: 2rem;
            }
            .app-buttons {
                display: flex;
                gap: 1rem;
            }
            .app-buttons a {
                display: inline-block;
                width: 120px;
                height: 40px;
                background: #000000;
                color: #ffffff;
                text-decoration: none;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.9rem;
            }
            .login-register-buttons {
                display: flex;
                gap: 1rem;
                margin-top: 2rem;
            }
            .btn-primary {
                background: #2563eb;
                border: none;
                border-radius: 8px;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                text-transform: uppercase;
                color: #ffffff;
            }
            .btn-outline-primary {
                border-color: #2563eb;
                color: #2563eb;
                background: #ffffff;
                border-radius: 8px;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                text-transform: uppercase;
            }
            .hero-image {
                flex: 1;
                display: flex;
                justify-content: flex-end;
                position: relative;
            }
            .phone-image {
                width: 200px;
                height: auto;
                z-index: 1;
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
                .hero {
                    flex-direction: column;
                    text-align: center;
                }
                .hero-image {
                    justify-content: center;
                    margin-top: 2rem;
                }
                .login-register-buttons {
                    flex-direction: column;
                }
                .btn-primary, .btn-outline-primary {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar">
            <div class="navbar-brand">Breeze</div>
            <div class="nav-links">
                @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-primary text-light">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                        @endif
                @endif
            </div>
        </nav>
        <div class="hero">
            <div class="hero-text">
                <h1>Welcome to Laravel Breeze!</h1>
                <p class="ms-2">Login or register your account</p>
            </div>
        </div>
        <div class="decorative-elements">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>