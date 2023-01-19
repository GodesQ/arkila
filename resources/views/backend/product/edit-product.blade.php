@extends('layout.backend-layout.admin') @section('content')
<div class="page-body">
    <div class="content-wrapper">
        <div class="container">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>
                                Edit Product
                                <small>Arkila Admin panel</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="/admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="card-header">
                            <h5>Product</h5>
                        </div>
                        <div class="card-body">
                            <form
                                action="/update_product"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @csrf
                                <input
                                    name="id"
                                    value="{{ $product->id }}"
                                    type="hidden"
                                />
                                <div class="digital-add needs-validation">
                                    @if(session()->get('role') == 'admin')
                                    <div class="form-group">
                                        <label class="col-form-label"
                                            ><span>*</span>Vendor</label
                                        >
                                        <select
                                            class="custom-select form-control"
                                            name="vendor_id"
                                            {{ session()->get('role') == 'vendor' ? 'readonly' : null }}> @foreach($vendors as  $vendor)
                                            <option
                                                value="{{ $vendor->id }}"
                                                {{ $product-> vendor_id == $vendor->id ? 'selected' : null }}>{{ $vendor->email }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @else
                                    <input
                                        type="hidden"
                                        name="vendor_id"
                                        value="{{ $product->vendor_id }}"
                                    />
                                    @endif
                                    <div class="form-group">
                                        <label
                                            for="validationCustom01"
                                            class="col-form-label pt-0"
                                            ><span>*</span> Title</label
                                        >
                                        <input
                                            class="form-control"
                                            id="validationCustom01"
                                            type="text"
                                            name="product_name"
                                            value="{{ $product->product_name }}"
                                        />
                                        @error('product_name'){{
                                            $message
                                        }}@enderror
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="validationCustomtitle"
                                            class="col-form-label pt-0"
                                            ><span>*</span> Stock</label
                                        >
                                        <input
                                            class="form-control"
                                            id="validationCustomtitle"
                                            type="text"
                                            name="stock"
                                            value="{{ $product->stock }}"
                                        />
                                        @error('product_name'){{
                                            $message
                                        }}@enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"
                                            ><span>*</span> Categories</label
                                        >
                                        <select
                                            class="custom-select form-control"
                                            name="category_id"
                                        >
                                            <option value="">--Select--</option>
                                            @foreach($categories as $category)
                                            <option {{ $product->category_id == $category->id ? 'selected' : null }} value="{{ $category->id}}">
                                                {{ $category->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('product_name'){{
                                            $message
                                        }}@enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"
                                            >Description</label
                                        >
                                        <textarea
                                            name="description"
                                            rows="5"
                                            cols="12"
                                            >{{ $product->description }}</textarea
                                        >
                                        @error('product_name'){{
                                            $message
                                        }}@enderror
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="validationCustom02"
                                            class="col-form-label"
                                            ><span>*</span> Product Price</label
                                        >
                                        <input
                                            class="form-control"
                                            id="validationCustom02"
                                            type="text"
                                            name="amount"
                                            value="{{ $product->amount }}"
                                        />
                                        @error('amount'){{ $message }}@enderror
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="validationCustom03"
                                            class="col-form-label"
                                            ><span>*</span>Product Image</label
                                        >
                                        <input
                                            onchange="showPreview(event)"
                                            class="form-control"
                                            id="validationCustom03"
                                            type="file"
                                            name="product_image"
                                        />
                                        <input
                                            type="hidden"
                                            name="old_image"
                                            value="{{ $product->product_image }}"
                                        />
                                        @error('product_image'){{
                                            $message
                                        }}@enderror
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="d-flex align-items-center justify-content-center"
                    >
                        <img
                            src="../../../assets/images/products/{{ $product->product_image }}"
                            class="img-responsive"
                            id="preview-image"
                            alt="Category Image"
                            width="600"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showPreview(event) {
        console.log(event.target);
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview-image");
            preview.src = src;
            preview.style.display = "block";
        }
    }
</script>
@endsection
