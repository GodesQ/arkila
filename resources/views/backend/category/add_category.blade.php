@extends('layout.backend-layout.admin') 

@section('content')
    <div class="page-body">
        <div class="container">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>
                                Add Category
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
                        <div class="col-md-12">
                            <form action="/store_category" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="category_name" class="form-label">Category Image</label>
                                    <input type="file" name="category_image" class="form-control">
                                </div>
                                <div class="form-footer">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection