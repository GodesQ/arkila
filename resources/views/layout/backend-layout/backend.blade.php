<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="ARKILA" />
        <meta name="keywords" content="arkila, rent-shop" />
        <meta name="author" content="GODESQ" />
        <title>Arkila PH - Online Borrowing/Lending System</title>
        <link
            rel="icon"
            href="../assets/images/dashboard/favicon.png"
            type="image/x-icon"
        />
        <link
            rel="shortcut icon"
            href="../assets/images/dashboard/favicon.png"
            type="image/x-icon"
        />

        <!-- Google font-->
        <link
            href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet"
        />

        <!-- Font Awesome-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ URL::asset('assets/css/vendors/fontawesome.css') }}"
        />

        <!-- Flag icon-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ URL::asset('assets/css/vendors/flag-icon.css') }}"
        />

        <!-- ico-font-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ URL::asset('assets/css/vendors/icofont.css') }}"
        />

        <!-- Prism css-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ URL::asset('assets/css/vendors/prism.css') }}"
        />

        <!-- Chartist css -->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ URL::asset('assets/css/vendors/chartist.css') }}"
        />

        <!-- Bootstrap css-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ URL::asset('assets/css/vendors/bootstrap.css') }}"
        />
        <!-- App css-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ URL::asset('assets/css/admin.css') }}"
        />
    </head>

    <body>
        <!-- page-wrapper Start-->
        <div class="page-wrapper">
            <!-- Page Header Start-->
            <div class="page-main-header">
                <div class="main-header-right row">
                    <div class="main-header-left d-lg-none w-auto">
                        <div class="logo-wrapper">
                            <a href="#"
                                ><img
                                    class="blur-up lazyloaded"
                                    src="{{ url('/assets/images/dashboard/arkila-logo.png') }}"
                                    alt="Arkila Logo"
                            /></a>
                        </div>
                    </div>
                    <div class="mobile-sidebar w-auto">
                        <div class="media-body text-end switch-sm">
                            <label class="switch"
                                ><a href="#"
                                    ><i
                                        id="sidebar-toggle"
                                        data-feather="align-left"
                                    ></i></a
                            ></label>
                        </div>
                    </div>
                    <div class="nav-right col">
                        <ul class="nav-menus">
                            <li>
                                <form class="form-inline search-form">
                                    <div class="form-group">
                                        <input
                                            class="form-control-plaintext"
                                            type="search"
                                            placeholder="Search.."
                                        /><span class="d-sm-none mobile-search"
                                            ><i data-feather="search"></i
                                        ></span>
                                    </div>
                                </form>
                            </li>
                            <li class="onhover-dropdown">
                                <div class="media align-items-center">
                                    <img
                                        class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded"
                                        src="../assets/images/dashboard/man.png"
                                        alt="header-user"
                                    />
                                    <div class="dotted-animation">
                                        <span class="animate-circle"></span
                                        ><span class="main-circle"></span>
                                    </div>
                                </div>
                                <ul
                                    class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover"
                                >
                                    <li>
                                        <a href="#"
                                            ><i data-feather="user"></i>Edit
                                            Profile</a
                                        >
                                    </li>
                                    <li>
                                        <a href="#"
                                            ><i data-feather="mail"></i>Inbox</a
                                        >
                                    </li>
                                    <li>
                                        <a href="/vendor/logout"
                                            ><i data-feather="log-out"></i
                                            >Logout</a
                                        >
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="d-lg-none mobile-toggle pull-right">
                            <i data-feather="more-horizontal"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header Ends -->

            <!-- Page Body Start-->
            <div class="page-body-wrapper">
                <!-- Page Sidebar Start-->
                <div class="page-sidebar">
                    <div class="main-header-left d-none d-lg-block">
                        <div class="logo-wrapper">
                            <a href="index.html"
                                ><img
                                    class="blur-up lazyloaded"
                                    src="../assets/images/dashboard/multikart-logo.png"
                                    alt=""
                            /></a>
                        </div>
                    </div>
                    <div class="sidebar custom-scrollbar">
                        <div class="sidebar-user text-center">
                            <div>
                                <img
                                    class="img-60 rounded-circle lazyloaded blur-up"
                                    src="../assets/images/dashboard/man.png"
                                    alt="#"
                                />
                            </div>
                            <h6 class="mt-3 f-14">JOHN</h6>
                            <p>general manager.</p>
                        </div>
                        <ul class="sidebar-menu">
                            <li>
                                <a class="sidebar-header" href="/vendor/dashboard"
                                    ><i data-feather="home"></i
                                    ><span>Dashboard</span></a
                                >
                            </li>
                            <li>
                                <a class="sidebar-header" href="#"
                                    ><i data-feather="box"></i>
                                    <span>Products</span
                                    ><i class="fa fa-angle-right pull-right"></i
                                ></a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="/products"
                                            ><i class="fa fa-circle"></i
                                            >Product List</a
                                        >
                                    </li>
                                    <li>
                                        <a href="add-product.html"
                                            ><i class="fa fa-circle"></i
                                            >Add Product</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="sidebar-header" href=""
                                    ><i data-feather="dollar-sign"></i
                                    ><span>Sales</span
                                    ><i class="fa fa-angle-right pull-right"></i
                                ></a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="order.html"
                                            ><i class="fa fa-circle"></i
                                            >Orders</a
                                        >
                                    </li>
                                    <li>
                                        <a href="transactions.html"
                                            ><i class="fa fa-circle"></i
                                            >Transactions</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="sidebar-header" href=""
                                    ><i data-feather="tag"></i
                                    ><span>Coupons</span
                                    ><i class="fa fa-angle-right pull-right"></i
                                ></a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="coupon-list.html"
                                            ><i class="fa fa-circle"></i>List
                                            Coupons</a
                                        >
                                    </li>
                                    <li>
                                        <a href="coupon-create.html"
                                            ><i class="fa fa-circle"></i>Create
                                            Coupons
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="sidebar-header" href="reports.html"
                                    ><i data-feather="bar-chart"></i
                                    ><span>Reports</span></a
                                >
                            </li>
                            <li>
                                <a class="sidebar-header" href="invoice.html"
                                    ><i data-feather="archive"></i
                                    ><span>Invoice</span></a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Page Sidebar Ends-->

                <!-- Right sidebar Start-->
                <div class="right-sidebar" id="right_side_bar">
                    <div>
                        <div class="container p-0">
                            <div class="modal-header p-l-20 p-r-20">
                                <div class="col-sm-8 p-0">
                                    <h6 class="modal-title font-weight-bold">
                                        FRIEND LIST
                                    </h6>
                                </div>
                                <div class="col-sm-4 text-end p-0">
                                    <i class="me-2" data-feather="settings"></i>
                                </div>
                            </div>
                        </div>
                        <div class="friend-list-search mt-0">
                            <input type="text" placeholder="search friend" /><i
                                class="fa fa-search"
                            ></i>
                        </div>
                        <div class="p-l-30 p-r-30">
                            <div class="chat-box">
                                <div class="people-list friend-list">
                                    <ul class="list">
                                        <li class="clearfix">
                                            <img
                                                class="rounded-circle user-image"
                                                src="../assets/images/dashboard/user.png"
                                                alt=""
                                            />
                                            <div
                                                class="status-circle online"
                                            ></div>
                                            <div class="about">
                                                <div class="name">
                                                    Vincent Porter
                                                </div>
                                                <div class="status">Online</div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <img
                                                class="rounded-circle user-image"
                                                src="../assets/images/dashboard/user1.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="status-circle away"
                                            ></div>
                                            <div class="about">
                                                <div class="name">
                                                    Ain Chavez
                                                </div>
                                                <div class="status">
                                                    28 minutes ago
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <img
                                                class="rounded-circle user-image"
                                                src="../assets/images/dashboard/user2.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="status-circle online"
                                            ></div>
                                            <div class="about">
                                                <div class="name">
                                                    Kori Thomas
                                                </div>
                                                <div class="status">Online</div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <img
                                                class="rounded-circle user-image"
                                                src="../assets/images/dashboard/user3.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="status-circle online"
                                            ></div>
                                            <div class="about">
                                                <div class="name">
                                                    Erica Hughes
                                                </div>
                                                <div class="status">Online</div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <img
                                                class="rounded-circle user-image"
                                                src="../assets/images/dashboard/man.png"
                                                alt=""
                                            />
                                            <div
                                                class="status-circle offline"
                                            ></div>
                                            <div class="about">
                                                <div class="name">
                                                    Ginger Johnston
                                                </div>
                                                <div class="status">
                                                    2 minutes ago
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <img
                                                class="rounded-circle user-image"
                                                src="../assets/images/dashboard/user5.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="status-circle away"
                                            ></div>
                                            <div class="about">
                                                <div class="name">
                                                    Prasanth Anand
                                                </div>
                                                <div class="status">
                                                    2 hour ago
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <img
                                                class="rounded-circle user-image"
                                                src="../assets/images/dashboard/designer.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="status-circle online"
                                            ></div>
                                            <div class="about">
                                                <div class="name">
                                                    Hileri Jecno
                                                </div>
                                                <div class="status">Online</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>

        /* SCRIPTS *\
        <!-- latest jquery-->
        <script src="{{url('assets/js/jquery-3.3.1.min.js') }}"></script>

        <!-- Bootstrap js-->
        <script src="{{url('assets/js/bootstrap.bundle.min.js') }}"></script>

        <!-- feather icon js-->
        <script src="{{url('assets/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{url('assets/js/icons/feather-icon/feather-icon.js') }}"></script>

        <!-- Sidebar jquery-->
        <script src="{{url('assets/js/sidebar-menu.js') }}"></script>

        <!--chartist js-->
        <script src="{{url('assets/js/chart/chartist/chartist.js') }}"></script>

        <!--chartjs js-->
        <script src="{{url('assets/js/chart/chartjs/chart.min.js') }}"></script>

        <!-- lazyload js-->
        <script src="{{url('assets/js/lazysizes.min.js') }}"></script>

        <!--copycode js-->
        <script src="{{url('assets/js/prism/prism.min.js') }}"></script>
        <script src="{{url('assets/js/clipboard/clipboard.min.js') }}"></script>
        <script src="{{url('assets/js/custom-card/custom-card.js') }}"></script>

        <!--counter js-->
        <script src="{{url('assets/js/counter/jquery.waypoints.min.js') }}"></script>
        <script src="{{url('assets/js/counter/jquery.counterup.min.js') }}"></script>
        <script src="{{url('assets/js/counter/counter-custom.js') }}"></script>

        <!--peity chart js-->
        <script src="{{url('assets/js/chart/peity-chart/peity.jquery.js') }}"></script>

        <!--sparkline chart js-->
        <script src="{{url('assets/js/chart/sparkline/sparkline.js') }}"></script>

        <!--Customizer admin-->
        <script src="{{url('assets/js/admin-customizer.js') }}"></script>

        <!--dashboard custom js-->
        <script src="{{url('assets/js/dashboard/default.js') }}"></script>

        <!--right sidebar js-->
        <script src="{{url('assets/js/chat-menu.js') }}"></script>

        <!--height equal js-->
        <script src="{{url('assets/js/height-equal.js') }}"></script>

        <!-- lazyload js-->
        <script src="{{url('assets/js/lazysizes.min.js') }}"></script>

        <!--script admin-->
        <script src="{{url('assets/js/admin-script.js') }}"></script>
    </body>
</html>
