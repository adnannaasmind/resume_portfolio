@extends('admin.layouts.master')

@section('title', 'SEO Settings')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">SEO Settings</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">SEO Settings</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Search Engine Optimization</h4>
                    </div>
                    <div class="card-body">
                        <form id="seoSettingsForm">
                            @csrf

                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" maxlength="60">
                                <small class="form-text text-muted">Recommended: 50-60 characters</small>
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3"
                                    maxlength="160"></textarea>
                                <small class="form-text text-muted">Recommended: 150-160 characters</small>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                    placeholder="resume, portfolio, cv, professional">
                                <small class="form-text text-muted">Comma-separated keywords</small>
                            </div>

                            <div class="form-group">
                                <label for="meta_author">Meta Author</label>
                                <input type="text" class="form-control" id="meta_author" name="meta_author">
                            </div>

                            <div class="form-group">
                                <label for="og_title">Open Graph Title</label>
                                <input type="text" class="form-control" id="og_title" name="og_title">
                            </div>

                            <div class="form-group">
                                <label for="og_description">Open Graph Description</label>
                                <textarea class="form-control" id="og_description" name="og_description"
                                    rows="2"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="og_image">Open Graph Image URL</label>
                                <input type="url" class="form-control" id="og_image" name="og_image">
                                <small class="form-text text-muted">Recommended size: 1200x630 pixels</small>
                            </div>

                            <div class="form-group">
                                <label for="twitter_card">Twitter Card Type</label>
                                <select class="form-control" id="twitter_card" name="twitter_card">
                                    <option value="summary">Summary</option>
                                    <option value="summary_large_image">Summary with Large Image</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="google_analytics">Google Analytics Tracking ID</label>
                                <input type="text" class="form-control" id="google_analytics" name="google_analytics"
                                    placeholder="UA-XXXXXXXXX-X or G-XXXXXXXXXX">
                            </div>

                            <div class="form-group">
                                <label for="google_site_verification">Google Site Verification</label>
                                <input type="text" class="form-control" id="google_site_verification"
                                    name="google_site_verification">
                            </div>

                            <div class="form-group">
                                <label for="robots_txt">Robots.txt Content</label>
                                <textarea class="form-control" id="robots_txt" name="robots_txt" rows="5">User-agent: *
    Allow: /
    Sitemap: {{ url('/sitemap.xml') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Save SEO Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#seoSettingsForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/admin/settings/seo',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('SEO settings updated successfully');
                        },
                        error: function (xhr) {
                            toastr.error('Failed to update SEO settings');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
