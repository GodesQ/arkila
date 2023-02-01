@extends('layout.frontend-layout.frontend')

@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        @push('scripts')
            <script>
                toastr.error('{{ $error }}', 'Error')
            </script>
        @endpush
    @endforeach
@endif

    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-bold">Pay Penalty</h3>
                        <hr>
                        <form action="/store/pay_penalty" method="post">
                            @csrf
                            <input type="hidden" value="{{ $checkout->id }}" name="checkout_id">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-label font-weight-bold">Product</div>
                                                <h4>{{ optional($checkout->product)->product_name }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-label font-weight-bold">Product Price</div>
                                                <input type="text" class="form-control" name="product_price" value="{{ number_format(optional($checkout->product)->amount, 2) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-label font-weight-bold">Penalty Days</div>
                                                @php
                                                    $date2 = new DateTime($checkout->end_date);
                                                    $date1 = new DateTime(date('Y-m-d'));
                                                    $diff = $date2->diff($date1);
                                                @endphp
                                                <input type="text" class="form-control" name="penalty_days" value="{{ $diff->days }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-label font-weight-bold">Total</div>
                                                @php
                                                    $total = (optional($checkout->product)->amount * $diff->days) * 1.25;
                                                @endphp
                                                <input type="text" class="form-control" name="total" value="{{ $total }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div style="color: #444444; font-weight: 600; font-size: 22px;">
                                                Payment Method
                                            </div>
                                            <div class="payment-options">
                                                <ul>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input
                                                                type="radio"
                                                                name="payment_type"
                                                                id="payment-2"
                                                                value="COR"
                                                            />
                                                            <label for="payment-2">Cash On Returned</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input
                                                                type="radio"
                                                                name="payment_type"
                                                                id="payment-1"
                                                                value="CC"
                                                            />
                                                            <label for="payment-1">Credit Card</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input
                                                                type="radio"
                                                                name="payment_type"
                                                                id="payment-4"
                                                                value="BC"
                                                            />
                                                            <label for="payment-4">E-Wallet / Bitcoins</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option paypal">
                                                            <input
                                                                type="radio"
                                                                name="payment_type"
                                                                id="payment-3"
                                                                value="PAYPAL"
                                                            />
                                                            <label
                                                                for="payment-3"
                                                                >PayPal</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option paypal">
                                                            <input
                                                                type="radio"
                                                                name="payment_type"
                                                                id="payment-6"
                                                                value="GCASH"
                                                            />
                                                            <label
                                                                for="payment-6"
                                                                >GCASH</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option paypal">
                                                            <input
                                                                type="radio"
                                                                name="payment_type"
                                                                id="payment-7"
                                                                value="BOGUS_BANK"
                                                            />
                                                            <label
                                                                for="payment-7"
                                                                >BOGUS BANK</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option paypal">
                                                            <input
                                                                type="radio"
                                                                name="payment_type"
                                                                id="payment-5"
                                                                value="BOG"
                                                            />
                                                            <label
                                                                for="payment-5"
                                                                >Bank Online</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button class="btn-solid btn">Pay Penalty</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
