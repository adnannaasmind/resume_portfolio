@extends('admin.layouts.master')

@section('title', 'Website Settings')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Website Settings</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Website Settings</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Website Information</h4>
                    </div>
                    <div class="card-body">
                        <form id="websiteSettingsForm">
                            @csrf

                            <div class="form-group">
                                <label for="site_title">Site Title</label>
                                <input type="text" class="form-control" id="site_title" name="site_title"
                                    value="Resume Portfolio Pro">
                            </div>

                            <div class="form-group">
                                <label for="site_tagline">Site Tagline</label>
                                <input type="text" class="form-control" id="site_tagline" name="site_tagline"
                                    value="Build Your Professional Resume & Portfolio">
                            </div>

                            <div class="form-group">
                                <label for="site_description">Site Description</label>
                                <textarea class="form-control" id="site_description" name="site_description"
                                    rows="3">Create professional resumes and portfolios with AI-powered tools</textarea>
                            </div>

                            <div class="form-group">
                                <label for="site_logo">Site Logo URL</label>
                                <input type="url" class="form-control" id="site_logo" name="site_logo">
                                <small class="form-text text-muted">Upload logo to storage and paste URL here</small>
                            </div>

                            <div class="form-group">
                                <label for="site_favicon">Favicon URL</label>
                                <input type="url" class="form-control" id="site_favicon" name="site_favicon">
                            </div>

                            <div class="form-group">
                                <label for="contact_email">Contact Email</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email"
                                    value="contact@resumepro.com">
                            </div>

                            <div class="form-group">
                                <label for="contact_phone">Contact Phone</label>
                                <input type="tel" class="form-control" id="contact_phone" name="contact_phone">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                            </div>

                            <hr>
                            <h5>Social Media Links</h5>

                            <div class="form-group">
                                <label for="facebook_url">Facebook</label>
                                <input type="url" class="form-control" id="facebook_url" name="facebook_url">
                            </div>

                            <div class="form-group">
                                <label for="twitter_url">Twitter</label>
                                <input type="url" class="form-control" id="twitter_url" name="twitter_url">
                            </div>

                            <div class="form-group">
                                <label for="linkedin_url">LinkedIn</label>
                                <input type="url" class="form-control" id="linkedin_url" name="linkedin_url">
                            </div>

                            <div class="form-group">
                                <label for="instagram_url">Instagram</label>
                                <input type="url" class="form-control" id="instagram_url" name="instagram_url">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#websiteSettingsForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/admin/settings/website',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Website settings updated successfully');
                        },
                        error: function (xhr) {
                            toastr.error('Failed to update website settings');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
