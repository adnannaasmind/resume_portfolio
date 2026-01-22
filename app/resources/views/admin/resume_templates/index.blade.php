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
                                    @php
                                        $hasResume = in_array($template->id, $userResumeTemplateIds ?? []);
                                    @endphp
                                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card h-100 {{ $hasResume ? 'border-primary' : '' }}">
                                            @if($hasResume)
                                                <div class="ribbon ribbon-top-right">
                                                    <span class="bg-primary" style="font-size: 11px; padding: 5px 15px;">
                                                        <i class="fas fa-check"></i> In Use
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="pro-img-box position-relative">
                                                <a href="{{ route('admin.templates.show', $template) }}">
                                                    @if($template->blade_file)
                                                        <div class="template-preview-wrapper">
                                                            <iframe
                                                                src="{{ route('admin.templates.preview', $template) }}?v={{ time() }}"
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
                                                    @if($hasResume)
                                                        <form action="{{ route('admin.templates.use', $template) }}" method="POST"
                                                            style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="adtocart" data-bs-toggle="tooltip"
                                                                title="{{ __('Edit Your Resume') }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button type="button" class="adtocart use-template-btn"
                                                            data-template-id="{{ $template->id }}"
                                                            data-template-name="{{ $template->name }}" data-bs-toggle="tooltip"
                                                            title="{{ __('Use This Template') }}">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    @endif
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

        /* Ribbon for templates in use */
        .ribbon {
            position: absolute;
            z-index: 20;
        }

        .ribbon-top-right {
            top: -5px;
            right: -5px;
        }

        .ribbon-top-right span {
            position: relative;
            display: block;
            text-align: center;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transform: rotate(0deg);
        }

        .ribbon-top-right span::before,
        .ribbon-top-right span::after {
            position: absolute;
            content: "";
            display: block;
            border: 5px solid #1572e8;
            border-top-color: transparent;
            border-right-color: transparent;
            bottom: -5px;
        }

        .ribbon-top-right span::before {
            left: 0;
        }

        .ribbon-top-right span::after {
            right: 0;
        }

        .card.border-primary {
            border-width: 2px !important;
            box-shadow: 0 0 15px rgba(21, 114, 232, 0.2);
        }

        .pro-title {
            color: #333;
            text-decoration: none;
        }

        .pro-title:hover {
            color: #1572e8;
        }
    </style>

    <!-- Modal for Resume Title Input -->
    <div class="modal fade" id="resumeTitleModal" tabindex="-1" aria-labelledby="resumeTitleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resumeTitleModalLabel">
                        <i class="fas fa-file-alt"></i> {{ __('Create New Resume') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createResumeForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="resumeTitle" class="form-label">{{ __('Resume Title') }} <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="resumeTitle" name="title"
                                placeholder="{{ __('e.g., Software Engineer Resume, Marketing Manager CV') }}" required>
                            <small class="form-text text-muted">
                                {{ __('Give your resume a descriptive title to help you organize multiple resumes') }}
                            </small>
                        </div>
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle"></i> {{ __('Using template') }}: <strong
                                id="selectedTemplateName"></strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('Create Resume') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                // Initialize tooltips
                $('[data-bs-toggle="tooltip"]').tooltip();

                // Handle Use Template button click
                $('.use-template-btn').on('click', function () {
                    const templateId = $(this).data('template-id');
                    const templateName = $(this).data('template-name');

                    // Set the template name in modal
                    $('#selectedTemplateName').text(templateName);

                    // Set the form action
                    const formAction = "{{ route('admin.templates.use', ':id') }}".replace(':id', templateId);
                    $('#createResumeForm').attr('action', formAction);

                    // Set default title suggestion
                    $('#resumeTitle').val(templateName + ' Resume');

                    // Show modal
                    $('#resumeTitleModal').modal('show');
                });

                // Handle form submission
                $('#createResumeForm').on('submit', function (e) {
                    const title = $('#resumeTitle').val().trim();

                    if (!title) {
                        e.preventDefault();
                        alert('{{ __('Please enter a resume title') }}');
                        return false;
                    }
                });

                // Clear form when modal is closed
                $('#resumeTitleModal').on('hidden.bs.modal', function () {
                    $('#resumeTitle').val('');
                    $('#createResumeForm').attr('action', '');
                });
            });
        </script>
    @endpush
@endsection