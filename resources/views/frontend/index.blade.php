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
                                <img class="product-image" src="{{ url('assets/images/products/' . $product->product_image) }}" alt="" style=""/>
                                <div style="padding: 0.5rem !important;">
                                    <div class="font-bold my-1 px-1 product-text" style="">
                                        <div>{{ strlen($product->product_name) > 35 ? substr($product->product_name, 0, 35) . "..." : $product->product_name }}</div>
                                        @if($product->rate)
                                            @for ($i = 0; $i < round($product->rate); $i++)
                                                <span style="color: #ffc72d;"">&#9733;</span>
                                            @endfor
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <span style="color: #ffc72d;"">&#9734;</span>
                                            @endfor
                                        @endif
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
    {{-- <section class="section-b-space ratio_asos">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 collection-filter">
                        <!-- side-bar colleps block stat -->
                        <div class="collection-filter-block">
                            <!-- brand filter start -->
                            <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
                                        aria-hidden="true"></i> back</span></div>
                            <div class="collection-collapse-block open">
                                <h3 class="collapse-block-title">brand</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="collection-brand-filter">
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="zara">
                                            <label class="form-check-label" for="zara">zara</label>
                                        </div>
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="vera-moda">
                                            <label class="form-check-label" for="vera-moda">vera-moda</label>
                                        </div>
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="forever-21">
                                            <label class="form-check-label" for="forever-21">forever-21</label>
                                        </div>
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="roadster">
                                            <label class="form-check-label" for="roadster">roadster</label>
                                        </div>
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="only">
                                            <label class="form-check-label" for="only">only</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- color filter start here -->
                            <div class="collection-collapse-block open">
                                <h3 class="collapse-block-title">colors</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="color-selector">
                                        <ul>
                                            <li class="color-1 active"></li>
                                            <li class="color-2"></li>
                                            <li class="color-3"></li>
                                            <li class="color-4"></li>
                                            <li class="color-5"></li>
                                            <li class="color-6"></li>
                                            <li class="color-7"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- size filter start here -->
                            <div class="collection-collapse-block border-0 open">
                                <h3 class="collapse-block-title">size</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="collection-brand-filter">
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="hundred">
                                            <label class="form-check-label" for="hundred">s</label>
                                        </div>
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="twohundred">
                                            <label class="form-check-label" for="twohundred">m</label>
                                        </div>
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="threehundred">
                                            <label class="form-check-label" for="threehundred">l</label>
                                        </div>
                                        <div class="form-check collection-filter-checkbox">
                                            <input type="checkbox" class="form-check-input" id="fourhundred">
                                            <label class="form-check-label" for="fourhundred">xl</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- price filter start here -->
                            <div class="collection-collapse-block border-0 open">
                                <h3 class="collapse-block-title">price</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="wrapper mt-3">
                                        <div class="range-slider">
                                            <input type="text" class="js-range-slider" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- silde-bar colleps block end here -->
                        <!-- side-bar single product slider start -->

                        <!-- side-bar single product slider end -->
                        <!-- side-bar banner start here -->
                        <div class="collection-sidebar-banner">
                            <a href="#"><img src="../assets/images/side-banner.png" class="img-fluid blur-up lazyload"
                                    alt=""></a>
                        </div>
                        <!-- side-bar banner end here -->
                    </div>
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collection-product-wrapper">
                                        <div class="product-top-filter">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="filter-main-btn"><span
                                                            class="filter-btn btn btn-theme"><i class="fa fa-filter"
                                                                aria-hidden="true"></i> Filter</span></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-filter-content">
                                                        <div class="search-count">
                                                            <h5>Showing Products 1-24 of 10 Result</h5>
                                                        </div>
                                                        <div class="collection-view">
                                                            <ul>
                                                                <li><i class="fa fa-th grid-layout-view"></i></li>
                                                                <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                            </ul>
                                                        </div>
                                                        <div class="collection-grid-view">
                                                            <ul>
                                                                <li><img src="../assets/images/icon/2.png" alt=""
                                                                        class="product-2-layout-view"></li>
                                                                <li><img src="../assets/images/icon/3.png" alt=""
                                                                        class="product-3-layout-view"></li>
                                                                <li><img src="../assets/images/icon/4.png" alt=""
                                                                        class="product-4-layout-view"></li>
                                                                <li><img src="../assets/images/icon/6.png" alt=""
                                                                        class="product-6-layout-view"></li>
                                                            </ul>
                                                        </div>
                                                        <div class="product-page-per-view">
                                                            <select>
                                                                <option value="High to low">24 Products Par Page
                                                                </option>
                                                                <option value="Low to High">50 Products Par Page
                                                                </option>
                                                                <option value="Low to High">100 Products Par Page
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="product-page-filter">
                                                            <select>
                                                                <option value="High to low">Sorting items</option>
                                                                <option value="Low to High">50 Products</option>
                                                                <option value="Low to High">100 Products</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-wrapper-grid">
                                            <div class="row margin-res">
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/35.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/36.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div>
                                                                <div class="rating"><i class="fa fa-star"></i> <i
                                                                        class="fa fa-star"></i> <i
                                                                        class="fa fa-star"></i> <i
                                                                        class="fa fa-star"></i> <i
                                                                        class="fa fa-star"></i></div>
                                                                <a href="product-page(no-sidebar).html">
                                                                    <h6>Slim Fit Cotton Shirt</h6>
                                                                </a>
                                                                <p>Lorem Ipsum is simply dummy text of the printing and
                                                                    typesetting industry. Lorem Ipsum has been the
                                                                    industry's standard dummy text ever since the 1500s,
                                                                    when an unknown printer took a galley
                                                                    of type and scrambled it to make a type specimen
                                                                    book
                                                                </p>
                                                                <h4>$500.00</h4>
                                                                <ul class="color-variant">
                                                                    <li class="bg-light0"></li>
                                                                    <li class="bg-light1"></li>
                                                                    <li class="bg-light2"></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/27.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/28.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/1.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/2.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/33.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/34.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/27.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/28.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/35.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/36.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/27.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/28.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/1.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/2.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/27.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/28.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/1.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/2.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/33.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/34.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img src="../assets/images/pro3/1.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="#"><img src="../assets/images/pro3/2.jpg"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="cart-info cart-wrap">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#addtocart" title="Add to cart"><i
                                                                        class="ti-shopping-cart"></i></button> <a
                                                                    href="javascript:void(0)" title="Add to Wishlist"><i
                                                                        class="ti-heart" aria-hidden="true"></i></a> <a
                                                                    href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view" title="Quick View"><i
                                                                        class="ti-search" aria-hidden="true"></i></a> <a
                                                                    href="compare.html" title="Compare"><i
                                                                        class="ti-reload" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                            </div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley
                                                                of type and scrambled it to make a type specimen book
                                                            </p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-pagination">
                                            <div class="theme-paggination-block">
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <nav aria-label="Page navigation">
                                                            <ul class="pagination">
                                                                <li class="page-item"><a class="page-link" href="#"
                                                                        aria-label="Previous"><span
                                                                            aria-hidden="true"><i
                                                                                class="fa fa-chevron-left"
                                                                                aria-hidden="true"></i></span> <span
                                                                            class="sr-only">Previous</span></a></li>
                                                                <li class="page-item active"><a class="page-link"
                                                                        href="#">1</a></li>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="#">2</a></li>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="#">3</a></li>
                                                                <li class="page-item"><a class="page-link" href="#"
                                                                        aria-label="Next"><span aria-hidden="true"><i
                                                                                class="fa fa-chevron-right"
                                                                                aria-hidden="true"></i></span> <span
                                                                            class="sr-only">Next</span></a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <div class="product-search-count-bottom">
                                                            <h5>Showing Products 1-24 of 10 Result</h5>
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
    </section> --}}
</section>
@endsection
