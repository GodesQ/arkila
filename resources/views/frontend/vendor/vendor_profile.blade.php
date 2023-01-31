@extends('layout.frontend-layout.frontend')

@section('content')

<div class="page-body">

    <!-- vendor cover start -->
    <div class="vendor-cover">
        <div style="background-color: #d8faff;">
            <img src="" alt="" class="bg-img lazyload blur-up">
        </div>
    </div>
    <!-- vendor cover end -->
    <!-- section start -->
    <section class="vendor-profile pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile-left">
                        <div class="profile-image">
                            <div>
                                <img src="{{ url('/assets/images/vendors/' . $vendor->vendor_image) }}" alt="" class="img-responsive">
                                <div style="font-size: 20px; font-weight: 800;">{{ $total_average }}</div>
                                <div>Based on {{ count($reviews) }} Reviews</div>
                                <div id="{{ $total_average }}" class="rate"></div>
                                <h6>{{ $vendor->email }}</h6>
                            </div>
                        </div>
                        <div class="profile-detail">
                            <div>
                                <h2>{{ $vendor->username }} Shop</h2>
                               <p>{{ $vendor->vendor_description ? $vendor->vendor_description : 'No description of vendor' }}</p>
                            </div>
                        </div>
                        <div class="vendor-contact">
                            <div>
                                <h6>if you have any query:</h6>
                                <a href="tel:{{ $vendor->contactno }}" class="btn btn-solid btn-sm">contact seller</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Section ends -->
    <div class="container my-3">
        <div class="card p-4">
            <h3 style="text-transform: uppercase; color: #000; font-weight: 800;">{{ $vendor->username }} ITEMS</h3>
            <div class="card-body">
                <div class="no-slider row gap-xl-5 gap-md-2 d-flex justify-content-start align-items-center">
                    @forelse($vendor->products as $product)
                        <div class="col-xl-2 col-lg-3 col-6 col-md-5 my-1" style="padding: 0.5rem;">
                            <div style="background: #fff !important; box-shadow: 0 .0625rem .125rem 0 rgba(0,0,0,.1); height: 100% !important;">
                                <a href="/store/product/{{ $product->id }}">
                                    <img src="{{ url('assets/images/products/' . $product->product_image) }}" alt="" class="product-image" />
                                    <div style="padding: 0.5rem !important;">
                                        <div class="font-bold my-1 px-1 product-text">
                                            {{ strlen($product->product_name) > 35 ? substr($product->product_name, 0, 35) . "..." : $product->product_name }}
                                        </div>
                                        <h5 class="text-primary px-1">₱ {{ number_format($product->amount, 0) }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
    <script>
        let rate = document.querySelector('.rate');

        const values = Math.floor(Number(rate.id));
        for (let index = 0; index < values; index++) {
            console.log(values);
            $(rate).append(`<li style="font-size: 20px; color: rgb(255, 166, 0)">★</li>`);
        }
    </script>
@endpush
