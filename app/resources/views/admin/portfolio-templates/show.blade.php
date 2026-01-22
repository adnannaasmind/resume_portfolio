@extends('admin.layouts.master')

@section('title', 'Portfolio Details')

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Portfolio Details</h3>
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
                <a href="{{ route('admin.portfolios.index') }}">Portfolios</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ $portfolio->title }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $portfolio->title }}</h4>
                        <div class="ms-auto">
                            <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Owner:</strong>
                        </div>
                        <div class="col-md-9">
                            <a href="{{ route('admin.users.show', $portfolio->user_id) }}">
                                {{ $portfolio->user->name }}
                            </a>
                            <span class="text-muted">({{ $portfolio->user->email }})</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Title:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $portfolio->title }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Description:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $portfolio->description ?? 'No description provided' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Created:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $portfolio->created_at->format('M d, Y h:i A') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Last Updated:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $portfolio->updated_at->format('M d, Y h:i A') }}
                        </div>
                    </div>

                    @if($portfolio->data)
                        <div class="row">
                            <div class="col-12">
                                <strong>Portfolio Data:</strong>
                                <pre
                                    class="bg-light p-3 mt-2"><code>{{ json_encode($portfolio->data, JSON_PRETTY_PRINT) }}</code></pre>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
