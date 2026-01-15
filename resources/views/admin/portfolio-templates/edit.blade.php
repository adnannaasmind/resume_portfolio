@extends('admin.layouts.master')

@section('title', 'Edit Portfolio Template')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Portfolio Template</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.portfolio-templates.index') }}">Portfolio Templates</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Edit</li>
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
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Template Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $portfolio->title }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3">{{ $portfolio->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="theme">Theme</label>
                                <select class="form-control" id="theme" name="theme">
                                    <option value="light" {{ ($portfolio->data['theme'] ?? '') === 'light' ? 'selected' : '' }}>Light</option>
                                    <option value="dark" {{ ($portfolio->data['theme'] ?? '') === 'dark' ? 'selected' : '' }}>
                                        Dark</option>
                                    <option value="colorful" {{ ($portfolio->data['theme'] ?? '') === 'colorful' ? 'selected' : '' }}>Colorful</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="layout">Layout Style</label>
                                <select class="form-control" id="layout" name="layout">
                                    <option value="modern" {{ ($portfolio->data['layout'] ?? '') === 'modern' ? 'selected' : '' }}>Modern</option>
                                    <option value="classic" {{ ($portfolio->data['layout'] ?? '') === 'classic' ? 'selected' : '' }}>Classic</option>
                                    <option value="creative" {{ ($portfolio->data['layout'] ?? '') === 'creative' ? 'selected' : '' }}>Creative</option>
                                    <option value="minimal" {{ ($portfolio->data['layout'] ?? '') === 'minimal' ? 'selected' : '' }}>Minimal</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Update Portfolio Template</button>
                                <a href="{{ route('admin.portfolio-templates.index') }}"
                                    class="btn btn-secondary">Cancel</a>
                                <button type="button" class="btn btn-danger ms-auto" onclick="deletePortfolio()">Delete
                                    Portfolio</button>
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
                        url: '/api/v1/portfolios/{{ $portfolio->id }}',
                        type: 'POST',
                        data: $(this).serialize(),
                        headers: {
                            'X-HTTP-Method-Override': 'PUT',
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Portfolio template updated successfully');
                            setTimeout(() => window.location.href = '{{ route("admin.portfolio-templates.index") }}', 1500);
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                Object.values(errors).flat().forEach(error => toastr.error(error));
                            } else {
                                toastr.error('Failed to update portfolio template');
                            }
                        }
                    });
                });
            });

            function deletePortfolio() {
                if (confirm('Are you sure you want to delete this portfolio?')) {
                    $.ajax({
                        url: '/api/v1/portfolios/{{ $portfolio->id }}',
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function () {
                            toastr.success('Portfolio deleted successfully');
                            setTimeout(() => window.location.href = '{{ route("admin.portfolio-templates.index") }}', 1500);
                        },
                        error: function () {
                            toastr.error('Failed to delete portfolio');
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
