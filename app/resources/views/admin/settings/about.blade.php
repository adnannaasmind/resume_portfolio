@extends('admin.layouts.master')

@section('title', 'About Settings')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">About Settings</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">About</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">About Us Page Content</h4>
                    </div>
                    <div class="card-body">
                        <form id="aboutSettingsForm">
                            @csrf

                            <div class="form-group">
                                <label for="about_title">About Title</label>
                                <input type="text" class="form-control" id="about_title" name="about_title"
                                    value="About Resume Portfolio Pro">
                            </div>

                            <div class="form-group">
                                <label for="about_subtitle">Subtitle</label>
                                <input type="text" class="form-control" id="about_subtitle" name="about_subtitle"
                                    value="Your Professional Career Platform">
                            </div>

                            <div class="form-group">
                                <label for="about_description">About Description</label>
                                <textarea class="form-control" id="about_description" name="about_description"
                                    rows="8">We are dedicated to helping professionals build stunning resumes and portfolios that stand out. Our AI-powered platform makes it easy to create professional documents that get you noticed by employers.</textarea>
                            </div>

                            <hr>
                            <h5>Mission & Vision</h5>

                            <div class="form-group">
                                <label for="mission">Our Mission</label>
                                <textarea class="form-control" id="mission" name="mission"
                                    rows="4">To empower job seekers and professionals with the tools they need to present their skills and experience in the best possible way.</textarea>
                            </div>

                            <div class="form-group">
                                <label for="vision">Our Vision</label>
                                <textarea class="form-control" id="vision" name="vision"
                                    rows="4">To become the world's leading platform for professional resume and portfolio creation.</textarea>
                            </div>

                            <hr>
                            <h5>Company Information</h5>

                            <div class="form-group">
                                <label for="founded_year">Founded Year</label>
                                <input type="number" class="form-control" id="founded_year" name="founded_year"
                                    value="2026">
                            </div>

                            <div class="form-group">
                                <label for="team_size">Team Size</label>
                                <input type="text" class="form-control" id="team_size" name="team_size" value="10-50">
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="Global">
                            </div>

                            <hr>
                            <h5>Features Highlights</h5>

                            <div class="form-group">
                                <label for="features">Key Features (one per line)</label>
                                <textarea class="form-control" id="features" name="features" rows="6">AI-Powered Resume Builder
    Professional Templates
    Portfolio Showcase
    PDF Export
    Cover Letter Generator
    Multi-language Support</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Save About Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#aboutSettingsForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/admin/settings/about',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('About settings updated successfully');
                        },
                        error: function (xhr) {
                            toastr.error('Failed to update about settings');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
