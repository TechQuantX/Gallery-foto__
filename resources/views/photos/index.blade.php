@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Photos</h2>
        <!-- Tombol untuk membuat album baru dan navigasi ke halaman foto (fixed) -->
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
                    <a href="{{ route('user.profile') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-user me-1"></i> Your Profile
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{ route('photos.create') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-upload me-1"></i> Upload Photo
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($photos as $photo)
                @if ($photo->user_id === auth()->id())
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/photos/' . basename($photo->LokasiFile)) }}" class="card-img-top"
                                alt="{{ $photo->JudulFoto }}">

                            <div class="card-body">
                                {{-- <h5 class="card-title">{{ $photo->JudulFoto }}</h5>
                                <p class="card-text">{{ $photo->DeskripsiFoto }}</p>
                                <p class="card-text"><strong>Uploaded On:</strong> {{ $photo->TanggalUnggah }}</p>
                                <p class="card-text"><strong>Album:</strong> {{ $photo->album->NamaAlbum }}</p> --}}
                                <p class="card-text"><strong>Uploaded By:</strong> {{ $photo->user->username }}</p>
                                <div class="col-md-6 text-md-end">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('photos.show', $photo->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye-fill"></i>
                                            <span class="visually-hidden">View Details</span>
                                        </a>
                                        {{-- <form action="{{ route('photos.destroy', $photo->id) }}" method="POST"
                                            class="d-inline ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this photo?')">
                                                <i class="bi bi-trash-fill"></i>
                                                <span class="visually-hidden">Delete</span>
                                            </button>
                                        </form> --}}
                                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST"
                                            class="d-inline ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this photo?')"
                                                disabled>
                                                <i class="bi bi-trash-fill"></i>
                                                <span class="visually-hidden">Delete</span>
                                            </button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
