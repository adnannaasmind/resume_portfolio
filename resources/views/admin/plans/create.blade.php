@extends('admin.layouts.master')

@section('title', 'Create Plan')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Create Pricing Plan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.plans.index') }}">Plans</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Create</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Plan Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="planForm">
                            @csrf

                            <div class="form-group">
                                <label for="name">Plan Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                            </div>

                            <div class="form-group">
                                <label for="billing_period">Billing Period</label>
                                <select class="form-control" id="billing_period" name="billing_period" required>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                    <option value="lifetime">Lifetime</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="features">Features (one per line)</label>
                                <textarea class="form-control" id="features" name="features" rows="8"
                                    placeholder="Unlimited Resumes&#10;5 Portfolio Sites&#10;AI Cover Letters&#10;PDF Export"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="max_resumes">Max Resumes (0 for unlimited)</label>
                                <input type="number" class="form-control" id="max_resumes" name="max_resumes" value="0">
                            </div>

                            <div class="form-group">
                                <label for="max_portfolios">Max Portfolios (0 for unlimited)</label>
                                <input type="number" class="form-control" id="max_portfolios" name="max_portfolios"
                                    value="0">
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                    <label class="form-check-label" for="is_active">
                                        Active Plan
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured">
                                    <label class="form-check-label" for="is_featured">
                                        Featured Plan
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Create Plan</button>
                                <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancel</a>
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
                $('#planForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/api/v1/admin/plans',
                        type: 'POST',
                        data: $(this).serialize(),
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Plan created successfully');
                            setTimeout(() => window.location.href = '{{ route("admin.plans.index") }}', 1500);
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                Object.values(errors).flat().forEach(error => toastr.error(error));
                            } else {
                                toastr.error('Failed to create plan');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
