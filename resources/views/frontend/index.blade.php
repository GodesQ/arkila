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
            <h4>OUR</h4>
            <h2 class="title-inner1">ITEMS</h2>
        </div>
        {{-- <div class="container d-flex justify-content-center align-items-center">
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
        </div> --}}
        <section class="section-b-space ratio_asos">
            <div class="collection-wrapper">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 collection-filter">

                            <!-- side-bar colleps block stat -->
                            <div class="collection-filter-block">
                                <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
                                <div class="collection-collapse-block open">
                                    <h3 class="collapse-block-title">Keyword</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="wrapper mt-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Search any keyword..." id="keyword">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collection-collapse-block open">
                                    <h3 class="collapse-block-title">Categories</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">
                                            @foreach($categories as $category)
                                                <div class="form-check collection-filter-checkbox">
                                                    <input type="checkbox" class="form-check-input category" name="category[]" value="{{ $category->id }}" id="{{ $category->category_name }}">
                                                    <label class="form-check-label" for="{{ $category->category_name }}">{{ $category->category_name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- price filter start here -->
                                <div class="collection-collapse-block border-0 open">
                                    <h3 class="collapse-block-title">price</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="wrapper mt-3">
                                            <div class="range-slider">
                                                <input type="text" id="price-range" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <button id="filter-btn" class="btn btn-primary btn-block">Filter</button>
                                </div>
                            </div>
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
                                                {{-- <div class="row">
                                                    <div class="col-12">
                                                        <div class="product-filter-content">
                                                            <div class="search-count">
                                                                <h5>Showing Products 1-24 of 10 Result</h5>
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
                                                </div> --}}
                                            </div>
                                            <div class="product-wrapper-grid">
                                                <div class="row margin-res products-data">
                                                    @include('frontend.products.fetch_products')
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
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
    $("#price-range").ionRangeSlider({
        skin: "round",
        min: 0,
        max: 10000,
        from: 100,
        to: 10000,
        type: 'double',
        prefix: "₱",
        grid_num: 5,
        step: 50,
        onChange: function (data) {
            $('#price-range').val(`${data.from};${data.to}`);
        },
    });

    $(document).on('click', '.pagination .page-item a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        $('#page_count').val(page);
        fetchProducts(page, false);
    })

    $(document).on('click', '#filter-btn', function() {
        fetchProducts(1, true);
    })

    function fetchProducts(page, isFilter) {
        let selected_categories = [];

        // get all checked skills
        $.each($(".category:checked"), function(){
            selected_categories.push(Number($(this).val()));
        });

        let filter_data = {
            keyword: $('#keyword').val(),
            price: isFilter ? $('#price-range').val() : '',
            categories: encodeURIComponent(JSON.stringify(selected_categories)),
        }
        let filter_parameters = `keyword=${filter_data.keyword}&categories=${filter_data.categories}&price=${filter_data.price}`;

        $.ajax({
            url: "/fetch_products?page="+page+'&'+filter_parameters,
            success: function (data) {
                $('.products-data').empty().html(data.view_data);
            }
        })
    }
</script>
@endpush
