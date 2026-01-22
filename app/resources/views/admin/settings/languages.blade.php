@extends('admin.layouts.master')

@section('title', 'Manage Language')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Manage Language</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Manage Language</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Available Languages</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Language</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($languages as $code => $name)
                                        <tr>
                                            <td>{{ $name }}</td>
                                            <td>{{ $code }}</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <a href="{{ route('admin.settings.languages') }}?edit={{ $code }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Edit Translations
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if(request('edit'))
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title">Edit Translations - {{ $languages[request('edit')] }}</h4>
                        </div>
                        <div class="card-body">
                            <form id="languageForm">
                                @csrf
                                <input type="hidden" name="language" value="{{ request('edit') }}">

                                @php
                                    $translations = trans('app', [], request('edit'));
                                @endphp

                                @foreach($translations as $key => $value)
                                    <div class="form-group">
                                        <label for="{{ $key }}">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                        <input type="text" class="form-control" id="{{ $key }}" name="translations[{{ $key }}]"
                                            value="{{ $value }}">
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-primary">Save Translations</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#languageForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/admin/settings/languages',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Translations updated successfully');
                        },
                        error: function (xhr) {
                            toastr.error('Failed to update translations');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
