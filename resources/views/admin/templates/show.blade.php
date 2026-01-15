@extends('admin.layouts.master')

@section('title', 'Template Details')

@section('content')
<div class="page-header">
    <h3 class="fw-bold mb-3">Template Details</h3>
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
            <a href="{{ route('admin.templates.index') }}">Templates</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">{{ $template->name }}</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">{{ $template->name }}</h4>
                    <div class="ms-auto">
                        <a href="{{ route('admin.templates.edit', $template->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.templates.destroy', $template->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this template?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Category:</strong>
                    </div>
                    <div class="col-md-8">
                        <span class="badge badge-info">{{ $template->category }}</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Type:</strong>
                    </div>
                    <div class="col-md-8">
                        @if($template->is_premium)
                            <span class="badge badge-warning">Premium</span>
                        @else
                            <span class="badge badge-success">Free</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Total Uses:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $template->resumes_count ?? 0 }} resumes
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Description:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $template->description ?? 'No description available' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Preview Image:</strong>
                    </div>
                    <div class="col-md-8">
                        @if($template->preview_image)
                            <img src="{{ $template->preview_image }}" alt="{{ $template->name }}"
                                 class="img-fluid" style="max-width: 200px;">
                        @else
                            <span class="text-muted">No preview image</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $template->created_at->format('M d, Y h:i A') }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Last Updated:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $template->updated_at->format('M d, Y h:i A') }}
                    </div>
                </div>

                @if($template->structure)
                <div class="row">
                    <div class="col-12">
                        <strong>Structure:</strong>
                        <pre class="bg-light p-3 mt-2"><code>{{ json_encode($template->structure, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Resumes</p>
                            <h4 class="card-title">{{ $template->resumes_count ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Quick Actions</h4>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.templates.edit', $template->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Template
                    </a>
                    <a href="{{ route('admin.templates.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i> All Templates
                    </a>
                    <form action="{{ route('admin.templates.destroy', $template->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100"
                                onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete Template
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
