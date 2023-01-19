@extends('layout.frontend-layout.frontend')
@section('content')
<section class="p-0 container-fluid">
    @if(Session::get('fail'))
        @push("scripts")
            <script>
                toastr.error('{{ Session::get("fail") }}', 'Failed');
            </script>
        @endpush
    @endif
    @if(Session::get('success'))
        @push("scripts")
            <script>
                toastr.success('{{ Session::get("success") }}', 'Success');
            </script>
        @endpush
    @endif
    <style>
        body {
            background: #f2f2f2;
        }

        @media (max-width: 500px) {
            h1.text-white.sliderhead {
                font-size: 25px !important;
                line-height: 35px;;
            }
        }
    </style>
    <section class="p-0">
        <div class="slide-1 home-slider">
            <div>
                <div class="home  text-center">
                    <img src="{{ url('/assets/images/slider/ciit_school.jpg') }}" alt="" class="bg-img blur-up lazyload">
                    <div class="slider-overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="slider-contain sliderbox">
                                    <div>
                                        <h4 class="text-white slidersub">
                                            welcome to arkila
                                        </h4>
                                        <h1 class="text-white sliderhead">Why Buy If You<br>Can Borrow</h1>
                                        <a href="#store" class="btn btn-solid sliderbtn" >Borrow Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="home text-center">
                    <img src="{{ url('/assets/images/slider/ciit_computers.png') }}" alt="" class="bg-img blur-up lazyload">
                    <div class="slider-overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="slider-contain sliderbox">
                                    <div>
                                        <h4 class="text-white slidersub">
                                            welcome to arkila
                                        </h4>
                                        <h1 class="text-white sliderhead">Borrow School Supplies<br>From Your Classmates</h1>
                                        <a href="#store" class="btn btn-solid sliderbtn">Borrow Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="slide-1 home-slider" style="max-height: 700px !important;">
        <div style="max-height: 700px !important;">
            <div class="home text-center bg-size blur-up lazyloaded">
                <img src="{{ url('/assets/images/slider/ciit_school.jpg') }}" alt="" class="bg-img img-section blur-up lazyload" />
                <div class="slider-overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="slider-contain sliderbox">
                                <div>
                                    <h4 class="text-white slidersub">
                                        welcome to arkila
                                    </h4>
                                    <h1 class="text-white sliderhead">Why Buy If You<br>Can Borrow</h1>
                                    <a href="#store" class="btn btn-solid sliderbtn" >Borrow Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 600px !important;">
            <div class="home text-center">
                <img src="{{ url('/assets/images/slider/ciit_computers.png') }}" alt="" class="bg-img blur-up lazyload" />
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="slider-contain sliderbox">
                                <div>
                                    <h4 class="text-white slidersub">
                                        welcome to arkila
                                    </h4>
                                    <h1 class="text-white sliderhead">Borrow School Supplies<br>From Your Classmates</h1>
                                    <a href="#store" class="btn btn-solid sliderbtn">Borrow Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="title1 section-t-space">
            <h4>OUR</h4>
            <h2 class="title-inner1">Categories</h2>
        </div>
        <div class="container">
            <div class="row margin-default ratio_square ">
                @foreach($categories as $category)
                <div class="col-xl-2 col-4 col-lg-3 col-md-4">
                    <a href="/store/categories/{{ $category->id }}" class="text-secondary font-bold d-flex justify-content-center align-items-center flex-column">
                        <div class="img-category">
                            <div class="pattern-bg bg1">
                                <div class="img-sec">
                                    <img src="{{ url('assets/images/categories/' . $category->category_image) }}" class="img-fluid " alt="">
                                </div>
                            </div>
                            <h6>{{ $category->category_name }}</h6>
                        </div>
                    </a>
                </div>

                @endforeach
                {{-- <div class="col-xl-2 col-sm-3 col-4">
                    <a href="#">
                        <div class="img-category">
                            <div class="pattern-bg bg1">
                                <div class="img-sec">
                                    <img src="../assets/images/fashion/category/8.png" class="img-fluid bg-img" alt="">
                                </div>
                            </div>
                            <h4>Top wear</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-sm-3 col-4">
                    <a href="#">
                        <div class="img-category hover-effect">
                            <div class="pattern-bg bg2">
                                <div class="img-sec">
                                    <img src="../assets/images/fashion/category/9.png" class="img-fluid bg-img" alt="">
                                </div>
                            </div>
                            <h4>dresses</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-sm-3 col-4">
                    <a href="#">
                        <div class="img-category">
                            <div class="pattern-bg bg3">
                                <div class="img-sec">
                                    <img src="../assets/images/fashion/category/10.png" class="img-fluid bg-img" alt="">
                                </div>
                            </div>
                            <h4>bottom</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-sm-3 col-4">
                    <a href="#">
                        <div class="img-category">
                            <div class="pattern-bg bg4">
                                <div class="img-sec">
                                    <img src="../assets/images/fashion/category/11.png" class="img-fluid bg-img" alt="">
                                </div>
                            </div>
                            <h4>inner/sleep</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-sm-3 col-4">
                    <a href="#">
                        <div class="img-category">
                            <div class="pattern-bg bg5">
                                <div class="img-sec">
                                    <img src="../assets/images/fashion/category/12.png" class="img-fluid bg-img" alt="">
                                </div>
                            </div>
                            <h4>footwear</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-sm-3 col-4">
                    <a href="#">
                        <div class="img-category">
                            <div class="pattern-bg bg6">
                                <div class="img-sec">
                                    <img src="../assets/images/fashion/category/13.png" class="img-fluid bg-img" alt="">
                                </div>
                            </div>
                            <h4>sports/active</h4>
                        </div>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="container-fluid" id="store">
        <div class="title1 section-t-space">
            <h4>LATEST</h4>
            <h2 class="title-inner1">ITEMS</h2>
        </div>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="no-slider row">
                @foreach($products as $product)
                    <div class="col-xl-2 col-6 col-lg-3 col-md-5 my-1" style="padding: 0.5rem;">
                        <div style="background: #fff !important; box-shadow: 0 .0625rem .125rem 0 rgba(0,0,0,.1); height: 100% !important;">
                            <a href="/store/product/{{ $product->id }}">
                                <img class="product-image" src="{{ url('assets/images/products/' . $product->product_image) }}" alt="" style=""
                                />
                                <div style="padding: 0.5rem !important;">
                                    <div class="font-bold my-1 px-1 product-text" style="">
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
</section>
@endsection
