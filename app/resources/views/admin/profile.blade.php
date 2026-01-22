@extends('admin.layouts.master')

@section('title', 'Manage Profile')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Manage Profile</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Manage Profile</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-header" style="background-image: url('https://via.placeholder.com/800x200')">
                        <div class="profile-picture">
                            <div class="avatar avatar-xl">
                                <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                    alt="{{ $user->name }}" class="avatar-img rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <div class="name">{{ $user->name }}</div>
                            <div class="job">{{ ucfirst($user->role) }}</div>
                            <div class="desc">{{ $user->email }}</div>
                            <div class="view-profile mt-3">
                                <button class="btn btn-secondary btn-block" onclick="$('#avatarInput').click()">
                                    Change Avatar
                                </button>
                                <input type="file" id="avatarInput" accept="image/*" style="display: none;"
                                    onchange="uploadAvatar(this)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form id="profileForm">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <select class="form-control" id="timezone" name="timezone">
                                    <option value="UTC" {{ $user->timezone === 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York" {{ $user->timezone === 'America/New_York' ? 'selected' : '' }}>America/New_York</option>
                                    <option value="America/Chicago" {{ $user->timezone === 'America/Chicago' ? 'selected' : '' }}>America/Chicago</option>
                                    <option value="Europe/London" {{ $user->timezone === 'Europe/London' ? 'selected' : '' }}>
                                        Europe/London</option>
                                    <option value="Asia/Dhaka" {{ $user->timezone === 'Asia/Dhaka' ? 'selected' : '' }}>
                                        Asia/Dhaka</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="preferred_locale">Preferred Language</label>
                                <select class="form-control" id="preferred_locale" name="preferred_locale">
                                    <option value="en" {{ $user->preferred_locale === 'en' ? 'selected' : '' }}>English
                                    </option>
                                    <option value="es" {{ $user->preferred_locale === 'es' ? 'selected' : '' }}>Spanish
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title">Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form id="passwordForm">
                            @csrf

                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#profileForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/profile',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Profile updated successfully');
                            setTimeout(() => location.reload(), 1500);
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                Object.values(errors).flat().forEach(error => toastr.error(error));
                            } else {
                                toastr.error('Failed to update profile');
                            }
                        }
                    });
                });

                $('#passwordForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/profile/password',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Password changed successfully');
                            $('#passwordForm')[0].reset();
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                Object.values(errors).flat().forEach(error => toastr.error(error));
                            } else {
                                toastr.error('Failed to change password');
                            }
                        }
                    });
                });
            });

            function uploadAvatar(input) {
                if (input.files && input.files[0]) {
                    const formData = new FormData();
                    formData.append('avatar', input.files[0]);

                    $.ajax({
                        url: '/api/v1/profile/avatar',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Avatar updated successfully');
                            setTimeout(() => location.reload(), 1500);
                        },
                        error: function (xhr) {
                            toastr.error('Failed to upload avatar');
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
