@extends('layout.frontend-layout.frontend')

@section('content')
    <div class="page-body">
        <div class="page-wrapper">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <h1>{{ $total_average }}</h1>
                            <div class="stars"></div>
                            <h4>Based on {{ count($reviews) }} Reviews</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @forelse($reviews as $review)
                                    <div class="col-md-12 shadow-sm p-3"> 
                                        <div class="h6 text-primary">{{ $review->customer->firstname }} {{ $review->customer->lastname }}</div>
                                        @if($review->review_image)
                                            <img style="width: 100px; object-fit: cover;" src="{{ url('/assets/images/product_reviews/' . $review->review_image) }}" alt="">
                                        @endif
                                        <div id="{{ $total_average }}" class="rate"></div>
                                        <div class="my-1">{{ $review->review }}</div>
                                    </div>
                                @empty

                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let rates = document.querySelectorAll('.rate');
       rates.forEach((rate) => {
            const values =  [...Array(Number(rate.id))].map((_, i) => i+1);
            console.log(values);
            values.forEach((value) => {
                $(rate).append(`<li style="font-size: 20px; color: rgb(255, 166, 0)">&#9733;</li>`);
            })
       })
    </script>
@endpush