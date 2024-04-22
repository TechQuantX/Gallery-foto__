@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Your Account</h1>

        <div class="mb-3">
            <a href="{{ route('categories.index') }}" class="btn btn-primary">View Categories</a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            <span class="toggle-icon">&#x25BC;</span>
                            Your Profile
                        </h3>

                        <div class="profile-details" style="display: none;">
                            <div class="mb-3">
                                <strong>Nama:</strong> {{ Auth::user()->username }}
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong> {{ Auth::user()->email }}
                            </div>
                            <div class="mb-3">
                                <strong>Nama Lengkap:</strong> {{ Auth::user()->nama_lengkap }}
                            </div>
                            <div class="d-grid gap-2">
                                <a href="{{ route('user.edit') }}" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                    <style>
                        .toggle-icon {
                            cursor: pointer;
                        }
                    </style>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const toggleIcon = document.querySelector('.toggle-icon');
                            const profileDetails = document.querySelector('.profile-details');

                            toggleIcon.addEventListener('click', function() {
                                if (profileDetails.style.display === 'none' || profileDetails.style.display === '') {
                                    profileDetails.style.display = 'block';
                                    toggleIcon.innerHTML = '&#x25B2;'; // Panah ke atas
                                } else {
                                    profileDetails.style.display = 'none';
                                    toggleIcon.innerHTML = '&#x25BC;'; // Panah ke bawah
                                }
                            });
                        });
                    </script>
                </div>
            </div>

            <div class="col-md-8">
                <h2>Your Albums</h2>

                @forelse(Auth::user()->albums as $album)
                    <div class="card mb-4 album-card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                                    <img src="{{ asset('storage/' . $album->cover_image) }}" class="img-fluid"
                                        alt="Profile Image">
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title">{{ $album->NamaAlbum }}</h5>
                                    <p class="card-text">{{ $album->Deskripsi }}</p>
                                    <p class="card-text"><strong>Created at:</strong>
                                        {{ $album->TanggalDibuat ?: 'Not available' }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('albums.show', $album->id) }}" class="btn btn-view-album me-2">
                                    <i class="fas fa-eye"></i> <!-- Ikon view -->
                                </a>
                                <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> <!-- Ikon edit -->
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No albums available.</p>
                @endforelse
            </div>
        </div>

        <div class="container fixed-bottom mb-3">
            <div class="row justify-content-between">
                <div class="col-md-3 text-center">
                    <a href="{{ route('albums.index') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="bi bi-collection me-2"></i> Show Albums
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{ route('photos.index') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-images"></i> Photo Page
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{ route('categories.index') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-eye me-1"></i> Show Category
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{ route('user.profile') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-user me-1"></i> Your Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
