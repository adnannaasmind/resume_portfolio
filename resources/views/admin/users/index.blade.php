@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">{{ __('User Management') }}</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">{{ __('Users') }}</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('All Users') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="users-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Role') }}</th>
                                            <th>{{ __('Resumes') }}</th>
                                            <th>{{ __('Portfolios') }}</th>
                                            <th>{{ __('Joined') }}</th>
                                            <th style="width: 10%">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-2">
                                                            <div
                                                                class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                                <strong>{{ strtoupper(substr($user->name, 0, 1)) }}</strong>
                                                            </div>
                                                        </div>
                                                        <div>{{ $user->name }}</div>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->role === 'admin')
                                                        <span class="badge badge-danger">{{ __('Admin') }}</span>
                                                    @else
                                                        <span class="badge badge-info">{{ __('User') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $user->resumes_count }}</td>
                                                <td>{{ $user->portfolios_count }}</td>
                                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title="{{ __('View User') }}"
                                                            class="btn btn-link btn-primary btn-lg">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        @if ($user->role !== 'admin')
                                                            <button type="button" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                                class="btn btn-link btn-danger">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                "pageLength": 10,
                "paging": false,
                "searching": false,
                "ordering": true,
                "info": false
            });
        });
    </script>
@endsection
