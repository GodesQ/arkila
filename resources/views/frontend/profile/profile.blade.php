@extends('layout.frontend-layout.frontend')

@section('content')
    <div class="page-body">
        @if(Session::get('success'))
            @push("scripts")
                <script>
                    toastr.success('{{ Session::get("success") }}', 'Success');
                </script>
            @endpush
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @push("scripts")
                    <script>
                        toastr.error('{{ $error }}', 'Failed');
                    </script>
                @endpush
            @endforeach
        @endif

        @if(Session::get('fail'))
            @push("scripts")
                <script>
                    toastr.error('{{ Session::get("fail") }}', 'Failed');
                </script>
            @endpush
        @endif

        <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard-sidebar">
                        <div class="profile-top">
                            <div class="profile-image">
                                @if($user->customer_image)
                                    <img style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover; object-position: center;" src="../../../assets/images/customers/{{ $user->customer_image }}" alt="" class="img-fluid">
                                @else
                                    <img style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover; object-position: center;" src="../../../assets/images/user-default-image.png" alt="" class="img-fluid">
                                @endif
                            </div>
                            <div class="profile-detail">
                                <div style="font-size: 20px; font-weight: 800;">{{ $total_average }}</div>
                                <div>Based on {{ count($reviews) }} {{ count($reviews) > 1 ? 'Reviews' : 'Review' }}</div>
                                <div id="{{ $total_average }}" class="rate"></div>
                                <hr>
                                <h5>{{ $user->firstname }} {{ $user->lastname }}</h5>
                                <h6>{{ $user->email }}</h6>
                            </div>
                        </div>
                        <div class="faq-tab">
                            <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active"
                                        href="#dashboard">Profile</a>
                                </li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#orders">orders</a>
                                </li>
                                <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                        href="#settings">settings</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="modal" data-bs-target="#logout"
                                        href="/logout">logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="faq-content tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="dashboard">
                            <div class="counter-section">
                                <div class="row">
                                    <a class="col-xl-3 col-md-6 my-1">
                                        <div class="counter-box">
                                            <img src="../assets/images/icon/dashboard/homework.png" class="img-fluid">
                                            <div>
                                                <h3>{{ $pending_count }}</h3>
                                                <h5>Pending Products</h5>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="col-xl-3 col-md-6 my-1">
                                        <div class="counter-box">
                                            <img src="../assets/images/icon/dashboard/sale.png" class="img-fluid">
                                            <div>
                                                <h3>{{ $delivered_count }}</h3>
                                                <h5>Received Products</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 my-1">
                                        <div class="counter-box">
                                            <img src="../assets/images/icon/dashboard/order.png" class="img-fluid">
                                            <div>
                                                <h3>{{ $returned_count }}</h3>
                                                <h5>Returned Products</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 my-1">
                                        <div class="counter-box">
                                            <img src="../assets/images/icon/dashboard/rated.png" class="img-fluid">
                                            <div>
                                                <h3>{{ $rated_count }}</h3>
                                                <h5>Rated Products</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="/store/update_profile" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">Firstname <span class="danger text-danger">*</span></label>
                                                    <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">Lastname <span class="danger text-danger">*</span></label>
                                                    <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="middlename">Middlename</label>
                                                    <input type="text" name="middlename" class="form-control" value="{{ $user->middlename }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address <span class="danger text-danger">*</span></label>
                                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username">Username <span class="danger text-danger">*</span></label>
                                                    <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" readonly name="email" class="form-control" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contactno">Contact No</label>
                                                    <input type="text" name="contactno" class="form-control" value="{{ $user->contact_no }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="customer_image">Customer Image</label>
                                                    <input type="file" name="customer_image" class="form-control" value="">
                                                    <input type="hidden" name="old_image" class="form-control" value="{{ $user->customer_image }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-footer">
                                            <button class="btn btn-solid">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-content">
                                                <div class="table-responsive">
                                                    <table style="width: 100% !important;" class="table" id="data-table">
                                                        <thead>
                                                            <th>Image</th>
                                                            <th>Product Name</th>
                                                            <th>Total</th>
                                                            <th>Quantity</th>
                                                            <th>Payment Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                            <th>Change Status</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="settings">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mt-0">
                                        <div class="card-body">
                                            <div class="dashboard-box">
                                                <div class="dashboard-title">
                                                    <h4>settings</h4>
                                                </div>
                                                <div class="dashboard-detail">
                                                    <div class="account-setting">
                                                        <h5>Change Password</h5>
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form method="POST" action="/change_password">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $user->id }}" />
                                                                    <div class="form-group">
                                                                        <label>Old Password</label>
                                                                        <input class="form-control" type="password" name="old_password" id="old_password" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>New Password</label>
                                                                        <input class="form-control" type="password" name="password" id="password" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Confirm Password</label>
                                                                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" />
                                                                    </div>
                                                                    <div class="form-footer float-right my-1">
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  dashboard section end -->
    </div>
@endsection

@push('scripts')
<script>
    let table = $('#data-table').DataTable({
    searching: true,
    processing: true,
    pageLength: 10,
    serverSide: true,
    ajax: '/store/profile_order_table',
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
        },
        {
            data: 'quantity',
            name: 'quantity',
        },
        {
            data: 'payment_type',
            name: 'payment_type',
        },
        {
            data: 'status',
            name: 'status',
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
            data: 'review',
            name: 'review',
            orderable: true,
            searchable: true
        },
    ],
});

    let rate = document.querySelector('.rate');

    const values = Math.floor(Number(rate.id));
    for (let index = 0; index < values; index++) {
        console.log(values);
        $(rate).append(`<li style="font-size: 20px; color: rgb(255, 166, 0)">★</li>`);
    }

</script>
@endpush

