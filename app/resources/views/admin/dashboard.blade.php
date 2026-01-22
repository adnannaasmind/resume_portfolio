@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('Admin Dashboard') }}</h3>
                    <h6 class="op-7 mb-2">{{ __('ResumePro Admin Panel') }}</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.settings.system') }}" class="btn btn-label-info btn-round me-2">{{ __('Settings') }}</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-round">{{ __('User Dashboard') }}</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ __('Success!') }}</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ __('Error!') }}</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ __('Please fix the following errors:') }}</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{ __('Total Users') }}</p>
                                        <h4 class="card-title">{{ number_format($stats['total_users'] ?? 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{ __('Total Resumes') }}</p>
                                        <h4 class="card-title">{{ number_format($stats['total_resumes'] ?? 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{ __('Total Portfolios') }}</p>
                                        <h4 class="card-title">{{ number_format($stats['total_portfolios'] ?? 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{ __('Total Revenue') }}</p>
                                        <h4 class="card-title">${{ number_format($stats['total_revenue'] ?? 0, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Stats -->
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-warning bubble-shadow-small">
                                        <i class="fas fa-crown"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{ __('Active Subscriptions') }}</p>
                                        <h4 class="card-title">{{ number_format($stats['active_subscriptions'] ?? 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{ __('AI Requests') }}</p>
                                        <h4 class="card-title">{{ number_format($stats['ai_requests'] ?? 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{ __('Monthly Revenue') }}</p>
                                        <h4 class="card-title">${{ number_format($stats['monthly_revenue'] ?? 0, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Tables -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">{{ __('Revenue Statistics (Last 7 Months)') }}</div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(isset($revenue_chart) && !empty($revenue_chart['labels']) && !empty($revenue_chart['data']))
                                <div class="chart-container" style="min-height: 375px">
                                    <canvas id="statisticsChart"></canvas>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center" style="min-height: 375px">
                                    <div class="text-center">
                                        <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">{{ __('No revenue data available') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1>${{ number_format($stats['monthly_revenue'] ?? 0, 2) }}</h1>
                            </div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <span class="avatar-title rounded-circle border border-white bg-success">
                                        <i class="far fa-chart-bar"></i>
                                    </span>
                                </div>
                                <div class="ms-3 info-text">
                                    <h5 class="text-muted mb-0">{{ __('This Month Revenue') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-round">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-end text-primary">{{ $stats['templates'] ?? 0 }}</div>
                            <h2 class="mb-2">{{ $stats['templates'] ?? 0 }}</h2>
                            <p class="text-muted">{{ __('Resume Templates') }}</p>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users & Payments -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">{{ __('Recent Users') }}</h4>
                                <div class="card-tools">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-label-info btn-round btn-sm me-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        {{ __('View All') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col" class="text-end">{{ __('Email') }}</th>
                                            <th scope="col" class="text-end">{{ __('Joined') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recent_users ?? [] as $user)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex">
                                                        <div class="avatar avatar-sm me-2">
                                                            <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                                <strong>{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</strong>
                                                            </div>
                                                        </div>
                                                        <div>{{ $user->name ?? 'Unknown' }}</div>
                                                    </div>
                                                </th>
                                                <td class="text-end">{{ $user->email ?? 'N/A' }}</td>
                                                <td class="text-end">
                                                    @if($user->created_at)
                                                        {{ $user->created_at->diffForHumans() }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-4">
                                                    <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted mb-0">{{ __('No users yet') }}</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">{{ __('Recent Payments') }}</h4>
                                <div class="card-tools">
                                    <button class="btn btn-label-success btn-round btn-sm me-2">
                                        <span class="btn-label">
                                            <i class="fa fa-dollar-sign"></i>
                                        </span>
                                        {{ __('Export') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('User') }}</th>
                                            <th scope="col" class="text-end">{{ __('Amount') }}</th>
                                            <th scope="col" class="text-end">{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recent_payments ?? [] as $payment)
                                            <tr>
                                                <th scope="row">
                                                    <div>{{ optional($payment->user)->name ?? 'N/A' }}</div>
                                                </th>
                                                <td class="text-end">${{ number_format($payment->amount ?? 0, 2) }}</td>
                                                <td class="text-end">
                                                    <span class="badge badge-{{ ($payment->status ?? '') === 'paid' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($payment->status ?? 'pending') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-4">
                                                    <i class="fas fa-dollar-sign fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted mb-0">{{ __('No payments yet') }}</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($revenue_chart) && !empty($revenue_chart['labels']) && !empty($revenue_chart['data']))
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                var ctx = document.getElementById('statisticsChart');

                if (!ctx) {
                    console.error('Chart canvas element not found');
                    return;
                }

                ctx = ctx.getContext('2d');

                var chartData = {
                    labels: {!! json_encode($revenue_chart['labels'] ?? []) !!},
                    datasets: [{
                        label: "Revenue",
                        borderColor: '#177dff',
                        pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                        pointRadius: 3,
                        backgroundColor: 'rgba(23, 125, 255, 0.4)',
                        legendColor: '#177dff',
                        fill: true,
                        borderWidth: 2,
                        data: {!! json_encode($revenue_chart['data'] ?? []) !!}
                    }]
                };

                // Validate chart data
                if (!chartData.labels || chartData.labels.length === 0) {
                    console.warn('No labels provided for chart');
                    return;
                }

                if (!chartData.datasets[0].data || chartData.datasets[0].data.length === 0) {
                    console.warn('No data provided for chart');
                    return;
                }

                var statisticsChart = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            bodySpacing: 4,
                            mode: "nearest",
                            intersect: 0,
                            position: "nearest",
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    try {
                                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += '$' + parseFloat(tooltipItem.yLabel).toFixed(2);
                                        return label;
                                    } catch (e) {
                                        console.error('Error formatting tooltip:', e);
                                        return 'Error';
                                    }
                                }
                            }
                        },
                        layout: {
                            padding: {
                                left: 5,
                                right: 5,
                                top: 15,
                                bottom: 15
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontStyle: "500",
                                    beginAtZero: true,
                                    maxTicksLimit: 5,
                                    padding: 10,
                                    callback: function(value, index, values) {
                                        try {
                                            return '$' + parseFloat(value).toFixed(2);
                                        } catch (e) {
                                            console.error('Error formatting y-axis value:', e);
                                            return value;
                                        }
                                    }
                                },
                                gridLines: {
                                    drawTicks: false,
                                    display: false
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                    zeroLineColor: "transparent"
                                },
                                ticks: {
                                    padding: 10,
                                    fontStyle: "500"
                                }
                            }]
                        }
                    }
                });
            } catch (error) {
                console.error('Error initializing chart:', error);

                // Display error message to user
                var chartContainer = document.querySelector('.chart-container');
                if (chartContainer) {
                    chartContainer.innerHTML = '<div class="alert alert-warning" role="alert">' +
                        '<i class="fas fa-exclamation-triangle me-2"></i>' +
                        'Unable to load chart. Please refresh the page or contact support if the problem persists.' +
                        '</div>';
                }
            }
        });
    </script>
    @endpush
    @endif
@endsection
