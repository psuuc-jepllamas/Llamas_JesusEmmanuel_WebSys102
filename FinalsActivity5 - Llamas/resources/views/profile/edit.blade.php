<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - {{ __('Profile') }}</title>

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
                z-index: 1001;
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
                background: #1e293b;
                border: none;
                border-radius: 8px;
                z-index: 1000;
            }
            .dropdown-item {
                color: #ffffff;
                padding: 0.5rem 1rem;
            }
            .dropdown-item:hover {
                background: #2563eb;
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
            .form-section {
                max-width: 42rem;
                margin-bottom: 1.5rem;
            }
            .form-section h2 {
                font-size: 1.125rem;
                font-weight: 500;
                color: #ffffff;
            }
            .form-section p {
                margin-top: 0.25rem;
                font-size: 0.875rem;
                color: #94a3b8;
            }
            .form-section .form-control {
                background: #2d3748;
                border: 1px solid #4b5563;
                color: #ffffff;
            }
            .form-section .form-control:focus {
                border-color: #2563eb;
                box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
            }
            .btn-primary {
                background: #2563eb;
                border: none;
            }
            .btn-primary:hover {
                background: #1d4ed8;
            }
            .btn-danger {
                background: #dc2626;
                border: none;
            }
            .btn-danger:hover {
                background: #b91c1c;
            }
            .btn-secondary {
                background: #4b5563;
                border: none;
            }
            .btn-secondary:hover {
                background: #374151;
            }
            .modal-content {
                background: #1e293b;
                color: #ffffff;
                border-radius: 8px;
            }
            .modal-header, .modal-footer {
                border-color: #4b5563;
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
                <div class="container-fluid">
                    <div class="flex justify-between w-100">
                        <div class="flex items-center">
                            <div class="shrink-0 flex items-center me-4">
                                <a href="{{ route('dashboard') }}">
                                    <div class="navbar-brand">Laravel Breeze</div>
                                </a>
                            </div>
                            <div class="hidden sm:flex sm:items-center space-x-4">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </div>
                        </div>
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
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="hamburger-btn">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div :class="{'block': open, 'hidden': ! open}" class="nav-menu sm:hidden">
                        <div class="pt-2 pb-3 space-y-1">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-base font-medium text-white {{ request()->routeIs('dashboard') ? 'bg-blue-600' : 'hover:bg-blue-500' }} rounded">
                                {{ __('Dashboard') }}
                            </a>
                        </div>
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
            <header class="shadow">
                <div class="container py-6 px-4">
                    <h2 class="font-semibold text-xl text-white leading-tight">
                        {{ __('Profile') }}
                    </h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="dashboard-content">
                    <!-- Update Profile Information -->
                    <section class="form-section">
                        <header>
                            <h2 class="text-lg font-medium">
                                {{ __('Profile Information') }}
                            </h2>
                            <p class="mt-1 text-sm">
                                {{ __("Update your account's profile information and email address.") }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" name="name" type="text" class="form-control mt-1 block w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" name="email" type="email" class="form-control mt-1 block w-full" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2">
                                            {{ __('Your email address is unverified.') }}
                                            <button form="send-verification" class="underline text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-400">
                                                {{ __('A new verification link has been sent to your email address.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
<br>
<br>
                    <!-- Update Password -->
                    <section class="form-section">
                        <header>
                            <h2 class="text-lg font-medium">
                                {{ __('Update Password') }}
                            </h2>
                            <p class="mt-1 text-sm">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
                                <input id="update_password_current_password" name="current_password" type="password" class="form-control mt-1 block w-full" autocomplete="current-password" />
                                @error('current_password', 'updatePassword')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
                                <input id="update_password_password" name="password" type="password" class="form-control mt-1 block w-full" autocomplete="new-password" />
                                @error('password', 'updatePassword')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control mt-1 block w-full" autocomplete="new-password" />
                                @error('password_confirmation', 'updatePassword')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
<br>    
<br>
                    <!-- Delete Account -->
                    <section class="form-section">
                        <header>
                            <h2 class="text-lg font-medium">
                                {{ __('Delete Account') }}
                            </h2>
                            <p class="mt-1 text-sm">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                            </p>
                        </header>
<br>
                        <button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            class="btn btn-danger"
                        >{{ __('Delete Account') }}</button>

                        <div
                            x-data="{ show: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }"
                            x-show="show"
                            x-on:open-modal.window="show = true"
                            x-on:close.window="show = false"
                            class="modal fade"
                            id="confirm-user-deletion"
                            tabindex="-1"
                            aria-labelledby="confirm-user-deletion-label"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                        @csrf
                                        @method('delete')

                                        <h2 class="text-lg font-medium">
                                            {{ __('Are you sure you want to delete your account?') }}
                                        </h2>
                                        <p class="mt-1 text-sm">
                                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                        </p>

                                        <div class="mt-6">
                                            <label for="password" class="sr-only">{{ __('Password') }}</label>
                                            <input
                                                id="password"
                                                name="password"
                                                type="password"
                                                class="form-control mt-1 block w-3/4"
                                                placeholder="{{ __('Password') }}"
                                            />
                                            @error('password', 'userDeletion')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </button>
                                            <button type="submit" class="btn btn-danger ms-3">
                                                {{ __('Delete Account') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </main>

            <div class="decorative-elements">
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Manual Dropdown Initialization -->
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