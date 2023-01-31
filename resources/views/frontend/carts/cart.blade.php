@extends('layout.frontend-layout.frontend') @section('content')
<div class="page-body">
    <div class="page-wrapper">
        <!--section start-->
        <section class="cart-section section-b-space">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 table-responsive-xs">
                        <table class="table cart-table table-responsive">
                            <thead>
                                <tr class="table-head">
                                    <th scope="col">image</th>
                                    <th scope="col">product name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">Total Date</th>
                                    <th scope="col">total</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($carts as $cart)
                                <tr>
                                    <td>
                                        <a href="/store/product/{{ optional($cart->product)->id }}">
                                            <img src="{{ url('assets/images/products/' . optional($cart->product)->product_image ) }}"alt="" />
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/store/product/{{ optional($cart->product)->id }}">{{ optional($cart->product)->product_name }}</a>
                                        <div class="mobile-cart-content row">
                                            <div class="col">
                                                <div class="qty-box">
                                                    <div class="input-group">
                                                        <input
                                                            type="text"
                                                            name="quantity"
                                                            id=""
                                                            class="form-control input-number"
                                                            value="{{ $cart->quantity }}"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h2 class="td-color">{{ optional($cart->product)->amount }}</h2>
                                            </div>
                                            <div class="col">
                                                <h2 class="td-color">
                                                    <a href="#" class="icon"
                                                        ><i class="ti-close"></i
                                                    ></a>
                                                </h2>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h2>&#8369 {{ number_format(optional($cart->product)->amount, 2) }}</h2>
                                    </td>
                                    <td>
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <input
                                                    oninput="updateCartQuantity(this, '{{ optional($cart->product)->amount }}', {{ $cart->total_date }})"
                                                    type="number"
                                                    id="{{ $cart->id }}"
                                                    min="1" max="{{ optional($cart->product)->stock }}"
                                                    name="quantity"
                                                    class="form-control input-number"
                                                    value="{{ $cart->quantity }}"
                                                />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h3>
                                            {{ $cart->total_date ? $cart->total_date : 0 }}
                                        </h3>
                                    </td>
                                    <td>
                                        <h2 class="td-color">&#8369 <span class="total">{{ number_format($cart->amount, 2) }}</span></h2>
                                    </td>
                                    <td>
                                        @if(optional($cart->product)->stock == 0 || $cart->quantity > optional($cart->product)->stock)
                                            <a href="#" class="text-white btn btn-sm" style="background-color: gray;">OUT OF STOCK</a>
                                        @else
                                            <a href="/store/checkout/{{ $cart->id }}" class="text-white btn btn-sm btn-primary ">BORROW</a>
                                        @endif

                                        <a href="/destroy_cart/{{ $cart->id }}" class="text-white btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">No Items</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row cart-buttons">
                    <div class="col-12">
                        <a href="/" class="btn btn-solid">continue shopping</a>
                    </div>
                </div>
            </div>
        </section>
        <!--section end-->
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function updateCartQuantity(e, amount, total_date) {
            if('{{ count($carts) }}' > 0) {
                $.ajax({
                    url: '/store/update_quantity',
                    method: 'GET',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': e.id,
                        'quantity': e.value,
                        'price': amount,
                        'total_date' : total_date
                    },
                    success: function(response) {
                        if(response.status == 200) {
                            let total = $(e).parent().parent().parent().parent().children()[5];
                            console.log(total);
                            $(total).html(`<h2 class="td-color">&#8369 <span class="total">${Number(response.total).toFixed(2)}</span></h2>`);
                        } else {
                            toastr.warning(`${response.message}`, 'Fail');
                        }
                    }
                });
            }
        }
    </script>
@endpush
