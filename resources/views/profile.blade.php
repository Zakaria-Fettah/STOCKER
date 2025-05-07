<?php $page = 'profile'; ?>
@extends('layout.mainlayout')

@section('content')
    <div class="container"style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Update Your Profile</h3>
                    </div>
                    <div class="card-body">
                        <!-- Profile Update Form -->
                        <form action="{{ route('updateProfileImage') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Current Profile Picture -->
                            <div class="mb-4 text-center">
                                <label for="current-avatar" class="form-label fw-bold">Current Profile Picture</label>
                                <div class="mb-3">
                                    <img src="{{ asset(Auth::user()->avatar ?? '/build/img/profiles/avator1.jpg') }}"
                                         alt="User Avatar" class="img-fluid rounded-circle"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>

                            <!-- Upload New Profile Picture -->
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Upload New Profile Picture</label>
                                <input type="file" name="avatar" class="form-control" id="avatar" accept="image/*">
                                @error('avatar')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                                <small class="form-text text-muted">Leave empty to keep your current password.</small>
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       id="password_confirmation">
                                @error('password_confirmation')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection