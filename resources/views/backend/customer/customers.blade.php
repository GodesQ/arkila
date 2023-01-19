@extends('layout.backend-layout.admin') @section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Customers
                            <small>Arkila Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Vendors</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::get('status'))
            <div class="success alert-success p-2 my-2">
                {{Session::get('status')}}
            </div>
        @push('scripts')
        <script>
            toastr.success("{{Session::get('status')}}", 'Success');
        </script>
        @endpush
        @endif
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
                                            <th>Email</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
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
    ajax: '/table_customers',
    columns: [
        {
            data: 'email',
            name: 'email',
        },
        {
            data: 'firstname',
            name: 'firstname',
            orderable: true,
            searchable: true
        },
        {
            data: 'lastname',
            name: 'lastname',
            orderable: true,
            searchable: true
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
