<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="ARKILA" />
        <meta name="keywords" content="arkila, rent-shop" />
        <meta name="author" content="GODESQ" />
        <title>ARKILA</title>
        <link
            rel="icon"
            href="../../../assets/images/logos/arkila-logo-s1.png"
            type="image/x-icon"
        />
        <link
            rel="shortcut icon"
            href="../../../assets/images/logos/arkila-logo-s1.png"
            type="image/x-icon"
        />

        <!-- Google font-->

        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,700&display=swap" rel="stylesheet">

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

        <!-- DataTables css-->
        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"
        />
        <!-- Select2 css-->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- toastr css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"  />
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
                                    src="../../../assets/images/dashboard/arkila-logo.png"
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
                            </li>
                            <li class="onhover-dropdown">
                                <div class="media align-items-center">
                                    @if(session()->get('profile_picture'))
                                        <img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="../assets/images/vendors/{{ session()->get('profile_picture') }}" alt="header-user" />
                                    @else
                                        <img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="../assets/images/user-default-image.png" alt="header-user" />
                                    @endif
                                    <div class="dotted-animation">
                                        <span class="animate-circle"></span
                                        ><span class="main-circle"></span>
                                    </div>
                                </div>
                                <ul
                                    class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover"
                                >
                                    <li>
                                        @if(Session::get('role') == 'admin')
                                        <a href="/admin/logout"
                                            ><i data-feather="log-out"></i
                                            >Logout</a
                                        >
                                        @else
                                        <a href="/vendor/logout"
                                            ><i data-feather="log-out"></i
                                            >Logout</a
                                        >
                                        @endif
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
                        <div class="logo-wrapper justify-content-center">
                            <a href="{{session()->get('role') == 'admin' ? 'admin/dashboard/' : 'vendor/dashboard' }}"
                                ><img
                                    class="blur-up lazyloaded"
                                    src="../../../assets/images/dashboard/arkila-logo.png"
                                    alt=""
                                    width="150"
                            /></a>
                        </div>
                    </div>
                    <div class="sidebar custom-scrollbar">
                        @if(session()->get('role') == 'admin')
                            <div class="sidebar-user text-center d-flex justify-content-center align-items-center flex-column">   
                                <div style="
                                        width: 60px;
                                        height: 60px;
                                        background-color: #038dcc;
                                        border-radius: 50px;
                                        text-transform: uppercase;
                                        font-weight: 900;
                                    "
                                    class="text-white d-flex justify-content-center align-items-center flex-column"
                                >
                                {{  session()->get('username')  }}
                                </div>
                                <p class="text-uppercase">
                                    {{ session()->get('role') }}
                                </p>
                            </div>
                        @else
                            <div class="sidebar-user text-center d-flex justify-content-center align-items-center flex-column">  
                                @if(session()->get('profile_picture'))
                                    <img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="../assets/images/vendors/{{ session()->get('profile_picture') }}" alt="header-user" />
                                @else
                                    <img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="../assets/images/user-default-image.png" alt="header-user" />
                                @endif
                            </div>
                        @endif
                        <ul class="sidebar-menu">
                            <li>
                                <a
                                    class="sidebar-header"
                                    href="{{ session()->get('role') == 'admin' ? '/admin/dashboard' : '/vendor/dashboard' }}"
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
                                            ><i class="fa fa-circle"></i>Product
                                            List</a
                                        >
                                    </li>
                                    <li>
                                        <a href="/create_product"
                                            ><i class="fa fa-circle"></i>Add
                                            Product</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            @if(Session::get('role') == 'admin')
                            <li>
                                <a class="sidebar-header" href="#"
                                    ><i data-feather="user"></i>
                                    <span>Customers</span
                                    ><i class="fa fa-angle-right pull-right"></i
                                ></a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="/customers"
                                            ><i class="fa fa-circle"></i>Customers
                                            List</a
                                        >
                                    </li>
                                    <li>
                                        <a href="/create_customer"
                                            ><i class="fa fa-circle"></i>Add
                                            Customer</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            @endif
                            @if(Session::get('role') == 'admin')
                            <li>
                                <a class="sidebar-header" href="#"
                                    ><i data-feather="user"></i>
                                    <span>Vendors</span
                                    ><i class="fa fa-angle-right pull-right"></i
                                ></a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="/vendors"
                                            ><i class="fa fa-circle"></i>Vendors
                                            List</a
                                        >
                                    </li>
                                    <li>
                                        <a href="/create_vendor"
                                            ><i class="fa fa-circle"></i>Add
                                            Vendor</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            @endif 
                            @if(Session::get('role') == 'admin')
                                <li>
                                    <a class="sidebar-header" href="#"
                                        ><i data-feather="book"></i>
                                        <span>Categories</span
                                        ><i class="fa fa-angle-right pull-right"></i
                                    ></a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a href="/categories"
                                                ><i class="fa fa-circle"></i
                                                >Cateogory List</a
                                            >
                                        </li>
                                        <li>
                                            <a href="/create_category"
                                                ><i class="fa fa-circle"></i>Add
                                                Category</a
                                            >
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <li>
                                <a
                                    class="sidebar-header"
                                    href="/checkouts"
                                    ><i data-feather="dollar-sign"></i
                                    ><span>Checkouts</span></a
                                >
                            </li>
                            @if(Session::get('role') == 'vendor')
                                <li>
                                    <a
                                        class="sidebar-header"
                                        href="/vendor/profile"
                                        ><i data-feather="user"></i
                                        ><span>Profile</span></a
                                    >
                                </li>
                            @endif
                            @if(Session::get('role') == 'admin')
                            <li>
                                <a class="sidebar-header" href="#"
                                    ><i data-feather="user"></i>
                                    <span>Admins</span
                                    ><i class="fa fa-angle-right pull-right"></i
                                ></a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="/admins"
                                            ><i class="fa fa-circle"></i>Admin
                                            List</a
                                        >
                                    </li>
                                    <li>
                                        <a href="/create_admin"
                                            ><i class="fa fa-circle"></i>Add
                                            Admin</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            @endif
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
        <script src="{{ url('assets/js/jquery-3.3.1.min.js') }}"></script>

        <!-- Bootstrap js-->
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>

        <!-- feather icon js-->
        <script src="{{
                url('assets/js/icons/feather-icon/feather.min.js')
            }}"></script>
        <script src="{{
                url('assets/js/icons/feather-icon/feather-icon.js')
            }}"></script>

        <!-- Sidebar jquery-->
        <script src="{{ url('assets/js/sidebar-menu.js') }}"></script>

        <!--chartist js-->
        <script src="{{
                url('assets/js/chart/chartist/chartist.js')
            }}"></script>

        <!--chartjs js-->
        <script src="{{
                url('assets/js/chart/chartjs/chart.min.js')
            }}"></script>

        <!-- lazyload js-->
        <script src="{{ url('assets/js/lazysizes.min.js') }}"></script>

        <!--copycode js-->
        <script src="{{ url('assets/js/prism/prism.min.js') }}"></script>
        <script src="{{
                url('assets/js/clipboard/clipboard.min.js')
            }}"></script>
        <script src="{{
                url('assets/js/custom-card/custom-card.js')
            }}"></script>

        <!--counter js-->
        <script src="{{
                url('assets/js/counter/jquery.waypoints.min.js')
            }}"></script>
        <script src="{{
                url('assets/js/counter/jquery.counterup.min.js')
            }}"></script>
        <script src="{{ url('assets/js/counter/counter-custom.js') }}"></script>

        <!--peity chart js-->
        <script src="{{
                url('assets/js/chart/peity-chart/peity.jquery.js')
            }}"></script>

        <!--sparkline chart js-->
        <script src="{{ url('assets/js/chart/sparkline/sparkline.js') }}"></script>

        <!--dashboard custom js-->
        <script src="{{ url('assets/js/dashboard/default.js') }}"></script>

        <!--right sidebar js-->
        <script src="{{ url('assets/js/chat-menu.js') }}"></script>

        <!--height equal js-->
        <script src="{{ url('assets/js/height-equal.js') }}"></script>

        <!-- lazyload js-->
        <script src="{{ url('assets/js/lazysizes.min.js') }}"></script>

        <!--script admin-->
        <script src="{{ url('assets/js/admin-script.js') }}"></script>

        <!--data tables-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

        <!--select2 js-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <script src="{{ url('assets/js/custom.js') }}"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!--toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        @stack('scripts')
    </body>
</html>
