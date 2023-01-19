@extends('layout.frontend-layout.frontend')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="title1">
                <h2 class="title-inner1">{{ $category->category_name }}</h2>
            </div>
            <div class="container">
                <div class="no-slider row d-flex justify-content-start align-items-center">
                    @foreach($products as $product)
                        <div class="col-xl-2 col-lg-3 col-6 col-md-5 my-1" style="padding: 0.5rem;">
                            <div style="background: #fff !important; box-shadow: 0 .0625rem .125rem 0 rgba(0,0,0,.1); height: 100% !important;">
                                <a href="/store/product/{{ $product->id }}">
                                    <img src="{{ url('assets/images/products/' . $product->product_image) }}" alt="" class="product-image" />
                                    <div style="padding: 0.5rem !important;">
                                        <div class="font-bold my-1 px-1 product-text">
                                            {{ strlen($product->product_name) > 35 ? substr($product->product_name, 0, 35) . "..." : $product->product_name }}
                                        </div>
                                        <h5 class="text-primary px-1">&#8369 {{ number_format($product->amount, 0) }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
            </div>
            </div>
        </div>
    </div>
@endsection
