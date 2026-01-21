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
                            <a href="{{ route('admin.templates.index') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fas fa-plus"></i>
                                {{ __('Add New Resume') }}
                            </a>
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
                                                        class="btn btn-sm btn-info" title="{{ __('Preview') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.resumes.edit', $resume) }}"
                                                        class="btn btn-sm btn-warning" title="{{ __('Edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.resumes.download', $resume) }}"
                                                        class="btn btn-sm btn-success" title="{{ __('Download PDF') }}"
                                                        target="_blank">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <form action="{{ route('admin.resumes.destroy', $resume) }}" method="POST"
                                                        style="display: inline;" class="delete-form"
                                                        data-resume-title="{{ $resume->title }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                            title="{{ __('Delete') }}">
                                                            <i class="fas fa-trash"></i>
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
                            {{ $resumes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            console.log('Script loaded');

            $(document).ready(function () {
                console.log('Document ready');
                console.log('jQuery loaded:', typeof $ !== 'undefined');
                console.log('SweetAlert loaded:', typeof swal !== 'undefined');

                // Initialize DataTable
                var table = $('#resumesTable').DataTable({
                    "pageLength": 10,
                    "searching": true,
                    "ordering": true,
                    "paging": false,
                    "info": false
                });

                console.log('DataTable initialized');
                console.log('Delete buttons found:', $('.delete-btn').length);
                console.log('Delete forms found:', $('.delete-form').length);

                // Use event delegation for dynamically rendered elements
                $(document).on('click', '.delete-btn', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    console.log('=== DELETE BUTTON CLICKED ===');

                    var $button = $(this);
                    var $form = $button.closest('.delete-form');
                    var resumeTitle = $form.data('resume-title') || 'this resume';

                    console.log('Button:', $button);
                    console.log('Form:', $form);
                    console.log('Resume title:', resumeTitle);
                    console.log('Form action:', $form.attr('action'));

                    if (typeof swal === 'undefined') {
                        console.error('SweetAlert not loaded, using native confirm');
                        if (confirm('Are you sure you want to delete "' + resumeTitle + '"?')) {
                            console.log('Submitting form...');
                            $form[0].submit();
                        }
                        return;
                    }

                    swal({
                        title: "Are you sure?",
                        text: "You are about to delete \"" + resumeTitle + "\". This will permanently delete all data.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            console.log('User confirmed deletion');
                            swal({
                                title: "Deleting...",
                                text: "Please wait",
                                type: "info",
                                showConfirmButton: false,
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            console.log('Submitting form to:', $form.attr('action'));
                            $form[0].submit();
                        } else {
                            console.log('User cancelled deletion');
                        }
                    });
                });

                console.log('Event handler attached');
            });
        </script>
    @endpush
@endsection