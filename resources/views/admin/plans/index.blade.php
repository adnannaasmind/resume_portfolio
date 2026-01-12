@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Pricing Plans</h3>
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
                        <a href="#">Plans</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                @foreach ($plans as $plan)
                    <div class="col-md-4">
                        <div class="card card-pricing">
                            <div class="card-header">
                                <h4 class="card-title">{{ $plan->name }}</h4>
                                <div class="card-price">
                                    <span class="price">${{ number_format($plan->price, 2) }}</span>
                                    <span class="text">/{{ $plan->billing_period }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="specification-list">
                                    <li>
                                        <span
                                            class="name-specification">{{ $plan->features['resume_limit'] ?? 'Unlimited' }}</span>
                                        <span class="status-specification">Resumes</span>
                                    </li>
                                    <li>
                                        <span
                                            class="name-specification">{{ $plan->features['portfolio_limit'] ?? 'Unlimited' }}</span>
                                        <span class="status-specification">Portfolios</span>
                                    </li>
                                    <li>
                                        <span
                                            class="name-specification">{{ $plan->features['ai_requests'] ?? 'Unlimited' }}</span>
                                        <span class="status-specification">AI Requests</span>
                                    </li>
                                    @if (isset($plan->features['premium_templates']) && $plan->features['premium_templates'])
                                        <li>
                                            <span class="name-specification">✓</span>
                                            <span class="status-specification">Premium Templates</span>
                                        </li>
                                    @endif
                                    @if (isset($plan->features['no_watermark']) && $plan->features['no_watermark'])
                                        <li>
                                            <span class="name-specification">✓</span>
                                            <span class="status-specification">No Watermark</span>
                                        </li>
                                    @endif
                                    @if (isset($plan->features['priority_support']) && $plan->features['priority_support'])
                                        <li>
                                            <span class="name-specification">✓</span>
                                            <span class="status-specification">Priority Support</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary btn-border">Edit Plan</button>
                                </div>
                                <div class="mt-2 text-center">
                                    <small class="text-muted">{{ $plan->subscriptions_count }} active subscriptions</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Plans</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Plan Name</th>
                                            <th>Price</th>
                                            <th>Billing</th>
                                            <th>Subscriptions</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($plans as $plan)
                                            <tr>
                                                <td><strong>{{ $plan->name }}</strong></td>
                                                <td>${{ number_format($plan->price, 2) }}</td>
                                                <td>{{ ucfirst($plan->billing_period) }}</td>
                                                <td>{{ $plan->subscriptions_count }}</td>
                                                <td>
                                                    @if ($plan->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">Edit</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection