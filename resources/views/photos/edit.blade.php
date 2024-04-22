<!-- resources/views/photos/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Photo</h1>

        @if (session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        <form action="{{ route('photos.update', $photo->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="form-group">
                <label for="JudulFoto">Title:</label>
                <div class="input-group">
                    <input type="text" name="JudulFoto" class="form-control" value="{{ $photo->JudulFoto }}" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top"
                            title="Help Text">
                            <i class="fas fa-question-circle"></i>
                        </button>
                    </div>
                </div>
                <small class="form-text text-muted">Enter a catchy title for your photo</small>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="DeskripsiFoto">Description:</label>
                <textarea name="DeskripsiFoto" class="form-control" rows="3">{{ $photo->DeskripsiFoto }}</textarea>
            </div>

            <!-- Current Image -->
            <div class="mb-4">
                <h5 class="card-title">Current Image:</h5>
                @if ($photo->LokasiFile)
                    <div class="current-image-container">
                        <img src="{{ asset('storage/photos/' . basename($photo->LokasiFile)) }}" class="card-img-top"
                            alt="{{ $photo->JudulFoto }}">

                        <div class="overlay">
                            <a href="{{ asset('storage/photos/' . basename($photo->LokasiFile)) }}" target="_blank"
                                class="btn btn-primary">View Full Size</a>
                        </div>
                    </div>
                @else
                    <p class="text-muted">No image available</p>
                @endif
            </div>

            <!-- Upload New Image -->
            <div class="form-group">
                <label for="LokasiFile">Update Image:</label>
                <input type="file" name="LokasiFile" class="form-control" id="imageInput">

                <!-- Image Preview -->
                <div class="mt-2">
                    <h6 class="mb-2">New Image Preview:</h6>
                    <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded"
                        style="max-height: 150px; display: none;">
                </div>

                <script>
                    // JavaScript to show image preview
                    document.getElementById('imageInput').addEventListener('change', function(e) {
                        var imagePreview = document.getElementById('imagePreview');
                        imagePreview.style.display = 'block';

                        var reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                        }

                        reader.readAsDataURL(this.files[0]);
                    });
                </script>
            </div>

            <!-- Upload Date -->
            <div class="form-group">
                <label for="TanggalUnggah">Upload Date:</label>
                <input type="date" name="TanggalUnggah" class="form-control" value="{{ $photo->TanggalUnggah }}"
                    required>
            </div>

            <!-- Album -->
            <div class="form-group">
                <label for="album_id">Album:</label>
                <select name="album_id" class="form-control" required>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}" {{ $album->id == $photo->album_id ? 'selected' : '' }}>
                            {{ $album->NamaAlbum }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Uploaded by User -->
            <div class="form-group">
                <label for="user_id">Uploaded by:</label>
                <select name="user_id" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $photo->user_id ? 'selected' : '' }}>
                            {{ $user->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Photo</button>
                <a href="{{ route('photos.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
