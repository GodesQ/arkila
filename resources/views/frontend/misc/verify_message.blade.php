@extends('layout.frontend-layout.frontend')

@section('content')
    <div class="page-body">
        <div class="page-content">
            <div class="d-flex justify-content-center align-items-center bg-white border-success-3 my-2 p-3 flex-column veify-box">
                <img class="brand-logo my-2" alt="stack admin logo"
                    src="../../../assets/images/dashboard/arkila-logo.png" width="200">
                <h2 class="text-center">Thank you for your registration in <span class="text-primary">ARKILA</span>!</h2>
                <h2 class="text-center">VALIDATE YOUR EMAIL NOW!</h2>
                <h5 class="text-center">You're almost there! We have sent an email to your email address.</h5>
                <p class="text-center">Just click on the link in that email to confirm your verification.</p>
                <a href="/login" class="btn btn-primary">Back to Login</a>
            </div>
        </div>
    </div>
@endsection
