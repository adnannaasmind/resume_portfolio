@extends('admin.layouts.master')

@section('title', __('My Resume'))

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">{{ __('My Resume') }}</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">{{ __('My Resume') }}</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ __('All Resumes') }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="resumesTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Template') }}</th>
                                        <th>{{ __('Created') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resumes as $resume)
                                        <tr>
                                            <td>{{ $resume->id }}</td>
                                            <td>{{ $resume->title ?? __('Untitled Resume') }}</td>
                                            <td>{{ $resume->user->name }}</td>
                                            <td>{{ $resume->template->name ?? 'N/A' }}</td>
                                            <td>{{ $resume->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.resumes.show', $resume) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="deleteResume({{ $resume->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $resumes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#resumesTable').DataTable({
                    "pageLength": 10,
                    "searching": true,
                    "ordering": true,
                    "paging": false
                });
            });

            function deleteResume(id) {
                if (confirm('{{ __('Are you sure you want to delete this resume?') }}')) {
                    $.ajax({
                        url: `/api/v1/resumes/${id}`,
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function () {
                            toastr.success('{{ __('Resume deleted successfully') }}');
                            location.reload();
                        },
                        error: function () {
                            toastr.error('{{ __('Failed to delete resume') }}');
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
