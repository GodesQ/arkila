@extends('layout.backend-layout.admin') 
@section('content')
@if(Session::get('success'))
    @push('scripts')
        <script>
            toastr.success('{{ Session::get("success") }}', 'Success');
        </script>
    @endpush
@endif
<div class="page-body">
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Edit Category
                            <small>Arkila Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form
                            action="/update_category"
                            enctype="multipart/form-data"
                            method="POST"
                        >
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <div class="form-group">
                                <label for="category_name" class="form-label"
                                    >Category Name</label
                                >
                                <input
                                    type="text"
                                    name="category_name"
                                    value="{{ $category->category_name }}"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label for="category_name" class="form-label"
                                    >Category Image</label
                                >
                                <input
                                    type="file"
                                    name="category_image"
                                    onchange="showPreview(event)"
                                    class="form-control"
                                />
                                <input
                                    type="hidden"
                                    name="old_image"
                                    class="form-control"
                                    value="{{ $category->category_image }}"
                                />
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center align-items-center">
                            <img
                                src="../../../assets/images/categories/{{ $category->category_image }}"
                                class="img-responsive"
                                id="preview-image"
                                alt="Category Image"
                                width="500"
                            />
                        </div>
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
