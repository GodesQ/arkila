<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta name="description" content="Arkila for renting items" />
        <meta name="keywords" content="Arkila, Rent" />
        <meta name="author" content="GodesQ Digital Marketing Agency" />
        <link
            rel="icon"
            href="../assets/images/logos/arkila-favicon.png"
            type="image/x-icon"
        />
        <title>Arkila PH - Online Borrowing/Lending System</title>

        <!--Google font-->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap"
            rel="stylesheet"
        />

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/fontawesome.css') }}"
        />

        <!-- Flag icon-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/flag-icon.css') }}"
        />

        <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/icofont.css') }}"
        />

        <!-- Prism css-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/prism.css') }}"
        />

        <!-- Chartist css -->
        <link rel="stylesheet"type="text/css" href="{{ URL::asset('assets/css/vendors/chartist.css') }}"
        />

        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/bootstrap.css') }}"
        />

        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/admin.css') }}"
        />

        <!-- DataTables css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />

        <!--Slick slider css-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/slick.css') }}" />

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/slick-theme.css') }}"/>

        <!-- Theme css -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}" />

        <!-- Animate icon -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/animate.css') }}" />

        <!-- Themify icon -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors/themify-icons.css') }}" />

        <!-- Theme css -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/style.css') }}" />

        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <style>
            .top-navbar {
                position: sticky;
                top: 0;
                z-index: 9 !important;
                background: #fff;
            }
            .header-logo {
                width: 150px;
                height: 100%;
            }
            .product-image {
                object-fit: cover;
                object-position: center;
                width: 100%;
                max-height: 220px;
                min-height: 220px;
            }
            .product-text {
                color: #000 !important;
                font-size: 0.80rem;
                min-height: 2.50rem;
            }
            @media (max-width: 567px) {
                #search-bar {
                    display: none !important;
                }
                .header-logo {
                    width: 130px;
                    height: 100% !important;
                    object-fit: cover;
                }
                .main-menu {
                    height: 70px !important;
                }
                .product-image {
                    object-fit: cover;
                    object-position: center;
                    width: 100%;
                    max-height: 110px;
                    min-height: 110px;
                }
                .product-text {
                    color: #000 !important;
                    font-size: 0.75rem;
                    min-height: 1.50rem;
                }
            }
        </style>
    </head>

    <body style="overflow-x: hidden !important;">
        <div class="page-wrapper">
            <div class="mobile-fix-option"></div>
            <div class="top-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="header-contact">
                                <ul>
                                    <li>Web & Mobile Application Built for CIIT Students Only</li>
                                    <li>
                                        <i
                                            class="fa fa-phone"
                                            aria-hidden="true"
                                        ></i
                                        >Call Us: 09157402476
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 text-end">
                            <ul class="header-dropdown">
                                <li class="onhover-dropdown mobile-account">
                                    <i
                                        class="fa fa-user"
                                        aria-hidden="true"
                                    ></i>
                                    My Account
                                    <ul class="onhover-show-div">
                                        @if(session()->get('role') &&
                                        session()->get('token'))
                                            <li><a href="/store/profile">Profile</a></li>
                                            <li><a href="/logout">Logout</a></li>
                                        @else
                                            <li><a href="/login">Login</a></li>
                                            <li>
                                                <a href="/register">register</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid top-navbar">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-menu">
                            <div class="menu-left">
                                <div class="brand-logo">
                                    <a href="/">
                                        <img src="../../../assets/images/dashboard/arkila-logo.png" style="" class="img-responsive blur-up lazyload header-logo" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="menu-right pull-right">
                                <div class="icon-nav" style="width: 100%;">
                                    <ul style="display: flex; justify-content: center; align-items: center;">
                                        <li id="search-bar" class="" style="width: 90%;">
                                            <form method="GET" action="/store/search" style="width: 100% !important;">
                                                <div class="d-flex">
                                                    <input placeholder="Search Here..." type="text" style="width: 100% !important;" name="query" class="form-control">
                                                    <button type="submit" class="btn btn-solid"><i class="fa fa-search"></i></button>
                                                </div>
                                            </form>
                                        </li>
                                        <li class="onhover-div mobile-search d-md-none">
                                            <div>
                                                <img src="../assets/images/icon/search.png" onclick="openSearch()" class="blur-up lazyload" alt=""> <i class="ti-search"
                                                    onclick="openSearch()"></i></div>
                                            <div id="search-overlay" class="search-overlay">
                                                <div>
                                                    <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                                    <div class="overlay-content">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <form method="GET" action="/store/search" style="width: 100% !important;">
                                                                        <div class="d-flex">
                                                                            <input placeholder="Search Here..." type="text" style="width: 100% !important;" name="query" class="form-control">
                                                                            <button type="submit" class="btn btn-solid" style="background: transparent;"><i class="fa fa-search"></i></button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="onhover-div mobile-cart">
                                            <div>
                                                <a href="/store/carts">
                                                    <img src="../../../assets/images/icon/cart-1.png" class="blur-uplazyload" alt="">
                                                    <i class="ti-shopping-cart"></i>
                                                </a>
                                            </div>
                                            {{-- <span class="cart_qty_cls">2</span> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="container-fluid d-flex justify-content-center top-navbar">
                <div class="row container-fluid ">
                    <div class="col-sm-12">
                        <div class="main-menu">
                            <div class="menu-right pull-right" style="width: 80%; display: flex !important; justify-content: flex-end !important;">
                                <div style="width: 100% !important; justify-content: flex-end !important; display: flex !important;">
                                    <div class="icon-nav" style="width: 100% !important; display: flex !important; justify-content: flex-end !important;">
                                        <ul style="width: 100% !important;" class="d-flex justify-content-between align-items-center">
                                            <li style="width: 87% !important;" id="search-bar">
                                                <form method="GET" action="/store/search" style="width: 100% !important;">
                                                <div class="d-flex">
                                                    <input placeholder="Search Here..." type="text" style="width: 100% !important;" name="query" class="form-control">
                                                    <button type="submit" class="btn btn-solid"><i class="fa fa-search"></i></button>
                                                </div>
                                            </form>
                                            </li>
                                            {{-- <li style="width: 5% !important;" class="onhover-div mobile-cart">
                                                <a href="/store/carts">
                                                    <img
                                                        src="../../../assets/images/icon/cart-1.png"
                                                        class="img-fluid blur-up lazyloaded"
                                                        alt=""
                                                    />
                                                    <i class="ti-shopping-cart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            @yield('content')
            <footer class="footer-light pet-layout-footer">
                <div class="white-layout">
                    <div class="container">
                        <section class="small-section">
                            <div class="row footer-theme2">
                                <div class="col">
                                    <div class="footer-link link-white">
                                        <div class="footer-brand-logo">
                                            <a href="#">
                                                <img
                                                    src="{{ url('assets/images/dashboard/arkila-logo.png') }}"
                                                    class="img-responsive blur-up lazyload"
                                                    alt=""
                                                    width="200"
                                                />
                                            </a>
                                        </div>
                                        <div class="footer-title footer-mobile-title">
                                            <h4>my account</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="sub-footer black-subfooter">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <div class="footer-end">
                                    <p class="text-center">
                                        <i
                                            class="fa fa-copyright"
                                            aria-hidden="true"
                                        ></i>
                                        2022 Arkila App
                                    </p>
                                </div>
                            </div>
                            <!--<div class="col-xl-6 col-md-6 col-sm-12">-->
                            <!--    <div class="payment-card-bottom">-->
                            <!--        <ul>-->
                            <!--            <li>-->
                            <!--                <a href="#"-->
                            <!--                    ><img-->
                            <!--                        src="../assets/images/icon/visa.png"-->
                            <!--                        alt=""-->
                            <!--                /></a>-->
                            <!--            </li>-->
                            <!--            <li>-->
                            <!--                <a href="#"-->
                            <!--                    ><img-->
                            <!--                        src="../assets/images/icon/mastercard.png"-->
                            <!--                        alt=""-->
                            <!--                /></a>-->
                            <!--            </li>-->
                            <!--            <li>-->
                            <!--                <a href="#"-->
                            <!--                    ><img-->
                            <!--                        src="../assets/images/icon/paypal.png"-->
                            <!--                        alt=""-->
                            <!--                /></a>-->
                            <!--            </li>-->
                            <!--            <li>-->
                            <!--                <a href="#"-->
                            <!--                    ><img-->
                            <!--                        src="../assets/images/icon/american-express.png"-->
                            <!--                        alt=""-->
                            <!--                /></a>-->
                            <!--            </li>-->
                            <!--            <li>-->
                            <!--                <a href="#"-->
                            <!--                    ><img-->
                            <!--                        src="../assets/images/icon/discover.png"-->
                            <!--                        alt=""-->
                            <!--                /></a>-->
                            <!--            </li>-->
                            <!--        </ul>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- latest jquery-->
        <script src="{{ url('assets/js/jquery-3.3.1.min.js') }}"></script>

        <!-- Bootstrap js-->
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>

        <!-- feather icon js-->
        <script src="{{ url('assets/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{ url('assets/js/icons/feather-icon/feather-icon.js') }}"></script>

        <!-- Sidebar jquery-->
        <script src="{{ url('assets/js/sidebar-menu.js') }}"></script>

        <!--chartist js-->
        <script src="{{ url('assets/js/chart/chartist/chartist.js') }}"></script>

        <!--chartjs js-->
        <script src="{{ url('assets/js/chart/chartjs/chart.min.js') }}"></script>

        <!-- lazyload js-->
        <script src="{{ url('assets/js/lazysizes.min.js') }}"></script>

        <!--copycode js-->
        <script src="{{ url('assets/js/prism/prism.min.js') }}"></script>
        <script src="{{ url('assets/js/clipboard/clipboard.min.js') }}"></script>
        <script src="{{ url('assets/js/custom-card/custom-card.js') }}"></script>

        <!-- slick js-->
        <script src="{{ url('assets/js/slick.js') }}"></script>

        <!--counter js-->
        <script src="{{ url('assets/js/counter/jquery.waypoints.min.js') }}"></script>
        <script src="{{ url('assets/js/counter/jquery.counterup.min.js') }}"></script>
        <script src="{{ url('assets/js/counter/counter-custom.js') }}"></script>

        <!--peity chart js-->
        <script src="{{ url('assets/js/chart/peity-chart/peity.jquery.js') }}"></script>

        <!--sparkline chart js-->
        <script src="{{url('assets/js/chart/sparkline/sparkline.js')}}"></script>

        <!--toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!--dashboard custom js-->
        <script src="{{ url('assets/js/dashboard/default.js') }}"></script>

        <!--right sidebar js-->
        <script src="{{ url('assets/js/chat-menu.js') }}"></script>

        <!--height equal js-->
        <script src="{{ url('assets/js/height-equal.js') }}"></script>

        <!-- lazyload js-->
        <script src="{{ url('assets/js/lazysizes.min.js') }}"></script>

        <!-- Theme js-->
        <script src="{{ url('assets/js/theme-setting.js') }}"></script>
        <script src="{{ url('assets/js/script.js') }}"></script>

        <!-- Bootstrap Notification js-->
        <script src="{{ url('assets/js/bootstrap-notify.min.js') }}"></script>

        <!-- Fly cart js-->
        <script src="{{ url('assets/js/fly-cart.js') }}"></script>

        <!-- menu js-->
        <script src="{{ url('assets/js/menu.js') }}"></script>

        <!-- exitintent jquery-->
        <script src="{{ url('assets/js/jquery.exitintent.js') }}"></script>
        <script src="{{ url('assets/js/exit.js') }}"></script>

        <!-- Zoom js-->
        <script src="{{ url('assets/js/jquery.elevatezoom.js') }}"></script>

        <script src="{{ url('assets/js/360view.js') }}"></script>

        <!-- chart js -->
        <script src="{{ url('assets/js/chart/apex/apexcharts.js') }}"></script>
        <script src="{{ url('assets/js/chart/apex/custom-chart.js') }}"></script>

        <script src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

        <!--data tables-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script>
            function openSearch() {
                document.getElementById("search-overlay").style.display = "block";
            }

            function closeSearch() {
                document.getElementById("search-overlay").style.display = "none";
            }
        </script>
        @stack('scripts')
    </body>
</html>
