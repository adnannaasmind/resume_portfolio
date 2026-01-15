@extends('admin.layouts.master')

@section('title', 'Create Portfolio Template')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Create Portfolio Template</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.portfolio-templates.index') }}">Portfolio Templates</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Create</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Portfolio Template Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="portfolioTemplateForm">
                            @csrf

                            <div class="form-group">
                                <label for="title">Template Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="theme">Theme</label>
                                <select class="form-control" id="theme" name="theme">
                                    <option value="light">Light</option>
                                    <option value="dark">Dark</option>
                                    <option value="colorful">Colorful</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="layout">Layout Style</label>
                                <select class="form-control" id="layout" name="layout">
                                    <option value="modern">Modern</option>
                                    <option value="classic">Classic</option>
                                    <option value="creative">Creative</option>
                                    <option value="minimal">Minimal</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Create Portfolio Template</button>
                                <a href="{{ route('admin.portfolio-templates.index') }}"
                                    class="btn btn-secondary">Cancel</a>
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
                $('#portfolioTemplateForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/portfolios',
                        type: 'POST',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Portfolio template created successfully');
                            setTimeout(() => window.location.href = '{{ route("admin.portfolio-templates.index") }}', 1500);
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                Object.values(errors).flat().forEach(error => toastr.error(error));
                            } else {
                                toastr.error('Failed to create portfolio template');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
