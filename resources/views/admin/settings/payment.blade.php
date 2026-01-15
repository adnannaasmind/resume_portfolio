@extends('admin.layouts.master')

@section('title', 'Payment Settings')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Payment Settings</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Payment Settings</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Stripe Configuration</h4>
                    </div>
                    <div class="card-body">
                        <form id="stripeSettingsForm">
                            @csrf

                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="stripe_enabled"
                                        name="stripe_enabled" checked>
                                    <label class="form-check-label" for="stripe_enabled">
                                        Enable Stripe
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="stripe_key">Stripe Publishable Key</label>
                                <input type="text" class="form-control" id="stripe_key" name="stripe_key"
                                    value="{{ config('services.stripe.key') }}">
                            </div>

                            <div class="form-group">
                                <label for="stripe_secret">Stripe Secret Key</label>
                                <input type="password" class="form-control" id="stripe_secret" name="stripe_secret"
                                    placeholder="Leave blank to keep current">
                            </div>

                            <div class="form-group">
                                <label for="stripe_webhook_secret">Stripe Webhook Secret</label>
                                <input type="password" class="form-control" id="stripe_webhook_secret"
                                    name="stripe_webhook_secret" placeholder="Leave blank to keep current">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Stripe Settings</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title">PayPal Configuration</h4>
                    </div>
                    <div class="card-body">
                        <form id="paypalSettingsForm">
                            @csrf

                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="paypal_enabled"
                                        name="paypal_enabled">
                                    <label class="form-check-label" for="paypal_enabled">
                                        Enable PayPal
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="paypal_mode">Mode</label>
                                <select class="form-control" id="paypal_mode" name="paypal_mode">
                                    <option value="sandbox">Sandbox</option>
                                    <option value="live">Live</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paypal_client_id">PayPal Client ID</label>
                                <input type="text" class="form-control" id="paypal_client_id" name="paypal_client_id">
                            </div>

                            <div class="form-group">
                                <label for="paypal_secret">PayPal Secret</label>
                                <input type="password" class="form-control" id="paypal_secret" name="paypal_secret"
                                    placeholder="Leave blank to keep current">
                            </div>

                            <button type="submit" class="btn btn-primary">Save PayPal Settings</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title">General Payment Settings</h4>
                    </div>
                    <div class="card-body">
                        <form id="generalPaymentForm">
                            @csrf

                            <div class="form-group">
                                <label for="currency">Currency</label>
                                <select class="form-control" id="currency" name="currency">
                                    <option value="USD">USD - US Dollar</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="GBP">GBP - British Pound</option>
                                    <option value="BDT">BDT - Bangladeshi Taka</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tax_rate">Tax Rate (%)</label>
                                <input type="number" step="0.01" class="form-control" id="tax_rate" name="tax_rate"
                                    value="0">
                            </div>

                            <button type="submit" class="btn btn-primary">Save General Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#stripeSettingsForm, #paypalSettingsForm, #generalPaymentForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/admin/settings/payment',
                        type: 'PUT',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Payment settings updated successfully');
                        },
                        error: function (xhr) {
                            toastr.error('Failed to update payment settings');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
