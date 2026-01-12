@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Template Management</h3>
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
                        <a href="#">Templates</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Resume Templates</h4>
                                <button class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Template
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="templates-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Premium</th>
                                            <th>Usage Count</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($templates as $template)
                                            <tr>
                                                <td>{{ $template->name }}</td>
                                                <td>{{ ucfirst($template->category) }}</td>
                                                <td>
                                                    @if ($template->is_premium)
                                                        <span class="badge badge-warning">Premium</span>
                                                    @else
                                                        <span class="badge badge-success">Free</span>
                                                    @endif
                                                </td>
                                                <td>{{ $template->resumes_count }}</td>
                                                <td>
                                                    @if ($template->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title="Edit"
                                                            class="btn btn-link btn-primary btn-lg">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-bs-toggle="tooltip" title="Preview"
                                                            class="btn btn-link btn-info">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button type="button" data-bs-toggle="tooltip" title="Delete"
                                                            class="btn btn-link btn-danger">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $templates->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#templates-table').DataTable({
                "pageLength": 10,
                "paging": false,
                "searching": false,
                "ordering": true,
                "info": false
            });
        });
    </script>
@endsection