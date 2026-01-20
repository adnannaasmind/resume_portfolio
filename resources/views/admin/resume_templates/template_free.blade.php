@extends('admin.layouts.master')

@push('styles')
    @if ($isEditMode ?? false)
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endif
@endpush

@section('content')
    <style>
        .resume-template-wrapper * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .template-free {
            margin-top: 70px;
        }

        .resume-template-wrapper {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .resume-template-wrapper .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            display: flex;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            min-height: 100vh;
        }

        /* Left Sidebar_template_free */
        .resume-template-wrapper .sidebar_template_free {
            width: 35%;
            background-color: #fafafa;
            padding: 50px 40px;
        }

        .resume-template-wrapper .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            margin: 0 auto 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 72px;
            color: white;
            font-weight: bold;
            position: relative;
            overflow: hidden;
        }

        .resume-template-wrapper .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .resume-template-wrapper .profile-img-edit {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            background: #2196F3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.2s;
        }

        .resume-template-wrapper .profile-img-edit:hover {
            background: #1976D2;
            transform: scale(1.1);
        }

        .resume-template-wrapper .profile-img-edit svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .resume-template-wrapper .name {
            margin-bottom: 30px;
        }

        .resume-template-wrapper .name h1 {
            font-size: 42px;
            color: #2196F3;
            font-weight: 700;
            line-height: 1.2;
        }

        .resume-template-wrapper .job-title {
            color: #999;
            font-size: 18px;
            margin-top: 10px;
        }

        .resume-template-wrapper .section {
            margin-bottom: 40px;
        }

        .resume-template-wrapper .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .resume-template-wrapper .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .resume-template-wrapper .section-title svg {
            width: 24px;
            height: 24px;
            color: #666;
        }

        .resume-template-wrapper .section-title h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .resume-template-wrapper .edit-icon {
            width: 20px;
            height: 20px;
            color: #2196F3;
            cursor: pointer;
        }

        .resume-template-wrapper .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: #666;
            font-size: 14px;
        }

        .resume-template-wrapper .contact-item svg {
            width: 18px;
            height: 18px;
        }

        .resume-template-wrapper .about-text {
            color: #666;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .resume-template-wrapper .skills-list {
            list-style: none;
        }

        .resume-template-wrapper .skills-list li {
            color: #666;
            font-size: 15px;
            margin-bottom: 10px;
            padding-left: 20px;
            position: relative;
        }

        .resume-template-wrapper .skills-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #2196F3;
        }

        /* Right Content */
        .resume-template-wrapper .content {
            width: 65%;
            padding: 50px 60px;
            background: white;
        }

        .resume-template-wrapper .toolbar {
            background: #2196F3;
            padding: 15px 20px;
            margin: -50px -60px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
        }

        .resume-template-wrapper .toolbar-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .resume-template-wrapper .content-section {
            margin-bottom: 50px;
        }

        .resume-template-wrapper .content-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 30px;
            background: #f0f8ff;
            margin-bottom: 30px;
            border-radius: 4px;
        }

        .resume-template-wrapper .content-section-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .resume-template-wrapper .content-section-title svg {
            width: 28px;
            height: 28px;
            color: #666;
        }

        .resume-template-wrapper .content-section-title h2 {
            font-size: 26px;
            font-weight: 600;
        }

        .resume-template-wrapper .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 35px;
        }

        .resume-template-wrapper .timeline-item:before {
            content: "";
            position: absolute;
            left: 4px;
            top: 8px;
            width: 10px;
            height: 10px;
            background: #2196F3;
            border-radius: 50%;
        }

        .resume-template-wrapper .timeline-item:after {
            content: "";
            position: absolute;
            left: 8px;
            top: 18px;
            width: 2px;
            height: calc(100% + 20px);
            background: #e0e0e0;
        }

        .resume-template-wrapper .timeline-item:last-child:after {
            display: none;
        }

        .resume-template-wrapper .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .resume-template-wrapper .item-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .resume-template-wrapper .item-subtitle {
            color: #666;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .resume-template-wrapper .item-date {
            background: #f5f5f5;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        .resume-template-wrapper .item-description {
            color: #666;
            font-size: 14px;
            line-height: 1.8;
        }

        .resume-template-wrapper .references-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .resume-template-wrapper .reference-card {
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }

        .resume-template-wrapper .reference-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .resume-template-wrapper .reference-title {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .resume-template-wrapper .reference-contact {
            color: #666;
            font-size: 13px;
            line-height: 1.8;
        }

        /* Edit Sidebar Styles */
        .edit-sidebar {
            position: fixed;
            right: -450px;
            top: 0;
            width: 450px;
            height: 100vh;
            background: white;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 9999;
            overflow-y: auto;
        }

        .edit-sidebar.active {
            right: 0;
        }

        .edit-sidebar-header {
            background: #2196F3;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .edit-sidebar-header h3 {
            margin: 0;
            font-size: 20px;
        }

        .edit-sidebar-close {
            background: transparent;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit-sidebar-body {
            padding: 20px;
        }

        .edit-sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 9998;
        }

        .edit-sidebar-overlay.active {
            display: block;
        }

        .edit-form-group {
            margin-bottom: 20px;
        }

        .edit-form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .edit-form-input,
        .edit-form-textarea,
        .edit-form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .edit-form-input:focus,
        .edit-form-textarea:focus,
        .edit-form-select:focus {
            outline: none;
            border-color: #2196F3;
        }

        .edit-form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .edit-form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edit-form-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .edit-form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .edit-btn-primary,
        .edit-btn-secondary {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .edit-btn-primary {
            background: #2196F3;
            color: white;
        }

        .edit-btn-primary:hover {
            background: #1976D2;
        }

        .edit-btn-secondary {
            background: #f5f5f5;
            color: #666;
        }

        .edit-btn-secondary:hover {
            background: #e0e0e0;
        }

        .resume-template-wrapper .edit-mode-btn {
            background: #2196F3;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .resume-template-wrapper .edit-mode-btn:hover {
            background: #1976D2;
        }

        .resume-template-wrapper .item-actions {
            position: absolute;
            right: 10px;
            top: 10px;
            display: flex;
            gap: 5px;
        }

        .resume-template-wrapper .item-actions .btn {
            padding: 4px 8px;
            font-size: 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            color: white;
        }

        .resume-template-wrapper .item-actions .btn-info {
            background: #17a2b8;
        }

        .resume-template-wrapper .item-actions .btn-info:hover {
            background: #138496;
        }

        .resume-template-wrapper .item-actions .btn-danger {
            background: #dc3545;
        }

        .resume-template-wrapper .item-actions .btn-danger:hover {
            background: #c82333;
        }
    </style>

    <div class="resume-template-wrapper template-free">
        @if (!($isEditMode ?? false))
            <div
                style="background: #fff3cd; border: 1px solid #ffc107; color: #856404; padding: 15px; margin: 20px; border-radius: 5px; text-align: center; font-size: 14px;">
                <strong>📋 Preview Mode:</strong> This is a template preview with sample data.
                <a href="{{ route('admin.templates.use', $template ?? 1) }}"
                    style="color: #0056b3; text-decoration: underline; margin-left: 10px;">
                    Click here to create your own resume
                </a>
            </div>
        @endif
        <div class="container" data-resume-id="{{ $resume->id }}">
            <!-- Left Sidebar_template_free -->
            <div class="sidebar_template_free">
                @php
                    $nameParts = explode(' ', $resume->user->name);
                    $firstName = $nameParts[0] ?? '';
                    $lastName = implode(' ', array_slice($nameParts, 1));
                    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                    $profileImage = $resume->data['profile_image'] ?? null;
                @endphp

                <div class="profile-img" style="position: relative;">
                    @if($profileImage)
                        <img src="{{ asset('storage/' . $profileImage) }}" alt="Profile Image">
                    @else
                        {{ $initials }}
                    @endif

                    @if ($isEditMode ?? false)
                        <div class="profile-img-edit" onclick="resumeEditor.editProfileImage()">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="name" style="position: relative;">
                    {{-- @if ($isEditMode ?? false)
                    <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        onclick="resumeEditor.editProfile()" style="cursor: pointer; position: absolute; right: 0; top: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    @endif --}}
                    <h1 data-profile-name="{{ $resume->user->name }}">{{ $firstName }}</h1>
                    <h1>{{ $lastName }}</h1>
                    <p class="job-title" data-profile-title="{{ $resume->title }}">{{ $resume->title }}</p>
                </div>

                <div class="section">
                    <div class="section-header">
                        <div class="section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <h2>Contact</h2>
                        </div>
                        @if ($isEditMode ?? false)
                            <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                onclick="resumeEditor.editContact()" style="cursor: pointer;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        @endif
                    </div>
                    <div class="contact-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span
                            data-contact-phone="{{ $resume->user->userProfile->phone ?? '' }}">{{ $resume->user->userProfile->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="contact-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span data-contact-email="{{ $resume->user->email }}">{{ $resume->user->email }}</span>
                    </div>
                    <div class="contact-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span
                            data-contact-location="{{ $resume->user->userProfile->location ?? '' }}">{{ $resume->user->userProfile->location ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">
                        <div class="section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h2>About Me</h2>
                        </div>
                        @if ($isEditMode ?? false)
                            <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                onclick="resumeEditor.editAbout()" style="cursor: pointer;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        @endif
                    </div>
                    <p class="about-text"
                        data-about-summary="{{ $resume->data['summary'] ?? ($resume->user->userProfile->summary ?? '') }}">
                        {{ $resume->data['summary'] ?? ($resume->user->userProfile->summary ?? 'N/A') }}
                    </p>
                </div>

                <div class="section">
                    <div class="section-header">
                        <div class="section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <h2>Skills</h2>
                        </div>
                        @if ($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addSkill()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>
                    <ul class="skills-list">
                        @foreach ($resume->skills as $skill)
                            <li style="position: relative; padding-right: 60px;" data-skill-id="{{ $skill->id }}"
                                data-name="{{ $skill->name }}" data-level="{{ $skill->level ?? '' }}">
                                {{ $skill->name }}
                                @if ($isEditMode ?? false)
                                    <div class="item-actions" style="position: absolute; right: 0; top: 0;">
                                        <button class="btn btn-sm btn-info" onclick="resumeEditor.editSkill({{ $skill->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="resumeEditor.deleteSkill({{ $skill->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Right Content -->
            <div class="content">
                <div class="toolbar">
                    <button class="toolbar-btn">Manrope ▼</button>
                    <button class="toolbar-btn">− 12 +</button>
                    <button class="toolbar-btn">T</button>
                    <button class="toolbar-btn">B I U</button>
                    <button class="toolbar-btn">≡ 1.5 ▼</button>
                    <button class="toolbar-btn">⊟ 1 ▼</button>
                    <button class="toolbar-btn">☰</button>
                </div>

                <div class="content-section">
                    <div class="content-section-header">
                        <div class="content-section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <h2>Education</h2>
                        </div>
                        @if ($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addEducation()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>

                    @foreach ($resume->educations as $education)
                        <div class="timeline-item" style="padding-right: 100px;" data-education-id="{{ $education->id }}"
                            data-degree="{{ $education->degree }}" data-institution="{{ $education->institution }}"
                            data-start-date="{{ $education->start_date }}" data-end-date="{{ $education->end_date ?? '' }}"
                            data-description="{{ $education->description ?? '' }}">
                            @if ($isEditMode ?? false)
                                <div class="item-actions">
                                    <button class="btn btn-sm btn-info" onclick="resumeEditor.editEducation({{ $education->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger"
                                        onclick="resumeEditor.deleteEducation({{ $education->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="item-header">
                                <div>
                                    <div class="item-title">{{ $education->degree }}</div>
                                    <div class="item-subtitle">{{ $education->institution }}</div>
                                </div>
                                <div class="item-date">
                                    {{ date('Y', strtotime($education->start_date)) }}-{{ $education->end_date ? date('Y', strtotime($education->end_date)) : 'Present' }}
                                </div>
                            </div>
                            @if ($education->description)
                                <p class="item-description">{{ $education->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="content-section">
                    <div class="content-section-header">
                        <div class="content-section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <h2>Experience</h2>
                        </div>
                        @if ($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addExperience()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>

                    @foreach ($resume->experiences as $experience)
                        <div class="timeline-item" style="padding-right: 100px;" data-experience-id="{{ $experience->id }}"
                            data-title="{{ $experience->title }}" data-company="{{ $experience->company }}"
                            data-location="{{ $experience->location ?? '' }}" data-start-date="{{ $experience->start_date }}"
                            data-end-date="{{ $experience->end_date ?? '' }}"
                            data-is-current="{{ $experience->is_current ? 'true' : 'false' }}"
                            data-description="{{ $experience->description ?? '' }}">
                            @if ($isEditMode ?? false)
                                <div class="item-actions">
                                    <button class="btn btn-sm btn-info"
                                        onclick="resumeEditor.editExperience({{ $experience->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger"
                                        onclick="resumeEditor.deleteExperience({{ $experience->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="item-header">
                                <div>
                                    <div class="item-title">{{ $experience->title }}</div>
                                    <div class="item-subtitle">{{ $experience->company }}</div>
                                </div>
                                <div class="item-date">
                                    {{ date('Y', strtotime($experience->start_date)) }}-{{ $experience->is_current ? 'Present' : date('Y', strtotime($experience->end_date)) }}
                                </div>
                            </div>
                            <p class="item-description">{{ $experience->description }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="content-section">
                    <div class="content-section-header">
                        <div class="content-section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <h2>References</h2>
                        </div>
                        @if ($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addReference()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>

                    <div class="references-grid">
                        @php
                            $references = $resume->data['references'] ?? [];
                        @endphp
                        @forelse($references as $reference)
                            <div class="reference-card" style="position: relative; padding-right: 60px;"
                                data-reference-id="{{ $reference['id'] }}" data-name="{{ $reference['name'] }}"
                                data-position="{{ $reference['title'] }}" data-company="{{ $reference['company'] ?? '' }}"
                                data-phone="{{ $reference['phone'] ?? '' }}" data-email="{{ $reference['email'] ?? '' }}">
                                @if ($isEditMode ?? false)
                                    <div class="item-actions" style="position: absolute; right: 10px; top: 10px;">
                                        <button class="btn btn-sm btn-info"
                                            onclick="resumeEditor.editReference({{ $reference['id'] }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="resumeEditor.deleteReference({{ $reference['id'] }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                                <div class="reference-name">{{ $reference['name'] }}</div>
                                <div class="reference-title">{{ $reference['company'] ?? '' }}
                                    {{ $reference['company'] && $reference['title'] ? '/' : '' }}{{ $reference['title'] }}
                                </div>
                                @if (!empty($reference['phone']))
                                    <div class="reference-contact">Phone : {{ $reference['phone'] }}</div>
                                @endif
                                @if (!empty($reference['email']))
                                    <div class="reference-contact">Email : {{ $reference['email'] }}</div>
                                @endif
                            </div>
                        @empty
                            <div class="reference-card">
                                <div class="reference-name">No references added yet</div>
                                <div class="reference-title">Click "Add" to add a reference</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($isEditMode ?? false)
        <!-- Edit Sidebar Overlay -->
        <div class="edit-sidebar-overlay" id="editSidebarOverlay" onclick="closeEditSidebar()"></div>

        <!-- Edit Sidebar -->
        <div class="edit-sidebar" id="editSidebar">
            <div class="edit-sidebar-header">
                <h3 id="editSidebarTitle">Add Item</h3>
                <button class="edit-sidebar-close" onclick="resumeEditor.closeSidebar()">&times;</button>
            </div>
            <div class="edit-sidebar-body" id="editSidebarBody">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>

        @push('scripts')
            {{-- <!-- jQuery (required for legacy functions, can be removed later if fully migrated) -->
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}

            <!-- Common Resume Editor Script -->
            <script src="{{ asset('backend/js/resume-editor.js') }}"></script>

            <!-- Initialize Resume Editor -->
            <script>
                console.log('✅ Template Free loaded. All CRUD functions available via resumeEditor object.');
            </script>
        @endpush
    @endif
@endsection