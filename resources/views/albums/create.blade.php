@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Album</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('albums.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Form fields go here -->
                            <div class="form-group">
                                <label for="NamaAlbum">Album Name</label>
                                <input type="text" class="form-control" id="NamaAlbum" name="NamaAlbum" required>
                            </div>

                            <div class="form-group">
                                <label for="Deskripsi">Description</label>
                                <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="cover_image">Cover Image</label>
                                <input type="file" class="form-control-file" id="cover_image" name="cover_image"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="user_id">Select User:</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->nama_lengkap }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Select Category:</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary mt-2">Create Album</button><br>
                            <a href="{{ route('albums.index') }}" class="btn btn-secondary mt-2">Back to Albums</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk menampilkan preview gambar kecil -->
    <script>
        document.getElementById('cover_image').addEventListener('change', function(e) {
            var imagePreviewContainer = document.getElementById('imagePreviewContainer');
            var imagePreview = document.getElementById('imagePreview');

            if (e.target.files.length > 0) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.style.display = 'block';
                };
                reader.readAsDataURL(e.target.files[0]);
            } else {
                imagePreview.src = '';
                imagePreviewContainer.style.display = 'none';
            }
        });
    </script>
@endsection
