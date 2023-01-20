@extends('layout.backend-layout.admin') @section('content')
    <!--Custom Style for star rating-->
    <style>
        .ratings {
            display: flex;
            justify-content: flex-start;
            width: 30%;
            border-radius: 25px;
        }

        .star {
            font-size: 35px;
            cursor: pointer;
        }
    </style>

    <div class="page-body p-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img width="100%"
                                src="{{ url('/assets/images/customers/' . $item->customer->customer_image) }}"
                                alt="" />
                            <h5 class="text-center" style="font-weight: 800">
                                {{ $item->customer->firstname }} {{ $item->customer->lastname }}
                            </h5>
                        </div>
                        <div class="col-md-9">
                            <div class="my-3">
                                <h2>Write Review</h2>
                            </div>
                            <div class="container-fluid">
                                <form action="/store_customer_review" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="customer_id" value="{{ $item->customer->id }}">
                                    <input type="hidden" name="vendor_id" value="{{ $item->product->vendor->id }}">
                                    <input type="hidden" name="checkout_id" value="{{ $item->id }}">
                                    <div class="form-group">
                                        <label for="">Review</label>
                                        <textarea name="review" id="" cols="5" rows="5"class="form-control"></textarea>
                                        <span class="danger text-danger">
                                            @error('review')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Item Status</label>
                                        <textarea name="item_status" id="" cols="5" rows="5" class="form-control"></textarea>
                                        <span class="danger text-danger">@error('item_status'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <h4 for="">Rate Customer</h4>
                                        <div class="ratings">
                                            <div class="star" id="1" style="color: rgb(255, 166, 0);">&#9734;
                                            </div>
                                            <div class="star" id="2" style="color: rgb(255, 166, 0);">&#9734;
                                            </div>
                                            <div class="star" id="3" style="color: rgb(255, 166, 0);">&#9734;
                                            </div>
                                            <div class="star" id="4" style="color: rgb(255, 166, 0);">&#9734;
                                            </div>
                                            <div class="star" id="5" style="color: rgb(255, 166, 0);">&#9734;
                                            </div>
                                        </div>
                                        <input type="hidden" name="rate" id="rate">
                                        <div class="danger text-danger">
                                            @error('rate')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-footer">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let stars = document.querySelectorAll('.star');
        let rate = document.querySelector('#rate');
        let currentActiveStar = 0;
        stars.forEach((star, i) => {
            star.onclick = function() {
                currentActiveStar = this.id;
                rate.value = currentActiveStar;
                stars.forEach((star, i) => {
                    if (currentActiveStar >= i + 1) {
                        star.innerHTML = '&#9733;';
                    } else {
                        star.innerHTML = '&#9734;';
                    }
                });
            }

        });
    </script>
@endsection
