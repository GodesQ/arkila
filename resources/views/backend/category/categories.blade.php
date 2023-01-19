@extends('layout.backend-layout.admin') @section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Categories
                            <small>Arkila Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card active-users">
                        <div class="card-header border-0">
                            <h4 class="card-title">Categories List</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table" id="data-table">
                                        <thead>
                                            <th>Image</th>
                                            <th>Category Name</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let table = $('#data-table').DataTable({
    searching: true,
    processing: true,
    pageLength: 10,
    serverSide: true,
    ajax: '/table_categories',
    columns: [{
            data: 'category_image',
            name: 'category_image'
        },
        {
            data: 'category_name',
            name: 'category_name',
        },
        {
            data: 'created_at',
            name: 'created_at',
            orderable: true,
            searchable: true
        },
        {
            data: 'action',
            name: 'action',
            orderable: true,
            searchable: true
        },
    ],
});
</script>
@endpush
