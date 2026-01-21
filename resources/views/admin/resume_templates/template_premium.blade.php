@if(!($isPdfMode ?? false) && !($isPreviewMode ?? false))
@extends('admin.layouts.master')

@push('styles')
    @if($isEditMode ?? false)
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endif
@endpush

@section('content')
@endif

@if($isPreviewMode ?? false)
<style>
    /* Force hide admin layout in preview mode */
    .wrapper .sidebar,
    .wrapper .main-header,
    .main-panel .main-header,
    body > .wrapper > .sidebar {
        display: none !important;
    }
    .main-panel {
        width: 100% !important;
        margin-left: 0 !important;
    }
    body {
        overflow: auto !important;
    }
</style>
@endif

<style>
    .resume-template-wrapper * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .template-premium {
        margin-top: 70px;
    }

    /* Main wrapper styles */
    .resume-template-wrapper {
        font-family: 'Calibri', 'Arial', sans-serif;
        background-color: #f8f9fa;
        padding: 20px;
        line-height: 1.5;
    }

    .resume-template-wrapper .container_premium {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Header */
    .resume-template-wrapper .header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 40px 50px 30px;
        border-bottom: 3px solid #00a8e8;
    }

    .resume-template-wrapper .header-left h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .resume-template-wrapper .header-subtitle {
        color: #00a8e8;
        font-size: 11px;
        margin-bottom: 12px;
        line-height: 1.6;
    }

    .resume-template-wrapper .header-contact {
        font-size: 10px;
        color: #333;
    }

    .resume-template-wrapper .header-contact span {
        margin-right: 15px;
    }

    .resume-template-wrapper .profile-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
        font-weight: bold;
        border: 3px solid white;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .resume-template-wrapper .profile-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .resume-template-wrapper .profile-photo-edit {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 30px;
        height: 30px;
        background: #00a8e8;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        transition: all 0.2s;
        z-index: 10;
    }

    .resume-template-wrapper .profile-photo-edit:hover {
        background: #0087c2;
        transform: scale(1.1);
    }

    .resume-template-wrapper .profile-photo-edit svg {
        width: 16px;
        height: 16px;
        color: white;
    }

    /* Main Content */
    .resume-template-wrapper .main-content {
        display: flex;
    }

    /* Left Column */
    .resume-template-wrapper .left-column {
        width: 60%;
        padding: 30px 50px;
    }

    /* Right Column */
    .resume-template-wrapper .right-column {
        width: 40%;
        background: #f8f9fa;
        padding: 30px 35px;
    }

    /* Section Styles */
    .resume-template-wrapper .section {
        margin-bottom: 25px;
    }

    .resume-template-wrapper .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .resume-template-wrapper .section-title {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        padding-bottom: 8px;
        border-bottom: 2px solid #333;
        letter-spacing: 0.5px;
        flex: 1;
    }

    .resume-template-wrapper .section-content {
        font-size: 11px;
        color: #333;
        line-height: 1.7;
    }

    /* Experience Items */
    .resume-template-wrapper .experience-item {
        margin-bottom: 20px;
        position: relative;
        padding-right: 100px;
    }

    .resume-template-wrapper .experience-header {
        display: flex;
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .resume-template-wrapper .experience-icon {
        width: 18px;
        height: 18px;
        background: #00a8e8;
        border-radius: 50%;
        margin-right: 10px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .resume-template-wrapper .experience-title {
        font-weight: 700;
        font-size: 12px;
        margin-bottom: 2px;
    }

    .resume-template-wrapper .experience-company {
        font-size: 11px;
        color: #666;
        margin-bottom: 3px;
    }

    .resume-template-wrapper .experience-date {
        font-size: 10px;
        color: #00a8e8;
        margin-bottom: 8px;
    }

    .resume-template-wrapper .experience-location {
        font-size: 10px;
        color: #999;
        margin-bottom: 8px;
    }

    .resume-template-wrapper .experience-description {
        font-size: 11px;
        color: #444;
        line-height: 1.6;
    }

    .resume-template-wrapper .experience-description ul {
        margin-left: 0;
        padding-left: 15px;
    }

    .resume-template-wrapper .experience-description li {
        margin-bottom: 5px;
    }

    /* Achievement Items */
    .resume-template-wrapper .achievement-item {
        margin-bottom: 18px;
        padding-left: 25px;
        padding-right: 60px;
        position: relative;
    }

    .resume-template-wrapper .achievement-item:before {
        content: "★";
        position: absolute;
        left: 0;
        color: #00a8e8;
        font-size: 14px;
    }

    .resume-template-wrapper .achievement-title {
        font-weight: 700;
        font-size: 11px;
        margin-bottom: 4px;
    }

    .resume-template-wrapper .achievement-description {
        font-size: 10px;
        color: #555;
        line-height: 1.6;
    }

    /* Skills */
    .resume-template-wrapper .skills-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .resume-template-wrapper .skill-item {
        background: white;
        padding: 8px 12px;
        border-left: 3px solid #00a8e8;
        font-size: 11px;
        font-weight: 600;
    }

    /* Passions */
    .resume-template-wrapper .passion-item {
        margin-bottom: 18px;
        padding-right: 60px;
        position: relative;
    }

    .resume-template-wrapper .passion-icon {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 5px;
    }

    .resume-template-wrapper .passion-icon:before {
        content: "♥";
        color: #00a8e8;
        font-size: 16px;
    }

    .resume-template-wrapper .passion-title {
        font-weight: 700;
        font-size: 11px;
    }

    .resume-template-wrapper .passion-description {
        font-size: 10px;
        color: #555;
        line-height: 1.6;
    }

    /* Education */
    .resume-template-wrapper .education-item {
        margin-bottom: 15px;
        padding-right: 100px;
        position: relative;
    }

    .resume-template-wrapper .education-degree {
        font-weight: 700;
        font-size: 12px;
        margin-bottom: 3px;
    }

    .resume-template-wrapper .education-school {
        font-size: 11px;
        color: #666;
        margin-bottom: 2px;
    }

    .resume-template-wrapper .education-year {
        font-size: 10px;
        color: #00a8e8;
    }

    /* Footer */
    .resume-template-wrapper .footer {
        padding: 15px 50px;
        background: #f8f9fa;
        border-top: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        font-size: 9px;
        color: #999;
    }

    /* Edit Mode Styles */
    .resume-template-wrapper .edit-mode-btn {
        background: #00a8e8;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-left: 10px;
    }

    .resume-template-wrapper .edit-mode-btn:hover {
        background: #0087c2;
    }

    .resume-template-wrapper .edit-icon {
        width: 16px;
        height: 16px;
        color: #00a8e8;
        cursor: pointer;
        margin-left: 10px;
    }

    .resume-template-wrapper .item-actions {
        position: absolute;
        right: 10px;
        top: 5px;
        display: flex;
        gap: 5px;
    }

    .resume-template-wrapper .item-actions .btn {
        padding: 4px 8px;
        font-size: 11px;
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
        background: #00a8e8;
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
        border-color: #00a8e8;
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
        background: #00a8e8;
        color: white;
    }

    .edit-btn-primary:hover {
        background: #0087c2;
    }

    .edit-btn-secondary {
        background: #f5f5f5;
        color: #666;
    }

    .edit-btn-secondary:hover {
        background: #e0e0e0;
    }

    @media print {
        .resume-template-wrapper {
            padding: 0;
        }

        .resume-template-wrapper .container_premium {
            box-shadow: none;
        }
    }

    /* PDF Export Styles */
    @media print {
        .edit-mode-btn,
        .edit-icon,
        .item-actions,
        .edit-sidebar,
        .edit-sidebar-overlay {
            display: none !important;
        }
    }
</style>
<!--template start -->
<div class="resume-template-wrapper template-premium">
    @if(!($isEditMode ?? false) && !($isPdfMode ?? false) && !($isPreviewMode ?? false))
        <div
            style="background: #fff3cd; border: 1px solid #ffc107; color: #856404; padding: 15px; margin: 20px; border-radius: 5px; text-align: center; font-size: 14px;">
            <strong>📋 Preview Mode:</strong> This is a template preview with sample data.
            <a href="{{ route('admin.templates.use', $template ?? 2) }}"
                style="color: #0056b3; text-decoration: underline; margin-left: 10px;">
                Click here to create your own resume
            </a>
        </div>
    @endif
    <div class="container_premium" data-resume-id="{{ $resume->id }}">
        <!-- Header -->
        <div class="header">
            <div class="header-left" style="cursor: {{ ($isEditMode ?? false) ? 'pointer' : 'default' }};" @if($isEditMode ?? false) onclick="resumeEditor.editProfile()" title="Click to edit profile" @endif>
                <h1 data-profile-name="{{ $resume->user->name }}">{{ strtoupper($resume->user->name) }}</h1>
                <div class="header-subtitle" data-profile-title="{{ $resume->title }}">
                    {{ $resume->title }}
                </div>
                <div class="header-contact">
                    <span data-contact-phone="{{ $resume->user->userProfile->phone ?? '' }}">📞
                        {{ $resume->user->userProfile->phone ?? 'N/A' }}</span>
                    <span data-contact-email="{{ $resume->user->email }}">✉ {{ $resume->user->email }}</span>
                    <span data-contact-location="{{ $resume->user->userProfile->location ?? '' }}">📍
                        {{ $resume->user->userProfile->location ?? 'N/A' }}</span>
                    @if($isEditMode ?? false)
                        <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            onclick="resumeEditor.editContact()"
                            style="cursor: pointer; display: inline-block; vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    @endif
                </div>
            </div>
            <div class="profile-photo" style="position: relative;">
                @php
                    $nameParts = explode(' ', $resume->user->name);
                    $firstName = $nameParts[0] ?? '';
                    $lastName = implode(' ', array_slice($nameParts, 1));
                    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                    $profileImage = $resume->data['profile_image'] ?? null;
                @endphp

                @if($profileImage)
                    <img src="{{ asset('storage/' . $profileImage) }}" alt="Profile Image">
                @else
                    {{ $initials }}
                @endif

                @if($isEditMode ?? false)
                    <div class="profile-photo-edit" onclick="resumeEditor.editProfile()" title="Edit Profile (Image, Name, Title)">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Left Column -->
            <div class="left-column">
                <!-- Summary -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">SUMMARY</div>
                        @if($isEditMode ?? false)
                            <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                onclick="resumeEditor.editAbout()" style="cursor: pointer;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        @endif
                    </div>
                    <div class="section-content"
                        data-about-summary="{{ $resume->data['summary'] ?? ($resume->user->userProfile->summary ?? '') }}">
                        {{ $resume->data['summary'] ?? $resume->user->userProfile->summary ?? 'N/A' }}
                    </div>
                </div>

                <!-- Experience -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">EXPERIENCE</div>
                        @if($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addExperience()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>

                    @foreach($resume->experiences as $experience)
                        <div class="experience-item" data-experience-id="{{ $experience->id }}"
                            data-title="{{ $experience->title }}" data-company="{{ $experience->company }}"
                            data-location="{{ $experience->location ?? '' }}"
                            data-start-date="{{ $experience->start_date }}"
                            data-end-date="{{ $experience->end_date ?? '' }}"
                            data-is-current="{{ $experience->is_current ? 'true' : 'false' }}"
                            data-description="{{ $experience->description ?? '' }}">
                            @if($isEditMode ?? false)
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
                            <div class="experience-header">
                                <div class="experience-icon"></div>
                                <div>
                                    <div class="experience-title">{{ $experience->title }}</div>
                                    <div class="experience-company">{{ $experience->company }}</div>
                                    <div class="experience-date">
                                        {{ date('m/Y', strtotime($experience->start_date)) }} -
                                        {{ $experience->is_current ? 'Present' : date('m/Y', strtotime($experience->end_date)) }}
                                    </div>
                                </div>
                            </div>
                            <div class="experience-description">
                                {{ $experience->description }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Education -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">EDUCATION</div>
                        @if($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addEducation()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>
                    @foreach($resume->educations as $education)
                        <div class="education-item" data-education-id="{{ $education->id }}"
                            data-degree="{{ $education->degree }}" data-institution="{{ $education->institution }}"
                            data-start-date="{{ $education->start_date }}" data-end-date="{{ $education->end_date ?? '' }}"
                            data-description="{{ $education->description ?? '' }}">
                            @if($isEditMode ?? false)
                                <div class="item-actions">
                                    <button class="btn btn-sm btn-info"
                                        onclick="resumeEditor.editEducation({{ $education->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger"
                                        onclick="resumeEditor.deleteEducation({{ $education->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="education-degree">{{ $education->degree }}</div>
                            <div class="education-school">{{ $education->institution }}</div>
                            <div class="education-year">
                                {{ date('m/Y', strtotime($education->start_date)) }} -
                                {{ $education->end_date ? date('m/Y', strtotime($education->end_date)) : 'Present' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <!-- Achievements -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">ACHIEVEMENTS</div>
                        @if($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addAchievement()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>

                    @if($resume->achievements && $resume->achievements->count() > 0)
                        @foreach($resume->achievements as $achievement)
                            <div class="achievement-item"
                                    data-achievement-id="{{ $achievement->id }}"
                                    data-achievement-title="{{ $achievement->title }}"
                                    data-achievement-issuer="{{ $achievement->issuer ?? '' }}"
                                    data-achievement-date="{{ $achievement->date ? (is_string($achievement->date) ? $achievement->date : $achievement->date->format('Y-m-d')) : '' }}"
                                    data-achievement-description="{{ $achievement->description ?? '' }}">
                                @if($isEditMode ?? false)
                                    <div class="item-actions">
                                        <button class="btn btn-info btn-sm" onclick="resumeEditor.editAchievement({{ $achievement->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="resumeEditor.deleteAchievement({{ $achievement->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                                <div class="achievement-title">{{ $achievement->title }}</div>
                                @if($achievement->issuer)
                                    <div style="font-size: 10px; color: #00a8e8; margin-bottom: 5px;">{{ $achievement->issuer }}</div>
                                @endif
                                @if($achievement->date)
                                    <div style="font-size: 9px; color: #999; margin-bottom: 5px;">
                                        {{ is_string($achievement->date) ? date('M Y', strtotime($achievement->date)) : $achievement->date->format('M Y') }}
                                    </div>
                                @endif
                                @if($achievement->description)
                                    <div class="achievement-description">{{ $achievement->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="achievement-item">
                            <div class="achievement-title">Top Performer Award</div>
                            <div class="achievement-description">Recognized 3 consecutive years for exceeding sales targets by 25% annually and excellent account management.</div>
                        </div>
                    @endif
                </div>

                <!-- Skills -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">SKILLS</div>
                        @if($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addSkill()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>
                    <div class="skills-grid">
                        @foreach($resume->skills as $skill)
                            <div class="skill-item" style="position: relative;" data-skill-id="{{ $skill->id }}"
                                data-name="{{ $skill->name }}" data-level="{{ $skill->level ?? '' }}">
                                {{ $skill->name }}
                                @if($isEditMode ?? false)
                                    <div class="item-actions" style="position: absolute; right: 10px; top: 8px;">
                                        <button class="btn btn-sm btn-info" onclick="resumeEditor.editSkill({{ $skill->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="resumeEditor.deleteSkill({{ $skill->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Highlights / Additional Info -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">HIGHLIGHTS</div>
                        @if($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addHighlight()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>

                    <div class="section-content" style="font-size: 10px; line-height: 1.7;">
                        @if(isset($resume->highlights) && $resume->highlights && $resume->highlights->count() > 0)
                            @foreach($resume->highlights as $highlight)
                                <div class="highlight-item" style="margin-bottom: 12px; position: relative; padding-right: 60px;"
                                        data-highlight-id="{{ $highlight->id }}"
                                        data-highlight-title="{{ $highlight->title }}"
                                        data-highlight-description="{{ $highlight->description }}">
                                @if($isEditMode ?? false)
                                    <div class="item-actions" style="position: absolute; right: 0; top: 0;">
                                        <button class="btn btn-info btn-sm" onclick="resumeEditor.editHighlight({{ $highlight->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="resumeEditor.deleteHighlight({{ $highlight->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    @endif
                                    <strong>{{ $highlight->title }}:</strong> {{ $highlight->description }}
                                    @if(!$loop->last)
                                        <br><br>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="highlight-item" style="margin-bottom: 12px;">
                                <strong>Effective Buyer-Client Relationship:</strong> Adept at forging lasting and meaningful business relationships by leveraging my ability to ensure client happiness, quick problem-solving, and consistent follow-up.
                                <br><br>
                                <strong>Strategic Vision:</strong> Able to identify growth opportunities through market analysis, drawing sound from the Institute of Sales Management, Royal Economics Society, and Institute of Directors along with 9 years of experience.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Passions -->
                <div class="section">
                    <div class="section-header">
                        <div class="section-title">PASSIONS</div>
                        @if($isEditMode ?? false)
                            <button class="edit-mode-btn" onclick="resumeEditor.addPassion()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        @endif
                    </div>

                    @if($resume->passions && $resume->passions->count() > 0)
                        @foreach($resume->passions as $passion)
                            <div class="passion-item"
                                    data-passion-id="{{ $passion->id }}"
                                    data-passion-title="{{ $passion->title }}"
                                    data-passion-icon="{{ $passion->icon ?? '' }}"
                                    data-passion-description="{{ $passion->description ?? '' }}">
                                @if($isEditMode ?? false)
                                    <div class="item-actions">
                                        <button class="btn btn-info btn-sm" onclick="resumeEditor.editPassion({{ $passion->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="resumeEditor.deletePassion({{ $passion->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                                <div class="passion-icon">
                                    @if($passion->icon)
                                        <i class="fas {{ $passion->icon }}" style="margin-right: 8px; color: #00a8e8;"></i>
                                    @endif
                                    <div class="passion-title">{{ $passion->title }}</div>
                                </div>
                                @if($passion->description)
                                    <div class="passion-description">{{ $passion->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="passion-item">
                            <div class="passion-icon">
                                <div class="passion-title">Sales & Market Growth</div>
                            </div>
                            <div class="passion-description">Passionate about identifying new market opportunities and driving sales performance.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>WWW.REALLYGREATSITE.COM</div>
            <div>POWERED BY ❤ ENHANCV</div>
        </div>
    </div>
</div>
<!--template end -->

@if($isEditMode ?? false)
    <!-- Edit Sidebar Overlay -->
    <div class="edit-sidebar-overlay" id="editSidebarOverlay"></div>

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
        {{-- <!-- jQuery (required for Bootstrap Notify notifications) -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}

        <!-- Common Resume Editor Script -->
        <script src="{{ asset('backend/js/resume-editor.js') }}"></script>

        <!-- Initialize Resume Editor -->
        <script>
            console.log('✅ Template Premium loaded. All CRUD functions available via resumeEditor object.');
        </script>
    @endpush
@endif

@if(!($isPdfMode ?? false) && !($isPreviewMode ?? false))
    @endsection
@endif
