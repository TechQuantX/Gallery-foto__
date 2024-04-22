<!-- resources/views/categories/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Categories</h2>
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
                    <a href="{{ route('categories.create') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-plus-circle me-1"></i> Create Category
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{ route('user.profile') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-user me-1"></i> Your Profile
                    </a>
                </div>
            </div>
        </div>
        @foreach ($categories as $category)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <!-- Tampilkan daftar album untuk setiap kategori -->
                    <ul>
                        @foreach ($category->albums as $album)
                            <li>{{ $album->NamaAlbum }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

        @if ($categories->isEmpty())
            <p>No categories available.</p>
        @endif
    </div>
@endsection
