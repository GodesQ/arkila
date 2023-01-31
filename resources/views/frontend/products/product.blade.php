@extends('layout.frontend-layout.frontend') @section('content')
    <div class="page-body">
        @if (Session::get('success'))
            @push('scripts')
                <script>
                    toastr.success('{{ Session::get('success') }}', 'Added');
                </script>
            @endpush
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @push('scripts')
                    <script>
                        toastr.error("{{ $error }}", 'Failed');
                    </script>
                @endpush
            @endforeach
        @endif
        <!-- breadcrumb start -->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-title">
                            <h2>Item</h2>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <nav aria-label="breadcrumb" class="theme-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Item
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb End -->
        <!-- section start -->
        <section class="section-b-space">
            <form method="POST" action="/store_cart" id="store_cart">
                @csrf
                <input type="hidden" value="{{ $product->id }}" name="product_id">
                <input type="hidden" value="{{ $product->vendor_id }}" name="vendor_id">
                <input type="hidden" value="{{ session()->get('id') }}" name="customer_id">
                <input type="hidden" value="{{ $product->amount }}" name="product_price">
                <div class="collection-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ url('assets/images/products/' . $product->product_image) }}"
                                    style="width: 100%; object-fit: cover !important;" alt="">
                            </div>
                            <div class="col-lg-6 rtl-text">
                                <div class="product-right">
                                    <h2 style="margin: 0;">{{ $product->product_name }}</h2>
                                    @if ($product->rate)
                                        <a href="#review-list">
                                            <span
                                                style="color: #ffc72d; font-size: 20px;">{{ number_format($product->rate, 1) }}</span>
                                            @for ($i = 0; $i < round($product->rate); $i++)
                                                <span style="color: #ffc72d; font-size: 25px;">&#9733;</span>
                                            @endfor
                                            <span style="margin-left: 7px;">{{ $product->total_reviews }} Reviews</span>
                                        </a>
                                    @else
                                        <a href="#review-list">
                                            @for ($i = 0; $i < 5; $i++)
                                                <span style="color: #ffc72d; font-size: 25px;">&#9734;</span>
                                            @endfor
                                            <span style="margin-left: 7px;">{{ $product->total_reviews }} Reviews</span>
                                        </a>
                                    @endif
                                    <h3 class="price-detail">₱ <span class="total_display_amount"
                                            style="color: #000; font-size: 25px;">{{ number_format($product->amount, 2) }}</span>
                                    </h3>
                                    <h4 class="price-detail">Stock: {{ $product->stock }}</h4>
                                    <h6 class="product-title">quantity</h6>
                                    <div class="qty-box my-2">
                                        <div class="input-group justify-content-lg-start justify-content-md-center">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn" onclick="setMinusQuantity()">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="number" readonly name="quantity" class="form-control input-number"
                                                value="{{ $cart ? $cart->quantity : 1 }}" max="{{ $product->stock }}">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn"
                                                    onclick="setAddQuantity('{{ $product->stock }}')">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="product-detail my-4">@php echo nl2br($product->description) @endphp</p>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">
                                            Borrow Duration
                                        </div>
                                        <input type="text" readonly name="daterange" value=""
                                            placeholder="Select Dates" class="form-control" />
                                        <input type="hidden" name="start_date"
                                            value="{{ $cart ? $cart->start_date : null }}">
                                        <input type="hidden" name="end_date" value="{{ $cart ? $cart->end_date : null }}">
                                    </div>
                                    <h4>Total Days: <span
                                            class="total_date_count">{{ $cart ? $cart->total_date : null }}</span></h4>
                                    <br>
                                    <div class="product-buttons">
                                        <input type="hidden" value="{{ $cart ? $cart->amount : null }}" name="amount">
                                        <input type="hidden" name="total_dates"
                                            value="{{ $cart ? $cart->total_date : null }}">
                                        @if ($product->stock > 0)
                                            @if ($cart)
                                                <button type="submit" id="cartEffect"
                                                    class="btn btn-solid hover-solid btn-animation">
                                                    <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i> Update In
                                                    Cart
                                                </button>
                                            @else
                                                <button type="submit" id="cartEffect"
                                                    class="btn btn-solid hover-solid btn-animation">
                                                    <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i> Borrow This
                                                    Item
                                                </button>
                                            @endif
                                        @else
                                            <button type="button" disabled id="cartEffect"
                                                class="btn btn-solid hover-solid btn-secondary btn-animation">
                                                Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <!-- Section ends -->

        <!-- product-tab starts -->
        <section class="tab-product pt-0 my-3" id="review-list">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="review-top-tab" data-bs-toggle="tab"
                                    href="#top-review" role="tab" aria-selected="false"><i
                                        class="icofont icofont-contacts"></i>Reviews
                                    ({{ $product->reviews->count() }})</a>
                                <div class="material-border"></div>
                            </li>
                        </ul>
                        <div class="tab-content nav-material" id="top-tabContent">
                            <div class="tab-pane active p-1" id="top-review" role="tabpanel"
                                aria-labelledby="review-top-tab">
                                @if (count($product->reviews) > 0)
                                    <div class="d-flex justify-content-end align-items-start my-2">
                                        <a href="/store/reviews/{{ $product->id }}">See all Reviews <i
                                                class="fa fa-arrow-right"></i></a>
                                    </div>
                                @endif
                                @forelse($product->reviews as $review)
                                    @if ($loop->index < 3)
                                        <div class="container shadow-sm p-3">
                                            <div class="h6 text-primary">{{ $review->customer->firstname }}
                                                {{ $review->customer->lastname }}</div>
                                            @if ($review->review_image)
                                                <img style="width: 100px; object-fit: cover;"
                                                    src="{{ url('/assets/images/product_reviews/' . $review->review_image) }}"
                                                    alt="">
                                            @endif
                                            <div id="{{ $review->rate }}" class="rate"></div>
                                            <div class="my-2">{{ $review->review }}</div>
                                        </div>
                                    @endif
                                @empty
                                    <div>No Reviews Here</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product-tab ends -->

        <div class="container mt-5 p-3 rounded" style="background-color: #038dcc;">
            <div class="row">
                <div class="col-md-9">
                    <div>
                        <h2 class="text-white">{{ $product->vendor->username }}</h2>
                        <h6 class="text-white">{{ $product->vendor->email }}</h6>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                    <a href="/store/vendor/{{ $product->vendor->id }}" class="btn btn-solid btn-air-primary">Visit Vendor
                        Shop</a>
                </div>
            </div>
        </div>

        <script>
            const inputNumber = document.querySelector('.input-number');

            function setAddQuantity(stock) {
                if (Number(inputNumber.value) < stock) return inputNumber.value = Number(inputNumber.value) + 1;
            }

            function setMinusQuantity() {
                if (inputNumber.value > 1) return inputNumber.value = Number(inputNumber.value) - 1;
            }
        </script>
    </div>

@endsection


@push('scripts')
    <script>
        $('#store_cart').submit(function(e) {
            e.preventDefault();
            if (!'{{ Session::get('role') }}' && !'{{ Session::get('token') }}') {
                toastr.error('Sign In first to continue.', 'Failed');
            } else {
                this.submit();
            }
        });

        let rates = document.querySelectorAll('.rate');
        rates.forEach((rate) => {
            const values = [...Array(Number(rate.id))].map((_, i) => i + 1);
            console.log(values);
            values.forEach((value) => {
                $(rate).append(`<li style="font-size: 20px; color: rgb(255, 166, 0)">&#9733;</li>`);
            })
        })

        $(function() {
            const disabledArr = [];
            $.ajax({
                url: '/store/disabled_dates',
                method: 'GET',
                data: {
                    product_id: '{{ $product->id }}',
                },
                success: function(responses) {
                    responses.forEach(response => {
                        let dates = getDateArray(new Date(response.start_date), new Date(
                            response.end_date));
                        dates.forEach(date => {
                            let formatedDate = setFormatDate(date);
                            disabledArr.push(formatedDate);
                        })
                    });
                }
            })

            let startDate = $('input[name="start_date"]').val() ? setFormatDate(new Date($(
                'input[name="start_date"]').val())) : null;
            let endDate = $('input[name="end_date"]').val() ? setFormatDate(new Date($('input[name="end_date"]')
                .val())) : null;

            $('input[name="daterange"]').daterangepicker({
                autoUpdateInput: false,
                minDate: new Date(),
                startDate: startDate ? startDate : $(this).val(
                ' '), // after open picker you'll see this dates as picked
                endDate: startDate ? endDate : $(this).val(' '),
                locale: {
                    cancelLabel: 'Clear',
                },
                isInvalidDate: function(arg) {
                    // Prepare the date comparision
                    var thisMonth = arg._d.getMonth() + 1; // Months are 0 based
                    if (thisMonth < 10) {
                        thisMonth = "0" + thisMonth; // Leading 0
                    }
                    var thisDate = arg._d.getDate();
                    if (thisDate < 10) {
                        thisDate = "0" + thisDate; // Leading 0
                    }
                    var thisYear = arg._d.getYear() + 1900; // Years are 1900 based

                    var thisCompare = thisMonth + "/" + thisDate + "/" + thisYear;
                    if ($.inArray(thisCompare, disabledArr) != -1) {
                        return true;
                    }
                }
            }).val(startDate && endDate ? startDate + ' - ' + endDate : '');

            $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
                $('input[name="start_date"]').val(picker.startDate.format('MM/DD/YYYY'));
                $('input[name="end_date"]').val(picker.endDate.format('MM/DD/YYYY'));
                let totalLengthOfDates = getDateArray(new Date(picker.startDate.format('MM/DD/YYYY')),
                    new Date(picker.endDate.format('MM/DD/YYYY')));
                $('input[name="total_dates"]').val(totalLengthOfDates.length);
                $('.total_date_count').text(totalLengthOfDates.length);
                let total = Number('{{ $product->amount }}') * Number(totalLengthOfDates.length);
                $('input[name="amount"]').val(total.toFixed(2));
            });

            $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('input[name="start_date"]').val('');
                $('input[name="end_date"]').val('');
            });

            const getDateArray = (start_date, end_date) => {
                var arr = [];
                while (start_date <= end_date) {
                    arr.push(new Date(start_date));
                    start_date.setDate(start_date.getDate() + 1);
                }
                return arr;
            }

            function setFormatDate(format_date) {
                const t = new Date(format_date);
                const date = ('0' + t.getDate()).slice(-2);
                const month = ('0' + (t.getMonth() + 1)).slice(-2);
                const year = t.getFullYear();
                const fullDate = `${month}/${date}/${year}`;
                return fullDate;
            }
        });
    </script>
@endpush
