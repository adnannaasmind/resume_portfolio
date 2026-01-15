@extends('admin.layouts.master')

@section('title', __('System Settings'))

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">{{ __('System Settings') }}</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">{{ __('System Settings') }}</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('General System Configuration') }}</h4>
                    </div>
                    <div class="card-body">
                        <form id="systemSettingsForm">
                            @csrf

                            <div class="form-group">
                                <label for="app_name">{{ __('Application Name') }}</label>
                                <input type="text" class="form-control" id="app_name" name="app_name"
                                    value="{{ config('app.name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="app_url">{{ __('Application URL') }}</label>
                                <input type="url" class="form-control" id="app_url" name="app_url"
                                    value="{{ config('app.url') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="app_timezone">{{ __('Timezone') }}</label>
                                <select class="form-control" id="app_timezone" name="app_timezone">
                                    <option value="UTC" {{ config('app.timezone') === 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York" {{ config('app.timezone') === 'America/New_York' ? 'selected' : '' }}>America/New_York</option>
                                    <option value="America/Chicago" {{ config('app.timezone') === 'America/Chicago' ? 'selected' : '' }}>America/Chicago</option>
                                    <option value="America/Los_Angeles" {{ config('app.timezone') === 'America/Los_Angeles' ? 'selected' : '' }}>America/Los_Angeles</option>
                                    <option value="Europe/London" {{ config('app.timezone') === 'Europe/London' ? 'selected' : '' }}>Europe/London</option>
                                    <option value="Asia/Dhaka" {{ config('app.timezone') === 'Asia/Dhaka' ? 'selected' : '' }}>Asia/Dhaka</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="app_locale">{{ __('Default Locale') }}</label>
                                <select class="form-control" id="app_locale" name="app_locale">
                                    <option value="en" {{ config('app.locale') === 'en' ? 'selected' : '' }}>{{ __('English') }}</option>
                                    <option value="es" {{ config('app.locale') === 'es' ? 'selected' : '' }}>{{ __('Spanish') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="app_env">{{ __('Environment') }}</label>
                                <select class="form-control" id="app_env" name="app_env">
                                    <option value="local" {{ config('app.env') === 'local' ? 'selected' : '' }}>{{ __('Local') }}</option>
                                    <option value="production" {{ config('app.env') === 'production' ? 'selected' : '' }}>
                                        {{ __('Production') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="app_debug" name="app_debug" {{ config('app.debug') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="app_debug">
                                        {{ __('Debug Mode (Only enable in development)') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="maintenance_mode"
                                        name="maintenance_mode">
                                    <label class="form-check-label" for="maintenance_mode">
                                        {{ __('Maintenance Mode') }}
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Save Settings') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#systemSettingsForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/admin/settings',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('{{ __('System settings updated successfully') }}');
                        },
                        error: function (xhr) {
                            toastr.error('{{ __('Failed to update settings') }}');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
