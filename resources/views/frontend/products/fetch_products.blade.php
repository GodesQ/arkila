<style>
</style>

@forelse($products as $product)
    <div class="col-xl-3 col-6 col-grid-box">
        <div class="product-box">
            <div class="img-wrapper">
                <div class="front">
                    <a href="/store/product/{{ $product->id }}"
                        style="background-image: url('{{ url('assets/images/products/' . $product->product_image) }}');
                        background-size: cover;
                        background-position: center center;
                        display: block;" class="bg-size blur-up lazyloaded">
                        <img src="{{ url('assets/images/products/' . $product->product_image) }}"
                            class="img-fluid blur-up lazyload bg-img"
                            style="background-image: url('{{ url('assets/images/products/' . $product->product_image) }}');
                            background-size: cover;
                            background-position: center center;
                            display: none;"
                            alt="">
                    </a>
                </div>
                {{-- <div class="back">
                    <a href="/store/product/{{ $product->id }}">
                        <img src="{{ url('assets/images/products/' . $product->product_image) }}"
                            class="img-fluid blur-up lazyload bg-img"
                            alt="">
                    </a>
                </div> --}}
            </div>
            <div class="product-detail">
                <div>
                    <div class="" style="color: #ffc72d;">
                        @if(optional($product)->rate)
                            <span style="color: #ffc72d; font-size: 15px;">{{ number_format(optional($product)->rate, 1) }}</span>
                            @for ($i = 0; $i < round(optional($product)->rate); $i++)
                            <i class="fa fa-star"></i>
                            @endfor
                        @else
                            <span style="color: #ffc72d; font-size: 15px;">{{ number_format(optional($product)->rate, 1) }}</span>
                            @for ($i = 0; $i < 5; $i++)
                            <span style="color: #ffc72d;"">&#9734;</span>
                            @endfor
                        @endif
                    </div>
                    <a href="/store/product/{{ $product->id }}">
                        <h6>{{ $product->product_name }}</h6>
                    </a>
                    <p>{{ substr($product->description, 0, 20 )}}
                    </p>
                    <h4>₱ {{ number_format($product->amount, 2) }}</h4>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="my-3">
        <h4 class="text-center">No Products Available</h4>
    </div>
@endforelse

{{ $products->links('layout.frontend-layout.pagination')}}
