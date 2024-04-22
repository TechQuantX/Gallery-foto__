@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-primary">{{ $photo->JudulFoto }}</h1>

        @if (session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $photo->JudulFoto }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $photo->DeskripsiFoto }}</p>
                <p class="card-text"><strong>Upload Date:</strong> {{ $photo->TanggalUnggah }}</p>
                <p class="card-text"><strong>Album:</strong> {{ $photo->album->NamaAlbum }}</p>
                <p class="card-text"><strong>Uploaded by:</strong> {{ $photo->user->nama_lengkap }}</p>

                @if ($photo->LokasiFile)
                    <div class="mt-3">
                        <h6>Image</h6>
                        <a href="{{ asset('storage/photos/' . basename($photo->LokasiFile)) }}" data-toggle="lightbox"
                            data-gallery="gallery" data-max-width="600">
                            <img src="{{ asset('storage/photos/' . basename($photo->LokasiFile)) }}" class="card-img-top"
                                alt="{{ $photo->JudulFoto }}">
                        </a>
                    </div>


                    <div class="mt-2">
                        <strong>Likes:</strong> {{ $photo->likes()->count() }}
                    </div>
                    <div class="mt-4">
                        <form action="{{ route('photos.like', $photo->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Like</button>
                        </form>
                    </div>
                    <form action="{{ route('photos.unlike', $photo->id) }}" method="post" class="mt-2">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Unlike</button>
                    </form>
                @endif
            </div>

            <!-- Display Comments -->
            <div>
                <h5 class="card-title">Comments:</h5>
                @foreach ($photo->komentar as $comment)
                    <div class="comment">
                        <div class="comment-content">
                            <p><strong>{{ $comment->user->nama_lengkap }}:</strong> {{ $comment->isikomentar }}</p>
                        </div>
                        @if (auth()->user()->id === $comment->user->id)
                            <div class="comment-actions">
                                <form class="delete-comment-form"
                                    action="{{ route('photos.comment.delete', $comment->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-link delete-comment-btn"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const commentContents = document.querySelectorAll('.comment-content');
                        commentContents.forEach(content => {
                            content.addEventListener('click', function() {
                                const commentActions = this.parentNode.querySelector('.comment-actions');
                                commentActions.classList.toggle('active');
                            });
                        });

                        const deleteButtons = document.querySelectorAll('.delete-comment-btn');
                        deleteButtons.forEach(button => {
                            button.addEventListener('click', function(event) {
                                event.stopPropagation();
                                const form = this.closest('.delete-comment-form');
                                if (confirm('Are you sure you want to delete this comment?')) {
                                    form.submit();
                                }
                            });
                        });
                    });
                </script>

                <style>
                    .comment-actions {
                        display: none;

                    }

                    .comment-actions.active {
                        display: block;
                    }

                    .comment-content {
                        cursor: pointer;
                        /* Mengubah ikon kursor saat mengarahkan ke komentar */
                    }
                </style>


                <!-- Add Comment Form -->
                <div class="mb-4 mt-4">
                    <h5 class="card-title">Add Comment:</h5>
                    <form action="{{ route('photos.comment', $photo->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Add your comment here" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add Comment</button>
                    </form>


                </div>
                <!-- Likes Count -->
                <div class="card-footer text-muted">
                    @if (auth()->user()->can('update', $photo))
                        <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endif
                </div>
                <a href="{{ route('photos.index') }}" class="btn btn-primary mt-3">Back to Photos</a>
            </div>
        </div>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
                                                                                                                                                                                                                                                                            text-white"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endsection
