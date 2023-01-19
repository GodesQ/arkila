@extends('layout.backend-layout.admin') 

@section('content')
<div class="page-body">
    @if(Session::get('success'))
        @push('scripts')
            <script>
                toastr.sucess('{{ Session::get("success") }}', 'Success')
            </script>
        @endpush
    @endif
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Checkouts
                            <small>Arkila Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Checkouts</li>
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
                            <h4 class="card-title">Checkouts List</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table" id="data-table">
                                        <thead>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Total</th>
                                            <th>Quantity</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                            <th>Customer</th>
                                            <th>Action</th>
                                            <th>Review</th>
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
    ajax: '/table_checkouts',
    columns: [{
            data: 'product_image',
            name: 'product_image'
        },
        {
            data: 'product_name',
            name: 'product_name',
        },
        {
            data: 'total',
            name: 'total',
            orderable: true,
            searchable: true
        },
        {
            data: 'quantity',
            name: 'quantity',
            orderable: true,
            searchable: true
        },
        {
            data: 'payment_type',
            name: 'payment_type',
            orderable: true,
            searchable: true
        },
        {
            data: 'status',
            name: 'status',
            orderable: true,
            searchable: true
        },
        {
            data: 'customer',
            name: 'customer',
            orderable: true,
            searchable: true
        },
        {
            data: 'action',
            name: 'action',
            orderable: true,
            searchable: true
        },
        {
            data: 'review_btn',
            name: 'review_btn',
            orderable: true,
            searchable: true
        },
    ],
});
</script>
@endpush
