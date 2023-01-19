@extends('layout.auth-layout.auth') @section('content')
<div class="page-wrapper">
    <div class="authentication-box">
        <div class="container">
            <div class="row">
                <div class="col-md-5 p-0 card-left">
                    <div class="card bg-primary d-flex align-items-center justify-content-center" style="height: 300px !important;">
                        <div class="single-item">
                            <div>
                                <div>
                                    <h3>LENDER</h3>
                                    <h3>WELCOME TO ARKILA</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-0 card-right">
                    <div class="card tab2-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center">
                                <img
                                    src="../../../assets/images/dashboard/arkila-logo.png"
                                    class="img-responsive blur-up lazyloaded"
                                    alt="arkila logo"
                                    width="200"
                                    style="object-fit: cover"
                                />
                            </div>
                            @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                            @endif

                            @if(Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <ul
                                class="nav nav-tabs nav-material"
                                id="top-tab"
                                role="tablist"
                            >
                                <li class="nav-item">
                                    <a
                                        class="nav-link active"
                                        id="top-profile-tab"
                                        data-bs-toggle="tab"
                                        href="#top-profile"
                                        role="tab"
                                        aria-controls="top-profile"
                                        aria-selected="true"
                                        ><span class="icon-user me-2"></span
                                        >Login</a
                                    >
                                </li>
                            </ul>
                            <div class="tab-content" id="top-tabContent">
                                <div
                                    class="tab-pane fade show active"
                                    id="top-profile"
                                    role="tabpanel"
                                    aria-labelledby="top-profile-tab"
                                >
                                    <form class="form-horizontal auth-form" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input
                                                name="email"
                                                type="email"
                                                class="form-control"
                                                placeholder="Email"
                                                id="email"
                                            />
                                            <span class="danger text-danger">@error('email'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group">
                                            <input
                                                name="password"
                                                type="password"
                                                class="form-control"
                                                placeholder="Password"
                                            />
                                            <span class="danger text-danger">@error('password'){{$message}}@enderror</span>
                                        </div>
                                        <!--<div class="form-terms">-->
                                        <!--    <div class="form-check mesm-2">-->
                                        <!--        Are you a borrower?-->
                                        <!--        <a-->
                                        <!--            href="/login"-->
                                        <!--            class="btn btn-default forgot-pass"-->
                                        <!--            >Login Here</a-->
                                        <!--        >-->
                                        <!--    </div>-->
                                            
                                        <!--</div>-->
                                        <div class="form-button">
                                            <button
                                                class="btn btn-primary"
                                                type="submit"
                                            >
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="footer my-2">
                                <div class="text-center">
                                    <a class="nav-link" href="register"
                                        >Dont have an account?</a
                                    >
                                    
                                    <span class="font-weight-bold d-flex justify-content-center align-items-center">
                                        Are you a borrower? <a class="nav-link" href="/login">Login Here</a>
                                    </span>
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
