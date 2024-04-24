@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Profile</h1>

        <div class="mb-4">
            <strong>Name:</strong> {{ Auth::user()->username }}
        </div>

        <div class="mb-4">
            <strong>Email:</strong> {{ Auth::user()->email }}
        </div>

        <div class="mb-4">
            <strong>Phone Number:</strong> {{ Auth::user()->nomor_hp ?? 'Not available' }}
        </div>

        <div class="mb-4">
            <strong>Photo:</strong>
            @if (Auth::user()->foto)
                <img src="{{ asset('uploads/' . Auth::user()->foto) }}" alt="Your Photo" style="max-width: 200px;"
                    class="img-fluid rounded">
            @else
                No photo available.
            @endif
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 my-4">
            @forelse(Auth::user()->albums as $album)
                <div class="col mb-4">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h2 class="card-title h4 mb-3">{{ $album->NamaAlbum }}</h2>
                                    <p class="card-text text-muted small mb-2">{{ $album->Deskripsi }}</p>
                                    <p class="card-text text-muted small mb-2"><strong>Created by:</strong>
                                        {{ $album->user->username }}</p>
                                    <p class="card-text text-muted small mb-2"><strong>Created at:</strong>
                                        {{ $album->TanggalDibuat ?: 'Not available' }}</p>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('albums.edit', $album->id) }}"
                                            class="btn btn-warning btn-sm me-2">
                                            <i class="fas fa-edit"></i> <!-- Ikon edit -->
                                        </a>

                                        <a href="{{ route('albums.show', $album->id) }}" class="btn btn-view-album btn-sm">
                                            <i class="fas fa-eye"></i> <!-- Ikon view -->
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No albums available.</p>
            @endforelse

        </div>
    </div>
@endsection
