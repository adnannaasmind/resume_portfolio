@extends('admin.layouts.master')

@section('title', 'Portfolio Templates')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Portfolio Templates</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item active">Portfolio Templates</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">All Portfolios</h4>
                            <button class="btn btn-primary btn-round ms-auto"
                                onclick="window.location.href='{{ route('admin.portfolio-templates.create') }}'">
                                <i class="fa fa-plus"></i> Add Portfolio Template
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="portfolioTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Title</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($portfolios as $portfolio)
                                        <tr>
                                            <td>{{ $portfolio->id }}</td>
                                            <td>{{ $portfolio->user->name }}</td>
                                            <td>{{ $portfolio->title ?? 'Untitled' }}</td>
                                            <td>{{ $portfolio->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-info"
                                                        onclick="viewPortfolio({{ $portfolio->id }})">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <a href="{{ route('admin.portfolio-templates.edit', $portfolio->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="deletePortfolio({{ $portfolio->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $portfolios->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#portfolioTable').DataTable({
                    "pageLength": 10,
                    "searching": true,
                    "ordering": true,
                    "paging": false
                });
            });

            function viewPortfolio(id) {
                window.open(`/portfolios/${id}`, '_blank');
            }

            function deletePortfolio(id) {
                if (confirm('Are you sure you want to delete this portfolio?')) {
                    $.ajax({
                        url: `/api/v1/portfolios/${id}`,
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                        },
                        success: function () {
                            toastr.success('Portfolio deleted successfully');
                            location.reload();
                        },
                        error: function () {
                            toastr.error('Failed to delete portfolio');
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
