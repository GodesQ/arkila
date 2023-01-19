@extends('layout.backend-layout.admin') @section('content')
<div class="page-body">
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Edit Admin
                            <small>Arkila Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul
                            class="nav nav-tabs tab-coupon"
                            id="myTab"
                            role="tablist"
                        >
                            <li class="nav-item">
                                <a
                                    class="nav-link active show"
                                    id="account-tab"
                                    data-bs-toggle="tab"
                                    href="#account"
                                    role="tab"
                                    aria-controls="account"
                                    aria-selected="true"
                                    data-original-title=""
                                    title=""
                                    >Account</a
                                >
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div
                                class="tab-pane fade active show"
                                id="account"
                                role="tabpanel"
                                aria-labelledby="account-tab"
                            >
                                <form
                                    class="needs-validation user-add"
                                    method="POST"
                                    action="/update_admin"
                                >
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $admin->id }}" />
                                    <div class="form-group row">
                                        <label
                                            for="validationCustom2"
                                            class="col-xl-3 col-md-4"
                                            ><span>*</span>Username</label
                                        >
                                        <div class="col-xl-8 col-md-7">
                                            <input
                                                class="form-control"
                                                id="validationCustom2"
                                                type="text"
                                                name="username"
                                                required=""
                                                value="{{ $admin->username }}"
                                            />
                                            <span class="danger text-danger"
                                                >@error('username'){{
                                                    $message
                                                }}@enderror</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            for="validationCustom2"
                                            class="col-xl-3 col-md-4"
                                            ><span>*</span> Email</label
                                        >
                                        <div class="col-xl-8 col-md-7">
                                            <input
                                                class="form-control"
                                                id="validationCustom2"
                                                type="text"
                                                name="email"
                                                required=""
                                                value="{{ $admin->email }}"
                                            />
                                            <span class="danger text-danger">@error('email'){{$message}}@enderror</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-footer">
                                         <a class="btn btn-secondary" href="/admins">
                                            Cancel
                                        </a>
                                        <button
                                            class="btn btn-primary"
                                            type="submit"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-5">-->
                    <!--    <div-->
                    <!--        class="d-flex align-items-center justify-content-center"-->
                    <!--    >-->
                    <!--        <img-->
                    <!--            src="../../../assets/images/img/1.jpg"-->
                    <!--            class="img-responsive"-->
                    <!--            id="preview-image"-->
                    <!--            alt="Category Image"-->
                    <!--            width="450"-->
                    <!--        />-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</div>

// <script>
//     function showPreview(event) {
//         console.log(event.target);
//         if (event.target.files.length > 0) {
//             var src = URL.createObjectURL(event.target.files[0]);
//             var preview = document.getElementById("preview-image");
//             preview.src = src;
//             preview.style.display = "block";
//         }
//     }
// </script>
@endsection

