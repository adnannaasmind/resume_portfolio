@extends('admin.layouts.master')

@section('title', 'Edit Plan')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Pricing Plan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.plans.index') }}">Plans</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Edit</li>
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
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Plan Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $plan->name }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3">{{ $plan->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    value="{{ $plan->price }}" required>
                            </div>

                            <div class="form-group">
                                <label for="billing_period">Billing Period</label>
                                <select class="form-control" id="billing_period" name="billing_period" required>
                                    <option value="monthly" {{ $plan->billing_period === 'monthly' ? 'selected' : '' }}>
                                        Monthly</option>
                                    <option value="yearly" {{ $plan->billing_period === 'yearly' ? 'selected' : '' }}>Yearly
                                    </option>
                                    <option value="lifetime" {{ $plan->billing_period === 'lifetime' ? 'selected' : '' }}>
                                        Lifetime</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="features">Features (one per line)</label>
                                <textarea class="form-control" id="features" name="features"
                                    rows="8">{{ is_array($plan->features) ? implode("\n", $plan->features) : $plan->features }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="max_resumes">Max Resumes (0 for unlimited)</label>
                                <input type="number" class="form-control" id="max_resumes" name="max_resumes"
                                    value="{{ $plan->max_resumes ?? 0 }}">
                            </div>

                            <div class="form-group">
                                <label for="max_portfolios">Max Portfolios (0 for unlimited)</label>
                                <input type="number" class="form-control" id="max_portfolios" name="max_portfolios"
                                    value="{{ $plan->max_portfolios ?? 0 }}">
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $plan->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active Plan
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" {{ $plan->is_featured ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Featured Plan
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Update Plan</button>
                                <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="button" class="btn btn-danger ms-auto" onclick="deletePlan()">Delete
                                    Plan</button>
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
                        url: '/api/v1/admin/plans/{{ $plan->id }}',
                        type: 'POST',
                        data: $(this).serialize(),
                        headers: {
                            'X-HTTP-Method-Override': 'PUT',
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function (response) {
                            toastr.success('Plan updated successfully');
                            setTimeout(() => window.location.href = '{{ route("admin.plans.index") }}', 1500);
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                Object.values(errors).flat().forEach(error => toastr.error(error));
                            } else {
                                toastr.error('Failed to update plan');
                            }
                        }
                    });
                });
            });

            function deletePlan() {
                if (confirm('Are you sure you want to delete this plan?')) {
                    $.ajax({
                        url: '/api/v1/admin/plans/{{ $plan->id }}',
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function () {
                            toastr.success('Plan deleted successfully');
                            setTimeout(() => window.location.href = '{{ route("admin.plans.index") }}', 1500);
                        },
                        error: function () {
                            toastr.error('Failed to delete plan');
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
