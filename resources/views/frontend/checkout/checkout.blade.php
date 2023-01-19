 @extends('layout.frontend-layout.frontend') @section('content')
<div class="page-body">
    <!-- section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="checkout-page">
                <div class="checkout-form">
                    @if(Session::get('success'))
                        @push("scripts")
                            <script>
                                toastr.success('{{ Session::get("success") }}', 'Success');
                            </script>
                        @endpush
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            @push("scripts")
                                <script>
                                    toastr.error('{{ $error }}', 'Failed');
                                </script>
                            @endpush
                        @endforeach
                    @endif
                    <form method="POST" action="/store/store_checkout">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>Billing Details</h3>
                                </div>
                                <div class="row check-out">
                                    <div
                                        class="form-group col-md-6 col-sm-6 col-xs-12"
                                    >
                                        <div class="field-label">
                                            First Name
                                        </div>
                                        <input
                                            type="text"
                                            name="firstname"
                                            value="{{ $item->customer->firstname }}"
                                            placeholder=""
                                        />
                                    </div>
                                    <div
                                        class="form-group col-md-6 col-sm-6 col-xs-12"
                                    >
                                        <div class="field-label">Last Name</div>
                                        <input
                                            type="text"
                                            name="lastname"
                                            value="{{ $item->customer->lastname }}"
                                            placeholder=""
                                        />
                                    </div>
                                    <div
                                        class="form-group col-md-6 col-sm-6 col-xs-12"
                                    >
                                        <div class="field-label">Phone</div>
                                        <input
                                            type="text"
                                            name="contactno"
                                            value="{{ $item->customer->contact_no }}"
                                            placeholder=""
                                        />
                                    </div>
                                    <div
                                        class="form-group col-md-6 col-sm-6 col-xs-12"
                                    >
                                        <div class="field-label">
                                            Email Address
                                        </div>
                                        <input
                                            type="text"
                                            name="email"
                                            value="{{ $item->customer->email }}"
                                            placeholder=""
                                        />
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">
                                            Address
                                        </div>
                                        <input
                                            type="text"
                                            name="address"
                                            value="{{ $item->customer->address }}"
                                            placeholder=""
                                        />
                                    </div>
                                    <div
                                        class="form-group col-md-12 col-sm-6 col-xs-12"
                                    >
                                        <div class="field-label">
                                            Postal Code
                                        </div>
                                        <input
                                            type="text"
                                            name="zip_code"
                                            value=""
                                            placeholder=""
                                        />
                                    </div>
                                    <div
                                        class="form-group col-md-12 col-sm-6 col-xs-12"
                                    >
                                        <div class="field-label">
                                            Borrow Duration
                                        </div>
                                        <input type="text" readonly name="daterange" value="" />
                                        <input type="hidden" name="start_date" value="{{ $item->start_date }}">
                                        <input type="hidden" name="end_date" value="{{ $item->end_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>
                                                Product <span>Total</span>
                                            </div>
                                        </div>
                                        <ul class="qty">
                                            <li>
                                                {{ $item->product->product_name }} x {{ $item->quantity }}
                                                <span>&#8369 {{ number_format($item->product->amount, 2) }}</span>
                                            </li>
                                            <li>
                                                Total Rental Date :
                                                <span id="total_dates">
                                                   x {{ $item->total_date }}
                                                </span>
                                                <input type="hidden" name="total_dates" value="{{ $item->total_date }}">
                                            </li>
                                            <li>
                                                Sub Total :
                                                <span>&#8369 {{ number_format($item->amount, 2) }}</span>
                                            </li>
                                        </ul>
                                        <ul class="total">
                                            <li>
                                                Total
                                                <span class="count">&#8369 {{ number_format($item->amount, 2) }}</span>
                                            </li>
                                        </ul>
                                    </div>

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
                                                                value="COD"
                                                            />
                                                            <label for="payment-2">Cash On Delivery</label>
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
                                            <input type="hidden" value="{{ $item->amount }}" name="total">
                                            <input type="hidden" value="{{ $item->product->product_name }}" name="product_name">
                                            <input type="hidden" value="{{ $item->quantity }}" name="quantity">
                                            <input type="hidden" value="{{ $item->id }}" name="cart_id">
                                            <input type="hidden" value="{{ $item->product->id }}" name="product_id">
                                            <input type="hidden" value="{{ $item->customer->id }}" name="customer_id">
                                            <input type="hidden" value="{{ $item->product->vendor_id }}" name="vendor_id">
                                            <button class="btn-solid btn">Submit Borrow Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function() {
        const disabledArr = [];
        $.ajax({
            url: '/store/disabled_dates',
            method: 'GET',
            data: {
                product_id: '{{ $item->product->id }}',
            },
            success: function(responses) {
                responses.forEach(response => {
                    let dates = getDateArray(new Date(response.start_date), new Date(response.end_date));
                    dates.forEach(date => {
                        let formatedDate = setFormatDate(date); 
                        disabledArr.push(formatedDate);
                    })
                });
            }
        })
        
        let startDate = setFormatDate(new Date( $('input[name="start_date"]').val()));
        let endDate = setFormatDate(new Date($('input[name="end_date"]').val()));

        $('input[name="daterange"]').daterangepicker({
            minDate: new Date(),
            startDate: startDate, // after open picker you'll see this dates as picked
            endDate: endDate,
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
            },
            isInvalidDate: function(arg){
                // Prepare the date comparision
                var thisMonth = arg._d.getMonth()+1;   // Months are 0 based
                if (thisMonth < 10){
                    thisMonth = "0"+thisMonth; // Leading 0
                }
                var thisDate = arg._d.getDate();
                if (thisDate < 10){
                    thisDate = "0"+thisDate; // Leading 0
                }
                var thisYear = arg._d.getYear()+1900;   // Years are 1900 based

                var thisCompare = thisMonth +"/"+ thisDate +"/"+ thisYear;
                if($.inArray(thisCompare, disabledArr)!=-1){
                    return true;
                }
            }
        }).val(startDate + " - " + endDate);
        
        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            $('input[name="start_date"]').val(picker.startDate.format('MM/DD/YYYY'));
            $('input[name="end_date"]').val(picker.endDate.format('MM/DD/YYYY'));
            let totalLengthOfDates = getDateArray(new Date(picker.startDate.format('MM/DD/YYYY')), new Date(picker.endDate.format('MM/DD/YYYY')));
            $('input[name="total_dates"]').val(totalLengthOfDates.length);
            $('#total_dates').text('x' + totalLengthOfDates.length);
            let total = Number('{{ $item->amount }}') * Number(totalLengthOfDates.length);
            $('input[name="total"]').val(total.toFixed(2));
            $('.count').text('P ' + total.toFixed(2));
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
