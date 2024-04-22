<!-- resources/views/photos/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Photo</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('photos.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Form fields go here -->
            <div class="form-group">
                <label for="JudulFoto">Title:</label>
                <input type="text" name="JudulFoto" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="DeskripsiFoto">Description:</label>
                <textarea name="DeskripsiFoto" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="TanggalUnggah">Upload Date:</label>
                <input type="datetime-local" name="TanggalUnggah" class="form-control" required
                    value="{{ old('TanggalUnggah', $defaultUploadDate) }}">
            </div>


            <div class="form-group">
                <label for="LokasiFile">Upload Image:</label>
                <input type="file" name="LokasiFile" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label for="album_id">Select Album:</label>
                <select name="album_id" class="form-control" required>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->NamaAlbum }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="album_id">Album:</label>
                <select class="form-control" name="album_id">
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->NamaAlbum }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">User:</label>
                <select class="form-control" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">Select User:</label>
                <select name="user_id" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary  mt-2">Create Photo</button>
            <a href="{{ route('photos.index') }}" class="btn btn-secondary mt-2">Back to Photos</a>

        </form>
    </div>
@endsection
