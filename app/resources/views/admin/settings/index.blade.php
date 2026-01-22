@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Settings</h3>
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
                        <a href="#">Settings</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">General Settings</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Site Name</label>
                                            <input type="text" class="form-control" value="ResumePro">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Site Email</label>
                                            <input type="email" class="form-control" value="admin@resumepro.com">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Site Description</label>
                                            <textarea class="form-control"
                                                rows="3">Professional Resume & Portfolio Builder</textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">SMTP Settings</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label>SMTP Host</label>
                                    <input type="text" class="form-control" placeholder="smtp.example.com">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Port</label>
                                    <input type="text" class="form-control" placeholder="587">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Username</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Encryption</label>
                                    <select class="form-control">
                                        <option>TLS</option>
                                        <option>SSL</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save SMTP Settings</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Payment Gateway Settings</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <h5 class="mb-3">Stripe</h5>
                                <div class="form-group">
                                    <label>Stripe Public Key</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Stripe Secret Key</label>
                                    <input type="password" class="form-control">
                                </div>

                                <h5 class="mb-3 mt-4">PayPal</h5>
                                <div class="form-group">
                                    <label>PayPal Client ID</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>PayPal Secret</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mode</label>
                                    <select class="form-control">
                                        <option>Sandbox</option>
                                        <option>Live</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Payment Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">AI Settings (OpenAI)</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>OpenAI API Key</label>
                                            <input type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Model</label>
                                            <select class="form-control">
                                                <option>gpt-3.5-turbo</option>
                                                <option>gpt-4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Enable AI Cover Letter Generation
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save AI Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection