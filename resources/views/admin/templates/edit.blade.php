@extends('admin.layouts.master')

@section('title', 'Edit Template')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Edit Resume Template</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="{{ route('admin.templates.index') }}">Templates</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item active">Edit</li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Template Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.templates.update', $template) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">{{ __('Template Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $template->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" rows="3">{{ old('description', $template->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">{{ __('Category') }}</label>
                            <select class="form-control @error('category') is-invalid @enderror"
                                id="category" name="category" required>
                                <option value="">{{ __('Select Category') }}</option>
                                <option value="modern" {{ old('category', $template->category) === 'modern' ? 'selected' : '' }}>{{ __('Modern') }}</option>
                                <option value="classic" {{ old('category', $template->category) === 'classic' ? 'selected' : '' }}>{{ __('Classic') }}</option>
                                <option value="creative" {{ old('category', $template->category) === 'creative' ? 'selected' : '' }}>{{ __('Creative') }}</option>
                                <option value="professional" {{ old('category', $template->category) === 'professional' ? 'selected' : '' }}>{{ __('Professional') }}</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="preview_url">{{ __('Preview URL') }}</label>
                            <input type="url" class="form-control @error('preview_url') is-invalid @enderror"
                                id="preview_url" name="preview_url" value="{{ old('preview_url', $template->preview_url) }}">
                            @error('preview_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cover_image">{{ __('Cover Image URL') }}</label>
                            <input type="url" class="form-control @error('cover_image') is-invalid @enderror"
                                id="cover_image" name="cover_image" value="{{ old('cover_image', $template->cover_image) }}">
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_premium"
                                    name="is_premium" value="1" {{ old('is_premium', $template->is_premium) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_premium">
                                    {{ __('Premium Template') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">{{ __('Update Template') }}</button>
                            <a href="{{ route('admin.templates.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
