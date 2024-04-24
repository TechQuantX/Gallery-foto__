<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <head>
        <!-- ... file lainnya ... -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <!-- ... file lainnya ... -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/albumShow.css') }}">
        <link rel="stylesheet" href="{{ asset('css/stayle.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/photos-style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
        <script src="{{ asset('js/scripts.js') }}" defer></script>
        <script src="{{ asset('js/hover-effect.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

        <script src="{{ mix('js/app.js') }}"></script>
        <style>
            /* Gaya untuk toggle-icon */
            .toggle-icon {
                cursor: pointer;
            }

            /* Gaya untuk tombol "Edit Profile" */
            .edit-profile-btn {
                display: inline-block;
                padding: 5px 10px;
                background-color: #007bff;
                color: white;
                border-radius: 5px;
                text-decoration: none;
            }

            .edit-profile-btn:hover {
                background-color: #0056b3;
            }

            /* Gaya untuk album card */
            .album-card {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                margin-bottom: 10px;
            }

            .album-card .card-title {
                margin-bottom: 5px;
            }

            .album-card .card-text {
                margin-bottom: 5px;
            }

            .album-card .img-fluid {
                max-width: 80px;
                max-height: 80px;
                border-radius: 50%;
                object-fit: cover;
            }

            .album-card .btn {
                padding: 2px 5px;
            }
        </style>
    </head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/albums') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <!-- Put left side navigation here -->
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Session::has('success'))
                                <li class="nav-item">
                                    <div class="alert alert-success alert-dismissible fade show mb-0 me-3" role="alert">
                                        {{ Session::get('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </li>
                            @endif

                            @if (Session::has('error'))
                                <li class="nav-item">
                                    <div class="alert alert-danger alert-dismissible fade show mb-0 me-3" role="alert">
                                        {{ Session::get('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </li>
                            @endif

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.profile') }}">
                                        Hi, {{ Auth::user()->username }}
                                        <span id="profile-icon">
                                            @if (Auth::user()->foto)
                                                <img id="profile-photo" src="{{ asset('uploads/' . Auth::user()->foto) }}"
                                                    alt="Your Photo"
                                                    style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px; transition: transform 0.3s;">
                                            @else
                                                <!-- Ganti ikon default di sini -->
                                                <i class="bi bi-person"></i>
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            @endauth

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        <i class="bi bi-person me-2"></i>{{ __('Your Account') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('albums.index') }}">
                                        <i class="bi bi-collection me-2"></i>{{ __('Album') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('photos.index') }}">
                                        <i class="bi bi-image me-2"></i>{{ __('Foto') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest


                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const profilePhoto = document.getElementById('profile-photo');

                                profilePhoto.addEventListener('mouseenter', function() {
                                    profilePhoto.style.transform = 'scale(1.5)'; // Memperbesar foto
                                });

                                profilePhoto.addEventListener('mouseleave', function() {
                                    profilePhoto.style.transform = 'scale(1)'; // Mengembalikan ukuran normal foto
                                });
                            });
                        </script>


                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <main class="py-4">
        @yield('content')
    </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
