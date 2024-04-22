<!-- resources/views/user/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ $user->username }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="old_password" name="old_password"
                                        value="{{ $user->password }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="showOldPassword">Show</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                    value="{{ $user->nama_lengkap }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Address</label>
                                <textarea class="form-control" id="alamat" name="alamat">{{ $user->alamat }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <script>
                        document.getElementById('showOldPassword').addEventListener('click', function() {
                            var passwordInput = document.getElementById('old_password');
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                            } else {
                                passwordInput.type = 'password';
                            }
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
