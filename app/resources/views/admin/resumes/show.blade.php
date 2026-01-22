@extends('admin.layouts.master')

@section('title', 'Resume Details')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Resume Details</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.resumes.index') }}">Resumes</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Details</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $resume->title ?? 'Untitled Resume' }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Basic Information</h5>
                                <table class="table">
                                    <tr>
                                        <th width="30%">User:</th>
                                        <td><a
                                                href="{{ route('admin.users.show', $resume->user) }}">{{ $resume->user->name }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Template:</th>
                                        <td>{{ $resume->template->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created:</th>
                                        <td>{{ $resume->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Updated:</th>
                                        <td>{{ $resume->updated_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <h5>Resume Data</h5>
                        <div class="bg-light p-3 rounded">
                            <pre>{{ json_encode($resume->data, JSON_PRETTY_PRINT) }}</pre>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('admin.resumes.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
