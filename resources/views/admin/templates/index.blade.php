@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">{{ __('Template Management') }}</h3>
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
                        <a href="#">{{ __('Templates') }}</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('Resume Templates') }}</h4>
                                <a href="{{ route('admin.templates.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    {{ __('Add Template') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="templates-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Premium') }}</th>
                                            <th>{{ __('Usage Count') }}</th>
                                            <th style="width: 10%">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($templates as $template)
                                            <tr>
                                                <td>{{ $template->name }}</td>
                                                <td>{{ ucfirst($template->category) }}</td>
                                                <td>
                                                    @if ($template->is_premium)
                                                        <span class="badge badge-warning">{{ __('Premium') }}</span>
                                                    @else
                                                        <span class="badge badge-success">{{ __('Free') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $template->resumes_count }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('admin.templates.edit', $template) }}"
                                                            data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                            class="btn btn-link btn-primary btn-lg">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.templates.show', $template) }}"
                                                            data-bs-toggle="tooltip" title="{{ __('Preview') }}"
                                                            class="btn btn-link btn-info">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('admin.templates.destroy', $template) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('{{ __('Are you sure you want to delete this template?') }}')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                                class="btn btn-link btn-danger">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
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
