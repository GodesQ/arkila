@extends('layout.backend-layout.admin')

@section('content')
    <div class="page-body p-4">
        <div class="page-wrapper">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="card-title"><h2>Profile</h2></div>
                            </div>
                            <div class="col-md-1">
                                <button onclick="history.back()" class="btn btn-solid">Back</button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <h3>{{ $customer->firstname }} {{ $customer->lastname }}</h3>
                                <h5>{{ $customer->email }}</h5>
                            </div>
                            <div class="col-md-2">
                                <img src="{{ url('/assets/images/customers/' .  $customer->customer_image)}}" alt="" class="img-fluid rounded">
                            </div>
                        </div>
                        <hr>
                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 my-2">
                                        <h4><b>Personal Information</b></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Firstname:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $customer->firstname }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Lastname:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $customer->lastname }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Middlename:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $customer->middlename }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Email:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $customer->email }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Contact No:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $customer->contact_no }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Address:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $customer->address }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Total Completed Orders:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $customer->confirmed_checkouts->count() }} Orders</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Customer Rate:</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5> <b>{{ $total_average }}</b> based on {{ $review_counts }} Reviews</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Customer Reviews</h2>
                                <h6>These reviews are from the vendor of the product that has a transaction with this customer.</h6>
                            </div>
                            <div class="col-md-12 my-2">
                                <div class="row">
                                    @forelse($customer->customer_reviews as $review)
                                        <div class="col-md-12 shadow-sm p-3"> 
                                            <div class="h6 text-primary">{{ $review->vendor->firstname }} {{ $review->vendor->lastname }}</div>
                                            <div id="{{ $review->rate }}" class="rate"></div>
                                            <div class="my-1">{{ $review->review }}</div>
                                        </div>
                                    @empty
                                        <div>No Reviews Found</div>
                                    @endforelse
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
        let rates = document.querySelectorAll('.rate');
       rates.forEach((rate) => {
            const values =  [...Array(Number(rate.id))].map((_, i) => i+1);
            console.log(values);
            values.forEach((value) => {
                $(rate).append(`<li style="font-size: 20px; color: rgb(255, 166, 0); margin-top: -10px;">&#9733;</li>`);
            })
       })
    </script>
@endpush