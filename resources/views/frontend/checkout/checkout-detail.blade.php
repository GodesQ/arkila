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
        <div class="container">
            <div class="text-right my-1">
                <button class="btn btn-primary text-right" type="button" onclick="history.back()">Back</button>
                @if($checkout->status == 'PENDING')
                   <a href="/store/update_checkout_status?id={{$checkout->id}}&status=DELIVERED" class="edit btn btn-primary">ORDER RECEIVED</a>
                @elseif($checkout->status == 'DELIVERED')
                    <a href="/store/update_checkout_status?id={{$checkout->id}}&status=RETURNED" class="edit btn btn-success">ORDER RETURNED</a>
                @endif
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-xl-5">
                                <h2>{{ $checkout->product->product_name }}</h2>
                                <h3>&#8369 {{ number_format($checkout->total, 2) }}</h3>
                            </div>
                            <div class="col-lg-4 col-xl-2">
                                <h6>Status</h6>
                                @if($checkout->status == 'PENDING')
                                    <a class="p-2 px-4 bg-primary">{{ $checkout->status }}</a>
                                @elseif($checkout->status == 'DELIVERED')
                                    <a class="p-2 px-4 bg-secondary">{{ $checkout->status }}</a>
                                @elseif($checkout->status == 'RETURNED')
                                    <a class="p-2 px-4 bg-success">{{ $checkout->status }}</a>
                                @else
                                    <a class="p-2 px-4 bg-info">{{ $checkout->status }}</a>
                                @endif
                            </div>
                            <div class="col-lg-4 col-xl-5">
                                <h6>Review</h6>
                                @if($checkout->status == 'RATED')
                                    This Item has already been rated.
                                @else
                                    <a href="{{ $checkout->status == 'RETURNED' ? '/store/write_review/' . $checkout->id : '#' }}" 
                                        class="{{  $checkout->status == 'RETURNED' ? 'p-2 px-4 bg-success text-white' : 'text-black'}}">
                                        {{ $checkout->status == 'RETURNED' ? 'Write Review' : 'You need to return the product before going to review page.' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row py-3" style="border-bottom: 0.5px solid #f8f8f9;">
                            <div class="col-md-4 ">
                                <h3 class="text-left text-primary">Transaction No.</h3>
                                <h4 class="text-left" style="color: black;">#{{ $checkout->txnid }}</h4>
                            </div>
                            <div class="col-md-4">
                                <h3 class="text-left text-primary">Order Date</h3>
                                <h4 class="text-left" style="color: black;">{{date_format(new DateTime($checkout->created_at), "d F Y")}}</h4>
                            </div>
                            <div class="col-md-4">
                                <h3 class="text-left text-primary">Payment Method</h3>
                                <h4 class="text-left" style="color: black;">{{ $checkout->payment_type }}</h4>
                            </div>
                        </div>
                        <div class="row p-3" style="border-bottom: 0.5px solid #f8f8f9;">
                            <h3 style="font-weight: 700; color: black;">Order Information</h3>
                            <div class="container mt-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Product Name</h4>
                                        <h6>{{ $checkout->product->product_name }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Total</h4>
                                        <h6>&#8369 {{ number_format($checkout->total, 2)  }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Quantity</h4>
                                        <h6>{{ $checkout->quantity }} x</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Payment Type</h4>
                                        <h6>{{ $checkout->payment_type  }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Started Rental Date</h4>
                                        <h6>{{ date_format(new DateTime($checkout->start_date), "F d, Y")  }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>End Rental Date</h4>
                                        <h6>{{ date_format(new DateTime($checkout->end_date), "F d, Y")  }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-3" style="border-bottom: 0.5px solid #f8f8f9;">
                            <h3 style="font-weight: 700; color: black;">Customer Information</h3>
                            <div class="container mt-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Customer Name</h4>
                                        <h6>{{ $checkout->customer->firstname }} {{ $checkout->customer->lastname }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Customer Address</h4>
                                        <h6>{{ $checkout->customer->address }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Customer Email</h4>
                                        <h6>{{ $checkout->customer->email }}    </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Contact No.</h4>
                                        <h6>{{ $checkout->customer->contact_no }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-3" style="border-bottom: 0.5px solid #f8f8f9;">
                            <h3 style="font-weight: 700; color: black;">Payment Information</h3>
                            <div class="container mt-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Sub Total</h4>
                                        <h6>&#8369 {{ number_format($checkout->product->amount, 2)  }}</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>Quantity</h4>
                                        <h6>{{ $checkout->quantity }} x</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>Total Dates</h4>
                                        <h6>{{ $checkout->total_date }} Days</h6>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <h4 class="text-primary">Total</h4>
                                        <h6 style="font-weight: 800; color: #000; font-size: 20px;">&#8369 {{ number_format($checkout->total, 2)  }}</h6>
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