@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Album</h1>

        <form action="{{ route('albums.update', $album->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="NamaAlbum" class="form-label">Album Name</label>
                <input type="text" class="form-control" id="NamaAlbum" name="NamaAlbum" value="{{ $album->NamaAlbum }}">
            </div>

            <div class="mb-3">
                <label for="Deskripsi" class="form-label">Description</label>
                <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="3">{{ $album->Deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $album->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tambahkan field lainnya sesuai kebutuhan -->

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
