@extends('admin.layouts.master')

@section('title', 'Edit User')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit User</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Edit</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Information</h4>
                    </div>
                    <div class="card-body">
                        <form id="updateUserForm">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <input type="text" class="form-control" id="timezone" name="timezone"
                                    value="{{ $user->timezone }}">
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

                            <div class="form-group">
                                <label for="password">New Password (leave blank to keep current)</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="form-text text-muted">Only fill if you want to change the password</small>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="profile_completed"
                                        name="profile_completed" {{ $user->profile_completed ? 'checked' : '' }}>
                                    <label class="form-check-label" for="profile_completed">
                                        Profile Completed
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#updateUserForm').on('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const userId = {{ $user->id }};

                    $.ajax({
                        url: `/api/v1/admin/users/${userId}`,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-HTTP-Method-Override': 'PUT',
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('User updated successfully');
                            setTimeout(() => window.location.href = '{{ route("admin.users.index") }}', 1500);
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                Object.values(errors).flat().forEach(error => toastr.error(error));
                            } else {
                                toastr.error('Failed to update user');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
