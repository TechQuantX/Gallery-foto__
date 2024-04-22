@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Albums</h1>

        <!-- Dropdown untuk memilih kategori -->
        <div class="mb-3 category-dropdown">
            <label for="categorySearch" class="form-label">Select Category:</label>
            <div class="position-relative">
                <input type="text" id="categorySearch" class="form-control" placeholder="Search category...">
                <i class="fas fa-search position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                <ul class="list-group mt-2 position-absolute w-100" id="categoryList"></ul>
            </div>
            <form action="{{ route('albums.index') }}" method="GET" id="categoryForm" style="display: none;">
                <select class="form-select" id="categorySelect" name="category">
                    <option value="" @if (!old('category') && !isset($selectedCategory)) selected @endif>
                        All Categories
                    </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('category') == $category->id || (isset($selectedCategory) && $selectedCategory->id == $category->id)) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <style>
            .category-dropdown {
                position: relative;
            }

            .category-dropdown label {
                font-weight: bold;
                margin-bottom: 5px;
                display: block;
            }

            .category-dropdown .form-control {
                border-radius: 8px;
                border: 2px solid #ced4da;
                padding: 10px;
                width: 100%;
                transition: border-color 0.2s;
            }

            .category-dropdown .form-control:focus {
                border-color: #007bff;
            }

            .category-dropdown .list-group {
                border-radius: 8px;
                max-height: 200px;
                overflow-y: auto;
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #fff;
                z-index: 3;
                padding: 0;
                margin-top: 4px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .category-dropdown .list-group-item {
                cursor: pointer;
                padding: 10px;
                transition: background-color 0.2s;
            }

            .category-dropdown .list-group-item:hover {
                background-color: #f8f9fa;
            }
        </style>



        <script>
            var categorySearch = document.getElementById('categorySearch');
            var categoryList = document.getElementById('categoryList');
            var categoryForm = document.getElementById('categoryForm');
            var categorySelect = document.getElementById('categorySelect');

            categorySearch.addEventListener('input', function() {
                var searchText = this.value.toLowerCase();
                var options = categorySelect.getElementsByTagName('option');

                // Clear previous search results
                categoryList.innerHTML = '';

                for (var i = 0; i < options.length; i++) {
                    var optionText = options[i].text.toLowerCase();
                    if (optionText.includes(searchText)) {
                        var li = document.createElement('li');
                        li.textContent = options[i].text;
                        li.className = 'list-group-item';
                        li.setAttribute('data-value', options[i].value);
                        li.addEventListener('click', function() {
                            categorySelect.value = this.getAttribute('data-value');
                            categoryForm.submit();
                        });
                        categoryList.appendChild(li);
                    }
                }

                // Show/hide list based on search results
                if (categoryList.children.length > 0) {
                    categoryList.style.display = 'block';
                } else {
                    categoryList.style.display = 'none';
                }
            });

            document.addEventListener('click', function(event) {
                if (!event.target.matches('#categorySearch')) {
                    categoryList.style.display = 'none';
                }
            });

            categorySearch.addEventListener('click', function() {
                // Clear previous search results
                categoryList.innerHTML = '';

                var options = categorySelect.getElementsByTagName('option');

                for (var i = 0; i < options.length; i++) {
                    var li = document.createElement('li');
                    li.textContent = options[i].text;
                    li.className = 'list-group-item';
                    li.setAttribute('data-value', options[i].value);
                    li.addEventListener('click', function() {
                        categorySelect.value = this.getAttribute('data-value');
                        categoryForm.submit();
                    });
                    categoryList.appendChild(li);
                }

                // Show all categories
                categoryList.style.display = 'block';
            });

            categorySearch.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    var selectedOption = categoryList.querySelector('.list-group-item.active');
                    if (selectedOption) {
                        categorySearch.value = selectedOption.textContent;
                        categoryForm.submit();
                    }
                }
            });

            // Tambahkan event listener pada dropdown kategori
            categorySelect.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                categorySearch.value = selectedOption.textContent;
                categoryForm.submit();

                // Tambahkan atribut readonly dan ubah nilai placeholder
                categorySearch.readOnly = true;
                categorySearch.placeholder = selectedOption.textContent;
            });
        </script>


        <!-- Menampilkan daftar album dalam grid -->
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5"> <!-- Tambahkan margin bottom di sini -->
            @forelse ($albums as $album)
                <div class="col mb-4">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h2 class="card-title">{{ $album->NamaAlbum }}</h2>
                                    <p class="card-text">{{ $album->Deskripsi }}</p>
                                    <p class="card-text"><strong>Created by:</strong> {{ $album->user->username }}</p>
                                    <p class="card-text"><strong>Created at:</strong>
                                        {{ $album->TanggalDibuat ?: 'Not available' }}</p>
                                    <a href="{{ route('albums.show', $album->id) }}" class="btn btn-view-album">View
                                        Album</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if ($album->cover_image)
                                    <a href="{{ route('albums.show', $album->id) }}">
                                        <img src="{{ asset('storage/' . $album->cover_image) }}"
                                            class="card-img-top img-fluid rounded" alt="{{ $album->NamaAlbum }}"
                                            style="height: 100%; object-fit: cover;">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No albums available.</p>
            @endforelse
        </div>

        <!-- Tombol untuk membuat album baru dan navigasi ke halaman foto (fixed) -->
        <div class="container fixed-bottom mb-3">
            <div class="row justify-content-between">
                <div class="col-md-3 text-center">
                    <a href="{{ route('albums.create') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-plus-circle me-1"></i> Create Album
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{ route('photos.index') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-images"></i> Photo Page
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{ route('account.index') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-user me-1"></i> Your Account
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{ route('categories.index') }}" class="btn btn-info btn-sm rounded-pill mb-2 mt-2">
                        <i class="fas fa-eye me-1"></i> Show Category
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
