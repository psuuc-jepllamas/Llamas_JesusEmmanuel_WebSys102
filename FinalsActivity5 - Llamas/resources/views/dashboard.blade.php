<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: #1e293b;
                color: #ffffff;
                min-height: 100vh;
                margin: 0;
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
                background: rgba(30, 41, 59, 0.95);
                backdrop-filter: blur(10px);
                z-index: 1001; /* Ensure navbar is above other elements */
            }
            .navbar-brand {
                font-size: 1.5rem;
                font-weight: 600;
                color: #ffffff;
                display: flex;
                align-items: center;
            }
            .navbar-brand::before {
                content: '';
                width: 12px;
                height: 12px;
                background: #ffffff;
                border-radius: 50%;
                margin-right: 0.5rem;
            }
            .nav-link {
                color: #94a3b8;
                text-decoration: none;
                font-weight: 500;
            }
            .nav-link:hover, .nav-link.active {
                color: #ffffff;
            }
            .dropdown-menu {
                background: #1e293b; /* Solid background for visibility */
                border: none;
                border-radius: 8px;
                z-index: 1000; /* Ensure dropdown is above other elements */
            }
            .dropdown-item {
                color: #ffffff;
                padding: 0.5rem 1rem;
            }
            .dropdown-item:hover {
                background: #2563eb; /* Solid hover background */
                color: #ffffff;
            }
            .hamburger-btn {
                background: transparent;
                border: none;
                color: #94a3b8;
                padding: 0.5rem;
                border-radius: 4px;
            }
            .hamburger-btn:hover {
                background: rgba(255, 255, 255, 0.1);
                color: #ffffff;
            }
            header {
                background: rgba(30, 41, 59, 0.95);
                backdrop-filter: blur(10px);
            }
            .dashboard-content {
                max-width: 1140px;
                margin: 3rem auto;
                padding: 1.5rem;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
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
                    align-items: flex-start;
                }
                .navbar-brand {
                    margin-bottom: 1rem;
                }
                .nav-menu {
                    width: 100%;
                }
                .dashboard-content {
                    margin: 2rem auto;
                    padding: 1rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="min-vh-100">
            <nav class="navbar" x-data="{ open: false }">
                <!-- Primary Navigation Menu -->
                <div class="container-fluid">
                    <div class="flex justify-between w-100">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="flex items-center me-4">
                                <a href="{{ route('dashboard') }}">
                                    <div class="navbar-brand">Laravel Breeze</div>
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden sm:flex sm:items-center space-x-4">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center">
                            <div class="dropdown">
                                <button class="btn btn-link text-white dropdown-toggle text-decoration-none" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="hamburger-btn">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div :class="{'block': open, 'hidden': ! open}" class="nav-menu sm:hidden">
                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-600">
                            <div class="px-4">
                                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-white hover:bg-blue-500 rounded">{{ __('Profile') }}</a>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-base font-medium text-white hover:bg-blue-500 rounded" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->


            <!-- Page Content -->
            <main>
                <div class="dashboard-content">
                    <div class="text-white">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </main>
        </div>

        <div class="decorative-elements">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Manual Dropdown Initialization (Optional) -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
                dropdownElementList.forEach(function (dropdownToggleEl) {
                    new bootstrap.Dropdown(dropdownToggleEl);
                });
            });
        </script>
    </body>
</html>