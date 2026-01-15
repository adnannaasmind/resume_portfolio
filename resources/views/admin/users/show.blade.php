@extends('admin.layouts.master')

@section('title', 'User Details')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">User Details</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">{{ $user->name }}</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl mb-3">
                            <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                alt="{{ $user->name }}" class="avatar-img rounded-circle">
                        </div>
                        <h4 class="fw-bold">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>
                        <span
                            class="badge badge-{{ $user->role === 'admin' ? 'success' : 'primary' }}">{{ ucfirst($user->role) }}</span>

                        <div class="mt-4">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit User
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Email:</div>
                            <div class="col-7">{{ $user->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Role:</div>
                            <div class="col-7">{{ ucfirst($user->role) }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Joined:</div>
                            <div class="col-7">{{ $user->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Last Login:</div>
                            <div class="col-7">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5 fw-bold">Email Verified:</div>
                            <div class="col-7">
                                @if($user->email_verified_at)
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-warning">Not Verified</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title">Statistics</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <i class="fas fa-file-alt fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $user->resumes->count() }}</h5>
                                        <small class="text-muted">Resumes Created</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <i class="fas fa-briefcase fa-2x text-success"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $user->portfolios->count() }}</h5>
                                        <small class="text-muted">Portfolios Created</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-credit-card fa-2x text-warning"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $user->subscriptions->count() }}</h5>
                                        <small class="text-muted">Subscriptions</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-dollar-sign fa-2x text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">
                                            ${{ number_format($user->payments->where('status', 'paid')->sum('amount'), 2) }}
                                        </h5>
                                        <small class="text-muted">Total Spent</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($user->resumes->count() > 0)
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-title">Recent Resumes</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Template</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->resumes->take(5) as $resume)
                                    <tr>
                                        <td>{{ $resume->title ?? 'Untitled' }}</td>
                                        <td>{{ $resume->template->name ?? 'N/A' }}</td>
                                        <td>{{ $resume->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.resumes.show', $resume) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
