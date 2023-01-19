@extends('layout.frontend-layout.frontend')

@section('content')
    <div class="page-body">
        <!-- breadcrumb start -->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-title">
                            <h2>search</h2>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <nav aria-label="breadcrumb" class="theme-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">search</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb End -->


        <!--section start-->
        <section class="authentication-page">
            <div class="container">
                <section class="search-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <h2 class="text-center">You Search for <span style="text-decoration: underline;">{{ $query }}</span></h2>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <!-- section end -->

        <div class="container my-5">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-start align-items-center">
                        @forelse($products as $product)
                           <div class="col-xl-2 col-lg-3 col-6 col-md-5 my-1" style="padding: 0.5rem;">
                                <div style="background: #fff !important; box-shadow: 0 .0625rem .125rem 0 rgba(0,0,0,.1); height: 100% !important;">
                                    <a href="/store/product/{{ $product->id }}">
                                        <img
                                            src="{{ url('assets/images/products/' . $product->product_image) }}"
                                            alt=""
                                            class="product-image"
                                        />
                                        <div style="padding: 0.5rem !important;">
                                            <div class="font-bold my-1 px-1 product-text">
                                                {{ strlen($product->product_name) > 35 ? substr($product->product_name, 0, 35) . "..." : $product->product_name }}
                                            </div>
                                            <h5 class="text-primary px-1">&#8369 {{ number_format($product->amount, 0) }}</h5>
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
