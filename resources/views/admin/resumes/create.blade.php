@extends('admin.layouts.master')

@section('title', 'Create Resume')

@section('content')
<div class="page-header">
    <h3 class="fw-bold mb-3">Create New Resume</h3>
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
            <a href="{{ route('admin.resumes.index') }}">Resumes</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Create</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Resume Information</div>
            </div>
            <form action="{{ route('admin.resumes.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">User <span class="text-danger">*</span></label>
                                <select class="form-control @error('user_id') is-invalid @enderror"
                                        id="user_id" name="user_id" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resume_template_id">Template <span class="text-danger">*</span></label>
                                <select class="form-control @error('resume_template_id') is-invalid @enderror"
                                        id="resume_template_id" name="resume_template_id" required>
                                    <option value="">Select Template</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" {{ old('resume_template_id') == $template->id ? 'selected' : '' }}>
                                            {{ $template->name }} {{ $template->is_premium ? '(Premium)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('resume_template_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Resume Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}"
                               placeholder="e.g., Software Engineer Resume" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="data">Resume Data (JSON)</label>
                        <textarea class="form-control" id="data" name="data" rows="10"
                                  placeholder='{"personal": {}, "experience": [], "education": []}'
                        >{{ old('data') }}</textarea>
                        <small class="form-text text-muted">Enter resume data in JSON format</small>
                    </div>
                </div>

                <div class="card-action">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Resume
                    </button>
                    <a href="{{ route('admin.resumes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
