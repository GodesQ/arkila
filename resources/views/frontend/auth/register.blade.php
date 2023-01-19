@extends('layout.frontend-layout.frontend')

@section('content')
<div class="page-body">
    <!--section start-->
    <section class="register-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>create account</h3>
                    <div class="theme-card">
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
                        <form class="theme-form" method="POST">
                            @csrf
                            <div class="form-row row">
                                <div class="col-md-6">
                                    <label for="email">First Name</label>
                                    <input type="text" class="form-control" id="fname" placeholder="First Name" name="firstname"
                                        required="">
                                    <span class="danger text-danger">@error('firstname'){{$message}}@enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="review">Last Name</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lastname"
                                        required="">
                                        <span class="danger text-danger">@error('lastname'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-6">
                                    <label for="email">email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" required="" name="email">
                                    <span class="danger text-danger">@error('email'){{$message}}@enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Username" required="" name="username">
                                    <span class="danger text-danger">@error('username'){{$message}}@enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="review">Password</label>
                                    <input type="password" class="form-control" id="review"
                                        placeholder="Enter your Password" required="" name="password">
                                        <span class="danger text-danger">@error('password'){{$message}}@enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="review">Confirm Password</label>
                                    <input type="password" class="form-control" id="review"
                                        placeholder="Enter your Password" required="" name="confirm_password">
                                        <span class="danger text-danger">@error('confirm_password'){{$message}}@enderror</span>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-solid">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
</div>
@endsection