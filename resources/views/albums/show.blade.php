@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <div class="container col-md-50 mb-50 mt-5">

        <!-- Gaya Kustom -->
        <style>
            .card {
                width: 100%;
            }

            .card img {
                object-fit: cover;
                height: 200px;
                /* Atur tinggi sesuai kebutuhan Anda */
                width: 100%;
            }

            .photo-image {
                height: 200px;
                /* Atur tinggi sesuai kebutuhan Anda */
                object-fit: cover;
                width: 100%;
            }
        </style>

        <h1 class="mb-4">{{ $album->NamaAlbum }}</h1>
        <div class="card mb-4">
            @if ($album->cover_image)
                <a href="{{ asset('storage/' . $album->cover_image) }}" data-toggle="lightbox" data-gallery="mygallery"
                    data-caption="{{ $album->NamaAlbum }}" data-max-width="600">
                    <img src="{{ asset('storage/' . $album->cover_image) }}"
                        class="card-img-top img-fluid rounded cover-image" alt="{{ $album->NamaAlbum }}">
                </a>
            @endif


            <div class="card-body">
                <!-- Kode yang sudah ada tetap tidak berubah -->

                @can('delete', $album)
                    <!-- Tambahkan tag form pembuka di sini -->
                    <form id="deleteAlbumForm" action="{{ route('albums.destroy', $album->id) }}" method="post">
                        @csrf
                        @method('delete')

                        <a href="{{ route('albums.show', $album->id) }}" class="btn btn-primary mr-2">Lihat Album</a>

                        <button class="btn btn-danger delete-album-btn" data-album-id="{{ $album->id }}" id="deleteAlbumBtn"
                            disabled>Hapus Album</button>

                    </form>
                    <!-- Pastikan script SweetAlert ditempatkan di bagian head atau sebelum akhir tag body -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('deleteAlbumBtn').addEventListener('click', function(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Apakah Anda yakin?',
                                    text: "Anda tidak akan bisa mengembalikannya!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Ya, hapus!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Submit the form when confirmed
                                        document.getElementById('deleteAlbumForm').submit();
                                    }
                                });
                            });
                        });
                    </script>
                @endcan
            </div>
        </div>

        <div class="mt-4">
            <h3>Foto</h3>
            <div class="row">
                @forelse ($album->photos as $photo)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">{{ $photo->JudulFoto }}</h5>
                                <p class="card-text">{{ $photo->DeskripsiFoto }}</p> --}}
                                <p class="card-text"><strong>Uploaded On:</strong> {{ $photo->TanggalUnggah }}</p>
                                <p class="card-text"><strong>Uploaded By:</strong> {{ $photo->user->username }}</p>
                                <a href="{{ route('photos.show', $photo->id) }}" class="btn btn-primary">View Details</a>

                                @if ($photo->LokasiFile)
                                    <div class="mt-3">
                                        <h6>Foto</h6>
                                        <a href="{{ asset('storage/photos/' . basename($photo->LokasiFile)) }}"
                                            data-toggle="lightbox" data-gallery="gallery" data-max-width="600">
                                            <img src="{{ asset('storage/photos/' . basename($photo->LokasiFile)) }}"
                                                class="card-img-top" alt="{{ $photo->JudulFoto }}">
                                        </a>
                                    </div>
                                    <!-- Modal yang sudah ada tetap tidak berubah -->
                                @endif


                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-12">Tidak ada foto tersedia.</p>
                @endforelse
            </div>
        </div>

        <a href="{{ route('albums.index') }}" class="btn btn-primary mt-3">Back to Albums</a>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
                                                                                                                                                                                                                                                                                                                text-white"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endsection
