@extends('admin.layouts.master')

@section('title', 'SMTP Settings')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">SMTP Settings</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">SMTP Settings</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Email Configuration</h4>
                    </div>
                    <div class="card-body">
                        <form id="smtpSettingsForm">
                            @csrf

                            <div class="form-group">
                                <label for="mail_mailer">Mail Driver</label>
                                <select class="form-control" id="mail_mailer" name="mail_mailer">
                                    <option value="smtp" {{ config('mail.default') === 'smtp' ? 'selected' : '' }}>SMTP
                                    </option>
                                    <option value="sendmail" {{ config('mail.default') === 'sendmail' ? 'selected' : '' }}>
                                        Sendmail</option>
                                    <option value="mailgun" {{ config('mail.default') === 'mailgun' ? 'selected' : '' }}>
                                        Mailgun</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mail_host">SMTP Host</label>
                                <input type="text" class="form-control" id="mail_host" name="mail_host"
                                    value="{{ config('mail.mailers.smtp.host') }}" placeholder="smtp.gmail.com">
                            </div>

                            <div class="form-group">
                                <label for="mail_port">SMTP Port</label>
                                <input type="number" class="form-control" id="mail_port" name="mail_port"
                                    value="{{ config('mail.mailers.smtp.port') }}" placeholder="587">
                            </div>

                            <div class="form-group">
                                <label for="mail_username">SMTP Username</label>
                                <input type="text" class="form-control" id="mail_username" name="mail_username"
                                    value="{{ config('mail.mailers.smtp.username') }}">
                            </div>

                            <div class="form-group">
                                <label for="mail_password">SMTP Password</label>
                                <input type="password" class="form-control" id="mail_password" name="mail_password"
                                    placeholder="Leave blank to keep current">
                            </div>

                            <div class="form-group">
                                <label for="mail_encryption">Encryption</label>
                                <select class="form-control" id="mail_encryption" name="mail_encryption">
                                    <option value="tls" {{ config('mail.mailers.smtp.encryption') === 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ config('mail.mailers.smtp.encryption') === 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="">None</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mail_from_address">From Address</label>
                                <input type="email" class="form-control" id="mail_from_address" name="mail_from_address"
                                    value="{{ config('mail.from.address') }}">
                            </div>

                            <div class="form-group">
                                <label for="mail_from_name">From Name</label>
                                <input type="text" class="form-control" id="mail_from_name" name="mail_from_name"
                                    value="{{ config('mail.from.name') }}">
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                                <button type="button" class="btn btn-secondary" onclick="testEmail()">Send Test
                                    Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#smtpSettingsForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/admin/settings/smtp',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('SMTP settings updated successfully');
                        },
                        error: function (xhr) {
                            toastr.error('Failed to update SMTP settings');
                        }
                    });
                });
            });

            function testEmail() {
                $.ajax({
                    url: '/api/v1/admin/settings/smtp/test',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                    },
                    success: function (response) {
                        toastr.success('Test email sent successfully');
                    },
                    error: function (xhr) {
                        toastr.error('Failed to send test email');
                    }
                });
            }
        </script>
    @endpush
@endsection
