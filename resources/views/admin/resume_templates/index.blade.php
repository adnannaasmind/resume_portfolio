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
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($templates as $template)
                                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card h-100">
                                            <div class="pro-img-box position-relative">
                                                <a href="{{ route('admin.templates.show', $template) }}">
                                                    @if($template->blade_file)
                                                        <div class="template-preview-wrapper">
                                                            <iframe src="{{ route('admin.templates.preview', $template) }}"
                                                                class="template-preview-iframe" scrolling="no">
                                                            </iframe>
                                                        </div>
                                                    @elseif($template->preview_image)
                                                        <img src="{{ asset('storage/' . $template->preview_image) }}"
                                                            class="img-thumbnail" alt="{{ $template->name }}">
                                                    @else
                                                        <img src="https://via.placeholder.com/300x400?text={{ urlencode($template->name) }}"
                                                            class="img-thumbnail" alt="{{ $template->name }}">
                                                    @endif
                                                </a>
                                                <div class="shop-details">
                                                    <form action="{{ route('admin.templates.use', $template) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="adtocart" data-bs-toggle="tooltip"
                                                            title="{{ __('Use This Template') }}">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('admin.templates.show', $template) }}" class="adtocart"
                                                        data-bs-toggle="tooltip" title="{{ __('Preview') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body text-center">
                                                <h5>
                                                    <a href="{{ route('admin.templates.show', $template) }}" class="pro-title">
                                                        <b>{{ strtoupper($template->name) }}</b>
                                                    </a>
                                                </h5>
                                                <p class="mb-2">
                                                    <span
                                                        class="badge badge-secondary">{{ ucfirst($template->category) }}</span>
                                                    @if ($template->is_premium)
                                                        <span class="badge badge-warning">{{ __('Premium') }}</span>
                                                    @else
                                                        <span class="badge badge-success">{{ __('Free') }}</span>
                                                    @endif
                                                </p>
                                                <p class="text-muted mb-0">
                                                    <small>{{ __('Used') }}: {{ $template->resumes_count }}
                                                        {{ __('times') }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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

    <style>
        .pro-img-box {
            position: relative;
            overflow: hidden;
        }

        .pro-img-box img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .template-preview-wrapper {
            width: 100%;
            height: 350px;
            overflow: hidden;
            position: relative;
            background: #f5f5f5;
        }

        .template-preview-iframe {
            width: 1200px;
            height: 1600px;
            border: none;
            transform: scale(0.25);
            transform-origin: 0 0;
            pointer-events: none;
        }

        .pro-img-box:hover img,
        .pro-img-box:hover .template-preview-wrapper {
            transform: scale(1.05);
        }

        .shop-details {
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 10;
        }

        .pro-img-box:hover .shop-details {
            opacity: 1;
        }

        .adtocart {
            width: 40px;
            height: 40px;
            background: #1572e8;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .adtocart:hover {
            background: #0d5dba;
            color: white;
            transform: scale(1.1);
        }

        .pro-title {
            color: #333;
            text-decoration: none;
        }

        .pro-title:hover {
            color: #1572e8;
        }
    </style>
@endsection